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


</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">
        
        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->
        
        <!--My Rejected Notes-->
       <section id="my_rejected_notes" class="pad_100_for_pages">
           <div class="container">
               <div class="small_pad_20">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="small-heading left_heading-1">My Rejected Notes</span>
                        </div>
                        <div class="col-md-7">
                            <form class="form-inline pull-right left_small_device">
                                <input class="form-control mr-sm-2 input_val search_icon" type="search" id="search_note" placeholder="Search notes here" aria-label="Search">
                                <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="submit">SEARCH</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="data_table">
                    <div class="table-responsive">
                       <table class="table fix_width_table second_col_pur fifth_col_pur">
                          <thead>
                              <tr>
                                  <th scope="col">SR NO.</th>
                                  <th scope="col">NOTE TITLE</th>
                                  <th scope="col">CATEGORY</th>
                                  <th scope="col">REMARK</th>
                                  <th scope="col">CLONE</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Accounts</td>
                                  <td>Commerce</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>4</td>
                                  <td>Accounts</td>
                                  <td>Commerce</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>5</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>6</td>
                                  <td>Accounts</td>
                                  <td>Commerce</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>7</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>8</td>
                                  <td>Accounts</td>
                                  <td>Commerce</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>9</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>10</td>
                                  <td>Accounts</td>
                                  <td>Commerce</td>
                                  <td>Lorem ipsum is simply dummy text</td>
                                  <td>Clone</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Note</a>
                                    </div>
                                </td>
                              </tr>
                          </tbody>
                          </table>
                   </div>
                   </div>
            <!--Pagination Start-->
            <div class="container">
                <div class="row">
                    <div class="pagination-filters">
                        <div class="col-md-12">
                            <div class="pagination">
                                <a href="#"> ❮ </a>
                                <a href="#search_pg1" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#"> ❯ </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Pagination End-->
           </div>
       </section>
       
        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->
        </div>
</body>

</html>