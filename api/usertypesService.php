<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/usertype.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL PAGES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$usertype = $mysql->get('tbl_site_usertype');
		if($usertype){
			foreach($usertype as $value){
				$item = new usertype();
				$item->setId(utf8_encode($value['id']));
				$item->setType(utf8_encode($value['type']));
				$item->setDescription(utf8_encode($value['description']));
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

// GET PAGE BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$usertypes = $mysql->where('id', $id)->get('tbl_site_usertype');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($usertypes){
		foreach($usertypes as $value){
			$usertype = new usertype();
			$usertype->setId(utf8_encode($value['id']));
			$usertype->setType(utf8_encode($value['type']));
			$usertype->setDescription(utf8_encode($value['description']));
			$usertype->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($usertype->getJson());
	}	
	
}

// UPDATE
function update($id, $usertypesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_usertype', 
			array(
				'type' => $usertypesObj->getType(), 
				'description' => $usertypesObj->getDescription(),
				'status' => $usertypesObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

function create($id, $usertypesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_usertype', 
			array(
				'type' => $usertypesObj->getType(), 
				'description' => $usertypesObj->getDescription(),
				'status' => $usertypesObj->getStatus()
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
		return $mysql->delete('tbl_site_usertype');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$usertypesObj = new usertype();
	$usertypesObj->setType($dataForm['type']);
	$usertypesObj->setDescription($dataForm['description']);
	if(isset($dataForm['status'])){ 
		$usertypesObj->setStatus(1);	
	}else{ 
		$usertypesObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $usertypesObj);
	}else if($action == "new"){
		return create($id, $usertypesObj);
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


