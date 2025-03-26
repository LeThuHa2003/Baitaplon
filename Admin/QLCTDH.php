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
        $str = "SELECT * FROM  ChiTietDonHang";
        $result = mysqli_query($conn, $str);

        //xóa 1 thành viên
        if (isset($_GET['del_idctdh']))
        {
            $mactdh = $_GET['del_idctdh'];
            $queryDelete = "DELETE FROM ChiTietDonHang WHERE id_CTDH = '$mactdh'";
            mysqli_query($conn, $queryDelete) or die('query failed');
            mysqli_close($conn);
            header("Location: QLCTDH.php?deleted_mactdh=$mactdh");
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Quản lý chi tiết đơn hàng</title>
    </head>
    <body >
        <!-- header section starts -->
        <?php include "header.php";?>
        <!-- header section ends -->
                    
        <!-- section QLSP starts -->
        <section class="qlsp" >
            <div class="module-head">
                <div class="header">
                    <b class="before"></b>
                    <h1>QUẢN LÝ CHI TIẾT ĐƠN HÀNG</h1>
                    <b class="after"></b>
                </div>
            </div>
            <div class="search-field">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="Mã, sản phẩm...">
                    <button type="submit" name="btnsearch">
                        <i class="fas fa-magnifying-glass"></i>
                        Tìm kiếm
                    </button>
                </form>
            </div>
            <div class="container" style="overflow-x: auto;">
                <!-- <form action=""> -->
                    <table class="tbl_qlsp">
                        <tr class="heading">
                            <td> Mã chi tiết giỏ hàng</td>
                            <td> Mã Đơn Hàng</td>
                            <td> Mã sản phẩm</td>
                            <td> Tên sản phẩm</td>
                            <td> Hình ảnh</td>
                            <td> Đơn giá</td>
                            <td> Số lượng</td>
                            <td> Thành tiền </td>
                            <td> Xóa </td>
                        </tr>
                        <?php 
                        if (isset($_GET['btnsearch']))
                        {
                            $search = $_GET['search'];
                            $str1 = "SELECT * FROM ChiTietDonHang WHERE id_CTDH like '%$search%' OR MaSP like '%$search%' OR TenSP like '%$search%'"; 
                            $result1 = mysqli_query($conn,$str1);
                            while ($row = mysqli_fetch_assoc($result1))
                            { 
                                $dongia = $row['DonGia'];
                                $thanhtien = $row['ThanhTien'];
                                ?>
                            <tr class="items">
                                <td style="text-align: center;"> <?php echo $row['id_CTDH']?></td>
                                <td style="text-align: center;"> <?php echo $row['MaDH']?></td>
                                <td style="text-align: center;"> <?php echo $row['MaSP']?></td>
                                <td class="mahoa" title="<?php echo $row['TenSP']; ?>"> <?php echo $row['TenSP']?> </td>
                                <td style="text-align: center;"> <img src="../Login/images/<?php echo $row['HinhSP']; ?>" alt="<?php echo $row['TenSP']; ?>" style="width: 100px; height: 150px;"></td>
                                <td style="text-align: center;"> <?php echo number_format($dongia, 0, ',', '.'); ?>đ</td>
                                <td style="text-align: center;"> <?php echo $row['SoLuong']?></td>
                                <td style="text-align: center;"> <?php echo number_format($thanhtien, 0, ',', '.'); ?>đ</td>
                                <td style="text-align: center;"> <a href="QLCTDH.php?del_idctdh=<?php echo $row['id_CTDH']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" class="fas fa-trash"></a></td>
                            </tr>
                                <?php }} else {
                            while ($row = mysqli_fetch_assoc($result))
                            { 
                                $dongia = $row['DonGia'];
                                $thanhtien = $row['ThanhTien'];
                                ?>
                            <tr class="items">
                                <td style="text-align: center;"> <?php echo $row['id_CTDH']?></td>
                                <td style="text-align: center;"> <?php echo $row['MaDH']?></td>
                                <td style="text-align: center;"> <?php echo $row['MaSP']?></td>
                                <td class="mahoa" title="<?php echo $row['TenSP']; ?>"> <?php echo $row['TenSP']?> </td>
                                <td style="text-align: center;"> <img src="../Login/images/<?php echo $row['HinhSP']; ?>" alt="<?php echo $row['TenSP']; ?>" style="width: 100px; height: 150px;"></td>
                                <td style="text-align: center;"> <?php echo number_format($dongia, 0, ',', '.'); ?>đ</td>
                                <td style="text-align: center;"> <?php echo $row['SoLuong']?></td>
                                <td style="text-align: center;"> <?php echo number_format($thanhtien, 0, ',', '.'); ?>đ</td>
                                <td style="text-align: center;"> <a href="QLCTDH.php?del_idctdh=<?php echo $row['id_CTDH']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" class="fas fa-trash"></a></td>
                            </tr>
                            <?php 
                            }
                        } ?>
                    </table>
                <!-- </form> -->
            </div>  
        </section>
        <!-- section QLSP ends -->

        <!-- script section starts -->
        <script>
            // Add your JavaScript here if needed
            document.addEventListener('DOMContentLoaded', function() {
                var truncatableCells = document.querySelectorAll('.mahoa');
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
            var deleted_mactdh = "<?php echo isset($_GET['deleted_mactdh']) ? $_GET['deleted_mactdh'] : ''; ?>";
            if (deleted_mactdh !== '') {
                alert("Bạn đã xóa sản phẩm mang mã chi tiết đơn hàng" + deleted_mactdh);
            }
        </script>

    </body>
</html>
<?php } else { 
    header("Location: admin_login.php?success=Mời bạn đăng nhập tài khoản Admin");
}?>


<style>
    body {
        background: lavenderblush;
        /* background-color: #8bff82d1; */
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

    /* css phần search */
    /* Container styling */
    .search-field {
        display: flex;
        justify-content: flex-end; /* Aligns the form to the right */
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
        /* background-color: #f8f9fa; */
        border-radius: 25px;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
    }

    /* Form styling */
    .search-field form {
        display: flex;
        align-items: center;
        width: auto;
    }

    /* Input field styling */
    .search-field input[type="text"] {
        /* border: .1rem solid black; */
        border-radius: 25px 0 0 25px;
        padding: 10px 80px 10px 20px;
        font-size: 16px;
        outline: none;
        flex-grow: 1;
        /* background-color: pink; */
    }

    /* Button styling */
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

    /* Button hover effect */
    .search-field button:hover {
        background-color: #3e6807;
    }

    /* Icon styling */
    .search-field button i {
        margin-right: 8px;
    }

    /* Placeholder text styling */
    .search-field input::placeholder {
        color: #adb5bd;
    }

    /* Responsive styling */
    @media (max-width: 600px) {
        .search-field {
            justify-content: center; /* Center align on small screens */
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
    /* hết css phần search */

    .qlsp .header{
        display: flex;
        position: relative;
        flex-wrap: nowrap;
        justify-content: center;
        width: 100%;
        align-items: center;
        /* margin: 0 auto; */
        /* text-align: center; */
    }
    .qlsp .header p{
        content: " ";
        flex: 1;
        height: 2px;
        opacity: 0.2;
        background-color: black;
        display: block;
        /* margin: auto 0;
        width: 30rem; */
    }

    .qlsp h1{
        font-size: 3rem;
        color: #3e6807;
        /* text-align: center; */
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
        /* border-collapse: collapse; */
        .heading{
            text-align: center;
            font-size: 2rem;
            color: black;
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
                /* border-bottom: 2px solid rgba(115, 129, 54, .2); */
                /* padding-bottom: 1.5rem; */
                padding: 2rem 1.5rem;
                /* border: .1rem solid #333; */
            }
            a{
                color: #999;
            }
            a:hover{
                color: orange;
            }
            .mahoa{
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
    /* hết css section QLSP */






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