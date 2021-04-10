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
        
    function searchNoteReject(page) {
        var searchNote_Reject = $("#searchReject").val();
        $.ajax({
            type: "GET",
            url: "reject_search_note.php",
            data: {
                search_reject_note: searchNote_Reject,
                page: page,
                orderBy: $('#hdnRejectSortOrder').val()
            },
            success: function (data) {
                $("#reject_Notes").html(data);
                
                if($('#hdnRejectSortColumn').val() == null || $('#hdnRejectSortColumn').val() == "") {
                    $('#hdnRejectSortOrder').val('ND.ModifiedDate DESC');
                    $('#hdnRejectSortDir').val('DESC');
                    $('#hdnRejectSortColumn').val('thDownloadDt');
                }
                if($('#hdnRejectSortDir').val() == "DESC") {
                    $('#' + $('#hdnRejectSortColumn').val()).addClass('descending');
                } else {
                    $('#' + $('#hdnRejectSortColumn').val()).addClass('ascending');
                }
            }
        });
    }
    $(document).ready(function(){
        searchNoteReject(1);
    });
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->
        
        <!--My Rejected Notes-->
       <section id="my_rejected_notes" class="pad_100_for_pages">
           <div class="container">
               <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">My Rejected Notes</span>
                        </div>
                        <div class="col-md-7">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchReject" name="searchReject" placeholder="Search notes here" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="button" onclick="searchNoteReject(1);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
            <input type="hidden" id="hdnRejectSortOrder">
            <input type="hidden" id="hdnRejectSortDir">
            <input type="hidden" id="hdnRejectSortColumn">    
            <div id="reject_Notes"></div>
           </div>
       </section>
       
        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->
        </div>
</body>

</html>