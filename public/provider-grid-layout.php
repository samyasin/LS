<?php
include 'includes/config.php';
global $con;




$category_id       = $_GET['category_id'];

$retrieveProvider  = "SELECT * FROM provider, category WHERE category.category_id='$category_id' AND provider.category_id = category.category_id";
$resultProvider    = mysqli_query($con, $retrieveProvider);

$retrieveCategory  = "SELECT * FROM category";
$resultCategory    = mysqli_query($con, $retrieveCategory);

$retrieveLocation1 = "SELECT * FROM address";
$resultLocation1   = mysqli_query($con, $retrieveLocation1);

$retrieveOneCategory  = "SELECT * FROM category WHERE category_id='$category_id'";
$resultOneCategory    = mysqli_query($con, $retrieveOneCategory);
$category_name_en     = "";
while($oneCat = mysqli_fetch_assoc($resultOneCategory)){
  $category_name_en   = $oneCat['name_en'];
}

?>

<?php include 'includes/header.php'; ?>
        <!-- Category Grid View Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="index.php">Home</a> -</li>
                        <li class="active"><?php echo $category_name_en; ?> Providers</li>
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
                                        <h2><?php echo $category_name_en; ?> Providers</h2>
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
                                  <?php
                                  if(mysqli_num_rows($resultProvider) > 0){
                                   while($row = mysqli_fetch_assoc($resultProvider)){ ?>
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12">
                                        <div class="product-box item-mb zoom-gallery">
                                            <div class="item-mask-wrapper">
                                                <div class="item-mask bg-box justify-content-center align-items-center d-flex p-0" style="height:175px">
                                                    <img src="../admin/<?php echo $row['logo']; ?>" alt="categories" class="img-fluid w-100 h-100">
                                                    <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i></div>
                                                    <div class="title-ctg"><?php echo $row['name_en']; ?></div>
                                                    <ul class="info-link">
                                                        <li><a href="product-grid-layout.php?provider_id=<?php echo $row['provider_id'] ?>&category_id=<?php echo $row['category_id'] ?>"  data-toggle="tooltip" data-placement="bottom" title="Company Products"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <h3 class="short-title"><?php echo $row['company_name']; ?></h3>
                                                <ul class="upload-info">
                                                  <?php
                                                    $address_id    = $row['address_id'];
                                                    $selectAddress = "SELECT * FROM address WHERE address_id='$address_id'";
                                                    $resSA         = mysqli_query($con, $selectAddress);
                                                    while($address = mysqli_fetch_assoc($resSA)){ ?>
                                                      <li class="place"><i class="fa fa-map-marker d-inline-block"></i><?php echo $address['city'].', '.$address['country']; ?></li>
                                                    <?php } ?>
                                                    <li class="d-block"><a href="company_details.php?provider_id=<?php echo $row['provider_id']; ?>" class="btn btn-link" style="font-size:0.8rem">Company Details</a></li>
                                                </ul>
                                                <div class="price" style="font-size:1rem;font-weight:400;bottom:58px"><?php echo $row['owner_full_name']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                  }else{ ?>
                                    <div class="col-12">
                                      <div class="text-center h3">
                                        No Providers in this Category
                                      </div>
                                    </div>
                                  <?php } ?>
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
                                        <a href="provider-grid-layout.php?category_id=<?php echo $row['category_id']; ?>"><img src="../admin/<?php echo $row['url']; ?>" alt="category" class="img-fluid" height="30" width="30"><?php
                                        echo $row['name_en']; ?>
                                        <?php
                                          $provCategory_id   = $row['category_id'];
                                         $numProviderCat     = "SELECT COUNT(*) numOfProv FROM provider WHERE category_id='$provCategory_id'";
                                         $resNum             = mysqli_query($con, $numProviderCat);
                                         while($num = mysqli_fetch_assoc($resNum)){?> <span>(<?php echo $num['numOfProv']; ?>)</span></a> <?php } ?>
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
                                    <li><a href="#"><?php echo $row['city']; ?></a></li>
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


        <script>
        $(function() {
          $('[data-toggle="tooltip"]').tooltip();
        });
        </script>


</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/category-grid-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:22 GMT -->
</html>
