<?php 
    session_start();
    include "../Login/connect_db.php";
    if (isset($_GET['btnreturn'])){
        header("Location: QLSP.php");
        exit();
    }

    if(isset($_GET['btnupdate'])){
        // Lấy dữ liệu từ form
        $masp = $_GET['masp'];
        $madm = $_GET['madm'];
        $tensp = $_GET['tensp'];
        $dongia = $_GET['dongia'];
        $gia = $dongia;
        $khuyenmai = $_GET['khuyenmai'];
        $sale = $_GET['sale'];
        if ($khuyenmai == 'Có')
        {
            $sale = $_GET['sale'];
        }
        else
        {
            $sale = "";
        }
        $soluonghangtrongkho = $_GET['soluonghangtrongkho'];
        $tinhtrang = $_GET['tinhtrang'];
        $sldaban = $_GET['soluongdaban'];
        $chitietsp = $_GET['chitietsp'];
        $congdung = $_GET['congdung'];

        // Xử lý đường dẫn hình ảnh
        $hinhanh = $_GET['hinhanh']; // Đường dẫn hình ảnh mặc định
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
        $queryUpdate = "UPDATE SanPham SET MaDanhMuc = '$madm', TenSP = '$tensp', Gia = '$gia', SoLuong = '$soluonghangtrongkho', TinhTrang = '$tinhtrang', KhuyenMai = '$khuyenmai',
                        Sale = '$sale', HinhAnh = '$hinhanh', ChiTietSP = '$chitietsp', CongDung = '$congdung' WHERE MaSP = '$masp'";
        if(mysqli_query($conn, $queryUpdate)) {
            header("Location: QLSP.php?success=Bạn đã cập nhật sản phẩm thành công!");
            // echo "Thêm sản phẩm thành công.";
        } else {
            echo "Cập nhật sản phẩm thất bại: " . mysqli_error($conn);
        }
    }
?>