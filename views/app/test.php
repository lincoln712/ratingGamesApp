<!--<?php
  require("../../models/app/Database.php");
  
  $db = new Database();
  $game = $db->getSingle($_GET['id'],$db->connect(),"games"); 
  //echo 'img/'.$db->getImage($db->connect(),$_GET['id']);
  ?>-->
  
  <!DOCTYPE html>
  <html>
  	<head></head>
  	<body>
  		<!--<img src="img/<?php echo $db->getImage($db->connect(),$_GET['id']);?>">-->
  		<!--<img src="<?php echo $db->getImage($db->connect(),$_GET['id']);?>" alt="<?php echo 'img/'.$db->getImage($db->connect(),$_GET['id']);?>">-->
  		<img src="img/the_last_of_us.png">
  	</body>
  </html>