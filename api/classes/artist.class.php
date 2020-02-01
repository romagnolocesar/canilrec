<?php
class artist{
	private $id;
	private $name;
	private $shortDescription;
	private $bio;
	private $picture;
	private $genre;
	private $email;
	private $phone;
	private $status;

	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setName($newName){
		$this->name = $newName;
	}

	public function getName(){
		return $this->name;
	}

	public function setShortDescription($newShortDescription){
		$this->shortDescription = $newShortDescription;
	}

	public function getShortDescription(){
		return $this->shortDescription;
	}

	public function setBio($newBio){
		$this->bio = $newBio;
	}

	public function getBio(){
		return $this->bio;
	}

	public function setPicture($newPicture){
		$this->picture = $newPicture;
	}

	public function getPicture(){
		return $this->picture;
	}

	public function setGenre($newGenre){
		$this->genre = $newGenre;
	}

	public function getGenre(){
		return $this->genre;
	}

	public function setEmail($newEmail){
		$this->email = $newEmail;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setPhone($newPhone){
		$this->phone = $newPhone;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$artist = array(
			"id" => $this->getId(),
			"name" => $this->getName(),
			"shortdescription" => $this->getShortDescription(),
			"bio" => $this->getBio(),
			"picture" => $this->getPicture(),
			"genre" => $this->getGenre(),
			"email" => $this->getEmail(),
			"phone" => $this->getPhone(),
			"status" => $this->getStatus(),
		);
		return $artist;
	}
}