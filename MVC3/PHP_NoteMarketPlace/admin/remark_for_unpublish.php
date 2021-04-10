<?php 
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    //include PHPMailer classes to your PHP file for sending email
    require '../common/src/Exception.php';
    require '../common/src/PHPMailer.php';
    require '../common/src/SMTP.php';

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    $message_sent = false;

    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;
    
    $remarks = (isset($_POST['remarks']) && !empty($_POST['remarks'])) ? ($_POST['remarks']) : NULL;

    if($noteID>0){
        
        $unpublishNoteQuery = "UPDATE notedetails SET StatusID = ".$removedID.", AdminRemarks = '".$remarks."', ActionByID = ".$_SESSION['user_id'].", ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteDetailID = ".$noteID;
        
        $unpublishNoteResult = $db_handle->updateQuery($unpublishNoteQuery);
        
        $sqlData = "SELECT ND.Title,ND.SellerID,US.FirstName,US.LastName,US.Email FROM notedetails ND 
        INNER JOIN users US ON US.UserID = ND.SellerID
        WHERE NoteDetailID = ".$noteID;
        $sqlDataResult = $db_handle->runQuery($sqlData);
        
        $body = "Hello <b>".$sqlDataResult[0]['FirstName']." ".$sqlDataResult[0]['LastName']." </b>, <br/><br/>";
        $body .= "We want to inform you that, your note <b>".$sqlDataResult[0]['Title']." </b> has been removed from the portal.";
        $body .= "Please find our remarks as below -<br/>";
        $body .= $remarks."<br/><br/><br/>";
    
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
        $mail->addAddress($sqlDataResult[0]['Email'], $sqlDataResult[0]['FirstName']); // This email is where you want to send the email
        $mail->addReplyTo($support_Email, $support_Email_Name); // If receiver replies to the email, it will be sent to this email address

        // Setting the email content
        $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
        $mail->Subject = "Sorry! We need to remove your notes from our portal."; //subject line of email
        $mail->Body = $body; //Email body
        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

        $mail->send();
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>