<?php 
    session_start();
    include "../Login/connect_db.php";
    if (isset($_SESSION['Admin'])) { 
        $username = $_SESSION['Admin'];

        // Truy vấn ID thành viên từ username
        $query = "SELECT id FROM thanhvien WHERE TenTaiKhoan = '$username'";
        $select = $conn->query($query);
        if ($select->num_rows > 0) {
            $row = $select->fetch_assoc();
            $id_thanhvien = $row['id'];
        }
    }
    $str = "SELECT * FROM  ThanhVien  WHERE TenTaiKhoan != 'Admin'";
    $result = mysqli_query($conn, $str);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Admin - Trang chủ</title>
    </head>
    <body >
        <!-- header section starts -->
        <?php include "header.php";?>

        <div class="body">
            <video src="../Login/images/nen_admin5.mp4" autoplay loop muted></video>
        </div>
        <!-- header section ends -->
        </body>
</html>
<style>
     video 
     { 
        position: absolute; 
        top: 0; left: 0; 
        width: 100%; height: 100vh; 
        object-fit: cover; 
    }
</style>