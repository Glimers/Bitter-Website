<?php
//type-hinting will throw an exception if the type doesn't match
function AddNumber(int $x, int $y) {
    
    return $x+$y;
    
}//end addNumbers



function PrintMessage(&$x, $z=2){ // & means by-reference
    $x = "Bonjour Monde"; //change to arguement inside the function
    echo $x . "<br>";
    echo $z . "<br>";
    
}

function Factorial($num){
    
    if($num == 1) return 1; //base case
    else return $num * Factorial ($num - 1);
    
   /* $sum = 1;
    for($i=1; $i<=$num ; $i++){
        $sum*= $i;
    }
    return $sum;*/
    
}


echo AddNumber(5, 6) . "<br>";
echo rand(1, 6) . "<br>";
echo getrandmax() . "<br>";
echo Factorial(10) . "<br>";
$myMessage = "Hello world";
PrintMessage($myMessage);
echo $myMessage . "<br>";