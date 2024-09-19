<?php
// session_start();
require_once "./config.php";
$successMessage = '';
$messErr = "";
$display = "none";
$userid = "";
$fName = $lName = $email = $password = $image = "";
$name_img = "";
$status = "";

// ! Hàm kiểm tra tên
/**
 * Điều kiện tên hợp lệ:
 * - Tên không được chứa số
 * - Tên không được chứa 2 khoảng trắng liền kề
 * - Tên không được chứa ký tự đặc biệt (ngoại trừ chữ cái và khoảng trắng)
 */
function validate_name($value)
{
    $errors = "";
    // Kiểm tra nếu tên chứa số
    if (preg_match('/[0-9]/', $value)) {
        $errors = "Tên không được chứa số.";
    }
    // Kiểm tra nếu tên chứa 2 khoảng trắng liền kề
    else if (preg_match('/\s{2,}/', $value)) {
        $errors = "Tên không được chứa 2 khoảng trắng liền kề.";
    }
    // Kiểm tra nếu tên chứa ký tự đặc biệt (ngoại trừ chữ cái và khoảng trắng)
    else if (preg_match('/[^a-zA-ZÀ-Ýà-ỹ\s]/u', $value)) {
        $errors = "Tên không được chứa ký tự đặc biệt.";
    }

    return $errors;
}
//! Hàm kiểm tra email
/**
 * Điều kiện email hợp lệ:
 * - Email phải có định dạng hợp lệ
 * - Email không được quá 254 ký tự(theo chuẩn RFC 5321)
 */
function validate_email($value)
{
    $errors = "";
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors = "Email không hợp lệ.";
    }
    if (strlen($value) > 254) {
        $errors = "Email không được quá 254 ký tự.";
    }
    return $errors;
}
//! Hàm kiểm tra mật khẩu
/**
 * Điều kiện mật khẩu hợp lệ:
 * - Mật khẩu phải có ít nhất 6 ký tự
 * - Mật khẩu phải có ít nhất một chữ cái in hoa
 * - Mật khẩu phải có ít nhất một chữ số
 * - Mật khẩu phải có ít nhất một ký tự đặc biệt
 */
function validate_password($value)
{
    $errors = "";

    // Kiểm tra độ dài ít nhất 6 ký tự
    if (strlen($value) < 6) {
        $errors = "Mật khẩu phải có ít nhất 6 ký tự.";
    }

    // Kiểm tra xem mật khẩu có ít nhất một chữ cái in hoa
    if (!preg_match('/[A-Z]/', $value)) {
        $errors = "Mật khẩu phải có ít nhất một chữ cái in hoa.";
    }

    // Kiểm tra xem mật khẩu có ít nhất một chữ số
    if (!preg_match('/[0-9]/', $value)) {
        $errors = "Mật khẩu phải có ít nhất một chữ số.";
    }

    // Kiểm tra xem mật khẩu có ít nhất một ký tự đặc biệt
    if (!preg_match('/[\W]/', $value)) {
        $errors = "Mật khẩu phải có ít nhất một ký tự đặc biệt.";
    }

    return $errors;
}

//! Xử lý khi form được submit
if (isset($_POST['submit'])) {
    // $messErr = "Submit 0 công";
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $messErr = validate_name($fName);
    if (empty($messErr)) {
        $messErr = validate_name($lName);
    }
    if (empty($messErr)) {
        $messErr = validate_email($email);
    }
    if (empty($messErr)) {
        $messErr = validate_password($password);
    }

    //!--------- Xử lý file -------------------
    if (isset($_FILES['image'])) {
        $imageName = $_FILES['image']['name'];  //tên file
        $typeFile = $_FILES['image']['type'];   //kiểu file
        $pathfile = $_FILES['image']['tmp_name'];   //đường dẫn lưu trữ file tạm

        // xử lí file nếu upload thành công
        $filenameCmp = explode(".", $imageName);
        $exten_file = end($filenameCmp);
        $extension = ["jpg", "jpeg", "png", "gif"];
        if (in_array($exten_file, $extension) === false) {
            $messErr = "Chỉ được upload file có định dạng: jpg, jpeg, png, gif";
        } else {
            $time = time();
            $name_img = $imageName;
            if (move_uploaded_file($pathfile, "images/" . $name_img)) {
                $status = "Online now";
            }
        }
    } else {
        $messErr = "Vui lòng chọn file ảnh";
    }

    if (!empty($messErr)) {
        // $messErr = "Submit khong thanh công";
        $display = "block";
    } else {
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
        if (mysqli_num_rows($sql) > 0) {
            $successMessage = "Email đã tồn tại!";
        } else {
            $userid = rand(time(), 100000);
            $sql = "INSERT INTO users (id_user, firstName, lastName, email, password, src_img, status) VALUES ('$userid','$fName', '$lName', '$email', '$password', '$name_img', '$status')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // echo "<script>alert('Đăng kí tài khoản thành công!');</script>";
                $successMessage = "Đăng kí tài khoản thành công!";
                header("Location: login.php");
            } else {
                $successMessage = "Hệ thống gặp lỗi!";
            }
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
    <title>Realtime Chatapp</title>
</head>

<body>
    <div class="container">
        <section class="content">
            <h2 class="header">Realtime chatting</h2>
            <form class="detailInfor" action="#" method="post" enctype="multipart/form-data">
                <div class="text-err" style="display: <?php echo $display; ?>"><?php echo $messErr; ?>
                </div>
                <script>
                    // Hàm để hiển thị hộp thoại alert khi trang tải xong
                    <?php if ($successMessage): ?>
                        alert("<?php echo $successMessage; ?>");
                    <?php endif; ?>
                </script>
                <div class="name-detail">
                    <div class="fiel">
                        <label for="fName">FirstName</label>
                        <input name="firstName" type="text" id="fName" placeholder="Type first name" required>
                    </div>
                    <div class="fiel">
                        <label for="lName">LastName</label>
                        <input name="lastName" type="text" id="lName" placeholder="Type last name" required>
                    </div>
                </div>
                <div class="fiel">
                    <label for="email">Email</label>
                    <input name="email" type="email" id="email" placeholder="Type email">
                </div>
                <div class="fiel">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password" placeholder="Type password" required>
                    <i class="fa-solid fa-eye showpass"></i>
                </div>
                <div class="fiel">
                    <label for="upImage">Upload image avatar</label>
                    <input name="image" type="file" id="upImage" required>
                </div>
                <div class="fiel submit">
                    <input name="submit" class="onSubmit" type="submit" value="Complete">
                </div>
            </form>
            <div class="other">
                Already have an account?
                <a href="./login.php"> Login now</a>
            </div>
        </section>
    </div>

    <script src="./showPassword.js"></script>
</body>

</html>