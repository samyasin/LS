<?php
include 'includes/config.php';
global $con;




$category_id      = $_GET['category_id'];

$retrieveProduct  = "SELECT * FROM product, category WHERE category.category_id='$category_id' AND product.category_id = category.category_id";
$resultProduct    = mysqli_query($con, $retrieveProduct);

$retrieveCategory = "SELECT * FROM category";
$resultCategory   = mysqli_query($con, $retrieveCategory);

$retrieveLocation1 = "SELECT * FROM location";
$resultLocation1   = mysqli_query($con, $retrieveLocation1);

?>

<?php include 'includes/header.php'; ?>
        <!-- Category Grid View Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="#">Home</a> -</li>
                        <li class="active">All ads</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="order-xl-2 order-lg-2 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper item-mb">
                            <div class="gradient-title">
                                <div class="row">
                                    <div class="col-4">
                                        <h2>All Ads</h2>
                                    </div>
                                    <div class="col-8">
                                        <div class="layout-switcher">
                                            <ul>
                                                <li>
                                                    <div class="page-controls-sorting">
                                                        <button class="sorting-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Sort By<i class="fa fa-sort" aria-hidden="true"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Date</a>
                                                            <a class="dropdown-item" href="#">Best Sale</a>
                                                            <a class="dropdown-item" href="#">Rating</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="active"><a class="product-view-trigger" href="#" data-type="category-grid-layout1"><i class="fa fa-th-large"></i></a></li>
                                                <li><a href="#" data-type="category-list-layout1" class="product-view-trigger"><i class="fa fa-list"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="category-view" class="category-grid-layout1 gradient-padding zoom-gallery">
                                <div class="row">
                                  <?php while($row = mysqli_fetch_assoc($resultProduct)){ ?>
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12">
                                        <div class="product-box item-mb zoom-gallery">
                                            <div class="item-mask-wrapper">
                                                <div class="item-mask bg-box justify-content-center align-items-center d-flex" style="height:277px">
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
                                                    <div class="symbol-featured <?php if($row['featured'] == 1) echo 'active'; ?>"><img src="img/banner/symbol-featured.png" alt="symbol" class="img-fluid"> </div>
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
                            </div>
                        </div>
                        <div class="gradient-wrapper mb-60">
                            <ul class="cp-pagination">
                                <li class="disabled"><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i>Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li><a href="#">Next<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                                <div class="add-layout2-left d-flex align-items-center">
                                    <div>
                                        <h2>Do you Have Something To Sell?</h2>
                                        <h3>Post your ad on classipost.com</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                <div class="add-layout2-right d-flex align-items-center justify-content-end mb--sm">
                                    <a href="#" class="cp-default-btn-sm-primary">Post Your Ad Now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-xl-1 order-lg-1 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="sidebar-item-box">
                            <div class="gradient-wrapper">
                                <div class="gradient-title">
                                    <h3>All Categories</h3>
                                </div>
                                <ul class="sidebar-category-list">
                                  <?php while($row = mysqli_fetch_assoc($resultCategory)){ ?>
                                    <li>
                                        <a href="category-grid-layout.php?category_id=<?php echo $row['category_id']; ?>"><img src="../admin/<?php echo $row['url']; ?>" alt="category" class="img-fluid" height="30" width="30"><?php
                                        echo $row['name']; ?><span>(50)</span></a>
                                    </li>
                                  <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-item-box">
                            <div class="gradient-wrapper">
                                <div class="gradient-title">
                                    <h3>Location</h3>
                                </div>
                                <ul class="sidebar-loacation-list">
                                  <?php while($row = mysqli_fetch_assoc($resultLocation1)){ ?>
                                    <li><a href="#"><?php echo $row['name']; ?></a></li>
                                  <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Grid View End Here -->



        <?php include 'includes/footer.php'; ?>


</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/category-grid-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:22 GMT -->
</html>
