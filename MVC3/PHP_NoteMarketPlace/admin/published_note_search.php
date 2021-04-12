<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $limit = 5;

    $page = (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page']) > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit;

    $sr_no = $start_from;

    $search_Str = (isset($_GET['search_published_note']) && !empty($_GET['search_published_note'])) ? $_GET['search_published_note'] : ""; 

    $searchBySeller = (isset($_GET['searchBySeller']) && !empty($_GET['searchBySeller'])) ? $_GET['searchBySeller'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." PublishedDate DESC";

    $whereQuery = "";
    $paginationPublishedNoteQuery = "";

    $basedPublishedNoteQuery = "
    
    SELECT
    * 
    FROM
    (
    
    SELECT ND.NoteDetailID,ND.Title,NC.CategoryName,ND.IsActive,ND.StatusID,CONCAT(US.FirstName,' ',US.LastName) AS SellerName,ND.CreatedDate,RD.Value,US.UserID,ND.SellingPrice,ND.PublishedDate,CONCAT(UP.FirstName,' ',UP.LastName) AS ApprovedByName, 
    
    (SELECT COUNT(DownloadNoteID) From downloadnotes 
        WHERE NoteDetailID = ND.NoteDetailID AND IsAttachmentDownloaded = 1 
    ) AS totalDownload 
    
    FROM notedetails ND
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    INNER JOIN users US ON ND.SellerID = US.UserID
    INNER JOIN users UP ON ND.ActionByID = UP.UserID
    INNER JOIN referencedata RD ON ND.SellingModeID = RD.DataValue AND RD.ReferenceCategory = 'SellingMode'
    ) AS T
    WHERE IsActive = 1 AND StatusID = ".$publishedID;

    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( Title LIKE '%".$search_Str."%' OR CategoryName LIKE '%".$search_Str."%' OR SellerName LIKE '%".$search_Str."%' OR Value LIKE '%".$search_Str."%' OR PublishedDate LIKE '%".$search_Str."%' OR ApprovedByName LIKE '%".$search_Str."%' )";
    }

    //Seller search query
    if(!empty($searchBySeller)) {
        $whereQuery = " AND UserID = ".$searchBySeller;
    }

    $publishedNoteQuery = $basedPublishedNoteQuery.$whereQuery.$orderBy." LIMIT ".$start_from. ",". $limit;

    $publishedNoteResult = $db_handle->runQuery($publishedNoteQuery);

    //Pagination Query
    $paginationPublishedNoteQuery = $basedPublishedNoteQuery.$whereQuery;

    $paginationPublishedNoteResult = $db_handle->numRows($paginationPublishedNoteQuery);

    $total_records = $paginationPublishedNoteResult;
    $total_pages = ceil($total_records / $limit);

    if($publishedNoteResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_big_table text-center tenth_col_pur second_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thNoteTitle" sortOrder="Title" class="allowSort" scope="col">NOTE TITLE</th>
                                <th id="thCategory" sortOrder="CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thSellType" sortOrder="Value" class="allowSort" scope="col">SELL TYPE</th>
                                <th id="thPrice" sortOrder="SellingPrice" class="allowSort" scope="col">PRICE</th>
                                <th id="thSellerName" sortOrder="SellerName" class="allowSort" scope="col">SELLER</th>
                                <th scope="col"></th>
                                <th id="thPublishedDate" sortOrder="PublishedDate" class="allowSort" scope="col">PUBLISHED DATE</th>
                                <th id="thApprovedByName" sortOrder="ApprovedByName" class="allowSort" scope="col">APPROVED BY</th>
                                <th id="thDownloadNotes" sortOrder="totalDownload" class="allowSort" scope="col">NUMBER OF DOWNLOADS</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($publishedNoteResult as $value) {
                            $sr_no++;
                            
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">'.$value["Title"].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".$value['Value']."</td>";
                            echo "<td>".$value['SellingPrice']."</td>";
                            echo "<td>".$value['SellerName']."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/member_details.php?user_id='.$value["UserID"].'"><img src="images/Dashboard/eye.png" alt="view" class="icon_space"></a></td>';
                            echo "<td>".date('d M Y h:i:s',strtotime($value['PublishedDate']))."</td>";
                            echo "<td>".$value['ApprovedByName']."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/downloaded_notes.php?note_id='.$value["NoteDetailID"].'">'.$value['totalDownload'].'</a></td>';
                            echo '<td class="dropdown">
                            
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="confirmation" class="icon_space"></a>     
                            
                            <div class="dropdown-menu">
                            
                            <a class="dropdown-item" href="#" onclick="downloadAdminNoteFromTable(0,'.$value["NoteDetailID"].');">Download Notes</a>
                            
                            <a class="dropdown-item" href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">View More Details</a>
                            
                            <a class="dropdown-item" href="#" onclick="unPublishNote('.$value["NoteDetailID"].",'".$value['Title'].'\');">Unpublish</a>
                            
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
        echo '<li class="pagination"><a onclick="searchPublishedNote('.($page-1).')" class="button">❮</a></li>';
        
        $j = 0;
        for($i = max(1, $page-2); $i <= min($page + 4, $total_pages); $i++) {
            echo '<li class="pagination"><a ';
            if($i==$page) {
                echo 'class = "active"' ;
            } echo 'onclick="searchPublishedNote('.$i.')" >' .$i.'</a>
            </li>';
            $j++;
            if($j == 5) break;
        }
        echo '<li class="pagination"><a onclick="searchPublishedNote('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnPublishedNoteSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnPublishedNoteSortDir').val('ASC');
                $('#hdnPublishedNoteSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnPublishedNoteSortDir').val('DESC');
                $('#hdnPublishedNoteSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchPublishedNote(1);
        });
    });
     
</script>
                
      