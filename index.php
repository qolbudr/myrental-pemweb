  <?php
    require 'includes/head.php';
    $DB = new database();

    $cars = $DB->query('SELECT * FROM `tb_car` INNER JOIN `tb_photo` ON `tb_car`.car_id = `tb_photo`.car_id GROUP by `tb_car`.car_id');
    $car_avail = $DB->get('tb_car', ['car_avaliable' => 1]);
    $car_avail = count($car_avail);
  ?>

    <div class="site-wrap">
      <div class="bg-blue site-header">
        <div class="row no-gutters">
          <div class="col-lg-7 col-md-6"></div>
          <div class="col-lg-5 col-md-6">
            <svg class="svg">
              <clipPath id="my-clip-path" clipPathUnits="objectBoundingBox"><path d="M0,0 C0,0.556,0.1,0.444,0.3,0.778 C0.5,1,0.7,0.889,1,1 H1 V0 H0"></path></clipPath>
            </svg>
            <div class="clipped"></div>
          </div>
          <div class="col-lg-12">
            <div class="container header-text text-white">
              <h1 class="font-weight-bold">MYRENTAL</h1>
              <h5 class="font-size-17">Rent our cheap, high class and luxury car is as easy as finger snap! </h5>
              <button class="btn btn-white mt-5">Get Started</button>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-light py-3">
        <div class="section-title text-center w-100 mt-5">
          <h2>DISCOVER</h2>
          <h5 class="font-size-14">View our affordable car for your trip</h5>
        </div>
        <div class="container" style="margin-bottom: 100px">
          <div class="row">
            <div class="col-lg-6">
              <form class="trip-form" method="get" action="<?= $url->this('/cars') ?>" autocomplete="off">
                <div class="card border-none p-3 with-shadow">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                      <h4>Discover</h4>
                      <label><span class="text-primary"><?= $car_avail ?></span> Car avaliable</label>
                    </div>
                    <div class="form-group">
                      <label>Location</label>
                      <input class="form-control" id="cf-1" placeholder="Search Location" required>
                      <input type="hidden" id="input-area" name="q">
                      <div class="result-container p-2 my-1">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label>Trip Date</label>
                        <input class="form-control datepicker" placeholder="Trip Date" required>
                      </div>
                      <div class="form-group col-lg-6">
                        <label>Trip End</label>
                        <input class="form-control datepicker" placeholder="Trip End" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-block btn-black py-3 mt-4" type="submit">Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-lg-6">
              <div class="nonloop-block-13 owl-carousel mt-3">
              <?php foreach($cars as $car) { ?>
              <div class="item-1">
                <div class="card banner-car-home cursor-pointer" style="background-image: url('<?= $url->myurl ?>/assets/images/user/<?= $car['user_id'] ?>/car-<?= $car['car_id'] ?>/<?= $car['car_photo'] ?>')">
                  <div class="banner-car-overlay text-center text-white">
                    <div class="text-overlay">
                      <?= $car['car_seat'] ?> Seat • <?= $car['car_door'] ?> Door • <?= ($car['car_transmision'] == 0 ? 'Manual' : 'Automatic') ?> Transmision
                    </div>
                    <a href="<?= $url->this('/car-details?cars='.$car['car_id']) ?>" class="btn btn-sm btn-white mt-3">Rent Now</a> 
                  </div>
                </div>
                <div class="item-1-content mt-2">
                  <div class="card border-none with-shadow">
                    <div class="card-body">
                      <div class="car-info">
                        <span class="btn btn-black btn-sm mb-3">Minimum Age <?= $car['car_age'] ?> years</span>
                        <h6 class="font-size-18 text-black"><?= $car['car_name'] ?></h6>
                        <h6 class="font-size-14 mb-0"><i class="lnr lnr-map"></i> <?= $car['car_location'] ?></h6>
                        <div class="rent-price mt-3">Rp <span><?= number_format($car['car_price'], 0,',','.') ?>/</span>day</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="xbot"></div>

<?php require 'includes/foot.php' ?>