<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $noteID = (isset($_GET['noteID']) && !empty($_GET['noteID'])) ? ($_GET['noteID']) : 0;

    //Update status of notes
    if($noteID>0) {
        $sqlChangeInReviewStatus = "UPDATE notedetails SET StatusID = ".$inReviewID.", ActionByID = ".$_SESSION['user_id'].", ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteDetailID = ".$noteID;
        
        $changeInReviewStatusResult = $db_handle->updateQuery($sqlChangeInReviewStatus); 
    }
?>