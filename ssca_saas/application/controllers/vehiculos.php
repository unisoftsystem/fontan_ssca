<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Vehiculos extends CI_Controller {


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
		$this->load->model('usuarios_sistema_model');//Cargar el modelo de tipo de red donde estan las funciones que hacen las consultas a la bd
		$this->load->model('movimientos_model');//Cargar el modelo de movimientos donde estan las funciones que hacen las consultas a la bd
		$this->load->model('vehiculo_model');//Cargar el modelo de vehiculo donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/***************** MOSTRAR PAGINAS ***********************/
	public function index()
	{
		
	}

	//Mostrar la vista de crear vehiculo
	function nuevo(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../vehiculos/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Creación de Vehiculos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('vehiculo/nuevo', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar vehiculo
	function editar(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../vehiculos/editar", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Modificación de Vehiculos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('vehiculo/editar', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/************************* ACCIONES *******************************************/

	//Funcion para crear un vehiculo
	function insertar(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'marca' => $_POST["marca"],
			'categoria' => $_POST["categoria"],
			'placa' => $_POST["placa"],
			'ruta' => $_POST["ruta"],
			'sillas' => $_POST["sillas"],
			'observaciones' => $_POST["observaciones"],
			'ImagenFotografica' => $url,
			'coordenadas' => $_POST["coordenadas"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->vehiculo_model->crear($array);//Se llama a la funcion de que esta en modelo
	}

	//Funcion para crear un vehiculo
	function actualizar(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'marca' => $_POST["marca"],
			'categoria' => $_POST["categoria"],
			'placa' => $_POST["placa"],
			'ruta' => $_POST["ruta"],
			'sillas' => $_POST["sillas"],
			'observaciones' => $_POST["observaciones"],
			'ImagenFotografica' => $url,
			'coordenadas' => $_POST["coordenadas"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->vehiculo_model->editar($array);//Se llama a la funcion de que esta en modelo
	}

	//Funcion para validar la existencia de un vehiculo por su placa
	function ExisteVehiculoPlaca(){
		$respuesta = $this->vehiculo_model->existeVehiculoPlaca($_POST["placa"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}

	//Funcion para obtener un vehiculo por su placa
	function obtenerVehiculoPlaca(){
		$respuesta = $this->vehiculo_model->getVehiculoPlaca($_POST["placa"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuesta != null){
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
	}

	//Funcion para obtener un vehiculo por su placa
	function obtenerVehiculoId(){
		$respuesta = $this->vehiculo_model->getVehiculoID($_POST["id"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuesta != null){
			foreach ($respuesta->result() as $value) {
				echo json_encode($value);
			}	
		}else{
			echo "{}";
		}
	}
}