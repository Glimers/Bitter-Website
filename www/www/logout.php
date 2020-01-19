<?php
    session_start();
    session_unset(); //removes all variables from session
    session_destroy(); //kills the session completely
    
    header("Location:Login.php?msg=login");
    
    
//log the user out and redirect them back to the login page.
?>
