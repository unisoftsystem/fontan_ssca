<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Movimientos que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/

class Movimientos_model extends CI_Model
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
			'idCredencial' => $datos["idCredencial"],
			
			'ValorMovimiento' => $datos["ValorMovimiento"],
			'DescripcionMovimiento' => $datos["DescripcionMovimiento"],
			'OrigenPedido' => $datos["OrigenPedido"]);

		$this->db->set('FechaMovimiento', 'CURDATE()', FALSE);
		$this->db->set('HoraMovimiento', 'curTime()', FALSE);

		$this->db->insert('movimientos', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function ReportePedidos($fechaInicial, $fechaFinal){		
		$data = $this->db->query("
			SELECT movimientos.*, usuarios.* 
			FROM `movimientos` 
			INNER JOIN credenciales ON credenciales.idCredencial = movimientos.idCredencial 
			INNER JOIN usuarios ON credenciales.idUsuarioSecundario = usuarios.idUsuario 
			WHERE movimientos.`DescripcionMovimiento` 
			LIKE '%No. Pedido %' 
			AND movimientos.FechaMovimiento BETWEEN '$fechaInicial' 
			AND '$fechaFinal'
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function ReporteCaja($fechaInicial, $fechaFinal, $usuario){	
		if($usuario == "Todos"){
			$data = $this->db->query("
				SELECT us.*, m.ValorMovimiento, m.idCredencial, m.FechaMovimiento, m.HoraMovimiento, m.DescripcionMovimiento, usuarios_sistema.PrimerApellido AS PrimerApellido_sistema, usuarios_sistema.SegundoApellido AS SegundoApellido_sistema, usuarios_sistema.PrimerNombre AS PrimerNombre_sistema, usuarios_sistema.SegundoNombre AS SegundoNombre_sistema
				From movimientos m 
				INNER JOIN usuarios_sistema ON usuarios_sistema.idUsuario = m.idUsuario 
				INNER JOIN credenciales c ON c.idCredencial = m.idCredencial 
				INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario 
				WHERE (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') 
				AND (m.`DescripcionMovimiento`='Recargue Caja' OR m.`DescripcionMovimiento`='recargue monetario') 
				
			");
		}else{
			$data = $this->db->query("
				SELECT us.*, m.ValorMovimiento, m.idCredencial, m.FechaMovimiento, m.HoraMovimiento, m.DescripcionMovimiento, usuarios_sistema.PrimerApellido AS PrimerApellido_sistema, usuarios_sistema.SegundoApellido AS SegundoApellido_sistema, usuarios_sistema.PrimerNombre AS PrimerNombre_sistema, usuarios_sistema.SegundoNombre AS SegundoNombre_sistema
				From movimientos m 
				INNER JOIN usuarios_sistema ON usuarios_sistema.idUsuario = m.idUsuario 
				INNER JOIN credenciales c ON c.idCredencial = m.idCredencial 
				INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario 
				WHERE (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') 
				AND (m.`DescripcionMovimiento`='Recargue Caja' OR m.`DescripcionMovimiento`='recargue monetario') 
				AND m.idUsuario = '$usuario'
				
			");
		}
		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de devoluciones
	function ReporteDevoluciones($fechaInicial, $fechaFinal, $usuario){		
		$data = $this->db->query("
			SELECT us.*, 
				m.ValorMovimiento, 
				m.idCredencial, 
				m.FechaMovimiento, 
				m.HoraMovimiento, 
				m.DescripcionMovimiento 
			From movimientos m 
			INNER JOIN credenciales c ON c.idCredencial = m.idCredencial 
			INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario 
			WHERE (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') 
			AND m.`DescripcionMovimiento`='Devolucion Saldo' 
			AND m.idUsuario = '$usuario'
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de salidas
	function ReportePermisosSalidas($fechaInicial, $fechaFinal, $usuario){		
		$data = $this->db->query("
			SELECT us.*, p.Fecha, p.Hora, p.Observaciones 
			From permiso  p 
			INNER JOIN usuarios us ON us.idUsuario = p.idUsuario  
			WHERE (p.`Fecha` BETWEEN '$fechaInicial' AND '$fechaFinal') 
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de reversion pedidos
	function ReporteReversionPedidos($fechaInicial, $fechaFinal, $usuario){		
		$data = $this->db->query("
			SELECT 
				us.*,
				r.idPedido, 
				r.FechaCancelacion, 
				r.HoraCancelacion, 
				r.FechaEntrega, 
				r.HoraEntrega, 
				r.OrigenPedido 
			From reversionpedidos r 
			INNER JOIN credenciales c ON c.idCredencial = r.idCredencial 
			INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario  
			WHERE (r.`FechaCancelacion` BETWEEN '$fechaInicial' AND '$fechaFinal')  
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function ReporteMovimientos($fechaInicial, $fechaFinal, $usuario){		
		$data = $this->db->query("
			SELECT movimientos.*, us.* 
			From movimientos  
			INNER JOIN credenciales c ON c.idCredencial = movimientos.idCredencial 
			INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario 
			WHERE (movimientos.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') 
			AND movimientos.`idCredencial`='$usuario' 
			AND (movimientos.DescripcionMovimiento<>'costo de asignación de tarjeta nueva' 
			AND NOT movimientos.DescripcionMovimiento 
			LIKE '%No de pedido%' 
			AND movimientos.DescripcionMovimiento<>'cambio de credencial' 
			AND movimientos.DescripcionMovimiento<>'costo de asignaciÃ³n de tarjeta nueva')
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de saldos
	function ReporteSaldos(){	
		$this->db->select('credenciales.*, usuarios.* ');
		$this->db->from('credenciales');	
		$this->db->join('usuarios', "usuarios.idUsuario = credenciales.idUsuarioSecundario");
		$data = $this->db->get();
		return $data->result();
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function MostrarTotalPorDia($fecha, $idCredencial){		
		$data = $this->db->query("
			SELECT SUM(`ValorMovimiento`) AS Total 
			FROM `movimientos` 
			WHERE `idCredencial`='$idCredencial' 
			AND `DescripcionMovimiento` 
			LIKE '%No. Pedido%' 
			AND `FechaMovimiento`=CURDATE()
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener el movimiento de un pedido
	function ObtenerMovimiento($idPedido){		
		$data = $this->db->query("
			SELECT * 
			FROM `movimientos` 
			WHERE `DescripcionMovimiento` 
			LIKE CONCAT ('%No. Pedido ', $idPedido, '%')
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para crear un log de restaurante
	function borrarPedidoImpuesto($id){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error		
		$this->db->where("DescripcionMovimiento LIKE '%No de pedido: " . $id . ":%'");
		
		$this->db->delete("movimientos");  			
		
	}

	//Funcion para crear un log de restaurante
	function borrarPedido($id){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error		
		$this->db->where("DescripcionMovimiento LIKE '%No. Pedido " . $id . ":%'");
		
		$this->db->delete("movimientos");  		
		
	}
}