<?php
	
	class Rate{
		private $game_id;
		private $overall;
		private $body;
		
		public function __construct($game_id,$overall,$body){
			$this->game_id = $game_id;
			$this->overall = $overall;
			$this->body = $body;
		}
		
		public function getGame_id(){
			return $this->game_id;
		}
		
		public function getOverall(){
			return $this->overall;
		}
		
		public function getBody(){
			return $this->body;
		}
	}