        <?php
            include "../config/globals.php";

            function getHeaderContentWrapper(){
              echo "<div class='content-wrapper'><section class='content-header'><h1>Gerenciador<small>Seções</small></h1>";
              ?>
              <ol class="breadcrumb">
                <li><a href="<?php echo $GLOBALS['admin_base_url']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Genrenciador de Seções</li>
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

                <div class="box" id="sections-manager-grid hidden">
                    <div class="box-header">
                      <h3 class="box-title">Relação de Seções</h3>
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
                        $json_string = $GLOBALS['api']['sections'];
                        $jsondata = file_get_contents($json_string);
                        $sectionsItens = json_decode($jsondata, TRUE);
                        echo "<table id='gridData' class='table table-bordered table-hover' url-api='".$GLOBALS['api']['sections']."/"."'>";
                        echo "  <thead>";
                        echo "    <tr>";
                                    echo "<td>Titulo1</td>";
                                    echo "<td>Titulo2</td>";
                                    echo "<td>Arquivo</td>";
                                    echo "<td>Status</td>";
                        echo "    </tr>";
                        echo "  </thead>";
                        echo "  <tbody>";
                                    foreach ($sectionsItens as $item) {
                                      echo "  <tr data-id='".$item['id']."'>";
                                        echo "  <td>".utf8_decode($item['title1'])."</td>";
                                        echo "  <td>".utf8_decode($item['title2'])."</td>";
                                        echo "  <td>".utf8_decode($item['filename'])."</td>";
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
                                    echo "<td>Titulo1</td>";
                                    echo "<td>Titulo2</td>";
                                    echo "<td>Arquivo</td>";
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
                    $json_string = $GLOBALS['api']['sections']."/".$_GET['id'];
                    $jsondata = file_get_contents($json_string);
                    $sectionsItem = json_decode($jsondata, TRUE);
                    getHeaderContentWrapper();
            ?>
                <section class="content container-fluid">  
                <div class="box box-warning" id="sections-manager-grid">
                    <div class="box-header">
                      <h3 class="box-title">Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["sections"]."/update/".$_GET['id']; ?>'>
                            <!-- text input -->
                            <div class="form-group">
                              <label>Titulo 1</label>
                              <input name="dataform[title1]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($sectionsItem['title1']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Titulo 2</label>
                              <input name="dataform[title2]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($sectionsItem['title2']); ?>">
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[showtitles]" type="checkbox" <?php if($sectionsItem['showtitles']){echo 'checked';}?>>Mostrar Titulos?
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                                  <label>Descrição</label>
                                  <textarea name="dataform[description]" class="form-control" rows="3"><?php echo utf8_decode($sectionsItem['description']); ?></textarea> 
                            </div>
                            <div class="form-group">
                              <label>Arquivo PHP</label>
                              <input name="dataform[filename]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($sectionsItem['filename']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Arquivo CSS</label>
                              <input name="dataform[cssfile]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($sectionsItem['cssfile']); ?>">
                            </div>
                            <div class="form-group">
                              <label>CSS ID</label>
                              <input name="dataform[cssid]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($sectionsItem['cssid']); ?>">
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[hasshape]" type="checkbox" <?php if($sectionsItem['hasshape']){echo 'checked';}?>>Possui Divisor (shape)
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Icone do Divisor</label>
                              <input name="dataform[shapeicon]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($sectionsItem['shapeicon']); ?>">
                            </div>
                            <div class="form-group">
                                  <label>HTML</label>
                                  <textarea id="wysieditor" name="dataform[fullhtml]" class="form-control" rows="3"><?php echo utf8_decode($sectionsItem['fullhtml']); ?></textarea> 
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[status]" type="checkbox" <?php if($sectionsItem['status']){echo 'checked';}?>>Ativo
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
                }else if($route == 'new'){
                  getHeaderContentWrapper();
            ?>
                <section class="content container-fluid">  
                <div class="box box-warning" id="sections-manager-grid">
                        <div class="box-header">
                          <h3 class="box-title">Novo</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["sections"]."/new/"?>'>
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Titulo 1</label>
                                  <input name="dataform[title1]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>Titulo 2</label>
                                  <input name="dataform[title2]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input name="dataform[showtitles]" type="checkbox">Mostrar Titulos?
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                      <label>Descrição</label>
                                      <textarea name="dataform[description]" class="form-control" rows="3"></textarea> 
                                </div>
                                <div class="form-group">
                                  <label>Arquivo PHP</label>
                                  <input name="dataform[filename]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>Arquivo CSS</label>
                                  <input name="dataform[cssfile]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>CSS ID</label>
                                  <input name="dataform[cssid]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input name="dataform[hasshape]" type="checkbox">Possui Divisor (shape)
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Icone do Divisor</label>
                                  <input name="dataform[shapeicon]" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                      <label>HTML</label>
                                      <textarea id="wysieditor" name="dataform[fullhtml]" class="form-control" rows="3"></textarea> 
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