<?php
include 'includes/header.php';
include 'includes/config.php';
global $con;

$id = $_SESSION['id'];

$sqlOreder = "";
if($_SESSION['type'] == 'admin'){
  $sqlOreder = "SELECT * FROM orders,order_details,product,users,provider WHERE order_details.order_id = orders.order_id AND order_details.product_id = product.product_id AND users.user_id = orders.user_id AND product.provider_id = provider.provider_id ORDER BY orders.order_date DESC";
}else{
  $sqlOreder = "SELECT * FROM orders,users,product WHERE orders.user_id=users.user_id AND orders.product_id=product.product_id AND orders.provider_id='$id'";
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
                                        <input type="search" id="search" name="search" placeholder="Search"
                                            class="form-control" required autocomplete="off">
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
                                        <span class="badge <?php echo $row['order_status']; ?> py-2"><?php echo $row['order_status']; ?></span>
                                    </td>
                                    <td>
                                        <form class="d-inline-block" action="order.php" method="post">
                                            <input type="hidden" name="order_id"
                                                value="<?php echo $row['order_id']; ?>">
                                            <button class="btn btn-sm btn-danger mt-2 mt-lg-0" type="submit"
                                                name="remove" value="remove">Remove</button>
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

</body>

</html>