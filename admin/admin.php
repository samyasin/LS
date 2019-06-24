<?php
session_start();
include 'includes/config.php';
global $con;
$msg = "";
if(isset($_POST['add'])){
  $fallname = $_POST['fallname'];
  $email    = $_POST['email'];
  $password = md5($_POST['password']);

  /* Encrypt a password */
  //$password = md5($password);

  /* check if user exist */
  $sql="SELECT email FROM admin WHERE email='$email' AND fallname='$fallname'";
  $result=mysqli_query($con,$sql);

  if(mysqli_num_rows($result) > 0){
    $msg ="This admin is exist";
  }else{
    $insert = "INSERT INTO admin(fallname,email,password) VALUES
              ('$fallname','$email','$password')";
    if(mysqli_query($con,$insert)){
      getAccount($email,$password);
    }
    header('Location: admin.php');

  }
}

if(isset($_POST['remove'])){
  $id      = $_POST['id'];
  $delete  = "DELETE FROM admin WHERE id_admin='$id'";
  $resulte = mysqli_query($con,$delete);
  header('Location: admin.php');
}


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

</head>

<body>

  <?php include 'header.php'; ?>


  <!-- Content -->
  <div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">

      <!-- add admin -->

      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Add Admin</div>
                <div class="card-body card-block position-relative">
                    <form id="add_admin"action = "admin.php" method="POST" class="">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" id="fallname" name="fallname" placeholder="Fall Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                <input type="password" id="Cpassword" name="Cpassword" placeholder="Confirm Password" class="form-control">
                            </div>
                        </div>
                        <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm" name="add" value="add">Submit</button></div>
                    </form>
                    <?php if($msg!=""){ ?>
                    <div class="alert alert-danger position-absolute w-50 p-2 text-center" style="right:10px;bottom:10px">
                      <?php echo $msg; ?>
                    </div>
                  <?php } ?>
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
              <strong class="card-title">Admin</strong>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-striped table-bordered">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Fall Name</th>
                    <th>Email</th>
                    <th>Option</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $retrieveData   = "SELECT * FROM admin";
                    $resultRetrieve = mysqli_query($con,$retrieveData);
                    if(mysqli_num_rows($resultRetrieve)>0){
                      $i=1;
                      while($row = mysqli_fetch_assoc($resultRetrieve)){
                        echo "<tr>
                          <td>".$i."</td>
                          <td>".$row['fallname']."</td>
                          <td>".$row['email']."</td>
                          <td>
                          <form id='option".$i."'action = 'admin.php' method='POST'>
                          <input type='hidden' name='id' value='".$row['id_admin']."'>
                            <button class='btn btn-primary' type='submit' name='edite'>Edit</button>
                            <button class='btn btn-danger' type='submit' name='remove' vlaue='remove'>Remove</button>
                          </form>
                          </td>
                        </tr>";
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


  <?php include 'footer.php'; ?>

  <script>
      $(document).ready(function() {
  /*      $( "#add_admin" ).submit(function( event ) {
          if($('#password').val() == $('#Cpassword').val()){
            return;
          } else {
            $('#Cpassword').css('border-color','red');
          }
          event.preventDefault();
        });*/
    } );
  </script>

</body>
</html>
