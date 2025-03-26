


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>Đổi mật khẩu</title>
    </head>
    <body >
        <?php include "header.php" ?>
        <main class="site-register">
            <div class="container">
                <!-- <div class="checkout__main">
                    <div class="checkout__information"> -->
                        <div class="form">
                            <h1 class="heading">Đổi mật khẩu</h1>
                            <form method="POST" action="Change_password_proccess.php">
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>

                                <?php if (isset($_GET['success'])) { ?>
                                    <p class="success"><?php echo $_GET['success']; ?></p>
                                <?php } ?>
                                <!-- <input type="hidden" name="_token" value="ECDLEuPSINMfXIN1EIzlxVe3mejbhdjs6rqUD3V9">                     -->
                                <!-- <div class="form_field"style="margin-bottom: 2rem;">
                                    <input type="email" class="form__control form__control--full" name="email" placeholder="Email của bạn" required="" autofocus="" value="" fdprocessedid="nvvewt">
                                </div> -->
                                <div class="form__row--inline">
                                    <div class="form__field">
                                        <input type="password" class="form__control form__control--full" name="new_password" placeholder="Nhập mật khẩu mới(*)" required="" autofocus="" fdprocessedid="k0gogf">
                                    </div><br>
                                    <div class="form__field">
                                        <input type="password" class="form__control form__control--full" name="password_confirmation" placeholder="Nhập lại mật khẩu mới(*)" required="" autofocus="" fdprocessedid="hig4ae">
                                    </div>
                                </div><br>
                                    <div class="form__field change_password"> 
                                        <button name = "btnLogin" type="submit" class="btn btn_login" fdprocessedid="32hjr" style="background-color: #3e6807;"><a href="Dang_nhap.php">Đăng nhập</a>    
                                        </button>
                                        <button type="submit" class="btn btn--primary btn--register one-whole" fdprocessedid="2wvjp" name="btn_Change_password">Đổi mật khẩu
                                        <!-- <span class="register-loader hide" style="width: 24px; margin-bottom: -4px;"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-spinner" viewBox="0 0 20 20"><path d="M7.229 1.173a9.25 9.25 0 1 0 11.655 11.412 1.25 1.25 0 1 0-2.4-.698 6.75 6.75 0 1 1-8.506-8.329 1.25 1.25 0 1 0-.75-2.385z" fill="#9B9B9B"></path></svg></span> -->
                                        </button>
                                    </div>
                                <!-- </div> -->
                            </form>
                        </div>
                    <!-- </div>
                </div> -->
            </div>
        </main>
        <?php include "footer.php" ?>
    </body>
</html>
<style>
    .site-register
    {
        background-image: url(images/nen.png);
        background-size: 100%;
        font-size: 3rem;
        .container
        {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
            .form
            {
                width: 600px;
                background-color: white;
                padding: 15px 40px;
                box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
                border-radius: 15px;
                text-align: center;
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
            input
            {
                border: .1rem solid black;
                font-size: 1.7rem;
                text-transform: none;
                width: 95%;
                padding: 1.5rem 3rem;
                outline: none;
            }
            .btn
            {
                border: 1px solid black;
                border-radius: 6px;
                padding: 13px 50px;
                background-color: #3e6807;
                color: white;
                font-size: 1.7rem;
            }
            .btn:hover
            {
                color: yellowgreen;
                transition: all 0.3s;
            }
            .error
            {
                text-transform: none;
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
                text-transform: none;
                font-size: 1.7rem;
                background: #D4EDDA;
                color: #40754C;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin: 20px auto;
            }
            .change_password a{
                text-decoration: none;
                color: white;
            }
            .change_password a:hover{
                color: yellowgreen;
                transition: all 0.3s;
            }
        }
    }

</style> 