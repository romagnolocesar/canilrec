var Server;

$(document).ready(function(){
	Server = new FancyWebSocket('ws://'+urlPort+'/?userid='+globals['logged-user']['id']);
	webSockets = {}


    Server.bind('open', function(id)
	{
    });
    Server.bind('close', function( data ) 
	{
    });
    Server.bind('message', function( payload ) 
	{
    });

    Server.connect();
});

function send(text){
    Server.send('message', text);
}

var FancyWebSocket = function(url){
	var callbacks = {};
	var ws_url = url;
	var conn;
	
	this.bind = function(event_name, callback){
		callbacks[event_name] = callbacks[event_name] || [];
		callbacks[event_name].push(callback);
		return this;
	};
	
	this.send = function(event_name, event_data){
		this.conn.send( event_data );
		return this;
	};
	
	this.connect = function() {

		if ( typeof(MozWebSocket) == 'function' )
		this.conn = new MozWebSocket(url);
		else
		this.conn = new WebSocket(url);
		
		this.conn.onmessage = function(evt)
		{
			dispatch('message', evt.data);
		};
		
		this.conn.onclose = function(){dispatch('close',null)}
		this.conn.onopen = function(id){
			checkOnlineUsers();
			dispatch('open',null)
			webSockets[id] = this.conn;
		}
	};

	
	this.disconnect = function(){
		this.conn.close();
	};
	
	var dispatch = function(event_name, message){
		var loggedUserId = globals['logged-user']['id'];
		var creatorUser;
		var targetUser;

		if(message != null && message != ""){
			var msgData = JSON.parse(message);
			var contentUrl = api['users']+'/'+msgData['creatoruserid'];
			var creatorUserId = msgData['creatoruserid'];
			var targetUserId = msgData['targetuserid'];

			var dateTime = timeConverter(msgData['date'])
			var formatedDate = new Date(dateTime['year'], dateTime['month']-1, dateTime['day'], dateTime['hour']-3, dateTime['min'], dateTime['sec']).toLocaleString();

			if(targetUserId == globals['logged-user']['id'] && $("#hidden_target_id").val() != creatorUserId){//Show notification if the user is the target
				$(".contactsusers[data-id='"+creatorUserId+"']").css('border-left', '0.5rem solid #00C0EF').css('background-color', '#2c3d44');
				$("#chat-container #btnopencontactlist").attr('data-alert', 'true');
				$(".contactsusers[data-id='"+creatorUserId+"'] .contacts-list-msg").text(decodeURIComponent(escape(msgData['msg'])));
				$(".contactsusers[data-id='"+creatorUserId+"'] .contacts-list-date").text(formatedDate);

				//Fill PHP Sections with states params
				$.ajax({
					type: 'POST',
					url: api['chatusershasnewmessages']+"/new",
					data: {
						'idcreator'	: creatorUserId,
						'idtarget'	: targetUserId,
					},
					success: function(data){
						
					}
				});

				if($("#chat-container #btnopencontactlist").css('color') == 'rgb(221, 75, 57)'){
					$("#chat-container #btnopencontactlist").pulse({'color': '#97a0b3'}, {duration : 1000, pulses : 8}, function(){
						$("#chat-container #btnopencontactlist").css('color', '#DD4B39');	
					});
				}else if($("#chat-container #btnopencontactlist").css('color') == 'rgb(151, 160, 179)'){
					$("#chat-container #btnopencontactlist").pulse({'color': '#DD4B39'}, {duration : 1000, pulses : 8}, function(){
						$("#chat-container #btnopencontactlist").css('color', '#DD4B39');
					});
				}
			}

			if(creatorUserId == globals['logged-user']['id'] || (creatorUserId == $("#hidden_target_id").val() && targetUserId == globals['logged-user']['id'])){
				$.ajax({
					type: 'POST',
					url: contentUrl,
					success: function(data){
						creatorUser = data;
						contentUrl = api['users']+'/'+msgData['targetuserid'];
						$.ajax({
							type: 'POST',
							url: contentUrl,
							success: function(data){
								targetUser = data;
								var fullNameCreator = decodeURIComponent(escape(creatorUser.name))+' '+decodeURIComponent(escape(creatorUser.lastname));
								var creatorUserId =  creatorUser.id;
								var fullNameTarget = decodeURIComponent(escape(targetUser.name))+' '+decodeURIComponent(escape(targetUser.lastname));
								var targetUserId =  targetUser.id;
								

								var fullMsg = decodeURIComponent(escape(msgData['msg']));

								
								
								if(loggedUserId == creatorUserId){
									$('#containerMessages').append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+fullNameCreator+'</span><span class="direct-chat-timestamp pull-left">'+formatedDate+'</span></div><img class="direct-chat-img" src="'+admin_base_url+'/img/users/'+ globals['logged-user']['picture']+'"  alt="Message User Image"><div class="direct-chat-text" style="overflow-wrap: break-word;">'+fullMsg+'</div></div>');
									
								}else{
									$('#containerMessages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+fullNameCreator+'</span><span class="direct-chat-timestamp pull-right">'+formatedDate+'</span></div><img class="direct-chat-img" src="'+admin_base_url+'/img/users/'+creatorUser.picture+'" alt="Message User Image"><div class="direct-chat-text" style="overflow-wrap: break-word;">'+fullMsg+'</div></div>');

								}
								var height = $('#containerMessages').prop('scrollHeight');
								$('#containerMessages').animate({scrollTop: height}, 600);
							}

						});
				
					}

				});	
			}
			
			
			
		}
		
	}
};
