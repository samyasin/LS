<?php
include 'includes/config.php';
global $con;


// add product
if(isset($_POST['add'])){
  // $userId = SESSION['id'];
  $userId     = '5';
  $title      = $_POST['title'];
  $category   = $_POST['category'];
  $location   = $_POST['location'];
  $description = $_POST['description'];
  $price      = $_POST['price'];
  $specialP   = $_POST['specialPrice'];

  $sql        = "INSERT INTO product(title,price,special_price,category_id,location_id,user_id,description) VALUES ('$title','$price','$specialP','$category','$location','$userId','$description')";
  if(mysqli_query($con,$sql)){
    // get id product for insert images
    $sqlGetID = "SELECT id FROM product WHERE title ='$title' AND pric='$price' AND special_price='$specialP' AND category_id = '$category' AND location_id='$location' AND user_id='$userId' AND description='$description'";
  }
  header('Location: category.php');
}

//retrieve data category
$sqlCategory    = "SELECT * FROM category";
$resultCategory = mysqli_query($con,$sqlCategory);

//retrieve data location
$sqlLocation    = "SELECT * FROM location";
$resultLocation = mysqli_query($con,$sqlLocation);
 ?>


<?php include 'includes/header.php'; ?>

  <!-- Content -->
  <div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <strong class="card-title">Add Product</strong>
            </div>
            <div class="card-body card-block position-relative">
              <form id="add_product" class="" action="productAdmin.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                        <input type="text" id="title" name="title" placeholder="Title" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-th-list"></i></div>
                        <select class="form-control" name="category" required>
                          <option value="-1" selected>Select Category</option>
                          <?php if(mysqli_num_rows($resultCategory) > 0){
                            while($row = mysqli_fetch_assoc($resultCategory)){
                              ?>
                              <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                            }
                          } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                        <select class="form-control" name="location" required>
                          <!-- <option value="-1" selected>Select Category</option> -->
                          <?php if(mysqli_num_rows($resultLocation) > 0){
                            while($row = mysqli_fetch_assoc($resultLocation)){
                              ?>
                              <option value="<?php echo $row['location_id']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                            }
                          } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                        <input type="text" id="price" name="price" placeholder="Price" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                        <input type="text" id="specialPrice" name="specialPrice" placeholder="Special Price" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-image"></i></div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="uploadImg" accept="image/*" name="image[]" multiple>
                      <label class="custom-file-label" for="uploadImg">Choose image</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                      <textarea rows="6" name="description" class="form-control" required placeholder="Description"></textarea>
                    </div>
                </div>
              <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm" name="add" value="add">Submit</button></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- / .end add product -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <strong class="card-title">Product</strong>
            </div>
            <div class="card-body">
              <table id="displayProduct" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Special Price</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Option</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / .Animated -->
  </div>
  <!-- /.content -->

<?php include 'includes/footer.php'; ?>
</body>
</html>
