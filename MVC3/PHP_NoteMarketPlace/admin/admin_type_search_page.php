<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $limit = 5;

    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit; 

    $sr_no = $start_from;

    $search_Str = (isset($_GET['search_admin_type']) && !empty($_GET['search_admin_type'])) ? $_GET['search_admin_type'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." NT.CreatedDate DESC";

    $whereQuery = "";
    $paginationTypeQuery = "";

    $basedAdminTypeQuery = "SELECT NT.NoteTypeID,NT.TypeName,NT.Description,NT.CreatedDate,NT.IsActive,CONCAT(US.FirstName,' ',US.LastName) AS AddedByAdminName From notetypes NT
    INNER JOIN users US ON US.UserID = NT.CreatedBy
    WHERE 1 = 1";
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR NT.TypeName LIKE '%".$search_Str."%' OR NT.Description LIKE '%".$search_Str."%'  OR NT.CreatedDate LIKE '%".$search_Str."%' )"; 
    }

    $manageTypeQuery = $basedAdminTypeQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit; 

    $manageTypeResult = $db_handle->runQuery($manageTypeQuery);

    //Pagination Query
    $paginationTypeQuery = $basedAdminTypeQuery.$whereQuery; 

    $paginationTypeResult = $db_handle->numRows($paginationTypeQuery);

    $total_records = $paginationTypeResult;
    $total_pages = ceil($total_records / $limit);

    if($manageTypeResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thTypeName" sortOrder="NT.TypeName" class="allowSort" scope="col">TYPE</th>
                                <th id="thTypeDescription" sortOrder="NT.Description" class="allowSort" scope="col">DESCRIPTION</th>
                                <th id="thAddedDate" sortOrder="NT.CreatedDate" class="allowSort" scope="col">DATE ADDED</th>
                                <th id="thAddedByAdminName" sortOrder="AddedByAdminName" class="allowSort" scope="col">ADDED BY</th>
                                <th scope="col">ACTIVE</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($manageTypeResult as $value){
                            $sr_no++;
                            
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo "<td>".$value['TypeName']."</td>";
                            echo "<td>".$value['Description']."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            echo "<td>".$value['AddedByAdminName']."</td>";
                            
                            if($value['IsActive'] == 1) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                            
                            echo '<td>
                            <a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/add_type.php?type_id='.$value["NoteTypeID"].'" role="button">
                            <img src="images/Dashboard/edit.png " alt="edit" class="icon_space"></a>
                            
                            <a href="#" onclick="deactivateType('.$value["NoteTypeID"].');">
                            <img src="images/Dashboard/delete.png" alt="delete"></a>
                            </td>
                        </tr>';
                        }
                        echo '</tbody>
                            </table>
                        </div>
                    </div>';
        
        //Pagination Start
        echo '<ul id="paging" class="pagination-filters">';
        echo '<li class="pagination"><a onclick="searchManageType('.($page-1).')" class="button">❮</a></li>';

        for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
            if($i==$page) { 
                echo 'class = "active"' ; 
            } echo 'onclick="searchManageType('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="searchManageType('.($page+1).')" class="button">❯</a></li>';
        echo '</ul>';
        //Pagination End
    } else {
        echo '<div class="data_table">No Records Found!!</div>';
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
            
            $('#hdnTypeSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnTypeSortDir').val('ASC');
                $('#hdnTypeSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnTypeSortDir').val('DESC');
                $('#hdnTypeSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchManageType(1);
        });
    });
     
</script>