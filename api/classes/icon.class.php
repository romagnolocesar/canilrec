<?php
	class icon{
		private $code;
		private $title;
		private $text;

		// CODE
		public function setCode($newCode){
			$this->code = $newCode;
			switch ($newCode) {
				case 'UE08E':
					$this->setTitle("Music Note");
					$this->setText("");
					break;
				case 'UE08B':
					$this->setTitle("Two Persons");
					$this->setText("");
					break;
				case 'UE00A':
					$this->setTitle("Atom");
					$this->setText("");
					break;
				case 'UE04E':
					$this->setTitle("Round Play");
					$this->setText("");
					break;
				case 'UE027':
					$this->setTitle("Headphone");
					$this->setText("");
					break;
				case 'UE024':
					$this->setTitle("Movie Tape");
					$this->setText("");
					break;
				case 'UE059':
					$this->setTitle("TwoFiles");
					$this->setText("");
					break;
				case 'UE0E6':
					$this->setTitle("File List");
					$this->setText("");
					break;
				case 'UE0DB':
					$this->setTitle("Pen Pencil");
					$this->setText("");
					break;
				case 'UE0EC':
					$this->setTitle("Graph");
					$this->setText("");
					break;
				case 'UE0F9':
					$this->setTitle("ChainSaw");
					$this->setText("");
					break;
				case 'UE007':
					$this->setTitle("Lamp");
					$this->setText("");
					break;
				case 'UE01B':
					$this->setTitle("Mic");
					$this->setText("");
					break;
				case 'UE033':
					$this->setTitle("Star");
					$this->setText("");
					break;
				case 'UE0F5':
					$this->setTitle("Target");
					$this->setText("");
					break;
				case 'UE0A0':
					$this->setTitle("Conection");
					$this->setText("");
					break;
				case 'UE0C1':
					$this->setTitle("Facebook");
					$this->setText("");
					break;
				case 'UE09A':
					$this->setTitle("Instagram");
					$this->setText("");
					break;
				case 'UE0A3':
					$this->setTitle("Youtube");
					$this->setText("");
					break;
				case 'UE002':
					$this->setTitle("SoundCloud");
					$this->setText("");
					break;

				default:
					$this->setTitle("Undefined");
					$this->setText("?");
					break;
			}

		}

		private function getCode(){
			return $this->code;
		}

		// TITLE
		private function setTitle($newtitle){
			$this->title = $newtitle;
		}

		private function getTitle(){
			return $this->title;
		}

		// TEXT
		private function setText($newtext){
			$this->text = $newtext;
		}

		public function getText(){
			return $this->text;
		}	
	}