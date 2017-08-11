<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller {

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
		$this->load->model('proteinas_model');//Cargar el modelo de proteinas donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/************** MOSTRAR PAGINAS *************************/
	public function index()
	{
		
	}

	//Mostrar la vista de menus del dia
	function MenuDia(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../menus/MenuDia", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Nuevo Menu del Dia";//Titulo de la pagina, se lo envio al archivo donde esta el header

			//Se listan todos los menus del dia para pasarlo a la vista como un objeto json
			$data['menus'] = $this->menus_model->listarMenuDias();//Se llama a la funcion de que esta en modelo y el resultado se guarda
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('Menu/menuDia');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de menu especial
	function MenuEspecial(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../menus/MenuEspecial", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Nuevo Menu Especial";//Titulo de la pagina, se lo envio al archivo donde esta el header

			//Se listan todos los menu especial para pasarlo a la vista como un objeto json
			$data['menus'] = $this->menus_model->listarMenuEspecial();//Se llama a la funcion de que esta en modelo y el resultado se guarda
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('Menu/menuEspecial');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/*************** ACCIONES ***********************/

	//Funcion para crear un menu del dia
	function nuevoMenuDia(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();
		/*
			Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
		*/
		if($_POST['imgBase64'] != ""){
			$img = $_POST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = getcwd() . "/images/" . $uidFoto . '.png';
			$url = "images/" . $uidFoto . '.png';
			$success = file_put_contents($file, $data);
		}

		//Se verifica si un dia de la semana ya tiene su menu asignado
		$menus = $this->menus_model->existeMenuDia($_POST["dia"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Si el dia de la semana no tiene menu asignado, se crea uno nuevo
		if($menus == 0){
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'idProteina' => $_POST["proteina"],
				'Descripcion' => $_POST["descripcion"],
				'Dia' => $_POST["dia"],
				'Foto' => $url,
				'Edad' => $_POST["rest"]);
			$this->menus_model->crearMenuDia($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}else{
			//Si el dia de la semana ya tiene menu asignado, se actualiza
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'idProteina' => $_POST["proteina"],
				'Descripcion' => $_POST["descripcion"],
				'Dia' => $_POST["dia"],
				'Foto' => $url,
				'Edad' => $_POST["rest"]);
			$this->menus_model->editarMenuDia($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}
	}

	//Funcion para crear un menu especial
	function nuevoEspecial(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();
		/*
			Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
		*/
		if($_POST['imgBase64'] != ""){
			$img = $_POST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = getcwd() . "/images/" . $uidFoto . '.png';
			$url = "images/" . $uidFoto . '.png';
			$success = file_put_contents($file, $data);
		}

		//Se verifica si un dia de la semana ya tiene su menu especial asignado
		$menus = $this->menus_model->existeMenuEspecial($_POST["dia"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Si el dia de la semana no tiene menu especial asignado, se crea uno nuevo
		if($menus == 0){
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'Valor' => $_POST["valor"],
				'Descripcion' => $_POST["descripcion"],
				'Dia' => $_POST["dia"],
				'Foto' => $url);
			$this->menus_model->crearMenuEspecial($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}else{
			//Si el dia de la semana ya tiene menu especial asignado, se actualiza
			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			$array = array(
				'Nombre' => $_POST["nombre"],
				'Valor' => $_POST["valor"],
				'Descripcion' => $_POST["descripcion"],
				'Dia' => $_POST["dia"],
				'Foto' => $url);
			$this->menus_model->editarMenuEspecial($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		}
	}
}