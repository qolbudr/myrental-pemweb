<?php  require 'includes/head.php' ?>
<?php
  $DB = new database();
  $lokasi = $_GET['q'];
  $lokasi = explode('-', $lokasi);
  $area = $lokasi[0];
  $cursor = $_GET['cursor'] ?? '1';
  $start = ($cursor - 1) * 8;
  $rows = $DB->query("SELECT * FROM `tb_car` INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_car`.car_location LIKE '%".$area."%' OR `tb_car`.car_area LIKE '%".$area."%'");
  $cars = $DB->query("SELECT * FROM `tb_car` INNER JOIN `tb_photo` on `tb_car`.car_id = `tb_photo`.car_id INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id  WHERE `tb_car`.car_location LIKE '%".$area."%' OR `tb_car`.car_area LIKE '%".$area."%' GROUP by `tb_car`.car_id LIMIT ".$start.", 8");
  $total = count($rows);
  $pages = ceil($total/8);
?>

    <div class="site-subheader bg-blue text-white">
      <div>
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1>CARS</h1>
              <p>Browse our for rent cars</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <?php if(count($cars) != 0) { ?>
            <?php foreach($cars as $car) { ?>
              <div class="col-lg-3 col-md-6 mb-4">
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
              </div>
            <?php } ?>

            <div class="col-12 my-4">
              <?php for($i = 1; $i <= $pages; $i++) { ?>
                <a href="?q=<?= $area ?>&cursor=<?= $i ?>" class="px-3 btn btn-black radius-none btn-sm"><?= $i ?></a>
              <?php } ?>
            </div>
          <?php } else { ?>
            <div class="col-12">
              <div class="alert alert-danger">
                No item match with your search
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

<?php require 'includes/foot.php' ?>