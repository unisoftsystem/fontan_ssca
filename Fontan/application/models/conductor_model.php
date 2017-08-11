<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Categoria que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Conductor_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear una categoria
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idconductor' => $datos["idconductor"],
			'nombre' => $datos["nombre"],
			'apellido' => $datos["apellido"],
			'telefono' => $datos["telefono"],
			'TipoUsuario' => "Conductor",
			'TipoId' => $datos["TipoId"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'direccion' => $datos["Direccion"],
			'Estado' => "ACTIVO",
			'Coordenadas' => $datos["Coordenadas"],
			'TipoSangre' => $datos["TipoSangre"],
			'arl' => $datos["arl"]);
		$this->db->insert('conductor', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
		
	}

	//Funcion para editar una categoria
	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'nombre' => $datos["nombre"],
			'apellido' => $datos["apellido"],
			'telefono' => $datos["telefono"],
			'TipoUsuario' => "Conductor",
			'TipoId' => $datos["TipoId"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'direccion' => $datos["Direccion"],
			'Estado' => "ACTIVO",
			'Coordenadas' => $datos["Coordenadas"],
			'TipoSangre' => $datos["TipoSangre"],
			'arl' => $datos["arl"]);
		$this->db->where('idconductor', $datos["idconductor"]);
		$this->db->update('conductor', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para listar todos las categorias
	function get($idmonitor){
		$data = $this->db->query("SELECT m.*, c.* FROM `monitor` m INNER JOIN credenciales c ON c.idUsuarioSecundario = m.idMonitor WHERE m.`idmonitor`='$idmonitor'");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las categorias
	function getConductorDoc($idconductor){
		$data = $this->db->query("SELECT usuarios.*, credenciales.* FROM `usuarios` INNER JOIN conductor ON conductor.idconductor = usuarios.NumeroId INNER JOIN credenciales ON credenciales.idUsuarioSecundario = usuarios.idUsuario WHERE conductor.`idconductor`='$idconductor'");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los monitores sin asignarles ruta
	function listar(){
		$data = $this->db->query("SELECT conductor.* FROM conductor WHERE (SELECT COUNT(*) FROM `asignacionruta` WHERE asignacionruta.`id_conductor` = conductor.idconductor) = 0");
		if($data->num_rows() > 0) return $data;
		else return false;	
	}

	//Funcion para listar todos los monitores sin asignarles ruta
	function listarTodos(){
		$data = $this->db->query("SELECT conductor.* FROM conductor ORDER BY nombre ASC, apellido ASC");
		if($data->num_rows() > 0) return $data;
		else return false;	
	}

	//Funcion para listar todos los monitores con rutas asignadas
	function listarConRuta(){
		$data = $this->db->query("SELECT conductor.* FROM conductor WHERE (SELECT COUNT(*) FROM `asignacionruta` WHERE asignacionruta.`id_conductor` = conductor.idconductor) != 0");
		if($data->num_rows() > 0) return $data;
		else return false;	
	}

	//Funcion para listar todos los monitores
	function ValidarHoras($hora_inicio, $hora_final, $fecha, $idconductor){
		$estado = true;

  		$query_select_existe = "SELECT * FROM `datoscalendario` INNER JOIN conductor ON datoscalendario.id_conductor = conductor.idconductor WHERE (datoscalendario.`fecha` = '$fecha') AND (datoscalendario.horainicial = '$hora_inicio' AND datoscalendario.horafinal = '$hora_final') AND datoscalendario.id_conductor = '$idconductor'";
  		
  		$query_select_entre = "SELECT * FROM `datoscalendario` INNER JOIN conductor ON datoscalendario.id_conductor = conductor.idconductor WHERE (('$hora_inicio' > datoscalendario.`horainicial` AND '$hora_inicio' < datoscalendario.`horafinal`) OR ('$hora_final' > datoscalendario.`horainicial` AND '$hora_final' < datoscalendario.`horafinal`)) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.id_conductor = '$idconductor'";

  		$query_select_antes_despues = "SELECT * FROM `datoscalendario` INNER JOIN conductor ON datoscalendario.id_conductor = conductor.idconductor WHERE ((datoscalendario.`horainicial` > '$hora_inicio' AND datoscalendario.`horainicial` < '$hora_final') OR (datoscalendario.`horafinal` > '$hora_inicio' AND datoscalendario.`horafinal` < '$hora_final')) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.id_conductor = '$idconductor'";

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
	function ValidarHorasEditar($hora_inicio, $hora_final, $fecha, $idconductor, $idruta){
		$estado = true;

  		$query_select_existe = "SELECT * FROM `datoscalendario` INNER JOIN conductor ON datoscalendario.id_conductor = conductor.idconductor WHERE (datoscalendario.`fecha` = '$fecha') AND (datoscalendario.horainicial = '$hora_inicio' AND datoscalendario.horafinal = '$hora_final') AND datoscalendario.id_conductor = '$idconductor' AND datoscalendario.idruta != '$idruta'";
  		
  		$query_select_entre = "SELECT * FROM `datoscalendario` INNER JOIN conductor ON datoscalendario.id_conductor = conductor.idconductor WHERE (('$hora_inicio' > datoscalendario.`horainicial` AND '$hora_inicio' < datoscalendario.`horafinal`) OR ('$hora_final' > datoscalendario.`horainicial` AND '$hora_final' < datoscalendario.`horafinal`)) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.id_conductor = '$idconductor' AND datoscalendario.idruta != '$idruta'";

  		$query_select_antes_despues = "SELECT * FROM `datoscalendario` INNER JOIN conductor ON datoscalendario.id_conductor = conductor.idconductor WHERE ((datoscalendario.`horainicial` > '$hora_inicio' AND datoscalendario.`horainicial` < '$hora_final') OR (datoscalendario.`horafinal` > '$hora_inicio' AND datoscalendario.`horafinal` < '$hora_final')) AND (datoscalendario.`fecha` = '$fecha') AND datoscalendario.id_conductor = '$idconductor' AND datoscalendario.idruta != '$idruta'";

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