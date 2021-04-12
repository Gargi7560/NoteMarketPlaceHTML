<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $sellerDropDownQuery = "SELECT DISTINCT UserID,CONCAT(FirstName,' ',LastName) AS SellerName FROM users WHERE UserRoleID = ".$memberUserRoleID;
        
    $sellerDropDownResult = $db_handle->runQuery($sellerDropDownQuery);

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
        
        //Search rejected note grid
        function searchRejectedNote(page) {
            var search_RejectedNote = $("#searchBtnRejectedNote").val();
            var searchBy_Seller = $("#selectSeller").val();
            $.ajax({
                type: "GET",
                url: "rejected_note_search.php",
                data: {
                    search_rejected_note: search_RejectedNote,
                    page: page,
                    searchBySeller: searchBy_Seller,
                    orderBy: $('#hdnRejectedNoteSortOrder').val()
                },
                success: function(data) {
                    $("#published_note_table").html(data);
                    
                    if($('#hdnRejectedNoteSortColumn').val() == null || $('#hdnRejectedNoteSortColumn').val() == "") {
                        $('#hdnRejectedNoteSortOrder').val('ND.ModifiedDate DESC');
                        $('#hdnRejectedNoteSortDir').val('DESC');
                        $('#hdnRejectedNoteSortColumn').val('thEditedDate');
                    }
                    if($('#hdnRejectedNoteSortDir').val() == "DESC") {
                        $('#' + $('#hdnRejectedNoteSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnRejectedNoteSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of approve button in tabel
        function noteApprove(noteID) {
            $('#noteApprovePopup').modal('show');
            $('#hdnApproveNoteID').val(noteID);
        }
        
        //Update status on click of yes in confirmation popup
        function confirmApproveStatus() {
            $.ajax({
                type: "GET",
                url: "statusChange_ApproveNotes.php",
                data: {
                    noteID: $('#hdnApproveNoteID').val()
                },
                success: function (data) {
                    $('#noteApprovePopup').modal('hide');
                    window.location = data;
                    searchNoteUnderReview(1);
                }
            });
        }
        $(document).ready(function(){
            searchRejectedNote(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
    
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Rejected Notes Start-->
        <section id="rejected_notes" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Rejected Notes</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <div class="seller">
                               <p class="val_content">seller</p>
                                <select class="form-control dropdown-control" id="selectSeller" name="selectSeller" onchange="searchRejectedNote(1);">
                                    <option value="0">Select seller name</option>
                                    <?php 
                                        foreach($sellerDropDownResult as $value){
                                            echo "<option value='".$value['UserID']."'>".$value['SellerName']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <!--Search field for note search-->
                        <div class="col-md-9">
                            <div class="form-inline pull-right left_small_device seller_inline_padding">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchBtnRejectedNote" name="searchBtnRejectedNote" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchRejectedNote(1);">SEARCH</button>

                            </div>
                        </div>
                    </div>
                </div>
    
                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnRejectedNoteSortOrder" />
                <input type="hidden" id="hdnRejectedNoteSortDir" />
                <input type="hidden" id="hdnRejectedNoteSortColumn" />
                
                <!--Data for rejected note grid-->
                <div id="published_note_table"></div>
                
                <!--Notes Approve Popup-->
                <div class="modal fade" id="noteApprovePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="unpublish_popup">
                                    <div class="form-group form-common">
                                        <p class="val_content">If you approve the notes – System will publish the notes over portal. Please press yes to continue.</p>
                                    </div>
                                        
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmationApproveNote" onclick="confirmApproveStatus();" />
                                    <input type="hidden" id="hdnApproveNoteID" /> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--Rejected Notes End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
</div>

</body>

</html>