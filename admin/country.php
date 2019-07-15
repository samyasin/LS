<?php
include 'includes/config.php';
global $con;

if(isset($_POST['add_country'])){
    $country_name  = $_POST['country_name'];
    $insert        = "INSERT INTO country(country_name) VALUE ('$country_name')";
    $result_insert = mysqli_query($con, $insert);
    header("Location: country.php");
}

if(isset($_POST['add_city'])){
    $city_name     = $_POST['city_name'];
    $country_id    = $_POST['country_id'];
    $insert        = "INSERT INTO city(city_name, country_id) VALUE ('$city_name', '$country_id')";
    $result_insert = mysqli_query($con, $insert);
    header("Location: country.php");
}

if(isset($_POST['edit'])){
    $country_id   = $_POST['country_id'];
    $city_id      = $_POST['city_id'];
    $country_name = $_POST['country_name'];
    $city_name    = $_POST['city_name'];

    $updateCountry    = "UPDATE country SET country_name='$country_name' WHERE country_id='$country_id'";
    $resUpdateCountry = mysqli_query($con, $updateCountry);

    $updateCity    = "UPDATE city SET city_name='$city_name' WHERE city_id='$city_id'";
    $resUpdateCity = mysqli_query($con, $updateCity);
    header("Location: country.php");
}

if(isset($_POST['delete'])){
    $country_id = $_POST['country_id'];
    $city_id    = $_POST['city_id'];
    $value      = $_POST['delete_name'];
    if($value == "country"){
        $sqlDelete = "DELETE FROM country WHERE country_id='$country_id'";
        $resDelete = mysqli_query($con, $sqlDelete);
        
        $sqlDeleteCity = "DELETE FROM city WHERE country_id='$country_id'";
        $resDeleteCity = mysqli_query($con, $sqlDeleteCity);
    }else{
        $sqlDelete = "DELETE FROM city WHERE city_id='$city_id'";
        $resDelete = mysqli_query($con, $sqlDelete);
    }
    header("Location: country.php");

}


$select_country = "SELECT * FROM country ORDER BY country_name";
$result_country = mysqli_query($con, $select_country);

?>
<?php include 'includes/header.php'; ?>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Countries</strong>
                    </div>
                    <div class="card-body">
                        <form action="country.php" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="country_name" name="country_name" placeholder="Country Name"
                                        class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_country" value="add_country">Add
                                Country</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Cities</strong>
                    </div>
                    <div class="card-body">
                        <form action="country.php" method="post">
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <div class="input-group">
                                        <select class="form-control" name="country_id" required>
                                            <option value="" selected disabled hidden>Select Country</option>
                                            <?php if(mysqli_num_rows($result_country) > 0){
                                                while($country = mysqli_fetch_assoc($result_country)){ ?>
                                                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                                             <?php  }
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <div class="input-group">
                                        <input type="text" id="city_name" name="city_name" placeholder="City Name"
                                            class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_city" value="add_city">Add
                                City</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Countries & Cities</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * FROM country, city WHERE country.country_id = city.country_id ORDER BY country_name";
                                        $res = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($res) > 0){
                                            $i = 1;
                                            while($row = mysqli_fetch_assoc($res)){ ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['country_name']; ?></td>
                                                    <td><?php echo $row['city_name']; ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" type="button" name="btn-edit" data-toggle="modal" data-target="#modalEdit<?php echo $i; ?>">Edit</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalEdit<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title d-inline-block" id="exampleModalCenterTitle">Edit</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="country.php" method="post">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="edit_country_name<?php echo $i; ?>">Country</label>
                                                                        <div class="input-group">
                                                                            <input type="text" id="edit_country_name<?php echo $i; ?>" name="country_name" placeholder="Country Name"
                                                                                class="form-control" required autocomplete="off" value="<?php echo $row['country_name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_city_name<?php echo $i; ?>">City</label>
                                                                        <div class="input-group">
                                                                            <input type="text" id="edit_city_name<?php echo $i; ?>" name="city_name" placeholder="City Name"
                                                                                class="form-control" required autocomplete="off" value="<?php echo $row['city_name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="country_id" value="<?php echo $row['country_id'] ?>">
                                                                <input type="hidden" name="city_id" value="<?php echo $row['city_id'] ?>">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="edit" value="edit">Save changes</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <button class="btn btn-danger btn-sm mt-2 mt-md-0"  type="button" name="btn-delete" data-toggle="modal" data-target="#modalDelete<?php echo $i; ?>">Delete</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalDelete<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title d-inline-block" id="exampleModalCenterTitle">Delete</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="country.php" method="post">
                                                                <div class="modal-body">
                                                                    <h5 class="card-title">Select what you want to delete</h5>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="customRadio222<?php echo $i; ?>" name="delete_name" class="custom-control-input" value="country" required>
                                                                        <label class="custom-control-label" for="customRadio222<?php echo $i; ?>">Country: <?php echo $row['country_name']; ?></label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mt-2">
                                                                        <input type="radio" id="customRadio111<?php echo $i; ?>" name="delete_name" class="custom-control-input" value="city" required>
                                                                        <label class="custom-control-label" for="customRadio111<?php echo $i; ?>">City: <?php echo $row['city_name']; ?></label>
                                                                    </div>
                                                                    <h6 class="text-muted mt-3 pl-2">If the country is deleted, the cities for that country will be deleted.</h6>
                                                                </div>
                                                                <input type="hidden" name="country_id" value="<?php echo $row['country_id'] ?>">
                                                                <input type="hidden" name="city_id" value="<?php echo $row['city_id'] ?>">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php $i++; }
                                        }
                                     ?>
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