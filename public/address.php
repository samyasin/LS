<?php session_start();
include 'includes/config.php';
global $con;
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

if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
}


if(isset($_POST['add_address'])){
  if(!isset($_SESSION['address'])){
    $_SESSION['address'] = array();
  }
  $_SESSION['address']['address_line'] = $_POST['address_line'];
  $_SESSION['address']['city']         = $_POST['city_id'];
  $_SESSION['address']['country']      = $_POST['country_id'];
  header("Location: payment.php");
}

$select_country = "SELECT * FROM country ORDER BY country_name";
$result_country = mysqli_query($con, $select_country);


$user_id = $_SESSION['user_id'];
$sqlCustomer = "SELECT * FROM users WHERE user_id='$user_id'";
$resCustomer = mysqli_query($con, $sqlCustomer);
?>
<?php include 'includes/header.php'; ?>

<section class="s-space-bottom-full bg-accent-shadow-body">
    <div class="container">
        <div class="breadcrumbs-area">
            <ul>
                <li><a href="index.php">Home</a> -</li>
                <li><a href="shopping-cart.php">Shopping Cart</a> -</li>
                <li class="active">Address</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="gradient-wrapper item-mb">
                    <div class="gradient-title">
                        <h2>Address</h2>
                    </div>
                    <div class="gradient-padding reduce-padding">
                        <form action="address.php" method="post">
                            <?php while($row = mysqli_fetch_assoc($resCustomer)){ ?>
                            <div class="form-group col-12">
                                <label for="country">Country</label>
                                <div class="input-group">
                                    <select id="country" class="form-control" name="country_id" required>
                                        <option value="" selected disabled hidden>Select Country</option>
                                        <?php if(mysqli_num_rows($result_country) > 0){
                                    while($country = mysqli_fetch_assoc($result_country)){ ?>
                                        <option value="<?php echo $country['country_id']; ?>" <?php if($row['country_id'] == $country['country_id']) echo "selected"; ?>>
                                            <?php echo $country['country_name']; ?></option>
                                        <?php  }
                                }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="city">City</label>
                                <div class="input-group">
                                    <select class="form-control" name="city_id" id="city" required>
                                        <?php
                                          $country_id_city = $row['country_id'];
                                          $sqlCity = "SELECT * FROM city WHERE country_id='$country_id_city'";
                                          $resCity = mysqli_query($con, $sqlCity);
                                          while($city = mysqli_fetch_assoc($resCity)){ ?>
                                          <option value="<?php echo $city['city_id']; ?>" <?php if($row['city_id'] == $city['city_id']) echo "selected"; ?>><?php echo $city['city_name']; ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Address Line</label>
                                <input type="text" class="form-control" id="address_line" name="address_line"
                                    aria-describedby="emailHelp" placeholder="Enter Address Line" required value="<?php echo $row['address_line']; ?>">
                            </div>
                            <div class="form-group col-12 text-right mt-3 mt-md-4">
                                <button class="cp-default-btn-xl p-2 text-dark" type="submit" name="add_address"
                                    value="continue">Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="gradient-wrapper item-mb">
                    <div class="gradient-title">
                        <h2>Order Summary</h2>
                    </div>
                    <div class="gradient-padding reduce-padding px-3 pb-3 text-center">
                        <ul class="text-left">
                            <li class="py-2 position-relative">Subtotal<span
                                    style="position: absolute; right: 0"><?php echo $_SESSION['sumPrice']; ?> $</span>
                            </li>
                            <li class="py-2 position-relative">Shipping & Delivery<span
                                    style="position: absolute; right: 0">0 $</span></li>
                            <li class="py-2 position-relative">Tax<span style="position: absolute; right: 0">0 $</span>
                            </li>
                            <li class="py-2 h5 position-relative">Total<span
                                    style="position: absolute; right: 0"><?php echo $_SESSION['sumPrice']; ?> $</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script>
$(document).ready(function() {
    $('#country').on('change', function() {
        var value = $(this).val();
        $.ajax({
            type: 'post',
            url: 'address.php',
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
});
</script>

</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->

</html>