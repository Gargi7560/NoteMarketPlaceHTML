<?php 
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    if(!empty($_GET["note_id"]) && $_GET["note_id"] > 0){
    $current_note_id = $_GET["note_id"];
        
    $note_detail_query = "SELECT ND.NoteDetailID,ND.SellerID,ND.StatusID,ND.ActionByID,ND.AdminRemarks,ND.PublishedDate,ND.Title,ND.CategoryID,ND.DisplayPicture,ND.NoteTypeID,ND.NumberOfPages,ND.Description,ND.UniversityName,ND.CountryID,ND.Course,ND.CourseCode,ND.Professor,ND.SellingModeID,ND.SellingPrice,ND.NotesPreview,NC.CategoryName,CN.CountryName,US.FirstName FROM notedetails ND 
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    INNER JOIN users US ON ND.SellerID = US.UserID
    INNER JOIN countries CN ON ND.CountryID = CN.CountryID WHERE ND.NoteDetailID = ".$current_note_id;
        
    $note_detail_result = $db_handle->runQuery($note_detail_query);
        
    //Star rating average query
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
    
    <!--Rating JS-->
    <script src="js/jsRating/jsRapStar.js"></script>
    
    <script type="text/javascript">    
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
        <?php include 'admin_header.php'; ?>
        <!--Header End-->

        <!--Search Notes Start-->
        <section id="admin_notes_details" class="pad_100_for_pages">
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
                                        echo $noteValue['DisplayPicture'];
                                        ?>" alt="note">
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-7">
                                    <span class="common-heading-1 left_heading-1"><?php echo $noteValue['Title']; ?></span>
                                    <p class="middle-heading left_heading-1"><?php echo $noteValue['CategoryName']; ?></p>
                                    <p class="val_content"><?php echo $noteValue['Description']; ?></p>
                                    
                                    <!--Thank You  Button tigger-->
                                    <div class="small-btn general-btn">
                                        <button type="button" class="btn btn-outline-primary btn-purple" onclick="<?php echo 'downloadAdminNoteFromTable(0,'.$noteValue["NoteDetailID"].');'; ?>">DOWNLOAD<?php if($noteValue['SellingModeID'] == $sellForPaid){
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
                                            echo $noteValue['NotesPreview'];
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
                               <iframe src="<?php echo $http_protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_iframe.php?note_id=".$current_note_id; ?>"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        }
                }?>
            </div>
        </section>
        <!--Search Notes End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php'; ?>
        <!--Footer End-->

    </div>

</body>

</html>