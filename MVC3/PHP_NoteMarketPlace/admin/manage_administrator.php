<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

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
        
        //Search field in manage administrator grid
        function searchAdminMember(page) {
            var searchAdminMember_OnPortal = $("#searchAdminMemberBtn").val();
            $.ajax({
                type: "GET",
                url: "administrator_member_search_page.php",
                data: {
                    search_admin_member: searchAdminMember_OnPortal,
                    page: page,
                    orderBy: $('#hdnManageAdminSortOrder').val()
                },
                success: function (data) {
                    $("#admin_member_search_table").html(data);
                    
                        if($('#hdnManageAdminSortColumn').val() == null || $('#hdnManageAdminSortColumn').val() == "") {
                        $('#hdnManageAdminSortOrder').val('US.CreatedDate DESC');
                        $('#hdnManageAdminSortDir').val('DESC');
                        $('#hdnManageAdminSortColumn').val('thJoiningDate');
                    }
                    if($('#hdnManageAdminSortDir').val() == "DESC") {
                        $('#' + $('#hdnManageAdminSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnManageAdminSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of delete button in tabel
        function deactivateAdminUser(userID) {
            $('#deactivateAdminUserPopup').modal('show');
            $('#hdnAdminUserID').val(userID);
        }
        
        //Update status on click of yes in confirmation popup
        function confirmDeactivateAdminUser() {
            $.ajax({
                type: "GET",
                url: "deactivate_member.php",
                data: {
                    userID: $('#hdnAdminUserID').val()
                },
                success: function (data) {
                    $('#deactivateAdminUserPopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            searchAdminMember(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Manage Administrator Start-->
        <section id="manage_administrator" class="pad_120_for_pages">
            <div class="container">

                <span class="common-heading-1 left_heading-1">Manage Administrator</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="btn btn-outline-primary btn-purple my-2 my-sm-0" href="add_administrator.php">ADD ADMINISTRATOR</a>
                        </div>
                        
                        <!--Search field for searching notes -->
                        <div class="col-md-8">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchAdminMemberBtn" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="submit" onclick="searchAdminMember(1);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnManageAdminSortOrder" />
                <input type="hidden" id="hdnManageAdminSortDir" />
                <input type="hidden" id="hdnManageAdminSortColumn" />
                
                <!--Data for administrator grid-->
                <div id="admin_member_search_table"></div>
                
                <!--Deactivate Admin User Popup-->
                <div class="modal fade" id="deactivateAdminUserPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">                                  
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to make this administrator inactive?</p>
                            
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmDeactivateAdminUser" onclick="confirmDeactivateAdminUser();">
                                    <input type="hidden" id="hdnAdminUserID"> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--Manage Administrator Ends-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
        
</body>

</html>