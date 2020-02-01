<?php
  $json_string = $GLOBALS['api']['mail']."/".$id;
  $jsondata = file_get_contents($json_string);
  $mailItem = json_decode($jsondata, TRUE);

  $json_string = $GLOBALS['api']['users'];
  $jsondata = file_get_contents($json_string);
  $usersItem = json_decode($jsondata, TRUE);


?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a onclick="openInbox()" href="#" class="btn btn-primary btn-block margin-bottom">Voltar para Caixa de Entrada</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pastas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li onclick="openInbox()"><a href="#"><i class="fa fa-inbox"></i> Recebidas
                  <span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Rascunhos</a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Span <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Lixo</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Categorias</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Importante</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Visitantes</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Criar nova mensagem</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="dataform" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["mail"]."/send/"; ?>'>
              <div class="form-group">
                <input class="form-control" type="hidden" name="dataform[targets]" id="dataform-targets">
                <select class="form-control select2" multiple="multiple" data-placeholder="Para:"
                      style="width: 100%;" onchange="fillHiddenFieldFromSelect2(event, 'dataform-targets')">
                <?php
                  foreach ($usersItem as $item) {
                    echo "<option value='".$item['id']."'>";
                    echo utf8_decode($item['name']);
                    echo "</option>";
                  }
                ?>
              </select>
              </div>
              <input class="form-control" type="hidden" name="dataform[creator_user_id]" id="dataform-creator" value="<?php echo $_SESSION['logged-user']->id?>">
              <div class="form-group">
                <input name="dataform[subject]" class="form-control" placeholder="Assunto:">
              </div>
              <div class="form-group">
                    <textarea name="dataform[msg]" id="wysieditor" class="form-control" style="height: 300px">
                      </br></br></br></br></br></br>
                      <p>Obrigado,</p>
                      <p><?php echo utf8_decode($_SESSION['logged-user']->name) . " " . utf8_decode($_SESSION['logged-user']->lastname); ?></p>
                    </textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Anexos
                  <input disabled="disabled" type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button disabled type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Guardar como rascunho</button>
                <button onclick="sendMessage()" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
              </div>
              <button disabled="" type="reset" class="btn btn-default"><i class="fa fa-times"></i> Descartar</button>
            </div>
            <!-- /.box-footer -->
            <div id="overlay" class="overlay" style="display: none">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->