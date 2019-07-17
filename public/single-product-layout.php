<?php
session_start();
include 'includes/config.php';
global $con;

$prodect_id         = $_GET['product_id'];
$retrieveOneProduct = "SELECT * FROM product WHERE product_id='$prodect_id'";
$resultOneProduct   = mysqli_query($con, $retrieveOneProduct);


if(isset($_POST['addProduct'])){
  if(!isset($_SESSION['carts'])){
    $_SESSION['carts'] = array();
  }
  $_SESSION['carts'][$_POST['product_id']] = $_POST['quantity'];
  echo "<script type='text/javascript'>window.top.location='single-product-layout.php?product_id=$prodect_id';</script>"; exit;
}


$retrieveProduct = "SELECT * FROM product, provider, category WHERE product_id='$prodect_id' AND provider.provider_id=product.provider_id AND category.category_id=product.category_id";
$resultProduct   = mysqli_query($con, $retrieveProduct);
$company_name     = "";
$category_id      = "";
$category_name_en = "";
$provider_id      = "";
$title            = "";
while($ret = mysqli_fetch_assoc($resultProduct)){
  $provider_id      = $ret['provider_id'];
  $category_id      = $ret['category_id'];
  $company_name     = $ret['company_name'];
  $category_name_en = $ret['name_en'];
  $title            = $ret['title'];
}

 ?>

<?php include 'includes/header.php'; ?>

<!-- Product Area Start Here -->
<section class="s-space-bottom-full bg-accent-shadow-body">
    <div class="container">
        <div class="breadcrumbs-area">
            <ul>
                <li><a href="index.php">Home</a> -</li>
                <li><a href="provider-grid-layout.php?category_id=<?php echo $category_id; ?>"><?php echo $category_name_en; ?>
                        Providers</a> -</li>
                <li><a
                        href="product-grid-layout.php?provider_id=<?php echo $provider_id ?>&category_id=<?php echo $category_id ?>"><?php echo $company_name ?>
                        Company</a> -</li>
                <li class="active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="gradient-wrapper item-mb">
                    <?php
                          $brand       = "";
                          $color       = "";
                          $warranty    = "";
                          $category_id = "";
                          $product_id  = "";
                           while($row = mysqli_fetch_assoc($resultOneProduct)){
                             $brand       = $row['brand'];
                             $color       = $row['color'];
                             $warranty    = $row['warranty'];
                             $category_id = $row['category_id'];
                             $product_id  = $row['product_id'];
                              ?>
                    <div class="gradient-title">
                        <h2><?php echo $row['title']; ?></h2>


                    </div>
                    <div class="gradient-padding reduce-padding">
                        <div class="single-product-img-layout1 item-mb">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="tab-content h-100">
                                        <?php if($row['special_price'] == ''){ ?>
                                        <span class="price">$<?php echo $row['price']; ?></span>
                                        <?php }else{ ?>
                                        <span class="price">$<?php echo $row['special_price']; ?>
                                            <span class="d-none d-sm-block"
                                                style="position: absolute;font-size: 1rem;bottom: 15px;right: 15px;text-decoration: line-through;color: #f12f34;">$<?php echo $row['price']; ?></span>
                                        </span>
                                        <?php } ?>

                                        <div role="tabpanel" class="h-100 text-center" id="related"
                                            style="height:500px !important">
                                            <img id="displayImg" alt="single" src="" class="img-fluid"
                                                style="height:100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 pt-2">
                                    <div class="owl-carousel owl-theme text-center">
                                        <?php
                                            $retImage    = "SELECT * FROM product_image WHERE product_id='$prodect_id'";
                                            $resImage    = mysqli_query($con, $retImage);
                                            while($image = mysqli_fetch_assoc($resImage)){ ?>
                                        <div class="item text-center">
                                            <img class="imgItem" src="../admin/<?php echo $image['url']; ?>" alt=""
                                                style="width:75px !important; height:75px !important;cursor:pointer">
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-title-left-dark child-size-xl title-bar item-mb">
                            <h3>Product Details:</h3>
                            <p><?php echo $row['description']; ?></p>
                        </div>
                        <ul class="item-actions border-top">
                            <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i>Save Ad</a></li>
                            <li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i>Share ad</a></li>
                            <li class="item-danger"><a href="#"><i class="fa fa-exclamation-triangle"
                                        aria-hidden="true"></i>Report abuse</a></li>
                        </ul>
                    </div>
                    <?php }?>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 sidebar-single-product">
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Add To Cart</h3>
                            </div>
                            <form class="py-2 px-1"
                                action="single-product-layout.php?product_id=<?php echo $product_id; ?>" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input class="form-control mb-2" type="number" name="quantity" value=""
                                    placeholder="Quantity" required>
                                <button type="submit" class="cp-default-btn-xl p-2 w-100" name="addProduct"
                                    value="addProduct">Add To Cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Seller Information</h3>
                            </div>
                            <ul class="sidebar-seller-information">
                                <?php
                                        $retProvider = "SELECT * FROM provider, product WHERE provider.provider_id=product.provider_id AND product.product_id='$prodect_id'";
                                        $resProvider = mysqli_query($con, $retProvider);
                                        while($provider = mysqli_fetch_assoc($resProvider)){
                                          $city_id    = $provider['city_id'];
                                          $country_id = $provider['country_id'];
                                          $selectAddress = "SELECT country_name, city_name FROM country, city WHERE city.city_id='$city_id' AND country.country_id='$country_id'";
                                          $resSA         = mysqli_query($con, $selectAddress);
                                          $country_name  = "";
                                          $city_name     = ""; 
                                          while($address = mysqli_fetch_assoc($resSA)){
                                              $country_name = $address['country_name'];
                                              $city_name    = $address['city_name'];
                                          }
                                           ?>
                                <li>
                                    <div class="media">
                                        <img src="../admin/<?php echo $provider['logo']; ?>" alt="user"
                                            class="img-fluid pull-left rounded-circle" style="width:36px;height:36px">
                                        <div class="media-body">
                                            <span>Posted By</span>
                                            <h4><?php echo $provider['owner_full_name']; ?></h4>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="img/user/user2.png" alt="user" class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>Location</span>
                                            <h4><?php echo $provider['address_line'].', '.$city_name.', '.$country_name; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="img/user/user3.png" alt="user" class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>Contact Number</span>
                                            <h4><?php echo $provider['phone_number']; ?></h4>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="img/user/user4.png" alt="user" class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>Email</span>
                                            <h4><?php echo $provider['provider_email']; ?></h4>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="img/user/user5.png" alt="user"
                                            class="img-fluid pull-left rounded-circle" style="width:36px;height:36px">
                                        <div class="media-body">
                                            <span>Location in Map</span>
                                            <a href="<?php echo $provider['location_map']; ?>" class="btn btn-link"
                                                target="_blank">Go to the map</a>
                                        </div>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Item Details</h3>
                            </div>
                            <ul class="sidebar-item-details">
                                <?php if($brand != "") echo "<li>Brand:<span>".$brand."</span></li>"; ?>
                                <?php if($color != "") echo "<li>Color:<span>".$color."</span></li>"; ?>
                                <?php if($warranty != "") echo "<li>Warranty:<span>".$warranty."</span></li>"; ?>
                                <li>
                                    <ul class="sidebar-social">
                                        <li>Share:</li>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Safety Tips for Buyers</h3>
                            </div>
                            <ul class="sidebar-safety-tips">
                                <li>Meet seller at a public place</li>
                                <li>Check The item before you buy</li>
                                <li>Pay only after collecting The item</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="gradient-wrapper item-mb">
                    <div class="gradient-title">
                        <h2>More Ads From This User </h2>
                    </div>
                    <div class="gradient-padding">
                        <div class="cp-carousel nav-control-middle category-grid-layout1" data-loop="true"
                            data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="5000"
                            data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false"
                            data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2"
                            data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="2"
                            data-r-small-nav="true" data-r-small-dots="false" data-r-medium="2" data-r-medium-nav="true"
                            data-r-medium-dots="false" data-r-Large="3" data-r-Large-nav="true"
                            data-r-Large-dots="false">
                            <?php
                                    $moreProduct  = "SELECT * FROM product, category WHERE category.category_id='$category_id' AND  product.category_id=category.category_id";
                                    $resultMoreProduct    = mysqli_query($con, $moreProduct);
                                    while($row = mysqli_fetch_assoc($resultMoreProduct)){ ?>
                            <div class="product-box item-mb zoom-gallery">
                                <div class="item-mask-wrapper">
                                    <div class="item-mask bg-box justify-content-center align-items-center d-flex"
                                        style="height:277px">
                                        <?php
                                                $product_id     = $row["product_id"];
                                                $retrieveImageP = "SELECT * FROM product_image WHERE product_id='$product_id' limit 1";
                                                $resultImageP   = mysqli_query($con, $retrieveImageP);
                                                while($image = mysqli_fetch_assoc($resultImageP)){ ?>
                                        <img src="../admin/<?php echo $image['url']; ?>" alt="categories"
                                            class="img-fluid">
                                        <?php } ?>
                                        <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt"
                                                aria-hidden="true"></i></div>
                                        <div class="title-ctg"><?php echo $row['name_en']; ?></div>
                                        <ul class="info-link">
                                            <li><a
                                                    href="single-product-layout.php?product_id=<?php echo $product_id ?>"><i
                                                        class="fa fa-link" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="symbol-featured <?php if($row['featured'] == 1) echo 'active'; ?>">
                                            <img src="img/banner/symbol-featured.png" alt="symbol" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="title-ctg"><?php echo $row['name_en']; ?></div>
                                    <h3 class="short-title text-left"><a
                                            href="single-product-layout.php?product_id=<?php echo $product_id ?>"><?php echo $row['title']; ?></a>
                                    </h3>
                                    <?php if($row['special_price'] == ''){ ?>
                                    <div class="price" style="bottom:-5px"><?php echo $row['price']; ?>$</div>
                                    <?php }else{ ?>
                                    <div class="price"
                                        style="bottom:21px;color:#a0a0a0;font-size:1rem;text-decoration:line-through">
                                        <?php echo $row['price']; ?>$</div>
                                    <div class="Sprice"
                                        style="position: absolute;right: 0;bottom: -4px;font-size: 1.5rem;color:#dc3545;font-weight: bold;">
                                        <?php echo $row['special_price']; ?>$</div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                        <div class="add-layout2-left d-flex align-items-center">
                            <div>
                                <h2>Do you Have Something To Sell?</h2>
                                <h3>Post your ad on classipost.com</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="add-layout2-right d-flex align-items-center justify-content-end mb--sm">
                            <a href="#" class="cp-default-btn-sm-primary">Post Your Ad Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Area End Here -->
<?php include 'includes/footer.php'; ?>

<script>
$(document).ready(function() {
    $('#displayImg').attr('src', $('.imgItem').attr('src'));
    $('.imgItem').click(function() {
        var url = $(this).attr('src');
        $('#displayImg').animate({
            opacity: 0
        }, 100, function() {
            $('#displayImg').attr('src', url).animate({
                opacity: 1
            }, 200);
        });
    });
    $('.owl-carousel').owlCarousel({
        margin: 10,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
});
</script>
</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->

</html>