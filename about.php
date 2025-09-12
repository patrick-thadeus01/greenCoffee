<?php
    include "components/connexion.php";
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header("location: login.php");
    }
?>
<style type="text/css">
    <?php 
        include "style.css";
    ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="script" href="js/all.js">
    <script src="https://cdnjs.clouflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <title>Green coffe - about us page</title>
</head>
<body>
    <?php include "components/header.php"; ?>
    <div class="main">
    
        <div class="banner">
            <h1>about us</h1>
        </div>
        <div class="title2">
            <a href="home.php">home </a><span>about</span>
        </div>
        <div class="about-category">
            <div class="box">
                <img src="img/3.webp">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_products.php" class = "btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="img/about.png">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon Teaname</h1>
                    <a href="view_products.php" class = "btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="img/2.webp">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon Teaname</h1>
                    <a href="view_products.php" class = "btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="img/1.webp">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_products.php" class = "btn">shop now</a>
                </div>
            </div>
        </div>
        <section class = "services">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>why choose us</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architeto dolorum desrum minus 
                    viniam tenetur
                </p>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="img/icon2.png">
                    <div class="detail">
                        <h3>great savings</h3>
                        <p>save big every order</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon1.png">
                    <div class="detail">
                        <h3>24*7 support</h3>
                        <p>one-on-one support</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon0.png">
                    <div class="detail">
                        <h3>gift vouchers</h3>
                        <p>vouchers on every festivals</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon.png">
                    <div class="detail">
                        <h3>worlwide delivery</h3>
                        <p>dropship delivery</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="about">
            <div class="row">
                <div class="img-box">
                    <img src="img/3.png" alt="">
                </div>
                <div class="detail">
                    <h1>visit our beautifull showroom!</h1>
                    <p>Our showroom is an expression of what we love doing; beeing creative with 
                        floral and plant arrangement. Wheter you are looking for a florist for your perfect wedding,
                        or just want to uplift any room with some one of a kind living decor, royalpat can help.
                    </p>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <div class="testimonial-container">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>what people say about us</h1>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architeto dolorum desrum minus 
                    viniam tenetur
                </p>
            </div>
                <div class="container">
                    <div class="testimonial-item active">
                        <img src="img/01.jpg" alt="">
                        <h1>Sara Smith</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
                             ieusmod tempor incididunt ut labor et dolor magna aliqua. Ut enim 
                             ad minim veniam, quid nostrud exercitation ullamco laboris nisi
                             ut adiliquip
                             ex ea commodo consequant.
                        </p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/02.jpg" alt="">
                        <h1>john Smith</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
                             ieusmod tempor incididunt ut labor et dolor magna aliqua. Ut enim 
                             ad minim veniam, quid nostrud exercitation ullamco laboris nisi
                             ut adiliquip
                             ex ea commodo consequant.
                        </p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/03.jpg" alt="">
                        <h1>Selena asari</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
                             ieusmod tempor incididunt ut labor et dolor magna aliqua. Ut enim 
                             ad minim veniam, quid nostrud exercitation ullamco laboris nisi
                             ut adiliquip
                             ex ea commodo consequant.
                        </p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/04.png" alt="">
                        <h1>alwena smith </h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
                             ieusmod tempor incididunt ut labor et dolor magna aliqua. Ut enim 
                             ad minim veniam, quid nostrud exercitation ullamco laboris nisi
                             ut adiliquip
                             ex ea commodo consequant.
                        </p>
                    </div>
                    <div class="left-arrow" onclick = "nextSlide()"><i class="fas fa-arrow-left"></i></div>
                    <div class="right-arrow" onclick = "prevSlide()"><i class="fas fa-arrow-right"></i></div>
                </div>
        </div>
        <?php include "components/footer.php";  ?>
    </div>
    
    <?php include "components/alert.php";  ?>    
</body> 
</html>   
