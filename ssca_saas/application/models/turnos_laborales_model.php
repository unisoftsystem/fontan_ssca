<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Movimientos que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/

class Turnos_laborales_model extends CI_Model
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
			'name' => $datos["nombre"],
			'idUsuario' => $datos["idUsuario"],
			'hora_inicio' => $datos["horainicio"],
			'hora_final' => $datos["horafinal"]);

		$this->db->set('date_create', 'CURDATE()', FALSE);
		$this->db->set('time_create', 'curTime()', FALSE);
		$this->db->insert('turnos_laborales', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
	}

	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'name' => $datos["nombre"],
			'hora_inicio' => $datos["horainicio"],
			'hora_final' => $datos["horafinal"]);
		$this->db->where('idUsuario', $datos["idUsuario"]);
		$this->db->update('turnos_laborales', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	function getTurno($idUsuario){
		$this->db->where("idUsuario", $idUsuario);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('turnos_laborales');//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	
}