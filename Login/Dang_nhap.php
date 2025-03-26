<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>Đăng nhập</title>
    </head>
    <body >
        <?php include "header.php" ?>
        <main class="site-login">
            <div class="container">
              <div class="login-form">
                <h1 class="heading">Đăng nhập</h1>
                <div class="form">
                  <form method="POST" action="login2.php" id="login-from">
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
                    <div class="form_field">
                      <input type="email" class="form__control" name="email" placeholder="Email của bạn" required="" autofocus="" value="" fdprocessedid="nvvewt">
                    </div><br>
                    <!-- <div class="form_field">
                      <input type="text" class="form__control" name="phone" placeholder="SDT của bạn" required="" autofocus="" value="" fdprocessedid="nvvewt">
                    </div><br> -->
                    <div class="form_field">
                      <input type="password" class="form__control form__control--full" name="password" placeholder="Nhập mật khẩu" required="" autofocus="" fdprocessedid="qdx8y">
                    </div><br>
                    <div class="gain_pass">
                      <a href="Forgot_password.php" class="form_link link">Quên mật khẩu</a>
                    </div>
                    <div class="form__button"> 
                      <button name = "btnLogin" type="submit" class="btn btn_login" fdprocessedid="32hjr" style="background-color: #3e6807;">
                        Đăng nhập
                      </button>
                    </div>
                    <p class="form__text text--center">
                      Bạn chưa có Tài khoản? Vui lòng đăng ký Tài khoản mới <a href="Sign_up.php" class="text--primary text-highLight_1 link">tại đây</a> .
                    </p>
                  </form>
                </div>
              </div>
            </div>
        </main>

        <?php include "footer.php" ?>
    </body>
</html>
<style>
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
            .login-form
            {
                /* width: 650px; */
                width: 65rem;
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
                border: .1rem solid black;
                font-size: 1.7rem;
                text-transform: none;
                width: 95%;
                padding: 1.5rem 3rem;
                outline: none;
                text-transform: none;
            }
            .gain_pass
            {
                text-align: left;
                margin: -10px 0 0 15px;
                
            }
            .form_link
            {
                font-size: 13px;
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
            .form__text {
                color: #6a6a69;
                font-size: 14px;
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
                text-transform: none;
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
                text-transform: none;
            }
            .link
            {
                color: blue;
                text-decoration: none;
                font-size: 1.8rem;
                font-weight: bold;
            }
            .link:hover
            {
                color: orange;
                transition: all 0.3s;
            }
        }
    } 

</style>