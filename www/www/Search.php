<?php
if(isset($_GET["search"])){
    session_start();
    include("Users.php");
    include("connect.php");
    include("Tweets.php");
}
else{
    header("Location:index.php?");
}






//move the tweet code to the TWEETS class 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Search for your bitter friends or find new people to troll.">
    <meta name="author" content="Ethan Steeves ethansteeves@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Search - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    
    <script src="includes/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="includes/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="includes/Validate.js"></script>
            
               

    
                
               
	
  </head>

  <body>

    <?php include("Includes/header.php"); ?> 
	<BR><BR>
                <div class='margins'>
				<b> Users found: </b> <br><hr><br>
                                <?php User::searchPeople($con, $_GET["search"]);   ?>
                                
                                <br> <b> Tweets Found: </b> <br><hr><br>
                                <?php Tweet::searchTweets($con); ?>
                </div> 
    
  </body>
  <footer>
      <br>
      
         <a class="foot" href="ContactUs.php">Contact Us</a>
        
  </footer>
</html>