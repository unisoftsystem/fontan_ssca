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

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="js/drag/jquery-git2.min.js"></script>
	<script src="js/drag/jquery.event.drag-2.2.js"></script>
    <script src="js/drag/jquery.event.drag.live-2.2.js"></script>
    <script src="js/drag/jquery.event.drop-2.2.js"></script>
    <script src="js/drag/jquery.event.drop.live-2.2.js"></script>
    <script src="js/drag/excanvas.min.js"></script>
    <script src="js/drag/watermark-polyfill.js"></script>
    <script src="js/drag/ScriptMain.js"></script>
    <script src="js/drag/ConexionWebService.js"></script>
	<script type="text/javascript" src="js/alertify.js"></script>
    <link rel="stylesheet" href="css/alertify.core.css" />
    <link rel="stylesheet" href="css/alertify.default.css" />
    
    <style type="text/css">
    	.footer {
		  position: static;
		  bottom: 0;
		  width: 100%;
		  /* Set the fixed height of the footer here */
		  height: 20%;
		  background-color: #f5f5f5;
		}
    </style>


  <script>
   //duplicado de curso
      $(document).ready(function () {
          $("#curso").keyup(function () {
              var value = $(this).val();
              $("#cursos").val(value);
          });
      });
</script>
<script>
   //duplicado de busqueda
      $(document).ready(function () {
          $("#busqueda").keyup(function () {
              var value = $(this).val();
              $("#busquedas").val(value);
          });
      });
</script>

<script>
   //duplicado de ruta
      $(document).ready(function () {
          $("#ruta").keyup(function () {
              var value = $(this).val();
              $("#rutas").val(value);
          });
      });
</script>
<script>
   //duplicado de monitor
      $(document).ready(function () {
          $("#monitor").keyup(function () {
              var value = $(this).val();
              $("#monitores").val(value);
          });
      });
</script>

<script>
//jquery
  $(function () {
    
    function doSomething(value) {
      $('#rutas').html('Selected Option: '+value);
    }
    
    $('#ruta').bind('change keyup',function () {
      //get value of selected option
      var value = $(this).children("option:selected").attr('value');
      doSomething(value);
    }).change();/*remove this ".change()" if you dont need it*/

    
  });

</script>

  <script type="text/javascript">
  //Declaramos las variables que vamos a user
  var lat = null;
  var lng = null;
  var map = null;
  var geocoder = null;
  var marker = null;

  var lat1 = null;
  var lng1 = null;
  var map1 = null;
  var geocoder1 = null;
  var marker1 = null;
           
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
     initialize()
  });

  jQuery(document).ready(function(){
       lat1 = jQuery('#lats').val();
       lng1 = jQuery('#longs').val();
       jQuery('#pasars').click(function(){
          codeAddress1();
          return false;
       });
        initialize()
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
           var latLng = new google.maps.LatLng(4.710988599999999,-74.072092);
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
              draggable: true //que el marcador se pueda arrastrar
          });
         //función que actualiza los input del formulario con las nuevas latitudes
         //Estos campos suelen ser hidden
          updatePosition(latLng);   
			
			google.maps.event.addListener(marker, 'dragend', function(){
				updatePosition(marker.getPosition());
				console.log(marker.getPosition());
			});
          //Si hay valores creamos un objeto Latlng
         if(lat1 !='' && lng1 != '')
        {
           var latLng1 = new google.maps.LatLng(lat1,lng1);
        }
        else
        {
           var latLng1 = new google.maps.LatLng(4.710988599999999,-74.072092);
        }
        //Definimos algunas opciones del mapa a crear
         var myOptions1 = {
            center: latLng,//centro del mapa
            zoom: 15,//zoom del mapa
            mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
          };
          //creamos el mapa con las opciones anteriores y le pasamos el elemento div
           map1 = new google.maps.Map(document.getElementById("map_canvass"), myOptions);

          //creamos el marcador en el mapa
          marker1 = new google.maps.Marker({
              map: map1,//el mapa creado en el paso anterior
              position: latLng,//objeto con latitud y longitud
              draggable: true //que el marcador se pueda arrastrar
          });
         //función que actualiza los input del formulario con las nuevas latitudes
         //Estos campos suelen ser hidden
          updatePosition1(latLng);   
		  google.maps.event.addListener(marker1, 'dragend', function(){
				updatePosition1(marker1.getPosition());
			});
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
				  console.log(marker.getPosition());
              });
        } else {
            //si no es OK devuelvo error
            alert("No podemos encontrar la direcci&oacute;n, error: " + status);
        }
      });   
          
    }

    //funcion que traduce la direccion en coordenadas
      function codeAddress1() {
      //obtengo la direccion del formulario
          var address1 = document.getElementById("direccions").value;
          //hago la llamada al geodecoder
          geocoder.geocode( { 'address': address1}, function(results, status) {
           
          //si el estado de la llamado es OK
          if (status == google.maps.GeocoderStatus.OK) {
              //centro el mapa en las coordenadas obtenidas
              map1.setCenter(results[0].geometry.location);
              //coloco el marcador en dichas coordenadas
              marker1.setPosition(results[0].geometry.location);
              //actualizo el formulario      
              updatePosition1(results[0].geometry.location);
               
              //Añado un listener para cuando el markador se termine de arrastrar
              //actualize el formulario con las nuevas coordenadas
              google.maps.event.addListener(marker1, 'dragend', function(){
                  updatePosition1(marker1.getPosition());
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
    function updatePosition1(latLng)
    {
         jQuery('#lats').val(latLng.lat());
         jQuery('#longs').val(latLng.lng());
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
<body>

	<div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12" style="background-color: #f5f5f5;">
                <img alt="Bootstrap Image Preview" src="img/HOME.png" width="200" height="100" border="0">
            </div>
            <div id="bartolo" align= "center" style="margin:0 auto 0 auto; left: 40%;" >
              <a href="creaciones.php"><img src="img/logo1.png" width="70" height="70" border="0"></a> 
              <a href="diss.php"><img src="img/logo2.png" width="70" height="70" border="0"></a>
              <a href="modificarcreaciones.php"><img src="img/logo3.png" width="70" height="70" border="0"></a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-primary text-right">
                    Creacion de Rutas
                </h3>
            </div>
        </div>
        
	<div class="row">
    	<!------------------------------------------------------------------------------------------->
		<div class="col-md-4">
        	<h3 class="text-primary">
				Nombre de la ruta
			</h3>
            <hr>
        	<div class="form-group">
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="">
            </div>
			<h3 class="text-primary">
				Selección de Vehiculo
			</h3>
      		<hr>
			
            <div class="form-group">
                 <select class="form-control" id="ruta" name="ruta" onkeyup="fAgrega();"> 
                    <?php
                        $result = mysql_query("SELECT * FROM vehiculo");
                        while($row = mysql_fetch_assoc($result))
                        {
                        ?>
                        <option  value="<?php echo($row['idvehiculo'])?>" onkeyup="fAgrega();" >
                            <?php echo($row['categoria']) ?>  <?php echo($row['placa']) ?>
                        </option>
                        <?php
                        }               
                    ?>
                  </select>
            </div>
			<h3 class="text-primary">
				Selección de Conductor
			</h3>
      		<hr>
            <div class="form-group">
                <select class="form-control" id="conductor" name="conductor" onkeyup="fAgrega();" > 
                    <?php
                          $result = mysql_query("SELECT * FROM conductor");
                          while($row = mysql_fetch_assoc($result))
                          {
                          ?>
                          <option  value="<?php echo($row['idconductor'])?>" onkeyup="fAgrega();">
                              <?php echo($row['nombre']) ?> <?php echo($row['apellido']) ?>
                          </option>
                          <?php
                          }               
                    ?>
                </select>
            </div>


			<h3 class="text-primary">
				Selección de Monitor
			</h3>
      		<hr>
            <div class="form-group">
                <select class="form-control" id="monitor" name="monitor" onkeyup="fAgrega();" > 
                    <?php
                          $result = mysql_query("SELECT * FROM monitor");
                          while($row = mysql_fetch_array($result))
                          {
                          ?>
                    <option  value="<?php echo($row['idmonitor'])?>" onkeyup="fAgrega();">
                      <?php echo($row['nombre']) ?> <?php echo($row['apellido']) ?>
                    </option>
                    <?php
                        }               
                    ?>
                </select>
            </div>
	

            <input type="hidden" class="form-control" readonly name="lat" id="lat"/>
            <input type="hidden" class="form-control" readonly name="lng" id="long"/>
            <!--campos ocultos donde guardamos los datos--> 
            <input type="hidden" class="form-control" readonly name="lats" id="lats"/>
            <input type="hidden" class="form-control" readonly name="lngs" id="longs"/>
            <input type="hidden" class="form-control" id="cursos" name="cursos" readonly>
            <input type="hidden" class="form-control" id="busquedas" name="busquedas" readonly >
            <input type="hidden" class="form-control" id="rutas" name="rutas" readonly>
            <input type="hidden" class="form-control" id="monitores" name="monitores" readonly >        
		</div>
		
        <!------------------------------------------------------------------------------------------->
        
       	<div class="col-md-4">
        	<h3 class="text-primary">
				Selección de Estudiantes
			</h3>
      		<hr>
			<form role="form" action="" method="POST">
            	<div class="form-group">
					<input type="number" class="form-control" id="curso" name="curso" placeholder="Curso No" >
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Busqueda por Apellido">
				</div>
                <div class="form-group">
					 <button type="button" id="btnFiltro" class="btn btn-primary pull-right">GO<span class="fa fa-arrow-right"></span></button>
				</div><br><br>
			</form> 
			<input type="hidden" id="totalDrop" value="0">
                
            <div style="float:right;width:90%;height: 100px;border: none;background: url('img/bg.png') no-repeat;background-size:40%; background-position:right;position:absolute; margin-top:-10px"></div>
            <div id="container-field"></div>
            <div id="container-player"></div>
            <div id="divDrag" style="position:absolute; margin-top:40px; width:96%;height: 448px">
            </div>
            
        
		</div>
        
        <!------------------------------------------------------------------------------------------->
		
        <div class="col-md-4">
			<h3 class="text-primary">
				Punto Origen de Ruta
			</h3>
      		<hr>
			<form role="form" id="google" name="google" action="#">
				<div class="form-group">
					<input class="form-control" type="text" id="direccion" name="direccion" value="" placeholder="Punto de Origen Ruta"/>
				    <button type="submit" id="pasar" class="btn btn-primary pull-right">GO<span class="fa fa-arrow-right"></span></button>
      		    </div>
			</form> 
      		</br>
      
			
			<div class="row">
				<div class="col-md-12">
                    <!-- div donde se dibuja el mapa-->
                    <div id="map_canvas" style="width:100%;height:200px;"></div>
				</div>
			</div>
			<h3 class="text-primary">
				Punto Destino de Ruta
			</h3>
     	 	<hr>
			<form role="form" id="google" name="google" action="#">
				<div class="form-group">
                    <input class="form-control" type="text" id="direccions" name="direccions" value="" placeholder="Punto de Destino Ruta"/>
                    <button type="submit" id="pasars" class="btn btn-primary pull-right">GO<span class="fa fa-arrow-right"></span></button>
				</div>
        		</br>
				   <!-- div donde se dibuja el mapa-->
    			<div id="map_canvass" style="width:100%;height:200px;"></div>
			</form>
            
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
            
            <div class="form-group">
                <button type="button" id="btnCrearRuta" class="btn btn-primary pull-right">Crear ruta<span class="fa fa-arrow-right"></span></button>
            </div>
		</div>
        
        <!------------------------------------------------------------------------------------------->
        
	</div>
</div>
        <script>
					$(function($){
						$("#btnFiltro").click(function(e) {
							var curso = $("#curso").val();
							var apellido = $("#busqueda").val();
                            var usuario = {
								curso: curso,
								apellido: apellido
							}
							EnviarDatos(usuario,"ActionListarEstudiantes.php","FILTRO");
                        });
						$("#btnCrearRuta").click(function(e) {
							
							var ruta = $("#ruta").val();
							var monitor = $("#monitor").val();
							var lat = $("#lat").val();
							var lng = $("#long").val();
							var lats = $("#lats").val();
							var lngs = $("#longs").val();
							var conductor = $("#conductor").val();
							var cursos = $("#cursos").val();
							var nombreruta = $("#txtNombre").val();
							
							if($.trim(nombreruta) != ""){
								
								var datos = {
									ruta: ruta,
									monitor: monitor,
									lat: lat,
									lng: lng,
									lats: lats,
									lngs: lngs,
									conductor: conductor,
									cursos: cursos,
									nombre: nombreruta
								}
								EnviarDatos(datos,"ActionInsertarRuta.php","CREARRUTA");
							}
                        });
						
						/*$("#divDrag").append('<div class="drag" id="drag4" number="4" style="left:10px;top:170px;" status="0"><a class="boxclose" id="back4" number="4" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">Estudiante</div></div>');
						$("#divDrag").append('<div class="drag" id="drag5" number="5" style="left:80px;top:170px;" status="0"><a class="boxclose" id="back5" number="5" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">Estudiante</div></div>');*/
						
						
						
						//$("#divDrag").append('');
						 //var text = watermark.text;
							//setTimeout(function () { 
							
							
							 /*watermark(['./img/shirt_r.png'])
							.image(text.center('', '18px Josefin Slab', '#000', 0, 48))
							.then(function (img) {
								
							})*/
							
						//}, 1000);
						
					
					});
					</script>
	







<footer class="footer">
   <img alt="" src="images/logo.png" width="300" height="110"  border="0">
</footer>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
  </body>
</html>