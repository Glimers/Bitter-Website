<?php 
//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php
session_start();

if(isset($_POST["username"])){
    
    include("connect.php");
    include("Users.php");
    
    User::LoginUser($con, $_POST["username"], $_POST["password"]);
    
    
}

?>