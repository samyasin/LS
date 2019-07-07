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
                         while($cat = mysqli_fetch_assoc($res)){
                           echo $cat['name_en'];
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
                      <div class="row" style="height:200px">
                        <div class="col-12 col-md-4 w-100 h-100">
                          <img class="h-100 rounded" src="../admin/<?php echo $row['logo']; ?>" alt="">
                        </div>
                        <div class="col-12 col-md-8 py-2 d-flex flex-column justify-content-around">
                          <div class="h3">
                            Company: <?php echo $row['company_name']; ?>
                          </div>
                          <div class="h4">
                            Owner: <?php echo $row['owner_full_name']; ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          Phone Number: <?php echo $row['phone_number'] ?>
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
