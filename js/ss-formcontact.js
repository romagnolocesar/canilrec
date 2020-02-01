$("#contactformforvisitors").submit(function(e) {
		e.preventDefault();

		//Show the Overlay
		$("#ss-formcontato #subLayerForm").css("display", "inline");

		var form = $(this);
		var url = form.attr('action');


		setTimeout(function() {
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(),
				success: function(data){
					if(data){
						$("#ss-formcontato #subLayerForm").fadeOut(1000);
						$("#ss-formcontato form").slideUp(1000);
						setTimeout(function(){
							$("#ss-formcontato #alertsuccess").fadeIn(500);
						}, 500);
						
					}else if(data == "false"){
						$("#ss-formcontato #subLayerForm").fadeOut(1000);
						$("#ss-formcontato form").slideUp(1000);
						setTimeout(function(){
							$("#ss-formcontato #alerterror").fadeIn(500);
						}, 500);
						
					}
					
				}
			});   
        }, 4000);
		

		
	});