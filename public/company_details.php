<?php
session_start();
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
                <li class="active">
                <li class="active"><?php echo $row['company_name'] ?> Company</li>
                </li>
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
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="col-12 d-flex align-items-center justify-content-center"
                                    style="height:200px">
                                    <img class="rounded mh-100" src="../admin/<?php echo $row['logo']; ?>" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="h3 py-2">
                                    Company: <?php echo $row['company_name']; ?>
                                </div>
                                <div class="h4 py-2">
                                    Owner: <?php echo $row['owner_full_name']; ?>
                                </div>
                                <div class="h6 py-2">
                                    Field of Company: <?php echo $cat_name_en; ?>
                                </div>
                                <div class=" mt-3 h4 py-2">
                                    Contact Informatiom
                                </div>
                                <div class="row">
                                    <div class=" py-2 h6 col-12 col-xl-6">
                                        <i class="fa fa-phone pr-2"></i> Phone Number:
                                        <?php echo $row['phone_number'] ?>
                                    </div>
                                    <div class="py-2 h6 col-12 col-xl-6">
                                        <i class="fa fa-envelope pr-2"></i> Email: <?php echo $row['provider_email'] ?>
                                    </div>
                                </div>



                                <div class="py-2 h6">
                                    <i class="fa fa-map-marker pr-2"></i> Address: <?php echo $row['address_line'].', '; 
                                          $country_id     = $row['country_id'];
                                          $city_id       = $row['city_id'];
                                          $selectAddress = "SELECT country_name, city_name FROM country, city WHERE city.city_id='$city_id' AND country.country_id='$country_id'";
                                          $resSA         = mysqli_query($con, $selectAddress);
                                          while($address = mysqli_fetch_assoc($resSA)){
                                              echo $address['city_name'].', '.$address['country_name'];
                                          }
                                         ?>
                                </div>
                                <div class="py-2 h6">
                                    <i class="fa fa-hashtag pr-2"></i> Postal Code: <?php echo $row['postal_code']; ?>
                                </div>


                                <?php if($row['location_map'] != ""){ ?>
                                <div class="py-2 h6">
                                    <a href="<?php echo $row['location_map']; ?>" target="_blank"><i
                                            class="fa fa-map pr-2"></i> Go to Map</a>
                                </div>
                                <?php } ?>

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