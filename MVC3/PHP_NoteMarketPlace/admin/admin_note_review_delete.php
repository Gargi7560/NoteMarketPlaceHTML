<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    $reviewID = (isset($_GET['reviewID']) && !empty($_GET['reviewID'])) ? ($_GET['reviewID']) : 0;
    
    //Deleting customer review from note detail page
    if($reviewID>0) {
        $sqlDelete = "UPDATE notesreviews SET IsActive = 0 WHERE NotesReviewID = ".$reviewID;
        $sqlDeleteResult = $db_handle->updateQuery($sqlDelete);
    }
?>