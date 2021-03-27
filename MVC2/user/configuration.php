<?php

    //Mail Config
    $host = 'smtp.gmail.com';
    $sMTPAuth = true;
    $port = 587;

    //Mail Admin And Support Gmail And Password
    $support_Email = 'gargi.notemarketplace@gmail.com';
    $support_Email_Password = 'Note@1234';
    $support_Email_Name = 'Support - NoteMarketPlace';
    $admin_Email = 'gargi.notemarketplace@gmail.com';
    $admin_Email_Name = 'Admin - NoteMarketPlace';

    /*Common Variables*/

    $superAdminNumber = "+91 90xxx 51xxx";

    $defaultUserID = 1;         //Super admin userID
    $memberUserRoleID = 1;      //Member User RoleID
    $adminUserRoleID = 2;       //Admin User RoleID
    $draftID = 1;               //Draft ID
    $submittedForReviewID = 2;  //Submitted For Review ID
    $inReviewID = 3;            //In Review ID
    $publishedID = 4;           //Published ID
    $rejectedID = 5;            //Rejected ID
    $removedID = 6;             //Removed ID

    $sellForFree = 1;
    $sellForPaid = 2;
    
    /*Folder Path*/
    $http_protocol = "http://";
    $uploadPath = $_SERVER["DOCUMENT_ROOT"]."/PHP_NoteMarketPlace/user/UploadedFiles/Members/";

?>