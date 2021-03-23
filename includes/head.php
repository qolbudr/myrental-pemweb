<?php 
    require dirname(__FILE__).'/../functions/url_helper.php';
    require dirname(__FILE__).'/../functions/database.php';
    session_start();
?>
<!doctype html>
<html>

  <head>
    <title>MyRental - Online car rental service for your trip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $url->myurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $url->myurl ?>/assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= $url->myurl ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $url->myurl ?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin=""/>
    <link rel="manifest" href="<?= $url->myurl ?>/manifest.json">
    <link rel="icon" href="assets/images/icon.png" />
    <link rel="apple-touch-icon" sizes="512x512" href="assets/images/icon-512x512.png"/>
    <link rel="apple-touch-icon" sizes="384x384" href="assets/images/icon-384x384.png"/>
    <link rel="apple-touch-icon" sizes="192x192" href="assets/images/icon-192x192.png"/>
    <link rel="apple-touch-icon" sizes="256x256" href="assets/images/icon-256x256.png"/>

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?= $url->myurl ?>/assets/css/main.css">
    <style>
    	.menu-mobile {
    		list-style: none; 
    		display: inline;
    	}

    	.menu-mobile li {
    		margin-bottom: 10%;
    	}

    	.menu-mobile a {
    		text-decoration: none;
    		color: black;
    	}
    </style>
  </head>

    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="preloader">
      <div class="loading">
        <img src="<?= $url->this('/assets/images/loader.gif') ?>">
      </div>
    </div>

    <div class="left-menu p-4 font-size-18">
      <div class="text-right">
        <i class="cursor-pointer close-menu font-size-20 lnr lnr-cross"></i>
      </div>
      <div class="text-left">
      	<ul class="menu-mobile">
      		<li><a href="<?= $url->myurl ?>">Home</a></li>
            <li><a href="<?= $url->this('/cars?q=surabaya-kota-surabaya-jawa-timur-indonesia') ?>">Cars</a></li>
            <?php if($_SESSION['user_status'] ?? '' == 'authorized') { ?>
              <?php if($_SESSION['user_type'] == 0) { ?>
                <li><a href="<?= $url->this('/account/user/clientarea') ?>">My Account</a></li>
              <?php } else { ?>
                <li><a href="<?= $url->this('/account/owner/clientarea') ?>">My Account</a></li>
              <?php } ?>
              <li><a href="<?= $url->this('/backend/logout.php') ?>">Logout</a></li>
            <?php } else { ?>
            <li><a href="<?= $url->this('/register') ?>">Register</a></li>
            <li><a href="<?= $url->this('/login') ?>">Login</a></li>
            <?php } ?>
      	</ul>
      </div>
    </div>
    <header class="w-100 text-white">
      <div class="container my-5">
        <div class="row font-size-16">
          <div class="col-6 text-left">
            MYRENTAL
          </div>
          <div class="col-6 text-right">
            <div>
              <ul class="nav-link m-0 p-0">
                <li><a href="<?= $url->myurl ?>">Home</a></li>
                <li><a href="<?= $url->this('/cars?q=surabaya-kota-surabaya-jawa-timur-indonesia') ?>">Cars</a></li>
                <?php if($_SESSION['user_status'] ?? '' == 'authorized') { ?>
                  <?php if($_SESSION['user_type'] == 0) { ?>
                    <li><a href="<?= $url->this('/account/user/clientarea') ?>">My Account</a></li>
                  <?php } else { ?>
                    <li><a href="<?= $url->this('/account/owner/clientarea') ?>">My Account</a></li>
                  <?php } ?>
                  <li><a href="<?= $url->this('/backend/logout.php') ?>">Logout</a></li>
                <?php } else { ?>
                <li><a href="<?= $url->this('/register') ?>">Register</a></li>
                <li><a href="<?= $url->this('/login') ?>">Login</a></li>
                <?php } ?>
              </ul>
              <ul class="nav-link-m m-0 p-0">
                <li>
                  <a class="open-menu" href="javascript:void(0)">
                    <i class="lnr lnr-menu"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>