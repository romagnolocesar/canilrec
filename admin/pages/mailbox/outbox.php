<?php
  $json_string = $GLOBALS['api']['mail']."/creator/".$_SESSION['logged-user']->id;
  $jsondata = file_get_contents($json_string);
  $mailsInboxItem = json_decode($jsondata, TRUE);


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
                <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
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
              <h3 class="box-title">Entrada</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button onclick="openInbox()" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php
                    if($mailsInboxItem){
                      foreach ($mailsInboxItem as $key => $value) {
                        $json_string = $GLOBALS['api']['users']."/".$value['targetuserid'];
                        $jsondata = file_get_contents($json_string);
                        $userItem = json_decode($jsondata, TRUE);
                    ?>
                        <tr onclick="readMail(<?php echo $value['id']; ?>)">
                          <td><input type="checkbox"></td>
                          <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                    <?php
                          echo "<td class='mailbox-name'><a href='read-mail.html'>".utf8_decode($userItem['name'])." ".utf8_decode($userItem['lastname'])."</a></td>";
                          echo "<td class='mailbox-subject'>".$value['subject']."</td>";                   
                    ?>
                          
                          <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                    <?php
                          $date_variant = date("d-m-Y",intval($value['date']));
                          echo "<td class='mailbox-date'>".$date_variant."</td>";
                    ?>
                        </tr>
                    <?php
                      }
                    }else{
                      echo "<p><center>Nenhuma mensagem</center></p>";
                    }
                    ?>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
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