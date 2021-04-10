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
    if($noteID>0) {
        
        $downloadNoteQuery = "SELECT DownloadNoteID,NoteDetailID FROM downloadnotes WHERE NoteDetailID = ".$noteID;
        $downloadNoteResult = $db_handle->runQuery($downloadNoteQuery);
        
        if(!empty($downloadNoteResult)){
        
            $reportIssueQuery = "INSERT INTO notesreportedissues (NoteDetailID,ReportedByID,AgainstDownloadID,Remarks,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES (".$noteID.",".$_SESSION['user_id'].",".$downloadNoteResult[0]['DownloadNoteID'].",'".$remarks."',NOW(),".$defaultUserID.",NOW(),".$defaultUserID.",1) " ;
            
            $reportIssueResult = $db_handle->insertQuery($reportIssueQuery); 
            
            if(!empty($reportIssueResult)) {
                
                $emailQuery = "SELECT DN.DownloadNoteID,DN.NoteDetailID,DN.SellerID,DN.DownloaderID,DN.NoteTitle,US.FirstName AS DownloaderFirstName,UP.FirstName AS SellerFirstName,UP.Email AS SellerEmail FROM downloadnotes DN
                INNER JOIN users US ON DN.DownloaderID = US.UserID
                INNER JOIN users UP ON DN.SellerID = UP.UserID WHERE DN.NoteDetailID = ".$noteID;
                
                $emailResult = $db_handle->runQuery($emailQuery);
                
                if(!empty($emailResult)) {
                    $body = "";
                    $body .= "Hello Admins,<br/><br/>";
                    $body .= "We want to inform you that, ".$emailResult[0]['DownloaderFirstName']." Reported an issue for ".$emailResult[0]['SellerFirstName']."’s Note with title ".$emailResult[0]['NoteTitle'].". Please look at the notes and take required actions.<br/><br/>";
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
                        $mail->addAddress($admin_Email, $admin_Email_Name); // This email is where you want to send the email
                        $mail->addReplyTo($support_Email, $support_Email_Name); // If receiver replies to the email, it will be sent to this email address
                        // Setting the email content
                        $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
                        $mail->Subject = $emailResult[0]['DownloaderFirstName']."Reported an issue for ".$emailResult[0]['NoteTitle']; //subject line of email
                        $mail->Body = $body; //Email body
                        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

                        $mail->send();
                    } catch (Exception $e) {
                            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        }
    }
?>