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
        $sqlChangeInReviewStatus = "UPDATE notedetails SET StatusID = ".$inReviewID.", ActionByID = ".$_SESSION['user_id'].", ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteDetailID = ".$noteID;
        
        $changeInReviewStatusResult = $db_handle->updateQuery($sqlChangeInReviewStatus); 
    }
?>