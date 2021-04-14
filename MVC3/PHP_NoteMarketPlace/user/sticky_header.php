<?php 
    
    //Settings from Config file
    include '../common/configuration.php';

?>
        <!--Header Start-->
        <header class="site-header">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo-wrapper">
                        <a class="navbar-brand" href="home.php"><img src="images/logo_pur/top-logo.png" alt="logo"></a> 
                                          
                        <!--Mobile Menu Open Button-->
                        <span id="mobile-nav-open-btn">&#9776;</span>
                                            
                    </div>
                    <div class="navigation-wrapper">
                        <nav class="main-nav navbar navbar-expand-md">
                            <div class="collapse navbar-collapse">

                                <ul class="menu-navigation">
                                    <li><a href="search_note.php" class="val_content">Search Notes</a></li>
                                    <li>
                                    <?php if(isset($_SESSION['user_logged_in'])){ ?>
                                    <a href="user_dashboard-1.php" class="val_content">Sell Your Notes</a>
                                    <?php } else { ?>
                                    <a href="user_login.php" class="val_content">Sell Your Notes</a>
                                    <?php } ?>
                                    </li>
                                    <li><a href="FAQ.php" class="val_content">FAQ</a></li>
                                    <li><a href="contact_us.php" class="val_content">Contact Us</a></li>
                                    
                                    <?php if(isset($_SESSION['user_logged_in'])){ ?>
                                          
                                    <li class="dropdown">
                                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?php 
                                            echo $_SESSION['profile_pic'];
                                            ?>" alt="user" class="img-responsive">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="user_profile.php">My Profile</a>
                                            <a class="dropdown-item" href="my_downloads.php">My Downloads</a>
                                            <a class="dropdown-item" href="my_sold_notes.php">My Sold Notes</a>
                                            <a class="dropdown-item" href="my_rejected_notes.php">My Rejected Notes</a>
                                            <a class="dropdown-item" href="user_change_pwd.php">Change Password</a>
                                            <a class="dropdown-item pur_col" href="logout.php">LOGOUT</a>
                                        </div>
                                    </li>
                                    <?php } ?>
                                          <li>
                                           <?php if(isset($_SESSION['user_logged_in'])){ ?>
                                                <a href="logout.php">
                                                   <button type="button" class="btn btn-outline-primary btn-purple">Logout</button> 
                                                </a>
                                            <?php } else { ?>
                                            <a href="user_login.php">
                                                <button type="button" class="btn btn-outline-primary btn-purple">Login</button>
                                            </a>
                                            <?php } ?>
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
                               <li><a href="search_note.php" class="val_content">Search Notes</a></li>
                               <li>
                                    <?php if(isset($_SESSION['user_logged_in'])){ ?>
                                    <a href="user_dashboard-1.php" class="val_content">Sell Your Notes</a>
                                    <?php } else { ?>
                                    <a href="user_login.php" class="val_content">Sell Your Notes</a>
                                    <?php } ?>
                                    </li>
                               <li><a href="FAQ.php" class="val_content">FAQ</a></li>
                               <li><a href="contact_us.php" class="val_content">Contact Us</a></li>
                               
                               <?php if(isset($_SESSION['user_logged_in'])){ ?>  
                               <li class="dropdown">
                                
                                   <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <img src="<?php 
                                            echo $profileResult[0]["ProfilePicture"];
                                            ?>" alt="user" class="img-responsive">
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item" href="user_profile.php">My Profile</a>
                                       <a class="dropdown-item" href="my_downloads.php">My Downloads</a>
                                       <a class="dropdown-item" href="my_sold_notes.php">My Sold Notes</a>
                                       <a class="dropdown-item" href="my_rejected_notes.php">My Rejected Notes</a>
                                       <a class="dropdown-item" href="user_change_pwd.php">Change Password</a>
                                       <a class="dropdown-item pur_col" href="logout.php">LOGOUT</a>
                                   </div>
                               </li>
                               <?php } ?>
                                <li>
                                    <?php if(isset($_SESSION['user_logged_in'])){ ?>
                                        <a href="logout.php">
                                           <button type="button" class="btn btn-outline-primary btn-purple">Logout</button> 
                                        </a>
                                    <?php } else { ?>
                                    <a href="user_login.php">
                                        <button type="button" class="btn btn-outline-primary btn-purple">Login</button>
                                    </a>
                                    <?php } ?>
                                </li>
                           </ul>

                        </div>
                    </div>
                    
                </div>
            </div>
        </header>
        <!--Header End-->
       