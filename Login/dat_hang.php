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
    
    
    function ketnoidb(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "WebMyPham";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            
        } catch(PDOException $e) {
           return $e->getMessage();
        }
        
    }

    function taodonhang($id_thanhvien, $name, $tel, $address, $email, $message, $pttt,  $tongtien, $trangthai){
        $conn=ketnoidb();
        $sql = "INSERT INTO DonHang(id,TenKH,SDT,DiaChi,Email,GhiChu,PTTT,TongTien,TrangThai) VALUES ('$id_thanhvien','$name','$tel','$address','$email','$message','$pttt', '$tongtien', '$trangthai')";
        // use exec() because no results are returned
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();    //phương thức lastInsertId() của đối tượng PDO để lấy ID của bản ghi vừa được chèn vào bảng DonHang.
        $conn = null;
        return $last_id;
    }
    function taochitietdohang($masp,$tensp,$hinhsp,$soluong,$dongia,$thanhtien,$idbill){
        $conn=ketnoidb();
        $sql = "INSERT INTO ChiTietDonHang(MaSP,TenSP,HinhSP,SoLuong,DonGia,ThanhTien,MaDH) VALUES ('$masp','$tensp','$hinhsp','$soluong' ,'$dongia','$thanhtien','$idbill')";
        // use exec() because no results are returned
        $conn->exec($sql);
        $conn = null;
    }
    // if (isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['message'], $_POST['payment_method'])) {
    if (isset($_POST['dathang']) && $_POST['dathang'])
    {
        $tong = 0;
        $select = mysqli_query($conn, "select * from GioHang where id = $id_thanhvien");   
        while($row = mysqli_fetch_assoc($select)){
            $thanhtien = $row['ThanhTien'];
            $tong = $tong + $thanhtien;
        }

        
        // $id_thanhvien;
        //lấy thông tin kh từ form để tạo đơn hàng
        $name = trim($_POST['name']);
        $tel = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);
        $pttt = trim($_POST['payment_method']);
        $trangthai = "Chờ xác nhận";
        // $tongtien = tongdonhang();
        if (!empty($name) && !empty($tel) && !empty($address) && !empty($email) && !empty($message)) {

        //insert đơn hàng - tạo đơn hàng mới
        $idbill=taodonhang($id_thanhvien, $name, $tel, $address, $email, $message, $pttt, $tong, $trangthai);


         //lấy thông tin giỏ hàng từ bảng giỏ hàng để insert vào bảng chi tiết giỏ hàng
        $select = mysqli_query($conn, "select * from GioHang where id = $id_thanhvien");                         
        while($row = mysqli_fetch_assoc($select)){
            $thanhtien = $row['ThanhTien'];
            $masp = $row['MaSP'];
            $tensp = $row['TenSP'];
            $hinhsp = $row['HinhAnh'];
            $dongia = $row['DonGia'];
            $soluong = $row['SoLuong'];
            taochitietdohang($masp,$tensp,$hinhsp,$soluong,$dongia,$thanhtien,$idbill);
            

            $queryUpdate = "UPDATE SanPham SET SoLuong = SoLuong - ?, SoLuongDaBan = SoLuongDaBan + ? WHERE MaSP = ?";
            $stmt = mysqli_prepare($conn, $queryUpdate);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iis", $soluong, $soluong, $masp);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                // Handle error in preparing statement
                error_log("Failed to prepare statement: " . mysqli_error($conn));
            }
        }


        //xóa giỏ hàng đi
        $sqldelete = "delete from GioHang where id = $id_thanhvien";
        $result = mysqli_query($conn,$sqldelete);
        
        header("Location: ChiTietDH.php?madh=".$idbill);
        }
        else{
            header("Location: GioHang.php?error=Bạn chưa nhập đủ dữ liệu");
        }
}
?>