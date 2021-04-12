<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    global $error;
    
    if(isset($_REQUEST['submit'])){
          
        //Server Side Validation
        function validate(){
            
            $db_handle = new DBController();
            $error=0;
            $errorMessages = [];
            
            if(isset($_POST['oldPassword'])){
                $oldPassword=$_POST['oldPassword'];
                if($oldPassword==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the password field';
                } 
            }
            if(isset($_POST['newPassword'])){
                $newPassword=$_POST['newPassword'];
                if($newPassword==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the password field';
                }
                else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/", $newPassword)){
                    $error=1;
                    $errorMessages[] = 'Enter valid password';
                }
            }
            if(isset($_POST['newConPassword'])){
                $newConPassword=$_POST['newConPassword'];
                if($newConPassword==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the confirm password field';
                }
                else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/", $newConPassword)){
                    $error=1;
                    $errorMessages[] = 'Enter valid confirm password';
                }
                else if($newPassword != $newConPassword) {
                    $error=1;
                    $errorMessages[] = 'Password and Confirm Password do not match';
                }
            }
            if($error){
                return $errorMessages;
            }else{
                $errorMessages[] = 'success';
                return $errorMessages;        
            }
        }
    }
    
    if(isset($_REQUEST['submit'])) {

        $validate = validate();
        if($validate[0]=='success'){
            unset($validate);
            $db_handle = new DBController();
            if(isset($_POST['newPassword'],$_POST['oldPassword'])){
                $oldPassword = MD5($_POST['oldPassword']);
                
                $checkOldPassQuery = "SELECT 1 FROM users WHERE UserID = ".$_SESSION['user_id']." AND Password = '".$oldPassword."'";
                
                $checkOldPassQueryResult = $db_handle->numRows($checkOldPassQuery);
                
                if($checkOldPassQueryResult > 0){
                    
                $newPassword = MD5($_POST['newPassword']);
                
                $setNewPassQuery = "UPDATE users SET Password = '".$newPassword."' WHERE UserID =".$_SESSION['user_id'];
                
                $setNewPassResult = $db_handle->updateQuery($setNewPassQuery);
                
                echo '<script>alert("Password has been changed successfully and you have to re-login with new password.")</script>';
                echo '<script>window.location.replace("logout.php")</script>'; 
                    
                } else {
                  $validate[] = 'Your old password is incorrect.';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!--important meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Title-->
    <title>Notes MarketPlace</title>
    
    <!--Favicon-->
    <link rel="shortcut icon" href="images/login/favicon.ico">
    
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">
    
    <script>
        reForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/;
        
        function validateChangePassword() {

            isValidChangePassword = false;

            if ($("#newPassword").val() == "" || $("#newPassword").val() == null || $("#newPassword").val().trim().length == 0) {
                $("#newPassword").focusin();
                $("#newPassword").addClass("borderHighlight");
                $("#newPasswordVal").css("visibility", "visible");
                $("#newPasswordVal").html("Please fill the password field.");
                isValidChangePassword = false;
            } else if (!reForPassword.test($("#newPassword").val())) {
                $("#newPassword").focusin();
                $("#newPassword").addClass("borderHighlight");
                $("#newPasswordVal").css("visibility", "visible");
                $("#newPasswordVal").html("Please enter valid password.");
                isValidChangePassword = false;
            } else {
                $("#newPassword").removeClass("borderHighlight");
                $("#newPasswordVal").css("visibility", "hidden");
                isValidChangePassword = true;
            }            
            return isValidChangePassword;
        }
        function validateChangeConPassword() {

            isValidChangeConPassword = false;

            if ($("#newConPassword").val() == "" || $("#newConPassword").val() == null || $("#newConPassword").val().trim().length == 0) {
                $("#newConPassword").focusin();
                $("#newConPassword").addClass("borderHighlight");
                $("#newConPasswordVal").css("visibility", "visible");
                $("#newConPasswordVal").html("Please fill the confirm password field.");
                isValidChangeConPassword = false;
            } else if (!reForPassword.test($("#newConPassword").val())) {
                $("#newConPassword").focusin();
                $("#newConPassword").addClass("borderHighlight");
                $("#newConPasswordVal").css("visibility", "visible");
                $("#newConPasswordVal").html("Please enter valid confirm password");
                isValidChangeConPassword = false;
            } else if ($('#newPassword').val() != $('#newConPassword').val()) {
                $("#newConPassword").focusin();
                $("#newConPassword").addClass("borderHighlight");
                $("#newConPasswordVal").css("visibility", "visible");
                $("#newConPasswordVal").html("Password and Confirm Password don't match.");
                isValidChangeConPassword = false;
            } else {
                $("#newConPassword").removeClass("borderHighlight");
                $("#newConPasswordVal").css("visibility", "hidden");
                isValidChangeConPassword = true;
            }
            return isValidChangeConPassword;
        }
        
        function validateChangePasswordForm() {

            isValidChangePasswordForm = false;

            isValidChangePassword = validateChangePassword();
            isValidChangeConPassword = validateChangeConPassword();

            if (isValidChangePassword && isValidChangeConPassword) {
                isValidChangePasswordForm = true;
            }
            return true;
        }
    </script>
</head>

<body data-spy="scroll" class="overflow-auto">

    <!--Change Password Page-->
    <section id="change_pwd">
           
        <!--Background Image-->
        <div class="back-cover-img" style="background-image: url(images/login/banner-with-overlay.jpg);"></div>
        
        <!--Inner Content-->
        <div class="center-div">
        <div class="container">
            <div class="content-box-sm">
            <div class="row">
                <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
                <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                    <div class="login-content">
                        <div class="login-logo">
	                       <img src="images/login/top-logo.png" alt="Logo" class="img-responsive note-img">
	                    </div>
                        <div class="login-details">
                            <div class="home-heading">
                                <span class="common-heading-1 center_heading-1">Change Password</span>
                                <p class="center_heading-1">Enter your new password to change your password</p> 
                                <?php if(isset($message)){ ?>
                                    <p class="successMsg"><img src="images/login/SUCCESS.png" alt="success">
                                    <?php echo $message ;?>
                                    </p>
                                <?php } ?>   
                            </div>
                            <?php
                                if(isset($validate) && $validate[0] != 'success'){
                                    foreach($validate as $error){
                                ?>
                                <p style="color:#ea4748"><?php echo $error ; ?></p>
                                <?php
                                    }
                                }
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateChangePasswordForm();">
	                            <div class="form-group form-common">
	                                <label for="oldPassword">Old Password</label>
	                                <input type="password" class="form-control input_val" id="oldPassword" name="oldPassword" placeholder="Enter your old password">
	                                <i class="common-icon pull-right"><img src="images/login/eye.png" onclick="showPassword('oldPassword');" /></i>
										
                                    <span class="spnValMsg"></span>
	                            </div>
                                <div class="form-group form-common">
	                                <label for="newPassword">New Password</label>
	                                <input type="password" class="form-control input_val" id="newPassword" name="newPassword" placeholder="Enter your new password" onblur="validateChangePassword();">
	                                <i class="common-icon pull-right"><img src="images/login/eye.png" onclick="showPassword('newPassword');" /></i>
										
                                    <span class="spnValMsg" id="newPasswordVal"></span>
	                            </div>
	                            <div class="form-group form-common">
	                                <label for="newConPassword">Confirm Password</label>
	                                <input type="password" class="form-control input_val" id="newConPassword" name="newConPassword" placeholder="Re-enter your password" onblur="validateChangeConPassword();">
	                                <i class="common-icon pull-right"><img src="images/login/eye.png" onclick="showPassword('newConPassword');" /></i>
										
                                    <span class="spnValMsg" id="newConPasswordVal"></span>
	                            </div>
	                            <div class="general-btn">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block btn-purple" name="submit" value="SUBMIT" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
            </div>
            </div>
        </div>
        </div>
    </section>
    
    <!--JQuery-->
    <script src="js/jquery.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
</body>

</html>