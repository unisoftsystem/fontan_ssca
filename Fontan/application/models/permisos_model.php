<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Movimientos que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/

class Permisos_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear un pedido
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idUsuario' => $datos["idUsuario"],
			'Observaciones' => $datos["Observaciones"],
			'Fecha' => $datos["Fecha"],
			'Hora' => $datos["Hora"],
			'Tipo' => $datos["Tipo"],
			'Estado' => "ACTIVO");

		$this->db->insert('permiso', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para obtener el saldo actual de una credencial
	function getPermiso($usuario, $fecha, $tipo, $hora = NULL){

		$sql = sprintf("SELECT * FROM `permiso` WHERE `idUsuario`='%s' AND `Fecha`= '%s'", $usuario, $fecha);
		$sql .= ($hora != NULL) ? sprintf(" AND `Hora` <= '%s'", $hora) : "";
		$sql .= sprintf(" AND `Estado`='ACTIVO' AND `Tipo`= '%s' ORDER BY `Fecha`, `Hora` DESC LIMIT 1", $tipo);
		$data = $this->db->query($sql);

		if($data->num_rows() > 0) return $data;
		else return false;
	}
}