<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/user.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL ARTISTS
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$users = $mysql->get('tbl_site_users');
		if($users){
			foreach($users as $value){
				$item = new user();
				$item->setId(utf8_encode($value['id']));
				$item->setName(utf8_encode($value['name']));
				$item->setLastname(utf8_encode($value['lastname']));
				$item->setEmail(utf8_encode($value['email']));
				$item->setLogin(utf8_encode($value['login']));
				$item->setPassword(utf8_encode($value['password']));
				$item->setPicture(utf8_encode($value['picture']));
				$item->setUserTypeId(utf8_encode($value['user_type_id']));
				$item->setOnline(utf8_encode($value['online']));
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

// GET ALL ARTISTS
function getLoggedUsers(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$currentDate = date_timestamp_get(new DateTime());
		$minAllowedDate = date_timestamp_get(new DateTime())-600;
		$users = $mysql->get('tbl_site_users');
		if($users){
			foreach($users as $value){
				if($value['online'] >= $minAllowedDate){
					$item = new user();
					$item->setId(utf8_encode($value['id']));
					$item->setName(utf8_encode($value['name']));
					$item->setLastname(utf8_encode($value['lastname']));
					$item->setEmail(utf8_encode($value['email']));
					$item->setLogin(utf8_encode($value['login']));
					$item->setPassword(utf8_encode($value['password']));
					$item->setPicture(utf8_encode($value['picture']));
					$item->setUserTypeId(utf8_encode($value['user_type_id']));
					$item->setOnline(utf8_encode($value['online']));
					$item->setStatus(utf8_encode($value['status']));
					array_push($itens, $item->getJson());
				}
			}	
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ARTIST BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$user = $mysql->where('id', $id)->get('tbl_site_users');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($user){
		foreach($user as $value){
			$item = new user();
			$item->setId(utf8_encode($value['id']));
			$item->setName(utf8_encode($value['name']));
			$item->setLastname(utf8_encode($value['lastname']));
			$item->setEmail(utf8_encode($value['email']));
			$item->setLogin(utf8_encode($value['login']));
			$item->setPassword(utf8_encode($value['password']));
			$item->setPicture(utf8_encode($value['picture']));
			$item->setUserTypeId(utf8_encode($value['user_type_id']));
			$item->setOnline(utf8_encode($value['online']));
			$item->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($item->getJson());
	}	
	
}

// GET BY LOGIN AND PASS
function getByLoginPassword($login, $password){
	include "../includes/mysql_connection.php";
	try{
		$user = $mysql->where('login', $login)->and_where('password', $password) ->get('tbl_site_users');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($user){
		foreach($user as $value){
			$item = new user();
			$item->setId(utf8_encode($value['id']));
			$item->setName(utf8_encode($value['name']));
			$item->setLastname(utf8_encode($value['lastname']));
			$item->setEmail(utf8_encode($value['email']));
			$item->setLogin(utf8_encode($value['login']));
			$item->setPassword(utf8_encode($value['password']));
			$item->setPicture(utf8_encode($value['picture']));
			$item->setUserTypeId(utf8_encode($value['user_type_id']));
			$item->setOnline(utf8_encode($value['online']));
			$item->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($item->getJson());
	}	
	
}

// UPDATE
function update($id, $usersObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_users', 
			array(
				'name' => $usersObj->getName(), 
				'lastname' => $usersObj->getLastname(),
				'email' => $usersObj->getEmail(),
				'login' => $usersObj->getLogin(),
				'password' => $usersObj->getPassword(),
				'picture' => $usersObj->getPicture(),
				'user_type_id' => $usersObj->getUserTypeId(),
				'online' => $usersObj->getOnline(),
				'status' => $usersObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// Update State of User
function updatestatus($id, $newStatus){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_users', 
			array(
				'online' => $newStatus,
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE
function create($id, $usersObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_users', 
			array(
				'name' => $usersObj->getName(), 
				'lastname' => $usersObj->getLastname(),
				'email' => $usersObj->getEmail(),
				'login' => $usersObj->getLogin(),
				'password' => $usersObj->getPassword(),
				'picture' => $usersObj->getPicture(),
				'user_type_id' => $usersObj->getUserTypeId(),
				'online' => $usersObj->getOnline(),
				'status' => $usersObj->getStatus()
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
		return $mysql->delete('tbl_site_users');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$usersObj = new user();
	$usersObj->setName($dataForm['name']);
	$usersObj->setLastname($dataForm['lastname']);
	$usersObj->setEmail($dataForm['email']);
	$usersObj->setLogin($dataForm['login']);
	$usersObj->setPassword($dataForm['password']);
	$usersObj->setPicture($dataForm['picture']);
	$usersObj->setUserTypeId($dataForm['usertypeid']);
	if(isset($dataForm['online'])){ 
		$usersObj->setOnline(1);	
	}else{ 
		$usersObj->setOnline(0);	
	}
	if(isset($dataForm['status'])){ 
		$usersObj->setStatus(1);	
	}else{ 
		$usersObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $usersObj);
	}else if($action == "new"){
		return create($id, $usersObj);
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
if(isset($_GET['status'])){
	$status = $_GET['status'];
}


if($route){
	switch ($route) {
		case 'new':
			echo mountObjectFromDataForm($id, $dataform, "new");
		break;
		case 'update':
			echo mountObjectFromDataForm($id, $dataform, "update");
		break;
		case 'updatestatus':
			echo updatestatus($id, $status);
		break;
		case 'delete':
			echo delete($_POST['ids']);
		break;
		case 'logged':
			echo getLoggedUsers();
		break;
		case 'login':
			if(isset($_POST['login']) && isset($_POST['password'])){
				echo getByLoginPassword($_POST['login'], $_POST['password']);
			}else{
				changeDocumentForJsonType();
				echo json_encode(array());
			}
		break;
	}	
}else{
	if($id){
		getById($id);
	}else{
		getAll();
	}
}