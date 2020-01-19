<?php
//this page will be used when the user clicks on the "follow" button for a particular user
//process the transaction and insert a record into the database, then redirect the user back
// to index.php
session_start();
include("connect.php");

$follower = $_SESSION["SESS_MEMBER_ID"];
$following = $_GET["Follow"];

$check = "SELECT follow_id FROM follows WHERE from_id = '$follower' && to_id = '$following'";

if(isset($_GET["Follow"])){
    
    $insert = "INSERT INTO follows (from_id, to_id) VALUES ('$follower', '$following')";
    if($result = mysqli_query($con, $check)){
       
        if(mysqli_num_rows($result) == 1){
           //echo $_GET["Follow"];
           header("Location:index.php?message=Already Following");

        }
        else {
            mysqli_query($con, $insert);

            if(mysqli_affected_rows($con) == 1){
                header("Location:index.php?message=Followed");
            }

        }
    }
}
else{
    header("Location:index.php");
}



?>