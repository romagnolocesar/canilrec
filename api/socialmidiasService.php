<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/socialmidia.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL SOCIAL MIDIAS
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$socialmidia = $mysql->get('tbl_site_socialmidias');
		if($socialmidia){
			foreach($socialmidia as $value){
				$item = new socialmidia();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->seticon(utf8_encode($value['icon']));
				$item->setLink(utf8_encode($value['link']));
				$item->setStatus(utf8_encode($value['status']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET SOCIALMIDIA BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$socialmidia = $mysql->where('id', $id)->get('tbl_site_socialmidias');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($socialmidia){
		foreach($socialmidia as $value){
			$socialmidia = new socialmidia();
			$socialmidia->setId(utf8_encode($value['id']));
			$socialmidia->setTitle(utf8_encode($value['title']));
			$socialmidia->seticon(utf8_encode($value['icon']));
			$socialmidia->setLink(utf8_encode($value['link']));
			$socialmidia->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($socialmidia->getJson());
	}	
	
}

// ROUTES
$route = NULL;
$id = NULL;

if(isset($_GET['route'])){
	$route = $_GET['route'];
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
}

if($route){
		
}else{
	if($id){
		getById($id);
	}else{
		getAll();
	}
}

