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

    //adding products in wishllist
    if (isset($_POST['add_to_wishlist'])) {
        $id = uniqid();
        $product_id = $_POST['product_id'];
        
        $verify_wishlist = $conn->prepare("SELECT * FROM `wislist` WHERE user_id = ? AND product_id = ?");
        $verify_wishlist->execute([$user_id, $product_id]);
        var_dump($verify_wishlist);

        $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
        $cart_num->execute([$user_id, $product_id]);
        var_dump($cart_num);
        
        if ($verify_wishlist->rowCount() > 0) {
            $warning_msg[] = 'product already exist in your wishlist';
        }else if ($cart_num->rowCount() > 0) {
            $warning_msg[] = 'product already exist in your cart';
        }else{
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND LIMIT = 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);
            var_dump($select_price);

            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES(?,?,?,?)");
            $insert_wishlist->execute([$id,$user_id,$product_id,$price]);
            var_dump($insert_wishlist);
            $success_msg[]='product added to wishlist successfully';
        }

    }
    //adding products in cart
    if (isset($_POST['add_to_wishlist'])) {
        $id = uniqid();
        $product_id = $_POST['product_id'];
        
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZER_STRING);


        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE u²ser_id = ? AND product_id = ?");
        $verify_cart->execute([$user_id, $product_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $max_cart_items->execute([$user_id]);
        
        if ($verify_cart->rowCount() > 0) {
            $warning_msg[] = 'product already exist in your cart';
        }else if ($max_cart_items->rowCount() > 20) {
            $warning_msg[] = 'cart is full';
        }else{
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND LIMIT = 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
            $insert_cart->execute([$id, $user_id, $product_id, $price, $qty]);
            $success_msg[]='product added to cart successfully';
        }

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
    
    <title>product detail page</title>
</head>
<body>
    <?php include "components/header.php"; ?>
    <div class="main">
    <div class="banner">
            <h1>product detail</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a> /<span> product detail</span>
        </div>
        <section class="view_page">
           <?php 
                if (isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = '$pid'");
                    $select_products->execute();
                    if ($select_products->rowCount()>0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC) ) {
                            
                        
            */?> 
            <form action="" method="post">
                <img src="image/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="detail">
                    <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail">
                    <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
                             ieusmod tempor incididunt ut labor et dolor magna aliqua. Ut enim 
                             ad minim veniam, quid nostrud exercitation ullamco laboris nisi
                             ut adiliquip
                             ex ea commodo consequant.
                        </p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_wishlist" class="btn">add to wishlist<i class="fas fa-heart">
                        </i></button>
                        <input type="hidden" name="qty" value="1" min="0" class="quantity">
                        <button type="submit" name="add_to_cartt" class="btn">add to wishlist<i class="fas fa-cart">
                        </i></button>
                    </div>
                </div>
            </form>
            <?php 

                        }
                    }
                }
            ?>
        </section>
        
        <?php include "components/footer.php";  ?>
    </div>
    <script src="https://cdnjs.clouflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include "components/alert.php";  ?>
</div>
