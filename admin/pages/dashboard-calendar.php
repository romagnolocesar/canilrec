<?php
  $json_string = $GLOBALS['api']['calendar']."/usernodate/".$_SESSION['logged-user']->id;
  $jsondata = file_get_contents($json_string);
  $calendarItensNoDate = json_decode($jsondata, TRUE);
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Eventos</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <?php
                  if($calendarItensNoDate){
                    foreach ($calendarItensNoDate as $key => $value) {
                     echo "<div data-id='".$value['id']."' class='external-event bg-".$value['color']."'>".utf8_decode($value['title'])."</div>";
                    }
                  }

                ?>
              </div>
              <p class="text-muted well well-sm no-shadow">Crie seus eventos e arraste-os para o calendário para criar um compromisso.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Criar Evento</h3>
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a data-color="aqua" class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="blue" class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="light-blue" class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="teal" class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="yellow" class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="orange" class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="green" class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="lime" class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="red" class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="purple" class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="fuchsia" class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a data-color="navy" class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Titulo">

                <div class="input-group-btn">
                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Adicionar</button>
                </div>
                <!-- /btn-group -->
              </div>
              <?php
                if($_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['admin'] || $_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['coadmin']){
              ?>

                <div class="input-group pad" id="checkbox-eventtype">
                  <label>
                    <input type="checkbox" class="minimal">
                    Evento Publico
                  </label>
                  <i class="fa fa-fw fa-user-secret"></i>
                </div>
              <?php
                }
              ?>
              <!-- /input-group -->
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
