<?php
//this is the main page for our Bitter website, 
//it will display all tweets from those we are trolling
//as well as recommend people we should be trolling.
//you can also post a tweet from here

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

//echo "<script> alert(" . $_SESSION[""]

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bitter Home Page, view all your trolls here. Start trolling your friends now.">
    <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca: Most Recently Updated By: Ethan Steeves, ethansteeves@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

   <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    
    <script src="includes/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="includes/jquery-3.3.1.min.js"></script>
   
            
    
    <script type="text/javascript">
	//just a little jquery to make the textbox appear/disappear like the real Twitter website does
	
        $(document).ready(function() {
		//hide the submit button on page load
		$("#button").hide();
		$("#tweet_form").submit(function() {
			
			$("#button").hide();
		});
		$("#myMessage").click( function() {			
			this.attributes["rows"].nodeValue = 5;
			$("#button").show();
			
		});//end of click event
		$("#myMessage").blur( function() {			
			this.attributes["rows"].nodeValue = 1;
                        //$("#button").hide();

		});//end of click event
                
                $("#submitReply").hide();
                
//               $("#test").click()(function(){
//                    $("#submitReply").show();
//                })
//               $("#subtest").click(function(){
//                   //alert("inside click");
//                   $.get(
//                    "reply_proc.php",
//                    $("#frmComment").serializeArray(),
//                    function(data) {//anonymous function
//                        alert("inside function"); //use this for debugging
//                        //write the resulting message back to the mySpan tag
//                        // 
//// $("#mySpan").text(data.msg); 
//
//                        alert(data.msg);
//                    },
//                    "json" //change this to HTML for debugging
//                ); //end of the get function call
//                return true;
//                //alert("HELP");
//            
//               });
//               
               
                
                
	});//end of ready event handler
    //this stuff might not be needed that is below
    
      /*  function test(){
            $("#submitReply").show();
        } */
    /*
        $("#test").click( function(){
            ("#submitReply").modal({
				opacity: 80,
				overlayCss: {backgroundColor:"#CCC"}
			
			});//end modal
			
			return false;
        });*/
    
     function disableButton () {
                    document.getElementById("button").disabled = true;
                } //end of disableButton
                function enableButton() {
                    document.getElementById("button").disabled = false;
                } //end of enableButton

           function checkUsernames(){
                 // var txtNum = document.getElementById("username").value;
                    
                    
                        $.get(
                    "includes/findUsername.php",
                    $("#message_form").serializeArray(),
                    function(data) {//anonymous function
                        //alert(data); //use this for debugging
                        //write the resulting message back to the mySpan tag
                      $("#snameError").text(data.msg);
                      
                       if($("#snameError").text() === "User not found") disableButton();
                       else enableButton();
                      //datalist.append in here
                    },
                    "json" //change this to HTML for debugging
                ); //end of the get function call
                return true;        
             
                        
                    }          
               
              
               
                
        
	</script>
        
  </head>

  <body>

    <!--nav goes here-->
    <?php include("includes/header.php"); ?>
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
				<div class="bold">
                                    <img class="bannericons" src="<?php echo $_SESSION['SESS_PROFILE_PIC'] ?>">
				<?php User::ProfileInfo($con, $_SESSION["SESS_MEMBER_ID"]) ?>
				<div class="trending img-rounded">
				<div class="bold">Trending</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					<form method="GET" id="message_form" action="message_proc.php">
					<div class="form-group">
                                            <input type="text" id="username" name="username" onkeyup="checkUsernames()" list="dlUsers" autocomplete="off"><span id="snameError"></span>
                                            <datalist id="dlUsers">
                                            </datalist>                                                      
						<textarea class="form-control" name="myMessage" id="myMessage" rows="1" placeholder="What are you bitter about today?"></textarea>
						<input type="submit" name="button" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button"/>
						
					</div>
					</form>
				</div>
				<div class="img-rounded">
				
                                
                                <?php
                                //here is where list of messages goes
                               // Tweet::NewsFeed($con);
                               
                                Tweet::messageFeed($con);
                                
                                ?>
                        
                        
                                
                                
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				<!-- display people you may know here-->
				<?php 
                                
                                     User::WhoToFollow($con);
                                    
                                ?>
				
				</div><BR>
				<!--don't need this div for now 
				<div class="trending img-rounded">
				© 2018 Bitter
				</div>-->
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	

    <!-- Bootstrap core JavaScript
    ================================================== --> 
    <!-- Placed at the end of the document so the pages load faster -->
    
    
  </body>
  
   <footer>
      <br>
      <h3>
         <a class="foot" href="ContactUs.php">Contact Us</a>
      </h3>   
  </footer>
  
</html>

<?php

   if (isset($_GET["message"])){
        $message = $_GET["message"];
        echo "<script>alert('$message')</script>";
    }

?>

