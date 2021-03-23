$("#cf-1,#location-input").keyup(function() {
  var data = '';
  var value = $(this).val();
  if(value) {
    $.ajax({
      type: 'get',
      url: `https://mamikos.com/garuda/suggest?q=${value}`,
      success: function(result) {
        $('.result-container').css({'visibility':'visible'});
        var result = result.data.areas
        result.forEach(function(lokasi) {
          data += `<li class="area-item" data-lokasi="${lokasi.title}" data-lat="${lokasi.latitude}" data-long="${lokasi.longitude}" data-area="${lokasi.area}"><h6 class="m-0 p-0">${lokasi.title}</h6><span class="font-size-11">${lokasi.area}</span></li>`
        })
        $('.result-container').html(data);
        $('.area-item').click(function() {
          var lokasi = $(this).attr('data-lokasi');
          var area = $(this).attr('data-area');
          var lat = $(this).attr('data-lat');
          var long = $(this).attr('data-long');
          $('.result-container').css({'visibility':'hidden'});
          $("#cf-1,#location-input").val(lokasi);
          $("#cf-1").attr('area', area);
          $("#car_lat,#car_lat-e").val(lat);
          $("#car_long,#car_long-e").val(long);
          $("#car_area,#car_area-e").val(area);
        })
      }
    })
  } else {
    $('.result-container').css({'visibility':'hidden'});
  }
})

$("#cf-1,#location-input").blur(function() {
  setTimeout(function() {
    var lokasi = $("#cf-1").val();
    var area = lokasi+' '+$("#cf-1").attr('area');
    var res = area.replace(/ |\, /gi, '-');
    $("#input-area").val(res.toLowerCase());
    $('.result-container').css({'visibility':'hidden'});
    $.ajax({
      type: 'get',
      url: `backend/fetch-count-car?q=${lokasi}`,
      success: function(result) {
        $('.trip-form .text-primary').html(result);
      }
    })
  }, 1000) 
})