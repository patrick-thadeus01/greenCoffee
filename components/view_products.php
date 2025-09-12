<?php
    include "../components/connexion.php";
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
    <link rel="stylesheet" href="css/brands.css">
    <link rel="script" href="js/all.js">
    
    <title>shop page</title>
</head>
<body>
    <?php include "../components/header.php"; ?>
    <div class="main">
    <div class="banner">
            <h1>shop</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a><span>our shop</span>
        </div>
        <section class="products">
            <div class="box-container">
            <?php
                $select_products = $conn->prepare("SELECT * FROM 'proucts'");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_proucts = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        
                    }
                }
            ?>  
            <form action="" method="post" class="box">
                <img src="img/<? = $fetch_proucts->fetch['image']; ?>" class="img">
            </form>
            </div>
        </section>
        
        <?php include "components/footer.php";  ?>
    </div>
    <script src="https://cdnjs.clouflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include "components/alert.php";  ?>
</div>
