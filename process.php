<?php
	require("Database.php");
	require("Rate.php");
	
	if(isset($_POST['submit'])){
		if($_POST['rate'] > 0){
			$db = new Database();
			
			$overall = htmlentities($_POST['rate']);
			$body = htmlentities($_POST['body']);
			$game_id = htmlentities($_POST['game_id']);
			
			$db->insertRate($db->connect(),new Rate($game_id,$overall,$body));

		}else{
			//echo "Error!";
			header("Location: rating.php?id=".$_POST['game_id']."?rated=false");
		}
	}