<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $message_sent = false;

    $downloadNoteID = (isset($_POST['downloadNoteID']) && !empty($_POST['downloadNoteID'])) ? ($_POST['downloadNoteID']) : 0;

    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;
    
    //Select notes from downloadnotes table from database
    if($downloadNoteID>0) {

        $noteDetailQuery = "SELECT SellerID,NoteDetailID FROM downloadnotes WHERE DownloadNoteID = ".$downloadNoteID;     
        
        $noteDetailResult = $db_handle->runQuery($noteDetailQuery);
    
        $noteID = $noteDetailResult[0]['NoteDetailID'];
        $sellerID = $noteDetailResult[0]['SellerID'];
    }

    //Select notes from notedetails table from database
    else {
        
        $noteDetailQuery = "SELECT SellerID,NoteDetailID FROM notedetails WHERE NoteDetailID = ".$noteID;     
    
        $noteDetailResult = $db_handle->runQuery($noteDetailQuery);
    
        $sellerID = $noteDetailResult[0]['SellerID'];
    }
    $folder_name = $uploadPath.$noteDetailResult[0]['SellerID']."/".$noteID."/";

    $downloadPath = $uploadPath.$sellerID."/".$noteID."/Attachments";
    
    if($noteID>0) {
        if($downloadNoteID>0) {
        
        $downloadNoteQuery = "UPDATE downloadnotes SET AttachmentPath = '".$downloadPath."', IsAttachmentDownloaded = 1, AttachmentDownloadedDate = NOW() , ModifiedDate = NOW() WHERE DownloadNoteID = ".$downloadNoteID;
            
        $allowDownloadResult = $db_handle->updateQuery($downloadNoteQuery);
        }
        //Get a real path of our folder
        $dir = $uploadPath.$sellerID."/".$noteID."/Attachments/";
            
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
?>