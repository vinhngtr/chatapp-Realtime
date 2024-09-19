<?php
session_start();
require_once "./config.php";
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
            <div class="personal">
                <div class="detail-infor">
                    <img src="./images/<?php echo $_SESSION['src_img'] ?>" alt="">
                    <div class="user">
                        <span class="name-user"><?php echo $_SESSION['name'] ?></span>
                        <p class="stt-user"><?php echo $_SESSION['status'] ?></p>
                    </div>
                </div>
                <button class="btn-logout">Logout</button>
            </div>
            <div class="search-user">
                <input type="search" placeholder="Search and select user to start chat!">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="listFriends">
                <?php
                $sql = "SELECT * FROM users WHERE id_user != '{$_SESSION['id-user']}'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) { ?>
                    <div class="notFriend">No user available to chat</div>
                <?php } else { ?>
                    <a href="#">
                        <div class=" personal friend">
                            <div class="detail-infor">
                                <img src="https://hiup.com.vn/wp-content/uploads/2024/02/su-that-neymar.jpg" alt="">
                                <div class="user">
                                    <span class="name-user">Neymar</span>
                                    <p class="mess-user">No finding message</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle stt-user"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class=" personal friend">
                            <div class="detail-infor">
                                <img src="https://hiup.com.vn/wp-content/uploads/2024/02/su-that-neymar.jpg" alt="">
                                <div class="user">
                                    <span class="name-user">Neymar</span>
                                    <p class="mess-user">No finding message</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle stt-user"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class=" personal friend">
                            <div class="detail-infor">
                                <img src="https://hiup.com.vn/wp-content/uploads/2024/02/su-that-neymar.jpg" alt="">
                                <div class="user">
                                    <span class="name-user">Neymar</span>
                                    <p class="mess-user">No finding messagesssssssss</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle stt-user"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class=" personal friend">
                            <div class="detail-infor">
                                <img src="https://hiup.com.vn/wp-content/uploads/2024/02/su-that-neymar.jpg" alt="">
                                <div class="user">
                                    <span class="name-user">Neymar</span>
                                    <p class="mess-user">No finding message</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle stt-user"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class=" personal friend">
                            <div class="detail-infor">
                                <img src="https://hiup.com.vn/wp-content/uploads/2024/02/su-that-neymar.jpg" alt="">
                                <div class="user">
                                    <span class="name-user">Neymar</span>
                                    <p class="mess-user">No finding message</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle stt-user"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class=" personal friend">
                            <div class="detail-infor">
                                <img src="https://hiup.com.vn/wp-content/uploads/2024/02/su-that-neymar.jpg" alt="">
                                <div class="user">
                                    <span class="name-user">Neymar</span>
                                    <p class="mess-user">No finding message</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle stt-user"></i>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </section>
    </div>
    <script src="./script.js"></script>
</body>

</html>