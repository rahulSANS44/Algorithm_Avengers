<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "blog";

// Create connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
