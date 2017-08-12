<?php
include ('func/db.php');
 
$conexion = db_connect();
  if (!$conexion )
   return 0;
   
$rs = mysql_query("SELECT * FROM coordenadas WHERE id='1'");
    while($result=mysql_fetch_array($rs))
    {
    $id = $result['id'];
        $coordenada1 = $result['coordenada1'];
        $coordenada2 = $result['coordenada2'];    
    }
?>
 
 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mapa</title>
<script src="http://maps.google.com/maps?file=api&v=3&key=ABQIAAAAp9wVclPicp2HGB4QNX-LLRTqx4D3bS478d-1w1nVZmw5mBzr_hTd8Hb4lXsLPv7hW7mRH6_tkUmJ3g" type="text/javascript"></script>
<script type="text/javascript">
 
var map      = null;
var geocoder = null;
  
function load() {
 
var coordenada1= "<?php echo $coordenada1; ?>";
var coordenada2= "<?php echo $coordenada2; ?>";
 
 
 map = new GMap2(document.getElementById("map"));
 map.setCenter(new GLatLng(coordenada1,coordenada2), 15);
 map.addControl(new GSmallMapControl());
 map.addControl(new GMapTypeControl());
 geocoder = new GClientGeocoder();
     }
 function showAddress(address, zoom) {
 
if (geocoder) {
          geocoder.getLatLng(address,
             function(point) {
               if (!point) {
                alert(address + " not found");
               } else {
                map.setCenter(point, zoom);
                var marker = new GMarker(point);
                map.addOverlay(marker);
                document.form_mapa.coordenadas1.value = point.y;
                document.form_mapa.coordenadas2.value = point.x;
                  }
 
                }
 
         );
 
       }}
</script>
</head>
 
<body onLoad="load();"  onunload="GUnload();"> 
<center>
<div align="center" id="map" style="height: 425px; width: 425px;">
</div>
</center> 
</body>
</html>