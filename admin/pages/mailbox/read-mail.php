<?php
  $json_string = $GLOBALS['api']['mail']."/".$id;
  $jsondata = file_get_contents($json_string);
  $mailItem = json_decode($jsondata, TRUE);

  $json_string = $GLOBALS['api']['mail']."/update-viewed/".$id;
  $jsondata = file_get_contents($json_string);


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Caixa de Mensagens
        <small>13 Novas Mensagens</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $GLOBALS['admin_base_url']; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Caixa de Mensagens</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a onclick="openCompose()" href="#" class="btn btn-primary btn-block margin-bottom">Nova Mensagem</a>

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
                <li onclick="openOutbox()"><a href=""><i class="fa fa-envelope-o"></i> Enviadas</a></li>
                <li><a href=""><i class="fa fa-file-text-o"></i> Rascunhos</a></li>
                <li><a href=""><i class="fa fa-filter"></i> Span <span class="label label-warning pull-right">65</span></a>
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
              <h3 class="box-title">Lendo Mensagem</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo utf8_decode($mailItem['subject']);?></h3>
                <?php
                  $json_string = $GLOBALS['api']['users']."/".$mailItem['creatoruserid'];
                  $jsondata = file_get_contents($json_string);
                  $userItem = json_decode($jsondata, TRUE);
                echo "<h5>De: ".utf8_decode($userItem['name'])." ".utf8_decode($userItem['lastname']);
                ?>
                  <span class="mailbox-read-time pull-right">
                    <?php 
                      $date_variant = date("d-m-Y",intval($mailItem['date']));
                      echo $date_variant; 
                    ?>
                      
                    </span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php
                  echo utf8_decode($mailItem['msg']);
                ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Responder</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Encaminhar</button>
              </div>
              <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Excluir</button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
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