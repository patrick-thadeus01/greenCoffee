
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
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
        
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
        var_dump($select_user);

        if ($select_user->rowCount() > 0) {
            $message[] = 'email already exist';
            echo 'email already exist';
        }else{
            if ($pass != $cpass) {
                $message[] = 'confirm your password';
                echo 'confirm your password'; 
            }
            else{
                $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password) VALUES(?,?,?,?)");
                $insert_user->execute([$id, $name, $email, $pass]);
                var_dump($insert_user);
                header('location: home.php');
                $insert_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND 'password' = ?");
                $insert_user->execute([$email, $pass]);
                $row = $insert_user->fetch(pdo::FETCH_ASSOC);
                var_dump($insert_user);
    
                if ($select_user->rowCount() > 0) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                }
            }
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
    <title>green tea - register now</title>
</head>
<body>
<div class="form-container"> 
        
    <section class = "main-container">
            
            <form method="post">   
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>register now</h1>
                <p class="p">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architeto dolorum desrum minus 
                    viniam tenetur
                </p>
            </div>  
                <div class="input-field">
                    <p>your name <sub class="sup">*</sub></p>
                    <input type="text" name = "name" required placeholder="enter your name" maxlenght="50">
                </div>
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
                <div class="input-field">
                    <p>confirm pasword <sub class="sup">*</sub></p>
                    <input type="password" name = "cpass" required placeholder="confirm your password" maxlenght="50" oninput=
                    "this.value=this.value.replace(/\s\g, '')">
                </div>
                <input type="submit" name = "submit" value = "register now" class = "btn">
                <p>already have an account ? <a href="login.php">login now</a></p>
            </form>
    </section>
</div>
</body>
</html>