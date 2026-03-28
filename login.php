<?php 
include_once("pages/phpProces/connection.php");
include_once("pages/phpProces/startsession.php");

if(isset($_GET['productID'])){
    $productID = filter_var($_GET['productID'],FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['productID'] = $productID;
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $email = filter_var($_REQUEST["email"],FILTER_SANITIZE_EMAIL);
    $password =$_REQUEST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if(!$email){
        $_SESSION['login'] = "Email is required";
    }else if(!$password){
        $_SESSION['login'] = "Password is required";
    }else{

        $result =$conn->query("SELECT COUNT(*) FROM users WHERE email = '$email'")->fetch_array()[0];
        if($result == 1)
        {
            $sql = "SELECT * FROM users where email='$email'";
            $result =$conn->query($sql);
            $user_db = $result->fetch_assoc();
            $user_password = $user_db['password'];
            // echo $user_password." = ".$hashed_password;
            // die();
            if(password_verify($password,$user_password)){
                $_SESSION["userID"] = $user_db["userID"];
                $_SESSION["userType"] = $user_db["userType"];
                if($_SESSION["userType"] == "admin")
                {
                    header("location:../admin/dashboard.php");
                    exit();
                }else{
                    if(isset($_GET['productID'])){
                        $productID = filter_var($_GET['productID'],FILTER_SANITIZE_NUMBER_INT);
                        header("location:productDetails.php?productID=$productID");
                        die();
                    }
                    header("location:index.php");
                    die();
                }
            }else{
                $_SESSION['login'] = "email or password is incorect";
            }



            
        }else{
            $_SESSION['login'] = "email or password is incorect";
        }

    }

}



?>




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
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="webroot/css/myStyle.css">

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->

</head>

<body>




<!-- start of Register files -->







<!-- ...:::: Start Customer Login Section :::... -->
<div class="longin-body">
    <div class="customer-login">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-12 col-md-12">
                    <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                        <form action="#" method="POST">
                            <div class="default-form-box">
                                <label>Email <span>*</span></label>
                                <input class="form-control" id="email" name="email" placeholder="Enter Your Email" />
                            </div>
                            <div class="default-form-box">
                                <label>Passwords <span>*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover mb-4" type="submit">login</button>
                                <a href="register.php">Create New Account</a>
                                <a href="forgotPassword.php">Forgot Password?</a>

                            </div>
                        </form>
                        <div class="text-center text-danger">
                            <h4 class="text-danger pb-3"><?php
                            if(isset($_SESSION['login'])){
                                echo $_SESSION['login'];
                                unset($_SESSION['login']);
                            }
                            ?></h4>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="index.php"><i class="fa fa-arrow-left mt-7"></i> Back To Home Page</a>
                    </div>
                </div>
                <!--login area start-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->
</div>








<!-- end of register files -->





    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>

    <!--Plugins JS-->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/material-scrolltop.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/venobox.min.js"></script>
    <script src="assets/js/plugins/jquery.waypoints.js"></script>
    <script src="assets/js/plugins/jquery.lineProgressbar.js"></script>
    <script src="assets/js/plugins/aos.min.js"></script>
    <script src="assets/js/plugins/jquery.instagramFeed.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script> -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="webroot/js/JavaScript.js"></script>
</body>


</html>