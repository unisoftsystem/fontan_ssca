<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Orden de Pedido que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Ordenpedido_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para Obtener el proximo turno
	function ObtenerTurno(){
		$turno = 0;
		$data = $this->db->query("SELECT * FROM `ordenpedido` WHERE `ConsecutivoTurno`!= 0 ORDER BY `id` DESC LIMIT 1");
		if($data->num_rows() > 0){
			if($data->result()[0]->ConsecutivoTurno < 100){
				$turno = $data->result()[0]->ConsecutivoTurno + 1;
			}else{
				$turno = 1;
			}
		}else{
			$turno = 1;
		}
		return $turno;
	}

	//Funcion para obtener el proximo id del pedido
	function ObtenerIdProximoPedido(){
		$id = 0;
		$data = $this->db->query("SELECT id FROM ordenpedido ORDER BY id DESC LIMIT 1");
		if($data->num_rows() > 0){
			$id = $data->result()[0]->id + 1;			
		}else{
			$id = 1;
		}
		return $id;
	}

	//Funcion para crear un pedido
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idUsuario' => $datos["idUsuario"],
			'idCredencial' => $datos["idCredencial"],
			'ConsecutivoTurno' => $datos["ConsecutivoTurno"],
			'ConsecutivoInterno' => $datos["ConsecutivoInterno"],
			'DescripcionPedido' => $datos["DescripcionPedido"],
			'UbicacionPedido' => $datos["UbicacionPedido"],
			'HoraEntrega' => $datos["HoraEntrega"],
			'FechaEntrega' => $datos["FechaEntrega"],
			'OrigenPedido' => $datos["OrigenPedido"]);
		$this->db->insert('ordenpedido', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		$this->db->select('MAX(id) AS id');
		$this->db->from('ordenpedido');
		$data = $this->db->get();
		if($data->num_rows() > 0) return $data->result()[0]->id;
		else return false;
	}

	//Funcion para generar un reporte agrupado por producto
	function ConsultaReporteCafeteriaDias($fechai, $fechaf){
		$array = array(array());
		$contadorFilas = 0;
		$json = "[";
		
		$data = $this->db->query("SELECT movimientos.*
			    FROM  `movimientos` 
			    WHERE movimientos.FechaMovimiento
			    BETWEEN  '$fechai' AND  '$fechaf'
			    AND movimientos.`DescripcionMovimiento` LIKE '%No. Pedido %' ");

		if($data->num_rows() > 0){
			foreach ($data->result() as $valueMovimiento) {
				$DescripcionMovimiento = $valueMovimiento->DescripcionMovimiento;
				$pedido = explode("No. Pedido ", $DescripcionMovimiento);
				$productos = $pedido[1]; // porción1

				$detalleProducto = explode(":", $productos);              
				$codigoPedido = $detalleProducto[0];

				$dataDetalleOrden = $this->db->query("SELECT * FROM `Detalle_OrdenPedido` WHERE `idOrdenPedido`='$codigoPedido'");

				foreach ($dataDetalleOrden->result() as $valorDetalle) {
					$dataProductos = $this->db->query("SELECT productos.*, categoria.Nombre AS NombreCategoria, `sub-categoria`.Nombre AS NombreSubCategoria FROM `productos` INNER JOIN categoria ON categoria.codigo = productos.Categoria INNER JOIN `sub-categoria` ON `sub-categoria`.codigo = productos.Subcategoria WHERE productos.`codigoProducto`='" . $valorDetalle->codigoProducto . "'");

					/*if($dataProductos != null){
						foreach ($dataProductos as $key) {
							$array[$contadorFilas][0] = $valorDetalle->codigoProducto;
							$contadorFilas++;
						}						
					}*/

					

					$fila = $this->existeProducto($array, $dataProductos->result()[0]->codigoProducto);
					if($fila != -1)	{
						$cantidadActual = $array[$fila][0] + $valorDetalle->cantidad;
						$subtotalActual = $array[$fila][5] + $valorDetalle->total;

						$array[$fila][0] += $valorDetalle->cantidad;
						$array[$fila][5] += $valorDetalle->total;

					}else{
						$array[$contadorFilas][0] = $valorDetalle->cantidad;
						$array[$contadorFilas][1] = $dataProductos->result()[0]->NombreProducto;
						$array[$contadorFilas][2] = $dataProductos->result()[0]->codigoProducto;
						$array[$contadorFilas][3] = $dataProductos->result()[0]->NombreCategoria;
						$array[$contadorFilas][4] = $dataProductos->result()[0]->NombreSubCategoria;
						$array[$contadorFilas][5] = $valorDetalle->total;

						$contadorFilas++;
					}
					/*$json .= json_encode($dataDetalleOrden->result());
					$json.= $fila . ",";*/
				}
			}	
			for($i=0;$i<count($array);$i++) {    
				if($array[$i][1] != ""){
					if($i == 0){
						$json .= '{"cantidad":"' . $array[$i][0] . '", "NombreProducto":"' . $array[$i][1] . '", "codigoProducto":"' . $array[$i][2] . '", "NombreCategoria":"' . $array[$i][3] . '", "NombreSubCategoria":"' . $array[$i][4] . '", "total":"' . $array[$i][5] . '"}';
						//$json .= '{"codigoProducto":"' . $array[$i][0] . '"}';
					}else{
						$json .= ',{"cantidad":"' . $array[$i][0] . '", "NombreProducto":"' . $array[$i][1] . '", "codigoProducto":"' . $array[$i][2] . '", "NombreCategoria":"' . $array[$i][3] . '", "NombreSubCategoria":"' . $array[$i][4] . '", "total":"' . $array[$i][5] . '"}';
						//$json .= ',{"codigoProducto":"' . $array[$i][0] . '"}';
					}

				}

			}
			$json .= "]";	
		}
		
		return $json;
	}

	function existeProducto($array, $codigo){
	  $resultado = -1;
	  for($i=0;$i<count($array);$i++) {
	  	if($array[$i]){
		    if($array[$i][2] == $codigo){
		      $resultado = $i;
		    }    
		  }
		}
	  return $resultado;
	}

	//Funcion para crear un log de restaurante
	function crearLog($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error

		//fecha y hora para el insert
		$fechain = date("d/m/Y");
		$horain  = date("H:i:s");

		$array = array(
			'documento' => $datos["idCredencial"],
			'fecha' => $fechain,
			'hora' => $horain,
			'mensaje' => $datos["mensaje"]);
		$this->db->insert('log_restaurante', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para obtener los pedidos a revertir
	function PedidosaRevertir($numeroId){
		$datos = $this->db->query("SELECT ordenpedido.*, movimientos.*, usuarios.PrimerNombre, usuarios.SegundoNombre, usuarios.PrimerApellido, usuarios.SegundoApellido FROM ordenpedido INNER JOIN usuarios ON usuarios.idUsuario =  ordenpedido.idUsuario INNER JOIN movimientos ON movimientos.`DescripcionMovimiento` LIKE CONCAT ('%No. Pedido ', ordenpedido.`ConsecutivoInterno`, '%') AND movimientos.`FechaMovimiento` = CURDATE() WHERE usuarios.NumeroId = '$numeroId' AND ordenpedido.FechaEntrega = '0000-00-00'");

		/*$datos = $this->db->query("(SELECT ordenpedido.*, movimientos.*, usuarios.PrimerNombre, usuarios.SegundoNombre, usuarios.PrimerApellido, usuarios.SegundoApellido FROM ordenpedido INNER JOIN usuarios ON usuarios.idUsuario =  ordenpedido.idUsuario INNER JOIN movimientos ON movimientos.`DescripcionMovimiento` LIKE CONCAT ('%No. Pedido ', ordenpedido.`ConsecutivoInterno`, '%') AND movimientos.`FechaMovimiento` = CURDATE() WHERE usuarios.NumeroId = '$numeroId' AND ordenpedido.FechaEntrega = '0000-00-00') UNION (SELECT ordenpedido.*, movimientos.*, usuarios.PrimerNombre, usuarios.SegundoNombre, usuarios.PrimerApellido, usuarios.SegundoApellido FROM ordenpedido INNER JOIN usuarios ON usuarios.idUsuario =  ordenpedido.idUsuario INNER JOIN movimientos ON movimientos.`DescripcionMovimiento` LIKE CONCAT ('%No. Pedido ', ordenpedido.`ConsecutivoInterno`, '%') WHERE usuarios.NumeroId = '$numeroId' AND ordenpedido.FechaEntrega = CURDATE())");*/
		
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	//Funcion para obtener los pedidos a revertir
	function PedidosaRevertirPlanificados($numeroId){
		$datos = $this->db->query("SELECT ordenpedido.*, movimientos.*, usuarios.PrimerNombre, usuarios.SegundoNombre, usuarios.PrimerApellido, usuarios.SegundoApellido FROM ordenpedido INNER JOIN usuarios ON usuarios.idUsuario =  ordenpedido.idUsuario INNER JOIN movimientos ON movimientos.`DescripcionMovimiento` LIKE CONCAT ('%No. Pedido ', ordenpedido.ConsecutivoInterno, '%') WHERE usuarios.NumeroId = '$numeroId' AND ordenpedido.FechaEntrega = CURDATE()");
		
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	//Funcion para crear un log de restaurante
	function borrarPedido($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error		
		$this->db->where('ConsecutivoInterno', $datos["id"]);
		$this->db->delete('ordenpedido');  			
		
	}

	
	
}
