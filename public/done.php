<?php session_start();
include 'includes/config.php';
global $con;
$sql = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
$res = mysqli_query($con, $sql);
$order_id = "";
while($row = mysqli_fetch_assoc($res)){
    $order_id = $row['order_id'];
}


if(isset($_SESSION['carts'])){
    unset($_SESSION['carts']);
}
if(isset($_SESSION['sumPrice'])){
    unset($_SESSION['sumPrice']);
}
if(isset($_SESSION['address'])){
    unset($_SESSION['address']);
}

?>
<?php include 'includes/header.php'; ?>

<section class="s-space-bottom-full bg-accent-shadow-body pt-5">
    <div class="container pt-2">
        <div class="row">
            <div class="col-12">
                <div class="gradient-wrapper item-mb">
                    <div class="gradient-title">
                        <h2>Done</h2>
                    </div>
                    <div class="gradient-padding reduce-padding text-center">
                        <div class="row">
                            <div class="col-12">
                                <i class="fa fa-check-square fa-5x" style="color:#0b9876"></i>
                            </div>
                            <div class="col-12 pt-2">
                                <p class="h5 font-weight-light">Thank you for using the website us.</p>
                            </div>
                            <div class="col-12 pt-1">
                                <p class="h6 font-weight-light">To buy your products.</p>
                            </div>
                            <div class="col-12 pt-2">
                                <p class="h5">Order ID: <?php echo $order_id ?></p>
                            </div>
                            <div class="col-12 pt-4">
                                <a class="btn btn-success" style="background-color:#0b9876" href="index.php">Home
                                    Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/single-product-layout1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:27 GMT -->

</html>