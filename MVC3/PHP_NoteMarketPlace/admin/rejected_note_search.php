<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $limit = 5;

    $page = (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page']) > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit;

    $sr_no = $start_from;

    $search_Str = (isset($_GET['search_rejected_note']) && !empty($_GET['search_rejected_note'])) ? $_GET['search_rejected_note'] : ""; 

    $searchBySeller = (isset($_GET['searchBySeller']) && !empty($_GET['searchBySeller'])) ? $_GET['searchBySeller'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." ND.ModifiedDate DESC";

    $whereQuery = "";
    $paginationPublishedNoteQuery = "";

    $basedRejectedNoteQuery = "SELECT ND.NoteDetailID,ND.Title,NC.CategoryName,CONCAT(US.FirstName,' ',US.LastName) AS SellerName,ND.ModifiedDate,US.UserID,CONCAT(UP.FirstName,' ',UP.LastName) AS RejectedByName,ND.ActionByID,ND.AdminRemarks FROM notedetails ND
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    INNER JOIN users US ON ND.SellerID = US.UserID
    INNER JOIN users UP ON ND.ActionByID = UP.UserID
    WHERE ND.IsActive = 1 AND ND.StatusID = ".$rejectedID;

    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( ND.Title LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' OR US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR UP.FirstName LIKE '%".$search_Str."%' OR UP.LastName LIKE '%".$search_Str."%' OR ND.ModifiedDate LIKE '%".$search_Str."%' )";
    }

    //Seller search query
    if(!empty($searchBySeller)) {
        $whereQuery = " AND US.UserID = ".$searchBySeller;
    }

    $rejectedNoteQuery = $basedRejectedNoteQuery.$whereQuery.$orderBy." LIMIT ".$start_from. ",". $limit;

    $rejectedNoteResult = $db_handle->runQuery($rejectedNoteQuery);

    //Pagination query
    $paginationRejectedNoteQuery = $basedRejectedNoteQuery.$whereQuery;

    $paginationRejectedNoteResult = $db_handle->numRows($paginationRejectedNoteQuery);

    $total_records = $paginationRejectedNoteResult;
    $total_pages = ceil($total_records / $limit);

    if($rejectedNoteResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                    <table class="table fix_width_big_table text-center second_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thNoteTitle" sortOrder="ND.Title" class="allowSort" scope="col">NOTE TITLE</th>
                                <th id="thCategory" sortOrder="NC.CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thSellerName" sortOrder="SellerName" class="allowSort" scope="col">SELLER</th>
                                <th scope="col"></th>
                                <th id="thEditedDate" sortOrder="ND.ModifiedDate" class="allowSort" scope="col">DATE ADDED</th>
                                <th id="thRejectedByName" sortOrder="RejectedByName" class="allowSort" scope="col">REJECTED BY</th>
                                <th id="thAdminRemarks" sortOrder="AdminRemarks" class="allowSort" scope="col">REMARK</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($rejectedNoteResult as $value) {
                            $sr_no++;
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">'.$value["Title"].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".$value['SellerName']."</td>";
                            
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/member_details.php?user_id='.$value["UserID"].'"><img src="images/Dashboard/eye.png" alt="view" class="icon_space"></a></td>';
                            
                            echo "<td>".date('d M Y h:i:s',strtotime($value['ModifiedDate']))."</td>";
                            echo "<td>".$value['RejectedByName']."</td>";
                            echo "<td>".$value['AdminRemarks']."</td>";
                            echo '<td class="dropdown">
                            
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="confirmation" class="icon_space"></a> 
                            
                            <div class="dropdown-menu">
                            
                            <a class="dropdown-item" href="#" onclick="noteApprove('.$value["NoteDetailID"].');">Approve</a>
                            
                            <a class="dropdown-item" href="#" onclick="downloadAdminNoteFromTable(0,'.$value["NoteDetailID"].');">Download Notes</a>
                            
                            <a class="dropdown-item" href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">View More Details</a>
                            
                            </div>
                            
                            </td>';
                            echo "</tr>";
                        }
                        echo '</tbody>
                        </table>
                    </div>
                </div>';
        
        //pagination Start
        echo '<ul id="paging" class="pagination-filters">';
        echo '<li class="pagination"><a onclick="searchRejectedNote('.($page-1).')" class="button">❮</a></li>';
        
        for($i=1; $i<=$total_pages; $i++) {
            echo '<li class="pagination"><a ';
            if($i==$page) {
                echo 'class = "active"' ;
            } echo 'onclick="searchRejectedNote('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="searchRejectedNote('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnRejectedNoteSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnRejectedNoteSortDir').val('ASC');
                $('#hdnRejectedNoteSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnRejectedNoteSortDir').val('DESC');
                $('#hdnRejectedNoteSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchRejectedNote(1);
        });
    });
     
</script>