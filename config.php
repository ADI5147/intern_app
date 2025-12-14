<?php
$host = "sql107.infinityfree.com";
$username = "if0_40418363";
$password = "jLZnZbF6DZz711";
$database = "if0_40418363_interndb007";

// Create connection
$conn = mysqli_connect($host, $username , $password , $database);
if(!$conn){
    die(" connection failed;" . mysqli_connect_error());
} else {
    // echo "connected successfully";
}
?>