<?php
	session_start();
	include "../config/globals.php";

	//SET 0 in timestamp database
	$json_string = $GLOBALS['api']['users']."/updatestatus/".$_SESSION['logged-user']->id."/0";
    $jsondata = file_get_contents($json_string);

	unset($_SESSION['logged-user']);
	unset($_SESSION['chatstates']);

	$admin_base_url = $GLOBALS['admin_base_url']."/login";
    header('location:'.$admin_base_url);
?>