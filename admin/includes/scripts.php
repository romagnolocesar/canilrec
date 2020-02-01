
<!-- TABLES DATA !IMPORTANTE -->
<!-- jQuery 3 -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- PACE -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/PACE/pace.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/dist/js/adminlte.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- fullCalendar -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/moment/moment.js"></script>
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- JCrop -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/bower_components/jcrop/jquery.Jcrop.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/plugins/iCheck/icheck.min.js"></script>

<!-- JQUERY PULSE -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/jquery.pulse.js"></script>
<!-- PACE CUSTOM -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/pace.js"></script>
<!-- INIT CRUD BUTTONS ACTIONS -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/initcrudbuttonsactions.js"></script>
<!-- INIT CRUD BUTTONS -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/initcrudbuttons.js"></script>
<!-- INIT WYSI EDITORS -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/initwysieditors.js"></script>
<!-- INIT DATA TABLE -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/initdatatable.js"></script>
<!-- INIT SELECTS2 -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/initselects2.js"></script>
<!-- CALENDAR DASHBOARD -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/calendar.js"></script>
<!-- MAILBOX -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/mailbox.js"></script>
<!-- USERS HANDLER -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/usersHandler.js"></script>
<!-- CHAT -->
<!-- <script src="/js/chat.js"></script> -->
<script src="<?php echo $GLOBALS['admin_base_url']; ?>/js/fancywebsocket.js"></script>
<script type="text/javascript">
    var urlPort = 'localhost:12345';
  </script>


<!-- PAGE SCRIPTS -->
<script>
  //iCheck for checkbox and radio inputs 
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })
  function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours()+3; //FIX TO LOCALE PTBR (+3) 
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = {
      day :   date,
      monthName:  month,
      month:  a.getMonth()+1,
      year :  year,
      hour :  hour,
      min :   min,
      sec :   sec
    }
    return time;
  }

  function initDragbbleSectionsBoxes(){
    $('#dragbble-pages-sections').sortable({
      placeholder         : 'sort-highlight',
      handle              : '.boxes',
      forcePlaceholderSize: true,
      zIndex              : 999999
    });
  }
  

  var size;
  var originalNameUploadPicture;

    function sendPicture(target){
      var form = document.querySelector('form#dataform')
      var formData = new FormData(form);
      $("#cropbox").show();

      $.ajax({
        url: admin_base_url+'/managerImages.php?action=upload&target='+target,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
          console.log(data);
          var src = $("#cropbox").attr("src");
          originalNameUploadPicture = data;
          $("#cropbox").attr("src", src+data);
          $('#cropbox').Jcrop({
            aspectRatio: 1,
            onSelect: function(c){
             size = {x:c.x,y:c.y,w:c.w,h:c.h};
             $("#crop").css("visibility", "visible");    
            },
            boxWidth: 500,
            boxHeight: 500,
            setSelect: [0,0,500,500]
          });
          $("#fileFieldUpload").hide(); 
          $("#currentPicture").hide();
          $("#btnCrop").show();
        }
      });

    }

    function cropPicture(target){
      var img = $("#cropbox").attr('src');
        $.ajax({
            url: admin_base_url+'/managerImages.php?action=crop&target='+target,
            type: "GET",
            data: {
                x: size.x,
                y: size.y,
                w: size.w,
                h: size.h,
                img: img,
                filename: originalNameUploadPicture

            },
            success: function(data) {
                $(".jcrop-holder").hide();
                $("#btnCrop").hide();
                $("#currentPicture").show();
                if(target === "artists"){
                  $("#currentPicture").attr('src', base_url+'/img/artists/'+data);  
                }else if(target === "tracks"){
                  $("#currentPicture").attr('src', base_url+'/img/covers/'+data);
                }else if(target === "users"){
                  $("#currentPicture").attr('src', admin_base_url+'/img/users/'+data);
                }
                
                $("#cropbox").hide();
                $("#hiddenpicturefield").attr("value", data);
            }
        })
    }

    function fillHiddenFieldFromSelect2(event, hiddenFieldId){
      var select2Value = $(event.target).val();
      $("#"+hiddenFieldId).val(select2Value);
    }

    var page;
    var admin_manager_service;
    var base_url;
    var admin_base_url;
    var api = [];
    var globals = []

    initGetVariables = function(){

      page = "<?php echo $page; ?>";  
      base_url = "<?php echo $GLOBALS['base_url']; ?>";
      admin_base_url = "<?php echo $GLOBALS['admin_base_url']; ?>";

  
      globals['logged-user'] = [];
      globals['logged-user']['id'] = "<?php echo utf8_decode($_SESSION['logged-user']->id); ?>";
      globals['logged-user']['name'] = "<?php echo utf8_decode($_SESSION['logged-user']->name); ?>";
      globals['logged-user']['lastname'] = "<?php echo utf8_decode($_SESSION['logged-user']->lastname); ?>";
      globals['logged-user']['email'] = "<?php echo utf8_decode($_SESSION['logged-user']->email); ?>";
      globals['logged-user']['login'] = "<?php echo utf8_decode($_SESSION['logged-user']->login); ?>";
      globals['logged-user']['picture'] = "<?php echo utf8_decode($_SESSION['logged-user']->picture); ?>";
      globals['logged-user']['usertypeid'] = "<?php echo utf8_decode($_SESSION['logged-user']->usertypeid); ?>"
      globals['logged-user']['online'] = "<?php echo utf8_decode($_SESSION['logged-user']->online); ?>"

      globals['usertypeid'] = []
      globals['usertypeid']['admin'] = 1;
      globals['usertypeid']['coadmin'] = 6;
      globals['usertypeid']['editor'] = 2;


      api['artists'] = base_url+"/api/artists";
      api['tracks'] = base_url+"/api/tracks";
      api['contactmsg'] = base_url+"/api/contactmsg";
      api['genres'] = base_url+"/api/genres";
      api['ourservices'] = base_url+"/api/ourservices";
      api['processmodules'] = base_url+"/api/processmodules";
      api['scopes'] = base_url+"/api/scopes";
      api['sections'] = base_url+"/api/sections";
      api['socialmidias'] = base_url+"/api/socialmidias";
      api['pages'] = base_url+"/api/pages";
      api['users'] = base_url+"/api/users";
      api['usertypes'] = base_url+"/api/usertypes";
      api['mail'] = base_url+"/api/mail";
      api['chatmessages'] = base_url+"/api/chatmessages";
      api['calendar'] = base_url+"/api/calendar";
      api['chatusershasnewmessages'] = base_url+"/api/chatusershasnewmessages";
      

      if(page=="manager-processmodules"){
        admin_manager_service = "processmodules";
      }else if(page=="manager-ourservices"){
        admin_manager_service = "ourservices";
      }else if(page=="manager-scopes"){
        admin_manager_service = "scopes";
      }else if(page=="manager-artists"){
        admin_manager_service = "artists";
      }else if(page=="manager-tracks"){
        admin_manager_service = "tracks";
      }else if(page=="manager-genres"){
        admin_manager_service = "genres";
      }else if(page=="manager-pages"){
        admin_manager_service = "pages";
      }else if(page=="manager-sections"){
        admin_manager_service = "sections";
      }else if(page=="manager-users"){
        admin_manager_service = "users";
      }else if(page=="manager-usertypes"){
        admin_manager_service = "usertypes";
      }
    }

    initGetVariables();
    initCrudButtons();
    initCrudButtonsActions();
    initDataTable();
    initWysiEditors();
    initSelects2();
    
</script>

<script>
  function readMail(id){
    // if(!this.hasAttribute("disabled")){
        $id = id;
        $("#overlay").show();
        setTimeout(function(){
            var contentUrl = admin_base_url+"/mailbox/read/"+$id;
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {},
                success: function(data){
                    $("#dynamic-content-container").html(data);
                    
                    $("#overlay").hide();
                    
                }
            });

        },500);
    // }
  }

  function openInbox(){
    // if(!this.hasAttribute("disabled")){
        $("#overlay").show();
        setTimeout(function(){
            var contentUrl = admin_base_url+"/mailbox/ajax";
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {},
                success: function(data){
                    $("#dynamic-content-container").html(data);
                    
                    $("#overlay").hide();
                    
                }
            });

        },500);
    // }
  }

  function openOutbox(){
    // if(!this.hasAttribute("disabled")){
        $("#overlay").show();
        setTimeout(function(){
            var contentUrl = admin_base_url+"/mailbox/outbox";
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {},
                success: function(data){
                    $("#dynamic-content-container").html(data);
                    $("#overlay").hide();
                    
                }
            });

        },500);
    // }
  }

  function openCompose(){
    // if(!this.hasAttribute("disabled")){
        $("#overlay").show();
        setTimeout(function(){
            var contentUrl = admin_base_url+"/mailbox/compose";
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {},
                success: function(data){
                    $("#dynamic-content-container").html(data);
                    initWysiEditors();
                    initSelects2();
                    $("#overlay").hide();
                    
                }
            });

        },500);
    // }
  }

  function sendMessage(){
    var form = $("#dataform");
    var url = form.attr('action');
    // if(!this.hasAttribute("disabled")){
        $("#overlay").show();
        setTimeout(function(){
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data){
                  if(data == 1){
                    openInbox();
                    $("#overlay").hide(); 
                  }
                    // $("#dynamic-content-container").html(data);
                    // initWysiEditors();
                    // initSelects2();
                    
                    
                }
            });

        },500);
    // }
  }
</script>
