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
			/*span{
				font-size:40px;
				font-weight:bold;
				margin: auto;
			}*/
			.container{
				text-align:center;
			}
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
				width:100px;
			}
		</style>
	</head>
	
	<body>
		<?php
			
			require("Database.php");
			$db = new Database();
			
			$id = number_format(trim($_SERVER['QUERY_STRING'],"id="));
			
			$game = $db->getSingle($id,$db->connect(),"games");
		?>
		<?php
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			if(strpos($url,"rated=false") == true):?>
				<p class="message">Fill out at least one star to make your rate accounts!</p>
			<?php endif;?>
		<div class="container">
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
				<form method="post" action="process.php">
					<input type="hidden" name="game_id" value="<?php echo $_GET['id'];?>">
					<input id="rate" type="hidden" name="rate" value="">
					<textarea name="body" placeholder="Optional"></textarea>
					<button type="submit" name="submit">Submit</button>
				</form>
			</div>
			<p>Quantity Of Rates: <?php echo $db->getRatingQuantity($db->connect(),$_GET['id']);?></p>
		</div>
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