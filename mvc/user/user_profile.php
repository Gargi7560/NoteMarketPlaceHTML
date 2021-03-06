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
        
        <!--User Profile Start--> 
        <section id="user_profile"> 
        <div class="common-top  pad_100_for_pages">
            <div class="content-box-lg">
                <div class="container">
                    <span class="common-heading-1 center_heading-1 main_heading">User Profile</span>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="content-box-sm">
            
            <form>
                <div class="home-heading">
                    <span class="common-heading-1 left_heading-1 common-head-pad">Basic Profile Details</span>   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="fname">First Name * </label>
                            <input type="text" class="form-control input_val" id="fname" placeholder="Enter your first name" required>
                            	
                            <span class="spnValMsg">Please fill out this field.</span> 
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="lname">Last Name * </label>
                            <input type="text" class="form-control input_val" id="lname" placeholder="Enter your last name" required>
                            	
                            <span class="spnValMsg">Please fill out this field.</span>
                            
                        </div>
                    </div>
                </div>
                               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control input_val" id="email" placeholder="Enter your email address">
                            
                            	
                            <span class="spnValMsg">The email address that you've entered is incorrect</span>
                        </div></div>
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="date-of-birth">Date Of Birth</label>
                            <input type="text" class="form-control input_val" id="date-of-birth" placeholder="Enter your date of birth">
                            <i class="common-icon pull-right"><img src="images/Profile/calendar.png"/></i>
                            <span class="spnValMsg">Please fill out this field.</span>
                        </div></div>
                </div>
                               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-common">
                            <label for="select-gender">Gender</label>
                            <select class="form-control dropdown-control" id="select-gender">
                                <option value="0">Select your gender</option>
                                <option value="1">Female</option>
                                <option value="2">Male</option>
                            </select>
                            <span class="spnValMsg">Please fill out this field.</span>
                        </div>
                    </div>
                            
                    <div class="col-md-6"><div class="form-group form-common">
                            <label for="phone-no">Phone Number</label>
                            <div class="row">
                                <div class="col-md-3 col-4">
                                    <select class="form-control dropdown-control" id="select-phone">
                                    <option value="1">+91</option>
                                    <option value="2">+1</option>
                                    <option value="3">+14</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-9 col-8">
                                    <input type="text" class="form-control input_val" id="phone-no" placeholder="Enter your phone number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="profile_picture">Profile Picture</label>
                                    <input type="file" class="form-control input_val" id="profile_picture" placeholder="Upload a picture">
                                    <label class="picture_bottom">Upload a picture</label>
                                    <span class="spnValMsg">Invalid extension</span>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </form>
                <div class="content-box-xs">
                    <form>
                        <div class="home-heading">
                            <span class="common-heading-1 left_heading-1 common-head-pad">Address Details</span>   
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="add1">Address Line 1 * </label>
                                    <input type="text" class="form-control input_val" id="add1" placeholder="Enter your address" required>
                                    	
                                    <span class="spnValMsg">Please fill out this field.</span>    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="add2">Address Line 2 * </label>
                                    <input type="text" class="form-control input_val" id="add2" placeholder="Enter your address" required>
                                    	
                                    <span class="spnValMsg">Please fill out this field.</span>    
                                </div>
                            </div>
                        </div>
                               
                        <div class="row">
                            <div class="col-md-6"><div class="form-group form-common">
                                    <label for="city">City *</label>
                                    <input type="text" class="form-control input_val" id="city" placeholder="Enter your city" required>
                                    
                                    	
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div></div>
                            <div class="col-md-6"><div class="form-group form-common">
                                    <label for="state">State *</label>
                                    <input type="text" class="form-control input_val" id="state" placeholder="Enter your state" required>
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div></div>
                        </div>
                               
                        <div class="row">
                            <div class="col-md-6"><div class="form-group form-common">
                                    <label for="zip1">ZipCode</label>
                                    <input type="zip" class="form-control input_val" id="zip1" placeholder="Enter your zipcode">
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div>
                                </div>
                            
                            <div class="col-md-6"><div class="form-group form-common">
                                    <label for="country">Country *</label>
                                    <select class="form-control dropdown-control" id="select-country">
                                        <option value="0">Select your country</option>
                                        <option value="1">India</option>
                                        <option value="2">US</option>
                                    </select>
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div></div>
                        </div>
                              
                    </form>
                </div>
        
                    <form>
                        <div class="home-heading">
                            <span class="common-heading-1 left_heading-1 common-head-pad">University and College Information</span>   
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="uni">University</label>
                                    <input type="text" class="form-control input_val" id="uni" placeholder="Enter your university" required> 
                                    <span class="spnValMsg">Please fill out this field.</span>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="college">College</label>
                                    <input type="text" class="form-control input_val" id="college" placeholder="Enter your college" required>
                                    <span class="spnValMsg">Please fill out this field.</span>
                                </div>
                            </div>
                        </div>
                               
                        <div class="row">
                            <div class="col-md-6"><div class="small-btn general-btn">
                                    <button type="button" class="btn btn-outline-primary btn-purple">SUBMIT</button>
                                </div></div>
                            <div class="col-md-6"></div>
                        </div>
                              
                    </form>
           
        </div>
        </div>
    </section>
        <!--User Profile End-->
        
        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->
        
        </div>
    
    </body>
</html>