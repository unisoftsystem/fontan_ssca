<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Turnos_laborales extends CI_Controller {

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
		$this->load->model('detalle_orden_pedido_model');//Cargar el modelo de detalle de orden de pedido donde estan las funciones que hacen las consultas a la bd
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('movimientos_model');//Cargar el modelo de movimientos donde estan las funciones que hacen las consultas a la bd
		$this->load->model('producto_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('turnos_laborales_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('categoria_model');//Cargar el modelo de categoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_aplicaciones_model');//Cargar el modelo de usuarios de aplicaciones donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}
	/******************** MOSTRAR PAGINAS **************************/
	public function index()
	{
		
	}

	//Mostrar la vista de consultar movimientos
	function adminTurnos(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../turnos_laborales/adminTurnos", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "ADMINISTRACION DE TURNOS LABORALES";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['funcionarios'] = $this->usuarios_aplicaciones_model->ListarTodosFuncionarios();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('turnos/adminTurnos');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}
	/******************* ACCIONES ******************************/

	function crearTurno(){
		$array = array(
			'idUsuario' => $_POST["usuario"],
			'nombre' => $_POST["nombre"],
			'horainicio' => $_POST["horainicio"],
			'horafinal' => $_POST["horafinal"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->turnos_laborales_model->crear($array);//Se llama a la funcion de que esta en modelo
	}

	function editarTurno(){
		$array = array(
			'idUsuario' => $_POST["usuario"],
			'nombre' => $_POST["nombre"],
			'horainicio' => $_POST["horainicio"],
			'horafinal' => $_POST["horafinal"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->turnos_laborales_model->editar($array);//Se llama a la funcion de que esta en modelo
	}

	function obtenerTurno(){
		$data = $this->turnos_laborales_model->getTurno($_POST["usuario"]);
		if($data != null){
			echo json_encode($data->result());
		}else{
			echo "[]";
		}
	}

}