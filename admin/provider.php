<?php
include 'includes/config.php';
global $con;


if(isset($_POST['ajax']) && isset($_POST['country_id'])){
  $country_id = $_POST['country_id'];
  $sql = "SELECT * FROM city WHERE country_id='$country_id'";
  $res = mysqli_query($con, $sql);
  while($city = mysqli_fetch_assoc($res)){
    $city_id = $city['city_id'];
    $city_name = $city['city_name'];
    echo "<option value='$city_id'>$city_name</option>";
  }
  exit;
}


if(isset($_POST['add'])){
  $company_name = $_POST['company_name'];
  $owner_name   = $_POST['owner_name'];
  $category     = $_POST['category'];
  $number_phone = $_POST['number_phone'];
  $logo         = $_FILES['logo']['name'];
  $target       = "upload/company_logo/".basename($logo);
  $email        = $_POST['email'];
  $password     = md5($_POST['password']);
  $address_line = $_POST['address_line'];
  $city         = $_POST['city_id'];
  $country      = $_POST['country_id'];
  $postal_code  = $_POST['postal_code'];
  $location_map = $_POST['location_map'];

    if(move_uploaded_file($_FILES['logo']['tmp_name'], $target)){
      $insertProvider = "INSERT INTO provider(owner_full_name,company_name,provider_email, password,phone_number,logo,location_map,category_id,address_line,postal_code,country_id,city_id) VALUES ('$owner_name','$company_name','$email','$password',
        '$number_phone','$target', '$location_map','$category','$address_line', '$postal_code', '$country', '$city')";
      $result  = mysqli_query($con, $insertProvider);
      $provider_id = mysqli_insert_id($con);
      foreach($_FILES['companyImg']['name'] as $key => $value){
        $imageName = $_FILES['companyImg']['name'][$key];
        $target    = "upload/company_images/$provider_id".basename($imageName);
        if(move_uploaded_file($_FILES['companyImg']['tmp_name'][$key], $target)){
            $insertImage = "INSERT INTO company_image(provider_id,url) VALUE ('$provider_id', '$target')";
            $resultImage = mysqli_query($con, $insertImage);
        }
      }
  }

  header("Location: provider.php");
}

if(isset($_POST['remove'])){
  $provider_id = $_POST['provider_id'];
  $logo        = $_POST['logo'];

  $delProvider = "DELETE FROM provider WHERE provider_id='$provider_id'";
  $resDelP     = mysqli_query($con, $delProvider);
  unlink($logo);

  $selectImage = "SELECT * FROM company_image WHERE provider_id='$provider_id'";
  $resultImage = mysqli_query($con, $selectImage);
  while($img   = mysqli_fetch_assoc($resultImage)){
    $delImg = $img['url'];  
    unlink($delImg);
    $delImage    = "DELETE FROM company_image WHERE provider_id='$provider_id'";
    $resDelImg   = mysqli_query($con, $delImage);
  };

  header("Location: provider.php");
}

if(isset($_POST['edit_company'])){
  $provider_id  = $_POST['provider_id'];
  $company_name = $_POST['company_name'];
  $owner_name   = $_POST['owner_name'];
  $number_phone = $_POST['number_phone'];
  $category     = $_POST['category'];
  $logo         = $_FILES['logo']['name'];
  $target       = "upload/company_logo/".basename($logo);
  $unlinkImg    = $_POST['image'];

  if($logo == ""){
    $update = "UPDATE provider SET owner_full_name='$owner_name', company_name='$company_name', phone_number='$number_phone', category_id='$category' WHERE provider_id='$provider_id'";
    $res    = mysqli_query($con, $update);
  }else {
    if(move_uploaded_file($_FILES['logo']['tmp_name'], $target)){
      $update = "UPDATE provider SET owner_full_name='$owner_name', company_name='$company_name', phone_number='$number_phone', logo='$target', category_id='$category' provider_id='$provider_id'";
      $res    = mysqli_query($con, $update);
      unlink($unlinkImg);
    }
  }
  header("Location: provider.php");
}


if(isset($_POST['edit_login'])){
  $provider_id   = $_POST['provider_id'];
  $email         = $_POST['email'];
  $password      = $_POST['password'];

  if($password == ""){
    $sql = "UPDATE provider SET provider_email='$email' WHERE provider_id='$provider_id'";
    $res = mysqli_query($con, $sql);
  }else{
    $password = md5($password);
    $sql = "UPDATE provider SET provider_email='$email', password='$password' WHERE provider_id='$provider_id'";
    $res = mysqli_query($con, $sql);
  }

  header("Location: provider.php");

}


if(isset($_POST['edit_address'])){
  $provider_id  = $_POST['provider_id'];
  $address_line = $_POST['address_line'];
  $city_id         = $_POST['city_id'];
  $country_id      = $_POST['country_id'];
  $postal_code  = $_POST['postal_code'];
  $location_map = $_POST['location_map'];

  $sqlL = "UPDATE provider SET location_map='$location_map', city_id='$city_id', country_id='$country_id', postal_code='$postal_code', address_line='$address_line' WHERE provider_id='$provider_id'";
  $resL = mysqli_query($con, $sqlL);


  header("Location: provider.php");
}


//retrieve data category
$sqlCategory    = "SELECT * FROM category";
$resultCategory = mysqli_query($con,$sqlCategory);

$select_country = "SELECT * FROM country ORDER BY country_name";
$result_country = mysqli_query($con, $select_country);
 ?>

<?php include 'includes/header.php'; ?>

<!-- start content -->
<div class="content">
    <!-- start animated -->
    <div class="animated fadeIn">
        <!-- start row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Provider</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="alert alert-danger" role="alert" style="display:none">
                            Passwords do not match
                        </div>
                        <h4 class="card-title">Company Information</h4>
                        <form id="add_provider" class="mt-3" action="provider.php" method="post" validate
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <input type="text" id="company_name" name="company_name" placeholder="Company Name"
                                        class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="owner_name" name="owner_name"
                                        placeholder="The Owner's Full Name" class="form-control" required
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-th-list"></i></div>
                                    <select class="form-control" name="category" required>
                                        <?php if(mysqli_num_rows($resultCategory) > 0){
                           while($row = mysqli_fetch_assoc($resultCategory)){
                             ?>
                                        <option value="<?php echo $row['category_id']; ?>">
                                            <?php echo $row['name_en']; ?></option>
                                        <?php
                           }
                         } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="number" id="number_phone" name="number_phone"
                                        placeholder="Number Phone" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="uploadImg" accept="image/*"
                                            name="logo" required>
                                        <label class="custom-file-label" for="uploadImg">Company Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="uploadImgs" accept="image/*"
                                            name="companyImg[]" multiple>
                                        <label class="custom-file-label" for="uploadImgs">Company Images (Main building,
                                            Branches).</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title mt-4">Login Information</h4>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" id="email" name="email"
                                        placeholder="Email (It is also used as an email for the company)"
                                        class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    <input type="password" id="password" name="password" placeholder="Password"
                                        class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    <input type="password" id="cpassword" name="cPassword"
                                        placeholder="Confirm Password" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <h4 class="card-title mt-4">Address Information</h4>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" id="address_line" name="address_line" placeholder="Address Line"
                                        class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                        <select id="country" class="form-control country" name="country_id"
                                            data-id="#city" required>
                                            <option value="" selected disabled hidden>Select Country</option>
                                            <?php if(mysqli_num_rows($result_country) > 0){
                                  while($country = mysqli_fetch_assoc($result_country)){ ?>
                                            <option value="<?php echo $country['country_id']; ?>">
                                                <?php echo $country['country_name']; ?></option>
                                            <?php  }
                              }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <select class="form-control city" name="city_id" id="city" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-paper-plane"></i></div>
                                        <input type="number" id="postal_code" name="postal_code"
                                            placeholder="Postal Code" class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                        <input type="text" id="location_map" name="location_map"
                                            placeholder="Location in Map" class="form-control" required
                                            autocomplete="off">
                                        <div class="input-group-addon" data-toggle="modal"
                                            data-target="#exampleModalCenter"><i class="fa fa-info"></i></div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title d-inline-block"
                                                            id="exampleModalLongTitle">How to add link google map
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ol class="px-4">
                                                            <li>Go to Google Maps.</li>
                                                            <li>Locate your company in a map.</li>
                                                            <li>Press the Share button.</li>
                                                            <li>Copy Link.</li>
                                                            <li>Paste it into a field.</li>
                                                        </ol>
                                                        <a href="https://youtu.be/ow5w-t-z4YQ" target="_blank"
                                                            class="btn btn-link">Go to youtube</a>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm"
                                    name="add" value="add">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- start row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Provider</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Owner Name</th>
                                    <th>Category</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Address Line</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Postal Code</th>
                                    <th>Logo</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    $retrieveProvider = "SELECT * FROM provider";
                    $resultProvider   = mysqli_query($con, $retrieveProvider);
                    if(mysqli_num_rows($resultProvider) > 0){
                      $i=1;
                      while($row = mysqli_fetch_assoc($resultProvider)){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['owner_full_name']; ?></td>
                                    <td>
                                        <?php
                              $category_id = $row['category_id'];
                              $sqlCat = "SELECT name_en FROM category WHERE category_id = '$category_id'";
                              $resCat = mysqli_query($con, $sqlCat);
                              while($cat = mysqli_fetch_assoc($resCat)){
                                echo $cat['name_en'];
                              }
                             ?>
                                    </td>
                                    <td><?php echo $row['phone_number']; ?></td>
                                    <td><?php echo $row['provider_email']; ?></td>
                                    <td><?php echo $row['address_line']; ?></td>
                                    <td>
                                        <?php $city_id =  $row['city_id'];
                                          $sql = "SELECT city_name FROM city WHERE city_id='$city_id'";
                                          $res = mysqli_query($con, $sql);
                                          while($city = mysqli_fetch_assoc($res)){
                                            echo $city['city_name'];
                                          }
                                     ?>
                                    </td>
                                    <td><?php
                                       $country = $row['country_id']; 
                                       $sql = "SELECT country_name FROM country WHERE country_id='$country'";
                                       $res = mysqli_query($con, $sql);
                                       while($country = mysqli_fetch_assoc($res)){
                                         echo $country['country_name'];
                                       }
                                       ?></td>
                                    <td><?php echo $row['postal_code']; ?></td>
                                    <td>
                                        <img src="<?php echo $row['logo']; ?>" alt=""
                                            style="max-width: 100px;max-height: 100px;min-width: 75px;min-height: 75px">
                                    </td>
                                    <td>
                                        <div class="row" style="max-width:200px">
                                            <div class="col-12 mb-1">
                                                <button class="btn btn-primary btn-sm w-100" type="button" name="button"
                                                    data-toggle='modal' data-target='#modalEditC<?php echo $i;?>'>Edit
                                                    Company Info.</button>
                                                <!-- stert Modal Edit Company -->
                                                <div class="modal fade" id="modalEditC<?php echo $i;?>" tabindex='-1'
                                                    role='dialog' aria-labelledby='exampleModalCenterTitle'
                                                    aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class='modal-title d-inline'
                                                                    id='exampleModalLongTitle<?php echo $i;?>'>Edit
                                                                    Company Info.</h5>
                                                                <button type='button' class='close' data-dismiss='modal'
                                                                    aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pb-0">
                                                                <!-- start form -->
                                                                <form id='edit_company<?php echo $i;?>'
                                                                    action="provider.php" method="post"
                                                                    enctype="multipart/form-data">
                                                                    <input type='hidden' name='provider_id'
                                                                        value='<?php echo $row['provider_id'];?>'>
                                                                    <input type='hidden' name='image'
                                                                        value='<?php echo $row['logo'];?>'>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-building"></i></div>
                                                                            <input type="text"
                                                                                id="company_name<?php echo $i;?>"
                                                                                name="company_name"
                                                                                placeholder="Company Name"
                                                                                class="form-control" required
                                                                                autocomplete="off"
                                                                                value="<?php echo $row['company_name'];?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-user"></i></div>
                                                                            <input type="text"
                                                                                id="owner_name<?php echo $i;?>"
                                                                                name="owner_name"
                                                                                placeholder="The Owner's Full Name"
                                                                                class="form-control" required
                                                                                autocomplete="off"
                                                                                value="<?php echo $row['owner_full_name'];?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-th-list"></i></div>
                                                                            <select class="form-control" name="category"
                                                                                required>
                                                                                <?php
                                                        $sql = "SELECT * FROM category";
                                                        $res = mysqli_query($con, $sql);
                                                        while($cat = mysqli_fetch_assoc($res)){
                                                          ?>
                                                                                <option
                                                                                    value="<?php echo $cat['category_id']; ?>"
                                                                                    <?php if($row['category_id'] == $cat['category_id']) echo "selected"; ?>>
                                                                                    <?php echo $cat['name_en']; ?>
                                                                                </option>
                                                                                <?php
                                                        }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-phone"></i></div>
                                                                            <input type="number"
                                                                                id="number_phone<?php echo $i;?>"
                                                                                name="number_phone"
                                                                                placeholder="Number Phone"
                                                                                class="form-control" required
                                                                                autocomplete="off"
                                                                                value="<?php echo $row['phone_number'];?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-image"></i></div>
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    class="custom-file-input"
                                                                                    id="uploadImg<?php echo $i;?>"
                                                                                    accept="image/*" name="logo">
                                                                                <label class="custom-file-label"
                                                                                    for="uploadImg">Company Logo</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-secondary'
                                                                            data-dismiss='modal'>Close</button>
                                                                        <button type='submit' class='btn btn-primary'
                                                                            name="edit_company"
                                                                            value="edit_company">Save</button>
                                                                    </div>

                                                                </form>
                                                                <!-- end form -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal Edit Company -->
                                            </div>

                                            <div class="col-12 mb-1">
                                                <button class="btn btn-primary btn-sm w-100" type="button" name="button"
                                                    data-toggle='modal' data-target='#modalEditL<?php echo $i;?>'>Edit
                                                    Login Info.</button>
                                                <!-- stert Modal Edit Login -->
                                                <div class="modal fade" id="modalEditL<?php echo $i;?>" tabindex='-1'
                                                    role='dialog' aria-labelledby='exampleModalCenterTitle'
                                                    aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class='modal-title d-inline'
                                                                    id='exampleModalLongTitleL<?php echo $i;?>'>Edit
                                                                    Login Info.</h5>
                                                                <button type='button' class='close' data-dismiss='modal'
                                                                    aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pb-0">
                                                                <!-- start form -->
                                                                <form id='edit_login<?php echo $i;?>'
                                                                    action="provider.php" method="post">
                                                                    <input type='hidden' name='provider_id'
                                                                        value='<?php echo $row['provider_id'];?>'>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-envelope"></i></div>
                                                                            <input type="email"
                                                                                id="email<?php echo $i;?>" name="email"
                                                                                placeholder="Email" class="form-control"
                                                                                required autocomplete="off"
                                                                                value="<?php echo $row['provider_email'];?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-asterisk"></i></div>
                                                                            <input type="password"
                                                                                id="password<?php echo $i;?>"
                                                                                name="password" placeholder="password"
                                                                                class="form-control" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-asterisk"></i></div>
                                                                            <input type="password"
                                                                                id="cPassword<?php echo $i;?>"
                                                                                name="cPassword"
                                                                                placeholder="Confirm Password"
                                                                                class="form-control" autocomplete="off">
                                                                        </div>
                                                                    </div>

                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-secondary'
                                                                            data-dismiss='modal'>Close</button>
                                                                        <button type='submit' class='btn btn-primary'
                                                                            name="edit_login"
                                                                            value="edit_login">Save</button>
                                                                    </div>

                                                                </form>
                                                                <!-- end form -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal Edit Company -->
                                            </div>
                                            <div class="col-12 mb-1">
                                                <button class="btn btn-primary btn-sm w-100" type="button" name="button"
                                                    data-toggle='modal' data-target='#modalEditA<?php echo $i;?>'>Edit
                                                    Address Info.</button>
                                                <!-- stert Modal Edit Login -->
                                                <div class="modal fade" id="modalEditA<?php echo $i;?>" tabindex='-1'
                                                    role='dialog' aria-labelledby='exampleModalCenterTitle'
                                                    aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class='modal-title d-inline'
                                                                    id='exampleModalLongTitleA<?php echo $i;?>'>Edit
                                                                    Address Info.</h5>
                                                                <button type='button' class='close' data-dismiss='modal'
                                                                    aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pb-0">
                                                                <!-- start form -->
                                                                <form id='edit_address<?php echo $i;?>'
                                                                    action="provider.php" method="post">
                                                                    <input type='hidden' name='provider_id'
                                                                        value='<?php echo $row['provider_id'];?>'>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-map-marker"></i></div>
                                                                            <input type="text"
                                                                                id="address_line<?php echo $i;?>"
                                                                                name="address_line"
                                                                                placeholder="Address Line"
                                                                                class="form-control" required
                                                                                autocomplete="off"
                                                                                value="<?php echo $row['address_line'];?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-map-marker"></i></div>
                                                                            <select class="form-control city"
                                                                                name="city_id"
                                                                                id="editCity<?php echo $i;  ?>"
                                                                                required>
                                                                                <?php
                                                                                $country_id = $row['country_id'];
                                                                                 $select_city = "SELECT * FROM city WHERE country_id='$country_id'";
                                                                                 $result_city = mysqli_query($con, $select_city);
                                                                                 while($city = mysqli_fetch_assoc($result_city)){ ?>
                                                                                <option
                                                                                    value="<?php echo $city['city_id']; ?>"
                                                                                    <?php if($city['city_id'] == $row['city_id']) echo "selected"; ?>>
                                                                                    <?php echo $city['city_name']; ?>
                                                                                </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-globe"></i></div>
                                                                            <select id="editCountry<?php echo $i; ?>"
                                                                                class="form-control country"
                                                                                name="country_id" required
                                                                                data-id="#editCity<?php echo $i;  ?>">
                                                                                <option value="" selected disabled
                                                                                    hidden>Select Country</option>
                                                                                <?php
                                                                                $select_country = "SELECT * FROM country ORDER BY country_name";
                                                                                $result_country = mysqli_query($con, $select_country);
                                                                                 if(mysqli_num_rows($result_country) > 0){
                                                                                while($country = mysqli_fetch_assoc($result_country)){ ?>
                                                                                <option
                                                                                    value="<?php echo $country['country_id']; ?>"
                                                                                    <?php if($country['country_id'] == $row['country_id']) echo "selected"; ?>>
                                                                                    <?php echo $country['country_name']; ?>
                                                                                </option>
                                                                                <?php  }
                                                                                }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-map"></i></div>
                                                                            <input type="text"
                                                                                id="editLocation_map<?php echo $i;?>"
                                                                                name="location_map"
                                                                                placeholder="Location in Map"
                                                                                class="form-control" required
                                                                                autocomplete="off"
                                                                                value="<?php echo $row['location_map']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i
                                                                                    class="fa fa-paper-plane"></i></div>
                                                                            <input type="text"
                                                                                id="postal_code<?php echo $i;?>"
                                                                                name="postal_code"
                                                                                placeholder="Postal Code"
                                                                                class="form-control" required
                                                                                autocomplete="off"
                                                                                value="<?php echo $row['postal_code'];?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-secondary'
                                                                            data-dismiss='modal'>Close</button>
                                                                        <button type='submit' class='btn btn-primary'
                                                                            name="edit_address"
                                                                            value="edit_address">Save</button>
                                                                    </div>

                                                                </form>
                                                                <!-- end form -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal Edit Company -->
                                            </div>
                                            <div class="col-12">
                                                <form id="option<?php echo $i;?>Del" action="provider.php"
                                                    method="post">
                                                    <input type="hidden" name="provider_id"
                                                        value="<?php echo $row['provider_id'] ?>">
                                                    <input type="hidden" name="logo" value="<?php echo $row['logo'] ?>">
                                                    <button class="btn btn-danger btn-sm w-100" type="submit"
                                                        name="remove" value="remove">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; }
                    }
                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end animated -->
</div>
<!-- end content -->


<?php include 'includes/footer.php'; ?>

<script>
$('.alert').fadeOut();
$(document).ready(function() {
    $('#add_provider').submit(function() {
        if ($('#password').val() != $('#cpassword').val()) {
            $('.alert').fadeIn('slow');
            $('#cpassword').css('border-color', '#dc3545');
            return false;
        }
    });

    $('.country').on('change', function() {
        var value = $(this).val();
        var city = $(this).attr('data-id');

        $.ajax({
            type: 'post',
            url: 'provider.php',
            cache: false,
            data: {
                ajax: 1,
                country_id: value
            },
            success: function(data) {
                $(city).html(data);
            }

        });
    });

});
</script>

</body>

</html>