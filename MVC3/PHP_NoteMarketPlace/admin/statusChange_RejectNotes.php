<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;
    
    $remarks = (isset($_POST['remarks']) && !empty($_POST['remarks'])) ? ($_POST['remarks']) : NULL;

    //Update status of notes
    if($noteID>0) {
        $sqlChangeRejectStatus = "UPDATE notedetails SET StatusID = ".$rejectedID.", AdminRemarks = '".$remarks."', ActionByID = ".$_SESSION['user_id'].", ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteDetailID = ".$noteID;
        
        $changeRejectStatusResult = $db_handle->updateQuery($sqlChangeRejectStatus); 
    }
?>