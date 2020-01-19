<?php 
//this file will handle the file uploading and return the user back to the edit_photo page.
include("connect.php");
session_start();

//echo $_SESSION['SESS_MEMBER_ID'];


if(isset($_POST['submit'])){
   
    include("Users.php");
    User::EditUserPhoto($con);
    /*
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
   header("location:edit_photo.php?message=$msg");*/
}

?>