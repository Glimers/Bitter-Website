<?php
//checkdate verifies if the date is valid and returns 1 if true
$valid = checkdate(2, 29, 2020);
echo $valid . "<br>";

//set the locale
setlocale(LC_ALL, "can-EN");

//%A - means the day of the week
//%d - day of the month
//%F - full date
//%B - month
echo strftime("%A, %B, %d, %Y") . "<br>";
        
echo date("F d, y") . "<br>";

date_default_timezone_set('America/Halifax');
//i means minutes
echo date("h:i:sa") . "<br>";

$dateArray = getdate();
print_r($dateArray);
 
//date last modified
echo "<br> this page was last modified on " . date("F d, Y h:i:sa", getlastmod()) . "<br>";

/*
//code from sprint

date_default_timezone_set('America/Halifax');
$now = new DateTime();
$dateTweeted = "2019-10-01";
$tweetTime = new DateTime($dateTweeted);                         //$result["date_created"]); //date created doesn't exist
$interval = $tweetTime->diff($now);

if ($interval->y > 1) echo $interval->format('%y years') . " ago";
elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";

//code used in sprint 3   */                                 
?>
