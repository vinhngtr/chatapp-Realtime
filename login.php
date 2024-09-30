<?php
require_once "./php/config.php";
session_start();
$display = "none";
$mess_err = "";
$email = $password = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM  users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        $mess_err = "Tài khoản không tồn tại!";
        $display = "block";
    } else if (mysqli_num_rows($result) > 0) {
        $sql2 = "UPDATE users SET status = 'Online now' WHERE email = '$email'";
        $stt = mysqli_query($conn, $sql2);
        while ($user = mysqli_fetch_assoc($result)) {
            $_SESSION['id-user'] = $user['id_user'];
            $_SESSION['name'] = $user['firstName'] . " " . $user['lastName'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['src_img'] = $user['src_img'];
            $_SESSION['status'] = $user['status'];
            header("Location: user.php");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Đăng nhập</title>
</head>

<body>
    <div class="container">
        <section class="content">
            <h2 class="header">Realtime chatting</h2>
            <form class="detailInfor" action="#" method="post">
                <div class="text-err" style="display:<?php echo $display; ?>"><?php echo $mess_err ?></div>
                <div class="fiel">
                    <label for="email">Email</label>
                    <input name="email" type="email" id="email" placeholder="Type email" required>
                </div>
                <div class="fiel">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password" placeholder="Type password" required>
                    <i class="fa-solid fa-eye showpass"></i>
                </div>
                <div class="fiel submit">
                    <input name="submit" type="submit" value="Sign In">
                </div>
            </form>
            <div class="other">
                Don't have an account yet?
                <a href="./index.php"> Sign up now</a>
            </div>
        </section>
    </div>
    <script src="./js/showPassword.js"></script>
</body>

</html>