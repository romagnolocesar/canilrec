$(".artists-box").click(function(){
    $description = this.children["full-description"].innerText;
    if($("#artists-details").is(':hidden')){
        //closed
        $("#ss-artists #details-box").text($description);
        $("#artists-details").slideDown('200', function() {

        });
    }else{
        //opened 
        $("#artists-details").slideUp('400', function() {
            setTimeout(function() {
               $("#ss-artists #details-box").text($description);  
               $("#artists-details").slideDown('200'); 
            }, 300);
            
            
        });
    }
});

$("#artists-details").click(function(){
    $("#artists-details").slideUp('200');
});
