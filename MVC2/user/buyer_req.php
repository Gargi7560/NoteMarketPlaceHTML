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

        function searchNoteForBuyerReq(page) {
            var searchNote_BuyerReq = $("#searchBuyerText").val();
            $.ajax({
                type: "GET",
                url: "buyer_search_note.php",
                data: {
                    search_buyer_note: searchNote_BuyerReq,
                    page: page,
                    orderBy: $('#hdnBuyReqSortOrder').val()
                },
                success: function(data) {
                    $("#buyerRequest_Notes").html(data);

                    if ($('#hdnBuyReqSortColumn').val() == null || $('#hdnBuyReqSortColumn').val() == "") {
                        $('#hdnBuyReqSortOrder').val('DN.AttachmentDownloadedDate DESC');
                        $('#hdnBuyReqSortDir').val('DESC');
                        $('#hdnBuyReqSortColumn').val('thDownloadDt');

                    }
                    if ($('#hdnBuyReqSortDir').val() == "DESC") {
                        $('#' + $('#hdnBuyReqSortColumn').val()).addClass('descending');
                    } else {
                        $('#' + $('#hdnBuyReqSortColumn').val()).addClass('ascending');
                    }
                }
            });
        }

        function allowDownloadBySeller(noteID) {
            $.ajax({
                type: "GET",
                url: "allow_download.php",
                data: {
                    noteID: noteID
                },
                success: function(data) {
                    searchNoteForBuyerReq(1);
                }
            });
        }

        $(document).ready(function() {

            searchNoteForBuyerReq(1);
        });
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">

        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--Buyer Request Start-->
        <section id="buyer_request" class="pad_100_for_pages">
            <div class="container">
                <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">Buyer Requests</span>
                        </div>
                        <div class="col-md-7">
                            <div class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="searchBuyerText" name="searchBuyerText" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" name="searchBuyer" type="button" onclick="searchNoteForBuyerReq(1);">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdnBuyReqSortOrder" />
                <input type="hidden" id="hdnBuyReqSortDir" />
                <input type="hidden" id="hdnBuyReqSortColumn" />
                <div id="buyerRequest_Notes"></div>
            </div>
        </section>
        <!--Buyer Request End-->

        <!--Footer-->
        <?php include 'footer.php';?>
        <!--End of footer-->

    </div>
</body>

</html>