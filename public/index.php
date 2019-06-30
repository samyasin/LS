
<?php
include 'includes/config.php';
global $con;
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
                            <h3 class="title-medium-dark mb-none"><a href="category-grid-layout.php?category_id=<?php echo $row1['category_id']; ?>"><?php
                            echo $row1['name']; ?></a></h3>
                            <div class="view">(19,805)</div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="container">
                <div class="text-center item-mt item-mb">
                    <h2 class="title-bold-dark mb-none">Do you have Something to Sell?</h2>
                    <p>Post your ad on classipost.com</p>
                    <a href="#" class="cp-default-btn direction-img">Post Your Ad Now!</a>
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
                <div class="row menu-list category-grid-layout2 zoom-gallery">
                  <?php while($row = mysqli_fetch_assoc($resultProduct)){ ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 menu-item">
                        <div class="product-box item-mb zoom-gallery">
                            <div class="item-mask-wrapper">
                                <div class="item-mask bg-box justify-content-center align-items-center d-flex" style="height:314px">
                                  <?php
                                  $product_id     = $row["product_id"];
                                  $retrieveImageP = "SELECT * FROM image WHERE image.product_id='$product_id' limit 1";
                                  $resultImageP   = mysqli_query($con, $retrieveImageP);
                                  while($image = mysqli_fetch_assoc($resultImageP)){ ?>
                                    <img src="../admin/<?php echo $image['url']; ?>" alt="categories" class="img-fluid">
                                  <?php } ?>
                                    <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i></div>
                                    <div class="title-ctg"><?php echo $row['name']; ?></div>
                                    <ul class="info-link">
                                        <li><a href="single-product-layout.php?product_id=<?php echo $product_id ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    </ul>
                                    <div class="symbol-featured"><img src="img/banner/symbol-featured.png" alt="symbol" class="img-fluid"> </div>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="title-ctg"><?php echo $row['name']; ?></div>
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
        <!-- Selling Process Area End Here -->


        <?php include 'includes/footer.php' ?>

</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:16 GMT -->
</html>
