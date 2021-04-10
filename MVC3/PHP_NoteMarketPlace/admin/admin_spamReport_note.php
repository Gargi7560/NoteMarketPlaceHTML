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

    $search_Str = (isset($_GET['spamReport_note']) && !empty($_GET['spamReport_note'])) ? $_GET['spamReport_note'] : ""; 

    $orderBy = " ORDER BY ";
    
    //Set ascending and descending order 
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." NR.CreatedDate DESC";

    $whereQuery = "";
    $paginationSpamReportQuery = "";

    $basedSpamReportQuery = "SELECT NR.NotesReportedIssuesID,NR.Remarks,NR.CreatedDate,ND.NoteDetailID,ND.Title,NC.CategoryName,NR.IsActive,CONCAT(US.FirstName,' ',US.LastName) AS ReportesBy From notesreportedissues NR
    INNER JOIN users US ON US.UserID = NR.ReportedByID
    INNER JOIN notedetails ND ON ND.NoteDetailID = NR.NoteDetailID
    INNER JOIN notecategories NC ON ND.CategoryID = NC.NoteCategoryID
    WHERE NR.IsActive = 1";
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( US.FirstName LIKE '%".$search_Str."%' OR US.LastName LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' OR ND.Title LIKE '%".$search_Str."%'  OR NR.CreatedDate LIKE '%".$search_Str."%' OR NR.Remarks LIKE '%".$search_Str."%' )"; 
    }

    $spamReportQuery = $basedSpamReportQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit; 

    $spamReportResult = $db_handle->runQuery($spamReportQuery);

    //Pagination Query
    $paginationSpamReportQuery = $basedSpamReportQuery.$whereQuery; 

    $paginationSpamReportResult = $db_handle->numRows($paginationSpamReportQuery);

    $total_records = $paginationSpamReportResult;
    $total_pages = ceil($total_records / $limit);

    if($spamReportResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                   <table class="table fix_width_table text-center third_col_pur">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thReportedBy" sortOrder="ReportesBy" class="allowSort" scope="col">REPORTED BY</th>
                                <th id="thTitle" sortOrder="ND.Title" class="allowSort" scope="col">NOTE TITLE</th>
                                <th id="thCategoryName" sortOrder="NC.CategoryName" class="allowSort" scope="col">CATEGORY</th>
                                <th id="thAddedDate" sortOrder="NR.CreatedDate" class="allowSort" scope="col">DATE EDITED</th>
                                <th id="thRemark" sortOrder="NR.Remarks" class="allowSort" scope="col">REMARK</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($spamReportResult as $value) {
                            $sr_no++;
                            
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo "<td>".$value['ReportesBy']."</td>";
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">'.$value["Title"].'</a></td>';
                            echo "<td>".$value['CategoryName']."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            echo "<td>".$value['Remarks']."</td>";
                            
                            echo '<td><a href="#" role="button" onclick="deleteSpamReport('.$value["NotesReportedIssuesID"].');"><img src="images/Dashboard/delete.png" alt="delete"></a></td>';
                            
                            echo '<td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/admin_note_details.php?note_id='.$value["NoteDetailID"].'">View More Details</a>
                                        <a class="dropdown-item" href="#" onclick="downloadAdminNoteFromTable(0,'.$value["NoteDetailID"].');">Download Notes</a>
                                    </div>
                                </td>';
                            echo "</tr>";
                        }
                    echo '</tbody>
                    </table>
                </div>
            </div>';
        
    //Pagination Start
    echo '<ul id="paging" class="pagination-filters">';
    echo '<li class="pagination"><a onclick="spamReportNotes('.($page-1).')" class="button">❮</a></li>';

    for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
        if($i==$page) { 
            echo 'class = "active"' ; 
        } echo 'onclick="spamReportNotes('.$i.')" >' .$i.'</a>
        </li>';
    }
    echo '<li class="pagination"><a onclick="spamReportNotes('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnSpamSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnSpamSortDir').val('ASC');
                $('#hdnSpamSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnSpamSortDir').val('DESC');
                $('#hdnSpamSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            spamReportNotes(1);
        });
    });
     
</script>
                                      
 