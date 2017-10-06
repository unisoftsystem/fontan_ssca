<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Reversion de Pedidos que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/

class Reversion_pedido_model extends CI_Model
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
			'idPedido' => $datos["idPedido"],
			'idCredencial' => $datos["idCredencial"],
			'FechaEntrega' => $datos["FechaEntrega"],
			'HoraEntrega' => $datos["HoraEntrega"],
			'OrigenPedido' => $datos["OrigenPedido"],
			'Productos' => $datos["DescripcionMovimiento"],
			'Turno' => $datos["turno"],
			'Total' => $datos["total"],
			'Fechapedido' => $datos["fechapedido"],
			'Horapedido' => $datos["horaspedido"]);

		$this->db->set('FechaCancelacion', 'CURDATE()', FALSE);
		$this->db->set('HoraCancelacion', 'curTime()', FALSE);

		$this->db->insert('reversionpedidos', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}
}