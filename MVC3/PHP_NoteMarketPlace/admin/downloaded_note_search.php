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

    $search_Str = (isset($_GET['search_downloaded_note']) && !empty($_GET['search_downloaded_note'])) ? $_GET['search_downloaded_note'] : ""; 

    $searchBySeller = (isset($_GET['searchBySeller']) && !empty($_GET['searchBySeller'])) ? $_GET['searchBySeller'] : ""; 

    $searchByBuyer = (isset($_GET['searchByBuyer']) && !empty($_GET['searchByBuyer'])) ? $_GET['searchByBuyer'] : ""; 

    $searchByNote = (isset($_GET['searchByNote']) && !empty($_GET['searchByNote'])) ? $_GET['searchByNote'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." DN.AttachmentDownloadedDate DESC";

    $whereQuery = "";
    $paginationDownloadedNoteQuery = "";

    $basedDownloadedNoteQuery = "SELECT DN.DownloaderID,DN.SellerID,ND.NoteDetailID,DN.DownloadNoteID,DN.NoteTitle,NC.CategoryName,CONCAT(US.FirstName,' ',US.LastName) AS BuyerName,
    CONCAT(UP.FirstName,' ',UP.LastName) AS SellerName,RD.Value,DN.PurchasedPrice,DN.AttachmentDownloadedDate FROM downloadnotes DN
    INNER JOIN notedetails ND ON ND.NoteDetailID = DN.NoteDetailID 
    INNER JOIN notecategories NC ON DN.NoteCategory = NC.NoteCategoryID 
    INNER JOIN users US ON DN.DownloaderID = US.UserID
    INNER JOIN users UP ON DN.SellerID = UP.UserID 
    INNER JOIN referencedata RD ON ND.SellingModeID = RD.DataValue AND RD.ReferenceCategory = 'SellingMode' 
    WHERE ND.IsActive = 1 AND IsAttachmentDownloaded = 1 ";

    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( DN.NoteTitle LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' OR US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR UP.FirstName LIKE '%".$search_Str."%' OR UP.LastName LIKE '%".$search_Str."%' OR RD.Value LIKE '%".$search_Str."%' OR DN.PurchasedPrice LIKE '%".$search_Str."%' OR DN.AttachmentDownloadedDate LIKE '%".$search_Str."%' )";
    }

    //Search with the seller dropdown
    if(!empty($searchBySeller)) {
        $whereQuery = " AND DN.SellerID = ".$searchBySeller;
    }

    //Search with the buyer dropdown
    if(!empty($searchByBuyer)) {
        $whereQuery = " AND DN.DownloaderID = ".$searchByBuyer;
    }

    //Search with the notes dropdown
    if(!empty($searchByNote)) {
        $whereQuery = " AND DN.NoteDetailID = ".$searchByNote;
    }

    $downloadedNoteQuery = $basedDownloadedNoteQuery.$whereQuery.$orderBy." LIMIT ".$start_from. ",". $limit;

    $downloadedNoteResult = $db_handle->runQuery($downloadedNoteQuery);

    //Pagination Query
    $paginationDownloadedNoteQuery = $basedDownloadedNoteQuery.$whereQuery;

    $paginationDownloadedNoteResult = $db_handle->numRows($paginationDownloadedNoteQuery);

    $total_records = $paginationDownloadedNoteResult;
    $total_pages = ceil($total_records / $limit);

    if($downloadedNoteResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                    <table class="table fix_width_table text-center second_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thNoteTitle" sortOrder="DN.NoteTitle" class="allowSort" scope="col">NOTE TITLE</th>
                                <th id="thCategory" sortOrder="NC.CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thBuyerName" sortOrder="BuyerName" class="allowSort" scope="col">BUYER</th>
                                <th scope="col"></th>
                                <th id="thSellerName" sortOrder="SellerName" class="allowSort" scope="col">SELLER</th>
                                <th scope="col"></th>
                                <th id="thSellType" sortOrder="RD.Value" class="allowSort" scope="col">SELL TYPE</th>
                                <th id="thPrice" sortOrder="DN.PurchasedPrice" class="allowSort" scope="col">PRICE</th>
                                <th id="thDownloadDt" sortOrder="DN.AttachmentDownloadedDate" class="allowSort" scope="col">DOWNLOADED DATE/TIME</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($downloadedNoteResult as $value) {
                            $sr_no++;
                            
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">'.$value["NoteTitle"].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".$value['BuyerName']."</td>";
                            
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/member_details.php?user_id='.$value["DownloaderID"].'"><img src="images/Dashboard/eye.png" alt="view" class="icon_space"></a></td>';
                            
                            echo "<td>".$value['SellerName']."</td>";
                            
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/member_details.php?user_id='.$value["SellerID"].'"><img src="images/Dashboard/eye.png" alt="view" class="icon_space"></a></td>';
                            
                            echo "<td>".$value['Value']."</td>";
                            echo "<td>".$value['PurchasedPrice']."</td>";
                            echo "<td>".date('d M Y h:i:s',strtotime($value['AttachmentDownloadedDate']))."</td>";
                            echo '<td class="dropdown">
                            
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="confirmation" class="icon_space"></a>     
                            
                            <div class="dropdown-menu">
                            
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
        echo '<li class="pagination"><a onclick="searchDownloadedNote('.($page-1).')" class="button">❮</a></li>';
        
        for($i=1; $i<=$total_pages; $i++) {
            echo '<li class="pagination"><a ';
            if($i==$page) {
                echo 'class = "active"' ;
            } echo 'onclick="searchDownloadedNote('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="searchDownloadedNote('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnDownloadedNoteSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnDownloadedNoteSortDir').val('ASC');
                $('#hdnDownloadedNoteSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnDownloadedNoteSortDir').val('DESC');
                $('#hdnDownloadedNoteSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchDownloadedNote(1);
        });
    });
     
</script>