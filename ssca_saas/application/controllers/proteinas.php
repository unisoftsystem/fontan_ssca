<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proteinas extends CI_Controller {

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
		$this->load->model('producto_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('categoria_model');//Cargar el modelo de categoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('menus_model');//Cargar el modelo de menus donde estan las funciones que hacen las consultas a la bd
		$this->load->model('subcategoria_model');//Cargar el modelo de subcategoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('proteinas_model');//Cargar el modelo de proteinas donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/****************************** MOSTRAR PAGINAS ******************************************/
	public function index()
	{
		
	}

	
	/****************************** ACCIONES ******************************************/
	//Funcion para crear una proteina
	function insertar(){
		//Se genera un color al azar
		$color = "#" . substr(md5(time()), 0, 6);

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'Nombre' => $_POST["Nombre"],
			'color' => $color);

		$data = $this->proteinas_model->crear($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $data;
	}

	//Funcion para listar las proteinas
	function listarProteinas(){
		
		$data = $this->proteinas_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda

		if($data != null){
			echo json_encode($data->result());
		}else{
			echo "[]";
		}
	}

	//Funcion para validar la existencia de una proteina por su nombre
	function ExisteProteina(){
		$respuesta = $this->proteinas_model->ExisteProteina($_POST["Nombre"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}
}