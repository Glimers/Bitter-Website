<?php
//header() sends a raw HTTP header to the browser
function authenticate() {
    //echo $_SERVER["PHP_AUTH_USER"] . "<BR>";
    $_SERVER["PHP_AUTH_USER"] = $_POST['OldAuth'];
    if ((isset($_SERVER["PHP_AUTH_USER"]) && ($_SERVER['PHP_AUTH_USER'] == 'client') && 
        isset($_SERVER['PHP_AUTH_PW']) && ($_SERVER["PHP_AUTH_PW"] == 'secret'))) {
            header('HTTP/1.0 400 OK');
    }
    else {
    
        header('WWW-Authenticate: Basic realm="Test Authentication System"');
        header('HTTP/1.0 401 Unauthorized');
        echo "You must enter a valid login ID and password to access this resource\n";
    }
    exit;
}//end authenticate method

//unset($_SERVER['PHP_AUTH_USER']);
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    authenticate();
} else {
    //remember htmlspecialchars converts some predefined chars to html entities
    echo "<p>Welcome: " . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "<br />";
    
    echo "<form action='' method='post'>\n";
    echo "<input type='hidden' name='SeenBefore' value='1' />\n";
    echo "<input type='text' name='OldAuth' value=\"" . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "\" />\n";
    echo "<input type='submit' value='Re Authenticate' />\n";
    echo "</form></p>\n";
}
$myPassword = "opensesame";//would normally be passed via a POST
//add this to signup_proc.php
$myHashedPassword = password_hash($myPassword, PASSWORD_DEFAULT);
echo $myHashedPassword . "<BR>";
//this will go on the login_proc.php
echo password_verify($myPassword, $myHashedPassword) . "<BR>";
?>

