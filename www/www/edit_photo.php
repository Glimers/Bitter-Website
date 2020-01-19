<?php

    session_start();

    if(isset($_GET["message"])){
        $msg = $_GET["message"];
        echo "<script>alert('$msg')</script>";
    }

    if(isset($_SESSION["SESS_MEMBER_ID"])){//
    //echo "You are logged in <br>";
    }
    else{
        header("Location:Login.php?");
    }
    
    
?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Change your trolly face, upload your profile image to make everyone rage">
    <meta name="author" content="Ethan Steeves ethansteeves@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Edit Profile Picture - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    
    <script src="includes/bootstrap.min.js"></script>
    
    </head>

  <body>

    <?php include("includes/header.php"); ?> 
	<BR><BR>
    <div class="container">
		<div class="row">
			
			<div class="main-login main-center">
				<h5>Change your profile picture to make trolls rage</h5>
                                <form method="post" action="edit_photo_proc.php" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Choose Image</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="file" name="pic" accept=".gif, .jpg, .jpeg, .png" required><br><br>
                                                                    <input id="button" type="submit" name="submit" value="Submit">
                                                                        <br>   <span id="imageError"></span>
                                                                </div>
							</div>
						</div>
						
						
					</form>
				</div>
			
		</div> <!-- end row -->
    </div><!-- /.container -->
    
  </body>
  <footer>
      <br>
      
         <a class="foot" href="ContactUs.php">Contact Us</a>
        
  </footer>
</html>