<?php 
    
    //Settings from Config file
    include '../common/configuration.php';

?>

<!--Header Start-->

<header class="site-header">
    <div class="container">
        <div class="header-wrapper">
            <div class="logo-wrapper">
                <a class="navbar-brand" href="admin_dashboard-1.php"><img src="images/logo_pur/top-logo.png" alt="logo"></a>

                <!--Mobile Menu Open Button-->
                <span id="mobile-nav-open-btn">&#9776;</span>

            </div>
            <div class="navigation-wrapper">
                <nav class="main-nav navbar navbar-expand-md">
                    <div class="collapse navbar-collapse">

                        <ul class="menu-navigation">
                            <li><a href="admin_dashboard-1.php" class="val_content">Dashboard</a></li>
                            <li class="dropdown">
                                <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notes
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="notes_under_review.php">Notes Under Review</a>
                                    <a class="dropdown-item" href="published_note.php">Published Notes</a>
                                    <a class="dropdown-item" href="downloaded_notes.php">Downloaded Notes</a>
                                    <a class="dropdown-item" href="rejected_notes.php">Rejected Notes</a>
                                </div>
                            </li>
                            <li><a href="members_page.php" class="val_content">Members</a></li>
                            <li class="dropdown">
                                <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Reports
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="spam_reports.php">Spam Reports</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php   
                                if(isset($_SESSION['user_logged_in']) && $_SESSION['user_id'] == $defaultUserID) {
                                    echo '<a class="dropdown-item" href="manage_sys_configuration.php">Manage System Configurations</a>
                                    <a class="dropdown-item" href="manage_administrator.php">Manage Administrator</a>';
                                } 
                                ?>
                                    <a class="dropdown-item" href="manage_category.php">Manage Category</a>
                                    <a class="dropdown-item" href="manage_type.php">Manage Type</a>
                                    <a class="dropdown-item" href="manage_country.php">Manage Countries</a>
                                </div>
                            </li>
                            
                            <!--Profile file in header-->
                            <?php if(isset($_SESSION['user_logged_in'])){ ?>
                            
                            <li class="dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?php echo $_SESSION['profile_pic'];
                                    ?>" alt="user" class="img-responsive">
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="admin_profile.php">My Profile</a>
                                    <a class="dropdown-item" href="admin_change_pwd.php">Change Password</a>
                                    <a class="dropdown-item pur_col" href="logout.php">LOGOUT</a>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <!--Logout and Login button-->
                            <li>
                            <?php if(isset($_SESSION['user_logged_in'])){ ?>   
                                <a href="logout.php">
                                    <button type="button" class="btn btn-outline-primary btn-purple">Logout</button> 
                                </a>
                                <?php } else { ?>
                                <a href="admin_login.php">
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
                        <li><a href="downloaded_notes.html" class="val_content">Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Notes
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="notes_under_review.php">Notes Under Review</a>
                                <a class="dropdown-item" href="published_note.php">Published Notes</a>
                                <a class="dropdown-item" href="downloaded_notes.php">Downloaded Notes</a>
                                <a class="dropdown-item" href="rejected_notes.php">Rejected Notes</a>

                            </div>
                        </li>
                        <li><a href="members_page.html" class="val_content">Members</a></li>
                        <li class="dropdown">
                            <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Reports
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="spam_reports.php">Spam Reports</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" role="button" class="val_content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Settings
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php   
                            if(isset($_SESSION['user_logged_in']) && $_SESSION['user_id'] == $defaultUserID) {
                                echo '<a class="dropdown-item" href="manage_sys_configuration.php">Manage System Configurations</a>
                                <a class="dropdown-item" href="manage_administrator.php">Manage Administrator</a>';
                            } 
                            ?>
                                <a class="dropdown-item" href="manage_category.php">Manage Category</a>
                                <a class="dropdown-item" href="manage_type.php">Manage Type</a>
                                <a class="dropdown-item" href="manage_country.php">Manage Countries</a>
                            </div>
                        </li>
                            
                        <!--Profile file in header-->
                        <?php if(isset($_SESSION['user_logged_in'])){ ?>
                            
                        <li class="dropdown">
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php 
                                echo $_SESSION['profile_pic'];
                                ?>" alt="user" class="img-responsive">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="admin_profile.php">My Profile</a>
                                <a class="dropdown-item" href="admin_change_pwd.php">Change Password</a>
                                <a class="dropdown-item pur_col" href="logout.php">LOGOUT</a>
                            </div>
                        </li>
                        <?php } ?>
                        
                        <!--Logout and Login button-->
                        <li>
                        <?php if(isset($_SESSION['user_logged_in'])){ ?>   
                            <a href="logout.php">
                                <button type="button" class="btn btn-outline-primary btn-purple">Logout</button> 
                            </a>
                            <?php } else { ?>
                            <a href="admin_login.php">
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