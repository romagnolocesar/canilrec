<?php
  include "secure-pages.php";
  include "../config/globals.php";

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = "";
  }
  if(isset($_GET['route'])){
    $route = $_GET['route'];
  }else{
    $route = "";
  }
  if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
  }else{
    $mode = "";
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }else{
    $id = "";
  }


if($mode != "ajax"){
  include "includes/header.php";
  echo "<!DOCTYPE html><html><body class='hold-transition skin-custom sidebar-mini'>";
?>
  <div class="wrapper" style="height: 100vh !important;">
      <?php

        include "blocks/main-header.php";

        include "blocks/l-side.php";

        include "main-content.php";

        include "blocks/main-footer.php";

        include "blocks/control-sidebar.php";

        include "includes/scripts.php";
      
        echo "</body></html>";
}else if($mode == "ajax"){
        include "main-content.php";
}
