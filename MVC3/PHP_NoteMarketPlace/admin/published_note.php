<?php
    
    //Settings from Config file
    include '../common/configuration.php';
    
    //Session start
    include 'manage_admin_session.php';

    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    $userID = (isset($_GET['user_id']) && !empty($_GET['user_id']) && $_GET['user_id'] > 0) ? $_GET['user_id'] : 0;

    $sellerDropDownQuery = "SELECT DISTINCT UserID,CONCAT(FirstName,' ',LastName) AS SellerName FROM users WHERE UserRoleID = ".$memberUserRoleID;
        
    $sellerDropDownResult = $db_handle->runQuery($sellerDropDownQuery);

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
        
        //Search publish note grid
        function searchPublishedNote(page) {
            var search_PublishedNote = $("#searchBtnPublishedNote").val();
            var searchBy_Seller = $("#selectSeller").val();
            $.ajax({
                type: "GET",
                url: "published_note_search.php",
                data: {
                    search_published_note: search_PublishedNote,
                    page: page,
                    searchBySeller: searchBy_Seller,
                    orderBy: $('#hdnPublishedNoteSortOrder').val()
                },
                success: function(data) {
                    $("#published_note_table").html(data);
                    
                    if($('#hdnPublishedNoteSortColumn').val() == null || $('#hdnPublishedNoteSortColumn').val() == "") {
                        $('#hdnPublishedNoteSortOrder').val('PublishedDate DESC');
                        $('#hdnPublishedNoteSortDir').val('DESC');
                        $('#hdnPublishedNoteSortColumn').val('thPublishedDate');
                    }
                    if($('#hdnPublishedNoteSortDir').val() == "DESC") {
                        $('#' + $('#hdnPublishedNoteSortColumn').val()).addClass('descending');
                    } else {
                    $('#' + $('#hdnPublishedNoteSortColumn').val()).addClass('ascending');
                }
                }
            });
        }
        
        //Shows popup on click of unpublish button in tabel
        function unPublishNote(noteID,title) {
            $('#unPublishNotePopup').modal('show');
            $('#hdnUnpublishNoteID').val(noteID);
            $('#titleForNotes').html(title);
        }
        
        //Shows confirm popup on click of unpublish button in tabel
        function remarkForUnpublish() {
            $('#unPublishNotePopup').modal('hide');
            $('#ConfirmUblishNotePopup').modal('show');
        }
        
        //Update status on click of yes in confirmation popup
        function confirmUnpublishNote() {
            $.ajax({
                type: "POST",
                url: "remark_for_unpublish.php",
                data: {
                    noteID: $('#hdnUnpublishNoteID').val(),
                    remarks: $('#remarks').val()
                },
                success: function (data) {
                    $('#ConfirmUblishNotePopup').modal('hide');
                }
            });
        }
        $(document).ready(function(){
            $('#selectSeller').val(<?php echo $userID; ?>);
            searchPublishedNote(1);
        });
    </script>
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'admin_header.php'?>
        <!--Header End-->

        <!--Published Notes Start-->
        <section id="published_notes" class="pad_120_for_pages">
            <div class="container">
                    <span class="common-heading-1 left_heading-1">Published Notes</span>

                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <div class="seller">
                               <p class="val_content">seller</p>
                                <select class="form-control dropdown-control" id="selectSeller" name="selectSeller" onchange="searchPublishedNote(1);">
                                    <option value="0">Select Seller</option>
                                    <?php 
                                        foreach($sellerDropDownResult as $value){
                                            echo "<option value='".$value['UserID']."'>".$value['SellerName']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <!--Search field for note search-->
                        <div class="col-md-9">
                            <div class="form-inline pull-right left_small_device seller_inline_padding">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchBtnPublishedNote" name="searchBtnPublishedNote" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" onclick="searchPublishedNote(1);">SEARCH</button>

                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Hidden Field for ascending and descending-->
                <input type="hidden" id="hdnPublishedNoteSortOrder" />
                <input type="hidden" id="hdnPublishedNoteSortDir" />
                <input type="hidden" id="hdnPublishedNoteSortColumn" />
                
                <!--Data for admin dashboard grid-->
                <div id="published_note_table"></div>
                
                <!--Unpublish Note Popup-->
                <div class="modal fade" id="unPublishNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="unpublish_popup">
                                    <span class="common-heading-1 left_heading-1" id="titleForNotes"></span>
                                    <div class="form-group form-common common_popup">
                                        <label for="remarks">Remarks *</label>
                                        <textarea class="form-control input_val" id="remarks" rows="3" placeholder="Remarks..." required></textarea>
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="UNPUBLISH" id="remarkUnpublish" onclick="remarkForUnpublish();">
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="CANCEL" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Confirm Unpublish Note Popup-->
                <div class="modal fade" id="ConfirmUblishNotePopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                </button>
                                <div class="unpublish_popup">
                                    <div class="form-group form-common">
                                        <p class="val_content">Are you sure you want to Unpublish this note?</p>
                                    </div>
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" value="YES" id="confirmationUnpublishNote" onclick="confirmUnpublishNote();">
                                    <input type="hidden" id="hdnUnpublishNoteID">
                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="NO" class="close-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--Published Notes End-->

        <!--Footer Start-->
        <?php include 'admin_footer.php' ?>
        <!--Footer End-->
</div>
</body>

</html>