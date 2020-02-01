<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/section.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL SECTIONS
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$sections = $mysql->get('tbl_site_sections');
		if($sections){
			foreach($sections as $value){
				$item = new section();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle1(utf8_encode($value['title1']));
				$item->setTitle2(utf8_encode($value['title2']));
				$item->setShowTitles(utf8_encode($value['showtitles']));
				$item->setDescription(utf8_encode($value['description']));
				$item->setFilename(utf8_encode($value['filename']));
				$item->setHasshape(utf8_encode($value['hasshape']));
				$item->setShapeicon(utf8_encode($value['shapeicon']));
				$item->setCssFile(utf8_encode($value['cssfile']));
				$item->setCssid(utf8_encode($value['cssid']));
				$item->setFullhtml(utf8_encode($value['fullhtml']));
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

// GET SECTION BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$section = $mysql->where('id', $id)->get('tbl_site_sections');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($section){
		foreach($section as $value){
			$section = new section();
			$section->setId(utf8_encode($value['id']));
			$section->setTitle1(utf8_encode($value['title1']));
			$section->setTitle2(utf8_encode($value['title2']));
			$section->setShowTitles(utf8_encode($value['showtitles']));
			$section->setDescription(utf8_encode($value['description']));
			$section->setFilename(utf8_encode($value['filename']));
			$section->setHasshape(utf8_encode($value['hasshape']));
			$section->setShapeicon(utf8_encode($value['shapeicon']));
			$section->setCssFile(utf8_encode($value['cssfile']));
			$section->setCssid(utf8_encode($value['cssid']));
			$section->setFullhtml(utf8_encode($value['fullhtml']));
			$section->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($section->getJson());
	}	
	
}

// UPDATE
function update($id, $sectionsObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_sections', 
			array(
				'title1' => $sectionsObj->getTitle1(), 
				'title2' => $sectionsObj->getTitle2(),
				'showtitles' =>	$sectionsObj->getShowTitles(),
				'description' => $sectionsObj->getDescription(),
				'filename' => $sectionsObj->getFilename(),
				'hasshape' => $sectionsObj->getHasshape(),
				'shapeicon' => $sectionsObj->getShapeicon(),
				'cssfile' => $sectionsObj->getCssFile(),
				'cssid' => $sectionsObj->getCssid(),
				'fullhtml' => $sectionsObj->getFullhtml(),
				'status' => $sectionsObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

function create($id, $sectionsObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_sections', 
			array(
				'title1' => $sectionsObj->getTitle1(), 
				'title2' => $sectionsObj->getTitle2(), 
				'showtitles' => $sectionsObj->getShowTitles(), 
				'description' => $sectionsObj->getDescription(), 
				'filename' => $sectionsObj->getFilename(), 
				'hasshape' => $sectionsObj->getHasshape(), 
				'shapeicon' => $sectionsObj->getShapeicon(),
				'cssfile' => $sectionsObj->getCssFile(),
				'cssid' => $sectionsObj->getCssid(),
				'fullhtml' => $sectionsObj->getFullhtml(),
				'status' => $sectionsObj->getStatus()
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
		return $mysql->delete('tbl_site_sections');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$sectionsObj = new section();
	$sectionsObj->setTitle1($dataForm['title1']);
	$sectionsObj->setTitle2($dataForm['title2']);
	if(isset($dataForm['showtitles'])){ 
		$sectionsObj->setShowTitles(1);	
	}else{ 
		$sectionsObj->setShowTitles(0);	
	}
	$sectionsObj->setDescription($dataForm['description']);
	$sectionsObj->setFilename($dataForm['filename']);
	if(isset($dataForm['hasshape'])){ 
		$sectionsObj->setHasshape(1);	
	}else{ 
		$sectionsObj->setHasshape(0);	
	}
	$sectionsObj->setShapeicon($dataForm['shapeicon']);
	$sectionsObj->setCssFile($dataForm['cssfile']);
	$sectionsObj->setCssid($dataForm['cssid']);
	$sectionsObj->setFullhtml($dataForm['fullhtml']);
	if(isset($dataForm['status'])){ 
		$sectionsObj->setStatus(1);	
	}else{ 
		$sectionsObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $sectionsObj);
	}else if($action == "new"){
		return create($id, $sectionsObj);
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

