<?php 
    session_start();
    require_once "connect_db.php";
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


    if (isset($_GET['madh']))
    {
        $madh = $_GET['madh'];
        $str = "SELECT * FROM ChiTietDonHang WHERE MaDH = '$madh'";
        $chitietdh = $conn->query($str);
        $str1 = "SELECT * FROM DonHang WHERE MaDH = '$madh'";
        $ttnhanhang = $conn->query($str1);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="ChiTietDH.php?madh=<?php echo $madh; ?>">Chi tiết đơn hàng</a>
        </div>
    </section>

    <main class="site-login">
        <div class="container">
        <?php 
        while ($se = mysqli_fetch_assoc($ttnhanhang))
        {
            $tongtien = $se['TongTien'];
            $ghichu = $se['GhiChu'];
        ?>
            <div class="receiving_info" style="display: flex;">
                <div class="form">
                    <p style="text-transform: none; margin-bottom: 2rem; padding: 1rem 0;">Thông tin nhận hàng</p>
                    <form method="POST" action="Lien_he_check.php">
                        <div class= "sub_container" style="display: flex;">
                            <div class="form_field">
                                <input id ="name_id" type="text" class="form__control" name="name" placeholder="Họ tên" readonly="" value="<?php echo $se['TenKH']; ?>" >
                            </div>
                            <div class="form_field">
                                <input id = "sdt_id" type="text" class="form__control" name="phone" placeholder="Số điện thoại" readonly="" value="<?php echo $se['SDT']; ?>" >
                            </div>
                        </div><br>
                        <div class="form_field">
                            <input type="text" class="form__control" name="address" placeholder="Địa chỉ" readonly="" value="<?php echo $se['DiaChi']; ?>">
                        </div><br>
                        <div class="form_field">
                        <input type="email" class="form__control" name="email" placeholder="Email" readonly="" value="<?php echo $se['Email']; ?>">
                        </div><br>
                        <div class="form_field">
                        <textarea type="text" name ="message" placeholder="Ghi chú" readonly="" style="color: #3e6807;"><?php echo $ghichu; ?></textarea>
                        </div><br>
                        <div class="form_field">
                        <input type="text" class="form__control" name="PTTT" placeholder="Phương thức thanh toán" readonly="" value="<?php echo $se['PTTT']; ?>">
                        </div><br>
                        <div class="form_field">
                        <input type="text" class="form__control" name="TrangThai" placeholder="Trạng thái" readonly="" value="<?php echo $se['TrangThai']; ?>">
                        </div>
                    </form>
                </div>
                <div class="cart_form" style="text-transform: none;">
                    <p>Chi tiết đơn hàng</p>
                    <div class="container_cart">
                        <table class="table_cart">
                            <tr class="header">
                                <td> Sản phẩm</td>
                                <td> Đơn giá</td>
                                <td> Số lượng</td>
                                <td> Thành tiền </td>
                                <!-- <td>  </td> -->
                            </tr>
                            <?php 
                            while ($row = mysqli_fetch_assoc($chitietdh))
                            {
                                $dongia = $row['DonGia'];
                                $thanhtien = $row['ThanhTien'];
                            ?>
                            <tr class="items">
                                <td> <a href="demo_detailproduct.php?id=<?php echo $row['MaSP'] ?>"><img src="images/<?php echo $row['HinhSP']; ?>"> <span style="color:#3e6807;"><?php echo $row['TenSP']; ?></span></a></td>
                                <td> <?php echo number_format($dongia, 0, ',', '.') . 'đ'; ?></td>
                                <td> <input type="number" value="<?php echo $row['SoLuong']; ?>" min="1" readonly=""></td>
                                <td> <?php echo number_format($thanhtien, 0, ',', '.') . 'đ'; ?> </td>
                                <!-- <td> <i class="fas fa-remove"></i> </td> -->
                            </tr>
                            <?php }?>
                            <!-- <tr class="items">
                                <td> <img src="images/CSD1.png"> <span>Son dưỡng gạo</span></td>
                                <td> 90.000đ</td>
                                <td> <input type="number" value="1" min="1" readonly=""></td>
                                <td> 90.000đ </td>
                                <td> <i class="fas fa-remove"></i> </td>
                            </tr> -->
                            
                        </table>
                    </div>
                    <br>
                    <table class="table_total">
                        <tr>
                            <td> Tổng giá trị đơn:  <span><?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></span></td>
                        </tr>
                        <tr>
                            <td> Phí giao hàng: <span> 0đ</span></td>
                        </tr>
                        <tr>
                            <td> Giảm giá: </td>
                        </tr>
                        <tr>
                            <td> Tổng đã thanh toán: <span style="color: orange;"><?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></span> </td>
                        </tr>
                    </table><br>
                    <div class="cancel">
                        <button><a href="LichSuMuaHang.php?idtv=<?php echo $id_thanhvien;?>">Quay lại</a></button>
                    </div>
                </div>
            </div>
        <?php }?>
        </div>
    </main>

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
    
    .site-login {
        /* background-image: url(images/nen.png); */
        margin-top: -5rem;
        background-size: 100%;
        font-size: 3rem;
        .container
        {
            
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
            .receiving_info
            {
                /* width: 75rem; */
                background-color: white;
                border: 0;
                padding: 15px 40px;
                /* box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2); */
                border-radius: 15px;
                margin-top: -10rem;
            }
            
            .form 
            {
                text-align: center;
                margin-right: 3rem;
            }
            input
            {
                border: 0;
                border: .1rem solid rgba(115, 129, 54, .2);
                font-size: 1.7rem;
                text-transform: none;
                /* width: 95%; */
                width: 100%;
                padding: 1.5rem 1rem;
                outline: none;
                text-transform: none;
                color: #3e6807;
            }
            textarea{
                /* width: 95%; */
                width: 100%;
                height: 15rem;
                font-size: 1.7rem;
                padding: 1.5rem 1rem;
                text-transform: none;
                border: .1rem solid rgba(115, 129, 54, .2);
            }
            .sub_container{
                /* margin-left: 1.5rem; */
                /* width: 95%; */
                #name_id{
                    width: 28rem;
                    margin-right: 3rem;
                }
                #sdt_id{
                    width: 28rem;
                }
            }
            p{
                font-size: 2.5rem;
                color: #3e6807;
                text-align: left;
                padding: 1rem 2rem;
            }
            
            .cart_form{
                /* margin-top: -5rem; */
                p{
                    margin-bottom: 2rem;
                    text-transform: none;
                }
            }
            .cart_form .container_cart{
                /* width: 80rem; */
                height: 27.5rem;
                overflow-y: auto;
            }
            .cart_form .table_cart{
                padding: 1rem 2rem;
                font-size: 1.7rem;
                color:#3e6807;
                border: .1rem solid rgba(115, 129, 54, .2);
                border-radius: 2rem;
                margin-left: 2rem;
                .header{
                    font-size: 1.8rem;
                    color: black;
                    td{
                        text-transform: none;
                        border-bottom: 2px solid rgba(115, 129, 54, .2);
                        padding-bottom: 1.5rem;
                    }
                }
                .items{
                    img{
                        height: 13rem;
                        width: 13rem;
                    }
                    span{
                        max-width: 20rem;
                        -webkit-box-orient: vertical;
                        display: -webkit-box;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        float: right;
                        -webkit-line-clamp: 2;
                        margin-top: 5rem;
                        margin-left: 2rem;
                    }
                    i{
                        font-size: 2rem;
                        font-weight: bold;
                    }
                    i:hover{
                        color: black;
                        transform: rotate(-90deg);
                    }
                }
                /* span{
                    -webkit-line-clamp: 2;
                } */
                td{
                    padding: 0 1.5rem;
                    input[type="number"]{
                        /* border: .1rem solid black; */
                        border-radius: 4rem;
                        width: 7rem;
                        height: 1rem;
                        background: #FFDAB9;
                    }
                }
            }
            .cart_form .table_total{
                padding: 1rem 2rem;
                font-size: 1.7rem;
                color:#3e6807;
                border: .1rem solid rgba(115, 129, 54, .2);
                border-radius: 2rem;
                margin-left: 2rem;
                tr td{
                    padding: 1rem 1.5rem;
                    span{
                        margin-left: 10rem;
                        float: right;
                        font-size: 2rem;
                        font-weight: bold;
                        color: #3e6807;
                    }
                }
            }
            .cart_form .cancel{
                button{
                    margin-left: 2rem;
                    padding: 1.6rem 4rem;
                    border-radius: 1rem;
                    background-color:#3e6807;
                    a{
                        font-size: 1.7rem;
                        color: #fff;
                    }
                }
                button:hover{
                    background: #3CB371;
                }
            }

        }
    } 
</style>