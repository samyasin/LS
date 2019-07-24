<?php 
include 'includes/config.php';
global $con;

$now = new \DateTime('now');
$month = $now->format('m');
$year  = $now->format('Y');



if(isset($_POST['ajax']) && isset($_POST['period'])){
    switch ($_POST['period']) {
        case 1:
            $sqlChart = "SELECT provider.provider_id, COUNT(orders.order_id) as num FROM orders, provider, product, order_details WHERE orders.order_id = order_details.order_id AND product.product_id = order_details.product_id AND product.provider_id = provider.provider_id AND orders.order_status = 'completed' AND MONTH(orders.order_date) = $month AND YEAR(orders.order_date) = $year GROUP BY provider.provider_id ORDER BY COUNT(orders.order_id) DESC LIMIT 5";
            $resChart = mysqli_query($con, $sqlChart);
            $dataPoints = array();
            while($row = mysqli_fetch_assoc($resChart)){

                $y = $row['num'];
                $provider_id = $row['provider_id'];
                $sqlPro = "SELECT company_name FROM provider WHERE provider_id = '$provider_id'";
                $resPro = mysqli_query($con, $sqlPro);
                while($prov = mysqli_fetch_assoc($resPro)){
                    $label = $prov['company_name'];
                    array_push($dataPoints,array("y" => $y, "label" => "$label" ));
                } 
                
            }
            echo "<div id='chartContainer' style='height: 330px; width: 100%;'></div>
            <script>

                var chart = new CanvasJS.Chart('chartContainer', {
                    animationEnabled: true,
                    theme: 'light2',
                    title: {
                        text: 'Top Sellers'
                    },
                    axisY: {
                        title: 'Number of Products( Month ".$now->format('M').")'
                    },
                    data: [{
                        type: 'column',
                        yValueFormatString: '#,##0 Products',
                        dataPoints: ".json_encode($dataPoints, JSON_NUMERIC_CHECK)."
                    }]
                });
                chart.render();

            </script>";
            break;
        case 2:
            $sqlChart = "SELECT provider.provider_id, COUNT(orders.order_id) as num FROM orders, provider, product, order_details WHERE orders.order_id = order_details.order_id AND product.product_id = order_details.product_id AND product.provider_id = provider.provider_id AND orders.order_status = 'completed' AND YEAR(orders.order_date) = $year GROUP BY provider.provider_id ORDER BY COUNT(orders.order_id) DESC LIMIT 5";
            $resChart = mysqli_query($con, $sqlChart);
            $dataPoints = array();
            while($row = mysqli_fetch_assoc($resChart)){

                $y = $row['num'];
                $provider_id = $row['provider_id'];
                $sqlPro = "SELECT company_name FROM provider WHERE provider_id = '$provider_id'";
                $resPro = mysqli_query($con, $sqlPro);
                while($prov = mysqli_fetch_assoc($resPro)){
                    $label = $prov['company_name'];
                    array_push($dataPoints,array("y" => $y, "label" => "$label" ));
                } 
                
            }
            echo "<div id='chartContainer' style='height: 330px; width: 100%;'></div>
            <script>

                var chart = new CanvasJS.Chart('chartContainer', {
                    animationEnabled: true,
                    theme: 'light2',
                    title: {
                        text: 'Top Sellers'
                    },
                    axisY: {
                        title: 'Number of Products( Year ".$year.")'
                    },
                    data: [{
                        type: 'column',
                        yValueFormatString: '#,##0 Products',
                        dataPoints: ".json_encode($dataPoints, JSON_NUMERIC_CHECK)."
                    }]
                });
                chart.render();

            </script>";
            break;
        case 3:
            $sqlChart = "SELECT provider.provider_id, COUNT(orders.order_id) as num FROM orders, provider, product, order_details WHERE orders.order_id = order_details.order_id AND product.product_id = order_details.product_id AND product.provider_id = provider.provider_id AND orders.order_status = 'completed' GROUP BY provider.provider_id ORDER BY COUNT(orders.order_id) DESC LIMIT 5";
            $resChart = mysqli_query($con, $sqlChart);
            $dataPoints = array();
            while($row = mysqli_fetch_assoc($resChart)){

                $y = $row['num'];
                $provider_id = $row['provider_id'];
                $sqlPro = "SELECT company_name FROM provider WHERE provider_id = '$provider_id'";
                $resPro = mysqli_query($con, $sqlPro);
                while($prov = mysqli_fetch_assoc($resPro)){
                    $label = $prov['company_name'];
                    array_push($dataPoints,array("y" => $y, "label" => "$label" ));
                } 
                
            }
            echo "<div id='chartContainer' style='height: 330px; width: 100%;'></div>
            <script>

                var chart = new CanvasJS.Chart('chartContainer', {
                    animationEnabled: true,
                    theme: 'light2',
                    title: {
                        text: 'Top Sellers'
                    },
                    axisY: {
                        title: 'Number of Products( All Time)'
                    },
                    data: [{
                        type: 'column',
                        yValueFormatString: '#,##0 Products',
                        dataPoints: ".json_encode($dataPoints, JSON_NUMERIC_CHECK)."
                    }]
                });
                chart.render();

            </script>";
            break;
    }
    exit;
}

include('includes/header.php');
$global_provider_id = $_SESSION['id'];

$sqlSales = "SELECT SUM(orders.grand_total) total_sum, COUNT(orders.order_id) count_num FROM orders, order_details, product, provider WHERE orders.order_id = order_details.order_id AND order_details.product_id = product.product_id AND product.provider_id = provider.provider_id AND provider.provider_id = '$global_provider_id' AND orders.order_status='completed'";
$resSales = mysqli_query($con, $sqlSales);
while($order = mysqli_fetch_assoc($resSales)){
    $revenue = $order['total_sum'];
    $sales   = $order['count_num'];
}

$sqlOrder = "SELECT COUNT(order_id) count_num FROM orders";
$resOrder = mysqli_query($con, $sqlOrder);
while($order = mysqli_fetch_assoc($resOrder)){
    $order_num = $order['count_num'];
}

$sqlUser = "SELECT COUNT(user_id) count_num FROM users";
$resUser = mysqli_query($con, $sqlUser);
while($user = mysqli_fetch_assoc($resUser)){
    $clients = $user['count_num'];
}

$sqlProvider = "SELECT COUNT(product_id) count_num FROM product WHERE provider_id='$global_provider_id'";
$resProvider = mysqli_query($con, $sqlProvider);
while($provider = mysqli_fetch_assoc($resProvider)){
    $provider_num = $provider['count_num'];
}



$total_sum = $clients + $order_num + $sales;
$pre_order = round($order_num / $total_sum*100);
$pre_sales = round($sales / $total_sum*100);
$pre_clt   = round(($clients / $total_sum)*100);



$sqlChart = "SELECT
provider.provider_id,
COUNT(orders.order_id) as num
FROM
orders,
provider,
product,
order_details
WHERE
orders.order_id = order_details.order_id AND product.product_id = order_details.product_id AND product.provider_id = provider.provider_id AND orders.order_status = 'completed' AND MONTH(orders.order_date) = $month AND YEAR(orders.order_date) = $year
GROUP BY
provider.provider_id
ORDER BY
COUNT(orders.order_id)
DESC
LIMIT 5";

$resChart = mysqli_query($con, $sqlChart);

$dataPoints = array();
while($row = mysqli_fetch_assoc($resChart)){

    $y = $row['num'];
    $provider_id = $row['provider_id'];
    $sqlPro = "SELECT company_name FROM provider WHERE provider_id = '$provider_id'";
    $resPro = mysqli_query($con, $sqlPro);
    while($prov = mysqli_fetch_assoc($resPro)){
        $label = $prov['company_name'];
        array_push($dataPoints,array("y" => $y, "label" => "$label" ));
    } 
	
}


?>



<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">$<span class="count"><?php echo $revenue; ?></span></div>
                                    <div class="stat-heading">Revenue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $sales; ?></span></div>
                                    <div class="stat-heading">Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="fa fa-product-hunt"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $provider_num; ?></span></div>
                                    <div class="stat-heading">Products</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $clients; ?></span></div>
                                    <div class="stat-heading">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <!--  Traffic  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Traffic </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card-body">
                                <!-- <canvas id="TrafficChart"></canvas>   -->
                                <!-- <div id="traffic-chart" class="traffic-chart"></div> -->
                                <div class="form-group">
                                    <select id="period" class="custom-select col-12 col-md-6 col-lg-5 col-xl-4"
                                        name="period" style="outline:none;box-shadow:none">
                                        <option value="1" selected>Current Month</option>
                                        <option value="2">Current Year</option>
                                        <option value="3">All Time</option>
                                    </select>
                                </div>

                                <div id="drawChart">
                                    <div id="chartContainer" style="height: 330px; width: 100%;"></div>
                                    <script>
                                    window.onload = function() {

                                        var chart = new CanvasJS.Chart("chartContainer", {
                                            animationEnabled: true,
                                            theme: "light2",
                                            title: {
                                                text: "Top Sellers"
                                            },
                                            axisY: {
                                                title: "Number of Products( Month <?php echo $now->format('M'); ?>)"
                                            },
                                            data: [{
                                                type: "column",
                                                yValueFormatString: "#,##0 Products",
                                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });
                                        chart.render();

                                    }
                                    </script>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-body d-flex flex-column h-100 w-100 justify-content-between">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Customers</h4>
                                    <div class="por-txt"><?php echo $clients; ?> Users (<?php echo $pre_clt; ?>%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar"
                                            style="width: <?php echo $pre_clt; ?>%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Orders</h4>
                                    <div class="por-txt"><?php echo $order_num; ?> Order (<?php echo $pre_order; ?>%)
                                    </div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar"
                                            style="width: <?php echo $pre_order; ?>%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Sales</h4>
                                    <div class="por-txt"><?php echo $sales; ?> Sales (<?php echo $pre_sales; ?>%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-3" role="progressbar"
                                            style="width: <?php echo $pre_sales; ?>%;" aria-valuenow="60"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!--<div class="progress-box progress-2">
                                    <h4 class="por-title">Targeted Visitors</h4>
                                    <div class="por-txt">99,658 Users (90%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 90%;"
                                            aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>-->
                            </div> <!-- /.card-body -->
                        </div>
                    </div> <!-- /.row -->
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body pb-0">
                        <h4 class="box-title pb-0">Last 5 Orders</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order No.</th>
                                                <th>Customer</th>
                                                <th>Items</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sqlOrd = "SELECT * FROM orders, order_details, users WHERE orders.order_id = order_details.order_id AND orders.user_id = users.user_id ORDER BY orders.order_id DESC LIMIT 5";
                                                $resOrd = mysqli_query($con , $sqlOrd);
                                                $i = 1;
                                                while($order5 = mysqli_fetch_assoc($resOrd)){ ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $order5['order_id']; ?></td>
                                                        <td><?php echo $order5['user_fname'].' '.$order5['user_lname']; ?></td>
                                                        <td><?php echo $order5['quantity']; ?></td>
                                                        <td><?php echo $order5['grand_total']; ?> $</td>
                                                    </tr>
                                                <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div>
            </div><!-- /# column -->
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->




<?php include('includes/footer.php'); ?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--Local Stuff-->
<!--<script>
jQuery(document).ready(function($) {
    "use strict";


    if ($('#traffic-chart').length) {
        var chart = new Chartist.Line('#traffic-chart', {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                'Dec'],
            series: [
                [0, 18, 30, 25, 22, 0, 30, 15, 20, 15, 3, 20],
                [0, 30, 15, 20, 15, 3, 30, 30, 15, 20, 15, 3],
                [0, 15, 28, 15, 30, 5, 15, 15, 28, 15, 30, 5]
            ]
        }, {
            low: 0,
            showArea: true,
            showLine: false,
            showPoint: false,
            fullWidth: true,
            axisX: {
                showGrid: true
            }
        });

        chart.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 2000 * data.index,
                        dur: 2000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect
                            .height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });
    }

});
</script> -->

<script>
$(document).ready(function() {
    $('#period').on('change', function() {
        var value = $(this).val();
        $.ajax({
            type: 'post',
            url: 'index.php',
            cach: false,
            data: {
                ajax: 1,
                period: value
            },
            success: function(data) {
                $('#drawChart').html(data);
            }
        });
    });
})
</script>

</body>

</html>