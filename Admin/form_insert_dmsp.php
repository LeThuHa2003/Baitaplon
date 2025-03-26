<?php 
    error_reporting(0);
    session_start();
    include "../Login/connect_db.php";
    if(isset($_GET['update_madm']))
    {
        $madm = $_GET['update_madm'];
        $str = "SELECT * FROM DanhMucSanPham WHERE MaDanhMuc = '$madm'";
        $result = mysqli_query($conn, $str);
        while ($row = mysqli_fetch_assoc($result))
        { 
            $madm = $row['MaDanhMuc'];
            $tendm = $row['TenDanhMuc'];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Thêm danh mục sản phẩm</title>
        <style>
            body {
                background: lavenderblush;
            }
            /* CSS cho section QLSP */
            .qlsp{
                margin-top: 14rem;
                padding: 1.5rem 12%;
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
            .qlsp h1{
                font-size: 3rem;
                color: green;
                padding: 3rem 3rem 2rem 0;
            }

            .module-body {
                font-size: 1.7rem;
                color: #3e6807;
            }
            .module-body .box{
                padding: 2.5rem 0;
            }
            .module-body label{
                margin-right: 3rem;
            }
            .module-body input{
                width: 30rem;
                padding: 1.5rem 1rem;
                font-size: 1.7rem;
                color: #555;
                text-transform: none;
                
            }
            /* Buttons */
            /* .module4.box {
                text-align: center;
            } */
            .module4 button {
                padding: 1rem 3rem;
                font-size: 1.7rem;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                background-color: #007bff;
                color: #fff;
                transition: background-color 0.3s ease;
            }
            .module4 button + button {
                margin-left: 20px;
            }
            .module4 button[name="btnreturn"]{
                background-color: lightcoral;
            }
            .module4 button[name="btnclear"]{
                background-color: green;
            }
            .module4 button:hover {
                background-color: #3e6807;
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
                margin: 2rem auto;
            }
            .success 
            {
                font-size: 1.7rem;
                background: #D4EDDA;
                color: #40754C;
                padding: 10px;
                width: 100%;
                border-radius: 5px;
                margin: 2rem auto;
                text-transform: none;
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
                    <h1>Thêm/Cập nhật danh mục sản phẩm</h1>
                    <b class="after"></b>
                </div>
            </div>

            <form action="insertdmsp_process.php" method="POST" enctype="multipart/form-data">
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
                <div class="module-body">
                    <div class="module1 container box">
                        <div class="submodule add_madm">
                            <label for="">Mã danh mục: </label>
                            <input type="text" name="madm" placeholder="Nhập mã danh mục sản phẩm" required="" style="margin-left: .7rem;" value="<?php echo $madm; ?>">
                        </div>
                        <br>
                        <div class="submodule add_tensp">
                            <label for="">Tên danh mục: </label>
                            <input type="text" name="tendm" placeholder="Nhập tên danh mục sản phẩm" required="" value="<?php echo $tendm; ?>">
                        </div>
                    </div>
                    <div class="module4 box">
                        <!-- <button type="submit" name="btnreturn">Quay lại</button> -->
                        <button type="submit" name="btnreturn"><a href="QLDM.php" style="color: #fff;">Quay lại</a></button>
                        <button type="submit" name="btnclear"><a href="form_insert_dmsp.php" style="color: #fff;">Nhập lại</a></button>
                        <button type="submit" name="btnadd">Thêm danh mục</button>
                        <button type="submit" name="btnupdate">Cập nhật danh mục</button>
                    </div>
                </div>
            </form>
        </section>
        <!-- section QLSP ends -->
            <script>
                document.getElementById('file-input').onchange = function(e) {
                    var reader = new FileReader();
                    reader.onload = function(){
                        var preview = document.getElementById('preview-image');
                        preview.src = reader.result;
                        preview.style.display = "block";
                    };
                    reader.readAsDataURL(this.files[0]);
                    var fileName = this.files[0].name;
                    document.getElementById('file-name').value = fileName;
                };
            </script>
    </body>
</html>