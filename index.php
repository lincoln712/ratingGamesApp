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
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(strpos($url,"rated=true") == true):?>
				<p class="message">You've successfully rated this game</p>
			<?endif?>
		<div class="card">		
			<span>3.5</span>
			<hr>
			<a href="rating.php">click to rate</a>		
		</div>
	</body>
</html>