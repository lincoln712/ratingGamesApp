<?php
	session_start();
	if($_SESSION['authorized'] !== true){
		header("Location:register");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<script src="https://kit.fontawesome.com/5efe6f7c46.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<title>Rate Game</title>
		<style>
			.checked{
				color: goldenrod;
			}
			.stars{
				margin:13px 0;
			}
			.message{
				text-align:center;
			}
			img{
				max-width:130px;
			}
			.form{
				border:1px solid #333;
			}
			.card{
				border:1px solid #333;
			}
			.container{
				width:50%;
				border:1px solid #333;
			}
			@media(max-width:576px){
				.card{
					width:100%;
				}
			}
		</style>
	</head>
	
	<body>
		<?php
			
			if($_SERVER['QUERY_STRING'] == ''){
				echo "<script>window.location.href='home';</script>";
				exit();
			}
			require("../../models/app/Database.php");
			$db = new Database();
			
			//$id = number_format(trim($_SERVER['QUERY_STRING'],"id="));
			
			$game = $db->getSingle($_GET['id'],$db->connect(),"games");
		?>
		<?php
			
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			if(strpos($url,"rated=false") == true):?>
				<p class="message">Fill out at least one star to make your rate accounts!</p>
			<?php endif;?>
		<div class="container text-center m-auto">
			<div class="card card">	
				<div class="card-body">
					<h3 class="card-title"><?php echo $game['title'];?></h3>
					<img src="img/<?php echo $db->getImage($db->connect(),$_GET['id']);?>">
					<p class="card-text"><?php echo $game['description'];?></p>	
					<hr>
				</div>	
			</div>
			<div class="stars">
				<div class="fa fa-star" id="s1"></div>
				<div class="fa fa-star" id="s2"></div>
				<div class="fa fa-star" id="s3"></div>
				<div class="fa fa-star" id="s4"></div>
				<div class="fa fa-star" id="s5"></div>
			</div>
			<div class="form">
				<form class="form-group mt-2" method="post" action="../../controllers/app/process.php">
					<input type="hidden" name="game_id" value="<?php echo $_GET['id'];?>">
					<input id="rate" type="hidden" name="rate" value="">
					<textarea class="form-control" name="body" placeholder="Optional"></textarea>
					<button class="btn btn-primary btn-success mt-2" type="submit" name="submit">Submit</button>
				</form>
			</div>
			<p>Quantity Of Rates: <?php echo $db->getRatingQuantity($db->connect(),$_GET['id']);?></p>
		</div>
			<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->
			<script>
				setTimeout(function(){
					document.querySelector(".message").style.display = "none";
				},2000);
				let rate = 0;
			
				let stars = document.querySelectorAll(".fa-star");
				stars.forEach(function(star){
					star.addEventListener('click',addStar);
				})
				
				function addStar(e){
					let id = parseInt(e.target.id.replace("s",""))-1;
				
					if(e.target.className.includes("checked")){
						switch(id){
							case id:
								stars[id].classList.remove("checked");
									for(let i = id; i < stars.length; i++){
										stars[i].classList.remove("checked");
									}
									rate = id;
									document.querySelector("#rate").value = rate;		
							break;
						}
					}else{
						switch(id){
							case id:
								stars[id].classList.add("checked");
									for(let i = 0; i <= id; i++){
										stars[i].classList.add("checked");
									}
									rate = id+1;
									document.querySelector("#rate").value = rate;
							break;
						}
					}	
					console.log(rate);
				}
			</script>
	</body>
</html>