<!DOCTYPE html>
<html>
	<head>
		<style>
			.card{
				width:30%;
				height:20vh;
				border:1px solid #333;
				margin:0 auto;
				text-align:center;
				display:flex;
				flex-direction: column;
			}
			span{
				font-size:40px;
				font-weight:bold;
				margin: auto;
			}
			.message{
				text-align:center;
			}
		</style>
	</head>
	<!--main page-->
	<body>
		<?php 
			/*$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(strpos($url,"rated=true") == true):?>*/
			if($_SERVER['QUERY_STRING'] == "rated=true"):?>
				<p class="message">You've successfully rated this game</p>
			<?endif?>
			<?php 
			require("Database.php");
			
			$db = new Database();
			$games = $db->getAll($db->connect(),"games");
			
			foreach($games as $game):?>
			<div class="card card">	
				<div class="card-body">
					<h3 class="card-title"><?php echo $game['title'];?></h3>
					<img src="">
					<p class="card-text"><?php echo $game['description'];?></p>	
					<p class="card-text">Rate: <?php echo $db->getAverage($db->connect(),$game['id']);?></p>	
			<!--<span>3.5</span>-->
					<hr>
					<a href="rating.php?id=<?php echo $game['id'];?>">click to rate</a>	
				</div>	
			</div>
			<?endforeach?>
	</body>
</html>