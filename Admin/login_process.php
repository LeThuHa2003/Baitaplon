<?php
//error_reporting(0);

    session_start();
    // if (isset($_POST['btnLogin']) &&$_POST['btnLogin'])
    // {
        // include "connect_db.php"; // Assuming this file contains the database connection
        $conn = new mysqli('localhost','root','','WebMyPham');
        $adminname = "Admin";
		$password = $conn->real_escape_string($_POST['password']);
        $str = $conn->query("SELECT TenTaiKhoan, id, MatKhau FROM ThanhVien WHERE TenTaiKhoan = '$adminname'");
        if ($str->num_rows > 0)
        {
            $row = $str->fetch_array();
            echo $row['MatKhau'];
            // $user = $row['TenTaiKhoan'];
            if (password_verify($password, $row['MatKhau'])) 
            {
                // echo "You logged in successfully!";
                //mysqli_close($conn);
                $_SESSION['Admin'] = $row['TenTaiKhoan'];
                // echo $_SESSION['User'];
                mysqli_close($conn);
                header("Location: Admin_Trangchu.php");
		        // exit();
            }
            else 
            {
                mysqli_close($conn);
                header("Location: admin_login.php?error=Incorect Username or password");
		        exit();
            }
        }
        else 
        {
            mysqli_close($conn);
            header("Location: admin_login.php?error=Incorect Username or password");
            exit();
        }
    // }

?>