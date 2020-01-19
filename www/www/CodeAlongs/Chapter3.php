<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chapter 3 PHP</title>
    </head>
    <body>
        <?php
        // put your code here
        /*mutli line comment */
        
        echo "<script>alert(\"Hello\")</script>";
        
        $x = 5;
        $myName = "Ethan";
        echo $myName . "<br>"; // . is string conatenation  
        echo ++$x . "<br>";
        echo $myName .= " Steeves<br>"; // .= concatenation and assign similar to += in C#
        print "Hello World<br>";
        printf("hello %s<br>", $myName);
        
        // scalar variables is used to hold a single value
        //boolean, int, float, string
        $value = (bool) true;
        $value = 'hello world';
        $value = 0755; //octal
        $value = 0xabc; //hex
        echo $value . " boolean value<BR>";
        //arrays will be covered (the hold multiple values
        $students[0] = "Jimmy";
        $students[1] = "John";
        $students[2] = "suzie";
        
        $X = 50; //this is different than $x
        
        $myVar = "5";
        $myVar2 = "10";
        //type-juggling 
        echo $myVar + $myVar2 . "<BR>";
        echo gettype($myVar2) . "<BR>";
        
        //by reference variables **
        $myVar2 =& $myVar;
        $myVar = 5600;
        echo $myVar2 . "<BR>";
        
        //const PI = 3.14159; //no $ on constants, $ is only for variables
        define("PI", 3.14);
        echo PI . "<br>";
        echo "<pre>";
        $count = 0;
        $count++; //increment the count variable
        echo $count . "<br>";
        if($count == 0){
            echo "zero<br>";
        }
        elseif($count > 0){//this is different
            echo "greater than 0\r\n";
        }
        else{
            echo $count> " count<br>";
        }
        echo "</pre>";
        $a = 5;
        $b = "5";
        if($a === $b){
            echo "equal<br>";
        }
        else {
            echo "Not equal<br>";
        }
        // <=> spaceship operator returns 1, 0, -1 is it's greater than, equal, less
        echo ($a <=> $b) . "<br>";
        
        //switch statement
         $color = "red";
         switch ($color){
            case "red":
                echo "Red<br>";
                break; 
            case "blue":
                echo "Blue<br>";
                break;
            default:
                echo "DEFUALT<BR>";
             
         }//end switch
        
         while(true){
             if($color == "red") break;
         }//end while
         $i = 0;
         do{
             echo pow($i,2) . "<br>";
             $i++; //don't forget to increment the counter
         }
         while($i<10);
         
         for ($i=0;$i<10;$i++){
             if($i == 5) continue; //skip the current iteration
         }
        ?>
        
        <!-- short circuit tag -->
        This is a <?=$myName;?> sentence using a short circuit tag.
        
    </body>
</html>
