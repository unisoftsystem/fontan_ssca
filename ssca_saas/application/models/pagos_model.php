<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Pagos que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/

class Pagos_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para el pago del restaurante de un estudiante
	function ConsultarPagoRestaurante($numero_identificacion, $tipo_servicio){		
		$data = $this->db->query("
			SELECT * 
			FROM asignacion_servicios 
			where numero_identificacion='$numero_identificacion' 
			AND estado='cancelado' 
			AND tipo_servicio='$tipo_servicio'
			
		");
		if($data->num_rows() > 0) return $data->num_rows();
		else return false;
	}
}