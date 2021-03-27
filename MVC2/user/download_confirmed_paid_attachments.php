<?php

session_start();

    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();
    
    //include PHPMailer classes to your PHP file for sending email
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;
    
    if($noteID > 0){
        $folder_name = $uploadPath.$_SESSION['user_id']."/".$noteID."/";
        
        $noteDetailQuery = "SELECT NoteDetailID,SellerID, Title,CategoryID,SellingModeID,SellingPrice FROM notedetails ND WHERE NoteDetailID = ".$noteID;     
        $noteDetailResult = $db_handle->runQuery($noteDetailQuery);
        
        $downloadPath = $uploadPath.$noteDetailResult[0]['SellerID']."/".$noteID."/Attachments";
        
        if($noteDetailResult[0]['SellingModeID'] == $sellForPaid) {
            
            $paidNoteDownloadQuery = "INSERT INTO downloadnotes (NoteDetailID,SellerID,DownloaderID,IsSellerHasAllowedDownload,IsAttachmentDownloaded,IsPaid,PurchasedPrice,NoteTitle,NoteCategory,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES 
            (".$noteID.",".$noteDetailResult[0]['SellerID'].",".$_SESSION['user_id'].",0,0,1,'".$noteDetailResult[0]['SellingPrice']."','".$noteDetailResult[0]['Title']."',".$noteDetailResult[0]['CategoryID'].",NOW(),".$defaultUserID.",NOW(),".$defaultUserID.",1) " ;
            
            $paidNoteDownloadResult = $db_handle->insertQuery($paidNoteDownloadQuery);
            
            if(!empty($paidNoteDownloadResult)) {
                $emailQuery = "SELECT DN.DownloadNoteID,DN.NoteDetailID,DN.SellerID,DN.DownloaderID,US.FirstName AS DownloaderFirstName,UP.FirstName AS SellerFirstName,UP.Email AS SellerEmail FROM downloadnotes DN
                INNER JOIN users US ON DN.DownloaderID = US.UserID
                INNER JOIN users UP ON DN.SellerID = UP.UserID WHERE DN.DownloadNoteID = ".$paidNoteDownloadResult;
                
                $emailResult = $db_handle->runQuery($emailQuery);
                
                if(!empty($emailResult)){
                $body = "";
                $body .= "Hello ".$emailResult[0]['SellerFirstName']."<br/><br/>";
                $body .= "We would like to inform you that, ".$emailResult[0]['DownloaderFirstName']." wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him.<br/><br/>";
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
                    $mail->addAddress($emailResult[0]['SellerEmail'], "Seller of notes"); // This email is where you want to send the email
                    $mail->addReplyTo($support_Email, $support_Email_Name); // If receiver replies to the email, it will be sent to this email address
                    // Setting the email content
                    $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
                    $mail->Subject = $emailResult[0]['DownloaderFirstName']."wants to purchase your notes"; //subject line of email
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