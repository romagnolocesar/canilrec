function checkOnlineUsers(){
	$.ajax({
		url: api['users']+"/logged",
		type: 'POST',
		data: {},
		success: function(data) {
			loggedUsers =[]
			for (var i = data.length - 1; i >= 0; i--) {
				loggedUsers.push(data[i].id);
			}
			console.log(loggedUsers);
			$(".contacts-list li img").css('border', '0.2rem solid #656565')
			$(".contacts-list li").each(function(index, el) {
				for (var i = loggedUsers.length - 1; i >= 0; i--) {
					if($(el).attr('data-id') == loggedUsers[i]){
						$(".contacts-list li[data-id='"+loggedUsers[i]+"'] img").css('border', '0.2rem solid #00a65a');
					}
				}
			});
		}
	});
}

$(function(){
	setInterval(function() {
		checkOnlineUsers();	
	}, 30000);
});