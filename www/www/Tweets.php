<?php

class Tweet{

    private $tweetId;
    private $tweetText;
    private $userId;
    private $originalTweetId;
    private $replyToTweetId;
    private $dateAdded;

    public function __get($prop) {
        return $this->$prop;
    }
    
    public function __set($prop, $value) {
        $this->$prop = $value;
    }
    
    public function __construct(int $tweetId, string $tweetText, int $userId, int $originalTweetId, int $replyToTweetId, string $dateAdded) {
       
        $this->tweetId = $tweetId;
        $this->tweetText = $tweetText;
        $this->userId = $userId;
        $this->originalTweetId = $originalTweetId;
        $this->replyToTweetId = $replyToTweetId;
        $this->dateAdded = $dateAdded;
    }
    
    public function __destruct() {
        //this destroys the object
    }
    
    public static function CreateTweet($con){
        $tweet = mysqli_escape_string($con,htmlspecialchars(trim($_POST['myTweet'])));
       
       if($tweet === ""){
           $msg = "Bit must contain text";
       }
       else if(strlen($tweet) > 200){
           $msg = "Bit must be below 200 characters";
       }
       else{
         
           $sql = "INSERT INTO tweets (tweet_text, user_id) VALUES ('$tweet', " . $_SESSION["SESS_MEMBER_ID"] . ")";
           
           mysqli_query($con, $sql);
           
           if(mysqli_affected_rows($con) == 1){
               $msg = "Bitt created successfully";
           }
           else{
               $msg = "Error posting your Bitt please try again later";
           }
       }
      // echo $_POST['myTweet'];
      // echo "here";
       header("location:index.php?message=$msg");
    }
    
    public static function NewsFeed($con){
         $sql = "SELECT u.first_name, u.user_id, u.last_name, u.screen_name, t.tweet_text, t.date_created, t.tweet_id, t.original_tweet_id, t.reply_to_tweet_id FROM users u JOIN tweets t ON t.user_id = u.user_id WHERE u.user_id IN (SELECT f.to_id FROM follows f WHERE f.from_id = " . $_SESSION["SESS_MEMBER_ID"] . ") OR u.user_id = " . $_SESSION["SESS_MEMBER_ID"] . " ORDER BY date_created DESC LIMIT 10;";
                               //echo $sql; need to CHANGE SQL STATEMENT TO ONLY GET 10 TWEETS AND ORDER FROM NEWEST TO OLDEST
                               date_default_timezone_set('America/Halifax');
                                 $count = 0;
                                $comments = mysqli_query($con, $sql);
                                if(mysqli_num_rows($comments) == 0){
                                    echo "";
                                }
                                else{
                                   
                                while($result = mysqli_fetch_array($comments)){
                                    $reply = $result["reply_to_tweet_id"];
                                    
                                    if($reply != 0){
                                        $sql = "SELECT u.first_name, u.user_id, u.last_name, u.screen_name, t.tweet_text, t.date_created, t.original_tweet_id, t.tweet_id, t.reply_to_tweet_id FROM users u JOIN tweets t ON t.user_id = u.user_id WHERE t.tweet_id = $reply";
                                        $org = mysqli_query($con, $sql);
                                        $original = mysqli_fetch_array($org);
                                        
                                       // echo "this is the original tweet" . $original["tweet_text"];
                                        Tweet::NewsItem($con, $original["user_id"], $original["first_name"], $original["last_name"], $original["screen_name"], $original["date_created"], $original["original_tweet_id"], $original["tweet_text"], $original["tweet_id"], $count, $original["reply_to_tweet_id"]);
                                      //  echo "<div>this is the text</div>";
                                        $count++;
                                        echo "<p id='indent'>";
                                    }
                                    
                                        
                                    
                                    Tweet::NewsItem($con, $result["user_id"], $result["first_name"], $result["last_name"], $result["screen_name"], $result["date_created"], $result["original_tweet_id"], $result["tweet_text"], $result["tweet_id"], $count, $reply);
                                    $count++;
                                    if($reply != 0) echo "</p><br><hr>";
                                    if($reply == 0)echo "<br><hr>";
                                    }//end of while                               
                                }//end of else    
    }//end of NewsFeed
    
    public static function NewsItem($con, $user_id, $firstName, $lastName, $screen_name, $date_created, $original_tweet_id, $tweet_text, $tweet_id, $count, $reply){
        echo "<a href='userpage.php?user_id=" . $user_id ."'>" . $firstName . " " ;
                                    echo $lastName . " @" . $screen_name . "</a> ";
                                   
                                    date_default_timezone_set('America/Halifax');
                                    $now = new DateTime();
                                    $tweetTime = new DateTime($date_created);
                                    $interval = $tweetTime->diff($now);

                                    if ($interval->y > 1) echo $interval->format('%y years') . " ago";
                                    elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
                                    elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
                                    elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
                                    elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
                                    elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
                                    elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
                                    elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
                                    elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
                                    elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
                                    elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
                                    elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
                                    
                                     if($original_tweet_id != 0){
                                        $retweetSql = "SELECT first_name, last_name FROM users WHERE user_id = (SELECT user_id FROM tweets WHERE tweet_id =" . $original_tweet_id . ")";
                                       // echo $result['original_tweet_id'];
                                       if($resultRetweet = mysqli_query($con, $retweetSql)){
                                        $fetchResult = mysqli_fetch_array($resultRetweet);
                                        echo " <b>retweeted from " . $fetchResult['first_name'] . " " . $fetchResult['last_name'] . "</b> ";
                                       }
                                    }
                                    echo "<br>";
                                    echo $tweet_text;
                                    echo "<br>";
                                    
                                   // echo "<form>";
                                    echo Tweet::likeTweet($con, $tweet_id);
                                    
                                    echo "<a href='retweet.php?tweet_id=" . $tweet_id . "'>" . "<img src='Images/retweet.png' id='littleIcon' /> </a>";
                                    
                                    echo "<a href='#' data-toggle='modal' data-target='#myModal" . $count ."'>" . "<img src='Images/reply.png'  id='littleIcon' /> </a>";
                                   // echo "</form>";
                                   
                                   echo "<form id='frmComment" . $count ."'>
                                       <div class='modal' id='myModal" . $count ."'>
  <div class='modal-dialog'>
    <div class='modal-content'>

      
      <div class='modal-header'>
        <h4 class='modal-title'>Replying to:</h4>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
      </div>

      <!-- Modal body -->
      <div class='modal-body'>
             @" . $screen_name . "<br> " . $tweet_text . " <br><br> 
          <input type='hidden' name='tweetId' value=" . $tweet_id . ">
          <input type='hidden' name='user_id' value=" . $_SESSION["SESS_MEMBER_ID"] . ">
          <input type='hidden' name='orgTweetId' value=" . $original_tweet_id   .  ">
          <input name='txtfield" . $tweet_id . "' >"  ."
      </div>

      <!-- Modal footer -->
      <div class='modal-footer'>
        
        <button onclick='subtest(". $count . ")'>Submit</button>
        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
      </div>

    </div>
  </div>
</div>
</form>";
                               
                                    
                          
    }//end of NewsItem
    
    public static function UserNewsFeed($con, $userId){
         $sql = "SELECT u.first_name, u.user_id, u.last_name, u.screen_name, t.tweet_text, t.date_created, t.tweet_id, t.original_tweet_id, t.reply_to_tweet_id FROM users u JOIN tweets t ON t.user_id = u.user_id WHERE u.user_id = " . $userId . " ORDER BY date_created;";
                               //echo $sql; need to CHANGE SQL STATEMENT TO ONLY GET 10 TWEETS AND ORDER FROM NEWEST TO OLDEST
                               date_default_timezone_set('America/Halifax');
                                 $count = 0;
                                $comments = mysqli_query($con, $sql);
                                if(mysqli_num_rows($comments) == 0){
                                    echo "";
                                }
                                else{
                                   
                                while($result = mysqli_fetch_array($comments)){
                                    $reply = $result["reply_to_tweet_id"];
                                    
                                  /*  if($reply != 0){
                                        $sql = "SELECT u.first_name, u.user_id, u.last_name, u.screen_name, t.tweet_text, t.date_created, t.original_tweet_id, t.tweet_id, t.reply_to_tweet_id FROM users u JOIN tweets t ON t.user_id = u.user_id WHERE t.tweet_id = $reply";
                                        $org = mysqli_query($con, $sql);
                                        $original = mysqli_fetch_array($org);
                                        
                                       // echo "this is the original tweet" . $original["tweet_text"];
                                        Tweet::NewsItem($con, $original["user_id"], $original["first_name"], $original["last_name"], $original["screen_name"], $original["date_created"], $original["original_tweet_id"], $original["tweet_text"], $original["tweet_id"], $count, $original["reply_to_tweet_id"]);
                                      //  echo "<div>this is the text</div>";
                                        $count++;
                                        echo "<p id='indent'>";
                                    }*/
                                    
                                        
                                    
                                    Tweet::NewsItem($con, $result["user_id"], $result["first_name"], $result["last_name"], $result["screen_name"], $result["date_created"], $result["original_tweet_id"], $result["tweet_text"], $result["tweet_id"], $count, $reply);
                                    $count++;
                                   /* if($reply != 0) echo "</p><br><hr>";
                                    if($reply == 0)echo "<br><hr>";*/
                                    echo "<br><hr>";
                                    }//end of while                               
                                }//end of else    
    }//end of UserPage News
    
    public static function searchTweets($con){
        
        $sql = "SELECT u.first_name, u.user_id, u.last_name, u.screen_name, t.tweet_text, t.date_created,
                t.tweet_id, t.original_tweet_id, t.reply_to_tweet_id FROM users u
                JOIN tweets t ON t.user_id = u.user_id WHERE u.user_id !=" . $_SESSION["SESS_MEMBER_ID"] . " AND
                u.first_name like '%e%' ORDER BY date_created";
        
        date_default_timezone_set('America/Halifax');
        $count = 0;
        
        $comments = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($comments) == 0){
            echo "";
            }
            else{

                while($result = mysqli_fetch_array($comments)){
                    $reply = $result["reply_to_tweet_id"];
                    Tweet::NewsItem($con, $result["user_id"], $result["first_name"], $result["last_name"], $result["screen_name"], $result["date_created"], $result["original_tweet_id"], $result["tweet_text"], $result["tweet_id"], $count, $reply);

                    $count++;
                    echo "<br><hr>";
                }
            }
    }//end of searchTweets
    
    public static function likeTweet($con, $tweetId){
        
        //here you are going to check to see if the user has already liked this tweet before.
        //if user already has liked the tweet before display green like image 
        //the page will redirect to delete tweet 
        $sql = "SELECT count(like_id) as liked FROM likes WHERE tweet_id = $tweetId AND user_id =" . $_SESSION['SESS_MEMBER_ID'];
        $like = mysqli_query($con, $sql);
        while($likes = mysqli_fetch_array($like)){
            if($likes["liked"] == 0){
                echo "<a href='like_proc.php?TweetId=$tweetId&like=1'><img src='Images/like.ico' alt='like this' id='littleIcon'/></a>&nbsp ";
            }
            else if ($likes["liked"] == 1){
                echo "<a href='like_proc.php?TweetId=$tweetId&dislike=1'><img src='Images/likes.ico' alt='like this' id='littleIcon'/></a>";
            }
        }
        
        
    }//end of likeTweet
   
    public static function Liking($con, $tweetId){
        $sql = "INSERT INTO likes(tweet_id, user_id) VALUES (" . $tweetId .", " .$_SESSION['SESS_MEMBER_ID'] . ")";
        
        mysqli_query($con, $sql);
        
        if(mysqli_affected_rows($con) == 1){
            $msg = "Successfully liked tweet";
        }
        else{
            $msg = "Error liking tweet please try again later";
        }
        
        header("location:index.php?message=$msg");
    }//end of liking
    
    public static function unLiking($con, $tweetId){
        $sql = "DELETE FROM likes WHERE tweet_id = $tweetId AND user_id = " . $_SESSION['SESS_MEMBER_ID'] ;
        
        
        
        if(mysqli_query($con, $sql)){
            $msg = "Successfully unliked tweet";
        }
        else{
            $msg = "Error unliking tweet please try again later";
        }
        header("location:index.php?message=$msg");
    }//end of unliking
    
    public static function messageFeed($con){
       
        $sql = "SELECT u.user_id, u.first_name, u.last_name, u.screen_name, m.message_text FROM users u JOIN messages m ON m.from_id = u.user_id WHERE m.to_id = " . $_SESSION["SESS_MEMBER_ID"];
        //echo $sql;
        if($result = mysqli_query($con, $sql)){
            
            while($message = mysqli_fetch_array($result)){
                echo "<a href='userpage.php?user_id='" . $message["user_id"] ."'>" . $message["first_name"] . " " . $message["last_name"] . " @" . $message["screen_name"] . "</a><br>";
                echo $message["message_text"] . "<br><hr>";
                
            }
        }
    }//end of messageFeed
    
    public static function LikesFeed($con){
        $sql = "SELECT user_id, tweet_id, date_created FROM likes WHERE tweet_id IN (SELECT tweet_id FROM tweets WHERE user_id = " . $_SESSION["SESS_MEMBER_ID"] . ") ORDER BY date_created DESC";
        //echo $sql;
        if($result = mysqli_query($con, $sql)){
            while($like = mysqli_fetch_array($result)){
                
                $sql2 = "SELECT u.first_name, u.last_name, u.profile_pic, (SELECT tweet_text FROM tweets WHERE tweet_id = " . $like["tweet_id"] .  ") AS message FROM users u WHERE u.user_id = " . $like["user_id"];
                
                if($res = mysqli_query($con, $sql2)){
                    while($mess = mysqli_fetch_array($res)){
                                    
                                    echo "<img src='" . $mess["profile_pic"] ."' class='bannericons'><a href='userpage.php?user_id=" . $like["user_id"] ."'>" .$mess["first_name"] . " " . $mess["last_name"] .  "</a> liked your tweet" . " ";
                                
                                    date_default_timezone_set('America/Halifax');
                                    $now = new DateTime();
                                    $tweetTime = new DateTime($like["date_created"]);
                                    $interval = $tweetTime->diff($now);

                                    if ($interval->y > 1) echo $interval->format('%y years') . " ago";
                                    elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
                                    elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
                                    elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
                                    elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
                                    elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
                                    elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
                                    elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
                                    elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
                                    elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
                                    elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
                                    elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
                                    echo "<br>";
                                    echo $mess["message"];
                                    echo "<br><hr>";
                        
                    }
                }
            }
        }
    }//end of likesfeed
    
    public static function RetweetsFeed($con){
       $sql = "SELECT u.user_id, u.first_name, u.last_name, u.profile_pic, t.tweet_id, t.tweet_text, t.original_tweet_id, t.reply_to_tweet_id, t.date_created FROM users u INNER JOIn tweets t ON t.user_id = u.user_id WHERE t.original_tweet_id IN (SELECT t.tweet_id FROM tweets t WHERE t.user_id = " . $_SESSION["SESS_MEMBER_ID"] . ")order by t.date_created desc";
        
        if($result = mysqli_query($con, $sql)){
            while($like = mysqli_fetch_array($result)){
               
                
                                    
                                    echo "<img src='" . $like["profile_pic"] ."' class='bannericons'><a href='userpage.php?user_id=" . $like["user_id"] ."'>" .$like["first_name"] . " " . $like["last_name"] .  "</a> retweeted your tweet" . " ";
                                
                                    date_default_timezone_set('America/Halifax');
                                    $now = new DateTime();
                                    $tweetTime = new DateTime($like["date_created"]);
                                    $interval = $tweetTime->diff($now);

                                    if ($interval->y > 1) echo $interval->format('%y years') . " ago";
                                    elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
                                    elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
                                    elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
                                    elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
                                    elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
                                    elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
                                    elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
                                    elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
                                    elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
                                    elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
                                    elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
                                    echo "<br>";
                                    echo $like["tweet_text"];
                                    echo "<br><hr>";
                        
                   
            }
        }
    }//end of retweetsfeed
    
    public static function RepliesFeed($con){
        $sql = "SELECT u.user_id, u.first_name, u.last_name, u.profile_pic, t.tweet_id, t.tweet_text, t.original_tweet_id, t.reply_to_tweet_id, t.date_created FROM users u INNER JOIn tweets t ON t.user_id = u.user_id WHERE t.reply_to_tweet_id IN (SELECT t.tweet_id FROM tweets t WHERE t.user_id = ". $_SESSION["SESS_MEMBER_ID"] . ")order by t.date_created desc";
        
        if($result = mysqli_query($con, $sql)){
            while($like = mysqli_fetch_array($result)){
                
               
                                    echo "<img src='" . $like["profile_pic"] ."' class='bannericons'> <a href='userpage.php?user_id=" . $like["user_id"] ."'>" .$like["first_name"] . " " . $like["last_name"] .  "</a> replied to your tweet" . " ";
                                
                                    date_default_timezone_set('America/Halifax');
                                    $now = new DateTime();
                                    $tweetTime = new DateTime($like["date_created"]);
                                    $interval = $tweetTime->diff($now);

                                    if ($interval->y > 1) echo $interval->format('%y years') . " ago";
                                    elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
                                    elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
                                    elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
                                    elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
                                    elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
                                    elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
                                    elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
                                    elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
                                    elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
                                    elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
                                    elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
                                    echo "<br>";
                                    echo $like["tweet_text"];
                                    echo "<br><hr>";
                        
                  
            }
        }
    }//end of repliesfeed
}
?>