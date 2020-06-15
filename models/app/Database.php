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
		
		public function getAll($conn){
			$stmt = $conn->prepare("SELECT id,title,description,average FROM games ORDER BY(average) DESC");
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
			return number_format($average['average'],1); //this 1 means that I want to one number post the dot
		}
		
		public function insertRate($conn,$rate){
			$stmt = $conn->prepare("INSERT INTO rate (overall,body,game_id) VALUES (?,?,?)");
				
			if($stmt->execute([$rate->getOverall(),$rate->getBody(),$rate->getGame_id()]) && $this->updateAverage($conn,$rate->getGame_id())){
				echo "<script>window.location.href = '../../views/app/index.php?rated=true';</script>";
			}else{
				echo "<script>window.location.href = '../../views/app/rating.php?rated=false';</script>";
			}
		}
		
		public function updateAverage($conn,$id){
			$avg = $this->getAverage($conn,$id);
			$stmt = $conn->prepare("UPDATE games SET average = ? WHERE id = ?");
			if($stmt->execute([$avg,$id])){
				return true;
			}else{
				return false;
			}
		}
		
		public function getRatingQuantity($conn,$id){
			$stmt = $conn->prepare("SELECT COUNT(rate.game_id) as quantity FROM games INNER JOIN rate ON games.id = rate.game_id WHERE games.id = ?");
			$stmt->execute([$id]);
			
			return $stmt->fetch(PDO::FETCH_ASSOC)['quantity'];
		}
		public function getImage($conn,$id){
			$stmt = $conn->prepare("SELECT image FROM games WHERE id = ?");
			
			$stmt->execute([$id]);
			
			return $stmt->fetch(PDO::FETCH_ASSOC)['image'];
		}
	}