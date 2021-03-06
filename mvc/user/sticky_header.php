
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
                                    <li><a href="search_note.php" class="val_content">Search Notes</a></li>
                                    <li><a href="add_notes.php" class="val_content">Sell Your Notes</a></li>
                                    <li><a href="FAQ.php" class="val_content">FAQ</a></li>
                                    <li><a href="contact_us.php" class="val_content">Contact Us</a></li>
                                    <li class="dropdown">
                                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="images/Add-notes/user-img.png" alt="user" class="img-responsive">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="my_downloads.html">My Downloads</a>
                                            <a class="dropdown-item" href="my_sold_notes.html">My Sold Notes</a>
                                            <a class="dropdown-item" href="my_rejected_notes.html">My Rejected Notes</a>
                                            <a class="dropdown-item" href="user_change_pwd.html">Change Password</a>
                                            <a class="dropdown-item pur_col" href="#">LOGOUT</a>
                                        </div>
                                    </li>
                                    <li>
                                           <?php if( $_SESSION['user_logged_in']): ?>
                                                <a href="user_login.php">
                                                   <button type="butoon" class="btn btn-outline-primary btn-purple">Logout</button> 
                                                </a>
                                            <?php else: ?>
                                            <a href="user_login.php">
                                                <button type="butoon" class="btn btn-outline-primary btn-purple">Login</button>
                                            </a>
                                            <?php endif; ?>
                                        </li>
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
                               <li><a href="search_note.html" class="val_content">Search Notes</a></li>
                               <li><a href="#" class="val_content">Sell Your Notes</a></li>
                               <li><a href="FAQ.html" class="val_content">FAQ</a></li>
                               <li><a href="contact_us.html" class="val_content">Contact Us</a></li>
                               <li class="dropdown">
                                  
                                   <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <img src="images/Add-notes/user-img.png" alt="user" class="img-responsive">
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item" href="#">My Profile</a>
                                       <a class="dropdown-item" href="my_downloads.html">My Downloads</a>
                                       <a class="dropdown-item" href="my_sold_notes.html">My Sold Notes</a>
                                       <a class="dropdown-item" href="my_rejected_notes.html">My Rejected Notes</a>
                                       <a class="dropdown-item" href="user_change_pwd.html">Change Password</a>
                                       <a class="dropdown-item pur_col" href="#">LOGOUT</a>
                                   </div>
                               </li>
                               <li><a href="#">
                                    <button type="submit" class="btn btn-outline-primary btn-purple">Logout</button> 
                                    </a>
                               </li>
                           </ul>

                        </div>
                    </div>
                    
                </div>
            </div>
        </header>
        <!--Header End-->