<?php
session_start();
include 'includes/config.php';
global $con;

if(isset($_POST['remove'])){
  $product_id = $_POST['product_id'];
  unset($_SESSION['carts'][$product_id]);
  header("Location: shopping-cart.php");
}

if(isset($_POST['edit'])){
  $product_id = $_POST['product_id'];
  $quantity   = $_POST['quantity'];
  $_SESSION['carts'][$product_id] = $quantity;
  header("Location: shopping-cart.php");
}

?>

 <?php include 'includes/header.php'; ?>

<section class="s-space-bottom-full bg-accent-shadow-body">
  <div class="container">
    <div class="breadcrumbs-area">
      <ul>
        <li><a href="index.php">Home</a> -</li>
        <li class="active">Shopping Cart</li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-9">
        <div class="gradient-wrapper item-mb">
          <div class="gradient-title">
            <h2>Shopping Cart</h2>
          </div>
          <div class="gradient-padding reduce-padding px-0 py-0">
            <div class="table-responsive">
              <table class="table">

                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sumPrice = 0;
                  if(isset($_SESSION['carts'])){
                    foreach($_SESSION['carts'] as $product_id => $quantity){
                      $sql = "SELECT * FROM product WHERE product_id='$product_id'";
                      $res = mysqli_query($con, $sql);
                      while($row = mysqli_fetch_assoc($res)){?>
                        <tr>
                          <td class="w-50">
                            <div class="row">
                              <div class="col-12 col-sm-3 pr-0 d-flex align-items-center justify-content-center">
                                <?php
                                $prod_id  = $row['product_id'];
                                $sqlImage = "SELECT * FROM product_image WHERE product_id='$prod_id' LIMIT 1";
                                $resImage = mysqli_query($con, $sqlImage);
                                while($img = mysqli_fetch_assoc($resImage)){?>
                                  <img src="../admin/<?php echo $img['url']; ?>" alt="" style="max-height:100px">
                              <?php  }
                                 ?>
                              </div>
                              <div class="col pl-3 pl-sm-0">
                                <p class="m-0"><a href="single-product-layout.php?product_id=<?php echo $prod_id; ?>" class="h4 btn-link"><?php echo $row['title']; ?></a></p>
                                <p class="m-0">Color: <?php echo $row['color'] ?></p>
                                <p class="m-0">Warranty: <?php echo $row['warranty'] ?></p>
                                <form class="" action="shopping-cart.php" method="post">
                                  <input type="hidden" name="product_id" value="<?php echo $prod_id; ?>">
                                  <button class="btn btn-link pl-0 text-danger" type="submit" name="remove" value="remove" style="cursor:pointer;font-size:0.9rem">Delete</button>
                                </form>
                              </div>
                            </div>
                          </td>
                          <td class="w-25">
                            <?php if($row['special_price'] == ''){
                              echo $row['price'].' $';
                              $sumPrice += $row['price'] * $quantity;
                            }else{
                              echo $row['special_price'].' $';
                              $sumPrice += $row['special_price'] * $quantity;
                            } ?>
                          </td>
                          <td class="w-25">
                            <span class="editQuantity"><?php echo $quantity; ?></span>
                            <span class="formEdit">
                              <form action="shopping-cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input class="form-control mb-2 form-control-sm col-12 col-md-6 col-lg-4" type="number" name="quantity" value="<?php echo $quantity; ?>">
                                <input class="cp-default-btn-xl p-2 text-dark" style="font-size:0.8rem" type="submit" name="edit" value="Update">
                              </form>
                            </span>
                          </td>
                        </tr>
                      <?php }
                    }
                  }?>
                </tbody>
              </table>
            </div>
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
          <li class="py-2 position-relative">Subtotal<span style="position: absolute; right: 0"><?php echo $sumPrice; ?> $</span></li>
          <li class="py-2 position-relative">Shipping & Delivery<span style="position: absolute; right: 0">0 $</span></li>
          <li class="py-2 position-relative">Tax<span style="position: absolute; right: 0">0 $</span></li>
          <li class="py-2 h5 position-relative">Total<span style="position: absolute; right: 0"><?php echo $sumPrice; ?> $</span></li>
         </ul>
         <div class="dropdown-divider mb-3"></div>
         <button class="cp-default-btn-xl p-2 text-dark" type="button" name="button" onclick="window.location.href='address.php'" <?php if($sumPrice == 0) echo "disabled" ?>>Proceed to checkout</button>
        </div>
       </div>
      </div>
    </div>
  </div>
</section>


<?php include 'includes/footer.php'; ?>


<script>
  $(document).ready(function(){
    $('.formEdit').hide();
    $('.editQuantity').on('click',function(){
      $(this).hide().next().show();
    });
  });
</script>



</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->
</html>
