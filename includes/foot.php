    <footer class="site-footer bg-blue">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 ml">
            <h2 class="footer-heading mb-4">About Us</h2>
                <p>A car rental, hire car, or car hire agency is a company that rents automobiles for short periods of time, generally ranging from a few hours to a few weeks. It is often organised with numerous local branches (which allow a user to return a vehicle to a different location), and primarily located near airports or busy city areas and often complemented by a website allowing online reservations.</p>
          </div>
          <div class="col-lg-5 ml-auto">
            <div class="row">
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Site Navigation</h2>
                <ul class="list-unstyled">
                  <li><a href="<?= $url->myurl ?>">Home</a></li>
                  <li><a href="<?= $url->this('/cars?q=surabaya-kota-surabaya-jawa-timur-indonesia') ?>">Cars</a></li>
                  <li><a href="<?= $url->this('/register') ?>">Register</a></li>
                  <li><a href="<?= $url->this('/login') ?>">Login</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Our Partner</h2>
                <ul class="list-unstyled">
                  <li><a href="http://flex-vps.expectron.tech">FlexVPS</a></li>
                  <li><a href="http://x-bot.expectron.tech">X-Bot</a></li>
                  <li><a href="https://midtrans.com">Midtrans</a></li>
                  <li><a href="https:/leafletjs.com">Leaflet</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    </div>
    <script>
      var myurl = "<?= $url->myurl ?>";
    </script>
    <script src="<?= $url->myurl ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/popper.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/sweet-alert.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/splide.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/dt.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-g4fJyO0FHVyuBBJD"></script>
    <script src="https://ghcdn.rawgit.org/qolbudr/plugin/main/xbot.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/location-picker.js"></script>
    <script src="<?= $url->myurl ?>/assets/js/main.js"></script>
    <script>
      if ("serviceWorker" in navigator) {
        window.addEventListener("load", function() {
          navigator.serviceWorker.register("<?= $url->myurl ?>/sw.js")
        });
      }
      <?php if($url->segment('0') == "car-details") { ?>
      var secondarySlider = new Splide( '#secondary-slider', {
        fixedWidth  : 100,
        height      : 60,
        gap         : 10,
        cover       : true,
        isNavigation: true,
        focus       : 'center',
        breakpoints : {
          '600': {
            fixedWidth: 66,
            height    : 40,
          }
        },
      } ).mount();

      var primarySlider = new Splide( '#primary-slider', {
        type       : 'fade',
        heightRatio: 0.5,
        pagination : false,
        arrows     : false,
        cover      : true,
      });

      primarySlider.sync( secondarySlider ).mount();
      <?php } ?>

      <?php if($url->segment('0') == "account") { ?>
        let url = window.location.href;
        let hash = url.split('#');
        hash = hash[1];

        if(hash) {
          $('.box-client-area').hide();
          $(`#${hash}`).show();
        }

        $(".btn-check").click(function() {
          var car_id = $(this).attr('car_id');
          var book_id = $(this).attr('book_id');
          $.ajax({
            type: "POST",
            url: "<?= $url->this('/backend/get-book.php') ?>",
            data: `book_id=${book_id}`,
            success: function(token) {
              snap.pay(token, {
              onError: function(result) {
                console.log(result);
                if(result.status_message[0] == 'transaction has been succeed') {
                  $.ajax({
                    type: 'GET',
                    url: `<?= $url->this('/backend/setbook.php?book_id=') ?>${book_id}&change=true&status=success`,
                    success: function(result) {
                      location.reload();
                    }
                  })
                } else {
                  $.ajax({
                    type: 'GET',
                    url: `<?= $url->this('/backend/setbook.php?book_id=') ?>${book_id}&change=true&status=error`,
                    success: function(result) {
                      location.reload();
                    }
                  })
                }
              }
            });
            }
          })
        })
      <?php } ?>
      
      <?php if($url->segment('0') == "car-details") { ?>
        $(".box-lokasi").html('<div id="map" style="width:100%; min-height: 180px"></div>');
          var mymap = L.map('map').setView([<?= $car['car_lat'] ?>, <?= $car['car_long'] ?>], 15);
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicWRyMzExMTIiLCJhIjoiY2s5czN1M3E4MTE5dTNmbzN0dzlvMW84cCJ9.xISAyVMSyc9_MWS3-nf5vQ', {
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoicWRyMzExMTIiLCJhIjoiY2s5czN1M3E4MTE5dTNmbzN0dzlvMW84cCJ9.xISAyVMSyc9_MWS3-nf5vQ'
          }).addTo(mymap);
        var marker = L.marker([<?= $car['car_lat'] ?>, <?= $car['car_long'] ?>]).addTo(mymap);

        $("#btn-rent").click(function() {
          var day = $("[name=day]").val();
          $.ajax({
            type: 'POST',
            url: '<?= $url->this('/functions/payment.php') ?>',
            data: `day=${day}&car_id=<?= $car['car_id'] ?>`,
            success: function(result) {
              var snapToken = result;
              snap.pay(result, {
                onSuccess: function(result) {
                  window.location = `<?= $url->this('/backend/setbook?car_id='.$car['car_id'].'&day=') ?>${day}&status=success`;
                },
                onPending: function(result) {
                  window.location = `<?= $url->this('/backend/setbook?car_id='.$car['car_id'].'&day=') ?>${day}&status=pending&token=${snapToken}`;
                },
                onError: function(result) {
                  window.location = `<?= $url->this('/backend/setbook?car_id='.$car['car_id'].'&day=') ?>${day}&status=error`;
                }
              })
            }
          })
        })
      <?php } ?>
    </script>

  </body>

</html>
