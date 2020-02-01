<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/scope.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL SCOPES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$scopes = $mysql->get('tbl_site_ourranges');
		if($scopes){
			foreach($scopes as $scope){
				$item = new scope();
				$item->setId(utf8_encode($scope['id']));
				$item->setValue(utf8_encode($scope['value']));
				$item->setIcon(utf8_encode($scope['icon']));
				$item->setTitle(utf8_encode($scope['title']));
				$item->setStatus(utf8_encode($scope['status']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET SCOPE BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$scope = $mysql->where('id', $id)->get('tbl_site_ourranges');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($scope){
		foreach($scope as $value){
			$scope = new scope();
			$scope->setId(utf8_encode($value['id']));
			$scope->setValue(utf8_encode($value['value']));
			$scope->setIcon(utf8_encode($value['icon']));
			$scope->setTitle(utf8_encode($value['title']));
			$scope->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($scope->getJson());
	}	
	
}

// UPDATE
function update($id, $scopesServicesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_ourranges', 
			array(
				'title' => $scopesServicesObj->getTitle(), 
				'value' => $scopesServicesObj->getValue(),
				'icon' => $scopesServicesObj->getIcon(),
				'status' => $scopesServicesObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE
function create($id, $scopesServicesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_ourranges', 
			array(
				'title' => $scopesServicesObj->getTitle(), 
				'value' => $scopesServicesObj->getValue(),
				'icon' => $scopesServicesObj->getIcon(),
				'status' => $scopesServicesObj->getStatus()
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
		return $mysql->delete('tbl_site_ourranges');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$scopesServicesObj = new scope();
	$scopesServicesObj->setTitle($dataForm['title']);
	$scopesServicesObj->setValue($dataForm['value']);
	$scopesServicesObj->setIcon($dataForm['icon']);
	if(isset($dataForm['status'])){ 
		$scopesServicesObj->setStatus(1);	
	}else{ 
		$scopesServicesObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $scopesServicesObj);
	}else if($action == "new"){
		return create($id, $scopesServicesObj);
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
