
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	
	$query  = "SELECT u.`idUsuario` AS idEstudiante, u.`TipoId` AS TipoIdEstudiante, u.`NumeroId` AS NumeroIdEstudiante, u.`PrimerApellido` AS PrimerApellidoEstudiante, u.`SegundoApellido` AS SegundoApellidoEstudiante, u.`PrimerNombre` AS PrimerNombreEstudiante, u.`SegundoNombre` AS SegundoNombreEstudiante, u.`ImagenFotografica` AS FotoEstudiante, u.`idAcudiente`  AS IdAcudienteEstudiante, u.`Direccion` AS DireccionEstudiante, u.`Telefono1` AS TelefonoPEstudiante, u.`Telefono2` AS TelefonoSEstudiante, u.`Estado` AS EstadoEstudiante, u.`Coordenadas` AS CoordenadasEstudiante, u.`latitud` AS LatitudEstudiante, u.`longitud` AS LongitudEstudiante, curso.Descripcion AS CursoEstudiante, u.`TipoSangre` AS TipoSangreEstudiante, a.nombreruta AS Ruta, a.latorigen AS LatOrigenRuta, a.longorigen AS LongOrigenRuta, a.latdestino AS LatDestinoRuta, a.longdestino AS LongDestinoRuta, v.`marca` AS VehiculoMarca, v.`categoria` AS VehiculoCateg, v.`placa` AS VehiculoPlaca, v.`sillas` AS VehiculoSillas, v.`observaciones` AS VehiculoObser, v.`ImagenFotografica` AS VehiculoFoto, v.`coordenadas` AS VehiculoCoord, m.`idmonitor` AS IdMonitor, m.`nombre` AS NombreMonitor, m.`apellido` AS ApellidoMonitor, m.`telefono` AS TelefonoMonitor, m.`TipoId` AS TipoIdMonitor, m.`ImagenFotografica` AS FotoMonitor, m.`Direccion` AS DireccionMonitor, m.`Estado` AS EstadoMonitor, cond.`idconductor` AS ConductorId, cond.`nombre` AS ConductorNombre, cond.`apellido` AS ConductorApellido, cond.`direccion` AS ConductorDirecion, cond.`telefono` AS ConductorTelefono, cond.`TipoId` AS ConductorTipoId, cond.`ImagenFotografica` AS ConductorFoto, cond.`Estado` AS ConductorEstado, cond.`Coordenadas` AS ConductorCoordena FROM cart c INNER JOIN asignacionruta a ON a.id = c.ruta INNER JOIN usuarios u ON u.NumeroId = c.valores  INNER JOIN vehiculo v ON v.idvehiculo = a.idruta INNER JOIN monitor m ON m.idmonitor = a.monitor INNER JOIN conductor cond ON cond.idconductor = a.id_conductor INNER JOIN cursos curso ON curso.id =  u.curso ORDER BY a.id";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		if($contador == 1){
			$jsonAcudientes .= json_encode($registro);	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= ',' . json_encode($registro);
			}
		}
		$contador+=1;
	}	
	$jsonAcudientes .= "]";		
  	echo $jsonAcudientes;
	
?>