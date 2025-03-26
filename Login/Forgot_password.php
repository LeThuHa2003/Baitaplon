<?php
    session_start();
    include "connect_db.php";
    error_reporting(0);
    $email = $_POST['email'];

    if (isset($_SESSION['User'])) {    //kiểm tra xem có session useer không
        $username = $_SESSION['User'];

        // Truy vấn thông tin thành viên từ username
        $query = "SELECT Email FROM thanhvien WHERE TenTaiKhoan = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();    //Lấy dòng dữ liệu kết quả dưới dạng mảng liên kết.
            $email = isset($row['Email']) ? $row['Email'] : '';    //Kiểm tra và gán giá trị email từ mảng kết quả vào biến $email. Nếu không có email, gán giá trị rỗng ('') cho $email.
        } else {
            // Handle case where no matching user is found
            $email = '';
        }
    } else {
        $email = $_POST['email'];    //Nếu không có session 'User', lấy email từ dữ liệu gửi qua phương thức POST.
    }




    if (isset($_POST['btn_Sendemail']))    //kiểm tra nếu nút btn_Sendemail đã được nhấn
    {
        $str = "SELECT * FROM ThanhVien WHERE Email = '$email'";
        // $role = $str[0]['VaiTro'];
        $result = mysqli_query($conn, $str);
        if (mysqli_num_rows($result) < 1)      //mysqli_num_rows trả về số lượng dòng trong kết quả truy vấn. Nếu số lượng dòng nhỏ hơn 1, nghĩa là không tìm thấy email trong cơ sở dữ liệu.
        { 
            header("Location: Forgot_password.php?error=Email không đúng!");
        }
        else
        {
            include "Forgot_password_process.php";
            $_SESSION['email'] = $email;
            header("Location: Code.php"); 
        }
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>Quên mật khẩu</title>
    </head>
    <body >
        <?php include "header.php"; ?>
        <main class="site-login">
            <div class="container">
              <div class="login-form">
                <h1 class="heading">Lấy lại mật khẩu</h1>
                <div class="form">
                  <form method="POST" action="Forgot_password.php" id="login-from">
                    <?php
                        if (isset($_GET['error']))
                        {?>
                            <p class = "error"><?php echo $_GET['error']; ?></p><?php
                        }
                    ?>

                    <?php if (isset($_GET['success'])) { ?>
                                    <p class="success"><?php echo $_GET['success']; ?></p>
                                <?php } ?>
                    <div class="form_field">
                      <input type="email" class="form__control" name="email" placeholder="Email của bạn" required="" autofocus="" value="<?php echo htmlspecialchars($email); ?>" fdprocessedid="nvvewt">
                    </div>
                    <div class="form__button"> 
                      <button name = "btn_Sendemail" type="submit" class="btn btn_sendemail" fdprocessedid="32hjr" style="background-color: #3e6807;">
                        Tiếp tục
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </main>

        <?php include "footer.php"; ?>
    </body>
</html>
<style>
    /* body{
        margin: 0;
        min-height: 100vh;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 16px;
        letter-spacing: .2px;
        line-height: 1.58;
        background-image: url(./nen4.png);
        background-size: 100%;
    }  */
    .site-login {
        background-image: url(images/nen.png);
        background-size: 100%;
        .container
        {
            
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
            .login-form
            {
                width: 600px;
                background-color: white;
                border: 0;
                padding: 15px 40px;
                box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
                border-radius: 15px;
            }
            h1
            {
                font-size: 30px;
                color: darkgreen;
                text-align: center;
                font-weight: 500;
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
                border: .1rem solid black;
                font-size: 1.7rem;
                width: 95%;
                padding: 12px 20px;
                outline: none;
                text-transform: none;
            }
            .form__button 
            {
                margin-bottom: 20px;
                margin-top: 30px;
            }
            .btn 
            {
                width: 95%;
                color: white;
                font-size: 1.7rem;
                /* font-size: 20px; */
                /* font-weight: bold; */
                border: 0;
                border-radius: 5px;
                padding: 1.5rem 0;
            }
            .btn_sendemail:hover
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
        }
    } 

</style>