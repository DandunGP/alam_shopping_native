<?php 
    require 'function/login.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="id-ID">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Karya Taman Alam </title>

        <link href="css/login.css" rel="stylesheet" type="text/css" />
        <link href="css/font.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>
    <body>
        <h1>Login ke <a href="#">Karya Taman Alam</a></h1>
        <div class=" w3l-login-form">
            <h2>Login Akun</h2>
            <?php if (isset($_SESSION['errorNotFound']) && $_SESSION['errorNotFound'] == true) : ?>
            <div class="flash-message">
                <?php echo "Username tidak ditemukan"; ?>
            </div>
            <?php elseif (isset($_SESSION['errorNotMatch']) && $_SESSION['errorNotMatch'] == true) : ?>
            <div class="flash-message">
                <?php echo "Password yang anda masukkan salah"; ?>
            </div>
            <?php endif; ?>
            <form action="" method="post">
            <div class=" w3l-form-group">
                <label>Username:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" class="form-control" placeholder="Username" minlength="4" maxlength="16" required>
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" name="submit">Login</button>
            </form>
            <?php
                if(isset($_POST['submit'])){
                   login();
                }
            ?>
        </div>

        <footer>
            <p class="copyright-agileinfo"> &copy; 2023 <a href="#">Karya Taman Alam</a></p>
        </footer>

        <script src="https://kit.fontawesome.com/8d85ff5c78.js" crossorigin="anonymous"></script>
    </body>
</html>