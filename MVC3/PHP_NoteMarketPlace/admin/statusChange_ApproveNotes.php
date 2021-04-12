<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $noteID = (isset($_GET['noteID']) && !empty($_GET['noteID'])) ? ($_GET['noteID']) : 0;

    //Update status of notes
    if($noteID>0) {
        $sqlChangeApproveStatus = "UPDATE notedetails SET StatusID = ".$publishedID.", ActionByID = ".$_SESSION['user_id'].", ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteDetailID = ".$noteID;
        
        $changeApproveStatusResult = $db_handle->updateQuery($sqlChangeApproveStatus); 
    }
?>