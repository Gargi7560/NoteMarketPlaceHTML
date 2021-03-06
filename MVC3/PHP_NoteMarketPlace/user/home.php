<?php
    session_start();
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
    
    <!--Responsive-tabs CSS-->
    <link rel="stylesheet" href="css/responsive-tabs/responsive-tabs.min.css">
    
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
    
    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body data-spy="scroll" class="overflow-auto" id="bodyForStickyHeader">
    <div class="wrapper">

        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--Home Page Start-->
        <section id="home-page">
            <div class="home-page">

                <!--home-page-1 Start-->
                <div class="home-page-1">
                    <div class="common-top pad_100_for_pages">
                        <div class="content-box-lg">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7">
                                            <span class="common-heading-1 left_heading-1 main_heading">Download Free/Paid Notes</span>
                                            <span class="common-heading-1 left_heading-1 main_heading">or Sale your Book</span>
                                        <div class="home-page-1-inner">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque amet ratione omnis. Vitae id molestias minus incidunt ea!</p>
                                        </div>
                                        <div class="small-btn">
                                            <a href="FAQ.php" class="btn btn-outline-primary small-btn-1 small-btn-2">Learn More</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-5"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--home-page-1 End-->

                <!--home-page-2 Start-->
                <div class="home-page-2">
                    <div class="container">
                        <div class="content-box-sm">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 row_fix_bottom">
                                    <div id="home-page-2-left">
                                        <span class="common-heading-1 left_heading-1">About</span>
                                        <span class="common-heading-1 left_heading-1">NotesMarketPlace</span>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div id="home-page-2-right">
                                        <p class="home-page-2-inner">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, natus suscipit delectus aperiam tenetur debitis modi est, nulla et numquam porro consectetur necessitatibus assumenda voluptas recusandae doloremque voluptate ab atque modi est, nulla et numquam porro consectetur necessitatibus assumenda voluptas.</p>
                                        <br>
                                        <p class="home-page-2-inner">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident earum minus, modi quia obcaecati quis accusantium, soluta tempora eveniet voluptatibus velit reiciendismodi est, nulla et numquam porro consectetur.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--home-page-2 End-->

                <!--home-page-3 Start-->
                <div class="home-page-3">
                    <div class="container-fluid">
                        <div class="content-box-sm">
                            <span class="common-heading-1 center_heading-1">How it Works</span>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-5 col-md-6 text-center row_fix_bottom">

                                    <div class="rounded-circle text-center">
                                        <img src="images/home/download.png" alt="download" class="img-responsive">
                                    </div>
                                    <p class="small-heading-1 center_heading-2">Download Free/Paid Notes</p>
                                    <p class="val_content">Get Material for your</p>
                                    <p class="val_content">Courses etc.</p>

                                    <div class="small-btn general-btn">
                                        <a href="search_note.php" class="btn btn-outline-primary btn-purple">DOWNLOAD</a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 text-center row_fix_bottom">

                                    <div class="rounded-circle text-center dow_sel">
                                        <img src="images/home/seller.png" alt="seller" class="img-responsive">
                                    </div>

                                    <p class="small-heading-1 center_heading-2">Seller</p>
                                    <div class="home-page-3-inner">
                                    <p class="val_content">Upload and Download Course</p>
                                    <p class="val_content">and Materials etc.</p>
                                    </div>
                                    <div class="small-btn general-btn">
                                       <?php if(isset($_SESSION['user_logged_in'])){ ?>
                                        <a href="user_dashboard-1.php" class="btn btn-outline-primary btn-purple">SELL BOOK</a>
                                        <?php } else { ?>
                                        <a href="user_login.php" class="btn btn-outline-primary btn-purple">SELL BOOK</a>
                                       <?php } ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                    </div>
                </div>
                <!--home-page-3 End-->

                <!--home-page-4 Start-->
                <div class="home-page-4">
                    <div class="container">
                        <div class="content-box-sm">
                            <span class="common-heading-1 center_heading-1">What our Customres are Saying</span>
                            <div class="row">

                                <div class="col-md-6 row_fix_bottom_30">
                                    <div class="customers">
                                        <div class="row home-page-4-name">
                                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
                                                <img src="images/clients/team-1.jpg" alt="customer" class="img-responsive rounded-circle rounded-sm">
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7 verti_middle">
                                                <span class="small-heading-1 left_heading-1">Walter Meller</span>
                                                <p class="val_content">Founder &amp; CEO, Matrix Group</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="par_p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, nisi distinctio magnam delectus voluptas at perferendis dignissimos quisquam consectetur quaerat possimus rerum quos aut!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="customers">
                                        <div class="row home-page-4-name">
                                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
                                                <img src="images/clients/team-3.jpg" alt="customer" class="img-responsive rounded-circle rounded-sm">
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7 verti_middle">
                                                <span class="small-heading-1 left_heading-1">Jonnie Riley</span>
                                                <p class="val_content">Employee, Curlous Snakes</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="par_p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, nisi distinctio magnam delectus voluptas at perferendis dignissimos quisquam consectetur quaerat possimus rerum quos aut!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>
                            <div class="row">

                                <div class="col-md-6 row_fix_bottom_30">
                                    <div class="customers">
                                        <div class="row home-page-4-name">
                                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
                                                <img src="images/clients/team-5.jpg" alt="customer" class="img-responsive rounded-circle rounded-sm">
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7 verti_middle">
                                                <span class="small-heading-1 left_heading-1">Amilia Luna</span>
                                                <p class="val_content">Teacher, Saint joseph High School</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="par_p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, nisi distinctio magnam delectus voluptas at perferendis dignissimos quisquam consectetur quaerat possimus rerum quos aut!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="customers">
                                        <div class="row home-page-4-name">
                                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
                                                <img src="images/clients/team-4.jpg" alt="customer" class="img-responsive rounded-circle rounded-sm">
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7 verti_middle">
                                                <span class="small-heading-1 left_heading-1">Daniel Cardos</span>
                                                <p class="val_content">Software Engineer, Infinitum Company</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="par_p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, nisi distinctio magnam delectus voluptas at perferendis dignissimos quisquam consectetur quaerat possimus rerum quos aut!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!--home-page-4 End-->
                
            </div>

        </section>
        <!--Home Page End-->


        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->


    </div>

</body>

</html>