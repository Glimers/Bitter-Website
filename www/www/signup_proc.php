<?php 
require_once('includes/Fedex/fedex-common.php');
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

if(isset($_POST["firstname"])){
    include ("connect.php");
    include("Users.php");
    
    $firstName = mysqli_escape_string($con,htmlspecialchars($_POST["firstname"]));
    $lastName = mysqli_escape_string($con,htmlspecialchars($_POST["lastname"]));
    $email = mysqli_escape_string($con,htmlspecialchars($_POST["email"]));
    $userName = mysqli_escape_string($con,htmlspecialchars($_POST["username"]));
    $password = mysqli_escape_string($con,htmlspecialchars($_POST["password"]));
    $password = mysqli_escape_string($con,htmlspecialchars(password_hash($password, PASSWORD_DEFAULT)));
   // $confirmPassword = preg_quote($_POST["confirm"]);
    $phone = mysqli_escape_string($con,htmlspecialchars($_POST["phone"]));
    $address = mysqli_escape_string($con,htmlspecialchars($_POST["address"]));
    $province = mysqli_escape_string($con,htmlspecialchars($_POST["province"]));
    $postalCode = mysqli_escape_string($con,htmlspecialchars($_POST["postalCode"]));
    $url = mysqli_escape_string($con,htmlspecialchars($_POST["url"]));
    $description = mysqli_escape_string($con,htmlspecialchars($_POST["desc"]));
    $location = mysqli_escape_string($con,htmlspecialchars($_POST["location"]));
    
    User::validatePostalCode($con, $firstName, $lastName, $userName, $password, $address, $postalCode, $phone, $email, $url, $description, $location, $province);
    //User::CreateUser();
    
}
?>