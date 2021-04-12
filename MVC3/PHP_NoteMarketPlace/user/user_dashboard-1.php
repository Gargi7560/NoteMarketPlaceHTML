<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $soldNoteCtQuery = "SELECT COUNT(DownloadNoteID) AS soldNotes FROM downloadnotes WHERE IsSellerHasAllowedDownload = 1 AND SellerID = ".$_SESSION['user_id'];

    $soldNoteCtResult = $db_handle->runQuery($soldNoteCtQuery);

    $downloadNoteCtQuery = "SELECT COUNT(DownloadNoteID) AS downloadNotes FROM downloadnotes WHERE IsAttachmentDownloaded = 1 AND DownloaderID = ".$_SESSION['user_id'];

    $downloadNoteCtResult = $db_handle->runQuery($downloadNoteCtQuery);

    $buyerCtQuery = "SELECT COUNT(DownloadNoteID) AS buyerNote FROM downloadnotes WHERE IsPaid = 1 AND IsSellerHasAllowedDownload = 0 AND SellerID = ".$_SESSION['user_id'];

    $buyerCtResult = $db_handle->runQuery($buyerCtQuery);

    $rejectedNoteCtQuery = "SELECT COUNT(NoteDetailID) AS rejectedNote FROM notedetails WHERE StatusID = ".$rejectedID." AND SellerID = ".$_SESSION['user_id'];

    $rejectedNoteCtResult = $db_handle->runQuery($rejectedNoteCtQuery);

    $earnedMoneyQuery = "SELECT SUM(PurchasedPrice) AS earnMoney FROM downloadnotes WHERE IsSellerHasAllowedDownload = 1 AND SellerID = ".$_SESSION['user_id'];

    $earnedMoneyResult = $db_handle->runQuery($earnedMoneyQuery);

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

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">
    
    <script type="text/javascript">
    function searchNoteForDashboard(page,status) //status> 1:inprogress, 2:published
    {
        var searchNote_Dashboard = (status == 1) ? $("#search_note1").val() : $("#search_note2").val();
        var orderBy_Dashboard = (status == 1) ? $("#hdnProgressSortOrder").val() : $("#hdnPublishedSortOrder").val();
        
        $.ajax({
            type: "GET",
            url: "dashboard_search_note.php",
            data: {
                search_note: searchNote_Dashboard,
                page: page,
                status: status,
                orderBy: orderBy_Dashboard
            },
            success: function (data) {
                if(status == 1){
                $("#inProgress_Notes").html(data);
                      
                if($('#hdnProgressSortColumn').val() == null || $('#hdnProgressSortColumn').val() == "") {
                    $('#hdnProgressSortOrder').val('ND.CreatedDate DESC');
                    $('#hdnProgressSortDir').val('DESC');
                    $('#hdnProgressSortColumn').val('thAddedDate');
                }
                if($('#hdnProgressSortDir').val() == "DESC") {
                    $('#dbTbl_'+status+' #' + $('#hdnProgressSortColumn').val()).addClass('descending');
                } else {
                    $('#dbTbl_'+status+' #' + $('#hdnProgressSortColumn').val()).addClass('ascending');
                }
                } else {
                   $("#published_Notes").html(data); 
                    
                    if($('#hdnPublishedSortColumn').val() == null || $('#hdnPublishedSortColumn').val() == "") {
                    $('#hdnPublishedSortOrder').val('ND.CreatedDate DESC');
                    $('#hdnPublishedSortDir').val('DESC');
                    $('#hdnPublishedSortColumn').val('thAddedDate');
                }
                if($('#hdnPublishedSortDir').val() == "DESC") {
                    $('#dbTbl_'+status+' #' + $('#hdnPublishedSortColumn').val()).addClass('descending');
                } else {
                    $('#dbTbl_'+status+' #' + $('#hdnPublishedSortColumn').val()).addClass('ascending');
                }
                }            
            }
        });
    }
        
    function deleteNote(noteID) //status> 1:inprogress, 2:published
    {
        $.ajax({
            type: "GET",
            url: "delete_Note.php",
            data: {
                noteID: noteID
            },
            success: function (data) {
                alert("Note deleted successfully");
                searchNoteForDashboard(1,1);        
            }
        });
    }
        
    $(document).ready(function(){
        searchNoteForDashboard(1,1);
        searchNoteForDashboard(1,2);
    });
        
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    
    <!--Header Start-->
    <?php include 'sticky_header.php';?>
    <!--Header End-->
    
    <!--Section Dashboard Start-->
    <section id="sec_dashboard" class="pad_100_for_pages">
        <div class="container">
            <div class="content-box-sm">
                <div class="row">
                    <div class="col-md-5">
                        <span class="common-heading-1 left_heading-1">Dashboard</span>
                    </div>
                    <div class="col-md-7">
                        <div class="small-btn pull-right left_small_device">
                            <!--<form class="form-inline">-->
                                <a href="add_notes.php" class="btn btn-outline-primary btn-purple my-2 my-sm-0">ADD NOTES</a>
                            <!--</form>-->
                        </div>
                    </div>
                </div>

                <div class="content-box-xs">
                    <div class="row">
                        <div class="col-lg-7 text-center row_fix_bottom">
                           <div class="dashboard_border">
                           <div class="row">
                                <div class="col-md-4 verti_center_padding">
                                    <img src="images/Dashboard/my-earning.png" alt="earning" class="pull-left">
                                    <p class="small-heading-1 center_heading-2">My Earning</p>
                                </div>
                                <div class="col-md-4 dash_inner_border verti_center_padding">
                                    <div class="dash_inner_border_top">
                                       <a href="my_sold_notes.php">
                                        <p class="small-heading-1 center_heading-2 verti_center"><?php     
                                        echo $soldNoteCtResult[0]['soldNotes']; ?></p>
                                        <p class="val_content">Number of Notes Sold</p></a>
                                    </div>
                                </div>
                                <div class="col-md-4 verti_center_padding">
                                   <a href="my_sold_notes.php">
                                    <p class="small-heading-1 center_heading-2">$<?php     
                                        echo $earnedMoneyResult[0]['earnMoney']; ?></p>
                                    <p class="val_content">Money Earned</p></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-5 text-center">
                           <div class="row">
                            <div class="col-md-4 row_fix_bottom_30">
                               <div class="dashboard_border verti_center_padding">
                               <a href="my_downloads.php">
                                <p class="small-heading-1 center_heading-2"><?php     
                                    echo $downloadNoteCtResult[0]['downloadNotes']; ?></p>
                                <p class="val_content">My Downloads</p></a>
                                </div>
                            </div>    
                            <div class="col-md-4 row_fix_bottom_30">
                               <div class="dashboard_border verti_center_padding">
                               <a href="my_rejected_notes.php">
                                <p class="small-heading-1 center_heading-2"><?php     
                                        echo $rejectedNoteCtResult[0]['rejectedNote']; ?></p>
                                <p class="val_content">My Rejected Notes</p></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                               <div class="dashboard_border verti_center_padding">
                               <a href="buyer_req.php">
                                <p class="small-heading-1 center_heading-2"><?php     
                                    echo $buyerCtResult[0]['buyerNote']; ?></p>
                                <p class="val_content">Buyer Requests</p></a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">In Progress Notes</span>
                        </div>
                        <div class="col-md-7">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="search_note1" name="search_note1" placeholder="Search notes here" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" name="search1" type="button" onclick="searchNoteForDashboard(1,1);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdnProgressSortOrder" />
                <input type="hidden" id="hdnProgressSortDir" />
                <input type="hidden" id="hdnProgressSortColumn" />
                <div id ="inProgress_Notes"></div>
                
                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">Published Notes</span>
                        </div>
                        <div class="col-md-7">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="search_note2" name="search_note2" placeholder="Search notes here" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="button" onclick="searchNoteForDashboard(1,2);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdnPublishedSortOrder" />
                <input type="hidden" id="hdnPublishedSortDir" />
                <input type="hidden" id="hdnPublishedSortColumn" />
                <div id ="published_Notes"></div>
            </div>
        </div>

    </section>
    <!--Section Dashboard Start-->

    <!--Footer-->
    <?php include 'footer.php';?>
    <!--End of footer-->

</body>

</html>