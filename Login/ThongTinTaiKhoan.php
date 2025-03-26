<?php 
    // error_reporting(0);
    include "connect_db.php";
    session_start();
    if (isset($_SESSION['User'])) { 
        $username = $_SESSION['User'];

        // Truy vấn thông tin thành viên từ username
        $query = "SELECT id, SDT, Email, DiaChi FROM thanhvien WHERE TenTaiKhoan = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_thanhvien = $row['id'];
            $phone = isset($row['SDT']) ? $row['SDT'] : '';
            $email = isset($row['Email']) ? $row['Email'] : '';
            $address = isset($row['DiaChi']) ? $row['DiaChi'] : '';
        } else {
            // Handle case where no matching user is found
            $phone = $email = $address = '';
        }
    } else {
        // Handle case where session is not set
        $username = $phone = $email = $address = '';
    }
    

    if (isset($_POST['btn_updateacc'])){
        $email = $_POST['email'];
        $tentaikhoan = $_POST['username'];
        $sdt = $_POST['phone'];
        $diachi = $_POST['address'];

        // Check if the username already exists
        $check_username_query = "SELECT * FROM ThanhVien WHERE TenTaiKhoan = ?";
        $stmt = $conn->prepare($check_username_query);
        $stmt->bind_param("s", $tentaikhoan);
        $stmt->execute();
        $result_username = $stmt->get_result();

        if ($result_username->num_rows > 0) {
            header("Location: ThongTinTaiKhoan.php?error=Đã tồn tại Tên Tài Khoản này!");
            exit();
        }

        $str = "UPDATE ThanhVien SET TenTaiKhoan = '$tentaikhoan', SDT = '$sdt', DiaChi = '$diachi' WHERE Email = '$email'";
        $result = mysqli_query($conn,$str);
        if ($result)
        {
            header("Location: ThongTinTaiKhoan.php?success=Cập nhật tài khoản thành công. Bạn hãy đăng nhập lại để thấy sự thay đổi.");
        }
        else{
            header("Location: ThongTinTaiKhoan.php?error=Cập nhật tài khoản thất bại");
        } 
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="SanPham.css"> -->
</head>
<body>
    
<?php include "header.php"; ?>

    <section class="breadcrumb">
        <div class="first_container">
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="ThongTinTaiKhoan.php">Thông tin tài khoản</a>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="account-sidebar">
                <div class="greeting">
                    <h2>Xin chào, 
                        <span><?php echo htmlspecialchars($username); ?></span>
                    </h2>
                </div>
                <a href="ThongTinTaiKhoan.php"><i class="fas fa-user"></i> Thông tin tài khoản</a>
                <a href="Lien_he.php"><i class="fas fa-envelope"></i> Gửi ý kiến cho Cỏ mềm</a>
                <a href="Dang_xuat.php"><i class="fas fa-close" style="margin-right: 3rem;"></i>Đăng xuất</a>
            </div>
            <div class="account-content">
                <div class="heading">
                    <h1>Thông tin tài khoản</h1>
                </div><br>
                <form action="ThongTinTaiKhoan.php" method="POST">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <div class="group">
                        <label for="">Tên tài khoản (*)</label>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div><br>
                    <div class="group">
                        <label for="">Số điện thoại (*)</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                    </div><br>
                    <div class="group">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                    </div><br>
                    <div class="group">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                    </div><br>
                    <div class="change-password">
                        <a href="Forgot_password.php">Thay đổi mật khẩu</a>
                        <div class="button">
                            <button name="btn_updateacc" type="submit">Cập nhật tài khoản</button>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
        </div>
    </section>


    <?php include "footer.php"; ?>
</body>
</html>

<style>
    /* css section breadcrumb */
    .breadcrumb .first_container a{
        font-size: 1.8rem;
        color: #555;
        font-weight: bold;
    }
    .breadcrumb .first_container span{
        margin-left: 1.5rem;
        font-size: 1.8rem;
    }


    .container{
        margin-top: 2rem;
        display: flex;
        font-size: 2rem;
        /* justify-content: space-between; */
    }
    .container .account-sidebar{
        display: grid;
        margin-right: 5rem;
        h2{
            color: green;
            font-size: 2rem;
            padding-bottom: 2rem;
            border-bottom: .1rem solid #999;
            span{
                font-size: 2.5rem;
            }
        }
        i{
            font-size: 2.2rem;
            margin-right: 2rem;
            .fa-close{
                margin-right: 5rem;
            }
        }
        a{
            color: #3e6807;
            padding: 2rem 0;
        }
        a:hover{
            color: orange;
        }
    }
    .container .account-content{
        /* margin-left: 2rem; */
        color: #3e6807;
        margin: 0 auto;
        .error
        {
            background: #F2DEDE;
            color: #A94442;
            padding: 20px;
            width: 100%;
            border-radius: 5px;
            margin: 10px auto;
            font-size: 1.7rem;
            text-transform: none;
        }
        .success 
        {
            font-size: 1.7rem;
            background: #D4EDDA;
            color: #40754C;
            padding: 20px;
            width: 100%;
            border-radius: 5px;
            margin: 10px auto;
            text-transform: none;
        }
        h1{
            color: green;
            font-size: 3rem;
            margin-bottom: 2rem;
        }
        .group
        {
            padding: .5rem;
            label{
                display: block;
                float: left;
                width: 30rem;
                margin-top: 2rem;
            }
            input{
                padding: 1.7rem 2rem;
                text-transform: none;
                border: .05rem solid green;
                border-radius: .5rem; 
                width: 50rem;      
                font-size: 1.7rem;
                color: #3e6807;     
            }
        } 
        .change-password{
            text-align: center;
            a{
                margin-top: 3rem;
                font-size: 1.7rem;
                margin: 0 auto;
                color: #3e6807;
                text-decoration: underline;
                font-weight: bold;
            }
            a:hover{
                color: orange;
            }
            button{
                margin-top: 3rem;
                width: 100%;
                border-radius: 1rem;
                padding: 1.7rem;
                background-color: #3e6807;
                color: #fff;
                font-size: 2rem;
            }
            button:hover{
                background-color: orange;
            }
        }
        
    }
</style>