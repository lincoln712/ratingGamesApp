<?php
	class Database{
		private $host;
		private $username;
		private $password;
		private $dbname;
		
		public function connect(){
			$dsn = "mysql: host=".$this->host.";dbname=".$this->dbname;
			
			try{
				$conn = new PDO($dsn,$this->username,$this->password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			
			if($conn){
				return $conn;
			}
		}
		
		public function insertUser($conn,$user){
			$stmt = $conn->prepare("INSERT INTO users(email,password) VALUES(?,?)");
			
			if($stmt->execute([$user->getEmail(),password_hash($user->getPassword(),PASSWORD_DEFAULT)])){
				header("Location:../../views/login/login.php");
				exit();
			}else{
				echo "Something went wrong!";
			}
		}
		
		public function isEmailAlreadyRegistered($conn,$email){
			$stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
			
			$stmt->execute([$email]);
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return count($result) > 0 ? true : false;
		}
		
		public function __construct(){
			$this->host = "localhost";
			$this->username = "lincoln";
			$this->password = "mygreatpower";
			$this->dbname = "ratinggames";
		}
	}
	
