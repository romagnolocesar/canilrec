        <?php
            include "../config/globals.php";

            $json_string = $GLOBALS['api']['genres'];
            $jsondata = file_get_contents($json_string);
            $genresItem = json_decode($jsondata, TRUE);

            $json_string = $GLOBALS['api']['artists'];
            $jsondata = file_get_contents($json_string);
            $artistsItem = json_decode($jsondata, TRUE);

            function getHeaderContentWrapper(){
              echo "<div class='content-wrapper'><section class='content-header'><h1>Gerenciador<small>Tracks</small></h1>";
              ?>
              <ol class="breadcrumb">
                <li><a href="<?php echo $GLOBALS['admin_base_url']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Genrenciador de Tracks</li>
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

                <div class="box" id="tracks-manager-grid hidden">
                    <div class="box-header">
                      <h3 class="box-title">Relação de Tracks</h3>
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
                        $json_string = $GLOBALS['api']['tracks'];
                        $jsondata = file_get_contents($json_string);
                        $tracksItens = json_decode($jsondata, TRUE);
                        echo "<table id='gridData' class='table table-bordered table-hover' url-api='".$GLOBALS['api']['tracks']."/"."'>";
                        echo "  <thead>";
                        echo "    <tr>";
                                    echo "<td>Titulo</td>";
                                    echo "<td>Gênero</td>";
                                    echo "<td>Status</td>";
                        echo "    </tr>";
                        echo "  </thead>";
                        echo "  <tbody>";
                                    foreach ($tracksItens as $item) {
                                      echo "  <tr data-id='".$item['id']."'>";
                                        echo "  <td>".utf8_decode($item['title'])."</td>";

                                        echo "<td>";
                                        if($item['genre']){
                                          $json_string = $GLOBALS['api']['genres']."/".$item['genre'];
                                          $jsondata = file_get_contents($json_string);
                                          $currentGenre = json_decode($jsondata, TRUE);
                                          if($currentGenre){
                                            echo utf8_decode($currentGenre['title']);
                                          }
                                        }
                                        echo "</td>";
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
                                    echo "<td>Gênero</td>";
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
                    $json_string = $GLOBALS['api']['tracks']."/".$_GET['id']."/artists";
                    $jsondata = file_get_contents($json_string);
                    $artistsRelationItem = json_decode($jsondata, TRUE);
                    $artistsRelationItemIds = array();
                    if($artistsRelationItem){
                      foreach ($artistsRelationItem as $key => $artist) {
                        array_push($artistsRelationItemIds, $artist['id']);
                      }
                    }

                    $json_string = $GLOBALS['api']['tracks']."/".$_GET['id'];
                    $jsondata = file_get_contents($json_string);
                    $tracksItem = json_decode($jsondata, TRUE);
                    getHeaderContentWrapper();
            ?>
                <section class="content container-fluid">  
                <div class="box box-warning" id="tracks-manager-grid">
                    <div class="box-header">
                      <h3 class="box-title">Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["tracks"]."/update/".$_GET['id']; ?>'>
                            <!-- text input -->
                            <div class="form-group">
                              <label>Titulo</label>
                              <input name="dataform[title]" type="text" class="form-control" placeholder="Enter ..." 
                                value="<?php echo utf8_decode($tracksItem['title']); ?>">
                            </div>
                            <div class="form-group">
                                  <label>Descrição</label>
                                  <textarea id="wysieditor" name="dataform[description]" class="form-control" rows="3"><?php echo utf8_decode($tracksItem['description']); ?></textarea> 
                            </div>
                            <div class="form-group" id="audioFieldUpload">
                                  <label for="foto">Áudio da track</label>
                                  
                                  <input name="dataform[audio]" type="text" class="form-control" placeholder="Audio.wav" 
                                value="<?php echo utf8_decode($tracksItem['audio']); ?>">                           
                                  <input onchange="sendAudio('tracks')" type="file" name="audio[audio]">
                                  <input type="hidden" name="dataform[audio]" value="<?php echo utf8_decode($tracksItem['audio']); ?>" id="hiddenaudiofield">

                              </div>
                            <div class="form-group">
                                <label for="foto">Capa</label>
                                <div class="container">
                                  <div class="row">
                                    <div class="col col-lg-3 col-md-3 col-sm-12">
                                        <img id="currentPicture" class="pad img-responsive img-circle"
                                        <?php
                                          echo "src='".$GLOBALS['base_url']."/img/covers/".utf8_decode($tracksItem['cover'])."'"; 
                                        ?>
                                        alt="Capa da Track">
                                      <img class="img-fluid" src='<?php echo $GLOBALS['base_url']."/";?>' id="cropbox" class="img" style="display: none;"/><br />
                                      <div id="btnCrop" style="display: none;">
                                        <input onclick="cropPicture('tracks')" type='button' id="crop" value='CROP'>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                            <div class="form-group" id="fileFieldUpload">                                
                                <input onchange="sendPicture('tracks')" type="file" id="" name="dataform[cover]">
                                <input type="hidden" name="dataform[cover]" value='<?php echo utf8_decode($tracksItem["cover"]); ?>' id="hiddenpicturefield">

                            </div>
                            <div class="form-group">
                              <label>Gênero</label>
                                <select name="dataform[genre]" class=" form-control" style="width: 100%;">
                                  <?php
                                      foreach ($genresItem as $item) {
                                        echo "<option ";
                                        echo "value='".$item['id']."' ";
                                        if($tracksItem['genre'] == $item['id']){
                                          echo "selected='selected'";
                                        } 
                                        echo ">";
                                        echo $item['title'];
                                        echo "</option>";
                                      }
                                  ?>
                                </select>
                            </div>

                            <div class="form-group">
                                  <label>Artistas Envolvidos</label>
                                  <input type="hidden" name="dataform[artists]" 
                                  <?php echo "value='".implode(',', $artistsRelationItemIds)."'";?>
                                  id="dataform-artists">
                                  <select class="form-control select2" multiple="multiple" data-placeholder="Selecione os artistas"
                                          style="width: 100%;" onchange="fillHiddenFieldFromSelect2(event, 'dataform-artists')">
                                    <?php
                                    
                                      foreach ($artistsItem as $item) {
                                        echo "<option ";
                                        if(in_array($item['id'], $artistsRelationItemIds)){
                                          echo "selected='selected' ";
                                        }
                                        echo "value='".$item['id']."'>";
                                        echo $item['name'];
                                        echo "</option>";
                                      }
                                    ?>
                                  </select>
                                </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input name="dataform[status]" type="checkbox" <?php if($tracksItem['status']){echo 'checked';}?>>Ativo
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
                <div class="box box-warning" id="tracks-manager-grid">
                        <div class="box-header">
                          <h3 class="box-title">Novo</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["tracks"]."/new/"?>'>
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Titulo</label>
                                  <input name="dataform[title]" type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                      <label>Descrição</label>
                                      <textarea id="wysieditor" name="dataform[description]" class="form-control" rows="3"></textarea> 
                                </div>
                                <div class="form-group" id="audioFieldUpload">
                                  <label for="foto">Áudio da track</label>                            
                                  <input onchange="sendAudio('tracks')" type="file" name="audio[audio]">
                                  <input type="hidden" name="dataform[audio]" value='' id="hiddenaudiofield">

                              </div>
                                <div class="form-group">
                                  <label for="foto">Capa</label>
                                  <div class="container">
                                    <div class="row">
                                      <div class="col col-lg-3 col-md-3 col-sm-12">
                                        <img id="currentPicture" class="pad img-responsive img-circle" style="display: none;">
                                      </div>
                                    </div>
                                  </div>
                                  <img class="img-fluid"src='<?php echo $GLOBALS['base_url']."/";?>' id="cropbox" class="img" style="display: none;"/><br />
                                  <div id="btnCrop" style="display: none;">
                                    <input onclick="cropPicture('tracks')" type='button' id="crop" value='CROP'>
                                </div>
                                </div>
                              <div class="form-group" id="fileFieldUpload">                                
                                  <input onchange="sendPicture('tracks')" type="file" id="" name="dataform[cover]">
                                  <input type="hidden" name="dataform[cover]" value='' id="hiddenpicturefield">

                              </div>
                                <div class="form-group">
                                  <label>Gênero</label>
                                    <select name="dataform[genre]" class=" form-control" style="width: 100%;">
                                      <?php
                                          foreach ($genresItem as $item) {
                                            echo "<option ";
                                            echo "value='".$item['id']."' ";
                                            echo ">";
                                            echo $item['title'];
                                            echo "</option>";
                                          }
                                      ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label>Artistas Envolvidos</label>
                                  <input type="hidden" name="dataform[artists]" id="dataform-artists">
                                  <select class="form-control select2" multiple="multiple" data-placeholder="Selecione os artistas"
                                          style="width: 100%;" onchange="fillHiddenFieldFromSelect2(event, 'dataform-artists')">
                                    <?php
                                      foreach ($artistsItem as $item) {
                                        echo "<option value='".$item['id']."'>";
                                        echo utf8_decode($item['name']);
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