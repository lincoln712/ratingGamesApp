<?php
	
	class Rate{
		private $game_id;
		private $overall;
		private $body;
		private $user_id;

		public function __construct($game_id,$overall,$body,$user_id){
			$this->game_id = $game_id;
			$this->overall = $overall;
			$this->body = $body;
			$this->user_id = $user_id;
		}
		
		public function getGame_id(){
			return $this->game_id;
		}
		
		public function getUser_id(){
			return $this->user_id;
		}

		public function getOverall(){
			return $this->overall;
		}
		
		public function getBody(){
			return $this->body;
		}
	}