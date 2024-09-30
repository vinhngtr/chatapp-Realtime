<?php
session_start();
require_once "./config.php";
$id_send = $_SESSION['id-user'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE id_user != '{$_SESSION['id-user']}'");
$output = "";
if (mysqli_num_rows($sql) == 0) {
    $output =  '<div class="notFriend">No user available to chat</div>';
} else if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        $sql1 = mysqli_query($conn, "SELECT * FROM message WHERE (IDSend_mess = '{$row['id_user']}' AND IDReceive_mess = '{$id_send}') OR (IDSend_mess = '{$id_send}' AND IDReceive_mess = '{$row['id_user']}') ORDER BY mess_id DESC LIMIT 1");
        $row1 = mysqli_fetch_assoc($sql1);
        $result = "";
        if (mysqli_num_rows($sql1) > 0) {
            $result = $row1['content_mess'];
        } else {
            $result = "No message finding";
        }
        ($row['status'] == "Online now") ? $stt = "online" : $stt = "";
        $output .= '<a href="message.php?id=' . $row['id_user'] . ' ">
                            <div class=" personal friend">
                                <div class="detail-infor">
                                    <img src="./images/' . $row['src_img'] . ' " alt="">
                                    <div class="per">
                                        <span class="name-per">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                        <p class="mess-user">' . $result . '</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-circle stt-icon ' . $stt . '"></i>
                            </div>
                        </a>';
    }
}
echo $output;
