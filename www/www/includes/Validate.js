/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 function phoneValid() {
                     var number = document.getElementById("phone").value;
                     var pattern = /^\(\d{3}\)()|( )?\d{3}(-)|( )\d{4}$/; 
  
                    if(pattern.test(number) == true){
                     //console.log("true");
                     document.getElementById("notPhone").innerHTML = "";
                     enableButton();
                    }
                    else{
                    //console.log("false");
                    document.getElementById("notPhone").innerHTML = "Please enter a valid Phone Number (xxx)xxx-xxxx";
                    disableButton();
                    }
                      
                }; //end of phoneValid
                
                function postalCodeValid() {
                    var postalCode = document.getElementById("postalCode").value;
                    var pattern = /^[A-Za-z][0-9][A-Za-z][ ][0-9][A-Za-z][0-9]$/i;
                    
                    if(pattern.test(postalCode) == true){
                        //console.log("true");
                        document.getElementById("notPostal").innerHTML = "";
                        enableButton();
                    }
                    else{
                        //console.log("false");
                        document.getElementById("notPostal").innerHTML = "Please enter a valid Postal Code A1A 1A1";
                        disableButton();
                    }
                
                }; //end of postalCodeValid
                
                function passwordMatch(){
                    var password1 = document.getElementById("password").value;
                    var confirm = document.getElementById("confirm").value;
                    
                    if(password1 != confirm){
                        document.getElementById("passwordFail").innerHTML = "Password does not match";
                        disableButton();
                    }
                    else { 
                        document.getElementById("passwordFail").innerHTML = "";
                        enableButton();
                    }
                    
                    
                }//end of passwordMatch
                
                function inputValue50(txtboxId, spanId){
                    var txtNum = document.getElementById(txtboxId).value;
                    
                    if(txtNum.length >= 50){
                       document.getElementById(spanId).innerHTML = "Input value must be less than 50 characters";
                       disableButton();
                    }
                    else{
                        document.getElementById(spanId).innerHTML = "";
                        enableButton();
                    }                    
                     
                } //end of inputValue50
                
                function inputValue100(txtboxId, spanId){
                    var txtNum = document.getElementById(txtboxId).value;
                    
                    if(txtNum.length >= 100){
                       document.getElementById(spanId).innerHTML = "Input value must be less than 100 characters";
                       disableButton();
                    }
                    else{
                        document.getElementById(spanId).innerHTML = "";
                        enableButton();
                    }                   
                     
                } //end of inputValue100
                
                function disableButton () {
                    document.getElementById("button").disabled = true;
                } //end of disableButton
                function enableButton() {
                    document.getElementById("button").disabled = false;
                } //end of enableButton
               
            function frm_submit(){
                $.get(
                    "CodeAlongs/Chap20_AJAX/Chap20_proc.php",
                    $("#registration_form").serializeArray(),
                    function(data) {//anonymous function
                        //alert(data); //use this for debugging
                        //write the resulting message back to the mySpan tag
                      $("#snameError").text(data.msg);
                      
                      /*if($("#snameError").text() === "sorry username is already taken, please try again") disableButton();
                      else enableButton();*/
                      
                    },
                    "json" //change this to HTML for debugging
                ); //end of the get function call
                return true;
            }
    
    function checkUsername(){
                  var txtNum = document.getElementById("username").value;
                    
                    if(txtNum.length >= 50){
                       document.getElementById("snameError").innerHTML = "Input value must be less than 50 characters";
                       disableButton();
                    }
                    else{
                        $.get(
                    "CodeAlongs/Chap20_AJAX/Chap20_proc.php",
                    $("#registration_form").serializeArray(),
                    function(data) {//anonymous function
                        //alert(data); //use this for debugging
                        //write the resulting message back to the mySpan tag
                      $("#snameError").text(data.msg);
                      
                      if($("#snameError").text() === "sorry username is already taken, please try again") disableButton();
                      else enableButton();
                      
                    },
                    "json" //change this to HTML for debugging
                ); //end of the get function call
                return true;        
             }
                        
                    }  //end of checkUsername   
                
               
   
                