<?php
include 'includes/header.php';
include 'includes/config.php';
global $con;

$id = $_SESSION['id'];
$sqlOreder = "";
if($_SESSION['type'] == 'admin'){
  $sqlOreder = "SELECT *, orders.city_id order_city_id, orders.country_id order_country_id, orders.address_line order_address_line FROM orders,order_details,product,users,provider WHERE order_details.order_id = orders.order_id AND order_details.product_id = product.product_id AND users.user_id = orders.user_id AND product.provider_id = provider.provider_id ORDER BY orders.order_date DESC";
}else{
  $sqlOreder = "SELECT *, orders.city_id order_city_id, orders.country_id order_country_id, orders.address_line order_address_line FROM orders,order_details,product,users,provider WHERE order_details.order_id = orders.order_id AND order_details.product_id = product.product_id AND users.user_id = orders.user_id AND product.provider_id = provider.provider_id AND product.provider_id='$id' ORDER BY orders.order_date DESC";
}

$resultOrder   = mysqli_query($con, $sqlOreder);

$sqlCustomer    = "SELECT * FROM users";
$resultCustomer = mysqli_query($con, $sqlCustomer);



if(isset($_POST['remove'])){
  $order_id = $_POST['order_id'];
  $delete   = "DELETE FROM orders WHERE order_id='$order_id'";
  $resDel   = mysqli_query($con, $delete);
  $delDet   = "DELETE FROM order_details WHERE order_id='$order_id'";
  $resDelDe = mysqli_query($con, $delDet);
  echo "<script type='text/javascript'>window.top.location='order.php';</script>"; exit;
}

if(isset($_POST['editStatus'])){
  $status    = $_POST['status'];
  $order_id  = $_POST['order_id'];
  $sqlUpdate = "UPDATE orders SET order_status='$status' WHERE order_id='$order_id'";
  $res       = mysqli_query($con, $sqlUpdate);
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
                                    <th>Order No.</th>
                                    <?php if($_SESSION['type'] == "admin") echo "<th>Provider</th>"; ?>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Grand Total</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; while($row = mysqli_fetch_assoc($resultOrder)){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <button class="btn btn-link btn-sm" data-toggle="modal"
                                            data-target="#details<?php echo $i; ?>"><?php echo $row['order_id']; ?></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="details<?php echo $i; ?>" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title d-inline-block" id="exampleModalLongTitle<?php echo $i; ?>">Order Details
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 mb-2">
                                                                <strong>Date: </strong><?php echo $row['order_date'] ?>
                                                            </div>
                                                            <div class="col-12">
                                                                <strong>Payment Method: </strong><?php echo $row['payment_method'] ?>
                                                            </div>
                                                            <div class="col-12">
                                                                <strong>Address: </strong><?php
                                                                    echo $row['order_address_line'].', ';
                                                                    $city_id = $row['order_city_id'];
                                                                    $country_id = $row['order_country_id'];
                                                                    $sqlRes = "SELECT city_name, country_name FROM city, country WHERE city.city_id='$city_id' AND country.country_id='$country_id'";
                                                                    $resSql = mysqli_query($con, $sqlRes);
                                                                    while($res = mysqli_fetch_assoc($resSql)){
                                                                        echo $res['city_name'].', '.$res['country_name'];
                                                                    }
                                                                  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <?php
                      if($_SESSION['type'] == "admin"){
                        $company_name = $row['company_name'];
                        echo "<td>$company_name</td>";
                      }?>
                                    <td><?php echo $row['user_fname'].' '.$row['user_lname']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['grand_total']; ?>$</td>
                                    <td><?php echo date('Y-m-d', strtotime($row['order_date'])); ?></td>
                                    <td>
                                        <span
                                            class="badge <?php echo $row['order_status']; ?> py-2"><?php echo $row['order_status']; ?></span>
                                        <span class="formEdit">
                                            <form class="text-right" action="order.php" method="post">
                                                <input type="hidden" name="order_id"
                                                    value="<?php echo $row['order_id']; ?>">
                                                <select class="form-control btn-sm" name="status">
                                                    <option value="approved">approved</option>
                                                    <option value="completed">completed</option>
                                                    <option value="canceled">canceled</option>
                                                </select>
                                                <input class="btn btn-sm btn-primary" style="font-size:0.7rem"
                                                    type="submit" name="editStatus" value="Update">
                                            </form>
                                        </span>
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

<script>
$(document).ready(function() {
    $('.formEdit').hide();
    $('.badge').on('click', function() {
        $(this).hide().next().show();
    });
});
</script>

</body>

</html>