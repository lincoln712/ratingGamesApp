<?php
	require('models/app/HandleUser.php');
	require('models/app/Database.php');
	//echo $_SERVER['QUERY_STRING'];
	//echo $newUrl;
	$db = new Database();
	$hUser = new HandleUser($db->connect());
	$hUser->isAlreadyRated(8,1);