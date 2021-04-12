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

    $search_Str = (isset($_GET['search_member']) && !empty($_GET['search_member'])) ? $_GET['search_member'] : ""; 

    $orderBy = " ORDER BY ";
    
    $orderBy = (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) ? $orderBy.$_GET['orderBy'] : $orderBy." CreatedDate DESC";

    $whereQuery = "";
    $paginationNoteUnderReviewQuery = "";

    $basedRegisteredMemberQuery = "
    
    SELECT 
    *
    FROM
    (
    SELECT US.UserID,US.FirstName,US.LastName,US.Email,US.CreatedDate, US.IsActive, US.UserRoleID,
    
    (SELECT COUNT(NoteDetailID) From notedetails 
        WHERE SellerID = US.UserID AND StatusID IN (".$submittedForReviewID.",".$inReviewID.") 
    ) AS totalNoteUnderReview,
    
    (SELECT COUNT(NoteDetailID) From notedetails 
        WHERE SellerID = US.UserID AND StatusID = ".$publishedID."
    ) AS totalPublished, 
    
    (SELECT COUNT(DownloadNoteID) From downloadnotes 
        WHERE DownloaderID = US.UserID AND 	IsAttachmentDownloaded = 1
    ) AS totalDownload,
    
    (SELECT SUM(PurchasedPrice) FROM downloadnotes 
        WHERE DownloaderID = US.UserID AND IsAttachmentDownloaded = 1
    ) AS totalExpenses,
    
    (SELECT SUM(PurchasedPrice) FROM downloadnotes 
        WHERE SellerID = US.UserID AND IsSellerHasAllowedDownload = 1
    ) AS earnMoney
    
    From users US
    ) AS T 
    WHERE 1=1 AND IsActive = 1 AND UserRoleID = ".$memberUserRoleID;
    
    //Primary search query
    if(!empty($search_Str)) {
        $whereQuery = " AND ( FirstName LIKE '%".$search_Str."%' OR LastName LIKE '%".$search_Str."%' OR Email LIKE '%".$search_Str."%' OR totalNoteUnderReview LIKE '%".$search_Str."%' OR totalPublished LIKE '%".$search_Str."%' OR totalDownload LIKE '%".$search_Str."%' OR totalExpenses LIKE '%".$search_Str."%' OR earnMoney LIKE '%".$search_Str."%' )"; 
    }

    $registeredMemberQuery = $basedRegisteredMemberQuery.$whereQuery.$orderBy." LIMIT ". $start_from. ",". $limit;

    $registeredMemberResult = $db_handle->runQuery($registeredMemberQuery);

    //Pagination query
    $paginationRegisteredMemberQuery = $basedRegisteredMemberQuery.$whereQuery;  

    $paginationRegisteredMemberResult = $db_handle->numRows($paginationRegisteredMemberQuery);

    $total_records = $paginationRegisteredMemberResult;
    $total_pages = ceil($total_records / $limit);

    if($registeredMemberResult != "") {
        echo '<div class="data_table">
                <div class="table-responsive">
                <input type="hidden" id="hdnSortColumn" />
                    <table class="table fix_width_big_table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SR NO.</th>
                                <th id="thFirstName" sortOrder="FirstName" class="allowSort" scope="col">FIRST NAME</th>
                                <th id="thLastName" sortOrder="LastName" class="allowSort" scope="col">LAST NAME</th>
                                <th id="thEmail" sortOrder="Email" class="allowSort" scope="col">EMAIL</th>
                                <th id="thJoiningDate" sortOrder="CreatedDate" class="allowSort table_big_head_fix_width" scope="col" >JOINING DATE</th>
                                <th id="thNoteUnderReview" sortOrder="totalNoteUnderReview" class="allowSort scope="col">UNDER REVIEW NOTES</th>
                                <th id="thNotePublished" sortOrder="totalPublished" class="allowSort scope="col">PUBLISHED NOTES</th>
                                <th id="thNoteDownload" sortOrder="totalDownload" class="allowSort scope="col">DOWNLOADED NOTES</th>
                                <th id="thNoteExpenses" sortOrder="totalExpenses" class="allowSort scope="col">TOTAL EXPENSES</th>
                                <th id="thNoteEarnMoney" sortOrder="earnMoney" class="allowSort scope="col">TOTAL EARNINGS</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($registeredMemberResult as $value) {   $sr_no++;
                            echo "<tr>";
                            echo "<td>".$sr_no."</td>";
                            echo "<td>".$value['FirstName']."</td>";
                            echo "<td>".$value['LastName']."</td>";
                            echo "<td>".$value['Email']."</td>";
                            echo "<td>".date('d M Y, h:i',strtotime($value['CreatedDate']))."</td>";
                            
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/notes_under_review.php?user_id='.$value["UserID"].'">'.$value['totalNoteUnderReview'].'</a></td>';
                            
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/published_note.php?user_id='.$value["UserID"].'">'.$value['totalPublished'].'</a></td>';
                            
                            echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/downloaded_notes.php?buyer_id='.$value["UserID"].'">'.$value['totalDownload'].'</a></td>';
                            
                            if(!empty($value['totalExpenses'])) {
                                echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/downloaded_notes.php?buyer_id='.$value["UserID"].'">$'.$value['totalExpenses'].'</a></td>';
                            } else {
                                echo '<td><a href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/downloaded_notes.php?buyer_id='.$value["UserID"].'">$0.00</a></td>';
                            }
                            
                            if(!empty($value['earnMoney'])) {
                                echo '<td>$'.$value['earnMoney'].'</td>';
                            } else {
                                echo '<td>$0.00</td>';
                            }
                            
                            echo '<td class="dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.$http_protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).'/member_details.php?user_id='.$value["UserID"].'">View More Details</a>
                                    
                                    <a class="dropdown-item" href="#" onclick="deactivateMember('.$value["UserID"].');">Deactive</a>
                                </div>
                            </td>
                        </tr>';
                        }
                        echo '</tbody>
                            </table>
                        </div>
                    </div>';
        //Pagination Start
        echo '<ul id="paging" class="pagination-filters">';
        echo '<li class="pagination"><a onclick="searchMemberOnPortal('.($page-1).')" class="button">❮</a></li>';

        for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
            if($i==$page) { 
                echo 'class = "active"' ; 
            } echo 'onclick="searchMemberOnPortal('.$i.')" >' .$i.'</a>
            </li>';
        }
        echo '<li class="pagination"><a onclick="searchMemberOnPortal('.($page+1).')" class="button">❯</a></li>';
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
            
            $('#hdnMemberPageSortColumn').val($(this).attr('id'));
            if(isAsc) {
                $('#hdnMemberPageSortDir').val('ASC');
                $('#hdnMemberPageSortOrder').val($(this).attr('sortOrder') + " ASC ");
            } else {
                $('#hdnMemberPageSortDir').val('DESC');
                $('#hdnMemberPageSortOrder').val($(this).attr('sortOrder') + " DESC ");                
            }
            searchMemberOnPortal(1);
        });
    });
     
</script>