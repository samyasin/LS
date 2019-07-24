<?php 
include 'includes/config.php';
global $con;


if(isset($_POST['remove'])){
    $subscribe_id = $_POST['subscribe_id'];
    $sqlDel       = "DELETE FROM subscribe WHERE subscribe_id='$subscribe_id'";
    $resDel       = mysqli_query($con, $sqlDel);
    header("Location: subscribers.php");
}

?>
<?php include 'includes/header.php';  ?>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Subscribers</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Option</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM subscribe";
                                        $res = mysqli_query($con, $sql);
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($res)){ ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['subscribe_email']; ?></td>
                                                <td>
                                                    <form action="subscribers.php" method="post">
                                                        <input type="hidden" name="subscribe_id" value="<?php echo $row['subscribe_id']; ?>">
                                                        <input class="btn btn-danger btn-sm" type="submit" name="remove" value="Remove">
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
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>