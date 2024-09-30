<?php
session_start();
if (isset($_SESSION['id-user'])) {
    require_once "./php/config.php";
    $idlogout = mysqli_escape_string($conn, $_GET['logoutId']);
    $sql = "UPDATE users SET status = 'Offline' WHERE id_user = '$idlogout'";
    $result = mysqli_query($conn, $sql);
    session_destroy();
    header("Location: login.php");
} else {
    header("Location: login.php");
}
