<?php
    session_start();
    include "connect_db.php";
    if (isset($_SESSION['User'])) { 
        $username = $_SESSION['User'];

        // Truy vấn ID thành viên từ username
        $query = "SELECT id FROM thanhvien WHERE TenTaiKhoan = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_thanhvien = $row['id'];
        }
    }
    unset($_SESSION['User']);
    // session_destroy();
    header('Location: Trangchu.php');
?>