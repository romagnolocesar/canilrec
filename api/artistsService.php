<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/artist.class.php";
include "classes/track.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}

// GET ALL ARTISTS
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$artists = $mysql->get('tbl_site_artists');
		if($artists){
			foreach($artists as $value){
				$item = new artist();
				$item->setId(utf8_encode($value['id']));
				$item->setName(utf8_encode($value['name']));
				$item->setShortDescription(utf8_encode($value['shortdescription']));
				$item->setBio(utf8_encode($value['bio']));
				$item->setPicture(utf8_encode($value['picture']));
				$item->setGenre(utf8_encode($value['genre']));
				$item->setEmail(utf8_encode($value['email']));
				$item->setPhone(utf8_encode($value['phone']));
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

// GET ARTIST BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$artist = $mysql->where('id', $id)->get('tbl_site_artists');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($artist){
		foreach($artist as $value){
			$artist = new artist();
			$artist->setId(utf8_encode($value['id']));
			$artist->setName(utf8_encode($value['name']));
			$artist->setShortDescription(utf8_encode($value['shortdescription']));
			$artist->setBio(utf8_encode($value['bio']));
			$artist->setPicture(utf8_encode($value['picture']));
			$artist->setGenre(utf8_encode($value['genre']));
			$artist->setEmail(utf8_encode($value['email']));
			$artist->setPhone(utf8_encode($value['phone']));
			$artist->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($artist->getJson());
	}	
	
}

// GET TRACKS BY ARTIST ID
function getTracksByArtistId($id){
	include "../includes/mysql_connection.php";
	try{
		$tracksByArtist = $mysql->where('artist_id', $id)->get('tbl_site_aux_tracks_artists');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	$tracksItens = array();
	foreach ($tracksByArtist as $trackByArtist) {
		try{
			$trackItem = $mysql->where('id', $trackByArtist['track_id'])->get('tbl_site_tracks');
		}catch(Exception $e){
			echo 'Caught exception: ', $e->getMessage();
		}
		foreach ($trackItem as $item) {
			$track = new track();
			$track->setId(utf8_encode($item['id']));
			$track->setTitle(utf8_encode($item['title']));
			$track->setDescription(utf8_encode($item['description']));
			$track->setCover(utf8_encode($item['cover']));
			$track->setGenre(utf8_encode($item['genre']));
			$track->setStatus(utf8_encode($item['status']));
			array_push($tracksItens, $track->getJson());	
		}
		
	}
	changeDocumentForJsonType();
	echo json_encode($tracksItens);
	
}

// UPDATE
function update($id, $artistsObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->where('id', $id)->update('tbl_site_artists', 
			array(
				'name' => $artistsObj->getName(), 
				'shortdescription' => $artistsObj->getShortDescription(),
				'bio' => $artistsObj->getBio(),
				'picture' => $artistsObj->getPicture(),
				'genre' => $artistsObj->getGenre(),
				'email' => $artistsObj->getEmail(),
				'phone' => $artistsObj->getPhone(),
				'status' => $artistsObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE
function create($id, $artistsObj){
	include "../includes/mysql_connection.php";
	try{
		return $mysql->insert('tbl_site_artists', 
			array(
				'name' => $artistsObj->getName(), 
				'shortdescription' => $artistsObj->getShortDescription(),
				'bio' => $artistsObj->getBio(),
				'picture' => $artistsObj->getPicture(),
				'genre' => $artistsObj->getGenre(),
				'email' => $artistsObj->getEmail(),
				'phone' => $artistsObj->getPhone(),
				'status' => $artistsObj->getStatus()
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
		return $mysql->delete('tbl_site_artists');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$artistsObj = new artist();
	$artistsObj->setName($dataForm['name']);
	$artistsObj->setShortDescription($dataForm['shortdescription']);
	$artistsObj->setBio($dataForm['bio']);
	$artistsObj->setPicture($dataForm['picture']);
	$artistsObj->setGenre($dataForm['genre']);
	$artistsObj->setEmail($dataForm['email']);
	$artistsObj->setPhone($dataForm['phone']);
	if(isset($dataForm['status'])){ 
		$artistsObj->setStatus(1);	
	}else{ 
		$artistsObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $artistsObj);
	}else if($action == "new"){
		return create($id, $artistsObj);
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
		case 'tracks':
			if($id){
				getTracksByArtistId($id);
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