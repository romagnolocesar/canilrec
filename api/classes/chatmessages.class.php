<?php
class chatMessage{
	private $id;
	private $msg;
	private $creatorUserId;
	private $targetUserId;
	private $date;

	
	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setMsg($newMsg){
		$this->msg = $newMsg;
	}

	public function getMsg(){
		return $this->msg;
	}

	public function setCreatorUserId($newCreatorUserId){
		$this->creatorUserId = $newCreatorUserId;
	}

	public function getCreatorUserId(){
		return $this->creatorUserId;
	}

	public function setTargetUserId($newTargetUserId){
		$this->targetUserId = $newTargetUserId;
	}

	public function getTargetUserId(){
		return $this->targetUserId;
	}

	public function setDate($newDate){
		$this->date = $newDate;
	}

	public function getDate(){
		return $this->date;
	}

	public function getJson(){
		$chatMessage = array(
			"id" => $this->getId(),
			"msg" => $this->getMsg(),
			"creatoruserid" => $this->getCreatorUserId(),
			"targetuserid" => $this->getTargetUserId(),
			"date" => $this->getDate()
		);
		return $chatMessage;
	}
}

