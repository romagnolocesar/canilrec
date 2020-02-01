<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/page.class.php";
include "classes/section.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL PAGES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$pages = $mysql->get('tbl_site_pages');
		if($pages){
			foreach($pages as $value){
				$item = new page();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->setLink(utf8_encode($value['link']));
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
		$pages = $mysql->where('id', $id)->get('tbl_site_pages');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($pages){
		foreach($pages as $value){
			$page = new page();
			$page->setId(utf8_encode($value['id']));
			$page->setTitle(utf8_encode($value['title']));
			$page->setLink(utf8_encode($value['link']));
			$page->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($page->getJson());
	}	
	
}

function getByLink($link){
	$itens = array();  
	include "../includes/conect_db.php";
	$query = "SELECT * FROM tbl_site_pages WHERE LINK = ".$link;
	$result = mysqli_query($conection, $query);
	$row = mysqli_fetch_row($result);
	if($row){
		$item = new page();
		$item->setId(utf8_encode($row[0]));
		$item->setTitle(utf8_encode($row[1]));
		$item->setLink(utf8_encode($row[2]));
		$item->setStatus(utf8_encode($row[3]));
		array_push($itens, $item->getJson());	
	}
	
	echo json_encode($itens);
}

// GET SECTIONS BY PAGE ID
function getSectionsByPageId($id){
	include "../includes/mysql_connection.php";
	try{
		$sectionsByPage = $mysql->where('page_id', $id)->order_by('weigth', 'ASC')->get('tbl_site_aux_pages_sections');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	$sectionsItens = array();
	if($sectionsByPage){
		foreach ($sectionsByPage as $sectionByPage) {
			try{
				$sectionItem = $mysql->where('id', $sectionByPage['section_id'])->get('tbl_site_sections');
			}catch(Exception $e){
				echo 'Caught exception: ', $e->getMessage();
			}
			foreach ($sectionItem as $item) {
				$section = new section();
				$section->setId(utf8_encode($item['id']));
				$section->setTitle1(utf8_encode($item['title1']));
				$section->setTitle2(utf8_encode($item['title2']));
				$section->setShowTitles(utf8_encode($item['showtitles']));
				$section->setDescription(utf8_encode($item['description']));
				$section->setFilename(utf8_encode($item['filename']));
				$section->setHasshape(utf8_encode($item['hasshape']));
				$section->setShapeicon(utf8_encode($item['shapeicon']));
				$section->setCssFile(utf8_encode($item['cssfile']));
				$section->setCssid(utf8_encode($item['cssid']));
				$section->setFullhtml(utf8_encode($item['fullhtml']));
				$section->setWeigth(utf8_encode($sectionByPage['weigth']));
				$section->setStatus(utf8_encode($item['status']));
				array_push($sectionsItens, $section->getJson());	
			}
			
		}	
	}
	
	changeDocumentForJsonType();
	return json_encode($sectionsItens);
	
}

//DELETE ALL SECTIONS RELATIONS BY PAGE ID
function deleteAllSectionsRelationsByPageId($pagesObj){	
	include "../includes/mysql_connection.php";
	$hasError = FALSE;
	include "../includes/mysql_connection.php";	
	try{
		$currentSections = getSectionsByPageId($pagesObj->getId());
		if($currentSections){
			$result = $mysql->where('page_id', $pagesObj->getId())->delete('tbl_site_aux_pages_sections');
			if($result){
				$return;
				$pagesObj->getSections() ? $return = createRelationsForPages($pagesObj) : $return = !$hasError;
				return $return;
			}else{
				return !$hasError;
			}
		}else if($pagesObj->getSections()){
			$return = createRelationsForPages($pagesObj);
			return $return;
				
		}else{
			return $hasError;	
		}
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//CREATE ALL RELATIONS SECTION FOR PAGES
function createRelationsForPages($pagesObj){
	include "../includes/mysql_connection.php";
	$hasError = FALSE;
	try{
		if($pagesObj->getSections()){
			foreach ($pagesObj->getSections() as $key => $value) {
				$result = $mysql->insert('tbl_site_aux_pages_sections', 
					array(
						'page_id' => $pagesObj->getId(), 
						'section_id' => $value,
						'weigth' => $key+1,
						'status' => 1
					)
				);
				if(!$result){
					$hasError = TRUE;
					break;
				}
			}
		}
		return !$hasError;	
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}

}

// UPDATE
function update($id, $pagesObj){
	include "../includes/mysql_connection.php";
	$hasError = FALSE;
	try{
		$hasError = !deleteAllSectionsRelationsByPageId($pagesObj);
		if(!$hasError){
			try{
				return $mysql->where('id', $id)->update('tbl_site_pages', 
					array(
						'title' => $pagesObj->getTitle(), 
						'link' => $pagesObj->getLink(),
						'status' => $pagesObj->getStatus()
					)
				);
			}catch(Exception $e){
				echo 'Caught exception: ', $e->getMessage();
			}	
		}
		
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

function create($id, $pagesObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_pages', 
			array(
				'title' => $pagesObj->getTitle(), 
				'link' => $pagesObj->getLink(),
				'status' => $pagesObj->getStatus()
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
			$pagesObj = new page();
			$pagesObj->setId($id);
			deleteAllSectionsRelationsByPageId($pagesObj);	
		}
		
		return $mysql->delete('tbl_site_pages');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$pagesObj = new page();
	$pagesObj->setId($id);
	$pagesObj->setTitle($dataForm['title']);
	$pagesObj->setLink($dataForm['link']);
	if(isset($dataForm['status'])){ 
		$pagesObj->setStatus(1);	
	}else{ 
		$pagesObj->setStatus(0);	
	}

	if(isset($dataForm['sections'])){ 
		$array = array();
		if($dataForm['sections'] != "" && $dataForm['sections'] != NULL){
			$array = explode(',', $dataForm['sections']);
			$pagesObj->setSections($array);
		}else{
			$array = NULL;
		}
	}

	if($action == "update"){
		return update($id, $pagesObj);
	}else if($action == "new"){
		return create($id, $pagesObj);
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
		case 'sections':
			if($id){
				echo getSectionsByPageId($id);
			}
		break;
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


