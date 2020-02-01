<?php
class genre{
	private $id;
	private $title;
	private $text;
	private $status;

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

	public function setText($newText){
		$this->text = $newText;
	}

	public function getText(){
		return $this->text;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$genre = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"text" => $this->getText(),
			"status" => $this->getStatus(),
		);
		return $genre;
	}

}