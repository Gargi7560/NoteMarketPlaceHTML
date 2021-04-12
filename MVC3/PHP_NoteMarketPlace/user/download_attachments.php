<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;
    
    if($noteID > 0){
        $folder_name = $uploadPath.$_SESSION['user_id']."/".$noteID."/";
        
        $noteDetailQuery = "SELECT NoteDetailID,SellerID, Title,CategoryID,SellingModeID,SellingPrice FROM notedetails WHERE NoteDetailID = ".$noteID;     
        $noteDetailResult = $db_handle->runQuery($noteDetailQuery);
        
        $downloadPath = $uploadPath.$noteDetailResult[0]['SellerID']."/".$noteID."/Attachments";
        
        if($noteDetailResult[0]['SellingModeID'] == $sellForFree) {
            
            $freeNoteDownloadQuery = "INSERT INTO downloadnotes (NoteDetailID,SellerID,DownloaderID,IsSellerHasAllowedDownload,AttachmentPath,IsAttachmentDownloaded,AttachmentDownloadedDate,IsPaid,PurchasedPrice,NoteTitle,NoteCategory,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES 
            (".$noteID.",".$noteDetailResult[0]['SellerID'].",".$_SESSION['user_id'].",1,'".$downloadPath."',1,NOW(),0,'".$noteDetailResult[0]['SellingPrice']."','".$noteDetailResult[0]['Title']."',".$noteDetailResult[0]['CategoryID'].",NOW(),".$defaultUserID.",NOW(),".$defaultUserID.",1) " ;
            
            //echo $freeNoteDownloadQuery;
            $freeNoteDownloadResult = $db_handle->insertQuery($freeNoteDownloadQuery);
            
            //Get a real path of our folder
            $dir = $uploadPath.$noteDetailResult[0]['SellerID']."/".$noteID."/Attachments/";
            
            $zipDownalodFile = "archives/notes.zip";
            
            //Delete previous file before add new file
            if(is_file($zipDownalodFile))
                unlink($zipDownalodFile);
            
            $zip = new ZipArchive();
            $filename = $zipDownalodFile;
            
            if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
              exit("cannot open <$filename>\n");
            }            

            // Create zip
            if (is_dir($dir)){
                if ($dh = opendir($dir)){
                    while (($file = readdir($dh)) !== false){
                        // If file
                        if (is_file($dir.$file)) {                     
                            if($file != '' && $file != '.' && $file != '..'){
                                $zip->addFile($dir.$file,$file);
                            }
                        }
                    }
                    closedir($dh);
                }
            }

            $zip->close();

            //$filename = str_replace($_SERVER["DOCUMENT_ROOT"], $http_protocol.$_SERVER['HTTP_HOST'], $filename);
            
            echo $filename;
            
        }
    }
?>