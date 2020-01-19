<?php
//Chapter 8 - Errors and Exception Handling
try{
    if(!mysqli_connect("localhost", "username", "password", "schema")){
        throw new Exception("Error connecting to database");
    }//end if
    else{
        echo "SUCCESSFUL!<BR>";
    }
}//end try
catch (Exception $ex){
    error_log("ERROR IN FILE: " . $ex->getFile() . " on line# " . $ex->getLine() . $ex->getMessage());
    echo "could not connect to database<BR>";
    exit; //stops execution of the program
}//end catch

echo "More logic here<br>";

?>

