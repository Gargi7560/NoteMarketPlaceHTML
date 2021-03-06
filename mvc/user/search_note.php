<?php
    session_start();
    
    //Import database configuration
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

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
    
    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>
    
    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    

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
                                    <input type="text" class="form-control input_val search_icon" name="search_note" id="search_note" placeholder="Search notes here..." onblur="search();">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-4 row_mid_bottom">
                                   
                                   <?php 
                                    
                                    $typeQuery = "select NoteTypeID,  TypeName from notetypes";
                                    $typeResult = $db_handle->runQuery($typeQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectType" name="selectType">
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
                                    <select class="form-control dropdown-control" id="selectCategory" name="selectCategory">
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
                                    $uniQuery = "select distinct UniversityName from notedetails where IsActive = 1";
                                    $uniResult = $db_handle->runQuery($uniQuery);
                                    ?>
                                    <select class="form-control dropdown-control" id="selectUniversity" name="selectUniversity">
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
                                    $courseQuery = "select distinct Course from notedetails where IsActive = 1";
                                    $courseResult = $db_handle->runQuery($courseQuery);
                                    ?>
                                    <select class="form-control dropdown-control" id="selectCourse" name="selectCourse">
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
                                    <select class="form-control dropdown-control" id="selectCountry" name="selectCountry">
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
                                    <select class="form-control dropdown-control" id="selectRating" name="selectRxating">
                                        <option value="0">Select rating</option>
                                        <?php                   
                                        foreach($ratingResult as $ratingRow){
                                            echo "<option value='" . $ratingRow['Value'] . "'>" . $ratingRow['Value'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <!--search_page_notes-->
                    
   <div class="search_page_notes">
    <p class="small-heading-1 left_heading-2">Total 18 notes</p>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/1.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                    <p class="common-heading-1 left_heading-1 fix_height">Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">

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

                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/2.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                    <a href="note_details.php">
                        <p class="common-heading-1 left_heading-1 fix_height">Computer Science</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">
                            <div class="rate1">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/3.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                    <a href="note_details.php">
                        <p class="common-heading-1 left_heading-1 fix_height">Basic Computer Engineer Tech India Publication Series</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">

                            <div class="rate2">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/4.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                       <p class="common-heading-1 left_heading-1 fix_height">Computer Science Illuminted-Seven Edition</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">

                            <div class="rate3">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/5.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                       <p class="common-heading-1 left_heading-1 fix_height">The Principle of Computer Hardware</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">
                            <div class="rate4">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/6.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                       <p class="common-heading-1 left_heading-1 fix_height">The Computer Book</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">
                            <div class="rate5">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/1.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                       <p class="common-heading-1 left_heading-1 fix_height">Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">
                            <div class="rate6">
                                <div class="rate"></div>
                            </div>

                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/2.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                       <p class="common-heading-1 left_heading-1 fix_height">Computer Science</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">
                            <div class="rate7">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="images/Search/3.jpg" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="note_details.php">
                       <p class="common-heading-1 left_heading-1 fix_height">Basic Computer Engineer Tech India Publication Series</p></a>
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content">University of California, US</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content">204 Pages</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content">Thu Nov 26,2020</span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text"> 5 Users marked this note as inappropriate</span>
                        </div>
                        <div class="merge">

                            <div class="rate8">
                                <div class="rate"></div>
                            </div>
                            <span class="val_content">100 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--Pagination Start-->
<div class="container">
    <div class="row">
        <div class="pagination-filters">
            <div class="col-md-12">
                <div class="pagination">
                    <a href="#"> ❮ </a>
                    <a href="#search_pg1" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#"> ❯ </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Pagination End-->
                    
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