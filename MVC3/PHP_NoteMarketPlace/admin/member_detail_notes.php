<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    $limit = 5;
    
    $current_member_id = (isset($_GET['userID']) && !empty($_GET['userID']) && $_GET['userID'] > 0) ? $_GET['userID'] : 0;

    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limit; 

    $sr_no = $start_from;

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." CreatedDate DESC";

    $basedMemberNotesDetailQuery = "
    
    SELECT
    *
    FROM 
    (
    
    SELECT ND.SellerID,ND.NoteDetailID,ND.Title,NC.CategoryName,RD.Value,ND.CreatedDate,ND.PublishedDate,ND.IsActive,
    
    (SELECT COUNT(DownloadNoteID) From downloadnotes 
        WHERE NoteDetailID = ND.NoteDetailID AND IsAttachmentDownloaded = 1
    ) AS totalDownloadedNotes,
    
    (SELECT SUM(PurchasedPrice) FROM downloadnotes 
        WHERE IsSellerHasAllowedDownload = 1 AND NoteDetailID = ND.NoteDetailID
    ) AS earnMoney
    
    From notedetails ND
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID 
    INNER JOIN referencedata RD ON ND.StatusID = RD.DataValue AND RD.ReferenceCategory = 'NoteStatus'
    
    ) AS T
    WHERE IsActive = 1 AND SellerID = ".$current_member_id;

    $memberNoteQuery = $basedMemberNotesDetailQuery.$orderBy." LIMIT ".$start_from. ",". $limit;

    $memberNoteResult = $db_handle->runQuery($memberNoteQuery);

    //Pagination query
    $paginationMemberNoteResult = $db_handle->numRows($basedMemberNotesDetailQuery);

    $total_records = $paginationMemberNoteResult;
    $total_pages = ceil($total_records / $limit);

    if($memberNoteResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                    <table class="table fix_width_big_table text-center second_col_pur fifth_col_pur six_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thNoteTitle" sortOrder="Title" class="allowSort" scope="col">NOTE TITLE</th>
                                <th id="thCategory" sortOrder="CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thStatus" sortOrder="Value" class="allowSort" scope="col">STATUS</th>
                                <th scope="col">DOWNLOADED NOTES</th>
                                <th scope="col">TOTAL EARNINGS</th>
                                <th id="thAddedDt" sortOrder="CreatedDate" class="allowSort" scope="col">DATE ADDED</th>
                                <th id="thPublishedDt" sortOrder="PublishedDate" class="allowSort" scope="col">PUBLISHED ADDED</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($memberNoteResult as $value) {
                            
                            $sr_no++;
                            
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">'.$value["Title"].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".$value['Value']."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/downloaded_notes.php?note_id='.$value["NoteDetailID"].'">'.$value['totalDownloadedNotes'].'</a></td>';
                            
                            if(!empty($value['earnMoney'])) {
                                echo '<td>$'.$value['earnMoney'].'</td>';
                            } else {
                                echo '<td>$0.00</td>';
                            }
                            
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['PublishedDate']))."</td>";
                            
                            echo '<td class="dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="downloadAdminNoteFromTable(0,'.$value["NoteDetailID"].');">Downloaded Notes</a>
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
        echo '<li class="pagination"><a onclick="memberNoteTable('.($page-1).')" class="button">❮</a></li>';
        
        for($i=1; $i<=$total_pages; $i++) {
            echo '<li class="pagination"><a ';
            if($i==$page) {
                echo 'class = "active"' ;
            } echo 'onclick="memberNoteTable('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="memberNoteTable('.($page+1).')" class="button">❯</a></li>';
        echo '</ul>'; 
        //Pagination End
    } else {
        echo '<div class="data_table text-center">No Notes Availabel For This User!!</div>';
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
            
            $('#hdnMemberDetailSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnMemberDetailSortDir').val('ASC');
                $('#hdnMemberDetailSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnMemberDetailSortDir').val('DESC');
                $('#hdnMemberDetailSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            memberNoteTable(1);
        });
    });
     
</script>  