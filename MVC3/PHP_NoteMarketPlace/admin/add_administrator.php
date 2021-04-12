<?php 

    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    global $error;
    $current_admin_profile_id = 0;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Get user data from users table from database
    if(!empty($_GET["user_id"]) && $_GET["user_id"] >0) {
        
        $current_admin_profile_id = $_GET["user_id"];
        
        $admin_member_query = "SELECT UserID,FirstName,LastName,Email FROM users WHERE UserID = ".$current_admin_profile_id;
        
        $admin_member_result = $db_handle->runQuery($admin_member_query);
        
        if(!empty($admin_member_result)){
            $admin_member_detail_query = "SELECT UserID,PhoneNumber_CountryID,PhoneNumber FROM userprofiledetails WHERE UserID = ".$current_admin_profile_id;
        
            $admin_member_detail_result = $db_handle->runQuery($admin_member_detail_query);
        }
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
            if(isset($_POST['phoneNo'])){
                $phoneNo=$_POST['phoneNo'];
                if($phoneNo==""){
                    $error=1;
                    $errorMessages[] = 'Please fill the phone number';
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
            
            if(isset($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['phoneNo'])){
                
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $email=$_POST['email'];
                $phoneCode = !empty($_POST['selectPhoneCode']) && (int)$_POST['selectPhoneCode'] > 0  ? $_POST['selectPhoneCode'] : "NULL";
                $phoneNo = $_POST['phoneNo'];
                
                $current_admin_profile_id = $_POST['current_admin_profile_id'];
                
                //Insert users
                if($current_admin_profile_id == 0) {
                
                    //Only unique email entry
                    $query = "SELECT * FROM users where email = '" . $email . "'";
                    $count = $db_handle->numRows($query);

                    if($count==0){

                        $addAdminQuery = "INSERT INTO users (UserRoleID,FirstName,LastName,Email,Password,IsEmailVerified,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES (".$adminUserRoleID.",'".$fname."','".$lname."','".$email."','".MD5($adminTempPassword)."',1,NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";

                        $addAdminResult = $db_handle->insertQuery($addAdminQuery);

                        if(!empty($addAdminResult)) {
                            $addAdminProfileQuery = "INSERT INTO userprofiledetails (UserID, PhoneNumber_CountryID, PhoneNumber, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive ) VALUES (".$addAdminResult.",".$phoneCode.",'".$phoneNo."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";

                            $addAdminProfileResult = $db_handle->insertQuery($addAdminProfileQuery);

                            $message = "successfully inserted!";
                        }
                    } else {		    
                        $validate[] = "Email <b>".$email."</b> is already in use.";
                   }
                }
                
                //Update users for existed users    
                else {
                    $editAdminQuery = "UPDATE users SET FirstName = '".$fname."', LastName = '".$lname."', Email = '".$email."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE UserID = ".$current_admin_profile_id;   

                    $editAdminResult = $db_handle->updateQuery($editAdminQuery);

                    $editAdminProfileQuery = "UPDATE userprofiledetails SET  PhoneNumber_CountryID = ".$phoneCode.", PhoneNumber = '".$phoneNo."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE UserID = ".$current_admin_profile_id;

                    $editAdminProfileResult = $db_handle->updateQuery($editAdminProfileQuery);

                }
            } else {
                echo 'Data not inserted!';
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
        
        //Client Side validation  
        
        reOnlyAlphabet = /^[A-Za-z]+$/;
        reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        
        function validateFirstName() {

            isValidFname = false;

            if ($("#fname").val() == "" || $("#fname").val() == null || $("#fname").val().trim().length == 0) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please fill the first name.");
                isValidFname = false;
            } else if (!reOnlyAlphabet.test($("#fname").val())) {
                $("#fname").focusin();
                $("#fname").addClass("borderHighlight");
                $("#fnameVal").css("visibility", "visible");
                $("#fnameVal").html("Please enter only alphabets.");
                isValidFname = false;
            } else {
                $("#fname").removeClass("borderHighlight");
                $("#fnameVal").css("visibility", "hidden");
                isValidFname = true;
            }
            return isValidFname;
        }

        function validateLastName() {

            isValidLname = false;

            if ($("#lname").val() == "" || $("#lname").val() == null || $("#lname").val().trim().length == 0) {
                $("#lname").focusin();
                $("#lname").addClass("borderHighlight");
                $("#lnameVal").css("visibility", "visible");
                $("#lnameVal").html("Please fill out this field.");
                isValidLname = false;
            } else if (!reOnlyAlphabet.test($("#lname").val())) {
                $("#lname").focusin();
                $("#lname").addClass("borderHighlight");
                $("#lnameVal").css("visibility", "visible");
                $("#lnameVal").html("Please enter only alphabets.");
                isValidLname = false;
            } else {
                $("#lname").removeClass("borderHighlight");
                $("#lnameVal").css("visibility", "hidden");
                isValidLname = true;
            }
            return isValidLname;
        }
        function validateEmail() {

            isValidEmail = false;

            if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please fill out this field.");
                isValidEmail = false;
            } else if (!reForEmail.test($("#email").val())) {
                $("#email").focusin();
                $("#email").addClass("borderHighlight");
                $("#emailVal").css("visibility", "visible");
                $("#emailVal").html("Please enter valid email.");
                isValidEmail = false;
            } else {
                $("#email").removeClass("borderHighlight");
                $("#emailVal").css("visibility", "hidden");
                isValidEmail = true;
            }
            return isValidEmail;
        }
        function validatePhoneCode() {

            isValidPhoneCode = false;

            if ($("#phoneNo").val() == "" || $("#phoneNo").val() == null || $("#phoneNo").val().trim().length == 0) {
                $("#phoneNo").focusin();
                $("#phoneNo").addClass("borderHighlight");
                $("#phoneNoVal").css("visibility", "visible");
                $("#phoneNoVal").html("Please fill out this field.");
                isValidPhoneCode = false;
            } else {
                $("#phoneNo").removeClass("borderHighlight");
                $("#phoneNoVal").css("visibility", "hidden");
                isValidPhoneCode = true;
            }
            return isValidPhoneCode;
        }
        function validateAddAdminForm() {
            isValidAddAdminForm = false;

            isValidFname = validateFirstName();
            isValidLname = validateLastName();
            isValidEmail = validateEmail();
            isValidPhoneCode = validatePhoneCode();

            if (isValidFname && isValidLname && isValidEmail && isValidPhoneCode) {
                isValidAddAdminForm = true;
            }
            return isValidAddAdminForm;
        }
    </script>
   
    </head>
    
    <body data-spy="scroll" class="overflow-auto sticky-header">
        <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->
        
        <!--Add Administrator Start--> 
        <section id="add_administrator" class="pad_100_for_pages"> 
        <div class="container">
            <div class="content-box-xs">
            
            <!--Shows server side validation success message-->
            <?php if(isset($message)){ ?>
                    <p class="successMsg"><img src="images/login/SUCCESS.png" alt="success">
                        <?php echo $message ;?>
                    </p>
            <?php } ?>
                    
            <!--Shows server side validation error message-->
            <?php
            if(isset($validate) && $validate[0] != 'success'){
                    foreach($validate as $error){
            ?>
            <p style="color:#ea4748"><?php echo $error ; ?></p>
            <?php
                    }
                }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateAddAdminForm();">
                <input type="hidden" name="current_admin_profile_id" value="<?php echo $current_admin_profile_id;?>" />
                <span class="common-heading-1 left_heading-1">Add Administrator</span>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-common">
                            <label for="fname">First Name * </label>
                            <input type="text" class="form-control input_val" id="fname" name="fname" <?php if($current_admin_profile_id != 0 && !empty($admin_member_result[0]["FirstName"])){
                                echo " value ='".$admin_member_result[0]["FirstName"]."'";
                            }
                            ?> placeholder="Enter your first name" onblur="validateFirstName();">
                            <span id="fnameVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="lname">Last Name * </label>
                            <input type="text" class="form-control input_val" id="lname" name="lname" <?php if($current_admin_profile_id != 0 && !empty($admin_member_result[0]["LastName"])){
                                echo " value ='".$admin_member_result[0]["LastName"]."'";
                            }
                            ?>placeholder="Enter your last name" onblur="validateLastName();">
                            <span id="lnameVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control input_val" id="email" name="email" <?php if($current_admin_profile_id != 0 && !empty($admin_member_result[0]["Email"])){
                                echo " value ='".$admin_member_result[0]["Email"]."'";
                            }
                            ?>placeholder="Enter your email address" onblur="validateEmail();">
                            <span id="emailVal" class="spnValMsg"></span>
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
                                    <?php    
                                        foreach($phoneCodeResult as $phoneCodeRow){ 
                                          echo "<option value='" .$phoneCodeRow['CountryID'] . "'";
                                        
                                            if($current_admin_profile_id != 0 && !empty($admin_member_detail_result[0]["PhoneNumber_CountryID"]) && $admin_member_detail_result[0]["PhoneNumber_CountryID"] > 0 && $phoneCodeRow['CountryID'] == $admin_member_detail_result[0]["PhoneNumber_CountryID"]) {
                                                echo " selected";
                                            }
                                            echo "> + ".$phoneCodeRow['PhoneCode']."</option>"; 
                                        } ?>  
                                    </select>
                                </div>

                                <div class="col-8">
                                    <input type="text" class="form-control input_val" id="phoneNo" name="phoneNo" <?php if($current_admin_profile_id != 0 && !empty($admin_member_detail_result[0]["PhoneNumber"])){
                                        echo " value ='".$admin_member_detail_result[0]["PhoneNumber"]."'";
                                    }
                                    ?>placeholder="Enter your phone number" onblur="validatePhoneCode();">
                                    <span id="phoneNoVal" class="spnValMsg"></span>
                                </div>
                            </div>
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
        <!--Add Administrator End-->
        
        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

        </div>
        
    
    </body>
</html>