$(function(){
	$('#chat-submit').click('submit', function(e){
		if(!$('#chat-submit').hasClass('disabled')){
			var form = $("#dataform");
			var contentUrl = api['chatmessages']+'/send';
			var message = $("#message").val();

			if(message.length > 0){
				$.ajax({
					type: 'POST',
					url: contentUrl,
					data: form.serialize(),
					success: function(data){
						send(data);
						$('#message').val('').focus();
					}

				});
			}
		}
		return false;
	});
	$('#btnchatcollapse').on('click', function(e){
		if($('#btnchatcollapse i').hasClass('fa-minus')){
			var updateChatStatesUrl = admin_base_url+'/blocks/chat/updatechatstates.php?opened=0';
			$.ajax({
				type: 'GET',
				url: updateChatStatesUrl,
				success: function(data){
					$('#btnchatcollapse i').removeClass('fa-minus');
					$('#btnchatcollapse i').addClass('fa-plus');
				}
			});
		}else if($('#btnchatcollapse i').hasClass('fa-plus')){
			var updateChatStatesUrl = admin_base_url+'/blocks/chat/updatechatstates.php?opened=1';
			$.ajax({
				type: 'GET',
				url: updateChatStatesUrl,
				success: function(data){
					$('#btnchatcollapse i').removeClass('fa-plus');
					$('#btnchatcollapse i').addClass('fa-minus');
				}
			});
		}
	});
	id = $("#hidden_target_id").val();	
	name = $("#chatname").text();
	if(id && name){
		changeTargetChat(id, name);
	}

	
	
});

changeTargetChat = function(id, name){
	$("#hidden_target_id").val(id);	
	$("#chatname").text(name);	
	$("#containerMessages").text("");
	var loggedUserId = globals['logged-user']['id'];

	var contentUrl = api['users']+'/'+id;
	$.ajax({
		type: 'POST',
		url: contentUrl,
		success: function(data2){
			user = data2;
			var fullName = user.name+' '+user.lastname;
			var updateChatStatesUrl = admin_base_url+'/blocks/chat/updatechatstates.php?targetid='+id+'&targetfullname='+fullName;
			$.ajax({
				type: 'GET',
				url: updateChatStatesUrl,
				success: function(data){

				}
			});
			var contentUrl = api['chatmessages']+'/conversation/'+globals['logged-user']['id']+'/'+id;
			$.ajax({
				type: 'POST',
				url: contentUrl,
				data: {},
				success: function(data){
					for (var i = 0; i <= data.length - 1; i++) {
						var dateTime = timeConverter(data[i]['date'])
						formatedDate = new Date(dateTime['year'], dateTime['month']-1, dateTime['day'], dateTime['hour']-3, dateTime['min'], dateTime['sec']).toLocaleString();
						if(loggedUserId == data[i]['creatoruserid']){
							loggedFullName = globals['logged-user']['name']+" "+globals['logged-user']['lastname'];
							$('#containerMessages').append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+loggedFullName+'</span><span class="direct-chat-timestamp pull-left">'+formatedDate+'</span></div><img class="direct-chat-img" src="'+admin_base_url+'/img/users/'+ globals['logged-user']['picture']+'"  alt="Message User Image"><div class="direct-chat-text" style="overflow-wrap: break-word;">'+decodeURIComponent(escape(data[i]['msg']))+'</div></div>');
							
						}else{
							$('#containerMessages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+decodeURIComponent(escape(fullName))+'</span><span class="direct-chat-timestamp pull-right">'+formatedDate+'</span></div><img class="direct-chat-img" src="'+admin_base_url+'/img/users/'+user.picture+'" alt="Message User Image"><div class="direct-chat-text" style="overflow-wrap: break-word;">'+decodeURIComponent(escape(data[i]['msg']))+'</div></div>');
						}
					}
					var height = $('#containerMessages').prop('scrollHeight');
					$('#containerMessages').animate({scrollTop: height}, 600);	
					$('#chat-submit').removeClass('disabled');		
					$('#containerMessages').css('background-color', '');
					$('#chat-container').removeClass('direct-chat-contacts-open');	

					$.ajax({
						type: 'POST',
						url: api['chatusershasnewmessages']+'/deletetargetandcreator/'+globals['logged-user']['id']+'/'+id,
						data: {},
						success: function(data){
							$.ajax({
								type: 'POST',
								url: api['chatusershasnewmessages']+'/target/'+globals['logged-user']['id'],
								data: {},
								success: function(data){
									if(data.length == 0){
										$("#chat-container #btnopencontactlist").pulse('destroy');
										$("#chat-container #btnopencontactlist").css('color', '');
										$("#chat-container #btnopencontactlist").css('color', '#97a0b3');
									}
								}
							});
							$(".contactsusers[data-id='"+id+"']").css('border-left', '').css('background-color', '');
						}
					});
				}
			});	
		}
	});
}

