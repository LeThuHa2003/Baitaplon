<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="../Login/images/favicon.png">
        <title>Đăng nhập - Admin</title>
    </head>
    <body >
    <main class="site-login">
            <div class="container">
                <div class="login-form">
                <div class="image">
                    <img src="nen.jpg" alt="" height="400rem" width="350rem">
                </div>
                <div class="form">
                <h1 class="heading">Đăng nhập</h1>
                  <form method="POST" action="login_process.php" id="login-from">
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
                      <input type="text" class="form__control" name="adminname" placeholder="Tên đăng nhập" required="" autofocus="" value="" fdprocessedid="nvvewt">
                    </div><br>
                    <div class="form_field">
                      <input type="password" class="form__control form__control--full" name="password" placeholder="Nhập mật khẩu" required="" autofocus="" fdprocessedid="qdx8y">
                    </div><br>
                    <div class="form__button"> 
                      <button name="btnLogin" type="submit" class="btn btn_login" fdprocessedid="32hjr" style="background-color: #3e6807;">
                        Đăng nhập
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </main>
    </body>
</html>

<style>
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

    .site-login {
        background-image: url("../Login/images/nen.png");
        background-size: 100%;
        font-size: 3rem;
        .container
        { 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
            
            .image img{
                border-radius: 5rem;
                margin-right: 5rem;
            }
            .login-form
            {
                /* background-color: #40754C; */
                display: flex;
                /* width: 650px; */
                /* width: 100rem; */
                background-color: #D4EDDA;
                border: 0;
                padding: 5rem 7rem;
                box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
                border-radius: 15px; 
            }
        
            h1
            {
                font-size: 3rem;
                color: darkgreen;
                text-align: center;
                font-weight: 350;
            }
            h1.heading 
            {
                padding: 2rem 4rem 4rem 4rem;
                /* padding: 4rem; */
            }
            .form 
            {
                margin-top: 2rem;
                width: 40rem;
                text-align: center;
            }
            input
            {
                border-bottom: .1rem solid #999;
                font-size: 1.7rem;
                text-transform: none;
                width: 100%;
                padding: 1.5rem 0 1.5rem 1rem;
                outline: none;
                text-transform: none;
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
                /* margin: 1rem auto; */
                margin: -20px auto 20px auto;
            }
            .success 
            {
                font-size: 1.7rem;
                background: #D4EDDA;
                color: #40754C;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin: -20px auto 20px auto;
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