<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $categoryID = (isset($_GET['categoryID']) && !empty($_GET['categoryID'])) ? ($_GET['categoryID']) : 0;

    //Update query for deactivate category from notecategories table in database
    if($categoryID>0) {
        
        $sqlDeactivateCategory = "UPDATE notecategories SET IsActive = 0, ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteCategoryID = ".$categoryID;
        
        $sqlDeactivateCategoryResult = $db_handle->updateQuery($sqlDeactivateCategory); 
    }
?>