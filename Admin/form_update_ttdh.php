<?php 
    error_reporting(0);
    session_start();
    include "../Login/connect_db.php";
    if(isset($_GET['update_madh']))
    {
        $madh = $_GET['update_madh'];
        $str = "SELECT * FROM DonHang WHERE MaDH = '$madh'";
        $result = mysqli_query($conn, $str);
        while ($row = mysqli_fetch_assoc($result))
        { 
            $madh = $row['MaDH'];
            $matv = $row['id'];
            $tenkh = $row['TenKH'];
            $SDT = $row['SDT'];
            $diachi = $row['DiaChi'];
            $email = $row['Email'];
            $ghichu = $row['GhiChu'];
            $pttt = $row['PTTT'];
            $tongtien = $row['TongTien']*1000;
            $thoigiandathang = $row['TGDatHang'];
            $trangthai = $row['TrangThai'];
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Cập nhật trạng thái đơn hàng</title>
        <style>
            body {
                background: lavenderblush;
            }
            /* CSS cho section QLSP */
            .qlsp{
                margin-top: 14rem;
                padding: 1.5rem 9%;
            }
            .qlsp .module-head{
                .header{
                    display: flex;
                    position: relative;
                    flex-wrap: nowrap;
                    justify-content: center;
                    width: 100%;
                    align-items: center;
                    b{
                        content: " ";
                        flex: 1;
                        height: 2px;
                        opacity: 0.2;
                        background-color: black;
                        display: block;
                    }
                }
            }
            .qlsp h1{
                font-size: 3rem;
                color: green;
                padding: 3rem 3rem 2rem 0;
            }

            .module-body {
                font-size: 1.7rem;
                color: #3e6807;
            }
            .module-body .container{
                display: flex;
                justify-content: space-between;
            }
            .module-body .box{
                padding: 2.5rem 0;
            }
            .module-body label{
                margin-right: 2rem;
            }
            .module-body input{
                width: 30rem;
                padding: 1.5rem 1rem;
                font-size: 1.7rem;
                color: #555;
                text-transform: none;
                
            }
            .dropdown select {
                width: 200px;
                padding: 10px;
                font-size: 1.7rem;
                border: none;
                border-radius: 5px;
                outline: none;
                /* background-color: #f1f1f1; */
                color: #555;
            }
            .dropdown select:focus {
                border: 1px solid #aaa;
            }
            /* Reset CSS */

            .module-body .module3 .submodule textarea{
                margin-top: 2rem;
                width: 400px;
                height: 100px;
                padding: 1.5rem 1rem;
                font-size: 1.7rem;
                color: #555;
                text-transform: none;
            }
            .module3.container.box-last {
                margin-top: 3rem;
            }

            /* Buttons */
            .module4.box {
                text-align: center;
            }
            .module4 button {
                padding: 1rem 3rem;
                font-size: 1.7rem;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                background-color: #007bff;
                color: #fff;
                transition: background-color 0.3s ease;
            }
            .module4 button + button {
                margin-left: 20px;
            }
            .module4 button[name="btnreturn"]{
                background-color: lightcoral;
            }
            .module4 button[name="btnclear"]{
                background-color: green;
            }
            .module4 button:hover {
                background-color: #3e6807;
            }
            .error 
            {
                font-size: 1.7rem;
                background: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 100%;
                border-radius: 5px;
                /* margin: 1rem auto; */
                margin: 2rem auto;
            }
            .success 
            {
                font-size: 1.7rem;
                background: #D4EDDA;
                color: #40754C;
                padding: 10px;
                width: 100%;
                border-radius: 5px;
                margin: 2rem auto;
                text-transform: none;
            }


        </style>
    </head>
    <body>
        <!-- header section starts -->
        <?php include "header.php";?>
        <!-- header section ends -->

        <!-- section QLSP starts -->
        <section class="qlsp">
            <div class="module-head">
                <div class="header">
                    <h1>Cập nhật trạng thái đơn hàng</h1>
                    <b class="after"></b>
                </div>
            </div>

            <form id="updateForm" action="updatedh_process.php" method="GET" enctype="multipart/form-data">
            <?php
                if (isset($_GET['error']))
                {?>
                    <p class = "error"><?php echo $_GET['error']; ?></p><?php
                }
            ?>
            <?php
                if (isset($_GET['success']))
                {?>
                    <p class = "success"><?php echo $_GET['success']; ?></p><?php
                }
            ?>
                <div class="module-body">
                    <div class="module1 container box">
                        <input type="hidden" name="masp" value="<?php echo $masp;?>" readonly>
                        <div class="submodule add_dongia">
                            <label for="">Mã đơn hàng: </label>
                            <input type="text" name="madh" value="<?php echo $madh; ?>" readonly>
                        </div>
                        <div class="submodule add_tensp">
                            <label for="">Mã thành viên: </label>
                            <input type="text" name="matv" value="<?php echo $matv; ?>" readonly>
                        </div>
                        <div class="submodule add_dongia">
                            <label for="">Họ tên thành viên: </label>
                            <input type="text" name="hoten"  value="<?php echo $tenkh; ?>" readonly>
                        </div>
                        
                        
                    </div>
                    <div class="module2 container box">
                        <div class="submodule add_dongia">
                            <label for="">Số điện thoại: </label>
                            <input type="text" name="sdt"  value="<?php echo $SDT; ?>" readonly>
                        </div>
                        <div class="submodule add_dongia">
                            <label for="">Địa chỉ: </label>
                            <input type="text" name="diachi"  value="<?php echo $diachi; ?>" readonly>
                        </div>
                        <div class="submodule add_dongia">
                            <label for="">Email khách hàng: </label>
                            <input type="text" name="email"  value="<?php echo $email; ?>" readonly>
                        </div>
                        
                        
                    </div>


                    <div class="module5 container box">
                        <div class="submodule add_khuyenmai">
                            <label for="">Phương thức TT: </label>
                            <input type="text" name="pttt" value="<?php echo $pttt; ?>" readonly>
                            <!-- <span class="dropdown">
                                <select name="pttt" >
                                    <option value="" disabled selected hidden>Phương thức thanh toán</option>
                                    <option value="COD" <?php if ($pttt == "COD") echo 'selected="selected"'; ?>>COD</option>
                                    <option value="vnpay" <?php if ($pttt == "vnpay") echo 'selected="selected"'; ?>>Vnpay</option>
                                    <option value="zalopay" <?php if ($pttt == "zalopay") echo 'selected="selected"'; ?>>Zalopay</option>
                                </select>
                            </span> -->
                        </div>
                        <div class="submodule add_sale">
                            <label for="">Tổng tiền:</label>
                            <input type="text" name="tongtien" value="<?php echo $tongtien; ?>" readonly>
                        </div>
                        <div class="submodule add_slhangtrongkho">
                            <label for="">Thời gian đặt hàng:</label>
                            <input type="text" name="thoigiandathang"  value="<?php echo $thoigiandathang; ?>" readonly>
                        </div>
                        
                    </div>

                    <div class="module3 container box-last">
                        <div class="submodule add_khuyenmai">
                            <label for="">Trạng thái đơn hàng: </label>
                            <span class="dropdown">
                                <select name="trangthai">
                                    <option value="" disabled selected hidden>Trạng thái</option>
                                    <option value="Chờ xác nhận" <?php if ($pttt == "Chờ xác nhận") echo 'selected="selected"'; ?>>Chờ xác nhận</option>
                                    <option value="Đã xác nhận" <?php if ($pttt == "Đã xác nhận") echo 'selected="selected"'; ?>>Đã xác nhận</option>
                                    <option value="Hoàn thành" <?php if ($pttt == "Hoàn thành") echo 'selected="selected"'; ?>>Hoàn thành</option>
                                </select>
                            </span>
                        </div>
                        <div class="submodule add_chitietsp">
                            <label for="">Ghi chú:</label><br>
                            <textarea type="text" name="ghichu" readonly><?php echo $ghichu; ?></textarea>
                        </div>
                    </div>

                    <div class="module4 box">
                        <button type="submit" name="btnreturn">Quay lại</button>
                        <!-- <button type="button" name="btnclear" onclick="resetForm()">Nhập lại</button> -->
                        <button type="submit" name="btnupdate">Cập nhật trạng thái đơn hàng</button>
                    </div>
                </div>
            </form>
        </section>
        <!-- section QLSP ends -->
    </body>
</html>