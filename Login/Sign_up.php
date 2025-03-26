<?php 
    error_reporting(0);
    session_start();
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
    $phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
    session_unset();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="stylesheet" href="./fontawesome-free-6.5.1-web/fontawesome-free-6.5.1-web/css/all.css">
        <title>Đăng ký</title>
    </head>
    <body >
        <?php include "header.php"; ?>
        <main class="site-register">
            <div class="container">
                <!-- <div class="checkout__main">
                    <div class="checkout__information"> -->
                        <div class="form">
                            <h1 class="heading">Đăng Ký Tài khoản</h1>
                            <form method="POST" action="Sign_up_check.php">
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>

                                <?php if (isset($_GET['success'])) { ?>
                                    <p class="success"><?php echo $_GET['success']; ?></p>
                                <?php } ?>
                                <!-- <input type="hidden" name="_token" value="ECDLEuPSINMfXIN1EIzlxVe3mejbhdjs6rqUD3V9">                     -->
                                <div class="form__row">
                                    <div class="form__field">
                                        <input type="text" class="form__control form__control--full" autofocus="" name="user" required="" placeholder="Tên tài khoản (*)" value="<?php echo htmlspecialchars($username); ?>" fdprocessedid="hd5fms">
                                    </div>
                                </div><br>
                                <div class="form__row">
                                    <div class="form__field">
                                        <input type="text" class="form__control form__control--full" name="phone" placeholder="Số điện thoại (*)" required="" value="<?php echo htmlspecialchars($phone); ?>" fdprocessedid="7ipa1f">
                                    </div>
                                </div><br>
                                <div class="form__row">
                                    <div class="form__field">
                                        <input type="email" class="form__control form__control--full" name="email" placeholder="Email (*)" required="" autofocus="" value="<?php echo htmlspecialchars($email); ?>" fdprocessedid="fzpd1zj">
                                    </div>
                                </div><br>
                                <div class="form__row">
                                    <div class="form__field" >
                                        <input type="text" class="form__control form__control--full" name="address" placeholder="Địa chỉ" autofocus="" value="<?php echo htmlspecialchars($address); ?>" fdprocessedid="fzpd1zk">
                                    </div>
                                </div><br>
                                <div class="form__row--inline">
                                    <div class="form__field">
                                        <input type="password" class="form__control form__control--full" name="password" placeholder="Nhập mật khẩu (*)" required="" autofocus="" fdprocessedid="k0gogf">
                                    </div><br>
                                    <div class="form__field">
                                        <input type="password" class="form__control form__control--full" name="password_confirmation" placeholder="Nhập lại mật khẩu (*)" required="" autofocus="" fdprocessedid="hig4ae">
                                    </div>
                                </div><br>
                                <!-- <div class="form__inner form--button grid--aligned-center"> -->
                                    <div class="form__field " id="btn" >
                                        <button class="button"><a href="Dang_nhap.php" class="text--primary one-whole mobile--hidden" style="font-size: 18px;">Về trang đăng nhập</a></button>
                                        <!-- <a href="logintheomau.html" class="text--primary one-whole tablet--hidden large--hidden desk--hidden">Đăng nhập</a> -->
                                    <!-- </div>
                                    <div class="form__field register"> -->
                                        <button type="submit" class="btn btn--primary btn--register one-whole" fdprocessedid="2wvjp" style="font-size: 18px;">Đăng ký
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
        text-decoration: none; */
        /* background-image: url(images/nen.png);
        background-size: 100%; */
    /* }  */
    .site-register
    {
        background-image: url(images/nen.png);
        background-size: 100%;
        padding: 8rem 0;
        font-size: 3rem;
        .container
        {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
            .form
            {
                width: 650px;
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
                font-size: 1.7rem;
                padding: 1.5rem 3rem;
                width: 95%;
                outline: none;
                border: .1rem solid black;
                text-transform: none;
            }
            a.text--primary.one-whole.mobile--hidden {
                color: white;
                text-decoration: none;
            }
            .button
            {
                background-color: #3e6807;
                border: 1px solid black;
                width: 290px;
                padding: 12.5px 45px 13.5px 45px;
                border-radius: 6px;
            }
            a.text--primary.one-whole.mobile--hidden:hover
            {
                color: yellowgreen;
                transition: all 0.3s;
            }
            .btn
            {
                /* font-weight: normal; */
                width: 190px;
                border: 1px solid black;
                padding: 13px 50px;
                background-color: #3e6807;
                border-radius: 6px;
                color: white;
            }
            .btn:hover
            {
                color: yellowgreen;
                transition: all 0.3s;
            }
            div#btn 
            {
                margin: 10px 0px 20px 0px;
            }
            .error
            {
                background: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin: 20px auto;
                font-size: 1.7rem;
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
        }
    }


    /* @media (max-width: 991px){
        .form{
            width: 500px;
        }
    }

    @media (max-width: 1328px){
    }


    @media (max-width: 768px){
    }
    @media (max-width: 450px){
        html{
            font-size: 50%;
        }
    } */


</style> 