<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';
    
    //include PHPMailer classes to your PHP file for sending email
    require '../common/src/Exception.php';
    require '../common/src/PHPMailer.php';
    require '../common/src/SMTP.php';

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $noteID = (isset($_GET['noteID']) && !empty($_GET['noteID'])) ? ($_GET['noteID']) : 0;

    if($noteID > 0) {
        $sqlUpdate = "UPDATE notedetails SET StatusID = ".$submittedForReviewID." WHERE NoteDetailID = ".$noteID;
        $sqlUpdateResult = $db_handle->updateQuery($sqlUpdate);
        
        $sqlTitle = "SELECT Title FROM notedetails WHERE NoteDetailID = ".$noteID;
        $sqlTitleResult = $db_handle->runQuery($sqlTitle);   
        
        $body .= "Hello Admins, <br/><br/>";
        $body .= "We want to inform you that, <b>".$_SESSION['user_fname']." ".$_SESSION['user_lname']." </b> sent his note <b>".$sqlTitleResult[0]['Title']."</b> for review. Please look at the notes and take required actions<br/><br/><br/>";
    
        $body .= "Regards,<br/> ";
        $body .= "Notes Marketplace<br/> ";

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
        $mail->Subject = $_SESSION['user_fname']." sent his review for review"; //subject line of email
        $mail->Body = $body; //Email body
        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

        $mail->send();
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>