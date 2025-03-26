<?php
//error_reporting(0);
 session_start();
    // if (isset($_POST['btnLogin']))
    // {
        // include "connect_db.php"; // Assuming this file contains the database connection
        $conn = new mysqli('localhost','root','','WebMyPham');
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
		$password = $conn->real_escape_string($_POST['password']);

        echo 'You are accessing the email: ' . $email . ' and password: ' . $password.'<br>';
        $str = $conn->query("SELECT TenTaiKhoan, id, MatKhau FROM ThanhVien WHERE Email = '$email'");
        if ($str->num_rows > 0)
        {
            $row = $str->fetch_array();
            echo $row['MatKhau'];
            // $user = $row['TenTaiKhoan'];
            if (password_verify($password, $row['MatKhau'])) 
            {
                // echo "You logged in successfully!";
                //mysqli_close($conn);
                $_SESSION['User'] = $row['TenTaiKhoan'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['phone'] = $row['SDT'];
                $_SESSION['address'] = $row['DiaChi'];
                // echo $_SESSION['User'];
                mysqli_close($conn);
                header("Location: Trangchu.php");
		        // exit();
            }
            else 
            {
                mysqli_close($conn);
                header("Location: Dang_nhap.php?error=Email hoặc mật khẩu không chính xác");
		        exit();
            }
        }
        else 
        {
            mysqli_close($conn);
            header("Location: Dang_nhap.php?error=Email hoặc mật khẩu không chính xác");
            exit();
        }
    // }

?>