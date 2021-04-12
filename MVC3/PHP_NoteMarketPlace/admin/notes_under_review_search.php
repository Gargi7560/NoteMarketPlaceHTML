<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $limit = 5;

    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit; 

    $sr_no = $start_from;

    $search_Str = (isset($_GET['search_under_review_note']) && !empty($_GET['search_under_review_note'])) ? $_GET['search_under_review_note'] : ""; 

    $searchBySeller = (isset($_GET['searchBySeller']) && !empty($_GET['searchBySeller'])) ? $_GET['searchBySeller'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." ND.CreatedDate DESC";

    $whereQuery = "";
    $paginationNoteUnderReviewQuery = "";

    $basedNoteUnderReviewQuery = "SELECT ND.NoteDetailID,ND.Title,NC.CategoryName,CONCAT(US.FirstName,' ',US.LastName) AS SellerName,ND.CreatedDate,RD.Value,US.UserID FROM notedetails ND
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    INNER JOIN users US ON ND.SellerID = US.UserID
    INNER JOIN referencedata RD ON ND.StatusID = RD.DataValue AND RD.ReferenceCategory = 'NoteStatus'
    WHERE ND.IsActive = 1 AND ND.StatusID IN (".$submittedForReviewID.",".$inReviewID.") ";

    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( ND.Title LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' OR US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR RD.Value LIKE '%".$search_Str."%' OR ND.CreatedDate LIKE '%".$search_Str."%' )"; 
    }

    //Seller search query
    if(!empty($searchBySeller)) {
        $whereQuery = " AND US.UserID = ".$searchBySeller;
    }

    $noteUnderReviewQuery = $basedNoteUnderReviewQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit; 


    $basedNoteUnderReviewResult = $db_handle->runQuery($noteUnderReviewQuery);

    //Pagination query
    $paginationNoteUnderReviewQuery = $basedNoteUnderReviewQuery.$whereQuery;  

    $paginationNoteUnderReviewResult = $db_handle->numRows($paginationNoteUnderReviewQuery);

    $total_records = $paginationNoteUnderReviewResult;
    $total_pages = ceil($total_records / $limit);

    if($basedNoteUnderReviewResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                   <table class="table fix_width_table text-center second_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thNoteTitle" sortOrder="ND.Title" class="allowSort" scope="col">NOTE TITLE</th>
                                <th id="thCategory" sortOrder="NC.CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thSellerName" sortOrder="SellerName" class="allowSort" scope="col">SELLER</th>
                                <th scope="col"></th>
                                <th id="thDateAdded" sortOrder="ND.CreatedDate" class="allowSort" scope="col">DATE ADDED</th>
                                <th id="thStatus" sortOrder="RD.Value" class="allowSort" scope="col">STATUS</th>
                                <th class="fix_three_btn_field_width" scope="col">ACTION</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($basedNoteUnderReviewResult as $value) {
                            $sr_no++;
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">'.$value["Title"].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".$value['SellerName']."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/member_details.php?user_id='.$value["UserID"].'"><img src="images/Dashboard/eye.png" alt="view" class="icon_space"></a></td>';
                            echo "<td>".date('d M Y h:i:s',strtotime($value['CreatedDate']))."</td>";
                            echo "<td>".$value['Value']."</td>";
                            echo '<td>
                            
                            <button type="button" class="btn btn-outline-primary btn-review btn-green" onclick="noteApprove('.$value["NoteDetailID"].');">Approve</button>
                            
                            <button type="button" class="btn btn-outline-primary btn-review btn-red" onclick="rejectNote('.$value["NoteDetailID"].',\''.$value["Title"].'\');">Reject</button>
                            
                            <button type="button" class="btn btn-outline-primary btn-review btn-grey" onclick="noteInReview('.$value["NoteDetailID"].');">InReview</button>
                            
                            </td>';
                            echo '<td class="dropdown">
                            
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="confirmation" class="icon_space"></a>     
                            
                            <div class="dropdown-menu">
                            
                            <a class="dropdown-item" href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">View More Details</a>
                            
                            <a class="dropdown-item" href="#" onclick="downloadAdminNoteFromTable(0,'.$value["NoteDetailID"].');">Download Notes</a>
                            
                            </div>
                            
                            </td>';
                            echo "</tr>";
                        }    
                        echo '</tbody>
                        </table>
                    </div>
                </div>';
        //Pagination Start
        echo '<ul id="paging" class="pagination-filters">';
        echo '<li class="pagination"><a onclick="searchNoteUnderReview('.($page-1).')" class="button">❮</a></li>';

        $j = 0;
        for($i = max(1, $page-2); $i <= min($page + 4, $total_pages); $i++)
        { echo '<li class="pagination"><a ' ; 
            if($i==$page) { 
                echo 'class = "active"' ; 
            } echo 'onclick="searchNoteUnderReview('.$i.')" >' .$i.'</a>
            </li>';
        $j++;
        if($j == 5) break;
        }
        echo '<li class="pagination"><a onclick="searchNoteUnderReview('.($page+1).')" class="button">❯</a></li>';
        echo '</ul>';
        //Pagination End
    } else {
        echo '<div class="data_table text-center">No Records Found!!</div>';
    }
?>

<!--Sorting columns-->
<script type="text/javascript">
    $(document).ready(function() {
        $("th.allowSort").click(function() {
            var isAsc = true;
            if($(this).hasClass('ascending')) {
                isAsc = false;
            }
            
            $('#hdnNoteUnderReviewSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnNoteUnderReviewSortDir').val('ASC');
                $('#hdnNoteUnderReviewSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnNoteUnderReviewSortDir').val('DESC');
                $('#hdnNoteUnderReviewSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchNoteUnderReview(1);
        });
    });
     
</script>                            