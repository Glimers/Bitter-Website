<?php

//include("connect.php");
class User{
    
    private $userId;
    private $password;
    private $lastName;
    private $province;
    private $contactNo;
    private $dateAdded;
    private $location;
    private $url;
    private $userName;
    private $firstName;
    private $address;
    private $postalCode;
    private $email;
    private $profImage;
    private $description;
    //CONST $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
    
    public function __get($prop) {
        return $this->$prop;
    }
    
    public function __set($prop, $value) {
        $this->$prop = $value;
    }
    
    public function __construct(int $userId, string $userName, string $password, string $firstName, string $lastName, string $address, string $province, string $postalCode, string $contactNo, string $email, string $dateAdded, string $profImage, string $location, string $description, string $url) {
        $this->userId = $userId; // might need to remove the userId part.. since on an insert i cannot figure it out til inserted??
        $this->userName = $userName;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->province = $province;
        $this->postalCode = $postalCode;
        $this->contactNo = $contactNo;
        $this->email = $email;
        $this->dateAdded = $dateAdded;
        $this->profImage = $profImage;
        $this->location = $location;
        $this->description = $description;
        $this->url = $url;
    }
    
    public function __destruct() {
        //this destroys the object
    }
    
    public static function CreateUser($con, $firstName, $lastName, $userName, $password, $address, $postalCode, $phone, $email, $url, $description, $location, $province){
      //  $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
         
        $sql = "INSERT INTO users (first_name, last_name, screen_name, password, address, province, postal_code, contact_number"
            . ", email, url, description, location) VALUES ('$firstName', '$lastName', '$userName', '$password', '$address', "
            . "'$province', '$postalCode', '$phone', '$email', '$url', '$description', '$location')";
        
        mysqli_query($con, $sql);
    
        if(mysqli_affected_rows($con) == 1){

           $msg = "Account created successfully";
           $success = "Login.php";

        }
        else{
            $msg = "Error with account creation please try again";
            $success = "Signup.php";
        }
    header("location:$success?message=$msg");
    }
    
    public static function LoginUser($con, $userName, $password){
        
        $userName =  mysqli_escape_string($con,htmlspecialchars($userName));   
        $password =  mysqli_escape_string($con,htmlspecialchars($password));
        
        
        $sql = "SELECT first_name, last_name, user_id, password, profile_pic FROM users WHERE screen_name = '$userName'";
    
    
    
    if($result = mysqli_query($con, $sql)){
        
      
        
        
        if(mysqli_num_rows($result) == 0){
            header("location:Login.php?message=Incorrect Username or Password");
        }
        //this is useful for getting number of rows
        //echo mysqli_num_rows($result) . "<br>";
        while ($row = mysqli_fetch_array($result)){
            
         
            
          $hashPassword = $row["password"];
          
          if(password_verify($password, $hashPassword) != 1){
              header("location:Login.php?message=Incorrect Username or Password");
               
          }
          else{
              //echo password_verify($password, $hashPassword);
               $_SESSION["SESS_FIRST_NAME"] = $row["first_name"];
               $_SESSION["SESS_LAST_NAME"] = $row["last_name"];
               $_SESSION["SESS_MEMBER_ID"] = $row["user_id"];
               $_SESSION["SESS_PROFILE_PIC"] = $row["profile_pic"];
               header("Location:index.php?");
          }
          //header("Location:index.php?");
         /* echo $_SESSION["SESS_FIRST_NAME"];
          echo $_SESSION["SESS_LAST_NAME"];
          echo $_SESSION["SESS_MEMBER_ID"];*/
          
          
          
        }//end while
    }//end if   
    }
    
    public static function EditUserPhoto($con){
        
        if(empty($_FILES['pic']['name'])){
        $msg = "Error: You must select a file";
    
    }
    
    $extension = $_FILES['pic']['name'];
    $x = pathinfo($extension, PATHINFO_EXTENSION);
        
    //echo $x; 
    if($x === "jpg" || $x === "jpeg" || $x === "png" || $x === "gif"){
    
        if($_FILES['pic']['size'] > (1024 * 1024 * 5)){
            unlink($_FILES['pic']['tmp_name']); //this will delete the file if too big
            $msg = "ERROR: image must be under 5MB";
        }
        else{
            
            $path = pathinfo($_FILES['pic']['name']);
            $ext = $path['extension'];  
           // echo $_FILES['pic']['name'];
            
            $newLocation = "Images/profilepics/" . $_SESSION['SESS_MEMBER_ID'] . "." .$ext;
            if(move_uploaded_file($_FILES['pic']['tmp_name'], $newLocation)){
                 

                $sql = "UPDATE users SET profile_pic = '$newLocation' WHERE user_id  = " . $_SESSION['SESS_MEMBER_ID'];

                mysqli_query($con, $sql);
                if(mysqli_affected_rows($con) == 1){
                    $msg = "Successfully added photo";
                    $_SESSION["SESS_PROFILE_PIC"] = $newLocation;
                }
                else{
                    $_SESSION["SESS_PROFILE_PIC"] = $newLocation;
                    $msg = "Profile picture updated";
                }

            }
            else{
                unlink($_FILES['pic']['tmp_name']);
                $msg = "Error handling file";

            }
            

        }
        
    }
    else{
        unlink($_FILES['pic']['tmp_name']);
        $msg = "Image must be either .jpg, .jpeg, .png or .gif";
    }
   header("location:edit_photo.php?message=$msg");
        
    }
    
    public static function WhoToFollow($con){
        $id = $_SESSION["SESS_MEMBER_ID"];
                                    
                                    $sql = "SELECT first_name, last_name, user_id, screen_name, profile_pic FROM users  WHERE user_id != $id AND "
                                            . "user_id NOT IN (SELECT to_id FROM follows WHERE from_id = $id) ORDER BY RAND() LIMIT 3";
                                    
                                    $userArray = array();
                                    $count = 0;
                                    
                                    if($result = mysqli_query($con, $sql)){
                                        while ($row = mysqli_fetch_array($result)){

                                            $fname = $row["first_name"];
                                            $lname = $row["last_name"];
                                            $memid = $row["user_id"];
                                            $sname = $row["screen_name"];
                                            $img = $row["profile_pic"];
                                            
                                            
                                            
                                            $userArray[$count] = array(substr($fname . " " . $lname . " " . "@". $sname,0,25), $memid);
                                            
                                            
                                            echo "<form method='get' action='Follow_proc.php'>";
                                            echo "<a href='userpage.php?user_id=" . $userArray[$count][1] ."'>" . "<img src='$img' id='followPhoto' >" . $userArray[$count][0] . "</a>";
                                            echo "<br>";
                                            
                                            echo "<input type='hidden'  value='" . $userArray[$count][1] ."' name='Follow'>";                                            
                                            echo "<input type='submit' class='followbutton' value='Follow'>"; 
                                            echo "<hr>";
                                           // echo "<br><br>";
                                            echo "</form>";
                                            $count ++;
                                        }
                                         
                                    }
    }
    //use user class for follow proc
    
    public static function ProfileInfo($con, $userId){
        $sql = "SELECT concat(u.first_name, ' ', u.last_name) as fullname, count(t.tweet_id) as tweets, (SELECT count(f.from_id) FROM follows f WHERE f.from_id = $userId) as follows, (SELECT count(f.to_id) FROM follows f WHERE f.to_id = $userId) as following, u.date_created, u.location FROM users u INNER JOIN tweets t ON t.user_id = u.user_id WHERE u.user_id IN (SELECT f.from_id FROM follows f WHERE f.from_id = $userId)";
        
        if($result = mysqli_query($con, $sql)){
        
            while($row = mysqli_fetch_array($result)){
                $time = $row["date_created"];
                $date = new DateTime($time);
                
                echo "<a href='userpage.php?user_id=$userId'>" . $row["fullname"] . "</a>" . "<BR></div>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>" . $row["tweets"] ."</td><td>" . $row["follows"] . "</td><td>" . $row["following"] . "</td>
				</tr></table>
				<img class='icon' src='images/location_icon.jpg'>" . $row["location"] . "<div class='bold'>Member Since:</div>
				<div>" . date_format($date, 'Y-m-d') . "</div>
				</div><BR><BR>";
            }
        }
        
            
        
        
    }//end of profile info
    
    public static function MutualFriends($con, $profileId){
        $id = $_SESSION["SESS_MEMBER_ID"];
                                    
                                    $sql = "SELECT first_name, last_name, user_id, screen_name, profile_pic FROM users  
                                            WHERE user_id != $profileId AND user_id != $id AND
                                            user_id IN (SELECT to_id FROM follows WHERE from_id = $profileId)
                                            AND user_id IN (SELECT to_id FROM follows WHERE from_id = $id) 
                                            order by rand() limit 3";
                                    
                                    $userArray = array();
                                    $count = 0;
                                    
                                    if($result = mysqli_query($con, $sql)){
                                        while ($row = mysqli_fetch_array($result)){

                                            $fname = $row["first_name"];
                                            $lname = $row["last_name"];
                                            $memid = $row["user_id"];
                                            $sname = $row["screen_name"];
                                            $img = $row["profile_pic"];
                                            
                                            
                                            
                                            $userArray[$count] = array(substr($fname . " " . $lname . " " . "@". $sname,0,25), $memid);
                                            
                                            
                                            echo "<form method='get' action='Follow_proc.php'>";
                                            echo "<a href='userpage.php?user_id=" . $userArray[$count][1] ."'>" . "<img src='$img' id='followPhoto' >" . $userArray[$count][0] . "</a>";
                                            echo "<br>";
                                            
                                            echo "<input type='hidden'  value='" . $userArray[$count][1] ."' name='Follow'>";                                            
                                            echo "<input type='submit' class='followbutton' value='Follow'>"; 
                                            echo "<hr>";
                                           // echo "<br><br>";
                                            echo "</form>";
                                            $count ++;
                                        }
                                         
                                    }
        
        
    }//end of MutualFriends
    
    public static function followersKnown($con, $profileId){
        $id = $_SESSION["SESS_MEMBER_ID"];
                                    
                                    $sql = "SELECT count(user_id) as counter FROM users  
                                            WHERE user_id != $profileId AND user_id != $id AND
                                            user_id IN (SELECT to_id FROM follows WHERE from_id = $profileId)
                                            AND user_id IN (SELECT to_id FROM follows WHERE from_id = $id) 
                                            order by rand() limit 3";
                                    
                                    $userArray = array();
                                    $count = 0;
                                    
                                    if($result = mysqli_query($con, $sql)){
                                        while ($row = mysqli_fetch_array($result)){
                                            
                                            echo $row["counter"];
                                            
                                            
                                            
                                          
                                        }
                                         
                                    }
        
        
    } //end of followersknown
    
    public static function searchPeople($con, $input){
        
        $sql = "SELECT user_id ,screen_name, first_name, last_name FROM users WHERE first_name LIKE '%$input%' OR last_name LIKE '%$input%' OR screen_name LIKE '%$input%'";
        
        if($result = mysqli_query($con, $sql)){
            while($row = mysqli_fetch_array($result)){
                
                if($row["user_id"] != $_SESSION["SESS_MEMBER_ID"]){
                echo "<a href='userpage.php?user_id=". $row["user_id"] . "'>" .$row["first_name"] . " " . $row["last_name"] . " @" . $row["screen_name"] . "</a> <br> ";
                //delete out the user_id echo
                
                $followSql = "SELECT (SELECT count(to_id) FROM follows JOIN users ON user_id = to_id WHERE from_id =" . $_SESSION["SESS_MEMBER_ID"] .
                " AND to_id =" . $row["user_id"] . ") AS following, (SELECT count(from_id) FROM follows 
                JOIN users ON user_id = to_id WHERE from_id =" . $row["user_id"] . " AND to_id =" . $_SESSION["SESS_MEMBER_ID"] . ") AS follows FROM dual";
                
                if($follow = mysqli_query($con, $followSql)){
                while($follows = mysqli_fetch_array($follow))
                {
                   // echo $test2["follows"] . " " . $test2["following"] . "<br>"; 
                    if($follows["following"] == 0){
                        //echo "follow button goes here";
                        echo "<form method='get' action='Follow_proc.php'>";                                      
                                                                     
                        echo "<input type='hidden'  value='" . $row["user_id"] ."' name='Follow'>";                                            
                        echo "<input type='submit' class='followbutton' value='Follow'>"; 
                        echo "</form>";
                    }
                    else if($follows["following"] == 1){
                        echo "Following <br>";
                    }
                    
                    if($follows["follows"] == 1){
                        echo "Follows You";                        
                    }
                    
                    
                }//end of while
                }//end of if
                echo "<br><hr>";
            }//end of if
            
                    }//end of while
        }//end of if
        
    }//end of SearchPeople

    public static function validatePostalCode($con, $firstName, $lastName, $userName, $password, $address, $postal, $phone, $email, $url, $description, $location, $prov){

        $newline = "<br />";
//Please include and reference in $path_to_wsdl variable.
$path_to_wsdl = "includes/fedex/wsdl/CountryService/CountryService_v5.wsdl";

ini_set("soap.wsdl_cache_enabled", "0");
 
$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

$request['WebAuthenticationDetail'] = array(
	'ParentCredential' => array(
		'Key' => getProperty('parentkey'), 
		'Password' => getProperty('parentpassword')
	),
	'UserCredential' => array(
		'Key' => getProperty('key'), 
		'Password' => getProperty('password')
	)
);

$request['ClientDetail'] = array(
	'AccountNumber' => getProperty('shipaccount'), 
	'MeterNumber' => getProperty('meter')
);
$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Validate Postal Code Request using PHP ***');
$request['Version'] = array(
	'ServiceId' => 'cnty', 
	'Major' => '5', 
	'Intermediate' => '0', 
	'Minor' => '1'
);

$request['Address'] = array(
	'PostalCode' => $postal,
        //'StateOrProvinceCode' => $prov,
	'CountryCode' => 'CA'
); //this piece here will have to be changed, the postal code will take in a variable the country code can stay as CA

$request['CarrierCode'] = 'FDXE';


try {
	if(setEndpoint('changeEndpoint')){
		//$newLocation = $client->__setLocation(setEndpoint('endpoint'));
                //echo "in set endpoint <br>";
	}
	
	$response = $client -> validatePostal($request);
        
    if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){  	
    	//printSuccess($client, $response);
                $province = $prov;
                switch($prov){
                    
                    case "British Columbia":
                        $prov = "BC";
                        break;
                    case "Alberta":
                        $prov = "AB";
                        break;
                    case "Saskatchewan":
                        $prov = "SK";
                        break;
                    case "Manitoba":
                        $prov = "MB";
                        break;
                    case "Ontario":
                        $prov = "ON";
                        break;
                    case "Quebec":
                        $prov = "PQ";
                        break;
                    case "New Brunswick":
                        //echo "NB is here";
                        $prov = "NB";
                        break;
                    case "Prince Edward Island":
                        $prov = "PE";
                        break;
                    case "Nova Scotia":
                        $prov = "NS";
                        break;
                    case "Newfoundland and Labrador":
                        $prov = "NF";
                        break;
                    case "Northwest Territories":
                        $prov = "NT";
                        break;
                    case "Nunavut":
                        $prov = "NT";
                        break;
                    case "Yukon":
                        $prov = "YT";
                        break;
                    default:
                        $prov = "";
                        break;
                    
                    
                }
        
        
		//loop through array that is returned in the reply
		//echo "<table>\n";
               // echo "HERE <br>";
                $provs = $response -> PostalDetail -> StateOrProvinceCode;
               // echo " " . $prov;
                if($prov == $provs){
                    //echo "Correct province";
                    //should just leave this method and continue?
                    User::CreateUser($con, $firstName, $lastName, $userName, $password, $address, $postal, $phone, $email, $url, $description, $location, $province);
                }
                else{
                    header("location:signup.php?message=Postal Code entered does not belong to Province selected");
                    //echo "<br> different";
                }
		//printPostalDetails($response -> PostalDetail, "");
		//echo "</table>\n";

	}else{
            header("location:signup.php?message=Not a valid postal code"); //redirect back to signup page
        //printError($client, $response);
    } 
    
   // writeToLog($client);    // Write to log file   
} catch (SoapFault $exception) {
   //printFault($exception, $client);        
}

function printString($spacer, $key, $value){
	if(is_bool($value)){
		if($value)$value='true';
		else $value='false';
	}
	echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
}

function printPostalDetails($details, $spacer){
	foreach($details as $key => $value){
		if(is_array($value) || is_object($value)){
        	$newSpacer = $spacer. '&nbsp;&nbsp;&nbsp;&nbsp;';
    		echo '<tr><td>'. $spacer . $key.'</td><td>&nbsp;</td></tr>';
    		printPostalDetails($value, $newSpacer);
    	}elseif(empty($value)){
			printString($spacer, $key, $value);
    	}else{
    		printString($spacer, $key, $value);
    	}
    }
}
    
}//end of validate postal

public static function SendMessage(){
    
}//end of sendMessage

public static function getMessages(){}


}

?>
