<?php

session_start();

if(!isset($_SESSION["id"])){
  header('Location: login.php');
}

include 'includes/config.php';
global $con;


if(!isset($_GET['product_id'])){
  header("Location: productAdmin.php");
}

$product_id = $_GET['product_id'];

if(isset($_FILES['addImg'])){
  $image = $_FILES['addImg']['name'];
  $target = "upload/product/$product_id".basename($image);

  if (move_uploaded_file($_FILES['addImg']['tmp_name'], $target)){
    $insertImg = "INSERT INTO product_image(product_id, url) VALUES ('$product_id', '$target')";
    $resultImg = mysqli_query($con, $insertImg);
  }


    header("Location: editProduct.php?product_id=$product_id");
}


if(isset($_POST['deleteImage'])){
  $image_id  = $_POST['image_id'];
  $image_url = $_POST['image_url'];
  unlink($image_url);
  $delete = "DELETE FROM product_image WHERE img_id='$image_id'";
  $result = mysqli_query($con, $delete);
  header("Location: editProduct.php?product_id=$product_id");
}


if(isset($_POST['changeImage'])){
  $image_id  = $_POST['image_id'];
  $image_url = $_POST['image_url'];
  $new_image_url = $_FILES['eImage']['name'];
  $target = "upload/product/$product_id".basename($new_image_url);
  unlink($image_url);
  if(move_uploaded_file($_FILES['eImage']['tmp_name'], $target)){
    $updateImg = "UPDATE product_image SET url='$target' WHERE img_id='$image_id'";
    $resultImg = mysqli_query($con, $updateImg);
  }
  header("Location: editProduct.php?product_id=$product_id");
}


if(isset($_POST['save'])){
  $category     = $_POST['category'];
  $title        = $_POST['title'];
  $price        = $_POST['price'];
  $specialPrice = $_POST['specialPrice'];
  $featurd      = $_POST['featured'];
  $brand        = $_POST['brand'];
  $color        = $_POST['color'];
  $warranty     = $_POST['warranty'];
  $description  = $_POST['description'];
  $video_url    = $_POST['video'];

  $pos         = strpos($video_url,'v=');

  if(!$pos){
    $video_embed = $video_url;
  }else{
    $pos+=2;
    $video_v     = substr($video_url, $pos);
    $video_embed = "https://www.youtube.com/embed/".$video_v;
  }

  $sql          = "UPDATE product SET title='$title', price='$price', special_price='$specialPrice', brand='$brand', color='$color', warranty='$warranty', category_id='$category', description='$description', featured='$featurd', video_url='$video_embed' WHERE product_id='$product_id'";
  $result = mysqli_query($con, $sql);
  header("Location: productAdmin.php");

}


$retrieveProduct      = "SELECT * FROM product WHERE product_id='$product_id'";
$resultProduct        = mysqli_query($con, $retrieveProduct);


$retrieveCategory     = "SELECT * FROM category";
$resultCategory       = mysqli_query($con,$retrieveCategory);


$retrieveProductImage = "SELECT * FROM product_image WHERE product_id='$product_id'";
$resultProductImage   = mysqli_query($con, $retrieveProductImage);


 ?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

  <style>
    .vh-100 {
      height: 100vh
    }
    .bg-lightBody{
      background-color: #fefefe !important;
    }
    .bg-light{
      background-color: #eaeaea !important;
    }
    .fr-box.fr-basic{
      width: 100%;
      margin-bottom: 15px
    }
    .fr-quick-insert, #logo { display: none; }
    .inerCard{
      border:1px solid;
      box-shadow:none !important
    }
    .fa-2x{
      font-size: 1.5em
    }
    .fa-1x{
      font-size: 1.4em
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      max-width: 100%;
      max-height: 100%;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;
      cursor: inherit;
      display: block;
    }
    .btn-option{
      border: none;
      background-color: #eaeaea;

    }
    .btn-option:hover{
      background-color: rgba(200, 200, 200, 0.5);

    }
    .btn-option:hover i{
      color: #222
    }
  </style>

</head>

<body class="vh-100 bg-lightBody">

  <div class="container my-5">
    <div class="row">
      <div class="card w-100">
        <h5 class="card-header">Edit Product</h5>
        <div class="card-body">
          <?php while($row = mysqli_fetch_assoc($resultProduct)){ ?>
            <form id="edit_product" class="" action="editProduct.php?product_id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group col-12 col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-th-list"></i></div>
                        <select class="form-control" name="category">
                          <?php while($category = mysqli_fetch_assoc($resultCategory)){ ?>
                              <option value="<?php echo $category['category_id']; ?>" <?php if($category['category_id'] == $row['category_id']) echo "selected"; ?>><?php echo $category['name_en']; ?></option>
                              <?php
                            }?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                        <input type="text" id="title" name="title" placeholder="Title" class="form-control" autocomplete="off" value="<?php echo $row['title']; ?>">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                        <input type="text" id="price" name="price" placeholder="Price" class="form-control"  autocomplete="off" value="<?php echo $row['price']; ?>">
                    </div>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                        <input type="text" id="specialPrice" name="specialPrice" placeholder="Special Price" class="form-control" autocomplete="off" value="<?php echo $row['special_price']; ?>">
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-star"></i></div>
                      <select class="form-control" name="featured" >
                        <option value="0" <?php if($row['featured'] == 0 ) echo "selected"; ?> >Normal</option>
                        <option value="1" <?php if($row['featured'] == 1 ) echo "selected"; ?>>Featured</option>
                      </select>
                  </div>
              </div>
              <div class="row">
                <div class="form-group  col-12 col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-trademark"></i></div>
                        <input type="text" id="brand" name="brand" placeholder="Brand" class="form-control" autocomplete="off" value="<?php echo $row['brand']; ?>">
                    </div>
                </div>
                <div class="form-group  col-12 col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-tint"></i></div>
                        <input type="text" id="color" name="color" placeholder="Color" class="form-control" autocomplete="off" value="<?php echo $row['color']; ?>">
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-shield"></i></div>
                      <input type="text" id="warranty" name="warranty" placeholder="Warranty Period" class="form-control" autocomplete="off" value="<?php echo $row['warranty']; ?>">
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-video-camera"></i></div>
                      <input type="text" id="video" name="video" placeholder="Video URL" class="form-control" autocomplete="off" value="<?php echo $row['video_url']; ?>">
                  </div>
              </div>
              <div class="form-group">
                <div class="inerCard card border-secondary">
                  <div class="card-header bg-dark text-light">
                    <div class="row">
                      <div class="col-8">
                        Image
                      </div>
                      <div class="col-4 d-flex justify-content-end align-items-center">
                        <form id="addImage" action="editProduct.php?product_id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
                          <button id="btnAddImg" class="btn btn-dark btn-file position-relative" type="button"><i class="fa fa-plus fa-1x"></i> <input id="addImg" type="file" name="addImg" accept="image/*"></button>
                          <input class="d-none" id="btn-addImg" type="submit" name="send" value="send">
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Start image show -->
                    <?php $i=0; while($imageShow = mysqli_fetch_assoc($resultProductImage)) { ?>
                      <div class="bg-light rounded my-2 text-secondary p-2">
                        <div class="row">
                          <div class="col-6">
                            <img class="rounded" src="<?php echo $imageShow['url']; ?>" alt="" style="max-width:100px;max-height:100px;min-width:75px;min-height:75px">
                          </div>
                          <div class="col-6 d-flex justify-content-end align-items-center">
                            <button class="btn text-secondary btn-light btn-option position-relative btn-sm" type="button" name="button" data-toggle="modal" data-target="#editProductImage<?php echo $imageShow['img_id']; ?>"><i class="fa fa-edit fa-2x mx-2"></i></button>

                            <form id="innerform" class="" action="editProduct.php?product_id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
                              <button class="btn text-secondary btn-light btn-option position-relative btn-sm" type="submit" name="deleteImage"><i class="fa fa-trash fa-2x mx-3"></i></button>
                            <!-- Start Modal -->
                              <div class="modal fade" id="editProductImage<?php echo $imageShow['img_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title d-inline-block" id="exampleModalLongTitle">Change Image</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>

                                      <div class="modal-body">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                            <div class="custom-file">
                                              <input type="hidden" name="image_id" value="<?php echo $imageShow['img_id']; ?>">
                                              <input type="hidden" name="image_url" value="<?php echo $imageShow['url']; ?>">
                                              <input type="file" class="custom-file-input" name="eImage" id="edit<?php echo $i; ?>" accept="image/*" value="">
                                              <label class="custom-file-label" for="edit<?php echo $i; ?>">Choose image</label>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="changeImage">Edit</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- End Modal -->
                              </form>
                            </div>
                          </div>
                        </div>
                    <?php } ?>
                    <!-- End image show -->

                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <textarea form="edit_product" id="example" name="description" class="form-control"  placeholder="Description"><?php echo $row['description']; ?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="form-actions form-group ml-3 mr-2"><a href="productAdmin.php" class="btn btn-danger">Cancel</a></div>
                <div class="form-actions form-group"><button form="edit_product" id="btn-submit" type="submit" class="btn btn-primary" name="save" value="save">Save</button></div>
              </div>
            </form>
          <?php } ?>
      </div>
    </div>
  </div>





  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

  <!--  Chart js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

  <!--Chartist Chart-->
  <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
  <script src="assets/js/init/fullcalendar-init.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.0.1/js/froala_editor.pkgd.min.js"></script>


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

  <script>
    $(document).ready(function(e){
      $('#addImg').change(function(e){
        $('#btn-addImg').click();
      });
    });
  </script>

</body>
</html>
