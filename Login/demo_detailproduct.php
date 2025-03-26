<?php 
    session_start();
    require_once "connect_db.php";

    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $str = "SELECT * FROM SanPham WHERE MaSP = '$id'";
        $product = $conn->query($str);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Chi tiết sản phẩm Cỏ Mềm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <?php include "header.php"; ?>
    <!-- detail product starts -->
    <section class="detail_product">
        <?php
        while ($row = mysqli_fetch_assoc($product))
        {
            ?>
            <!-- <section class="breadcrumb"> -->
                <div class="first_container">
                    <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
                    <span style="margin: 0 1.5rem;"> / </span>
                    <a href="SanPham.php">Sản phẩm</a>
                    <span style="margin: 0 1.5rem;"> / </span>
                    <?php switch($row['MaDanhMuc']) {
                        case 'CMTD':?>
                        <a href="CMTD.php">Cỏ mềm trang điểm</a>
                        <?php break;
                        case 'CMCSD':?>
                        <a href="CMCSD.php">Cỏ mềm chăm sóc da</a>
                        <?php break;
                        case 'CMCST':?>
                        <a href="CMSDT.php">Cỏ mềm chăm sóc tóc</a>
                    <?php } ?>
                    <span style="margin: 0 1.5rem;"> / </span>
                    <a href="demo_detailproduct.php?id=<?= $row['MaSP']; ?>"><?php echo $row['TenSP']; ?></a>
                </div>
            <!-- </section> -->
        <?php
            $gia_sale = $row['Gia'] - $row['Gia']*($row['Sale']/100);
            $sale = ceil($gia_sale / 1000) * 1000;
            // $sl_hang_trong_kho = $row['SoLuong'] - $row['SoLuongDaBan'];
         ?>
        <div class="first_container" style="display: flex;">
            <img src="images/<?php echo $row['HinhAnh']; ?>" alt="Ảnh sản phẩm" style="width: 50rem; height: 55rem; box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);">
            
            <div class="content">
                <h1 class="name_product"><?php echo $row['TenSP']; ?></h1>
                <div class="vote">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php 
                if ($row['KhuyenMai'] == "Có"){
                ?>
                <h2 class="price">Giá: <?php echo number_format($sale, 0, ',', '.') .'đ'; ?> <span><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></span></h2>
                <?php } else { ?>
                    <h2 class="price">Giá: <?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></h2>
                <?php } ?>
                <p class="stock">Số lượng hàng trong kho: <?php echo $row['SoLuong']; ?> </p>
                <?php if($row['TinhTrang'] == "Còn hàng"){
                    ?>
                    <p class="status">Tình trạng: <span style="color:#3e6807;"> <?php echo $row['TinhTrang']; ?></span></p>
                    <form action="add_cart2.php" method="POST">
                    <div class="numberadd">Số lượng: <input type="number" value="1" min="1" max="<?php echo $sl_hang_trong_kho ?>" name="soluong">
                    <button type="submit" name="addcart"><i class="fas fa-shopping-cart" style="font-size: 2.3rem; color:#3e6807;"></i> Add to cart</button>
                    <input type="hidden" name="masp" value="<?php echo $row['MaSP']; ?>">
                    </form>
                </div>
                <?php } else {?>
                    <p class="status">Tình trạng: <span style="color: red;"> <?php echo $row['TinhTrang']; ?></span></p>
                    <div class="numberadd">Số lượng: <input type="number" value="0" readonly=""  style="background:#999;">
                    <button aria-readonly="" style="background:#999;"><i class="fas fa-shopping-cart" style="font-size: 2.3rem; color:#3e6807;"></i> Add to cart</button>
                    </div>
                <?php }?>
            </div>
            
            <div class="serve">
                <div class="icons">
                    <img src="images/free_delivery.png" alt="">
                    <div class="info">
                        <h3>Giao hàng miễn phí</h3>
                        <!-- <span>tất cả đơn hàng</span> -->
                    </div>
                </div>

                <div class="icons">
                    <img src="images/10days_return.png" alt="">
                    <div class="info">
                        <h3>Hoàn trả trong 10 ngày</h3>
                        <!-- <span>Đảm bảo hoàn tiền</span> -->
                    </div>
                </div>

                <div class="icons">
                    <img src="images/offers_gifts.png" alt="">
                    <div class="info">
                        <h3>Ưu đãi và quà tặng</h3>
                        <!-- <span>tất cả đơn hàng</span> -->
                    </div>
                </div>

                <div class="icons">
                    <img src="images/secure_payments.png" alt="">
                    <div class="info">
                        <h3>thanh toán an toàn</h3>
                        <!-- <span>bảo vệ bởi paypal</span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="detail">
            <h1 class="heading">Chi tiết sản phẩm</h1>
            <p><?php echo $row['ChiTietSP']; ?></p>  
        </div>
        <div class="helpful">
            <h1 class="heading">Công dụng</h1>
            <p><?php echo $row['CongDung']; ?></p>
        </div>
        <div class="realtive_product">
            <h1 class="heading" style="margin-bottom: 4rem;">Sản phẩm liên quan</h1>
            <div class="products" id="products">
                <div class="box-container">
                <?php 
                $maDM = $row['MaDanhMuc'];
                $maSP = $row['MaSP'];
                $str1 = "SELECT * FROM SanPham WHERE MaDanhMuc = '$maDM' AND MaSP != '$maSP'";
                $result1 = mysqli_query($conn,$str1);
                if (mysqli_num_rows($result1) > 0)
                {
                    foreach ($result1 as $row)
                    {
                ?>
                        <div class="box">
                            <?php if($row['KhuyenMai'] == "Có"){
                            ?>
                            <span class="discount"> - <?php echo $row['Sale']; ?>%</span>
                            <?php } else {?> 
                            <?php }?>
                            <!-- <span class="discount"></span> -->
                            <div class="image">
                                <img src="images/<?php echo $row['HinhAnh']; ?>" alt="">
                                <?php if($row['TinhTrang'] == "Hết hàng")
                                {
                                }else
                                {?>
                                <div class="icons">
                                    <a href="#" class="fas fa-heart"></a>
                                    <a href="add_cart.php?id=<?= $row['MaSP']; ?>" class="cart-btn">add to cart</a>
                                    <a href="#" class="fas fa-share"></a>
                                </div>
                                <?php }?>
                            </div>
                            <div class="content">
                                <a href="demo_detailproduct.php?id=<?= $row['MaSP']; ?>"><h3><?php echo $row['TenSP']; ?></h3></a>
                                <?php if ($row['KhuyenMai'] == "Có"){?>
                                <div class="price"><?php echo number_format($sale, 0, ',', '.') .'đ'; ?><span><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></span></div>
                                <?php } else { ?>
                                <div class="price"><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                <?php
                    }
                }    
                ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <!-- detail product ends -->
    <?php include "footer.php"; ?>
</body>
</html>

<style>
    *
    {
        margin: 0; 
        padding: 0;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        outline: none;
        border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;
    }
    html{
        font-size: 62.5%;
        scroll-behavior: smooth;
        scroll-padding-top: 6rem;
        overflow-x: hidden;
    }

    section{
        /* padding: 1.5rem 9%; */
        padding: 1.5rem 12%;
    }

    /* css section breadcrumb */
    .first_container a{
        font-size: 1.8rem;
        color: #555;
        font-weight: bold;
    }
    .first_container span{
        margin-left: 1.5rem;
        font-size: 1.8rem;
    }
    /* end css section breadcrumb */

    section .first_container{
        margin: 5rem 0;
    }
    section .first_container img{
        padding: 0 2rem;
        border-radius: 2rem;
        /* box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2); */
        /* margin-left: 6rem; */
    }
    section .first_container .content{
        /* margin: 2rem 3rem 0 3rem; */
        margin: 2rem 0 0 6rem;
        line-height: 5rem;
        text-transform: none;
        font-size: 1.7rem;
        color: #999;
        width: -webkit-fill-available;
    }
    section .first_container .content .name_product{
        font-size: 2.7rem;
        color: #3e6807;
    }
    section .first_container .content .vote{
        font-size: 1.7rem;
        color: lightsalmon;
    }
    section .first_container .content .price{
        font-size: 2.5rem;
        color: pink;
    }
    section .first_container .content .price span{
        font-size: 1.7rem;
        color: #555;
        text-decoration: line-through;
        margin-left: 2rem;
    }
    /* section .first_container .content .stock{
        text-transform: none;
    }
    section .first_container .content .status{
        text-transform: none;
    } */
    section .first_container .content .numberadd input{
        /* border: 1px solid black; */
        padding: .7rem;
        width: 7rem;
        border-radius: 2rem;
        font-size: 1.7rem;
        background-color:#FFDAB9;
        color:#3e6807;
    }
    section .first_container .content .numberadd button{
        margin-left: 2rem;
        font-size: 2rem;
        padding: 1rem 2rem;
        text-transform: none;
        border-radius: .5rem;
        background-color: #FFDAB9;
        color:#3e6807;
    }
    section .first_container .content .numberadd button:hover{
        background-color: pink;
        color: #fff;
    }

    .serve {
        margin-left: 2rem;
    }
    section .first_container .serve .icons{
        display: flex;
        padding: 3rem;
        border: .1rem solid #999;
        img
        {
            width: 12rem;
            height: 8rem;
            /* box-shadow: none; */
        }
        .info
        {
            margin: 0 0 0 2rem;
            line-height: 2.2rem;
            font-size: 1.2rem;
            span{
                color: #999;
            }
            h3{
                text-align: -webkit-left;
                width: 7rem;
            }
        }
    }
    section .detail{
        margin-top: 15rem;
        line-height: 4rem;
        border-bottom: .1rem solid #3e6807;
    }
    .heading{
        font-size: 3rem;
        color:#3e6807;
    }
    section .detail p{
        margin: 2rem 0;
        font-size: 1.7rem;
        color: #999;
        text-transform: none;
        text-align: justify;
    }
    section .helpful{
        margin: 3rem 0;
        line-height: 4rem;
        border-bottom: .1rem solid #3e6807;
    }
    section .helpful p{
        margin: 2rem 0;
        font-size: 1.7rem;
        color: #999;
        text-transform: none;
        text-align: justify;
    }

    /* css relative product */

    .products .box-container{
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .box
    {
        max-width: 35rem;
    }
    .products .box-container .box{
        align-self: flex-end;
        flex: 1 1 30rem;
        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
        border-radius: .5rem;
        border: .1rem solid rgba(0, 0, 0, .1);
        position: relative;
    }

    .products .box-container .box .discount{
        position: absolute;
        top: 1rem; left: 1rem;
        padding: .7rem 1rem;
        font-size: 2rem;
        color: var(--pink);
        background: rgba(255, 51, 153, .05);
        z-index: 1;
        border-radius: .5rem;
    }
    .products .box-container .box .image{
        position: relative;
        text-align: center;
        padding-top: 2rem;
        overflow: hidden;
    }
    .products .box-container .box .image img{
        height: 35rem;
    }
    .products .box-container .box:hover .image img{
        transform: scale(1.1);
    }
    .products .box-container .box .image .icons{
        position: absolute;
        bottom: -7rem; left: 0; right: 0;
        /* bottom: 0; left: 0; right: 0; */
        display: flex;
    }
    .products .box-container .box:hover .image .icons{
        bottom: 0; 
    }

    .products .box-container .box .image .icons a{
        height: 5rem;
        line-height: 5rem;
        font-size: 2rem;
        background-color: #FFDAB9;
        color: #fff;
    }
    .products .box-container .box .image .icons a.fas.fa-heart {
        width: 25%;
    }
    .products .box-container .box .image .icons a.fas.fa-share {
        width: 25%;
    }
    .products .box-container .box .image .icons .cart-btn{
        border-left: 1rem solid #fff7;
        border-right: 1rem solid #fff7;
        width: 100%;
    }
    .products .box-container .box .image .icons a:hover{
        background: pink;
    }
    .products .box-container .box .content{
        padding: 2rem;
        text-align: center;
    }
    .products .box-container .box .content h3{
        font-size: 1.7rem;
        color: #333;
        cursor: pointer;
        line-height: 2.5rem;
        height: 5rem;
    }
    h3.maxLine2 {
        -webkit-box-orient: vertical;
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .maxLine2 {
        -webkit-line-clamp: 2;
    }
    .products .box-container .box .content .price{
        font-size: 2rem;
        color: pink;
        font-weight: bolder;
        padding-top: 1rem;
    }
    .products .box-container .box .content .price span{
        margin-left: 2rem;
        font-size: 1.5rem;
        color: #999;
        font-weight: lighter;
        text-decoration: line-through;
    }
</style>