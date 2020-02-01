initCrudButtons = function(){
    $qtdSelectedItens = 0;
    $('#gridData>tbody>tr').click(function(e){
        if($(this).attr("data-selected") == 1){
            $(this).css("background-color", "");
            $(this).attr("data-selected", 0);
            $qtdSelectedItens--;
        }else{
            $(this).css("background-color", "#ecf0f5");
            $(this).attr("data-selected", 1);   
            $qtdSelectedItens++;  
        }    

        if($qtdSelectedItens == 0){
            $("#btn-new").attr('disabled', false);
            $("#btn-edit").attr('disabled', true);
            $("#btn-del").attr('disabled', true);
        }else if($qtdSelectedItens == 1){
            $("#btn-new").attr('disabled', true);
            $("#btn-edit").attr('disabled', false);
            $("#btn-del").attr('disabled', false);
        }else if($qtdSelectedItens >= 2){
            $("#btn-new").attr('disabled', true);
            $("#btn-edit").attr('disabled', true);
            $("#btn-del").attr('disabled', false);
        }    
    });
}
