
<?php

    require_once("dbcontroller.php");
	$db_handle = new DBController();

    $query = "SELECT Title FROM notedetails where Title like '%$title%'";

    $searchNote = "";
    $selectType = "";
    $selectCategory = "";
    $selectUniversity = "";
    $selectCourse = "";
    $selectCountry = "";
    $selectRating = "";

    $searchNote = $_POST["search_note"];
    $selectType = $_POST["selectType"];
    $selectCategory = $_POST["selectCategory"];
    $selectUniversity = $_POST["selectUniversity"];
    $selectCourse = $_POST["selectCourse"];
    $selectCountry = $_POST["selectCountry"];
    $selectRating = $_POST["selectRating"];

    echo $searchNote;
    echo $selectType;
    echo $selectCategory;
    echo $selectUniversity;
    echo $selectCourse;
    echo $selectCountry;
    echo $selectRating;
?>

   
   
   
   