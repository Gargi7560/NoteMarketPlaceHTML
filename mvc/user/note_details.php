<?php
    session_start();

    require_once("dbcontroller.php");
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
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
        
        <!--Header Start-->
            <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--Search Notes Start-->
        <section id="notes_details" class="pad_100_for_pages">
            <div class="container">
                <div class="content-box-xs">
                    <p class="small-heading left_heading-1">Notes Details</p>
                   
                    <div class="row">
                        <div class="col-lg-7 row_fix_bottom">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="note_img">
                                        <img src="images/Notes_Details/1.jpg" alt="note">
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-7">
                                    <span class="common-heading-1 left_heading-1">Computer Science</span>
                                    <p class="middle-heading left_heading-1">Sciences</p>
                                    <p class="val_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni officia animi enim fugiat vero voluptatum voluptate excepturi possimus quasi hic quaerat quia veniam, facilis suscipit!</p>
                                    
                                    
                                    
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        echo '
                                    <div class="small-btn general-btn">
                                        <button type="button" class="btn btn-outline-primary btn-purple" name="allowDownload" data-toggle="modal" data-target="#myModal">DOWNLOAD/$15</button>
                                        
                                    </div>';
                                    } else {
                                        echo '
                                              <div class="small-btn general-btn">
                                        <button type="button" class="btn btn-outline-primary btn-purple" name="allowDownload" onclick="user_login.php">DOWNLOAD/$15</button>
                                              ';
                                    }
                                    ?>
                                    
                                    
                                    <!--Thank You Popup-->
                                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                                    </button>
                                                    <div class="thanks_popup">


                                                        <div class="success_icon text-center">
                                                            <img src="images/Notes_Details/SUCCESS.png" alt="success">
                                                        </div>
                                                        <h4 class="common-heading-1 center_heading-1">Thank you for purchasing</h4>
                                                        <p class="middle-heading"> Dear Smith,
                                                        </p>
                                                        <p class="val_content">As this is paid notes - you need to pay to seller Gargi Patel offline. We will send him an email that you want to download this note. He may contact you furthur for payment process completion. </p>
                                                        <p class="val_content">In case, you have urgency,<br>
                                                            please contact us on +919543210987.
                                                        </p>
                                                        <p class="val_content">Once he receives the payment and acknowledge us - selected notes you can see over my downloads tab for download.
                                                        </p>
                                                        <p class="val_content">Have a good day.</p>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5">
                            <ul class="notes_Details_ul list-unstyled">
                                <li> Institution: <span> University of California</span></li>
                                <li> Country: <span> United States</span></li>
                                <li> Course Name: <span> Computer Engineering</span></li>
                                <li> Course Code: <span> 248705</span></li>
                                <li> Professor: <span> Mr.Richard Brown</span></li>
                                <li> Number of Pages: <span> 277</span></li>
                                <li> Approved Date: <span> November 25 2020</span></li>
                                <li> Rating:
                                          <span> <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                     </div> 100 Reviews</span></li>
                                <li class="val_content red_text"> 5 Users marked this note as inappropriate</li>
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
                                        <iframe src="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">
                                            <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                                    An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                                        </iframe>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-7">
                            <p class="small-heading left_heading-1">Customer Reviews</p>

                            <div class="cust_review">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span><img src="images/clients/team-2.jpg" alt="customer" class="img-responsive rounded-circle cust_img"></span>
                                    </div>

                                    <div class="col-md-10">
                                        <span class="val_content"><b>Richard Brown</b></span>
                                        <br>
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        <br>
                                        <p class="val_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda fugiat praesentium tenetur reiciendis!</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span><img src="images/clients/team-2.jpg" alt="customer" class="img-responsive rounded-circle cust_img"></span>
                                    </div>

                                    <div class="col-md-10">
                                        <span class="val_content"><b>Richard Brown</b></span>
                                        <br>
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        <br>
                                        <p class="val_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda fugiat praesentium tenetur reiciendis!</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span><img src="images/clients/team-2.jpg" alt="customer" class="img-responsive rounded-circle cust_img"></span>
                                    </div>

                                    <div class="col-md-10">
                                        <span class="val_content"><b>Richard Brown</b></span>
                                        <br>
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        <br>
                                        <p class="val_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda fugiat praesentium tenetur reiciendis!</p>
                                    </div>
                                </div>


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