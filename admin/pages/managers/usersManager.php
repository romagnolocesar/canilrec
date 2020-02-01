        <?php
            include "../config/globals.php";

            function getHeaderContentWrapper(){
              echo "<div class='content-wrapper'><section class='content-header'><h1>Gerenciador<small>Usuários</small></h1>";
              ?>
              <ol class="breadcrumb">
                <li><a href="<?php echo $GLOBALS['admin_base_url']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Genrenciador de Usuários</li>
              </ol>
              <?php
              echo "</section>";
            }

            $json_string = $GLOBALS['api']['usertypes'];
            $jsondata = file_get_contents($json_string);
            $usertypesItem = json_decode($jsondata, TRUE);

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

                <div class="box" id="users-manager-grid hidden">
                    <div class="box-header">
                      <h3 class="box-title">Relação de Usuários</h3>
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
                        $json_string = $GLOBALS['api']['users'];
                        $jsondata = file_get_contents($json_string);
                        $usersItens = json_decode($jsondata, TRUE);
                        echo "<table id='gridData' class='table table-bordered table-hover' url-api='".$GLOBALS['api']['users']."/"."'>";
                        echo "  <thead>";
                        echo "    <tr>";
                                    echo "<td>Nome</td>";
                                    echo "<td>Sobrenome</td>";
                                    echo "<td>Status</td>";
                        echo "    </tr>";
                        echo "  </thead>";
                        echo "  <tbody>";
                                    foreach ($usersItens as $item) {
                                      echo "  <tr data-id='".$item['id']."'>";
                                        echo "  <td>".utf8_decode($item['name'])."</td>";
                                        echo "  <td>".utf8_decode($item['lastname'])."</td>";
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
                                    echo "<td>Nome</td>";
                                    echo "<td>Sobrenome</td>";
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
                    $json_string = $GLOBALS['api']['users']."/".$_GET['id'];
                    $jsondata = file_get_contents($json_string);
                    $usersItem = json_decode($jsondata, TRUE);
                    getHeaderContentWrapper();
            ?>
                <section class="content container-fluid">  
                <div class="box box-warning" id="users-manager-grid">
                    <div class="box-header">
                      <h3 class="box-title">Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["users"]."/update/".$_GET['id']; ?>'>
                            <!-- text input -->
                            <div class="form-group">
                              <label>Nome</label>
                              <input name="dataform[name]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($usersItem['name']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Sobrenome</label>
                              <input name="dataform[lastname]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($usersItem['lastname']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input name="dataform[email]" type="email" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($usersItem['email']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Login</label>
                              <input name="dataform[login]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($usersItem['login']); ?>">
                            </div>
                            <div class="form-group">
                              <label>Senha</label>
                              <input name="dataform[password]" type="email" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($usersItem['password']); ?>">
                            </div>
                            <div class="form-group">
                              <label for="foto">Foto</label>
                              <div class="container">
                                <div class="row">
                                  <div class="col col-lg-3 col-md-3 col-sm-12">
                                    <img id="currentPicture" class="pad img-responsive img-circle"
                                    <?php
                                      echo "src='".$GLOBALS['admin_base_url']."/img/users/".utf8_decode($usersItem['picture'])."'"; 
                                    ?>
                                    alt="User profile picture">
                                    <img class="img-fluid"src='<?php echo $GLOBALS['base_url']."/";?>' id="cropbox" class="img" style="display: none;"/><br />
                                    <div id="btnCrop" style="display: none;">
                                      <input onclick="cropPicture('users')" type='button' id="crop" value='CROP'>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group" id="fileFieldUpload">                                
                                <input onchange="sendPicture('users')" type="file" id="" name="dataform[picture]">
                                <input type="hidden" name="dataform[picture]" value='<?php echo utf8_decode($usersItem["picture"]); ?>' id="hiddenpicturefield">

                            </div>
                            <div class="form-group">
                              <label>Tipo de Usuário</label>
                                <select name="dataform[usertypeid]" class=" form-control" style="width: 100%;">
                                  <?php
                                      foreach ($usertypesItem as $item) {
                                        echo "<option ";
                                        echo "value='".$item['id']."' ";
                                        if($usersItem['usertypeid'] == $item['id']){
                                          echo "selected='selected'";
                                        } 
                                        echo ">";
                                        echo $item['type'];
                                        echo "</option>";
                                      }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[status]" type="checkbox" <?php if($usersItem['status']){echo 'checked';}?>>Ativo
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
                <div class="box box-warning" id="our-services-manager-grid">
                        <div class="box-header">
                          <h3 class="box-title">Novo</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["users"]."/new/"?>'>
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Nome</label>
                                  <input name="dataform[name]" type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                  <label>Sobrenome</label>
                                  <input name="dataform[lastname]" type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                  <label>Email</label>
                                  <input name="dataform[email]" type="email" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                  <label>Login</label>
                                  <input name="dataform[login]" type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                  <label>Senha</label>
                                  <input name="dataform[password]" type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                  <label for="foto">Foto</label>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col col-lg-3 col-md-3 col-sm-12">
                                        <img id="currentPicture" class="pad img-responsive img-circle" style="display: none;">
                                        <img class="img-fluid"src='<?php echo $GLOBALS['base_url']."/";?>' id="cropbox" class="img" style="display: none;"/><br />
                                        <div id="btnCrop" style="display: none;">
                                          <input onclick="cropPicture('users')" type='button' id="crop" value='CROP'>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <div class="form-group" id="fileFieldUpload">                                
                                  <input onchange="sendPicture('users')" type="file" id="" name="dataform[picture]">
                                  <input type="hidden" name="dataform[picture]" value='' id="hiddenpicturefield">

                              </div>
                                <div class="form-group">
                                  <label>Tipo de Usuário</label>
                                    <select name="dataform[usertypeid]" class=" form-control" style="width: 100%;">
                                      <?php
                                          foreach ($usertypesItem as $item) {
                                            echo "<option ";
                                            echo "value='".$item['id']."' ";
                                            echo ">";
                                            echo $item['type'];
                                            echo "</option>";
                                          }
                                      ?>
                                    </select>
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