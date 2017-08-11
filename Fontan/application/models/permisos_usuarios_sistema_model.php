<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Permisos de Usuarios que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Permisos_usuarios_sistema_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear permisos de usuarios
	function crear($datos){
		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'userid' => $datos["usuario"],
			'service_id' => $datos["idServicio"],
			'status' => 'ACTIVO');
		$this->db->set('registration_date', 'CURDATE()', FALSE);
		$this->db->set('registration_time', 'curTime()', FALSE);
		$this->db->insert('user_permission', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
	}

	//Funcion para listar todos los servicios asignados por el id del usuario
	function listarModuloAsignadosPorUsuario($idUsuario){
		$this->db->select('modulos.*');
		$this->db->from('modulos');		
		$this->db->where("user_permission.userid", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->group_by("modulos.id"); 
		$this->db->join('servicios_sistema', "servicios_sistema.modulo = modulos.id");
		$this->db->join('user_permission', "servicios_sistema.accion = user_permission.service_id");
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los servicios asignados por el id del modulo
	function listarSubModuloAsignadosPorUsuario($id, $idUsuario){
		$this->db->select('submodulos.*');
		$this->db->from('modulos');		
		$this->db->where("user_permission.userid", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->where("modulos.id", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero	
		$this->db->join('servicios_sistema', "servicios_sistema.modulo = modulos.id");		
		$this->db->join('user_permission', "servicios_sistema.accion = user_permission.service_id");
		$this->db->join('submodulos', "servicios_sistema.submodulo = submodulos.id");
		$this->db->group_by("submodulos.id"); 
		$this->db->order_by("submodulos.id", "asc"); 
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los servicios asignados por el id del modulo
	function listarServiciosdelUsuario($id, $idUsuario){
		$this->db->select('subservicios.*');
		$this->db->from('submodulos');		
		$this->db->where("user_permission.userid", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->where("submodulos.id", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->join('servicios_sistema', "servicios_sistema.submodulo = submodulos.id");
		$this->db->join('user_permission', "servicios_sistema.accion = user_permission.service_id");
		$this->db->join('subservicios', "subservicios.id = user_permission.service_id");
		$this->db->order_by("user_permission.id", "asc"); 
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar si el usuario interno que inicia sesion es un cajero
	function verificarUsuarioCajeroSesion($idUsuario){
		$this->db->select('subservicios.*');
		$this->db->from('modulos');		
		$this->db->where("user_permission.userid", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->join('servicios_sistema', "servicios_sistema.modulo = modulos.id");
		$this->db->join('user_permission', "servicios_sistema.accion = user_permission.service_id");
		$this->db->join('subservicios', "subservicios.id = user_permission.service_id");
		$this->db->order_by("user_permission.id", "asc"); 
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar la pagina actual con los permisos
	function verificarPagina($pagina, $idUsuario){
		$this->db->select('subservicios.*');
		$this->db->from('user_permission');	
		$this->db->where("user_permission.userid", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero	
		$this->db->where("subservicios.url", $pagina);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero	
		$this->db->join('servicios_sistema', "servicios_sistema.accion = user_permission.service_id");
		$this->db->join('subservicios', "subservicios.id = user_permission.service_id");
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data->num_rows();
		else return 0;
	}

	//Funcion para verificar la pagina actual con los permisos
	function listarUsuariosPorPermiso($pagina){
		$this->db->select('usuarios_sistema.*');
		$this->db->from('user_permission');			
		$this->db->where("subservicios.url", $pagina);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero	
		$this->db->join('servicios_sistema', "servicios_sistema.accion = user_permission.service_id");
		$this->db->join('subservicios', "subservicios.id = user_permission.service_id");
		$this->db->join('usuarios_sistema', "usuarios_sistema.idUsuario = user_permission.userid");
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return 0;
	}

	//Funcion para verificar la existencia permisos de un usuario en la bd buscandolo por su id
	function obtenerPermisosUsuario($idUsuario){
		$this->db->where("userid", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('user_permission');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	//Funcion para borrar los permisos de los usuarios
	function borrarPermisosUsuario($idUsuario){
		$this->db->where('userid', $idUsuario);
		$this->db->delete('user_permission');  
	}

}