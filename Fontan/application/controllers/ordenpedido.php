<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Ordenpedido extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('ordenpedido_model');//Cargar el modelo de orden de pedido donde estan las funciones que hacen las consultas a la bd
		$this->load->model('reversion_pedido_model');//Cargar el modelo de reversion de pedido donde estan las funciones que hacen las consultas a la bd
		$this->load->model('detalle_orden_pedido_model');//Cargar el modelo de detalle de orden de pedido donde estan las funciones que hacen las consultas a la bd
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('movimientos_model');//Cargar el modelo de movimientos donde estan las funciones que hacen las consultas a la bd
		$this->load->model('producto_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('pagos_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('categoria_model');//Cargar el modelo de categoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}
	/**************** MOSTRAR PAGINAS **********************************/
	public function index()
	{
		
	}

	//Mostrar la vista de agregar productos al pedido a crear
	function cajeroProductos(){		
    	//$this->load->library('logo_footer');
		$data['titulo'] = "Pedidos de Cafeter&iacute;a & Restaurante";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		if($this->session->userdata('PedidoSSCASESSION') == null){
			$this->session->set_userdata("PedidoSSCASESSION", "[]");
		}
		/*$logo_footer = $this->logo_footer->obtener_logo();
		$datos_footer = [
			'logo' => $logo_footer
		];*/
		$array_page = [
			//'footer' =>  $this->load->view('footerPages', $datos_footer, true)
		];
		$this->load->view('orden_pedido/cajero_productos', $array_page);
		
	}

	//Mostrar la vista de lectura de QR para crear un pedido
	function cajero(){
    	//$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../ordenpedido/cajero", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){
			$data['titulo'] = "SSCA";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			/*$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];*/
			$array_page = [
				//'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('orden_pedido/cajero', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de lectura de QR para entrar al restaurante
	function lecturaQREntrada(){
    	//$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../ordenpedido/lecturaQREntrada", $this->session->userdata('UserIDInternoSSCA'));	
		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){
			$data['titulo'] = "SSCA";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			/*$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];*/
			$array_page = [
				//'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('orden_pedido/lecturaQREntrada', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de reporte de cafeteria
	function ReporteCafeteriaDias(){
    	//$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../ordenpedido/ReporteCafeteriaDias", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$data['titulo'] = "Reporte Cafeteria";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			/*$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];*/
			$array_page = [
				//'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('orden_pedido/reportecafeteriadias', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de reporte de ventas
	function ReporteVentasDias(){
    	//$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../ordenpedido/ReporteVentasDias", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$data['titulo'] = "Reportes de Ventas";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			/*$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];*/
			$array_page = [
				//'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('orden_pedido/reporteventasdias', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de reversion de pedidos
	function reversionPedidos(){
    	//$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../ordenpedido/reversionPedidos", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$data['titulo'] = "Reversion de Ordenes de Pedido";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			/*$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];*/
			$array_page = [
				//'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('orden_pedido/reversionPedidos', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/***************** ACCIONES ****************************/
	//Funcion para consultar un usuario ya sea por id o por credencial
	function ActionConsultarUsuarioPorId(){
		$resultadoPorId = $this->credenciales_model->ConsultarUsuarioPorId($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultadoPorId != "[]"){
			echo $resultadoPorId;
			
		}else{
			$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			echo $resultadoPorCredencial;
		}
	}

	function getMonth_Text($m) { 
		$month_text = "";
		switch ($m) { 
			case 1: $month_text = "Enero"; break; 
			case 2: $month_text = "Febrero"; break; 
			case 3: $month_text = "Marzo"; break; 
			case 4: $month_text = "Abril"; break; 
			case 5: $month_text = "Mayo"; break; 
			case 6: $month_text = "Junio"; break; 
			case 7: $month_text = "Julio"; break; 
			case 8: $month_text = "Agosto"; break; 
			case 9: $month_text = "Septiembre"; break; 
			case 10: $month_text = "Octubre"; break; 
			case 11: $month_text = "Noviembre"; break; 
			case 12: $month_text = "Diciembre"; break; 
		} 
		return $month_text; 
    } 

	//Funcion para generar un almuerzo solo con tener el idCredencial y el usuario logueado que tiene acceso a este servicio
	function GenerarAlmuerzo(){		
		$resultado = array();
		$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		//Se verifica que se genero resultado al consultar el usuario
		if($resultadoPorCredencial != "[]"){
			//Se convierte el resultado a un objeto json
			$obj = json_decode($resultadoPorCredencial);
			foreach($obj as $array){
				switch ($array->TipoUsuario) {
					case 'Estudiante':

						if($array->fechanacimiento != "0000-00-00" && $array->fechanacimiento != ""){

							/*$y = date("Y");
							$m = date("m");
							$mes = "Restaurante " . $this->getMonth_Text($m) . " " . $y;				
							$pago = $this->pagos_model->ConsultarPagoRestaurante($array->NumeroId, $mes);//Se llama a la funcion de que esta en modelo	

							if($pago > 0){*/
								$producto = $this->producto_model->ObtenerStock("23");//Se llama a la funcion de que esta en modelo y el resultado se guarda	

								if($producto != null){								

									if($array->edad >= $producto->result()[0]->edad && $array->edad <= $producto->result()[0]->edad_max){
										if($array->SaldoCredencial >= $producto->result()[0]->ValorUnitario){
											//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos

											if($producto->result()[0]->Stock > 0){

												$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

												//Se guardan los datos en un array asociativo para pasarlos la funcion del model
												$datos = array(
													'idUsuario' => $array->idUsuario,
													'idCredencial' => $array->idCredencial,
													'ConsecutivoTurno' => "0",
													'ConsecutivoInterno' => $id,
													'DescripcionPedido' => "1 " . $producto->result()[0]->NombreProducto,
													'UbicacionPedido' => "ENTREGADO",
													'HoraEntrega' => "0000-00-00",
													'FechaEntrega' => "0000-00-00",
													'OrigenPedido' => "ENTRADARESTAURANTE");
												//Se llama a la funcion de guardar datos en bd que esta en el modelo
												$this->ordenpedido_model->crear($datos);//Se llama a la funcion de que esta en modelo

												//Se guardan los datos en un array asociativo para pasarlos la funcion del model
												$arrayDetalleMovimiento = array(
													'idUsuario' => $_POST["usuarioSesion"],
													'idCredencial' => $array->idCredencial,
													'ValorMovimiento' => $producto->result()[0]->ValorUnitario,
													'FechaMovimiento' => "0000-00-00",
													'HoraMovimiento' => "0000-00-00",
													'DescripcionMovimiento' => "No. Pedido " . $id . ":" . "1 " . $producto->result()[0]->NombreProducto,
													'OrigenPedido' => "ENTRADARESTAURANTE");
												$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

												//Se guardan los datos en un array asociativo para pasarlos la funcion del model
												$arrayImpuesto = array(
													'idUsuario' => $_POST["usuarioSesion"],
													'idCredencial' => $array->idCredencial,
													'ValorMovimiento' => ($producto->result()[0]->ValorUnitario * (0.0006)),
													'FechaMovimiento' => "0000-00-00",
													'HoraMovimiento' => "0000-00-00",
													'DescripcionMovimiento' => "No de pedido: " . $id,
													'OrigenPedido' => "ENTRADARESTAURANTE");
												$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

												//Se obtiene el saldo actual
												$saldoActual = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

												//Se calcula el saldo por haber realizado el pedido
												$totalSaldo = $saldoActual - $producto->result()[0]->ValorUnitario;

												//Se cambia el saldo
												$this->credenciales_model->CambiarSaldo($array->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

												//Se guardan los datos en un array asociativo para pasarlos la funcion del model
												$arrayDetalle = array(
													'idOrdenPedido' => $id,
													'codigoProducto' => $producto->result()[0]->codigoProducto,
													'cantidad' => "1",
													'total' => $producto->result()[0]->ValorUnitario);
												$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		

												//Se disminuye el stock del producto iterado
												$this->producto_model->DisminuirStock($producto->result()[0]->codigoProducto, 1, $_POST["usuarioSesion"], "DISMINUIR STOCK POR GENERAR ALMUERZO EN PEDIDO " . $id);//Se llama a la funcion de que esta en modelo

												$saldoAc = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

												$resultado["mensaje"] = "<h4>Se ha registrado con exito el almuerzo</h4><br><p>El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante.</p><br>Saldo Actual: " . $saldoAc;
												$resultado["ImagenFotografica"] = $array->ImagenFotografica;

												//Se guardan los datos en un array asociativo para pasarlos la funcion del model
												$datosLog = array(
													'idCredencial' => $array->idCredencial,
													'mensaje' => "El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante");	
												//Se llama a la funcion de guardar datos en bd que esta en el modelo
												$this->ordenpedido_model->crearLog($datosLog);//Se llama a la funcion de que esta en modelo	

												echo json_encode($resultado);
											}else{
												$resultado["mensaje"] = "La cantidad actual del almuerzo " . $producto->result()[0]->NombreProducto . " es insuficiente para realizar su compra.<br>Cantidad Actual: " . $producto->result()[0]->Stock;
												$resultado["ImagenFotografica"] = "";
												echo json_encode($resultado);
											}
										}else{
											$resultado["mensaje"] = "El Saldo actual del Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " es insuficiente para realizar la compra del almuerzo.<br>Saldo Actual: " . $array->SaldoCredencial . " . Precio del almuerzo: " . $producto->result()[0]->ValorUnitario;
											$resultado["ImagenFotografica"] = $array->ImagenFotografica;
											echo json_encode($resultado);
										}
									}else{
										$producto = $this->producto_model->ObtenerStock("24");//Se llama a la funcion de que esta en modelo y el resultado se guarda							

										if($producto != null){
											if($array->edad >= $producto->result()[0]->edad && $array->edad <= $producto->result()[0]->edad_max){
												if($array->SaldoCredencial >= $producto->result()[0]->ValorUnitario){
													//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos

													if($producto->result()[0]->Stock > 0){
														$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

														//Se guardan los datos en un array asociativo para pasarlos la funcion del model
														$datos = array(
															'idUsuario' => $array->idUsuario,
															'idCredencial' => $array->idCredencial,
															'ConsecutivoTurno' => "0",
															'ConsecutivoInterno' => $id,
															'DescripcionPedido' => "1 " . $producto->result()[0]->NombreProducto,
															'UbicacionPedido' => "ENTREGADO",
															'HoraEntrega' => "0000-00-00",
															'FechaEntrega' => "0000-00-00",
															'OrigenPedido' => "ENTRADARESTAURANTE");
														//Se llama a la funcion de guardar datos en bd que esta en el modelo
														$this->ordenpedido_model->crear($datos);//Se llama a la funcion de que esta en modelo

														//Se guardan los datos en un array asociativo para pasarlos la funcion del model
														$arrayDetalleMovimiento = array(
															'idUsuario' => $_POST["usuarioSesion"],
															'idCredencial' => $array->idCredencial,
															'ValorMovimiento' => $producto->result()[0]->ValorUnitario,
															'FechaMovimiento' => "0000-00-00",
															'HoraMovimiento' => "0000-00-00",
															'DescripcionMovimiento' => "No. Pedido " . $id . ":" . "1 " . $producto->result()[0]->NombreProducto,
															'OrigenPedido' => "ENTRADARESTAURANTE");
														$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

														//Se guardan los datos en un array asociativo para pasarlos la funcion del model
														$arrayImpuesto = array(
															'idUsuario' => $_POST["usuarioSesion"],
															'idCredencial' => $array->idCredencial,
															'ValorMovimiento' => ($producto->result()[0]->ValorUnitario * (0.0006)),
															'FechaMovimiento' => "0000-00-00",
															'HoraMovimiento' => "0000-00-00",
															'DescripcionMovimiento' => "No de pedido: " . $id,
															'OrigenPedido' => "ENTRADARESTAURANTE");
														$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

														//Se obtiene el saldo actual
														$saldoActual = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

														//Se calcula el saldo por haber realizado el pedido
														$totalSaldo = $saldoActual - $producto->result()[0]->ValorUnitario;

														//Se cambia el saldo
														$this->credenciales_model->CambiarSaldo($array->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

														//Se guardan los datos en un array asociativo para pasarlos la funcion del model
														$arrayDetalle = array(
															'idOrdenPedido' => $id,
															'codigoProducto' => $producto->result()[0]->codigoProducto,
															'cantidad' => "1",
															'total' => $producto->result()[0]->ValorUnitario);
														$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		

														//Se disminuye el stock del producto iterado
														$this->producto_model->DisminuirStock($producto->result()[0]->codigoProducto, 1, $_POST["usuarioSesion"], "DISMINUIR STOCK POR GENERAR ALMUERZO EN PEDIDO " . $id);//Se llama a la funcion de que esta en modelo

														$saldoAc = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda
														$resultado["mensaje"] = "<h4>Se ha registrado con exito el almuerzo</h4><br><p>El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante.</p><br>Saldo Actual: " . $saldoAc;
														$resultado["ImagenFotografica"] = $array->ImagenFotografica;

														//Se guardan los datos en un array asociativo para pasarlos la funcion del model
														$datosLog = array(
															'idCredencial' => $array->idCredencial,
															'mensaje' => "El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante");	
														//Se llama a la funcion de guardar datos en bd que esta en el modelo
														$this->ordenpedido_model->crearLog($datosLog);//Se llama a la funcion de que esta en modelo	
														echo json_encode($resultado);
													}else{
														$resultado["mensaje"] = "La cantidad actual del almuerzo " . $producto->result()[0]->NombreProducto . " es insuficiente para realizar su compra.<br>Cantidad Actual: " . $producto->result()[0]->Stock;
														$resultado["ImagenFotografica"] = "";
														echo json_encode($resultado);
													}
												}else{
													$resultado["mensaje"] = "El Saldo actual del Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " es insuficiente para realizar la compra del almuerzo.<br>Saldo Actual: " . $array->SaldoCredencial . " . Precio del almuerzo: " . $producto->result()[0]->ValorUnitario;
													$resultado["ImagenFotografica"] = $array->ImagenFotografica;
													echo json_encode($resultado);
												}
											}else{
												$producto = $this->producto_model->ObtenerStock("25");//Se llama a la funcion de que esta en modelo y el resultado se guarda							

												if($producto != null){									
													if($array->SaldoCredencial >= $producto->result()[0]->ValorUnitario){
														//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos

														if($producto->result()[0]->Stock > 0){
															$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

															//Se guardan los datos en un array asociativo para pasarlos la funcion del model
															$datos = array(
																'idUsuario' => $array->idUsuario,
																'idCredencial' => $array->idCredencial,
																'ConsecutivoTurno' => "0",
																'ConsecutivoInterno' => $id,
																'DescripcionPedido' => "1 " . $producto->result()[0]->NombreProducto,
																'UbicacionPedido' => "ENTREGADO",
																'HoraEntrega' => "0000-00-00",
																'FechaEntrega' => "0000-00-00",
																'OrigenPedido' => "ENTRADARESTAURANTE");
															//Se llama a la funcion de guardar datos en bd que esta en el modelo
															$this->ordenpedido_model->crear($datos);//Se llama a la funcion de que esta en modelo

															//Se guardan los datos en un array asociativo para pasarlos la funcion del model
															$arrayDetalleMovimiento = array(
																'idUsuario' => $_POST["usuarioSesion"],
																'idCredencial' => $array->idCredencial,
																'ValorMovimiento' => $producto->result()[0]->ValorUnitario,
																'FechaMovimiento' => "0000-00-00",
																'HoraMovimiento' => "0000-00-00",
																'DescripcionMovimiento' => "No. Pedido " . $id . ":" . "1 " . $producto->result()[0]->NombreProducto,
																'OrigenPedido' => "ENTRADARESTAURANTE");
															$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

															//Se guardan los datos en un array asociativo para pasarlos la funcion del model
															$arrayImpuesto = array(
																'idUsuario' => $_POST["usuarioSesion"],
																'idCredencial' => $array->idCredencial,
																'ValorMovimiento' => ($producto->result()[0]->ValorUnitario * (0.0006)),
																'FechaMovimiento' => "0000-00-00",
																'HoraMovimiento' => "0000-00-00",
																'DescripcionMovimiento' => "No de pedido: " . $id,
																'OrigenPedido' => "ENTRADARESTAURANTE");
															$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

															//Se obtiene el saldo actual
															$saldoActual = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

															//Se calcula el saldo por haber realizado el pedido
															$totalSaldo = $saldoActual - $producto->result()[0]->ValorUnitario;

															//Se cambia el saldo
															$this->credenciales_model->CambiarSaldo($array->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

															//Se guardan los datos en un array asociativo para pasarlos la funcion del model
															$arrayDetalle = array(
																'idOrdenPedido' => $id,
																'codigoProducto' => $producto->result()[0]->codigoProducto,
																'cantidad' => "1",
																'total' => $producto->result()[0]->ValorUnitario);
															$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		

															//Se disminuye el stock del producto iterado
															$this->producto_model->DisminuirStock($producto->result()[0]->codigoProducto, 1, $_POST["usuarioSesion"], "DISMINUIR STOCK POR GENERAR ALMUERZO EN PEDIDO " . $id);//Se llama a la funcion de que esta en modelo

															$saldoAc = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda
															$resultado["mensaje"] = "<h4>Se ha registrado con exito el almuerzo</h4><br><p>El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante.</p><br>Saldo Actual: " . $saldoAc;
															$resultado["ImagenFotografica"] = $array->ImagenFotografica;

															//Se guardan los datos en un array asociativo para pasarlos la funcion del model
															$datosLog = array(
																'idCredencial' => $array->idCredencial,
																'mensaje' => "El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante");	
															//Se llama a la funcion de guardar datos en bd que esta en el modelo
															$this->ordenpedido_model->crearLog($datosLog);//Se llama a la funcion de que esta en modelo	
															echo json_encode($resultado);
														}else{
															$resultado["mensaje"] = "La cantidad actual del almuerzo " . $producto->result()[0]->NombreProducto . " es insuficiente para realizar su compra.<br>Cantidad Actual: " . $producto->result()[0]->Stock;
															$resultado["ImagenFotografica"] = "";
															echo json_encode($resultado);
														}
													}else{
														$resultado["mensaje"] = "El Saldo actual del Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " es insuficiente para realizar la compra del almuerzo.<br>Saldo Actual: " . $array->SaldoCredencial . " . Precio del almuerzo: " . $producto->result()[0]->ValorUnitario;
														$resultado["ImagenFotografica"] = $array->ImagenFotografica;
														echo json_encode($resultado);
													}
													
												}
											}
										}
									}
								}
							/*}else{
								$resultado["mensaje"] = "El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " no ha realizado el pago del servicio del restaurante para el actual mes de " . $this->getMonth_Text($m);
								$resultado["ImagenFotografica"] = $array->ImagenFotografica;
								echo json_encode($resultado);
							}*/
						}else{
							$resultado["mensaje"] = "El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " le falta ingresar su fecha de nacimiento para saber su edad";
							$resultado["ImagenFotografica"] = $array->ImagenFotografica;
							echo json_encode($resultado);
						}
						break;

					case 'Funcionario':
						if($array->tipofuncionario != null){							
							/*$y = date("Y");
							$m = date("m");
							$mes = "Restaurante " . $this->getMonth_Text($m) . " " . $y;				
							$pago = $this->pagos_model->ConsultarPagoRestaurante($array->NumeroId, $mes);//Se llama a la funcion de que esta en modelo	

							if($pago > 0){*/
								switch ($array->tipofuncionario) {
									case 'Tipo A':
										$producto = $this->producto_model->ObtenerStock("342");//Se llama a la funcion de que esta en modelo y el resultado se guarda
										if($producto != null){
											if($array->SaldoCredencial >= $producto->result()[0]->ValorUnitario){
												//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos

												if($producto->result()[0]->Stock > 0){

													$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$datos = array(
														'idUsuario' => $array->idUsuario,
														'idCredencial' => $array->idCredencial,
														'ConsecutivoTurno' => "0",
														'ConsecutivoInterno' => $id,
														'DescripcionPedido' => "1 " . $producto->result()[0]->NombreProducto,
														'UbicacionPedido' => "ENTREGADO",
														'HoraEntrega' => "0000-00-00",
														'FechaEntrega' => "0000-00-00",
														'OrigenPedido' => "ENTRADARESTAURANTE");
													//Se llama a la funcion de guardar datos en bd que esta en el modelo
													$this->ordenpedido_model->crear($datos);//Se llama a la funcion de que esta en modelo

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayDetalleMovimiento = array(
														'idUsuario' => $_POST["usuarioSesion"],
														'idCredencial' => $array->idCredencial,
														'ValorMovimiento' => $producto->result()[0]->ValorUnitario,
														'FechaMovimiento' => "0000-00-00",
														'HoraMovimiento' => "0000-00-00",
														'DescripcionMovimiento' => "No. Pedido " . $id . ":" . "1 " . $producto->result()[0]->NombreProducto,
														'OrigenPedido' => "ENTRADARESTAURANTE");
													$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayImpuesto = array(
														'idUsuario' => $_POST["usuarioSesion"],
														'idCredencial' => $array->idCredencial,
														'ValorMovimiento' => ($producto->result()[0]->ValorUnitario * (0.0006)),
														'FechaMovimiento' => "0000-00-00",
														'HoraMovimiento' => "0000-00-00",
														'DescripcionMovimiento' => "No de pedido: " . $id,
														'OrigenPedido' => "ENTRADARESTAURANTE");
													$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

													//Se obtiene el saldo actual
													$saldoActual = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se calcula el saldo por haber realizado el pedido
													$totalSaldo = $saldoActual - $producto->result()[0]->ValorUnitario;

													//Se cambia el saldo
													$this->credenciales_model->CambiarSaldo($array->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayDetalle = array(
														'idOrdenPedido' => $id,
														'codigoProducto' => $producto->result()[0]->codigoProducto,
														'cantidad' => "1",
														'total' => $producto->result()[0]->ValorUnitario);
													$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		
													//Se disminuye el stock del producto iterado
													$this->producto_model->DisminuirStock($producto->result()[0]->codigoProducto, 1, $_POST["usuarioSesion"], "DISMINUIR STOCK POR GENERAR ALMUERZO EN PEDIDO " . $id);//Se llama a la funcion de que esta en modelo

													$saldoAc = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda
													$resultado["mensaje"] = "<h4>Se ha registrado con exito el almuerzo</h4><br><p>El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante.</p><br>Saldo Actual: " . $saldoAc;
													$resultado["ImagenFotografica"] = $array->ImagenFotografica;

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$datosLog = array(
														'idCredencial' => $array->idCredencial,
														'mensaje' => "El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante");	
													//Se llama a la funcion de guardar datos en bd que esta en el modelo
													$this->ordenpedido_model->crearLog($datosLog);//Se llama a la funcion de que esta en modelo
													echo json_encode($resultado);
												}else{
													$resultado["mensaje"] = "La cantidad actual del almuerzo " . $producto->result()[0]->NombreProducto . " es insuficiente para realizar su compra.<br>Cantidad Actual: " . $producto->result()[0]->Stock;
													$resultado["ImagenFotografica"] = "";
													echo json_encode($resultado);
												}	
											}else{
												$resultado["mensaje"] = "El Saldo actual del Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " es insuficiente para realizar la compra del almuerzo.<br>Saldo Actual: " . $array->SaldoCredencial . " . Precio del almuerzo: " . $producto->result()[0]->ValorUnitario;
												$resultado["ImagenFotografica"] = $array->ImagenFotografica;
												echo json_encode($resultado);
											}
										}
										break;
									
									case 'Tipo B':
										$producto = $this->producto_model->ObtenerStock("26");//Se llama a la funcion de que esta en modelo y el resultado se guarda
										if($producto != null){
											if($array->SaldoCredencial >= $producto->result()[0]->ValorUnitario){
												//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos

												if($producto->result()[0]->Stock > 0){

													$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$datos = array(
														'idUsuario' => $array->idUsuario,
														'idCredencial' => $array->idCredencial,
														'ConsecutivoTurno' => "0",
														'ConsecutivoInterno' => $id,
														'DescripcionPedido' => "1 " . $producto->result()[0]->NombreProducto,
														'UbicacionPedido' => "ENTREGADO",
														'HoraEntrega' => "0000-00-00",
														'FechaEntrega' => "0000-00-00",
														'OrigenPedido' => "ENTRADARESTAURANTE");
													//Se llama a la funcion de guardar datos en bd que esta en el modelo
													$this->ordenpedido_model->crear($datos);//Se llama a la funcion de que esta en modelo

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayDetalleMovimiento = array(
														'idUsuario' => $_POST["usuarioSesion"],
														'idCredencial' => $array->idCredencial,
														'ValorMovimiento' => $producto->result()[0]->ValorUnitario,
														'FechaMovimiento' => "0000-00-00",
														'HoraMovimiento' => "0000-00-00",
														'DescripcionMovimiento' => "No. Pedido " . $id . ":" . "1 " . $producto->result()[0]->NombreProducto,
														'OrigenPedido' => "ENTRADARESTAURANTE");
													$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayImpuesto = array(
														'idUsuario' => $_POST["usuarioSesion"],
														'idCredencial' => $array->idCredencial,
														'ValorMovimiento' => ($producto->result()[0]->ValorUnitario * (0.0006)),
														'FechaMovimiento' => "0000-00-00",
														'HoraMovimiento' => "0000-00-00",
														'DescripcionMovimiento' => "No de pedido: " . $id,
														'OrigenPedido' => "ENTRADARESTAURANTE");
													$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

													//Se obtiene el saldo actual
													$saldoActual = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se calcula el saldo por haber realizado el pedido
													$totalSaldo = $saldoActual - $producto->result()[0]->ValorUnitario;

													//Se cambia el saldo
													$this->credenciales_model->CambiarSaldo($array->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayDetalle = array(
														'idOrdenPedido' => $id,
														'codigoProducto' => $producto->result()[0]->codigoProducto,
														'cantidad' => "1",
														'total' => $producto->result()[0]->ValorUnitario);
													$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		
													//Se disminuye el stock del producto iterado
													$this->producto_model->DisminuirStock($producto->result()[0]->codigoProducto, 1, $_POST["usuarioSesion"], "DISMINUIR STOCK POR GENERAR ALMUERZO EN PEDIDO " . $id);//Se llama a la funcion de que esta en modelo

													$saldoAc = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda
													$resultado["mensaje"] = "<h4>Se ha registrado con exito el almuerzo</h4><br><p>El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante.</p><br>Saldo Actual: " . $saldoAc;
													$resultado["ImagenFotografica"] = $array->ImagenFotografica;

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$datosLog = array(
														'idCredencial' => $array->idCredencial,
														'mensaje' => "El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante");	
													//Se llama a la funcion de guardar datos en bd que esta en el modelo
													$this->ordenpedido_model->crearLog($datosLog);//Se llama a la funcion de que esta en modelo
													echo json_encode($resultado);
												}else{
													$resultado["mensaje"] = "La cantidad actual del almuerzo " . $producto->result()[0]->NombreProducto . " es insuficiente para realizar su compra.<br>Cantidad Actual: " . $producto->result()[0]->Stock;
													$resultado["ImagenFotografica"] = "";
													echo json_encode($resultado);
												}			
											}else{
												$resultado["mensaje"] = "El Saldo actual del Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " es insuficiente para realizar la compra del almuerzo.<br>Saldo Actual: " . $array->SaldoCredencial . " . Precio del almuerzo: " . $producto->result()[0]->ValorUnitario;
												$resultado["ImagenFotografica"] = $array->ImagenFotografica;
												echo json_encode($resultado);
											}
										}
										break;

									case 'Tipo C':
										$producto = $this->producto_model->ObtenerStock("380");//Se llama a la funcion de que esta en modelo y el resultado se guarda
										if($producto != null){
											if($array->SaldoCredencial >= $producto->result()[0]->ValorUnitario){
												//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos

												if($producto->result()[0]->Stock > 0){
													
													$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$datos = array(
														'idUsuario' => $array->idUsuario,
														'idCredencial' => $array->idCredencial,
														'ConsecutivoTurno' => "0",
														'ConsecutivoInterno' => $id,
														'DescripcionPedido' => "1 " . $producto->result()[0]->NombreProducto,
														'UbicacionPedido' => "ENTREGADO",
														'HoraEntrega' => "0000-00-00",
														'FechaEntrega' => "0000-00-00",
														'OrigenPedido' => "ENTRADARESTAURANTE");
													//Se llama a la funcion de guardar datos en bd que esta en el modelo
													$this->ordenpedido_model->crear($datos);//Se llama a la funcion de que esta en modelo

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayDetalleMovimiento = array(
														'idUsuario' => $_POST["usuarioSesion"],
														'idCredencial' => $array->idCredencial,
														'ValorMovimiento' => $producto->result()[0]->ValorUnitario,
														'FechaMovimiento' => "0000-00-00",
														'HoraMovimiento' => "0000-00-00",
														'DescripcionMovimiento' => "No. Pedido " . $id . ":" . "1 " . $producto->result()[0]->NombreProducto,
														'OrigenPedido' => "ENTRADARESTAURANTE");
													$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayImpuesto = array(
														'idUsuario' => $_POST["usuarioSesion"],
														'idCredencial' => $array->idCredencial,
														'ValorMovimiento' => ($producto->result()[0]->ValorUnitario * (0.0006)),
														'FechaMovimiento' => "0000-00-00",
														'HoraMovimiento' => "0000-00-00",
														'DescripcionMovimiento' => "No de pedido: " . $id,
														'OrigenPedido' => "ENTRADARESTAURANTE");
													$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

													//Se obtiene el saldo actual
													$saldoActual = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se calcula el saldo por haber realizado el pedido
													$totalSaldo = $saldoActual - $producto->result()[0]->ValorUnitario;

													//Se cambia el saldo
													$this->credenciales_model->CambiarSaldo($array->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$arrayDetalle = array(
														'idOrdenPedido' => $id,
														'codigoProducto' => $producto->result()[0]->codigoProducto,
														'cantidad' => "1",
														'total' => $producto->result()[0]->ValorUnitario);
													$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		
													//Se disminuye el stock del producto iterado
													$this->producto_model->DisminuirStock($producto->result()[0]->codigoProducto, 1, $_POST["usuarioSesion"], "DISMINUIR STOCK POR GENERAR ALMUERZO EN PEDIDO " . $id);//Se llama a la funcion de que esta en modelo

													$saldoAc = $this->credenciales_model->ObtenerSaldoActual($array->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda
													$resultado["mensaje"] = "<h4>Se ha registrado con exito el almuerzo</h4><br><p>El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante.</p><br>Saldo Actual: " . $saldoAc;
													$resultado["ImagenFotografica"] = $array->ImagenFotografica;

													//Se guardan los datos en un array asociativo para pasarlos la funcion del model
													$datosLog = array(
														'idCredencial' => $array->idCredencial,
														'mensaje' => "El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " puede ingresar en el restaurante");	
													//Se llama a la funcion de guardar datos en bd que esta en el modelo
													$this->ordenpedido_model->crearLog($datosLog);//Se llama a la funcion de que esta en modelo
													echo json_encode($resultado);	
												}else{
													$resultado["mensaje"] = "La cantidad actual del almuerzo " . $producto->result()[0]->NombreProducto . " es insuficiente para realizar su compra.<br>Cantidad Actual: " . $producto->result()[0]->Stock;
													$resultado["ImagenFotografica"] = "";
													echo json_encode($resultado);
												}		
											}else{
												$resultado["mensaje"] = "El Saldo actual del Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " es insuficiente para realizar la compra del almuerzo.<br>Saldo Actual: " . $array->SaldoCredencial . " . Precio del almuerzo: " . $producto->result()[0]->ValorUnitario;
												$resultado["ImagenFotografica"] = $array->ImagenFotografica;
												echo json_encode($resultado);
											}
										}
										break;

									default:
										$resultado["mensaje"] = "El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " le falta ingresar su tipo de funcionario";
										$resultado["ImagenFotografica"] = $array->ImagenFotografica;
										echo json_encode($resultado);
										break;
								}
							/*}else{
								$resultado["mensaje"] = "El Estudiante " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " no ha realizado el pago del servicio del restaurante para el actual mes de " . $this->getMonth_Text($m);
								$resultado["ImagenFotografica"] = $array->ImagenFotografica;
								echo json_encode($resultado);
							}*/
						}else{
							$resultado["mensaje"] = "El Funcionario " . $array->PrimerNombre . " " . $array->SegundoNombre . " " . $array->PrimerApellido . " " . $array->SegundoApellido . " le falta ingresar su tipo de funcionario";
							$resultado["ImagenFotografica"] = $array->ImagenFotografica;
							echo json_encode($resultado);
						}
						break;
					
				}
			}
		}
		
				
	}

	//Funcion para guardar datos de un usuario en una sesion 
	function guardarSesion(){
		$this->session->set_userdata("SaldoCredencial", $_POST["SaldoCredencial"]);
		$this->session->set_userdata("idCredencialSesion", $_POST["idCredencial"]);
		$this->session->set_userdata("idUsuarioApp", $_POST["usuario"]);
		$this->session->set_userdata("ValorRestriccion", $_POST["ValorRestriccion"]);
		$this->session->set_userdata("PrimerNombreUsuarioSesionApp", $_POST["primerNombre"]);
		$this->session->set_userdata("SegundoNombreUsuarioSesionApp", $_POST["segundoNombre"]);
		$this->session->set_userdata("PrimerApellidoUsuarioSesionApp", $_POST["primerApellido"]);
		$this->session->set_userdata("SegundoApellidoUsuarioSesionApp", $_POST["segundoApellido"]);
		$this->session->set_userdata("ImagenFotograficaUsuarioSesionApp", $_POST["ImagenFotografica"]);
	}

	//Funcion para guardar datos de un pedido en una sesion 
	function guardarPedidoSesion(){
		$this->session->set_userdata("PedidoSSCASESSION", $_POST["Pedido"]);
	}
	function prueba(){
		echo date("ymdHisU");
	}
	//Funcion para guardar datos de un pedido nuevo en la bd 
	function insertarPedido(){
		$turno = 0;

		//Se genera un turno nuevo cuando el pedido a crear es en ALISTAMIENTO
		if($_POST["ubicacionPedido"] == "ALISTAMIENTO"){
			$turno = $this->ordenpedido_model->ObtenerTurno();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}
		
		//Se obtiene el id para el pedido a crear y pasarlo como dato a la creacion del movimientos
		$id = $this->ordenpedido_model->ObtenerIdProximoPedido();//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["usuario"],
			'idCredencial' => $_POST["idCredencial"],
			'ConsecutivoTurno' => $turno,
			'ConsecutivoInterno' => $id,
			'DescripcionPedido' => $_POST["descripcionPedido"],
			'UbicacionPedido' => $_POST["ubicacionPedido"],
			'HoraEntrega' => $_POST["horaEntrega"],
			'FechaEntrega' => $_POST["fechaEntrega"],
			'OrigenPedido' => $_POST["OrigenPedido"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->ordenpedido_model->crear($array);//Se llama a la funcion de que esta en modelo

		//Se itera todo el detalle de los productos del pedido para guardarlo en la tabla detalles
		//Se dividen por la , y se obtienen sus datos en variables
		$detalleProducto = explode(",", $_POST["detalle"]);
		foreach ($detalleProducto as $valor) {
			$producto = explode(":", $valor);
			$codigoProducto = $producto[0];
			$cantidad = $producto[1];
			$total = $producto[2];	

			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$arrayDetalle = array(
				'idOrdenPedido' => $id,
				'codigoProducto' => $codigoProducto,
				'cantidad' => $cantidad,
				'total' => $total);
			$this->detalle_orden_pedido_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo		

			/*$cantidadInicial = 0;
			$resultado = $this->producto_model->ObtenerStock($codigoProducto);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($resultado != null){
				$cantidadInicial = $resultado->result()[0]->Stock;
			}
			$totalCantidad = $cantidadInicial - $cantidad;
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$arrayLog = array(
				'codigoProducto' => $codigoProducto,
				'stock_inicial' => $cantidadInicial,
				'cantidad_agregar' => $cantidad,
				'stock_final' => $totalCantidad,
				'session' => $_POST["session"],
				'origen' => "DISMINUIR STOCK POR AGREGAR PRODUCTO EN PEDIDO " . $id);
			$this->producto_model->crearLog($arrayLog);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			//Se disminuye el stock del producto iterado
			$this->producto_model->DisminuirStock($codigoProducto, $cantidad);//Se llama a la funcion de que esta en modelo		*/
		}

		

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayDetalleMovimiento = array(
			'idUsuario' => $_POST["usuario"],
			'idCredencial' => $_POST["idCredencial"],
			'ValorMovimiento' => $_POST["total"],
			'FechaMovimiento' => $_POST["fecha"],
			'HoraMovimiento' => $_POST["hora"],
			'DescripcionMovimiento' => "No. Pedido " . $id . ":" . $_POST["descripcionPedido"],
			'OrigenPedido' => $_POST["OrigenPedido"]);
		$this->movimientos_model->crear($arrayDetalleMovimiento);//Se llama a la funcion de que esta en modelo

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayImpuesto = array(
			'idUsuario' => $_POST["usuario"],
			'idCredencial' => $_POST["idCredencial"],
			'ValorMovimiento' => ($_POST["total"] * (0.0006)),
			'FechaMovimiento' => $_POST["fecha"],
			'HoraMovimiento' => $_POST["hora"],
			'DescripcionMovimiento' => "No de pedido: " . $id,
			'OrigenPedido' => $_POST["OrigenPedido"]);
		$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

		//Se obtiene el saldo actual
		$saldoActual = $this->credenciales_model->ObtenerSaldoActual($_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se calcula el saldo por haber realizado el pedido
		$totalSaldo = $saldoActual - $_POST["total"];

		//Se cambia el saldo
		$this->credenciales_model->CambiarSaldo($_POST["idCredencial"], $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se borran de la sesion los datos referentes al usuario y al pedido
		$this->session->unset_userdata('SaldoCredencial');
		$this->session->unset_userdata('idCredencialSesion');
		$this->session->unset_userdata('idUsuarioApp');
		$this->session->unset_userdata('ValorRestriccion');
		$this->session->unset_userdata('PrimerNombreUsuarioSesionApp');
		$this->session->unset_userdata('SegundoNombreUsuarioSesionApp');
		$this->session->unset_userdata('PrimerApellidoUsuarioSesionApp');
		$this->session->unset_userdata('SegundoApellidoUsuarioSesionApp');
		$this->session->unset_userdata('ImagenFotograficaUsuarioSesionApp');
		$this->session->unset_userdata('PedidoSSCASESSION');
		
		//Se retorna a la vista el json del pedido realizado
		echo '[{"turno":"' . $turno . '", "saldoActual":"' . $totalSaldo . '", "id":"' . $id . '"}]';
	}

	//Funcion para borrar datos de un usuario en una sesion 
	function borrarSesion(){
		if($this->session->userdata('PedidoSSCASESSION') != "[]" && $this->session->userdata('PedidoSSCASESSION') != null){
			$obj = json_decode($this->session->userdata('PedidoSSCASESSION'));
			foreach($obj as $array){
				if($array != null){
					$this->producto_model->AumentarStock($array->codigoProducto, $array->cantidad, $_REQUEST["session"], "AUMENTAR STOCK POR ELIMINAR PRODUCTO DE PEDIDO CANCELADO");//Se llama a la funcion de que esta en modelo y el resultado se guarda

				}
				
			}
		}
		$this->session->unset_userdata('SaldoCredencial');
		$this->session->unset_userdata('idCredencialSesion');
		$this->session->unset_userdata('idUsuarioApp');
		$this->session->unset_userdata('ValorRestriccion');
		$this->session->unset_userdata('PrimerNombreUsuarioSesionApp');
		$this->session->unset_userdata('SegundoNombreUsuarioSesionApp');
		$this->session->unset_userdata('PrimerApellidoUsuarioSesionApp');
		$this->session->unset_userdata('SegundoApellidoUsuarioSesionApp');
		$this->session->unset_userdata('ImagenFotograficaUsuarioSesionApp');	
		$this->session->unset_userdata('PedidoSSCASESSION');	
	}

	//Funcion para borrar datos de un usuario en una sesion 
	function borrarSesionTodo(){
		if($this->session->userdata('PedidoSSCASESSION') != "[]" && $this->session->userdata('PedidoSSCASESSION') != null){
			$obj = json_decode($this->session->userdata('PedidoSSCASESSION'));
			foreach($obj as $array){
				if($array != null){
					$this->producto_model->AumentarStock($array->codigoProducto, $array->cantidad, $_REQUEST["session"], "AUMENTAR STOCK POR ELIMINAR PRODUCTO DE PEDIDO CANCELADO POR SESSION");//Se llama a la funcion de que esta en modelo y el resultado se guarda

				}
				
			}
		}
		$this->session->unset_userdata('SaldoCredencial');
		$this->session->unset_userdata('UserNameInternoSSCA');
		$this->session->unset_userdata('UserIDInternoSSCA');
		$this->session->unset_userdata('idCredencialSesion');
		$this->session->unset_userdata('idUsuarioApp');
		$this->session->unset_userdata('ValorRestriccion');
		$this->session->unset_userdata('PrimerNombreUsuarioSesionApp');
		$this->session->unset_userdata('SegundoNombreUsuarioSesionApp');
		$this->session->unset_userdata('PrimerApellidoUsuarioSesionApp');
		$this->session->unset_userdata('SegundoApellidoUsuarioSesionApp');
		$this->session->unset_userdata('ImagenFotograficaUsuarioSesionApp');	
		$this->session->unset_userdata('PedidoSSCASESSION');	
		header('Location: ' . base_url());
	}

	//Funcion para generar reporte de ventas
	function GenerarReporteVentasDias(){
		$this->load->model('usuarios_aplicaciones_model');
		$resultado = $this->movimientos_model->ReportePedidos($_POST["fechaInicial"], $_POST["fechaFinal"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			foreach ($resultado->result() as $value) {
				if($value->TipoUsuario == "Estudiante"){
					$data_estudiante = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);

					if($data_estudiante != null){
						if(count($data_estudiante->result()) == 1){
							$data_estudiante = $data_estudiante->result()[0];
							$value->documento_acudiente = $data_estudiante->NumeroId;		
						}
					}
				}else{
					$value->documento_acudiente = $value->NumeroId;					
				}
			}
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para generar pedidos a revertir
	function GenerarPedidosRevertir(){
		$resultado = $this->ordenpedido_model->PedidosaRevertir($_REQUEST["numeroId"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		$json = "[";
		$contador = 0;
		if($resultado != null){
			foreach ($resultado->result() as $value) {
				$minTiempo = $this->detalle_orden_pedido_model->getMinTiempoMaximoRevertir($value->ConsecutivoInterno);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				$value->TiempoMin = $minTiempo;
				if($contador == 0){
					$json .= json_encode($value);
				}else{
					$json .= "," . json_encode($value);
				}
				$contador++;
			}
			
		}else{
			//echo "[]";
		}	

		$resultadoPlanificados = $this->ordenpedido_model->PedidosaRevertirPlanificados($_REQUEST["numeroId"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($resultadoPlanificados != null){
			foreach ($resultadoPlanificados->result() as $valor) {
				$minTiempo = $this->detalle_orden_pedido_model->getMinTiempoMaximoRevertir($valor->ConsecutivoInterno);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				$valor->TiempoMin = $minTiempo;
				if($contador == 0){
					$json .= json_encode($valor);
				}else{
					$json .= "," . json_encode($valor);
				}
				$contador++;
			}
			
		}else{
			//echo "[]";
		}		

		$json .= "]";
		echo $json;
	}

	//Funcion para generar un reporte agrupado por producto
	function ConsultaReporteCafeteriaDias(){
		$resultadoReporte = $this->ordenpedido_model->ConsultaReporteCafeteriaDias($_POST["fechai"], $_POST["fechaf"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $resultadoReporte;
	}

	//Funcion para generar un reporte agrupado por producto
	function RevertirPedido(){
		$resultado = $this->movimientos_model->ObtenerMovimiento($_REQUEST["consecutivoInterno"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($resultado != null){
			$codigoPedido = $_REQUEST["consecutivoInterno"];
			$dataDetalleOrden = $this->detalle_orden_pedido_model->get($_REQUEST["consecutivoInterno"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($dataDetalleOrden != null){
				$array = array(
					'id' => $_REQUEST["consecutivoInterno"]);
				$this->ordenpedido_model->borrarPedido($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				//$this->detalle_orden_pedido_model->borrarPedido($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				$this->movimientos_model->borrarPedido($_REQUEST["consecutivoInterno"]);//Se $llama a la funcion de que esta en modelo y el resultado se guarda

				$this->movimientos_model->borrarPedidoImpuesto($_REQUEST["consecutivoInterno"]);//Se $llama a la funcion de que esta en modelo y el resultado se guarda

				$arrayReversion = array(
					'idUsuario' => $_REQUEST["session"],
					'idPedido' => $_REQUEST["consecutivoInterno"],
					'idCredencial' => $_REQUEST["credencial"],
					'FechaEntrega' => $_REQUEST["fecha"],
					'HoraEntrega' => $_REQUEST["horaEntrega"],
					'OrigenPedido' => $_REQUEST["origenPedido"],
					'DescripcionMovimiento' => $_REQUEST["DescripcionMovimiento"],
					'turno' => $_REQUEST["turno"],
					'total' => $_REQUEST["total"],
					'fechapedido' => $_REQUEST["fechapedido"],
					'horaspedido' => $_REQUEST["horaspedido"]);
				$this->reversion_pedido_model->crear($arrayReversion);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				foreach ($dataDetalleOrden->result() as $value) {					
					$this->producto_model->AumentarStock($value->codigoProducto, $value->cantidad, $_REQUEST["session"], "AUMENTAR STOCK POR CANCELAR PEDIDO " . $_REQUEST["consecutivoInterno"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda		
				}

				$saldo = $this->credenciales_model->ObtenerSaldoActual($resultado->result()[0]->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				$totalSaldo = $saldo + $resultado->result()[0]->ValorMovimiento;

				//Se modifica el saldo
				$this->credenciales_model->CambiarSaldo($resultado->result()[0]->idCredencial, $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

			}
			
		}else{
			
		}	
		
	}

	//Funcion para exportar a excel un reporte agrupado por producto
	function ExportarReporteCafeteriaDias(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		//Se genera el reporte agrupado por producto
		$resultadoReporte = $this->ordenpedido_model->ConsultaReporteCafeteriaDias($_REQUEST["fechai"], $_REQUEST["fechaf"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se convierte a un objeto json el resultado de la consulta
		$json = json_decode($resultadoReporte);

		//Se ordena el json por el nombre del producto de forma ascendente
		usort($json, function($a, $b) { //Sort the array using a user defined function
		    return strcmp(strtolower($a->NombreProducto), strtolower($b->NombreProducto));
		}); 
		$objPHPExcel = new PHPExcel();
		// Se agregan la propiedades del archivo de excel a crear
		$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
           ->setLastModifiedBy("Fontan")
           ->setTitle("Reporte de Cafeteria")
           ->setSubject("Reporte de Cafeteria")
           ->setDescription("Reporte de Cafeteria")
           ->setKeywords("office 2007 openxml php")
           ->setCategory("Test result file");
		//Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
		$con = 2;    
		//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "CANTIDAD");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "CATEGORIA");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "SUBCATEGORIA");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "DETALLE");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "SUBTOTAL");
		
		//Se itera el json de los datos y se escriben en el excel en cada celda
		foreach ($json as $value) {
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$con, $value->cantidad);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('B'.$con, $value->NombreCategoria);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('C'.$con, $value->NombreSubCategoria);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('D'.$con, $value->NombreProducto);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$con, $value->total);

			$con++;            
		}
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Cafeteria');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Cafeteria" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

		//Se agregan otros atributos del archivo
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

     //Funcion para exportar a excel un reporte de ventas
	function ExportarReporteVentaDias(){
		$this->load->model('usuarios_aplicaciones_model');
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');

		//Se genera el reporte de ventas
		$resultadoReporte = $this->movimientos_model->ReportePedidos($_REQUEST["fechai"], $_REQUEST["fechaf"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($resultadoReporte != null){
			foreach ($resultadoReporte->result() as $value) {
				if($value->TipoUsuario == "Estudiante"){
					$data_estudiante = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);

					if($data_estudiante != null){
						if(count($data_estudiante->result()) == 1){
							$data_estudiante = $data_estudiante->result()[0];
							$value->documento_acudiente = $data_estudiante->NumeroId;		
						}
					}

				}else{
					$value->documento_acudiente = $value->NumeroId;					
				}
			}
		}
		
		$objPHPExcel = new PHPExcel();
		// Se agregan la propiedades del archivo de excel a crear
		$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
           ->setLastModifiedBy("Fontan")
           ->setTitle("Reporte de Venta por Dias")
           ->setSubject("Reporte de Venta por Dias")
           ->setDescription("Reporte de Venta por Dias")
           ->setKeywords("office 2007 openxml php")
           ->setCategory("Test result file");
        //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna 
		$i = 2;    
		//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "ID USUARIO");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "NOMBRES");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "APELLIDOS");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "DOCUMENTO ACUDIENTE");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "FECHA(aaaa-mm-dd)");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "HORA");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "DESCRIPCION");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "VALOR");
		
		//Se itera el json de los datos y se escriben en el excel en cada celda
		foreach ($resultadoReporte->result() as $value) {
			$resu = explode(":", $value->DescripcionMovimiento);
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $value->idUsuario);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('B'.$i, $value->PrimerNombre . " " . $value->SegundoNombre);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('C'.$i, $value->PrimerApellido . " " . $value->SegundoApellido);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('D'.$i, $value->documento_acudiente);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$i, $value->FechaMovimiento);

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('F'.$i, $value->HoraMovimiento);

			$objPHPExcel->setActiveSheetIndex(0)
          	->setCellValue('G'.$i, $resu[1]);

          	$objPHPExcel->setActiveSheetIndex(0)
          	->setCellValue('H'.$i, $value->ValorMovimiento);          

			$i++;            
		}
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Venta por Dias');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Ventas_Dias" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";
		//Se agregan otros atributos del archivo
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	} 

	//Funcion para mostrar el valor total de pedidos de una credencial en una fecha
	function MostrarTotalPorDia(){
		$resultado = $this->movimientos_model->MostrarTotalPorDia($_POST["fecha"], $_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}
}
