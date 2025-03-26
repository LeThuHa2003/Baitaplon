<?php 
    session_start();
    include "../Login/connect_db.php";
    if(isset($_GET['update_masp']))
    {
        $masp = $_GET['update_masp'];
        $str = "SELECT * FROM SanPham WHERE MaSP = '$masp'";
        $result = mysqli_query($conn, $str);
        while ($row = mysqli_fetch_assoc($result))
        { 
            $madm = $row['MaDanhMuc'];
            $tensp = $row['TenSP'];
            $dongia = $row['Gia']*1000;
            $soluonghangton = $row['SoLuong'];
            $khuyenmai = $row['KhuyenMai'];
            $Sale = $row['Sale'];
            $sldaban = $row['SoLuongDaBan'];
            $tinhtrang = $row['TinhTrang'];
            $hinhanh = $row['HinhAnh'];
            $chitietsp = $row['ChiTietSP'];
            $congdung = $row['CongDung'];
        }
        $sql = "SELECT MaDanhMuc, TenDanhMuc FROM DanhMucSanPham";
        $result1 = mysqli_query($conn, $sql);
        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
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
        <title>Cập nhật sản phẩm</title>
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
                display: none; 
                /* Ẩn input type file */
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
                max-width: 400px; /* Kích thước tối đa của hình ảnh xem trước */
                height: 280px;
                margin-top: 2rem;
                background-color: #fff;
                display: block;
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
                    <h1>Cập nhật sản phẩm</h1>
                    <b class="after"></b>
                </div>
            </div>

            <form id="updateForm" action="updatesp_process.php" method="GET" enctype="multipart/form-data">
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
                        <input type="hidden" name="masp" value="<?php echo $masp;?>">
                        <div class="submodule add_madm">
                            <label for="">Mã danh mục: </label>
                            <span class="dropdown">
                                <select name="madm">
                                    <option value="" disabled selected hidden>Mã danh mục</option>
                                    <?php
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                        echo '<option value="' . $row1['MaDanhMuc'] . '"' . ($madm == $row1['MaDanhMuc'] ? ' selected="selected"' : '') . '>' . $row1['TenDanhMuc'] . '</option>';
                                    }
                                    ?>
                                    <!-- <option value="CMSale" <?php if ($madm == "CMSale") echo 'selected="selected"'; ?>>CMSale</option>
                                    <option value="CMCSD" <?php if ($madm == "CMCSD") echo 'selected="selected"'; ?>>CMCSD</option>
                                    <option value="CMCST" <?php if ($madm == "CMCST") echo 'selected="selected"'; ?>>CMCST</option>
                                    <option value="CMTD" <?php if ($madm == "CMTD") echo 'selected="selected"'; ?>>CMTD</option> -->
                                </select>
                            </span>
                        </div>

                        <div class="submodule add_tensp">
                            <label for="">Tên sản phẩm: </label>
                            <input type="text" name="tensp" placeholder="Nhập tên sản phẩm" value="<?php echo $tensp; ?>">
                        </div>
                        <div class="submodule add_dongia">
                            <label for="">Đơn giá (VNĐ): </label>
                            <input type="text" name="dongia" placeholder="Nhập đơn giá" value="<?php echo $dongia; ?>">
                        </div>
                    </div>
                    <div class="module2 container box">
                        
                        <div class="submodule add_khuyenmai">
                            <label for="">Khuyến mại: </label>
                            <span class="dropdown">
                                <select name="khuyenmai">
                                    <option value="" disabled selected hidden>Khuyến mại</option>
                                    <option value="Không" <?php if ($khuyenmai == "Không") echo 'selected="selected"'; ?>>Không</option>
                                    <option value="Có" <?php if ($khuyenmai == "Có") echo 'selected="selected"'; ?>>Có</option>
                                </select>
                            </span>
                        </div>
                        <div class="submodule add_sale">
                            <label for="">Sale (%):</label>
                            <input type="text" name="sale" placeholder="Nhập phần trăm sale" value="<?php echo $Sale; ?>">
                        </div>
                        <div class="submodule add_slhangtrongkho">
                            <label for="">Tồn kho:</label>
                            <input type="text" name="soluonghangtrongkho" placeholder="Nhập số lượng" value="<?php echo $soluonghangton; ?>">
                        </div>
                    </div>


                    <div class="module5 container box">
                        <div class="submodule update_tinhtrang">
                            <label for="">Tình trạng: </label>
                            <span class="dropdown">
                                <select name="tinhtrang">
                                    <option value="" disabled selected hidden>Tình trạng</option>
                                    <option value="Còn hàng" <?php if ($tinhtrang == "Còn hàng") echo 'selected="selected"'; ?>>Còn hàng</option>
                                    <option value="Hết hàng" <?php if ($tinhtrang == "Hết hàng") echo 'selected="selected"'; ?>>Hết hàng</option>
                                </select>
                            </span>
                        </div>
                        <!-- <div class="submodule update_sldb">
                            <label for="">Số lượng đã bán:</label>
                            <input type="text" name="soluongdaban" placeholder="Nhập số lượng đã bán" value="<?php echo $sldaban; ?>">
                        </div> -->
                    </div>

                    <div class="module3 container box">
                        <div class="image-upload">
                            <label for="file-input">
                                Chọn hình ảnh:
                            </label>
                            <input id="file-input" type="file" accept="image/*" onchange="displayFileName()" />
                            <!-- onchange="displayFileName()" -->
                            <!-- onchange="displayImage(this)" -->
                            <!-- <span id="file-name" name="hinhanh"></span> -->
                            <input type="text" name="hinhanh" readonly="" id="file-name" value="<?php echo $hinhanh; ?>" style="width: 13rem;">
                            <img src="<?php echo "../Login/images/".$hinhanh?>"  id="preview-image" alt="Preview"/>
                        </div>

                        <div class="submodule add_chitietsp">
                            <label for="">Chi tiết sản phẩm:</label><br>
                            <textarea type="text" name="chitietsp" placeholder="Nhập chi tiết sản phẩm"><?php echo $chitietsp; ?></textarea>
                        </div>
                        <div class="submodule add_congdung">
                            <label for="">Công dụng sản phẩm:</label><br>
                            <textarea type="text" name="congdung" placeholder="Nhập công dụng sản phẩm"><?php echo $congdung; ?></textarea>
                        </div>
                    </div>

                    <div class="module4 box">
                        <button type="submit" name="btnreturn">Quay lại</button>
                        <button type="button" name="btnclear" onclick="resetForm()">Nhập lại</button>
                        <button type="submit" name="btnupdate">Cập nhật sản phẩm</button>
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

                function resetForm() {
                    // Clear all input elements
                    const inputs = document.querySelectorAll('#updateForm input[type="text"], #updateForm input[type="file"]');
                    inputs.forEach(input => {
                        input.value = '';
                    });

                    // Clear all select elements
                    const selects = document.querySelectorAll('#updateForm select');
                    selects.forEach(select => {
                        select.selectedIndex = 0;
                    });

                    // Clear all textarea elements
                    const textareas = document.querySelectorAll('#updateForm textarea');
                    textareas.forEach(textarea => {
                        textarea.value = '';
                    });

                    // Clear the preview image
                    document.getElementById('preview-image').src = "";
                    document.getElementById('file-name').value = "";
                }
            </script>

            <!-- <script>
                function displayImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        
                        reader.onload = function (e) {
                            var preview = document.getElementById('preview-image');
                            preview.src = e.target.result;
                            preview.style.display = "block";
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                };
                }
            </script> -->
            
    </body>
</html>