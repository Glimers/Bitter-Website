<?php
$colours[0] = "Red";
$colours[1] = "Blue";
$colours[2] = "White";

//easier way
$colours = [5=>"Red", "blue", "white"];

//associative array
//$grades = ["jimmy" => 98, "johnny" =>  66];
$grades = array("jimmy" => 98, "johnny" =>  66);


//2-dimensional array
$twoDArray = array("jimmy" => array("Math" => 98, "Science" => 99, "French" => 91),
                    "johnny" => array("Math" => 87, "Science" => 93, "French" => 100),
                    "Suzie" => array("Math" => 77, "Science" => 78, "French" => 79));

foreach ($twoDArray as $student){
    echo $student["Math"] . " " . $student["Science"] . "<br>";
}

$students = file("students.txt"); //read the file as an array
foreach ($students as $student){
    list($name, $hometown, $gpa) = explode("|", $student);
    echo $name . " " . $hometown . " " . $gpa . "<br>";
}

//populate an array with a range
$myNums = range(0, 100); //or range("A", "F")
//print_r($myNums); //print out an array

array_unshift($colours, "purple"); //add to the beginning of an array
array_push($colours, "yellow"); //add to the end of the array
array_shift($colours); //removes element from the beginning of the array
array_pop($colours); //removes element from the end of the array
print_r($colours);

if (in_array("Red", $colours)) echo "Found<br>";
else echo "Not found<br>";

//how many items are in my array
echo "<br>" . count($colours) . " elements<br>";
echo sizeof($colours) . " alias of count<br>";

print_r(array_reverse($colours)); //  presents the array backwards
echo "<br>";
print_r(array_flip($colours)); //flips the key and content of the array used for reverse searching
echo "<br>";


//sort (ascii order by default)

sort($colours, SORT_NATURAL);
natcasesort($colours);
$colours2 = array("black", "orange");
//merge array
$newArray = array_merge($colours, $colours2);

print_r($newArray);

//echo $colours[7] . "<br>";


