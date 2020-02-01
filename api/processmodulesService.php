<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";


include "classes/processmodule.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}


// GET ALL PROCESS MODULES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$processmodules = $mysql->get('tbl_site_process_modules');
		if($processmodules){
			foreach($processmodules as $value){
				$item = new processmodule();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->setSubTitle(utf8_encode($value['subtitle']));
				$item->setIcon(utf8_encode($value['icon']));
				$item->setText(utf8_encode($value['text']));
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


// GET PROCESS MODULE BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$artist = $mysql->where('id', $id)->get('tbl_site_process_modules');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($artist){
		foreach($artist as $value){
			$processmodule = new processmodule();
			$processmodule->setId(utf8_encode($value['id']));
			$processmodule->setTitle(utf8_encode($value['title']));
			$processmodule->setSubTitle(utf8_encode($value['subtitle']));
			$processmodule->setIcon(utf8_encode($value['icon']));
			$processmodule->setText(utf8_encode($value['text']));
			$processmodule->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($processmodule->getJson());
	}	
	
}

// UPDATE
function update($id, $processModuleObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_process_modules', 
			array(
				'title' => $processModuleObj->getTitle(), 
				'subtitle' => $processModuleObj->getSubTitle(),
				'icon' => $processModuleObj->getIcon(),
				'text' => $processModuleObj->getText(),
				'status' => $processModuleObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

function create($id, $processModuleObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_process_modules', 
			array(
				'title' => $processModuleObj->getTitle(), 
				'subtitle' => $processModuleObj->getSubTitle(),
				'icon' => $processModuleObj->getIcon(),
				'text' => $processModuleObj->getText(),
				'status' => $processModuleObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// DELETE  BY ID
function delete($ids){
	include "../includes/mysql_connection.php";
	try{
		foreach ($ids as $key => $id) {
			if($key == 0){
				$mysql->where('id', $id);
			}else{
				$mysql->or_where('id', $id);
			}
			
		}
		return $mysql->delete('tbl_site_process_modules');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$processModuleObj = new processmodule();
	$processModuleObj->setTitle($dataForm['title']);
	$processModuleObj->setSubTitle($dataForm['subtitle']);
	$processModuleObj->setIcon($dataForm['icon']);
	$processModuleObj->setText($dataForm['text']);
	if(isset($dataForm['status'])){ 
		$processModuleObj->setStatus(1);	
	}else{ 
		$processModuleObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $processModuleObj);
	}else if($action == "new"){
		return create($id, $processModuleObj);
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
if(isset($_POST['dataform'])){
	$dataform = $_POST['dataform'];
}

if($route){
	switch ($route) {
		case 'new':
			echo mountObjectFromDataForm($id, $dataform, "new");
		break;
		case 'update':
			echo mountObjectFromDataForm($id, $dataform, "update");
		break;
		case 'delete':
			echo delete($_POST['ids']);
		break;

	}
}else{
	if($id){
		getById($id);
	}else{
		getAll();
	}
}

