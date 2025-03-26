<?php 
    session_start();
    include "../Login/connect_db.php";

    if(isset($_POST['btnadd'])){
        // Lấy dữ liệu từ form
        $madm = $_POST['madm'];
        $tendm = $_POST['tendm'];

        // Check if the madm already exists
        $check_madm_query = "SELECT * FROM DanhMucSanPham WHERE MaDanhMuc = ?";
        $stmt = $conn->prepare($check_madm_query);
        $stmt->bind_param("s", $madm);
        $stmt->execute();
        $result_madm = $stmt->get_result();

        if ($result_madm->num_rows > 0) {
            header("Location: form_insert_dmsp.php?error=Đã tồn tại Mã danh mục này!");
            exit();
        }

         // Check if the tendm already exists
         $check_tendm_query = "SELECT * FROM DanhMucSanPham WHERE TenDanhMuc = ?";
         $stmt = $conn->prepare($check_tendm_query);
         $stmt->bind_param("s", $tendm);
         $stmt->execute();
         $result_tendm = $stmt->get_result();
 
         if ($result_tendm->num_rows > 0) {
             header("Location: form_insert_dmsp.php?error=Đã tồn tại Tên danh mục này!");
             exit();
         }


        // Thực hiện truy vấn insert vào bảng SanPham
        $query = "INSERT INTO DanhMucSanPham (MaDanhMuc, TenDanhMuc) 
                VALUES ('$madm', '$tendm')";
        if(mysqli_query($conn, $query)) {
            header("Location: form_insert_dmsp.php?success=Bạn đã thêm danh mục sản phẩm thành công!");
            // echo "Thêm sản phẩm thành công.";
        } else {
            echo "Thêm danh mục sản phẩm thất bại: " . mysqli_error($conn);
        }
    }

    if(isset($_POST['btnupdate'])){
        // Lấy dữ liệu từ form
        $madm = $_POST['madm'];
        $tendm = $_POST['tendm'];

        
        // Check if the tendm already exists
        $check_tendm_query = "SELECT * FROM DanhMucSanPham WHERE MaDanhMuc = ?";
        $stmt = $conn->prepare($check_tendm_query);
        $stmt->bind_param("s", $tendm);
        $stmt->execute();
        $result_tendm = $stmt->get_result();

        if ($result_tendm->num_rows > 0) {
            header("Location: form_insert_dmsp.php?error=Đã tồn tại Tên danh mục này!");
            exit();
        }



        // Thực hiện truy vấn insert vào bảng SanPham
        $query = "UPDATE DanhMucSanPham SET TenDanhMuc = '$tendm' WHERE MaDanhMuc = '$madm' ";
        if(mysqli_query($conn, $query)) {
            header("Location: form_insert_dmsp.php?success=Bạn đã cập nhật danh mục sản phẩm thành công!");
            // echo "Thêm sản phẩm thành công.";
        } else {
            echo "Cập nhật danh mục sản phẩm thất bại: " . mysqli_error($conn);
        }
    }



?>