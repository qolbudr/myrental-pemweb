<?php
  require 'functions/url_helper.php';
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
  <link rel="icon" type="image/png" href="<?= $url->this('/assets/images/icon.png') ?>">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="<?= $url->myurl ?>/assets/css/main.css">
  <style type="text/css">
      body {
        background-color: #f6f5f5;
      }

      .form-login {
          background-color: white;
          width: 30vw;
          margin: 10vh auto;
      }

      .banner-half {
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        height: 100%;
        width: 100%;
      }

      .overlay {
        position: relative;
        width: 100%;
        height: 100%;
        z-index: 999;
        background-color: #000000d4;
      }

      .no-gutters {
        margin: 0px !important;
      }

      .greeting {
        margin: 40vh 50px;
        position: absolute;
        max-width: 450px;
        word-wrap: break-word;
      }

      .spacer {
        border-top: .3px solid white;
        width: 200px;
      }

      @media (max-width: 768px) {
        .form-login {
          width: 100%;
          margin: 10vh auto;
        }
      }

      .preloader {
          width: 100vw;
          height: 100vh;
          position: fixed;
          z-index: 9999999;
          top:0;
          left:0;
          background-color: black;
        }

        .preloader .loading {
          text-align: center;
        }

        .loading img {
          width: 200px;
          margin-top: 40vh
        }


  </style>

</head>