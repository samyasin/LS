<?php session_start();

if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
}


if(isset($_POST['add_address'])){
  if(!isset($_SESSION['address'])){
    $_SESSION['address'] = array();
  }
  $_SESSION['address']['address_line'] = $_POST['address_line'];
  $_SESSION['address']['city']         = $_POST['city'];
  $_SESSION['address']['country']      = $_POST['country'];
  header("Location: payment.php");
}
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
            <form  action="address.php" method="post">
              <div class="form-group col-12">
                <label for="exampleInputEmail1">Address Line</label>
                <input type="text" class="form-control" id="address_line" name="address_line" aria-describedby="emailHelp" placeholder="Enter Address Line" required>
              </div>
              <div class="form-group col-12">
                <label for="exampleInputEmail1">City</label>
                <input type="City" class="form-control" id="city" name="city" aria-describedby="emailHelp" placeholder="Enter City" required>
              </div>
              <div class="form-group col-12">
                <label for="exampleInputEmail1">Country</label>
                <input type="text" class="form-control" id="country" name="country" aria-describedby="emailHelp" placeholder="Enter Country" required>
              </div>
              <div class="form-group col-12 text-right mt-3 mt-md-4">
                <button class="cp-default-btn-xl p-2 text-dark" type="submit" name="add_address" value="continue">Continue <i class="fa fa-arrow-right"></i></button>
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

</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->
</html>