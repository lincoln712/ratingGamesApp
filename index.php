<!DOCTYPE html>
<html>
	<head>
		<script src="https://kit.fontawesome.com/5efe6f7c46.js" crossorigin="anonymous"></script>
		<style>
			.card{
				width:30%;
				height:100%;
				border:1px solid #333;
				margin:0 auto;
				text-align:center;
				display:flex;
				flex-direction: column;
			}
			span{
				font-size:20px;
				font-weight:bold;
				margin: auto;
			}
			.message{
				text-align:center;
			}
			img{
				width:100px;
			}
			.flickering{
				color:goldenrod;
			}
		</style>
	</head>
	<!--main page-->
	<body>
		<?php
			if($_SERVER['QUERY_STRING'] == "rated=true"):?>
				<p class="message">You've successfully rated this game</p>
			<?endif?>
			<?php 
			require("Database.php");
			
			$db = new Database();
			$games = $db->getAll($db->connect(),"games");
			?>
			<?php foreach($games as $game):?>
			<div class="card card">	
				<div class="card-body">
					<h3 class="card-title"><?php echo $game['title'];?></h3>
					<img src="img/<?php echo $db->getImage($db->connect(),$game['id']);?>">
					<p class="card-text"><?php echo $game['description'];?></p>	
					<span class="card-text">Rate: <?php echo $db->getAverage($db->connect(),$game['id']);?><i class="fas fa-star flickering"></i></span>
					<hr>
					<a href="rating.php?id=<?php echo $game['id'];?>">click to rate</a>	
				</div>	
			</div>
			<?endforeach?>
			<script>
				setTimeout(function(){
					document.querySelector(".message").style.display = "none";
				},2000);
			</script>
	</body>
</html>