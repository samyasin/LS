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
                                <div class="top-bar-left">
                                    <a href="post-ad.html" class="cp-default-btn d-lg-none">Post Your Ad</a>
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
                                        <img src="img/logo.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 possition-static">
                                <div class="cp-main-menu">
                                    <nav>
                                        <ul>
                                            <li><a href="#">Home</a>
                                                <ul class="cp-dropdown-menu">
                                                    <li><a href="index-2.html">Home 1</a></li>
                                                    <li><a href="index2.html">Home 2</a></li>
                                                    <li><a href="index3.html">Home 3</a></li>
                                                    <li><a href="index4.html">Home 4</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="about.html">Who We Are</a></li>
                                            <li><a href="how-it-works.html">How It Works?</a></li>
                                            <li class="menu-justify active"><a href="#">Pages</a>
                                                <div class="rt-dropdown-mega container">
                                                    <div class="rt-dropdown-inner">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <ul class="rt-mega-items">
                                                                    <li><a href="index-2.html">Home 1</a></li>
                                                                    <li><a href="index2.html">Home 2</a></li>
                                                                    <li><a href="index3.html">Home 3</a></li>
                                                                    <li><a href="index4.html">Home 4</a></li>
                                                                    <li><a href="pricing.html">Pricing Plan</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <ul class="rt-mega-items">
                                                                    <li class="active"><a href="category-grid-layout1.html">Grid View 1</a></li>
                                                                    <li><a href="category-grid-layout2.html">Grid View 2</a></li>
                                                                    <li><a href="category-grid-layout3.html">Grid View 3</a></li>
                                                                    <li><a href="category-list-layout1.html">List View 1</a></li>
                                                                    <li><a href="category-list-layout2.html">List View 2</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <ul class="rt-mega-items">
                                                                    <li><a href="category-list-layout3.html">List View 3</a></li>
                                                                    <li><a href="single-product-layout1.html">Product Details 1</a></li>
                                                                    <li><a href="single-product-layout2.html">Product Details 2</a></li>
                                                                    <li><a href="single-product-layout3.html">Product Details 3</a></li>
                                                                    <li><a href="favourite-ad-list.html">Favourite Ad</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <ul class="rt-mega-items">
                                                                    <li><a href="my-account.html">My Account</a></li>
                                                                    <li><a href="login.html">Login</a></li>
                                                                    <li><a href="post-ad.html">Post Ad</a></li>
                                                                    <li><a href="report-abuse.html" data-toggle="modal" data-target="#report_abuse">Report Abuse</a></li>
                                                                    <li><a href="faq.html">Faq</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="category-grid-layout1.html">Features</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 text-right">
                                <a href="post-ad.html" class="position-relative" style="z-index:999">
                                  <i class="fa fa-shopping-cart fa-4x text-light" style="position:absolute;top:-80%;left:-140%;z-index:-1"></i>
                                  <span class="text-warning" style="font-size:1.5rem">9</span>
                                </a>
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
                                        <li><a href="#">Home</a>
                                            <ul>
                                                <li><a href="index-2.html">Home 1</a></li>
                                                <li><a href="index2.html">Home 2</a></li>
                                                <li><a href="index3.html">Home 3</a></li>
                                                <li><a href="index4.html">Home 4</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about.html">Who We Are</a></li>
                                        <li><a href="how-it-works.html">How It Works?</a></li>
                                        <li><a href="#">Pages</a>
                                            <ul>
                                                <li><a href="pricing.html">Pricing Plan</a></li>
                                                <li><a href="category-grid-layout1.html">Grid View 1</a></li>
                                                <li><a href="category-grid-layout2.html">Grid View 2</a></li>
                                                <li><a href="category-grid-layout3.html">Grid View 3</a></li>
                                                <li><a href="category-list-layout1.html">List View 1</a></li>
                                                <li><a href="category-list-layout2.html">List View 2</a></li>
                                                <li><a href="category-list-layout3.html">List View 3</a></li>
                                                <li><a href="single-product-layout1.html">Product Details 1</a></li>
                                                <li><a href="single-product-layout2.html">Product Details 2</a></li>
                                                <li><a href="single-product-layout3.html">Product Details 3</a></li>
                                                <li><a href="favourite-ad-list.html">Favourite Ad</a></li>
                                                <li><a href="login.html">Login</a></li>
                                                <li><a href="my-account.html">My Account</a></li>
                                                <li><a href="post-ad.html">Post Ad</a></li>
                                                <li><a href="report-abuse.html" data-toggle="modal" data-target="#report_abuse">Report Abuse</a></li>
                                                <li><a href="faq.html">Faq</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="category-grid-layout1.html">Features</a></li>
                                        <li><a href="contact.html">Contact</a></li>
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
                  <div class="google-map-area">
                      <div id="googleMap" style="width:100%; height:400px;"></div>
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
                                            <option value="<?php echo $row['location_id']; ?>"><?php echo $row['city']; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                  <div class="form-group search-input-area input-icon-category">
                                      <select id="categories" class="select2">
                                          <option value="0">Select Categories</option>
                                          <?php while($row = mysqli_fetch_assoc($resultCategorySearch)){ ?>
                                            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name_en']; ?></option>
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
                                  <a href="#" class="cp-search-btn"><i class="fa fa-search" aria-hidden="true"></i>Search</a>
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
                                        <option value="<?php echo $row['location_id']; ?>"><?php echo $row['city']; ?></option>
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
      <?php } ?>
