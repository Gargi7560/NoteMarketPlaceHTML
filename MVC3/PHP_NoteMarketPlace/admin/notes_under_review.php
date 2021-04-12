<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $userID = (isset($_GET['user_id']) && !empty($_GET['user_id']) && $_GET['user_id'] > 0) ? $_GET['user_id'] : 0;

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
        
        //Search note under review grid
        function searchNoteUnderReview(page) {
            var searchNote_UnderReview = $("#searcbtnhNoteUnderReview").val();
            var searchBy_Seller = $("#selectSeller").val();
            $.ajax({
                type: "GET",
                url: "notes_under_review_search.php",
                data: {
                    search_under_review_note: searchNote_UnderReview,
                    page: page,
                    searchBySeller: searchBy_Seller,
                    orderBy: $('#hdnNoteUnderReviewSortOrder').val()
                },
                success: function (data) {
                    $("#notes_under_review_table").html(data);
                    
                    if($('#hdnNoteUnderReviewSortColumn').val() == null || $('#hdnNoteUnderReviewSortColumn').val() == "") {
                    $('#hdnNoteUnderReviewSortOrder').val('ND.CreatedDate DESC');
                    $('#hdnNoteUnderReviewSortDir').val('DESC');
                    $('#hdnNoteUnderReviewSortColumn').val('thDateAdded');
                }
                if($('#hdnNoteUnderReviewSortDir').val() == "DESC") {
                    $('#' + $('#hdnNoteUnderReviewSortColumn').val()).addClass('descending');
                } else {
                    $('#' + $('#hdnNoteUnderReviewSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of inreview button in tabel
        function noteInReview(noteID) {
            $('#noteInReviewPopup').modal('show');
            $('#hdnInReviewNoteID').val(noteID);
        }
        
        //Shows confirmation popup for inreview note
        function confirmInReviewStatus() {
            $.ajax({
                type: "GET",
                url: "statusChange_InReviewNotes.php",
                data: {
                    noteID: $('#hdnInReviewNoteID').val()
                },
                success: function (data) {
                    $('#noteInReviewPopup').modal('hide');
                    searchNoteUnderReview(1);
                }
            });
        }
        
        //Shows popup on click of approve button in tabel
        function noteApprove(noteID) {
            $('#noteApprovePopup').modal('show');
            $('#hdnApproveNoteID').val(noteID);
        }
        
        //Shows confirmation popup for approve note
        function confirmApproveStatus() {
            $.ajax({
                type: "GET",
                url: "statusChange_ApproveNotes.php",
                data: {
                    noteID: $('#hdnApproveNoteID').val()
                },
                success: function (data) {
                    $('#noteApprovePopup').modal('hide');
                    searchNoteUnderReview(1);
                }
            });
        }
        
        //Shows popup on click of reject button in tabel
        function rejectNote(noteID,title) {
            $('#rejectNotePopup').modal('show');
            $('#hdnRejectNoteID').val(noteID);
            $('#titleForNotes').html(title);
        }
        
        //Shows confirmation popup for reject note
        function remarkForRejectNotes(){
            $('#rejectNotePopup').modal('hide');
            $('#confirmRejectNotePopup').modal('show');
        }
        
        //Shows confirmation popup for reject note
        function confirmRemarkForRejectNotes() {
            $.ajax({
                type: "POST",
                url: "statusChange_RejectNotes.php",
                data: {
                    noteID: $('#hdnRejectNoteID').val(),
                    remarks: $('#remarks').val()
                },
                success: function (data) {
                    $('#confirmRejectNotePopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            $('#selectSeller').val(<?php echo $userID; ?>);
            searchNoteUnderReview(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
    
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Notes Under Review Start-->
        <section id="notes_under_review" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Notes Under Review</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <div class="seller">
                               <p class="val_content">seller</p>
                                <select class="form-control dropdown-control" id="selectSeller" name="selectSeller" onchange="searchNoteUnderReview(1);">
                                   <option value="0">Select seller name</option>
                                    <?php 
                                        foreach($sellerDropDownResult as $value){
                                            echo "<option value='".$value['UserID']."'>".$value['SellerName']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!--Search field for searching notes -->
                        <div class="col-md-9">
                            <div class="form-inline pull-right left_small_device seller_inline_padding">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searcbtnhNoteUnderReview" name="searcbtnhNoteUnderReview" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchNoteUnderReview(1);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnNoteUnderReviewSortOrder" />
                <input type="hidden" id="hdnNoteUnderReviewSortDir" />
                <input type="hidden" id="hdnNoteUnderReviewSortColumn" />
                
                <!--Data for admin dashboard grid-->
                <div id="notes_under_review_table"></div>
                
                <!--Notes InReview Popup-->
                <div class="modal fade" id="noteInReviewPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="unpublish_popup">
                                    <div class="form-group form-common">
                                        <p class="val_content">Via marking the note In Review – System will let user know that review process has been initiated. Please press yes to continue.</p>
                                    </div>
                                        
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmationInReviewNote" onclick="confirmInReviewStatus();" />
                                    <input type="hidden" id="hdnInReviewNoteID" /> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
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
                                        
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmationInReviewNote" onclick="confirmApproveStatus();" />
                                    <input type="hidden" id="hdnApproveNoteID" /> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Reject Note Popup-->
                <div class="modal fade" id="rejectNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">
                                    <span class="common-heading-1 left_heading-1" id="titleForNotes"></span>                               <div class="form-group form-common row_fix_bottom">
                                        <label for="remarks">Remarks *</label>
                                        <textarea class="form-control input_val" id="remarks" rows="3" placeholder="Remarks..." required></textarea>
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-review btn-red" data-toggle="modal" value="Reject" id="reportIssueForNote" onclick="remarkForRejectNotes();">
                                    <input type="button" class="btn btn-outline-primary btn-review btn-grey" data-dismiss="modal" value="CANCEL" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Confirm Reject Note Popup-->
                <div class="modal fade" id="confirmRejectNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="unpublish_popup">
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to reject seller request?</p>
                                    </div>
                                        
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmationRejectNote" onclick="confirmRemarkForRejectNotes();" />
                                    <input type="hidden" id="hdnRejectNoteID" /> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--Notes Under Review End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
</div>
</body>

</html>