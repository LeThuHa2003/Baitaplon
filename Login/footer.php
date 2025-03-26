<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Footer</title>
    </head>
    <body >
        <!-- Footer section starts -->
    <section class="footer">
        <div class="box-container">
            <div class="box-footer" id="tien">
                <h3>nguyễn minh tiến</h3>
                <li><i class="fas fa-cake"></i><span>05/08/2003</span></li>
                <li><i class="fas fa-phone"></i><span>096-418-4617</span></li>
                <li><i class="fa-brands fa-square-facebook"></i><span>Tiến</span></li>
                <li><i class="fas fa-envelope"></i><span>Tiến</span></li>
            </div>

            <div class="box-footer" id="huonng">
                <h3>nguyễn thị lan hương</h3>
                <li><i class="fas fa-cake"></i><span>13/01/2003</span></li>
                <li><i class="fas fa-phone"></i><span>096-418-4617</span></li>
                <li><i class="fa-brands fa-square-facebook"></i><span>Hương</span></li>
                <li><i class="fas fa-envelope"></i><span>Hương</span></li>
            </div>

            <div class="box-footer" id="ha">
                <h3>lê thu hà</h3>
                <li><i class="fas fa-cake"></i><span>30/12/2003</span></li>
                <li><i class="fas fa-phone"></i><span>096-418-4617</span></li>
                <li><i class="fa-brands fa-square-facebook"></i><span>Hà</span></li>
                <li><i class="fas fa-envelope"></i><span>Hà</span></li>
            </div>
        </div>
    </section>
    <!-- footer section ends -->
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
    section{
        /* padding: 1.5rem 9%; */
        padding: 1.5rem 12%;
    }
    section.footer {
        margin-top: 3rem;
        background: #3e6807;
    }
    .footer .box-container{
        color: white;
        display: flex;
        /* flex-wrap: wrap; */
        justify-content: space-between;
        /* gap: 1.5rem; */

    }
    .footer .box-container .box-footer{
        text-align: center;
        margin-left: 6.5rem;
        /* flex: 1 1 25rem; */
    }
    .footer .box-container .box-footer h3{
        font-size: 2.2rem;
        padding: 1rem 0;
    }
    .footer .box-container .box-footer li{
        text-align: left;
        list-style: none;
        font-size: 1.5rem;
    }
    .footer .box-container .box-footer i{
        /* margin-right: 2rem; */
        font-size: 2.2rem;
        padding: 1rem 0;
    }
    /* .footer .box-container #tien li{
        margin-left: 9rem;
    }
    .footer .box-container #ha li{
        margin-left: 15rem;
    } */
    li span{
        margin-left: 2rem;
    }


    /* media queries */
@media (max-width: 991px){
    html{
        font-size: 55%;
    }
    .footer .box-container .box-footer h3{
        font-size: 2.3rem;
    }
    .footer .box-container #tien li{
        margin-left: 5rem;
    }
    .footer .box-container #ha li{
        margin-left: 10rem;
    }
}

@media (max-width: 768px){
    .footer .box-container .box-footer h3{
        font-size: 2rem;
    }
    .footer .box-container .box-footer li{
        font-size: 1.5rem;
    }
}
@media (max-width: 450px){
    .footer .box-container .box-footer h3{
        font-size: 1.5rem;
    }
    .footer .box-container .box-footer li{
        font-size: 1rem;
    }
}
</style>
