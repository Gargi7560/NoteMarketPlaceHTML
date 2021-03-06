<?php
    
    //Settings from Config file
    include '../common/configuration.php';

    global $error;

    if(isset($_REQUEST['submit'])){
    
    //Server Side Validation
    function validate(){
        
        $error=0;
        $errorMessages = [];
        
        if(isset($_POST['email'])){
            $email=$_POST['email'];
            if($email==""){
                $error=1;
                $errorMessages[] = 'Please fill the email';
            }
        }
        if(isset($_POST['password'])){
            $password=$_POST['password'];
            if($password==""){
                $error=1;
                $errorMessages[] = 'Please fill the password';
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
    
    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $validate = validate();

    if($validate[0]=='success'){
        
    unset($validate);

        if(isset($_POST['email'],$_POST['password'])){
            $email = $_POST['email'];
            $password = MD5($_POST['password']);
            
            
            if ($email != "" && $password != ""){
                
                $query = "SELECT UserID,UserRoleID,FirstName,LastName,Email,Password FROM users WHERE IsEmailVerified = 1 AND IsActive = 1 AND Email='".$email."' AND Password='".$password."'";
                
                $result = $db_handle->runQuery($query);
                
                if($result != ""){
                    
                    $email = $result[0]['Email'];
                    $userId = $result[0]['UserID'];
                    $userFirstName = $result[0]['FirstName'];
                    $userLastName = $result[0]['LastName'];
                    $userRoleID = $result[0]['UserRoleID'];
                    
                    $profileQuery = "SELECT ProfilePicture,UserID FROM userprofiledetails Where UserID = ".$userId;
            
                    $profileResult = $db_handle->runQuery($profileQuery);
                    
                    if($profileResult > 0) {
                        
                        $profilePic = $profileResult[0]['ProfilePicture'];
                        
                    } else {
                        
                        $defaultProfilePic = "SELECT `Key`, `Value` FROM systemconfiguration WHERE `Key` = 'DefaultProfilePicture'";
                            
                        $defaultProfilePicResult = $db_handle->runQuery($defaultProfilePic);
                        
                        $profilePic = $defaultProfilePicResult[0]['Value'];
                    }
                    session_start();
                    $_SESSION['user'] = $email;
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['user_fname'] = $userFirstName;
                    $_SESSION['user_lname'] = $userLastName;
                    $_SESSION['profile_pic'] = $profilePic;
                    $_SESSION['user_roleID'] = $userRoleID;
                    
                    //Set Cookies
                    if(isset($_POST['remember'])){
                        setcookie('email',$_POST['email'],time()+60*60*7);
                        setcookie('password',$_POST['password'],time()+60*60*7);
                    }
                    
                    if($userRoleID == $adminUserRoleID OR $userRoleID == $superAdminUserRoleID){
                        // Redirect User to Admin portal 
                        header("location:../admin/admin_dashboard-1.php");
                        exit();
                    }
                    else {
                        $userQuery = "SELECT 1 FROM userprofiledetails WHERE UserID = " . $userId;
	                    $count = $db_handle->numRows($userQuery);
                        
                        if($count>0){
                            // Redirect User to Member Portal
                            header("location:search_note.php");
                            exit();
                        } else {
                            header("location:user_profile.php");
                            exit();
                        }
                    }
                } else {
                    $validate[] = "Invalid Credentials. Please try again!";
                }
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

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">

    <script type="text/javascript">

        reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        reForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/;
        
        function loginValidateEmail() {

            isLoginValidEmail = false;

            if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please fill out email field.");
                isLoginValidEmail = false;
            } else if (!reForEmail.test($("#email").val())) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please enter valid email.");
                isValidEmail = false;
            } else {
                $("#email").removeClass("borderHighlight");
                $("#emailVal").css("visibility", "hidden");
                isLoginValidEmail = true;
            }
            return isLoginValidEmail;
        }

        function loginValidatePassword() {

            isLoginValidPassword = false;

            if ($("#password").val() == "" || $("#password").val() == null || $("#password").val().trim().length == 0) {
                $("#password").focusin();
                $("#password").addClass("borderHighlight");
                $("#passwordVal").css("visibility", "visible");
                $("#passwordVal").html("Please fill out password field.");
                isLoginValidPassword = false;
            } else if (!reForPassword.test($("#password").val())) {
                $("#password").focusin();
                $("#password").addClass("borderHighlight");
                $("#passwordVal").css("visibility", "visible");
                $("#passwordVal").html("Please enter valid password.");
                isValidPassword = false;
            } else {
                $("#password").removeClass("borderHighlight");
                $("#passwordVal").css("visibility", "hidden");
                isLoginValidPassword = true;
            }
            return isLoginValidPassword;
        }

        function loginValidateForm() {

            isLoginValidateForm = false;

            isLoginValidEmail = loginValidateEmail();
            isLoginValidPassword = loginValidatePassword();

            if (isLoginValidEmail && isLoginValidPassword) {
                isLoginValidateForm = true;
            }
            return isLoginValidateForm;
        }
    </script>

</head>

<body data-spy="scroll" class="overflow-auto">

    <!--Login Page-->
    <section id="login">

        <!--Background Image-->
        <div class="back-cover-img" style="background-image: url(images/login/banner-with-overlay.jpg);"></div>

        <!--Inner Login Box Content-->
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
                                        <span class="common-heading-1 center_heading-1">Login</span>
                                        <p class="center_heading-1">Enter your email address and password to login</p>
                                    </div>
                                    
                                    <!--Server side validation error message print-->
                                    <?php
                                    if(isset($validate) && $validate[0] != 'success'){
                                            foreach($validate as $error){
                                    ?>
                                    <p style="color:#ea4748"><?php echo $error ; ?></p>
                                    <?php
                                            }
                                        }
                                    ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return loginValidateForm();">
                                        <div class="form-group form-common">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control input_val" id="email" name="email" placeholder="Enter your email" <?php if(isset($_COOKIE['email'])) { 
                                                echo " value ='".$_COOKIE['email']."'";
                                            } ?> onblur="loginValidateEmail();">
                                            <span id="emailVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="form-group form-common">
                                            <label for="password">Password</label>
                                            <a href="user_forgot_pwd.php" class="btn-blue pull-right">Forgot Password?</a>
                                            <input type="password" class="form-control input_val" id="password" name="password" placeholder="Enter your password" <?php if(isset($_COOKIE['password'])) { 
                                                echo " value ='".$_COOKIE['password']."'";
                                            } ?> onblur="loginValidatePassword();">
                                            <i class="common-icon pull-right"><img src="images/login/eye.png" onclick="showPassword('password');"/></i>
                                            <span id="passwordVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="form-group form-check form-common">
                                            <input type="checkbox" class="form-check-input checkbox-common" id="remember" name="remember">
                                            <label class="form-check-label check-lab1" for="remember">Remember Me</label>
                                        </div>
                                        <div class="general-btn">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block btn-purple" name="submit" value="LOGIN">
                                        </div>
                                        <div class="sign-up">
                                            <span class="sign-btn">Don't have an account?</span>
                                            <a href="user_sign_up.php" class="btn-blue">Sign Up</a>
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

</body>

</html>