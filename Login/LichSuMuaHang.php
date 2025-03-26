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

                            
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="SanPham.css"> -->
</head>
<body>

    <?php include "header.php"; ?>

    <section class="breadcrumb">
        <div class="first_container">
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="GioHang.php">Giỏ hàng</a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="LichSuMuaHang.php?idtv=<?php echo $id_thanhvien;?>">Lịch sử mua hàng</a>
        </div>
    </section>

    <section class="Lichsumuahang">
        <div class="container" style="overflow-x: auto;">
            <!-- <form action=""> -->
                <table class="tbl_lichsumuahang">
                    <tr class="header">
                        <td> Mã đơn hàng</td>
                        <td> Mã khách hàng</td>
                        <td> Tên khách hàng</td>
                        <td> SDT </td>
                        <td> Địa chỉ </td>
                        <td> Email </td>
                        <td> PTTT </td>
                        <td> Tổng tiền </td>
                        <td> Thời gian đặt hàng </td>
                        <td> Trạng thái</td>
                        <td> </td>
                    </tr>
                    
                    <?php 
                    if(isset($_POST['lichsudathang']) && $_POST['lichsudathang'] || isset($_GET['idtv']))
                    {
                        $select = mysqli_query($conn, "select * from DonHang where id = $id_thanhvien"); 
                        while($row = mysqli_fetch_assoc($select)){
                            $tongtien = $row['TongTien'];
                    ?>
                    <tr class="items">
                        <td> <?php echo $row['MaDH']; ?></td>
                        <td> <?php echo $row['id']; ?></td>
                        <td> <?php echo $row['TenKH']; ?></td>
                        <td> <?php echo $row['SDT']; ?></td>
                        <td> <?php echo $row['DiaChi']; ?> </td>
                        <td> <?php echo $row['Email']; ?></td>
                        <td> <?php echo $row['PTTT']; ?></td>
                        <td> <?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?> </td>
                        <td> <?php echo $row['TGDatHang']; ?> </td>
                        <td> <?php echo $row['TrangThai'];?></td>
                        <td> <a href="ChiTietDH.php?madh=<?php echo $row['MaDH'];?>" class="fas fa-arrow-right"></a></td>
                        
                    </tr>
                    <?php 
                        }
                    }
                    ?>
                </table>
            <!-- </form> -->
        </div><br>
        <div class="cancel">
            <button><a href="GioHang.php">Quay lại</a></button>
        </div>
    </section>

    <?php include "footer.php"; ?>
</body>
</html>


<style>

    /* css section breadcrumb */
    .breadcrumb .first_container a{
        font-size: 1.8rem;
        color: #555;
        font-weight: bold;
    }
    .breadcrumb .first_container span{
        margin-left: 1.5rem;
        font-size: 1.8rem;
    }
    /* end css section breadcrumb */

    .container{
        text-align: -webkit-center;
    }
    .tbl_lichsumuahang{
        /* text-align: center; */
        width: 95%;
        white-space: nowrap;
        padding: 1rem 2rem;
        font-size: 1.7rem;
        color:#3e6807;
        border: .1rem solid rgba(115, 129, 54, .2);
        border-radius: 2rem;
        margin: 0 auto;
        .header{
            text-align: center;
            font-size: 2rem;
            color: #999;
            td{
                text-transform: none;
                border-bottom: 2px solid rgba(115, 129, 54, .2);
                /* padding-bottom: 1.5rem; */
                padding: 1rem 1.5rem;
            }
        }
        .items{
            td{
                text-transform: none;
                padding: 2rem 1.5rem;
                a{
                    font-size: 3rem;
                    color: lightsalmon;
                }
                a:hover{
                    transform: scale(1.3);
                }
            }
        }
    }
    .cancel{
        text-align: center;
    }
    .cancel button{
        margin-top: 2rem;
        text-align: center;
        padding: 2rem 5rem;
        background-color: #3e6807;
        font-size: 2rem;
        border-radius: 1rem;
        a{
            color: #fff;
        }
    }
    .cancel button:hover{
        background-color: #3CB371;
    }
</style>