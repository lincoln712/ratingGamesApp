<?php

	session_start();
	if($_SESSION['authorized'] == true){
		header("Location:home");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>Register</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
		<style>
			.jumbotron{
				display:flex;
				width:70%;
				flex-direction:column;
				justify-content:center;
				align-items:center;
				height:50vh;
				margin:0 auto;
			}
			form{
				width:50%; 
				margin:0 auto;
		
			}
			input{
				margin-bottom:3px;	
			}
			.message{
				text-align:center;
				text-transform:capitalize;
			}

			@media(max-width:576px){
				.jumbotron{
					width:100%;
				}
				.form-group{
					width:100%;
				}
			}
		</style>
	</head>
	<body>
		<?php
			$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // analysis the $_SERVER[REQUEST_URI] content
				if($_SERVER['QUERY_STRING'] !== ''){
					$newUrl = str_replace("registerfailed/".$_SERVER['QUERY_STRING'],"register",$_SERVER['REQUEST_URI']);
				}
		?>
		<?php if(strpos($url,"passworddoesntmatch=true") == true):?>
			<p class="message alert alert-danger" role="alert">password doesn't match!</p>
		<?php endif;?>
		<?php if(strpos($url,"passwordistooshort=true") == true):?>
			<p class="message alert alert-danger" role="alert">password should be at least 3 characters!</p>
		<?php endif;?>
		<?php if(strpos($url,"emailisalreadyregistered=true") == true):?>
			<p class="message alert alert-danger" role="alert">email is already taken!</p>
		<?php endif;?>
		<div class="jumbotron">
			<form class="form-group text-center" method="post" action="signup">
				<input class="form-control" name="email" type="email" placeholder="Enter E-mail" required>
				<input class="form-control" name="password" type="password" placeholder="Enter Password" required>
				<input class="form-control" name="passwordagain" type="password" placeholder="Enter Password Again" required>
				<input class="btn btn-primary btn-success" name="submit" type="submit" value="Sign-up">
			</form>
			<fieldset><a class="btn btn-secondary btn-info" href="login">Sign-in</a></fieldset>
		</div>
		<script>
			setTimeout(function(){
				document.querySelectorAll(".message").forEach(function(message){
					message.style.display = "none";
					window.location.href = "<?php echo $newUrl;?>";
				});
				
			},2000);
		</script>
	</body>
</html>