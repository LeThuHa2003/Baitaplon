<?php
session_start();
include "connect_db.php";

    if(isset($_POST['btn_Change_password'])) {
        // $email = $_POST['email'];
        $email = $_SESSION['email'];
        $code = $_SESSION['code'];
        $new_password = $_POST['new_password'];
        $re_pass = $_POST['password_confirmation'];

        // Check if password and confirmation match
        if ($new_password != $re_pass) {
            mysqli_close(($conn));
            header("Location: Change_password.php?error=Mật khẩu xác nhận không khớp!");
            exit();
        }

        // Check password strength
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $new_password)) {
            header("Location: Change_password.php?error=Mật khẩu phải dài ít nhất 8 ký tự và bao gồm ít nhất một chữ hoa, một chữ thường và một số.");
            exit();
        }

        $hash = password_hash($new_password, PASSWORD_BCRYPT);
        // $changeQuery = $conn->prepare("UPDATE ThanhVien SET MatKhau = ? WHERE Email = ? AND Code = ? AND Updated_time >= NOW() - INTERVAL 1 DAY");
        $changeQuery = $conn->query("UPDATE ThanhVien SET MatKhau = '$hash' WHERE Email = '$email' AND Code = '$code' AND Updated_time >= NOW() - INTERVAL 1 DAY");
        // $changeQuery->bind_param("sss", $hash, $email, $code);
        // $changeQuery->execute();

        if($changeQuery) {
            mysqli_close(($conn));
            header("Location: Change_password.php?success=Đổi mật khẩu thành công! Bạn có thể đăng nhập với mật khẩu mới rồi!");
            exit();
        } else {
            mysqli_close(($conn));
            header("Location: Change_password.php?error=Check your email or time change password again!");
            exit();
        }
    }
?>
