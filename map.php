<html>
<head>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript'>
      google.load('visualization', '1', { 'packages': ['geomap'] });
      google.setOnLoadCallback(drawMap);

      function drawMap() {
          var data = google.visualization.arrayToDataTable([
            ['City', 'Amount'],
            ['Nepal', 4000],
            
          ]);

          var options = {};
          options['region'] = 'NP';
          options['colors'] = [0xFF8747]; //orange colors
          options['dataMode'] = 'markers';
          options['width'] = '556px';

          var container = document.getElementById('map_canvas');
          var geomap = new google.visualization.GeoMap(container);
          geomap.draw(data, options);
      };

  </script>
</head>

<body>
<div id="panel">
<div id="list">
</div>
<div id='map_canvas'></div>
</div>
</body>

</html>