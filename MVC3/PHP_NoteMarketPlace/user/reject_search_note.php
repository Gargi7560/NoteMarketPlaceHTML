<?php
    
    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $limitDownload = 10;
    $sr_no = 1;
    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limitDownload; 

    $search_Str = (isset($_GET['search_reject_note']) && !empty($_GET['search_reject_note'])) ? $_GET['search_reject_note'] : ""; 

    $orderBy = " ORDER BY ";

    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." ND.ModifiedDate DESC";
	
    $whereQuery = "";
    $paginationRejectQuery = "";

    $basedRejectQuery = "SELECT ND.NoteDetailID,ND.Title,NC.CategoryName,ND.AdminRemarks,ND.ModifiedDate FROM notedetails ND 
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID 
    INNER JOIN users US ON ND.SellerID = US.UserID 
    WHERE ND.StatusID = ".$rejectedID." AND ND.SellerID = ".$_SESSION['user_id'];
    
    if(!empty($search_Str)) {
        $whereQuery = " AND ( ND.Title LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' )"; 
    }
    
    $rejectQuery = $basedRejectQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limitDownload; 
    $rejectResult = $db_handle->runQuery($rejectQuery);

    $paginationRejectQuery = $basedRejectQuery.$whereQuery;   
    $paginationRejectResult = $db_handle->numRows($paginationRejectQuery);

    $total_records = $paginationRejectResult;
    $total_pages = ceil($total_records / $limitDownload);
          
    if($rejectResult != ""){
        echo '<div class="data_table">
            <div class="table-responsive">
            <input type="hidden" id="hdnSortColumn" />
                <table class="table fix_width_table second_col_pur six_col_pur">
                    <thead>
                        <tr>
                            <th scope="col">SR NO.</th>
                            <th id="thNoteTitle" sortOrder="ND.Title" scope="col" class="allowSort">NOTE TITLE</th>
                            <th id="thCategory" sortOrder="NC.CategoryName" scope="col" class="allowSort">CATEGORY</th>
                            <th id="thRemark" sortOrder="ND.AdminRemarks" scope="col" class="allowSort">REMARK</th>
                            <th id="thDownloadDt" sortOrder="ND.ModifiedDate" scope="col" class="allowSort">DATE EDITED</th>
                            <th scope="col">CLONE TYPE</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($rejectResult as $value) {
                        echo "<tr>";
                        echo "<td>".$sr_no."</td>";
                        echo '<td><a href=';
                        echo $http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/note_details.php?note_id='.$value["NoteDetailID"];
                        echo '>'.$value["Title"].'</a></td>';
                        echo "<td>".$value['CategoryName']."</td>";
                        echo "<td>".$value['AdminRemarks']."</td>";
                        if(!empty($value['ModifiedDate'])){
                            echo "<td>".date('d M Y h:i:s',strtotime($value['ModifiedDate']))."</td>";
                        }else{
                            echo "<td></td>";
                        }
                        echo '<td><a href="#">Clone</a></td>';
                        echo '<td><a href='; 
                        echo $http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/note_details.php?note_id='.$value["NoteDetailID"]; 
                        echo '><img src="images/Dashboard/eye.png" alt="view" class="icon_space"></a></td>';
                        
                        echo '<td class="dropdown"><a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="confirmation" class="icon_space"></a>
                        <div class="dropdown-menu">                 <a class="dropdown-item" href="#" onclick="downloadNoteFromTable(0,';
                        echo $value["NoteDetailID"];
                        echo ')">Download Notes</a></div></td>';
                        echo "</tr>";
                        $sr_no++;
                    }          
                    echo '</tbody>
                    </table>
                </div>
            </div>';
        
    //Pagination Start
    echo '<ul id="paging" class="pagination-filters">';
    echo '<li class="pagination"><a onclick="searchNoteReject('.($page-1).')" class="button">❮</a></li>';

    for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
        if($i==$page) { 
            echo 'class = "active"' ; 
        } echo 'onclick="searchNoteReject('.$i.')" >' .$i.'</a>
        </li>';
    }
    echo '<li class="pagination"><a onclick="searchNoteReject('.($page+1).')" class="button">❯</a></li>';
    echo '</ul>';
    //Pagination End
        
    } else {
        echo '<div class="data_table">No Records Found!!</div>';
    }
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("th.allowSort").click(function() {
            var isAsc = true;
            if($(this).hasClass('ascending')) {
                isAsc = false;
            }
            
            $('#hdnRejectSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnRejectSortDir').val('ASC');
                $('#hdnRejectSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnRejectSortDir').val('DESC');
                $('#hdnRejectSortOrder').val($(this).attr('sortOrder') + " DESC ");
            }
            searchNoteReject(1);
       }); 
    });
</script>
            