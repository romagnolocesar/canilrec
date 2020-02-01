$(function () {
  contentUrl = api['calendar']+'/userhasdate/'+globals['logged-user']['id'];
  eventsData = [];
  resourcesData = [];
  var backgroundColor
  var borderColor;
  var startDateObj, endDateObj;
  $.ajax({
    type: 'POST',
    url: contentUrl,
    success: function(data){
      for (var i = data.length - 1; i >= 0; i--) {
        if(data[i]['color'] == 'red'){
          backgroundColor = '#f56954';
          borderColor = '#f56954';
        }else if(data[i]['color'] == 'aqua'){
          backgroundColor = '#00c0ef';
          borderColor = '#00c0ef';
        }else if(data[i]['color'] == 'blue'){
          backgroundColor = '#0073b7';
          borderColor = '#0073b7';
        }else if(data[i]['color'] == 'light-blue'){
          backgroundColor = '#3c8dbc';
          borderColor = '#3c8dbc';
        }else if(data[i]['color'] == 'teal'){
          backgroundColor = '#39cccc';
          borderColor = '#39cccc';
        }else if(data[i]['color'] == 'yellow'){
          backgroundColor = '#f39c12';
          borderColor = '#f39c12';
        }else if(data[i]['color'] == 'orange'){
          backgroundColor = '#ff851b';
          borderColor = '#ff851b';
        }else if(data[i]['color'] == 'green'){
          backgroundColor = '#00a65a';
          borderColor = '#00a65a';
        }else if(data[i]['color'] == 'lime'){
          backgroundColor = '#01ff70';
          borderColor = '#01ff70';
        }else if(data[i]['color'] == 'purple'){
          backgroundColor = '#605ca8';
          borderColor = '#605ca8';
        }else if(data[i]['color'] == 'fuchsia'){
          backgroundColor = '#f012be';
          borderColor = '#f012be';
        }else if(data[i]['color'] == 'navy'){
          backgroundColor = '#001f3f';
          borderColor = '#001f3f';
        }

        if(data[i]['startdate'] > 0 && data[i]['enddate'] > 0){
          startDateObj = timeConverter(data[i]['startdate']);
          endDateObj = timeConverter(data[i]['enddate']);
        }

        //EVENT DATA
        eventData = {
          id              : data[i]['id'],
          title           : decodeURIComponent(escape(data[i]['title'])),
          start           : new Date(startDateObj['year'], startDateObj['month']-1, startDateObj['day'], startDateObj['hour'], startDateObj['min']),
          end             : new Date(endDateObj['year'], endDateObj['month']-1, endDateObj['day'], endDateObj['hour'], endDateObj['min']),
          backgroundColor : backgroundColor,
          borderColor     : borderColor,
          editable        : (data[i]['eventtype'] == 1 && (globals['logged-user']['usertypeid'] != globals['usertypeid']['admin'] && globals['logged-user']['usertypeid'] != globals['usertypeid']['coadmin'])) ? false : true,
        };
        eventsData.push(eventData);
        
      }
      $('#calendar').fullCalendar({
        header    : {
          left  : 'prev,next today',
          center: 'title',
          right : 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'hoje',
          month: 'mes',
          week : 'semana',
          day  : 'dia'
        },
        //Random default events
        events                : eventsData,
        editable              : true,
        eventDurationEditable : true,
        droppable             : true, // this allows things to be dropped onto the calendar !!!
        drop                  : function (date, allDay) { // this function is called when something is dropped
          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject')

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject)

          // assign it the date that was reported
          copiedEventObject.start           = date
          // date.add(1, 'd')
          // copiedEventObject.end             = date
          copiedEventObject.allDay          = allDay
          copiedEventObject.backgroundColor = $(this).css('background-color')
          copiedEventObject.borderColor     = $(this).css('border-color')

          // render the event on the calendar
          // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
          $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)
          $(this).remove();
          updateEventsDB(copiedEventObject);
            

        },
        eventResize : function(ele, args){
          init_events($(this));
          updateEventsDB(ele);
        },
        eventDrop : function(ele, args){
          init_events($(this));
          updateEventsDB(ele);
        }
      });
    }

  });

//***********************DATABASE FUNCTIONS**********************
  //Update event into database
    function updateEventsDB(ele){
      contentUrl = api['calendar']+'/update/'+ele.id;
      start = ele.start.unix();
      end = 0;
      if(ele.end){
        end = ele.end.unix();
      }
      $.ajax({
        type: 'POST',
        url: contentUrl,
        data: {
          'start': start,
          'end': end,
        },
        success: function(data){

        }
      });
    }

    //create new event into database
    function createEventsDB(title, color, eventtype, callback){
      contentUrl = api['calendar']+'/new';
      $.ajax({
        type: 'POST',
        url: contentUrl,
        data: {
          'title': title,
          'color': color,
          'eventtype': eventtype,
          'userid': globals['logged-user']['id']
        },
        success: function(data){
          callback(data);
        }
      });
    }
    
    
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          id      : $(this).data('id'),
          title   : $.trim($(this).text()), // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      });
    }
    

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    var colorAlias;
    var eventtype;
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color');
      colorAlias = $(this).data('color');
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor });
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      if($("#checkbox-eventtype .icheckbox_minimal-blue").attr('aria-checked') == "true"){
        eventtype = 1; //evento publico
      }else{
        eventtype = 2; //evento privado
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')

      if(eventtype == 1){
        event.html('[publico] '+ val);
      }else if(eventtype == 2){
        event.html(val);
      }

      createEventsDB(event.text(), colorAlias, eventtype, function(result){
        if(result){
          $(event).attr('data-id', result);

          $('#external-events').prepend(event)

          //Add draggable funtionality
          init_events(event)

          //Remove event from text input
          $('#new-event').val('')

          //Clean btn color
          $('#add-new-event').css({ 'background-color': '', 'border-color': '' })

        }
      });
    })
  })