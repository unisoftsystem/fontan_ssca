<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Categoria que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Proteinas_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear una proteina
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'Descripcion' => $datos["Nombre"],
			'color' => $datos["color"]);

		$this->db->insert('proteinas', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		$this->db->select('MAX(id) AS id');
		$this->db->from('proteinas');
		$data = $this->db->get();
		if($data->num_rows() > 0) return $data->result()[0]->id;
		else return false;
	}

	//Funcion para listar todos las bodegas
	function listar(){
		$data = $this->db->get('proteinas');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su userid
	function ExisteProteina($Descripcion){
		$this->db->where("Descripcion", $Descripcion);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('proteinas');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}
}