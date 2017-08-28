
<?php
//fecha actual
$_SESSION['link']=$_GET["ruta"];
$valor = $_SESSION['link'];
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
				height: 13%;
				background-color: #f5f5f5;
			}
			#map {
				height: 50%;
				width: 95%;
				height: 80%;
				position:absolute;
				z-index:1;
				outline: 1px solid black;
			}
			.checkbox { color:blue; }
			.checkbox:before { content:""; background-color:blue; width:15px; height:18px; display:block; position:absolute; margin-left:-20px; }
			.checkbox.checked { color:red; }
			.checkbox.checked:before { background-color:red; } 
			h2 {
				text-shadow: 0px 2px 3px #555;
			}
			.mover{  
				position:relative;  
				top:40px;  
			} 
		</style>
		<script language="javascript">
			function frmSubmit(){
				document.myform.submit();
			}
		</script>
	</head>
  
	<!--<body onload="setTimeout('frmSubmit()', 6000)" >-->
	<body>
		<div class="container-fluid">
			<form name="myform" method="GET" action="http://181.55.254.193/ssca/dis.php">
				<input type="hidden" name="ruta" value="<?php echo $valor;?>">
			</form>
			<div class="row">
				<div class="col-md-12" style="background-color: #f5f5f5;">
					<img alt="Bootstrap Image Preview" src="img/HOME.png" width="200" height="100" >
					<a href="creaciones.php" style="margin-left:25%;"><img src="img/logo1.png" width="120" height="120"  ></a></center> 
					<a href="diss.php" class="mover" ><img src="img/logo2.png" width="120" height="120"  ></a>
					<a href="modificarcreaciones.php" ><img src="img/logo3.png" width="120" height="120"  ></a>
				</div>
			</div>		
		
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-primary text-right">Tracking</h2>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<h3 class="text-primary">Datos Ruta</h3>
					<hr>
					<h6 id="NombreRuta">Nombre Ruta: </h6>
					<hr>
					<h6 id="ConductorRuta">Conductor: </h6>
					<hr>
					<h6 id="PlacaRuta">Placa: </h6>
					<hr>
					<h6 id="MonitorRuta">Monitor: </h6>
					<hr>
					<h6 id="SillasRuta">Sillas: </h6>
					<hr>
					<input type="button" value="Buscar otra ruta"  onClick=" window.location.href='diss.php'"  class="btn btn-primary btn-lg pull-right"/>
					
				</div>
				<div class="col-md-6">
					<h3 class="text-primary">Mapa</h3>
					<hr>
					<div id="map">
					</div>
					</br>
					<div class="row">
						<div class="col-md-12">
							<!-- div donde se dibuja el mapa-->
							<div id="map_canvas" style="width:100%;height:200px;"></div>
						</div>
					</div>
				</div>
				
				
				<div class="col-md-4" id="rutaEstudiantesRecogido">
					<!--<div id="directions-panel"></div> <br><br>
					<h3 class="text-primary">Estudiantes en ruta</h3>
					<div id="name" class="name">
						<p id="n">A</p>
						<p id="n">A</p>
						<p id="n">A</p><br><br>
					</div>-->
				</div>
				<div class="col-md-4" id="rutaEstudiantesNoRecogido">
					<!--<div id="directions-panel"></div> <br><br>
					<h3 class="text-primary">Estudiantes que no estan en ruta</h3>
					<div id="name" class="name">
						<p id="n">A</p>
						<p id="n">A</p>
						<p id="n">A</p><br><br>
					</div>-->
				</div>
			</div>
				
			
			
			</br>
			</br>
			</br>
        
		</div>

<script>
var map;
var marker;
var markers = [];
setInterval(function(){ 
	MostrarBus();
	var date = new Date();
	var dia = date.getDate();
	var mes = (date.getMonth() + 1);
	var year = date.getFullYear();
	
	if(dia < 10) {
		dia = '0' + dia;
	} 
	
	if(mes < 10) {
		mes = '0' + mes;
	} 
	
	var fechaIn = year + "-" + mes + "-" + dia;
	var fecha = dia + "/" + mes + "/" + year;
	$("#rutaEstudiantesRecogido").empty();
	MostrarEstudiantes(<?php echo $valor;?>, fecha, fechaIn);
}, 6000);
function initMap() {
	
	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
	
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 6,
		center: {lat: 41.85, lng: -87.65}
	});//http://181.55.254.193/ssca/disDatos.php?ruta=10
	
	directionsDisplay.setMap(map);
	MostrarBus();
	
	var date = new Date();
	var dia = date.getDate();
	var mes = (date.getMonth() + 1);
	var year = date.getFullYear();
	
	if(dia < 10) {
		dia = '0' + dia;
	} 
	
	if(mes < 10) {
		mes = '0' + mes;
	} 
	
	var fechaIn = year + "-" + mes + "-" + dia;
	var fecha = dia + "/" + mes + "/" + year;
	$("#rutaEstudiantesRecogido").empty();
	MostrarEstudiantes(<?php echo $valor;?>, fecha, fechaIn);
	MostrarDatosRuta(<?php echo $valor;?>, directionsService, directionsDisplay);
}
function MostrarDatosRuta(idruta, directionsService, directionsDisplay){	
	
	var datos = {
		idruta: idruta
	} 	
	
	$.post("http://181.55.254.193/ssca/ActionMostrarDatosRuta.php", datos)
	.done(function( data ) {
		if($.trim(data) != "[]"){
			var jsonDatos = JSON.parse(data);
			var CoordenadasOrigenRuta = jsonDatos.latorigen + "," + jsonDatos.longorigen;
			var CoordenadasDestinoRuta = jsonDatos.latdestino + "," + jsonDatos.longdestino;
			$("#NombreRuta").html("Nombre Ruta: " + jsonDatos.nombreruta);
			$("#ConductorRuta").html("Conductor: " + jsonDatos.nombreConductor + " " + jsonDatos.apellidoConductor);
			$("#PlacaRuta").html("Placa: " + jsonDatos.placa);
			$("#MonitorRuta").html("Monitor: " + jsonDatos.nombreMonitor + " " + jsonDatos.apellidoMonitor);
			$("#SillasRuta").html("Sillas: " + jsonDatos.sillas);
			calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta);
		}
	});
}

function MostrarEstudiantes(idruta, fecha, fechaIn){	
	
	var datos = {
		idruta: idruta,
		fecha: fecha,
		fechaIn: fechaIn
	} 	
	
	$.post("http://181.55.254.193/ssca/ActionListarEstudiantesTracking.php", datos)
	.done(function( data ) {
		if($.trim(data) != "[]"){
			var json = JSON.parse(data);
			var htmlRecogidos = "";
			var htmlNoRecogidos = "";
			$.each(json, function(i, item) {
				if($.trim(json[i].TipoDatos) == "RECOGIDOS"){
					htmlRecogidos += '<br><br>' +
						'<h3 class="text-primary">Estudiantes en ruta</h3>' +
						'<div id="name" class="name">' +
							'<p id="n"><b>Posicion: </b>' + (i + 1) + '</p>' +
							'<p id="n"><b>Estudiante: </b>' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</p>' +
							'<p id="n"><b>Recogido </b> <input id=\"checkbox\" type=\"checkbox\" name=\"checkbox\" checked="checked" readonly=\"readonly\"  onclick=\"javascript: return false;\"/></p><br><br>' +
						'</div>';
					
				}else{
					htmlNoRecogidos += '<br><br>' +
						'<h3 class="text-primary">Estudiantes que no estan en ruta</h3>' +
						'<div id="name" class="name">' +
							'<p id="n"><b>Posicion: </b>' + (i + 1) + '</p>' +
							'<p id="n"><b>Estudiante: </b>' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</p>' +
							'<p id="n"><b>Recogido </b> <input id=\"checkbox\" type=\"checkbox\"  readonly=\"readonly\"  onclick=\"javascript: return false;\"/><br><br>' +
						'</div>';
					
				}
			});
			if(htmlRecogidos != ""){
				$("#rutaEstudiantesRecogido").html(htmlRecogidos);
			}else{
				$("#rutaEstudiantesRecogido").html('<br><br><h3 class="text-primary">Estudiantes en ruta</h3>');
			}
			if(htmlNoRecogidos != ""){
				$("#rutaEstudiantesNoRecogido").html(htmlNoRecogidos);
			}else{
				$("#rutaEstudiantesNoRecogido").html('<br><br><h3 class="text-primary">Estudiantes que no estan en ruta</h3>');
			}
			
		}
	});
}

function MostrarBus(){
	var date = new Date();
	var dia = date.getDate();
	var mes = (date.getMonth() + 1);
	var year = date.getFullYear();
	
	if(dia < 10) {
		dia = '0' + dia;
	} 
	
	if(mes < 10) {
		mes = '0' + mes;
	} 
	
	var fecha_actual = year + "-" + mes + "-" + dia;
	var datos = {
		idruta: <?php echo $valor;?>,
		fecha: fecha_actual
	} 
	$.post("http://181.55.254.193/ssca/ActionObtenerCoordenadasBus.php", datos)
	.done(function( data ) {
		console.log(data);	
		if($.trim(data) != ""){
			//marker.setMap(null);
			deleteMarkers();
			var json = JSON.parse(data);			
			
			var datosBus = json.coordenadas_recogida;
			var coordenadas = datosBus.split(",");
			var lats = parseFloat(coordenadas[0]);
			var longs = parseFloat(coordenadas[1]);; 

			var latLng = new google.maps.LatLng(lats, longs);

			//Definimos algunas opciones del mapa a crear
			var myOptions = {
				center: latLng,//centro del mapa
				zoom: 15,//zoom del mapa
				mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
			};

			//creamos el marcador en el mapa
			marker = new google.maps.Marker({
				map: map,//el mapa creado en el paso anterior
				position: latLng,//objeto con latitud y longitud
				icon: 'img/icon-bus.png',
				draggable: false //que el marcador se pueda arrastrar
			});
			
			markers.push(marker);

		}
	});
}
// Sets the map on all markers in the array.
function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
}
// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
	clearMarkers();
	markers = [];
}
function calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta) {
	
	var waypts=[];

	var date = new Date();
	var dia = date.getDate();
	var mes = (date.getMonth() + 1);
	var year = date.getFullYear();
	
	if(dia < 10) {
		dia = '0' + dia;
	} 
	
	if(mes < 10) {
		mes = '0' + mes;
	} 
	
	var fecha_actual = dia + "/" + mes + "/" + year;
	var origen = CoordenadasOrigenRuta;
	var destino = CoordenadasDestinoRuta;
	// arreglo de json en variable json
	var datos = {
		idruta: <?php echo $valor;?>
	} 
	$.post("http://181.55.254.193/ssca/ActionObtenerCoordenadasRuta.php", datos)
	.done(function( data ) {
				
		if($.trim(data) != "[]"){
			console.log(data);
			var json = JSON.parse(data);
			
			$.each(json, function(i, item) {
				var latlon = new google.maps.LatLng(json[i].latitud,json[i].longitud);
				waypts.push({
					location: latlon,
					stopover: true
				});
			});
			
			
			directionsService.route({
				origin: origen,
				destination: destino,
				waypoints: waypts,
				optimizeWaypoints: true,
				travelMode: google.maps.TravelMode.DRIVING
			}, 
			function(response, status) {
				if (status === google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
					var route = response.routes[0];
					/*var summaryPanel = document.getElementById('directions-panel');
					summaryPanel.innerHTML = '';*/
					// For each route, display summary information.
					console.log('localizacion: ' + route.legs);
					for (var i = 0; i < route.legs.length; i++) {
						var routeSegment = i + 1;
					}
				} else {
					window.alert('No se encuentra la direccion ' + status);
				}
			});
		}
	});	
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer>
    </script>
    <footer class="footer">
    <img alt="" src="img/logo.png" width="250" height="88"  border="0"></footer>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>