<?php
if (isset($_POST["txtName"])) {
    //won't get here the first time you visit the page
    //will only get if a form has been submitted via post
    
    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    echo $name . " " . $email . "<BR>";
    
    include("../../connect.php");
    //for this code to work go to connect.php and uncomment define(dbname, productsdemo)
    
    /*
    define("DB_HOST", "localhost"); // these lines needed to make database connection
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "productsdemo");
    
    global $con;
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
    
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
     
     */
    $sql = "select * from products";  
    
    if($result = mysqli_query($con, $sql)){
        //this is useful for getting number of rows
        //echo mysqli_num_rows($result) . "<br>";
        while ($row = mysqli_fetch_array($result)){
            
          echo $row["ID"] . " " . $row["Category"] . " " . $row["Description"] . "<BR>";
        }//end while
    }//end if
    
    //insert statement
    $prodId = 10; //this is suppose to be unique
    $category = "Sportswear";
    $description = "Hockey Stick";
    $price = 29.99;
    $sql = "INSERT INTO Products (ID, Category, Description, Price, Image) VALUES ($prodId, '$category', '$description', $price, 10)";
    mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1){
        echo "INSERT SUCCESSFUL<BR>";
    }
    else{
        echo "ERROR ON INSERT<BR>";
    }//end if
    
    //DELETE STATEMENT
   /* $sql = "DELETE FROM products WHERE ID = $prodId";
    mysqli_query($con, $sql);
    echo (mysqli_affected_rows($con) == 1) ? "DELETE SUCCESSFUL<BR>" : "DELETE FAILED<BR>";
    */
    
    //UPDATE statement
    $description = "baseball bat";
    $sql = "UPDATE products SET Description = '$description' WHERE ID = $prodId";
    mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1){
        $msg= "update successful<br>";
    }
    else if(mysqli_affected_rows($con) == 0) {
        $msg = "no records updated<br>";
    }
    else {
        $msg = "multiple records updated<br>";
    }
    
    
} // end BIG if statement

//a header redirect will send the user to another page
//? is the URL querystring
//used for sendng data via a GET
header("location:chap27.php?message=$msg"); //this line is very important

    ?>

