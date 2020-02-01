<?php
class usertype{
	private $id;
	private $type;
	private $description;
	private $status;

	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setType($newType){
		$this->type = $newType;
	}

	public function getType(){
		return $this->type;
	}

	public function setDescription($newDescription){
		$this->description = $newDescription;
	}

	public function getDescription(){
		return $this->description;
	}
	
	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$usertype = array(
			"id" => $this->getId(),
			"type" => $this->getType(),
			"description" => $this->getDescription(),
			"status" => $this->getStatus(),
		);
		return $usertype;
	}
}