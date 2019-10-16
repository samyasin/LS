<?php
include 'includes/config.php';
global $con;
$msg = "";
if(isset($_POST['add'])){

  $image = $_FILES['image']['name'];
  $target = "upload/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
      $insert = "INSERT INTO ads(ads_img) VALUES ('$target')";
      if(mysqli_query($con,$insert)){
      //  getAccount($email,$password);
      $msg = "Add Ads successfully";
      }
  	}else{
  		$msg = "Failed to upload image";
  	}

    header('Location: ads.php');

  }

  if(isset($_POST['edit'])){
  $id      = $_POST['id'];
  $image   = $_FILES['eImage']['name'];
  $target  = "upload/".basename($image);
  
    if (move_uploaded_file($_FILES['eImage']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
      $update   = "UPDATE ads SET ads_img='$target' WHERE ads_id='$id'";
      $result = mysqli_query($con,$update);
    }else{
      $msg = "Failed to upload image";
    }
  

  if (move_uploaded_file($_FILES['eImage']['tmp_name'], $target)) {
    $msg = "Image uploaded successfully";
    $update   = "UPDATE ads SET ads_img='$target' WHERE ads_id='$id'";
    $result = mysqli_query($con,$update);
  }else{
    $msg = "Failed to upload image";
  }


  header('Location: ads.php');
}

if(isset($_POST['remove'])){
  $id      = $_POST['id'];
  $target  = $_POST['image'];
  $delete  = "DELETE FROM ads WHERE ads_id='$id'";
  $resulte = mysqli_query($con,$delete);
  unlink($target);
  $msg = "Remove ads successfully";
  header('Location: ads.php');
}



?>

  <?php include 'includes/header.php'; ?>

  <!-- Content -->
  <div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
      <?php if($msg != ''){ ?>
      <div id="msg" class="alert alert-info position-fixed px-3" role="alert" style="bottom:10px; right:10px;z-index:999">
        <?php echo $msg; ?>
      </div>
    <?php }?>
      <!-- add admin -->
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <strong class="card-title">Add Ads</strong>
                </div>
                <div class="card-body card-block position-relative">
                    <form id="add_ads" action = "" method="POST" class="" enctype="multipart/form-data">
                        
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-image"></i></div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="uploadImg" accept="image/*" name="image">
                              <label class="custom-file-label" for="uploadImg">Choose image</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm" name="add" value="add">Submit</button></div>
                    </form>
                    
                </div>
            </div>
        </div>
      </div>
      <!-- / .add admin -->

      <!-- display admin -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong class="card-title">Ads</strong>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-striped table-bordered">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Option</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $retrieveData   = "SELECT * FROM ads";
                    $resultRetrieve = mysqli_query($con,$retrieveData);
                    if(mysqli_num_rows($resultRetrieve)>0){
                      $i=1;
                      while($row = mysqli_fetch_assoc($resultRetrieve)){
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><img src="<?php echo $row['ads_img'];?>" style="max-width:50px;max-height:50px"></td>
                          <td>
                          <!-- modal -->
                          <!-- Button trigger modal -->
                          <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modal<?php echo $i;?>'>
                            Edit
                          </button>

                          <!-- Modal -->
                          <div class='modal fade' id='modal<?php echo $i;?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title d-inline' id='exampleModalLongTitle<?php echo $i;?>'>Edit Ads</h5>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body pb-0'>
                                <!-- form edit admin -->
                                <form id='edit_ads<?php echo $i;?>' action = 'ads.php' method='POST' class="" enctype="multipart/form-data">
                                    <input type='hidden' name='id' value='<?php echo $row['ads_id'];?>'>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="eImage" id="edit<?php echo $i;?>" accept="image/*" value="">
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
                          <form id='option<?php echo $i;?>'action = 'ads.php' method='POST' class='d-inline-block mt-2 mt-md-0'>
                          <input type='hidden' name='id' value='<?php echo $row['ads_id'];?>'>
                            <button class='btn btn-danger btn-sm' type='submit' name='remove' vlaue='remove'>Remove</button>
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
      <!-- / .display admin -->

    </div>
    <!-- / .Animated -->

  </div>
  <!-- /.content -->

  <?php include 'includes/footer.php'; ?>
  <script>
    $(document).ready(function(){
      setTimeout(function(){
         $('#msg').fadeOut('slow');
       }, 3000);
    });
  </script>
</body>
</html>
