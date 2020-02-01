        <?php
            include "../config/globals.php";

            function getHeaderContentWrapper(){
              echo "<div class='content-wrapper'><section class='content-header'><h1>Gerenciador<small>Tipos de Usuários</small></h1>";
              ?>
              <ol class="breadcrumb">
                <li><a href="<?php echo $GLOBALS['admin_base_url']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Genrenciador de Tipos de Usuários</li>
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

                <div class="box" id="usertypes-manager-grid hidden">
                    <div class="box-header">
                      <h3 class="box-title">Relação de Tipos Usuários</h3>
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
                        $json_string = $GLOBALS['api']['usertypes'];
                        $jsondata = file_get_contents($json_string);
                        $usertypesItens = json_decode($jsondata, TRUE);
                        echo "<table id='gridData' class='table table-bordered table-hover' url-api='".$GLOBALS['api']['usertypes']."/"."'>";
                        echo "  <thead>";
                        echo "    <tr>";
                                    echo "<td>Tipo</td>";
                                    echo "<td>Descrição</td>";
                                    echo "<td>Status</td>";
                        echo "    </tr>";
                        echo "  </thead>";
                        echo "  <tbody>";
                                    foreach ($usertypesItens as $item) {
                                      echo "  <tr data-id='".$item['id']."'>";
                                        echo "  <td>".utf8_decode($item['type'])."</td>";
                                        echo "  <td>".utf8_decode($item['description'])."</td>";
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
                                    echo "<td>Tipo</td>";
                                    echo "<td>Descrição</td>";
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
                    $json_string = $GLOBALS['api']['usertypes']."/".$_GET['id'];
                    $jsondata = file_get_contents($json_string);
                    $usertypesItem = json_decode($jsondata, TRUE);
                    getHeaderContentWrapper();
            ?>
                <section class="content container-fluid">  
                <div class="box box-warning" id="usertypes-manager-grid">
                    <div class="box-header">
                      <h3 class="box-title">Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["usertypes"]."/update/".$_GET['id']; ?>'>
                            <!-- text input -->
                            <div class="form-group">
                              <label>Tipo</label>
                              <input name="dataform[type]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($usertypesItem['type']); ?>">
                            </div>
                            <div class="form-group">
                                  <label>Descrição</label>
                                  <textarea id="wysieditor" name="dataform[description]" class="form-control" rows="3"><?php echo utf8_decode($usertypesItem['description']); ?></textarea> 
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[status]" type="checkbox" <?php if($usertypesItem['status']){echo 'checked';}?>>Ativo
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
                <div class="box box-warning" id="usertypes-manager-grid">
                        <div class="box-header">
                          <h3 class="box-title">Novo</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["usertypes"]."/new/"?>'>
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Tipo</label>
                                  <input name="dataform[type]" type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                      <label>Descrição</label>
                                      <textarea id="wysieditor" name="dataform[description]" class="form-control" rows="3"></textarea> 
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