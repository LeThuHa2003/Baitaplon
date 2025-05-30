<!-- <?php 
    session_start();
?> -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Header</title>
        <link rel="stylesheet" href="header.css">
    </head>
    <body >
        <!-- header section starts -->
        <div class="site-header">
            <header class="big-header">
                <input type="checkbox" name="" id="toggler">
                <label for="toggler" class="fas fa-bars"></label>
                <a href="Trangchu.php" class="logo"><img src="images/logocomem.png" ></a>
                <div class="search-navbar">
                    <div class="header_search_field">
                        <form action="Timkiem.php" method="GET">
                        <input type="text" id="spolight_search" name="search" placeholder="Tìm sản phẩm, danh mục mong muốn ..." autocomplete="off">
                        <button class="header_search_btn" type="submit" name="timkiem" aria-label="Tìm kiếm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999">
                                <path d="M225.773.616C101.283.616 0 101.622 0 225.773S101.284 450.93 225.773 450.93s225.774-101.006 225.774-225.157S350.263.616 225.773.616zm0 413.301c-104.084 0-188.761-84.406-188.761-188.145 0-103.745 84.677-188.145 188.761-188.145s188.761 84.4 188.761 188.145c.001 103.739-84.676 188.145-188.761 188.145z"></path>
                                <path d="M506.547 479.756L385.024 358.85c-7.248-7.205-18.963-7.174-26.174.068-7.205 7.248-7.174 18.962.068 26.174l121.523 120.906a18.457 18.457 0 0013.053 5.385 18.45 18.45 0 0013.121-5.453c7.205-7.249 7.174-18.963-.068-26.174z"></path>
                            </svg>
                        </button>
                        </form>
                    </div>
                    <nav class="navbar">
                        <a href="Trangchu.php">Trang chủ</a>
                        <a href="CMsale.php">sale</a>
                        <a href="CMTD.php">trang điểm</a>
                        <a href="CMCSD.php">chăm sóc da</a>
                        <a href="CMCST.php">chăm sóc tóc</a>
                        <a href="Lien_he.php">Liên hệ</a>
                    </nav>
                </div>

                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="GioHang.php" class="fas fa-shopping-cart"></a>
                    <!-- <a href="Dang_nhap.php" class="fas fa-user"></a> -->
                    <span class="email_control">
                    <?php if (isset($_SESSION['User']))
                        {
                            echo "<span class='route email_item'>". $_SESSION['User']. "</span>";
                            echo '<div class = "email_item_list">
                                <div class = "email_link"><a class="link1" href = "ThongTinTaiKhoan.php">Thông tin tài khoản</a></div>
                                <div class = "email_link"><a class="link1" href = "Dang_xuat.php">Đăng xuất</a></div>
                                </div>';
                        }
                        else
                        {
                            echo '<a href="Dang_nhap.php" class="fas fa-user" id="user" style="color: black; color: white; font-size: 2.5rem !important;"></a>';
                        }
                    ?>
                    </span>
                </div>
            </header>
        </div>
        <!-- header section ends -->


        <div class="slideshow">
            <div class="slideshow">
                <?php include "banner.php"?>
            </div>
        </div>
        <!-- image slide ends -->

        
    </body>
</html>
