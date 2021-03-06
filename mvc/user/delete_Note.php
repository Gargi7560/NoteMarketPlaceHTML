<?php
    session_start();

    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();

    $noteID = (isset($_GET['noteID']) && !empty($_GET['noteID'])) ? ($_GET['noteID']) : 0;
    
    if($noteID>0) {
    $sqlDelete = "UPDATE notedetails SET IsActive = 0 WHERE NoteDetailID = ".$noteID;
    $sqlDeleteResult = $db_handle->updateQuery($sqlDelete);
        
    $sqlDeleteAttachment = "UPDATE notesattachments SET IsActive = 0 WHERE NoteDetailID = ".$noteID;
    $sqlDeleteAttachmentResult = $db_handle->updateQuery($sqlDeleteAttachment);
    }
?>