<?php
class contactmsg{
	private $id;
	private $name;
	private $mail;
	private $msg;
	private $date;
	private $checked;

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

	public function setMail($newMail){
		$this->mail = $newMail;
	}

	public function getMail(){
		return $this->mail;
	}

	public function setMsg($newMsg){
		$this->msg = $newMsg;
	}

	public function getMsg(){
		return $this->msg;
	}

	public function setDate($newDate){
		$this->date = $newDate;
	}

	public function getDate(){
		return $this->date;
	}

	public function setchecked($newChecked){
		$this->checked = $newChecked;
	}

	public function getChecked(){
		return $this->checked;
	}

	public function getJson(){
		$contactmsg = array(
			"id" => $this->getId(),
			"name" => $this->getName(),
			"mail" => $this->getMail(),
			"msg" => $this->getMsg(),
			"date" => $this->getDate(),
			"checked" => $this->getChecked()
		);
		return $contactmsg;
	}
}

