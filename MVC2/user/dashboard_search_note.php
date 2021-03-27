<?php
    session_start();

    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();

    $limit = 5;
    
    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit; 
    
    $search_Str = (isset($_GET['search_note']) && !empty($_GET['search_note'])) ? $_GET['search_note'] : ""; 
	
    $search_Status = (isset($_GET['status']) && !empty($_GET['status'])) ? $_GET['status'] : 1; 
    
    $orderBy = " ORDER BY ";

    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." ND.CreatedDate DESC";
    
    $whereQuery = "";
    $paginationQuery = "";

    $baseQuery = "SELECT ND.NoteDetailID,ND.CreatedDate,ND.Title,ND.CategoryID,ND.StatusID,NC.CategoryName,RD.Value FROM notedetails ND 
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID 
    INNER JOIN referencedata RD ON ND.StatusID = RD.DataValue AND RD.ReferenceCategory = 'NoteStatus' WHERE ND.IsActive = 1 AND SellerID = ".$_SESSION['user_id'];

    if($search_Status == 1) {
        $whereQuery = " AND ND.StatusID IN (".$draftID.",".$submittedForReviewID.",".$inReviewID.") ";
    } else {
        $whereQuery = " AND ND.StatusID = ".$publishedID;
    }                      
    if(!empty($search_Str)) {
        $whereQuery = $whereQuery." AND ( ND.Title LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' OR RD.Value LIKE '%".$search_Str."%' )"; 
    }
    
    $dashboardQuery = $baseQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit;                   
    $dashboardResult = $db_handle->runQuery($dashboardQuery);
     
    $paginationQuery = $baseQuery.$whereQuery;                    
    $paginationResult = $db_handle->numRows($paginationQuery);
    
    $total_records = $paginationResult;                    
    $total_pages = ceil($total_records / $limit);
?>

<?php
    if($dashboardResult != "") {

    echo '<div class="data_table">
        <div class="table-responsive">
        <input type="hidden" id="hdnSortColumn" />
            <table id="dbTbl_'.$search_Status.'" class="table fix_width_table">
                <thead>
                    <tr>
                        <th id="thAddedDate"  sortOrder="ND.CreatedDate" class="allowSort" scope="col">ADDED DATE</th>
                        <th id="thTitle" sortOrder="ND.Title" class="allowSort" scope="col">TITLE</th>
                        <th id="thCategory" sortOrder="NC.CategoryName" class="allowSort" scope="col">CATEGORY</th>
                        <th id="thStatus" sortOrder="RD.Value" class="allowSort" scope="col">STATUS</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>';
                       
    foreach($dashboardResult as $value) {
    
    echo "<tr>";
    echo "<td>".$value['CreatedDate']."</td>";
    echo "<td>".$value['Title']."</td>";
    echo "<td>".$value['CategoryName']."</td>";
    echo "<td>".$value['Value']."</td>";
    
        if($value['StatusID'] == $draftID){
            echo '<td>
            <a href="http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/add_notes.php?note_id='. $value['NoteDetailID']
                .'"><img src="images/Dashboard/edit.png" alt="edit" class="icon_space"></a>
            <a onclick="deleteNote('.$value['NoteDetailID'].')"><img src="images/Dashboard/delete.png" alt="delete"></a>
             </td>';
        } else if($value['StatusID'] == $submittedForReviewID) {
            echo '<td>
            <img src="images/Dashboard/eye.png" alt="view" class="icon_space">
             </td>';
        } else if($value['StatusID'] == $inReviewID) {
            echo '<td>
            <img src="images/Dashboard/eye.png" alt="view" class="icon_space">
             </td>';
        } else if($value['StatusID'] == $publishedID) {
            echo '<td>
            <img src="images/Dashboard/eye.png" alt="view" class="icon_space">
             </td>';
        } 
        
        echo "</tr>";  
    }
                            
                echo '</tbody>
            </table>
        </div>
    </div>';

    //Pagination Start
    
    echo '<ul id="paging" class="pagination-filters">'; 
    
    echo '<li class="pagination"><a onclick="searchNoteForDashboard('.($page-1).','.$search_Status.')" class="button">❮</a></li>';

    for ($i=1; $i<=$total_pages; $i++) {
        echo '<li class="pagination"><a ';
        if($i == $page) {
            echo 'class = "active"';
        }
        echo' onclick="searchNoteForDashboard('.$i.','.$search_Status.')" >'.$i.'</a></li>';	                    
    }
        echo '<li class="pagination"><a onclick="searchNoteForDashboard('.($page+1).','.$search_Status.')" 
        class="button">❯</a></li>';
    echo '</ul>';
    //Pagination End
} else {
    echo '<div class="data_table verti_middle">No Records Found!!</div>';
}
?>
<script type="text/javascript">
    $(document).ready(function() {

        $("#dbTbl_<?php echo $search_Status." ";
          ?>th.allowSort").click(function() {
            var isAsc = true;
            if ($(this).hasClass('ascending')) {
                isAsc = false;
            }

            <?php if ($search_Status == 1){ ?>

                $('#hdnProgressSortColumn').val($(this).attr('id'));
                if (isAsc) {
                    $('#hdnProgressSortDir').val('ASC');
                    $('#hdnProgressSortOrder').val($(this).attr('sortOrder') + " ASC ");
                } else {
                    $('#hdnProgressSortDir').val('DESC');
                    $('#hdnProgressSortOrder').val($(this).attr('sortOrder') + " DESC ");
                }
                searchNoteForDashboard(1, <?php echo $search_Status;?>);
            <?php } else { ?> 

                $('#hdnPublishedSortColumn').val($(this).attr('id'));
                if (isAsc) {
                    $('#hdnPublishedSortDir').val('ASC');
                    $('#hdnPublishedSortOrder').val($(this).attr('sortOrder') + " ASC ");
                } else {
                    $('#hdnPublishedSortDir').val('DESC');
                    $('#hdnPublishedSortOrder').val($(this).attr('sortOrder') + " DESC ");
                }
                searchNoteForDashboard(1, <?php echo $search_Status;?>);
            <?php } ?>
        });
    });
</script>