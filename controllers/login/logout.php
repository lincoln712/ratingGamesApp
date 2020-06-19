<?php
	if(isset($_POST['submit'])){
		session_start();
		session_destroy();
		header("Location:login");
		exit();
	}