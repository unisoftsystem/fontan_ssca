<?php
/* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes

    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    //sesion a variable
     $_SESSION['userid'] = $id;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ENVIO DE MENSAJES AL MONITOR</title>
<link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" href="css/styles.css"/>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/menu.css" rel="stylesheet"/>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/style.js"></script>	
<script type="text/javascript" src="js/ConexionWebService.js"></script>
<!--<script type="text/javascript" src="js/ValidacionUsuario.js"></script>-->
<link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/alertify.js"></script>
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<script src="js/script.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/photobooth.js"></script>
<style>
	input, select, textarea{
		border-radius:8px;
	}
	textarea{
		height:200px;
	}
</style>
</head>

<body id="bodyBase">
<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion"><?php echo $id;?></label></h4>
<h2 align="right" style="margin-top:2%; margin-right:2%; color:#00C">MENSAJERIA PARA ACUDIENTES</h2>
	<?php
        $query1  = "SELECT * FROM usuarios_sistema where  idUsuario='".$id."'";
        $result1 = mysql_query($query1);

        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $permisos = stripslashes($rows['permisos']);
        }
        ?>
        <div id='cssmenu'>
            <ul>
                  <?php
                  $pos = strpos($permisos, "CREACION CONDUCTORES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='CrearConductores.html' title=\"Gestion de Conductores\"><h6><p class=\"full-circle\"></p><span>Gestion de Conductores</span></h6></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "CREACION MONITORES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li class=''><a href='CrearMonitor.html' title=\"Gestion de Monitores\"><h6><p class=\"full-circle\"></p><span>Gestion de Monitores</span></h6></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "CREACION VEHICULOS");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li class=''><a href='CrearVehiculos.html' title=\"Gestion de Vehiculos\"><h6><p class=\"full-circle\"></p><span>Gestion de Vehiculos</span></h6></a></li>";
                  }
                  ?>
               
               <li class=''><a href='#' title="Gestion de Rutas Escolares"><h6><p class="full-circle"></p><span>Gestion de Rutas Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "CREACION RUTAS ESCOLARES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='creaciones.php' title=\"Administracion Rutas Escolares\"><span>Administracion Rutas Escolares</span></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "TRACKING RUTAS ESCOLARES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='diss.php' title=\"Tracking Time - Real\"><span>Tracking Time - Real</span></a></li>";
                  }
                  ?>
                  <li><a href='AvisosyObservaciones.html' title="Avisos y Observaciones"><span>Avisos y Observaciones</span></a></li>
                  </ul>
                  </li>
                  <?php
                  $pos = strpos($permisos, "CREAR MENSAJES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li ><a href='#' title=\"Mensajeria\"><span>Mensajeria</span></a><ul style=\"margin-right:-42%\"><li><a href='MensajesAcudientes.php' title='Mensajeria para acudientes'><span>Mensajeria para acudientes</span></a></li></ul></li>";
                  }
                  ?>
               
               <li ><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                    <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "REPORTES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                 echo "<li><a href='ReporteEstadodeCuenta.html' title=\"Reporte Estado de Cuenta\"><span>Reporte Estado de Cuenta</span></a></li>";
                  echo "<li><a href='ReporteRutas.php' title=\"Reporte Asignacion de Ruta\"><span>Reporte Asignacion de Ruta</span></a></li>";
                  echo "<li><a href='ReporteMensajeAcudiente.php' title=\"Reporte Mensajeria de Acudientes\"><span>Reporte Mensajeria de Acudientes</span></a></li>";
                  echo "<li><a href='BitacoradeRecogidasyentregas.html' title=\"Bitacora de Recogidas y entregas\"><span>Bitacora de Recogidas y entregas</span></a></li>";
                  echo "<li><a href='ReporteAlarmas.php' title=\"Alarmas generadas en trayectos\"><span>Alarmas generadas en trayectos</span></a></li>";
				  echo "<li><a href='ReporteMensajeCoordinador.php' title=\"Reporte Mensajeria de Coordinador a Acudientes\"><span>Reporte Mensajeria de Coordinador a Acudientes</span></a></li>";
                  }
                  ?>
                    </ul>
               </li>
            </ul>

        </div>
<div class="contenidoBorde">

	<div class="container-fluid" style="margin-top:2%;margin-right:20px; width:100%" align="center">
        <form class="cmxform" id="commentForm" method="get" action="">
        <div class="row" align="center">
            <div class="col-md-5" style="background-color: #f5f5f5; border: 1px #333333 solid; border-radius:8px; padding-bottom:10px; margin-left:5%">
                	<input type="radio" id="radio1" name="opcion" value="ruta" class="form-control radio"/><br>
                    <label for="radio1" style="width:100%">ESCOGER UNA RUTA</label>
                    <select id="selectRuta" name="selectRuta" class="form-control">
                    </select>
            </div>
            <div class="col-md-5" style="background-color: #f5f5f5; border: 1px #333333 solid; border-radius:8px; margin-left:10px; padding-bottom:10px; margin-left:5%">
                	<input type="radio" id="radio2" name="opcion" value="estudiante" class="form-control"/><br>
                    <label for="radio2" style="width:100%">ESCOGER UN ESTUDIANTE</label>
                    <select id="selectEstudiante" name="selectEstudiante" class="form-control">
                    </select>
            </div>            
        </div>
        <br>
        <div class="row" align="center" style="width:100%">
            <div class="col-md-12">
            	<textarea id="textAreaMensaje" name="textAreaMensaje" style="width:100%" placeholder="Mensaje"></textarea>
            </div>
        </div>
        
        <div class="row" align="right" style="width:100%">
            <div class="col-md-12" style="background-color: #f5f5f5;">
            	<button class="btn btn-primary" type="submit">Enviar Mensaje</button>
            </div>
        </div>
        </form>
	</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
	/*
		Fecha: 			Octubre 22 de 2015
		Descripcion: 	Script para enviar los datos al webservice para que los inserte en la base de datos
	
	*/
	
	//Valor guardado cuando se cierra un popup y se concreto una operación
	var opcionSeleccionar = "";
		
	//Capturar evento del boton crear
	$.validator.setDefaults({
		//Capturar evento del boton crear
		submitHandler: function() {

			if($('input[name="opcion"]:checked').length > 0){
				
				switch($("input[name=opcion]:checked").val()){
					case "ruta":
						//alert($("#selectRuta").val());
						var usuario = $("#usuarioSesion").html(); 
						var idRuta = $("#selectRuta").val();
						var mensaje = $("#textAreaMensaje").val();
						var tipo = $("input[name=opcion]:checked").val();
						/*
							Descripcion: Obtener fecha y hora para registrar movimientos
						*/
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
						
						var fechaActual = year + "-" + mes + "-" + dia;
						var horaActual = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(); 
						//Se guardan los datos en un JSON
						var datos = {
							coordenadas: "0, 0",
							idUsuario: usuario,
							fecha: fechaActual,
							hora: horaActual,
							idRuta: idRuta,
							mensaje: mensaje,
							tipo: tipo,
							idEstudiante: ""
						}   
						$.post("ActionInsertarMensajeaMonitor.php", datos)
						.done(function( data ) {
							console.log($.trim(data));
							if($.trim(data) == "1"){
								alert("¡Se envio con exito el mensaje!");				
								window.location.href = "MensajesAcudientes.html";				
								
							}
						});	
						break;
					case "estudiante":
						//alert($("#selectEstudiante").val());
						var usuario = $("#usuarioSesion").html(); 
						var idEstudiante = $("#selectEstudiante").val();
						var mensaje = $("#textAreaMensaje").val();
						var tipo = $("input[name=opcion]:checked").val();
						/*
							Descripcion: Obtener fecha y hora para registrar movimientos
						*/
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
						
						var fechaActual = year + "-" + mes + "-" + dia;
						var horaActual = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(); 
						//Se guardan los datos en un JSON
						var datos = {
							coordenadas: "0, 0",
							idUsuario: usuario,
							fecha: fechaActual,
							hora: horaActual,
							idRuta: "",
							mensaje: mensaje,
							tipo: tipo,
							idEstudiante: idEstudiante
						}   

						$.post("ActionEnviarMensajeaAcudientes.php", datos)
						.done(function( data ) {
							console.log($.trim(data));
							if($.trim(data) == "1"){
								alert("¡Se envio con exito el mensaje!");				
								window.location.href = "MensajesAcudientes.php";				
								
							}
						});	
						break;
				}
			}else{
				alert("¡Debe seleccionar una opcion a realizar!");				
			}
			
		}
	});
	
	(function() {
		// use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
		$("#commentForm").tooltip({
			show: false,
			hide: false
		});
	
		// validate signup form on keyup and submit
		$("#commentForm").validate({
			rules: {
				textAreaMensaje: "required"
			},
			messages: {
				textAreaMensaje: "Por favor ingrese un mensaje"
			}
		});
	
	})();

	$("input[name=opcion]").change(function(e) {
        
		switch($("input[name=opcion]:checked").val()){
			case "ruta":
				//alert($("input[name=opcion]:checked").val() + " 01");
				$.post("ActionListarTodasRutas.php", {})
				.done(function( data ) {
					var json = JSON.parse(data);
					
					$("#selectRuta").empty();
					for(i = 0; i < json.length; i++){
						$("#selectRuta").append('<option value="' + json[i].id + '">' + json[i].nombreruta + '</option>');
					}
				});	
				break;
			case "estudiante":
				//alert($("input[name=opcion]:checked").val() + " 02");
				$.post("ActionListarTodosEstudiantes.php", {})
				.done(function( data ) {
					var json = JSON.parse(data);
					
					$("#selectEstudiante").empty();
					for(i = 0; i < json.length; i++){
						$("#selectEstudiante").append('<option value="' + json[i].idUsuario + '">' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + ' ' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + '</option>');
					}
				});	
				break;
		}
    });
	/*
		Fecha: 23 de Octubre de 2015
		Descripcion: Evento para capturar la existencia del usuario en la base de datos al quitar el focus del campo de texto de usuario
	*/
	window.addEventListener('load',init);
	function init(){
		
		
	}
	$("#Salir").click(function(e) {
		localStorage.removeItem("usuario");
		localStorage.removeItem("tipoUsuario");
		window.location.href = "index.html";
	});
</script>
</body>
</html>
