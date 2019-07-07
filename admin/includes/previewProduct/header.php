<?php
include 'includes/config.php';
global $con;

$retrieveCategorySearch = "SELECT * FROM category";
$resultCategorySearch   = mysqli_query($con, $retrieveCategorySearch);

$retrieveLocation = "SELECT * FROM address";
$resultLocation   = mysqli_query($con, $retrieveLocation);
 ?>



<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/category-grid-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:22 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ClassiPost</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="includes/previewProduct/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="includes/previewProduct/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="includes/previewProduct/css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="includes/previewProduct/css/font-awesome.min.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="includes/previewProduct/vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="includes/previewProduct/vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="includes/previewProduct/css/meanmenu.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="includes/previewProduct/css/select2.min.css">
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="text/css" href="includes/previewProduct/css/magnific-popup.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="includes/previewProduct/style.css">
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
                                <div class="top-bar-left">
                                    <a href="#" class="cp-default-btn d-lg-none">Post Your Ad</a>
                                    <p class="d-none d-lg-block">
                                        <i class="fa fa-life-ring" aria-hidden="true"></i>Have any questions? +088 199990 or mail@classipost
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                                <div class="top-bar-right">
                                    <ul>
                                        <li>
                                            <button type="button" class="login-btn" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-lock" aria-hidden="true"></i>Login
                                            </button>
                                        </li>
                                        <li class="hidden-mb">
                                            <a class="login-btn" href="#" id="login-button">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i>Live Chat
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primary" id="sticker">
                    <div class="container">
                        <div class="row no-gutters d-flex align-items-center">
                            <div class="col-lg-2 col-md-2 col-sm-3">
                                <div class="logo-area">
                                    <a href="index-2.html" class="img-fluid">
                                        <img src="includes/previewProduct/img/logo.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 possition-static">
                                <div class="cp-main-menu">
                                    <nav>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">Who We Are</a></li>
                                            <li><a href="#">How It Works?</a></li>
                                            <li><a href="#">Features</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 text-right">
                                <a href="#" class="cp-default-btn">Post Your Ad</a>
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
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Who We Are</a></li>
                                        <li><a href="#">How It Works?</a></li>
                                        <li><a href="#">Features</a></li>
                                        <li><a href="#">Contact</a></li>
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
                                        <option value="<?php echo $row['address_id']; ?>"><?php echo $row['city']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                              <div class="form-group search-input-area input-icon-category">
                                  <select id="categories" class="select2">
                                      <option class="first" value="0">Select Categories</option>
                                      <?php while($row = mysqli_fetch_assoc($resultCategorySearch)){ ?>
                                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['name_en']; ?></option>
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
