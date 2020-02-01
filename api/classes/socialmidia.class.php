<?php
class socialmidia{
	private $id;
	private $title;
	private $icon;
	private $link;
	private $status;

	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitle($newtitle){
		$this->title= $newtitle;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setIcon($newicon){
		$this->icon= $newicon;
	}

	public function getIcon(){
		return $this->icon;
	}

	public function setLInk($newlink){
		$this->link= $newlink;
	}

	public function getLink(){
		return $this->link;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$socialmidia = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"icon" => $this->getIcon(),
			"link" => $this->getLink(),
			"status" => $this->getStatus(),
		);
		return $socialmidia;
	}
}