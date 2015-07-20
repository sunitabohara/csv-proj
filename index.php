<html>
<head>
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
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="js/jquery.js"></script> 
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript'>
      google.load('visualization', '1', { 'packages': ['geomap'] });
      google.setOnLoadCallback(drawMap);

  jQuery(document).ready(function($) {
      $('#map').hide();
  });
      function drawMap() {
      $('.data_list').click(function(){
          var Id   = this.id;
          var data = Id.split('_');
          var Id   = data[1];
          var address  = data[0];
          $('#map').show();
          //$('#j1').html('address: '+address);
          var data = google.visualization.arrayToDataTable([
            ['City', 'Amount'],
            [address, 4000],
          ]);
          var options = {};
          options['region'] = 'NP';
          options['colors'] = [0xFF8747]; //orange colors
          options['dataMode'] = 'markers';
          options['width'] = '556px';

          var container = document.getElementById('map_canvas');
          var geomap = new google.visualization.GeoMap(container);
          geomap.draw(data, options);

           
$.get('uploads/final.csv', function(data) {
  var table = document.createElement("table");
  var rows = data.split("\n");
  //for (var i = 0; i < rows.length; i++) {
    var header = rows[0].split(",");
    var newId = parseInt( parseInt(Id) + parseInt(1) );
    var cells = rows[newId].split(",");
    var amount = cells[12];  
    for (var j = 0; j < cells.length; j++) {
      var row = table.insertRow(-1);
var cell = row.insertCell(-1);
                       cell.innerHTML = header[j]+' : ';

      var cell = row.insertCell(-1);
                       cell.innerHTML = cells[j];

    }
  //}
  var dvCSV = document.getElementById("container");
                dvCSV.innerHTML = "";
               dvCSV.appendChild(table);
 
  });

       });
            

      };
    

  </script>
</head>

<body>
<div id="panel">
<div id="top" >
 

  <span><a href="upload_contracts.php">add data here...</a></span><br/>
  <span><a href="uploads/output/final.csv">Download here</a></span>
  
   
    </div>
 <div id="list">
      <?php
        $awards = array_map("str_getcsv", file("uploads/final.csv",FILE_SKIP_EMPTY_LINES));
        
         $keys_awards = array_shift($awards);
         foreach ($awards as $i=>$row) {
        $csv_awards[$i] = array_combine($keys_awards, $row);
        ?>
        <ul>
        <li id= "<?php echo $csv_awards[$i]['awardeeLocation'].'_'.$i ?>" class="data_list"> <a href="#"><?php print_r ($csv_awards[$i]['contractname']);?></a> </li> 
          <input type="hidden" id="amount_<?php echo $i ?>" name="1" value="111" />
        <br/>
        </ul>
        <?php

      }
      ?>
       
        
      </div>
     
      <div id='map'>
       <div id="j1"></div>
       <div id="container"></div>
        <div id='map_canvas'></div>
      </div>
</div>
</body>

</html>