<?php
    session_start();

    //Settings from Config file
    include 'configuration.php';

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
    <link rel="shortcut icon" href="images/login/favicon.ico">
    
    <!--JQuery-->
    <script src="js/jquery.min.js"></script>
    
    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
    
    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">

    <script type="text/javascript">
        
    function searchSoldNote(page) {
        var searchNote_Sold = $("#searchSold").val();
        $.ajax({
            type: "GET",
            url: "sold_search_note.php",
            data: {
                search_sold_note: searchNote_Sold,
                page: page,
                orderBy: $('#hdnSoldSortOrder').val()
            },
            success: function (data) {
                $("#sold_Notes").html(data);
                
                if($('#hdnSoldSortColumn').val() == null || $('#hdnSoldSortColumn').val() == "") {
                    $('#hdnSoldSortOrder').val('DN.AttachmentDownloadedDate DESC');
                    $('#hdnSoldSortDir').val('DESC');
                    $('#hdnSoldSortColumn').val('thDownloadDt');
                }
                if($('#hdnSoldSortDir').val() == "DESC") {
                    $('#' + $('#hdnSoldSortColumn').val()).addClass('descending');
                } else {
                    $('#' + $('#hdnSoldSortColumn').val()).addClass('ascending');
                }
            }
        });
    }
    $(document).ready(function(){
        searchSoldNote(1);
    });    
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
      
        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->
        
        <!--My Sold Notes-->
       <section id="my_sold_notes" class="pad_100_for_pages">
           <div class="container">
               <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">My Sold Notes</span>
                        </div>
                        <div class="col-md-7">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchSold" name="searchSold" placeholder="Search notes here" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="submit" onclick="searchSoldNote(1);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdnSoldSortOrder" />
                <input type="hidden" id="hdnSoldSortDir" />
                <input type="hidden" id="hdnSoldSortColumn" />
                <div id="sold_Notes"></div>
           </div>
       </section>
        <!--My Sold Notes-->
        
        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->
        </div>
</body>

</html>