<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitores extends CI_Controller {

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
		$this->load->model('monitor_model');//Cargar el modelo de monitor donde estan las funciones que hacen las consultas a la bd
		$this->load->model('tarifas_model');//Cargar el modelo de tarifas donde estan las funciones que hacen las consultas a la bd
		$this->load->model('curso_model');//Cargar el modelo de curso donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/********* MOSTRAR PAGINAS *****************************/

	public function index()
	{
		
	}

	//Mostrar la vista de crear monitores
	function nuevo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../monitores/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Creación de Monitores";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('monitor/nuevo');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar monitores
	function editar(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../monitores/editar", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Modificación de Monitores";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('monitor/editar');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/*************** ACCIONES ******************************/

	//Funcion para crear un monitor
	function crearMonitor(){
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
		
		//Se obtienen los valores de las tarifas
		$VrTarjeta = $this->tarifas_model->ConsultarValorTarifa("Vr. Tarjeta");//Se llama a la funcion de que esta en modelo y el resultado se guarda
		$VrTransaccional = $this->tarifas_model->ConsultarValorTarifa("Vr Transaccional");
		
		//Se divide la fecha para mostrarla en letras en la credencial que se genera
		$dateVenci = explode("-", $_POST["fechaVencimiento"]);
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

		$cargo = "Monitor";
		$curso = "0";
		$arl = $_POST["arl"];
		$tipoestudiante = "";
		$tipofuncionario = $_POST["tipofuncionario"];
        
     	//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["idUsuario"],
			'TipoUsuario' => "Funcionario",
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
			'fechanacimiento' => $_POST["fechanacimiento"]);
		$this->usuarios_aplicaciones_model->crear($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

	 	//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayDatos = array(
			'idmonitor' => $_POST["NumeroId"],
			'nombre' => $_POST["PrimerNombre"] . " " . $_POST["SegundoNombre"],
			'apellido' => $_POST["PrimerApellido"] . " " . $_POST["SegundoApellido"],
			'telefono' => $_POST["Telefono1"] . " " . $_POST["Telefono2"],
			'TipoId' => $_POST["TipoId"],
			'ImagenFotografica' => $url,
			'Direccion' => $_POST["Direccion"],
			'Clave' => base64_encode($_POST["Clave"]),
			'Coordenadas' => $_POST["latitud"] . "," . $_POST["longitud"],
			'TipoSangre' => $_POST["TipoSangre"],
			'arl' => $arl);
		$this->monitor_model->crear($arrayDatos);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayCredencial = array(
			'idUsuarioPrincipal' => $_POST["idUsuario"],
			'idUsuarioSecundario' => $_POST["idUsuario"],
			'SaldoCredencial' => $_POST["saldo"],
			'FechaVencimiento' => $_POST["fechaVencimiento"]);
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
		
		$tipoId = $_POST["TipoId"];	
		$numeroId = $_POST["NumeroId"];	
		$primerApellido = $_POST["PrimerApellido"];	
		$segundoApellido = $_POST["SegundoApellido"];	
		$primerNombre = $_POST["PrimerNombre"];	
		$segundoNombre = $_POST["SegundoNombre"];		
		$tipoUsuario = "Funcionario";	
		$tipoSangre = $_POST["TipoSangre"];
		$arl = $_POST["arl"];
		$cargo = "Monitor";
		$fechaVencimiento = $_POST["fechaVencimiento"];

		//Se genera el json para la creacion de la credencial en la vista
		echo '[{"resultado":"' . $credencial . '", "curso":"NINGUNO", "tipoSangre":"' . $tipoSangre . '", "credencial":"' . $credencial . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $url . '", "fechaVencimiento":"' . $mes . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '"}]';
	}

	//Funcion para crear un monitor
	function editarMonitor(){
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
		}else{
			$url = $_POST['fotoCon'];
		}
		
		$credencial = "";		
		$mes = "";		
		$cargo = "Monitor";
		$curso = "0";
		$arl = $_POST["arl"];
		$tipoestudiante = "";
		$tipofuncionario = $_POST["tipofuncionario"];
        
        //Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["idUsuario"],
			'TipoUsuario' => "Funcionario",
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
			'numeroIdNuevo' => $_POST["NumeroId"],
			'TipoSangre' => $_POST["TipoSangre"],
			'arl' => $arl,
			'cargo' => $cargo,
			'tipoestudiante' => $tipoestudiante,
			'tipofuncionario' => $tipofuncionario,
			'fechanacimiento' => $_POST["fechanacimiento"]);
		$this->usuarios_aplicaciones_model->editar($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$arrayDatos = array(
			'idmonitor' => $_POST["NumeroId"],
			'nombre' => $_POST["PrimerNombre"] . " " . $_POST["SegundoNombre"],
			'apellido' => $_POST["PrimerApellido"] . " " . $_POST["SegundoApellido"],
			'telefono' => $_POST["Telefono1"] . " " . $_POST["Telefono2"],
			'TipoId' => $_POST["TipoId"],
			'ImagenFotografica' => $url,
			'Direccion' => $_POST["Direccion"],
			'Clave' => base64_encode($_POST["Clave"]),
			'Coordenadas' => $_POST["latitud"] . "," . $_POST["longitud"],
			'TipoSangre' => $_POST["TipoSangre"],
			'arl' => $arl);
		$this->monitor_model->editar($arrayDatos);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se modifica los datos de la credencial, el acudiente y su estudiante asociado
		$this->credenciales_model->CambiarAcudiente($_POST["idUsuario"], $_POST["idUsuario"], $_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se cambia la fecha de vencimiento de la credencial
		$this->credenciales_model->CambiarFechaVencimiento($_POST["fechaVencimiento"], $_POST["idUsuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

	}

	//Funcion para consultar un monitor por su numero de documento de identidad
	function ConsultarMonitor(){
		$resultadoPorId = $this->monitor_model->getMonitorDoc($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultadoPorId != null){
			foreach ($resultadoPorId->result() as $value) {
				$value->Clave = base64_decode($value->Clave);
			}
			echo json_encode($resultadoPorId->result());
			
		}else{
			echo "[]";
		}
	}
}