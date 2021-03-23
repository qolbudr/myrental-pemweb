<?php
  require '../../includes/head.php';
  if($_SESSION['user_status'] != 'authorized') {
    echo '<script>window.location="'.$url->this('/login').'"</script>';
  }
  if($_SESSION['user_type'] != 0) {
    echo '<script>window.location="'.$url->this('/account/owner/clientarea').'"</script>';
  }

  $DB = new database();
  $row = $DB->get('tb_user', ['user_id' => $_SESSION['user_id']]);
  $data = $row[0];
  $books = $DB->query('SELECT * FROM `tb_book` INNER JOIN `tb_car` ON `tb_book`.car_id = `tb_car`.car_id INNER JOIN `tb_photo` ON `tb_book`.car_id = `tb_photo`.car_id INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_book`.user_id = '.$_SESSION['user_id'].' AND `tb_book`.book_status = 1 OR `tb_book`.book_status = 2 OR `tb_book`.book_status = 4 GROUP BY `tb_book`.car_id LIMIT 2');

  $histories = $DB->query('SELECT * FROM `tb_book` INNER JOIN `tb_car` ON `tb_book`.car_id = `tb_car`.car_id INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_book`.user_id = '.$_SESSION['user_id'].' AND `tb_book`.book_status = 3 OR `tb_book`.book_status = 0');

  foreach($books as $book) {
    if(date('Y-m-d') > $book['book_end']) {
      if($book['book_status'] == 2) {
        $DB->update('tb_book', ['book_status' => 3], ['book_id' => $book['book_id']]);
      } else {
        $DB->update('tb_book', ['book_status' => 0], ['book_id' => $book['book_id']]);
      }
    }
  }

?>

    <div class="site-subheader bg-blue text-white">
      <div>
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1>CLIENT AREA</h1>
              <p>Manage your account in this section below</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-6 my-2">
            <div class="card border-none cursor-pointer text-center" id="account-settings">
              <div class="card-body">
                <h3><span class="lnr lnr-users my-2"></span></h3>
                <span>Account</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6 my-2">
            <div class="card border-none cursor-pointer text-center" id="book-status">
              <div class="card-body">
                <h3><span class="lnr lnr-car"></span></h3>
                <span>Booked</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6 my-2">
            <div class="card border-none cursor-pointer text-center" id="book-history">
              <div class="card-body">
                <h3><span class="lnr lnr-history"></span></h3>
                <span>History</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6 my-2">
            <div class="card border-none cursor-pointer text-center" id="account-settings">
              <a class="text-dark" style="text-decoration: none" href="<?= $url->this('/backend/logout') ?>">
                <div class="card-body">
                  <h3><span class="lnr lnr-power-switch"></span></h3>
                  <span>Logout</span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row mt-4 box-client-area" id="account-box">
          <form action="<?= $url->this('/backend/change_profile') ?>" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
              <div class="card border-none">
                <div class="card-body p-4">
                  <div class="form-group">
                    <h5 class="font-size-18 font-weight-bold mb-3">Avatar</h5>
                    <div class="img-group">
                      <?php if(empty($data['user_photo'])) { ?>
                      <label class="img-round mr-3" style="background-image: url('<?= $url->this('/assets/images/default.png') ?>')"></label>
                      <?php } else { ?>
                      <label class="img-round mr-3" style="background-image: url('<?= $url->this('/assets/images/user/'.$_SESSION['user_id'].'/'.$data['user_photo']) ?>')"></label>
                      <?php } ?>
                      <input class="d-none" type="file" id="upload-photo" name="user_photo">
                      <input type="hidden" name="isUpload" value="0">
                      <label for="upload-photo" href="javascript:void(0)" class="btn btn-outline-primary mr-2 cursor-pointer">Upload</label>
                      <label id="remove-photo" class="btn btn-outline-dark cursor-pointer">Remove</label>
                    </div>
                  </div>
                  <div class="spacer-dark my-3"></div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <h5 class="font-size-14 font-weight-bold mb-3">Full Name</h5>
                      <input type="text" value="<?= $data['user_name'] ?>" class="form-control" name="user_name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group col-md-6">
                      <h5 class="font-size-14 font-weight-bold mb-3">Email Address</h5>
                      <input type="email" value="<?= $data['user_email'] ?>" class="form-control" name="user_email" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="spacer-dark my-3"></div>
                    </div>
                    <div class="form-group col-md-4">
                      <h5 class="font-size-14 font-weight-bold mb-3">Password</h5>
                      <input type="password" value="<?= $data['user_password'] ?>" class="form-control" name="user_password" placeholder="Password" required>
                    </div>
                    <div class="form-group col-md-4">
                      <h5 class="font-size-14 font-weight-bold mb-3">Phone Number</h5>
                      <input type="number" value="<?= $data['user_phone'] ?>" class="form-control" name="user_phone" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group col-md-4">
                      <h5 class="font-size-14 font-weight-bold mb-3">Living Address</h5>
                      <input type="text" value="<?= $data['user_address'] ?>" class="form-control" name="user_address" placeholder="Address" required>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="spacer-dark my-3"></div>
                    </div>
                    <div class="form-group col-md-6">
                      <h5 class="font-size-18">Delete Account</h5>
                      <span>All of your saved data will be lost, and you can't restore your account</span>
                    </div>
                    <div class="form-group col-md-6 text-right">
                      <a href="javascript:void(0)" class="btn btn-outline-danger font-size-15 btn-delete-account">Delete Account</a>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="spacer-dark my-3"></div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button class="btn btn-black">Save Changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="row mt-4 box-client-area" id="book-box" style="display: none">
          <?php 
          if(!empty($books[0])) { 
            foreach($books as $book) {
          ?>
          <div class="col-md-4 mb-3">
            <div class="card banner-car" style="background-image: url('<?= $url->myurl ?>/assets/images/user/<?= $book['user_id'] ?>/car-<?= $book['car_id'] ?>/<?= $book['car_photo'] ?>')"></div>
          </div>
          <div class="col-md-8 mb-3">
            <div class="card border-none">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <h5><?= $book['car_name'] ?></h5>
                  <span class="font-size-14 m-0"><?= $book['book_start'].' / '.$book['book_end'] ?></span>
                </div>
                <ul class="m-0 px-3">
                  <li>
                    <span><i class="lnr lnr-map"></i> <?= $book['car_location'] ?></span>
                  </li>
                  <li>
                    <span><?= $book['car_door'] ?> Doors</span>
                  </li>
                  <li>
                    <span><?= $book['car_seat'] ?> Seats</span>
                  </li>
                  <li>
                    <span><?= $book['car_transmision'] == 1 ? 'Automatic' : 'Manual' ?> Transmision</span>
                  </li>
                  <li>
                    <span><?= $book['car_age'] ?> years Minimum Age</span>
                  </li>
                </ul>
                <?php if($book['book_status'] == 2) { ?>
                <div class="d-flex justify-content-between alert alert-success mt-4" role="alert">
                  Your book has been succeded!
                </div>
                <?php } else if ($book['book_status'] == 4) { ?>
                <div class="d-flex justify-content-between alert alert-warning mt-4" role="alert">
                  We're currently checking and processed your booking
                  <button class="btn btn-outline-dark btn-sm btn-check" book_id="<?= $book['book_id'] ?>" car_id="<?= $book['car_id'] ?>">Check Payment</button>
                </div>
                <?php } else if ($book['book_status'] == 1) { ?>
                <div class="d-flex justify-content-between alert alert-warning mt-4" role="alert">
                  Waiting acceptance from owner side
                </div>
                <?php } else { ?>
                <div class="d-flex justify-content-between alert alert-danger mt-4" role="alert">
                  Sorry your booking has been canceled due to fraud reason
                </div> 
                <?php }?>
              </div>
            </div>
          </div>
          <?php }} else { ?>
            <div class="col-md-12">
              <div class="alert alert-warning">
                You don't have rent any car yet
              </div>
            </div>
          <?php } ?>
        </div>

        <div class="row mt-4 box-client-area" id="history-box" style="display: none">
          <div class="col-md-12">
            <div class="card border-none">
              <div class="card-body p-4">
                <h5 class="font-size-18 mb-3">Booking History</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col">Trip Date</th>
                          <th scope="col">Trip End</th>
                          <th scope="col">Car Name</th>
                          <th scope="col">Car Owner</th>
                          <th scope="col">Price</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($histories as $history) { ?>
                          <tr>
                            <td><?= $history['book_start'] ?></td>
                            <td><?= $history['book_end'] ?></td>
                            <td><?= $history['car_name'] ?></td>
                            <td><?= $history['user_name'] ?></td>
                            <td><?= 'Rp. '.number_format($history['car_price'], 0, ',', '.') ?></td>
                            <td>
                              <?php if($history['book_status'] == 0) { ?>
                                <span class="badge badge-danger">Cancelled</span>
                              <?php } else if($history['book_status'] == 3) { ?>
                                <span class="badge badge-warning">Completed</span>
                              <?php } ?>
                            </td>
                          </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  require '../../includes/foot.php';
?>

