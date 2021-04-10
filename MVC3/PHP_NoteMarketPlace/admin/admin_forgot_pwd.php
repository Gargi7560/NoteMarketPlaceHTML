<?php
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
        if($error){
            return $errorMessages;
        }else{
            $errorMessages[] = 'success';
            return $errorMessages;        
        }
    }
        
    function generate_password($length = 8){
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
        $str = '';
        $max = strlen($chars) - 1;
        for ($i=0; $i < $length; $i++)
            $str .= $chars[random_int(0, $max)];
            return $str;
    }
}

//include PHPMailer classes to your PHP file for sending email
require '../common/src/Exception.php';
require '../common/src/PHPMailer.php';
require '../common/src/SMTP.php';

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_REQUEST['submit'])) {
    
    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $validate = validate();
    $generate_password = generate_password();
    
    if($validate[0]=='success'){
        
    unset($validate);

        if(isset($_POST['email'])){
            $email = $_POST['email'];
            
            $query = "SELECT UserID,FirstName,Email FROM users where email = '" . $email . "'";
	        $result = $db_handle->runQuery($query);
            if($result != "") {

                $sql = "UPDATE users set Password = '".MD5($generate_password)."' WHERE UserID=" . $result[0]['UserID'];
                $fname = $result[0]['FirstName'];
                $count = $db_handle->updateQuery($sql);
                
                if(!empty($count)) {
                    
                    //Email body
                    $subject = "New Temporary Password has been created for you";
                    $body = "";
                    $body .= "Hello, <br/><br/>";
                    $body .= "We have generated a new password for you <br/>";
                    $body .= "Password: " .$generate_password. "<br/><br/><br/>";
                    $body .= "Regards, <br/>";
                    $body .= "Notes Marketplace <br/>";
                    $mail = new PHPMailer(true);

                    try {
                        //Settings from Config file
                        include '../common/configuration.php';

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

                        // Setting the email content
                        $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
                        $mail->Subject = $subject; //subject line of email
                        $mail->Body = $body; //Email body
                        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

                        $mail->send();
                        
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                        $message = 'Your password has been changed successfully and newly generated password is sent on your registered email address. Please <a href="user_login.php" style="color:#006400; font: inherit; "><b>Login</b></a> with your new password';
                } else {

                    $validate[] = "Please contact administrator.";
                }
                        
                unset($_POST);
            } else {

                $validate[] = "Email <b>".$email."</b> is not register. Please Enter register email.";  
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
    <link rel="shortcut icon" href="images/home/favicon.ico">

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script_admin.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style_admin.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive_admin.css">

    <script type="text/javascript">
        
        //Client side validation
        function forgotValidateEmail() {

            isForgotValidEmail = false;

            if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please fill out this field.");
                isForgotValidEmail = false;
            } else {
                $("#email").removeClass("borderHighlight");
                $("#emailVal").css("visibility", "hidden");
                isForgotValidEmail = true;
            }
            return isForgotValidEmail;
        }

        function forgotValidateForm() {

            isForgotValidateForm = false;

            isForgotValidEmail = forgotValidateEmail();

            if (isForgotValidEmail) {
                isForgotValidateForm = true;
            }
            return isForgotValidateForm;
        }
    </script>

</head>

<body data-spy="scroll" class="overflow-auto">

    <!--Forgot Password Page-->
    <section id="forgot_pwd">

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
                                        <span class="common-heading-1 center_heading-1">Forgot Password?</span>
                                        <p class="center_heading-1">Enter your email to reset your password</p>
                                    </div>
                                   
                                        <!--Server side validation success message-->
                                        <?php 
                                            if(isset($message)){ 
                                        ?>
                                        <p class="successMsg"><img src="images/login/SUCCESS.png" alt="success">
                                        <?php echo $message ;?>
                                        </p>
                                        <?php          
                                            }
                                        ?>
                                        <!--Server side validation error message-->
                                        <?php
                    
                                            if(isset($validate) && $validate[0] != 'success'){
                                                foreach($validate as $error){
                                        ?>
                                        <p style="color:#ea4748"><?php echo $error ; ?></p>
                                        <?php
                                                }
                                            }
                                        ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return forgotValidateForm();">
                                        <div class="form-group form-common">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control input_val" id="email" name="email" placeholder="Enter your email" onblur="forgotValidateEmail();">
                                            <span id="emailVal" class="spnValMsg"></span>
                                        </div>

                                        <div class="general-btn">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block btn-purple" value="SUBMIT" name="submit">
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