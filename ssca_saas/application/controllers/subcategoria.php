<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategoria extends CI_Controller {

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
		$this->load->model('subcategoria_model');//Cargar el modelo de subcategoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}


	/****************************** ACCIONES ******************************************/

	//Funcion para listar las subcategorias
	function listarSubCategorias(){
		$resultado = $this->subcategoria_model->listar($_POST["idCategoria"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}
}