<?php

session_start();

if(isset($_SESSION["name"])){
    echo "You are logged in <br>";
}
else{
    echo "You are not logged in <br>"; //instead of saying you are not logged in redirect them to the login page
}

$students = array("Nick", "Jim", "John", "Jill");
$jStudents = preg_grep("/^j/i", $students);
print_r($jStudents);
echo "<br>";

$myString = "The lion, the witch and the wardrobe";
echo preg_match_all("/the/i", $myString, $myMatches) . "<br>";
print_r($myMatches);
echo "<br>";

$myString = "the price is $19.99*-+=)(";      
echo preg_quote($myString) . "<br>";             //this is useful for escaping characters.. like for insert on a database

$myString = "PHP is my favorite programming language";
//$myString = preg_replace("/PHP/", "Java", $myString); //replacing PHP with java
$myString = preg_filter("/PHP1/", "Java", $myString);
echo $myString . "<br>";

$myString = "this|is|a|sentence";
$myArray = preg_split("/\|/", $myString);
print_r($myArray);
echo "<br>";

echo strlen($myString) . "<br>"; //length of the string
$string1 = "HELLO WORLD";
$string2 = "hello world";
echo strcmp($string2, $string1) . "<br>"; //compare 2 strings
//in case above returns 1 because string 1 is bigger than string 2
echo strcasecmp($string2, $string1) . "<br>"; //ignores case returns 0 because they are equal

echo strtolower($string1) . "<br>"; //converts to lowercase
echo ucfirst($string2) . "<br>"; //ucfirst capitalizes first letter of the string
echo lcfirst($string1) . "<br>"; //lcfirst makes first letter lower case

$myString = "+ & ^ % $ è ©";
echo htmlentities($myString) . "<br>";
        
$myString = "BIlly O'donnell";
echo addslashes($myString) . "<br>";

// mysqli_real_escape_string($con (a connection object goes here),$myString); //use this in insert or update statements so it escapes and special characters
//use this in PHP project

$myString = "Java <br> is <br> awesome <br>";
echo $myString;
echo strip_tags($myString); //this is to remove tags from someone who tries to input tags