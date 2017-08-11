
<?php
        

        include("connect.php");
        
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
	<link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
	<style>
	html, body{
		background-image:url(img/tracking.png);
		background-repeat:no-repeat;
		background-size: 100% 100%;
		height: 100%;
        margin: 0;
        padding: 0;
	}
	#wrap { margin:0 auto 0 auto; width:390px; }

	#map {
        height: 60%;
        float: right;
        width: 75%;
        height: 60%;
      }
#right-panel {
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select, #right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}

      #right-panel {
        margin: 20px;
        border-width: 1px;
        width: 20%;
        float: left;
        text-align: left;
        padding-top: 20px;
      }
      #directions-panel {
        margin-top: 20px;
        background-color: #FFEE77;
        padding: 10px;
      }

	</style>
</head>
<body>
	<div id="wrap">
	</br>
	</br>
		<a href="creacion.php"><img src="img/logo1.png" width="100" height="100" border="0"></a> 
		<a href="diss.php"><img src="img/logo2.png" width="100" height="100" border="0"></a>
		<a href="#"><img src="img/logo3.png" width="100" height="100" border="0"></a>
	</div>
	</br>
	</br>
  </br>
	<div id="map"></div>
    <div id="right-panel">
    <div>
       </br>
       <div class="col-lg-12">
      <form  action="dis.php" method="POST">
      <select class="form-control" name="ruta"> 
      <?php
            $result = mysql_query("SELECT * FROM ruta");
            while($row = mysql_fetch_assoc($result))
            {
            ?>
            <option  value="<?php echo($row['idruta'])?>" >
                <?php echo($row['nombre_ruta']) ?> 
            </option>
            <?php
            }               
        ?>
      </select>
      </br>
       <input type="submit" id="submit" class="btn btn-primary ">
    </form>
    </div>
    </br>
    </div>
    
    </div>
    <script>
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: 4.710988599999999, lng: -74.072092}
  });
  directionsDisplay.setMap(map);

  document.getElementById('submit').addEventListener('click', function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer></script>

</body>
</html>