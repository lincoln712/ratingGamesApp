<?php
	
	if(isset($_POST['submit'])){
		if($_POST['rate'] > 0){
			//echo "saving on the database!";
			$host = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ratinggames";
			
			$dsn = "mysql: host=".$host.";dbname=".$dbname;
			
			$conn = new PDO($dsn,$username,$password);
				
			$stmt = $conn->prepare("INSERT INTO rate (overall,body) VALUES(?,?)");
			if($stmt->execute([$_POST['rate'],$_POST['body']])){
				header("Location: index.php?rated=true");
			}else{
				echo "failed!";
			}
			
			//echo "Okay!";
		}else{
			echo "Rate lesser than 1";
		}
	}