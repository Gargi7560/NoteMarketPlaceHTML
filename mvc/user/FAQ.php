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
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
    
        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--FAQ Start-->
        <section id="faq_page">
            <div class="common-top pad_100_for_pages">
                <div class="content-box-lg">
                    <div class="container">
                        <span class="common-heading-1 center_heading-1 main_heading">Frequently Asked Questions</span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content-box-sm">

                <span class="common-heading-1 left_heading-1">General Questions</span>
                <div id="accordion" class="accordion">
                        <div class="card mb-0">
                            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                                    What is Marketplace-Notes?
                            </div>
                            <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </p>
                            </div>
                            <br>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    What do the University say?
                            </div>
                            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </p>
                            </div>
                            <br>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    Is this legal?
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <span class="common-heading-1 left_heading-1">Uploaders</span>
                <div id="accordion" class="accordion">
                        <div class="card mb-0">
                            <div class="card-header collapsed" data-toggle="collapse" href="#collapseFour">
                                    What can't I sell?
                            </div>
                            <div id="collapseFour" class="card-body collapse" data-parent="#accordion">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </p>
                            </div>
                            <br>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                    What notes can I sell?
                            </div>
                            <div id="collapseFive" class="card-body collapse" data-parent="#accordion">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    
                <span class="common-heading-1 left_heading-1">Downloaders</span>
                <div id="accordion" class="accordion">
                        <div class="card mb-0">
                            <div class="card-header collapsed" data-toggle="collapse" href="#collapseSix">
                                    What do I buy notes?
                            </div>
                            <div id="collapseSix" class="card-body collapse" data-parent="#accordion">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </p>
                            </div>
                            <br>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                                    Can I edit the notes I purchased?
                            </div>
                            <div id="collapseSeven" class="card-body collapse" data-parent="#accordion">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--FAQ End-->

        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->

    </div>
    

</body>

</html>