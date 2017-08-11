<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
/**
* 
*/
class Services extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('modulo_model');//Cargar el modelo de modulo donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_sistema_model');//Cargar el modelo de usuario del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
	}

	/*******************MOSTRAR PAGINAS******************************/

	function index(){

	}

	//Mostrar la vista de crear servicios del sistema
	function CrearServiciosSistema(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../services/nuevo", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		//if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$data['titulo'] = "Creacion de Servicios del Sistema";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['modulos'] = $this->modulo_model->listar();//Se llama a la funcion de que esta en modelo y el resultado se guarda			
			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$this->load->view('usuarios_sistema/crearServiciosSistema');//Se muestra el body de la pagina
		/*}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuario/home';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}*/
	}	

	/***********************************ACCIONES**********************************************/
	//Funcion para listar los submodulos
	function listarSubModulo(){
		$resultado = $this->modulo_model->listarSubModulos($_POST["idModulo"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para listar los servicios
	function listarServicios(){
		$resultado = $this->modulo_model->listarServicios($_POST["idSubModulo"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para crear un servicio
	function crearServicio(){
		
		$array = array(
			'servicesid' => $this->input->post('selectServicios'),
			'moduleid' => $this->input->post('selectModulos'),
			'submodule' => $this->input->post('selectSubModulos'));
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$url = base_url();
		$this->modulo_model->crearServicio($array);//Se llama a la funcion de que esta en modelo
		echo "<script>alert('Servicio creado con exito');window.location.href = '$url/index.php/services/crearServiciosSistema';</script>";//Se muestra un alert cuando se crea el registro en la bd
	}

	//Funcion para generar el json el cual es necesario en el arbol de servicios
	function arbolServicios(){
		$cadena = "[";
		$contador = 0;

		//Se listan los modulos activos que tengan asignados servicios
		$resultado = $this->modulo_model->listarModulosConServicios();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			//Se iteran los modulos con servicios asignados
			foreach ($resultado->result() as $value) {
				//Se consultan los servicios asignados al modulo
				$resultadoServicios = $this->modulo_model->listarServiciosAsignadosPorModulo($value->id);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				$jsonServicios = "";
				$contadorServicios = 0;
				//Se iteran los servicios y se agregan al json
				foreach ($resultadoServicios->result() as $valor) {
					if($contadorServicios == 0){
						$jsonServicios .= '{"id":"' . $valor->id . '", "order":"0", "parent_id":"' . $value->id . '", "name": "' . $valor->nombre . '", "text": "' . $valor->nombre . '", "children":[], "data": {}}';
					}else{
						$jsonServicios .= ',{"id":"' . $valor->id . '", "order":"0", "parent_id":"' . $value->id . '", "name": "' . $valor->nombre . '", "text": "' . $valor->nombre . '", "children":[], "data": {}}';
					}
					$contadorServicios++;
				}
				if($contador == 0){
					$cadena .= '{"id":"' . $value->id . '", "order":"0", "parent_id":"0", "name": "' . $value->nombre . '", "text": "' . $value->nombre . '", "children":[' . $jsonServicios . '], "data": {}}';
				}else{
					$cadena .= ',{"id":"' . $value->id . '", "order":"0", "parent_id":"0", "name": "' . $value->nombre . '", "text": "' . $value->nombre . '", "children":[' . $jsonServicios . '], "data": {}}';
				}
				$contador++;
			}
			$cadena .= "]";
			//Se retorna a la vista al json para el arbol de servicios
			echo $cadena;
		}else{
			echo "[]";
		}		
	}

	//Funcion para generar el json de menu de submodulos con sus servicios
	function menuServicios($usuario, $pagina, $id){
		$cadena = "[";
		$contador = 0;

		//Se listan los submodulos que tengan asigando un usuario que ha iniciado sesion
		$resultado = $this->permisos_usuarios_sistema_model->listarSubModuloAsignadosPorUsuario($id, $usuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($resultado != null){
			//Se iteran los submodulos
			foreach ($resultado->result() as $value) {

				//Se listan los servicios que tiene asignado el usuarios que ha iniciado sesion por cada submodulo iterado
				$resultadoServicios = $this->permisos_usuarios_sistema_model->listarServiciosdelUsuario($value->id, $usuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				$jsonServicios = "";

				//Se genera el json de los servicios del submodulo iterados
				if($resultadoServicios != null){
					$jsonServicios = json_encode($resultadoServicios->result());
				}else{
					$jsonServicios = "[]";
					
				}
				//Se genera el json del submodulo con su json de servicios
				if($contador == 0){
					$cadena .= '{"id":"' . $value->id . '", "name": "' . $value->nombre . '", "description": "' . $value->descripcion . '", "servicios":' . $jsonServicios . '}';
				}else{
					$cadena .= ',{"id":"' . $value->id . '", "name": "' . $value->nombre . '", "description": "' . $value->descripcion . '", "servicios":' . $jsonServicios . '}';
				}
				$contador++;
			}
			
		}else{
			
		}
		$cadena .= "]";
		//Se carga la libreria donde se crea el menu
		$this->load->library('menu');

		//Se pasa a la libreria del menu el json de los submodulos y servicios para que se cree el menu
		$menuPrincipal = $this->menu->menuServicios($pagina, json_decode($cadena));//Se llama a la funcion que crea el menu, el codigo html se guarda en la variable
		return $menuPrincipal;	
	}

	

	//Funcion para generar el json de menu de modulos
	function menuModulos($usuario, $modulo){
		$json;
		
		//Se listan los modulos que tengan asigandos un usuario que ha iniciado sesion
		$resultado = $this->permisos_usuarios_sistema_model->listarModuloAsignadosPorUsuario($usuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			$json = $resultado->result();
		}else{
			$json = json_decode("[]");
			
		}
		//Se carga la libreria donde se crea el menu
		$this->load->library('menu');

		//Se pasa a la libreria del menu el json de los modulos para que se cree el menu
		$menuPrincipal = $this->menu->menuModulos($modulo, $json);//Se llama a la funcion que crea el menu, el codigo html se guarda en la variable
		
		return $menuPrincipal;	
	}

	//Funcion para asignar un servicio
	function asignarServicio(){
		
		$array = array(
			'usuario' => $_POST["usuario"],
			'idServicio' => $_POST["idServicio"],
			'fecha' => $_POST["fecha"],
			'hora' => $_POST["hora"]);
		//Se llama a la funcion de guardar datos en bd que esta en el modelo
		$this->permisos_usuarios_sistema_model->crear($array);//Se llama a la funcion de que esta en modelo
	}


}