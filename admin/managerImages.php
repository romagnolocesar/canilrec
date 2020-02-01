<?php
  if($_GET['action'] == "upload"){
    if($_GET['target'] == "artists"){
      $fileTmp = $_FILES['dataform']['tmp_name']['picture'];
      $file = $_FILES['dataform']['name']['picture'];
      $targetPath = "../img/artists/" . $file;
      $result = "img/artists/".$file;
    }else if($_GET['target'] == "tracks"){
      $fileTmp = $_FILES['dataform']['tmp_name']['cover'];
      $file = $_FILES['dataform']['name']['cover'];
      $targetPath = "../img/covers/" . $file;
      $result = "img/covers/".$file;
    }else if($_GET['target'] == "users"){
      $fileTmp = $_FILES['dataform']['tmp_name']['picture'];
      $file = $_FILES['dataform']['name']['picture'];
      $targetPath = "img/users/" . $file;
      $result = "admin/img/users/".$file;
    }
    if (is_uploaded_file($fileTmp)) {        
        if (move_uploaded_file($fileTmp, $targetPath)) {
          echo $result;
        }
    }

  }else if($_GET['action'] == "crop") {
    $img_r = imagecreatefromjpeg($_GET['img']);
    $dst_r = ImageCreateTrueColor( $_GET['w'], $_GET['h'] );
   
    imagecopyresampled($dst_r, $img_r, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h'], $_GET['w'],$_GET['h']);
    
    //header('Content-type: image/jpeg');

    $filename = uniqid(rand(), true);
    $filename .= ".jpg";
   
    if($_GET['target'] == "artists"){
      imagejpeg($dst_r, "../img/artists/".$filename);
    }else if($_GET['target'] == "tracks"){
       imagejpeg($dst_r, "../img/covers/".$filename);
    }else if($_GET['target'] == "users"){
       imagejpeg($dst_r, "img/users/".$filename);
    }
    unlink("../".$_GET['filename']);

    echo $filename;

    exit;
  }
  
?>