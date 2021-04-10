<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';
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
        
        //Search field in manage category grid
        function searchManageCategory(page) {
            var searchManageCategory_OnPortal = $("#searchManageCategoryBtn").val();
            $.ajax({
                type: "GET",
                url: "admin_category_search_page.php",
                data: {
                    search_admin_category: searchManageCategory_OnPortal,
                    page: page,
                    orderBy: $('#hdnCategorySortOrder').val()
                },
                success: function (data) {
                    $("#admin_category_search_table").html(data);
                    
                        if($('#hdnCategorySortColumn').val() == null || $('#hdnCategorySortColumn').val() == "") {
                        $('#hdnCategorySortOrder').val('NC.CreatedDate DESC');
                        $('#hdnCategorySortDir').val('DESC');
                        $('#hdnCategorySortColumn').val('thAddedDate');
                    }
                    if($('#hdnCategorySortDir').val() == "DESC") {
                        $('#' + $('#hdnCategorySortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnCategorySortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of delete button in tabel
        function deactivateCategory(categoryID) {
            $('#deactivateCategoryPopup').modal('show');
            $('#hdnCategoryID').val(categoryID);
        }
        
        //Update status on click of yes in confirmation popup
        function confirmDeactivateCategory() {
            $.ajax({
                type: "GET",
                url: "deactivate_category.php",
                data: {
                    categoryID: $('#hdnCategoryID').val()
                },
                success: function (data) {
                    $('#deactivateCategoryPopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            searchManageCategory(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    
    
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Manage Category Start-->
        <section id="manage_category" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Manage Category</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-4">
                                <a class="btn btn-outline-primary btn-purple my-2 my-sm-0" href="add_category.php">ADD CATEGORY</a>
                        </div>
                        
                        <!--Search field for searching notes -->
                        <div class="col-md-8">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchManageCategoryBtn" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchManageCategory(1);">SEARCH</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnCategorySortOrder" />
                <input type="hidden" id="hdnCategorySortDir" />
                <input type="hidden" id="hdnCategorySortColumn" />
                
                <!--Data for category grid-->
                <div id="admin_category_search_table"></div>
           
                <!--Deactivate Category Popup-->
                <div class="modal fade" id="deactivateCategoryPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">                                  
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to make this category inactive?</p>
                            
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmDeactivateAdminUser" onclick="confirmDeactivateCategory();">
                                    <input type="hidden" id="hdnCategoryID"> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
   
           
            </div>
        </section>
        <!--Manage Category End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
        
</body>

</html>