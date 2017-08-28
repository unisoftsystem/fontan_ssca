<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Usuarios del Sistema que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Usuarios_sistema_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear un usuario del sistema
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idUsuario' => $datos["idUsuario"],
			'TipoId' => $datos["TipoId"],
			'NumeroId' => $datos["NumeroId"],
			'PrimerApellido' => $datos["PrimerApellido"],
			'SegundoApellido' => $datos["SegundoApellido"],
			'PrimerNombre' => $datos["PrimerNombre"],
			'SegundoNombre' => $datos["SegundoNombre"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'Direccion' => $datos["Direccion"],
			'Telefono1' => $datos["Telefono1"],
			'Telefono2' => $datos["Telefono2"],
			'Estado' => $datos["Estado"],
			'Clave' => $datos["Clave"]);
		$this->db->insert('usuarios_sistema', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}
	
	//Funcion para listar todos los usuarios
	function listarUsuarios(){
		$data = $this->db->get('usuarios_sistema');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}
	//Funcion para editar un usuario del sistema
	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idUsuario' => $datos["idUsuario"],
			'TipoId' => $datos["TipoId"],
			'PrimerApellido' => $datos["PrimerApellido"],
			'SegundoApellido' => $datos["SegundoApellido"],
			'PrimerNombre' => $datos["PrimerNombre"],
			'SegundoNombre' => $datos["SegundoNombre"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'Direccion' => $datos["Direccion"],
			'Telefono1' => $datos["Telefono1"],
			'Telefono2' => $datos["Telefono2"],
			'Estado' => $datos["Estado"],
			'Clave' => $datos["Clave"]);
		$this->db->where('NumeroId', $datos["NumeroId"]);
		$this->db->update('usuarios_sistema', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para editar un usuario del sistema
	function asignar_co($idUsuario, $tipo){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'tipo' => $tipo);

		$this->db->where('idUsuario', $idUsuario);
		$this->db->update('usuarios_sistema', $array);
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su userid
	function existeUsuario($userid){
		$this->db->where("idUsuario", $userid);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios_sistema');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su numero de id
	function existeDocumentoUsuario($documento){
		$this->db->where("NumeroId", $documento);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios_sistema');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para Iniciar sesion con un usuario del sistema
	function login($datos){
		$this->db->where("idUsuario", $datos["user"]);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->where("Clave", $datos["pass"]);//Al agregar un where() seguido de otro where() se unen en la consulta con un AND
		$result = $this->db->get('usuarios_sistema');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function obtenerUsuarioDocumento($documento){
		$this->db->where("NumeroId", $documento);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios_sistema');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario Centro de Operaciones
	function obtenerUsuarioCO(){
		$this->db->where("Tipo", "CO");//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios_sistema');//El metodo get sirve para realizar un SELECT en la bd.
    	return $result->result();
	}
}