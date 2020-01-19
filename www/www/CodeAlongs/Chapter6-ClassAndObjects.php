<?php

//create an instance of the student class

 include("Chapter6-Student.php");
 
 $s = new Student("Ethan", 5026354); //uses the default constructor
 $s -> studentId = 123456;
 echo $s->studentId .  "<br>";
 
 //call the static method
 Student::PrintSchool();
 DoStuff($s);
 
 
 function DoStuff(Student $s){
    echo $s->name . "<br>";
 }
 
?>

