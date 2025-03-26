<?php 
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
        } else {
            // Handle case where no matching user is found
            $phone = $email = $address = '';
        }
    } else {
        // Handle case where session is not set
        $username = $phone = $email = $address = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Liên hệ Cỏ Mềm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <?php include "header.php"; ?>
    
    <section class="breadcrumb">
        <div class="first_container">
            <a href="Trangchu.php" class="fas fa-home"><span>Trang chủ</span></a>
            <span style="margin: 0 1.5rem;"> / </span>
            <a href="Lien_he.php">Liên hệ</a>
        </div>
    </section>

    <main class="site-login">
            <div class="container">
                <div class="contact-form">
                    <h1 class="heading">Liên hệ với Cỏ Mềm</h1>
                    <div class="form">
                        <form method="POST" action="Lien_he_check.php">
                            <?php
                                if (isset($_GET['error']))
                                {?>
                                    <p class = "error"><?php echo $_GET['error']; ?></p><?php
                                }
                            ?>
                            <?php if (isset($_GET['success'])) { ?>
                                <p class="success"><?php echo $_GET['success']; ?></p>
                            <?php } ?>
                            <div class= "sub_container" style="display: flex;">
                                <div class="form_field">
                                    <input id ="name_id" type="text" class="form__control" name="name" placeholder="Họ tên của bạn*" required="" autofocus="" value="<?php echo htmlspecialchars($username); ?>" fdprocessedid="nvvewt">
                                </div>
                                <div class="form_field">
                                    <input id = "sdt_id" type="text" class="form__control" name="phone" placeholder="Số điện thoại*" required="" autofocus="" value="<?php echo htmlspecialchars($phone); ?>" fdprocessedid="nvvewt">
                                </div>
                            </div><br>
                            <div class="form_field">
                            <input type="email" class="form__control" name="email" placeholder="Email của bạn*" required="" autofocus="" value="<?php echo htmlspecialchars($email); ?>" fdprocessedid="nvvewt">
                            </div><br>
                            <div class="form_field">
                            <textarea type="text" name ="message" placeholder="Nhập câu hỏi của bạn ở đây:*" required=""></textarea>
                            </div><br>
                            <div class="form__button"> 
                            <button name = "btnLogin" type="submit" class="btn btn_login" fdprocessedid="32hjr" style="background-color: #3e6807;">
                                Gửi Cỏ Mềm
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="ggmap_container">
                    <p>Địa chỉ: 69 P. Thái Hà, Trung Liệt, Đống Đa, Hà Nội 11500, Việt Nam</p><br>
                    <p>Số điện thoại: 0964867697 <span style="margin-left:2rem; text-transform: none;"> Email: comemhomelab@gmail.com</span></p><br>
                    <!-- <p>Email: comemhomelab@gmail.com</p><br> -->
                    <div class="ggmap">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.78257103932503!2d105.8211904238091!3d21.011824155378317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb3b5041bff%3A0xc7eb2c38f2f358a3!2zQ-G7jyBN4buBbSBIb21lTGFi!5e0!3m2!1svi!2s!4v1714364788803!5m2!1svi!2s" 
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                </div>
            </div>
        </main>

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
    /* end css section breadcrumb */
    
    .site-login {
        background-image: url(images/nen.png);
        background-size: 100%;
        font-size: 3rem;
        .container
        {
            
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
            .contact-form
            {
                width: 75rem;
                background-color: white;
                border: 0;
                padding: 15px 40px;
                box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
                border-radius: 15px;
            }
            h1
            {
                font-size: 3.5rem;
                color: darkgreen;
                text-align: center;
                font-weight: 350;
            }
            h1.heading 
            {
                padding: 20px;
            }
            .form 
            {
                text-align: center;
            }
            input
            {
                border: 0;
                border-bottom: .1rem solid #3e6807;
                font-size: 1.7rem;
                text-transform: none;
                width: 95%;
                padding: 1.5rem 0;
                outline: none;
                text-transform: none;
                color: #3e6807;
            }
            .form__button 
            {
                margin-bottom: 30px;
                margin-top: 20px;
            }
            .btn 
            {
                font-size: 1.7rem;
                color: white;
                border: 0;
                border-radius: .5rem;
                padding: 1.5rem 3rem;
            }
            .btn_login:hover
            {
                color: yellowgreen;
                transition: all 0.3s;
            }
            .error 
            {
                font-size: 1.7rem;
                background: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin: 20px auto;
            }
            .success 
            {
                font-size: 1.7rem;
                background: #D4EDDA;
                color: #40754C;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin: 20px auto;
            }
            textarea{
                width: 95%;
                height: 15rem;
                font-size: 1.7rem;
                padding: 1.5rem 0;
                text-transform: none;
                border-bottom: .1rem solid #3e6807;
            }
            .sub_container{
                margin-left: 1.5rem;
                #name_id{
                    width: 30rem;
                    margin-right: 3.5rem;
                }
                #sdt_id{
                    width: 30rem;
                }
            }
            .ggmap_container{
                margin-left: 3rem;
                font-size: 1.7rem;
                background: #fff;
                padding: 2.3rem 5rem;
                border-radius: 15px;
                box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
                width: 75rem;
                color: #3e6807;
            }
        }
    } 
</style>