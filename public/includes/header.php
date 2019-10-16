<?php
include 'includes/config.php';
global $con;

if(isset($_POST['subscribe'])){
    $email     = $_POST['email'];
    $sqlSelect = "SELECT * FROM subscribe WHERE subscribe_email='$email'";
    $resSelect = mysqli_query($con, $sqlSelect);
    if(mysqli_num_rows($resSelect) == 0){
        $sqlInsert = "INSERT INTO subscribe(subscribe_email) VALUE ('$email')";
        $resInsert = mysqli_query($con, $sqlInsert);
    }
    header("Refresh:0");exit;
}

$retrieveCategorySearch = "SELECT * FROM category";
$resultCategorySearch   = mysqli_query($con, $retrieveCategorySearch);

$retrieveLocation = "SELECT * FROM country";
$resultLocation   = mysqli_query($con, $retrieveLocation);
 ?>



<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/category-grid-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:22 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ClassiPost</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header-three" class="header-style1 header-fixed">
                <div class="header-top-bar top-bar-style1">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-8">
                                <div class="top-bar-left h-100">
                                    <div class="d-flex d-lg-none align-items-end h-100">
                                        <a href="shopping-cart.php" class="h5 text-white mb-0"><i
                                                class="fa fa-shopping-cart"></i><span style="font-weight:500;"
                                                class="badge badge-pill badge-light ml-2">
                                                <?php if(isset($_SESSION['carts'])){
                                            echo is_array($_SESSION['carts']) ? count($_SESSION['carts']) : 0;
                                        }else {
                                            echo "0";
                                        } ?>
                                            </span></a>
                                    </div>
                                    <p class="d-none d-lg-block">
                                        <i class="fa fa-life-ring" aria-hidden="true"></i>Have any questions? +088
                                        199990 or mail@classipost
                                    </p>
                                </div>
                            </div>
                            <?php if(!isset($_SESSION['user_id'])){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                                <div class="top-bar-right">
                                    <ul>
                                        <li>
                                            <a href="login.php" class="login-btn">
                                                <i class="fa fa-lock" aria-hidden="true"></i>Login
                                            </a>
                                        </li>
                                        <li class="hidden-mb">
                                            <a class="login-btn" href="singup.php">
                                                <i class="fa fa-lock" aria-hidden="true"></i>Signup
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primary" id="sticker">
                    <div class="container">
                        <div class="row no-gutters d-flex align-items-center">
                            <div class="col-lg-2 col-md-2 col-sm-3">
                                <div class="logo-area">
                                    <a href="index.php" class="img-fluid">
                                        <img src="img/logo.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 possition-static">
                                <div class="cp-main-menu">
                                    <nav>
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="about.php">Who We Are</a></li>
                                            <li><a href="how-it-works.php">How It Works?</a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 text-right">
                                <a href="shopping-cart.php" class="h4 text-white"><i
                                        class="fa fa-shopping-cart"></i><span style="font-weight:500;"
                                        class="badge badge-pill badge-light ml-2">
                                        <?php if(isset($_SESSION['carts'])){
                                    echo is_array($_SESSION['carts']) ? count($_SESSION['carts']) : 0;
                                  }else {
                                    echo "0";
                                  } ?>
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="about.php">Who We Are</a></li>
                                        <li><a href="how-it-works.php">How It Works?</a></li>
                                        <li><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>
        <!-- Header Area End Here -->





        <?php if(basename($_SERVER['PHP_SELF']) == "index.php"){ ?>
        <!-- Map Area Start Here -->
        <section class="map-layout1 fixed-menu-mt full-width-container">
            <div class="container-fluid">
                <div class="google-map-area" style="height: 300px; overflow: hidden;position: relative">
<!--                    <iframe width='100%' height='300px' id='mapcanvas' src='https://maps.google.com/maps?q=aqaba,Jordan&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=&amp;output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'><div class="zxos8_gm"><a href="https://sites.google.com/site/wistfulvariance/instant-free-vehicle-check">instant</a></div><div style='overflow:hidden;'><div id='gmap_canvas' style='height:100%;width:100%;'></div></div><div></div></iframe>-->
                        <img src="test.jpg" style="object-fit: cover;max-height: 100%;width: 100%">
                </div>
            </div>
        </section>
        <!-- Map Area End Here -->
        <!-- Search Area Start Here -->
        <section class="search-layout2 bg-accent">
            <div class="search-layout2-holder">
                <div class="container">
                    <form id="cp-search-form" class="bg-body search-layout2-inner">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="form-group search-input-area input-icon-location">
                                    <select id="location" class="select2">
                                        <option value="0">Select Location</option>
                                        <?php while($row = mysqli_fetch_assoc($resultLocation)){ ?>
                                        <option value="<?php echo $row['country_id']; ?>">
                                            <?php echo $row['country_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="form-group search-input-area input-icon-category">
                                    <select id="categories" class="select2">
                                        <option value="0">Select Categories</option>
                                        <?php while($row = mysqli_fetch_assoc($resultCategorySearch)){ ?>
                                        <option value="<?php echo $row['category_id']; ?>">
                                            <?php echo $row['name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="form-group search-input-area input-icon-keywords">
                                    <input placeholder="Enter Keywords here ..." value="" name="key-word" type="text">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 text-right text-left-mb">
                                <a href="#" class="cp-search-btn"><i class="fa fa-search"
                                        aria-hidden="true"></i>Search</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Search Area End Here -->
        <?php

        } else { ?>
        <!-- Search Area Start Here -->
        <section class="search-layout1 bg-body full-width-border-bottom fixed-menu-mt">
            <div class="container">
                <form id="cp-search-form">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-location">
                                <select id="location" class="select2">
                                    <option class="first" value="0">Select Location</option>
                                    <?php while($row = mysqli_fetch_assoc($resultLocation)){ ?>
                                    <option value="<?php echo $row['country_id']; ?>">
                                        <?php echo $row['country_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-category">
                                <select id="categories" class="select2">
                                    <option class="first" value="0">Select Categories</option>
                                    <?php while($row = mysqli_fetch_assoc($resultCategorySearch)){ ?>
                                    <option value="<?php echo $row['category_id'] ?>"><?php echo $row['name_en']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-keywords">
                                <input placeholder="Enter Keywords here ..." value="" name="key-word" type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 text-right text-left-mb">
                            <a href="#" class="cp-search-btn">
                                <i class="fa fa-search" aria-hidden="true"></i>Search
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Search Area End Here -->
        <?php } ?>