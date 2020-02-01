<?php
class section{
	private $id;
	private $title1;
	private $title2;
	private $showtitles;
	private $description;
	private $filename;
	private $hasshape;
	private $shapeicon;
	private $cssfile;
	private $cssid;
	private $fullhtml;
	private $weigth;
	private $status;

	public function setId($newId){
		$this->id = $newId;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitle1($newTitle1){
		$this->title1 = $newTitle1;
	}

	public function getTitle1(){
		return $this->title1;
	}

	public function setTitle2($newTitle2){
		$this->title2 = $newTitle2;
	}

	public function getTitle2(){
		return $this->title2;
	}

	public function setShowTitles($newShowTitles){
		$this->showtitles = $newShowTitles;
	}

	public function getShowTitles(){
		return $this->showtitles;
	}

	public function setDescription($newDescription){
		$this->description = $newDescription;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setFilename($newFilename){
		$this->filename = $newFilename;
	}

	public function getFilename(){
		return $this->filename;
	}

	public function setHasshape($newHasshape){
		$this->hasshape = $newHasshape;
	}

	public function getHasshape(){
		return $this->hasshape;
	}

	public function setShapeicon($newShapeicon){
		$this->shapeicon = $newShapeicon;
	}

	public function getShapeicon(){
		return $this->shapeicon;
	}

	public function setCssFile($newCssFile){
		$this->cssfile = $newCssFile;
	}

	public function getCssFile(){
		return $this->cssfile;
	}

	public function setCssid($newCssid){
		$this->cssid = $newCssid;
	}

	public function getCssid(){
		return $this->cssid;
	}

	public function setFullhtml($newFullhtml){
		$this->fullhtml = $newFullhtml;
	}

	public function getFullhtml(){
		return $this->fullhtml;
	}

	public function setWeigth($newWeigth){
		$this->weigth = $newWeigth;
	}

	public function getWeigth(){
		return $this->weigth;
	}

	public function setStatus($newStatus){
		$this->status = $newStatus;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getJson(){
		$section = array(
			"id" => $this->getId(),
			"title1" => $this->getTitle1(),
			"title2" => $this->getTitle2(),
			"showtitles" => $this->getShowTitles(),
			"description" => $this->getDescription(),
			"filename" => $this->getFilename(),
			"hasshape" => $this->getHasshape(),
			"shapeicon" => $this->getShapeicon(),
			"cssfile" => $this->getCssFile(),
			"cssid" => $this->getCssid(),
			"fullhtml" => $this->getFullhtml(),
			"weigth" => $this->getWeigth(),
			"status" => $this->getStatus(),
		);
		return $section;
	}
}