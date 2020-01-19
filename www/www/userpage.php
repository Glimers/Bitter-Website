<?php
session_start();
include("connect.php");

if(isset($_SESSION["SESS_MEMBER_ID"])){
    //echo "You are logged in <br>";
    include("Tweets.php");
    include("Users.php");
}
else{
    header("Location:Login.php?");
}
/*if(isset($_GET["user_Id"])){

    //this might need fixed
}
else{
    header("Location:index.php?");
}*/

//echo "<script> alert(" . $_SESSION[""]

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="All of your Bitter content, view, like, complain on your own bitter page.">
    <meta name="author" content="Ethan Steeves, ethansteeeves@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
	
	
  </head>

  <body>

    <?php include("Includes/header.php"); ?> 
	
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
				<div class="bold">
				<img class="bannericons" src="images/profilepics/<?php echo $_GET["user_id"]; ?>">
                                <?php User::ProfileInfo($con, $_GET["user_id"]); ?>
			<!--	Jimmy Jones<BR></div>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>0</td><td>0</td><td>0</td>
				</tr></table>
				<img class="icon" src="images/location_icon.jpg">New Brunswick
				<div class="bold">Member Since:</div>
				<div>jan 1, 2001</div>
				</div><BR><BR>
		this section here should go in ProfileInfo($con, $_GET["user_id"])	-->	
				<div class="trending img-rounded">
                                    <div class="bold"><?php User::followersKnown($con, $_GET["user_id"]); ?> &nbsp;Followers you know<BR>
				<?php User::MutualFriends($con, $_GET["user_id"]); ?>
				</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="img-rounded">
                                    <!-- news feed here -->
                                    <?php
                                    Tweet::UserNewsFeed($con, $_GET["user_id"]);
                                    ?>
				</div>
				<div class="img-rounded">
				
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				
                                <?php User::WhoToFollow($con); ?>
				
				</div><BR>
				
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="includes/bootstrap.min.js"></script>
    
  </body>
  
   <footer>
      <br>
      <h3>
         <a class="foot" href="ContactUs.php">Contact Us</a>
      </h3>   
  </footer>
  
</html>
