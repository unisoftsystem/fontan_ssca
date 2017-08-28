<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Vehiculo que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Vehiculo_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear un vehiculo
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'marca' => $datos["marca"],
			'categoria' => $datos["categoria"],
			'placa' => $datos["placa"],
			'nombre_ruta' => $datos["ruta"],
			'sillas' => $datos["sillas"],
			'observaciones' => $datos["observaciones"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'coordenadas' => $datos["coordenadas"]);

		$this->db->insert('vehiculo', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para editar un vehiculo
	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'marca' => $datos["marca"],
			'categoria' => $datos["categoria"],
			'nombre_ruta' => $datos["ruta"],
			'sillas' => $datos["sillas"],
			'observaciones' => $datos["observaciones"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'coordenadas' => $datos["coordenadas"]);

		$this->db->where('placa', $datos["placa"]);
		$this->db->update('vehiculo', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su numero de id
	function existeVehiculoPlaca($placa){
		$this->db->where("placa", $placa);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('vehiculo');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su numero de id
	function getVehiculoPlaca($placa){
		$this->db->where("placa", $placa);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('vehiculo');//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su numero de id
	function getVehiculoID($id){
		$this->db->where("idvehiculo", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$data = $this->db->get('vehiculo');//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los monitores sin asignarles ruta
	function listar(){
		$data = $this->db->query("SELECT vehiculo.* FROM vehiculo WHERE (SELECT COUNT(*) FROM `asignacionruta` WHERE asignacionruta.`idruta` = vehiculo.idvehiculo) = 0");
		if($data->num_rows() > 0) return $data;
		else return false;	
	}

	//Funcion para listar todos los monitores sin asignarles ruta
	function listarTodos(){
		$data = $this->db->query("SELECT vehiculo.* FROM vehiculo ORDER BY categoria ASC, placa ASC");
		if($data->num_rows() > 0) return $data;
		else return false;	
	}

	//Funcion para listar todos los monitores con rutas asignadas
	function listarConRuta(){
		$data = $this->db->query("SELECT vehiculo.* FROM vehiculo WHERE (SELECT COUNT(*) FROM `asignacionruta` WHERE asignacionruta.`idruta` = vehiculo.idvehiculo) != 0");
		if($data->num_rows() > 0) return $data;
		else return false;	
	}

	//Funcion para listar todos los monitores
	function ValidarHoras($hora_inicio, $hora_final, $fecha, $idvehiculo){
		$estado = true;

  		$query_select_existe = "SELECT * FROM `datoscalendario` INNER JOIN vehiculo ON datoscalendario.vehiculo = vehiculo.idvehiculo WHERE (datoscalendario.`fecha` = '$fecha') AND (datoscalendario.horainicial = '$hora_inicio' AND datoscalendario.horafinal = '$hora_final') AND datoscalendario.vehiculo = '$idvehiculo'";
  		
  		$query_select_entre = "SELECT * FROM `datoscalendario` INNER JOIN vehiculo ON datoscalendario.vehiculo = vehiculo.idvehiculo WHERE (('$hora_inicio' > datoscalendario.`horainicial` AND '$hora_inicio' < datoscalendario.`horafinal`) OR ('$hora_final' > datoscalendario.`horainicial` AND '$hora_final' < datoscalendario.`horafinal`)) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.vehiculo = '$idvehiculo'";

  		$query_select_antes_despues = "SELECT * FROM `datoscalendario` INNER JOIN vehiculo ON datoscalendario.vehiculo = vehiculo.idvehiculo WHERE ((datoscalendario.`horainicial` > '$hora_inicio' AND datoscalendario.`horainicial` < '$hora_final') OR (datoscalendario.`horafinal` > '$hora_inicio' AND datoscalendario.`horafinal` < '$hora_final')) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.vehiculo = '$idvehiculo'";

  		$data_select_existe = $this->db->query($query_select_existe);
  		$data_select_entre = $this->db->query($query_select_entre);
  		$data_select_antes_despues = $this->db->query($query_select_antes_despues);
  		
  		if($data_select_existe->num_rows() > 0 || $data_select_entre->num_rows() > 0 || $data_select_antes_despues->num_rows() > 0){
  			$estado = false;
	  	}else{
	  		$estado = true;
	  	}
		return $estado;
	}

	//Funcion para listar todos los monitores
	function ValidarHorasEditar($hora_inicio, $hora_final, $fecha, $idvehiculo, $idruta){
		$estado = true;

  		$query_select_existe = "SELECT * FROM `datoscalendario` INNER JOIN vehiculo ON datoscalendario.vehiculo = vehiculo.idvehiculo WHERE (datoscalendario.`fecha` = '$fecha') AND (datoscalendario.horainicial = '$hora_inicio' AND datoscalendario.horafinal = '$hora_final') AND datoscalendario.vehiculo = '$idvehiculo' AND datoscalendario.idruta != '$idruta'";
  		
  		$query_select_entre = "SELECT * FROM `datoscalendario` INNER JOIN vehiculo ON datoscalendario.vehiculo = vehiculo.idvehiculo WHERE (('$hora_inicio' > datoscalendario.`horainicial` AND '$hora_inicio' < datoscalendario.`horafinal`) OR ('$hora_final' > datoscalendario.`horainicial` AND '$hora_final' < datoscalendario.`horafinal`)) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.vehiculo = '$idvehiculo' AND datoscalendario.idruta != '$idruta'";

  		$query_select_antes_despues = "SELECT * FROM `datoscalendario` INNER JOIN vehiculo ON datoscalendario.vehiculo = vehiculo.idvehiculo WHERE ((datoscalendario.`horainicial` > '$hora_inicio' AND datoscalendario.`horainicial` < '$hora_final') OR (datoscalendario.`horafinal` > '$hora_inicio' AND datoscalendario.`horafinal` < '$hora_final')) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.vehiculo = '$idvehiculo' AND datoscalendario.idruta != '$idruta'";

  		$data_select_existe = $this->db->query($query_select_existe);
  		$data_select_entre = $this->db->query($query_select_entre);
  		$data_select_antes_despues = $this->db->query($query_select_antes_despues);
  		
  		if($data_select_existe->num_rows() > 0 || $data_select_entre->num_rows() > 0 || $data_select_antes_despues->num_rows() > 0){
  			$estado = false;
	  	}else{
	  		$estado = true;
	  	}
		return $estado;
	}
	
}