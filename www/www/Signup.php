<?php
    
    session_start();
    
    if(isset($_SESSION["SESS_MEMBER_ID"])){
        header("Location:index.php?");
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Create a Bitter Account. Sign up today to be able to access the bitter website.">
    <meta name="author" content="Ethan Steeves ethansteeves@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Signup - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    
    <script src="includes/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="includes/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="includes/Validate.js"></script>
            
               

    
                
               
	
  </head>

  <body>

    <?php include("Includes/HeaderBlank.php"); ?> 
	<BR><BR>
    <div class="container">
		<div class="row">
			
			<div class="main-login main-center">
				<h5>Sign up once and troll as many people as you like!</h5>
					<form method="post" id="registration_form" action="signup_proc.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">First Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="text" class="form-control" required name="firstname" id="firstname"  onblur="inputValue50('firstname','fnameError')" placeholder="Enter your First Name"/>
                                                                        <br>   <span id="fnameError"></span>
                                                                </div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Last Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="lastname" onblur="inputValue50('lastname', 'lnameError')" id="lastname" placeholder="Enter your Last Name"/>
                                                                        <br>   <span id="lnameError"></span>
                                                                </div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="email" class="form-control" required name="email" id="email" onblur="inputValue100('email', 'emailError')" placeholder="Enter your Email"/>
                                                                        <br>   <span id="emailError"></span>
                                                                </div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Screen Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="text" class="form-control" required name="username" id="username"  onkeyup="checkUsername()"   placeholder="Enter your Screen Name"/>
                                                                        <br>   <span id="snameError"></span>
                                                                </div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="password" class="form-control" required name="password" onblur="inputValue50('password', 'passwordError')" id="password"  placeholder="Enter your Password"/>
                                                                        <br>   <span id="passwordError"></span>
                                                                </div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="password" class="form-control" required name="confirm" onkeyup="passwordMatch()" id="confirm"  placeholder="Confirm your Password"/>
                                                                        <br>   <span id="passwordFail"></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Phone Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="phone" id="phone" onblur="phoneValid()"  placeholder="Enter your Phone Number"/>
                                                                        <br>   <span id="notPhone"></span> 
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="address" id="address" onblur="inputValue100('address', 'addressError')" placeholder="Enter your Address"/>
                                                                        <br>   <span id="addressError"></span>
                                                                </div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Province</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<select name="province" id="province" class="textfield1" required><?php echo $vprovince; ?> 
										<option> </option>
										<option value="British Columbia">British Columbia</option>
										<option value="Alberta">Alberta</option>
										<option value="Saskatchewan">Saskatchewan</option>
										<option value="Manitoba">Manitoba</option>
										<option value="Ontario">Ontario</option>
										<option value="Quebec">Quebec</option>
										<option value="New Brunswick">New Brunswick</option>
										<option value="Prince Edward Island">Prince Edward Island</option>
										<option value="Nova Scotia">Nova Scotia</option>
										<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
										<option value="Northwest Territories">Northwest Territories</option>
										<option value="Nunavut">Nunavut</option>
										<option value="Yukon">Yukon</option>
									  </select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Postal Code</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="postalCode" id="postalCode" onblur="postalCodeValid()" placeholder="Enter your Postal Code"/>
                                                                        <br>   <span id="notPostal"></span>
                                                                </div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Url</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="text" class="form-control" name="url" id="url" onblur="inputValue50('url', 'urlError')" placeholder="Enter your URL"/>
                                                                        <br>   <span id="urlError"></span>
                                                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="text" class="form-control" required name="desc" id="desc" onblur="inputValue100('desc', 'descriptionError')"  placeholder="Description of your profile"/>
                                                                        <br>   <span id="descriptionError"></span>
                                                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Location</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
                                                                    <input type="text" class="form-control" name="location" id="location" onblur="inputValue50('location', 'locationError')" placeholder="Enter your Location"/>
                                                                        <br>   <span id="locationError"></span>
                                                                </div>
							</div>
						</div>
						
						
						<div class="form-group ">
							<input type="submit" name="button" id="button" value="Register" class="btn btn-primary btn-lg btn-block login-button"/>
							
						</div>
						
					</form>
				</div>
			
		</div> <!-- end row -->
    </div><!-- /.container -->
    
  </body>
  <footer>
      <br>
      
         <a class="foot" href="ContactUs.php">Contact Us</a>
        
  </footer>
</html>

<?php

   if (isset($_GET["message"])){
        $message = $_GET["message"];
        echo "<script>alert('$message')</script>";
    }

?>