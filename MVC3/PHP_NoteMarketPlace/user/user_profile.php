<?php
    session_start();

    global $error;
    $current_user_profile_id = 0;
    
    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    if(isset($_SESSION['user_id'])){
        $folder_name = $uploadPath.$_SESSION['user_id']."/";
        
        $user_detail_query = "SELECT UserProfileDetailID, UserID,DOB,GenderID,PhoneNumber_CountryID,PhoneNumber,ProfilePicture,AddressLine1,AddressLine2,City,State,ZipCode,CountryID,University,College FROM userprofiledetails WHERE UserID = ".$_SESSION['user_id'];

        $user_detail_result = $db_handle->runQuery($user_detail_query);
        
        $current_user_profile_id = !empty($user_detail_result[0]["UserProfileDetailID"]) ? $user_detail_result[0]["UserProfileDetailID"] : 0;
        
                
    }

    if(isset($_REQUEST['submit'])){
    
        //Server Side Validation
        function validate() {
            $error=0;
            $errorMessages = [];

            if(isset($_POST['fname'])){
                $fname=$_POST['fname'];
                if($fname==""){
                    $error=1;
                    $errorMessages[] = 'Please enter your firstname';
                }
                else if(!preg_match("/^[A-Za-z]+$/", $fname)){
                    $error=1;
                    $errorMessages[] = 'Enter only alphabets in firstname';
                }
            }
            if(isset($_POST['lname'])){
                $lname=$_POST['lname'];
                if($lname==""){
                    $error=1;
                    $errorMessages[] = 'Please enter your lastname';
                }
                else if(!preg_match("/^[A-Za-z]+$/", $lname)){
                    $error=1;
                    $errorMessages[] = 'Enter only alphabets in firstname';
                }
            }
            if(isset($_POST['email'])){
                $email=$_POST['email'];
                if($email==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the email';
                }
                else if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)){
                    $error=1;
                    $errorMessages[] = 'Enter valid email';
                }
            }
            if(isset($_POST['hdnProfilePicPath']) && empty($_POST['hdnProfilePicPath'])){
                if(isset($_FILES['profilePicture']['name'])){
                    if (!empty($_FILES['profilePicture']['name'])){
                        if(!empty($_FILES['profilePicture']['type']) && $_FILES['profilePicture']['type'] != 'image/jpeg' && $_FILES['profilePicture']['type'] != 'image/jpg' && $_FILES['profilePicture']['type'] != 'image/png') {
                            $error=1;
                            $errorMessages[] = 'Please upload jpeg, jpg, png files only.';
                        }     
                    }
                }
            }
            if(isset($_POST['addressFirstLine'])){  
                $addressFirstLine=$_POST['addressFirstLine'];
                if($addressFirstLine==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the address field.';
                }
            }
            if(isset($_POST['addressSecondLine'])){            
                $addressSecondLine=$_POST['addressSecondLine'];
                if($addressSecondLine==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the address field.';
                }
            }
            if(isset($_POST['city'])){            
                $city=$_POST['city'];
                if($city==""){
                    $error=1;
                    $errorMessages[] = 'Please enter your city.';
                }
            }
            if(isset($_POST['state'])){            
                $state=$_POST['state'];
                if($state==""){
                    $error=1;
                    $errorMessages[] = 'Please enter your state.';
                }
            }
            if(isset($_POST['country'])){            
                $country=$_POST['country'];
                if($country=="" || $country==0){
                    $error=1;
                    $errorMessages[] = 'Please select anyone.';
                }
            }
            if($error){
                return $errorMessages;
            } else{
                $errorMessages[] = 'success';
                return $errorMessages;        
            }
        }
    }
    if(isset($_REQUEST['submit'])){
        
        
        $validate = validate();
        
        if($validate[0] == 'success'){
            unset($validate); 
           if(isset($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['dateOfBirth'],$_POST['selectGender'],$_POST['selectPhoneCode'],$_POST['phoneNo'],$_POST['addressFirstLine'],$_POST['addressSecondLine'],$_POST['city'],$_POST['state'],$_POST['zipCode'],$_POST['country'],$_POST['userUniversity'],$_POST['userCollege'])) {
           
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];   
                $email = $_POST['email'];
               
                $dateOfBirth = !empty($_POST['dateOfBirth']) ? date_format(date_create($_POST['dateOfBirth']),"Y-m-d") : "NULL";
               
                $gender = !empty($_POST['selectGender']) && (int)$_POST['selectGender'] > 0  ? $_POST['selectGender'] : "NULL";
               
                $phoneCode = !empty($_POST['selectPhoneCode']) && (int)$_POST['selectPhoneCode'] > 0  ? $_POST['selectPhoneCode'] : "NULL";
               
                $phoneNo = $_POST['phoneNo'];
                $addFirstLine = $_POST['addressFirstLine'];
                $addSecondLine = $_POST['addressSecondLine'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $zipCode = $_POST['zipCode'];
                $country = $_POST['country'];
                $userUniversity = $_POST['userUniversity'];
                $userCollege = $_POST['userCollege'];
                                
                if($current_user_profile_id == 0){
                    
                if($_SESSION['user_fname'] != $fname || $_SESSION['user_lname'] != $lname){
                    $updateFieldQuery = "UPDATE users SET FirstName = '".$fname."' ,LastName ='".$lname."' WHERE UserID =".$_SESSION['user_id'];
                    
                    $updateFieldResult = $db_handle->updateQuery($updateFieldQuery);
                    
                    $_SESSION['user_fname'] = $fname;
                    $_SESSION['user_lname'] = $lname;
                }
                    
                $userProfileQuery = "INSERT INTO userprofiledetails (UserID,DOB,GenderID,PhoneNumber_CountryID,PhoneNumber,AddressLine1,AddressLine2,City,State,ZipCode,CountryID,University,College,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES (".$_SESSION['user_id'].",'".$dateOfBirth."',".$gender.",".$phoneCode.",".$phoneNo.",'".$addFirstLine."','".$addSecondLine."','".$city."','".$state."','".$zipCode."','".$country."','".$userUniversity."','".$userCollege."',NOW(),".$_SESSION['user_id'].",NOW(),".$_SESSION['user_id'].",1) " ;
                
                $current_user_profile_id = $db_handle->insertQuery($userProfileQuery);
                    
                if(!empty($current_user_profile_id)){
                    
                    $new_Profile_Pic_File_Name = "";
                    $folder_name = $uploadPath.$_SESSION['user_id']."/";
                    
                    if (!file_exists($folder_name)) {
                        mkdir($folder_name);
                    }
                                        
                    /*Upload Profile Picture*/
                    if(!empty($_FILES['profilePicture']['name'])){
                        $path_parts = pathinfo($_FILES['profilePicture']['name']);
                        $profile_Pic_Extension = $path_parts['extension']; 
                         $new_Profile_Pic_File_Name=$folder_name."PP_".$current_user_profile_id .".".$profile_Pic_Extension;

                        if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $new_Profile_Pic_File_Name)) {
                            $validate[] = "Profile Picture Upload Failed!";
                        }    
                    } else {
                        
                        $defaultProfilePic = "SELECT `Key`, `Value` FROM systemconfiguration WHERE `Key` = 'DefaultProfilePicture'";
                            
                        $defaultProfilePicResult = $db_handle->runQuery($defaultProfilePic);
                        
                        $path_parts = pathinfo($defaultProfilePicResult[0]['Value']);
                        
                        $profile_Pic_Extension = $path_parts['extension'];
                            
                        $new_Profile_Pic_File_Name = $folder_name."PP_".$current_user_profile_id .".".$profile_Pic_Extension;
                            
                        if (!copy($defaultProfilePicResult[0]['Value'], $new_Profile_Pic_File_Name)) {
                            $validate[] = "Display Picture Upload Failed!";
                        }    
                    }
                    
                    //Update Path in to DB.
                    if(!empty($new_Profile_Pic_File_Name)) {

                        $sql = "UPDATE userprofiledetails SET ProfilePicture = '".$new_Profile_Pic_File_Name."'  WHERE UserProfileDetailID=" . $current_user_profile_id;

                        $count = $db_handle->updateQuery($sql); 
                        
                        $_SESSION['profile_pic'] = $new_Profile_Pic_File_Name;
                    }
                    $message = "successfully inserted!";
                  
                    header("location:search_note.php");  
                } else {
                    $validate[] = "insert again!";
                } 
                } else {
                    
                    if($_SESSION['user_fname'] != $fname || $_SESSION['user_lname'] != $lname){
                    $updateFieldQuery = "UPDATE users SET FirstName = '".$fname."' ,LastName ='".$lname."' WHERE UserID =".$_SESSION['user_id'];
                    
                    $updateFieldResult = $db_handle->updateQuery($updateFieldQuery);
                    
                    $_SESSION['user_fname'] = $fname;
                    $_SESSION['user_lname'] = $lname;
                    
                    }
                    $updateProfileQuery = "UPDATE userprofiledetails SET DOB ='".$dateOfBirth."' ,GenderID =".$gender." ,PhoneNumber_CountryID =".$phoneCode." ,PhoneNumber ='".$phoneNo."' ,AddressLine1 ='".$addFirstLine."' ,AddressLine2 ='".$addSecondLine."' ,City ='".$city."' ,State ='".$state."' ,ZipCode ='".$zipCode."' ,CountryID =".$country." ,University ='".$userUniversity."' ,College ='".$userCollege."' WHERE  UserProfileDetailID =".$current_user_profile_id;
                    
                    $update_profile_id = $db_handle->updateQuery($updateProfileQuery);
                    
                    $folder_name = $uploadPath.$_SESSION['user_id']."/";
                
                    /*Update Profile Picture*/
                    if(isset($_POST['hdnProfilePicPath']) && empty($_POST['hdnProfilePicPath'])){
                    if(!empty($_FILES['profilePicture']['name'])){
                        $path_parts = pathinfo($_FILES['profilePicture']['name']);
                        $profile_Pic_Extension = $path_parts['extension']; 
                         $new_Profile_Pic_File_Name=$folder_name."PP_".$current_user_profile_id .".".$profile_Pic_Extension;

                        if (!file_exists($folder_name)) {
                            mkdir($folder_name);
                        }
                        if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $new_Profile_Pic_File_Name)) {
                            $validate[] = "Profile Picture Upload Failed!";
                        }    
                    }
                    $sqlUpdateProfilePic = "UPDATE userprofiledetails SET ProfilePicture = '".$new_Profile_Pic_File_Name."'  WHERE UserProfileDetailID=" . $current_user_profile_id;

                    $sqlUpdateProfilePicResult = $db_handle->updateQuery($sqlUpdateProfilePic); 
                        
                    $_SESSION['profile_pic'] = $new_Profile_Pic_File_Name;
                    }
                }
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
    <link rel="shortcut icon" href="images/login/favicon.ico">

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" media="all"      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css" />

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">

    <script>
        reOnlyAlphabet = /^[A-Za-z]+$/;
        reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        function validateUserFirstName() {
            isValidUserFname = false;

            if ($("#fname").val() == "" || $("#fname").val() == null || $("#fname").val().trim().length == 0) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please enter your first name.");
                isValidUserFname = false;
            } else if (!reOnlyAlphabet.test($("#fname").val())) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please enter only alphabets.");
                isValidUserFname = false;
            } else {
                $("#fname").removeClass("borderHighlight");
                $("#fnameVal").css("visibility", "hidden");
                isValidUserFname = true;
            }
            return isValidUserFname;
        }

        function validateUserLastName() {
            isValidUserLname = false;

            if ($("#lname").val() == "" || $("#lname").val() == null || $("#lname").val().trim().length == 0) {
                $("#lname").focusin();
                $("#lname").addClass("borderHighlight");
                $("#lnameVal").css("visibility", "visible");
                $("#lnameVal").html("Please enter your last name.");
                isValidUserLname = false;
            } else if (!reOnlyAlphabet.test($("#lname").val())) {
                $("#lname").focusin();
                $("#lname").addClass("borderHighlight");
                $("#lnameVal").css("visibility", "visible");
                $("#lnameVal").html("Please enter only alphabets.");
                isValidUserLname = false;
            } else {
                $("#lname").removeClass("borderHighlight");
                $("#lnameVal").css("visibility", "hidden");
                isValidUserLname = true;
            }
            return isValidUserLname;
        }
        function validateProfilePicture() {

            isValidProfilePicture = false;
            
            if ($("#hdnProfilePicPath").val() == "") {
                if ($("#profilePicture")[0].files.length != 0) {
                    var ext = $('#profilePicture').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                        $("#profilePicture").addClass("borderHighlight");
                        $("#profilePictureVal").css("visibility", "visible");
                        $("#profilePictureVal").html("Please upload jpg, jpeg, png files.");
                        isValidProfilePicture = false;
                    } else {
                        $("#profilePicture").removeClass("borderHighlight");
                        $("#profilePictureVal").css("visibility", "hidden");
                        isValidProfilePicture = true;
                    }
                } else {
                    $("#profilePicture").removeClass("borderHighlight");
                    $("#profilePictureVal").css("visibility", "hidden");
                    isValidProfilePicture = true;
                }
            } else {
                $("#profilePicture").removeClass("borderHighlight");
                $("#profilePictureVal").css("visibility", "hidden");
                isValidProfilePicture = true;
            }
            return isValidProfilePicture;
        }
        function validateUserAddressFirstLine() {
            isValidUserAddressFirstLine = false;

            if ($("#addressFirstLine").val() == "" || $("#addressFirstLine").val() == null || $("#addressFirstLine").val().trim().length == 0) {
                $("#addressFirstLine").focusin();
                $("#addressFirstLine").addClass("borderHighlight");
                $("#addressFirstLineVal").css("visibility", "visible");
                $("#addressFirstLineVal").html("Please enter your address.");
                isValidUserAddressFirstLine = false;
            } else {
                $("#addressFirstLine").removeClass("borderHighlight");
                $("#addressFirstLineVal").css("visibility", "hidden");
                isValidUserAddressFirstLine = true;
            }
            return isValidUserAddressFirstLine;
        }

        function validateUserAddressSecondLine() {
            isValidUserAddressSecondLine = false;

            if ($("#addressSecondLine").val() == "" || $("#addressSecondLine").val() == null || $("#addressSecondLine").val().trim().length == 0) {
                $("#addressSecondLine").focusin();
                $("#addressSecondLine").addClass("borderHighlight");
                $("#addressSecondLineVal").css("visibility", "visible");
                $("#addressSecondLineVal").html("Please enter your address.");
                isValidUserAddressSecondLine = false;
            } else {
                $("#addressSecondLine").removeClass("borderHighlight");
                $("#addressSecondLineVal").css("visibility", "hidden");
                isValidUserAddressSecondLine = true;
            }
            return isValidUserAddressSecondLine;
        }

        function validateUserCity() {
            isValidUserCity = false;

            if ($("#city").val() == "" || $("#city").val() == null || $("#city").val().trim().length == 0) {
                $("#city").focusin();
                $("#city").addClass("borderHighlight");
                $("#cityVal").css("visibility", "visible");
                $("#cityVal").html("Please enter your city.");
                isValidUserCity = false;
            } else {
                $("#city").removeClass("borderHighlight");
                $("#cityVal").css("visibility", "hidden");
                isValidUserCity = true;
            }
            return isValidUserCity;
        }

        function validateUserState() {
            isValidUserState = false;

            if ($("#state").val() == "" || $("#state").val() == null || $("#state").val().trim().length == 0) {
                $("#state").focusin();
                $("#state").addClass("borderHighlight");
                $("#stateVal").css("visibility", "visible");
                $("#stateVal").html("Please enter your state.");
                isValidUserState = false;
            } else {
                $("#state").removeClass("borderHighlight");
                $("#stateVal").css("visibility", "hidden");
                isValidUserState = true;
            }
            return isValidUserState;
        }

        function validateUserCountry() {
            isValidUserCountry = false;

            if ($("#country").val() == 0) {
                $("#country").focusin();
                $("#country").addClass("borderHighlight");
                $("#countryVal").css("visibility", "visible");
                $("#countryVal").html("Please select anyone.");
                isValidUserCountry = false;
            } else {
                $("#country").removeClass("borderHighlight");
                $("#countryVal").css("visibility", "hidden");
                isValidUserCountry = true;
            }
            return isValidUserCountry;
        }

        function validateUserProfileForm() {
            isvalidUserProfileForm = false;

            isValidUserFname = validateUserFirstName();
            isValidUserLname = validateUserLastName();
            isValidProfilePicture = validateProfilePicture();
            isValidUserAddressFirstLine = validateUserAddressFirstLine();
            isValidUserAddressSecondLine = validateUserAddressSecondLine();
            isValidUserCity = validateUserCity();
            isValidUserState = validateUserState();
            isValidUserCountry = validateUserCountry();

            if (isValidUserFname && isValidUserLname && isValidProfilePicture && isValidUserAddressFirstLine && isValidUserAddressSecondLine && isValidUserCity && isValidUserState && isValidUserCountry) {
                isvalidUserProfileForm = true;
            }
            return isvalidUserProfileForm;
        }

        $(document).ready(function() {
            $("#dateOfBirth").datepicker({
                dateFormat: 'dd-mm-yy',
            });
            $("#imgDateOfBirth").click(function() { 
            $("#dateOfBirth").datepicker( "show" );
            });
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
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--User Profile Start-->
        <section id="user_profile">
            <div class="common-top  pad_100_for_pages">
                <div class="content-box-lg">
                    <div class="container">
                        <span class="common-heading-1 center_heading-1 main_heading">User Profile</span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content-box-sm">
                    <?php
                    if(isset($validate) && $validate[0] != 'success'){
                            foreach($validate as $error){
                    ?>
                    <p style="color:#ea4748"><?php echo $error ; ?></p>
                    <?php
                            }
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateUserProfileForm();">
                        <input type="hidden" name="current_user_profile_id" value="<?php echo $current_user_profile_id;?>" />
                        <div class="home-heading">
                            <span class="common-heading-1 left_heading-1 common-head-pad">Basic Profile Details</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="fname">First Name * </label>
                                    <input type="text" class="form-control input_val" id="fname" name="fname"<?php if(isset($_SESSION['user'])){
                                        echo " value ='".$_SESSION['user_fname']."'";
                                    }?> placeholder="Enter your first name" onblur="validateUserFirstName();">
                                    <span class="spnValMsg" id="fnameVal"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="lname">Last Name * </label>
                                    <input type="text" class="form-control input_val" id="lname" name="lname"<?php if(isset($_SESSION['user'])){
                                        echo " value ='".$_SESSION['user_lname']."'";
                                    }?>  placeholder="Enter your last name" onblur="validateUserLastName();">
                                    <span class="spnValMsg" id="lnameVal"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="email">Email *</label>
                                    <input type="text" class="form-control input_val" id="email" name="email" <?php if(isset($_SESSION['user'])){
                                        echo " value ='".$_SESSION['user']."' readonly";
                                    }?> placeholder="Enter your email address" onblur="validateUserEmail();">
                                    <span class="spnValMsg" id="emailVal"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="dateOfBirth">Date Of Birth</label>
                                    <input type="text" class="form-control input_val" id="dateOfBirth" name="dateOfBirth" <?php if($current_user_profile_id != 0 && !empty($user_detail_result[0]["DOB"]) && $user_detail_result[0]["DOB"] > 0){
                                        echo " value =".date("d-m-Y", strtotime($user_detail_result[0]["DOB"]));
    
                                    }
                                    ?>
                                    placeholder="Enter your date of birth">
                                    <i class="common-icon pull-right" id="imgDateOfBirth"><img src="images/Profile/calendar.png"/></i>
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="selectGender">Gender</label>
                                    <?php 
                                    
                                    $genderQuery = "SELECT Value,  DataValue,ReferenceCategory FROM referencedata WHERE ReferenceCategory = 'Gender'";
                                    
                                    $genderResult = $db_handle->runQuery($genderQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectGender" name="selectGender">
                                        <option value="0">Select your gender</option>
                                        <?php                   
                                        foreach($genderResult as $genderRow){
                                            echo "<option value='" . $genderRow['DataValue'] . "'";
                                            if($current_user_profile_id != 0 && !empty($user_detail_result[0]["GenderID"]) && $user_detail_result[0]["GenderID"] > 0 && $genderRow['DataValue'] == $user_detail_result[0]["GenderID"]){
                                                echo " selected";
                                            }
                                            echo ">". $genderRow['Value']."</option>";
                                        }
                                        ?>
                                    </select>
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="phoneNo">Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-3 col-4">
                                            <?php 
                                    
                                                $phoneCodeQuery = "SELECT CountryID,  PhoneCode FROM countries";
                                                $phoneCodeResult = $db_handle->runQuery($phoneCodeQuery);
                                                
                                            ?>
                                            <select class="form-control dropdown-control" id="selectPhoneCode" name="selectPhoneCode">
                                                
                                                <?php                   
                                                foreach($phoneCodeResult as $phoneCodeRow){
                                                    echo "<option value='" . $phoneCodeRow['CountryID'] . "'";
                                                    if($current_user_profile_id != 0 && !empty($user_detail_result[0]["PhoneNumber_CountryID"]) && $user_detail_result[0]["PhoneNumber_CountryID"] > 0 && $phoneCodeRow['CountryID'] == $user_detail_result[0]["PhoneNumber_CountryID"]){
                                                echo " selected";
                                            }
                                            echo "> + ". $phoneCodeRow['PhoneCode'] . "</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-9 col-8">
                                            <input type="text" class="form-control input_val" id="phoneNo" name="phoneNo" <?php if($current_user_profile_id != 0 && !empty($user_detail_result[0]["PhoneNumber"])){
                                            echo " value ='".$user_detail_result[0]["PhoneNumber"]."'";
                                            }
                                            ?>
                                               placeholder="Enter your phone number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="profilePicture">Profile Picture</label>
                                    <input type="file" class="form-control input_val" id="profilePicture" name="profilePicture" accept="image/jpg,image/png,image/jpeg" onsubmit="return validateProfilePicture();" />
                                    <label class="picture_bottom">Upload a picture</label>
                                    <?php
                                    if($current_user_profile_id != 0 && !empty($user_detail_result[0]["ProfilePicture"])){
                                        echo '<input type="hidden" name="hdnProfilePicPath" id="hdnProfilePicPath" value = "'.$user_detail_result[0]["ProfilePicture"].'"/>
                                        <span class="filename" style="float:left;">'.str_replace($folder_name,"",$user_detail_result[0]["ProfilePicture"]).'</span>';
                                    } else {
                                        echo '<input type="hidden" name="hdnProfilePicPath" id="hdnProfilePicPath"/>
                                        <span class="filename" style="float:left;"></span>';
                                    }
                                    ?>
                                    <span id="profilePictureVal" class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="content-box-xs">
                            <div class="home-heading">
                                <span class="common-heading-1 left_heading-1 common-head-pad">Address Details</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-common">
                                        <label for="addressFirstLine">Address Line 1 * </label>
                                        <input type="text" class="form-control input_val" id="addressFirstLine" name="addressFirstLine" <?php if($current_user_profile_id != 0 ){
                                        echo " value ='".$user_detail_result[0]["AddressLine1"]."'";
                                        }
                                        ?>
                                       placeholder="Enter your address" onblur="validateUserAddressFirstLine();">
                                        <span class="spnValMsg" id="addressFirstLineVal"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-common">
                                        <label for="addressSecondLine">Address Line 2 * </label>
                                        <input type="text" class="form-control input_val" id="addressSecondLine" name="addressSecondLine" <?php if($current_user_profile_id != 0 ){
                                        echo " value ='".$user_detail_result[0]["AddressLine2"]."'";
                                        }
                                        ?>
                                        placeholder="Enter your address" onblur="validateUserAddressSecondLine();">
                                        <span class="spnValMsg" id="addressSecondLineVal"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-common">
                                        <label for="city">City *</label>
                                        <input type="text" class="form-control input_val" id="city" name="city" placeholder="Enter your city" <?php if($current_user_profile_id != 0 ){
                                        echo " value ='".$user_detail_result[0]["City"]."'";
                                        }
                                        ?>
                                        onblur="validateUserCity();">
                                        <span class="spnValMsg" id="cityVal"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-common">
                                        <label for="state">State *</label>
                                        <input type="text" class="form-control input_val" id="state" name="state" placeholder="Enter your state" <?php if($current_user_profile_id != 0 ){
                                        echo " value ='".$user_detail_result[0]["State"]."'";
                                        }
                                        ?> onblur="validateUserState();">
                                        <span class="spnValMsg" id="stateVal"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-common">
                                        <label for="zipCode">ZipCode</label>
                                        <input type="zip" class="form-control input_val" id="zipCode" name="zipCode" placeholder="Enter your zipcode" <?php if($current_user_profile_id != 0 && !empty($user_detail_result[0]["ZipCode"])){
                                        echo " value ='".$user_detail_result[0]["ZipCode"]."'";
                                        }
                                        ?>>
                                        <span class="spnValMsg">Please fill out this field.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-common">
                                        <label for="country">Country *</label>
                                        <?php 
                                            $countryQuery = "select CountryID,  CountryName from countries";
                                            $countryResult = $db_handle->runQuery($countryQuery);
                                        ?>
                                        <select class="form-control dropdown-control" id="country" name="country" onblur="validateUserCountry();">
                                            <option value="0">Select your country</option>
                                            <?php                   
                                                foreach($countryResult as $countryRow){
                                                    echo "<option value='" . $countryRow['CountryID'] . "'";
                                                    if($current_user_profile_id != 0 && !empty($user_detail_result[0]["CountryID"]) && $user_detail_result[0]["CountryID"] > 0 && $countryRow["CountryID"] == $user_detail_result[0]["CountryID"]){
                                                    echo " selected";
                                                }
                                                echo ">".$countryRow['CountryName']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <span class="spnValMsg" id="countryVal"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="home-heading">
                            <span class="common-heading-1 left_heading-1 common-head-pad">University and College Information</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="userUniversity">University</label>
                                    <input type="text" class="form-control input_val" id="userUniversity" name="userUniversity" <?php 
                                        if($current_user_profile_id != 0 && !empty($user_detail_result[0]["University"])){
                                            echo " value = '".$user_detail_result[0]['University']."'";
                                        }
                                    ?>placeholder="Enter your university">
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="userCollege">College</label>
                                    <input type="text" class="form-control input_val" id="userCollege" name="userCollege" <?php 
                                        if($current_user_profile_id != 0 && !empty($user_detail_result[0]["College"])){
                                            echo " value = '".$user_detail_result[0]['College']."'";
                                        }
                                    ?>placeholder="Enter your college">
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
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
        <!--User Profile End-->

        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->

    </div>

</body>

</html>