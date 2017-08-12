<?php
include("connect.php");
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
        <title>SSCA</title>
        <link href="css/styler.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="dist/tablefilter/style/tablefilter.css">
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>	
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
		<script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
       <style>
			label, select{
				color:#00C;
			}
		</style>
    
    
    </head>
    <body id="bodyBase">
    <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion" style="color:#CCC"><?php echo $id;?></label></h4>
<h2 align="right" style="margin-top:2%; margin-right:2%; color:#00C">Reportes de Caja</h2>
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
               <li><a href='#' title="Recaudos"><h6><p class="full-circle"></p><span>Recaudos</span></h6></a>
                    <ul style="margin-right:-42%">
                         <?php
                          $pos = strpos($permisos, "CREAR PAGO INICIAL SERVICIOS");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='asignacionpagoinicial.php' title=\"Pago Inicial de Servicios\"><span>Pago Inicial de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "CREAR RECAUDO SERVICIOS");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recaudo de Servicios\" ><a href='RecaudodeServicios.html'><span>Recaudo de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "CREAR RECARGUE DE CREDENCIALES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recargue de Credenciales\" ><a href='ProcesoRecaudo.php'><span>Recargue de Credenciales</span></a></li>";
                          }
                          ?>
                    </ul>
               </li>
               <li class=''><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "REPORTES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReporteRecaudo.php' title=\"Cierre de Caja\"><span>Cierre de Caja</span></a></li>";
                          }
                          ?>
                          <?php
                          $pos = strpos($permisos, "REPORTES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Generacionestadosdecuenta.html' title=\"Generacion estados de cuenta\"><span>Generacion estados de cuenta</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
               <li><a href='#' title="Mensajeria"><h6><p class="full-circle"></p><span>Mensajeria</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "COBRO SERVICIOS ESCOLARES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Cobrodeserviciosescolaresalosacudientes.html'><span>Cobro de servicios escolares a los acudientes</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
            </ul> 
        </div>
    <div class="contenidoBorde">
    <br><br>

    <table align="center" width="100%">
		<tr>
        	<td><label for="selectUsuario">Cajero</label></td>
            <td>
            	<select class="form-control" id="selectUsuario" name="selectUsuario">
                	<?php
						$queryCajero  = "SELECT * FROM `usuarios_sistema` WHERE permisos LIKE '%CREAR RECARGUE DE CREDENCIALES%'";
						$resultCajero = mysql_query($queryCajero);
				
						while($rowCajero = mysql_fetch_array($resultCajero, MYSQL_ASSOC))
						{ 
							$NombreCompletoCajero = stripslashes($rowCajero['PrimerNombre']) . " " . stripslashes($rowCajero['SegundoNombre']) . " " . stripslashes($rowCajero['PrimerApellido']) . " " . stripslashes($rowCajero['SegundoApellido']);
							$idUsuarioCajero = stripslashes($rowCajero['idUsuario']);
					?>
                    	<option value="<?php echo $idUsuarioCajero;?>"><?php echo $NombreCompletoCajero;?></option>
                    <?php
							
						}
					?>
                </select>
            </td>
        </tr>    
        <tr>
            <td><label for="dateFechaInicial">FECHA INICIAL:&nbsp;</label></td>
            <td><input class="form-control" type="date" name="dateFechaInicial" id="dateFechaInicial"/></td>        
        </tr>
        <tr>
            <td><label for="dateFechaFinal">FECHA FINAL:&nbsp;</label></td>
            <td><input class="form-control" type="date" name="dateFechaFinal" id="dateFechaFinal"/></td>        
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><button type="button" name="btnExportarReporte" id="btnExportarReporte" class="btn btn-primary" style="margin-right: 10px; visibility: hidden;"><b>EXPORTAR EXCEL</b></button><button type="button" name="btnGenerarReporte" id="btnGenerarReporte" class="btn btn-primary"><b>GENERAR REPORTE</b></button></td>
        </tr>
        <tr>
            <td colspan="2" height="20px">&nbsp;</td>
        </tr>
    </table>
      <h2 id="h2Total" align="right"></h2>
	<table id="demo" width="100%">
        <thead>
            <tr>
                <th>Id Usuario</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Acudiente</th>
                <th>Numero de Indentificacion del Acudiente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripcion</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            
        </tbody>
    </table>

      
       </div>   
       <script src="dist/tablefilter/tablefilter.js"></script>
			<script>
            
                //Configuracion de la tabla    
                var filtersConfig = {
                    base_path: 'dist/tablefilter/',
                    paging: true,//Activar o no la paginacion
                    results_per_page: ['Filas: ', [10,25,50,100]],//Numero de registros a mostrar en cada pagina
                    auto_filter: true,//Aceptar o no filtro automatico cuando se empieza a escribir
                    auto_filter_delay: 1100, //milliseconds
                    filters_row_index: 1,
                    remember_page_number: true,
                    remember_page_length: true,
                    alternate_rows: true,
                    grid_layout: true,
                    grid_width: '100%',//Ancho de la tabla
                    alternate_rows: true,
                    btn_reset: true,//Activar el boton de resetear los campos de filtro
                    rows_counter: true,
                    loader: true,
                    status_bar: true,
          					col_0: 'none',//Configurar el filtro de la columna con select
          					col_1: 'none',//Configurar el filtro de la columna con select
          					col_2: 'none',//Configurar el filtro de la columna con select
                    col_3: 'none',//Configurar el filtro de la columna con select
                    col_4: 'none',//Configurar el filtro de la columna con select
          					col_5: 'none',//Configurar el filtro de la columna con select
          					col_6: 'none',//Configurar el filtro de la columna con select
                    
                    extensions:[
                        {
                            name: 'sort',
                            types: [
                                'number', 'string', 'string',
                                'number', 'string', 'string',
                                'number'
                            ]
                        }
                    ]
                };
            	
            </script>
      <script type="text/javascript">
        /*
          Fecha:      Octubre 24 de 2015
          Descripcion:  Script para enviar los datos al webservice para que los inserte en la base de datos
        
        */
        
        //Valor guardado cuando se cierra un popup y se concreto una operación
        var opcionSeleccionar = "";
          
        //Capturar evento del boton crear
        $("#btnGenerarReporte").click(function(e) {
			//Se obtienen los datos a enviar    
			var usuarioSeleccionado = $("#selectUsuario").val();
			var fechaInicial = $("#dateFechaInicial").val();
			var fechaFinal = $("#dateFechaFinal").val();
			
			//Se guardan los datos en un JSON
			var usuario = {
				usuario: usuarioSeleccionado,
				fechaInicial: fechaInicial,
				fechaFinal: fechaFinal
			}   
			
     
			//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
			EnviarDatos(usuario, "ActionReporteRecaudo.php", "REPORTERECAUDO");
		
		
		
		});
        
        window.addEventListener('load',init);
        function init(){

          
          
        }
        $("#Salir").click(function(e) {
			localStorage.removeItem("usuario");
			localStorage.removeItem("tipoUsuario");
			window.location.href = "index.html";
		});
      $("#btnExportarReporte").click(function(e) {
        var usuarioSeleccionado = $("#selectUsuario").val();
        var fechaInicial = $("#dateFechaInicial").val();
        var fechaFinal = $("#dateFechaFinal").val();
        var win = window.open("exportar.php?usuario=" + usuarioSeleccionado + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, '_blank');
        win.focus();  
          
      });
		$(".flt").keypress(function(e) {
            
        });
        
      </script>
        
		<script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>