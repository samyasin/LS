<?php

include 'includes/config.php';
global $con;
$msg = "";
?>

<?php include 'includes/header.php'; ?>

<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">


        <!-- display admin -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">New Provider</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                      $retrieveData   = "SELECT * FROM new_provider";
                                      $resultRetrieve = mysqli_query($con,$retrieveData);
                                      if(mysqli_num_rows($resultRetrieve)>0){
                                        $i=1;
                                        while($row = mysqli_fetch_assoc($resultRetrieve)){
                                          ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['new_name']; ?></td>
                                        <td><?php echo $row['new_email']; ?></td>
                                        <td><?php echo $row['new_mobile']; ?></td>
                                        <td><?php echo $row['new_message']; ?></td>
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
        </div>
        <!-- / .display admin -->

    </div>
    <!-- / .Animated -->

</div>
<!-- /.content -->

<?php include 'includes/footer.php'; ?>
<script>
$(document).ready(function() {
    $("#add_admin").submit(function(event) {
        if ($('#password').val() == $('#Cpassword').val()) {
            return;
        } else {
            $('#Cpassword').css('border-color', 'red');
        }
        event.preventDefault();
    });
});
</script>
</body>

</html>