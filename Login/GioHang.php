<?php 
    session_start();
    require_once "connect_db.php";
    //Kiểm tra nếu người dùng đã đăng nhập
    if (isset($_SESSION['User'])) { 
        $username = $_SESSION['User'];

        // Truy vấn ID thành viên từ username
        $query = "SELECT id, SDT, Email, DiaChi FROM thanhvien WHERE TenTaiKhoan = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_thanhvien = $row['id'];
            $phone = isset($row['SDT']) ? $row['SDT'] : '';
            $email = isset($row['Email']) ? $row['Email'] : '';
            $address = isset($row['DiaChi']) ? $row['DiaChi'] : '';
        } else {
            // Handle case where no matching user is found
            $phone = $email = $address = '';
        }


        if (isset($_POST['updatecart']))
        {
            $matv = $_POST['matv'];
            $masp = $_POST['masp'];
            $soluong = $_POST['soluong'];
            $dongia = $_POST['dongia'];
            $thanhtien = $soluong * $dongia;
            $queryUpdate = "update GioHang set SoLuong = $soluong,ThanhTien = $thanhtien where id = '$matv' and MaSP = '$masp'";
            mysqli_query($conn, $queryUpdate) or die('query failed');
            // mysqli_close($conn);
            header("Location: GioHang.php");
            exit();
        }

        if (isset($_POST['xoagiohang'])){
            $deleteCart = "DELETE FROM GioHang WHERE id = '$id_thanhvien'";
            mysqli_query($conn, $deleteCart) or die('query failed');
            mysqli_close($conn);
            header("Location: GioHang.php");
        }

        
        $se_cart = mysqli_query($conn, "select * from GioHang where id = '$id_thanhvien'") or die('query failed'); //Lấy thông tin từ giỏ hàng để kiểm tra
        if ($se_cart->num_rows > 0) { //nếu đã có sản phẩm trong giỏ hàng thì in ra 
    //}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
</head>
<body>

<?php include "header.php"; ?>

    <section class="breadcrumb">
        <div class="first_container">
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="GioHang.php">Giỏ hàng</a>
        </div>
    </section>

    <main class="site-login">
        <div class="container">
            <div class="receiving_info">
                <!-- <h1 class="heading">Thông tin nhận hàng</h1> -->
                <div class="form">
               
                    <p style="text-transform: none; margin-bottom: 2rem;">Thông tin nhận hàng</p>
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
                    <form method="POST" action="dat_hang.php">
                        <div class= "sub_container" style="display: flex;">
                            <div class="form_field">
                                <input id ="name_id" type="text" class="form__control" name="name" placeholder="Họ tên của bạn*" required="" autofocus="" value="<?php echo htmlspecialchars($username); ?>" >
                            </div>
                            <div class="form_field">
                                <input id = "sdt_id" type="text" class="form__control" name="phone" placeholder="Số điện thoại*" required="" autofocus="" value="<?php echo htmlspecialchars($phone); ?>" >
                            </div>
                        </div><br>
                        <div class="form_field">
                            <input type="text" class="form__control" name="address" placeholder="Địa chỉ*" required="" autofocus="" value="<?php echo htmlspecialchars($address); ?>">
                        </div><br>
                        <div class="form_field">
                        <input type="email" class="form__control" name="email" placeholder="Email của bạn*" required="" autofocus="" value="<?php echo htmlspecialchars($email); ?>">
                        </div><br>
                        <div class="form_field">
                        <textarea type="text" name ="message" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính,...)"></textarea>
                        </div><br>
                        <p style="text-transform: none;">Hình thức thanh toán</p>
                        <div class="payment-method">
                            <label class="field">
                                <input type="radio" name="payment_method" value="COD" class="payment_method_cod" checked>
                                <span class="checkmark"></span>
                                <span class="checkmark-border"></span>
                                <div class="content">
                                <div class="icon">
                                    <img src="images/COD.svg" alt="Thanh toán khi nhận hàng (COD)">
                                </div>
                                <div class="info">
                                    <span class="title"><span >Thanh toán khi nhận hàng (COD)</span></span>
                                </div>
                                </div>
                            </label>
                            <label class="field">
                                <input type="radio" name="payment_method" value="vnpay">
                                <span class="checkmark"></span>
                                <span class="checkmark-border"></span>
                                <div class="content">
                                <div class="icon">
                                    <img src="images/vnpay.png" alt="Thanh toán VNPay">
                                </div>
                                <div class="info">
                                    <span class="title">
                                        <span>Thẻ ATM (App bank)/ Thẻ tín dụng (Credit Card)</span>
                                    </span>
                                </div>
                                </div>
                            </label>
                            <label class="field">
                                <input type="radio" name="payment_method" value="zalopay">
                                <span class="checkmark"></span>
                                <span class="checkmark-border"></span>
                                <div class="content">
                                <div class="icon">
                                    <img src="images/zalo_payv2.png" alt="Thanh toán khi nhận hàng (COD)">
                                </div>
                                <div class="info">
                                    <span class="title"><span> Ví điện tử ZaloPay<br></span></span>
                                </div>
                                </div>
                            </label>
                        </div>
                        </div>
                        <?php
                            $query = "SELECT * FROM GioHang WHERE id = '$id_thanhvien'";
                            $resultquery = $conn->query($query);
                    
                            if ($resultquery->num_rows > 0) {?>
                        <div class="dathang"><input type="submit" name="dathang" value="Đồng ý đặt hàng"></div>
                        <?php } else {} ?>
                    </form>
                </div>
                <div class="cart_form" style="text-transform: none;">
                    <p>Giỏ hàng của bạn</p>
                    <?php $tong = 0; ?>
                    <div class="container_cart">
                    <!-- <form action="cart1.php" method="POST"> -->
                        <table class="table_cart">
                            <tr class="header">
                                <td> Sản phẩm</td>
                                <td> Đơn giá</td>
                                <td> Số lượng</td>
                                <td> Thành tiền </td>
                                <td>  </td>
                                <td>  </td>
                            </tr>
                            
                            <?php
                            
                            $select = mysqli_query($conn, "select * from GioHang where id = $id_thanhvien");                         
                            while($row = mysqli_fetch_assoc($select)){
                                $dongia = $row['DonGia'];
                                $_SESSION['giohang'][] = [$row['MaGioHang'], $row['id'], $row['MaSP'], $row['TenSP'], $row['DonGia'], $row['SoLuong'], $row['ThanhTien'], $row['HinhAnh']];
                                $_SESSION['masp'] = $row['MaSP'];
                            ?>
                            <form action="" method="POST">
                            <tr class="items">
                                <td><a href="demo_detailproduct.php?id=<?php echo $row['MaSP'] ?>"> <img src="images/<?php echo $row['HinhAnh'];?>"> <span style="color: #3e6807;"><?php echo $row['TenSP'];?></span> </a></td>
                                <td> <?php echo number_format($dongia, 0, ',', '.') . 'đ';?><input class="price" type="hidden" value="<?php echo $dongia;?>" name="dongia"></td>
                                <td > <input class="quantity" type="number" onchange="subToTal()" value="<?php echo $row['SoLuong'];?>" min="1" name="soluong"></td>
                                <td class="total" style="text-transform: none;"></td>
                                <td> <a href="add_cart.php?delid=<?php echo $row['MaSP']; ?>" style="color: green;"><i class="fas fa-remove"></i></a></td>
                                <td><input type="submit" value="Cập nhật" name="updatecart">
                                    <input type="hidden" name="matv" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="masp" value="<?php echo $row['MaSP']; ?>">
                                </td>
                            </tr>
                            </form>
                            <!-- <tr class="items">
                                <td> <img src="images/CSD1.png"> <span>Son dưỡng gạo</span></td>
                                <td> 90.000đ</td>
                                <td> <input type="number" value="1" min="1"></td>
                                <td> 90.000đ </td>
                                <td> <i class="fas fa-remove"></i> </td>
                            </tr> -->
                            <?php }
                                    ?>
                        </table>
                        <!-- </form> -->
                    </div>
                    <br>
                    
                    <table class="table_total">
                        <tr>
                            <td> Tổng giá trị đơn:  <span class="sum" style="text-transform: none;"></span></td>
                        </tr>
                        <tr>
                            <td> Phí giao hàng: <span>0đ</span></td>
                        </tr>
                        <tr>
                            <td> Giảm giá: </td>
                        </tr>
                        <tr>
                            <td> Tổng thanh toán: <span class="sum" style="text-transform: none; color: orange;"></span> </td>
                        </tr>
                    </table><br>
                    <?php
                    ?>
                    <!-- <form action="cart1.php" method="POST"> -->
                    <div class="container_button" style="display: flex;">
                        <form action="LichSuMuaHang.php" method="POST">
                            <div class="lichsudathang"><input type="submit" name="lichsudathang" value="Lịch sử đặt hàng"></div>
                        </form>
                        <form action="GioHang.php" method="POST">
                            <div class="xoagiohang"><input type="submit" name="xoagiohang" value="Xóa giỏ hàng"></div>
                        </form>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </main>

    
    <script type="text/javascript">
    var gt = 0;
    var price = document.getElementsByClassName('price');
    var quantity = document.getElementsByClassName('quantity');
    var total = document.getElementsByClassName('total');
    var sum = document.getElementsByClassName('sum')[0];
    var sum1 = document.getElementsByClassName('sum')[1]
    function subToTal() {
        gt = 0;
        for (var i = 0; i < price.length; i++) {
            var subtotal = parseFloat(price[i].value) * parseInt(quantity[i].value);
            total[i].innerText = subtotal.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫','') +'đ';
            gt += subtotal;
        }
        sum.innerText = gt.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫','') +'đ';
        sum1.innerText = sum.innerText;
    }
    subToTal();

</script>




    <?php include "footer.php"; ?>
</body>
</html>
<!-- nếu chưa có sản phẩm trong giỏ hàng thì thông báo Giỏ hàng rỗng -->
<?php }else{ ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://assets.comem.vn/images/favicon.png">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include "header.php"; ?>

    <section class="breadcrumb">
        <div class="first_container" >
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="demo_cart.php">Giỏ hàng</a>
        </div>
    </section>

    <main class="site-login">
        <div class="container">
            <div class="receiving_info">
                <div class="form">
                    <p style="text-transform: none; margin-bottom: 2rem;">Thông tin nhận hàng</p>
                    <form method="POST" action="dat_hang.php">
                        <div class= "sub_container" style="display: flex;">
                            <div class="form_field">
                                <input id ="name_id" type="text" class="form__control" name="name" placeholder="Họ tên của bạn*" required="" autofocus="" value="" >
                            </div>
                            <div class="form_field">
                                <input id = "sdt_id" type="text" class="form__control" name="phone" placeholder="Số điện thoại*" required="" autofocus="" value="" >
                            </div>
                        </div><br>
                        <div class="form_field">
                            <input type="text" class="form__control" name="address" placeholder="Địa chỉ*" required="" autofocus="" value="">
                        </div><br>
                        <div class="form_field">
                        <input type="email" class="form__control" name="email" placeholder="Email của bạn*" required="" autofocus="" value="">
                        </div><br>
                        <div class="form_field">
                        <textarea type="text" name ="message" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính,...)"></textarea>
                        </div><br>
                        <p style="text-transform: none;">Hình thức thanh toán</p>
                        <div class="payment-method">
                            <label class="field">
                                <input type="radio" name="payment_method" value="COD" class="payment_method_cod">
                                <span class="checkmark"></span>
                                <span class="checkmark-border"></span>
                                <div class="content">
                                <div class="icon">
                                    <img src="https://assets.comem.vn/images/checkout/shipping-box.svg" alt="Thanh toán khi nhận hàng (COD)">
                                </div>
                                <div class="info">
                                    <span class="title"><span >Thanh toán khi nhận hàng (COD)</span></span>
                                </div>
                                </div>
                            </label>
                            <label class="field">
                                <input type="radio" name="payment_method" value="vnpay">
                                <span class="checkmark"></span>
                                <span class="checkmark-border"></span>
                                <div class="content">
                                <div class="icon">
                                    <img src="https://assets.comem.vn/images/checkout/vnpay.png" alt="Thanh toán VNPay">
                                </div>
                                <div class="info">
                                    <span class="title">
                                        <span>Thẻ ATM (App bank)/ Thẻ tín dụng (Credit Card)</span>
                                    </span>
                                </div>
                                </div>
                            </label>
                            <label class="field">
                                <input type="radio" name="payment_method" value="zalopay">
                                <span class="checkmark"></span>
                                <span class="checkmark-border"></span>
                                <div class="content">
                                <div class="icon">
                                    <img src="https://assets.comem.vn/images/checkout/zalo_payv2.png" alt="Thanh toán khi nhận hàng (COD)">
                                </div>
                                <div class="info">
                                    <span class="title"><span> Ví điện tử ZaloPay<br></span></span>
                                </div>
                                </div>
                            </label>
                        </div>
                        </div>
                        <!-- <div class="dathang"><input type="submit" name="dathang" value="Đồng ý đặt hàng"></div> -->
                    </form>
                </div>
                <div class="cart_form" style="text-transform: none;">
                    <p>Giỏ hàng của bạn</p>
                    <?php $tong = 0; ?>
                    <div class="container_cart">
                        <table class="table_cart">
                            <tr class="header">
                                <td> Sản phẩm</td>
                                <td> Đơn giá</td>
                                <td> Số lượng</td>
                                <td> Thành tiền </td>
                                <td>  </td>
                            </tr>
                            <tr class="items"> <p style="font-size: 3rem; color: orange;">Giỏ hàng của bạn rỗng</p> </tr>
                        </table>
                    </div>
                    <br>
                    
                    <table class="table_total">
                        <tr>
                            <td> Tổng giá trị đơn:  <span><?php echo number_format($tong, 0, ',', '.') . 'đ';?></span></td>
                        </tr>
                        <tr>
                            <td> Phí giao hàng: <span>0đ</span></td>
                        </tr>
                        <tr>
                            <td> Giảm giá: </td>
                        </tr>
                        <tr>
                            <td> Tổng thanh toán: <span style="color: orange;"><?php echo number_format($tong, 0, ',', '.') . 'đ';?></span> </td>
                        </tr>
                    </table><br>
                    <?php
                    ?>
                    <!-- <form action="cart1.php" method="POST"> -->
                    <div class="container_button" style="display: flex;">
                        <form action="LichSuMuaHang.php" method="POST">
                            <div class="lichsudathang"><input type="submit" name="lichsudathang" value="Lịch sử đặt hàng"></div>
                        </form>
                        <form action="GioHang.php" method="POST">
                            <div class="xoagiohang"><input type="submit" name="xoagiohang" value="Xóa giỏ hàng"></div>
                        </form>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?>
</body>
</html>
<?php } ?>
<!-- người dùng chưa đăng nhập thì thông báo người dùng hãy đăng nhập để mua hàng -->
<?php }else{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://assets.comem.vn/images/favicon.png">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <?php include "header.php"; ?>
    <h1 style="color:#3CB371; font-size: 3rem; text-align: center; padding: 6rem 0; text-transform: none">Bạn hãy đăng nhập để có thể mua sản phẩm.</h1>
    <?php include "footer.php"; ?>
</body>
</html>
<?php }?>

<style>
    body{
        overflow-x: auto;
    }
    /* css section breadcrumb */
    .breadcrumb{
        margin-bottom: 2rem;
    }
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
        /* margin-top: -5rem; */
        padding: 20px;
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
                width: 75rem;
                background-color: white;
                border: 0;
                padding: 15px 40px;
                /* box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2); */
                border-radius: 15px;
            }
            h1
            {
                font-size: 3.5rem;
                color: darkgreen;
                text-align: left;
                font-weight: 350;
            }
            h1.heading 
            {
                padding: 20px;
            }
            .form 
            {
                text-align: center;
            }
            input
            {
                border: 0;
                border: .1rem solid rgba(115, 129, 54, .2);
                font-size: 1.7rem;
                text-transform: none;
                width: 95%;
                padding: 1.5rem 1rem;
                outline: none;
                text-transform: none;
                color: #3e6807;
            }
            textarea{
                width: 95%;
                height: 15rem;
                font-size: 1.7rem;
                padding: 1.5rem 1rem;
                text-transform: none;
                border: .1rem solid rgba(115, 129, 54, .2);
            }
            .sub_container{
                margin-left: 1.5rem;
                #name_id{
                    width: 30rem;
                    margin-right: 3.5rem;
                }
                #sdt_id{
                    width: 30rem;
                }
            }
            p{
                font-size: 2.5rem;
                color: #3e6807;
                text-align: left;
                padding: 1rem 2rem;
            }
            .payment-method .field{
                display: flex;
                align-items: center;
                padding: 1rem 2rem;
                /* width: 95%; */
                input[type="radio"]{
                    width: 20px;
                    height: 20px;
                    margin-right: 2rem;
                }
                .content{
                    display: flex;
                    vertical-align: middle;
                    .icon img{
                        object-fit: contain;
                        width: 50px; 
                        height: 50px;
                        margin-right: 2rem;  
                    }
                }
                .info .title span{
                    font-size: 1.7rem;
                    color: #999;
                }
            }
            .dathang{
                margin: 2rem 0 0 2rem;
                width: 100%;
                input{
                    background: orange;
                    color: #fff;
                }
                input:hover{
                    background: #3e6807;
                }
            }
            .cart_form{
                margin-top: -6rem;
                p{
                    margin-bottom: 2rem;
                    text-transform: none;
                }
            }
            .cart_form .container_cart{
                /* width: 80rem; */
                height: 40rem;
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
                    input[type="submit"]
                    {
                        font-size: 1.7rem;
                        background: white;
                        border: none;
                    }
                    input[type="submit"]:hover{
                        color: black;
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
            .cart_form .container_button{
                display: flex;
                margin-left: 2rem;
                input{
                    width: 20rem;
                    border-radius: 1rem;
                    background-color:#3e6807;
                    color: #fff;
                    cursor: pointer;
                }
                .lichsudathang{
                    margin-right: 2.3rem;
                }
                input:hover{
                    background: #3CB371;
                    color: #fff;
                }
            }
            .error 
            {
                font-size: 1.7rem;
                background: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin-top: 2rem;
                margin: -20px auto 20px auto;
            }
        }
    } 
</style>