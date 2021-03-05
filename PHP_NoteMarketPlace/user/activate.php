<?php
    //Import database configuration
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	if(!empty($_GET["id"])) {
	$query = "UPDATE users set IsEmailVerified = 1 WHERE UserID=" . $_GET["id"];
	$result = $db_handle->updateQuery($query);
		if(!empty($result)) {
			$message = "Your account is activated.";             
		} else {
			$message = "Invalid activation link.Please contact admin.";
		}
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
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    </script>
    </head>

    <body>
        <!-- Modal -->
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
                            <h4 class="common-heading-1 center_heading-1">Thank you for Signup</h4>
                            <p class="val_content text-center"><?php echo $message ?></p>
                            <p class="text-center">Click here to <a href="user_login.php" class="btn-blue">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>