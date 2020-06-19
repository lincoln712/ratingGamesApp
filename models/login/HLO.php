<?php
	//HLO means handle with login operations
	class HLO{
		private $conn;
		
		public function __construct($db){
			$this->conn = $db;
		}
		
		public function isEmailRegistered($email){
			$stmt = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
			$stmt->execute([$email]);
			
			return count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0 ? true : false;
		}
		
		public function getPassword($email){
			$stmt = $this->conn->prepare("SELECT password FROM users WHERE email = ?");
			$stmt->execute([$email]);
			return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password'];
		}
		
		public function passwordMatches($user){
			$hashed = $this->getPassword($user->getEmail());
			
			return password_verify($user->getPassword(),$hashed);
		}
			
		public function isRegistered($user){
			if($this->isEmailRegistered($user->getEmail()) && $this->passwordMatches($user)){
				return true;
			}else{
				return false;
			}
		}
	}
	