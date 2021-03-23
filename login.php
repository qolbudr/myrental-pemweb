<?php

require 'includes/head_login.php';
session_start();

if($_SESSION['user_status'] ?? '' == 'authorized') {
  header("location: ".$url->myurl);
}

?>
  <body class="dark" data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="preloader">
      <div class="loading">
        <img src="<?= $url->this('/assets/images/loader.gif') ?>">
      </div>
    </div>
    <div class="row no-gutters">
      <div class="col-md-6">
        <div class="form-login" style="margin-top: 20vh">
          <div class="col-md-12">
            <div class="form-auth p-3">
              <h3>Login</h3>
              <span>Enter your credentials below</span>
              <div class="box-form my-4">
                <form action="<?= $url->this('/backend/login_auth') ?>" method="post" autocomplete="off">
                  <div class="form-group">
                    <input class="form-control" name="user_email" type="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="user_pass" type="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                     <input type="submit" class="btn btn-block btn-black radius-none text-white py-3 px-5" value="Login">
                  </div>
                </form>
                <div class="register-q text-center">
                  <span>Don't have an account ? <a href="<?= $url->this('/register') ?>">Register Now</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="banner-half" style="background-image: url('<?= $url->this('/assets/images/banner-home.jpg') ?>')">
          <div class="overlay">
            <div class="greeting text-left">
              <h4 class="text-white">Welcome to MyRental</h4>
              <div class="spacer my-3"></div>
              <span class="text-white">
                Our service offer high luxury car to rent. just book it as easy as finger snap!
              </span>
              <br>
              <a href="<?= $url->myurl ?>" class="btn btn-white my-3">Get Started</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="<?= $url->myurl ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/popper.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>
    <script src="<?= $url->myurl ?>/assets/js/location-picker.js"></script>
    <script src="https://ghcdn.rawgit.org/qolbudr/plugin/main/xbot.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/main.js"></script>
    <script>
      $(document).ready(function(){
        $(".preloader").fadeOut();
      })
    </script>
    <?php
    $flash = base64_decode($_GET['status'] ?? '');
    if($flash == 'login_failed') { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Login failed check your credentials!'
      })
    </script>
    <?php } else if($flash == 'register_success') { ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'You\'ve been registered, you can login now'
      })
    </script>
    <?php } ?>
  </body>

</html>