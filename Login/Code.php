<?php
    session_start();
    include "connect_db.php";
    // $email = $_POST['email'];
    if (isset($_POST['btn_Sendcode']))
    {
        $code = $_POST['code'];     // Lấy mã đặt lại mật khẩu từ dữ liệu gửi qua phương thức POST.
        $email = $_SESSION['email'];
        $str = "SELECT * FROM ThanhVien WHERE Code = '$code' AND Email = '$email'";
        // $role = $str[0]['VaiTro'];

        // Sử dụng prepared statements để tránh SQL injection
        // $stmt = $conn->prepare("SELECT * FROM ThanhVien WHERE Code = ? AND Email = ?");
        // $stmt->bind_param("ss", $code, $email);
        // $stmt->execute();
        // $result = $stmt->get_result();


        $result = mysqli_query($conn, $str);
        if (mysqli_num_rows($result) < 1)     // if (result->num_rows < 1)
        {
            header("Location: Code.php?error=Mã đã nhập không đúng!");
        }
        else
        {
            header("Location: Change_password.php");
        }
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>Code Verification</title>
    </head>
    <body >
        <?php include "header.php"; ?>
        <main class="site-login">
            <div class="container">
              <div class="login-form">
                <h1 class="heading">Code Verification</h1>
                <div class="form">
                  <form method="POST" action="Code.php" id="login-from">
                    <?php
                        if (isset($_GET['error']))
                        {?>
                            <p class = "error"><?php echo $_GET['error']; ?></p><?php

                        }
                    ?>
                    <div class="form_field">
                      <input type="text" class="form__control" name="code" placeholder="Mã code bạn đã nhận" required="" autofocus="" value="" fdprocessedid="nvvewt">
                    </div>
                    <div class="form__button"> 
                      <button name = "btn_Sendcode" type="submit" class="btn btn_sendcode" fdprocessedid="32hjr" style="background-color: #3e6807;">
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
                font-weight: 350;
            }
            h1.heading 
            {
                padding: 20px;
            }
            .form 
            {
                text-align: center;
                font-size: 1.7rem;
            }
            input
            {
                border: .1rem solid black;
                font-size: 1.7rem;
                text-transform: none;
                width: 95%;
                padding: 12px 20px;
                outline: none;
            }
            .form__button 
            {
                margin-bottom: 30px;
                margin-top: 30px;
            }
            .btn 
            {
                font-size: 1.7rem;
                color: white;
                border-radius: 5px;
                width: 95%;
                padding: 1.5rem 0;
            }
            .btn_sendcode:hover
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
        }
    } 

</style>