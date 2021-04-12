<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;
    
    $remarks = (isset($_POST['remarks']) && !empty($_POST['remarks'])) ? ($_POST['remarks']) : NULL;

    //Update status of notes
    if($noteID>0) {
        $sqlChangeRejectStatus = "UPDATE notedetails SET StatusID = ".$rejectedID.", AdminRemarks = '".$remarks."', ActionByID = ".$_SESSION['user_id'].", ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteDetailID = ".$noteID;
        
        $changeRejectStatusResult = $db_handle->updateQuery($sqlChangeRejectStatus); 
    }
?>