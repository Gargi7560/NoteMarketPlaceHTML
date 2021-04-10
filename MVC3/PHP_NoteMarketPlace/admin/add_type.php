<?php
    session_start();

    $current_type_id = 0;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    //Get type data from notetypes table from database
    if(!empty($_GET["type_id"]) && $_GET["type_id"] >0) {
        
        $current_type_id = $_GET["type_id"];
        
        $admin_type_query = "SELECT NoteTypeID,TypeName,Description FROM notetypes WHERE NoteTypeID = ".$current_type_id;
        
        $admin_type_result = $db_handle->runQuery($admin_type_query);
    }

    //Server side validation
    if(isset($_REQUEST['submit'])){
        function validate() {
            $error=0;
            $errorMessages = [];

            if(isset($_POST['typeName'])){
                $typeName=$_POST['typeName'];
                if($typeName==""){
                    $error=1;
                    $errorMessages[] = 'Please enter type';
                }
                else if(!preg_match("/^[A-Za-z]+$/", $typeName)){
                    $error=1;
                    $errorMessages[] = 'Enter only alphabets in type';
                }
            }
            if(isset($_POST['description'])){
                $description=$_POST['description'];
                if($description==""){
                    $error=1;
                    $errorMessages[] = 'Please enter description';
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
             if(isset($_POST['typeName'],$_POST['description'])){
                $typeName=$_POST['typeName'];
                $description=$_POST['description'];
                
                $current_type_id = $_POST['current_type_id'];
                
                 //Insert new type entry  
                if($current_type_id == 0){
                    $addTypeQuery = "INSERT INTO notetypes (TypeName,Description,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('".$typeName."','".$description."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) ";
                    
                    $addTypeResult = $db_handle->insertQuery($addTypeQuery);
                } 
                //Update type for existed types  
                else {
                    $editTypeQuery = "UPDATE notetypes SET TypeName = '".$typeName."', Description = '".$description."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteTypeID = ".$current_type_id;   
                    
                    $editTypeResult = $db_handle->updateQuery($editTypeQuery);
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
        
        function validateTypeName() {
            isValidTypeName = false;
            
            if ($("#typeName").val() == "" || $("#typeName").val() == null || $("#typeName").val().trim().length == 0) {
                $("#typeName").focusin();
                $("#typeName").addClass("borderHighlight");
                $("#typeNameVal").css("visibility", "visible");
                $("#typeNameVal").html("Please enter type.");
                isValidTypeName = false;
            } else if (!reOnlyAlphabet.test($("#typeName").val())) {
                $("#typeName").focusin();
                $("#typeName").addClass("borderHighlight");
                $("#typeNameVal").css("visibility", "visible");
                $("#typeNameVal").html("Please enter only alphabets.");
                isValidTypeName = false;
            } else {
                $("#typeName").removeClass("borderHighlight");
                $("#typeNameVal").css("visibility", "hidden");
                isValidTypeName = true;
            }
            return isValidTypeName;
        }
        function validateTypeDescription() {
            isValidTypeDescription = false;
            
            if ($("#description").val() == "" || $("#description").val() == null || $("#description").val().trim().length == 0) {
                $("#description").focusin();
                $("#description").addClass("borderHighlight");
                $("#descriptionVal").css("visibility", "visible");
                $("#descriptionVal").html("Please enter description for type field.");
                isValidTypeDescription = false;
            } else {
                $("#description").removeClass("borderHighlight");
                $("#descriptionVal").css("visibility", "hidden");
                isValidTypeDescription = true;
            }
            return isValidTypeDescription;
        }
        function validateTypeForm() {
            isvalidTypeForm = false;

            isValidTypeName = validateTypeName();
            isValidTypeDescription = validateTypeDescription();
            
            if (isValidTypeName && isValidTypeDescription) {
                isvalidTypeForm = true;
            }
            return isvalidTypeForm;
        }
    </script>
    
    </head>
    
    <body data-spy="scroll" class="overflow-auto sticky-header">
        <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->
        
        <!--Add Type Start--> 
        <section id="add_type" class="pad_100_for_pages"> 
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateTypeForm();">
                   <input type="hidden" name="current_type_id" value="<?php echo $current_type_id;?>" />
                    <span class="common-heading-1 left_heading-1">Add Type</span>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-common">
                            <label for="typeName">Type * </label>
                            <input type="text" class="form-control input_val" id="typeName" name="typeName" <?php if($current_type_id != 0 && !empty($admin_type_result[0]["TypeName"])){
                                echo " value ='".$admin_type_result[0]["TypeName"]."'";
                            }
                            ?> placeholder="Enter type" onblur="validateTypeName();">
                            <span id="typeNameVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common" id="big_text_area">
                            <label for="description">Description *</label>
                            <textarea class="form-control input_val" id="description" name="description" rows="5" placeholder="Enter your Description" onblur="validateTypeDescription();"> <?php if($current_type_id != 0 && !empty($admin_type_result[0]["Description"])){
                                echo $admin_type_result[0]["Description"];
                            }
                            ?></textarea>
                            <span id="descriptionVal" class="spnValMsg"></span>
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
        <!--Add Type End-->
        
        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
        
        </div>
    </body>
</html>