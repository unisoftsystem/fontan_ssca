<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Usuarios_aplicaciones extends CI_Controller {

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
		$this->load->model('usuarios_aplicaciones_model');//Cargar el modelo de usuarios de aplicaciones donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('movimientos_model');//Cargar el modelo de movimientos donde estan las funciones que hacen las consultas a la bd
		$this->load->model('tarifas_model');//Cargar el modelo de tarifas donde estan las funciones que hacen las consultas a la bd
		$this->load->model('curso_model');//Cargar el modelo de curso donde estan las funciones que hacen las consultas a la bd
		$this->load->model('monitor_model');//Cargar el modelo de monitor donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/*************************** MOSTRAR PAGINAS ***********************************/

	//Mostrar la vista de crear usuarios de aplicaciones
	function nuevo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../usuarios_aplicaciones/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Creación de Usuarios de Aplicaciones";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('usuarios_aplicaciones/nuevoUsuarioAplicaciones');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar usuarios de aplicaciones
	function editar(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../usuarios_aplicaciones/editar", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Modificación de Usuarios de Aplicaciones";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('usuarios_aplicaciones/editarUsuarioAplicaciones');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar usuarios de aplicaciones
	function borrar_funcionario(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../usuarios_aplicaciones/borrar_funcionario", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Borrar Funcionarios";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('usuarios_aplicaciones/borrarFuncionarios');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/****************************** ACCIONES ******************************************/

	//Funcion para crear un usuario de aplicaciones
	function crearUsuario(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();
		/*
			Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
		*/
		if($_POST['imgBase64'] != ""){
			$img = $_POST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace('data:image/jpg;base64,', '', $img);
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace('data:image/gif;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = getcwd() . "/images/" . $uidFoto . '.png';
			$url = "images/" . $uidFoto . '.png';
			$success = file_put_contents($file, $data);
		}
		$cargo = "";
		$curso = "";
		$arl = "";
		$idAcudiente = "";
		$tipoestudiante = "";
		$tipofuncionario = "";
		$credencial = "";

		//Se obtienen los valores de las tarifas
		$VrTarjeta = $this->tarifas_model->ConsultarValorTarifa("Vr. Tarjeta");//Se llama a la funcion de que esta en modelo y el resultado se guarda
		$VrTransaccional = $this->tarifas_model->ConsultarValorTarifa("Vr Transaccional");
		$saldoIngresar = $_POST["saldo"] - $VrTarjeta - ($VrTransaccional * $VrTarjeta);

		$date = date_create($_POST["fechaVencimiento"]);
		$fechaVenNuevo =  date_format($date, 'Y-m-d');

		$dateNac = date_create($_POST["fechanacimiento"]);
		$fechaNacNuevo =  date_format($dateNac, 'Y-m-d');

		//Se divide la fecha para mostrarla en letras en la credencial que se genera
		$dateVenci = explode("-", $fechaVenNuevo);
		$mes = "";
		
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

		//Se valida el tipo de usuario a crear
		switch($_POST["TipoUsuario"]){
            case "Estudiante":
                $cargo = "";
				$curso = $_POST["curso"];
				$arl = "";
				$tipoestudiante = $_POST["tipoestudiante"];
				$tipofuncionario = "";
                break;

            case "Funcionario":
                $cargo = $_POST["cargo"];
				$curso = "0";
				$arl = $_POST["arl"];
				$tipoestudiante = "";
				$tipofuncionario = $_POST["tipofuncionario"];
                break;

            case "Acudiente":
               	$cargo = "";
				$curso = "0";
				$arl = "";
				$tipoestudiante = "";
				$tipofuncionario = "";
                break;
        }
        
        //Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["idUsuario"],
			'TipoUsuario' => $_POST["TipoUsuario"],
			'TipoId' => $_POST["TipoId"],
			'NumeroId' => $_POST["NumeroId"],
			'PrimerApellido' => $_POST["PrimerApellido"],
			'SegundoApellido' => $_POST["SegundoApellido"],
			'PrimerNombre' => $_POST["PrimerNombre"],
			'SegundoNombre' => $_POST["SegundoNombre"],
			'ImagenFotografica' => $url,
			'idAcudiente' => $_POST["idAcudiente"],
			'Direccion' => $_POST["Direccion"],
			'Telefono1' => $_POST["Telefono1"],
			'Telefono2' => $_POST["Telefono2"],
			'Estado' => "ACTIVO",
			'Clave' => base64_encode($_POST["Clave"]),
			'Coordenadas' => $_POST["latitud"] . "," . $_POST["longitud"],
			'latitud' => $_POST["latitud"],
			'longitud' => $_POST["longitud"],
			'curso' => $curso,
			'TipoSangre' => $_POST["TipoSangre"],
			'arl' => $arl,
			'cargo' => $cargo,
			'tipoestudiante' => $tipoestudiante,
			'tipofuncionario' => $tipofuncionario,
			'fechanacimiento' => $fechaNacNuevo);
		$this->usuarios_aplicaciones_model->crear($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se valida el tipo de usuario a crear
		switch($_POST["TipoUsuario"]){
            case "Estudiante":
            	//Se guardan los datos en un array asociativo para pasarlos la funcion del model
               	$arrayCredencial = array(
					'idUsuarioPrincipal' => $_POST["idAcudiente"],
					'idUsuarioSecundario' => $_POST["idUsuario"],
					'SaldoCredencial' => $_POST["saldo"],
					'FechaVencimiento' => $fechaNacNuevo);
				$credencial = $this->credenciales_model->crear($arrayCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$arrayDetalle = array(
					'idUsuario' => $_POST["idUsuario"],
					'idCredencial' => $credencial,
					'ValorMovimiento' => $_POST["saldo"],
					'FechaMovimiento' => $_POST["fecha"],
					'HoraMovimiento' => $_POST["hora"],
					'DescripcionMovimiento' => "recargue monetario",
					'OrigenPedido' => "");
				$this->movimientos_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo

				//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$arrayImpuesto = array(
					'idUsuario' => $_POST["idUsuario"],
					'idCredencial' => $credencial,
					'ValorMovimiento' => ($VrTarjeta + ($VrTransaccional * $VrTarjeta)),
					'FechaMovimiento' => $_POST["fecha"],
					'HoraMovimiento' => $_POST["hora"],
					'DescripcionMovimiento' => "costo de asignación de tarjeta nueva",
					'OrigenPedido' => "");
				$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo

				$tipoId = $_REQUEST["TipoId"];	
				$numeroId = $_REQUEST["NumeroId"];	
				$primerApellido = $_REQUEST["PrimerApellido"];	
				$segundoApellido = $_REQUEST["SegundoApellido"];	
				$primerNombre = $_REQUEST["PrimerNombre"];	
				$segundoNombre = $_REQUEST["SegundoNombre"];		
				$tipoUsuario = $_REQUEST["TipoUsuario"];	
				$tipoSangre = $_REQUEST["TipoSangre"];
				$curso = $_REQUEST["curso"];
				$arl = $_REQUEST["arl"];
				$cargo = $_REQUEST["cargo"];
				$fechaVencimiento = $_REQUEST["fechaVencimiento"];

				//Obtener el nombre del curso
				$NombreCurso = $this->curso_model->get($_REQUEST["curso"]);//Se llama a la funcion de que esta en modelo

				//Se genera el json para la creacion de la credencial en la vista
				echo '[{"resultado":"' . $credencial . '", "curso":"' . $NombreCurso . '", "tipoSangre":"' . $tipoSangre . '", "credencial":"' . $credencial . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $url . '", "fechaVencimiento":"' . $mes . '"}]';
                break;

            case "Funcionario":
            	//Se guardan los datos en un array asociativo para pasarlos la funcion del model
                $arrayCredencial = array(
					'idUsuarioPrincipal' => $_POST["idUsuario"],
					'idUsuarioSecundario' => $_POST["idUsuario"],
					'SaldoCredencial' => $_POST["saldo"],
					'FechaVencimiento' => $fechaNacNuevo);
				$credencial = $this->credenciales_model->crear($arrayCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

            	//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$arrayDetalle = array(
					'idUsuario' => $_POST["idUsuario"],
					'idCredencial' => $credencial,
					'ValorMovimiento' => $_POST["saldo"],
					'FechaMovimiento' => $_POST["fecha"],
					'HoraMovimiento' => $_POST["hora"],
					'DescripcionMovimiento' => "recargue monetario",
					'OrigenPedido' => "");
				$this->movimientos_model->crear($arrayDetalle);//Se llama a la funcion de que esta en modelo

            	//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$arrayImpuesto = array(
					'idUsuario' => $_POST["idUsuario"],
					'idCredencial' => $credencial,
					'ValorMovimiento' => ($VrTarjeta + ($VrTransaccional * $VrTarjeta)),
					'FechaMovimiento' => $_POST["fecha"],
					'HoraMovimiento' => $_POST["hora"],
					'DescripcionMovimiento' => "costo de asignación de tarjeta nueva",
					'OrigenPedido' => "");
				$this->movimientos_model->crear($arrayImpuesto);//Se llama a la funcion de que esta en modelo
				
				$tipoId = $_REQUEST["TipoId"];	
				$numeroId = $_REQUEST["NumeroId"];	
				$primerApellido = $_REQUEST["PrimerApellido"];	
				$segundoApellido = $_REQUEST["SegundoApellido"];	
				$primerNombre = $_REQUEST["PrimerNombre"];	
				$segundoNombre = $_REQUEST["SegundoNombre"];		
				$tipoUsuario = $_REQUEST["TipoUsuario"];	
				$tipoSangre = $_REQUEST["TipoSangre"];
				$curso = $_REQUEST["curso"];
				$arl = $_REQUEST["arl"];
				$cargo = $_REQUEST["cargo"];
				$fechaVencimiento = $_REQUEST["fechaVencimiento"];

				//Se genera el json para la creacion de la credencial en la vista
				echo '[{"resultado":"' . $credencial . '", "curso":"NINGUNO", "tipoSangre":"' . $tipoSangre . '", "credencial":"' . $credencial . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $url . '", "fechaVencimiento":"' . $mes . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '"}]';
                break;

            case "Acudiente":
               	echo "[]";
                break;
        }

		


	}

	//Funcion para editar un usuario de aplicaciones
	function editarUsuario(){
		$idUsuario = $_REQUEST['idUsuario']; 
	    $TipoUsuario = $_REQUEST['TipoUsuario']; 
	    $TipoId = $_REQUEST['TipoId']; 
	    $NumeroId = $_REQUEST['NumeroId']; 
	    $PrimerApellido = $_REQUEST['PrimerApellido']; 
	    $SegundoApellido = $_REQUEST['SegundoApellido']; 
	    $PrimerNombre = $_REQUEST['PrimerNombre']; 
	    $SegundoNombre = $_REQUEST['SegundoNombre']; 
	    $idAcudiente = $_REQUEST['idAcudiente']; 
	    $Direccion = $_REQUEST['Direccion'];  	
	    $Telefono1 = $_REQUEST['Telefono1'];  	
	    $Telefono2 = $_REQUEST['Telefono2'];  	
	    $Clave = base64_encode($_REQUEST["Clave"]); 
	    $latitud = $_REQUEST['latitud'];  	 	
	    $longitud = $_REQUEST['longitud'];  	 	
	    $numeroIdNuevo = $_REQUEST['numeroIdNuevo'];  	
	    $TipoSangre = $_REQUEST['TipoSangre'];  	
	    $fechanacimiento = $_REQUEST['fechanacimiento'];  
	    $fechaVencimiento = $_REQUEST['fechaVencimiento'];  
	    $idCredencial = $_REQUEST['idCredencial'];  
		$file = "";
		$url = "";
		$uidFoto = uniqid();
		/*
			Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
		*/
		if($_REQUEST['imgBase64'] != ""){
			$img = $_REQUEST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace('data:image/jpg;base64,', '', $img);
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace('data:image/gif;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = getcwd() . "/images/" . $uidFoto . '.png';
			$url = "images/" . $uidFoto . '.png';
			$success = file_put_contents($file, $data);
		}else{
			$url = $_REQUEST['fotoCon'];
		}
		$cargo = "";
		$curso = "";
		$arl = "";
		
		$tipoestudiante = "";
		$tipofuncionario = "";	
		
		$mes = "";
		
		//Se valida el tipo de usuario a crear
		switch($TipoUsuario){
            case "Estudiante":
                $cargo = "";
				$curso = $_REQUEST["curso"];
				$arl = "";
				$tipoestudiante = $_REQUEST["tipoestudiante"];
				$tipofuncionario = "";
                break;

            case "Funcionario":
                $cargo = $_REQUEST["cargo"];
				$curso = "0";
				$arl = $_REQUEST["arl"];
				$tipoestudiante = "";
				$tipofuncionario = $_REQUEST["tipofuncionario"];
                break;

            case "Acudiente":
               	$cargo = "";
				$curso = "0";
				$arl = "";
				$tipoestudiante = "";
				$tipofuncionario = "";
                break;
        }
        
        //Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $idUsuario,
			'TipoUsuario' => $TipoUsuario,
			'TipoId' => $TipoId,
			'NumeroId' => $NumeroId,
			'PrimerApellido' => $PrimerApellido,
			'SegundoApellido' => $SegundoApellido,
			'PrimerNombre' => $PrimerNombre,
			'SegundoNombre' => $SegundoNombre,
			'ImagenFotografica' => $url,
			'idAcudiente' => $idAcudiente,
			'Direccion' => $Direccion,
			'Telefono1' => $Telefono1,
			'Telefono2' => $Telefono2,
			'Estado' => "ACTIVO",
			'Clave' => $Clave,
			'Coordenadas' => $latitud . "," . $longitud,
			'latitud' => $latitud,
			'longitud' => $longitud,
			'numeroIdNuevo' => $numeroIdNuevo,
			'curso' => $curso,
			'TipoSangre' => $TipoSangre,
			'arl' => $arl,
			'cargo' => $cargo,
			'tipoestudiante' => $tipoestudiante,
			'tipofuncionario' => $tipofuncionario,
			'fechanacimiento' => $fechanacimiento);
		$this->usuarios_aplicaciones_model->editar($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		//echo $idUsuario . " - " . $TipoUsuario . " - " . $TipoId . " - " . $NumeroId . " - " . $PrimerApellido . " - " . $PrimerApellido . " - " . $SegundoApellido . " - " . $PrimerNombre . " - " . $SegundoNombre . " - " . $url . " - " . $idAcudiente . " - " . $Direccion . " - " . $Telefono1 . " - " . $Telefono2 . " - " . $Clave . " - " . $latitud . " - " . $longitud . " - " . $numeroIdNuevo . " - " . $curso . " - " . $TipoSangre . " - " . $arl . " - " . $cargo . " - " . $tipoestudiante . " - " . $tipofuncionario . " - " . $fechanacimiento . " - " . $idCredencial;

		//Se valida el tipo de usuario a crear
		switch($_REQUEST["TipoUsuario"]){
            case "Estudiante":   
            	//Se modifica los datos de la credencial, el acudiente y su estudiante asociado            	
				$this->credenciales_model->CambiarAcudiente($idAcudiente, $idUsuario, $idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				//Se cambia la fecha de vencimiento de la credencial
				$this->credenciales_model->CambiarFechaVencimiento($fechaVencimiento, $idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
                break;

            case "Funcionario":
            	//Se modifica los datos de la credencial, el acudiente y su estudiante asociado
            	$this->credenciales_model->CambiarAcudiente($idUsuario, $idUsuario, $idCredencial);//Se llama a la funcion de que esta en modelo y el resultado se guarda

            	//Se cambia la fecha de vencimiento de la credencial
                $this->credenciales_model->CambiarFechaVencimiento($fechaVencimiento, $idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
                break;

            case "Acudiente":
               	echo "[]";
                break;
        }

		


	}
	//Funcion para validar la existencia de un usuario de aplicaciones
	function ExisteUsuario(){
		$respuesta = $this->usuarios_aplicaciones_model->existeUsuario($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}

	//Funcion para validar la existencia de un usuario de aplicaciones por su numero de documento de identidad
	function ExisteDocumentoUsuario(){
		$respuesta = $this->usuarios_aplicaciones_model->existeDocumentoUsuario($_POST["documento"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}
	//Funcion para listar los acudientes
	function listarAcudientes(){
		$respuesta = $this->usuarios_aplicaciones_model->listarAcudientes();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuesta != null){
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
		
	}

	//Funcion para listar los estudiantes por filtro de curso o apellido
	function listarEstudiantes(){
		$respuesta = null;
		if(trim($_POST["curso"]) != "Seleccione" && trim($_POST["apellido"]) == ""){
			$respuesta = $this->usuarios_aplicaciones_model->ListarEstudiantes($_POST["curso"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}else{
			$respuesta = $this->usuarios_aplicaciones_model->ListarEstudiantesApellido($_POST["apellido"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}

		
		if($respuesta != null){
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
		
	}

	//Funcion para listar los estudiantes
	function ListarTodosEstudiantes(){
		$respuesta = $this->usuarios_aplicaciones_model->ListarTodosEstudiantes();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuesta != null){
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
		
	}

	//Funcion para consultar un usuario ya sea por numero de identificacion o por credencial
	function ConsultarUsuarioPorNum(){
		$resultado = $this->usuarios_aplicaciones_model->getUsuarioDocOther($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			foreach ($resultado->result() as $value) {
				$value->Clave = base64_decode($value->Clave);
				//$value->Clave = base64_decode($value->Clave);
			}
			echo json_encode($resultado->result());
			
		}else{
			$resultadoAcudiente = $this->usuarios_aplicaciones_model->getUsuarioDocAcudiente($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($resultadoAcudiente != null){
				foreach ($resultadoAcudiente->result() as $value) {
					$value->Clave = base64_decode($value->Clave);
					//$value->Clave = base64_decode($value->Clave);
					$value->idCredencial = "";
					$value->SaldoCredencial = "";
				}
				echo json_encode($resultadoAcudiente->result());
				
			}else{
				echo "[]";
			}
		}
	}

	//Funcion para consultar un usuario ya sea por numero de identificacion o por credencial
	function ConsultarUsuario(){

		//Se consulta primero si es un estudiante
		$resultadoPorId = $this->usuarios_aplicaciones_model->ConsultarUsuarioUsuarioDoc($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultadoPorId != null){
			foreach ($resultadoPorId->result() as $value) {
				$value->Clave = base64_decode($value->Clave);
				//$value->Clave = base64_decode($value->Clave);
			}
			echo json_encode($resultadoPorId->result());
			
		}else{
			//Si no es un estudiante, se consulta es un funcionario
			$resultadoFun = $this->usuarios_aplicaciones_model->ConsultarUsuarioUsuarioFuncionDoc($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($resultadoFun != null){
				foreach ($resultadoFun->result() as $value) {
					$value->Clave = base64_decode($value->Clave);
					//$value->Clave = base64_decode($value->Clave);
				}
				echo json_encode($resultadoFun->result());
				
			}else{
				//Si no es un funcionario, se consulta por el numero de documento	
				$resultado = $this->usuarios_aplicaciones_model->obtenerUsuarioDocumento($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($resultado != null){
					foreach ($resultado->result() as $value) {
						$value->Clave = base64_decode($value->Clave);
						//$value->Clave = base64_decode($value->Clave);
					}
					echo json_encode($resultado->result());
					
				}else{
					//Sino se consulta por la credencial
					$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
					if($resultadoPorCredencial != ""){
						echo $resultadoPorCredencial;	
					}else{
						echo "[]";
					}
									
				}
			}
		}
	}

	//Funcion para consultar un usuario por su numero de documento de identidad
	function ConsultarUsuarioDocumento(){
		$resultado = $this->usuarios_aplicaciones_model->obtenerUsuarioDocumento($_POST["document"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			foreach ($resultado->result() as $value) {
				echo json_encode($value);
			}
		}else{
			echo "{}";
		}
	}

	//Funcion para consultar un usuario por su numero de documento de identidad
	function ConsultarUsuarioReemplazoCrede(){
		//Se consulta primero si es un estudiante
		$resultadoPorId = $this->usuarios_aplicaciones_model->ConsultarUsuarioUsuarioDoc($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultadoPorId != null){
			foreach ($resultadoPorId->result() as $value) {
				$value->Clave = base64_decode($value->Clave);
			}
			echo json_encode($resultadoPorId->result());
			
		}else{
			//Si no es un estudiante, se consulta es un funcionario
			$resultadoFun = $this->usuarios_aplicaciones_model->ConsultarUsuarioUsuarioFuncionDoc($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($resultadoFun != null){
				foreach ($resultadoFun->result() as $value) {
					$value->Clave = base64_decode($value->Clave);
				}
				echo json_encode($resultadoFun->result());
				
			}else{
				//Sino se consulta por la credencial
				$resultadoPorCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				echo $resultadoPorCredencial;		
				
			}
		}
	}

	//Funcion para consultar un usuario por su numero de documento de identidad
	function ConsultarUsuarioFuncionario(){
		//Si no es un estudiante, se consulta es un funcionario
		$data_funcionario = $this->usuarios_aplicaciones_model->obtener_usuario_funcionario($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($data_funcionario != null){			
			echo json_encode($data_funcionario->result());			
		}else{
			echo "[]";
		}
	}

	//Funcion para consultar un borrar un usuario
	function action_borrar_funcionario(){
		$_POST["session"] = $this->session->userdata('UserIDInternoSSCA');
	 	$this->usuarios_aplicaciones_model->crear_log_funcionarios($_POST);
		$this->usuarios_aplicaciones_model->borrar_funcionario($_POST["usuario"]);
		$this->usuarios_aplicaciones_model->borrar_funcionario_credencial($_POST["usuario"]);
	}

	//Funcion para listar los estudiantes
	function ObtenerusuarioAplicacion(){
		$respuestaEstudiante = $this->usuarios_aplicaciones_model->obtenerAcudiente($_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuestaEstudiante != null){
			foreach ($respuestaEstudiante->result() as $value) {
				$respuestaAcudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($respuestaAcudiente != null){
					$value->NombreAcudiente = $respuestaAcudiente->result()[0]->PrimerNombre . " " . $respuestaAcudiente->result()[0]->SegundoNombre . " " . $respuestaAcudiente->result()[0]->PrimerApellido . " " . $respuestaAcudiente->result()[0]->SegundoApellido;
					$value->gcm_regid = $respuestaAcudiente->result()[0]->gcm_regid;
					
				}else{
					$value->NombreAcudiente = "";
					$value->gcm_regid = "";
				}
				if($value->TipoUsuario == "Acudiente"){
					$textoEstudiantes = "";
					$textoidEstudiantes = "";
					$respuestaEstudiantes = $this->usuarios_aplicaciones_model->obtenerDatosEstudiantes($value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
					if($respuestaEstudiantes != null){
						$contador = 0;
						//$value->Estudiantes = $respuestaEstudiantes->result();
						foreach ($respuestaEstudiantes->result() as $key) {
							if($contador == 0){
								$textoEstudiantes .= $key->PrimerNombre . " " . $key->SegundoNombre . " " . $key->PrimerApellido . " " . $key->SegundoApellido;
								$textoidEstudiantes .= $key->idUsuario;
							}else{
								$textoEstudiantes .= " - " . $key->PrimerNombre . " " . $key->SegundoNombre . " " . $key->PrimerApellido . " " . $key->SegundoApellido;
								$textoidEstudiantes .=  "," . $key->idUsuario;
							}
							$contador++;
						}
						$value->Estudiantes = $textoEstudiantes;
						$value->idEstudiantes = $textoidEstudiantes;
					}else{
						$value->Estudiantes = "";
						$value->idEstudiantes = "";
					}



				}
			}
			echo json_encode($respuestaEstudiante->result());
		}else{
			echo "[]";
		}
		
	}
}