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
    $str1 = "SELECT * FROM SanPham WHERE KhuyenMai = 'Có'";
    $all_product_sale = $conn->query($str1);

    $str2 = "SELECT * FROM SanPham WHERE MaDanhMuc = 'CMTD'";
    $all_product_TD = $conn->query($str2);

    $str3 = "SELECT * FROM SanPham WHERE MaDanhMuc = 'CMCSD'";
    $all_product_CSD = $conn->query($str3);
    
    $str4 = "SELECT * FROM SanPham WHERE MaDanhMuc = 'CMCST'";
    $all_product_CST = $conn->query($str4);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
    <link rel="stylesheet" href="Trangchu.css">
</head>
<body>

<?php include "header.php"; ?>

    <section class="breadcrumb">
        <div class="first_container">
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
        </div>
    </section>

    <!-- about section starts-->
    <section class="about" id="about">
        <h1 class="heading"><span>about</span> us</h1>

        <div class="row">
            <div class="video-container">
                <video src="images/vid_mp4.mp4" loop autoplay muted  style="height: 40rem;"></video>
                <h3>best seller item</h3>
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>100% sản phẩm Cỏ Mềm có số công bố chất lượng và kiểm nghiệm theo tiêu chuẩn Bộ 
                    Y Tế trước khi lưu hành trên thị trường. Bộ dữ liệu minh bạch là nơi Cỏ Mềm trung 
                    thực công khai mọi thành phần nguyên liệu trong sản phẩm cùng với nguồn gốc, vai trò, 
                    công dụng và tỷ lệ an toàn kèm theo.</p>
                <p>Cỏ Mềm kiên định phát triển dòng sản phẩm thiên nhiên an toàn cho sức khoẻ, chất lượng 
                    hiệu quả và thân thiện với môi trường - luôn giữ vững vị thế là Thương hiệu Mỹ phẩm 
                    Thiên nhiên ĐƯỢC TIN CẬY hàng đầu Việt Nam.</p>
                <p>MINH BẠCH NGUYÊN LIỆU. Sản phẩm LÀNH - Chất lượng THẬT</p>
                <!-- <a href="#" class="btn">learn more</a> -->
            </div>
        </div>

    </section>
    <!-- about section ends -->


    <!-- icons section starts -->
    <section class="icons-container">

        <div class="icons">
            <img src="images/free_delivery.png" alt="">
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/10days_return.png" alt="">
            <div class="info">
                <h3>10 days returns</h3>
                <span>money back guarantee</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/offers_gifts.png" alt="">
            <div class="info">
                <h3>offer & gifts</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/secure_payments.png" alt="">
            <div class="info">
                <h3>secure payments</h3>
                <span>protected by paypal</span>
            </div>
        </div>
    </section>
    <!-- icon section ends -->


    <!-- products sale section starts -->
    <section class="products" id="products">
        <h1 class="heading"> sale <span>products</span> </h1>
        <div class="box-container1">
        <?php 
        while ($row = mysqli_fetch_assoc($all_product_sale))
        {
            $gia_sale = $row['Gia'] - $row['Gia']*($row['Sale']/100);
            $sale = ceil($gia_sale / 1000) * 1000;
        ?>
            <div class="box">
                <span class="discount">- <?php echo $row['Sale']; ?>%</span>
                <div class="image">
                    <img src="images/<?php echo $row['HinhAnh']; ?>" alt="">
                    <?php if($row['TinhTrang'] != "Hết hàng")
                    {?>
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="add_cart.php?id=<?= $row['MaSP']; ?>" class="cart-btn">add to cart</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                    <?php }?>
                </div>
                <div class="content">
                    <a href="demo_detailproduct.php?id=<?= $row['MaSP']; ?>"><h3 class="maxLine2"><?php echo $row['TenSP']; ?></h3></a>
                    <div class="price"><?php echo number_format($sale, 0, ',', '.') .'đ'; ?><span><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></span></div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </section> 
    <!-- products sale section ends -->
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Slick JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.box-container1').slick({
                dots: true,
                // infinite: true,
                slidesToShow: 4,
                slidesToScroll: 3,
                autoplay: true,
                autoplaySpeed: 2500,
                pauseOnHover: true,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>



    <!-- product trang diem section starts-->
    <section class="products" id="products">
        <h1 class="heading"> make up <span>products</span> </h1>
        <div class="box-container">
        <?php 
        while ($row = mysqli_fetch_assoc($all_product_TD))
        {
            $gia_sale = $row['Gia'] - $row['Gia']*($row['Sale']/100);
            $sale = ceil($gia_sale / 1000) * 1000;
        ?>
            <div class="box">
                <?php if($row['KhuyenMai'] == "Có"){
                ?>
                <span class="discount"> - <?php echo $row['Sale']; ?>%</span>
                <?php } else {?> 
                <?php }?>
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
                    <a href="demo_detailproduct.php?id=<?= $row['MaSP']; ?>"><h3 class="maxLine2"><?php echo $row['TenSP']; ?></h3></a>
                    <?php if ($row['KhuyenMai'] == "Có"){?>
                    <div class="price"><?php echo number_format($sale, 0, ',', '.') .'đ'; ?><span><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></span></div>
                    <?php } else { ?>
                    <div class="price"><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </section> 
    <!-- product trang diem section ends -->
    
    <!-- product CSD section starts-->
    <section class="products" id="products">
        <h1 class="heading"> skin <span>products</span> </h1>
        <div class="box-container">
        <?php 
        while ($row = mysqli_fetch_assoc($all_product_CSD))
        {
            $gia_sale = $row['Gia'] - $row['Gia']*($row['Sale']/100);
            $sale = ceil($gia_sale / 1000) * 1000;
        ?>
            <div class="box">
                <?php if($row['KhuyenMai'] == "Có"){
                ?>
                <span class="discount"> - <?php echo $row['Sale']; ?>%</span>
                <?php } else {?> 
                <?php }?>
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
                    <a href="demo_detailproduct.php?id=<?= $row['MaSP']; ?>"><h3 class="maxLine2"><?php echo $row['TenSP']; ?></h3></a>
                    <?php if ($row['KhuyenMai'] == "Có"){?>
                    <div class="price"><?php echo number_format($sale, 0, ',', '.') .'đ'; ?><span><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></span></div>
                    <?php } else { ?>
                    <div class="price"><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </section> 
    <!-- product CSD section ends -->

    <!-- product CST section starts-->
    <section class="products" id="products">
        <h1 class="heading"> hair <span>products</span> </h1>
        <div class="box-container">
        <?php 
        while ($row = mysqli_fetch_assoc($all_product_CST))
        {
            $gia_sale = $row['Gia'] - $row['Gia']*($row['Sale']/100);
            $sale = ceil($gia_sale / 1000) * 1000;
        ?>
            <div class="box">
                <?php if($row['KhuyenMai'] == "Có"){
                ?>
                <span class="discount"> - <?php echo $row['Sale']; ?>%</span>
                <?php } else {?> 
                <?php }?>
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
                    <a href="demo_detailproduct.php?id=<?= $row['MaSP']; ?>"><h3 class="maxLine2"><?php echo $row['TenSP']; ?></h3></a>
                    <?php if ($row['KhuyenMai'] == "Có"){?>
                    <div class="price"><?php echo number_format($sale, 0, ',', '.') .'đ'; ?><span><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></span></div>
                    <?php } else { ?>
                    <div class="price"><?php echo number_format($row['Gia'], 0, ',', '.') .'đ'; ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </section> 
    <!-- product CST section ends -->

    <?php include "footer.php"; ?>
</body>
</html>
