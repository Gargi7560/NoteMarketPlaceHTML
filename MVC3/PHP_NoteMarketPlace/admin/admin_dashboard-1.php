<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    for ($i = 0; $i <= 5; $i++) {
      // Store the months in an array
       $months[] = date("M-Y", strtotime( date( 'Y-m-01' )." -$i months"));
    }

    //Number of notes in review for publish
    $numInReviewQuery = "SELECT COUNT(NoteDetailID) AS numInReview FROM notedetails WHERE StatusID IN (".$submittedForReviewID.", ".$inReviewID.") ";

    $numInReviewResult = $db_handle->runQuery($numInReviewQuery);

    //Separate date for get last 7 days data
    $getDate = date('Y-m-d', strtotime('-7 days'));
    $separateDate = explode('-', $getDate);

    //Number of new notes downloaded in last 7 days
    $newDownloadedNotesQuery = "SELECT COUNT(DownloadNoteID) AS newDownload FROM downloadnotes WHERE ( DAY(AttachmentDownloadedDate) >= ".$separateDate[2]." AND MONTH(AttachmentDownloadedDate) >= ".$separateDate[1]." AND  YEAR(AttachmentDownloadedDate) >= ".$separateDate[0]." ) ";

    $newDownloadedNotesResult = $db_handle->runQuery($newDownloadedNotesQuery);

    //Number of new member registration in last 7 days
    $newRegistrationQuery = "SELECT COUNT(UserID) AS newRegistrer FROM users WHERE ( DAY(CreatedDate) >= ".$separateDate[2]." AND MONTH(CreatedDate) >= ".$separateDate[1]." AND  YEAR(CreatedDate) >= ".$separateDate[0]." ) ";

    $newRegistrationResult = $db_handle->runQuery($newRegistrationQuery);

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
        
        //Search admin dashboard grid
        function searchAdminDashboard(page) {
            var searchNote_AdminDashboard = $("#searchAdminDashboard").val();
            var search_Month = $("#selectMonth").val();
            $.ajax({
                type: "GET",
                url: "admin_dashboard_search_note.php",
                data: {
                    search_admin_dashboard_note: searchNote_AdminDashboard,
                    page: page,
                    searchMonth: search_Month,
                    orderBy: $('#hdnAdminDashboardSortOrder').val()
                },
                success: function(data) {
                    $("#admin_dashboard_notes").html(data);
                    
                    if($('#hdnAdminDashboardSortColumn').val() == null || $('#hdnAdminDashboardSortColumn').val() == "") {
                    $('#hdnAdminDashboardSortOrder').val('PublishedDate DESC');
                    $('#hdnAdminDashboardSortDir').val('DESC');
                    $('#hdnAdminDashboardSortColumn').val('thDownloadDt');
                }
                if($('#hdnAdminDashboardSortDir').val() == "DESC") {
                    $('#' + $('#hdnAdminDashboardSortColumn').val()).addClass('descending');
                } else {
                    $('#' + $('#hdnAdminDashboardSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of unpublish button in tabel
        function unPublishNote(noteID,title) {
            $('#unPublishNotePopup').modal('show');
            $('#hdnUnpublishNoteID').val(noteID);
            $('#titleForNotes').html(title);
        }
        
        //Shows confirmation popup for unpublish note
        function remarkForUnpublish() {
            $('#unPublishNotePopup').modal('hide');
            $('#ConfirmUblishNotePopup').modal('show');
        }
        
        //Update status on click of yes in confirmation popup
        function confirmUnpublishNote() {
            $.ajax({
                type: "POST",
                url: "remark_for_unpublish.php",
                data: {
                    noteID: $('#hdnUnpublishNoteID').val(),
                    remarks: $('#remarks').val()
                },
                success: function (data) {
                    $('#ConfirmUblishNotePopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            searchAdminDashboard(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    
    <!--Header Start-->
    <?php include 'admin_header.php'?>
    <!--Header End-->

    <!--Dashboard-->
    <section id="admin_dashboard" class="pad_120_for_pages">
        <div class="container">
                <span class="common-heading-1 left_heading-1">Dashboard</span>
            
            <!--Dashboard Statistics-->
            <div class="content-box-xs">
               <div class="row">
                   <div class="col-md-4 row_fix_bottom_30">
                      <div class="dashboard_border verti_center_padding text-center fix_height_dashboard">
                    <a href="notes_under_review.php"><p class="small-heading-1 center_heading-2"><?php echo  $numInReviewResult[0]['numInReview']; ?></p>
                        <p class="val_content">Numbers of Notes in Review for Publish</p></a>
                        </div>
                   </div>
                   <div class="col-md-4 row_fix_bottom_30">
                      <div class="dashboard_border verti_center_padding text-center fix_height_dashboard">
                    <a href="downloaded_notes.php"><p class="small-heading-1 center_heading-2"><?php echo  $newDownloadedNotesResult[0]['newDownload']; ?></p>
                        <span class="val_content">Numbers of New Notes Downloaded</span>
                        <p class="val_content">(Last 7 days)</p></a>
                       </div>
                   </div>
                   <div class="col-md-4 row_fix_bottom_30">
                      <div class="dashboard_border verti_center_padding text-center fix_height_dashboard"><a href="members_page.php">
                       <p class="small-heading-1 center_heading-2"><?php echo  $newRegistrationResult[0]['newRegistrer']; ?></p>
                        <span class="val_content">Numbers of New Registrations</span>
                        <p class="val_content">(Last 7 days)</p></a>
                       </div>
                   </div>
               </div>
            </div>

            <div class="small_pad_20">
                <div class="row">
                    <div class="col-md-4">
                        <span class="small-heading left_heading-1">Published Notes</span>
                    </div>
                    <div class="col-md-8">
                        <div class="form-inline pull-right left_small_device">
                           
                            <!--Search field for searching notes -->
                            <input class="form-control mr-sm-2 input_val search_icon small_device" type="search" id="searchAdminDashboard" name="searchAdminDashboard" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="button" onclick="searchAdminDashboard(1);">SEARCH</button>
                            
                            <!--Search notes according to last 6 months(drop-down)-->
                            <select class="form-control dropdown-control ml-sm-2 input_val small_device" id="selectMonth" name="selectMonth" onchange="searchAdminDashboard(1);">
                              <option value="0">Select Month</option>
                               <?php foreach($months as $value){
                                    echo "<option value='".$value."'>".$value."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Hidden Field for ascending and descending-->
            <input type="hidden" id="hdnAdminDashboardSortOrder" />
            <input type="hidden" id="hdnAdminDashboardSortDir" />
            <input type="hidden" id="hdnAdminDashboardSortColumn" />
            
            <!--Data for admin dashboard grid-->
            <div id="admin_dashboard_notes"></div>
            
            <!--Unpublish Note Popup-->
            <div class="modal fade" id="unPublishNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                            </button>
                            <div class="unpublish_popup">
                                <span class="common-heading-1 left_heading-1" id="titleForNotes"></span>
                                <div class="form-group form-common common_popup">
                                    <label for="remarks">Remarks *</label>
                                    <textarea class="form-control input_val" id="remarks" rows="3" placeholder="Remarks..." required></textarea>
                                </div>
                                <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="UNPUBLISH" id="remarkUnpublish" onclick="remarkForUnpublish();">
                                <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="CANCEL" class="close-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Confirm Unpublish Note Popup-->
            <div class="modal fade" id="ConfirmUblishNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                            </button>
                            <div class="unpublish_popup">
                                <div class="form-group form-common">
                                    <p class="val_content">Are you sure you want to Unpublish this note?</p>
                                </div>
                                <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmationUnpublishNote" onclick="confirmUnpublishNote();">
                                <input type="hidden" id="hdnUnpublishNoteID">
                                <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Footer Start-->
    <?php include 'admin_footer.php' ?>
    <!--Footer End-->

</body>

</html>