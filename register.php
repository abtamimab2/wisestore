<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<noscript>
        <meta http-equiv="refresh" content="0;url=no-javascript.php">
    </noscript>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <title>WISE WORLD STORE</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="../../assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="../../assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="../../assets/css/vendor/jquery-ui.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../../assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="../../assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="../../assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="../../assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="../../assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="../../assets/css/plugins/aos.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../webroot/css/myStyle.css">

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->

</head>

<body style="background-color: #ffffff;">




<!-- start of Register files -->





    <!-- ...:::: Start Customer Login Section :::... -->
<div class="longin-body">
    <div class="customer-login">
        <div class="container">
            <div class="row">

                <!--register area start-->
                <div class="col-lg-12 col-md-12">
                    <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                        <form action="#" enctype="multipart/form-data" method="post">
                            <input hidden name="productID" value="<?php
                            include_once('../phpProces/startsession.php');
                            if(isset($_SESSION['productID'])){
                                $productID = $_SESSION['productID'];
                                echo $productID;
                            }
                            ?>" />
                            <div class="default-form-box">
                                <label for="firstName">First Name <span>*</span></label>
                                <input required class="form-control" pattern="[A-Za-z]+" required name="firstName" placeholder="Enter Your First Name" />
                                <span class="text-danger invalid-fname">First name must be 3 - 15 just character and andrescore ( _ )</span>
                                <span class="text-success valid-fname"><i class="fa fa-check-circle"></i> First Name is valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="lastName">Last Name <span>*</span></label>
                                <input required class="form-control" pattern="[A-Za-z]+" required name="lastName" placeholder="Enter Your last Name" />
                                <span class="text-danger invalid-lname">Last name must be 3 - 15 just character and andrescore ( _ )</span>
                                <span class="text-success valid-lname"><i class="fa fa-check-circle"></i> Last Name is valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="userName">Username <span>*</span></label>
                                <input required class="form-control" name="userName" pattern="[a-zA-Z0-9_]+" placeholder="Enter Your Userame" />
                                <span class="text-danger invalid-uname">Username must be 3 - 15 just character and andrescore ( _ )</span>
                                <span class="text-success valid-uname"><i class="fa fa-check-circle"></i> User is valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="phoneNumber">Phone <span>*</span></label>
                                <input class="form-control"  name="phoneNumber" pattern="[0-9]{10}" required placeholder="Enter Your Phone Number" />
                                <span class="text-danger invalid-pn">Phone Number must be 10 number with leading zero ( 0 )</span>
                                <span class="text-success valid-pn"><i class="fa fa-check-circle"></i> Phone number is valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="address">Address <span>*</span></label>
                                <input class="form-control"  name="address" pattern="[A-Za-z]+" required placeholder="Enter Your Address" />
                                <span class="text-danger invalid-address">You can use alphanumeric characters, spaces, hyphens, commas, periods, and hash symbols</span>
                                <span class="text-success valid-address"><i class="fa fa-check-circle"></i> Address is valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="email">Email <span>*</span></label>
                                <input required class="form-control" name="email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" placeholder="Enter Your Email" />
                                <span class="text-danger" id="email-unique"></span>
                                <span class="text-danger invalid-email">Your email is Invalid</span>
                                <span class="text-success valid-email"><i class="fa fa-check-circle"></i> Email is valid</span>
                            </div>
                            <div class="default-form-box ">
                                <label for="gender">Gender <span>*</span></label>
                                <label for="male-radio" style="display: inline;">Male</label>
                                <input type="radio" checked name="gender" style="width:20px;" value="1" id="male-radio">

                                <label for="female-radio" style="display: inline !important;">Female</label>
                                <input type="radio"  name="gender" style="width:20px;" value="0" id="female-radio">
                            </div>
                            <div class="default-form-box">
                                <label for="dob">Date Of Birth <span>*</span></label>
                                <input required class="form-control" type="date" name="dob" placeholder="Enter Your Email" />
                                <span class="text-danger invalid-dob">Your Date of Birth Must be between 7 and 100</span>
                                <span class="text-success valid-dob"><i class="fa fa-check-circle"></i> Date of birth is valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" required class="form-control" name="password" placeholder="Enter Your Password" />
                                <span class="text-danger invalid-password">Password must be (8 - 20) character and must contain alphabit, and number and character </span>
                                <span class="text-success valid-password"><i class="fa fa-check-circle"></i> Password is Valid</span>
                            </div>
                            <div class="default-form-box">
                                <label for="confirmpassword">Confirm Password <span>*</span></label>
                                <input type="password" required class="form-control" name="confirmpassword" placeholder="Retype Password" />
                                <span class="text-danger invalid-cpassword">Password Does not match</span>
                                <span class="text-success valid-cpassword"><i class="fa fa-check-circle"></i> Password Confirmed</span>
                            </div>
                            <div class="default-form-box">
                                <div class="custom-file">
                                    <label for="Photo" class="custom-file-label">Profile Picture <span>*</span></label>
                                    <input required class="form-control custom-file-input" type="file" name="fileToUpload" id="fileToUpload" />
                                    <span class="text-danger invalid-image">Please select image image(jpg,jpeg,png,gif) less than 2MB</span>
                                    <span class="text-success valid-image"><i class="fa fa-check-circle"></i> Image Selected</span>
                                    <div id="disp_tmp_path"></div>
                                </div>
                            </div>
                            <div class="default-form-box">
                                <div style="height:200px;" class=" w-100 text-center ">
                                    <img class="h-100  imagepreview rounded-circle  " style="width:200px;" alt="photo" src="webroot/images/users/user.png" />
                                </div>
                            </div>

                            <div class="login_submit ">
                                <button class="btn btn-md btn-black-default-hover" id="register-btn" type="submit">Register</button>
                            </div>
                            <div class=" error-box text-center mt-6"><h4 class="text-danger">Please fill the <i class="fa fa-arrow-circle-up"></i> above errors...</h4></div>
                            <div class=" text-center mt-6"><h4 class="text-danger" id="php-error-box"></h4></div>
                        </form>
                    </div>
                    <div class="text-center mb-4">
                        <a href="index.php"><i class="fa fa-arrow-left mt-7"></i> Back To Home Page</a>
                    </div>
                </div>
                <!--register area end-->


            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->
<div>








<!-- end of register files -->









    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <script src="../../assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="../../assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="../../assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/jquery-ui.min.js"></script>

    <!--Plugins JS-->
    <script src="../../assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="../../assets/js/plugins/material-scrolltop.js"></script>
    <script src="../../assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="../../assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="../../assets/js/plugins/venobox.min.js"></script>
    <script src="../../assets/js/plugins/jquery.waypoints.js"></script>
    <script src="../../assets/js/plugins/jquery.lineProgressbar.js"></script>
    <script src="../../assets/js/plugins/aos.min.js"></script>
    <script src="../../assets/js/plugins/jquery.instagramFeed.js"></script>
    <script src="../../assets/js/plugins/ajax-mail.js"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script> -->

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>
    <script src="../../webroot/js/JavaScript.js"></script>
    <script src="../../webroot/js/uploads.js"></script>
</body>


</html>