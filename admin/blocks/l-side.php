<?php
  
?>
<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $GLOBALS['admin_base_url']."/img/users/".$_SESSION['logged-user']->picture; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo utf8_decode($_SESSION['logged-user']->name)." ".utf8_decode($_SESSION['logged-user']->lastname); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pesquisar">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
              	<i class="fa fa-search"></i>
              </button>
          </span>
        </div>
      </form>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header ">.:: MENU ::.</li>
        <li class="<?php if($page == "dashboard"){echo 'active'; } ?>">
          <a href="<?php echo $GLOBALS['admin_base_url']; ?>">
          	<i class="fa fa-desktop"></i> <span>Dashboard</span>
          </a>
        </li>

        <!-- ################## CONTENT MANAGER ######################## -->
        <?php 
          if( $_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['admin']   ||
              $_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['coadmin']  ||
              $_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['editor']
        ){
        ?>
          <li class="treeview
            <?php 
              if(
              $page == 'manager-processmodules' ||
              $page == 'manager-artists' ||
              $page == 'manager-tracks' ||
              $page == 'manager-genres' ||
              $page == 'manager-ourservices' ||
              $page == 'manager-scopes'

              ){
                echo 'menu-open'; 
              } 
            ?>
          ">
            <a href="#">
            	<i class="fa fa-gears"></i> <span>Gerenciar Conteúdos</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" 
            <?php 
              if(
                $page == 'manager-artists' ||
                $page == 'manager-tracks' ||
                $page == 'manager-genres' ||
                $page == 'manager-processmodules' ||
                $page == 'manager-ourservices' ||
                $page == 'manager-scopes'
              ){
                echo "style='display:block'"; 
              } 
            ?>
            >
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/artists/">
                  Artistas
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/tracks/">
                  Tracks
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/genres/">
                  Gêneros
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/processmodules/">
                  Modulos de Processos
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/ourservices/">
                  Nossos Serviços
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/scopes/">
                  Nosso Alcance
                </a>
              </li>
            </ul>
          </li>
        <?php
        }
        ?>

        <!-- ################## STRUCTURE MANAGER ######################## -->
        <?php 
          if( $_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['admin']
        ){
        ?>
          <li class="treeview
            <?php 
              if(
              $page == 'manager-pages' ||
              $page == 'manager-sections'

              ){
                echo 'menu-open'; 
              } 
            ?>
          ">
            <a href="#">
              <i class="fa fa-cubes"></i> <span>Gerenciar Estrutura</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" 
            <?php 
              if(
                $page == 'manager-pages' ||
                $page == 'manager-sections'
              ){
                echo "style='display:block'"; 
              } 
            ?>
            >
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/pages/">
                  Páginas
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/sections/">
                  Seções
                </a>
              </li>
          </li>
        </ul>
      <?php
        }
      ?>


      <!-- ################## USERS MANAGER ######################## -->
      <?php 
        if( $_SESSION['logged-user']->usertypeid == $GLOBALS['usertypeid']['admin']
      ){
      ?>
        <li class="treeview
            <?php 
              if(
              $page == 'manager-users' ||
              $page == 'manager-usertypes'

              ){
                echo 'menu-open'; 
              } 
            ?>
          ">
            <a href="#">
              <i class="fa fa-users"></i> <span>Gerenciar Usuários</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" 
            <?php 
              if(
                $page == 'manager-users' ||
                $page == 'manager-usertypes'
              ){
                echo "style='display:block'"; 
              } 
            ?>
            >
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/users/">
                  Usuários
                </a>
              </li>
              <li>
                <a href="<?php echo $GLOBALS['admin_base_url']; ?>/manager/usertypes/">
                  Tipos de Usuários
                </a>
              </li>
          </li>
        <?php
          }
        ?>
    </section>
  </aside>