<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
		$data['titulo'] = "SCHOOL SERVICE AND CONTROL ACCESS";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/inicio');//Se carga la vista que esta dentro de la carpeta
	}

	public function identificacion()
	{
		$data['titulo'] = "SISTEMAS DE IDENTIFICACION";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/identificacion');//Se carga la vista que esta dentro de la carpeta
	}

	public function rutas()
	{
		$data['titulo'] = "CONTROL DE RUTAS ESCOLARES";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/rutas');//Se carga la vista que esta dentro de la carpeta
	}

	public function restaurante()
	{
		$data['titulo'] = "CONTROL PARA RESTAURANTE ESCOLAR";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/restaurante');//Se carga la vista que esta dentro de la carpeta
	}

	public function cafeteria()
	{
		$data['titulo'] = "CONTROL PARA CAFETERIA ESCOLAR";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/cafeteria');//Se carga la vista que esta dentro de la carpeta
	}

	public function tarjeta()
	{
		$data['titulo'] = "TARJETAS MONEDERO";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/tarjeta');//Se carga la vista que esta dentro de la carpeta
	}

	public function control()
	{
		$data['titulo'] = "SISTEMAS DE CONTROL POR LECTURA DE CODIGOS";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/control');//Se carga la vista que esta dentro de la carpeta
	}

	public function contactenos()
	{
		$data['titulo'] = "CONTACTENOS";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$this->load->view('validacion/contactenos');//Se carga la vista que esta dentro de la carpeta
	}

	/****************************** ACCIONES ******************************************/

	//Funcion para enviar un mensaje
	function enviarMensaje(){
		$configuraciones["mailtype"] = 'html';
		$this->email->initialize($configuraciones);
		$this->email->from($_POST["email"], $_POST["nombre"]);
		$this->email->to("shelvinbb@gmail.com");
		$this->email->subject("Mensaje de contactenos");
		$this->email->message($_POST["mensaje"]);
		$this->email->send();
	}
}