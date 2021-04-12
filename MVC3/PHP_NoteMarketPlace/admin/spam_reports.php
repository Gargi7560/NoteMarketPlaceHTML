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
        
        //Search spam grid
        function spamReportNotes(page) {
            var spamReportNotes_OnPortal = $("#searchSpamReportNotes").val();
            $.ajax({
                type: "GET",
                url: "admin_spamReport_note.php",
                data: {
                    spamReport_note: spamReportNotes_OnPortal,
                    page: page,
                    orderBy: $('#hdnSpamSortOrder').val()
                },
                success: function (data) {
                    $("#admin_spamReport_note_table").html(data);
                
                    if($('#hdnSpamSortColumn').val() == null || $('#hdnSpamSortColumn').val() == "") {
                        $('#hdnSpamSortOrder').val('NR.CreatedDate DESC');
                        $('#hdnSpamSortDir').val('DESC');
                        $('#hdnSpamSortColumn').val('thAddedDate');
                    }
                    if($('#hdnSpamSortDir').val() == "DESC") {
                        $('#' + $('#hdnSpamSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnSpamSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of delete button in tabel
        function deleteSpamReport(spamID) {
            $('#deleteSpamReportPopup').modal('show');
            $('#hdnSpamID').val(spamID);
        }
        
        //Delete note on click of yes in confirmation popup
        function confirmDeleteSpamReport() {
            $.ajax({
                type: "GET",
                url: "delete_spamReport.php",
                data: {
                    spamID: $('#hdnSpamID').val()
                },
                success: function (data) {
                    $('#deleteSpamReportPopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            spamReportNotes(1);
        });
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
    
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Spam Report Start-->
        <section id="spam_report" class="pad_120_for_pages">
            <div class="container">

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="common-heading-1 left_heading-1">Spam Reports</span>
                        </div>
                        
                        <!--Search field for note search-->
                        <div class="col-md-8">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchSpamReportNotes" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="spamReportNotes(1);">SEARCH</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnSpamSortOrder" />
                <input type="hidden" id="hdnSpamSortDir" />
                <input type="hidden" id="hdnSpamSortColumn" />
                
                <!--Data for spam reports grid-->
                <div id="admin_spamReport_note_table"></div>
                
                <!--Delete Spam Report Popup-->
                <div class="modal fade" id="deleteSpamReportPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">                                  
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to delete reported issue?</p>
                            
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmDeleteSpamReport" onclick="confirmDeleteSpamReport();">
                                    <input type="hidden" id="hdnSpamID"> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Spam Report End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

</div>

</body>

</html>