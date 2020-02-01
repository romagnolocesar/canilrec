<?php
class page{
	private $id;
	private $title;
	private $link;
	private $sections = NULL;
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

	public function setLink($newLink){
		$this->link = $newLink;
	}

	public function getLink(){
		return $this->link;
	}

	public function setSections($newSections){
		$this->sections = $newSections;
	}

	public function getSections(){
		return $this->sections;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$page = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"link" => $this->getLink(),
			"sections" => $this->getSections(),
			"status" => $this->getStatus(),
		);
		return $page;
	}
}