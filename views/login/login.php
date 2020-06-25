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
		<title>Login</title>
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
				background-color: rgba(80,150,250,0.5);
			}
			.form-group{
				width:50%;
				margin:0 auto;
			}
			input{
				margin-bottom:5px;
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
			$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if($_SERVER['QUERY_STRING'] !== ''){
				$newUrl = str_replace("loginfailed/".$_SERVER['QUERY_STRING'],"login",$_SERVER['REQUEST_URI']);
			}
			if(strpos($url,"emailorpasswordincorrect=true") == true):?>
				<p class="message alert alert-danger" role="alert">e-mail or password incorrect!</p>
			<?php endif;?>
		<div class="jumbotron text-center">
			<form class="form-group" method="post" action="signin">
				<input class="form-control" name="email" type="email" placeholder="Enter E-mail" required>
				<input class="form-control" name="password" type="password" placeholder="Enter Password" required>
				<input class="btn btn-primary btn-success" name="submit" type="submit" value="Login">
			</form>
			<fieldset class="form-group"><a class="btn btn-primary btn-info" href="register">Sign-up</a></fieldset>
		</div>
		
		<script>
				setTimeout(function(){
				document.querySelectorAll(".message").forEach(function(message){
					message.style.display = "none";
					window.location.href = "<?php echo $newUrl;?>";
				});
				
			},3000);
		</script>
	</body>
</html>
