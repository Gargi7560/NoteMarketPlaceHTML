<?php
    session_start();
    
    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();

    $limit = 9;

    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit;

    $search_Str = (isset($_GET['search_note']) && !empty($_GET['search_note'])) ? $_GET['search_note'] : "";


    $selectedType = (isset($_GET['selectedType']) && !empty($_GET['selectedType']) && $_GET['selectedType'] > 0) ? $_GET['selectedType'] : "";

    $selectedCategory = (isset($_GET['selectedCategory']) && !empty($_GET['selectedCategory']) && $_GET['selectedCategory'] > 0) ? $_GET["selectedCategory"] : "";

    $selectedUniversity = (isset($_GET['selectedUniversity']) && !empty($_GET['selectedUniversity'])) ? $_GET["selectedUniversity"] : "";

    $selectedCourse = (isset($_GET['selectedCourse']) && !empty($_GET['selectedCourse']) && $_GET['selectedCourse'] > 0) ? $_GET["selectedCourse"] : "";
    
    $selectedCountry = (isset($_GET['selectedCountry']) && !empty($_GET['selectedCountry']) && $_GET['selectedCountry'] > 0) ? $_GET["selectedCountry"] : "";
    
    $selectedRating = (isset($_GET['selectedRating']) && !empty($_GET['selectedRating']) && $_GET['selectedRating'] > 0) ? $_GET["selectedRating"] : "";

    $whereQuery = "";
    $paginationSearchQuery = "";
    
    $basedSearchQuery = "
    
    SELECT
    *
    FROM
    (
    
    SELECT ND.NoteDetailID,ND.Title,ND.DisplayPicture,ND.UniversityName,ND.NumberOfPages,ND.PublishedDate,NC.CategoryName,NT.TypeName,CN.CountryName, ND.StatusID, ND.NoteTypeID, ND.CategoryID, ND.Course, ND.CountryID,
    
    (SELECT AVG(Ratings) FROM notesreviews 
            WHERE NoteDetailID = ND.NoteDetailID
    ) as AverageRating
    
    FROM notedetails ND
    LEFT JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    LEFT JOIN notetypes NT ON ND.NoteTypeID = NT.NoteTypeID
    LEFT JOIN countries CN ON ND.CountryID = CN.CountryID 
    ) AS T
    WHERE 1 = 1 AND StatusID = ".$publishedID;

    if(!empty($search_Str)) {
        $whereQuery .= " AND (Title LIKE '%".$search_Str."%' OR CategoryName LIKE '%".$search_Str."%' OR TypeName LIKE '%".$search_Str."%') "; 
    }

    if(!empty($selectedType)) {
        $whereQuery .= " AND (NoteTypeID = ".$selectedType.") "; 
    }
    if(!empty($selectedCategory)) {
        $whereQuery .= " AND (CategoryID = ".$selectedCategory.") "; 
    }
    if(!empty($selectedUniversity)) {
        $whereQuery .= " AND (UniversityName = '".$selectedUniversity."') "; 
    }
    if(!empty($selectedCourse)) {
        $whereQuery .= " AND (Course = '".$selectedCourse."') "; 
    }
    if(!empty($selectedCountry)) {
        $whereQuery .= " AND (CountryID = ".$selectedCountry.") "; 
    }

    if(!empty($selectedRating)) {
        $whereQuery .= " AND (AverageRating >= ".$selectedRating.") "; 
    }
    
    $searchQuery = $basedSearchQuery.$whereQuery." LIMIT ". $start_from. ",". $limit; 

    $searchResult = $db_handle->runQuery($searchQuery);

    $paginationSearchQuery = $basedSearchQuery.$whereQuery;   
    $paginationSearchResult = $db_handle->numRows($paginationSearchQuery);

    $total_records = $paginationSearchResult;
    $total_pages = ceil($total_records / $limit);

?>

<!--search_page_notes-->
<div class="search_page_notes">
    <p class="small-heading-1 left_heading-2">Total <?php echo $total_records; ?> notes</p>
    <div class="row">
            
<?php
               
    if($searchResult != ""){ 

        foreach($searchResult as $value){
            
            $reportedNoteQuery = "SELECT NotesReportedIssuesID FROM notesreportedissues WHERE NoteDetailID = ".$value['NoteDetailID'];
        
            $reportedNoteResult = $db_handle->runQuery($reportedNoteQuery);
            
            $rateQuery ="SELECT COUNT(NotesReviewID) AS RatingCount FROM notesreviews 
            WHERE NoteDetailID = ".$value['NoteDetailID']; 
                            
            $rateResult = $db_handle->runQuery($rateQuery);
            
            $avgRating = (!empty($value['AverageRating']) && $value['AverageRating'] > 0) ? $value['AverageRating'] : 0;
            
            $ratingCnt = (!empty($rateResult[0]['RatingCount']) && $rateResult[0]['RatingCount'] > 0) ? $rateResult[0]['RatingCount'] : 0;
?>    
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 row_fix_bottom">
            <div class="single_note">
                <img src="
                    <?php 
                        echo             str_replace($_SERVER["DOCUMENT_ROOT"], $http_protocol.$_SERVER['HTTP_HOST'], $value['DisplayPicture']);
                    ?>" alt="note" class="note_img">

                <div class="search_page_notes_details">
                   <a href="<?php echo $http_protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/note_details.php?note_id=".$value['NoteDetailID']; ?>">
                   
                    <p class="common-heading-1 left_heading-1 fix_height"><?php echo $value['Title']; ?><span class="common-heading-1 left_heading-1 fix_height"><?php echo $value['CategoryName']; ?></span></p>
                    </a>
                    
                    <div class="merge_div_pad">
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/university.png" alt="university" class="note_details_icon">
                            </div>
                            <span class="val_content"><?php echo $value['UniversityName'].",".$value['CountryName']; ?></span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/pages.png" alt="book" class="note_details_icon">
                            </div>
                            <span class="val_content"><?php echo $value['NumberOfPages']; ?></span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/date.png" alt="date" class="note_details_icon">
                            </div>
                            <span class="val_content"><?php echo date('D, M d Y',strtotime($value['PublishedDate'])); ?></span>
                        </div>
                        <div class="merge">
                            <div class="merge_icon">
                                <img src="images/Search/flag.png" alt="flag" class="note_details_icon">
                            </div>
                            <span class="val_content red_text">
                            <?php 
                            if(!empty($reportedNoteResult)){
                            echo count($reportedNoteResult);}else{
                                echo "No ";
                            } ?> users marked this note as inappropriate.</span>
                        </div>
                        <div class="merge">                
                            <div id="noteDetailRating<?php echo $value['NoteDetailID']; ?>" start="<?php echo $avgRating ?>"></div>

                            <span class="val_content reviewMargin"><?php 
                            echo "&nbsp;&nbsp;&nbsp;".$ratingCnt; ?> reviews</span>
                        </div>
                        <script type="text/javascript">
                            $('#noteDetailRating<?php echo $value['NoteDetailID']; ?>').jsRapStar({
                                length: 5,
                                enabled: false,
                                starHeight: 24,
                                colorFront: '#deb217',
                                value: <?php echo $avgRating; ?>
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
<?php 
    }
?>
    </div>
    </div>
<?php
  //Pagination Start
    echo '<ul id="paging" class="pagination-filters">';
    echo '<li class="pagination"><a onclick="searchAnyNote('.($page-1).')" class="button">❮</a></li>';

    for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
        if($i==$page) { 
            echo 'class = "active"' ; 
        } echo 'onclick="searchAnyNote('.$i.')" >' .$i.'</a>
        </li>';
    }
    echo '<li class="pagination"><a onclick="searchAnyNote('.($page+1).')" class="button">❯</a></li>';
    echo '</ul>';
    //Pagination End
        
    } else {
        echo '<p class="verti_middle">No Records Found!!</p>';
    }
?>

