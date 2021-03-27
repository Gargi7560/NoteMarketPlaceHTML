<?php
    session_start();

    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();
    
    if(!empty($_GET["note_id"]) && $_GET["note_id"] > 0){
        $current_note_id = $_GET["note_id"];
        
        $note_detail_query = "SELECT ND.NoteDetailID,ND.SellerID,ND.StatusID,ND.ActionByID,ND.AdminRemarks,ND.PublishedDate,ND.Title,ND.CategoryID,ND.DisplayPicture,ND.NoteTypeID,ND.NumberOfPages,ND.Description,ND.UniversityName,ND.CountryID,ND.Course,ND.CourseCode,ND.Professor,ND.SellingModeID,ND.SellingPrice,ND.NotesPreview,NC.CategoryName,CN.CountryName,US.FirstName FROM notedetails ND 
        INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
        INNER JOIN users US ON ND.SellerID = US.UserID
        INNER JOIN countries CN ON ND.CountryID = CN.CountryID WHERE ND.NoteDetailID = ".$current_note_id;
        
        $note_detail_result = $db_handle->runQuery($note_detail_query);
        
        $rateQuery = "SELECT AVG(Ratings) AS AverageRating,  COUNT(NotesReviewID) AS RatingCount FROM notesreviews 
        WHERE NoteDetailID = ".$current_note_id;
                            
        $rateResult = $db_handle->runQuery($rateQuery);
        
        $avgRating = (!empty($rateResult[0]['AverageRating']) && $rateResult[0]['AverageRating'] > 0) ? $rateResult[0]['AverageRating'] : 0;
        
        $ratingCnt = (!empty($rateResult[0]['RatingCount']) && $rateResult[0]['RatingCount'] > 0) ? $rateResult[0]['RatingCount'] : 0;
        
        $reportedNoteQuery = "SELECT NotesReportedIssuesID FROM notesreportedissues WHERE NoteDetailID = ".$current_note_id;
        
        $reportedNoteResult = $db_handle->runQuery($reportedNoteQuery);
        
        $CustomerReviewQuery = "SELECT NR.Ratings,NR.ReviewedByID,NR.Comments,US.FirstName,US.LastName,UP.ProfilePicture FROM notesreviews NR 
        INNER JOIN users US ON NR.ReviewedByID = US.UserID 
        INNER JOIN userprofiledetails UP ON NR.ReviewedByID = UP.UserID 
        WHERE NR.NoteDetailID = ".$current_note_id." ORDER BY NR.Ratings DESC";
        
        $CustomerReviewResult = $db_handle->runQuery($CustomerReviewQuery);
    }
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

    <!--Rating JS-->
    <script src="js/jsRating/jsRapStar.js"></script>

    <script type="text/javascript">
        function downloadAttachments() {
            <?php if(isset($_SESSION['user_logged_in']) && $note_detail_result[0]['SellingModeID'] == $sellForFree){ ?>
            var noteID = <?php echo $current_note_id; ?>;

            $.ajax({
                type: "POST",
                url: "download_attachments.php",
                data: {
                    noteID: noteID
                },
                success: function(data) {
                    window.location = data;
                }
            });
            <?php } else if(isset($_SESSION['user_logged_in']) && $note_detail_result[0]['SellingModeID'] == $sellForPaid) { ?>
            $('#downloadPaidNoteMsg').modal('show');

            <?php } else { ?>
            $('#downloadNoteMsg').modal('show');

            <?php } ?>
        }

        function downloadConfirmedPaidAttachments() {
            var noteID = <?php echo $current_note_id; ?>;

            $.ajax({
                type: "POST",
                url: "download_confirmed_paid_attachments.php",
                data: {
                    noteID: noteID
                },
                success: function(data) {
                    $('#downloadPaidNoteMsg').modal('hide');
                    $('#successPaidNoteMsg').modal('show');
                }
            });
        }

        $(document).ready(function() {
            //searchNoteForBuyerReq(1);
            $('#showRating').jsRapStar({
                length: 5,
                enabled: false,
                starHeight: 24,
                colorFront: '#deb217',
                value: <?php echo $avgRating; ?>
            });
        });
    </script>

</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">

        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--Search Notes Start-->

        <section id="notes_details" class="pad_100_for_pages">
            <div class="container">
                <?php
                    if($note_detail_result != ""){
                        foreach($note_detail_result as $noteValue){     
                ?>
                <div class="content-box-xs">
                    <p class="small-heading left_heading-1">Notes Details</p>
                    <div class="row">
                        <div class="col-lg-7 row_fix_bottom">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="note_img">
                                        <img src="<?php
                                        echo             str_replace($_SERVER["DOCUMENT_ROOT"], $http_protocol.$_SERVER['HTTP_HOST'], $noteValue['DisplayPicture']);
                                        ?>" alt="note">
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-7">
                                    <span class="common-heading-1 left_heading-1"><?php echo $noteValue['Title']; ?></span>
                                    <p class="middle-heading left_heading-1"><?php echo $noteValue['CategoryName']; ?></p>
                                    <p class="val_content"><?php echo $noteValue['Description']; ?></p>

                                    <!--Pop Up Button tigger-->
                                    <div class="small-btn general-btn">
                                        <button type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" onclick="downloadAttachments();">DOWNLOAD<?php if($noteValue['SellingModeID'] == $sellForPaid){
                                            echo "/".$noteValue['SellingPrice'];
                                        } ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <ul class="notes_Details_ul list-unstyled">
                                <li> Institution: <span class="right_pur_font"> <?php echo $noteValue['UniversityName']; ?></span></li>
                                <li> Country: <span class="right_pur_font"> <?php echo $noteValue['CountryName']; ?></span></li>
                                <li> Course Name: <span class="right_pur_font"> <?php echo $noteValue['Course']; ?></span></li>
                                <li> Course Code: <span class="right_pur_font"> <?php echo $noteValue['CourseCode']; ?></span></li>
                                <li> Professor: <span class="right_pur_font"> <?php echo $noteValue['Professor']; ?></span></li>
                                <li> Number of Pages: <span class="right_pur_font"> <?php echo $noteValue['NumberOfPages']; ?></span></li>
                                <li> Approved Date: <span class="right_pur_font"> <?php echo date('M d Y',strtotime($noteValue['PublishedDate'])); ?></span></li>
                                <li> Rating:
                                    <span class="right_pur_font merge">
                                        <div id="showRating" start="<?php echo $avgRating ?>"></div>
                                        <?php echo "&nbsp;&nbsp;&nbsp;".$ratingCnt; ?> reviews
                                    </span>
                                </li>
                                <li class="val_content red_text"> 
                                <?php 
                            if(!empty($reportedNoteResult)){
                            echo count($reportedNoteResult);}else{
                                echo "No ";
                            } ?> users marked this note as inappropriate.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="content-box-xs">
                    <div class="row">
                        <div class="col-lg-5 row_fix_bottom">
                            <p class="small-heading left_heading-1">Notes Preview</p>

                            <div class="note_preview">
                                <!-- responsive iframe -->
                                <!-- ============== -->

                                <div class="set-border-note-pdf">
                                    <div class="responsive-wrapper responsive-wrapper-padding-bottom-90pct">
                                        <iframe src="<?php 
                                            echo  str_replace($_SERVER["DOCUMENT_ROOT"], $http_protocol.$_SERVER['HTTP_HOST'], $noteValue['NotesPreview']);
                                        ?>">
                                            <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                            An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <p class="small-heading left_heading-1">Customer Reviews</p>
                            <div class="responsive-wrapper responsive-wrapper-padding-bottom-90pct">
                               <iframe src="<?php echo $http_protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/iframe.php?note_id=".$current_note_id; ?>"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                                    }
                }?>
            </div>
            <!--Popup Contain For Non Register User-->
            <div class="modal fade" id="downloadNoteMsg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                            </button>
                            <div class="common_popup">
                                <h4 class="common-heading-1 center_heading-1">Please Register</h4>
                                <p class="val_content">Please <a href="user_login.php"> sign in/register </a>to download this note. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Popup Contain For Paid Notes-->
            <div class="modal fade" id="downloadPaidNoteMsg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                            </button>
                            <div class="common_popup">
                                <h4 class="common-heading-1 center_heading-1">Please Confirm</h4>
                                <p class="val_content">Are you sure you want to download this <b>Paid note. </b> Please confirm. </p>
                                <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" name="updateStatus" id="updateStatus" onclick="downloadConfirmedPaidAttachments();">
                                <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="CANCEL" class="close-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Popup For Success of Paid Notes-->
            <div class="modal fade" id="successPaidNoteMsg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                            </button>

                            <div class="common_popup">
                                <div class="success_icon text-center">
                                    <img src="images/Notes_Details/SUCCESS.png" alt="success">
                                </div>
                                <h4 class="common-heading-1 center_heading-1">Thank you For Purchasing</h4>
                                <p class="val_content">Hey, thank you for purchasing the note. </p>
                                <p class="val_content">As this is paid notes - you need to pay the amount to seller <b><?php echo $note_detail_result[0]['FirstName'] ?></b> offline in order to download the note. </p>
                                <p class="val_content">We will send Seller an email that you want to download this note. Seller may contact you further for payment process completion. In case, you have urgency, please contact us on <b><?php echo $superAdminNumber; ?> </b></p>
                                <p class="val_content">Once Seller receives the payment and acknowledge us - selected notes you can see over my downloads tab for download.</p>
                                <p class="val_content">Have a good day.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!--Search Notes End-->


        <!--Footer-->
        <?php include 'footer.php';?>
        <!--End of footer-->

    </div>

</body>

</html>