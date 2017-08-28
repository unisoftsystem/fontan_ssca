<?php 
require(dirname(__FILE__) . '/wp-load.php');
include("functions.php");
?>
<!DOCTYPE html>
<html> 
<head>
<script src="google-map.js"></script>
</head>
<body>
<form id="google" name="google" action="#">
 
<label>Direcci&oacute;n</label>
<input type="text" id="direccion" name="direccion" value="Luro 1200, Mar del Plata, Buenos Aires, Argentina"/> 
<button id="pasar">Pasar al mapa</button>
 
<!-- div donde se dibuja el mapa-->
<div id="map_canvas" style="width:450px;height:450px;"></div>
 
<!--campos ocultos donde guardamos los datos-->
<input type="hidden" name="lat" id="lat"/>
<input type="hidden" name="lng" id="long"/>
</form>
</body>
</html>