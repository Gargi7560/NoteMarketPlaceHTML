<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $noteID = (isset($_GET['noteID']) && !empty($_GET['noteID'])) ? ($_GET['noteID']) : 0;
    
    if($noteID>0) {
    $sqlDelete = "UPDATE notedetails SET IsActive = 0 WHERE NoteDetailID = ".$noteID;
    $sqlDeleteResult = $db_handle->updateQuery($sqlDelete);
        
    $sqlDeleteAttachment = "UPDATE notesattachments SET IsActive = 0 WHERE NoteDetailID = ".$noteID;
    $sqlDeleteAttachmentResult = $db_handle->updateQuery($sqlDeleteAttachment);
    }
?>