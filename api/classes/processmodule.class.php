<?php
class processmodule{
	private $id;
	private $title;
	private $subtitle;
	private $icon;
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

	public function setSubTitle($newSubTitle){
		$this->subtitle = $newSubTitle;
	}

	public function getSubTitle(){
		return $this->subtitle;
	}

	public function setIcon($newIcon){
		$this->icon = $newIcon;
	}

	public function getIcon(){
		return $this->icon;
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
		$processmodule = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"subtitle" => $this->getSubTitle(),
			"icon" => $this->getIcon(),
			"text" => $this->getText(),
			"status" => $this->getStatus(),
		);
		return $processmodule;
	}

}