	<?php
	require("../../models/app/Database.php");
	require("../../models/app/Rate.php");
	
	if(isset($_POST['submit'])){
		if($_POST['rate'] > 0){
			$db = new Database();
			
			$overall = htmlentities($_POST['rate']);
			$body = htmlentities($_POST['body']);
			$game_id = htmlentities($_POST['game_id']);
			$user_id = htmlentities($_POST['user_id']);

			$db->insertRate($db->connect(),new Rate($game_id,$overall,$body,$user_id));
		}else{
			//echo "Error!";
			header("Location:../../views/app/rating.php?id=".$_POST['game_id']."?rated=false");
		}
	}