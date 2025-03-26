<?php
    session_start();
    // error_reporting(0);
    include "connect_db.php";
    if (isset($_POST['masp'])) {
        if (isset($_SESSION['User'])) {
            $username = $_SESSION['User'];
    
            // Truy vấn ID thành viên từ username
            $query = "SELECT id FROM thanhvien WHERE TenTaiKhoan = '$username'";
            $result = $conn->query($query);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id_thanhvien = $row['id'];
            }
        $pr_id = $_POST['masp']; //Lấy ID sản phẩm
        // $soluong = $_POST['soluong'];
        $soluong = $_POST['soluong'];
        $se_product = mysqli_query($conn, "select * from SanPham where MaSP = $pr_id"); //Lấy thông tin sản phẩm từ CSDL
    
        $add = mysqli_fetch_array($se_product);
        $name = $add['TenSP'];
        if ($add['KhuyenMai' == 'Có'])
        {
            $price = ceil(($add['Gia'] - $add['Gia']*($add['Sale']/100))/1000)*1000;
        }
        else
        {
            $price = $add['Gia'];
        }
        $image = $add['HinhAnh'];
        $thanhtien = $soluong*$price;
        $se_cart = mysqli_query($conn, "select * from GioHang where MaSP = $pr_id and id = $id_thanhvien") or die('query failed'); //Lấy thông tin từ giỏ hàng để kiểm tra
        if ($se_cart->num_rows > 0) {
            $row = $se_cart->fetch_assoc();
            $soluong_cu = $row['SoLuong'];
            $soluong_moi = $soluong_cu + $soluong;
            $thanhtien_moi = $price*$soluong_moi;
            // echo $soluong_moi;
            // echo $tamtinh_moi;
            $queryUpdate = "update GioHang set SoLuong = $soluong_moi, ThanhTien = $thanhtien_moi";
            mysqli_query($conn, $queryUpdate) or die('query failed');
            mysqli_close($conn);
            // header("Location: product_detail.php?id=".$pr_id);
            header("Location:GioHang.php");
            //Cập nhật số lượng và tạm tính
        } else {
            $queryInsert = "insert into GioHang (id, MaSP, TenSP, DonGia, SoLuong, ThanhTien, HinhAnh) values ('$id_thanhvien', '$pr_id', '$name', '$price', '$soluong', '$thanhtien', '$image')";
            mysqli_query($conn, $queryInsert) or die('query failed');
            mysqli_close($conn);
            // header("Location: product_detail.php?id=".$pr_id); 
            header("Location:GioHang.php");
            // Thêm vào CSDL
        }
    }else
    {
        header("Location: Dang_nhap.php?success=Mời bạn đăng nhập để có thể mua sản phẩm.");
    }
    }
    

    //xóa 1 sp trong giỏ hàng
    if (isset($_GET['delid']))
    {
        $masp = $_GET['delid'];
        $queryDelete = "DELETE FROM GioHang WHERE MaSP = '$masp'";
        mysqli_query($conn, $queryDelete) or die('query failed');
        mysqli_close($conn);
        header("Location: GioHang.php");
    }
?>