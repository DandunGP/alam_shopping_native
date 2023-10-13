<?php
    require 'function/register.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>Buat Akun</title>

    <link href="css/register/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="css/register/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <link href="css/register/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="css/register/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link href="css/register/css/main7.css" rel="stylesheet" media="all">

    <style>
        .input--style-2:hover {
            border-bottom: 1px solid #FA4251;
            color: #4DAE3C
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Buat Akun</h2>
                    <form action="" method="post">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" placeholder="Username" minlength="4" maxlength="16" name="username" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="password" placeholder="Password" name="password" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Nama lengkap" name="name" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" placeholder="No. HP" minlength="9" maxlength="15" name="phone_number" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" minlength="10" type="email" placeholder="Email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Alamat" name="address" required>
                        </div>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="submit">Daftar</button>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            register();
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>