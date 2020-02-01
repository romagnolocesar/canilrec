<?php
class calendar{
	private $id;
	private $title;
	private $color;
	private $startdate;
	private $enddate;
	private $eventtype;
	private $userid;
	private $hasdate;

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

	public function setColor($newColor){
		$this->color = $newColor;
	}

	public function getColor(){
		return $this->color;
	}

	public function setStartDate($newStartDate){
		$this->startdate = $newStartDate;
	}

	public function getStartDate(){
		return $this->startdate;
	}

	public function setEndDate($newEndDate){
		$this->enddate = $newEndDate;
	}

	public function getEndDate(){
		return $this->enddate;
	}


	public function setEventType($newEventType){
		$this->eventtype = $newEventType;
	}

	public function getEventType(){
		return $this->eventtype;
	}

	public function setUserId($newUserId){
		$this->userid = $newUserId;
	}

	public function getUserId(){
		return $this->userid;
	}

	public function setHasDate($newHasDate){
		$this->hasdate = $newHasDate;
	}

	public function getHasDate(){
		return $this->hasdate;
	}

	public function getJson(){
		$calendarEvents = array(
			"id" => $this->getId(),
			"title" => $this->getTitle(),
			"color" => $this->getColor(),
			"startdate" => $this->getStartDate(),
			"enddate" => $this->getEndDate(),
			"eventtype" => $this->getEventType(),
			"userid" => $this->getUserId(),
			"hasdate" => $this->getHasDate(),
		);
		return $calendarEvents;
	}
}