<?php
	class scope{	
		private $id;
		private $value;
		private $icon;
		private $title;
		private $status;

		public function getId(){
			return $this->id;
		}

		public function setId($newId){
			$this->id = $newId;
		}

		public function getValue(){
			return $this->value;
		}

		public function setValue($value){
			$this->value = $value;
		}

		public function getIcon(){
			return $this->icon;
		}
		public function setIcon($icon){
			$this->icon = $icon;
		}

		public function getTitle(){
			return $this->title;
		}

		public function setTitle($title){
			$this->title = $title;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setStatus($status){
			$this->status = $status;
		}

		public function getJson(){
			$scope = array(
				"id" 		=> $this->getId(),
				"title" 	=> $this->getTitle(), 
				"icon" 		=> $this->getIcon(),
				"value" 	=> $this->getValue(),
				"status" 	=> $this->getStatus(),
			);
			return $scope;
		}
	}
