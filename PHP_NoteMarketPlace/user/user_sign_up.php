<?php

    //Settings from Config file
    include 'configuration.php';

    global $error;
       
    if(isset($_REQUEST['submit'])){
          
    //Server Side Validation
    function validate(){
        $error=0;
        $errorMessages = [];
        
        if(isset($_POST['fname'])){
            $fname=$_POST['fname'];
            if($fname==""){
                $error=1;
                $errorMessages[] = 'Please fill the firstname';
            }
            else if(!preg_match("/^[A-Za-z]+$/", $fname)){
                $error=1;
                $errorMessages[] = 'Enter only alphabets in firstname';
            }
        }
        if(isset($_POST['lname'])){
            $lname=$_POST['lname'];
            if($lname==""){
                $error=1;
                $errorMessages[] = 'Please fill the lastname';
            }
            else if(!preg_match("/^[A-Za-z]+$/", $lname)){
                $error=1;
                $errorMessages[] = 'Enter only alphabets in lastname';
            }
        }
        if(isset($_POST['email'])){
            $email=$_POST['email'];
            if($email==""){
                $error=1;
                $errorMessages[] = 'Please fill the email';
            }
            else if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)){
                $error=1;
                $errorMessages[] = 'Enter valid email';
            }
        }
        if(isset($_POST['password'])){
            $password=$_POST['password'];
            if($password==""){
                $error=1;
                $errorMessages[] = 'Please fill the password';
            }
            else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/", $password)){
                $error=1;
                $errorMessages[] = 'Enter valid password';
            }
        }
        if(isset($_POST['conpassword'])){
            $conpassword=$_POST['conpassword'];
            if($conpassword==""){
                $error=1;
                $errorMessages[] = 'Please fill the confirm password';
            }
            else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/", $conpassword)){
                $error=1;
                $errorMessages[] = 'Enter valid confirm password';
            }
            else if($password != $conpassword) {
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
//include PHPMailer classes to your PHP file for sending email
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$message_sent = false;
if(isset($_REQUEST['submit'])) {

    $validate = validate();

    if($validate[0]=='success'){
        
    unset($validate);
    if(isset($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['password'])) {
        
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = MD5($_POST['password']);
        
    require_once("dbcontroller.php");
	$db_handle = new DBController();
	$query = "SELECT * FROM users where email = '" . $email . "'";
	$count = $db_handle->numRows($query);
	
	if($count==0) {
		$query = "INSERT INTO users (UserRoleID,FirstName,LastName,Email,Password,IsEmailVerified,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES
        ('".$memberUserRoleID."','".$fname."','".$lname."','".$email."','".$password."',0,NOW(),'".$defaultUserID."',NOW(),'".$defaultUserID."',1) ";
        
        $current_id = $db_handle->insertQuery($query);
        
		if(!empty($current_id)) {
            
			$actual_link = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER['PHP_SELF'])."/activate.php?id=" . $current_id;
           
			//$toEmail = $email;
            $content = file_get_contents('email_verify_template.html');
            $content = str_replace('##FirstName##', $fname, $content);
            $content = str_replace('##ActivationLink##', $actual_link, $content);
            
            $mail = new PHPMailer(true);

            try {
                
            // Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // You can enable this for detailed debug output
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = $sMTPAuth;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $port; // This is fixed port for gmail SMTP            
            $mail->Username = $support_Email; // YOUR gmail email which will be used as sender and 
            $mail->Password = $support_Email_Password; // YOUR gmail password for above account

            // Sender and recipient settings
            $mail->setFrom($support_Email, $support_Email_Name); // This email address and name will be visible as sender of email
            $mail->addAddress($email, $fname); // This email is where you want to send the email
            $mail->addReplyTo($support_Email, $support_Email_Name); // If receiver replies to the email, it will be sent to this email address
            $mail->addEmbeddedImage('images/logo_pur/top-logo.png','logo_2u');

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "Note Marketplace - Email Verification"; //subject line of email
            $mail->Body = $content; //Email body
            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

            $mail->send();
            //echo "Email message sent.";
                
            } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }
        
                $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate your account.";
            
			unset($_POST);
		} else {
			$validate[] = "Problem in registration. Try Again!";	 
		}
	} else {		    
        $validate[] = "Email <b>".$email."</b> is already in use.";
	}
    } else {
        echo 'Data not inserted';
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

</head>


<body data-spy="scroll" class="overflow-auto">

    <!--SignUp Page-->
    <section id="sign_up">

        <!--Background Image-->
        <div class="back-cover-img" style="background-image: url(images/login/banner-with-overlay.jpg);"></div>

        <!--Inner Content-->
        <div class="center-div">
            <div class="container">
                <div class="content-box-sm">
                    <div class="row">
                        <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0">
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="login-content">
                                <div class="login-logo">
                                    <img src="images/login/top-logo.png" alt="Logo" class="img-responsive note-img">
                                </div>
                                <div class="login-details">
                                    <div class="home-heading">
                                        <span class="common-heading-1 center_heading-1">Cretae an Account</span>
                                        <p class="center_heading-1">Enter your details to signup</p>
                                        <?php 
                                            if(isset($message)){ ?>
                                        <p class="successMsg"><img src="images/login/SUCCESS.png" alt="success">
                                            <?php echo $message ;?>
                                        </p>
                                        <?php          
                                        }
                                        ?>
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
                                    
                                    <form name="ff1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm();">
                                        <div class="form-group form-common">
                                            <label for="fname">First Name * </label>
                                            <input type="text" class="form-control input_val" id="fname" name="fname" placeholder="Enter your first name" onblur="validateFirstName();">

                                            <span id="fnameVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="form-group form-common">
                                            <label for="lname">Last Name * </label>
                                            <input type="text" class="form-control input_val" id="lname" name="lname" placeholder="Enter your last name" onblur="validateLastName();">

                                            <span id="lnameVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="form-group form-common">
                                            <label for="email">Email *</label>
                                            <input type="text" class="form-control input_val" id="email" name="email" placeholder="Enter your email address" onblur="validateEmail();">

                                            <span id="emailVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="form-group form-common">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control input_val" id="password" name="password" placeholder="Enter your password" onblur="validatePassword();">

                                            <i class="common-icon pull-right"><img src="images/login/eye.png" onclick="showPassword('password');" /></i>

                                            <span id="passwordVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="form-group  form-common">
                                            <label for="conPassword">Confirm Password</label>
                                            <input type="password" class="form-control input_val" id="conPassword" name="conpassword" placeholder="Re-enter your password" onblur="validateConPassword();">
                                            <i class="common-icon pull-right" onclick="showPassword('conPassword');"><img src="images/login/eye.png" /></i>

                                            <span id="conPasswordVal" class="spnValMsg"></span>
                                        </div>
                                        <div class="general-btn">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block btn-purple" name="submit" value="SIGN UP" />
                                        </div>
                                        <div class="sign-up">
                                            <span class="sign-btn">Already have an account?</span>
                                            <a href="user_login.php" class="btn-blue">Login</a>
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