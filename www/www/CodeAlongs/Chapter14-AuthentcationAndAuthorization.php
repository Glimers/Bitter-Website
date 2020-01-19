<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$myPassword = "opensesame"; //would normally be passed via a _POST

//add this to signup_proc.php
$myHashedPassword = password_hash($myPassword, PASSWORD_DEFAULT);
echo $myHashedPassword . "<br>";

//this will go on the login_proc.php
echo password_verify("opensesame", $myHashedPassword) . "<br>";


?>