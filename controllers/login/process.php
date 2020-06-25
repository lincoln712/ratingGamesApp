<?php
	if(isset($_POST['submit'])){
		
		$email = htmlentities($_POST['email']);
		$password = htmlentities($_POST['password']);
		$passwordagain = htmlentities($_POST['passwordagain']);
		$errors = '';

		if($password !== $passwordagain){
			$errors .= "passworddoesntmatch=true";
		}
		if(strlen($password) < 3){
			$errors .= "passwordistooshort=true";
		}
		
		require("../../models/login/User.php");
		require("../../models/login/database/Database.php");
		$user = new User($email,$password);
		$db = new Database();
	
		if($db->isEmailAlreadyRegistered($db->connect(),$user->getEmail())){
			$errors .= "emailisalreadyregistered=true";
		}
		
		if($errors !== ''){
			header("Location:registerfailed/".$errors);
			exit();
		}else{
			//save user on the database
			$db->insertUser($db->connect(),$user);
		}
	}
	