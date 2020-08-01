<?php
class track{
	private $id;
	private $title;
	private $description;
	private $cover;
	private $audio;
	private $genre;
	private $status;
	private $artists = array();

	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitle($newTitle){
		$this->title = $newTitle;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setDescription($newDescription){
		$this->description = $newDescription;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setCover($newCover){
		$this->cover = $newCover;
	}

	public function getCover(){
		return $this->cover;
	}

	public function setAudio($newAudio){
		$this->audio = $newAudio;
	}

	public function getAudio(){
		return $this->audio;
	}

	public function setGenre($newGenre){
		$this->genre = $newGenre;
	}

	public function getGenre(){
		return $this->genre;
	}

	public function setArtists($newArtists){
		$this->artists = $newArtists;
	}

	public function getArtists(){
		return $this->artists;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$track = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"description" => $this->getDescription(),
			"cover" => $this->getCover(),
			"audio" => $this->getAudio(),
			"genre" => $this->getGenre(),
			"artists" => $this->getArtists(),
			"status" => $this->getStatus(),
		);
		return $track;
	}
}