<?php
class mail{
	private $id;
	private $subject;
	private $msg;
	private $creatorUserId;
	private $targetUserId;
	private $date;
	private $viewed;
	private $msgGroupId;
	private $ownerUserId;
	private $asked;

	
	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setSubject($newSubject){
		$this->subject = $newSubject;
	}

	public function getSubject(){
		return $this->subject;
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

	public function setViewed($newViewed){
		$this->viewed = $newViewed;
	}

	public function getViewed(){
		return $this->viewed;
	}

	public function setMsgGroupId($newMsgGroupId){
		$this->msgGroupId = $newMsgGroupId;
	}

	public function getMsgGroupId(){
		return $this->msgGroupId;
	}

	public function setOwnerUserId($newOwnerUserId){
		$this->ownerUserId = $newOwnerUserId;
	}

	public function getOwnerUserId(){
		return $this->ownerUserId;
	}

	public function setAsked($newAsked){
		$this->asked = $newAsked;
	}

	public function getAsked(){
		return $this->asked;
	}

	public function getJson(){
		$contactmsg = array(
			"id" => $this->getId(),
			"subject" => $this->getSubject(),
			"msg" => $this->getMsg(),
			"creatoruserid" => $this->getCreatorUserId(),
			"targetuserid" => $this->getTargetUserId(),
			"date" => $this->getDate(),
			"viewed" => $this->getViewed(),
			"msggroupid" => $this->getMsgGroupId(),
			"owneruserid" => $this->getOwnerUserId(),
			"asked" => $this->getAsked()
		);
		return $contactmsg;
	}
}

