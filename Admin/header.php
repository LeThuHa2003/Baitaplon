<!-- <?php 
    session_start();
?> -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Admin - header</title>
    </head>
    <body >
        <!-- header section starts -->
        <div class="site-header">
            <header class="big-header">
                <div class="search-navbar" style="display: flex;">
                    <a href="Admin_Trangchu.php" class="fas fa-home" style="color: #fff;"></a>
                    <span>
                    <nav class="navbar">
                            <!-- <a href="Admin_Trangchu.php" class="fas fa-home" style="color: #fff;"></a> -->
                            <a href="QLSP.php">Quản lý sản phẩm</a>
                            <a href="QLTV.php">Quản lý thành viên</a>
                            <a href="QLDM.php">Quản lý danh mục</a>
                            <a href="QLGH.php">Quản lý giỏ hàng</a>
                            <a href="QLDH.php">Quản lý đơn hàng</a>
                            <a href="QLCTDH.php">Quản lý chi tiết đơn hàng</a>
                            <a href="QLLH.php">Quản lý liên hệ</a>
                    </nav>
                    </span>
                </div>

                <div class="icons" style="display: grid;">
                    <!-- <div class="image" style="display: flex;"><img src="admin_icon.png" alt="" width="50rem" height="50rem" style="margin: 1rem auto">
                        <p style="margin-top: 2rem;"><a href="logout.php" class="fas fa-arrow-right" style="color: #fff; font-size: 3rem; "></a></p></div>
                    <span class="email_control"> -->
                    <?php if (isset($_SESSION['Admin']))
                    { ?>
                            <div class="image" style="display: flex;">
                                <img src="admin_icon.png" alt="" width="50rem" height="50rem" style="margin: 1rem auto">
                                <p style="margin-top: 2rem;"><a href="logout.php" class="fas fa-arrow-right" style="color: #fff; font-size: 3rem; "></a></p>
                            </div>
                    <span class="email_control"> 
                    <?php
                        echo "<span class='route email_item'> Xin chào, ". $_SESSION['Admin']. "</span>";
                        // echo '<div class = "email_item_list">
                        //         <div class = "email_link"><a class="link1" href = "Dang_xuat.php">Đăng xuất</a></div>
                        //     </div>';
                    }
                    else
                    {
                        echo '<a href="admin_login.php" class="fas fa-user" id="user" style="font-size: 2.5rem !important; display: grid; text-align: center;">
                            <p style = "margin: auto 1rem; font-size: 1.7rem; font-weight: normal">Đăng nhập</p></a>';
                    }
                    ?>
                    </span>
                    
                </div>
                
            </header>
        </div>
        <!-- header section ends -->

        
    </body>
</html>
<style>
    :root{
        --pink: pink;
    }
    *
    {
        margin: 0; 
        padding: 0;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        outline: none;
        border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;
    }
    html{
        font-size: 62.5%;
        scroll-behavior: smooth;
        scroll-padding-top: 6rem;
        overflow-x: hidden;
    }

    section{
        /* padding: 1.5rem 9%; */
        padding: 1.5rem 5%;
    }

    header{
        /* background: url("../Login/images/big_header.webp"); */
        position: fixed;
        top: 0; left: 0; right: 0;
        background: #333;
        /* background-color: #82ff92d1; */
        /* background-color: #8bff82d1; */
        /* background-color: #82ff90d1; */
        padding: 2rem 4%;
        display: flex;
        align-items:  center;
        justify-content: space-between;
        z-index: 1000;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
    }

    a.fas.fa-home {
        font-size: 2rem;
        padding: 0.2rem;
        margin-right: 1rem;
    }
    a:hover.fas.fa-home{
        color: pink;
    }

    header .navbar a{
        font-size: 2rem;
        padding: 1rem 1.5rem;
        /* color: #228B22; */
        color: lightyellow;
        text-decoration: none;
        text-transform: none;
        /* border: .1rem solid #fff; */
        position: relative;
    }
    header .navbar a:hover{
        color: #fff;
    }

    header .navbar a::before,
    header .navbar a::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: transparent; 
        bottom: 0;
        left: 0;
        transition: #fff 0.3s ease;
    }

    header .navbar a::before {
        transform: scaleX(0);
        transform-origin: right;
    }

    header .navbar a::after {
        transform: scaleX(0);
        transform-origin: left;
    }

    header .navbar a:hover::before,
    header .navbar a:hover::after {
        background-color: #fff; 
    }

    header .navbar a:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    header .navbar a:hover::after {
        transform: scaleX(1);
        transform-origin: right;
    }

    .fa-user::before{
        padding: 1rem;
    }

    header .icons a{
        color: lightyellow;
    }
    header .icons a:hover{
        color: #fff;
    }

    /* css cho phần đăng nhập */
    span.route.email_item {
        /* margin-left: 2rem; */
        font-size: 1.7rem;
    }
    .email-item{
        display: flex;
        /* color: #fff; */
        max-width: 120px;
        text-overflow: ellipsis;
        overflow: hidden; 
        cursor: pointer;
        margin-bottom: 0;
    }
    span.route.email_item {
        color: lightyellow;
    }
    span.route.email_item:hover {
        color: #fff;
    }
    /* hết css cho phần đăng nhập */
</style>