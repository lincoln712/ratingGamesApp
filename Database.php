<?php

	class Database{
		private $host;
		private $username;
		private $password;
		private $dbname;
		
		public function __construct(){
			$this->host = 'localhost';
			$this->username = 'root';
			$this->password = '';
			$this->dbname = 'ratinggames';
			
		}
		public function connect(){
			$dsn = "mysql: host=".$this->host.";dbname=".$this->dbname;
			$conn = new PDO($dsn,$this->username,$this->password);
			
			return $conn;
		}
		
		public function getAll($conn,$table){
		
			$stmt = $conn->prepare("SELECT id,title,description FROM ".$table);
			
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		}
		
		public function getSingle($id,$conn,$table){
			$stmt = $conn->prepare("SELECT *FROM ".$table." WHERE id = ?");
			$stmt->execute([$id]);
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		
		public function getAverage($conn,$id){
			$stmt = $conn->prepare("SELECT AVG(overall) as average FROM games INNER JOIN rate ON games.id = rate.game_id WHERE games.id = ?");
			
			$stmt->execute([$id]);
			$average = $stmt->fetch(PDO::FETCH_ASSOC);
			return number_format($average['average'],1);
		}
		
		public function insertRate($conn,$rate){
			$stmt = $conn->prepare("INSERT INTO rate (overall,body,game_id) VALUES (?,?,?)");
				
			if($stmt->execute([$rate->getOverall(),$rate->getBody(),$rate->getGame_id()])){
				header("Location: index.php?rated=true");
			}else{
				echo "error!";
			}
		}
	}
	
	/*$db = new Database();
	echo $db->getAverage($db->connect(),1);*/