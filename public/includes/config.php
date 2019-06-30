<?php
$servername = "localhost";
$username = "root";
$password = "0000";
$dbname = "classipost";

// Create connection
$con = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
