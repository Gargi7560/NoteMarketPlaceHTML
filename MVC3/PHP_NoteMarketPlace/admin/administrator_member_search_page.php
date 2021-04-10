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

    $search_Str = (isset($_GET['search_admin_member']) && !empty($_GET['search_admin_member'])) ? $_GET['search_admin_member'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." US.CreatedDate DESC";

    $whereQuery = "";
    $paginationAdminMemberQuery = "";

    $basedAdminMemberQuery = "SELECT US.UserID,US.FirstName,US.LastName,US.Email,US.CreatedDate,US.IsActive,UP.PhoneNumber From users US
    INNER JOIN userprofiledetails UP ON US.UserID = UP.UserID
    WHERE US.UserRoleID = ".$adminUserRoleID;
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR US.Email LIKE '%".$search_Str."%' OR UP.PhoneNumber LIKE '%".$search_Str."%'  OR US.CreatedDate LIKE '%".$search_Str."%' )"; 
    }

    $administratorMemberQuery = $basedAdminMemberQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit; 

    $administratorMemberResult = $db_handle->runQuery($administratorMemberQuery);

    //Pagination Query
    $paginationAdminMemberQuery = $basedAdminMemberQuery.$whereQuery;  
    $paginationAdminMemberResult = $db_handle->numRows($paginationAdminMemberQuery);

    $total_records = $paginationAdminMemberResult;
    $total_pages = ceil($total_records / $limit);

    if($administratorMemberResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thFirstName" sortOrder="US.FirstName" class="allowSort" scope="col">FIRST NAME</th>
                                <th id="thLastName" sortOrder="US.LastName" class="allowSort" scope="col">LAST NAME</th>
                                <th id="thEmail" sortOrder="US.Email" class="allowSort" scope="col">EMAIL</th>
                                <th id="thPhoneNo" sortOrder="UP.PhoneNumber" class="allowSort" scope="col">PHONE NO.</th>
                                <th id="thJoiningDate" sortOrder="US.CreatedDate" class="allowSort scope="col">DATE ADDED</th>
                                <th scope="col">ACTIVE</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($administratorMemberResult as $value) {
                            $sr_no++;
                            
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo "<td>".$value['FirstName']."</td>";
                            echo "<td>".$value['LastName']."</td>";
                            echo "<td>".$value['Email']."</td>";
                            echo "<td>".$value['PhoneNumber']."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            
                            if($value['IsActive'] == 1) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                            
                            echo '<td>
                            <a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/add_administrator.php?user_id='.$value["UserID"].'" role="button">
                            <img src="images/Dashboard/edit.png " alt="edit" class="icon_space"></a>
                            
                            <a href="#" onclick="deactivateAdminUser('.$value["UserID"].');">
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
        echo '<li class="pagination"><a onclick="searchAdminMember('.($page-1).')" class="button">❮</a></li>';

        for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
            if($i==$page) { 
                echo 'class = "active"' ; 
            } echo 'onclick="searchAdminMember('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="searchAdminMember('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnManageAdminSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnManageAdminSortDir').val('ASC');
                $('#hdnManageAdminSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnManageAdminSortDir').val('DESC');
                $('#hdnManageAdminSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchAdminMember(1);
        });
    });
     
</script>