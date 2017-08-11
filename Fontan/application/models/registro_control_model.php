<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Movimientos que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/

class Registro_control_model extends CI_Model
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
			'Tipo' => $datos["Tipo"],
			'Observacion' => $datos["Observacion"]);

		$this->db->set('Fecha', 'CURDATE()', FALSE);
		$this->db->set('Hora', 'curTime()', FALSE);

		$this->db->insert('registrocontrol', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function ReporteSinDoc($fechaInicial, $fechaFinal, $tipo){		
		$data = $this->db->query("
			SELECT rc.*, u.* 
			FROM registrocontrol rc 
			inner join usuarios u on u.idUsuario = rc.idUsuario 
			WHERE (rc.Fecha BETWEEN '$fechaInicial' AND '$fechaFinal') 
			AND (u.TipoUsuario = '$tipo') 
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}
	//Funcion para generar un reporte de ventas a contabilidad
	function existeRegistro($idCredencial, $tipo){		
		$data = $this->db->query("
			SELECT registrocontrol.* 
			FROM registrocontrol 
			WHERE registrocontrol.`Fecha` = CURDATE() 
			AND registrocontrol.`Tipo` = '$tipo' 
			AND registrocontrol.`idCredencial` = '$idCredencial'
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function ReporteConDoc($fechaInicial, $fechaFinal, $tipo, $numeroID){		
		$data = $this->db->query("
			SELECT rc.*, u.* 
			FROM registrocontrol rc 
			inner join usuarios u on u.idUsuario = rc.idUsuario 
			WHERE (rc.Fecha BETWEEN '$fechaInicial' AND '$fechaFinal') 
			AND (u.TipoUsuario = '$tipo') 
			AND (u.NumeroId='$numeroID')
			
		");
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para generar un reporte de ventas a contabilidad
	function ExisteEntradaUltima($idCredencial){	
		$existe = false;	
		$data = $this->db->query("
			SELECT * 
			FROM  `registrocontrol` 
			WHERE  `idCredencial` = '$idCredencial' 
			AND Fecha = CURDATE() 
			
			ORDER BY `idControl` DESC LIMIT 1
		");

		if($data->num_rows() > 0){				
			foreach ($data->result() as $value) {
				if($value->Tipo == "ENTRADA"){
					$existe = true;
				}							
			}
			
		}
		return $existe;
	}

	
}