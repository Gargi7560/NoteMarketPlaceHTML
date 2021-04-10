<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $spamID = (isset($_GET['spamID']) && !empty($_GET['spamID'])) ? ($_GET['spamID']) : 0;

    if($spamID>0) {
        
        //Delete spam report from notesreportedissues table in database
        $sqlDeleteSpam = "DELETE FROM notesreportedissues WHERE NotesReportedIssuesID = ".$spamID;
        
        $sqlDeleteSpamResult = $db_handle->updateQuery($sqlDeleteSpam); 
    }
?>