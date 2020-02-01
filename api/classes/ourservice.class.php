<?php

class ourService{
	private $id;
	private $title;
	private $text;
	private $button;
	private $icon;
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

	public function setButton($newButton){
		$this->button = $newButton;
	}

	public function getButton(){
		return $this->button;
	}

	public function setIcon($newIcon){
		$this->icon = $newIcon;
	}

	public function getIcon(){
		return $this->icon;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$ourService = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"text" => $this->getText(),
			"button" => $this->getButton(),
			"icon" => $this->getIcon(),
			"status" => $this->getStatus(),
		);
		return $ourService;
	}
}