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
        
        //Search member page grid
        function searchMemberOnPortal(page) {
            var searchMember_OnPortal = $("#searchMemberBtn").val();
            $.ajax({
                type: "GET",
                url: "member_search_page.php",
                data: {
                    search_member: searchMember_OnPortal,
                    page: page,
                    orderBy: $('#hdnMemberPageSortOrder').val()
                },
                success: function (data) {
                    $("#member_search_table").html(data);
                 
                    if($('#hdnMemberPageSortColumn').val() == null || $('#hdnMemberPageSortColumn').val() == "") {
                        $('#hdnMemberPageSortOrder').val('CreatedDate DESC');
                        $('#hdnMemberPageSortDir').val('DESC');
                        $('#hdnMemberPageSortColumn').val('thJoiningDate');
                    }
                    if($('#hdnMemberPageSortDir').val() == "DESC") {
                        $('#' + $('#hdnMemberPageSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnMemberPageSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of deactivate button in tabel
        function deactivateMember(userID) {
            $('#deactivateMemberPopup').modal('show');
            $('#hdnMemberUserID').val(userID);
        }
        
        //Shows confirmation popup for deactivate note
        function confirmDeactivateMember() {
            $.ajax({
                type: "GET",
                url: "deactivate_member.php",
                data: {
                    userID: $('#hdnMemberUserID').val()
                },
                success: function (data) {
                    $('#deactivateMemberPopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            searchMemberOnPortal(1);
        });
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
    
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Member Page Start-->
        <section id="members_page" class="pad_120_for_pages">
            <div class="container">

                <div class="small_pad_20">
                    <div class="row">
                       <div class="col-md-4">
                            <div class="home-heading">
                                <span class="common-heading-1 left_heading-1">Members</span>
                            </div>
                        </div>
                        
                        <!--Search field for searching notes -->
                        <div class="col-md-8">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchMemberBtn" name="searchMemberBtn" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchMemberOnPortal(1);">SEARCH</button>

                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnMemberPageSortOrder" />
                <input type="hidden" id="hdnMemberPageSortDir" />
                <input type="hidden" id="hdnMemberPageSortColumn" />
                
                <!--Data for admin dashboard grid-->
                <div id="member_search_table"></div>
                
                <!--Deactivate Member Popup-->
                <div class="modal fade" id="deactivateMemberPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">                                  
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to make this member inactive?</p>
                            
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmDeactivateMember" onclick="confirmDeactivateMember();">
                                    <input type="hidden" id="hdnMemberUserID"> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--Member Page End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

</div>

</body>

</html>