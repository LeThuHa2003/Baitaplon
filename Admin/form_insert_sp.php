<?php 
    session_start();
    include "../Login/connect_db.php";
    $sql = "SELECT MaDanhMuc, TenDanhMuc FROM DanhMucSanPham";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Thêm sản phẩm mới</title>
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
            .module-body .container{
                display: flex;
                justify-content: space-between;
            }
            .module-body .box{
                padding: 2.5rem 0;
            }
            .module-body label{
                margin-right: 2rem;
            }
            .module-body input{
                width: 30rem;
                padding: 1.5rem 1rem;
                font-size: 1.7rem;
                color: #555;
                text-transform: none;
                
            }
            .dropdown select {
                width: 200px;
                padding: 10px;
                font-size: 1.7rem;
                border: none;
                border-radius: 5px;
                outline: none;
                /* background-color: #f1f1f1; */
                color: #555;
            }
            .dropdown select:focus {
                border: 1px solid #aaa;
            }

            .image-upload label {
                cursor: pointer;
                display: inline-block;
                background-color: lightgray; /* Màu nền của nút chọn */
                color: #333;
                padding: 10px 20px;
                /* border-radius: 5px; */
                transition: background-color 0.3s ease;
                font-family: Arial, sans-serif; /* Font chữ */
            }

            .image-upload label:hover {
                background-color: #3e6807; /* Màu nền khi di chuột qua */
                color: #fff;
            }

            .image-upload input[type="file"] {
                display: none; /* Ẩn input type file */
            }

            #file-name {
                margin-left: -3rem;
                width: 20rem;
                font-size: 1.7rem;
                background-color: #fff;
                padding: .85rem 3rem 1.1rem 3rem;
                text-transform: none;
            }
            #preview-image {
                max-width: 300px; /* Kích thước tối đa của hình ảnh xem trước */
                height: 280px;
                margin-top: 2rem;
                display: none;
                background-color: #fff;
                border-radius: 5px; /* Bo tròn viền hình ảnh */
                border: 2px solid #999; /* Viền hình ảnh */
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Hiển thị bóng đổ */
            }
            /* Reset CSS */

            .module-body .module3 .submodule textarea{
                margin-top: 2rem;
                width: 400px;
                height: 260px;
                padding: 1.5rem 1rem;
                font-size: 1.7rem;
                color: #555;
                text-transform: none;
            }
            .module-body .module3 .add_chitietsp, .add_congdung{
                margin-top: 10px;
            }

            /* Buttons */
            .module4.box {
                text-align: center;
            }
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
                    <h1>Thêm sản phẩm</h1>
                    <b class="after"></b>
                </div>
            </div>

            <form action="insertsp_process.php" method="POST" enctype="multipart/form-data">
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
                            <span class="dropdown">
                                <select name="madm" required="">
                                    <option value="" disabled selected hidden>Mã danh mục</option>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['MaDanhMuc'] . '">' . $row['TenDanhMuc'] . '</option>';
                                        }
                                    ?>
                                    <!-- <option value="CMSale">CMSale</option>
                                    <option value="CMCSD">CMCSD</option>
                                    <option value="CMCST">CMCST</option>
                                    <option value="CMTD">CMTD</option> -->
                                </select>
                            </span>
                        </div>

                        <div class="submodule add_tensp">
                            <label for="">Tên sản phẩm: </label>
                            <input type="text" name="tensp" placeholder="Nhập tên sản phẩm" required="">
                        </div>
                        <div class="submodule add_dongia">
                            <label for="">Đơn giá (VNĐ): </label>
                            <input type="text" name="dongia" placeholder="Nhập đơn giá" required="">
                        </div>
                    </div>
                    <div class="module2 container box">
                        
                        <div class="submodule add_khuyenmai">
                            <label for="">Khuyến mại: </label>
                            <span class="dropdown">
                                <select name="khuyenmai" required="">
                                    <option value="" disabled selected hidden>Khuyến mại</option>
                                    <option value="Không">Không</option>
                                    <option value="Có">Có</option>
                                </select>
                            </span>
                        </div>
                        <div class="submodule add_sale">
                            <label for="">Sale (%):</label>
                            <input type="text" name="sale" placeholder="Nhập phần trăm sale">
                        </div>
                        <div class="submodule add_slhangtrongkho">
                            <label for="">Tồn kho:</label>
                            <input type="text" name="soluonghangtrongkho" placeholder="Nhập số lượng" required="">
                        </div>
                    </div>
                    <div class="module3 container box">
                        <div class="image-upload">
                            <label for="file-input">
                                Chọn hình ảnh:
                            </label>
                            <input id="file-input" type="file" accept="image/*" onchange="displayFileName()" required=""/>
                            <!-- <span id="file-name" name="hinhanh"></span> -->
                            <input type="text" name="hinhanh" readonly="" id="file-name" style="width: 13rem;" required="">
                            <img id="preview-image" src="#" alt="Preview" />
                        </div>

                        <div class="submodule add_chitietsp">
                            <label for="">Chi tiết sản phẩm:</label><br>
                            <textarea type="text" name="chitietsp" placeholder="Nhập chi tiết sản phẩm" required=""></textarea>
                        </div>
                        <div class="submodule add_congdung">
                            <label for="">Công dụng sản phẩm:</label><br>
                            <textarea type="text" name="congdung" placeholder="Nhập công dụng sản phẩm" required=""></textarea>
                        </div>
                    </div>

                    <div class="module4 box">
                        <!-- <button type="submit" name="btnreturn">Quay lại</button> -->
                        <button type="submit" name="btnreturn"><a href="QLSP.php" style="color: #fff;">Quay lại</a></button>
                        <button type="submit" name="btnclear"><a href="form_insert_sp.php" style="color: #fff;">Nhập lại</a></button>
                        <button type="submit" name="btnadd">Thêm sản phẩm</button>
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