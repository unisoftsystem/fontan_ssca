<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Modulo que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Modulo_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para listar todos los modulos
	function listar(){
		$data = $this->db->get('modulos');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los submodulos
	function listarSubModulos($id){
		$this->db->where("idModulo", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('submodulos');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los modulos con servicios asignados
	function listarModulosConServicios(){
		$this->db->select('modulos.*');
		$this->db->from('modulos');		
		$this->db->group_by("modulos.id"); 
		$this->db->join('servicios_sistema', "servicios_sistema.modulo = modulos.id");
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los servicios asignados por el id del modulo
	function listarServiciosAsignadosPorModulo($id){
		$this->db->select('subservicios.*');
		$this->db->from('modulos');		
		$this->db->where("modulos.id", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->join('servicios_sistema', "servicios_sistema.modulo = modulos.id");
		$this->db->join('subservicios', "subservicios.id = servicios_sistema.accion");
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los submodulos
	function listarServicios($id){
		$this->db->where("idSubmodulo", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('subservicios');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para crear un requerimiento
	function crearServicio($datos){
		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'accion' => $datos["servicesid"],
			'modulo' => $datos["moduleid"],
			'submodulo' => $datos["submodule"]);
		$this->db->insert('servicios_sistema', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo					
	}
}