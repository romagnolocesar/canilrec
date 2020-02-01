<?php
session_start();
if(isset($_GET['targetid'])){
	$_SESSION['chatstates']['targetid'] = $_GET['targetid'];
}

if(isset($_GET['targetfullname'])){
	$_SESSION['chatstates']['targetfullname'] = $_GET['targetfullname'];
}

if(isset($_GET['opened'])){
	$_SESSION['chatstates']['opened'] = $_GET['opened'];
}