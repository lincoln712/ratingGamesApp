<?php
	require('models/login/database/Database.php');
	require('models/login/HLO.php');
	require('models/login/User.php');
	$db = new Database();
	
	$data = new HLO($db->connect());
	$user = new User('y@gmail.com','111');
	//$hashed = $data->getPassword($user->getEmail());
	if($data->isRegistered($user)){
		echo "logged in!";
	}else{
		echo "email or password incorrect!";
	}
	//echo password_verify('111',$hashed);
	//echo $data->passwordMatches($user);