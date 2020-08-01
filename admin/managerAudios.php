<?php
  if($_GET['action'] == "upload"){
    if($_GET['target'] == "tracks"){
      $fileTmp = $_FILES['audio']['tmp_name']['audio'];
      $file = $_FILES['audio']['name']['audio'];
      $rand = rand();
      $extension = pathinfo($_FILES['audio']['name']['audio'], PATHINFO_EXTENSION);
      $targetPath = "../tracks/" . $rand.".".$extension;
      $result = $rand.".".$extension;

    }
    if (is_uploaded_file($fileTmp)) {        
        if (move_uploaded_file($fileTmp, $targetPath)) {
          echo $result;
        }
    }

  }
  
?>