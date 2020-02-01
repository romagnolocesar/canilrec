<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/contactmsg.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL CONTACT MESSAGES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$messages = $mysql->get('tbl_site_contactmsg');
			if($messages){
				foreach($messages as $value){
					$item = new contactmsg();
					$item->setId(utf8_encode($value['id']));
					$item->setName(utf8_encode($value['name']));
					$item->setMail(utf8_encode($value['mail']));
					$item->setMsg(utf8_encode($value['msg']));
					$item->setDate(utf8_encode($value['date']));
					$item->setChecked(utf8_encode($value['checked']));
					array_push($itens, $item->getJson());
				}
			}
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}


// GET CONTACT MSG BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$message = $mysql->where('id', $id)->get('tbl_site_contactmsg');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($message){
		foreach($message as $value){
			$message = new contactmsg();
			$message->setId(utf8_encode($value['id']));
			$message->setName(utf8_encode($value['name']));
			$message->setMail(utf8_encode($value['mail']));
			$message->setMsg(utf8_encode($value['msg']));
			$message->setDate(utf8_encode($value['date']));
			$message->setChecked(utf8_encode($value['checked']));
		}
		changeDocumentForJsonType();
		echo json_encode($message->getJson());
	}	
}

// CREATE
function createContactMsg($msgObj){
	include "../includes/mysql_connection.php";
	try{
		$mysql->insert('tbl_site_contactmsg', 
			array(
				'name' => $msgObj->getName(), 
				'mail' => $msgObj->getMail(),
				'msg' => $msgObj->getMsg(),
				'date' => $msgObj->getDate(),
				'checked' => $msgObj->getChecked()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	changeDocumentForJsonType();
	return json_encode($mysql->insert_id());
}


//MISC
function receiveContactFormBySite($formData){
	$msgObj = new contactmsg();
	$msgObj->setName(utf8_encode($formData['name']));
	$msgObj->setMail(utf8_encode($formData['mail']));
	$msgObj->setMsg(utf8_encode($formData['msg']));
	$msgObj->setDate(getdate()[0]);
	$msgObj->setChecked(0);	
	return createContactMsg($msgObj);
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
	switch ($route) {
		case 'createcontactmsg':
			echo receiveContactFormBySite($_POST['contactmsg']);
		break;
	}	
}else{
	if($id){
		getById($id);
	}else{
		getAll();
	}
}

