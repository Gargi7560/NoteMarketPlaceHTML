<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

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
    
    <script type="text/javascript">
        
        //Search field in manage country grid
        function searchCountry(page) {
            var searchCountry_OnPortal = $("#searchCountryBtn").val();
            $.ajax({
                type: "GET",
                url: "manage_country_search_page.php",
                data: {
                    search_country: searchCountry_OnPortal,
                    page: page,
                    orderBy: $('#hdnCountrySortOrder').val()
                },
                success: function (data) {
                    $("#manage_country_search_table").html(data);
                
                            if($('#hdnCountrySortColumn').val() == null || $('#hdnCountrySortColumn').val() == "") {
                        $('#hdnCountrySortOrder').val('CO.CreatedDate DESC');
                        $('#hdnCountrySortDir').val('DESC');
                        $('#hdnCountrySortColumn').val('thAddedDate');
                    }
                    if($('#hdnCountrySortDir').val() == "DESC") {
                        $('#' + $('#hdnCountrySortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnCountrySortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of delete button in tabel
        function deactivateCountry(countryID) {
            $('#deactivateCountryPopup').modal('show');
            $('#hdnCountryID').val(countryID);
        }
        
        //Update status on click of yes in confirmation popup
        function confirmDeactivateCountry() {
            $.ajax({
                type: "GET",
                url: "deactivate_country.php",
                data: {
                    countryID: $('#hdnCountryID').val()
                },
                success: function (data) {
                    $('#deactivateCountryPopup').modal('hide');
                    window.location = data;
                }
            });
        }
        $(document).ready(function(){
            searchCountry(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
   
    
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Manage Country Start-->
        <section id="manage_country" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Manage Country</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-4">
                                <a class="btn btn-outline-primary btn-purple my-2 my-sm-0" href="add_country.php">ADD COUNTRY</a>
                        </div>
                        
                        <!--Search field for searching notes -->
                        <div class="col-md-8">
                            <form class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchCountryBtn" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchCountry(1);">SEARCH</button>

                            </form>
                        </div>
                    </div>
                </div>

                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnCountrySortOrder" />
                <input type="hidden" id="hdnCountrySortDir" />
                <input type="hidden" id="hdnCountrySortColumn" />
                
                <!--Data for country grid-->
                <div id="manage_country_search_table"></div>

                <!--Deactivate Country Popup-->
                <div class="modal fade" id="deactivateCountryPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="review_popup">                                  
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to make this country inactive?</p>
                            
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmDeactivateCountry" onclick="confirmDeactivateCountry();">
                                    <input type="hidden" id="hdnCountryID"> 
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
        </section>
        <!--Manage Country End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

</body>

</html>