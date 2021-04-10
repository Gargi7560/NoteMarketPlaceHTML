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

    $search_Str = (isset($_GET['search_admin_category']) && !empty($_GET['search_admin_category'])) ? $_GET['search_admin_category'] : ""; 

    $orderBy = " ORDER BY ";
    
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." NC.CreatedDate DESC";

    $whereQuery = "";
    $paginationCategoryQuery = "";

    $basedAdminCategoryQuery = "SELECT NC.NoteCategoryID,NC.CategoryName,NC.Description,NC.CreatedDate,NC.IsActive,CONCAT(US.FirstName,' ',US.LastName) AS AddedByAdminName From notecategories NC
    INNER JOIN users US ON US.UserID = NC.CreatedBy
    WHERE 1 = 1";
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' OR NC.Description LIKE '%".$search_Str."%'  OR NC.CreatedDate LIKE '%".$search_Str."%' )"; 
    }

    $manageCategoryQuery = $basedAdminCategoryQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit; 

    $manageCategoryResult = $db_handle->runQuery($manageCategoryQuery);

    //Pagination Query
    $paginationCategoryQuery = $basedAdminCategoryQuery.$whereQuery; 

    $paginationCategoryResult = $db_handle->numRows($paginationCategoryQuery);

    $total_records = $paginationCategoryResult;
    $total_pages = ceil($total_records / $limit);

    if($manageCategoryResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thCategoryName" sortOrder="NC.CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thCategoryDescription" sortOrder="NC.Description" class="allowSort" scope="col">DESCRIPTION</th>
                                <th id="thAddedDate" sortOrder="NC.CreatedDate" class="allowSort" scope="col">DATE ADDED</th>
                                <th id="thAddedByAdminName" sortOrder="AddedByAdminName" class="allowSort" scope="col">ADDED BY</th>
                                <th scope="col">ACTIVE</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($manageCategoryResult as $value) {
                            $sr_no++;
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".$value['Description']."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            echo "<td>".$value['AddedByAdminName']."</td>";
                            
                            if($value['IsActive'] == 1) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                            
                            echo '<td>
                            <a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/add_category.php?category_id='.$value["NoteCategoryID"].'" role="button">
                            <img src="images/Dashboard/edit.png " alt="edit" class="icon_space"></a>
                            
                            <a href="#" onclick="deactivateCategory('.$value["NoteCategoryID"].');">
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
        echo '<li class="pagination"><a onclick="searchManageCategory('.($page-1).')" class="button">❮</a></li>';

        for ($i=1; $i<=$total_pages; $i++) { 
            echo '<li class="pagination"><a ' ; 
            if($i==$page) { 
                echo 'class = "active"' ; 
            } echo 'onclick="searchManageCategory('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="searchManageCategory('.($page+1).')" class="button">❯</a></li>';
        echo '</ul>';
        //Pagination End
    } else {
        echo '<div class="data_table text-center">No Records Found!!</div>';
    }
    
?>

<!--Sorting for columns-->
<script type="text/javascript">
    $(document).ready(function() {
        $("th.allowSort").click(function() {
            var isAsc = true;
            if($(this).hasClass('ascending')) {
                isAsc = false;
            }
            
            $('#hdnCategorySortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnCategorySortDir').val('ASC');
                $('#hdnCategorySortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnCategorySortDir').val('DESC');
                $('#hdnCategorySortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchManageCategory(1);
        });
    });
     
</script>
   

   
         