<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/chatmessages.class.php";
include "classes/chatusershasnewmessages.class.php";
include "classes/user.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}


// GET ALL chatMessage
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$chatMessages = $mysql->get('tbl_admin_chat_messages');
		if($chatMessages){
			foreach($chatMessages as $value){
				$item = new chatMessage();
				$item->setId(utf8_encode($value['id']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ALL chatMessage BY TARGET
function getAllByTarget($idTarget){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('target_user_id', $idTarget);
	try{
		$chatMessages = $mysql->get('tbl_admin_chat_messages');
		if($chatMessages){
			foreach($chatMessages as $value){
				$item = new chatMessage();
				$item->setId(utf8_encode($value['id']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET CONVERSATION
function getConversation($idTarget, $idCreator){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('target_user_id', $idTarget);
	$mysql->and_where('creator_user_id', $idCreator);
	$mysql->or_where('target_user_id', $idCreator);
	$mysql->and_where('creator_user_id', $idTarget);
	try{
		$chatMessages = $mysql->get('tbl_admin_chat_messages');
		if($chatMessages){
			foreach($chatMessages as $value){
				$item = new chatMessage();
				$item->setId(utf8_encode($value['id']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ALL chatMessage BY TARGET
function getAllByCreator($idCreator){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('creator_user_id', $idCreator);
	try{
		$chatMessages = $mysql->get('tbl_admin_chat_messages');
		if($chatMessages){
			foreach($chatMessages as $value){
				$item = new chatMessage();
				$item->setId(utf8_encode($value['id']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET chatMessage BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$chatMessages = $mysql->where('id', $id)->get('tbl_admin_chat_messages');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($chatMessages){
		foreach($chatMessages as $value){
			$chatMessage = new chatMessage();
			$chatMessage->setId(utf8_encode($value['id']));
			$chatMessage->setMsg(utf8_encode($value['msg']));
			$chatMessage->setCreatorUserId(utf8_encode($value['creator_user_id']));
			$chatMessage->setTargetUserId(utf8_encode($value['target_user_id']));
			$chatMessage->setDate(utf8_encode($value['date']));
		}	
		changeDocumentForJsonType();
		return json_encode($chatMessage->getJson());
	}	
	
}

// UPDATE
function update($id, $chatMessageObject){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_admin_chat_messages', 
			array(
				'msg' => $mailObject->getMsg(),
				'creator_user_id' => $mailObject->getCreatorUserId(),
				'target_user_id' => $mailObject->getTargetUserId(),
				'date' => $mailObject->getDate()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE Message
function create($chatMessageObj){
	include "../includes/mysql_connection.php";
	try{
		if(createUserNewMessages($chatMessageObj)){
			$mysql->insert('tbl_admin_chat_messages', 
				array(
					'msg' => $chatMessageObj->getMsg(),
					'creator_user_id' => $chatMessageObj->getCreatorUserId(),
					'target_user_id' => $chatMessageObj->getTargetUserId(),
					'date' => $chatMessageObj->getDate()
				)
			);
			return getById($mysql->insert_id());
		}else{
			return 0;
		}
		
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ALL chatMessage BY TARGET and BY CREATOR
function getAllByTargetAndCreator($idTarget, $idCreator){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('target_user_id', $idTarget)->and_where('creator_user_id', $idCreator);
	try{
		$chatUsersHasNewMessages = $mysql->get('tbl_admin_chat_users_has_new_messages');
		if($chatUsersHasNewMessages){
			foreach($chatUsersHasNewMessages as $value){
				$item = new chatUsersHasNewMessages();
				$item->setId(utf8_encode($value['id']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				array_push($itens, $item->getJson());
			}
		}
		return $itens;
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE Interaction
function createUserNewMessages($chatUsersHasNewMessagesObj){
	include "../includes/mysql_connection.php";
	$itens = getAllByTargetAndCreator($chatUsersHasNewMessagesObj->getTargetUserId(), $chatUsersHasNewMessagesObj->getCreatorUserId());
	if(count($itens) == 0){
		try{
			return $mysql->insert('tbl_admin_chat_users_has_new_messages', 
				array(
					'creator_user_id' => $chatUsersHasNewMessagesObj->getCreatorUserId(),
					'target_user_id' => $chatUsersHasNewMessagesObj->getTargetUserId(),
				)
			);
		}catch(Exception $e){
			echo 'Caught exception: ', $e->getMessage();
		}
	}else{
		return 1;
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
		return $mysql->delete('tbl_admin_chat_messages');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// SEND MESSAGES
function mountObjectFromDataForm($id, $dataForm, $action){
	$tbl_admin_chat_messages = new chatMessage();
	$tbl_admin_chat_messages->setMsg($dataForm['msg']);
	$tbl_admin_chat_messages->setCreatorUserId($dataForm['creator_user_id']);
	$tbl_admin_chat_messages->setTargetUserId($dataForm['target_user_id']);
	$tbl_admin_chat_messages->setDate(1567390393);

	if($action == "update"){
		return update($id, $tbl_admin_chat_messages);
	}else if($action == "new"){
		return create($tbl_admin_chat_messages);
	}
	
}

//MISC
function sendMessage($dataForm){
	$chatMessageObj = new chatMessage();
	$chatMessageObj->setMsg($dataForm['msg']);
	$chatMessageObj->setCreatorUserId($dataForm['creator_user_id']);
	$chatMessageObj->setTargetUserId($dataForm['target_user_id']);
	$currentDate = new DateTime();
	$currentDate = date_timestamp_get($currentDate);
	$chatMessageObj->setDate($currentDate);
	changeDocumentForJsonType();
	return json_encode(create($chatMessageObj));
	
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
if(isset($_GET['idcreator'])){
	$idcreator = $_GET['idcreator'];
}
if(isset($_GET['idtarget'])){
	$idtarget = $_GET['idtarget'];
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
		case 'target':
			echo getAllByTarget($id);
		break;
		case 'conversation':
			echo getConversation($idtarget, $idcreator);
		break;
		case 'creator':
			echo getAllByCreator($id);
		break;
		case 'send':
			echo sendMessage($dataform);
		break;

	}
		
}else{
	if($id){
		getById($id);
	}else{
		getAll();
	}
}

