<?php
include 'includes/header.php';
include 'includes/config.php';
global $con;

$id = $_SESSION['id'];


if($_SESSION['type'] == 'admin'){
  $sqlOreder = "SELECT * FROM order_cus,users,product,provider WHERE order_cus.user_id=users.user_id AND order_cus.product_id=product.product_id AND order_cus.provider_id=provider.provider_id";
}else{
  $sqlOreder = "SELECT * FROM order_cus,users,product WHERE order_cus.user_id=users.user_id AND order_cus.product_id=product.product_id AND order_cus.provider_id='$id'";
}

$resultOrder   = mysqli_query($con, $sqlOreder);

$sqlCustomer    = "SELECT * FROM users";
$resultCustomer = mysqli_query($con, $sqlCustomer);



if(isset($_POST['remove'])){
  $order_id = $_POST['order_id'];
  $delete   = "DELETE FROM order_cus WHERE order_id='$order_id'";
  $resDel   = mysqli_query($con, $delete);
  echo "<script type='text/javascript'>window.top.location='order.php';</script>"; exit;
}


if(isset($_POST['edit'])){
  $order_id   = $_POST['order_id'];
  $product_id = $_POST['product'];
  $quantity   = $_POST['quantity'];
  $sqlUpdate  = "UPDATE order_cus SET quantity='$quantity', product_id='$product_id' WHERE order_id='$order_id'";
  $resUpdate  = mysqli_query($con, $sqlUpdate);
  echo "<script type='text/javascript'>window.top.location='order.php';</script>"; exit;
}


 ?>


 <div class="content">
   <div class="animated fadeIn">
     <div class="row">
       <div class="col-12">
         <div class="card">
           <div class="card-header">
             <div class="row">
               <div class="col-2 d-flex align-items-center">
                 <strong class="card-title m-0">Order</strong>
               </div>
               <!-- start Search -->
               <div class="col-sm-10 col-lg-8">
                 <div class="form-group mb-0">
                     <div class="input-group">
                         <div class="input-group-addon"><i class="fa fa-search"></i></div>
                         <input type="search" id="search" name="search" placeholder="Search" class="form-control" required autocomplete="off">
                     </div>
                 </div>
               </div>
               <!-- end Search -->
             </div>
           </div>
           <div class="card-body">
             <table class="table table-striped table-bordered">
               <thead>
                 <tr>
                   <th>#</th>
                   <?php if($_SESSION['type'] == "admin") echo "<th>Provider</th>"; ?>
                   <th>Customer</th>
                   <th>Product</th>
                   <th>Quantity</th>
                   <th>Date</th>
                   <th>State</th>
                   <th>Option</th>
                 </tr>
               </thead>
               <tbody>
                 <?php $i=1; while($row = mysqli_fetch_assoc($resultOrder)){ ?>
                   <tr>
                     <td><?php echo $i; ?></td>
                     <?php
                      if($_SESSION['type'] == "admin"){
                        $company_name = $row['company_name'];
                        echo "<td>$company_name</td>";
                      }?>
                     <td><?php echo $row['user_fname'].' '.$row['user_lname']; ?></td>
                     <td><?php echo $row['title']; ?></td>
                     <td><?php echo $row['quantity']; ?></td>
                     <td><?php echo $row['order_date']; ?></td>
                     <td>
                       <span class="badge badge-success py-2">Complete</span>
                       <span class="badge badge-danger py-2">Canceled</span>
                       <span class="badge badge-warning py-2">Waiting</span>
                     </td>
                     <td>
                       <button class="btn btn-sm btn-primary" type="button" name="button" data-toggle="modal" data-target="#edit_order<?php echo $i;?>">Edit</button>
                       <!-- Modal -->
                       <div class="modal fade" id="edit_order<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h5 class="modal-title d-inline-block" id="exampleModalLongTitle<?php echo $i;?>">Edit Order</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <form id="edit_order<?php echo $i;?>" action="order.php" method="post">
                               <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                               <div class="modal-body">
                                 <!-- start input field -->
                                 <div class="form-group">
                                   <label for="products">Products</label>
                                     <div class="input-group">
                                         <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                         <select id="products<?php echo $i;?>" class="form-control" name="product" required>
                                           <?php
                                           $provider_id   = $row['provider_id'];
                                           $sqlProduct    = "SELECT * FROM product WHERE provider_id='$provider_id'";
                                           $resultProduct = mysqli_query($con, $sqlProduct);
                                           while($user = mysqli_fetch_assoc($resultProduct)){ ?>
                                             <option value="<?php echo $user['product_id'] ?>" <?php if($user['product_id'] == $row['product_id']) echo "selected"; ?>><?php echo $user['title']; ?></option>
                                          <?php  } ?>

                                         </select>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                   <label for="products">Quantity</label>
                                     <div class="input-group">
                                         <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                         <input type="number" name="quantity" placeholder="Quantity" class="form-control" required value="<?php echo $row['quantity']; ?>">
                                     </div>
                                 </div>
                                 <!-- end input field -->
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary" name="edit" value="edit">Edit Order</button>
                               </div>
                             </form>
                           </div>
                         </div>
                       </div>
                       <!-- end modal -->

                       <form class="d-inline-block" action="order.php" method="post">
                         <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                         <button class="btn btn-sm btn-danger mt-2 mt-lg-0" type="submit" name="remove" value="remove">Remove</button>
                       </form>
                     </td>
                   </tr>
                 <?php $i++; } ?>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>

<?php include 'includes/footer.php'; ?>

</boody>
</html>
