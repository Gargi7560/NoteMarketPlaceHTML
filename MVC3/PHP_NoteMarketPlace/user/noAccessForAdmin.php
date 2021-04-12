<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    //include 'manage_user_session.php';
    
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

</head>

<body data-spy="scroll" class="overflow-auto sticky-header">

    <div class="wrapper">

        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--No Access Page Start-->
        <section id="no_access">
            <div class="common-top pad_100_for_pages">
                <div class="content-box-lg">
                    <div class="container">
                        <span class="common-heading-1 center_heading-1 main_heading">No Access</span>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="content-box-sm">
                    <div class="home-heading">
                        <span class="common-heading-1 left_heading-1">Please contact support team.</span><br/>
                        <p class="row_fix_bottom">You do not have enough permission to access this page.<br/> 
                        Kindly contact us on <?php echo $admin_Email; ?></p>
                    </div>
                </div>
            </div>

        </section>
        <!--No Access Page End-->

        <!--Footer-->
        <?php include 'footer.php';?>
        <!--End of footer-->
    </div>

</body>

</html>