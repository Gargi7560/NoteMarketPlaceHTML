<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    $current_category_id = 0;

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Get category data from categories table from database
    if(!empty($_GET["category_id"]) && $_GET["category_id"] >0) {
        
        $current_category_id = $_GET["category_id"];
        
        $admin_category_query = "SELECT NoteCategoryID,CategoryName,Description FROM notecategories WHERE NoteCategoryID = ".$current_category_id;
        
        $admin_category_result = $db_handle->runQuery($admin_category_query);
    }

    //Server Side Validation
    if(isset($_REQUEST['submit'])){
        function validate() {
            $error=0;
            $errorMessages = [];

            if(isset($_POST['categoryName'])){
                $categoryName=$_POST['categoryName'];
                if($categoryName==""){
                    $error=1;
                    $errorMessages[] = 'Please enter category name';
                }
                else if(!preg_match("/^[A-Za-z]+$/", $categoryName)){
                    $error=1;
                    $errorMessages[] = 'Enter only alphabets in category name';
                }
            }
            if(isset($_POST['description'])){
                $description=$_POST['description'];
                if($description==""){
                    $error=1;
                    $errorMessages[] = 'Please enter description for category';
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
            
             if(isset($_POST['categoryName'],$_POST['description'])){
                $categoryName=$_POST['categoryName'];
                $description=$_POST['description'];
                
                $current_category_id = $_POST['current_category_id'];
                 
                //Insert new category entry  
                if($current_category_id == 0){
                    $addCategoryQuery = "INSERT INTO notecategories (CategoryName,Description,CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('".$categoryName."','".$description."',NOW(),".$_SESSION['user_id'].",NOW(),".$_SESSION['user_id'].",1) ";
                    
                    $addCategoryResult = $db_handle->insertQuery($addCategoryQuery);
                } 
                
                //Update category for existed categories   
                else {
                    $editCategoryQuery = "UPDATE notecategories SET CategoryName = '".$categoryName."', Description = '".$description."', ModifiedDate = NOW(), ModifiedBy = ".$_SESSION['user_id']." WHERE NoteCategoryID = ".$current_category_id;
                    
                    $editCategoryResult = $db_handle->updateQuery($editCategoryQuery);
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
        
        function validateCategoryName() {
            isValidCategoryName = false;
            
            if ($("#categoryName").val() == "" || $("#categoryName").val() == null || $("#categoryName").val().trim().length == 0) {
                $("#categoryName").focusin();
                $("#categoryName").addClass("borderHighlight");
                $("#categoryNameVal").css("visibility", "visible");
                $("#categoryNameVal").html("Please enter category name.");
                isValidCategoryName = false;
            } else if (!reOnlyAlphabet.test($("#categoryName").val())) {
                $("#categoryName").focusin();
                $("#categoryName").addClass("borderHighlight");
                $("#categoryNameVal").css("visibility", "visible");
                $("#categoryNameVal").html("Please enter only alphabets.");
                isValidCategoryName = false;
            } else {
                $("#categoryName").removeClass("borderHighlight");
                $("#categoryNameVal").css("visibility", "hidden");
                isValidCategoryName = true;
            }
            return isValidCategoryName;
        }
        function validateDescription() {
            isValidDescription = false;
            
            if ($("#description").val() == "" || $("#description").val() == null || $("#description").val().trim().length == 0) {
                $("#description").focusin();
                $("#description").addClass("borderHighlight");
                $("#descriptionVal").css("visibility", "visible");
                $("#descriptionVal").html("Please enter description for category.");
                isValidDescription = false;
            } else {
                $("#description").removeClass("borderHighlight");
                $("#descriptionVal").css("visibility", "hidden");
                isValidDescription = true;
            }
            return isValidDescription;
        }
        function validateCategoryForm() {
            isvalidCategoryForm = false;

            isValidCategoryName = validateCategoryName();
            isValidDescription = validateDescription();
            
            if (isValidCategoryName && isValidDescription) {
                isvalidCategoryForm = true;
            }
            return isvalidCategoryForm;
        }
    </script>
    
    </head>
    
    <body data-spy="scroll" class="overflow-auto sticky-header">
        <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->
        
        <!--Add Category Start--> 
        <section id="add_category" class="pad_100_for_pages"> 
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateCategoryForm();">
                <input type="hidden" name="current_category_id" value="<?php echo $current_category_id;?>" />
                <span class="common-heading-1 left_heading-1">Add Category</span>
            
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-common">
                            <label for="cat_name">Category Name * </label>
                            <input type="text" class="form-control input_val" id="categoryName" name="categoryName" <?php if($current_category_id != 0 && !empty($admin_category_result[0]["CategoryName"])){
                                echo " value ='".$admin_category_result[0]["CategoryName"]."'";
                            }
                            ?> placeholder="Enter your category name" onblur="validateCategoryName();">
                            <span id="categoryNameVal" class="spnValMsg"></span>
                        </div>
                        <div class="form-group form-common">
                            <label for="description">Description *</label>
                            <textarea class="form-control input_val" id="description" name="description" rows="6" placeholder="Enter your Description"  onblur="validateDescription();"><?php if($current_category_id != 0 && !empty($admin_category_result[0]["Description"])){
                                echo $admin_category_result[0]["Description"];
                            }
                            ?> </textarea>
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
        <!--Add Category End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
        
        </div>
    
    </body>
</html>