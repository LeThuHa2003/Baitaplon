<?php 
    session_start();
    include "../Login/connect_db.php";
    // if (isset($_POST['btnreturn'])){
    //     header("Location: QLDM.php");
    //     exit();
    // }

    // if(isset($_POST['btnclear'])){
    //     header("Location: form_insert_sp.php");
    //     exit();
    // }

    if(isset($_POST['btnadd'])){
        // Lấy dữ liệu từ form
        $madm = $_POST['madm'];
        $tensp = $_POST['tensp'];


        $dongia = $_POST['dongia'];
        $gia = $dongia;
        $khuyenmai = $_POST['khuyenmai'];
        $sale = $_POST['sale'];
        if ($khuyenmai == 'Có')
        {
            $sale = $_POST['sale'];
        }
        else
        {
            $sale = "";
        }
        $soluonghangtrongkho = $_POST['soluonghangtrongkho'];
        $sldaban = 0;
        $tinhtrang = "Còn hàng";
        $chitietsp = $_POST['chitietsp'];
        $congdung = $_POST['congdung'];

        // Xử lý đường dẫn hình ảnh
        $hinhanh = $_POST['hinhanh']; // Đường dẫn hình ảnh mặc định
        if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
            $target_dir = "../Login/images/"; // Thư mục lưu trữ hình ảnh
            $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Kiểm tra kích thước hình ảnh
            if ($_FILES["hinhanh"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Cho phép các định dạng hình ảnh cụ thể
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Upload hình ảnh
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    $hinhanh = $target_file;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Thực hiện truy vấn insert vào bảng SanPham
        $query = "INSERT INTO SanPham (MaDanhMuc, TenSP, Gia, SoLuong, TinhTrang, KhuyenMai, Sale, SoLuongDaBan, HinhAnh, ChiTietSP, CongDung) 
                VALUES ('$madm', '$tensp', '$gia', '$soluonghangtrongkho', '$tinhtrang', '$khuyenmai', '$sale', '$sldaban', '$hinhanh', '$chitietsp', '$congdung')";
        if(mysqli_query($conn, $query)) {
            header("Location: form_insert_sp.php?success=Bạn đã thêm sản phẩm thành công!");
            // echo "Thêm sản phẩm thành công.";
        } else {
            echo "Thêm sản phẩm thất bại: " . mysqli_error($conn);
        }
    }
?>