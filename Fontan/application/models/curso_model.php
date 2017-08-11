<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Categoria que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Curso_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear una categoria
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'Descripcion' => $datos["Descripcion"]);

		$this->db->insert('cursos', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para listar todos las bodegas
	function listarCursos(){
		$data = $this->db->query("SELECT `id`, `Descripcion` FROM `cursos`");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su numero de id
	function existeCurso($nombre){
		$this->db->where("Descripcion", $nombre);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('cursos');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para listar todos las bodegas
	function get($id){
		$data = $this->db->query("SELECT `id`, `Descripcion` FROM `cursos` WHERE `id` = '$id'");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data->result()[0]->Descripcion;
		else return false;
	}
}