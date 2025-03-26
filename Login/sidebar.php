<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side bar</title>
</head>
<body>
    <div id="sidebar">
        <a id = "home" href="Trangchu.php" >Trang chủ</a> 
        <!-- style="margin-top: 15rem; justify-content: center;" -->
        <a href="CMsale.php">Sale</a>
        <a href="CMTD.php">Trang điểm</a>
        <a href="CMCSD.php">Chăm sóc da</a>
        <a href="CMCST.php">Chăm sóc tóc</a>
        <a href="Lien_he.php">Liên hệ</a>
    </div>
</body>
</html>
<style>
    #sidebar
    {
        color: yellow; 
        color: pink; 
        background: #3e6807; 
        display: grid; 
        width: 35rem;
        text-align: center;
        height: 65rem;
    }
    #sidebar a{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-decoration: none;
        /* line-height: 1.5rem; */
        color: #fff;
        /* padding: .5rem 0; */
        transition: 0.4s;
        font-size: 2rem;        
    }
    #sidebar a:hover{
        background: #32CD32	;
        color: pink;
        transform: scale(1.03);
    }
    #home{
        margin-top: 15rem;
    }
    

    @media (max-width: 1376px){
        #sidebar{
            width: 30rem;     
            height: 49rem;
        }
        #sidebar a{
            font-size: 1.6rem;
            padding: .5rem 0;
        }
        #home{
            margin-top: 12rem;
        }
    }
    @media (max-width: 1024px){
        #sidebar{
            width: 23rem;     
            height: 38.55rem;
        }
        #sidebar a{
            font-size: 1.6rem;
            padding: 0;
        }
        #home{
            margin-top: 15rem;
        }
    }


    @media (max-width: 991px){
        #sidebar{
            width: 25rem;   
            height: 41.42rem;  
        }
        #sidebar a{
            font-size: 1.6rem;
            padding: .5rem 0;
        }
        #home{
            margin-top: 12rem;
        }
    }
    @media (max-width: 768px){
        #sidebar{
            height: 31.55rem;
        }
        #sidebar a{
            font-size: 1.5rem;
            padding: .5rem 0;
        }
        #home{
            margin-top: 11rem;
        }
    }

    @media (max-width: 660px){
        #sidebar{
            width: 14rem;   
            height: 30.02rem;  
        }
        #sidebar a{
            font-size: 1.1rem;
            padding: .5rem 0;
        }
        #home{
            margin-top: 10rem;
        }
    }

    @media (max-width: 450px){
        #sidebar{
            width: 14rem;   
            height: 23rem;  
        }
        #sidebar a{
            font-size: 1rem;
            padding: .3rem 0;
        }
    }
    @media (max-width: 390px){
        #sidebar{
            width: 14rem;   
            height: 22rem;  
        }
        #sidebar a{
            font-size: 1rem;
            padding: .2rem 0;
        }
    }
</style>

