<?php
    session_start();

    //Settings from Config file
    include 'configuration.php';

    //Import database configuration
    require_once("dbcontroller.php");
	$db_handle = new DBController();

    $limitDownload = 10;
    $sr_no = 1;
    $page = (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

    $start_from = ($page-1) * $limitDownload; 

    $search_Str = (isset($_GET['search_buyer_note']) && !empty($_GET['search_buyer_note'])) ? $_GET['search_buyer_note'] : ""; 
	
    $whereQuery = "";
    $paginationBuyerQuery = "";

    $basedBuyerQuery = "SELECT ND.Title,NC.CategoryName,US.Email,RD.Value,ND.SellingPrice,DN.AttachmentDownloadedDate,'+91' AS PhoneNumberCountryID,'9876543210' AS PhoneNumber FROM downloadnotes DN 
    INNER JOIN notedetails ND ON ND.NoteDetailID = DN.NoteDetailID 
    INNER JOIN notecategories NC ON DN.NoteCategory = NC.NoteCategoryID 
    INNER JOIN users US ON DN.SellerID = US.UserID  
    INNER JOIN referencedata RD ON DN.IsPaid = RD.DataValue AND RD.ReferenceCategory = 'SellingMode' 
    WHERE DN.SellerID = ".$_SESSION['user_id'];

    if(!empty($search_Str)) {
        $whereQuery = " AND ( ND.Title LIKE '%".$search_Str."%' OR NC.CategoryName LIKE '%".$search_Str."%' )"; 
    }
    
    $buyerQuery = $basedBuyerQuery.$whereQuery." LIMIT ". $start_from. ",". $limitDownload; 
    $buyerResult = $db_handle->runQuery($buyerQuery);

    $paginationBuyerQuery = $basedBuyerQuery.$whereQuery;   
    $paginationBuyerResult = $db_handle->numRows($paginationBuyerQuery);

    $total_records = $paginationBuyerResult;
    $total_pages = ceil($total_records / $limitDownload);
?>
        
<?php
               
    if($buyerResult != ""){
        echo '<div class="data_table">
            <div class="table-responsive">
                <table class="table fix_width_table second_col_pur">
                    <thead>
                        <tr>
                            <th scope="col">SR NO.</th>
                            <th scope="col">NOTE TITLE</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">BUYER</th>
                            <th scope="col">PHONE NO.</th>
                            <th scope="col">SELL TYPE</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">DOWNLOADED DATE/TIME</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($buyerResult as $value) {
                        echo "<tr>";
                        echo "<td>".$sr_no."</td>";
                        echo "<td>".$value['Title']."</td>";
                        echo "<td>".$value['CategoryName']."</td>";
                        echo "<td>".$value['Email']."</td>";
                        echo "<td>".$value['PhoneNumberCountryID']." ".$value['PhoneNumber']."</td>";
                        echo "<td>".$value['Value']."</td>";
                        echo "<td>".$value['SellingPrice']."</td>";
                        echo "<td>".$value['AttachmentDownloadedDate']."</td>";
                        echo '<td><img src="images/Dashboard/eye.png" alt="edit" class="icon_space"></td>';
                        echo '<td><img src="images/Dashboard/dots.png" alt="edit" class="icon_space"></td>';
                        echo "</tr>";
                        $sr_no++;
                    }          
                    echo '</tbody>
                    </table>
                </div>
            </div>';
        
    //Pagination Start
    echo '<ul id="paging" class="pagination-filters">';
    echo '<li class="pagination"><a onclick="searchNoteForBuyerReq('.($page-1).')" class="button">❮</a></li>';

    for ($i=1; $i<=$total_pages; $i++) { echo '<li class="pagination"><a ' ; 
        if($i==$page) { 
            echo 'class = "active"' ; 
        } echo 'onclick="searchNoteForBuyerReq('.$i.')" >' .$i.'</a>
        </li>';
    }
    echo '<li class="pagination"><a onclick="searchNoteForBuyerReq('.($page+1).')" class="button">❯</a></li>';
    echo '</ul>';
    //Pagination End
        
    } else {
        echo '<div class="data_table">No Records Found!!</div>';
    }
?>