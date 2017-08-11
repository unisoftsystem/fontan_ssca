<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Credenciales extends CI_Controller {


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
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('tarifas_model');//Cargar el modelo de tarifas donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_model');//Cargar el modelo de permisos donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_sistema_model');//Cargar el modelo de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('movimientos_model');//Cargar el modelo de movimientos donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/************** MOSTRAR PAGINAS ***********************/
	public function index()
	{
		
	}

	//Mostrar la vista de la credencial de los estudiantes y funcionarios
	function carnet(){
		$data['titulo'] = "Credencial";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('carnet');
	}

	//Mostrar la vista de la credencial de los conductores y monitores
	function CarnetFuncionario(){
		$data['titulo'] = "Credencial";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('CarnetFuncionario');
	}

	//Mostrar la vista de recarga de credenciales
	function procesoRecaudo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/procesoRecaudo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Proceso de Recaudo";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/procesoRecaudo');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de devolucion de saldo de credenciales
	function devolucionSaldo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/devolucionSaldo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Devolución de Saldo";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/devolucionSaldo');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de reportes de recarga de credenciales
	function reporteRecaudo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/reporteRecaudo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['usuarios'] = $this->permisos_usuarios_sistema_model->listarUsuariosPorPermiso("../credenciales/procesoRecaudo");//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable

			$data['titulo'] = "Reporte de Recaudos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/reporteRecaudo');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de reportes de recarga de credenciales
	function reporteDevoluciones(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/reporteDevoluciones", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Reporte de Devoluciones";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/reporteDevoluciones');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}


	//Mostrar la vista de reportes de recarga de credenciales
	function reporteReversionPedidos(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/reporteReversionPedidos", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Reporte Reversion Pedidos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/reporteReversionPedidos');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de reportes de recarga de credenciales
	function reportePermisosSalidas(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/reportePermisosSalidas", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Reporte Permisos Salidas";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/reportePermisosSalidas');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}



	//Mostrar la vista de reemplazo de credenciales
	function reemplazarCredencial(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/reemplazarCredencial", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Reemplazo de credenciales";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/reemplazarCredencial');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de asignar permisos de salida
	function asignarPermiso(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../credenciales/asignarPermiso", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Asignación de Permisos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('credenciales/asignarPermiso');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	
	/************** ACCIONES ********************************/

	//Funcion para generar un codigo QR de las credenciales
	function generarQR(){
		/*
			Descripcion: Codigo para generar codigo QR
		*/
		//Direccion completa de la carpeta donde se guardan los png de los QR
		$PNG_TEMP_DIR = getcwd() . DIRECTORY_SEPARATOR . "qr" . DIRECTORY_SEPARATOR;
	    
	    //Carpeta donde se guardan los png de los QR
	    $PNG_WEB_DIR = 'qr/';

	    //Se carga el archivo de la libreria de QR
	    $this->load->file('plugins/phpqrcode/qrlib.php'); 
	    
	    //Validar si la carpeta donde se guardan los png de los QR existe
	    if (!file_exists($PNG_TEMP_DIR))
	        mkdir($PNG_TEMP_DIR);
	    

	    $filename = $PNG_TEMP_DIR.'.png';
	    $errorCorrectionLevel = 'H';
	    $matrixPointSize = 4;
	    
	    if (isset($_REQUEST['data'])) { 
	    	if (trim($_REQUEST['data']) == '')
	            die('data cannot be empty! <a href="?">back</a>');
	            
	        $filename = $PNG_TEMP_DIR . '' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
	        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
	    }    
		//Se retorna a la vista el nombre del archivo QR que se genero
		echo $PNG_WEB_DIR.basename($filename);
	}

	//Funcion para la accion de recarga de credenciales
	function ProcesarRecaudo(){
		$usuario = $_POST["usuario"];
		$usuarioSesion = $_POST["usuarioSesion"];
		$saldo = $_POST["saldo"];
		$fecha = $_POST["fecha"];
		$hora = $_POST["hora"];
		$credencial = $_POST["credencial"];
		$valor = str_replace(".", "", $saldo);
		
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayDetalle = array(
			'idUsuario' => $usuarioSesion,
			'idCredencial' => $_POST["credencial"],
			'ValorMovimiento' => $valor,
			'FechaMovimiento' => $_POST["fecha"],
			'HoraMovimiento' => $_POST["hora"],
			'DescripcionMovimiento' => "recargue monetario",
			'OrigenPedido' => "");
		$this->movimientos_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo

		//Se obtiene el saldo actual para sumarle el valor de la recarga que se realizo
		$saldoActual = $this->credenciales_model->ObtenerSaldoActual($_POST["credencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se calcula el saldo final
		$totalSaldo = $saldoActual + $valor;

		//Se modifica el saldo
		$this->credenciales_model->CambiarSaldo($_POST["credencial"], $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se consulta los datos de la credencial para mostrarlo en el popup de la vista
		$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($_POST["credencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $resultadoPorCredencial;
	}

	//Funcion para la accion de recarga de credenciales
	function DevolverSaldo(){
		$usuario = $_POST["usuario"];
		$usuarioSesion = $_POST["usuarioSesion"];
		$saldo = $_POST["saldo"];
		$fecha = $_POST["fecha"];
		$hora = $_POST["hora"];
		$credencial = $_POST["credencial"];
		$valor = str_replace(".", "", $saldo);
		
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayDetalle = array(
			'idUsuario' => $usuarioSesion,
			'idCredencial' => $_POST["credencial"],
			'ValorMovimiento' => $valor,
			'FechaMovimiento' => $_POST["fecha"],
			'HoraMovimiento' => $_POST["hora"],
			'DescripcionMovimiento' => "Devolucion Saldo",
			'OrigenPedido' => "");
		$this->movimientos_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo

		//Se obtiene el saldo actual para sumarle el valor de la recarga que se realizo
		$saldoActual = $this->credenciales_model->ObtenerSaldoActual($_POST["credencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se calcula el saldo final
		$totalSaldo = $saldoActual - $valor;

		//Se modifica el saldo
		$this->credenciales_model->CambiarSaldo($_POST["credencial"], $totalSaldo);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se consulta los datos de la credencial para mostrarlo en el popup de la vista
		$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($_POST["credencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $resultadoPorCredencial;
	}

	//Funcion para asignar permisos de salida
	function crearPermiso(){
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["idUsuario"],
			'Observaciones' => $_POST["observaciones"],
			'Fecha' => $_POST["fecha"],
			'Hora' => $_POST["hora"],
			'Tipo' => $_POST["tipo"]);
		$this->permisos_model->crear($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
	}

	//Funcion para reemplazo de credenciales
	function CrearReemplazoCredencial(){
		//Se consulta el usuario por su idUsuario
		$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorId($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se obtienen los valores de las tarifas
		$VrTarjeta = $this->tarifas_model->ConsultarValorTarifa("Vr. Tarjeta");//Se llama a la funcion de que esta en modelo y el resultado se guarda
		$VrTransaccional = $this->tarifas_model->ConsultarValorTarifa("Vr Transaccional");

		//Se verifica que se genero resultado al consultar el usuario
		if($resultadoPorCredencial != "[]"){
			//Se convierte el resultado a un objeto json
			$resultadoPorCredencial = json_decode($resultadoPorCredencial);

			//Se obtiene el saldo actual
			$saldoActual = $this->credenciales_model->ObtenerSaldoActual($resultadoPorCredencial[0]->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$arrayDetalle = array(
					'idUsuario' => $_REQUEST["usuarioSesion"],
					'idCredencial' => $resultadoPorCredencial[0]->idCredencial,
					'ValorMovimiento' => $VrTarjeta + ($VrTransaccional * $VrTarjeta),
					'FechaMovimiento' => $_REQUEST["fecha"],
					'HoraMovimiento' => $_REQUEST["hora"],
					'DescripcionMovimiento' => "cambio de credencial",
					'OrigenPedido' => "");
			//$this->movimientos_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo

			//Se genera el reemplazo de la credencial y se obtiene la nueva
			$credencial = $this->credenciales_model->crearReemplazo($resultadoPorCredencial[0]->idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

			//Se consulta el usuario por la credencial
			$resultcredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($credencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			
			//Se convierte el resultado de la busqueda por la credencial en un objeto json y se itera			
			$obj = json_decode($resultcredencial);
			foreach($obj as $array){
				
				if($array->TipoUsuario  == "Estudiante" || $array->TipoUsuario  == "Funcionario"){
					//Se guardan los datos iterados en variables
					$numeroId = $array->NumeroId;
					$primerApellido = $array->PrimerApellido;
					$segundoApellido = $array->SegundoApellido;
					$primerNombre = $array->PrimerNombre;
					$segundoNombre = $array->SegundoNombre;
					$tipoUsuario = $array->TipoUsuario;
					$curso = "";
					if($array->Descripcion){
						$curso = $array->Descripcion;
					}
					$tipoId = $array->TipoId;
					$tipoSangre = $array->TipoSangre;
					$cargo = $array->cargo;
					$arl = $array->arl;
					$file = $array->ImagenFotografica;
					$fechaVencimiento = $array->FechaVencimiento;

					$dateVenci = explode("-", $fechaVencimiento);
					$mes = "";
					if($fechaVencimiento != ""){
						//Se divide la fecha para mostrarla en letras en la credencial que se genera
						switch($dateVenci[1]){
							case "01":
								$mes = $dateVenci[2] . " ENERO DE " . $dateVenci[0];
								break;
							case "02":
								$mes = $dateVenci[2] . " FEBRERO DE " . $dateVenci[0];
								break;
							case "03":
								$mes = $dateVenci[2] . " MARZO DE " . $dateVenci[0];
								break;
							case "04":
								$mes = $dateVenci[2] . " ABRIL DE " . $dateVenci[0];
								break;
							case "05":
								$mes = $dateVenci[2] . " MAYO DE " . $dateVenci[0];
								break;
							case "06":
								$mes = $dateVenci[2] . " JUNIO DE " . $dateVenci[0];
								break;
							case "07":
								$mes = $dateVenci[2] . " JULIO DE " . $dateVenci[0];
								break;
							case "08":
								$mes = $dateVenci[2] . " AGOSTO DE " . $dateVenci[0];
								break;
							case "09":
								$mes = $dateVenci[2] . " SEPTIEMBRE DE " . $dateVenci[0];
								break;
							case "10":
								$mes = $dateVenci[2] . " OCTUBRE DE " . $dateVenci[0];
								break;
							case "11":
								$mes = $dateVenci[2] . " NOVIEMBRE DE " . $dateVenci[0];
								break;
							case "12":
								$mes = $dateVenci[2] . " DICIEMBRE DE " . $dateVenci[0];
								break;		
						}
					}

					//Se genera el json para la creacion de la credencial en la vista
					echo '[{"resultado":"", "credencial":"' . $credencial . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $file . '", "curso":"' . $curso . '", "tipoSangre":"' . $tipoSangre . '", "fechaVencimiento":"' . $mes . '", "cargo":"' . $cargo . '", "arl":"' . $arl . '"}]';
						
				}/*else{
					$tipoUsuario = $array->TipoUsuario;
					if($tipoUsuario == "Monitor"){
						$numeroId = $array->idmonitor;
					}else{
						$numeroId = $array->idconductor;
					}
					
					$primerApellido = $array->apellido;
					$primerNombre = $array->nombre;
					$tipoSangre = $array->TipoSangre;
					$arl = $array->arl;
					
					$fechaVencimiento = $array->FechaVencimiento;

					//Se divide la fecha para mostrarla en letras en la credencial que se genera
					$mes = "";
					if($fechaVencimiento != ""){
						$dateVenci = explode("-", $fechaVencimiento);
						
						

						switch($dateVenci[1]){
							case "01":
								$mes = $dateVenci[2] . " ENERO DE " . $dateVenci[0];
								break;
							case "02":
								$mes = $dateVenci[2] . " FEBRERO DE " . $dateVenci[0];
								break;
							case "03":
								$mes = $dateVenci[2] . " MARZO DE " . $dateVenci[0];
								break;
							case "04":
								$mes = $dateVenci[2] . " ABRIL DE " . $dateVenci[0];
								break;
							case "05":
								$mes = $dateVenci[2] . " MAYO DE " . $dateVenci[0];
								break;
							case "06":
								$mes = $dateVenci[2] . " JUNIO DE " . $dateVenci[0];
								break;
							case "07":
								$mes = $dateVenci[2] . " JULIO DE " . $dateVenci[0];
								break;
							case "08":
								$mes = $dateVenci[2] . " AGOSTO DE " . $dateVenci[0];
								break;
							case "09":
								$mes = $dateVenci[2] . " SEPTIEMBRE DE " . $dateVenci[0];
								break;
							case "10":
								$mes = $dateVenci[2] . " OCTUBRE DE " . $dateVenci[0];
								break;
							case "11":
								$mes = $dateVenci[2] . " NOVIEMBRE DE " . $dateVenci[0];
								break;
							case "12":
								$mes = $dateVenci[2] . " DICIEMBRE DE " . $dateVenci[0];
								break;		
						}
					}
					
					
					$tipoId = $array->TipoId;
					$file = $array->ImagenFotografica;

					//Se genera el json para la creacion de la credencial en la vista
					echo '[{"resultado":"", "credencial":"' . $credencial . '", "nombre":"' . $primerNombre . '", "apellido":"' . $primerApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $file . '", "fechaVencimiento":"' . $mes . '", "tipoSangre":"' . $tipoSangre . '", "arl":"' . $arl . '"}]';
				}*/
		        
			}
		}
		
	}
	
}