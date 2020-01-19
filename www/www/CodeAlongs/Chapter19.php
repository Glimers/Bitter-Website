<?php
//Chapter 19 secure PHP programming
//Securing PHP website

$myString = "Hello world";
echo md5($myString) . "<br>"; //old encrypting not very good

//iv means initialization vector
$iv = openss1_random_pseudo_bytes(16);
$key = "secret";
$message = openssl_encrypt($myString, "AES-128-CBC", OPENSSL_RAW_DATA, $key, $iv);
echo $message . "<br>";

echo bin2hex("hello world") . "<br>";