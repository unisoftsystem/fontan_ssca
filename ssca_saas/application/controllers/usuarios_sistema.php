<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_sistema extends CI_Controller {

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
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_sistema_model');//Cargar el modelo de tipo de red donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de tipo de red donde estan las funciones que hacen las consultas a la bd
		$this->load->model('producto_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}
	/*************************** MOSTRAR PAGINAS ***********************************/

	//Mostrar la vista de crear un usuario del sistema
	function AsignarServiciosSistema(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../usuarios_sistema/AsignarServiciosSistema", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));		
			$data['titulo'] = "Creación de Usuarios del Sistema";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->library('../controllers/services');		
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$datos_footer = [
				'logo' => "img/logo app.png"
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('usuarios_sistema/nuevoUsuarioSistema', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de editar un usuario del sistema
	function ModificarUsuarioSistema(){
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../usuarios_sistema/ModificarUsuarioSistema", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['titulo'] = "Modificación de Usuarios del Sistema";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$this->load->library('../controllers/services');
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$datos_footer = [
				'logo' => "img/logo app.png"
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('usuarios_sistema/editarUsuarioSistema', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	//Mostrar la vista de iniciar sesion de los usuario internos
	function loginInterno(){
		$this->session->unset_userdata('UserNameInternoSSCA');
		$this->session->unset_userdata('UserIDInternoSSCA');
		$this->session->unset_userdata('SegmentoCodigoModulo');
		$this->session->unset_userdata('SegmentoTextoModulo');
		$this->session->unset_userdata('permisos_usuarios_sistema_model');
		$data['titulo'] = "SSCA";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$datos_footer = [
				'logo' => "img/logo app.png"
			];
			$array_page = [
				'footer' =>  $this->load->view('footerLogin', $datos_footer, true)
			];
		$this->load->view('usuarios_sistema/loginInterno', $array_page);//Se carga la vista que esta dentro de la carpeta
	}

	//Funcion para mostrar la pagina de home solo con el menu de modulos
	function homeInternoModulos(){
		//Se cargan los menus de los modulos que estan en el controller services
		$this->load->library('../controllers/services');
		$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
		$data['titulo'] = "SSCA";//Titulo de la pagina, se lo envio al archivo donde esta el header
		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$datos_footer = [
			'logo' => "img/logo app.png"
		];
		$array_page = [
			'footer' =>  $this->load->view('footerPages', $datos_footer, true)
		];
		$this->load->view('homeInternoModulos', $array_page);//Se muestra el body de la pagina
	}


	//Funcion para mostrar la pagina de crear usuario
	function homeInternoServicios(){
		//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
		$this->load->library('../controllers/services');
		$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
		$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
		$data['titulo'] = "SSCA";//Titulo de la pagina, se lo envio al archivo donde esta el header

		$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
		$datos_footer = [
			'logo' => "img/logo app.png"
		];
		$array_page = [
			'footer' =>  $this->load->view('footerPages', $datos_footer, true)
		];
		$this->load->view('homeInternoServicios', $array_page);//Se muestra el body de la pagina
	}

	/****************************** ACCIONES ******************************************/

	//Funcion para crear un usuario del sistema
	function crearUsuario(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();
		/*
			Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
		*/
		if($_POST['imgBase64'] != ""){
			$img = $_POST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace('data:image/jpg;base64,', '', $img);
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace('data:image/gif;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = getcwd() . "/images/" . $uidFoto . '.png';
			$url = "images/" . $uidFoto . '.png';
			$success = file_put_contents($file, $data);
		}

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["usuario"],
			'TipoId' => $_POST["tipoId"],
			'NumeroId' => $_POST["numeroId"],
			'PrimerApellido' => $_POST["primerApellido"],
			'SegundoApellido' => $_POST["segundoApellido"],
			'PrimerNombre' => $_POST["primerNombre"],
			'SegundoNombre' => $_POST["segundoNombre"],
			'ImagenFotografica' => $url,
			'Direccion' => $_POST["direccion"],
			'Telefono1' => $_POST["telefono1"],
			'Telefono2' => $_POST["telefono2"],
			'Estado' => "ACTIVO",
			'Clave' => base64_encode($_POST["clave"]));
		$this->usuarios_sistema_model->crear($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se divide la cadena de los permisos y se itera para guardarla en la bd
		$permisosSistema = explode(",", $_POST["permisos"]);
		foreach ($permisosSistema as $valor) {
			$arrayPermisos = array(
				'usuario' => $_POST["usuario"],
				'idServicio' => $valor,
				'fecha' => $_POST["fecha"],
				'hora' => $_POST["hora"]);
			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->permisos_usuarios_sistema_model->crear($arrayPermisos);//Se llama a la funcion de que esta en modelo
		}		
	}

	//Funcion para crear un usuario del sistema
	function editarUsuario(){
		$file = "";
		$url = "";
		$uidFoto = uniqid();
		/*
			Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
		*/
		if($_POST['imgBase64'] != ""){
			$img = $_POST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace('data:image/jpg;base64,', '', $img);
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace('data:image/gif;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = getcwd() . "/images/" . $uidFoto . '.png';
			$url = "images/" . $uidFoto . '.png';
			$success = file_put_contents($file, $data);
		}else{
			$url = $_POST['fotoCon'];
		}

		//Se guardan los datos en un array asociativo para pasarlos la funcion del model
		$array = array(
			'idUsuario' => $_POST["usuario"],
			'TipoId' => $_POST["tipoId"],
			'NumeroId' => $_POST["numeroId"],
			'PrimerApellido' => $_POST["primerApellido"],
			'SegundoApellido' => $_POST["segundoApellido"],
			'PrimerNombre' => $_POST["primerNombre"],
			'SegundoNombre' => $_POST["segundoNombre"],
			'ImagenFotografica' => $url,
			'Direccion' => $_POST["direccion"],
			'Telefono1' => $_POST["telefono1"],
			'Telefono2' => $_POST["telefono2"],
			'Estado' => "ACTIVO",
			'Clave' => base64_encode($_POST["clave"]));
		$this->usuarios_sistema_model->editar($array);//Se llama a la funcion de que esta en modelo y el resultado se guarda

		$this->credenciales_model->CambiaridUsuarioLogIn($_POST["usuarioOculto"], $_POST["usuario"], "AUMENTAR STOCK POR ELIMINAR PRODUCTO EN PEDIDO");//Se llama a la funcion de que esta en modelo y el resultado se guarda

		$this->credenciales_model->CambiaridUsuarioLogIn($_POST["usuarioOculto"], $_POST["usuario"], "DISMINUIR STOCK POR AGREGAR PRODUCTO EN PEDIDO");//Se llama a la funcion de que esta en modelo y el resultado se guarda

		$this->credenciales_model->CambiaridUsuarioLogIn($_POST["usuarioOculto"], $_POST["usuario"], "GESTION DE INVENTARIO");//Se llama a la funcion de que esta en modelo y el resultado se guarda

		//Se borran los permisos que tiene asignado el usuario del sistema y se crean nuevamente
		$this->permisos_usuarios_sistema_model->borrarPermisosUsuario($_POST["usuario"]);//Se llama a la funcion de que esta en modelo

		//Se divide la cadena de los permisos y se itera para guardarla en la bd
		$permisosSistema = explode(",", $_POST["permisos"]);
		for ($i=0; $i < count($permisosSistema); $i++) { 
		
			$arrayPermisos = array(
				'usuario' => $_POST["usuario"],
				'idServicio' => $permisosSistema[$i],
				'fecha' => $_POST["fecha"],
				'hora' => $_POST["hora"]);
			//Se llama a la funcion de guardar datos en bd que esta en el modelo
			$this->permisos_usuarios_sistema_model->crear($arrayPermisos);//Se llama a la funcion de que esta en modelo
		}
		echo json_encode($permisosSistema);	
	}

	//Funcion para validar la existencia de un usuario del sistema por su idUsuario
	function ExisteUsuario(){
		$respuesta = $this->usuarios_sistema_model->existeUsuario($_POST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}

	//Funcion para validar la existencia de un usuario del sistema por su numero de documento
	function ExisteDocumentoUsuario(){
		$respuesta = $this->usuarios_sistema_model->existeDocumentoUsuario($_POST["documento"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo $respuesta;
	}

	//Funcion para Iniciar sesion con un usuario del sistema
	function loginUsuarioInterno(){
	
		$campos = array(
			'user' => $this->input->post('txtUsuario'), 
			'pass' => base64_encode($this->input->post('txtClave')));

		$respuesta = $this->usuarios_sistema_model->login($campos);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		
		if($respuesta){
			//Se verifica si el usuario a iniciar sesion es un cajero
			$permisos = $this->permisos_usuarios_sistema_model->verificarUsuarioCajeroSesion($respuesta->result()[0]->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
			
			//Se guardan sus datos en la session
			$this->session->set_userdata('UserNameInternoSSCA', $respuesta->result()[0]->PrimerNombre . " " . $respuesta->result()[0]->SegundoNombre . " " . $respuesta->result()[0]->PrimerApellido . " " . $respuesta->result()[0]->SegundoApellido);
			$this->session->set_userdata('UserIDInternoSSCA', $respuesta->result()[0]->idUsuario);

			//Se verifica si el usuario tiene permisos asignados
			if($permisos != null){
				//Se verifica si tiene un solo permiso para saber si es un cajero o no
				if($permisos->num_rows() == 1){
					//Se verifica si el usuario es un cajero
					if($permisos->result()[0]->url == "../ordenpedido/cajero"){
						echo "<script>window.location.href = '" . base_url() . "index.php/ordenpedido/cajero';</script>";//Se muestra la pagina de lectura QR si es un cajero
					}else{
						if($permisos->result()[0]->url == "../ordenpedido/lecturaQREntrada"){
							echo "<script>window.location.href = '" . base_url() . "index.php/ordenpedido/lecturaQREntrada';</script>";//Se muestra la pagina de lectura QR si es un cajero
						}else{
							echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se muestra la pagina de home si no es un cajero el usuario
						}
					}
				}else{
					if($permisos->num_rows() == 3){
						$resul = $this->isCoordinador("../rutas/nuevo","../rutas/editar","../rutas/obtener",$permisos);
						if($resul == 3){
							echo "<script>window.location.href = '" . base_url() . "index.php/rutas/nuevo';</script>";//Se muestra la pagina de home si no es un cajero el usuario
						}else{
							echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se muestra la pagina de home si no es un cajero el usuario
						}
						
					}else{
						echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se muestra la pagina de home si no es un cajero el usuario
					}
					
				}
			}else{
				echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se muestra la pagina de home si no es un cajero el usuario
			}
		}else{
			echo "<script>alert('Usuario y/o Clave no existen');window.location.href = '" . base_url() . "index.php/usuarios_sistema/loginInterno';</script>";//Se muestra la pagina de home si el usuario no tiene permisos
		}
			
		
	}

	//Funcion para saber si el usuario logueado es el coordinador de rutas
	function isCoordinador($servicio1, $servicio2, $servicio3, $permisos){
		$contador = 0;
		if($permisos->result()[0]->url == $servicio1 || $permisos->result()[1]->url == $servicio1 || $permisos->result()[2]->url == $servicio1){
			$contador++;
		}

		if($permisos->result()[0]->url == $servicio2 || $permisos->result()[1]->url == $servicio2 || $permisos->result()[2]->url == $servicio2){
			$contador++;
		}

		if($permisos->result()[0]->url == $servicio3 || $permisos->result()[1]->url == $servicio3 || $permisos->result()[2]->url == $servicio3){
			$contador++;
		}
		return $contador;
	}

	//Funcion para borrar los datos del usuario de la session
	function cerrarSesionUsuarioInterno(){
		$this->session->unset_userdata('UserNameInternoSSCA');
		$this->session->unset_userdata('UserIDInternoSSCA');
		$this->session->unset_userdata('SegmentoCodigoModulo');
		$this->session->unset_userdata('SegmentoTextoModulo');
		$this->session->unset_userdata('permisos_usuarios_sistema_model');
		
	}

	//Funcion para obtener un usuario por su numero de documento
	function ObtenerUsuarioDocumento(){
		$resultado = $this->usuarios_sistema_model->obtenerUsuarioDocumento($_POST["documento"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			foreach ($resultado->result() as $value) {
				$value->Clave = base64_decode($value->Clave);
				$resultadoPermisos = $this->permisos_usuarios_sistema_model->obtenerPermisosUsuario($value->idUsuario);//Se llama a la funcion de que esta en modelo y el resultado se guarda
				if($resultadoPermisos != null){
					$value->permisos = json_encode($resultadoPermisos->result());
				}else{
					$value->permisos = json_encode(array());
				}				
			}
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para guardar el modulos seleccionado del menu en la session
	function MostrarServicios(){
		$this->load->library('../controllers/services');
		$this->session->set_userdata('SegmentoCodigoModulo', $_POST["id"]);	
		$this->session->set_userdata('SegmentoTextoModulo', $_POST["texto"]);			
	}
}