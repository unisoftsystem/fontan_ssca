<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cursos extends CI_Controller {

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
		$this->load->model('curso_model');//Cargar el modelo de curso donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/***************** MOSTRAR PAGINAS ************************/
	public function index()
	{
		
	}

	//Mostrar la vista de crear cursos
	function nuevo(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../cursos/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Nuevo Curso";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('curso/nuevo', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}
	/****************** ACCIONES *******************/

	//Funcion para crear cursos
	function crear(){
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
				'Descripcion' => $_POST["descripcion"]);
		$resultado = $this->curso_model->crear($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda		
	}

	//Funcion para listar los cursos
	function listarCursos(){
		$resultado = $this->curso_model->listarCursos();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para validar la existencia de un curso por su nombre
	function ExisteCurso(){
		$respuesta = $this->curso_model->existeCurso($_POST["descripcion"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}
}