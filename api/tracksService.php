<?php
include "../config/globals.php";
include "classes/helpers/mysql.class.php";

include "classes/track.class.php";
include "classes/artist.class.php";

// UTILITIES
function changeDocumentForJsonType(){
	header("Content-Type:application/json; charset=UTF-8");	
}


// GET ALL TRACKS
function getAll(){
	$itens = array(); 
	include "../includes/mysql_connection.php";
	try{
		$tracks = $mysql->get('tbl_site_tracks');
		if($tracks){
			foreach($tracks as $value){
				$item = new track();
				$item->setId(utf8_encode($value['id']));
				$item->setTitle(utf8_encode($value['title']));
				$item->setDescription(utf8_encode($value['description']));
				$item->setCover(utf8_encode($value['cover']));
				$item->setGenre(utf8_encode($value['genre']));
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

// GET TRACK BY ID
function getById($id){
	include "../includes/mysql_connection.php";
	try{
		$track = $mysql->where('id', $id)->get('tbl_site_tracks');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	if($track){
		foreach($track as $value){
			$track = new track();
			$track->setId(utf8_encode($value['id']));
			$track->setTitle(utf8_encode($value['title']));
			$track->setDescription(utf8_encode($value['description']));
			$track->setCover(utf8_encode($value['cover']));
			$track->setGenre(utf8_encode($value['genre']));
			$track->setStatus(utf8_encode($value['status']));
		}	
		changeDocumentForJsonType();
		echo json_encode($track->getJson());
	}	
	
}

// GET ARTISTS BY TRACK ID
function getTracksByArtistId($id){
	include "../includes/mysql_connection.php";
	try{
		$artistsByTrack = $mysql->where('track_id', $id)->get('tbl_site_aux_tracks_artists');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	$artistsItens = array();
	foreach ($artistsByTrack as $artistByTrack) {
		try{
			$artistItem = $mysql->where('id', $artistByTrack['artist_id'])->get('tbl_site_artists');
		}catch(Exception $e){
			echo 'Caught exception: ', $e->getMessage();
		}
		foreach ($artistItem as $item) {
			$artist = new artist();
			$artist->setId(utf8_encode($item['id']));
			$artist->setName(utf8_encode($item['name']));
			$artist->setShortDescription(utf8_encode($item['shortdescription']));
			$artist->setBio(utf8_encode($item['bio']));
			$artist->setPicture(utf8_encode($item['picture']));
			$artist->setGenre(utf8_encode($item['genre']));
			$artist->setEmail(utf8_encode($item['email']));
			$artist->setPhone(utf8_encode($item['phone']));
			$artist->setStatus(utf8_encode($item['status']));
			array_push($artistsItens, $artist->getJson());	
		}
		
	}
	changeDocumentForJsonType();
	echo json_encode($artistsItens);
	
}

// UPDATE
function update($id, $tracksObj){
	include "../includes/mysql_connection.php";
	try{
		deleteRelationTrackWithArtists($id);
		createRelationTrackWithArtists($id, $tracksObj->getArtists());
		return $mysql->where('id', $id)->update('tbl_site_tracks', 
			array(
				'title' => $tracksObj->getTitle(), 
				'description' => $tracksObj->getDescription(),
				'cover' => $tracksObj->getCover(),
				'genre' => $tracksObj->getGenre(),
				'status' => $tracksObj->getStatus()
			)
		);
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE
function create($id, $tracksObj){
	include "../includes/mysql_connection.php";
	try{
		$mysql->insert('tbl_site_tracks', 
			array(
				'title' => $tracksObj->getTitle(), 
				'description' => $tracksObj->getDescription(),
				'cover' => $tracksObj->getCover(),
				'genre' => $tracksObj->getGenre(),
				'status' => $tracksObj->getStatus()
			)
		);
		return createRelationTrackWithArtists($mysql->insert_id(), $tracksObj->getArtists());
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// CREATE RELATION TRACK WITH ARTISTS
function createRelationTrackWithArtists($trackid, $artistsIds){
	include "../includes/mysql_connection.php";
	try{
		foreach($artistsIds as $artist){
			$mysql->insert('tbl_site_aux_tracks_artists', 
				array(
					'artist_id' => $artist, 
					'track_id' => $trackid,
				)
			);
		}
		return "1";
		
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
		deleteRelationTrackWithArtists($ids);
		return $mysql->delete('tbl_site_tracks');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

// DELETE RELATION TRACK ARTIST
function deleteRelationTrackWithArtists($trackIds){
	include "../includes/mysql_connection.php";
	try{
		if(is_array($trackIds)){
			foreach ($trackIds as $key => $trackId) {
				if($key == 0){
					$mysql->where('track_id', $trackId);
				}else{
					$mysql->or_where('track_id', $trackId);
				}
				
			}	
		}else{
			$mysql->where('track_id', $trackIds);
		}
		
		return $mysql->delete('tbl_site_aux_tracks_artists');
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
}

//MISC
function mountObjectFromDataForm($id, $dataForm, $action){
	$tracksObj = new track();
	$tracksObj->setTitle($dataForm['title']);
	$tracksObj->setDescription($dataForm['description']);
	$tracksObj->setCover($dataForm['cover']);
	$tracksObj->setGenre($dataForm['genre']);

	if($dataForm['artists']){
		$tracksObj->setArtists(explode(",", $dataForm['artists']));	
	}
	
	if(isset($dataForm['status'])){ 
		$tracksObj->setStatus(1);	
	}else{ 
		$tracksObj->setStatus(0);	
	}
	
	if($action == "update"){
		return update($id, $tracksObj);
	}else if($action == "new"){
		return create($id, $tracksObj);
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

if(isset($_GET['route'])){
	$route = $_GET['route'];
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
}

if($route){
	switch ($route) {
		case 'artists':
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