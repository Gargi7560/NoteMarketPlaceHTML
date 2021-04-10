<?php

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Mail Config
    $host = 'smtp.gmail.com';
    $sMTPAuth = true;
    $port = 587;

    //Default System Configuration Value
    $defaultSystemConfigVal = "SELECT `Key`,`Value` From systemconfiguration WHERE `Key` IN ('SupportEmail', 'SupportPhoneNo', 'FacebookUrl', 'TwitterUrl', 'LinkdinUrl')";

    $defaultSystemConfigValResult = $db_handle->runQuery($defaultSystemConfigVal);

    foreach($defaultSystemConfigValResult as $value) {
        if($value['Key'] == "SupportEmail")
            $support_Email = $value['Value'];           //Default Support Email Address
        
        if($value['Key'] == "SupportPhoneNo")
            $support_PhoneNo = $value['Value'];         //Default Support Phone Number
        
        if($value['Key'] == "FacebookUrl")
            $support_FacebookUrl = $value['Value'];     //Default FaceBook URL
        
        if($value['Key'] == "TwitterUrl")
            $support_TwitterUrl = $value['Value'];      //Default Twitter URL
        
        if($value['Key'] == "LinkdinUrl")
            $support_LinkdinUrl = $value['Value'];      //Default Twitter URL
    }
    
    //Mail Admin And Support Gmail And Password
    $support_Email_Password = 'Note@1234';
    $support_Email_Name = 'Support - NoteMarketPlace';
    $admin_Email = 'gargi.notemarketplace@gmail.com';
    $admin_Email_Name = 'Admin - NoteMarketPlace';

    /*Common Variables*/
    $defaultUserID = 1;         //Super admin userID
    $memberUserRoleID = 1;      //Member User RoleID
    $adminUserRoleID = 2;       //Admin User RoleID
    $superAdminUserRoleID = 3;  //Super Admin User RoleID

    /*Status Defaukt Variable*/
    $draftID = 1;               //Draft ID
    $submittedForReviewID = 2;  //Submitted For Review ID
    $inReviewID = 3;            //In Review ID
    $publishedID = 4;           //Published ID
    $rejectedID = 5;            //Rejected ID
    $removedID = 6;             //Removed ID

    $sellForFree = 1;
    $sellForPaid = 2;
    
    /*Admin Temp Password*/
    $adminTempPassword = "Admin@1234";


    //$basePath = dirname(__FILE__, 2);
    //$basePath = str_replace("\\", "/", $basePath);
    //$basePath = str_replace($_SERVER["DOCUMENT_ROOT"], '', $basePath);

    /*Folder Path*/
    $http_protocol = "http://";
    //$uploadPath = $_SERVER["DOCUMENT_ROOT"].$basePath."/user/UploadedFiles/Members/";

	/*Admin Folder Path*/
	//$adminUploadPath =  $_SERVER["DOCUMENT_ROOT"].$basePath."/admin/UploadedFiles/Admin/";

    /*Default Image Path*/
    //$defaultImagePath =  $_SERVER["DOCUMENT_ROOT"].$basePath."/common/Default/";

    $uploadPath = "../user/UploadedFiles/Members/";

	/*Admin Folder Path*/
	$adminUploadPath =  "../admin/UploadedFiles/Admin/";

    /*Default Image Path*/
    $defaultImagePath =  "../common/Default/";

?>