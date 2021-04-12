<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    $current_country_id = 0;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Get country data from countries table from database
    if(!empty($_GET["country_id"]) && $_GET["country_id"] >0) {
        
        $current_country_id = $_GET["country_id"];
        
        $admin_country_query = "SELECT CountryID,CountryName,PhoneCode FROM countries WHERE CountryID = ".$current_country_id;
        
        $admin_country_result = $db_handle->runQuery($admin_country_query);
    }

    //Server side validation
    if(isset($_REQUEST['submit'])){
        function validate() {
            $error=0;
            $errorMessages = [];

            if(isset($_POST['countryName'])){
                $countryName=$_POST['countryName'];
                if($countryName==""){
                    $error=1;
                    $errorMessages[] = 'Please enter country name';
                }
                else if(!preg_match("/^[A-Za-z]+$/", $countryName)){
                    $error=1;
                    $errorMessages[] = 'Enter only alphabets in country name';
                }
            }
            if(isset($_POST['countryCode'])){
                $countryCode=$_POST['countryCode'];
                if($countryCode==""){
                    $error=1;
                    $errorMessages[] = 'Please enter country code';
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
             if(isset($_POST['countryName'],$_POST['countryCode'])){
                $countryName=$_POST['countryName'];
                $countryCode=$_POST['countryCode'];
                
                $current_country_id = $_POST['current_country_id'];
                 
                //Insert new country entry  
                if($current_country_id == 0){
                    $addCountryQuery = "INSERT INTO countries (CountryName,PhoneCode,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('".$countryName."','".$countryCode."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                    
                    $addCountryResult = $db_handle->insertQuery($addCountryQuery);
                } 
                 
                //Update country for existed countries  
                else {
                    $editCountryQuery = "UPDATE countries SET CountryName = '".$countryName."', PhoneCode = '".$countryCode."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE CountryID = ".$current_country_id;
                    
                    $editCountryResult = $db_handle->updateQuery($editCountryQuery);
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
        
        function validateCountryName() {
            isValidCountryName = false;
            
            if ($("#countryName").val() == "" || $("#countryName").val() == null || $("#countryName").val().trim().length == 0) {
                $("#countryName").focusin();
                $("#countryName").addClass("borderHighlight");
                $("#countryNameVal").css("visibility", "visible");
                $("#countryNameVal").html("Please enter country name.");
                isValidCountryName = false;
            } else if (!reOnlyAlphabet.test($("#countryName").val())) {
                $("#countryName").focusin();
                $("#countryName").addClass("borderHighlight");
                $("#countryNameVal").css("visibility", "visible");
                $("#countryNameVal").html("Please enter only alphabets.");
                isValidCountryName = false;
            } else {
                $("#countryName").removeClass("borderHighlight");
                $("#countryNameVal").css("visibility", "hidden");
                isValidCountryName = true;
            }
            return isValidCountryName;
        }
        function validateCountryCode() {
            isValidCountryCode = false;
            
            if ($("#countryCode").val() == "" || $("#countryCode").val() == null || $("#countryCode").val().trim().length == 0) {
                $("#countryCode").focusin();
                $("#countryCode").addClass("borderHighlight");
                $("#countryCodeVal").css("visibility", "visible");
                $("#countryCodeVal").html("Please enter country code.");
                isValidCountryCode = false;
            } else {
                $("#countryCode").removeClass("borderHighlight");
                $("#countryCodeVal").css("visibility", "hidden");
                isValidCountryCode = true;
            }
            return isValidCountryCode;
        }
        function validateCountryForm() {
            isvalidCountryForm = false;

            isValidCountryName = validateCountryName();
            isValidCountryCode = validateCountryCode();
            
            if (isValidCountryName && isValidCountryCode) {
                isvalidCountryForm = true;
            }
            return isvalidCountryForm;
        }
    </script>
    
    </head>
    
    <body data-spy="scroll" class="overflow-auto sticky-header">
        <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->
        
        <!--Add Country Start--> 
        <section id="add_country" class="pad_100_for_pages"> 
        <div class="container">
            
            <div class="content-box-xs">
            
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateCountryForm();">
                <input type="hidden" name="current_country_id" value="<?php echo $current_country_id;?>" />
                <span class="common-heading-1 left_heading-1">Add Country</span>
               
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-common">
                            <label for="countryName">Country Name * </label>
                            <input type="text" class="form-control input_val" id="countryName" name="countryName" <?php if($current_country_id != 0 && !empty($admin_country_result[0]["CountryName"])){
                                echo " value ='".$admin_country_result[0]["CountryName"]."'";
                            }
                            ?> placeholder="Enter your country name" onblur="validateCountryName();">
                            <span id="countryNameVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="countryCode">Country Code * </label>
                            <input type="text" class="form-control input_val" id="countryCode" name="countryCode" <?php if($current_country_id != 0 && !empty($admin_country_result[0]["PhoneCode"]) && $admin_country_result[0]["PhoneCode"] > 0){
                                echo " value =".$admin_country_result[0]["PhoneCode"];
                            }
                            ?> placeholder="Enter your code" onblur="validateCountryCode();">
                            <span id="countryCodeVal" class="spnValMsg"></span>
                        </div>
                        <div class="small-btn general-btn">
                            <input type="submit" class="btn btn-outline-primary btn-purple" value="SUBMIT" name="submit"/>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </section>
        <!--Add Country End-->
        
        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

        </div>
    </body>
</html>