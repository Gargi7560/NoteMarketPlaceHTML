<?php
    
    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

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
    <link rel="shortcut icon" href="images/login/favicon.ico">
    
    <!--JQuery-->
    <script src="js/jquery.min.js"></script>
        
    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>
    
    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    
    <!--Rating CSS-->
    <link rel="stylesheet" href="css/jsRating/jsRapStar.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
    
    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">
    
    <!--Rating JS-->
    <script src="js/jsRating/jsRapStar.js"></script>
    
    <script type="text/javascript">
        
    function searchNoteDownload(page) {
        var searchNote_Download = $("#searchDownload").val();
        $.ajax({
            type: "GET",
            url: "download_search_note.php",
            data: {
                search_download_note: searchNote_Download,
                page: page,
                orderBy: $('#hdnDownloadSortOrder').val()
            },
            success: function (data) {
                $("#download_Notes").html(data);
                
                if($('#hdnDownloadSortColumn').val() == null || $('#hdnDownloadSortColumn').val() == "") {
                    $('#hdnDownloadSortOrder').val('DN.AttachmentDownloadedDate DESC');
                    $('#hdnDownloadSortDir').val('DESC');
                    $('#hdnDownloadSortColumn').val('thDownloadDt');
                }
                if($('#hdnDownloadSortDir').val() == "DESC") {
                    $('#' + $('#hdnDownloadSortColumn').val()).addClass('descending');
                } else {
                    $('#' + $('#hdnDownloadSortColumn').val()).addClass('ascending');
                }
            }
        });
    }
    function noteReview(noteID) {
        $('#reviewPopup').modal('show');
        $('#hdnNoteID').val(noteID);
        $('#starRate').jsRapStar({
            step: false,
            value: 0,
            length: 5,
            starHeight: 50,
            colorFront: '#f0c420',
            onClick: function(score) {
                this.StarF.css({
                    color: '#f0c420'
                });
                $('#hdbStarRatingValue').val(score);
            },
            onMousemove: function(score) {
                $(this).attr('title', 'Rate ' + score);
            }
        });
    }
    function submitNoteReview() {
        
        starRating = parseFloat($('#hdbStarRatingValue').val()).toFixed(2);
        
        $.ajax({
            type: "POST",
            url: "note_review.php",
            data: {
                noteID: $('#hdnNoteID').val(),
                comment: $('#comment').val(),
                starRating: starRating
            },
            success: function (data) {
                window.location = data;
            }
        });
    }
    function inappropriateNote(noteID,title) {
        $('#inappropriateNotePopup').modal('show');
        $('#hdnReportNoteID').val(noteID);
        $('#titleForNotes').html(title);
    }
    function reportAnIssue(){
        $('#inappropriateNotePopup').modal('hide');
        $('#confirmInappropriateNotePopup').modal('show');
    }
    function confirmReportAnIssue() {
        $.ajax({
            type: "POST",
            url: "report_an_issue.php",
            data: {
                noteID: $('#hdnReportNoteID').val(),
                remarks: $('#remarks').val()
            },
            success: function (data) {
                $('#confirmInappropriateNotePopup').modal('hide');
            }
        });
    }
    $(document).ready(function(){
        searchNoteDownload(1);
    });
       
    </script>

</head>

<body data-spy="scroll" class="overflow-auto sticky-header">

    <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->
        
        <!--My Downloads Start-->
          <section id="my_downloads" class="pad_100_for_pages">
           <div class="container">
               <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">My Downloads</span>
                        </div>
                        <div class="col-md-7">
                            <form class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchDownload" name="searchDownload" placeholder="Search notes here" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="submit" onclick="searchNoteDownload(1);">SEARCH</button>
                            </form>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdnDownloadSortOrder" />
                <input type="hidden" id="hdnDownloadSortDir" />
                <input type="hidden" id="hdnDownloadSortColumn" />
                <div id="download_Notes"></div>

                <!--Add Review Popup-->
                <div class="modal fade" id="reviewPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">

                                    <span class="common-heading-1 left_heading-1">Add Review</span>
                                    <div id="starRate"></div>
                                    <input type="hidden" id="hdbStarRatingValue">
                                    <input type="hidden" id="hdnNoteID">                                   
                                    <div class="form-group form-common">
                                        <label for="comment">comments *</label>
                                        <textarea class="form-control input_val" id="comment" rows="3" placeholder="Comment..." required></textarea>
                                    </div>
                                    <div class="small-btn general-btn">
                                        <input type="button" class="btn btn-outline-primary btn-purple" value="SUBMIT" onclick="submitNoteReview();" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                
                <!--Inappropriate Note Popup-->
                <div class="modal fade" id="inappropriateNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">
                                    <span class="common-heading-1 left_heading-1" id="titleForNotes"></span>                               <div class="form-group form-common">
                                        <label for="remarks">Remarks *</label>
                                        <textarea class="form-control input_val" id="remarks" rows="3" placeholder="Remarks..." required></textarea>
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="Report an issue" id="reportIssueForNote" onclick="reportAnIssue();">
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="CANCEL" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Confirm Inappropriate Note Popup-->
                <div class="modal fade" id="confirmInappropriateNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">                                  
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to mark this report as spam, you cannot update it later?</p>
                            
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="reportIssueForNote" onclick="confirmReportAnIssue();">
                                    <input type="hidden" id="hdnReportNoteID"> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
           </div>
       </section>
        <!--My Downloads Start-->
        
        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->
    </div>
</body>

</html>