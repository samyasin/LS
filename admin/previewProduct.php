<?php
include 'includes/config.php';
global $con;

$prodect_id         = $_GET['product_id'];
$retrieveOneProduct = "SELECT * FROM product WHERE product_id='$prodect_id'";
$resultOneProduct   = mysqli_query($con, $retrieveOneProduct);

 ?>
<?php include 'includes/previewProduct/header.php'; ?>
        <!-- Product Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="#">Home</a> -</li>
                        <li><a href="#">Electronics</a> -</li>
                        <li class="active">Computer</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper item-mb">
                          <?php
                          $provider_id = "";
                          $brand       = "";
                          $color       = "";
                          $warranty    = "";
                           while($row = mysqli_fetch_assoc($resultOneProduct)){
                             $provider_id = $row['provider_id'];
                             $brand       = $row['brand'];
                             $color       = $row['color'];
                             $warranty    = $row['warranty'];
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
                                                <span class="price" style="width: 24%;">$<?php echo $row['price']; ?></span>
                                              <?php }else{ ?>
                                                <span class="price" style="width: 24%;">$<?php echo $row['special_price']; ?>
                                                  <span class="d-none d-sm-block" style="position: absolute;font-size: 1rem;bottom: 15px;right: 15px;text-decoration: line-through;color: #f12f34;">$<?php echo $row['price']; ?></span>
                                                </span>
                                              <?php } ?>

                                                  <div role="tabpanel" class="h-100 text-center" id="related" style="height:500px !important">
                                                      <img id="displayImg" alt="single" src="" class="img-fluid" style="height:100%">
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
                                                <img class="imgItem" src="<?php echo $image['url']; ?>" alt="" style="width:75px !important; height:75px !important;cursor:pointer">
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
                                    <li class="item-danger"><a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Report abuse</a></li>
                                </ul>
                            </div>
                          <?php }?>

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
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="sidebar-item-box">
                            <div class="gradient-wrapper">
                                <div class="gradient-title">
                                    <h3>Seller Information</h3>
                                </div>
                                <ul class="sidebar-seller-information">
                                  <?php
                                    $sqlProvider = "SELECT * FROM provider WHERE provider_id='$provider_id'";
                                    $resProvider = mysqli_query($con, $sqlProvider);
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
                                              <img src="<?php echo $provider['logo']; ?>" alt="user" class="img-fluid pull-left rounded-circle" style="width:36px;height:36px">
                                              <div class="media-body">
                                                  <span>Posted By</span>
                                                  <h4><?php echo $provider['owner_full_name']; ?></h4>
                                              </div>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="media">
                                              <img src="includes/previewProduct/img/user/user2.png" alt="user" class="img-fluid pull-left">
                                              <div class="media-body">
                                                  <span>Location</span>
                                                  <h4><?php echo $provider['address_line'].', '.$city_name.', '.$country_name; ?></h4>
                                              </div>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="media">
                                              <img src="includes/previewProduct/img/user/user3.png" alt="user" class="img-fluid pull-left">
                                              <div class="media-body">
                                                  <span>Contact Number</span>
                                                  <h4><?php echo $provider['phone_number']; ?></h4>
                                              </div>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="media">
                                              <img src="includes/previewProduct/img/user/user4.png" alt="user" class="img-fluid pull-left">
                                              <div class="media-body">
                                                  <span>Email</span>
                                                  <h4><?php echo $provider['provider_email']; ?></h4>
                                              </div>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="media">
                                              <img src="includes/previewProduct/img/user/user5.png" alt="user" class="img-fluid pull-left rounded-circle" style="width:36px;height:36px">
                                              <div class="media-body">
                                                  <span>Location in Map</span>
                                                  <a href="<?php echo $provider['location_map']; ?>" class="btn btn-link"
                                                target="_blank">Go to the map</a>
                                              </div>
                                          </div>
                                      </li>
                                    <?php } ?>
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
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Area End Here -->
        <?php include 'includes/previewProduct/footer.php'; ?>

        <script>
          $(document).ready(function(){
            $('#displayImg').attr('src',$('.imgItem').attr('src'));
            $('.imgItem').click(function(){
              var url = $(this).attr('src');
              $('#displayImg').animate({
                opacity:0
              }, 100, function(){
                $('#displayImg').attr('src',url).animate({
                  opacity:1
                },200);
              });
            });
            $('.owl-carousel').owlCarousel({
                margin:10,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            });
          });
        </script>
</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->
</html>
