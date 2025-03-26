<?php 
    session_start();
    require_once "connect_db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Tìm kiếm sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="SanPham.css">
</head>
<body>

<?php include "header.php"; ?>

    <section class="breadcrumb">
        <div class="first_container">
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="SanPham.php">Sản phẩm</a>
        </div>
    </section>

    <section>
        <div class="container" style="display: flex;">
            <div class="sidebar">
                <div class="collections-sidebar">
                    <div class="heading">Danh mục sản phẩm </div>
                            <a href="Trangchu.php">Trang chủ</a>
                            <a href="CMsale.php">Sale</a>
                            <a href="CMTD.php">Trang điểm</a>
                            <a href="CMCSD.php"> Chăm sóc da </a>
                            <a href="CMCST.php"> Chăm sóc tóc</a>
                            <a href="Lien_he.php">Liên hệ</a>
                </div>
            </div>
            <div class="second_container" style="display: grid;">
                <form action="Timkiem.php" method="GET">
                    <div class="collections-filter" style="margin-bottom:0;">
                        <div class="collections-filter__heading">
                            <span class="icon">
                                <img src="https://assets.comem.vn/images/collections/flower.png" alt="Sản phẩm Icon"><span class="heading">Sản phẩm</span>
                            </span>
                        <!-- <h1 class="heading">Sản phẩm khuyến mãi</h1> -->
                        </div>
                    </div>
                </form>
                <div class="products" id="products">
                    <div class="box-container">
                    <?php 
                    if (isset($_GET['timkiem']))
                    {
                        $search = $_GET['search'];
                        $str = "SELECT * FROM SanPham WHERE TenSP like '%$search%' OR MaDanhMuc like '%$search%' OR Gia like '%$search%'"; 
                        $result = mysqli_query($conn,$str);
                        // $str1 = "SELECT COUNT(*) AS count FROM SanPham WHERE TenSP like '%$search%' OR MaDanhMuc like '%$search%' OR Gia like '%$search%'";
                        // $resultcount = $conn->query($str1);
                        // $row_count = $resultcount->fetch_assoc();
                        // $count = count($row_count['count'],COUNT_NORMAL);
                        if (mysqli_num_rows($result) > 0)
                        {
                            // echo 'Tìm thấy '.$count.' sản phẩm theo tiêu chí của bạn: '.$search;
                            foreach ($result as $row)
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
                        }
                        else
                        {
                            echo '<p style ="color: green; font-size: 2.5rem; margin-top: -5rem;">Không tìm thấy sản phẩm bạn cần tìm!</p>';
                        }
                    }    
                    ?>
                    </div>
                </div>
            </div>
        </div>

    </section>

    

    <?php include "footer.php"; ?>
</body>
</html>
