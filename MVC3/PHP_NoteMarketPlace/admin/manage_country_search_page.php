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

    $search_Str = (isset($_GET['search_country']) && !empty($_GET['search_country'])) ? $_GET['search_country'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." CO.CreatedDate DESC";

    $whereQuery = "";
    $paginationCountryQuery = "";

    $basedCountryQuery = "SELECT CO.CountryID,CO.CountryName,CO.PhoneCode,CO.CreatedDate,CO.IsActive,CONCAT(US.FirstName,' ',US.LastName) AS AddedByAdminName From countries CO
    INNER JOIN users US ON US.UserID = CO.CreatedBy
    WHERE 1 = 1";
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR CO.CountryName LIKE '%".$search_Str."%' OR CO.PhoneCode LIKE '%".$search_Str."%'  OR CO.CreatedDate LIKE '%".$search_Str."%' )"; 
    }

    $manageCountryQuery = $basedCountryQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit; 

    $manageCountryResult = $db_handle->runQuery($manageCountryQuery);

    //Pagination query
    $paginationCountryQuery = $basedCountryQuery.$whereQuery;

    $paginationCountryResult = $db_handle->numRows($paginationCountryQuery);

    $total_records = $paginationCountryResult;
    $total_pages = ceil($total_records / $limit);

    if($manageCountryResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thCountryName" sortOrder="CO.CountryName" class="allowSort" scope="col">COUNTRY NAME</th>
                                <th id="thCountryCode" sortOrder="CO.PhoneCode" class="allowSort" scope="col">COUNTRY CODE</th>
                                <th id="thAddedDate" sortOrder="CO.CreatedDate" class="allowSort" scope="col">DATE ADDED</th>
                                <th id="thAddedByAdminName" sortOrder="AddedByAdminName" class="allowSort" scope="col">ADDED BY</th>
                                <th scope="col">ACTIVE</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($manageCountryResult as $value) {
                            $sr_no++;
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo "<td>".$value['CountryName']."</td>";
                            echo "<td>".$value['PhoneCode']."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            echo "<td>".$value['AddedByAdminName']."</td>";
                            
                            if($value['IsActive'] == 1) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                            
                            echo '<td>
                            <a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/add_country.php?country_id='.$value["CountryID"].'" role="button">
                            <img src="images/Dashboard/edit.png " alt="edit" class="icon_space"></a>
                            
                            <a href="#" onclick="deactivateCountry('.$value["CountryID"].');">
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
        echo '<li class="pagination"><a onclick="searchCountry('.($page-1).')" class="button">❮</a></li>';

        $j = 0;
        for($i = max(1, $page-2); $i <= min($page + 4, $total_pages); $i++)
        { echo '<li class="pagination"><a ' ; 
            if($i==$page) { 
                echo 'class = "active"' ; 
            } echo 'onclick="searchCountry('.$i.')" >' .$i.'</a>
            </li>';
         $j++;
         if($j == 5) break;
        }
        echo '<li class="pagination"><a onclick="searchCountry('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnCountrySortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnCountrySortDir').val('ASC');
                $('#hdnCountrySortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnCountrySortDir').val('DESC');
                $('#hdnCountrySortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchCountry(1);
        });
    });
     
</script>
   
      