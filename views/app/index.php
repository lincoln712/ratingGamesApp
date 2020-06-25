<?php
	session_start();
	
	if($_SESSION['authorized'] !== true){
		header("Location:login");
		exit();
	}
?>
	
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>Home</title>
		<script src="https://kit.fontawesome.com/5efe6f7c46.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<style>
			.message{
				text-align:center;
			}
			img{
				max-width:135px;
				height:200px;
			}
			.flickering{
				color:goldenrod;
			}
			.card{
				border:1px solid #333;
			}
		</style>
	</head>
	<!--main page-->
	<body>
		
		<form method="post" action="logout">
			<input name="submit" type="submit" value="Log-Out">
		</form>
			<p><?php echo $_SESSION['username'];?></p>
			<?php if($_SERVER['QUERY_STRING'] == "rated=true"):?>
				<p class="message">You've successfully rated this game!</p>
			<?php endif;?>

			<?php 
				require("../../models/app/Database.php");
			
				$db = new Database();
				$games = $db->getAll($db->connect());
			?>
			<div class="container-fluid">
				<div class="row">
					<?php foreach($games as $game):?>
						<div class="col-sm-4">
							<div class="card card text-center">	
								<div class="card-body">
									<h3 class="card-title text-capitalize"><?php echo $game['title'];?></h3>
									<img class="card-img-top" src="img/<?php echo $db->getImage($db->connect(),$game['id']);?>">
									<p class="card-text"><?php echo $game['description'];?></p>	
									<span class="card-text">Rate: <?php echo $game['average'];?><i class="fas fa-star flickering"></i></span>
									<hr>
									<a class="btn btn-primary" href="game/<?php echo $game['id'];?>">click to rate</a>	
								</div>	
							</div>
						</div>
					<?php endforeach;?>
				</div>
			</div>
<!-- 			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 -->			<script>
				setTimeout(function(){
					if(document.querySelector(".message") !== null){
						document.querySelector(".message").style.display = "none";
					}
				},2000);
			</script>
	</body>
</html>