<?php
    session_start();
    // MOVE THIS CODE TO TWEETS CLASS PAGE
    include("connect.php");
    include("Tweets.php");
    if(isset($_GET['tweet_id'])){
          $orgTweetId = $_GET['tweet_id'];
          $sql = "SELECT u.first_name, u.last_name, t.tweet_text FROM users u JOIN tweets t ON t.user_id = u.user_id WHERE t.tweet_id = $orgTweetId";
        
          $tweet = mysqli_query($con, $sql);
          $result = mysqli_fetch_array($tweet);
          
          //echo $result['first_name'];
          
           $sqlRetweet = "INSERT INTO tweets (tweet_text, user_id, original_tweet_id) VALUES ('" . $result['tweet_text'] . "', '" . $_SESSION['SESS_MEMBER_ID'] . "', '$orgTweetId')" ;
           mysqli_query($con, $sqlRetweet);
           
          if(mysqli_affected_rows($con) == 1){
            $msg = "Retweet Successful";
          }
          else{
            $msg = "Error retweeting try again later";
          }
          
        //is retweeting a new tweet?
        //$sql = "INSERT INTO tweets (tweet_text, user_id, original_tweet_id) VALUES ("*/
    }

header("location:index.php?message=$msg");

?>
