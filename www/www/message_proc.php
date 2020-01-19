<?php
session_start();
include("connect.php");
$userName = $_GET["username"];
$message = $_GET["myMessage"];

//echo $userName . $message;

$sql = "SELECT user_id FROM users WHERE screen_name = '$userName'";

if($result = mysqli_query($con, $sql)){
    while($row = mysqli_fetch_array($result)){
        $user_id = $row["user_id"];
        
        $insertSql = "INSERT INTO messages (from_id, to_id, message_text) VALUES ('" . $_SESSION["SESS_MEMBER_ID"] . "', '$user_id', '$message')";
        
        mysqli_query($con, $insertSql);
        
        if(mysqli_affected_rows($con) == 1){
            $msg  = "Message sent to $userName";
            $success = "DirectMessage.php";
        }
        else{
            $msg = "Error sending message please try again later";
            $success = "DirectMessage.php";
        }
        header("location:$success?message?$msg");
        
    }
}

