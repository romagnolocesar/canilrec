<?php
class chatUsersHasNewMessages{
	private $id;
	private $creatorUserId;
	private $targetUserId;

	
	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
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


	public function getJson(){
		$chatMessage = array(
			"id" => $this->getId(),
			"creatoruserid" => $this->getCreatorUserId(),
			"targetuserid" => $this->getTargetUserId(),
		);
		return $chatMessage;
	}
}

