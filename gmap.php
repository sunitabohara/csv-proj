<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="utf-8">
    <title>Show awarder location</title>
    <style>
     
      #panel {
        position: absolute;
        top: 5px;
        width: 100%;
        height:100%;
        
      }
      #list{
        position: absolute;
        width: 50%;
        float: left;

      }
       #map{
        position: absolute;
        width: 50%;
        float: right;
        left: 50%;

      }
    </style>
   
  </head>
  <body>

    <div id="panel">
      <div id="list">
      <?php
        $awards = array_map("str_getcsv", file("uploads/final.csv",FILE_SKIP_EMPTY_LINES));
        
         $keys_awards = array_shift($awards);
         foreach ($awards as $i=>$row) {
        $csv_awards[$i] = array_combine($keys_awards, $row);
        ?>
        <ul>
        <li id= "<?php echo $csv_awards[$i]['awardeeLocation'].'_'.$i ?>" class="data_list"> <a href="#"><?php print_r ($csv_awards[$i]['contractname']);?></a> </li> <br/>
        </ul>
        <?php

      }
      ?>
       
        
      </div>
      <div id='map'>
      <div></div>
      <div id="map-canvas" style="height: 500px; width: 400px;"></div>
      </div>
    </div>
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script src="js/jquery.min.js"></script> 
    <script src="js/jquery.js"></script> 
    <script>

var geocoder;
var map;


function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(27.7, 85.3333);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


google.maps.event.addDomListener(window, 'load', initialize);
jQuery(document).ready(function($) {
  $('#map').hide();
  $('.data_list').click(function(){
    var Id   = this.id;
    var data = Id.split('_');
    var Id   = data[1];
    var address  = data[0];
    $('#map').show();
    $.ajax({
                type: "POST",
                url: "get_map_data.php",
                dataType:"json",
                data: {
                    id : Id,
                },
                success :function(response) {
                    $.each(response, function(key, value) {
                        
                    });
                    branches.prop('disabled', false);
                    $("#fe-pid").trigger("chosen:updated");
                },
                error: function(e) {
                    // console.log(e.responseText);
                }
            });

    geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
    
  });
});
    </script>
  </body>
</html>