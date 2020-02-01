<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/calendar.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL EVENTS
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$calendarEvents = $mysql->get('tbl_admin_calendar');
		if($calendarEvents){
			foreach($calendarEvents as $value){
				$item = new calendar();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->setColor(utf8_encode($value['color']));
				$item->setStartDate(utf8_encode($value['start_date']));
				$item->setEndDate(utf8_encode($value['end_date']));
				$item->setEventType(utf8_encode($value['event_type']));
				$item->setUserId(utf8_encode($value['user_id']));
				$item->setHasDate(utf8_encode($value['hasdate']));
				array_push($itens, $item->getJson());
			}
		}	
		changeDocumentForJsonType();
		echo json_encode($itens);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// GET EVENT BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$calendarEvents = $mysql->where('id', $id)->get('tbl_admin_calendar');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($calendarEvents){
		foreach($calendarEvents as $value){
			$calendarEvent = new calendar();
			$calendarEvent->setId(utf8_encode($value['id']));
			$calendarEvent->setTitle(utf8_encode($value['title']));
			$calendarEvent->setColor(utf8_encode($value['color']));
			$calendarEvent->setStartDate(utf8_encode($value['start_date']));
			$calendarEvent->setEndDate(utf8_encode($value['end_date']));
			$calendarEvent->setEventType(utf8_encode($value['event_type']));
			$calendarEvent->setUserId(utf8_encode($value['user_id']));
			$calendarEvent->setHasDate(utf8_encode($value['hasdate']));
		}	
		changeDocumentForJsonType();
		echo json_encode($calendarEvent->getJson());
	}	
	
}

// GET EVENT BY USER ID
function getEventsByUserId($id){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$calendarEvents = $mysql->where('user_id', $id)->get('tbl_admin_calendar');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($calendarEvents){
		foreach($calendarEvents as $value){
			$calendarEvent = new calendar();
			$calendarEvent->setId(utf8_encode($value['id']));
			$calendarEvent->setTitle(utf8_encode($value['title']));
			$calendarEvent->setColor(utf8_encode($value['color']));
			$calendarEvent->setStartDate(utf8_encode($value['start_date']));
			$calendarEvent->setEndDate(utf8_encode($value['end_date']));
			$calendarEvent->setEventType(utf8_encode($value['event_type']));
			$calendarEvent->setUserId(utf8_encode($value['user_id']));
			$calendarEvent->setHasDate(utf8_encode($value['hasdate']));
			array_push($itens, $calendarEvent->getJson());
		}	
		changeDocumentForJsonType();
		echo json_encode($itens);
	}	
	
}

// GET EVENT BY USER ID NO DATE
function getEventsByUserIdNoDate($id){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$calendarEvents = $mysql->where('user_id', $id)->and_where('hasdate', 0)->get('tbl_admin_calendar');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($calendarEvents){
		foreach($calendarEvents as $value){
			$calendarEvent = new calendar();
			$calendarEvent->setId(utf8_encode($value['id']));
			$calendarEvent->setTitle(utf8_encode($value['title']));
			$calendarEvent->setColor(utf8_encode($value['color']));
			$calendarEvent->setStartDate(utf8_encode($value['start_date']));
			$calendarEvent->setEndDate(utf8_encode($value['end_date']));
			$calendarEvent->setEventType(utf8_encode($value['event_type']));
			$calendarEvent->setUserId(utf8_encode($value['user_id']));
			$calendarEvent->setHasDate(utf8_encode($value['hasdate']));
			array_push($itens, $calendarEvent->getJson());
		}	
		changeDocumentForJsonType();
		echo json_encode($itens);
	}	
	
}

// GET EVENT BY USER ID HAS DATE
function getEventsByUserIdHasDate($id){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$calendarEvents = $mysql->where('user_id', $id)->and_where('hasdate', '1')->or_where('event_type', 1)->and_where('hasdate', '1')->get('tbl_admin_calendar');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($calendarEvents){
		foreach($calendarEvents as $value){
			$calendarEvent = new calendar();
			$calendarEvent->setId(utf8_encode($value['id']));
			$calendarEvent->setTitle(utf8_encode($value['title']));
			$calendarEvent->setColor(utf8_encode($value['color']));
			$calendarEvent->setStartDate(utf8_encode($value['start_date']));
			$calendarEvent->setEndDate(utf8_encode($value['end_date']));
			$calendarEvent->setEventType(utf8_encode($value['event_type']));
			$calendarEvent->setUserId(utf8_encode($value['user_id']));
			$calendarEvent->setHasDate(utf8_encode($value['hasdate']));
			array_push($itens, $calendarEvent->getJson());
		}	
		changeDocumentForJsonType();
		echo json_encode($itens);
	}	
	
}

// UPDATE
function update($id, $start, $end){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_admin_calendar', 
			array(
				'start_date' => $start,
				'end_date' => $end,
				'hasdate' => 1
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE
function create($newTitle, $newColor, $newEventType, $newUserid){
	include "../includes/mysql_connection.php";
	if(!$newColor){
		$color = "light-blue";
	}else{
		$color = $newColor;
	}
	try{
		$mysql->insert('tbl_admin_calendar', 
			array(
				'title' => $newTitle, 
				'color' => $color,
				'start_date' => 0,
				'end_date' => 0,
				'event_type' => $newEventType,
				'user_id' => $newUserid,
				'hasdate' => 0
			)
		);
		if($mysql){
			return $mysql->insert_id();
		}
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
		return $mysql->delete('tbl_admin_calendar');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$eventCalendarObj = new calendar();
	$eventCalendarObj->setTitle($dataForm['title']);
	$eventCalendarObj->setColor($dataForm['color']);
	$eventCalendarObj->setStartDate($dataForm['startdate']);
	$eventCalendarObj->setEndDate($dataForm['enddate']);
	$eventCalendarObj->setEventType($dataForm['eventtype']);
	$eventCalendarObj->setUserId($dataForm['userid']);
	
	if($action == "update"){
		return update($id, $eventCalendarObj);
	}else if($action == "new"){
		return create($eventCalendarObj);
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
if(isset($_POST['title'])){
	$title = $_POST['title'];
}
if(isset($_POST['color'])){
	$color = $_POST['color'];
}
if(isset($_POST['eventtype'])){
	$eventtype = $_POST['eventtype'];
}
if(isset($_POST['userid'])){
	$userid = $_POST['userid'];
}
if(isset($_POST['start'])){
	$start = $_POST['start'];
}
if(isset($_POST['end'])){
	$end = $_POST['end'];
	if($end == 0){
		$end = $_POST['start'];
	}
}

if($route){
	switch ($route) {
		case 'user':
			echo getEventsByUserId($id);
		break;
		case 'usernodate':
			echo getEventsByUserIdNoDate($id);
		break;
		case 'userhasdate':
			echo getEventsByUserIdHasDate($id);
		break;
		case 'new':
			echo create($title, $color, $eventtype, $userid);
		break;
		case 'update':
			echo update($id, $start, $end);
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