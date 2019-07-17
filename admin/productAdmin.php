<?php
include 'includes/header.php';
include 'includes/config.php';
global $con;
$provider_id = $_SESSION['id'];
// add product
if(isset($_POST['add'])){
  // $userId = SESSION['id'];
  $provider_id = $_SESSION['id'];
  $title       = $_POST['title'];
  $category    = $_POST['category'];
  $description = $_POST['description'];
  $price       = $_POST['price'];
  $specialP    = $_POST['specialPrice'];
  $featured    = $_POST['featured'];
  $brand       = $_POST['brand'];
  $color       = $_POST['color'];
  $warranty    = $_POST['warranty'];

  $sql        = "INSERT INTO product(title,price,special_price,brand,color,warranty,category_id,provider_id,description,featured) VALUES ('$title','$price','$specialP','$brand','$color','$warranty','$category','$provider_id','$description','$featured')";
  if(mysqli_query($con,$sql)){

    $last_id = mysqli_insert_id($con);

    if(!empty(array_filter($_FILES['image']['name']))){
      foreach ($_FILES['image']['name'] as $key => $value) {
        $imageName = $_FILES['image']['name'][$key];
        $target    = "upload/product/$last_id".basename($imageName);
        if(move_uploaded_file($_FILES['image']['tmp_name'][$key],$target)){
          $insert = "INSERT INTO product_image(product_id, url) VALUES ('$last_id', '$target')";
          $result = mysqli_query($con, $insert);
        }
      }
    }

  }
  echo "<script type='text/javascript'>window.top.location='productAdmin.php';</script>"; exit;
   // exit(header('Location: productAdmin.php'));
}

if(isset($_POST['remove'])){
  $product_id = $_POST['id'];
  $delete     = "DELETE FROM product WHERE product_id='$product_id'";
  $result     = mysqli_query($con, $delete);
  $sqlImg     = "SELECT * FROM product_image WHERE product_id='$product_id'";
  $resultImg  = mysqli_query($con, $sqlImg);
  if(mysqli_num_rows($resultImg) > 0){
    while($row = mysqli_fetch_assoc($resultImg)){
      unlink($row['url']);
      $deleteImg = "DELETE FROM product_image WHERE product_id='$product_id'";
      $resImg    = mysqli_query($con, $deleteImg);
    }
  }
  echo "<script type='text/javascript'>window.top.location='productAdmin.php';</script>"; exit;
  //header('Location: productAdmin.php');
}

//retrieve data category
$sqlCategory    = "SELECT * FROM category";
$resultCategory = mysqli_query($con,$sqlCategory);

 ?>


  <!-- Content -->
  <div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
      <?php if($_SESSION['type'] != 'admin'){ ?>
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
                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name_en']; ?></option>
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
                          <div class="input-group-addon"><i class="fa fa-trademark"></i></div>
                          <input type="text" id="brand" name="brand" placeholder="Brand" class="form-control" autocomplete="off">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-shield"></i></div>
                          <input type="text" id="warranty" name="warranty" placeholder="Warranty Period" class="form-control" autocomplete="off">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-tint"></i></div>
                          <input type="text" id="color" name="color" placeholder="Color" class="form-control" autocomplete="off">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-image"></i></div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="uploadImg" accept="image/*" name="image[]" multiple required>
                        <label class="custom-file-label" for="uploadImg">Choose images</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <textarea id="example" name="description" class="form-control" required placeholder="Description"></textarea>
                    </div>
                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm" name="add" value="add">Submit</button></div>
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- / .end add product -->
      <?php } ?>
      <div class="row">
        <div class="col-12">
          <div class="card w-100">
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
                    <th>Featured</th>
                    <th>Images</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($_SESSION['type'] == 'admin'){
                    $retrieveData = "SELECT * FROM product, category  WHERE product.category_id = category.category_id";
                  } else {
                    $retrieveData = "SELECT * FROM product, category  WHERE product.category_id = category.category_id AND product.provider_id='$provider_id'";
                  }

                  $resultRetrieve = mysqli_query($con, $retrieveData);
                  if(mysqli_num_rows($resultRetrieve) > 0){
                    $i=1;
                    while($row = mysqli_fetch_assoc($resultRetrieve)){
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><?php echo $row['name_en'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td>
                          <?php
                          if($row['featured'] == 0){
                            echo "Normal";
                          } else{
                            echo "Featured";
                          }
                           ?>
                        </td>
                        <!-- display image -->
                        <td>
                        <?php
                          $product_id = $row['product_id'];
                          $retrieveImage = "SELECT * FROM product_image WHERE product_id='$product_id'";
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
                          <div class="row">
                            <div class="col-12">
                              <a href="previewProduct.php?product_id=<?php echo $row['product_id'];?>" class='btn btn-sm btn-info w-100' target="_blank">Preview</a>
                            </div>
                            <div class="col-12">
                              <a href="editProduct.php?product_id=<?php echo $row['product_id'];?>" class='btn btn-sm btn-primary my-2 w-100'>Edit</a>
                            </div>
                            <div class="col-12">
                              <form id='option<?php echo $i;?>'action = 'productAdmin.php' method='POST' class='d-inline'>
                              <input type='hidden' name='id' value='<?php echo $row['product_id'];?>'>
                                <button class='btn btn-sm btn-danger w-100' type='submit' name='remove' vlaue='remove'>Remove</button>
                              </form>
                            </div>
                          </div>
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

<script type="text/javascript">
var editor = new FroalaEditor('#example', {
  toolbarButtons: ['bold', 'italic', 'underline', '|', 'fontFamily', '|', 'fontSize', '|', 'formatOL', 'formatUL', '|', 'align', '|', 'lineHeight', '|', 'undo', 'redo'],
  heightMin: 150,
  dragInline: false,
  toolbarInline: false,
  placeholderText: 'Description',
  enter: FroalaEditor.ENTER_BR
});
</script>
</body>
</html>
