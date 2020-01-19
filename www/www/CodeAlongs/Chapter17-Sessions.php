<?php

//Chapter 17 - Sessions

//cookie is a small text file stored on your computer - limited size 4KB - Security issues
//session replaced cookies
//session variables are stored on the RAM of the server
//echo $_SESSION["name"]; //this won't work here because the session needs to be first

session_start(); //USE THIS EVERY TIME YOU WANT TO USE SESSION VARIABLES

//Set the session variable
$_SESSION["name"] = "Ethan"; //this would be similar to what will be on login_proc however "Ethan" will probably be a variable with $_POST

//Retrieve the session variable
echo $_SESSION["name"] . "<br>";

echo session_id() . " my session ID<br>";

echo session_encode() . " ALL MY SESSION VARS<br>";
$mySession = session_encode();
echo session_decode($mySession) . "<br>";

session_unset(); //removes all variables from session
session_destroy(); //kills the session completely
