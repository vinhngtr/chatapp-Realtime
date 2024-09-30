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
    <title>Trang cá nhân</title>
</head>

<body>
    <div class="container">
        <section class="content forUser">
            <?php
            require_once "./php/config.php";
            $sql = "SELECT * FROM users WHERE id_user = '{$_SESSION['id-user']}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="personal">
                <div class="detail-infor">
                    <img src="./images/<?php echo $row['src_img'] ?>" alt="">
                    <div class="per">
                        <span class="name-per"><?php echo $row['firstName'] . " " . $row['lastName'] ?></span>
                        <p class="stt-per"><?php echo $row['status'] ?></p>
                    </div>
                </div>
                <button class="btn-logout" name="logout"><a href="./logout.php?logoutId=<?php echo $row['id_user'] ?>">Log out</a></button>
            </div>
            <div class="search-user">
                <input type="search" placeholder="Search and select user to start chat!">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="listFriends">
            </div>
        </section>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>