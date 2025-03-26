<?php 
    session_start();
    include "../Login/connect_db.php";
    if (isset($_GET['btnreturn'])){
        header("Location: QLDH.php");
        exit();
    }

    if(isset($_GET['btnupdate'])){
        // Lấy dữ liệu từ form
        $madh = $_GET['madh'];
        $trangthai = $_GET['trangthai'];

        // Thực hiện truy vấn insert vào bảng SanPham
        $queryUpdate = "UPDATE DonHang SET TrangThai = '$trangthai' WHERE MaDH = '$madh'";
        if(mysqli_query($conn, $queryUpdate)) {
            header("Location: form_update_ttdh.php?success=Bạn đã cập nhật trạng thái đơn hàng thành công!");
            // echo "Thêm sản phẩm thành công.";
        } else {
            header("Location: form_update_ttdh.php?error=Cập nhật trạng thái đơn hàng thất bại!");
            // echo "Cập nhật trạng thái đơn hàng thất bại: " . mysqli_error($conn);
        }
    }
?>