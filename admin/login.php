<?php
session_start();

include "../config/globals.php";
include "includes/header.php";
include "../includes/post.php";

if(isset($_GET['route'])){
  if($_GET['route'] == "login"){
    
    try{
        $result = post($GLOBALS['api']['users']."/login", array(
            'login' => $_POST['login'],
            'password' => $_POST['password']
        ));
        if($result){
          $_SESSION['logged-user'] = json_decode($result);
          $admin_base_url = $GLOBALS['admin_base_url'];

          // UPDATE TIMESTAMP LOGIN INTO DB
          $currentDate = date_timestamp_get(new DateTime());
          $json_string = $GLOBALS['api']['users']."/updatestatus/".$_SESSION['logged-user']->id."/".$currentDate;
          $jsondata = file_get_contents($json_string);

          header('location:'.$admin_base_url);
        }else{
          unset($_SESSION);
        }
    } catch(Exception $e){
        echo $e->getMessage();
    }

    
  }
}

?>
<body class="hold-transition login-page" style="background-color: #222222">
<div class="login-box">
  <div class="login-logo">
    <img src="img/footer-logo.png">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Identifique-se para começar a sessão</p>

    <form action="login.php?route=login" method="post">
      <div class="form-group has-feedback">
        <input type="login" name="login" class="form-control" placeholder="login">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
