<?php
session_start();
require_once "./config.php";
$output = "";
if (!isset($_SESSION['id-user'])) {
    header("Location: login.html");
} else {
    $id_recei = mysqli_real_escape_string($conn, $_POST['id_recei']);
    $id_send = mysqli_real_escape_string($conn, $_POST['id_send']);
    $content = mysqli_real_escape_string($conn, $_POST['mess']);
    if (!empty($content)) {
        $sql = "INSERT INTO message(IDSend_mess, IDReceive_mess, content_mess) VALUES ('$id_send','$id_recei','$content')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $output = "success";
        } else {
            $output = "fail";
        }
    }
}
echo $output;
