<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");	
class Rutas extends CI_Controller {

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
		$this->load->model('categoria_model');//Cargar el modelo de categoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_aplicaciones_model');//Cargar el modelo de usuarios de aplicaciones donde estan las funciones que hacen las consultas a la bd
		$this->load->model('conductor_model');//Cargar el modelo de conductor donde estan las funciones que hacen las consultas a la bd
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('subcategoria_model');//Cargar el modelo de subcategorias donde estan las funciones que hacen las consultas a la bd
		$this->load->model('monitor_model');//Cargar el modelo de monitor donde estan las funciones que hacen las consultas a la bd
		$this->load->model('vehiculo_model');//Cargar el modelo de vehiculo donde estan las funciones que hacen las consultas a la bd
		$this->load->model('curso_model');//Cargar el modelo de curso donde estan las funciones que hacen las consultas a la bd
		$this->load->model('rutas_model');//Cargar el modelo de vehiculo donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/****************************** MOSTRAR PAGINAS ******************************************/
	public function index()
	{
		
	}

	//Mostrar la vista de crear rutas
	function nuevo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/nuevo", $this->session->userdata('UserIDInternoSSCA'));

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['cursos'] = $this->curso_model->listarCursos();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			//$data['monitores'] = $this->monitor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			//$data['conductores'] = $this->conductor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			//$data['vehiculos'] = $this->vehiculo_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Creación de Rutas Escolares";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('rutas/nuevo');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar rutas
	function editar(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/editar", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['cursos'] = $this->curso_model->listarCursos();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			//$data['monitores'] = $this->monitor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			//$data['conductores'] = $this->conductor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			//$data['vehiculos'] = $this->vehiculo_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Modificación de Rutas Escolares";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/editar');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar rutas
	function obtener(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/obtener", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['monitores'] = $this->monitor_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['conductores'] = $this->conductor_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['vehiculos'] = $this->vehiculo_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Tracking de Rutas";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/obtener');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	// BITACORA Obtener observaciones particulares de una ruta
	function get_observacione_particulares() {
		$this->load->model('rutas_model');
		$response = $this->rutas_model->get_observacione_particulares(
			$_POST['id_asignacionruta'],
			$_POST['fecha_reemplazo']
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// BITACORA Obtener observaciones particulares de una ruta
	function get_alerta_monitor() {
		$this->load->model('rutas_model');
		$response = $this->rutas_model->get_alerta_monitor(
			$_POST['id_asignacionruta'],
			$_POST['fecha_reemplazo']
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// BITACORA Obtener observaciones particulares de una ruta
	function get_chat_con_acudiente() {
		$this->load->model('rutas_model');
		$response = $this->rutas_model->get_chat_con_acudiente(
			$_POST['id_asignacionruta'],
			$_POST['fecha_reemplazo']
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// BITACORA Obtener los datos para el recorrido del dia
	function get_recorrido_dia() {
		$this->load->model('rutas_model');
		$response = $this->rutas_model->get_recorrido_dia(
			$_POST['id_asignacionruta'],
			$_POST['fecha_reemplazo']
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	//Mostrar la vista de visualizar rutas
	function chatMonitor(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/chatMonitor", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "MONITOR RUTA ESCOLAR";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('chat/mensajeMonitor');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar rutas
	function chatAcudiente(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/chatAcudiente", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "ACUDIENTES";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('chat/chatAcudiente');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar rutas
	function bitacora(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/bitacora", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Bitacora de Ruta Escolar";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/bitacora');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar mensajes enviados de los acudientes a los monitores
	function mensajeacudienteamonitor(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/mensajeacudienteamonitor", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['mensajes'] = $this->rutas_model->listarMensajesAcudienteaCoordinador();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "REPORTE DE MENSAJES DE ACUDIENTES A MONITOR";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/mensajeacudienteamonitor');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	// Obtener los chasts de los acudientes a los monitores de una ruta
	function get_mensaje_acudiente_monitor(){
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina(
			"../rutas/mensajeacudienteamonitor", 
			$this->session->userdata('UserIDInternoSSCA')
		);	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){
			$fecha = date('Y-m-d', strtotime($_POST['fecha_reemplazo']));
			$idruta = $_POST['id_asignacionruta'];

			$mensajes = $this->rutas_model->get_mensaje_acudiente_monitor($idruta, $fecha); 
			header('Content-Type: application/json');
			echo json_encode($mensajes);
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";
		}
	}

	//Mostrar la vista de visualizar mensajes enviados por el coordinador de rutas a los acudientes
	function mensajecoordinadoracudiente(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/mensajecoordinadoracudiente", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['mensajes'] = $this->rutas_model->listarMensajesCoordinadorAcudiente();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "REPORTE DE MENSAJES A LOS ACUDIENTES";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/mensajecoordinadoracudiente');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar mensajes enviados por el coordinador de rutas a los acudientes
	function enviarmensajeacudientes(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/enviarmensajeacudientes", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['mensajes'] = $this->rutas_model->listarMensajesCoordinadorAcudiente();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Envío de Mensajes para Acudientes";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/enviarmensajeacudientes');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar mensajes predefinidos para el chat de la app de monitor
	function mensajes_predefinidos(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		/*$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/enviarmensajeacudientes", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){*/

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['mensajes'] = $this->rutas_model->listar_mensajes_predefinidos();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Administración de Mensajes Predefinidos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/mensajes_predefinidos');//Se carga la vista que esta dentro de la carpeta
		/*}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}*/
	}

	//Mostrar la vista de visualizar rutas
	function todos(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/obtener", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Tracking de Rutas";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/todos');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar rutas
	function calendariomonitores(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/calendariomonitores", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Calendario de Monitores en Ruta";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/monitoresebruta');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar rutas
	function admintraslados(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/admintraslados", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){
			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Administración Individual de Traslados";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/admintraslados');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de visualizar rutas
	function calendariovehiculos(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../rutas/calendariovehiculos", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['rutas'] = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda en la variable
			$data['titulo'] = "Calendario de Vehiculos en Ruta";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada

			$this->load->view('rutas/vehiculosruta');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de contactenos que abre el acudiente desde el mensaje recibido en su correo
	function contactenos(){	
		//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
		$this->load->library('../controllers/services');
		$data['titulo'] = "Contactenos";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('rutas/contactenos');//Se carga la vista que esta dentro de la carpeta		
	}

	/****************************** ACCIONES ******************************************/

	//Funcion para crear una ruta
	function insertar(){

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'vehiculo' => $_POST["ruta"],
			'nombreruta' => $_POST["nombre"],
			'monitor' => $_POST["monitor"],
			'conductor' => $_POST["conductor"],
			'latorigen' => $_POST["lat"],
			'longorigen' => $_POST["lng"],
			'latdestino' => $_POST["lats"],
			'longdestino' => $_POST["lngs"],
			'color' => $_POST["color"],
			'repetir' => $_POST["repetir"],
			'horainicial' => $_POST["horainicial"],
			'horafinal' => $_POST["horafinal"],
			'fechainicial' => $_POST["fechainicial"],
			'fechafinal' => $_POST["fechafinal"],
			'ruta_dinamica' => $_POST["rutaDinamica"],
		);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$id = $this->rutas_model->crear($array);//Se llama a la funcion de que esta en modelo

		//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
		switch ($_REQUEST["repetir"]) {
			case 'NUNCA':
				$arrayDatosCalendario = array(
					'vehiculo' => $_POST["ruta"],
					'idruta' =>$id,
					'nombreruta' => $_POST["nombre"],
					'monitor' => $_POST["monitor"],
					'conductor' => $_POST["conductor"],
					'latorigen' => $_POST["lat"],
					'longorigen' => $_POST["lng"],
					'latdestino' => $_POST["lats"],
					'longdestino' => $_POST["lngs"],
					'color' => $_POST["color"],
					'repetir' => $_POST["repetir"],
					'horainicial' => $_POST["horainicial"],
					'horafinal' => $_POST["horafinal"],
					'fecha' => $_POST["fechainicial"]);
				//Se llama a la funcion de guardar datos en bd que esta en el modelo
				$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo
				break;

			case 'DIARIAMENTE':
				$fechaFinal = $_REQUEST["fechafinal"];
				if($_REQUEST["fechafinal"] == ""){
					$datos = explode("-", $_REQUEST["fechainicial"]);
					$month = $datos[0] . '-12';
					$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
					$fechaFinal = date('Y-m-d', strtotime("{$aux} - 1 day"));
				}
				$fecha1 = strtotime($_POST["fechainicial"]);
				$fecha2 = strtotime($fechaFinal);

				$fechaIterada = strtotime($_POST["fechainicial"]);
				$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

				while($fechaIterada >= $fecha1 && $fechaIterada <= $fecha2){		

					$arrayDatosCalendario = array(
						'vehiculo' => $_POST["ruta"],
						'idruta' =>$id,
						'nombreruta' => $_POST["nombre"],
						'monitor' => $_POST["monitor"],
						'conductor' => $_POST["conductor"],
						'latorigen' => $_POST["lat"],
						'longorigen' => $_POST["lng"],
						'latdestino' => $_POST["lats"],
						'longdestino' => $_POST["lngs"],
						'color' => $_POST["color"],
						'repetir' => $_POST["repetir"],
						'horainicial' => $_POST["horainicial"],
						'horafinal' => $_POST["horafinal"],
						'fecha' => $nuevafecha);
					//Se llama a la funcion de guardar datos en bd que esta en el modelo
					$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo*/					

					//echo $nuevafecha . " " . $_POST["fechainicial"] . "";
					$fechaIterada = strtotime ( '+1 day' , $fechaIterada) ;
					$nuevafecha = date ( 'Y-m-d' , $fechaIterada );
					

				}
				break;

			case 'SEMANALMENTE':
				$fechaFinal = $_REQUEST["fechafinal"];
				if($_REQUEST["fechafinal"] == ""){
					$datos = explode("-", $_REQUEST["fechainicial"]);
					$month = $datos[0] . '-12';
					$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
					$fechaFinal = date('Y-m-d', strtotime("{$aux} - 1 day"));
				}
				$fecha1 = strtotime($_POST["fechainicial"]);
				$fecha2 = strtotime($fechaFinal);

				$fechaIterada = strtotime($_POST["fechainicial"]);
				$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

				while($fechaIterada >= $fecha1 && $fechaIterada <= $fecha2){		

					$arrayDatosCalendario = array(
						'vehiculo' => $_POST["ruta"],
						'idruta' =>$id,
						'nombreruta' => $_POST["nombre"],
						'monitor' => $_POST["monitor"],
						'conductor' => $_POST["conductor"],
						'latorigen' => $_POST["lat"],
						'longorigen' => $_POST["lng"],
						'latdestino' => $_POST["lats"],
						'longdestino' => $_POST["lngs"],
						'color' => $_POST["color"],
						'repetir' => $_POST["repetir"],
						'horainicial' => $_POST["horainicial"],
						'horafinal' => $_POST["horafinal"],
						'fecha' => $nuevafecha);
					//Se llama a la funcion de guardar datos en bd que esta en el modelo
					$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo*/					

					//echo $nuevafecha . " " . $_POST["fechainicial"] . "";
					$fechaIterada = strtotime ( '+7 day' , $fechaIterada) ;
					$nuevafecha = date ( 'Y-m-d' , $fechaIterada );
					

				}
				break;

			case 'MENSUALMENTE':
				$fechaFinal = $_REQUEST["fechafinal"];
				if($_REQUEST["fechafinal"] == ""){
					$datos = explode("-", $_REQUEST["fechainicial"]);
					$month = $datos[0] . '-12';
					$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
					$fechaFinal = date('Y-m-d', strtotime("{$aux} - 1 day"));
				}
				$fecha1 = strtotime($_POST["fechainicial"]);
				$fecha2 = strtotime($fechaFinal);

				$fechaIterada = strtotime($_POST["fechainicial"]);
				$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

				while($fechaIterada >= $fecha1 && $fechaIterada <= $fecha2){		

					$arrayDatosCalendario = array(
						'vehiculo' => $_POST["ruta"],
						'idruta' =>$id,
						'nombreruta' => $_POST["nombre"],
						'monitor' => $_POST["monitor"],
						'conductor' => $_POST["conductor"],
						'latorigen' => $_POST["lat"],
						'longorigen' => $_POST["lng"],
						'latdestino' => $_POST["lats"],
						'longdestino' => $_POST["lngs"],
						'color' => $_POST["color"],
						'repetir' => $_POST["repetir"],
						'horainicial' => $_POST["horainicial"],
						'horafinal' => $_POST["horafinal"],
						'fecha' => $nuevafecha);
					//Se llama a la funcion de guardar datos en bd que esta en el modelo
					$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo*/					

					//echo $nuevafecha . " " . $_POST["fechainicial"] . "";
					$fechaIterada = strtotime ( '+1 month' , $fechaIterada) ;
					$nuevafecha = date ( 'Y-m-d' , $fechaIterada );
					

				}
				break;
		}

		//Dividir la cadena los estudiantes seleccionados en la ruta para guardarlos en la bd
		$estudiantes = explode(",", $_POST["estudiantes"]);
		
		//Se itera el array resultante de la division por coma
		for ($i=0; $i < count($estudiantes); $i++) { 
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$datosEstudiantes = array(
				'estudiante' => $estudiantes[$i],
				'idruta' => $id);

			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->rutas_model->agregarEstudiantes($datosEstudiantes);//Se llama a la funcion de que esta en modelo
		}
	}

	//Funcion para editar una ruta
	function modificar(){
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'vehiculo' => $_POST["ruta"],
			'nombreruta' => $_POST["nombre"],
			'monitor' => $_POST["monitor"],
			'conductor' => $_POST["conductor"],
			'latorigen' => $_POST["lat"],
			'longorigen' => $_POST["lng"],
			'latdestino' => $_POST["lats"],
			'longdestino' => $_POST["lngs"],
			'color' => $_POST["color"],
			'repetir' => $_POST["repetir"],
			'horainicial' => $_POST["horainicial"],
			'horafinal' => $_POST["horafinal"],
			'fechainicial' => $_POST["fechainicial"],
			'fechafinal' => $_POST["fechafinal"],
			'id' => $_POST["idruta"]
		);

		//Se valida si es edicion o particuliaridad
		if(isset($_POST['isParticuliaridad']) && $_POST['isParticuliaridad'] == '1') {
			$array['observaciones'] = $_POST['observaciones'];
			$array['fecha_reemplazo'] = $_POST['fecha_reemplazo'];	
			$array['id_asignacionruta'] = $_POST['id_asignacionruta'];
			$resp = $this->rutas_model->crear_ruta_paralela_particularides($array);
			header('Content-Type: application/json');
			echo json_encode($resp);
		}else {
			$this->rutas_model->editar($array);//Se llama a la funcion de que esta en modelo
			//Se borran primero los estudiantes que antes han sido agregados a la ruta
			$this->rutas_model->borrarEstudiantes($_POST["idruta"]);//Se llama a la funcion de que esta en modelo

			$this->rutas_model->borrarDatosCalendario($_POST["idruta"]);//Se llama a la funcion de que esta en modelo

			//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
			switch ($_REQUEST["repetir"]) {
				case 'NUNCA':
					$arrayDatosCalendario = array(
						'vehiculo' => $_POST["ruta"],
						'idruta' =>$_POST["idruta"],
						'nombreruta' => $_POST["nombre"],
						'monitor' => $_POST["monitor"],
						'conductor' => $_POST["conductor"],
						'latorigen' => $_POST["lat"],
						'longorigen' => $_POST["lng"],
						'latdestino' => $_POST["lats"],
						'longdestino' => $_POST["lngs"],
						'color' => $_POST["color"],
						'repetir' => $_POST["repetir"],
						'horainicial' => $_POST["horainicial"],
						'horafinal' => $_POST["horafinal"],
						'fecha' => $_POST["fechainicial"]);
					//Se llama a la funcion de guardar datos en bd que esta en el modelo
					$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo
					break;

				case 'DIARIAMENTE':
					$fechaFinal = $_REQUEST["fechafinal"];
					if($_REQUEST["fechafinal"] == ""){
						$datos = explode("-", $_REQUEST["fechainicial"]);
						$month = $datos[0] . '-12';
						$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
						$fechaFinal = date('Y-m-d', strtotime("{$aux} - 1 day"));
					}
					$fecha1 = strtotime($_POST["fechainicial"]);
					$fecha2 = strtotime($fechaFinal);

					$fechaIterada = strtotime($_POST["fechainicial"]);
					$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

					while($fechaIterada >= $fecha1 && $fechaIterada <= $fecha2){		

						$arrayDatosCalendario = array(
							'vehiculo' => $_POST["ruta"],
							'idruta' =>$_POST["idruta"],
							'nombreruta' => $_POST["nombre"],
							'monitor' => $_POST["monitor"],
							'conductor' => $_POST["conductor"],
							'latorigen' => $_POST["lat"],
							'longorigen' => $_POST["lng"],
							'latdestino' => $_POST["lats"],
							'longdestino' => $_POST["lngs"],
							'color' => $_POST["color"],
							'repetir' => $_POST["repetir"],
							'horainicial' => $_POST["horainicial"],
							'horafinal' => $_POST["horafinal"],
							'fecha' => $nuevafecha);
						//Se llama a la funcion de guardar datos en bd que esta en el modelo
						$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo				

						//echo $nuevafecha . " " . $_POST["fechainicial"] . "";
						$fechaIterada = strtotime ( '+1 day' , $fechaIterada) ;
						$nuevafecha = date ( 'Y-m-d' , $fechaIterada );
						

					}
					break;

				case 'SEMANALMENTE':
					$fechaFinal = $_REQUEST["fechafinal"];
					if($_REQUEST["fechafinal"] == ""){
						$datos = explode("-", $_REQUEST["fechainicial"]);
						$month = $datos[0] . '-12';
						$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
						$fechaFinal = date('Y-m-d', strtotime("{$aux} - 1 day"));
					}
					$fecha1 = strtotime($_POST["fechainicial"]);
					$fecha2 = strtotime($fechaFinal);

					$fechaIterada = strtotime($_POST["fechainicial"]);
					$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

					while($fechaIterada >= $fecha1 && $fechaIterada <= $fecha2){		

						$arrayDatosCalendario = array(
							'vehiculo' => $_POST["ruta"],
							'idruta' =>$_POST["idruta"],
							'nombreruta' => $_POST["nombre"],
							'monitor' => $_POST["monitor"],
							'conductor' => $_POST["conductor"],
							'latorigen' => $_POST["lat"],
							'longorigen' => $_POST["lng"],
							'latdestino' => $_POST["lats"],
							'longdestino' => $_POST["lngs"],
							'color' => $_POST["color"],
							'repetir' => $_POST["repetir"],
							'horainicial' => $_POST["horainicial"],
							'horafinal' => $_POST["horafinal"],
							'fecha' => $nuevafecha);
						//Se llama a la funcion de guardar datos en bd que esta en el modelo
						$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo					

						//echo $nuevafecha . " " . $_POST["fechainicial"] . "";
						$fechaIterada = strtotime ( '+7 day' , $fechaIterada) ;
						$nuevafecha = date ( 'Y-m-d' , $fechaIterada );
						

					}
					break;

				case 'MENSUALMENTE':
					$fechaFinal = $_REQUEST["fechafinal"];
					if($_REQUEST["fechafinal"] == ""){
						$datos = explode("-", $_REQUEST["fechainicial"]);
						$month = $datos[0] . '-12';
						$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
						$fechaFinal = date('Y-m-d', strtotime("{$aux} - 1 day"));
					}
					$fecha1 = strtotime($_POST["fechainicial"]);
					$fecha2 = strtotime($fechaFinal);

					$fechaIterada = strtotime($_POST["fechainicial"]);
					$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

					while($fechaIterada >= $fecha1 && $fechaIterada <= $fecha2){		

						$arrayDatosCalendario = array(
							'vehiculo' => $_POST["ruta"],
							'idruta' =>$_POST["idruta"],
							'nombreruta' => $_POST["nombre"],
							'monitor' => $_POST["monitor"],
							'conductor' => $_POST["conductor"],
							'latorigen' => $_POST["lat"],
							'longorigen' => $_POST["lng"],
							'latdestino' => $_POST["lats"],
							'longdestino' => $_POST["lngs"],
							'color' => $_POST["color"],
							'repetir' => $_POST["repetir"],
							'horainicial' => $_POST["horainicial"],
							'horafinal' => $_POST["horafinal"],
							'fecha' => $nuevafecha);
						//Se llama a la funcion de guardar datos en bd que esta en el modelo
						$this->rutas_model->crearDatosCalendario($arrayDatosCalendario);//Se llama a la funcion de que esta en modelo					

						//echo $nuevafecha . " " . $_POST["fechainicial"] . "";
						$fechaIterada = strtotime ( '+1 month' , $fechaIterada) ;
						$nuevafecha = date ( 'Y-m-d' , $fechaIterada );
						

					}
					break;
			}

			//Dividir la cadena los estudiantes seleccionados en la ruta para guardarlos en la bd
			$estudiantes = explode(",", $_POST["estudiantes"]);
			
			//Se itera el array resultante de la division por coma
			for ($i=0; $i < count($estudiantes); $i++) { 
				//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$datosEstudiantes = array(
					'estudiante' => $estudiantes[$i],
					'idruta' => $_POST["idruta"]);

				//Se llama a la funcion de guardar datos en bd que esta en el modelo
				$this->rutas_model->agregarEstudiantes($datosEstudiantes);//Se llama a la funcion de que esta en modelo
			}
		}

	}

	//Funcion para registrar observaciones de rutas
	function registrar_observacion(){
		$_POST["usuario_session"] = $this->session->userdata('UserIDInternoSSCA');
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$result_user = $this->usuarios_aplicaciones_model->getUsuarioDocAcudiente($_POST["numero_id"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($result_user != null){
			foreach ($result_user->result() as $value) {
				$_POST["usuario"] = $value->idUsuario;
			}			
		}
		$this->rutas_model->crear_observacion($_POST);//Se llama a la funcion de que esta en modelo				
	}

	//Funcion para validar la existencia de una ruta
	function ExisteRuta(){
		$respuesta = $this->rutas_model->existeRuta($_POST["ruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}

	//Funcion para validar la existencia del color de una ruta
	function ExisteColorRuta(){
		$respuesta = $this->rutas_model->existeColorRuta($_POST["color"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}

	//Funcion para obtener una ruta
	function ObtenerRuta(){
		$respuesta = $this->rutas_model->get($_POST["ruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){
			$estudiantes = $this->rutas_model->getEstudiantes($_POST["ruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			foreach ($respuesta->result() as $value) {

				if($estudiantes != null){
					$value->estudiantes = $estudiantes->result();
				}else{
					$value->estudiantes = array();
				}
			}			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener una ruta detallada
	function ObtenerRutaDetallada(){
		$respuesta = $this->rutas_model->getRuta($_POST["ruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ObtenerCoordenadasRuta(){
		$respuesta = $this->rutas_model->getCoordenadasRuta($_REQUEST["idruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener coordenadas de un bus de una ruta
	function ObtenerCoordenadasBus(){
		$fecha = date("Y-m-d");
		//$fecha = "2017-01-12";
		$respuesta = $this->rutas_model->getCoordenadasBus($_REQUEST["idruta"], $fecha);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	function ObtenerTodasCoordenadasBus(){
		$respuesta = $this->rutas_model->getTodasCoordenadasBus($_POST["idruta"], $_POST["fecha"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	function ObtenerTodasCoordenadasBusSinFecha(){
		$respuesta = $this->rutas_model->getTodasCoordenadasBusSinFecha($_POST["idruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener coordenadas de un bus de una ruta
	function ObtenerCoordenadasTodosBus(){
		$fecha = date("Y-m-d");
		$datos = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($datos != null){	
			foreach ($datos->result() as $value) {
				$respuesta = $this->rutas_model->getCoordenadasBus($value->id, $fecha);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($respuesta != null){	
					$value->coordenadas_recogida = $respuesta->result()[0]->coordenadas_recogida;
				}else{
					$value->coordenadas_recogida = "";
				}		
			}		
			echo json_encode($datos->result());
		}else{
			echo "[]";
		}
		
	}
	function MensajePru() {
		// El mensaje
		$mensaje = '<style type="text/css">
			*{
				margin: 0;
				padding: 0;
			}
			.btn-primary {
			    
			}
			.btn {
			    
			}
		</style>
		<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
		<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
		<div align="center" style="width: 50%; float: right">
			<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>Shelvin Batista</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
			<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=shelvinbb@gmail.com&name=Shelvin Batista" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
			    margin-bottom: 0;
			    font-size: 18px;
			    font-weight: 400;
			    line-height: 1.42857143;
			    text-align: center;
			    white-space: nowrap;
			    vertical-align: middle;
			    -ms-touch-action: manipulation;
			    touch-action: manipulation;
			    cursor: pointer;
			    -webkit-user-select: none;
			    -moz-user-select: none;
			    -ms-user-select: none;
			    user-select: none;
			    border: 1px solid transparent;color: #fff;
			    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
		</div>
		<div style="width:100%" align="center">
			<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
		</div>
		<table width="100%" border="0">
			<tr>
				<td width="20px">&nbsp;</td>
				<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
				<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
				<td>
					<div style="width: 100%">
						<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
					</div>
				</td>
			</tr>
		</table>';										
		
		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = "shelvinbb@gmail.com";
		$email_subject = "Informe Ingreso a Ruta Escolar";

		$configuraciones["mailtype"] = 'html';
		$this->email->initialize($configuraciones);
		$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
		$this->email->to($email_to);
		$this->email->subject($email_subject);
		$this->email->message($mensaje);
		$this->email->send();
	}

	function RegistroRecogidaSinCredencial(){
		$latitud = $_POST["latitud"];	
		$longitud = $_POST["longitud"];
		$fecha = date("Y-m-d");	
		$hora = date("H:i:s");	
		$tipo = $_POST["tipo"];	
		$idRuta = $_POST["idRuta"];

		$data = $this->usuarios_aplicaciones_model->ConsultarUsuarioUsuarioFuncionDoc($_POST["usuario"]);

		if($data != null){
			foreach ($data->result() as $value) {
				$idCredencial = $value->idCredencial;

				$respuestaCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($idCredencial);


				if($respuestaCredencial != "[]"){
					$jsonUsuario = json_decode($respuestaCredencial, true);

					if($jsonUsuario[0]["TipoUsuario"] == "Estudiante"){

						// Validara si la ruta es dinamica
						$is_dinamic_route = $this->rutas_model->is_dinamic_route($idRuta);
						// verifivar la existencia del usuario
						if($is_dinamic_route == 1) {
							$usuarioTieneRuta = 1;
						}else {
							$usuarioTieneRuta = $this->rutas_model->existeUsuarioRuta($idRuta, $jsonUsuario[0]["idUsuario"]);
						}

						if($usuarioTieneRuta > 0){
							switch ($tipo) {
								case "RECOGIDA":
									$dataLog = $this->rutas_model->getlogRutaPorTipo($idRuta, $fecha, $tipo, $jsonUsuario[0]["idUsuario"]);

									if($dataLog == null){
										$latitudUsuario = $jsonUsuario[0]["latitud"];
										$longitudUsuario = $jsonUsuario[0]["longitud"];

										$point1 = array("lat" =>  $latitudUsuario, "long" => $longitudUsuario ); 
										$point2 = array("lat" => $latitud, "long" => $longitud); 

										$km = $this->distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calcular la distancia en kilómetros (por defecto)

										if($km > 1){
											$coordenadas = $latitud . "," . $longitud;
											$array = array(
												'idestudiante' => $jsonUsuario[0]["idUsuario"],
												'coordenadas_recogida' => $coordenadas,
												'tipo' => $tipo,
												'idruta' => $idRuta,
												'acudiente' => "",
												'mensaje' => "Fue recogido en un sitio diferente",
												'session' => "");
											$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

											$jsonUsuario[0]["Mensaje"] = "Fue recogido en un sitio diferente";
											$jsonUsuario[0]["CodigoConfirmacion"] = "1";
											$jsonUsuario[0]["TipoRegistro"] = $tipo;
											$estudianteName = $jsonUsuario[0]["PrimerNombre"] . " " . $jsonUsuario[0]["SegundoNombre"] . " " . $jsonUsuario[0]["PrimerApellido"] . " " . $jsonUsuario[0]["SegundoApellido"];

											// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
											$email_to = $jsonUsuario[0]["idAcudiente"];
											$email_subject = "Informe Ingreso a Ruta Escolar";

											// El mensaje
											$mensaje = '<style type="text/css">
												*{
													margin: 0;
													padding: 0;
												}
												.btn-primary {
												    
												}
												.btn {
												    
												}
											</style>
											<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
											<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
											<div align="center" style="width: 50%; float: right">
												<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $estudianteName . '</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
												<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' . $email_to . '&name=' . $estudianteName . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
												    margin-bottom: 0;
												    font-size: 18px;
												    font-weight: 400;
												    line-height: 1.42857143;
												    text-align: center;
												    white-space: nowrap;
												    vertical-align: middle;
												    -ms-touch-action: manipulation;
												    touch-action: manipulation;
												    cursor: pointer;
												    -webkit-user-select: none;
												    -moz-user-select: none;
												    -ms-user-select: none;
												    user-select: none;
												    border: 1px solid transparent;color: #fff;
												    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
											</div>
											<div style="width:100%" align="center">
												<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
											</div>
											<table width="100%" border="0">
												<tr>
													<td width="20px">&nbsp;</td>
													<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
													<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
													<td>
														<div style="width: 100%">
															<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
									                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
									                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
									                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
														</div>
													</td>
												</tr>
											</table>';										
											
											

											$configuraciones["mailtype"] = 'html';
											$this->email->initialize($configuraciones);
											$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
											$this->email->to($email_to);
											$this->email->subject($email_subject);
											$this->email->message($mensaje);
											$this->email->send();

											$arrayAlerta = array(
												'idUsuario' => $jsonUsuario[0]["idUsuario"],
												'tipo' => "ALERTEACORREO",
												'mensaje' => "Fue recogido en un sitio diferente");
											$this->rutas_model->crearAlerta($arrayAlerta);
											echo json_encode($jsonUsuario);
										}else{
											$coordenadas = $latitud . "," . $longitud;
											$array = array(
												'idestudiante' => $jsonUsuario[0]["idUsuario"],
												'coordenadas_recogida' => $coordenadas,
												'tipo' => $tipo,
												'idruta' => $idRuta,
												'acudiente' => "",
												'mensaje' => "Fue recogido correctamente",
												'session' => "");
											$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

											$jsonUsuario[0]["Mensaje"] = "Fue recogido correctamente";
											$jsonUsuario[0]["CodigoConfirmacion"] = "1";
											$jsonUsuario[0]["TipoRegistro"] = $tipo;	
											$estudianteName = $jsonUsuario[0]["PrimerNombre"] . " " . $jsonUsuario[0]["SegundoNombre"] . " " . $jsonUsuario[0]["PrimerApellido"] . " " . $jsonUsuario[0]["SegundoApellido"];

											// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
											$email_to = $jsonUsuario[0]["idAcudiente"];
											$email_subject = "Informe Ingreso a Ruta Escolar";

											// El mensaje
											$mensaje = '<style type="text/css">
												*{
													margin: 0;
													padding: 0;
												}
												.btn-primary {
												    
												}
												.btn {
												    
												}
											</style>
											<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
											<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
											<div align="center" style="width: 50%; float: right">
												<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $estudianteName . '</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
												<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' . $email_to . '&name=' . $estudianteName . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
												    margin-bottom: 0;
												    font-size: 18px;
												    font-weight: 400;
												    line-height: 1.42857143;
												    text-align: center;
												    white-space: nowrap;
												    vertical-align: middle;
												    -ms-touch-action: manipulation;
												    touch-action: manipulation;
												    cursor: pointer;
												    -webkit-user-select: none;
												    -moz-user-select: none;
												    -ms-user-select: none;
												    user-select: none;
												    border: 1px solid transparent;color: #fff;
												    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
											</div>
											<div style="width:100%" align="center">
												<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
											</div>
											<table width="100%" border="0">
												<tr>
													<td width="20px">&nbsp;</td>
													<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
													<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
													<td>
														<div style="width: 100%">
															<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
									                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
									                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
									                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
														</div>
													</td>
												</tr>
											</table>';										
											
											

											$configuraciones["mailtype"] = 'html';
											$this->email->initialize($configuraciones);
											$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
											$this->email->to($email_to);
											$this->email->subject($email_subject);
											$this->email->message($mensaje);
											$this->email->send();

											$arrayAlerta = array(
												'idUsuario' => $jsonUsuario[0]["idUsuario"],
												'tipo' => "ALERTEACORREO",
												'mensaje' => "Fue recogido correctamente");
											$this->rutas_model->crearAlerta($arrayAlerta);
											echo json_encode($jsonUsuario);
										}
									}else{
										$jsonUsuario[0]["Mensaje"] = "El estudiante ya se ha recogido el dia de hoy en esta ruta";
										$jsonUsuario[0]["CodigoConfirmacion"] = "0";
										$jsonUsuario[0]["TipoRegistro"] = $tipo;
										echo json_encode($jsonUsuario);
									}
									break;

								case "BAJADA":
									$dataLog = $this->rutas_model->getlogRutaPorTipo($idRuta, $fecha, $tipo, $jsonUsuario[0]["idUsuario"]);

									if($dataLog == null){
										$dataLogValidar = $this->rutas_model->getlogRutaPorTipo($idRuta, $fecha, "RECOGIDA", $jsonUsuario[0]["idUsuario"]);

										if($dataLogValidar != null){
											$coordenadas = $latitud . "," . $longitud;
											$array = array(
												'idestudiante' => $jsonUsuario[0]["idUsuario"],
												'coordenadas_recogida' => $coordenadas,
												'tipo' => $tipo,
												'idruta' => $idRuta,
												'acudiente' => "",
												'mensaje' => "Fue recogido en un sitio diferente",
												'session' => "");
											$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

											$jsonUsuario[0]["Mensaje"] = "Bajo del bus sin ningun inconveniente";
											$jsonUsuario[0]["CodigoConfirmacion"] = "1";
											$jsonUsuario[0]["TipoRegistro"] = $tipo;
											$estudianteName = $jsonUsuario[0]["PrimerNombre"] . " " . $jsonUsuario[0]["SegundoNombre"] . " " . $jsonUsuario[0]["PrimerApellido"] . " " . $jsonUsuario[0]["SegundoApellido"];

											// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
											$email_to = $jsonUsuario[0]["idAcudiente"];
											$email_subject = "Informe Ruta Escolar llegada a Destino";

											
											// El mensaje
											$mensaje = '<style type="text/css">
												*{
													margin: 0;
													padding: 0;
												}
												.btn-primary {
												    
												}
												.btn {
												    
												}
											</style>
											<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
											<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
											<div align="center" style="width: 50%; float: right">
												<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $estudianteName . '</i></b> ha llegado a su destino</label><br>
												<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' . $email_to . '&name=' . $estudianteName . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
												    margin-bottom: 0;
												    font-size: 18px;
												    font-weight: 400;
												    line-height: 1.42857143;
												    text-align: center;
												    white-space: nowrap;
												    vertical-align: middle;
												    -ms-touch-action: manipulation;
												    touch-action: manipulation;
												    cursor: pointer;
												    -webkit-user-select: none;
												    -moz-user-select: none;
												    -ms-user-select: none;
												    user-select: none;
												    border: 1px solid transparent;color: #fff;
												    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
											</div>
											<div style="width:100%" align="center">
												<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
											</div>
											<table width="100%" border="0">
												<tr>
													<td width="20px">&nbsp;</td>
													<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
													<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
													<td>
														<div style="width: 100%">
															<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
									                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
									                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
									                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
														</div>
													</td>
												</tr>
											</table>';									
												
											
											$configuraciones["mailtype"] = 'html';
											$this->email->initialize($configuraciones);
											$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
											$this->email->to($email_to);
											$this->email->subject($email_subject);
											$this->email->message($mensaje);
											$this->email->send();
											echo json_encode($jsonUsuario);
										}else{
											$jsonUsuario[0]["Mensaje"] = "El estudiante no se ha recogido el dia de hoy en esta ruta";
											$jsonUsuario[0]["CodigoConfirmacion"] = "0";
											$jsonUsuario[0]["TipoRegistro"] = $tipo;
											echo json_encode($jsonUsuario);
										}
									}else{
										$jsonUsuario[0]["Mensaje"] = "El estudiante ya se ha entregado el dia de hoy en esta ruta";
										$jsonUsuario[0]["CodigoConfirmacion"] = "0";
										$jsonUsuario[0]["TipoRegistro"] = $tipo;
										echo json_encode($jsonUsuario);
									}
									break;	
							}
						}else{
							$jsonUsuario[0]["Mensaje"] = "El estudiante no esta asignado a esta ruta";
							$jsonUsuario[0]["CodigoConfirmacion"] = "0";
							$jsonUsuario[0]["TipoRegistro"] = $tipo;
							echo json_encode($jsonUsuario);
						}
						
					}else{
						$jsonUsuario[0]["Mensaje"] = "No es estudiante";
						$jsonUsuario[0]["CodigoConfirmacion"] = "0";
						$jsonUsuario[0]["TipoRegistro"] = $tipo;
						echo json_encode($jsonUsuario);
					}

				}else{
					echo $respuestaCredencial;
				}
			}
		}
	}

	function RegistroRecogida(){
		$latitud = $_POST["latitud"];	
		$longitud = $_POST["longitud"];
		$idCredencial = $_POST["idCredencial"];
		$fecha = date("Y-m-d");	
		$hora = date("H:i:s");	
		$tipo = $_POST["tipo"];	
		$idRuta = $_POST["idRuta"];


		$respuestaCredencial = $this->credenciales_model->ConsultarUsuarioPorCredencial($idCredencial);

		if($respuestaCredencial != "[]"){
			$jsonUsuario = json_decode($respuestaCredencial, true);

			if($jsonUsuario[0]["TipoUsuario"] == "Estudiante"){

				// Validara si la ruta es dinamica
				$is_dinamic_route = $this->rutas_model->is_dinamic_route($idRuta);
				// verifivar la existencia del usuario
				if($is_dinamic_route == 1) {
					$usuarioTieneRuta = 1;
				}else {
					$usuarioTieneRuta = $this->rutas_model->existeUsuarioRuta($idRuta, $jsonUsuario[0]["idUsuario"]);
				}

				if($usuarioTieneRuta > 0){
					switch ($tipo) {
						case "RECOGIDA":
							$dataLog = $this->rutas_model->getlogRutaPorTipo($idRuta, $fecha, $tipo, $jsonUsuario[0]["idUsuario"]);

							if($dataLog == null){
								$latitudUsuario = $jsonUsuario[0]["latitud"];
								$longitudUsuario = $jsonUsuario[0]["longitud"];

								$point1 = array("lat" =>  $latitudUsuario, "long" => $longitudUsuario ); 
								$point2 = array("lat" => $latitud, "long" => $longitud); 

								$km = $this->distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calcular la distancia en kilómetros (por defecto)

								if($km > 1){
									$coordenadas = $latitud . "," . $longitud;
									$array = array(
										'idestudiante' => $jsonUsuario[0]["idUsuario"],
										'coordenadas_recogida' => $coordenadas,
										'tipo' => $tipo,
										'idruta' => $idRuta,
										'acudiente' => "",
										'mensaje' => "Fue recogido en un sitio diferente",
										'session' => "");
									$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

									$jsonUsuario[0]["Mensaje"] = "Fue recogido en un sitio diferente";
									$jsonUsuario[0]["CodigoConfirmacion"] = "1";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;
									$estudianteName = $jsonUsuario[0]["PrimerNombre"] . " " . $jsonUsuario[0]["SegundoNombre"] . " " . $jsonUsuario[0]["PrimerApellido"] . " " . $jsonUsuario[0]["SegundoApellido"];

									// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
									$email_to = $jsonUsuario[0]["idAcudiente"];
									$email_subject = "Informe Ingreso a Ruta Escolar";

									// El mensaje
									$mensaje = '<style type="text/css">
										*{
											margin: 0;
											padding: 0;
										}
										.btn-primary {
										    
										}
										.btn {
										    
										}
									</style>
									<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
									<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
									<div align="center" style="width: 50%; float: right">
										<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $estudianteName . '</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
										<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' . $email_to . '&name=' . $estudianteName . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
										    margin-bottom: 0;
										    font-size: 18px;
										    font-weight: 400;
										    line-height: 1.42857143;
										    text-align: center;
										    white-space: nowrap;
										    vertical-align: middle;
										    -ms-touch-action: manipulation;
										    touch-action: manipulation;
										    cursor: pointer;
										    -webkit-user-select: none;
										    -moz-user-select: none;
										    -ms-user-select: none;
										    user-select: none;
										    border: 1px solid transparent;color: #fff;
										    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
									</div>
									<div style="width:100%" align="center">
										<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
									</div>
									<table width="100%" border="0">
										<tr>
											<td width="20px">&nbsp;</td>
											<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
											<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
											<td>
												<div style="width: 100%">
													<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
							                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
							                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
							                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
												</div>
											</td>
										</tr>
									</table>';										
									
									

									$configuraciones["mailtype"] = 'html';
									$this->email->initialize($configuraciones);
									$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
									$this->email->to($email_to);
									$this->email->subject($email_subject);
									$this->email->message($mensaje);
									$this->email->send();

									$arrayAlerta = array(
										'idUsuario' => $jsonUsuario[0]["idUsuario"],
										'tipo' => "ALERTEACORREO",
										'mensaje' => "Fue recogido en un sitio diferente");
									$this->rutas_model->crearAlerta($arrayAlerta);
									echo json_encode($jsonUsuario);
								}else{
									$coordenadas = $latitud . "," . $longitud;
									$array = array(
										'idestudiante' => $jsonUsuario[0]["idUsuario"],
										'coordenadas_recogida' => $coordenadas,
										'tipo' => $tipo,
										'idruta' => $idRuta,
										'acudiente' => "",
										'mensaje' => "Fue recogido correctamente",
										'session' => "");
									$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

									$jsonUsuario[0]["Mensaje"] = "Fue recogido correctamente";
									$jsonUsuario[0]["CodigoConfirmacion"] = "1";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;	
									$estudianteName = $jsonUsuario[0]["PrimerNombre"] . " " . $jsonUsuario[0]["SegundoNombre"] . " " . $jsonUsuario[0]["PrimerApellido"] . " " . $jsonUsuario[0]["SegundoApellido"];

									// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
									$email_to = $jsonUsuario[0]["idAcudiente"];
									$email_subject = "Informe Ingreso a Ruta Escolar";

									// El mensaje
									$mensaje = '<style type="text/css">
										*{
											margin: 0;
											padding: 0;
										}
										.btn-primary {
										    
										}
										.btn {
										    
										}
									</style>
									<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
									<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
									<div align="center" style="width: 50%; float: right">
										<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $estudianteName . '</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
										<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' . $email_to . '&name=' . $estudianteName . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
										    margin-bottom: 0;
										    font-size: 18px;
										    font-weight: 400;
										    line-height: 1.42857143;
										    text-align: center;
										    white-space: nowrap;
										    vertical-align: middle;
										    -ms-touch-action: manipulation;
										    touch-action: manipulation;
										    cursor: pointer;
										    -webkit-user-select: none;
										    -moz-user-select: none;
										    -ms-user-select: none;
										    user-select: none;
										    border: 1px solid transparent;color: #fff;
										    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
									</div>
									<div style="width:100%" align="center">
										<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
									</div>
									<table width="100%" border="0">
										<tr>
											<td width="20px">&nbsp;</td>
											<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
											<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
											<td>
												<div style="width: 100%">
													<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
							                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
							                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
							                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
												</div>
											</td>
										</tr>
									</table>';										
									
									

									$configuraciones["mailtype"] = 'html';
									$this->email->initialize($configuraciones);
									$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
									$this->email->to($email_to);
									$this->email->subject($email_subject);
									$this->email->message($mensaje);
									$this->email->send();

									$arrayAlerta = array(
										'idUsuario' => $jsonUsuario[0]["idUsuario"],
										'tipo' => "ALERTEACORREO",
										'mensaje' => "Fue recogido correctamente");
									$this->rutas_model->crearAlerta($arrayAlerta);
									echo json_encode($jsonUsuario);
								}
							}else{
								$jsonUsuario[0]["Mensaje"] = "El estudiante ya se ha recogido el dia de hoy en esta ruta";
								$jsonUsuario[0]["CodigoConfirmacion"] = "0";
								$jsonUsuario[0]["TipoRegistro"] = $tipo;
								echo json_encode($jsonUsuario);
							}
							break;

						case "BAJADA":
							$dataLog = $this->rutas_model->getlogRutaPorTipo($idRuta, $fecha, $tipo, $jsonUsuario[0]["idUsuario"]);

							if($dataLog == null){
								$dataLogValidar = $this->rutas_model->getlogRutaPorTipo($idRuta, $fecha, "RECOGIDA", $jsonUsuario[0]["idUsuario"]);

								if($dataLogValidar != null){
									$coordenadas = $latitud . "," . $longitud;
									$array = array(
										'idestudiante' => $jsonUsuario[0]["idUsuario"],
										'coordenadas_recogida' => $coordenadas,
										'tipo' => $tipo,
										'idruta' => $idRuta,
										'acudiente' => "",
										'mensaje' => "Fue recogido en un sitio diferente",
										'session' => "");
									$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

									$jsonUsuario[0]["Mensaje"] = "Bajo del bus sin ningun inconveniente";
									$jsonUsuario[0]["CodigoConfirmacion"] = "1";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;
									$estudianteName = $jsonUsuario[0]["PrimerNombre"] . " " . $jsonUsuario[0]["SegundoNombre"] . " " . $jsonUsuario[0]["PrimerApellido"] . " " . $jsonUsuario[0]["SegundoApellido"];

									// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
									$email_to = $jsonUsuario[0]["idAcudiente"];
									$email_subject = "Informe Ruta Escolar llegada a Destino";

									
									// El mensaje
									$mensaje = '<style type="text/css">
										*{
											margin: 0;
											padding: 0;
										}
										.btn-primary {
										    
										}
										.btn {
										    
										}
									</style>
									<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
									<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
									<div align="center" style="width: 50%; float: right">
										<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $estudianteName . '</i></b> ha llegado a su destino</label><br>
										<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' . $email_to . '&name=' . $estudianteName . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
										    margin-bottom: 0;
										    font-size: 18px;
										    font-weight: 400;
										    line-height: 1.42857143;
										    text-align: center;
										    white-space: nowrap;
										    vertical-align: middle;
										    -ms-touch-action: manipulation;
										    touch-action: manipulation;
										    cursor: pointer;
										    -webkit-user-select: none;
										    -moz-user-select: none;
										    -ms-user-select: none;
										    user-select: none;
										    border: 1px solid transparent;color: #fff;
										    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
									</div>
									<div style="width:100%" align="center">
										<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
									</div>
									<table width="100%" border="0">
										<tr>
											<td width="20px">&nbsp;</td>
											<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
											<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
											<td>
												<div style="width: 100%">
													<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
							                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
							                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
							                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
												</div>
											</td>
										</tr>
									</table>';									
										
									
									$configuraciones["mailtype"] = 'html';
									$this->email->initialize($configuraciones);
									$this->email->from('ruta@ssca.com', 'SSCA – Servicios Escolares Colegio Fontán');
									$this->email->to($email_to);
									$this->email->subject($email_subject);
									$this->email->message($mensaje);
									$this->email->send();
									echo json_encode($jsonUsuario);
								}else{
									$jsonUsuario[0]["Mensaje"] = "El estudiante no se ha recogido el dia de hoy en esta ruta";
									$jsonUsuario[0]["CodigoConfirmacion"] = "0";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;
									echo json_encode($jsonUsuario);
								}
							}else{
								$jsonUsuario[0]["Mensaje"] = "El estudiante ya se ha entregado el dia de hoy en esta ruta";
								$jsonUsuario[0]["CodigoConfirmacion"] = "0";
								$jsonUsuario[0]["TipoRegistro"] = $tipo;
								echo json_encode($jsonUsuario);
							}
							break;	
					}
				}else{
					$jsonUsuario[0]["Mensaje"] = "El estudiante no esta asignado a esta ruta";
					$jsonUsuario[0]["CodigoConfirmacion"] = "0";
					$jsonUsuario[0]["TipoRegistro"] = $tipo;
					echo json_encode($jsonUsuario);
				}
				
			}else{
				$jsonUsuario[0]["Mensaje"] = "No es estudiante";
				$jsonUsuario[0]["CodigoConfirmacion"] = "0";
				$jsonUsuario[0]["TipoRegistro"] = $tipo;
				echo json_encode($jsonUsuario);
			}

		}else{
			echo $respuestaCredencial;
		}
	}

	function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
		// Cálculo de la distancia en grados
		$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
	 
		// Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
		switch($unit) {
			case 'km':
				$distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
				break;
			case 'mi':
				$distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
				break;
			case 'nmi':
				$distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
		}
		return round($distance, $decimals);
	}
	function ObtenerMes($mes){
		$mesLetras = "";
		switch($mes){
			case "01":
				$mesLetras = "Enero";
				break;
			case "02":
				$mesLetras = "Febrero";
				break;
			case "03":
				$mesLetras = "Marzo";
				break;
			case "04":
				$mesLetras = "Abril";
				break;
			case "05":
				$mesLetras = "Mayo";
				break;
			case "06":
				$mesLetras = "Junio";
				break;
			case "07":
				$mesLetras = "Julio";
				break;
			case "08":
				$mesLetras = "Agosto";
				break;
			case "09":
				$mesLetras = "Septiembre";
				break;
			case "10":
				$mesLetras = "Obtubre";
				break;
			case "11":
				$mesLetras = "Noviembre";
				break;
			case "12":
				$mesLetras = "Diciembre";
				break;
		}
		return $mesLetras;
	}

	//Funcion para obtener coordenadas de un bus de una ruta
	function ListarTodasRutas(){
		$datos = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($datos != null){	
			foreach ($datos->result() as $value) {
				$fecha = date("Y-m-d");
				$respuestaAlertas = $this->rutas_model->listarAlertasMonitorRuta($value->id, "ALERTAPPMONITOR", $fecha);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($respuestaAlertas != null){		
					$value->alarmas = "Presenta Alarmas";	
				}else{
					$value->alarmas = "No Tiene Alarmas";
				}

				
			}		
			echo json_encode($datos->result());
		}else{
			echo "[]";
		}
		
	}
	//Funcion para obtener mensajes predifinidos del chat de monitor
	function ListarMensajesPredefinidos(){
		$datos = $this->rutas_model->listar_mensajes_predefinidos();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($datos != null){				
			echo json_encode($datos->result());
		}else{
			echo "[]";
		}
		
	}

	//Funcion para obtener mensajes predifinidos del chat de monitor
	function ObtenerMensajePredefinido(){
		$datos = $this->rutas_model->get_mensaje_predefinido($_POST["id"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($datos != null){				
			echo json_encode($datos->result()[0]);
		}else{
			echo "[]";
		}
		
	}

	//Funcion para crear mensajes predifinidos del chat de monitor
	function crear_mensaje_predefinido(){
		$_POST["user_create"] = $this->session->userdata('UserIDInternoSSCA');
		$this->rutas_model->crear_mensaje_predefinido($_POST);
	}

	//Funcion para actualizar mensajes predifinidos del chat de monitor
	function update_mensaje_predefinido(){		
		$this->rutas_model->update_mensaje_predefinido($_POST);
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ListarEstudiantesTracking(){
		$fecha = date("d/m/Y");
		$fechaIn = date("Y-m-d");
		
		
		$estudiantes = $this->rutas_model->getEstudiantes($_REQUEST["idruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		$indiceCaracter = 66;

		if($estudiantes != null){			
			foreach ($estudiantes->result() as $value) {
				$value->Indice = chr($indiceCaracter);
				$respuesta = $this->rutas_model->listarEstudiantesTracking($_REQUEST["idruta"], $fecha, $fechaIn, $value->idUsuario, "RECOGIDA");//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($respuesta != null){
					$value->TipoDatos = "RECOGIDO";
					$value->HoraRecogido = $respuesta->result()[0]->hora;
				}else{
					$value->HoraRecogido = "";
				}

				$respuestaEntregados = $this->rutas_model->listarEstudiantesTracking($_REQUEST["idruta"], $fecha, $fechaIn, $value->idUsuario, "BAJADA");//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($respuestaEntregados != null){
					$value->TipoDatos = "ENTREGADO";
					$value->HoraEntregado = $respuestaEntregados->result()[0]->hora;
				}else{
					$value->HoraEntregado = "";
				}

				$json = "[]";
				$contador = 0;
				$respuestaMensaj = $this->rutas_model->listarMensajesAcudienteaCoordinadorFecha($_REQUEST["idruta"], $fechaIn, $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				if($respuestaMensaj != null){			
					foreach ($respuestaMensaj->result() as $valor) {
						if($contador == 0){
							$json = json_encode($valor);
							$contador++;
						}else{
							$json .= "," . json_encode($valor);
						}
					}
					
				}

				$respuestaCoor = $this->rutas_model->listarMensajesCoordinadorAcudienteFecha($_REQUEST["idruta"], $fechaIn, $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				if($respuestaCoor != null){			
					foreach ($respuestaCoor->result() as $valor) {
						if($contador == 0){
							$json = json_encode($valor);
							$contador++;
						}else{
							$json .= "," . json_encode($valor);
						}
					}
					
				}
				if($json == "[]"){
					$value->mensajes = json_decode($json);
				}else{
					$value->mensajes = json_decode("[" . $json . "]");
				}			

				$respuestaMonit = $this->rutas_model->listarMensajesMonitoraEstudiante($_REQUEST["idruta"], $fechaIn, $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				if($respuestaMonit != null){			
					foreach ($respuestaMonit->result() as $valor) {
						if($contador == 0){
							$json = json_encode($valor);
							$contador++;
						}else{
							$json .= "," . json_encode($valor);
						}
					}
					
				}
				if($json == "[]"){
					$value->mensajes = json_decode($json);
				}else{
					$value->mensajes = json_decode("[" . $json . "]");
				}
				$indiceCaracter++;
			}	
			echo json_encode($estudiantes->result());
		}else{
			echo "[]";
		}		
	}

	function mostrarAlertasRuta(){
		$fecha = date("Y-m-d");
		$respuestaAlertas = $this->rutas_model->listarAlertasMonitorRuta($_POST["idruta"], "ALERTAPPMONITOR", $fecha);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuestaAlertas != null){		
			echo json_encode($respuestaAlertas->result());
		}else{
			echo "[]";
		}
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ListarEstudiantesBitacora(){
		
		$this->load->model('Log_ruta_model');
		$data = $this->Log_ruta_model->get_registro_estudiantes_bitacora();
		header('Content-type: application/json');
		echo json_encode($data);

		//$estudiantes = $this->rutas_model->getEstudiantes($_REQUEST["idruta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		// if($estudiantes != null){			
		// 	foreach ($estudiantes->result() as $value) {
		// 		$respuesta = $this->rutas_model->getLogEstudianteBitacora($_REQUEST["idruta"], $_REQUEST["fecha"], "RECOGIDA", $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		// 		if($respuesta != null){
		// 			$value->HoraRecogido = $respuesta->result()[0]->hora;
		// 		}else{
		// 			$value->HoraRecogido = "";
		// 		}

		// 		$datos = $this->rutas_model->getLogEstudianteBitacora($_REQUEST["idruta"], $_REQUEST["fecha"], "BAJADA", $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		// 		if($datos != null){
		// 			$value->HoraEntregado = $datos->result()[0]->hora;				
		// 		}else{
		// 			$value->HoraEntregado = "";
		// 		}

		// 		$json = "[]";
		// 		$contador = 0;
		// 		$respuestaMensaj = $this->rutas_model->listarMensajesAcudienteaCoordinadorFecha($_REQUEST["idruta"], $_REQUEST["fecha"], $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		// 		if($respuestaMensaj != null){			
		// 			foreach ($respuestaMensaj->result() as $valor) {
		// 				if($contador == 0){
		// 					$json = json_encode($valor);
		// 					$contador++;
		// 				}else{
		// 					$json .= "," . json_encode($valor);
		// 				}
		// 			}
					
		// 		}

		// 		$respuestaCoor = $this->rutas_model->listarMensajesCoordinadorAcudienteFecha($_REQUEST["idruta"], $_REQUEST["fecha"], $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		// 		if($respuestaCoor != null){			
		// 			foreach ($respuestaCoor->result() as $valor) {
		// 				if($contador == 0){
		// 					$json = json_encode($valor);
		// 					$contador++;
		// 				}else{
		// 					$json .= "," . json_encode($valor);
		// 				}
		// 			}
					
		// 		}
		// 		if($json == "[]"){
		// 			$value->mensajes = json_decode($json);
		// 		}else{
		// 			$value->mensajes = json_decode("[" . $json . "]");
		// 		}

		// 		$respuestaMonit = $this->rutas_model->listarMensajesMonitoraEstudiante($_REQUEST["idruta"], $_REQUEST["fecha"], $value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		// 		if($respuestaMonit != null){			
		// 			foreach ($respuestaMonit->result() as $valor) {
		// 				if($contador == 0){
		// 					$json = json_encode($valor);
		// 					$contador++;
		// 				}else{
		// 					$json .= "," . json_encode($valor);
		// 				}
		// 			}
					
		// 		}
		// 		if($json == "[]"){
		// 			$value->mensajes = json_decode($json);
		// 		}else{
		// 			$value->mensajes = json_decode("[" . $json . "]");
		// 		}
				
		// 	}	
		// 	echo json_encode($estudiantes->result());
		// }else{
		// 	echo "[]";
		// }		
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ObtenerDatosPersonas(){
		$respuesta = $this->usuarios_aplicaciones_model->obtenerDatosAcudiente($_REQUEST["idUsuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){		
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function EnvioMensajeAcudientes(){
		switch ($_POST["tipo"]) {
			case 'ruta':
				$estudiantes = $this->rutas_model->getEstudiantes($_POST["idRuta"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

				if($estudiantes != null){			
					foreach ($estudiantes->result() as $value) {
						$configuraciones["mailtype"] = 'html';
						$this->email->initialize($configuraciones);
						$this->email->from('info@rutas', 'Informacion del Coordinador de Rutas');
						$this->email->to($value->idAcudiente);
						$this->email->subject("Mensaje del Coordinador de las rutas");
						$this->email->message($_POST["mensaje"]);
						$this->email->send();

						$array = array(
							'idestudiante' => $value->idUsuario,
							'coordenadas_recogida' => $_POST["coordenadas"],
							'tipo' => "MENSAJEAACUDIENTESPORRUTA",
							'idruta' => $_POST["idRuta"],
							'acudiente' => $value->idAcudiente,
							'mensaje' => $_POST["mensaje"],
							'session' => $_POST["idUsuario"]);
						$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
					}	
					echo json_encode($estudiantes->result());
					echo $_POST["tipo"];
				}		
				break;
			
			case 'estudiante':
				$estudiantes = $this->usuarios_aplicaciones_model->obtenerAcudiente($_POST["idEstudiante"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($estudiantes != null){			
					foreach ($estudiantes->result() as $value) {
						$configuraciones["mailtype"] = 'html';
						$this->email->initialize($configuraciones);
						$this->email->from('info@rutas', 'Informacion del Coordinador de Rutas');
						$this->email->to($value->idAcudiente);
						$this->email->subject("Mensaje del Coordinador de las rutas");
						$this->email->message($_POST["mensaje"]);
						$this->email->send();		
					}	
					$array = array(
						'idestudiante' => $_POST["idEstudiante"],
						'coordenadas_recogida' => $_POST["coordenadas"],
						'tipo' => "MENSAJEAACUDIENTESPORESTUDIANTE",
						'idruta' => $_POST["idRuta"],
						'acudiente' => $value->idAcudiente,
						'mensaje' => $_POST["mensaje"],
						'session' => $_POST["idUsuario"]);
					$this->rutas_model->crearLogRuta($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				}		
				break;
		}
		
	}

	//Funcion para listar todas las rutas
	function listarRutas(){
		$respuesta = $this->rutas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){			
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}	
	}



	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ListarDatosCalendarioMonitores(){
		$respuesta = $this->rutas_model->listarDatosCalendario();//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){		
			foreach ($respuesta->result() as $valores) {
				$valores->title = $valores->nombreMonitor . " " . $valores->apellidoMonitor;
				$valores->start = $valores->fecha . "T" . $valores->horainicial;
				$valores->end = $valores->fecha . "T" . $valores->horafinal;
				$valores->editable = false;
				$valores->backgroundColor = $valores->color;
			}	
			echo json_encode($respuesta->result());

		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ListarDatosCalendarioConductores(){
		$respuesta = $this->rutas_model->listarDatosCalendario();//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){		
			foreach ($respuesta->result() as $valores) {
				$valores->title = $valores->nombreConductor . " " . $valores->apellidoConductor;
				$valores->start = $valores->fecha . "T" . $valores->horainicial;
				$valores->end = $valores->fecha . "T" . $valores->horafinal;
				$valores->editable = false;
				$valores->backgroundColor = $valores->color;
			}	
			echo json_encode($respuesta->result());

		}else{
			echo "[]";
		}		
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function ListarDatosCalendarioVehiculos(){
		$respuesta = $this->rutas_model->listarDatosCalendario();//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($respuesta != null){		
			foreach ($respuesta->result() as $valores) {
				$valores->title = $valores->categoria . " " . $valores->marca . " " . $valores->placa;
				$valores->start = $valores->fecha . "T" . $valores->horainicial;
				$valores->end = $valores->fecha . "T" . $valores->horafinal;
				$valores->editable = false;
				$valores->backgroundColor = $valores->color;
			}	
			echo json_encode($respuesta->result());

		}else{
			echo "[]";
		}		
	}

	//Funcion para listar los monitores a seleccionar en la ruta
	function listarMonitores(){
		$respuesta = $this->monitor_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no
		/*$respuesta = $this->monitor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		$json = "";
		$contador = 0;*/
		if($respuesta != null){				
			/*foreach ($respuesta->result() as $valores) {
				if($contador == 0){
					$json .= json_encode($valores);
					$contador++;
				}else{
					$json .= "," . json_encode($valores);
				}
			}
			
			$respuestaConRuta = $this->monitor_model->listarConRuta();//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($respuestaConRuta != null){	
				foreach ($respuestaConRuta->result() as $value) {

					//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
					switch ($_REQUEST["repetir"]) {

						case 'NUNCA':
							$estado = $this->monitor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $_REQUEST["fechainicial"], $value->idmonitor);
							if($estado){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}
							
							break;

						case 'DIARIAMENTE':	
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->monitor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idmonitor);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+1 day', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}							
							break;

						case 'SEMANALMENTE':
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->monitor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idmonitor);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+7 day', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}			
							break;

						case 'MENSUALMENTE':
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->monitor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idmonitor);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+1 month', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}			
							break;
					}
				}
			}
			
			
			$jsonDatos = json_decode("[" . $json . "]");*/
			//echo json_encode($respuesta->result());
			//Se ordena el json por el nombre del producto de forma ascendente
			usort($respuesta->result(), function($a, $b) { //Sort the array using a user defined function
			    return strcmp(strtolower($a->nombre), strtolower($b->nombre));
			});
			echo json_encode($respuesta->result()); 
		}else{
			echo "[]";
		}
		
	}

	//Funcion para listar los monitores a seleccionar en la ruta
	function listarConductores(){

		$respuesta = $this->conductor_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		/*$respuesta = $this->conductor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		$json = "";
		$contador = 0;*/
		if($respuesta != null){				
			/*foreach ($respuesta->result() as $valores) {
				if($contador == 0){
					$json .= json_encode($valores);
					$contador++;
				}else{
					$json .= "," . json_encode($valores);
				}
			}
			
			$respuestaConRuta = $this->conductor_model->listarConRuta();//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($respuestaConRuta != null){	
				foreach ($respuestaConRuta->result() as $value) {

					//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
					switch ($_REQUEST["repetir"]) {
						case 'NUNCA':
							$estado = $this->conductor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $_REQUEST["fechainicial"], $value->idconductor);
							if($estado){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}
							
							break;

						case 'DIARIAMENTE':	
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->conductor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idconductor);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+1 day', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}							
							break;

						case 'SEMANALMENTE':
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->conductor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idconductor);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+7 day', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}			
							break;

						case 'MENSUALMENTE':
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->conductor_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idconductor);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+1 month', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}			
							break;						
					}
				}
			}
			

			
			$jsonDatos = json_decode("[" . $json . "]");*/
			//echo json_encode($respuesta->result());
			//Se ordena el json por el nombre del producto de forma ascendente
			usort($respuesta->result(), function($a, $b) { //Sort the array using a user defined function
			    return strcmp(strtolower($a->nombre), strtolower($b->nombre));
			});
			echo json_encode($respuesta->result()); 
			//echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
		
		
	}

	//Funcion para listar los monitores a seleccionar en la ruta
	function listarVehiculos(){
		$respuesta = $this->vehiculo_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		/*$respuesta = $this->vehiculo_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		$json = "";
		$contador = 0;*/
		if($respuesta != null){				
			/*foreach ($respuesta->result() as $valores) {
				if($contador == 0){
					$json .= json_encode($valores);
					$contador++;
				}else{
					$json .= "," . json_encode($valores);
				}
			}
			
			$respuestaConRuta = $this->vehiculo_model->listarConRuta();//Se llama a la funcion de que esta en modelo y el resultado se guarda
			if($respuestaConRuta != null){	
				foreach ($respuestaConRuta->result() as $value) {

					//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
					switch ($_REQUEST["repetir"]) {

						case 'NUNCA':
							$estado = $this->vehiculo_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $_REQUEST["fechainicial"], $value->idvehiculo);
							if($estado){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}
							
							break;

						case 'DIARIAMENTE':	
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->vehiculo_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idvehiculo);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+1 day', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}							
							break;

						case 'SEMANALMENTE':
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->vehiculo_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idvehiculo);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+7 day', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}			
							break;

						case 'MENSUALMENTE':
							$fechaInicial = strtotime($_REQUEST["fechainicial"]);
							$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
							$total_todos = 0;

							$fechaIterada = $fechaInicial;		

							while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
								$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

								$estado = $this->vehiculo_model->ValidarHoras($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idvehiculo);
								if(!$estado){
									$total_todos++;
								}

								$fechaIterada = strtotime ( '+1 month', $fechaIterada) ;
							}
							if($total_todos == 0){
								if($contador == 0){
									$json .= json_encode($value);
									$contador++;
								}else{
									$json .= "," . json_encode($value);
								}
							}			
							break;						
					}
				}
			}*/
			

			
			//echo "[" . $json . "]"; 
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
		
		
	}

	/**
	 * Determina si la hora de referencia queda dentro del rango horario dado
	 *
	 * - Todas las horas son cadenas en formato HH:MM (o HH:MM:SS)
	 * - El rango es cerrado y de tipo 9:00-14:00 o 23:00-6:00
	 * - Compara con la hora actual si no se indica lo contrario
	 */
	function dentro_de_horario($hms_inicio, $hms_fin, $hms_referencia=NULL){ // v2011-06-21
	    if( is_null($hms_referencia) ){
	        $hms_referencia = date('G:i:s');
	    }

	    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_inicio), 3, 0);
	    $s_inicio = 3600*$h + 60*$m + $s;

	    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_fin), 3, 0);
	    $s_fin = 3600*$h + 60*$m + $s;

	    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_referencia), 3, 0);
	    $s_referencia = 3600*$h + 60*$m + $s;

	    if($s_inicio<=$s_fin){
	        return $s_referencia>=$s_inicio && $s_referencia<=$s_fin;
	    }else{
	        return $s_referencia>=$s_inicio || $s_referencia<=$s_fin;
	    }
	}	

	//Funcion para listar los monitores a seleccionar en la ruta
	function listarMonitoresEditar(){
		$respuesta = $this->monitor_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		/*$respuesta = $this->monitor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		$json = "";
		$contador = 0;*/
		if($respuesta != null){				
			/*foreach ($respuesta->result() as $valores) {
				if($contador == 0){
					$json .= json_encode($valores);
					$contador++;
				}else{
					$json .= "," . json_encode($valores);
				}
			}*/
			usort($respuesta->result(), function($a, $b) { //Sort the array using a user defined function
		    	return strcmp(strtolower($a->nombre), strtolower($b->nombre));
			});
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}

		
		
		/*$respuestaConRuta = $this->monitor_model->listarConRuta();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuestaConRuta != null){	
			foreach ($respuestaConRuta->result() as $value) {

				//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
				switch ($_REQUEST["repetir"]) {
					case 'NUNCA':
						$estado = $this->monitor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $_REQUEST["fechainicial"], $value->idmonitor, $_REQUEST["ruta"]);
						if($estado){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}
						
						break;

					case 'DIARIAMENTE':	
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->monitor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idmonitor, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+1 day', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}							
						break;

					case 'SEMANALMENTE':
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->monitor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idmonitor, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+7 day', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}			
						break;

					case 'MENSUALMENTE':
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->monitor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idmonitor, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+1 month', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}			
						break;





					
				}
			}
		}
		
		$jsonDatos = json_decode("[" . $json . "]");
		//echo json_encode($respuesta->result());
		//Se ordena el json por el nombre del producto de forma ascendente
		usort($jsonDatos, function($a, $b) { //Sort the array using a user defined function
		    return strcmp(strtolower($a->nombre), strtolower($b->nombre));
		});
		echo json_encode($jsonDatos); 
		//echo json_encode($respuesta->result());*/
		
		
		
	}

	//Funcion para listar los monitores a seleccionar en la ruta
	function listarConductoresEditar(){
		$respuesta = $this->conductor_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		/*$respuesta = $this->conductor_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		$json = "";
		$contador = 0;*/
		if($respuesta != null){				
			/*foreach ($respuesta->result() as $valores) {
				if($contador == 0){
					$json .= json_encode($valores);
					$contador++;
				}else{
					$json .= "," . json_encode($valores);
				}
			}*/
			usort($respuesta->result(), function($a, $b) { //Sort the array using a user defined function
			    return strcmp(strtolower($a->nombre), strtolower($b->nombre));
			});
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
			
		/*$respuestaConRuta = $this->conductor_model->listarConRuta();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuestaConRuta != null){	
			foreach ($respuestaConRuta->result() as $value) {

				//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
				switch ($_REQUEST["repetir"]) {

					case 'NUNCA':
						$estado = $this->conductor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $_REQUEST["fechainicial"], $value->idconductor, $_REQUEST["ruta"]);
						if($estado){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}
						
						break;

					case 'DIARIAMENTE':	
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->conductor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idconductor, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+1 day', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}							
						break;

					case 'SEMANALMENTE':
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->conductor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idconductor, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+7 day', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}			
						break;

					case 'MENSUALMENTE':
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->conductor_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idconductor, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+1 month', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}			
						break;
				}
			}
		}
		

		
		$jsonDatos = json_decode("[" . $json . "]");
		//echo json_encode($respuesta->result());
		//Se ordena el json por el nombre del producto de forma ascendente
		usort($jsonDatos, function($a, $b) { //Sort the array using a user defined function
		    return strcmp(strtolower($a->nombre), strtolower($b->nombre));
		});
		echo json_encode($jsonDatos); 
		//echo json_encode($respuesta->result());*/
		
		
		
	}

	//Funcion para guardar datos de un pedido en una sesion 
	function guardarJSONChatSesion(){
		//$this->session->set_userdata("JSONSSCASESSION", $_POST["JSONCHAT"]);
		//$this->session->unset_userdata('JSONSSCASESSION');	
		//echo $this->session->userdata('JSONSSCASESSION');
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/Fontan/JSONSSCASESSION.json", $_POST["JSONCHAT"]);
		/*$file = fopen($_SERVER['DOCUMENT_ROOT'] . "/Fontan/JSONSSCASESSION.json", "w");
		fwrite($file, $_POST["JSONCHAT"] . PHP_EOL);
		fclose($file);*/
	}

	//Funcion para guardar datos de un pedido en una sesion 
	function guardarMensajeChat(){
		$array = array(
			'message' => $_POST["mensaje"],
			'origen' => $_POST["origen"],
			'destino' => $_POST["destino"],
			'usuario1' => $_POST["usuario1"],
			'usuario2' => $_POST["usuario2"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->rutas_model->crearMensajeChat($array);//Se llama a la funcion de que esta en modelo

		$arrayDatos = array(
			'message' => $_POST["mensaje"],
			'origen' => $_POST["origen"],
			'destino' => $_POST["destino"],
			'usuario1' => $_POST["usuario2"],
			'usuario2' => $_POST["usuario1"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->rutas_model->crearMensajeChat($arrayDatos);//Se llama a la funcion de que esta en modelo
	}
	function obtenerChatUsuario(){
		$respuestaMensajes = $this->rutas_model->getMensajesChat($_POST["usuario1"], $_POST["usuario2"]);
		if($respuestaMensajes != null){
			echo json_encode($respuestaMensajes->result());
		}else{
			echo "[]";
		}
	}
	//Funcion para guardar datos de un pedido en una sesion 
	function obtenerJSONChatSesion(){
		$json = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/Fontan/JSONSSCASESSION.json"));
		if(count($json) > 0){
			foreach ($json as $value) {
				if(isset($value->tipo)){					

					switch ($value->tipo) {
						case 'ACUDIENTE':
							$respuesta = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->usuarioF);
							if($respuesta != null){
								$value->NombreAcudiente = $respuesta->result()[0]->PrimerNombre . " " . $respuesta->result()[0]->SegundoNombre . " " . $respuesta->result()[0]->PrimerApellido . " " . $respuesta->result()[0]->SegundoApellido;

								if($respuesta->result()[0]->gcm_regid != ""){
									$value->Online = "SI";
								}else{
									$value->Online = "NO";
								}	
								
								$textEstudiantes = "";
								if(isset($value->estudiantes)){


									$estudiantes = explode(",", $value->estudiantes);
									for ($i=0; $i < count($estudiantes); $i++) { 
										$respuestaAcudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($estudiantes[$i]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
										if($respuestaAcudiente != null){
											if($i == 0){
												$textEstudiantes .= $respuestaAcudiente->result()[0]->PrimerNombre . " " . $respuestaAcudiente->result()[0]->SegundoNombre . " " . $respuestaAcudiente->result()[0]->PrimerApellido . " " . $respuestaAcudiente->result()[0]->SegundoApellido;
											}else{
												$textEstudiantes .= "-" . $respuestaAcudiente->result()[0]->PrimerNombre . " " . $respuestaAcudiente->result()[0]->SegundoNombre . " " . $respuestaAcudiente->result()[0]->PrimerApellido . " " . $respuestaAcudiente->result()[0]->SegundoApellido;
											}
											
										}else{
											$value->Nombre = $textEstudiantes;
										}
									}
									$value->Nombre = $textEstudiantes;
								}

								
							}else{
								$respuestaOtro = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->usuarioS);
								if($respuestaOtro != null){
									$value->NombreAcudiente = $respuestaOtro->result()[0]->PrimerNombre . " " . $respuestaOtro->result()[0]->SegundoNombre . " " . $respuestaOtro->result()[0]->PrimerApellido . " " . $respuestaOtro->result()[0]->SegundoApellido;

									if($respuestaOtro->result()[0]->gcm_regid != ""){
										$value->Online = "SI";
									}else{
										$value->Online = "NO";
									}		

									$textEstudiantes = "";
									if(isset($value->estudiantes)){
										$estudiantes = explode(",", $value->estudiantes);
										for ($i=0; $i < count($estudiantes); $i++) { 
											$respuestaAcudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($estudiantes[$i]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
											if($respuestaAcudiente != null){
												if($i == 0){
													$textEstudiantes .= $respuestaAcudiente->result()[0]->PrimerNombre . " " . $respuestaAcudiente->result()[0]->SegundoNombre . " " . $respuestaAcudiente->result()[0]->PrimerApellido . " " . $respuestaAcudiente->result()[0]->SegundoApellido;
												}else{
													$textEstudiantes .= "-" . $respuestaAcudiente->result()[0]->PrimerNombre . " " . $respuestaAcudiente->result()[0]->SegundoNombre . " " . $respuestaAcudiente->result()[0]->PrimerApellido . " " . $respuestaAcudiente->result()[0]->SegundoApellido;
												}
												
											}else{
												$value->Nombre = $textEstudiantes;
											}
										}
										$value->Nombre = $textEstudiantes;
									}
								}else{
									$value->Nombre = "";
									$value->NombreAcudiente = "";
								}
							}
							
							$respuestaMensajes = $this->rutas_model->getMensajesChat($value->usuarioF,$value->usuarioS);
							if($respuestaMensajes != null){
								$value->Mensajes = $respuestaMensajes->result();
							}else{
								$value->Mensajes = []; 
							}

							break;

						case 'MONITOR':
							$respuesta = $this->usuarios_aplicaciones_model->obtenerUsuarioDocumento($value->usuarioF);
							if($respuesta != null){
								$value->Nombre = $respuesta->result()[0]->PrimerNombre . " " . $respuesta->result()[0]->SegundoNombre . " " . $respuesta->result()[0]->PrimerApellido . " " . $respuesta->result()[0]->SegundoApellido;
								if($respuesta->result()[0]->gcm_regid != ""){
									$value->Online = "SI";
								}else{
									$value->Online = "NO";
								}		
							}else{
								$respuestaOtro = $this->usuarios_aplicaciones_model->obtenerUsuarioDocumento($value->usuarioS);
								if($respuestaOtro != null){
									$value->Nombre = $respuestaOtro->result()[0]->PrimerNombre . " " . $respuestaOtro->result()[0]->SegundoNombre . " " . $respuestaOtro->result()[0]->PrimerApellido . " " . $respuestaOtro->result()[0]->SegundoApellido;	
									if($respuestaOtro->result()[0]->gcm_regid != ""){
										$value->Online = "SI";
									}else{
										$value->Online = "NO";
									}		
								}else{
									$value->Nombre = "";
								}
							}
							$respuestaMensajes = $this->rutas_model->getMensajesChat($value->usuarioF,$value->usuarioS);
							if($respuestaMensajes != null){
								$value->Mensajes = $respuestaMensajes->result();
							}else{
								$value->Mensajes = [];
							}
							break;

						case 'CENTRO':							
							$respuestaMensajes = $this->rutas_model->getMensajesChat($value->usuarioF,$value->usuarioS);
							if($respuestaMensajes != null){
								$value->Mensajes = $respuestaMensajes->result();
							}else{
								$value->Mensajes = [];
							}
							break;
						
						default:
							# code...
							break;
					}
				}
				
				
			}
			echo json_encode($json);
		}
		
	}

	//Funcion para listar los monitores a seleccionar en la ruta
	function listarVehiculosEditar(){
		$respuesta = $this->vehiculo_model->listarTodos();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no

		/*$respuesta = $this->vehiculo_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda. Los que tengan la fecha actual y los que no


		$json = "";
		$contador = 0;*/
		if($respuesta != null){				
			/*foreach ($respuesta->result() as $valores) {
				if($contador == 0){
					$json .= json_encode($valores);
					$contador++;
				}else{
					$json .= "," . json_encode($valores);
				}
			}*/
			echo json_encode($respuesta->result());
		}else{
			echo "[]";
		}
			
		/*$respuestaConRuta = $this->vehiculo_model->listarConRuta();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($respuestaConRuta != null){	
			foreach ($respuestaConRuta->result() as $value) {

				//Iterar las rutas asignadas del monitor que tengan el tipo seleccionado y compararlo con la fecha de su creacion
				switch ($_REQUEST["repetir"]) {

					case 'NUNCA':
						$estado = $this->vehiculo_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $_REQUEST["fechainicial"], $value->idvehiculo, $_REQUEST["ruta"]);
						if($estado){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}
						
						break;

					case 'DIARIAMENTE':	
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->vehiculo_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idvehiculo, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+1 day', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}							
						break;

					case 'SEMANALMENTE':
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->vehiculo_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idvehiculo, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+7 day', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}			
						break;

					case 'MENSUALMENTE':
						$fechaInicial = strtotime($_REQUEST["fechainicial"]);
						$fechaFinal = strtotime ($_REQUEST["fechafinal"]);
						$total_todos = 0;

						$fechaIterada = $fechaInicial;		

						while($fechaIterada >= $fechaInicial && $fechaIterada <= $fechaFinal){
							$nuevafecha = date ( 'Y-m-d' , $fechaIterada );

							$estado = $this->vehiculo_model->ValidarHorasEditar($_REQUEST["horainicial"], $_REQUEST["horafinal"], $nuevafecha, $value->idvehiculo, $_REQUEST["ruta"]);
							if(!$estado){
								$total_todos++;
							}

							$fechaIterada = strtotime ( '+1 month', $fechaIterada) ;
						}
						if($total_todos == 0){
							if($contador == 0){
								$json .= json_encode($value);
								$contador++;
							}else{
								$json .= "," . json_encode($value);
							}
						}			
						break;	
				}
			}
		}
		

		
		echo "[" . $json . "]"; */
		//echo json_encode($respuesta->result());
		
		
		
	}

	function enviarMensajePrueba(){
		// El mensaje
		$mensaje = '<style type="text/css">
			*{
				margin: 0;
				padding: 0;
			}
			.btn-primary {
			    
			}
			.btn {
			    
			}
		</style>
		<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
		<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
		<div align="center" style="width: 50%; float: right">
			<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>Shelvin Batista Batista</i></b> fue recogido y ya se encuentra en nuestro bus escolar</label><br>
			<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=prueba@gmail.com&name=Prueba Prueba" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
			    margin-bottom: 0;
			    font-size: 18px;
			    font-weight: 400;
			    line-height: 1.42857143;
			    text-align: center;
			    white-space: nowrap;
			    vertical-align: middle;
			    -ms-touch-action: manipulation;
			    touch-action: manipulation;
			    cursor: pointer;
			    -webkit-user-select: none;
			    -moz-user-select: none;
			    -ms-user-select: none;
			    user-select: none;
			    border: 1px solid transparent;color: #fff;
			    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
		</div>
		<div style="width:100%" align="center">
			<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
		</div>
		<table width="100%" border="0">
			<tr>
				<td width="20px">&nbsp;</td>
				<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
				<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
				<td>
					<div style="width: 100%">
						<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
					</div>
				</td>
			</tr>
		</table>';
		
		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = "shelvinbb@gmail.com";
		$email_subject = "Informe Ingreso a Ruta Escolar";
		
		
		//$mail->Host = "localhost";
		//$mail->Port = "25";
		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: SSCA – Servicios Escolares Colegio Fontán<ruta@ssca.com>";
		$bool = mail($email_to, $email_subject, $mensaje, $headers);
	}

	function enviarMensajeContactenos(){
		// El mensaje
		$mensaje = $_POST["mensaje"];
		$from = $_POST["email"];
		$name = $_POST["nombre"];

		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = "info@ssca-colombia.com";
		$email_subject = "Informacion de Contactenos";
		
		
		//$mail->Host = "localhost";
		//$mail->Port = "25";
		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: " . $name . "<" . $from . ">";
		$bool = mail($email_to, $email_subject, $mensaje, $headers);
	}
	

	function export_log_ruta()
	{
		if(empty($this->session->userdata('UserIDInternoSSCA'))) {
			header("HTTP/1.0 403 Forbidden", false, 403);
			exit("HTTP/1.0 403 Forbidden");
		}

		$DB_Server = "localhost";     
		$DB_Username = "root";
		$DB_Password = "usc";                  
		$DB_DBName = "ssca";        
		$DB_TBLName = "log_ruta";
		$filename = "Reporte log ruta ".$_GET['f'];
		$sql = sprintf("Select 
			PrimerApellido, 
			SegundoApellido, 
			PrimerNombre, 
			SegundoNombre, 
			hora, 
			mensaje, 
			coordenadas_recogida 
			from %s
			inner join usuarios
			on usuarios.NumeroId = log_ruta.idestudiante 
			where fecha = '%s'", 
			$DB_TBLName, $_GET['f']);
		// exit($sql);
		$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
		$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
		$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
		$file_ending = "xls";
		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=$filename.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");
		$sep = "\t"; 
		for ($i = 0; $i < mysql_num_fields($result); $i++) {
			echo mysql_field_name($result,$i) . "\t";
		}
		print("\n");    
		while($row = mysql_fetch_row($result))
		{
			$schema_insert = "";
			for($j=0; $j<mysql_num_fields($result);$j++)
			{
				if(!isset($row[$j]))
					$schema_insert .= "NULL".$sep;
				elseif ($row[$j] != "")
					$schema_insert .= "$row[$j]".$sep;
				else
					$schema_insert .= "".$sep;
			}
			$schema_insert = str_replace($sep."$", "", $schema_insert);
			$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
			$schema_insert .= "\t";
			print(trim($schema_insert));
			print "\n";
		} 
	}

}

