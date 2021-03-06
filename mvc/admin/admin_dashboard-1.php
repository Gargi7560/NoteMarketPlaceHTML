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
    
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    
        <!--Header Start-->
        <header class="site-header">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo-wrapper">
                    <a class="navbar-brand" href="#"><img src="images/logo_pur/top-logo.png" alt="logo"></a>
                                      
                    <!--Mobile Menu Open Button-->
                    <span id="mobile-nav-open-btn">&#9776;</span>
                    
                </div>
                <div class="navigation-wrapper">
                    <nav class="main-nav navbar navbar-expand-md">
                        <div class="collapse navbar-collapse">

                            <ul class="menu-navigation">
                                <li><a href="admin_dashboard-1.html" class="val_content">Dashboard</a></li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Notes
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="notes_under_review.html">Notes Under Review</a>
                                        <a class="dropdown-item" href="published_note.html">Published Notes</a>
                                        <a class="dropdown-item" href="downloaded_notes.html">Downloaded Notes</a>
                                        <a class="dropdown-item" href="rejected_notes.html">Rejected Notes</a>

                                    </div>
                                </li>
                                <li><a href="members_page.html" class="val_content">Members</a></li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="spam_reports.html">Spam Reports</a>
                                    </div>
                                </li>
                                <li><a href="#" class="val_content">Settings</a></li>
                                <li class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Add-notes/user-img.png" alt="user" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="#">Change Password</a>
                                        <a class="dropdown-item pur_col" href="#">LOGOUT</a>
                                    </div>
                                </li>
                                <li><a href="#">
                                    <button type="button" class="btn btn-outline-primary btn-purple">Logout</button> </a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                
                
                    <!--Mobile Menu-->
                    <div id="mobile-nav">
                        <!--Mobile Menu Close Button-->
                        <span id="mobile-nav-close-btn">&times;</span>
                        <div id="mobile-nav-content">
                            <ul class="menu-navigation">
                                <li><a href="downloaded_notes.html" class="val_content">Dashboard</a></li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Notes
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="notes_under_review.html">Notes Under Review</a>
                                        <a class="dropdown-item" href="published_note.html">Published Notes</a>
                                        <a class="dropdown-item" href="downloaded_notes.html">Downloaded Notes</a>
                                        <a class="dropdown-item" href="rejected_notes.html">Rejected Notes</a>

                                    </div>
                                </li>
                                <li><a href="members_page.html" class="val_content">Members</a></li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="spam_reports.html">Spam Reports</a>
                                    </div>
                                </li>
                                <li><a href="#" class="val_content">Settings</a></li>
                                <li class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Add-notes/user-img.png" alt="user" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="#">Change Password</a>
                                        <a class="dropdown-item pur_col" href="#">LOGOUT</a>
                                    </div>
                                </li>
                                <li><a href="#">
                                    <button type="button" class="btn btn-outline-primary btn-purple">Logout</button> </a></li>
                            </ul>

                        </div>
                    </div>
                
            </div>
        </div>
    </header>
        <!--Header End-->

    <!--Dashboard-->
    <section id="admin_dashboard" class="pad_120_for_pages">
        <div class="container">
                <span class="common-heading-1 left_heading-1">Dashboard</span>
            

            <div class="content-box-xs">
               <div class="row">
                   <div class="col-md-4 row_fix_bottom_30">
                      <div class="dashboard_border verti_center_padding text-center fix_height_dashboard">
                       <p class="small-heading-1 center_heading-2">20</p>
                        <span class="val_content">Numbers of Notes in Review for Publish</span>
                        </div>
                   </div>
                   <div class="col-md-4 row_fix_bottom_30">
                      <div class="dashboard_border verti_center_padding text-center fix_height_dashboard">
                       <p class="small-heading-1 center_heading-2">103</p>
                        <span class="val_content">Numbers of New Notes Downloaded</span>
                        <p class="val_content">(Last 7 days)</p>
                       </div>
                   </div>
                   <div class="col-md-4 row_fix_bottom_30">
                      <div class="dashboard_border verti_center_padding text-center fix_height_dashboard">
                       <p class="small-heading-1 center_heading-2">223</p>
                        <span class="val_content">Numbers of New Notes Registrations</span>
                        <p class="val_content">(Last 7 days)</p>
                       </div>
                   </div>
               </div>
            </div>

            <div class="small_pad_20">
                <div class="row">
                    <div class="col-md-4">
                        <span class="small-heading left_heading-1">In Progress Notes</span>
                    </div>
                    <div class="col-md-8">
                        <form class="form-inline pull-right left_small_device">
                            <input class="form-control mr-sm-2 input_val search_icon small_device" type="search" id="search_note" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary btn-purple my-2 my-sm-0" type="submit">SEARCH</button>
                            <select class="form-control dropdown-control ml-sm-2 input_val small_device" id="select-month">
                                <option value="0">Select month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                            </select>

                        </form>
                    </div>
                </div>
            </div>
    
                <div class="data_table">
                    <div class="table-responsive">
                       <table class="table fix_width_table text-center second_col_pur ninth_col_pur">
                          <thead>
                              <tr>
                                  <th scope="col">SR NO.</th>
                                  <th scope="col">TITLE</th>
                                  <th scope="col">CATEGORY</th>
                                  <th scope="col">ATTACHMENT SIZE</th>
                                  <th scope="col">SELL TYPE</th>
                                  <th scope="col">PRICE</th>
                                  <th scope="col">PUBLISHER</th>
                                  <th scope="col">PUBLISHER DATE</th>
                                  <th scope="col" class="table_head_fix_width">NUMBER OF DOWNLOADS</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>10 KB</td>
                                  <td>Paid</td>
                                  <td>$250</td>
                                  <td>Gargi Patel</td>
                                  <td>09-10-2020, 10:10</td>
                                  <td>10</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Notes</a>
                                        <a class="dropdown-item" href="#">View More Details</a>
                                        <a class="dropdown-item" href="#">Unpublish</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>10 KB</td>
                                  <td>Paid</td>
                                  <td>$250</td>
                                  <td>Gargi Patel</td>
                                  <td>09-10-2020, 10:10</td>
                                  <td>10</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Notes</a>
                                        <a class="dropdown-item" href="#">View More Details</a>
                                        <a class="dropdown-item" href="#">Unpublish</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>10 KB</td>
                                  <td>Paid</td>
                                  <td>$250</td>
                                  <td>Gargi Patel</td>
                                  <td>09-10-2020, 10:10</td>
                                  <td>10</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Notes</a>
                                        <a class="dropdown-item" href="#">View More Details</a>
                                        <a class="dropdown-item" href="#">Unpublish</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>4</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>10 KB</td>
                                  <td>Paid</td>
                                  <td>$250</td>
                                  <td>Gargi Patel</td>
                                  <td>09-10-2020, 10:10</td>
                                  <td>10</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Notes</a>
                                        <a class="dropdown-item" href="#">View More Details</a>
                                        <a class="dropdown-item" href="#">Unpublish</a>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td>5</td>
                                  <td>Data Science</td>
                                  <td>Science</td>
                                  <td>10 KB</td>
                                  <td>Paid</td>
                                  <td>$250</td>
                                  <td>Gargi Patel</td>
                                  <td>09-10-2020, 10:10</td>
                                  <td>10</td>
                                  <td class="dropdown">
                                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="details" class="img-responsive">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Download Notes</a>
                                        <a class="dropdown-item" href="#">View More Details</a>
                                        <a class="dropdown-item" href="#">Unpublish</a>
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
    <!--footer-->

    <div class="admin-footer">
        <hr>
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="admin-footer-content">version:1.1.24</span>
            </div>
            <div class="col-md-6">
                <span class="admin-footer-content pull-right">Copyright &#169; TatvaSoft All rights reserved.</span>
            </div>
        </div>
        </div>
    </div>
    <!--Footer End-->



</body>

</html>
