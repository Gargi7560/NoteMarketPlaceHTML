<?php

session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    $noteID = (isset($_POST['noteID']) && !empty($_POST['noteID'])) ? ($_POST['noteID']) : 0;

    $comment = (isset($_POST['comment']) && !empty($_POST['comment'])) ? ($_POST['comment']) : NULL;

    $starRating = (isset($_POST['starRating']) && !empty($_POST['starRating'])) ? ($_POST['starRating']) : 0;

    if($noteID > 0){
        
        $downloadNoteQuery = "SELECT DownloadNoteID,NoteDetailID FROM downloadnotes WHERE NoteDetailID = ".$noteID;
        $downloadNoteResult = $db_handle->runQuery($downloadNoteQuery);
        
        if(!empty($downloadNoteResult)){
            
        $noteStarRatingQuery = "INSERT INTO notesreviews (NoteDetailID,ReviewedByID,AgainstDownloadsID,Ratings,Comments,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES (".$noteID.",".$_SESSION['user_id'].",".$downloadNoteResult[0]['DownloadNoteID'].",".$starRating.",'".$comment."',NOW(),".$defaultUserID.",NOW(),".$defaultUserID.",1) ";
           
        $noteStarRatingResult = $db_handle->insertQuery($noteStarRatingQuery); 
            
            //var_dump($noteStarRatingResult);
        }
    }
?>