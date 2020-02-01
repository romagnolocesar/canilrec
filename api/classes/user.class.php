<?php
class user{
	private $id;
	private $name;
	private $lastname;
	private $email;
	private $login;
	private $password;
	private $picture;
	private $usertypeid;
	private $online;
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

	public function setLastname($newLastname){
		$this->lastname = $newLastname;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function setEmail($newEmail){
		$this->email = $newEmail;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setLogin($newLogin){
		$this->login = $newLogin;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setPassword($newPassword){
		$this->password = $newPassword;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPicture($newPicture){
		$this->picture = $newPicture;
	}

	public function getPicture(){
		return $this->picture;
	}

	public function setUserTypeId($newUserTypeId){
		$this->usertypeid = $newUserTypeId;
	}

	public function getUserTypeId(){
		return $this->usertypeid;
	}

	public function setOnline($newOnline){
		$this->Online = $newOnline;
	}

	public function getOnline(){
		return $this->Online;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	

	public function getJson(){
		$users = array(
			"id" => $this->getId(),
			"name" => $this->getName(),
			"lastname" => $this->getLastname(),
			"email" => $this->getEmail(),
			"login" => $this->getLogin(),
			"password" => $this->getPassword(),
			"picture" => $this->getPicture(),
			"usertypeid" => $this->getUserTypeId(),
			"online" => $this->getOnline(),
			"status" => $this->getStatus(),
		);
		return $users;
	}
}