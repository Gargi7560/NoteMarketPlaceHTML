<?php
    session_start();

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();

    //Settings from Config file
    include '../common/configuration.php';

    $userID = (isset($_GET['user_id']) && !empty($_GET['user_id']) && $_GET['user_id'] > 0) ? $_GET['user_id'] : 0;

    $noteID = (isset($_GET['note_id']) && !empty($_GET['note_id']) && $_GET['note_id'] > 0) ? $_GET['note_id'] : 0;

    $buyerID = (isset($_GET['buyer_id']) && !empty($_GET['buyer_id']) && $_GET['buyer_id'] > 0) ? $_GET['buyer_id'] : 0;

    //Query for seller name dropdown
    $sellerDropDownQuery = "SELECT DISTINCT UserID,CONCAT(FirstName,' ',LastName) AS SellerName FROM users WHERE UserRoleID = ".$memberUserRoleID;
        
    $sellerDropDownResult = $db_handle->runQuery($sellerDropDownQuery);

    //Query for buyer name dropdown
    $buyerDropDownQuery = "SELECT DISTINCT UserID,CONCAT(FirstName,' ',LastName) AS BuyerName FROM users WHERE UserRoleID = ".$memberUserRoleID;

    $buyerDropDownResult = $db_handle->runQuery($buyerDropDownQuery);

    //Query for notes name dropdown
    $noteDropDownQuery = "SELECT DISTINCT NoteDetailID,Title FROM notedetails";

    $noteDropDownResult = $db_handle->runQuery($noteDropDownQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!--important meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Title-->
    <title>Notes MarketPlace</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="images/home/favicon.ico">

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>

    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>
    
    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script_admin.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style_admin.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive_admin.css">
    
    <script type="text/javascript">
        
        //Search download note grid
        function searchDownloadedNote(page) {
            var search_DownloadedNote = $("#searchBtnDownloadedNote").val();
            var searchBy_Seller = $("#selectSeller").val();
            var searchBy_Buyer = $("#selectBuyer").val();
            var searchBy_Note = $("#selectNote").val();
            $.ajax({
                type: "GET",
                url: "downloaded_note_search.php",
                data: {
                    search_downloaded_note: search_DownloadedNote,
                    page: page,
                    searchBySeller: searchBy_Seller,
                    searchByBuyer: searchBy_Buyer,
                    searchByNote: searchBy_Note,
                    orderBy: $('#hdnDownloadedNoteSortOrder').val()
                },
                success: function(data) {
                    $("#downloaded_note_table").html(data);
                    
                    if($('#hdnDownloadedNoteSortColumn').val() == null || $('#hdnDownloadedNoteSortColumn').val() == "") {
                        $('#hdnDownloadedNoteSortOrder').val('DN.AttachmentDownloadedDate DESC');
                        $('#hdnDownloadedNoteSortDir').val('DESC');
                        $('#hdnDownloadedNoteSortColumn').val('thDownloadDt');
                    }
                    if($('#hdnDownloadedNoteSortDir').val() == "DESC") {
                        $('#' + $('#hdnDownloadedNoteSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnDownloadedNoteSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        $(document).ready(function(){
            $('#selectSeller').val(<?php echo $userID; ?>);
            $('#selectNote').val(<?php echo $noteID; ?>);
            $('#selectBuyer').val(<?php echo $buyerID; ?>);
            searchDownloadedNote(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
       
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Dashboard-->
        <section id="notes_under_review" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Downloaded Notes</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-lg-7">
                           <div class="form-inline">
                           <div class="merge">
                            <div class="download_seller">
                           <p class="val_content">Note</p>
                                <select class="form-control dropdown-control down_fix_width" id="selectNote" name="selectNote" onchange="searchDownloadedNote(1);">
                                    <option value="0">Select note</option>
                                    <?php 
                                        foreach($noteDropDownResult as $value){
                                            echo "<option value='".$value['NoteDetailID']."'>".$value['Title']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="download_seller">
                            <p class="val_content">Seller</p>
                                <select class="form-control dropdown-control down_fix_width" id="selectSeller" name="selectSeller" onchange="searchDownloadedNote(1);">
                                    <option value="0">Select seller name</option>
                                    <?php 
                                        foreach($sellerDropDownResult as $value){
                                            echo "<option value='".$value['UserID']."'>".$value['SellerName']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="download_buyer">
                            <p class="val_content">Buyer</p>
                                <select class="form-control dropdown-control down_fix_width" id="selectBuyer" name="selectBuyer" onchange="searchDownloadedNote(1);">
                                    <option value="0">Select buyer name</option>
                                    <?php 
                                        foreach($buyerDropDownResult as $value){
                                            echo "<option value='".$value['UserID']."'>".$value['BuyerName']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            </div>
                            </div>
                        </div>
                        
                        <!--Search field-->
                        <div class="col-lg-5 col-md-12">
                            <div class="form-inline pull-right seller_inline_padding left_mid_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchBtnDownloadedNote" name="searchBtnDownloadedNote" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchDownloadedNote(1);">SEARCH</button>

                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnDownloadedNoteSortOrder" />
                <input type="hidden" id="hdnDownloadedNoteSortDir" />
                <input type="hidden" id="hdnDownloadedNoteSortColumn" />
                
                <!--Download notes grid-->
                <div id="downloaded_note_table"></div>

            </div>
        </section>

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->

    </div>
</body>

</html>