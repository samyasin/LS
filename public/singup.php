<?php
session_start();
include 'includes/config.php';
global $con;
$msg = "";

if(isset($_POST['ajax']) && isset($_POST['country_id'])){
  $country_id = $_POST['country_id'];
  $sql = "SELECT * FROM city WHERE country_id='$country_id'";
  $res = mysqli_query($con, $sql);
  while($city = mysqli_fetch_assoc($res)){
    $city_id = $city['city_id'];
    $city_name = $city['city_name'];
    echo "<option value='$city_id'>$city_name</option>";
  }
  exit;
}

if(isset($_POST['singup'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $gender = $_POST['gender'];
  $phone_number = $_POST['phone_number'];
  $country_id = $_POST['country'];
  $city_id = $_POST['city'];
  $address_line = $_POST['address_line'];

  $sql = "SELECT user_email FROM users WHERE user_email='$email'";
  $res = mysqli_query($con, $sql);
  if(mysqli_num_rows($res) > 0){
    $msg = "This user is exist.";
  }else{
    $insert    = "INSERT INTO users(user_email,user_password,user_fname,user_lname,user_gender,user_phone,address_line,city,country) VALUE ('$email','$password','$fname','$lname','$gender','$phone_number','$address_line','$city','$country')";
    $resInsert = mysqli_query($con, $insert);
    $_SESSION['user_id'] = mysqli_insert_id($con);
    header("Location: index.php");
  }
}

$select_country = "SELECT * FROM country ORDER BY country_name";
$result_country = mysqli_query($con, $select_country);
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
            <div class="col-12 mt-2 mt-lg-0 col-md-8 col-lg-6 mx-auto">
                <div class="card text-center shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title text-uppercase mb-0">Singup</h3>
                    </div>
                    <div class="card-body text-left">
                        <?php if($msg != ""){ ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $msg; ?>
                        </div>
                        <?php } ?>
                        <form id="singup" class="" action="singup.php" method="post">
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="fname"
                                        aria-describedby="emailHelp" placeholder="Enter email" required>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lname"
                                        aria-describedby="emailHelp" placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" id="cpassword"
                                    placeholder="Password" autocomplete="off" required aria-describedby="cpasswordHelper">
                                    <small id="cpasswordHelper" class="form-text text-danger d-none">Not the same password.</small>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" id="phone_number"
                                    placeholder="Phone Number" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <label for="country">Country</label>
                                    <select class="form-control" name="country" id="country" required>
                                        <option value="" selected disabled hidden>Select Country</option>
                                        <?php if(mysqli_num_rows($result_country) > 0){
                                    while($country = mysqli_fetch_assoc($result_country)){ ?>
                                        <option value="<?php echo $country['country_id']; ?>">
                                            <?php echo $country['country_name']; ?></option>
                                        <?php  }
                                }?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="city">City</label>
                                    <select class="form-control" name="city" id="city" required>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address_line">Address Line</label>
                                <input type="text" name="address_line" class="form-control" id="address_line"
                                    placeholder="Address Line" autocomplete="off" required>
                            </div>
                            <button type="submit" class="btn btn-dark" name="singup" value="singup">Singup</button>
                        </form>
                    </div>
                </div>
                <div class="text-center text-light py-4">
                    If you have account <a class="text-warning h6" href="login.php">Login</a>
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
    <script>
    $(document).ready(function() {
        $('#country').on('change', function() {
            var value = $(this).val();
            $.ajax({
                type: 'post',
                url: 'singup.php',
                cache: false,
                data: {
                    ajax: 1,
                    country_id: value
                },
                success: function(data) {
                    $('#city').html(data);
                }

            });
        });

        $("#singup").submit(function(){
          if($('#password').val() != $('#cpassword').val()){
            $('#cpasswordHelper').removeClass('d-none');
            $('#cpassword').css('border-color','#dc3545');
            return false;
          }
        });
    });
    </script>
</body>

</html>