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
        $str = "SELECT * FROM  ThanhVien";
        $result = mysqli_query($conn, $str);

        //xóa 1 thành viên
        if (isset($_GET['del_idtv']))
        {
            $matv = $_GET['del_idtv'];
            $queryDelete = "DELETE FROM ThanhVien WHERE id = '$matv'";
            mysqli_query($conn, $queryDelete) or die('query failed');
            mysqli_close($conn);
            header("Location: QLTV.php?deleted_matv=$matv");
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Quản lý thành viên</title>
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
                    <h1>QUẢN LÝ THÀNH VIÊN</h1>
                    <b class="after"></b>
                </div>
            </div>
            <div class="search-field">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="Tên, địa chỉ...">
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
                            <td> Mã thành viên</td>
                            <td> Tên tài khoản</td>
                            <td> SĐT</td>
                            <td> Email </td>
                            <td> Địa chỉ </td>
                            <td> Mật khẩu</td>
                            <td> Code </td>
                            <td> Thời gian cập nhật</td>
                            <td> Xóa </td>
                        </tr>
                        <?php 
                        if (isset($_GET['btnsearch']))
                        {
                            $search = $_GET['search'];
                            $str1 = "SELECT * FROM ThanhVien WHERE id like '%$search%' OR TenTaiKhoan like '%$search%' OR SDT like '%$search%' OR DiaChi like '%$search%' OR Code like '%$search%' OR Updated_time like '%$search%'"; 
                            $result1 = mysqli_query($conn,$str1);
                            while ($row = mysqli_fetch_assoc($result1))
                            { 
                                ?>
                            <tr class="items">
                                <td style="text-align: center;"> <?php echo $row['id']?></td>
                                <td> <?php echo $row['TenTaiKhoan']?></td>
                                <td style="text-align: center;"> <?php echo $row['SDT']?></td>
                                <td> <?php echo $row['Email']?> </td>
                                <td> <?php echo $row['DiaChi']?> </td>
                                <td class="mahoa"> <?php echo $row['MatKhau']?></td>
                                <td style="text-align: center;"> <?php echo $row['Code']?> </td>
                                <td> <?php echo $row['Updated_time']; ?></td>
                                <td style="text-align: center;"> <a href="QLTV.php?del_idtv=<?php echo $row['id']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" class="fas fa-trash"></a></td>
                            </tr>
                                <?php }} else {
                            while ($row = mysqli_fetch_assoc($result))
                            { 
                                ?>
                            <tr class="items" >
                                <td style="text-align: center;"> <?php echo $row['id']?></td>
                                <td> <?php echo $row['TenTaiKhoan']?></td>
                                <td style="text-align: center;"> <?php echo $row['SDT']?></td>
                                <td> <?php echo $row['Email']?> </td>
                                <td> <?php echo $row['DiaChi']?> </td>
                                <td class="mahoa" title="<?php echo $row['MatKhau']; ?>"> <?php echo $row['MatKhau']?></td>
                                <td style="text-align: center;"> <?php echo $row['Code']?> </td>
                                <td> <?php echo $row['Updated_time']; ?></td>
                                <td style="text-align: center;"> <a href="QLTV.php?del_idtv=<?php echo $row['id']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa thành viên này không?');" class="fas fa-trash"></a></td>
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
            var deleted_matv = "<?php echo isset($_GET['deleted_matv']) ? $_GET['deleted_matv'] : ''; ?>";
            if (deleted_matv !== '') {
                alert("Bạn đã xóa Thành Viên mang mã " + deleted_matv);
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
        text-transform: none;
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
                display: block;
                max-width: 25rem;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                -webkit-line-clamp: 1;
                cursor: pointer;
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