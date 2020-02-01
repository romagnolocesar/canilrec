<?php
header("Content-Type:application/json; charset=UTF-8");
include "classes/icon.class.php";

if($_GET){
	$iconCode = $_GET['iconcode'];
}else{
	$iconCode = NULL;
}

$icon = new icon();
$icon->setCode($iconCode);

echo $icon->getText();