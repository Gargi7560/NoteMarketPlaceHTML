<?php 

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
    
    </head>
    
    <body data-spy="scroll" class="overflow-auto sticky-header">
        <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->
        
        <!--Add Administrator Start--> 
        <section id="add_administrator" class="pad_100_for_pages"> 
            <div class="container">
                <div class="content-box-xs">
                    <span class="common-heading-1 left_heading-1">No Access</span>
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
        <!--Add Administrator End-->
        
        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

        </div>
        
    
    </body>
</html>