<?php 
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    //Settings from Config file
    include '../common/configuration.php';

    if(!empty($_GET["user_id"]) && $_GET["user_id"] > 0){
        $current_member_id = $_GET["user_id"];
        
        $member_detail_query = "SELECT US.UserID,US.FirstName,US.LastName,US.Email,UP.DOB,UP.PhoneNumber,UP.University,UP.College,UP.ProfilePicture,UP.AddressLine1,UP.AddressLine2,UP.City,UP.State,CN.CountryName,UP.ZipCode FROM users US
        LEFT JOIN userprofiledetails UP ON UP.UserID = US.UserID
        LEFT JOIN countries CN ON UP.CountryID = CN.CountryID 
        WHERE US.UserID = ".$current_member_id;

        $member_detail_result = $db_handle->runQuery($member_detail_query);
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
        
        //Search member detail grid
        function memberNoteTable(page) {
            $.ajax({
                type: "GET",
                url: "member_detail_notes.php",
                data: {
                    page: page,
                    orderBy: $('#hdnMemberDetailSortOrder').val(),
                    userID: <?php echo $current_member_id; ?>
                },
                success: function (data) {
                    $("#member_detail_notes_table").html(data);
                    
                    if($('#hdnMemberDetailSortColumn').val() == null || $('#hdnMemberDetailSortColumn').val() == "") {
                        $('#hdnMemberDetailSortOrder').val('CreatedDate DESC');
                        $('#hdnMemberDetailSortDir').val('DESC');
                        $('#hdnMemberDetailSortColumn').val('thAddedDt');
                    }
                    if($('#hdnMemberDetailSortDir').val() == "DESC") {
                        $('#' + $('#hdnMemberDetailSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnMemberDetailSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        $(document).ready(function(){
            memberNoteTable(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
    
        <!--Header Start-->
        <?php include 'admin_header.php'; ?>
        <!--Header End-->

        <!--Member Details Start-->
        <section id="member_details" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Member Details</span>
                
                <div class="small_pad_20">
                <?php
                if($member_detail_result != ""){
                    foreach($member_detail_result as $memberValue){    
                ?>
                    <div class="row">
                        <div class="col-lg-2 admin_img">
                            <img src="<?php 
                                echo $memberValue['ProfilePicture'];
                            ?>" alt="admin">
                        </div>
                        <div class="col-lg-10">
                        <div class="row">
                        <div class="col-md-6 vertical_bordered">
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">First Name:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['FirstName']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Last Name:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['LastName']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Email:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['Email']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">DOB:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php if(!empty($memberValue['DOB'])) {
                                        echo date('d-m-Y',strtotime($memberValue['DOB']));
                                    }
                                    ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Phone Nimber:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['PhoneNumber']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">College/University:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php if(!empty($memberValue['University'])) {
                                        echo $memberValue['University'];
                                    } else {
                                        echo $memberValue['College'];
                                    } ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Address 1:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['AddressLine1']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Address 2:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['AddressLine2']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">City:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['City']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">State:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['State']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Country:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['CountryName']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-4">
                                    <p class="val_content">Zip Code:</p>
                                </div>
                                <div class="col-md-7 col-8">
                                    <p class="val_content pur_col"><?php echo $memberValue['ZipCode']; ?></p>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
                <?php 
                                    }
                }?>
                    <hr>
                   
                    <!--Hidden Field for ascending and descending-->
                    <input type="hidden" id="hdnMemberDetailSortOrder" />
                    <input type="hidden" id="hdnMemberDetailSortDir" />
                    <input type="hidden" id="hdnMemberDetailSortColumn" />
                    
                    <!--Data for member detail grid-->
                    <div id="member_detail_notes_table"></div>
                    
                </div> 
            </div>
        </section>
        <!--Member Details End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php'; ?>
        <!--Footer End-->

    </div>

</body>

</html>