<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $countryID = (isset($_GET['countryID']) && !empty($_GET['countryID'])) ? ($_GET['countryID']) : 0;

    //Update query for deactivate country from countries tabel in database
    if($countryID>0) {
        
        $sqlDeactivateCountryID = "UPDATE countries SET IsActive = 0, ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE CountryID = ".$countryID;
        
        $sqlDeactivateCountryIDResult = $db_handle->updateQuery($sqlDeactivateCountryID); 
    }
?>