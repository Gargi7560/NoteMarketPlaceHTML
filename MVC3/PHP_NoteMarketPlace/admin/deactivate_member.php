<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $userID = (isset($_GET['userID']) && !empty($_GET['userID'])) ? ($_GET['userID']) : 0;

    if($userID>0) {
        
        //Update query for deactivate note of users tabel in database
        $sqlDeactivateMemberNote = "UPDATE notedetails SET IsActive = 0, ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE SellerID = ".$userID;
        
        $sqlDeactivateMemberNoteResult = $db_handle->updateQuery($sqlDeactivateMemberNote); 
        
        //Update query for deactivate user from users tabel in database
        $sqlDeactivateMember = "UPDATE users SET IsActive = 0, ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE UserID = ".$userID;
        
        $sqlDeactivateMemberResult = $db_handle->updateQuery($sqlDeactivateMember);
        
        //Update query for deactivate user from userprofile table in database
        $sqlDeactivateMemberProfile = "UPDATE userprofiledetails SET IsActive = 0, ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE UserID = ".$userID;
        
        $sqlDeactivateMemberProfileResult = $db_handle->updateQuery($sqlDeactivateMemberProfile);
    }
?>