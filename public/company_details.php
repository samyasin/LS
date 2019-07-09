<?php
include 'includes/config.php';
global $con;

$provider_id = $_GET['provider_id'];

$retrieveProvider = "SELECT * FROM provider WHERE provider_id='$provider_id'";
$resultProvider   = mysqli_query($con, $retrieveProvider);

 ?>
<?php include 'includes/header.php'; ?>
        <!-- Product Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
          <?php while($row = mysqli_fetch_assoc($resultProvider)){ ?>
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="index.php">Home</a> -</li>
                        <li><a href="provider-grid-layout.php?category_id=<?php echo $row['category_id']; ?>"><?php
                         $category_id = $row['category_id'];
                         $sql = "SELECT * FROM category WHERE category_id='$category_id'";
                         $res = mysqli_query($con, $sql);
                         $cat_name_en = "";
                         while($cat = mysqli_fetch_assoc($res)){
                           echo $cat['name_en'];
                           $cat_name_en = $cat['name_en'];
                         }
                         ?> Providers</a> -</li>
                        <li class="active"><li class="active"><?php echo $row['company_name'] ?> Company</li></li>
                    </ul>
                </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="gradient-wrapper item-mb">
                    <div class="gradient-title">
                      <h2><?php echo $row['company_name']; ?> Company</h2>
                    </div>
                    <div class="gradient-padding reduce-padding">
                      <div class="row overflow-hidden">
                        <div class="col-12 col-md-4 d-flex align-items-center justify-content-center" style="height:200px">
                          <img class="rounded mh-100" src="../admin/<?php echo $row['logo']; ?>" alt="">
                        </div>
                        <div class="col-12 col-md-4 py-2 d-flex flex-column justify-content-around" style="min-height:130px">
                          <div class="h3">
                            Company: <?php echo $row['company_name']; ?>
                          </div>
                          <div class="h4">
                            Owner: <?php echo $row['owner_full_name']; ?>
                          </div>
                        </div>
                        <div class="col-12 col-md-4 py-4 d-flex align-items-start">
                          <div class="h5 mt-md-3">
                            Field of Company: <?php echo $cat_name_en; ?>
                          </div>
                        </div>
                      </div>
                      <div class="row py-2">
                        <div class="col-12 mt-3 h4">
                          Contact Informatiom
                        </div>
                        <div class="col-12 col-md-8 py-2 h6">
                          <i class="fa fa-phone pr-2"></i> Phone Number: <?php echo $row['phone_number'] ?>
                        </div>
                        <div class="col-12 col-md-4 py-2 h6">
                          <i class="fa fa-envelope pr-2"></i> Email: <?php echo $row['provider_email'] ?>
                        </div>
                        <div class="col-12 col-md-8 py-2 h6">
                          <i class="fa fa-map-marker pr-2"></i> Address:
                          <?php
                            $address_id = $row['address_id'];
                            $postal     = "";
                            $sqlAddress = "SELECT * FROM address WHERE address_id='$address_id'";
                            $resAddress = mysqli_query($con, $sqlAddress);
                            while($address = mysqli_fetch_assoc($resAddress)){
                              echo $address['address'].', '.$address['city'].', '.$address['country'];
                              $postal = $address['postal_code'];
                            }
                           ?>
                        </div>
                        <div class="col-12 col-md-4 py-2 h6">
                          <i class="fa fa-hashtag pr-2"></i> Postal Code: <?php echo $postal; ?>
                        </div>
                        <div class="col-12 py-2 h6">
                           <a href="#"><i class="fa fa-map pr-2"></i> Go to Map</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </section>
        <!-- Product Area End Here -->
        <?php include 'includes/footer.php'; ?>
</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->
</html>
