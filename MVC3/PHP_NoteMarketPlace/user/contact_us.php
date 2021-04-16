<?php
    session_start();

    global $error;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';
    
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
            if(isset($_POST['subject'])){
                $email=$_POST['subject'];
                if($email==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the subject ';
                }
            }
            if(isset($_POST['comment_contact'])){
                $email=$_POST['comment_contact'];
                if($email==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the comment ';
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
    require '../common/src/Exception.php';
    require '../common/src/PHPMailer.php';
    require '../common/src/SMTP.php';

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $message_sent = false;

    if(isset($_REQUEST['submit'])) {

        $validate = validate();

        if($validate[0]=='success'){

        unset($validate);
            
            if(isset($_POST['fname'],$_POST['email'],$_POST['subject'],$_POST['comment_contact'])) {

            $fname = $_POST['fname'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $comment_contact = $_POST['comment_contact'];
            $body = "Hello, <br/><br/>";

                //echo $count;
                if($fname != "" && $email != "" && $subject != "" && $comment_contact != "") {

                $body .= "From: ".$fname. "<br/>";
                $body .= "Email: ".$email. "<br/>";
                $body .= "Subject: ".$subject. "<br/>";
                $body .= "Comment: ".$comment_contact. "<br/><br/><br/>";
                $body .= "Regards,<br/> ".$fname;

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
                    $mail->addAddress($admin_Email, $admin_Email_Name); // This email is where you want to send the email
                    $mail->addReplyTo($support_Email, $support_Email_Name); // If receiver replies to the email, it will be sent to this email address

                    // Setting the email content
                    $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
                    $mail->Subject = $fname." - Query"; //subject line of email
                    $mail->Body = $body; //Email body
                    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

                    $mail->send();
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }

                $message = "Thanks We will be in touch";
                unset($_POST);
                } else {		    
                $validate[] = "Missing some field Please fill that";
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
    
    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>

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
        
        reOnlyAlphabet = /^[A-Za-z]+$/;
        reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        reForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/;

        function validateContactFirstName() {

            isValidContactFname = false;

            if ($("#fname").val() == "" || $("#fname").val() == null || $("#fname").val().trim().length == 0) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please fill the firstname.");
                isValidContactFname = false;
            } else if (!reOnlyAlphabet.test($("#fname").val())) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please enter only alphabets.");
                isValidContactFname = false;
            } else {
                $("#fname").removeClass("borderHighlight");
                $("#fnameVal").css("visibility", "hidden");
                isValidContactFname = true;
            }

            return isValidContactFname;

        }

        function validateContactEmail() {

            isValidContactEmail = false;

            if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please fill the email.");
                isValidContactEmail = false;
            } else if (!reForEmail.test($("#email").val())) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please enter valid email.");
                isValidContactEmail = false;
            } else {
                $("#email").removeClass("borderHighlight");
                $("#emailVal").css("visibility", "hidden");
                isValidContactEmail = true;
            }

            return isValidContactEmail;

        }

        function validateContactSubject() {

            isValidContactSubject = false;

            if ($("#subject").val() == "" || $("#subject").val() == null || $("#subject").val().trim().length == 0) {
                $("#subject").focusin();
                $("#subject").addClass("borderHighlight");
                $("#subjectVal").css("visibility", "visible");
                $("#subjectVal").html("Please fill the subject.");
                isValidContactSubject = false;
            } else {
                $("#subject").removeClass("borderHighlight");
                $("#subjectVal").css("visibility", "hidden");
                isValidContactSubject = true;
            }

            return isValidContactSubject;

        }

        function validateContactComment() {

            isValidContactComment = false;

            if ($("#comment_contact").val() == "" || $("#comment_contact").val() == null || $("#comment_contact").val().trim().length == 0) {
                $("#comment_contact").focusin();
                $("#comment_contact").addClass("borderHighlight");
                $("#comment_contactVal").css("visibility", "visible");
                $("#comment_contactVal").html("Please fill out this field.");
                isValidContactComment = false;
            } else {
                $("#comment_contact").removeClass("borderHighlight");
                $("#comment_contactVal").css("visibility", "hidden");
                isValidContactComment = true;
            }

            return isValidContactComment;

        }

        function validateContactForm() {

            isValidateContactForm = false;

            isValidContactFname = validateContactFirstName();
            isValidContactEmail = validateContactEmail();
            isValidContactSubject = validateContactSubject();
            isValidContactComment = validateContactComment();

            if (isValidContactFname && isValidContactEmail && isValidContactSubject && isValidContactComment) {
                isValidateContactForm = true;
            }

            return isValidateContactForm;

        }
    
    </script>
   
    </head>
    
    <body data-spy="scroll" class="overflow-auto sticky-header">
    
        <div class="wrapper">
        
        <!--Header Start-->
            <?php include 'sticky_header.php';?>
        <!--Header End-->
        
        <!--Contact Us Start--> 
        <section id="contact_us"> 
        <div class="common-top pad_100_for_pages">
            <div class="content-box-lg">
                <div class="container">
                    <span class="common-heading-1 center_heading-1 main_heading">Contact Us</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="content-box-sm">
                  
            <?php 
                if(isset($message)){ ?>
                    <p class="successMsg"><img src="images/login/SUCCESS.png" alt="success">
                    <?php echo $message ;?>
                    </p>
                <?php          
                }
                ?>
            <?php
                    
            if(isset($validate) && $validate[0] != 'success'){
                foreach($validate as $error){
            ?>
                <p style="color:#ea4748"><?php echo $error ; ?></p>
            <?php
                }
            }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateContactForm();">
                <div class="home-heading">
                    <span class="common-heading-1 left_heading-1">Get In Touch</span> 
                    <p class="row_fix_bottom">Let us know how to get back to you</p>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="fname">First Name * </label>
                                <input type="text" class="form-control input_val" id="fname" name="fname" 
                                       <?php if(isset($_SESSION['user_logged_in'])){
                                            echo " value ='".$_SESSION['user_fname']."'";
                                        } ?>
                                       placeholder="Enter your first name" onblur="validateContactFirstName();">
                                    	
                                <span id="fnameVal" class="spnValMsg"></span>    
                        </div>
                        <div class="form-group form-common">
                            <label for="email">Email *</label>
                            <input type="text" class="form-control input_val" id="email" name="email" 
                                           <?php if(isset($_SESSION['user_logged_in'])){
                                            echo " value ='".$_SESSION['user']."'";
                                        } ?>
                                        placeholder="Enter your email address" onblur="validateContactEmail();">
                                    	
                            <span id="emailVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="subject">Subject * </label>
                            <input type="text" class="form-control input_val" id="subject" name="subject" placeholder="Enter your subject" onblur="validateContactSubject();">
                            	
                            <span id="subjectVal" class="spnValMsg"></span> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="comment_contact">Comments/Questions * </label>
                            <textarea class="form-control input_val" rows="8" id="comment_contact" name="comment_contact" placeholder="Comments..." onblur="validateContactComment();"></textarea>
                            	
                            <span id="comment_contactVal" class="spnValMsg"></span>
                        </div>
                    </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="small-btn general-btn">
                                    <input type="submit" class="btn btn-outline-primary btn-purple" name="submit" value="SUBMIT">
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        
    </section>
    <!--Contact Us End-->
        
        <!--Footer-->
            <?php include 'footer.php';?>
        <!--End of footer--> 
        </div>
    
    </body>
</html>

