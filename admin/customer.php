<?php
include 'includes/config.php';
global $con;

$msg = "";

if(isset($_POST['add'])){
  $fname        = $_POST['fname'];
  $lname        = $_POST['lname'];
  $phone_number = $_POST['number_phone'];
  $gender       = $_POST['gender'];
  $email        = $_POST['email'];
  $password     = md5($_POST['password']);

  $sqlInsert    = "INSERT INTO users(user_email,user_password,user_fname,user_lname,user_gender,user_phone) VALUES ('$email','$password','$fname','$lname','$gender','$phone_number')";
  $res          = mysqli_query($con, $sqlInsert);
  header("Location: customer.php");
}


if(isset($_POST['remove'])){
  $user_id = $_POST['user_id'];
  $delete  = "DELETE FROM users WHERE user_id='$user_id'";
  $res     = mysqli_query($con, $delete);
  header("Location: customer.php");
}

if(isset($_POST['edit'])){
  $user_id      = $_POST['user_id'];
  $fname        = $_POST['fname'];
  $lname        = $_POST['lname'];
  $phone_number = $_POST['number_phone'];
  $gender       = $_POST['gender'];
  $email        = $_POST['email'];
  $password     = $_POST['password'];

  if($password == ""){
    $update    = "UPDATE users SET user_email='$email', user_fname='$fname', user_lname='$lname', user_gender='$gender', user_phone='$phone_number' WHERE user_id='$user_id'";
    $resUPdate = mysqli_query($con, $update);
  }else{
    $password  = md5($password);
    $update    = "UPDATE users SET user_email='$email', user_password='$password', user_fname='$fname', user_lname='$lname', user_gender='$gender', user_phone='$phone_number' WHERE user_id='$user_id'";
    $resUPdate = mysqli_query($con, $update);
  }

  header("Location: customer.php");
}


 ?>

 <?php include 'includes/header.php'; ?>

 <!-- start content -->
 <div class="content">
   <div class="animated fadeIn">
     <!-- start row -->
     <div class="row">
       <div class="col-12">
         <!-- start card -->
         <div class="card">
           <div class="card-header">
             <div class="row">
               <div class="col d-flex align-items-center">
                 <strong class="card-title m-0">Customer</strong>
               </div>
               <!-- start Search -->
               <div class="col-12 col-sm-8 order-md-1 order-2 mt-2 mt-md-0">
                 <div class="form-group mb-0">
                     <div class="input-group">
                         <div class="input-group-addon"><i class="fa fa-search"></i></div>
                         <input type="search" id="search" name="search" placeholder="Search" class="form-control" required autocomplete="off">
                     </div>
                 </div>
               </div>
               <!-- end Search -->
               <div class="col order-1 d-flex align-items-center justify-content-end">
                 <button class="btn btn-light" type="button" name="button"  data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i></button>
                 <!-- Modal -->
                 <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                   <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title d-inline-block" id="exampleModalLongTitle">Add Customer</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <form id="add_user" action="customer.php" method="post">
                         <div class="modal-body">
                           <div class="alert alert-danger" role="alert">
                             Passwords do not match
                           </div>
                           <!-- start input field -->
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                   <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" required autocomplete="off">
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                   <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" required autocomplete="off">
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                   <input type="number" id="number_phone" name="number_phone" placeholder="Phone Number" class="form-control" required autocomplete="off">
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-venus-mars"></i></div>
                                   <select class="form-control" name="gender" required>
                                     <option value="male">Male</option>
                                     <option value="female">Female</option>
                                   </select>
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                   <input type="email" id="email" name="email" placeholder="Email" class="form-control" required autocomplete="off">
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                   <input type="password" id="password" name="password" placeholder="Password" class="form-control" required autocomplete="off">
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                   <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control" required autocomplete="off">
                               </div>
                           </div>
                           <!-- end input field -->
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary" name="add" value="add">Add Customer</button>
                         </div>
                       </form>
                     </div>
                   </div>
                 </div>
                 <!-- end modal -->
               </div>
             </div>
           </div>
           <!-- end header card -->
           <div class="card-body">
             <table class="table table-striped table-bordered">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Full Name</th>
                   <th>Phone Number</th>
                   <th>Gender</th>
                   <th>Email</th>
                   <th>Option</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                    $retrieveUser = "SELECT * FROM users";
                    $resultUser   = mysqli_query($con, $retrieveUser);
                    if(mysqli_num_rows($resultUser) > 0){
                      $i = 1;
                      while($row = mysqli_fetch_assoc($resultUser)){ ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['user_fname'].' '.$row['user_lname']; ?></td>
                          <td><?php echo $row['user_phone']; ?></td>
                          <td><?php echo $row['user_gender']; ?></td>
                          <td><?php echo $row['user_email']; ?></td>
                          <td>
                            <button type="button" name="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUser<?php echo $i; ?>">Edit</button>
                            <!-- Modal -->
                            <div class="modal fade" id="editUser<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title d-inline-block" id="exampleModalLongTitle">Edit Customer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="edit_user<?php echo $i; ?>" action="customer.php" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                    <div class="modal-body">
                                      <!-- start input field -->
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                              <input type="text" id="fname<?php echo $i; ?>" name="fname" placeholder="First Name" class="form-control" required autocomplete="off" value="<?php echo $row['user_fname']; ?>">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                              <input type="text" id="lname<?php echo $i; ?>" name="lname" placeholder="Last Name" class="form-control" required autocomplete="off" value="<?php echo $row['user_lname']; ?>">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                              <input type="number" id="number_phone<?php echo $i; ?>" name="number_phone" placeholder="Phone Number" class="form-control" required autocomplete="off" value="<?php echo $row['user_phone']; ?>">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-venus-mars"></i></div>
                                              <select class="form-control" name="gender" required>
                                                <option value="male" <?php if($row['user_gender'] == "male") echo " selected"; ?> >Male</option>
                                                <option value="female" <?php if($row['user_gender'] == "female") echo " selected"; ?>>Female</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                              <input type="email" id="email<?php echo $i; ?>" name="email" placeholder="Email" class="form-control" required autocomplete="off" value="<?php echo $row['user_email']; ?>">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                              <input type="password" id="password<?php echo $i; ?>" name="password" placeholder="Password" class="form-control" autocomplete="off">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                              <input type="password" id="cpassword<?php echo $i; ?>" name="cpassword" placeholder="Confirm Password" class="form-control" autocomplete="off">
                                          </div>
                                      </div>
                                      <!-- end input field -->
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" name="edit" value="edit">Edit Save</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- end modal -->
                            <form class="d-inline-block" action="customer.php" method="post">
                              <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                              <button type="submit" name="remove" value="remove" class="btn btn-danger btn-sm mt-md-0 mt-2">Remove</button>
                            </form>
                          </td>
                        </tr>
                      <?php $i++; }
                    }
                  ?>
               </tbody>
             </table>
           </div>
         </div>
         <!-- end card -->
       </div>
     </div>
     <!-- end row -->
   </div>
 </div>
 <!-- end content -->
<?php include 'includes/footer.php'; ?>

<script>
  $(document).ready(function(){
    $('.alert').fadeOut();
    $('#add_user').submit(function(){
      if($('#password').val() != $('#cpassword').val()){
        $('.alert').fadeIn();
        $('#cpassword').css('border-color','#dc3545');
        return false;
      }
    });

    /**
     * Search Using ajax
     */
    // $('#search').keyup(function(){
    //   var search_value = $(this).val();
    //   $.ajax({
    //     type: 'post',
    //     data: {ajax: 1, search_value: search_value},
    //     cach: false,
    //     success: function(data){
    //
    //     }
    //   });
    // });

  });
</script>
</boody>
</html>
