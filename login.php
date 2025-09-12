<?php
    include "components/connexion.php";
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }
    //register user
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
        var_dump($select_user);

        if ($select_user->rowCount() > 0) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            header('location: home.php');
        }else {
            $message[] = 'incorrect username or password';
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
    <title>green tea - login now</title>
</head>
<body>
<div class="main-container">     
        <div class="title">
            <img src="img/download.png" class="logo">
            <h1>login now</h1>
            <p class="p">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architeto dolorum desrum minus 
            viniam tenetur
            </p>
        </div>      
    <section class = "form-container">
            
            <form method="post">
                <div class="input-field">
                    <p>your email <sub class="sup">*</sub></p>
                    <input type="email" name = "email" required placeholder="enter your email" maxlenght="50" oninput=
                    "this.value=this.value.replace(/\s\g, '')">
                </div>
                <div class="input-field">
                    <p>your password <sub class="sup">*</sub></p>
                    <input type="password" name = "pass" required placeholder="enter your password" maxlenght="50" oninput=
                    "this.value=this.value.replace(/\s\g, '')">
                </div>
                <input type="submit" name = "submit" value = "register now" class = "btn">
                <p>don't have an account ? <a href="register.php">register now</a></p>
            </form>
    </section>
</div>
</body>
</html>