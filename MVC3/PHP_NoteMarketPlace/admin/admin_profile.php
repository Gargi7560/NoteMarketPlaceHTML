<?php 
    session_start();

    global $error;
    $current_admin_profile_id = 0;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';
    
    if(isset($_SESSION['user_id'])){
        $folder_name = $adminUploadPath.$_SESSION['user_id']."/";
        
        $admin_detail_query = "SELECT UserProfileDetailID, UserID,SecondaryEmailAddress,PhoneNumber_CountryID,PhoneNumber,ProfilePicture FROM userprofiledetails WHERE UserID = ".$_SESSION['user_id'];
        
        $admin_detail_result = $db_handle->runQuery($admin_detail_query);
        
        $current_admin_profile_id = !empty($admin_detail_result[0]["UserProfileDetailID"]) ? $admin_detail_result[0]["UserProfileDetailID"] : 0;
    }

    //Server Side Validation
    if(isset($_REQUEST['submit'])){
    
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
            
            if(isset($_POST['fname'],$_POST['lname'],$_POST['secondEmail'],$_POST['selectPhoneCode'],$_POST['phoneNo'])) {
                
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $secondEmail = $_POST['secondEmail'];
                
                $phoneCode = !empty($_POST['selectPhoneCode']) && (int)$_POST['selectPhoneCode'] > 0  ? $_POST['selectPhoneCode'] : "NULL";
               
                $phoneNo = $_POST['phoneNo'];
                
                if($current_admin_profile_id > 0){
                    
                    //Update user data in users table
                    if($_SESSION['user_fname'] != $fname || $_SESSION['user_lname'] != $lname){

                        $updateFieldQuery = "UPDATE users SET FirstName = '".$fname."' ,LastName ='".$lname."' WHERE UserID =".$_SESSION['user_id'];

                        $updateFieldResult = $db_handle->updateQuery($updateFieldQuery);

                        $_SESSION['user_fname'] = $fname;
                        $_SESSION['user_lname'] = $lname;
                    }
                    //Update user data in userprofile table
                    $updateAdminProfileQuery = "UPDATE userprofiledetails SET PhoneNumber_CountryID =".$phoneCode." ,PhoneNumber ='".$phoneNo."' ,SecondaryEmailAddress = '".$secondEmail."' WHERE UserProfileDetailID =".$current_admin_profile_id;
                    
                    $updateAdminProfileResult = $db_handle->updateQuery($updateAdminProfileQuery);
                    
                    $new_Profile_Pic_File_Name = "";
                    $folder_name = $adminUploadPath.$_SESSION['user_id']."/";
                    
                    if (!file_exists($folder_name)) {
                        mkdir($folder_name);
                    }
                    
                    /*Update Profile Picture*/
                    if(isset($_POST['hdnProfilePicPath']) && empty($_POST['hdnProfilePicPath'])){
                        
                        //Update Profile Picture (if user upload)
                        if(!empty($_FILES['profilePicture']['name'])){
                            $path_parts = pathinfo($_FILES['profilePicture']['name']);
                            $profile_Pic_Extension = $path_parts['extension']; 
                             $new_Profile_Pic_File_Name=$folder_name."PP_".$current_admin_profile_id .".".$profile_Pic_Extension;

                            if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $new_Profile_Pic_File_Name)) {
                                $validate[] = "Profile Picture Upload Failed!";
                            }    
                        } 
                        
                        //Default Update Profile Picture (if user do not upload)
                        else {
                            $defaultProfilePic = "SELECT `Key`, `Value` FROM systemconfiguration WHERE `Key` = 'DefaultProfilePicture'";
                            
                            $defaultProfilePicResult = $db_handle->runQuery($defaultProfilePic);
                            
                            $path_parts = pathinfo($defaultProfilePicResult[0]['Value']);
                        
                            $profile_Pic_Extension = $path_parts['extension'];
                            
                            $new_Profile_Pic_File_Name = $folder_name."PP_".$current_admin_profile_id .".".$profile_Pic_Extension;
                            
                            if (!copy($defaultProfilePicResult[0]['Value'], $new_Profile_Pic_File_Name)) {
                                $validate[] = "Display Picture Upload Failed!";
                            }
                        } 
                        $sqlUpdateProfilePic = "UPDATE userprofiledetails SET ProfilePicture = '".$new_Profile_Pic_File_Name."'  WHERE UserProfileDetailID=" . $current_admin_profile_id;

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
        
        //Client side validation
        reOnlyAlphabet = /^[A-Za-z]+$/;
        reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        function validateAdminFirstName() {
            isValidAdminFname = false;

            if ($("#fname").val() == "" || $("#fname").val() == null || $("#fname").val().trim().length == 0) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please enter your first name.");
                isValidAdminFname = false;
            } else if (!reOnlyAlphabet.test($("#fname").val())) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please enter only alphabets.");
                isValidAdminFname = false;
            } else {
                $("#fname").removeClass("borderHighlight");
                $("#fnameVal").css("visibility", "hidden");
                isValidAdminFname = true;
            }
            return isValidAdminFname;
        }  
        function validateAdminLastName() {
            isValidAdminLname = false;

            if ($("#lname").val() == "" || $("#lname").val() == null || $("#lname").val().trim().length == 0) {
                $("#lname").focusin();
                $("#lname").addClass("borderHighlight");
                $("#lnameVal").css("visibility", "visible");
                $("#lnameVal").html("Please enter your last name.");
                isValidAdminLname = false;
            } else if (!reOnlyAlphabet.test($("#lname").val())) {
                $("#lname").focusin();
                $("#lname").addClass("borderHighlight");
                $("#lnameVal").css("visibility", "visible");
                $("#lnameVal").html("Please enter only alphabets.");
                isValidAdminLname = false;
            } else {
                $("#lname").removeClass("borderHighlight");
                $("#lnameVal").css("visibility", "hidden");
                isValidAdminLname = true;
            }
            return isValidAdminLname;
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
        
        function validateAdminProfileForm() {
            isvalidAdminProfileForm = false;

            isValidAdminFname = validateAdminFirstName();
            isValidAdminLname = validateAdminLastName();
            isValidProfilePicture = validateProfilePicture();
            
            if (isValidAdminFname && isValidAdminLname && isValidProfilePicture) {
                isvalidAdminProfileForm = true;
            }
            return isvalidAdminProfileForm;
        }
        
        //Shows file name at the bottom of the profile pic field
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
        
        <!--Admin Profile Start--> 
        <section id="admin_profile" class="pad_100_for_pages"> 
        <div class="container">
        
           <div class="content-box-xs">
           <?php
            if(isset($validate) && $validate[0] != 'success'){
                    foreach($validate as $error){
            ?>
            <p style="color:#ea4748"><?php echo $error ; ?></p>
            <?php
                    }
                }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateAdminProfileForm();">
                <span class="common-heading-1 left_heading-1">My Profile</span>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-common">
                            <label for="fname">First Name * </label>
                            <input type="text" class="form-control input_val" id="fname" name="fname"<?php if(isset($_SESSION['user'])){
                                echo " value ='".$_SESSION['user_fname']."'";
                            }?> placeholder="Enter your first name" onblur="validateAdminFirstName();">
                            <span id="fnameVal" class="spnValMsg"></span>
                        </div>
                        
                        <div class="form-group form-common">
                            <label for="lname">Last Name * </label>
                            <input type="text" class="form-control input_val" id="lname" name="lname"<?php if(isset($_SESSION['user'])){
                                echo " value ='".$_SESSION['user_lname']."'";
                            }?> placeholder="Enter your last name" onblur="validateUserAdminName();">
                            <span id="lnameVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="email">Email *</label>
                            <input type="text" class="form-control input_val" id="email" name="email" <?php if(isset($_SESSION['user'])){
                                echo " value ='".$_SESSION['user']."' readonly";
                            }?> placeholder="Enter your email address">
                            <span id="emailVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="secondEmail">Secondary Email</label>
                            <input type="text" class="form-control input_val" id="secondEmail" name="secondEmail" <?php if(!empty($admin_detail_result[0]["SecondaryEmailAddress"])){
                                echo " value ='".$admin_detail_result[0]["SecondaryEmailAddress"]."'";
                            } ?> placeholder="Enter your email address">
                            <span class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="phoneNo">Phone Number</label>
                                <div class="row">
                                    <div class="col-4">
                                    <?php 
                                        $phoneCodeQuery = "SELECT CountryID,  PhoneCode FROM countries";
                                        $phoneCodeResult = $db_handle->runQuery($phoneCodeQuery);
                                    ?>
                                      <select class="form-control dropdown-control" id="selectPhoneCode" name="selectPhoneCode">
                                        <?php    foreach($phoneCodeResult as $phoneCodeRow){ 
                                          echo "<option value='" .$phoneCodeRow['CountryID'] . "'";
                                            if(!empty($admin_detail_result[0]["PhoneNumber_CountryID"]) && $admin_detail_result[0]["PhoneNumber_CountryID"] > 0 && $phoneCodeRow['CountryID'] == $admin_detail_result[0]["PhoneNumber_CountryID"]){
                                                echo " selected";
                                            }
                                            echo  " > + ".$phoneCodeRow['PhoneCode']."</option>";
                                        } ?>
                                        </select>
                                    </div>
                                        
                                        <div class="col-8">
                                            <input type="text" class="form-control input_val" id="phoneNo" name="phoneNo" <?php if(!empty($admin_detail_result[0]["PhoneNumber"])){
                                                echo " value = '".$admin_detail_result[0]["PhoneNumber"]."'";
                                            } ?> placeholder="Enter your phone number">
                                        </div>
                                    </div>
                                </div>
                        <div class="form-group form-common">
                            <label for="profile_picture">Profile Picture</label>
                                <input type="file" class="form-control input_val" id="profilePicture" name="profilePicture" placeholder="Upload a picture">
                                <label class="Center_label_text picture_bottom">Upload a picture</label>
                               <?php if(!empty($admin_detail_result[0]["ProfilePicture"])){
                                    echo '<input type="hidden" name="hdnProfilePicPath" id="hdnProfilePicPath" value = "'.$admin_detail_result[0]["ProfilePicture"].'"/>
                                    <span class="filename" style="float:left;">'.str_replace($folder_name,"",$admin_detail_result[0]["ProfilePicture"]).'</span>';
                                } else {
                                    echo '<input type="hidden" name="hdnProfilePicPath" id="hdnProfilePicPath"/>
                                    <span class="filename" style="float:left;"></span>'; 
                                } ?>
                                <span id="profilePictureVal" class="spnValMsg"></span>
                        </div>
                        <div class="small-btn general-btn">
                            <input type="submit" class="btn btn-outline-primary btn-purple" value="SUBMIT" name="submit" />
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </section>
        <!--Admin Profile End-->
        
        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

        </div>
    </body>
</html>