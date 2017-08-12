
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIR_DATA . '/DataOrdenPedido.php');
	include_once(DIR_DATA . '/DataMovimientos.php');
	include_once(DIR_CONTROLLER . '/Controller_OrdenPedido.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Movimientos.php');
	include_once(DIR_CONTROLLER . '/Controller_Producto.php');
	
	$idCredencial = $_REQUEST["idCredencial"];
	$usuario = $_REQUEST["usuario"];
	$descripcionPedido = $_REQUEST["descripcionPedido"];
	$ubicacionPedido = $_REQUEST["ubicacionPedido"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	$total = $_REQUEST["total"];
	$horaEntrega = $_REQUEST["horaEntrega"];
	$fechaEntrega = $_REQUEST["fechaEntrega"];
	$detalle = $_REQUEST["detalle"];
	$turno = 0;
	$conexionBD = new ConexionBD();
	$conexion = $conexionBD->conectar();
	
	

	$dataOrdenPedido = new DataOrdenPedido();
	$controller_OrdenPedido = new Controller_OrdenPedido();
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Movimientos = new Controller_Movimientos();
	$controller_Producto = new Controller_Producto();
		
	if($ubicacionPedido == "ALISTAMIENTO"){
		$sqlTurno = "SELECT * FROM `ordenpedido` WHERE `ConsecutivoTurno`!= 0 ORDER BY `id` DESC LIMIT 1";
		$resultTurno = mysqli_query($conexion, $sqlTurno);

		if(mysqli_num_rows($resultTurno) > 0){
			$registroTurno = mysqli_fetch_array($resultTurno);
			if($registroTurno["ConsecutivoTurno"] < 50){
				$turno = $registroTurno["ConsecutivoTurno"] + 1;
			}else{
				$turno = 1;
			}
			
		}else{
			$turno = 1;
		}
		
	}
	
	$sql = "SELECT id FROM ordenpedido ORDER BY id DESC LIMIT 1";
	$resultId = mysqli_query($conexion, $sql);
	$registro = mysqli_fetch_array($resultId);
	$id = $registro["id"] + 1;

	$dataOrdenPedido->setIdUsuario($usuario);
	$dataOrdenPedido->setIdCredencial($idCredencial);

	$dataOrdenPedido->setConsecutivoTurno($turno);
	$dataOrdenPedido->setConsecutivoInterno($id);
	$dataOrdenPedido->setDescripcionPedido($descripcionPedido);
	$dataOrdenPedido->setUbicacionPedido($ubicacionPedido);	
	$dataOrdenPedido->setHoraEntrega($horaEntrega);	
	$dataOrdenPedido->setFechaEntrega($fechaEntrega);	
	$dataOrdenPedido->setOrigen("APP");	
	//Llamar la funcion que lista las categorias
	$resultOrdenPedido = $controller_OrdenPedido->CrearPedido($dataOrdenPedido);

	$dataMovimientoDetalles = new DataMovimientos();
	$dataMovimientoNumeroOrden = new DataMovimientos();
	
	$dataMovimientoDetalles->setIdUsuario($usuario);	
	$dataMovimientoDetalles->setIdCredencial($idCredencial);
	$dataMovimientoDetalles->setValorMovimiento($total);	
	$dataMovimientoDetalles->setFechaMovimiento($fecha);	
	$dataMovimientoDetalles->setHoraMovimiento($hora);
	$dataMovimientoDetalles->setDescripcionMovimiento("No. Pedido " . $resultOrdenPedido . ":" . $descripcionPedido);	
	$dataMovimientoDetalles->setOrigen("APP");	
	
	$dataMovimientoNumeroOrden->setIdUsuario($usuario);	
	$dataMovimientoNumeroOrden->setIdCredencial($idCredencial);
	$dataMovimientoNumeroOrden->setValorMovimiento($total * (0.0006));	
	$dataMovimientoNumeroOrden->setFechaMovimiento($fecha);	
	$dataMovimientoNumeroOrden->setHoraMovimiento($hora);
	$dataMovimientoNumeroOrden->setDescripcionMovimiento("No de pedido: " . $resultOrdenPedido);
	$dataMovimientoNumeroOrden->setOrigen("APP");		
	
	//Llamar la funcion que registra los movimientos
	$resultMovimientoTarjeta = $controller_Movimientos->CrearMovimiento($dataMovimientoDetalles);
	$resultMovimientoRecarga = $controller_Movimientos->CrearMovimiento($dataMovimientoNumeroOrden);
	
		
	
	//Cambiar saldo de la credencial
	$saldoActual = $controller_Credenciales->ObtenerSaldoActual($idCredencial);
	//$totalSaldo = $saldoActual - ($total + ($total * 0.0006));
	$totalSaldo = $saldoActual - $total;
	$resultCambuiarSaldo = $controller_Credenciales->CambiarSaldo($idCredencial, $totalSaldo);
	
	$detalleProducto = explode(",", $detalle);
	foreach ($detalleProducto as $valor) {
		$producto = explode(":", $valor);
		$codigoProducto = $producto[0];
		$cantidad = $producto[1];
		$total = $producto[2];
		$query = "INSERT INTO `Detalle_OrdenPedido`(`idOrdenPedido`, `codigoProducto`, `cantidad`, `total`) VALUES ('$resultOrdenPedido','$codigoProducto','$cantidad','$total')";
		$result = mysqli_query($conexion, $query);
		//$resultProductos = $controller_Producto->DisminuirStock($codigoProducto, $cantidad);	
	}

	echo '[{"turno":"' . $turno . '", "saldoActual":"' . $totalSaldo . '", "id":"' . $resultOrdenPedido . '", "ubicacionPedido":"' . $ubicacionPedido . '"}]';
	
	
	
	
	
	
	
?>