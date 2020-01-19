<?php 
//insert a tweet into the database
session_start();
include("connect.php");
include("Tweets.php");
//echo $_SESSION["SESS_MEMBER_ID"];
  if(isset($_POST['myTweet'])){
      
        Tweet::CreateTweet($con);
//       $tweet = mysqli_escape_string($con,htmlspecialchars(trim($_POST['myTweet'])));
//       
//       if($tweet === ""){
//           $msg = "Bit must contain text";
//       }
//       else if(strlen($tweet) > 200){
//           $msg = "Bit must be below 200 characters";
//       }
//       else{
//         //  date_default_timezone_set('America/Halifax');
//         //  $time = date('m/d/Y h:i:s a', time());
//           $sql = "INSERT INTO tweets (tweet_text, user_id) VALUES ('$tweet', " . $_SESSION["SESS_MEMBER_ID"] . ")";
//           
//           mysqli_query($con, $sql);
//           
//           if(mysqli_affected_rows($con) == 1){
//               $msg = "Bitt created successfully";
//           }
//           else{
//               $msg = "Error posting your Bitt please try again later";
//           }
//       }
//      // echo $_POST['myTweet'];
//      // echo "here";
//       header("location:index.php?message=$msg");
   } 
?>