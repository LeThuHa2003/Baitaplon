<?php 
    session_start();
    require_once "connect_db.php";
    $items_per_page = 9;

    //Sắp xếp theo hàm order-by
    $order_by = isset($_GET['order-by']) ? $_GET['order-by'] : "";
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    //Caculate offset: Tính thứ tự item bắt đầu
    $offset = ($page - 1) * $items_per_page;

    $str = "SELECT * FROM SanPham";
    $result = $conn->query($str);

    if (!empty($order_by))
    {
        $str .= " ORDER BY ";
        switch($order_by)
        {
            case 'title.asc':
                $str .= "TenSP ASC";
                break;
            case 'price.asc':
                $str .= "Gia ASC";
                break;
            case 'price.desc':
                $str .= "Gia DESC";
                break; 
            default:
                $str .= "TenSP DESC"; 
                break;
        }
    }

    $str .= " LIMIT $offset, $items_per_page";
    $result3 = $conn->query($str);
    //Caculate total page
    $str_count = "SELECT COUNT(*) AS count FROM SanPham";
    $resultcount = $conn->query($str_count);
    $row_count = $resultcount->fetch_assoc();
    $total_page = ceil($row_count['count'] / $items_per_page);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Sản phẩm</title>
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
                    <div class="heading">Danh mục </div>
                    <a href="Trangchu.php">Trang chủ</a>
                    <a href="CMsale.php">Sale</a>
                    <a href="CMTD.php">Trang điểm</a>
                    <a href="CMCSD.php"> Chăm sóc da </a>
                    <a href="CMCST.php"> Chăm sóc tóc</a>
                    <a href="Lien_he.php">Liên hệ</a>
                </div>
                <!-- <div class="collections-sidebar">
                <div class="heading">Danh mục</div>
                <a href="Trangchu.php">Trang chủ</a>
                <div class="dropdown">
                    <a href="#" class="dropbtn">Sản phẩm</a>
                    <div class="dropdown-content">
                        <a href="CMsale.php">Sale</a>
                        <a href="CMCSD.php">Chăm sóc da</a>
                        <a href="CMCST.php">Chăm sóc tóc</a>
                        <a href="CMTD.php">Trang điểm</a>
                    </div>
                </div>
                <a href="Lien_he.php">Liên hệ</a>
                </div> -->
            </div>
            <div class="second_container" >
                <!-- style="display: grid;" -->
                <form action="SanPham.php" method="GET">
                    <div class="collections-filter" style="margin-bottom:0;">
                        <div class="collections-filter__heading">
                            <span class="icon">
                                <img src="images/flower.png" alt="Sản phẩm Icon"><span class="heading">Sản phẩm</span>
                            </span>
                        <!-- <h1 class="heading">Sản phẩm khuyến mãi</h1> -->
                        </div>
                        <div class="collections-orderby">
                            <span>Sắp xếp theo:</span>
                            <select name="order-by" id="collection-order-by" aria-label="Sắp xếp theo" onchange="this.form.submit()">
                                <option value="display_order.asc"  <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "display_order.asc"){ echo 'selected';} ?>>-- Sắp xếp --</option>
                                <option value="price.desc" <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "price.desc"){ echo 'selected';} ?> >Giá cao đến thấp</option>
                                <option value="price.asc" <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "price.asc"){ echo 'selected';} ?> >Giá thấp đến cao</option>
                                <option value="title.asc" <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "title.asc"){ echo 'selected';} ?> >Tên sản phẩm</option>
                            </select>
                            <!-- <button type="submit" name="sort">Sắp xếp</button> -->
                        </div>
                    </div>
                </form>
                <div class="products" id="products">
                    <div class="box-container">
                    <?php 
                    if (mysqli_num_rows($result3) > 0)
                    {
                        foreach ($result3 as $row)
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
                    ?>
                    </div>
                </div>
                <div class="pagination">
                    <?php 
                    // if ($page > 2) {
                        $first_page = 1;
                        ?>
                        <a class="page-item" href="?per_page <?= $items_per_page?>&page=<?= $first_page?>"> << </a>
                    <!-- <?php  ?>  -->
                    <?php if ($page > 1){
                        $pre_page = $page - 1;
                        ?>
                        <a class="page-item" href="?per_page <?= $items_per_page?>&page=<?=$pre_page?>"><</a>
                    <?php } ?>
                    <?php for ($num = 1; $num <= $total_page; $num++) {?>
                        <?php if ($num != $page) {?>
                            <?php if ($num > $page - 2 && $num < $page + 2) { ?>
                            <a class="page-item" href="?per_page <?= $items_per_page?>&page=<?= $num?>"><?=$num?></a>
                            <?php } ?>
                        <?php } else { ?>
                            <strong class="current-page page-item" style="background-color: pink; border:.1rem solid black; padding: 1rem; background-color: pink;color: #fff;border-radius: 5rem;"><?= $num ?></strong>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($page < $total_page - 1) {
                        $next_page = $page + 1;
                    ?>
                    <a class="page-item" href="?per_page <?= $items_per_page?>&page=<?= $next_page?>">></a>
                    <?php } ?>
                    <?php 
                    // if($page < $total_page - 2){ 
                        $end_page = $total_page;
                        ?>
                        <a class="page-item" href="?per_page <?= $items_per_page?>&page=<?= $end_page?>">>></a>
                    <!-- <?php  ?> -->
                </div>
            </div>
        </div>

    </section>

    

    <?php include "footer.php"; ?>
</body>
</html>
