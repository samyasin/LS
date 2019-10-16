<?php
include 'includes/config.php';
global $con;


if(isset($_POST['send'])){
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $mobile  = $_POST['mobile'];
    $message = $_POST['message'];

    $sql = "INSERT INTO new_provider(new_name,new_email,new_mobile,new_message) VALUES ('$name','$email','$mobile','$message')";
    $res = mysqli_query($con, $sql);

    header('Location: index.php');
}


$retrieveCategory = "SELECT * FROM category limit 8";
$resultCategory   = mysqli_query($con, $retrieveCategory);

$retrieveProduct  = "SELECT * FROM product, category WHERE product.featured='1' AND product.category_id = category.category_id";
$resultProduct    = mysqli_query($con, $retrieveProduct);
?>

<?php include 'includes/header.php'; ?>

<!-- Service Area Start Here -->
<section class="service-layout1 bg-accent s-space-custom3">
    <div class="container">
        <div class="section-title-dark">
            <p>Browse Our Top Categories</p>
        </div>
        <div class="row">
          <?php while ($row1 = mysqli_fetch_assoc($resultCategory)) {  ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 item-mb">
                <div class="service-box1 bg-body text-center">
                    <img src="../admin/<?php echo $row1['url']; ?>" alt="service" class="img-fluid">
                    <h3 class="title-medium-dark mb-none"><a href="provider-grid-layout.php?category_id=<?php echo $row1['category_id']; ?>"><?php
                    echo $row1['name_en']; ?></a></h3>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="container">
    <div class="text-center item-mt item-mb">
        <h2 class="title-bold-dark mb-none">Do you have Something to Sell?</h2>
        <p>Post your ad on classipost.com</p>
        <a href="" class="cp-default-btn direction-img" data-toggle="modal" data-target="#exampleModalCenter">Post Your Ad Now!</a>

<!--         Button trigger modal -->
<!--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->
<!--            Launch demo modal-->
<!--        </button>-->

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width: 85%">
                <div class="modal-content overflow-hidden">
                    <div class="modal-header bg-primary text-light">
                        <h5 class="modal-title" id="exampleModalLongTitle">Provider Information</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="" role="form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" class="form-control" placeholder="Write Message"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success bg-primary-btn" name="send" value="send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
</section>
<!-- Service Area End Here -->
<!-- Products Area Start Here -->
<section class="products-layout1 bg-body s-space-default">
    <div class="container">
        <div class="section-title-dark">
            <h2>Our Featured Products</h2>
            <p>Browse To Our Top Products</p>
        </div>
    </div>
    <div class="container menu-list-wrapper">
        <div class="row menu-list category-grid-layout2 zoom-gallery justify-content-center">
          <?php while($row = mysqli_fetch_assoc($resultProduct)){ ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 menu-item">
                <div class="product-box item-mb zoom-gallery">
                    <div class="item-mask-wrapper">
                        <div class="item-mask bg-box justify-content-center align-items-center d-flex" style="height:314px">
                          <?php
                          $product_id     = $row["product_id"];
                          $retrieveImageP = "SELECT * FROM product_image WHERE product_id='$product_id' limit 1";
                          $resultImageP   = mysqli_query($con, $retrieveImageP);
                          while($image = mysqli_fetch_assoc($resultImageP)){ ?>
                            <img src="../admin/<?php echo $image['url']; ?>" alt="categories" class="img-fluid">
                        <?php } ?>
                        <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i></div>
                        <div class="title-ctg"><?php echo $row['name_en']; ?></div>
                        <ul class="info-link">
                            <li><a href="single-product-layout.php?product_id=<?php echo $product_id ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                        </ul>
                        <div class="symbol-featured"><img src="img/banner/symbol-featured.png" alt="symbol" class="img-fluid"> </div>
                    </div>
                </div>
                <div class="item-content">
                    <div class="title-ctg"><?php echo $row['name_en']; ?></div>
                    <h3 class="short-title"><a href="single-product-layout.php?product_id=<?php echo $product_id ?>"><?php echo $row['title']; ?></a></h3>
                    <ul class="upload-info">
                        <li class="place"><i class="fa fa-map-marker d-inline-block"></i>Sydney, Australia</li>
                    </ul>
                    <?php if($row['special_price'] == ''){ ?>
                      <div class="price"><?php echo $row['price']; ?>$</div>
                  <?php }else{ ?>
                      <div class="price" style="bottom:28px;color:#a0a0a0;font-size:1rem;text-decoration:line-through"><?php echo $row['price']; ?>$</div>
                      <div class="Sprice" style="position: absolute;right: 0;bottom: -4px;font-size: 1.5rem;color:#dc3545;font-weight: bold;"><?php echo $row['special_price']; ?>$</div>
                  <?php } ?>
              </div>
          </div>
      </div>
  <?php }?>
</div>
<div class="loadmore text-center item-mt">
    <a href="#" class="cp-default-btn-primary">See All Album</a>
</div>
</div>
</section>
<!-- Products Area End Here -->
<!-- Counter Area Start Here -->
<section class="overlay-default s-space-equal overflow-hidden" style="background-image: url('img/banner/counter-back1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="d-md-flex justify-md-content-center counter-box text-center--md">
                    <div>
                        <img src="img/banner/counter4.png" alt="counter" class="img-fluid mb20-auto--md">
                    </div>
                    <div>
                        <div class="counter counter-title" data-num="100000">1,00,000</div>
                        <h3 class="title-regular-light">Our Products</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="d-md-flex justify-md-content-center counter-box text-center--md">
                    <div>
                        <img src="img/banner/counter5.png" alt="counter" class="img-fluid mb20-auto--md">
                    </div>
                    <div>
                        <div class="counter counter-title" data-num="500000">5,00,000</div>
                        <h3 class="title-regular-light">Our Happy Buyers</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="d-md-flex justify-md-content-center counter-box text-center--md">
                    <div>
                        <img src="img/banner/counter6.png" alt="counter" class="img-fluid mb20-auto--md">
                    </div>
                    <div>
                        <div class="counter counter-title" data-num="200000">2,00,000</div>
                        <h3 class="title-regular-light">Verified Users</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Area End Here -->
<!-- Pricing Plan Area Start Here -->
<section class="bg-body s-space-default">
    <div class="container">
        <div class="section-title-dark">
            <h2>Start Earning From Things You Don’t Need Anymore</h2>
            <p>It’s very Simple to choose pricing &amp; Plan</p>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-5 col-md-12 col-12">
                <div class="pricing-box bg-box">
                    <div class="plan-title">Free Post</div>
                    <div class="price"><span class="currency">$</span>0<span class="duration">/ Per mo</span>
                    </div>
                    <h3 class="title-bold-dark size-xl">Always FREE Ad Posting</h3>
                    <p>Post as many ads as you like for 30 days without limitations and 100% FREE SUBMIT AD</p>
                    <a href="#" class="cp-default-btn-lg">Submit Ad</a>
                </div>
            </div>
            <div class="d-flex align-items-center col-lg-2 col-md-12 col-sm-12 col-12">
                <div class="other-option bg-primary">or</div>
            </div>
            <div class="col-lg-5 col-md-12 col-12">
                <div class="pricing-box bg-box">
                    <div class="plan-title">Premium Post</div>
                    <div class="price"><span class="currency">$</span>19<span class="duration">/ Per mo</span>
                    </div>
                    <h3 class="title-bold-dark size-xl">Featured Ad Posting</h3>
                    <p>Post as many ads as you like for 30 days without limitations and 100% FREE SUBMIT AD</p>
                    <a href="#" class="cp-default-btn-lg">Submit Ad</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Pricing Plan Area End Here -->
<!-- Selling Process Area Start Here -->

<section class="bg-accent s-space-regular">
    <div class="container">
        <div class="section-title-dark">
            <h2>How To Start Selling Your Products</h2>
            <p>It’s very simple to choose pricing &amp; level of exposure on pricing page</p>
        </div>
        <ul class="process-area">
            <li>
                <img src="img/banner/process1.png" alt="process" class="img-fluid">
                <h3>Upload Your Products</h3>
                <p> Bmply dummy text of the printing and typesing industrypsum been the induse.</p>
            </li>
            <li>
                <img src="img/banner/process2.png" alt="process" class="img-fluid">
                <h3>Set Your Price</h3>
                <p> Bmply dummy text of the printing and typesing industrypsum been the induse.</p>
            </li>
            <li>
                <img src="img/banner/process3.png" alt="process" class="img-fluid">
                <h3>Start Your Business</h3>
                <p> Bmply dummy text of the printing and typesing industrypsum been the induse.</p>
            </li>
        </ul>
    </div>
</section>

<?php include 'includes/footer.php' ?>

<!--<script>-->
<!--    var myIndex = 0;-->
<!--    carousel();-->
<!---->
<!--    function carousel() {-->
<!--      var i;-->
<!--      var x = document.getElementsByClassName("mySlides");-->
<!--      for (i = 0; i < x.length; i++) {-->
<!--        x[i].style.display = "none";  -->
<!--    }-->
<!--    myIndex++;-->
<!--    if (myIndex > x.length) {myIndex = 1}    -->
<!--      x[myIndex-1].style.display = "block";  -->
<!--  setTimeout(carousel, 3000); // Change image every 2 seconds-->
<!--}-->
<!--</script>-->

</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:16 GMT -->
</html>
