<?php
$hostname = "localhost";
$username = "trongvinh";
$password = "vinhtrong782002";
$dbname = "chatapp";
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Kết nối thất bại" . mysqli_connect_error());
}
// echo "Kết nối thành công";
// $messErr = "";
