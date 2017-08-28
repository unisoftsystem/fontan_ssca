<?php
        include("connect.php");
        $valor = 1012324820;
        $query  = "SELECT latitud, longitud  FROM usuarios where idAcudiente='".$valor."'";
        $result = mysql_query($query);
        
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $latitud = stripslashes($row['latitud']);
        $longitud = stripslashes($row['longitud']);
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html  xml:lang="es">
<head>
<title>Mapa</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache" />
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/responsive-nav.js"></script>
<style type="text/css">
	label{
		width: 70px;float:left;
		padding-top: 3px;
	}
</style>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script language="JavaScript">
		function comprobar(){ //datos de cordenadas guardadas vs datos de busqueda
		   	clave1 = document.getElementById("lat").value; 
		   	clave2 =<?php echo $latitud; ?>; 
		   	clave3 = document.getElementById("long").value; 
		   	clave4 = <?php echo $longitud; ?>; 

		   	if (parseFloat(clave1) == parseFloat(clave2) && parseFloat(clave3) == parseFloat(clave4)) 
		      	alert("las coordenadas son iguales") 
		   	else 
		      	alert("las coordenadas no concuerdan") 
		} 
	</script>
<script type="text/javascript">
	//Declaramos las variables que vamos a user
	var lat = null;
	var lng = null;
	var map = null;
	var geocoder = null;
	var marker = null;
	         
	jQuery(document).ready(function(){
	     //obtenemos los valores en caso de tenerlos en un formulario ya guardado en la base de datos
	     lat = jQuery('#lat').val();
	     lng = jQuery('#long').val();
	     //Asignamos al evento click del boton la funcion codeAddress
	     jQuery('#pasar').click(function(){
	        codeAddress();
	        return false;
	     });
			//Inicializamos la función de google maps una vez el DOM este cargado
	    initialize();
	    initializeuno();
	});
	     
	    function initialize() {
	     
	      geocoder = new google.maps.Geocoder();
	        
	       //Si hay valores creamos un objeto Latlng
	       if(lat !='' && lng != '')
	      {
	         var latLng = new google.maps.LatLng(lat,lng);
	      }
	      else
	      {
	         var latLng = new google.maps.LatLng(<?php echo $latitud; ?>,<?php echo $longitud; ?>);
	      }
	      //Definimos algunas opciones del mapa a crear
	       var myOptions = {
	          center: latLng,//centro del mapa
	          zoom: 15,//zoom del mapa
	          mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
	        };
	        //creamos el mapa con las opciones anteriores y le pasamos el elemento div
	        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	         
	        //creamos el marcador en el mapa
	        marker = new google.maps.Marker({
	            map: map,//el mapa creado en el paso anterior
	            position: latLng,//objeto con latitud y longitud
	            draggable: false //que el marcador se pueda arrastrar
	        });
	        
	       //función que actualiza los input del formulario con las nuevas latitudes
	       //Estos campos suelen ser hidden
	        updatePosition(latLng);
	         
	         
	    }

	    function initializeuno() {
	     
	      geocoder = new google.maps.Geocoder();
	        
	       //Si hay valores creamos un objeto Latlng
	       if(lat !='' && lng != '')
	      {
	         var latLng = new google.maps.LatLng(lat,lng);
	      }
	      else
	      {
	         var latLng = new google.maps.LatLng(4.710,-74.072092);
	      }
	      //Definimos algunas opciones del mapa a crear
	       var myOptions = {
	          center: latLng,//centro del mapa
	          zoom: 15,//zoom del mapa
	          mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
	        };
	        //creamos el mapa con las opciones anteriores y le pasamos el elemento div
	        map = new google.maps.Map(document.getElementById("map_canvas1"), myOptions);
	         
	        //creamos el marcador en el mapa
	        marker = new google.maps.Marker({
	            map: map,//el mapa creado en el paso anterior
	            position: latLng,//objeto con latitud y longitud
	            draggable: true //que el marcador se pueda arrastrar
	        });
	        
	       //función que actualiza los input del formulario con las nuevas latitudes
	       //Estos campos suelen ser hidden
	        updatePosition(latLng);
	         
	         
	    }
	     
	    //funcion que traduce la direccion en coordenadas
	    function codeAddress() {
	         
	        //obtengo la direccion del formulario
	        var address = document.getElementById("direccion").value;
	        //hago la llamada al geodecoder
	        geocoder.geocode( { 'address': address}, function(results, status) {
	         
	        //si el estado de la llamado es OK
	        if (status == google.maps.GeocoderStatus.OK) {
	            //centro el mapa en las coordenadas obtenidas
	            map.setCenter(results[0].geometry.location);
	            //coloco el marcador en dichas coordenadas
	            marker.setPosition(results[0].geometry.location);
	            //actualizo el formulario      
	            updatePosition(results[0].geometry.location);
	             
	            //Añado un listener para cuando el markador se termine de arrastrar
	            //actualize el formulario con las nuevas coordenadas
	            google.maps.event.addListener(marker, 'dragend', function(){
	                updatePosition(marker.getPosition());
	            });
	      } else {
	          //si no es OK devuelvo error
	          alert("No podemos encontrar la direcci&oacute;n, error: " + status);
	      }
	    });
	  }
	   
	  //funcion que simplemente actualiza los campos del formulario
	  function updatePosition(latLng)
	  {
	       
	       jQuery('#lat').val(latLng.lat());
	       jQuery('#long').val(latLng.lng());
	   
	  }
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1749329-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
     </head>
     <body   onunload="GUnload();">
        <header>
        <a href="menu.php" class="logo" data-scroll><img src="img/HOME.png" width="60" height="60" border="0"></a>
        <nav class="nav-collapse">
          <ul>
          <li class="menu-item active"><a href="consultarutas.php" data-scroll>Consulta Ruta</a></li>
          <li class="menu-item active"><a href="formcrearruta.php" data-scroll>Identificacion Ruta</a></li>
          <li class="menu-item"><a href="drag.php" data-scroll>Cargar Lista Estudiantes</a></li>
          <li class="menu-item"><a href="pagovirtual.php" data-scroll>Pagos Virtuales</a></li>
          <li class="menu-item"><a href="busquedahijo.php" data-scroll>Bitacoras</a></li>
          <li class="menu-item"><a href="mapa.php" data-scroll>Obtener Coordenadas Estudiante</a></li>
          <li class="menu-item"><a href="buscarrutas.php" data-scroll>Busqueda Rutas</a></li>
          <li class="menu-item"><a href="pagos.php" data-scroll>Pagos</a></li>
          <li class="menu-item"><a href="recogidavsdireccion.php" data-scroll>Recogida Vs Direccion</a></li>
          <li class="menu-item"><a href="#blog" data-scroll>Salir</a></li>
          </ul>
         </nav>
        </header>
        </br>
     	</br>
     	</br>
	 	<form id="google" name="google" action="#">
		<p><label>Direcci&oacute;n: </label>
		<div class="col-lg-12">
		<input class="form-control" type="text" id="direccion" name="direccion" value="" /><button type="submit" id="pasar" class="btn btn-primary pull-right" onclick="return comprobar();" >Obtener coordenadas <span class="fa fa-arrow-right"></span></button>
	    </div> 
		</p>
		<!-- div donde se dibuja el mapa-->
		<div id="map_canvas1" style="width:100%;height:300px;"></div>
	    </br>
	    </br>
		</form>
		<!--campos ocultos donde guardamos los datos-->
		<form >
		<p><label>Latitud: </label></br></p>
		<div class="col-lg-12">
			<input type="text" class="form-control" readonly onkeyup="comprobar()" name="lat" id="lat"/>
	    </div>
		<p><label> Longitud:</label></p>
		<div class="col-lg-12">
			<input type="text" class="form-control" readonly onkeyup="comprobar()" name="lng" id="long"/>
	    </div>
	    <div class="col-lg-12">
	    </div>
		</form>
	    </br>
        </br>
        </br>
        </br>
		<center><h3>Coordenadas Guardadas Estudiante</h3></center>
		<div id="map_canvas" style="width:100%;height:300px;"></div>
		</br>
        </br>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
		<script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
     </body>
     </html>