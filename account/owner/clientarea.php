<?php
  require '../../includes/head.php';
  if($_SESSION['user_status'] != 'authorized') {
    echo '<script>window.location="'.$url->this('/login').'"</script>';
  }
  if($_SESSION['user_type'] != 1) {
    echo '<script>window.location="'.$url->this('/account/user/clientarea').'"</script>';
  }

  $DB = new database();
  $row = $DB->get('tb_user', ['user_id' => $_SESSION['user_id']]);
  $data = $row[0];

  $cars = $DB->get('tb_car', ['user_id' => $_SESSION['user_id']]);

  $books = $DB->query('SELECT * FROM `tb_book` INNER JOIN `tb_car` ON `tb_book`.car_id = `tb_car`.car_id INNER JOIN `tb_user` ON `tb_book`.user_id = `tb_user`.user_id WHERE `tb_car`.user_id = '.$_SESSION['user_id']);
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
                <span>Manage Car</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6 my-2">
            <div class="card border-none cursor-pointer text-center" id="book-history">
              <div class="card-body">
                <h3><span class="lnr lnr-briefcase"></span></h3>
                <span>Manage Booking</span>
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

        <?php if($data['user_phone'] == '' || $data['user_address'] == '') { ?>
          <div class="row mt-4 box-client-area" id="book-box" style="display: none">
            <div class="col-md-12">
              <div class="alert alert-danger mt-3" role="alert">
                Please complete your account details in Account section
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="row mt-4 box-client-area" id="book-box" style="display: none">
            <div class="col-md-12">
              <div class="card border-none">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between my-2">
                    <h5 class="font-size-18 mb-3">Manage Car</h5>
                    <button class="btn btn-black btn-sm btn-add-car">Add a Car</button>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Location</th>
                          <th scope="col">Price</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($cars as $car) { ?>
                          <tr>
                            <td><?= $car['car_name'] ?></td>
                            <td><?= $car['car_location'] ?></td>
                            <td><?= 'Rp. '.number_format($car['car_price'], 0, ',', '.') ?></td>
                            <td><?= $car['car_avaliable'] == 1 ? '<span class="badge badge-success text-white">Avaliable</span>' : '<span class="badge badge-danger">Not Avaliable</span>' ?></td>
                            <td>
                              <div class="d-flex text-white text-center">
                                <button class="btn btn-sm btn-primary btn-car-edit" car-id="<?= $car['car_id'] ?>"><i class="lnr lnr-pencil"></i></button>
                                <a href="<?= $url->this('/car-details?cars='.$car['car_id']) ?>" target="_b" class="btn btn-sm btn-warning mx-1"><i class="lnr lnr-eye"></i></a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-delete-car" car-id="<?= $car['car_id'] ?>"><i class="lnr lnr-trash"></i></a>
                              </div>
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
        <?php } ?>

      <?php if($data['user_phone'] == '' || $data['user_address'] == '') { ?>
        <div class="row mt-4 box-client-area" id="history-box" style="display: none">
          <div class="col-md-12">
            <div class="alert alert-danger mt-3" role="alert">
              Please complete your account details in Account section to receive booking info
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="row mt-4 box-client-area" id="history-box" style="display: none">
          <div class="col-md-12">
            <div class="card border-none">
              <div class="card-body p-4">
                <h5 class="font-size-18 mb-3">Manage Booking</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col">Bookers</th>
                          <th scope="col">Car Name</th>
                          <th scope="col">Trip Date</th>
                          <th scope="col">Trip End</th>
                          <th scope="col">Price</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($books as $book) { ?>
                          <tr>
                            <td><?= $book['user_name'] ?></td>
                            <td><?= $book['car_name'] ?></td>
                            <td><?= $book['book_start'] ?></td>
                            <td><?= $book['book_end'] ?></td>
                            <td><?= 'Rp. '.number_format($book['car_price'], 0, ',', '.') ?></td>
                            <td>
                              <?php if($book['book_status'] == 1) { ?>
                              <div class="d-flex text-white text-center">
                                <a href="<?= $url->this('/backend/setbook.php?book_id='.$book['book_id'].'&change=true&status=approve') ?>" class="btn btn-sm btn-success mx-1"><i class="lnr lnr-checkmark-circle"></i></a>
                                <a href="<?= $url->this('/backend/setbook.php?book_id='.$book['book_id'].'&change=true&status=error') ?>" class="btn btn-sm btn-danger"><i class="lnr lnr-cross"></i></a>
                              </div>
                              <?php } else if($book['book_status'] == 0) { ?>
                                <span class="badge badge-danger">Cancelled</span>
                              <?php } else if($book['book_status'] == 2) { ?>
                                <span class="badge badge-success text-white">Approved</span>
                              <?php } else if($book['book_status'] == 3) { ?>
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
      <?php } ?>

      <div class="row mt-4 box-client-area" id="add-car" style="display: none">
        <div class="col-md-12">
          <div class="card border-none">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between">
                <h5 class="font-size-18 mb-3">Add a car</h5>
                <i class="lnr lnr-cross cursor-pointer btn-close-add-car"></i>
              </div>
              <form action="<?= $url->this('/backend/add-car.php') ?>" method="post" enctype="multipart/form-data">
                <div class="row my-3">
                  <div class="col-md-6">
                    <input type="file" class="d-none" name="car_photo[]" id="car_photo" multiple="true" accept="image/png, image/jpeg" required="">
                    <label class="upload-photo cursor-pointer" for="car_photo">
                      <div class="area">
                        <i class="lnr lnr-cloud-upload font-size-30"></i>
                        <h5 class="font-size-14">Upload car Image</h5>
                      </div>
                    </label>
                    <div class="upload-container mb-2">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label>Car Name</label>
                        <input type="text" name="car_name" class="form-control" placeholder="Car Name" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Car Doors</label>
                        <input type="number" name="car_door" class="form-control" placeholder="Car Door" required>
                      </div>
                      <div class="form-group col-md-8">
                        <label>Car Transmision</label>
                        <select class="form-control" name="car_transmision" required>
                          <option value="0">Manual</option>
                          <option value="1">Automatic</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Car Seats</label>
                        <input type="number" name="car_seat" class="form-control" placeholder="Car Seat" required>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Car Location</label>
                        <input type="text" name="car_location" class="form-control" placeholder="Car Location" id="cf-1" required>
                        <input type="hidden" id="car_area" name="car_area">
                        <input type="hidden" id="car_lat" name="car_lat">
                        <input type="hidden" id="car_long" name="car_long">
                        <div class="result-container">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Minimum Age</label>
                        <input type="number" name="car_age" class="form-control" placeholder="Minimum Age" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Car Price/Day</label>
                        <input type="number" name="car_price" class="form-control" placeholder="Car Price" required>
                      </div>
                      <div class="form-group col-md-12">
                        <button class="btn btn-black radius-none btn-block ">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4 box-client-area" id="edit-car" style="display: none">
        <div class="col-md-12">
          <div class="card border-none">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between">
                <h5 class="font-size-18 mb-3">Edit a car</h5>
                <i class="lnr lnr-cross cursor-pointer btn-close-add-car"></i>
              </div>
              <form action="<?= $url->this('/backend/edit-car.php') ?>" method="post" enctype="multipart/form-data">
                <div class="row my-3">
                  <div class="col-md-6">
                    <input type="file" class="d-none" name="car_photo[]" id="car_photos" multiple="true" accept="image/png, image/jpeg">
                    <label class="upload-photo cursor-pointer" for="car_photos">
                      <div class="area">
                        <i class="lnr lnr-cloud-upload font-size-30"></i>
                        <h5 class="font-size-14">Upload car Image</h5>
                      </div>
                    </label>
                    <div class="upload-container mb-2">
                      <div class="alert font-size-14 alert-warning my-1" role="alert">
                        Leave blank if you don't want to change the image
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label>Car Name</label>
                        <input type="hidden" name="car_id" id="id-input">
                        <input type="text" name="car_name" class="form-control" id="name-input" placeholder="Car Name" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Car Doors</label>
                        <input type="number" name="car_door" class="form-control" id="door-input" placeholder="Car Door" required>
                      </div>
                      <div class="form-group col-md-8">
                        <label>Car Transmision</label>
                        <select class="form-control" name="car_transmision" id="transmision_input" required>
                          <option value="0">Manual</option>
                          <option value="1">Automatic</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Car Seats</label>
                        <input type="number" name="car_seat" class="form-control" id="seat-input" placeholder="Car Seat" required>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Car Location</label>
                        <input type="hidden" id="car_area-e" name="car_area">
                        <input type="hidden" id="car_lat-e" name="car_lat">
                        <input type="hidden" id="car_long-e" name="car_long">
                        <input type="text" name="car_location" class="form-control" id="location-input" placeholder="Car Location" id="cf-1" required>
                        <div class="result-container">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Minimum Age</label>
                        <input type="number" name="car_age" class="form-control" id="age-input" placeholder="Minimum Age" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Car Price/Day</label>
                        <input type="number" name="car_price" class="form-control" id="price-input" placeholder="Car Price" required>
                      </div>
                      <div class="form-group col-md-12">
                        <button class="btn btn-black radius-none btn-block">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
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

