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

    $search_Str = (isset($_GET['search_admin_dashboard_note']) && !empty($_GET['search_admin_dashboard_note'])) ? $_GET['search_admin_dashboard_note'] : ""; 

    $search_Month = (isset($_GET['searchMonth']) && !empty($_GET['searchMonth'])) ? $_GET['searchMonth'] : "";

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." PublishedDate DESC";

    $separateMonthYear = explode('-', $search_Month);
    $numMonth = date('m', strtotime($separateMonthYear[0]));
    
    $whereQuery = "";
    $paginationDashboardQuery = "";

    $basedAdminDashboardQuery = "
    
    SELECT 
    *
    FROM
    (
    
    SELECT ND.NoteDetailID,ND.Title,NC.CategoryName,RD.Value,ND.SellingPrice,US.FirstName,US.LastName,ND.PublishedDate,ND.StatusID,
    
    (SELECT COUNT(DownloadNoteID) From downloadnotes 
        WHERE NoteDetailID = ND.NoteDetailID AND IsAttachmentDownloaded = 1 
    ) AS totalDownload
    
    FROM notedetails ND 
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    INNER JOIN users US ON ND.SellerID = US.UserID 
    INNER JOIN referencedata RD ON ND.SellingModeID = RD.DataValue AND RD.ReferenceCategory = 'SellingMode' 
    ) AS T
    WHERE StatusID = ".$publishedID;
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( Title LIKE '%".$search_Str."%' OR CategoryName LIKE '%".$search_Str."%' OR SellingPrice LIKE '%".$search_Str."%' OR Value LIKE '%".$search_Str."%' OR FirstName LIKE '%".$search_Str."%' OR PublishedDate LIKE '%".$search_Str."%' OR totalDownload LIKE '%".$search_Str."%' )"; 
    }

    //Search month query with dropdown
    if(!empty($search_Month)) {
        $whereQuery = " AND ( MONTH(PublishedDate) = ".$numMonth." AND  YEAR(PublishedDate) = ".$separateMonthYear[1]." )";
    }

    $adminDashboardQuery = $basedAdminDashboardQuery.$whereQuery.$orderBy." LIMIT " .$start_from. ",".$limit;

    $adminDashboardResult = $db_handle->runQuery($adminDashboardQuery);

    //Pagination Query
    $paginationDashboardQuery = $basedAdminDashboardQuery.$whereQuery;
    $paginationDashboardResult = $db_handle->numRows($paginationDashboardQuery);

    $total_records = $paginationDashboardResult;
    $total_pages = ceil($total_records / $limit);

    if($adminDashboardResult != ""){
        echo '<div class="data_table">
                <div class="table-responsive">
                    <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_table text-center second_col_pur ninth_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thNoteTitle" sortOrder="Title" class="allowSort" scope="col">TITLE</th>
                                <th id="thCategory" sortOrder="CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th scope="col">ATTACHMENT SIZE</th>
                                <th id="thSellType" sortOrder="Value" class="allowSort" scope="col">SELL TYPE</th>
                                <th id="thPrice" sortOrder="SellingPrice" class="allowSort" scope="col">PRICE</th>
                                <th id="thPublisher" sortOrder="FirstName" class="allowSort" scope="col">PUBLISHER</th>
                                <th id="thPublishedDate" sortOrder="PublishedDate" class="allowSort" scope="col">PUBLISHED DATE</th>
                                <th id="thDownloadNote" sortOrder="totalDownload" class="allowSort" scope="col" class="table_head_fix_width">NUMBER OF DOWNLOADS</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($adminDashboardResult as $value) {
                            $sr_no++;

                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo '<td><a href=';
                            echo $http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'>'.$value['Title'].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>10 KB</td>";
                            echo "<td>".$value['Value']."</td>";
                            echo "<td>".$value['SellingPrice']."</td>";
                            echo "<td>".$value['FirstName']." ".$value['LastName']."</td>";
                            
                            if(!empty($value['PublishedDate'])) {
                                echo "<td>".date('d M Y h:i:s',strtotime($value['PublishedDate']))."</td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/downloaded_notes.php?note_id='.$value["NoteDetailID"].'">'.$value['totalDownload'].'</a></td>';
                            
                            echo '<td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        
                                        <a class="dropdown-item" href="#" onclick="downloadAdminNoteFromTable(0,'.$value["NoteDetailID"].');">Download Notes</a>
                                            
                                        <a class="dropdown-item" href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">View More Details</a>
                                            
                                        <a class="dropdown-item" href="#" onclick="unPublishNote('.$value["NoteDetailID"].",'".$value['Title'].'\');">Unpublish</a>
                                            
                                    </div>
                                </td>';
                        echo "</tr>";
                        }
                        echo "</tbody>
                        </table>
                    </div>
                </div>";

            //Pagination Start
            echo '<ul id="paging" class="pagination-filters">';
            echo '<li class="pagination"><a onclick="searchAdminDashboard('.($page-1).')" class="button">❮</a></li>';

            $j = 0;
            for($i = max(1, $page-2); $i <= min($page + 4, $total_pages); $i++) { 
                echo '<li class="pagination"><a ' ; 
                if($i==$page) { 
                    echo 'class = "active"' ; 
                } echo 'onclick="searchAdminDashboard('.$i.')" >' .$i.'</a>
                </li>';
                $j++;
                if($j == 5) break;
            }
            echo '<li class="pagination"><a onclick="searchAdminDashboard('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnAdminDashboardSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnAdminDashboardSortDir').val('ASC');
                $('#hdnAdminDashboardSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnAdminDashboardSortDir').val('DESC');
                $('#hdnAdminDashboardSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchAdminDashboard(1);
        });
    });
</script>        

   
                    
                    
      