        <?php
            include "../config/globals.php";

            function getHeaderContentWrapper(){
              echo "<div class='content-wrapper'><section class='content-header'><h1>Gerenciador<small>Páginas</small></h1>";
              ?>
              <ol class="breadcrumb">
                <li><a href="<?php echo $GLOBALS['admin_base_url']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Genrenciador de Páginas</li>
              </ol>
              <?php
              echo "</section>";
            }

            if($route == 'grid'){
              getHeaderContentWrapper();
        ?>
                <section class="content container-fluid">  
                  <!-- AVISO MODAL -->
                  <div class="modal modal-danger fade" id="modal-danger-del">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Aviso</h4>
                        </div>
                        <div class="modal-body">
                          <p>Excluir registros selecionados?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="btn-del-modal-cancel" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-outline" id="btn-del-modal-confirm">Excluir</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                <div class="box" id="pages-manager-grid hidden">
                    <div class="box-header">
                      <h3 class="box-title">Relação de Páginas</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="box box-info">
                            <div class="box-body">
                                <a class="btn btn-app" id="btn-new">
                                    <i class="fa fa-asterisk"></i> Novo
                                </a>
                                <a class="btn btn-app" disabled id="btn-edit">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <a class="btn btn-app" disabled id="btn-del">
                                    <i class="fa fa-trash"></i> Deletar
                                </a>
                            </div>
                        </div>
                        <!-- CALLOUTS -->
                        <div class="callout callout-success" id="callout-sucess" style="display: none">
                          <h4></h4>

                          <p></p>
                        </div>

                        <div class="callout callout-danger" id="callout-error" style="display: none">
                          <h4></h4>

                          <p></p>
                        </div>

                      <?php
                        $json_string = $GLOBALS['api']['pages'];
                        $jsondata = file_get_contents($json_string);
                        $pagesItens = json_decode($jsondata, TRUE);
                        echo "<table id='gridData' class='table table-bordered table-hover' url-api='".$GLOBALS['api']['pages']."/"."'>";
                        echo "  <thead>";
                        echo "    <tr>";
                                    echo "<td>Titulo</td>";
                                    echo "<td>Status</td>";
                        echo "    </tr>";
                        echo "  </thead>";
                        echo "  <tbody>";
                                    foreach ($pagesItens as $item) {
                                      echo "  <tr data-id='".$item['id']."'>";
                                        echo "  <td>".utf8_decode($item['title'])."</td>";
                                        echo "  <td>";
                                            if($item['status'] == 1){
                                                echo '<i class="text-green fa fa-fw fa-check-circle"></i>';
                                            }if($item['status'] == 0){
                                                echo '<i class="text-red fa fa-fw fa-circle"></i>';
                                            }
                                        echo "</td>";
                                      echo "  </tr>    ";     
                                    }
                        echo "  </tbody>";
                        echo "  <tfoot>";
                        echo "    <tr>";
                                    echo "<td>Titulo</td>";
                                    echo "<td>Status</td>";
                        echo "    </tr>";
                        echo "  </tfoot>";
                        echo "</table>";
                        
                      ?>

                    </div>
                    <div id="grid-overlay" class="overlay" style="display: none">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <!-- /.box-body -->
                </div>
            <?php
                }else if($route == 'edit'){
                    $json_string = $GLOBALS['api']['pages']."/".$_GET['id'];
                    $jsondata = file_get_contents($json_string);
                    $pagesItem = json_decode($jsondata, TRUE);

                    $json_string = $GLOBALS['api']['pages']."/".$_GET['id']."/sections";
                    $jsondata = file_get_contents($json_string);
                    $sectionsItens = json_decode($jsondata, TRUE);

                    $json_string = $GLOBALS['api']['sections'];
                    $jsondata = file_get_contents($json_string);
                    $allSectionsItens = json_decode($jsondata, TRUE);

                    getHeaderContentWrapper();

            ?>
                <section class="content container-fluid">  
                <div class="box box-info" id="our-services-manager-grid">
                    <div class="box-header">
                      <h3 class="box-title">Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["pages"]."/update/".$_GET['id']; ?>'>
                            <!-- text input -->
                            <div class="form-group">
                              <label>Titulo</label>
                              <input name="dataform[title]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($pagesItem['title']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Link</label>
                              <input name="dataform[link]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($pagesItem['link']); ?>">
                            </div>
                            
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[status]" type="checkbox" <?php if($pagesItem['status']){echo 'checked';}?>>Ativo
                                </label>
                              </div>
                            </div>
                            <div>
                              <div class="box box-primary" id="box-organize-sections">
                                <div class="row">
                                  <div class="col col-lg-6 col-md-6 col-sm-12">
                                    <h4>Organizar Posições das Seções</h4>
                                    <ul id="dragbble-pages-sections">
                                    <?php
                                    if($sectionsItens){
                                      foreach ($sectionsItens as $key => $value) {
                                        echo "<li data-id='".$value['id']."'>";
                                        echo "<div class='boxes'>";
                                        ?>
                                        <!-- drag handle -->
                                        <span class="handle">
                                          <i class="fa fa-ellipsis-v"></i>
                                          <i class="fa fa-ellipsis-v">  </i>
                                        </span>
                                        <?php
                                        echo utf8_decode($value['title1']);
                                        echo " ";
                                        echo utf8_decode($value['title2']);
                                        ?>
                                        <div class="tools">
                                          <i class="btn-remove-section fa fa-trash-o"></i>
                                        </div>
                                        <?php
                                        echo "</div>";
                                        echo "</li>";
                                      }
                                    }else{
                                      echo "<li id='blank-box-section'>";
                                        echo "<div class='boxes'>";
                                        ?>
                                        <!-- drag handle -->
                                        <span class="handle">
                                          <i class="fa fa-ellipsis-v"></i>
                                          <i class="fa fa-ellipsis-v">  </i>
                                        </span>
                                        <?php
                                        echo "</div>";
                                        echo "</li>";
                                    }
                                    ?>
                                    </ul>
                                  </div>
                                  <div class="col col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <h4>Adicionar Seção</h4>
                                      <input type="hidden" id="hidden-selected-section-id" name="dataform[sections]">
                                      <select onchange="changeSelectNewSections()" id="selected-new-section" class="form-control" style="width: 100%;">
                                        <option value="" selected="selected" disabled="disabled">SELECIONE UMA SEÇÃO PARA ADICIONAR A PÁGINA</option>;
                                        <?php
                                        if($allSectionsItens){
                                            foreach ($allSectionsItens as $key => $item) {
                                              echo "<option ";
                                              echo "data-id='".$item['id']."' ";
                                              echo "value='".($key+2)."' ";
                                              echo ">";
                                              echo utf8_decode($item['title1'])." ".utf8_decode($item['title2']);
                                              echo "</option>";
                                            }
                                        }
                                        ?>
                                      </select>
                                      <div class="clearfix no-border">
                                        <button id="btn-add-new-section" type="button" class="btn btn-default pull-left disabled" disabled="disabled"><i class="fa fa-arrow-left"></i> Adicionar Seção</button>
                                      </div>
                                      </br>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                    </div>
                    <a class="btn btn-app" id="btn-save">
                        <i class="fa fa-save"></i> Salvar
                    </a>
                    <a class="btn btn-app" id="btn-cancel">
                        <i class="fa fa-ban"></i> Cancelar
                    </a>
                    <div id="grid-overlay" class="overlay" style="display: none">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                        
            <?php
                }else if($route == 'new'){
                  getHeaderContentWrapper();
            ?>
                <section class="content container-fluid">  
                <div class="box box-warning" id="pages-manager-grid">
                        <div class="box-header">
                          <h3 class="box-title">Novo</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["pages"]."/new/"?>'>
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Titulo</label>
                                  <input name="dataform[title]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>Link</label>
                                  <input name="dataform[link]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input name="dataform[status]" type="checkbox">Ativo
                                    </label>
                                  </div>
                                </div>
                              </form>
                        </div>
                        <a class="btn btn-app" id="btn-save">
                            <i class="fa fa-save"></i> Salvar
                        </a>
                        <a class="btn btn-app" id="btn-cancel">
                            <i class="fa fa-ban"></i> Cancelar
                        </a>
                        <div id="grid-overlay" class="overlay" style="display: none">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    </div>
            <?php

                }
            ?>

    </section>
</div>