<?php

    session_start();
    
    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    //Insert and update query for support email 
    if(isset($_POST['supportEmail'])) {
        $supportEmail = $_POST['supportEmail'];
        
        if(!empty($supportEmail)) {
            $query = "SELECT * FROM systemconfiguration WHERE `Key` = 'SupportEmail'";
	        $count = $db_handle->numRows($query);
            
            if($count==0) {
                $addSupportEmail = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('SupportEmail','".$supportEmail."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                
                $addSupportEmailResult = $db_handle->insertQuery($addSupportEmail);
            }
            else {
                $editSupportEmail = "UPDATE systemconfiguration SET  `Value` = '".$supportEmail."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'supportEmail'";   
                    
                $editSupportEmailResult = $db_handle->updateQuery($editSupportEmail);
            }
        }
    }

    //Insert and update query for support phone number 
    if(isset($_POST['supportPhoneNo'])) {
        $supportPhoneNo = $_POST['supportPhoneNo'];
        
        if(!empty($supportPhoneNo)) {
            $query = "SELECT * FROM systemconfiguration WHERE `Key` = 'SupportPhoneNo'";
	        $count = $db_handle->numRows($query);
            
            if($count==0) {
                $addSupportPhoneNo = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('SupportPhoneNo','".$supportPhoneNo."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                
                $addSupportPhoneNoResult = $db_handle->insertQuery($addSupportPhoneNo);
            }
            else {
                $editSupportPhoneNo = "UPDATE systemconfiguration SET  `Value` = '".$supportPhoneNo."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'SupportPhoneNo'";   
                    
                $editSupportPhoneNoResult = $db_handle->updateQuery($editSupportPhoneNo);
            }
        }
    }

    //Insert and update query for email for notification
    if(isset($_POST['emailForNotification'])) {
        $emailForNotification = $_POST['emailForNotification'];
        
        if(!empty($emailForNotification)) {
            $query = "SELECT * FROM systemconfiguration WHERE `Key` = 'EmailForNotification'";
	        $count = $db_handle->numRows($query);
            
            if($count==0) {
                $addEmailForNotification = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('EmailForNotification','".$emailForNotification."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                
                $addEmailForNotificationResult = $db_handle->insertQuery($addEmailForNotification);
            }
            else {
                $editEmailForNotification = "UPDATE systemconfiguration SET  `Value` = '".$emailForNotification."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'EmailForNotification'";   
                    
                $editEmailForNotificationResult = $db_handle->updateQuery($editEmailForNotification);
            }
        }
    }

    //Insert and update query for facebook url
    if(isset($_POST['facebookUrl'])) {
        $facebookUrl = $_POST['facebookUrl'];
        
        if(!empty($facebookUrl)) {
            $query = "SELECT * FROM systemconfiguration WHERE `Key` = 'FacebookUrl'";
	        $count = $db_handle->numRows($query);
            
            if($count==0) {
                $addFacebookUrl = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('FacebookUrl','".$facebookUrl."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                
                $addFacebookUrlResult = $db_handle->insertQuery($addFacebookUrl);
            }
            else {
                $editFacebookUrl = "UPDATE systemconfiguration SET  `Value` = '".$facebookUrl."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'FacebookUrl'";   
                    
                $editFacebookUrlResult = $db_handle->updateQuery($editFacebookUrl);
            }
        }
    }

    //Insert and update query for twitter url
    if(isset($_POST['twitterUrl'])) {
        $twitterUrl = $_POST['twitterUrl'];
        
        if(!empty($twitterUrl)) {
            $query = "SELECT * FROM systemconfiguration WHERE `Key` = 'TwitterUrl'";
	        $count = $db_handle->numRows($query);
            
            if($count==0) {
                $addTwitterUrl = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('TwitterUrl','".$twitterUrl."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                
                $addTwitterUrlResult = $db_handle->insertQuery($addTwitterUrl);
            }
            else {
                $editTwitterUrl = "UPDATE systemconfiguration SET  `Value` = '".$twitterUrl."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'TwitterUrl'";   
                    
                $editTwitterUrlResult = $db_handle->updateQuery($editTwitterUrl);
            }
        }
    }

    //Insert and update query for linkdin url
    if(isset($_POST['linkdinUrl'])) {
        $linkdinUrl = $_POST['linkdinUrl'];
        
        if(!empty($linkdinUrl)) {
            $query = "SELECT * FROM systemconfiguration WHERE `Key` = 'LinkdinUrl'";
	        $count = $db_handle->numRows($query);
            
            if($count==0) {
                $addLinkdinUrl = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('LinkdinUrl','".$linkdinUrl."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                
                $addLinkdinUrlResult = $db_handle->insertQuery($addLinkdinUrl);
            }
            else {
                $editLinkdinUrl = "UPDATE systemconfiguration SET  `Value` = '".$linkdinUrl."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'LinkdinUrl'";   
                    
                $editLinkdinUrlResult = $db_handle->updateQuery($editLinkdinUrl);
            }
        }
    }

    /*Upload Default Display Picture*/
    if(isset($_FILES['defaultDisplayPicture']['name'])){
        
        $queryDefaultDisplayPic = "SELECT * FROM systemconfiguration WHERE `Key` = 'DefaultDisplayPicture'";
        
	    $countDefaultDisplayPic = $db_handle->numRows($queryDefaultDisplayPic);
        
        $default_Display_Picture = "";
        
        if($countDefaultDisplayPic == 0) {
            
            if(!empty($_FILES['defaultDisplayPicture']['name'])){
            
                $path_parts = pathinfo($_FILES['defaultDisplayPicture']['name']);
                $default_Display_Picture_Extension = $path_parts['extension']; 

                $default_Display_Picture = $defaultImagePath."DefaultDisplayPic.".$default_Display_Picture_Extension;

                if (!file_exists($defaultImagePath)) {
                    mkdir($defaultImagePath);
                }
                if (!move_uploaded_file($_FILES['defaultDisplayPicture']['tmp_name'], $default_Display_Picture)) {
                    echo "Profile Picture Upload Failed!";
                }
            }
            /*Insert Path in to DB.*/
            if(!empty($default_Display_Picture)) {

                $addDefaultDisplayPic = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('DefaultDisplayPicture','".$default_Display_Picture."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";

                $addDefaultDisplayPicResult = $db_handle->updateQuery($addDefaultDisplayPic); 
            }
            
        }
        else {  
            if(!empty($_FILES['defaultDisplayPicture']['name'])){
            
                $path_parts = pathinfo($_FILES['defaultDisplayPicture']['name']);
                
                $default_Display_Picture_Extension = $path_parts['extension']; 
                
                $default_Display_Picture = $defaultImagePath."DefaultDisplayPic.".$default_Display_Picture_Extension;

                if (!file_exists($defaultImagePath)) {
                    mkdir($defaultImagePath);
                }
                if (!move_uploaded_file($_FILES['defaultDisplayPicture']['tmp_name'], $default_Display_Picture)) {
                    echo "Profile Picture Upload Failed!";
                }
            }
            /*Update Path in to DB.*/
            if(!empty($default_Display_Picture)) {

                $editDefaultDisplayPic = "UPDATE systemconfiguration SET  `Value` = '".$default_Display_Picture."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'DefaultDisplayPicture'";

                $editDefaultDisplayPicResult = $db_handle->updateQuery($editDefaultDisplayPic); 
            }
        }
    }

    /*Upload Default Profile Picture*/
    if(isset($_FILES['defaultProfilePicture']['name'])){
        
        $queryDefaultProfilePic = "SELECT * FROM systemconfiguration WHERE `Key` = 'DefaultProfilePicture'";
        
	    $countDefaultProfilePic = $db_handle->numRows($queryDefaultProfilePic);
        
        $default_Profile_Picture = "";
        
        if($countDefaultProfilePic == 0) {
            
            if(!empty($_FILES['defaultProfilePicture']['name'])){
            
                $path_parts = pathinfo($_FILES['defaultProfilePicture']['name']);
                $default_Profile_Picture_Extension = $path_parts['extension']; 

                $default_Profile_Picture = $defaultImagePath."DefaultProfilePic.".$default_Profile_Picture_Extension;

                if (!file_exists($defaultImagePath)) {
                    mkdir($defaultImagePath);
                }
                if (!move_uploaded_file($_FILES['defaultProfilePicture']['tmp_name'], $default_Profile_Picture)) {
                    echo "Profile Picture Upload Failed!";
                }
            }
            /*Insert Path in to DB.*/
            if(!empty($default_Profile_Picture)) {

                $addDefaultProfilePic = "INSERT INTO systemconfiguration (`Key`,`Value`,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('DefaultProfilePicture','".$default_Profile_Picture."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";

                $addDefaultProfilePicResult = $db_handle->updateQuery($addDefaultProfilePic); 
            }
            
        }
        else {  
            if(!empty($_FILES['defaultProfilePicture']['name'])){
            
                $path_parts = pathinfo($_FILES['defaultProfilePicture']['name']);
                
                $default_Profile_Picture_Extension = $path_parts['extension']; 
                $default_Profile_Picture = $defaultImagePath."DefaultProfilePic.".$default_Profile_Picture_Extension;

                if (!file_exists($defaultImagePath)) {
                    mkdir($defaultImagePath);
                }
                if (!move_uploaded_file($_FILES['defaultProfilePicture']['tmp_name'], $default_Profile_Picture)) {
                    echo "Profile Picture Upload Failed!";
                }
            }
            /*Insert Path in to DB.*/
            if(!empty($default_Profile_Picture)) {

                $editDefaultProfilePic = "UPDATE systemconfiguration SET  `Value` = '".$default_Profile_Picture."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE `Key` = 'DefaultProfilePicture'";

                $editDefaultProfilePicResult = $db_handle->updateQuery($editDefaultProfilePic); 
            }
        }
    }

    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!--important meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Title-->
    <title>Notes MarketPlace</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="images/home/favicon.ico">

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>

    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script_admin.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style_admin.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive_admin.css">
    
    <script type="text/javascript">
        
        //Showing file name at the bottom of the profile and display picture
        $(document).ready(function() {
            $('input[type=file]').change(function() {
                if ($(this)[0].files.length > 0) {
                    filename = "";
                    $.each($(this)[0].files, function(index, item) {
                        filename += item.name + "   ";
                    });
                    $(this).parent().find('.filename').html(filename);
                } else {
                    $(this).parent().find('.filename').html("");
                }
                $(this).parent().find('input[type=hidden]').val("");
            });
        });
    </script>

</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">

        <!--Header Start-->
        <?php include 'admin_header.php' ?>
        <!--Header End-->

        <!--Manage System Configuration Start-->
        <section id="Mange_sys_conf" class="pad_100_for_pages">
            <div class="container">
                <div class="content-box-xs">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
                        <div class="home-heading">
                            <span class="common-heading-1 left_heading-1">Manage System Configuration</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="supportEmail">Support emails address *</label>
                                    <input type="email" class="form-control input_val" id="supportEmail" name="supportEmail" placeholder="Enter email address" onclick="validateSupportEmail();">

                                </div>
                                <div class="form-group form-common">
                                    <label for="supportPhoneNo">Support phone number *</label>
                                    <input type="phone_no" class="form-control input_val" id="supportPhoneNo" name="supportPhoneNo" placeholder="Enter phone number">

                                </div>
                                <div class="form-group form-common">
                                    <label for="emailForNotification">Email Address(es) (for various events system will send notifications to these users) *</label>
                                    <input type="email" class="form-control input_val" id="emailForNotification" name="emailForNotification" placeholder="Enter email address">

                                </div>
                                <div class="form-group form-common">
                                    <label for="facebookUrl">Facebook URL</label>
                                    <input type="text" class="form-control input_val" id="facebookUrl" name="facebookUrl" placeholder="Enter facebook url">

                                </div>
                                <div class="form-group form-common">
                                    <label for="twitterUrl">Twitter URL</label>
                                    <input type="text" class="form-control input_val" id="twitterUrl" name="twitterUrl" placeholder="Enter twitter url">
                                </div>
                                <div class="form-group form-common">
                                    <label for="linkdinUrl">Linkdin URL</label>
                                    <input type="text" class="form-control input_val" id="linkdinUrl" name="linkdinUrl" placeholder="Enter linkdin url">
                                </div>
                                <div class="abccc">
                                    <div class="form-group form-common">

                                        <label for="defaultDisplayPicture">Default image for notes (if seller do not upload)</label>
                                        <input type="file" class="form-control input_val" id="defaultDisplayPicture" name="defaultDisplayPicture" accept="image/jpg,image/png,image/jpeg">
                                        <label class="picture_bottom_2 Center_label_text">Upload a picture</label>
                                        <span class="filename" style="float:left;"></span>
                                    </div>
                                </div>
                                <div class="form-group form-common">
                                    <div class="exyy">
                                        <label for="defaultProfilePicture">Default profile picture (if seller do not upload)</label>
                                        <input type="file" class="form-control input_val" id="defaultProfilePicture" name="defaultProfilePicture" accept="image/jpg,image/png,image/jpeg">
                                        <label class="picture_bottom Center_label_text">Upload a picture</label>
                                        <span class="filename" style="float:left;"></span>
                                    </div>
                                </div>
                                <div class="small-btn general-btn">
                                    <input type="submit" class="btn btn-outline-primary btn-purple" value="SUBMIT" name="submit" />
                                </div>
                            </div>

                            <div class="col-md-6"></div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--Manage System Configuration End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

    </div>


</body>

</html>