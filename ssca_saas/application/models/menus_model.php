<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Categoria que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Menus_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear un menu del dia
	function crearMenuDia($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'Nombre' => $datos["Nombre"],
			'idProteina' => $datos["idProteina"],
			'Descripcion' => $datos["Descripcion"],
			
			'Dia' => $datos["Dia"],
			'Foto' => $datos["Foto"],
			'Edad' => $datos["Edad"]);

		$this->db->insert('menudia', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para crear un menu del dia
	function crearMenuEspecial($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'Nombre' => $datos["Nombre"],
			'Valor' => $datos["Valor"],
			'Descripcion' => $datos["Descripcion"],
			'Dia' => $datos["Dia"],
			
			'Foto' => $datos["Foto"]);

		$this->db->insert('menuespecial', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para editar un menu del dia
	function editarMenuDia($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'Nombre' => $datos["Nombre"],
			'idProteina' => $datos["idProteina"],
			'Descripcion' => $datos["Descripcion"],
			'Foto' => $datos["Foto"],
			'Edad' => $datos["Edad"]);
		$this->db->where('Dia', $datos["Dia"]);
		
		$this->db->update('menudia', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para editar un menu del dia
	function editarMenuEspecial($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'Nombre' => $datos["Nombre"],
			'Valor' => $datos["Valor"],
			'Descripcion' => $datos["Descripcion"],
			'Dia' => $datos["Dia"],
			'Foto' => $datos["Foto"]);

		$this->db->where('Dia', $datos["Dia"]);
		
		$this->db->update('menuespecial', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para listar todos las bodegas
	function listarMenuDias(){
		$data = $this->db->query("
			SELECT m.*, p.Descripcion AS Proteina 
			FROM `menudia` m 
			INNER JOIN proteinas p on p.id = m.`idProteina`  
			
			ORDER BY `Dia` ASC");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las bodegas
	function listarMenuEspecial(){
		$data = $this->db->query("
			SELECT * 
			FROM `menuespecial`   
			
			ORDER BY `Dia` ASC");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las bodegas
	function getMenuDia($dia){
		
		$this->db->where("Dia", $dia);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('menudia');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las bodegas
	function existeMenuDia($dia){
		
		$this->db->where("Dia", $dia);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('menudia');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data->num_rows();
		else return 0;
	}

	//Funcion para listar todos las bodegas
	function existeMenuEspecial($dia){
		
		$this->db->where("Dia", $dia);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('menuespecial');//El metodo get sirve para realizar un SELECT en la bd. Si solo esta esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data->num_rows();
		else return 0;
	}
}