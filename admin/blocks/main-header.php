<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo $GLOBALS['admin_base_url']; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-xs" >
        <img style="margin:0 auto; vertical-align: middle;" width="50%" class="img-responsive img-fluid" src="<?php echo $GLOBALS['admin_base_url']; ?>/img/footer-logo.png">
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <?php
        $json_string = $GLOBALS['api']['mail']."/target-new/".$_SESSION['logged-user']->id;
        $jsondata = file_get_contents($json_string);
        $newEmails = json_decode($jsondata, TRUE);
        $qtdNewEmails = count($newEmails);
      ?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php if($qtdNewEmails){ echo $qtdNewEmails;} ?></span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="header"><?php if($qtdNewEmails){ echo "Você possui ".$qtdNewEmails." mensagens";} ?></li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <?php
                  if($newEmails){
                      foreach ($newEmails as $key => $value) {
                        $json_string = $GLOBALS['api']['users']."/".$value['creatoruserid'];
                        $jsondata = file_get_contents($json_string);
                        $userItem = json_decode($jsondata, TRUE);
                  ?>
                        <li><!-- start message -->
                          <a href="#">
                            <div class="pull-left">
                              <!-- User Image -->
                              <img src="<?php echo $GLOBALS['admin_base_url']."/img/users/".$userItem['picture']; ?>" class="img-circle" alt="User Image">
                            </div>
                            <!-- Message title and timestamp -->
                            <h4>
                              <?php echo utf8_decode($userItem['name'])." ".utf8_decode($userItem['lastname']); ?>
                              <small><i class="fa fa-clock-o"></i>
                                <?php
                                $date_stamp = intval($value['date']);
                                echo date("d-m-Y",$date_stamp);
                                ?>
                              </small>
                            </h4>
                            <!-- The message -->
                            <p><?php echo $value['subject']; ?></p>
                          </a>
                        </li>
                  <?php

                      }
                  }else{
                    echo "<li><p><center>Você não possui novas mensagens.</center></p></li>";
                  }
                  ?>
                  


                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href='<?php echo $GLOBALS['admin_base_url']."/mailbox";?>'>Ver todas as mensagens</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"></span>
            </a>
            <!-- <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul> -->
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"></span>
            </a>
            <!-- <
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul> 
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
            -->
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo $GLOBALS['admin_base_url']."/img/users/".$_SESSION['logged-user']->picture; ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo utf8_decode($_SESSION['logged-user']->name)." ".utf8_decode($_SESSION['logged-user']->lastname); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo $GLOBALS['admin_base_url']."/img/users/".$_SESSION['logged-user']->picture; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo utf8_decode($_SESSION['logged-user']->name)." ".utf8_decode($_SESSION['logged-user']->lastname); ?> - Web Developer
                  <!-- <small>Administrador</small> -->
                </p>
              </li>
              <!-- Menu Body -->
            <!--   <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Skill1</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Skill2</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Skill3</a>
                  </div>
                </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $GLOBALS['admin_base_url']."/logout"; ?>" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>