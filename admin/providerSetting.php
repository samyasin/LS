<?php  ?>
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
    exit();
  }

  include 'includes/header.php';
  $provider_id = $_SESSION['id'];

  if(isset($_FILES['addImg'])){
    $image = $_FILES['addImg']['name'];
    $target = "upload/company_images/$provider_id".basename($image);
  
    if (move_uploaded_file($_FILES['addImg']['tmp_name'], $target)){
      $insertImg = "INSERT INTO company_image(provider_id, url) VALUES ('$provider_id', '$target')";
      $resultImg = mysqli_query($con, $insertImg);
    }
  
  
    echo "<script type='text/javascript'>window.top.location='providerSetting.php?active=4';</script>"; exit;
  }

  if(isset($_POST['deleteImage'])){
    $image_id  = $_POST['image_id'];
    $image_url = $_POST['image_url'];
    unlink($image_url);
    $delete = "DELETE FROM company_image WHERE img_id='$image_id'";
    $result = mysqli_query($con, $delete);
    echo "<script type='text/javascript'>window.top.location='providerSetting.php?active=4';</script>"; exit;
  }

  if(isset($_POST['changeImage'])){
    $image_id  = $_POST['image_id'];
    $image_url = $_POST['image_url'];
    $new_image_url = $_FILES['eImage']['name'];
    $target = "upload/company_images/$provider_id".basename($new_image_url);
    unlink($image_url);
    if(move_uploaded_file($_FILES['eImage']['tmp_name'], $target)){
      $updateImg = "UPDATE company_image SET url='$target' WHERE img_id='$image_id'";
      $resultImg = mysqli_query($con, $updateImg);
    }
    echo "<script type='text/javascript'>window.top.location='providerSetting.php?active=4';</script>"; exit;
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
        $update = "UPDATE provider SET owner_full_name='$owner_name', company_name='$company_name', phone_number='$number_phone', logo='$target', category_id='$category' WHERE provider_id='$provider_id'";
        $res    = mysqli_query($con, $update);
        unlink($unlinkImg);
      }
    }
    echo "<script type='text/javascript'>window.top.location='providerSetting.php?active=1';</script>"; exit;
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
  
    echo "<script type='text/javascript'>window.top.location='providerSetting.php?active=2';</script>"; exit;
  
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
  
  
    echo "<script type='text/javascript'>window.top.location='providerSetting.php?active=3';</script>"; exit;
  }


$retrieveProvider = "SELECT * FROM provider WHERE provider_id='$provider_id'";
$resultProvider   = mysqli_query($con, $retrieveProvider);
$active_num       = $_GET['active'];
$retrieveProviderImage = "SELECT * FROM company_image WHERE provider_id='$provider_id'";
$resultProviderImage   = mysqli_query($con, $retrieveProviderImage);
?>




<!-- start content -->
<div class="content">
    <!-- start animated -->
    <div class="animated fadeIn">
        <!-- start row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Settings</strong>
                    </div>
                    <div class="card-body card-block">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php if($active_num == 1) echo "active"; ?>" id="home-tab"
                                    data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                    aria-selected="true">Company Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($active_num == 2) echo "active"; ?>" id="profile-tab"
                                    data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                    aria-selected="false">Login Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($active_num == 3) echo "active"; ?>" id="contact-tab"
                                    data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                    aria-selected="false">Address Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($active_num == 4) echo "active"; ?>" id="image-tab"
                                    data-toggle="tab" href="#image" role="tab" aria-controls="image"
                                    aria-selected="false">Provider Image</a>
                            </li>
                        </ul>


                        <div class="tab-content mt-4" id="myTabContent">
                            <?php while($row = mysqli_fetch_assoc($resultProvider)){ ?>
                            <div class="tab-pane fade <?php if($active_num == 1) echo "show active"; ?>" id="home"
                                role="tabpanel" aria-labelledby="home-tab">
                                <!-- start form -->
                                <form id='edit_company' action="providerSetting.php" method="post"
                                    enctype="multipart/form-data">
                                    <input type='hidden' name='provider_id' value='<?php echo $row['provider_id'];?>'>
                                    <input type='hidden' name='image' value='<?php echo $row['logo'];?>'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <input type="text" id="company_name" name="company_name"
                                                placeholder="Company Name" class="form-control" required
                                                autocomplete="off" value="<?php echo $row['company_name'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="owner_name" name="owner_name"
                                                placeholder="The Owner's Full Name" class="form-control" required
                                                autocomplete="off" value="<?php echo $row['owner_full_name'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-th-list"></i></div>
                                            <select class="form-control" name="category" required>
                                                <?php
                                                        $sql = "SELECT * FROM category";
                                                        $res = mysqli_query($con, $sql);
                                                        while($cat = mysqli_fetch_assoc($res)){
                                                          ?>
                                                <option value="<?php echo $cat['category_id']; ?>"
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
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="number" id="number_phone" name="number_phone"
                                                placeholder="Number Phone" class="form-control" required
                                                autocomplete="off" value="<?php echo $row['phone_number'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="uploadImg"
                                                    accept="image/*" name="logo">
                                                <label class="custom-file-label" for="uploadImg">Company Logo</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='modal-footer border-0'>
                                        <button type='submit' class='btn btn-primary' name="edit_company"
                                            value="edit_company">Save</button>
                                    </div>

                                </form>
                                <!-- End form -->
                            </div>
                            <div class="tab-pane fade <?php if($active_num == 2) echo "show active"; ?>" id="profile"
                                role="tabpanel" aria-labelledby="profile-tab">
                                <div class="alert alert-danger" role="alert" style="display:none">
                                    Passwords do not match
                                </div>
                                <!-- start form -->
                                <form id='edit_login' action="providerSetting.php" method="post">
                                    <input type='hidden' name='provider_id' value='<?php echo $row['provider_id'];?>'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="email" id="email" name="email" placeholder="Email"
                                                class="form-control" required autocomplete="off"
                                                value="<?php echo $row['provider_email'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                            <input type="password" id="password" name="password" placeholder="password"
                                                class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                            <input type="password" id="cPassword" name="cPassword"
                                                placeholder="Confirm Password" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class='modal-footer border-0'>
                                        <button type='submit' class='btn btn-primary' name="edit_login"
                                            value="edit_login">Save</button>
                                    </div>

                                </form>
                                <!-- end form -->
                            </div>
                            <div class="tab-pane fade <?php if($active_num == 3) echo "show active"; ?>" id="contact"
                                role="tabpanel" aria-labelledby="contact-tab">
                                <!-- start form -->
                                <form id='edit_address' action="providerSetting.php" method="post">
                                    <input type='hidden' name='provider_id' value='<?php echo $row['provider_id'];?>'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" id="address_line" name="address_line"
                                                placeholder="Address Line" class="form-control" required
                                                autocomplete="off" value="<?php echo $row['address_line'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <select class="form-control city" name="city_id" id="editCity" required>
                                                <?php
                                                    $country_id = $row['country_id'];
                                                    $select_city = "SELECT * FROM city WHERE country_id='$country_id'";
                                                    $result_city = mysqli_query($con, $select_city);
                                                    while($city = mysqli_fetch_assoc($result_city)){ ?>
                                                <option value="<?php echo $city['city_id']; ?>"
                                                    <?php if($city['city_id'] == $row['city_id']) echo "selected"; ?>>
                                                    <?php echo $city['city_name']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                            <select id="editCountry<?php echo $i; ?>" class="form-control country"
                                                name="country_id" required data-id="#editCity">
                                                <option value="" selected disabled hidden>Select Country</option>
                                                <?php
                                                    $select_country = "SELECT * FROM country ORDER BY country_name";
                                                    $result_country = mysqli_query($con, $select_country);
                                                        if(mysqli_num_rows($result_country) > 0){
                                                    while($country = mysqli_fetch_assoc($result_country)){ ?>
                                                <option value="<?php echo $country['country_id']; ?>"
                                                    <?php if($country['country_id'] == $row['country_id']) echo "selected"; ?>>
                                                    <?php echo $country['country_name']; ?>
                                                </option>
                                                <?php  } }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                            <input type="text" id="editLocation_map" name="location_map"
                                                placeholder="Location in Map" class="form-control" required
                                                autocomplete="off" value="<?php echo $row['location_map']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-paper-plane"></i></div>
                                            <input type="text" id="postal_code" name="postal_code"
                                                placeholder="Postal Code" class="form-control" required
                                                autocomplete="off" value="<?php echo $row['postal_code'];?>">
                                        </div>
                                    </div>

                                    <div class='modal-footer border-0'>
                                        <button type='submit' class='btn btn-primary' name="edit_address"
                                            value="edit_address">Save</button>
                                    </div>

                                </form>
                                <!-- end form -->
                            </div>
                            <div class="tab-pane fade <?php if($active_num == 4) echo "show active"; ?>" id="image"
                                role="tabpanel" aria-labelledby="image-tab">
                                <div class="inerCard card border-secondary">
                                    <div class="card-header bg-dark text-light">
                                        <div class="row">
                                            <div class="col-8">
                                                Image
                                            </div>
                                            <div class="col-4 d-flex justify-content-end align-items-center">
                                                <form id="addImage"
                                                    action="providerSetting.php"
                                                    method="post" enctype="multipart/form-data">
                                                    <button id="btnAddImg"
                                                        class="btn btn-dark btn-file position-relative" type="button"><i
                                                            class="fa fa-plus fa-1x"></i> <input id="addImg" type="file"
                                                            name="addImg" accept="image/*"></button>
                                                    <input class="d-none" id="btn-addImg" type="submit" name="send"
                                                        value="send">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Start image show -->
                                        <?php $i=0; while($imageShow = mysqli_fetch_assoc($resultProviderImage)) { ?>
                                        <div class="bg-light rounded my-2 text-secondary p-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <img class="rounded" src="<?php echo $imageShow['url']; ?>" alt=""
                                                        style="max-width:100px;max-height:100px;min-width:75px;min-height:75px">
                                                </div>
                                                <div class="col-6 d-flex justify-content-end align-items-center">
                                                    <button
                                                        class="btn text-secondary btn-light btn-option position-relative btn-sm"
                                                        type="button" name="button" data-toggle="modal"
                                                        data-target="#editProductImage<?php echo $imageShow['img_id']; ?>"><i
                                                            class="fa fa-edit fa-2x mx-2"></i></button>

                                                    <form class=""
                                                        action="providerSetting.php"
                                                        method="post" enctype="multipart/form-data">
                                                        <button
                                                            class="btn text-secondary btn-light btn-option position-relative btn-sm"
                                                            type="submit" name="deleteImage"><i
                                                                class="fa fa-trash fa-2x mx-3"></i></button>
                                                        <!-- Start Modal -->
                                                        <div class="modal fade"
                                                            id="editProductImage<?php echo $imageShow['img_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title d-inline-block"
                                                                            id="exampleModalLongTitle">Change Image</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon"><i
                                                                                        class="fa fa-image"></i></div>
                                                                                <div class="custom-file">
                                                                                    <input type="hidden" name="image_id"
                                                                                        value="<?php echo $imageShow['img_id']; ?>">
                                                                                    <input type="hidden"
                                                                                        name="image_url"
                                                                                        value="<?php echo $imageShow['url']; ?>">
                                                                                    <input type="file"
                                                                                        class="custom-file-input"
                                                                                        name="eImage" id="edit<?php echo $i; ?>"
                                                                                        accept="image/*" value="">
                                                                                    <label class="custom-file-label"
                                                                                        for="edit<?php echo $i; ?>">Choose image</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            name="changeImage">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; } ?>
                                        <!-- End image show -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
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
    $('#edit_login').submit(function() {
        if ($('#password').val() != $('#cPassword').val()) {
            $('.alert').fadeIn('slow');
            $('#cPassword').css('border-color', '#dc3545');
            return false;
        }
    });

    $('.country').on('change', function() {
        var value = $(this).val();
        var city = $(this).attr('data-id');

        $.ajax({
            type: 'post',
            url: 'providerSetting.php',
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
  <script>
    $(document).ready(function(e){
      $('#addImg').change(function(e){
        $('#btn-addImg').click();
      });
    });
  </script>

</body>

</html>