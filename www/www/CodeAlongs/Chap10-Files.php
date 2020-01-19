<?php

//Chapter 10 - Files

$path = "c:\php\students.txt";

printf("the size of the file is %s bytes<br>", filesize($path));
printf("the name of the file is %s <br>", basename($path, ".txt")); //basename($path) will give you the name with the extension
printf("folder only %s <br>", dirname($path));

//relative file paths
$relPath = "../Images/logo.jpg";
echo "absolute path is " . realpath($relPath) . "<br>";
printf("the size of the file is %s kilobytes<br>", round(filesize($relPath)/1024, 2));
echo "DISK SPACE REMAINING: " . disk_free_space('c:/') . "<br>";
echo "DISK SPACE REMAINING: " . disk_total_space('c:/') . "<br>";

date_default_timezone_set("America/Halifax");

//g means 12 hour format, G means is 24 hour format
//i means minutes with leading zeroes
//s means seconds with leading zeroes
//a means lowercase am/pm, A means uppercase AM/PM
echo "file last accessed " . date("m-d-y h:i:sa", fileatime($relPath)) . "<br>";
echo "file last modified " . date("m-d-y g:i:sa", filemtime($relPath)) . "<br>";

//open the file
//r means read
//w means write
//x means create
//w+ means read and write
//a means append
$myFile = fopen($path, "a+");
fwrite($myFile, "Johnny \r\n");
fwrite($myFile, "asdf \r\n");
rewind($myFile); // move the file pointer to the beginning of the file
while(!feof($myFile)){
    //fgets reads a line
    //fgetc reads a single character
    //fread ignores line feed character
    echo fgets($myFile) . "<br>";
    
}

fclose($myFile);

?>