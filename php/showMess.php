<?php
session_start();
require_once "./config.php";
$output = "";
if (!isset($_SESSION['id-user'])) {
    header("Location: login.html");
}
$id_recei = mysqli_real_escape_string($conn, $_POST['id_recei']);
$id_send = mysqli_real_escape_string($conn, $_POST['id_send']);
$sql = mysqli_query($conn, "SELECT * FROM message 
                            LEFT JOIN users ON message.IDReceive_mess = users.id_user
                            WHERE (IDSend_mess = '{$id_recei}' 
                            AND IDReceive_mess = '{$id_send}') 
                            OR (IDSend_mess = '{$id_send}' 
                            AND IDReceive_mess = '{$id_recei}') 
                            ORDER BY mess_id  ASC");
if (mysqli_num_rows(($sql)) == 0) {
    $output = '';
} else if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        if ($row['IDSend_mess'] == $id_send) {
            $output .= '<div class="contentMess mSend">
            <div class="detail">
                  <p >
                        ' . $row['content_mess'] . '
                    </p>
            </div>
                </div>';
        } else {
            $output .= '<div class="contentMess mReceive">
                    <img class="imgChat" src="./images/' . $row['src_img'] . '" alt="">
                  <div class="detail">
                  <p >
                        ' . $row['content_mess'] . '
                    </p>
                    </div>
                 </div>';
        }
    }
}
echo $output;
