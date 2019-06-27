<?php
include 'includes/config.php';
global $con;


// add product
if(isset($_POST['add'])){
  // $userId = SESSION['id'];
  $userId      = '5';
  $title       = $_POST['title'];
  $category    = $_POST['category'];
  $description = $_POST['description'];
  $price       = $_POST['price'];
  $specialP    = $_POST['specialPrice'];
  $featured    = $_POST['featured'];

  $sql        = "INSERT INTO product(title,price,special_price,category_id,user_id,description,featured) VALUES ('$title','$price','$specialP','$category','$userId','$description','$featured')";
  if(mysqli_query($con,$sql)){

    $last_id = mysqli_insert_id($con);

    if(!empty(array_filter($_FILES['image']['name']))){
      foreach ($_FILES['image']['name'] as $key => $value) {
        $imageName = $_FILES['image']['name'][$key];
        $target    = "upload/product/".basename($imageName);
        if(move_uploaded_file($_FILES['image']['tmp_name'][$key],$target)){
          $insert = "INSERT INTO image(product_id, url) VALUES ('$last_id', '$target')";
          $result = mysqli_query($con, $insert);
        }
      }
    }

  }
   header('Location: productAdmin.php');
}

if(isset($_POST['remove'])){
  $product_id = $_POST['id'];
  $delete     = "DELETE FROM product WHERE product_id='$product_id'";
  $result     = mysqli_query($con, $delete);
  $sqlImg     = "SELECT * FROM image WHERE product_id='$product_id'";
  $resultImg  = mysqli_query($con, $sqlImg);
  if(mysqli_num_rows($resultImg) > 0){
    while($row = mysqli_fetch_assoc($resultImg)){
      unlink($row['url']);
      $deleteImg = "DELETE FROM image WHERE product_id='$product_id'";
      $resImg    = mysqli_query($con, $deleteImg);
    }
  }
  header('Location: productAdmin.php');
}

//retrieve data category
$sqlCategory    = "SELECT * FROM category";
$resultCategory = mysqli_query($con,$sqlCategory);

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
                        <div class="input-group-addon"><i class="fa fa-th-list"></i></div>
                        <select class="form-control" name="category" required>
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
                        <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                        <input type="text" id="title" name="title" placeholder="Title" class="form-control" required autocomplete="off">
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
                        <div class="input-group-addon"><i class="fa fa-star"></i></div>
                        <select class="form-control" name="featured" required>
                          <option value="0" selected>Normal</option>
                          <option value="1">Featured</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-image"></i></div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="uploadImg" accept="image/*" name="image[]" multiple required>
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
                    <th>Price</th>
                    <th>Special Price</th>
                    <th>Featured</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $retrieveData = "SELECT product.product_id, product.featured, product.title, category.name catName, product.price, product.special_price, product.description FROM product, category  WHERE product.category_id = category.category_id";
                  $resultRetrieve = mysqli_query($con, $retrieveData);
                  if(mysqli_num_rows($resultRetrieve) > 0){
                    $i=1;
                    while($row = mysqli_fetch_assoc($resultRetrieve)){
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><?php echo $row['catName'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td>
                          <?php
                          if($row['special_price'] ==  ""){
                            echo "-";
                          } else {
                            echo $row['special_price'];
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          if($row['featured'] == 0){
                            echo "Normal";
                          } else{
                            echo "Featured";
                          }
                           ?>
                        </td>
                        <td style="max-width:400px"><?php echo $row['description'];?></td>
                        <!-- display image -->
                        <td>
                        <?php
                          $product_id = $row['product_id'];
                          $retrieveImage = "SELECT * FROM image WHERE product_id='$product_id'";
                          $resultImage = mysqli_query($con,$retrieveImage);
                          if(mysqli_num_rows($resultImage) > 0){
                            while ($imageUrl = mysqli_fetch_assoc($resultImage)) {
                              ?>
                              <img src="<?php echo $imageUrl['url']; ?>" alt="" width="50" height="50" class="my-1">
                              <?php
                            }
                          }
                         ?>
                         </td>
                         <!-- end display image -->
                        <td>
                          <!-- modal -->
                          <!-- Button trigger modal -->
                          <button type='button' class='btn btn-sm btn-primary my-2' data-toggle='modal' data-target='#modal<?php echo $i;?>'>
                            Edit
                          </button>

                          <!-- Modal -->
                          <div class='modal fade' id='modal<?php echo $i;?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title d-inline' id='exampleModalLongTitle<?php echo $i;?>'>Edit Admin</h5>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body pb-0'>
                                <!-- form edit admin -->
                                <form id='edit_admin<?php echo $i;?>' action = 'category.php' method='POST' class="" enctype="multipart/form-data">
                                    <input type='hidden' name='id' value='<?php echo $row['category_id'];?>'>
                                    <div class='form-group'>
                                        <div class='input-group'>
                                            <div class='input-group-addon'><i class='fa fa-th-list'></i></div>
                                            <input type='text' id='eCategory<?php echo $i;?>' name='category' placeholder='Category' class='form-control' required autocomplete='off' value="<?php echo $row['name'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="edit<?php echo $i;?>" accept="image/*" value="<?php echo $row['url'];?>" name="image">
                                          <label class="custom-file-label" for="edit<?php echo $i;?>">Choose image</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class='modal-footer'>
                                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                      <button type='submit' class='btn btn-primary' name="edit" value="edit">Save changes</button>
                                    </div>
                                </form>
                                <!-- end form -->
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end modal -->
                          <form id='option<?php echo $i;?>'action = 'productAdmin.php' method='POST' class='d-inline'>
                          <input type='hidden' name='id' value='<?php echo $row['product_id'];?>'>
                            <button class='btn btn-sm btn-danger' type='submit' name='remove' vlaue='remove'>Remove</button>
                          </form>
                        </td>
                      </tr>
                      <?php
                      $i++;
                    }
                  }
                   ?>
                </tbody>
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
