<?php
	if(isset($_POST['submit'])){
		require('../../models/login/database/Database.php');
		require('../../models/login/HLO.php');
		require('../../models/login/User.php');
		
		$db = new Database();
		$data = new HLO($db->connect());
		$user = new User($_POST['email'],$_POST['password']);
		
		if(!$data->isRegistered($user)){
			header("Location:loginfailed/emailorpasswordincorrect=true");
			exit();
		}else{
			session_start();
			$_SESSION['authorized'] = true;
			$_SESSION['username'] = $user->getEmail();
			header("Location:home");
			exit();
		}	
	}