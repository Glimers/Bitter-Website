<?php
$format = "xml";
$url = "http://localhost/codealongs/Chapter18/MyFirstWS.php?temp=20&format=$format";
// cURL is versatile set of libraries that allow PHP to send/retrieve data via HTTP
//Google and Amazon (AWS) use web services a lot

$cobj = curl_init($url);
curl_setopt($cobj, CURLOPT_RETURNTRANSFER, 1); //returns teh results to me, instead of displaying it directly on the screen
$data = curl_exec($cobj);
curl_close($cobj); //don't forget to close it 


if($format == "json"){
    $object = json_decode($data); //convert it back to an array


    //echo $data;
    echo $object->{"temp"}; //dereferencing the array object
    //echo print_r($object);
}
else{//xml
    $xmlObject = simplexml_load_string($data);
    //print_r($xmlObject);
    echo "the temp in F is: " . $xmlObject ->temp;
    
}
?>