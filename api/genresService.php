<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/genre.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}


// GET ALL GENRES
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$genres = $mysql->get('tbl_site_genres');
		if($genres){
			foreach($genres as $value){
				$item = new genre();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->setText(utf8_encode($value['text']));
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

// GET GENRE BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$genres = $mysql->where('id', $id)->get('tbl_site_genres');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($genres){
		foreach($genres as $value){
			$genre = new genre();
			$genre->setId(utf8_encode($value['id']));
			$genre->setTitle(utf8_encode($value['title']));
			$genre->setText(utf8_encode($value['text']));
			$genre->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($genre->getJson());
	}	
	
}

// UPDATE
function update($id, $genresObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_genres', 
			array(
				'title' => $genresObj->getTitle(), 
				'text' => $genresObj->getText(),
				'status' => $genresObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

function create($id, $genresObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_genres', 
			array(
				'title' => $genresObj->getTitle(), 
				'text' => $genresObj->getText(),
				'status' => $genresObj->getStatus()
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
		return $mysql->delete('tbl_site_genres');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$genresObj = new genre();
	$genresObj->setTitle($dataForm['title']);
	$genresObj->setText($dataForm['text']);
	if(isset($dataForm['status'])){ 
		$genresObj->setStatus(1);	
	}else{ 
		$genresObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $genresObj);
	}else if($action == "new"){
		return create($id, $genresObj);
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

