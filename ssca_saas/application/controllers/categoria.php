<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller {

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
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('subcategoria_model');//Cargar el modelo de subcategorias donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/****************************** MOSTRAR PAGINAS ******************************************/
	public function index()
	{
		
	}

	//Mostrar la vista de crear categorias
	function nuevo(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../categoria/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
	    	$this->load->library('logo');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Nueva Categoria";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('categorias/nuevo', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar categorias
	function editar(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../categoria/editar", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Modificar Categoria";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];

			$this->load->view('categorias/editar', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/****************************** ACCIONES ******************************************/

	//Funcion para guardar datos de una categoria en la bd 
	function insertar(){
		if($_REQUEST["tipoCategoria"] == "Categoria"){
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"]);
			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->categoria_model->crear($array);//Se llama a la funcion de que esta en modelo
		}else{
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'idCategoria' => $_POST["categoria"]);

			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->subcategoria_model->crear($array);//Se llama a la funcion de que esta en modelo
		}
	}

	//Funcion para modificar los datos de una categoria en la bd 
	function modificar(){
		if($_REQUEST["tipoCategoria"] == "Categoria"){
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'codigo' => $_POST["codigoCategoria"]);
			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->categoria_model->editar($array);//Se llama a la funcion de que esta en modelo
		}else{
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'codigo' => $_POST["codigoSubCategoria"]);

			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->subcategoria_model->editar($array);//Se llama a la funcion de que esta en modelo
		}
	}

	//Funcion para listar las categorias
	function listarCategorias(){
		$resultado = $this->categoria_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			//Se convierte a cadena el json del resultado de la consulta
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}
}