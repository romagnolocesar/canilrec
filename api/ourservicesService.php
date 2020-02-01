<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/ourservice.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL SERVICES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$ourservices = $mysql->get('tbl_site_ourservices');
		if($ourservices){
			foreach($ourservices as $value){
				$item = new ourservice();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->setText(utf8_encode($value['text']));
				$item->setButton(utf8_encode($value['button']));
				$item->setIcon(utf8_encode($value['icon']));
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


// GET SERVICES BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$ourservice = $mysql->where('id', $id)->get('tbl_site_ourservices');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($ourservice){
		foreach($ourservice as $value){
			$ourservice = new ourservice();
			$ourservice->setId(utf8_encode($value['id']));
			$ourservice->setTitle(utf8_encode($value['title']));
			$ourservice->setText(utf8_encode($value['text']));
			$ourservice->setButton(utf8_encode($value['button']));
			$ourservice->setIcon(utf8_encode($value['icon']));
			$ourservice->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($ourservice->getJson());
	}	
	
}

// UPDATE
function update($id, $ourServicesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_ourservices', 
			array(
				'title' => $ourServicesObj->getTitle(), 
				'subtitle' => $ourServicesObj->getSubTitle(),
				'icon' => $ourServicesObj->getIcon(),
				'text' => $ourServicesObj->getButton(),
				'status' => $ourServicesObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

function create($id, $ourServicesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_ourservices', 
			array(
				'title' => $ourServicesObj->getTitle(), 
				'text' => $ourServicesObj->getText(),
				'icon' => $ourServicesObj->getIcon(),
				'button' => $ourServicesObj->getButton(),
				'status' => $ourServicesObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// DELETE BY ID
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
		return $mysql->delete('tbl_site_ourservices');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$ourServicesObj = new ourservice();
	$ourServicesObj->setTitle($dataForm['title']);
	$ourServicesObj->setText($dataForm['text']);
	$ourServicesObj->setIcon($dataForm['icon']);
	$ourServicesObj->setButton($dataForm['button']);
	if(isset($dataForm['status'])){ 
		$ourServicesObj->setStatus(1);	
	}else{ 
		$ourServicesObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $ourServicesObj);
	}else if($action == "new"){
		return create($id, $ourServicesObj);
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

