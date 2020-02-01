initCrudButtonsActions = function(){
    $('#btn-new').click(function(e){
        if(!this.hasAttribute("disabled")){
            $("#grid-overlay").show();
            setTimeout(function(){
                var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/new";
                $.ajax({
                    type: "POST",
                    url: contentUrl,
                    data: {},
                    success: function(data){
                        $("#dynamic-content-container").html(data);
                        initGetVariables();
                        initCrudButtons();
                        initCrudButtonsActions();
                        initDataTable();
                        initWysiEditors();
                        initSelects2();
                        
                        $("#grid-overlay").hide();
                        
                    }
                });

            },1000);
        }
        
    });

    

    $('#btn-edit').click(function(e){
        if(!this.hasAttribute("disabled")){
            $id = $("#gridData>tbody>tr[data-selected=1]").attr("data-id");
            $("#grid-overlay").show();
            setTimeout(function(){
                var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/edit/"+$id;
                $.ajax({
                    type: "POST",
                    url: contentUrl,
                    data: {},
                    success: function(data){
                        $("#dynamic-content-container").html(data);
                        initGetVariables();
                        initCrudButtons();
                        initCrudButtonsActions();
                        initDataTable();
                        initWysiEditors();
                        initSelects2();
                        initDragbbleSectionsBoxes();
                        
                        $("#grid-overlay").hide();
                        
                    }
                });

            },500);
        }
        
    });
    $('#btn-del').click(function(e){
        if(!this.hasAttribute("disabled")){
            $("#grid-overlay").show();
            $("#modal-danger-del").modal();
        }
        
    });
    $('#btn-del-modal-cancel').click(function(e){
        $("#grid-overlay").hide();

        $("#modal-danger-del").modal('hide');
    })


    $('#btn-del-modal-confirm').click(function(e){
        $("#modal-danger-del").modal("hide");
        $ids = []
        $itens = $("#gridData>tbody>tr[data-selected=1]");
        $itens.each(function(index, el) {
            $ids.push(this.attributes["data-id"].value)
        });
        $.ajax({
            type: "POST",
            url: $("#gridData").attr("url-api")+"delete/",
            data: { ids: $ids},
            success: function(data){
                if(data == 1){
                    setTimeout(function(){
                        var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/ajax";
                        $.ajax({
                            type: "POST",
                            url: contentUrl,
                            data: {},
                            success: function(data){
                                $("#dynamic-content-container").html(data);
                                initGetVariables();
                                initCrudButtons();
                                initCrudButtonsActions();
                                initDataTable();
                                initWysiEditors();
                                initSelects2();
                                
                                $("#grid-overlay").hide();
                                $("#callout-sucess h4").text("Sucesso");
                                $("#callout-sucess p").text("Registro excluido com sucesso");
                                $("#callout-sucess").slideDown(500);
                                setTimeout(function(){
                                    $("#callout-sucess").slideUp(500);
                                },3000);
                                
                                
                            }
                        });

                    },1000);
                }else{
                    setTimeout(function(){
                        var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/ajax";
                        $.ajax({
                            type: "POST",
                            url: contentUrl,
                            data: {},
                            success: function(data){
                                $("#dynamic-content-container").html(data);
                                initGetVariables();
                                initCrudButtons();
                                initCrudButtonsActions();
                                initDataTable();
                                initWysiEditors();
                                initSelects2();
                                
                                $("#grid-overlay").hide();
                                $("#callout-error h4").text("Falha");
                                $("#callout-error p").text("Erro ao excluir registro.");
                                $("#callout-error").slideDown(500);
                                setTimeout(function(){
                                    $("#callout-error").slideUp(500);
                                },3000);
                                
                                
                            }
                        });

                    },1000);
                }
                
            }
                
        });
    });

    $('#btn-save').click(function(e){
        $("#grid-overlay").show()
        var form = $("#dataform");
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data){
                if(data == 1){
                    setTimeout(function(){
                        var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/ajax";
                        $.ajax({
                            type: "POST",
                            url: contentUrl,
                            data: {},
                            success: function(data){
                                $("#dynamic-content-container").html(data);
                                initGetVariables();
                                initCrudButtons();
                                initCrudButtonsActions();
                                initDataTable();
                                initWysiEditors();
                                initSelects2();
                                
                                $("#grid-overlay").hide();
                                $("#callout-sucess h4").text("Sucesso");
                                $("#callout-sucess p").text("Registro adicionado ou atualizado com sucesso");
                                $("#callout-sucess").slideDown(500);
                                setTimeout(function(){
                                    $("#callout-sucess").slideUp(500);
                                },3000);
                                
                                
                            }
                        });

                    },1000);
                }else{
                    setTimeout(function(){
                        var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/ajax";
                        $.ajax({
                            type: "POST",
                            url: contentUrl,
                            data: {},
                            success: function(data){
                                $("#dynamic-content-container").html(data);
                                initGetVariables();
                                initCrudButtons();
                                initCrudButtonsActions();
                                initDataTable();
                                initWysiEditors();
                                initSelects2();
                                
                                $("#grid-overlay").hide();
                                $("#callout-error h4").text("Falha");
                                $("#callout-error p").text("Erro ao inserir/atualizar registro.");
                                $("#callout-error").slideDown(500);
                                setTimeout(function(){
                                    $("#callout-error").slideUp(500);
                                },3000);
                                
                                
                            }
                        });

                    },1000);
                }
                
            }
        });   
        
    });
    $('#btn-cancel').click(function(e){
        $("#grid-overlay").show()
        setTimeout(function(){
            var contentUrl = admin_base_url+"/manager/"+admin_manager_service+"/ajax";
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {},
                success: function(data){
                    $("#dynamic-content-container").html(data);
                    initGetVariables();
                    initCrudButtons();
                    initCrudButtonsActions();
                    initDataTable();
                    initWysiEditors();
                    initSelects2();
                    
                    $("#grid-overlay").hide();
                    
                }
            });

        },500);
    });

    onStopDragbble = function(e){
        fillHiddenFieldOfSectionsOrder();
    }

    // MANAGER PAGES SECTIONS ORGANIZE
    function initDragbbleSectionsBoxes(){
        $('#dragbble-pages-sections').sortable({
          placeholder         : 'sort-highlight',
          handle              : '.boxes',
          forcePlaceholderSize: true,
          zIndex              : 999999,
          stop                : onStopDragbble
        });
      }

    fillHiddenFieldOfSectionsOrder = function(){
        var listSection = $('#dragbble-pages-sections').children('li');
        var parsedList = [];
        for (var i = 0; i < listSection.length; i++) {
            parsedList.push((listSection[i]).dataset["id"]);
        }
        $("#hidden-selected-section-id").val(parsedList);

    }

    changeSelectNewSections = function(){
        $("#btn-add-new-section").attr('disabled', false).removeClass('disabled');
    }

    initBtnRemoveSection = function(){
        $('.btn-remove-section').click(function(elem) {
            $(elem.target).parent().parent().parent().remove();
            fillHiddenFieldOfSectionsOrder();
        });   
        
    }
    
    $('#btn-add-new-section').click(function(){
        var selectedNewSectionKey = $("#selected-new-section").val();
        var elem = $("#selected-new-section").children('option:nth-child('+selectedNewSectionKey+')');
        var selectedNewSectionId = elem.attr('data-id');
        var selectedNewSectionName = elem.text();
        var htmlElement = '<li data-id="'+selectedNewSectionId+'"><div style="background-color:#7FDEDE" class="boxes boxes-new"><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span> '+ selectedNewSectionName + '<div class="tools"><i class="btn-remove-section fa fa-trash-o"></i></div></div></li>';

        if($("#blank-box-section")){
            $("#blank-box-section").remove();
            $("#dragbble-pages-sections")
            .append(htmlElement)
        }else{
            $("#dragbble-pages-sections")
            .append(htmlElement)
           
        } 
        fillHiddenFieldOfSectionsOrder();
        initBtnRemoveSection();   
    });
    initBtnRemoveSection();
    fillHiddenFieldOfSectionsOrder();
}