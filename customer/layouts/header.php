<?php
include 'function/customer_function.php';

session_start();

$user = get_customer_data($_SESSION['customer']['id']);
?><!DOCTYPE html>
<html lang="ID-id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Customer</title>
  
    <link rel="stylesheet" href="../css/all.min.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/tempusdominus-bootstrap-4.min.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/adminlte.min.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/toastr.min.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/datepicker.min.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/select2.min.css" type="text/css" media="screen"/>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
    <form class="form-inline ml-3" action="search.php" method="GET">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" value="" name="query" placeholder="Cari order..." aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
            </div>
          </div>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php">
      
      <h3 align="center">Karya Taman Alam</h3>
    </a>
	
	

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="customer_gambar/<?php echo $user['profile_picture']; ?>" class="img-circle elevation-2" alt="Foto profil <?php echo $user['name']?>">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $user['name'] ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dasbor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="order.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Order Saya
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pembayaran.php" class="nav-link">
              <i class="nav-icon fa fa-money-bill"></i>
              <p>
                Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="review.php" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Review
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>