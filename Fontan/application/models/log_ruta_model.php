<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_ruta_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_registro_estudiantes_bitacora()
	{
		$sql = sprintf("SELECT a.mensaje, a.hora, a.tipo, b.PrimerApellido, b.SegundoApellido, b.PrimerNombre, b.SegundoNombre
			FROM log_ruta a
			inner join usuarios b
			on b.idUsuario = a.idestudiante
			WHERE idruta = '%s' 
			and fecha = '%s'
			and idestudiante in 
			(SELECT idUsuario FROM usuarios WHERE NumeroId IN (SELECT valores FROM cart WHERE ruta = '%s'))",
			$_POST['idruta'], 
			$_POST['fecha'], 
			$_POST['idruta'] 
		);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}