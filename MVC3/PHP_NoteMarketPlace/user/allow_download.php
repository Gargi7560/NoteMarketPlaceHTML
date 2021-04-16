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

    //$message_sent = false;

    $noteID = (isset($_GET['noteID']) && !empty($_GET['noteID'])) ? ($_GET['noteID']) : 0;
    
    if($noteID>0) {
        $allowDownloadQuery = "UPDATE downloadnotes SET IsSellerHasAllowedDownload = 1 WHERE DownloadNoteID = ".$noteID;
            
        $allowDownloadResult = $db_handle->updateQuery($allowDownloadQuery);
    
        if(!empty($allowDownloadResult)){
            
            $emailQuery = "SELECT DN.DownloadNoteID,DN.NoteDetailID,DN.SellerID,DN.DownloaderID,US.FirstName AS DownloaderFirstName,UP.FirstName AS SellerFirstName,US.Email AS DownloaderEmail FROM downloadnotes DN
            INNER JOIN users US ON DN.DownloaderID = US.UserID
            INNER JOIN users UP ON DN.SellerID = UP.UserID WHERE DN.DownloadNoteID = ".$noteID;
            
            $emailResult = $db_handle->runQuery($emailQuery);
            
            //var_dump($emailResult);
            
            if(!empty($emailResult)){
                $body = "";
                $body .= "Hello ".$emailResult[0]['DownloaderFirstName']."<br/><br/>";
                $body .= "We would like to inform you that, ".$emailResult[0]['SellerFirstName']." allows you to download a note.<br/>";
                $body .= "Please login and see My Download tabs to download particular note.<br/><br/>";
                $body .= "Regards,<br/>Notes Marketplace";
                
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
                    $mail->addAddress($emailResult[0]['DownloaderEmail'], $emailResult[0]['DownloaderFirstName']); // This email is where you want to send the email
                    $mail->addReplyTo($support_Email, $support_Email_Name); // If receiver replies to the email, it will be sent to this email address
                    // Setting the email content
                    $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
                    $mail->Subject = $emailResult[0]['SellerFirstName']." allows you to download a note."; //subject line of email
                    $mail->Body = $body; //Email body
                    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

                    $mail->send();
                } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
?>