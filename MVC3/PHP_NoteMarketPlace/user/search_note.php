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

    <!--Rating JS-->
    <script src="js/jsRating/jsRapStar.js"></script>

    <script>

    function searchAnyNote(page) {

        var searchNote = $("#search_note").val();
        var selectedType = $("#selectType").val();
        var selectedCategory = $("#selectCategory").val();
        var selectedUniversity = $("#selectUniversity").val();
        var selectedCourse = $("#selectCourse").val();
        var selectedCountry = $("#selectCountry").val();
        var selectedRating = $("#selectRating").val();

        $.ajax({
            type: "GET",
            url: "search.php",
            data: {
                search_note: searchNote,
                selectedType: selectedType,
                selectedCategory: selectedCategory,
                selectedUniversity: selectedUniversity,
                selectedCourse: selectedCourse,
                selectedCountry: selectedCountry,
                selectedRating: selectedRating,
                page: page
                
            },

            success: function (data) {
                $("#search_note_result_div").html(data);
            }
        });
    }
        
    $(document).ready(function(){
        searchAnyNote(1);
    });
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">

        <!--Header Start-->
            <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--Search Notes Start-->
        <section id="search_notes_page">
            <div class="common-top pad_100_for_pages">
                <div class="content-box-lg">
                    <div class="container">
                        <div class="top-heading">
                            <span class="common-heading-1 center_heading-1 main_heading">Search Notes</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="search_filter_notes">

                    <div class="content-box-sm">
                        <p class="small-heading-1 left_heading-2">Search and Filter notes</p>
                        <div class="search_filter_notes_inner">

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control input_val search_icon" name="search_note" id="search_note" placeholder="Search notes here..." onchange="searchAnyNote(1);">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-4 row_mid_bottom">
                                   
                                   <?php 
                                    
                                    $typeQuery = "select NoteTypeID,  TypeName from notetypes";
                                    $typeResult = $db_handle->runQuery($typeQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectType" name="selectType" onchange="searchAnyNote(1);">
                                        <option value="0">Select type</option>
                                        <?php                   
                                        foreach($typeResult as $typeRow){
                                            echo "<option value='" . $typeRow['NoteTypeID'] . "'>" . $typeRow['TypeName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 row_mid_bottom">
                                   <?php 
                                    
                                    $categoryQuery = "select NoteCategoryID,  CategoryName from notecategories";
                                    $categoryResult = $db_handle->runQuery($categoryQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectCategory" name="selectCategory" onchange="searchAnyNote(1);">
                                        <option value="0">Select category</option>
                                         <?php                   
                                        foreach($categoryResult as $categoryRow){
                                            echo "<option value='" . $categoryRow['NoteCategoryID'] . "'>" . $categoryRow['CategoryName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 row_mid_bottom">
                                   <?php 
                                    $uniQuery = "SELECT distinct UniversityName FROM notedetails WHERE IsActive = 1 AND NOT UniversityName = ''";
                                    $uniResult = $db_handle->runQuery($uniQuery);
                                    ?>
                                    <select class="form-control dropdown-control" id="selectUniversity" name="selectUniversity" onchange="searchAnyNote(1);">
                                        <option value="0">Select university</option>
                                        <?php                   
                                        foreach($uniResult as $uniRow){
                                            echo "<option value='" . $uniRow['UniversityName'] . "'>" . $uniRow['UniversityName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 row_fix_bottom_30">
                                    <?php 
                                    $courseQuery = "SELECT distinct Course FROM notedetails where IsActive = 1 AND NOT Course = ''";
                                    $courseResult = $db_handle->runQuery($courseQuery);
                                    ?>
                                    <select class="form-control dropdown-control" id="selectCourse" name="selectCourse" onchange="searchAnyNote(1);">
                                        <option value="0">Select course</option>
                                        <?php                   
                                        foreach($courseResult as $courseRow){
                                            echo "<option value='" . $courseRow['Course'] . "'>" . $courseRow['Course'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 row_fix_bottom_30">
                                   <?php 
                                    
                                    $countryQuery = "select CountryID,  CountryName from countries";
                                    $countryResult = $db_handle->runQuery($countryQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectCountry" name="selectCountry" onchange="searchAnyNote(1);">
                                        <option value="0">Select country</option>
                                        <?php                   
                                        foreach($countryResult as $countryRow){
                                            echo "<option value='" . $countryRow['CountryID'] . "'>" . $countryRow['CountryName'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                   <?php 
                                    
                                    $ratingQuery = "select Value,  DataValue,ReferenceCategory from referencedata where ReferenceCategory = 'Ratings'";
                                    
                                    $ratingResult = $db_handle->runQuery($ratingQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectRating" name="selectRating" onchange="searchAnyNote(1);">
                                        <option value="0">Select rating</option>
                                        <?php                   
                                        foreach($ratingResult as $ratingRow){
                                            echo "<option value='" . $ratingRow['DataValue'] . "'>" . $ratingRow['Value'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="search_note_result_div"></div>
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