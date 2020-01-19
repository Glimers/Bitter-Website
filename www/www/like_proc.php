<?php
session_start();
include("connect.php");
include("Tweets.php");
//echo "made it";
if(isset($_GET["like"])){
   // echo "here";
    Tweet::Liking($con, $_GET["TweetId"]);
}

if(isset($_GET["dislike"])){
    //echo "not";
    Tweet::unLiking($con, $_GET["TweetId"]);
}


?>