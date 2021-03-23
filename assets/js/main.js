$(document).ready(function(){
  $(".preloader").fadeOut();
  $("#datatable").DataTable({
    responsive: true
  });

  $('.datepicker').datepicker();
})

    if ( $('.nonloop-block-13').length > 0 ) {
      $('.nonloop-block-13').owlCarousel({
        center: false,
        items: 1,
        loop: true,
        margin: 20,
        smartSpeed: 1000,
        autoplay: true,
        nav: false,
        responsive:{
          600:{
            margin: 20,
            nav: false,
            items: 2
          },
          1000:{
            margin: 20,
            stagePadding: 0,
            nav: false,
            items: 2
          }
        }
      });


      $('.custom-next').click(function(e) {
        e.preventDefault();
        $('.nonloop-block-13').trigger('next.owl.carousel');
      })
      $('.custom-prev').click(function(e) {
        e.preventDefault();
        $('.nonloop-block-13').trigger('prev.owl.carousel');
      })

      
    }

$(".open-menu").click(function() {
  $('.left-menu').css('right', 0);
})

$(".close-menu").click(function() {
  $('.left-menu').css('right', '-80%');
})

var width = $(window).width();
$(window).on('resize', function() {
  if ($(this).width() !== width) {
    width = $(this).width();
    if(width > 700) {
      $(".close-menu").click();
    }
  }
});

$("#xbot").xbotInit({
    bot_id: '0dc7b-d8e-a4d260b-8c37'
})

function changeImg(input) {
  if(input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.img-round').css('background-image', `url('${e.target.result}')`);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function changePhoto(input) {
  $('.upload-container').html('');
  if(input.files && input.files[0]) {
    var filesAmount = input.files.length;
    for(i = 0; i < filesAmount; i++) {
      var name = input.files[i].name;
      $('.upload-container').append(`
        <div class="alert font-size-14 alert-primary my-1" role="alert">
          ${name}
        </div>
        `);
    }
  }
}

$("#upload-photo").change(function() {
  changeImg(this);
  $('[name=isUpload]').val(1);
})

$("#remove-photo").click(function() {
  $('.img-round').css('background-image', `url('${myurl}/assets/images/default.png')`);
  $('[name=isUpload]').val(1);
})

$("#car_photo").change(function() {
  changePhoto(this);
})

$("#account-settings").click(function() { 
  $('.box-client-area').hide();
  $('#account-box').show();  
})

$("#book-status").click(function() { 
  $('.box-client-area').hide();
  $('#book-box').show();  
})

$("#book-history").click(function() { 
  $('.box-client-area').hide();
  $('#history-box').show();  
})

$(".btn-add-car").click(function() {
  $("#add-car").show();
  $("#book-box").hide();
})

$(".btn-close-add-car").click(function() {
  $("#add-car").hide();
  $("#edit-car").hide();
  $("#book-box").show();
})

$(".banner-car-home").mouseover(function() {
  $(this).find('.banner-car-overlay').css('opacity', 1);
  $(this).addClass('animate-scale');
})

$(".banner-car-home").mouseleave(function() {
  $(this).removeClass('animate-scale');
  $(this).find('.banner-car-overlay').css('opacity', 0);
})

$(".btn-delete-car").click(function() {
  var car_id = $(this).attr('car-id');
  Swal.fire({
    title: 'Are you sure?',
    text: "This will delete your car ads!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = `${myurl}/backend/delete-car?car_id=${car_id}`
    }
  })
})

$(".btn-delete-account").click(function() {
  Swal.fire({
    title: 'Are you sure?',
    text: "This will delete your account!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = `${myurl}/backend/delete-account`
    }
  })
})

$(".btn-car-edit").click(function() {
  var car_id = $(this).attr('car-id');
  $.ajax({
    type: 'POST',
    url: `${myurl}/backend/fetch-car.php`,
    data: `car_id=${car_id}`,
    success: function(result) {
      $('#name-input').val(result.car_name);
      $('#id-input').val(result.car_id);
      $('#door-input').val(result.car_door);
      $('#seat-input').val(result.car_seat);
      $('#age-input').val(result.car_age);
      $('#price-input').val(result.car_price);
      $('#car_lat-e').val(result.car_lat);
      $('#car_long-e').val(result.car_long);
      $('#car_area-e').val(result.car_area)
      $(`#transmision_input option[value=${result.car_transmision}]`).attr('selected', 'selected');
      $('#location-input').val(result.car_location);
      $("#edit-car").show();
      $("#book-box").hide();
    }
  })
})