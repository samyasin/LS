<?php session_start();
include 'includes/config.php';
global $con;

if(isset($_POST['add_payment'])){
    $user_id       = $_SESSION['user_id'];
    $paymentMethod = $_POST['paymentMethod'];
    $grand_total   = $_SESSION['sumPrice'];
    $address_line  = $_SESSION['address']['address_line'];
    $city          = $_SESSION['address']['city'];
    $country       = $_SESSION['address']['country'];
    if($paymentMethod == "cash"){
        $insert = "INSERT INTO orders(payment_method,grand_total,order_status,address_line,city,country,user_id) VALUE ('$paymentMethod', '$grand_total', 'pending', '$address_line','$city', '$country', '$user_id')";
    }else{
        $insert = "INSERT INTO orders(payment_method,grand_total,order_status,address_line,city,country,user_id) VALUE ('$paymentMethod', '$grand_total', 'approved', '$address_line','$city', '$country', '$user_id')";
    }
    
    
    if(mysqli_query($con, $insert)){
        $order_id = mysqli_insert_id($con);
        foreach($_SESSION['carts'] as $product_id => $quantity){
            $insertDetails = "INSERT INTO order_details(order_id,product_id,quantity) VALUE ('$order_id', '$product_id', '$quantity')";
            $res = mysqli_query($con, $insertDetails);
        }
    }
    header("Location: done.php");
}

?>
<?php include 'includes/header.php'; ?>

<section class="s-space-bottom-full bg-accent-shadow-body">
  <div class="container">
    <div class="breadcrumbs-area">
      <ul>
        <li><a href="index.php">Home</a> -</li>
        <li><a href="shopping-cart.php">Shopping Cart</a> -</li>
        <li><a href="address.php">Address</a> -</li>
        <li class="active">Payment</li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-9">
        <div class="gradient-wrapper item-mb">
          <div class="gradient-title">
            <h2>Payment</h2>
          </div>
          <div class="gradient-padding reduce-padding">
            <form  action="payment.php" method="post">
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="paymentMethod" class="custom-control-input" value="paypal" required>
                    <label class="custom-control-label" for="customRadio1">Online payment(PayPal)</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="paymentMethod" class="custom-control-input" value="cash" required>
                    <label class="custom-control-label" for="customRadio2">Cash On Delivery</label>
                </div>
                <div class="col-12">
                    <div id="paypal">
                        <p class="pt-4 pl-2">For another time</p>
                    </div>
                    <div id="cash">
                        <p class="pt-4 pl-2">Completed the payment step, click on continue.</p>
                    </div>
                </div>
                <div class="form-group col-12 text-right mt-3 mt-md-4">
                    <button class="cp-default-btn-xl p-2 text-dark" type="submit" name="add_payment" value="continue">Continue <i class="fa fa-arrow-right"></i></button>
                </div>
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
          <li class="py-2 position-relative">Subtotal<span style="position: absolute; right: 0"><?php echo $_SESSION['sumPrice']; ?> $</span></li>
          <li class="py-2 position-relative">Shipping & Delivery<span style="position: absolute; right: 0">0 $</span></li>
          <li class="py-2 position-relative">Tax<span style="position: absolute; right: 0">0 $</span></li>
          <li class="py-2 h5 position-relative">Total<span style="position: absolute; right: 0"><?php echo $_SESSION['sumPrice']; ?> $</span></li>
         </ul>
        </div>
       </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
    $(document).ready(function(){

        $('#paypal, #cash').fadeOut('fast');
        $("input[name='paymentMethod'").on('change',function(){
            var id = $(this).val();
            $('#paypal, #cash').fadeOut();
            setTimeout(function(){
                $('#'+id).fadeIn(); 
            }, 400);

        });
    });
</script>

</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->
</html>