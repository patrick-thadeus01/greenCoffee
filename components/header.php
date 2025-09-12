<header class="header">
    <div class="flex">
        <a href="home.php" class="logo"><img src="img/logo.jpg"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="view_products.php">products</a>
            <a href="order.php">orders</a>
            <a href="about.php">about us</a>
            <a href="contact.php">contact us</a>
        </nav>
        <div class="icons">
            <i class ="fas fa-user" id ="user-btn"></i>
            <?php
                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?")->execute([$user_id]);
                echo($count_wishlist_items);
                 //$total_wishlist_items = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn"><i class="fas fa-heart"></i><sup><? =$count_wishlist_items->rowCount(); ?>
            </sup></a>
            <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                //$total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn"><i class="fas fa-cart-shopping"></i></span><sup><?=$count_cart_items->rowCount(); ?>
            </sup></a>
            <i class="fas fa-list" id="menu-btn" style = "font-size: 2rem;"></i>
        </div>
        <div class="user-box"> 
            <p>username : <span><?php print($_SESSION['user_name']);  ?></span></p>
            <p>email : <span><?php print($_SESSION['user_email'])  ; ?></span></p>
            <a href="login.php" class = "btn" style = "color: #000;">login</a>
            <a href="register.php" class="btn" style = "color: #000;">register</a>
            <form method="post">
                <button type="submit" name="logout" class="logout-btn">logout</button>
            </form>
        </div>
    </div>
</header>