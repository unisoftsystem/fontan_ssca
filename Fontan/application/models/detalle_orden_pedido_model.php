<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Orden de Pedido que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Detalle_orden_pedido_model extends CI_Model
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
			'idOrdenPedido' => $datos["idOrdenPedido"],
			'codigoProducto' => $datos["codigoProducto"],
			'cantidad' => $datos["cantidad"],
			'total' => $datos["total"]);
		$this->db->insert('Detalle_OrdenPedido', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	function get($codigoPedido){
		$data = $this->db->query("SELECT * FROM `Detalle_OrdenPedido` WHERE `idOrdenPedido`='$codigoPedido'");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	function getMinTiempoMaximoRevertir($codigoPedido){
		$min = "00:00:00";
		$data = $this->db->query("SELECT * FROM `Detalle_OrdenPedido` WHERE `idOrdenPedido`='$codigoPedido'");
		if($data->num_rows() > 0){
			foreach ($data->result() as $valorDetalle) {
				$dataProductos = $this->db->query("SELECT productos.* FROM `productos` WHERE productos.`codigoProducto`='" . $valorDetalle->codigoProducto . "'");
				$minHora = strtotime( $min );
				$horaMax = strtotime( $dataProductos->result()[0]->hora_maxima);

				if( $minHora < $horaMax ) {
				    $min = $dataProductos->result()[0]->hora_maxima;
				} 
				
			}
		}
		return $min;
	}

	//Funcion para crear un log de restaurante
	function borrarPedido($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error		
		$this->db->where('idOrdenPedido', $datos["id"]);
		$this->db->delete('Detalle_OrdenPedido');  			
		
	}
}