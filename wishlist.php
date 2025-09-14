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

    
    //adding products in cart
    if (isset($_POST['add_to_wishlist'])) {
        $id = uniqid();
        $product_id = $_POST['product_id'];
        
        $qty = 1;
        $qty = filter_var($qty, FILTER_SANITIZER_STRING);


        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
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

            $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)")->execute([$id, $user_id, $product_id, $price, $qty]);
            
            $success_msg[]='product added to cart successfully';
        }

    }

    //delete item from wishlist
    if (isset($_POST['delete_item'])) {
        $wishlist_id = $_POST['wishlist_id'];
        $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZER_STRING);

        $verify_delete_items = $conn->prepare("SELECT * FROM `wishlist` WHERE id = ?");
        $verify_delete_items->execute([$wishlist_id]);

        if ($verify_delete_items->rowCount()>0) {
            $delete_wishlist_items = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
            $delete_wishlist_items->execute([$wishlist_id]);
            $success_msg[] = 'wishlist item delete successfully';
        }else {
            $warning_msg = 'wishlist item allready deleted';
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
    
    <title>Green coffee - wishlist page</title>
</head>
<body>
    <?php include "components/header.php"; ?>
    <div class="main">
    <div class="banner">
        +
            <h1>my wishlist</h1>
        </div>
        <div class="title2">
            <a href="home.php">home</a> /<span>wishlist</span>
        </div>
        <section class="products">
           <h1 class="title">products addded successfully in wishlist</h1>
           <div class="box-container">
                <?php 
                    $grandd_total = 0;
                    $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                    $select_wishlist->execute([$user_id]);
                    if ($select_wishlist->rowCount()>0) {
                        while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_products->execute([$fetch_wishlist['product_id']]);
                            
                            if ($select_products->rowCount()>0) {
                                $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                            
                ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="wishlist_id" value="<?=$fetch_wishlist['id']; ?>">
                <img src="image/<?=$fetch_products['image'];?>" alt="">
                <div class="button">
                <button type="submit" name="add_to_cart"><i class="fas fa-cart"></i></button>    
                <a href="view_page.php?pid=<?php echo $fetch_proucts['id']; ?>" cllass="fas fa-show"></a>
                <button type="submit" name="delete_item" onclick="return confirm('delete this item');"><i class="fas fa-x"></i></button>    
            </div>
            <h3 class="name"><?=$fetch_products['name'];?></h3>
            <input type="hidden" name="product_id" value="<?=$fetch_products['id'];?>">
            <div class="flex">
                <p class="price">price $<?=$fetch_products['price'];?>-/</p>
        
            </div>
            <a href="checkout.php?get_id=<?$fetch_proucts['id'];?>" class="btn">buy now</a>

        </form>
           
            <?php  
                        $grandd_total = $fetch_wishlist['price'];
                        }
                    }
        
                }else {
                    echo '<p class="empty">no product added yet!</p>';
                }
            ?>
            </div>
        </section>
        
        <?php include "components/footer.php";  ?>
    </div>
    <script src="https://cdnjs.clouflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include "components/alert.php";  ?>
</div>



<div class="fb3 building-wrap">
        <div class="fb3a window-wrap">
          <div class="fb3-window"></div>
          <div class="fb3-window"></div>
          <div class="fb3-window"></div>
        </div>
        <div class="fb3b"></div>
        <div class="fb3a"></div>
        <div class="fb3b"></div>
      </div>
      <div class="fb4">
        <div class="fb4a"></div>
        <div class="fb4b">
          <div class="fb4-window"></div>
          <div class="fb4-window"></div>
          <div class="fb4-window"></div>
          <div class="fb4-window"></div>
          <div class="fb4-window"></div>
          <div class="fb4-window"></div>
        </div>
      </div>
      <div class="fb5"></div>
      <div class="fb6"></div>
      <div></div>
      <div></div>