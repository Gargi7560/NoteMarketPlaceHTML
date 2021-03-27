<?php
   session_start();

    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();
    
    if(!empty($_GET["note_id"]) && $_GET["note_id"] > 0){
        $current_note_id = $_GET["note_id"];
        
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

</head>
  <body>
      <div class="cust_review">
    <?php if($CustomerReviewResult != "") { 
                $i = 0;
        foreach($CustomerReviewResult as $customerReviewValue){
    ?>

    <div class="row cust_review">
        <div class="col-2">
            <span><img src="<?php 
                echo             str_replace($_SERVER["DOCUMENT_ROOT"], $http_protocol.$_SERVER["HTTP_HOST"], $customerReviewValue["ProfilePicture"]);
            ?>" alt="customer" class="img-responsive rounded-circle cust_img"></span>
        </div>
        <div class="col-10">
            <span class="val_content float-left"><b><?php echo $customerReviewValue["FirstName"]." ".$customerReviewValue["LastName"]; ?></b></span>
            <div class="float-left" id="singleRating_<?php echo $i; ?>" start="<?php echo $customerReviewValue["Ratings"]; ?>"></div>
            <div class="clear"></div>
            <span class="val_content"><?php echo $customerReviewValue["Comments"]; ?></span>
        </div>
    </div>
    <script type="text/javascript">
        $('#singleRating_<?php echo $i;?>').jsRapStar({
            length: 5,
            enabled: false,
            starHeight: 24,
            colorFront: '#deb217',
            value: <?php echo $customerReviewValue["Ratings"]; ?>
        });
    </script>
    <hr>
    <?php 
        $i++;
        } 
            } else {
                
                echo "No customer reviews for this note.";
                
    }?>
    </div>
</body>