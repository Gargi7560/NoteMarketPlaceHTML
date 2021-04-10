<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $typeID = (isset($_GET['typeID']) && !empty($_GET['typeID'])) ? ($_GET['typeID']) : 0;

    if($typeID>0) {
        
        //Update query for deactivate type from notetype tabel in database
        $sqlDeactivateType = "UPDATE notetypes SET IsActive = 0, ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteTypeID = ".$typeID;
        
        $sqlDeactivateTypeResult = $db_handle->updateQuery($sqlDeactivateType); 
    }
?>