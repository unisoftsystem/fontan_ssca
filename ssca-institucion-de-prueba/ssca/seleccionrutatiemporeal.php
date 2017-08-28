<?php
    //conect
      require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Ssca</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/base.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <style type="text/css">
    	.footer {
		  position:fixed;
		  bottom: 0;
		  width: 100%;
		  /* Set the fixed height of the footer here */
		  height: 10%;
		  background-color: #f5f5f5;
		}
      #map {
        height: 60%;
        width: 95%;
        height: 60%;
        position:absolute;
        z-index:1;
        outline: 1px solid black;
      }
      h2 {
             text-shadow: 0px 2px 3px #555;
         }
    </style>
  </head>
  <body>
    <div class="container-fluid">
	  <div class="row">
		<div class="col-md-12" style="background-color: #f5f5f5;">
    <img alt="Bootstrap Image Preview" src="img/HOME.png" width="200" height="100" border="0">

      <a href="creaciones.php" style="margin-left:25%;"><img src="img/logo1.png" width="100" height="100" border="1" ></a></center> 
      <a href="diss.php" ><img src="img/logo2.png" width="100" height="100" border="1" ></a>
      <a href="#" ><img src="img/logo3.png" width="100" height="100" border="1" ></a>
    </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-primary text-right">
				Tracking
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h3 class="text-primary">
				Selección de Ruta
			</h3>
      <hr>
				<div class="form-group">
					 <form  action="rutatiemporeal.php" method="POST">
              <select class="form-control" name="ruta"> 
              <?php
              $result = mysql_query("SELECT * FROM asignacionruta");
              while($row = mysql_fetch_assoc($result))
              {
              ?>
            <option  value="<?php echo($row['id'])?>" >
                <?php echo($row['nombreruta']) ?> 
            </option>
            <?php
            }               
        ?>
      </select>
      </br>
       <input type="submit" id="submit" class="btn btn-primary btn-lg" title="Consultar Ruta" value="Consultar Ruta">
    </form>
		</div>	
		</div>
      <div class="col-md-8">
			<h3 class="text-primary">
				Mapa
			</h3>
      		<hr>
			     <div id="map"></div>
      </br>
			<div class="row">
				<div class="col-md-12">
          <!-- div donde se dibuja el mapa-->
          <div id="map_canvas" style="width:100%;height:200px;"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
				</div>
        </br>
			</div>
		</div>    
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
<footer class="footer">
<img alt="" src="img/logo.png" width="300" height="90"  border="0">
</footer>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
</body>
</html>