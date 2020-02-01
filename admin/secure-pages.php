<?php
session_start();
include "../config/globals.php";

if(!isset($_SESSION['logged-user'])){
	$loginpage = $GLOBALS['admin_base_url']."/login";
	header('location:'.$loginpage);
}


?>