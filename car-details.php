<?php  
  require 'includes/head.php';
  if($_SESSION['user_status'] !== 'authorized') {
    echo '<script>window.location = `'.$url->this('/login').'`</script>';
  }
  $DB = new database();
  $car_id = $_GET['cars'];
  $car = $DB->query('SELECT * FROM `tb_car` INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_car`.car_id = "'.$car_id.'"')[0];
  $photos = $DB->get('tb_photo', ['car_id' => $car_id]);
  $type = $_SESSION['user_type'];
?>

    <div class="site-subheader bg-blue text-white">
      <div>
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1>CAR DETAILS</h1>
              <p>View our car spesification</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <?php if($type == 1) { ?>
            <div class="col-md-12 my-3">
              <div class="alert alert-danger">
                You are logged in as owner, you can't booking any car
              </div>
            </div>
          <?php }?>
          <?php if(is_array($car)) { ?>
            <div class="col-lg-7 col-md-12">
              <div id="primary-slider" class="splide mb-3">
                <div class="splide__track">
                  <ul class="splide__list">
                    <?php foreach($photos as $photo) { ?> 
                    <li class="splide__slide">
                      <img src="<?= $url->this('/assets/images/user/'.$car['user_id'].'/'.'car-'.$car['car_id'].'/'.$photo['car_photo']) ?>">
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div id="secondary-slider" class="splide mb-3">
                <div class="splide__track">
                  <ul class="splide__list">
                    <?php foreach($photos as $photo) { ?> 
                    <li class="splide__slide">
                      <img src="<?= $url->this('/assets/images/user/'.$car['user_id'].'/'.'car-'.$car['car_id'].'/'.$photo['car_photo']) ?>">
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="card border-none my-3">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                      <div class="img-group">
                        <label class="img-round mr-3" style="background-image: url('<?= $url->this('/assets/images/user/'.$car['user_id'].'/'.$car['user_photo']) ?>')"></label>
                        <label style="vertical-align: middle">
                          <h6 class="font-size-15 font-weight-bold">Car Owner</h6>
                          <h6 class="font-size-15 m-0"><?= $car['user_name'] ?></h6>
                        </label>
                      </div>
                      <label>
                        <a href="tel:<?= $car['user_phone'] ?>" class="btn btn-black radius-none">Contact</a>
                      </label>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-12">
              <div class="card border-none">
                <div class="card-body">
                  <h5><?= $car['car_name'] ?></h5>
                  <h6><i class="lnr lnr-map"></i> <?= $car['car_location'] ?></h6>
                  <ul class="m-0 px-3">
                    <li>
                      <span><?= $car['car_door'] ?> Doors</span>
                    </li>
                    <li>
                      <span><?= $car['car_seat'] ?> Seats</span>
                    </li>
                    <li>
                      <span><?= $car['car_transmision'] == 0 ? 'Manual' : 'Automatic' ?> Transmision</span>
                    </li>
                    <li>
                      <span><?= $car['car_age'] ?> years Minimum Age</span>
                    </li>
                  </ul>
                  <div class="box-lokasi my-3">
                  </div>
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Travel Duration (Days)</label>
                      <div class="d-flex justify-content-between">
                        <input class="form-control mr-2" type="number" name="day" value="1" placeholder="1" required>
                        <button id="btn-rent" class="btn btn-black radius-none btn-block" <?= ($type == 1) ? 'disabled' : '' ?>> Rent Now</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <script>window.location = '<?= $url->myurl ?>'</script>
          <?php } ?>
        </div>
      </div>
    </div>

<?php require 'includes/foot.php' ?>