<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/mail.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}


// GET ALL MAIL
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$genres = $mysql->get('tbl_admin_mail');
		if($genres){
			foreach($genres as $value){
				$item = new mail();
				$item->setId(utf8_encode($value['id']));
				$item->setSubject(utf8_encode($value['subject']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				$item->setViewed(utf8_encode($value['viewed']));
				$item->setMsgGroupId(utf8_encode($value['msg_group_id']));
				$item->setOwnerUserId(utf8_encode($value['owner_user_id']));
				$item->setAsked(utf8_encode($value['asked']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ALL MAIL BY TARGET
function getAllByTarget($idTarget){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('target_user_id', $idTarget);
	try{
		$mails = $mysql->get('tbl_admin_mail');
		if($mails){
			foreach($mails as $value){
				$item = new mail();
				$item->setId(utf8_encode($value['id']));
				$item->setSubject(utf8_encode($value['subject']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				$item->setViewed(utf8_encode($value['viewed']));
				$item->setMsgGroupId(utf8_encode($value['msg_group_id']));
				$item->setOwnerUserId(utf8_encode($value['owner_user_id']));
				$item->setAsked(utf8_encode($value['asked']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ALL NEW MAILS BY TARGET
function getAllByTargetNew($idTarget){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('target_user_id', $idTarget)->and_where('viewed', 0);
	try{
		$mails = $mysql->get('tbl_admin_mail');
		if($mails){
			foreach($mails as $value){
				$item = new mail();
				$item->setId(utf8_encode($value['id']));
				$item->setSubject(utf8_encode($value['subject']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				$item->setViewed(utf8_encode($value['viewed']));
				$item->setMsgGroupId(utf8_encode($value['msg_group_id']));
				$item->setOwnerUserId(utf8_encode($value['owner_user_id']));
				$item->setAsked(utf8_encode($value['asked']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
		
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET ALL MAIL BY TARGET
function getAllByCreator($idCreator){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	$mysql->where('creator_user_id', $idCreator);
	try{
		$mails = $mysql->get('tbl_admin_mail');
		if($mails){
			foreach($mails as $value){
				$item = new mail();
				$item->setId(utf8_encode($value['id']));
				$item->setSubject(utf8_encode($value['subject']));
				$item->setMsg(utf8_encode($value['msg']));
				$item->setCreatorUserId(utf8_encode($value['creator_user_id']));
				$item->setTargetUserId(utf8_encode($value['target_user_id']));
				$item->setDate(utf8_encode($value['date']));
				$item->setViewed(utf8_encode($value['viewed']));
				$item->setMsgGroupId(utf8_encode($value['msg_group_id']));
				$item->setOwnerUserId(utf8_encode($value['owner_user_id']));
				$item->setAsked(utf8_encode($value['asked']));
				array_push($itens, $item->getJson());
			}
		}
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET MAIL BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$genres = $mysql->where('id', $id)->get('tbl_admin_mail');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($genres){
		foreach($genres as $value){
			$mail = new mail();
			$mail->setId(utf8_encode($value['id']));
			$mail->setSubject(utf8_encode($value['subject']));
			$mail->setMsg(utf8_encode($value['msg']));
			$mail->setCreatorUserId(utf8_encode($value['creator_user_id']));
			$mail->setTargetUserId(utf8_encode($value['target_user_id']));
			$mail->setDate(utf8_encode($value['date']));
			$mail->setViewed(utf8_encode($value['viewed']));
			$mail->setMsgGroupId(utf8_encode($value['msg_group_id']));
			$mail->setOwnerUserId(utf8_encode($value['owner_user_id']));
			$mail->setAsked(utf8_encode($value['asked']));
		}	
		changeDocumentForJsonType();
		echo json_encode($mail->getJson());
	}	
	
}

// UPDATE VIEWED
function updateViewed($id){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_admin_mail', 
			array(
				'viewed' => 1,
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// UPDATE
function update($id, $mailObject){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_admin_mail', 
			array(
				'subject' => $mailObject->getSubject(), 
				'msg' => $mailObject->getMsg(),
				'creator_user_id' => $mailObject->getCreatorUserId(),
				'target_user_id' => $mailObject->getTargetUserId(),
				'date' => $mailObject->getDate(),
				'viewed' => $mailObject->getViewed(),
				'msg_group_id' => $mailObject->getMsgGroupId(),
				'owner_user_id' => $mailObject->getOwnerUserId(),
				'asked' => $mailObject->getAsked()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE
function create($mailObject){
	include "../includes/mysql_connection.php";
	try{
		if($mailObject->getMsgGroupId()){
			$msg_group_id = $mailObject->getMsgGroupId();		
		}else{
			$msg_group_id = 0;
		}
		return $mysql->insert('tbl_admin_mail', 
			array(
				'subject' => $mailObject->getSubject(), 
				'msg' => $mailObject->getMsg(),
				'creator_user_id' => $mailObject->getCreatorUserId(),
				'target_user_id' => $mailObject->getTargetUserId(),
				'date' => $mailObject->getDate(),
				'viewed' => $mailObject->getViewed(),
				'msg_group_id' => $msg_group_id,
				'owner_user_id' => $mailObject->getOwnerUserId(),
				'asked' => $mailObject->getAsked()
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
		return $mysql->delete('tbl_admin_mail');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// SEND EMAILS
function mountObjectFromDataForm($id, $dataForm, $action){
	$tbl_admin_mail = new mail();
	$tbl_admin_mail->setSubject($dataForm['subject']);
	$tbl_admin_mail->setMsg($dataForm['msg']);
	$tbl_admin_mail->setCreatorUserId($dataForm['creator_user_id']);
	$tbl_admin_mail->setTargetUserId($dataForm['target_user_id']);
	$tbl_admin_mail->setDate(1567390393);
	$tbl_admin_mail->setViewed($dataForm['viewed']);
	$tbl_admin_mail->setMsgGroupId($dataForm['msg_group_id']);
	$tbl_admin_mail->setOwnerUserId($dataForm['owner_user_id']);
	$tbl_admin_mail->setAsked($dataForm['asked']);

	if($action == "update"){
		return update($id, $tbl_admin_mail);
	}else if($action == "new"){
		return create($tbl_admin_mail);
	}
	
}

//MISC
function sendMessage($dataForm){
	if($dataForm['targets']){
		$targets = explode(",", $dataForm['targets']);	
	}

	if($targets){
		foreach ($targets as $key => $target) {
			$mailObject = new mail();
			$mailObject->setSubject($dataForm['subject']);
			$mailObject->setMsg($dataForm['msg']);
			$mailObject->setCreatorUserId($dataForm['creator_user_id']);
			$mailObject->setTargetUserId($target);
			$mailObject->setDate(time());
			$mailObject->setViewed(0);
			$mailObject->setOwnerUserId($dataForm['creator_user_id']);
			$mailObject->setAsked(0);

			create($mailObject);

		}
	}
	return "1";
	
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
		case 'target':
			echo getAllByTarget($id);
		break;
		case 'target-new':
			echo getAllByTargetNew($id);
		break;
		case 'creator':
			echo getAllByCreator($id);
		break;
		case 'send':
			echo sendMessage($dataform);
		break;
		case 'update-viewed':
			echo updateViewed($id);
		break;

	}
		
}else{
	if($id){
		getById($id);
	}else{
		getAll();
	}
}

