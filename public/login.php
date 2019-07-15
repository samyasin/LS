<?php
session_start();
include 'includes/config.php';
global $con;
$msg = "";
$url = "";
if(isset($_SERVER['HTTP_REFERER'])){
  $url = $_SERVER['HTTP_REFERER'];
}
if(strpos($url, "shopping-cart")){
  $url = "address.php";
}else{
  $url = "index.php";
}
if(!isset($_SESSION['url'])){
  $_SESSION['url'] = $url;
}



if(isset($_POST['login'])){
  $email = $_POST['email'];
  $pass  = md5($_POST['password']);
  $sql   = "SELECT * FROM users WHERE user_email='$email' AND user_password='$pass'";
  $res   = mysqli_query($con, $sql);
  if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
      $user_id = $row['user_id'];
    }
    $_SESSION['user_id'] = $user_id;
    $url = $_SESSION['url'];
    header("Location: $url");
    exit();
  }else {
    $msg = "Email or Password is incorrect";
  }
}

if(isset($_SESSION['user_id'])){
  header("Location: index.php");
  exit();
}


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
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
</head>
<body class="bg-dark" style="height:100vh">

  <div class="container h-100">
    <div class="row h-100 d-flex align-items-center">
      <div class="col-10 col-md-8 col-lg-6 mx-auto">
        <div class="card text-center shadow-lg">
          <div class="card-header">
            <h3 class="card-title">Login</h3>
          </div>
          <div class="card-body text-left">
          <?php if($msg != ""){ ?>
            <div class="alert alert-danger text-center" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php } ?>
            <form class="" action="login.php" method="post">
              <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-dark" name="login" value="login">Login</button>
            </form>
          </div>
        </div>
        <div class="text-center text-light py-4">
          If you not have account <a class="text-warning h6" href="singup.php">Registration</a>
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
  <!-- Magnific Popup -->
  <script src="js/jquery.magnific-popup.min.js"></script>
</body>
</html>
