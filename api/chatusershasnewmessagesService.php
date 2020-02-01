<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/chatusershasnewmessages.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}


// GET ALL chatMessage BY TARGET
function getAllByTarget($idTarget){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('target_user_id', $idTarget);
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
		changeDocumentForJsonType();
		echo json_encode($itens);
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


// CREATE
function create($chatUsersHasNewMessagesObj){
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
function deleteByTargetAndCreator($idTarget, $idCreator){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('target_user_id', $idTarget)->and_where('creator_user_id', $idCreator)->delete('tbl_admin_chat_users_has_new_messages');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// SEND MESSAGES
function mountObjectFromDataForm($id, $idcreator, $idtarget, $action){
	$tbl_admin_chat_users_has_new_messages = new chatUsersHasNewMessages();
	$tbl_admin_chat_users_has_new_messages->setCreatorUserId($idcreator);
	$tbl_admin_chat_users_has_new_messages->setTargetUserId($idtarget);
	
	if($action == "new"){
		return create($tbl_admin_chat_users_has_new_messages);
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
if(isset($_POST['idcreator'])){
	$idcreator = $_POST['idcreator'];
}else if(isset($_GET['idcreator'])){
	$idcreator = $_GET['idcreator'];
}
if(isset($_POST['idtarget'])){
	$idtarget = $_POST['idtarget'];
}else if(isset($_GET['idtarget'])){
	$idtarget = $_GET['idtarget'];
}



if($route){
	switch ($route) {
		case 'new':
			echo mountObjectFromDataForm($id, $idcreator, $idtarget, "new");
		break;
		case 'target':
			echo getAllByTarget($id);
		break;
		case 'targetandcreator':
			if(count(getAllByTargetAndCreator($idtarget, $idcreator)) > 0){
				echo 1;
			}else{
				echo 0;
			}
		break;
		case 'deletetargetandcreator':
			echo deleteByTargetAndCreator($idtarget, $idcreator);
		break;

		


	}
		
}

