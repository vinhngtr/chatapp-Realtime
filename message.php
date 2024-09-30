<?php
session_start();
require_once "./php/config.php";
if (!isset($_SESSION['id-user'])) {
    header("Location: login.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Message</title>
</head>

<body>
    <div class="container forMess">
        <section class="content">
            <header class="header-user">
                <div class="material">
                    <?php
                    $id_receiver = $_GET['id'];
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '{$_GET['id']}'");
                    $row = mysqli_fetch_assoc($sql);
                    ?>
                    <a class="backPrev" href="./user.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <div class="personal">
                        <div class="detail-infor">
                            <img src="./images/<?php echo $row["src_img"] ?>" alt="">
                            <div class="per">
                                <span class="name-per"><?php echo $row['firstName'] . " " . $row['lastName'] ?></span>
                                <?php ($row['status'] == "Offline") ? $sw_off = "off" : $sw_off = "" ?>
                                <p class="stt-per <?php echo $sw_off ?>"><?php echo $row['status'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space" style="width: 1rem;"></div>
            </header>
            <div class="contentChat">
            </div>
            <footer>
                <form class="sendMess" action="#" method="post" autocomplete="off">
                    <input type="text" name="id_send" value="<?php echo $_SESSION['id-user'] ?>" hidden>
                    <input type="text" name="id_recei" value="<?php echo $id_receiver ?>" hidden>
                    <input type="text" name="mess" class="input-field" placeholder="Type a message">
                    <button class="submitMess" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </footer>
        </section>
    </div>
    <script src="./js/chatting.js"></script>
</body>

</html>