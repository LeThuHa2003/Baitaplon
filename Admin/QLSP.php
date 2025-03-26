<?php 
    session_start();
    include "../Login/connect_db.php";
    if (isset($_SESSION['Admin'])) { 
        $username = $_SESSION['Admin'];

        // Truy vấn ID thành viên từ username
        $query = "SELECT id FROM thanhvien WHERE TenTaiKhoan = '$username'";
        $select = $conn->query($query);
        if ($select->num_rows > 0) {
            $row = $select->fetch_assoc();
            $id_thanhvien = $row['id'];
        }
        $str = "SELECT * FROM SanPham";
        $result = mysqli_query($conn, $str);

        //xóa 1 thành viên
        if (isset($_GET['del_masp']))
        {
            $masp = $_GET['del_masp'];
            $queryDelete = "DELETE FROM SanPham WHERE MaSP = '$masp'";
            mysqli_query($conn, $queryDelete) or die('query failed');
            mysqli_close($conn);
            header("Location: QLSP.php?deleted_masp=$masp"); 
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Loginimages/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Quản lý sản phẩm</title>
        <style>
            body {
                background: lavenderblush;
            }

            /* CSS cho section QLSP */
            .qlsp{
                margin-top: 14rem;
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

            .module-container {
                display: flex;
                justify-content: space-between;
                margin-bottom: 3rem;
            }

            .submodule-container {
                display: flex;
            }

            /* css sắp xếp */
            .collections-orderby {
                display: ruby;
            }
            .collections-orderby span{
                font-size: 1.7rem;
                color: #333;
            }
            .collections-orderby select{
                margin-left: 2rem;
                background: #007bff;
                padding: 1rem;
                font-size: 1.5rem;
                color: #fff;
                border-radius: .5rem;
            }
            .collections-orderby select:hover{
                background-color: #3e6807;
            }
            .collections-orderby select option{
                font-size: 1.5rem;
            }
            /* hết css phần sort */

            /* css cho phần insert */
            .insert-field {
                border-radius: 25px;
                margin-left: 20px;
                button{
                    color: #fff;
                    padding: 1.1rem 2rem;
                    font-size: 1.5rem;
                    background-color: #007bff;
                    border-radius: .5rem;
                }
                button:hover{
                    background-color: #3e6807;
                }
            }
            /* hết css phần insert */

            /* css phần search */
            .search-field {
                display: flex;
                justify-content: flex-end; 
                align-items: center;
                border-radius: 25px;
            }

            .search-field form {
                display: flex;
                align-items: center;
                width: auto;
            }

            .search-field input[type="text"] {
                border-radius: 25px 0 0 25px;
                padding: 10px 80px 10px 20px;
                font-size: 16px;
                outline: none;
                flex-grow: 1;
                text-transform: none;
            }

            .search-field button {
                background-color: #007bff;
                border: none;
                border-radius: 0 25px 25px 0;
                color: white;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                transition: background-color 0.3s ease;
            }

            .search-field button:hover {
                background-color: #3e6807;
            }

            .search-field button i {
                margin-right: 8px;
            }

            .search-field input::placeholder {
                color: #adb5bd;
            }

            @media (max-width: 600px) {
                .search-field {
                    justify-content: center;
                    padding: 5px;
                }
                .search-field form {
                    flex-direction: column;
                    border-radius: 15px;
                    width: 100%;
                }
                .search-field input[type="text"] {
                    border-radius: 15px 15px 0 0;
                    width: 100%;
                    margin-bottom: 10px;
                }
                .search-field button {
                    border-radius: 0 0 15px 15px;
                    width: 100%;
                }
            }

            .qlsp h1{
                font-size: 3rem;
                color: #3e6807;
                padding: 3rem;
            }

            .container {
                height: 60rem;
                overflow-y: auto;
            }
            .tbl_qlsp{
                width: 100%;
                margin: 0 auto;
                padding: 1rem 2rem;
                font-size: 2rem;
                color:#3e6807;
                border: .1rem solid rgba(115, 129, 54, .2);
                border-radius: 2rem;
                white-space: nowrap;
                background-color: #fff;
                .heading{
                    text-align: center;
                    font-size: 2rem;
                    color: black;
                    td{
                        text-transform: none;
                        border-bottom: 2px solid rgba(115, 129, 54, .2);
                        padding: 1rem 1.5rem;
                    }
                }
                .items{
                    td{
                        text-transform: none;
                        padding: 2rem 2rem;
                    }
                    a{
                        color: #999;
                        font-size: 2rem;
                    }
                    a:hover{
                        color: orange;
                    }      
                    .truncate {
                        cursor: pointer;
                        max-width: 20rem;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        -webkit-line-clamp: 1;
                        margin-top: 6.5rem;
                        margin-right: 2rem;
                    }
                }
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
                margin: -20px auto 20px auto;
            }
            .success 
            {
                font-size: 1.7rem;
                background: #D4EDDA;
                color: #40754C;
                padding: 10px;
                width: 100%;
                border-radius: 5px;
                margin: -20px auto 20px auto;
                text-transform: none;
            }

            /* media queries */
        @media (max-width: 991px){
            html{
                font-size: 55%;
            }
            header{
                padding: 2rem;
            }
            section{
                padding: 2rem;
            }
            .header_search_field{
                width: 60rem;
            }
            header .navbar a{
                font-size: 1.8rem;
                padding: 0 1.5rem;
                color: #fff;
            }
        }

        @media (max-width: 1328px){
            .header_search_field{
                /* position: absolute; */
                width: 60rem;
            }
            header .navbar a{
                font-size: 1.7rem;
            }
        }


        @media (max-width: 768px){
            html .fa-bars{
                display: block;
                color: #fff;
            }
            .header_search_field{
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: #eee;
                border-top: .1rem solid rgba(0, 0, 0, .3);
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            }

            header .navbar{
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: #eee;
                border-top: .1rem solid rgba(0, 0, 0, .3);
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            }

            header .navbar a{
                color: #3e6807;
                margin: 1.5rem;
                padding: 1.5rem;
                background: #fff;
                border: .1rem solid rgba(0 , 0, 0, .1);
                display: block;
            }
        }
        @media (max-width: 450px){
            html{
                font-size: 50%;
            }
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
                    <b class="before"></b>
                    <h1>QUẢN LÝ SẢN PHẨM</h1>
                    <b class="after"></b>
                </div>
            </div>
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
            <div class="module-container">
                <div class="submodule-container">
                    <div class="collections-orderby">
                        <span>Sắp xếp theo:</span>
                        <form action="QLSP.php" method="GET" style="display:flex;">
                            <select name="order-by" id="collection-order-by" aria-label="Sắp xếp theo" onchange="this.form.submit()">
                                <option value="display_order.asc" <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "display_order.asc"){ echo 'selected';} ?>>-- Sắp xếp --</option>
                                <option value="price.desc" <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "price.desc"){ echo 'selected';} ?>>Giá cao đến thấp</option>
                                <option value="price.asc" <?php if(isset($_GET['order-by']) && $_GET['order-by'] == "price.asc"){ echo 'selected';} ?>>Giá thấp đến cao</option>
                                <option value="title.asc"<?php if(isset($_GET['order-by']) && $_GET['order-by'] == "title.asc"){ echo 'selected';} ?>>Tên sản phẩm</option>
                            </select>
                        </form>
                    </div>
                    <span class="insert-field">
                        <form action="form_insert_sp.php" method="GET">
                            <button type="submit" name="btninsert">
                                <i class="fas fa-plus"></i>
                                Thêm sản phẩm
                            </button>
                        </form>
                    </span>
                </div>
                <div class="search-field">
                    <form action="" method="GET">
                        <input type="text" name="search" placeholder="Tên sản phẩm, mã sản phẩm...">
                        <button type="submit" name="btnsearch">
                            <i class="fas fa-magnifying-glass"></i>
                            Tìm kiếm
                        </button>
                    </form>
                </div>
            </div>
            <div class="container" style="overflow-x: auto;">
                <table class="tbl_qlsp" >
                <!-- style=" height: 80vh; overflow-y: auto;" -->
                    <tr class="heading">
                        <td> Mã sản phẩm</td>
                        <td> Mã danh mục</td>
                        <td> Tên sản phẩm</td>
                        <td> Đơn giá </td>
                        <td> Số lượng hàng trong kho </td>
                        <td> Số lượng đã bán</td>
                        <td> Khuyến Mại</td>
                        <td> Sale </td>
                        <td> Hình ảnh</td>
                        <td> Chi tiết sản phẩm</td>
                        <td> Tình trạng </td>
                        <td> Công dụng</td>
                        <td> Cập nhật</td>
                        <td> Xóa </td>
                    </tr>
                    <?php 
                    if (isset($_GET['btnsearch']))
                    {
                        $search = $_GET['search'];
                        $str1 = "SELECT * FROM SanPham WHERE MaSP like '%$search%' OR MaDanhMuc like '%$search%' OR TenSP like '%$search%' OR CongDung like '%$search%' OR ChiTietSP like '%$search%' OR TinhTrang like '%$search%'"; 
                        $result1 = mysqli_query($conn,$str1);
                        while ($row = mysqli_fetch_assoc($result1))
                        { 
                            $dongia = $row['Gia'];
                        ?>
                    <tr class="items">
                        <td style="text-align: center;"><?php echo $row['MaSP']; ?></td>
                        <td style="text-align: center;"><?php echo $row['MaDanhMuc']; ?></td>
                        <td class="truncate" title="<?php echo $row['TenSP']; ?>"><?php echo $row['TenSP']; ?></td>
                        <td style="text-align: center;"><?php echo number_format($dongia, 0, ',', '.'); ?>đ</td>
                        <td style="text-align: center;"><?php echo $row['SoLuong']; ?></td>
                        <td style="text-align: center;"><?php echo $row['SoLuongDaBan']; ?></td>
                        <td style="text-align: center;"><?php echo $row['KhuyenMai']; ?></td>
                        <td style="text-align: center;"><?php echo $row['Sale']; ?></td>
                        <td style="text-align: center;"><img src="../Login/images/<?php echo $row['HinhAnh']; ?>" alt="<?php echo $row['TenSP']; ?>" style="width: 100px; height: 150px;"></td>
                        <td class="truncate" title="<?php echo $row['ChiTietSP']; ?>"><?php echo $row['ChiTietSP']; ?></td>
                        <td><?php echo $row['TinhTrang']; ?></td>
                        <td class="truncate" title="<?php echo $row['CongDung']; ?>"><?php echo $row['CongDung']; ?></td>
                        <td style="text-align: center;"><a href="form_update_sp.php?update_masp=<?php echo $row['MaSP']; ?>"><i class="fas fa-edit"></i></a></td>
                        <td style="text-align: center;"><a href="QLSP.php?del_masp=<?php echo $row['MaSP']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <?php
                        }
                        exit();
                    }


                    if (isset($_GET['order-by'])) {
                        $orderBy = $_GET['order-by'];
                        $str = "SELECT * FROM SanPham ORDER BY ";
                        if ($orderBy == "price.desc") {
                            $str .= "Gia DESC";
                        } elseif ($orderBy == "price.asc") {
                            $str .= "Gia ASC";
                        } elseif ($orderBy == "title.asc") {
                            $str .= "TenSP ASC";
                        } else {
                            $str .= "MaSP ASC";
                        }
                        $result = mysqli_query($conn, $str);
                    }
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        $dongia = $row['Gia'];
                    ?>
                    <tr class="items">
                        <td style="text-align: center;"><?php echo $row['MaSP']; ?></td>
                        <td style="text-align: center;"><?php echo $row['MaDanhMuc']; ?></td>
                        <td class="truncate" title="<?php echo $row['TenSP']; ?>"><?php echo $row['TenSP']; ?></td>
                        <td style="text-align: center;"><?php echo number_format($dongia, 0, ',', '.'); ?>đ</td>
                        <td style="text-align: center;"><?php echo $row['SoLuong']; ?></td>
                        <td style="text-align: center;"><?php echo $row['SoLuongDaBan']; ?></td>
                        <td style="text-align: center;"><?php echo $row['KhuyenMai']; ?></td>
                        <td style="text-align: center;"><?php echo $row['Sale']; ?></td>
                        <td style="text-align: center;"><img src="../Login/images/<?php echo $row['HinhAnh']; ?>" alt="<?php echo $row['TenSP']; ?>" style="width: 100px; height: 150px;"></td>
                        <td class="truncate" title="<?php echo $row['ChiTietSP']; ?>"><?php echo $row['ChiTietSP']; ?></td>
                        <td><?php echo $row['TinhTrang']; ?></td>
                        <td class="truncate" title="<?php echo $row['CongDung']; ?>"><?php echo $row['CongDung']; ?></td>
                        <td style="text-align: center;"><a href="form_update_sp.php?update_masp=<?php echo $row['MaSP']; ?>"><i class="fas fa-edit"></i></a></td>
                        <td style="text-align: center;"><a href="QLSP.php?del_masp=<?php echo $row['MaSP']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </section>
        <!-- section QLSP ends -->

        <!-- script section starts -->
        <script>
            // Add your JavaScript here if needed
            document.addEventListener('DOMContentLoaded', function() {
                var truncatableCells = document.querySelectorAll('.truncate');
                truncatableCells.forEach(function (cell) {
                    cell.addEventListener('click', function(){
                        var fullContent = this.textContent;
                        alert(fullContent);
                    });
                });
            });
        </script>
        <!-- script section ends -->

        <script>
            var deleted_masp = "<?php echo isset($_GET['deleted_masp']) ? $_GET['deleted_masp'] : ''; ?>";
            if (deleted_masp !== '') {
                alert("Bạn đã xóa sản phẩm mang mã " + deleted_masp);
            }
        </script>

    </body>
</html>
<?php } else { 
    header("Location: admin_login.php?success=Mời bạn đăng nhập tài khoản Admin");
}?>