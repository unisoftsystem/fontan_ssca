<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Controller {

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
		$this->load->model('subcategoria_model');//Cargar el modelo de subcategoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/************ MOSTRAR PAGINAS ********************************/
	public function index()
	{
		
	}

	//Mostrar la vista de crear producto
	function nuevo(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../producto/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Creaci&oacute;n de Productos";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['categorias'] = $this->categoria_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('productos/nuevo');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar producto
	function editar(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../producto/editar", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Modificaci&oacute;n de Productos";//Titulo de la pagina, se lo envio al archivo donde esta el header

			//Se listan las categorias y se pasan como json a la pagina
			$data['categorias'] = $this->categoria_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda

			//Se listan los productos y se pasan como json a la pagina
			$data['productos'] = $this->producto_model->ListarProductos();//Se llama a la funcion de que esta en modelo y el resultado se guarda

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('productos/editar');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de gestion de inventarios
	function gestionInventario(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../producto/gestionInventario", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){
			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Gestión de Productos";//Titulo de la pagina, se lo envio al archivo donde esta el header

			//Se listan los productos y se pasan como json a la pagina
			$data['productos'] = $this->producto_model->ListarProductos();//Se llama a la funcion de que esta en modelo y el resultado se guarda

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('productos/gestionInventario');//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}	

	/****************************** ACCIONES ******************************************/

	//Funcion para listar las productos por subcategoria
	function ListarProductosSubCategoria(){
		$resultado = $this->producto_model->ListarProductosSubCategoria($_POST["subcategoria"], $_POST["dia"], $_POST["idUsuario"], $_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $resultado;	
	}

	//Funcion para listar los productos
	function ListarProductos(){
		$resultado = $this->producto_model->ListarProductos();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			echo json_encode($resultado->result());	
		}else{
			echo "[]";	
		}
		
	}

	//Funcion para disminuir el stock de un producto
	function DisminuirStock(){
		$cantidad = 0;
		$resultado = $this->producto_model->ObtenerStock($_POST["codigoProducto"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			$cantidad = $resultado->result()[0]->Stock;
		}
		$total = $cantidad - $_POST["cantidad"];
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		
		$this->producto_model->DisminuirStock($_POST["codigoProducto"], $_POST["cantidad"], $_POST["session"], "DISMINUIR STOCK POR AGREGAR PRODUCTO EN PEDIDO");//Se llama a la funcion de que esta en modelo y el resultado se guarda
	}

	//Funcion para aumentar el stock de un producto
	function AumentarStock(){
		$cantidad = 0;
		$resultado = $this->producto_model->ObtenerStock($_POST["codigoProducto"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			$cantidad = $resultado->result()[0]->Stock;
		}
		$total = $cantidad + $_POST["cantidad"];
		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		
		$this->producto_model->AumentarStock($_POST["codigoProducto"], $_POST["cantidad"], $_POST["session"], "AUMENTAR STOCK POR ELIMINAR PRODUCTO EN PEDIDO");//Se llama a la funcion de que esta en modelo y el resultado se guarda
	}

	//Funcion para disminuir el stock de un producto en la gestion de inventarios
	function AumentarStockGestion(){
		
		$data = $this->producto_model->ObtenerStock($_POST["codigoProducto"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($data != null){
			$cantidadActual = $data->result()[0]->Stock;
			$total = $cantidadActual + $_POST["cantidad"];

			//Se guardan los datos en un array asociativo para pasarlos la funcion del model
			
			$this->producto_model->AumentarStock($_POST["codigoProducto"], $_POST["cantidad"], $_POST["session"], "GESTION DE INVENTARIO");//Se llama a la funcion de que esta en modelo y el resultado se guarda

			//Se muestra el popup en la vista con los datos del producto gestionado
			echo "<script>$('#foto').attr('src', '" . base_url() . $data->result()[0]->Imagen . "');$('#Datos').html('<h5>" . $data->result()[0]->NombreProducto . "</h5><p>Cantidad Anterior: " . $cantidadActual . "</p><p>Cantidad Agregada: " . $_POST["cantidad"] . "</p><p>Cantidad Final: " . $total . "</p>');$('#popup').fadeIn('slow');</script>";
		}
		
	}

	//Funcion para obtener el stock de un producto
	function ObtenerStock(){
		$data = $this->producto_model->ObtenerStock($_POST["codigoProducto"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($data != null){
			echo json_encode($data->result());
		}else{
			echo "[]";
		}
	}

	//Funcion para crear un producto
	function insertar(){
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

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'nombreProducto' => $_POST["nombreProducto"],
			'descripcion' => $_POST["descripcion"],
			'valorUnitario' => $_POST["valorUnitario"],
			'categoria' => $_POST["categoria"],
			'subcategoria' => $_POST["subcategoria"],
			'stock' => $_POST["stock"],
			'estado' => $_POST["estado"],
			'file' => $url,
			'tiempo' => $_POST["tiempo"],
			'tiempoc' => $_POST["tiempoc"],
			'edadMinima' => $_POST["edadMinima"],
			'edad' => $_POST["edad"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->producto_model->crear($array);//Se llama a la funcion de que esta en modelo
	}

	//Funcion para crear un producto
	function modificar(){
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
		}else{
			$url = $_POST['fotoCon'];
		}
		
		$cantidad = 0;
		$resultado = $this->producto_model->ObtenerStock($_POST["codigo"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			$cantidad = $resultado->result()[0]->Stock;

			if($cantidad != $_POST["stock"]){
				//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$array = array(
					'codigoProducto' => $_POST["codigo"],
					'stock_inicial' => $cantidad,
					'cantidad_agregar' => $_POST["stock"],
					'stock_final' => $_POST["stock"],
					'session' => $_POST["session"],
					'origen' => "MODIFICACION DE PRODUCTO POR CANTIDAD");
				$this->producto_model->crearLog($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			}else{
				//Se guardan los datos en un array asociativo para pasarlos la funcion del model
				$array = array(
					'codigoProducto' => $_POST["codigo"],
					'stock_inicial' => $cantidad,
					'cantidad_agregar' => $_POST["stock"],
					'stock_final' => $_POST["stock"],
					'session' => $_POST["session"],
					'origen' => "MODIFICACION DE PRODUCTO POR DATOS");
				$this->producto_model->crearLog($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			}
			
		}
		

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'codigo' => $_POST["codigo"],
			'nombreProducto' => $_POST["nombreProducto"],
			'descripcion' => $_POST["descripcion"],
			'valorUnitario' => $_POST["valorUnitario"],
			'categoria' => $_POST["categoria"],
			'subcategoria' => $_POST["subcategoria"],
			'stock' => $_POST["stock"],
			'estado' => $_POST["estado"],
			'file' => $url,
			'tiempo' => $_POST["tiempo"],
			'tiempoc' => $_POST["tiempoc"],
			'edadMinima' => $_POST["edadMinima"],
			'edad' => $_POST["edad"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->producto_model->editar($array);//Se llama a la funcion de que esta en modelo
	}
}