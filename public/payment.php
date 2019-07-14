<?php
  session_start();
  if(isset($_POST['add_address'])){
    if(!isset($_SESSION['address'])){
      $_SESSION['address'] = array();
    }
    $_SESSION['address']['full_name']    = $_POST['full_name'];
    $_SESSION['address']['email']        = $_POST['email'];
    $_SESSION['address']['address_line'] = $_POST['address_line'];
    $_SESSION['address']['city']         = $_POST['city'];
    $_SESSION['address']['country']      = $_POST['country'];
    header("Location: payment.php");
  }
?>
<!DOCTYPE html>
<html class="no-js">
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
  <!-- Font-awesome CSS-->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Magnific CSS -->
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <style>
  .progressbar {
        counter-reset: step;
    }
    .progressbar li {
        list-style-type: none;
        width: 25%;
        float: left;
        font-size: 16px;
        position: relative;
        text-align: center;
        text-transform: uppercase;
        color: #7d7d7d;
        z-index:999
    }
    .progressbar li:before {
        width: 30px;
        height: 30px;
        content: counter(step);
        counter-increment: step;
        line-height: 30px;
        border: 2px solid #7d7d7d;
        display: block;
        text-align: center;
        margin: 0 auto 10px auto;
        border-radius: 50%;
        background-color: white;
        z-index:99
    }
    .progressbar li:after {
        width: 100%;
        height: 2px;
        content: '';
        position: absolute;
        background-color: #7d7d7d;
        top: 15px;
        left: calc(-50% + 15px);
        z-index: -1;
    }
    .progressbar li:first-child:after {
        content: none;
    }
    .progressbar li.active {
        color: green;
    }
    .progressbar li.active:before {
        border-color: #55b776;
    }
    .progressbar li.active + li:after {
        background-color: #55b776;
    }
    .font-weight-light{
      font-weight:300 !important
    }
    .custom-control-input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .custom-control-label {
        position: relative;
        margin-bottom: 0;
    }
    .custom-control-label::before {
        position: absolute;
        top: .25rem;
        left: -1.5rem;
        display: block;
        width: 1rem;
        height: 1rem;
        pointer-events: none;
        content: "";
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #dee2e6;
    }
    .custom-control-label::before, .custom-file-label, .custom-select {
        transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .custom-radio .custom-control-label::before {
        border-radius: 50%;
    }
    .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        background-color: #007bff;
    }
    .custom-radio .custom-control-input:checked~.custom-control-label::before {
        background-color: #007bff;
    }
    .custom-control-label::after {
        position: absolute;
        top: calc( 50% - 0.25rem );
        left: -20px;
        display: block;
        width: 0.5rem;
        height: 0.5rem;
        content: "";
        border-radius: 50%;
    }
    .custom-radio .custom-control-input:checked~.custom-control-label::after {
        background-color: #fff
    }
  </style>
</head>
<body style="height:100vh">
  <!--[if lt IE 8]>
          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
  <!-- Add your site or application content here -->
  
  <div class="container-fluid">
    <div class="row">
      <div class="col d-none d-md-block py-5">
        <ul class="progressbar">
          <li class="active">Singin</li>
          <li class="active">Address</li>
          <li>Payment</li>
          <li>Done</li>
        </ul>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row mt-3">
      <div class="col-12">
        <div class="h3">
            Payment
        </div>
        <p class="mt-2 text-muted h6 font-weight-light">Choose the right payment method for you.</p>
      </div>
      <form class="mt-2 mt-md-5 col-12 col-md-6" action="address.php" method="post">
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
            <label class="custom-control-label" for="customRadio1">Toggle the first option</label>
        </div>
      </form>
      <div class="col-12 ml-md-auto col-md-4 mt-2 mt-md-5 py-4">
        <div class="card border-dark">
          <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <div class="dropdown-divider border-dark"></div>
            <ul>
              <li class="py-2 pt-3 position-relative">Subtotal<span style="position: absolute; right: 0">14602 $</span></li>
              <li class="py-2 position-relative">Shipping & Delivery<span style="position: absolute; right: 0">0 $</span></li>
              <li class="py-2 position-relative">Tax<span style="position: absolute; right: 0">0 $</span></li>
              <li class="py-2 h4 mb-0 position-relative">Total<span style="position: absolute; right: 0">14602 $</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- jquery-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <!-- Popper js -->
  <script src="js/popper.js"></script>
  <!-- Bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Owl Cauosel JS -->
  <script src="vendor/OwlCarousel/owl.carousel.min.js"></script>
  <!-- Meanmenu Js -->
  <script src="js/jquery.meanmenu.min.js"></script>
  <!-- Srollup js -->
  <script src="js/jquery.scrollUp.min.js"></script>
  <!-- jquery.counterup js -->
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <!-- Select2 Js -->
  <script src="js/select2.min.js"></script>
  <!-- Isotope js -->
  <script src="js/isotope.pkgd.min.js"></script>
  <!-- Magnific Popup -->
  <script src="js/jquery.magnific-popup.min.js"></script>
  <!-- jQuery Zoom -->
  <script src="js/jquery.zoom.min.js"></script>
  <!-- Google Map js -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>
</body>
</html>