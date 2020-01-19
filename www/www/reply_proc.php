<?php
include("connect.php");
$tweetId = $_GET['tweetId'];
$userId = $_GET['user_id'];
$tweetText = $_GET['txtfield' . $tweetId];
$orgTweetId = $_GET['orgTweetId'];
$json_out = '{"msg" : "Error connecting to database"}';
//$tweetText = "testing";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$sql = "INSERT INTO tweets (tweet_text, user_id, reply_to_tweet_id) VALUES ('$tweetText', '$userId', '$tweetId')";

mysqli_query($con, $sql);

if(mysqli_affected_rows($con) == 1){
    $json_out = '{"msg" : "Successfully replied"}';
    
}
else{
    $json_out = '{"msg" : "Error replying to tweet please try again later"}';
}


echo $json_out;
?>
