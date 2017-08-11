<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Vehiculo que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Rutas_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}


	// RETURN IF IS A DINAMIC ROUTE
	function is_dinamic_route($id_route = 0)
	{	
		$this->db->select('ruta_dinamica');
		$this->db->from('asignacionruta');
		$this->db->where('idruta', $id_route);
		$query = $this->db->get();
		return $query->result();
	} 

	//Funcion para crear una ruta
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idruta' => $datos["vehiculo"],
			'nombreruta' => $datos["nombreruta"],
			'monitor' => $datos["monitor"],
			'id_conductor' => $datos["conductor"],
			'latorigen' => $datos["latorigen"],
			'longorigen' => $datos["longorigen"],
			'latdestino' => $datos["latdestino"],
			'longdestino' => $datos["longdestino"],
			'color' => $datos["color"],
			
			'repetir' => $datos["repetir"],
			'horainicial' => $datos["horainicial"],
			'horafinal' => $datos["horafinal"],
			'fechainicial' => $datos["fechainicial"],
			'ruta_dinamica' => $datos["ruta_dinamica"],
			'fechafinal' => $datos["fechafinal"]);


		$this->db->insert('asignacionruta', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo		
		$this->db->select('MAX(id) AS id');
		$this->db->from('asignacionruta');
		
		$data = $this->db->get();
		if($data->num_rows() > 0) return $data->result()[0]->id;
		else return false;		
	}

	//Funcion para crear una ruta
	function crear_observacion($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'id_usuario' => $datos["usuario"],
			'fecha_observacion' => $datos["fecha"],
			'tipo' => $datos["tipo"],
			'id_ruta' => $datos["id_ruta"],
			'observacion' => $datos["observacion"],
			'direccion' => $datos["direccion"],
			'coordenadas' => $datos["coordenadas"],
			'id_usuario_session' => $datos["usuario_session"]);
		$this->db->insert('observaciones_rutas', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
	}

	//Funcion para crear una ruta
	function crearDatosCalendario($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idruta' => $datos["idruta"],
			'vehiculo' => $datos["vehiculo"],
			
			'nombreruta' => $datos["nombreruta"],
			'monitor' => $datos["monitor"],
			'id_conductor' => $datos["conductor"],
			'latorigen' => $datos["latorigen"],
			'longorigen' => $datos["longorigen"],
			'latdestino' => $datos["latdestino"],
			'longdestino' => $datos["longdestino"],
			'color' => $datos["color"],
			'repetir' => $datos["repetir"],
			'horainicial' => $datos["horainicial"],
			'horafinal' => $datos["horafinal"],
			'fecha' => $datos["fecha"]);
		
		$this->db->insert('datoscalendario', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo		
		
	}

	//Funcion para crear una ruta
	function crearMensajeChat($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'message' => $datos["message"],
			
			'origen' => $datos["origen"],
			'destino' => $datos["destino"],
			'usuario1' => $datos["usuario1"],
			'usuario2' => $datos["usuario2"]);

		$this->db->set('fecha', 'CURDATE()', FALSE);
		$this->db->set('hora', 'curTime()', FALSE);
		
		$this->db->insert('chatmensajes', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo		
		
	}

	//Funcion para borrar estudiantes de una ruta
	function borrarDatosCalendario($idruta){		
		$this->db->where("idruta", $idruta);
		
		$this->db->delete('datoscalendario'); 
	}

	//Funcion para crear una ruta
	function crearLogRuta($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idestudiante' => $datos["idestudiante"],
			'coordenadas_recogida' => $datos["coordenadas_recogida"],
			'tipo' => $datos["tipo"],
			
			'idruta' => $datos["idruta"],
			'acudiente' => $datos["acudiente"],
			'mensaje' => $datos["mensaje"],
			'session' => $datos["session"]);

		$this->db->set('fecha', 'CURDATE()', FALSE);
		$this->db->set('hora', 'curTime()', FALSE);

		$this->db->insert('log_ruta', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo				
	}

	function crearAlerta($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			
			'idUsuario' => $datos["idUsuario"],
			'mensaje' => $datos["mensaje"],
			'tipo' => $datos["tipo"]);

		$this->db->set('fecha', 'CURDATE()', FALSE);
		$this->db->set('hora', 'curTime()', FALSE);

		$this->db->insert('alertas', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo				
	}

	//Funcion para editar una ruta
	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idruta' => $datos["vehiculo"],
			'nombreruta' => $datos["nombreruta"],
			'monitor' => $datos["monitor"],
			'id_conductor' => $datos["conductor"],
			'latorigen' => $datos["latorigen"],
			'longorigen' => $datos["longorigen"],
			'latdestino' => $datos["latdestino"],
			'longdestino' => $datos["longdestino"],
			'color' => $datos["color"],
			'repetir' => $datos["repetir"],
			'horainicial' => $datos["horainicial"],
			'horafinal' => $datos["horafinal"],
			'fechainicial' => $datos["fechainicial"],
			'fechafinal' => $datos["fechafinal"]);
		
		$this->db->where("id", $datos["id"]);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->update('asignacionruta', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
	}

	// Crear ruta paralela con los cambios particulares para una fecha
	function crear_ruta_paralela_particularides($datos){		
		$array = array(
			'idruta' => $datos["vehiculo"],
			'nombreruta' => $datos["nombreruta"],
			'monitor' => $datos["monitor"],
			'id_conductor' => $datos["conductor"],
			'latorigen' => $datos["latorigen"],
			'longorigen' => $datos["longorigen"],
			'latdestino' => $datos["latdestino"],
			'longdestino' => $datos["longdestino"],
			'color' => $datos["color"],
			'repetir' => $datos["repetir"],
			'horainicial' => $datos["horainicial"],
			'horafinal' => $datos["horafinal"],
			
			'fechainicial' => $datos["fechainicial"],
			'fechafinal' => $datos["fechafinal"],
		);
		$array['observaciones'] = $datos['observaciones'];
		$array['fecha_reemplazo'] = $datos['fecha_reemplazo'];	
		$array['id_asignacionruta'] = $datos['id_asignacionruta'];
		return $this->db->insert('asignacionruta_particuliaridades', $array);			
	}

	//Funcion para crear estudiantes en la cart
	function agregarEstudiantes($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$fechain = date("d/m/Y");
		$array = array(
			'valores' => $datos["estudiante"],
			'ruta' => $datos["idruta"],
			
			'fecha' => $fechain);

		$this->db->insert('cart', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
	}

	//Funcion para borrar estudiantes de una ruta
	function borrarEstudiantes($idruta){		
		$this->db->where("ruta", $idruta);
		
		$this->db->delete('cart'); 
	}

	//Funcion para verificar la existencia de una ruta
	function existeRuta($nombreruta){
		
		$this->db->where("nombreruta", $nombreruta);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('asignacionruta');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para verificar la existencia del color de una ruta
	function existeColorRuta($color){
		
		$this->db->where("color", $color);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('asignacionruta');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	function existeUsuarioRuta($idRuta, $idUsuario){
		$result = $this->db->query("
			SELECT u.*, c.* FROM `cart` c 
			inner join usuarios u on c.valores = u.NumeroId 
			WHERE c.`ruta`='$idRuta' 
			AND u.`TipoUsuario`='Estudiante' 
			AND u.idUsuario = '$idUsuario'
			
		");		
		
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para listar todos las rutas
	function listar(){
		$this->db->select('asignacionruta.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca');
		$this->db->from('asignacionruta');	
		
		$this->db->join('monitor', "monitor.idmonitor = asignacionruta.monitor");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = asignacionruta.idruta");
		$this->db->order_by("asignacionruta.nombreruta", "asc"); 
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos los mensajes
	function listar_mensajes_predefinidos(){
		$this->db->select('mensajes_predefinidos_chat.*');
		$this->db->from('mensajes_predefinidos_chat');	
		$this->db->order_by("mensajes_predefinidos_chat.mensaje", "asc"); 
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener un mensaje
	function get_mensaje_predefinido($id){
		$this->db->select('mensajes_predefinidos_chat.*');
		$this->db->from('mensajes_predefinidos_chat');	
		$this->db->where("mensajes_predefinidos_chat.id", $id);
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	// Crear ruta paralela con los cambios particulares para una fecha
	function crear_mensaje_predefinido($datos){		
		$array = array(			
			'mensaje' => $datos["mensaje"],
			'user_create' => $datos["user_create"]);

		$this->db->set('date_create', 'CURDATE()', FALSE);
		$this->db->set('time_create', 'curTime()', FALSE);

		$this->db->insert('mensajes_predefinidos_chat', $array);		
	}

	// Crear ruta paralela con los cambios particulares para una fecha
	function update_mensaje_predefinido($datos){		
		$array = array(			
			'mensaje' => $datos["mensaje"]);
		$this->db->where("id", $datos["id"]);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->update('mensajes_predefinidos_chat', $array);
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacion($idMonitor, $fecha){
		$this->db->select('asignacionruta.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca');
		$this->db->from('asignacionruta');	
		
		$this->db->where("asignacionruta.fechainicial", $fecha);
		$this->db->join('monitor', "monitor.idmonitor = asignacionruta.monitor AND monitor.idmonitor = '$idMonitor'");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = asignacionruta.idruta");
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacionDiario($idMonitor, $fechaInicial, $fechaFinal){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio, asignacionruta.fechafinal AS fechaFinal');
		$this->db->from('datoscalendario');	
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor AND monitor.idmonitor = '$idMonitor'");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo");
		$this->db->where("datoscalendario.fecha BETWEEN '" . $fechaInicial . "' AND '" . $fechaFinal . "'");
		
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarDatosCalendario(){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio');
		$this->db->from('datoscalendario');	
		
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo");
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacionMensual($idMonitor, $fechaInicial, $fechaFinal, $dia){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio, asignacionruta.fechafinal AS fechaFinal');
		$this->db->from('datoscalendario');	
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor AND monitor.idmonitor = '$idMonitor'");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta AND asignacionruta.fechainicial LIKE '%-" . $dia . "'");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo");
		$this->db->where("datoscalendario.fecha BETWEEN '" . $fechaInicial . "' AND '" . $fechaFinal . "'");
		
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacionDiarioVehiculo($idvehiculo, $fechaInicial, $fechaFinal){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio, asignacionruta.fechafinal AS fechaFinal');
		$this->db->from('datoscalendario');	
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo AND vehiculo.idvehiculo = '$idvehiculo'");
		$this->db->where("datoscalendario.fecha BETWEEN '" . $fechaInicial . "' AND '" . $fechaFinal . "'");
		
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacionMensualVehiculo($idvehiculo, $fechaInicial, $fechaFinal, $dia){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio, asignacionruta.fechafinal AS fechaFinal');
		$this->db->from('datoscalendario');	
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta AND asignacionruta.fechainicial LIKE '%-" . $dia . "'");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo AND vehiculo.idvehiculo = '$idvehiculo'");
		$this->db->where("datoscalendario.fecha BETWEEN '" . $fechaInicial . "' AND '" . $fechaFinal . "'");
		
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacionDiarioConductor($idconductor, $fechaInicial, $fechaFinal){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio, asignacionruta.fechafinal AS fechaFinal');
		$this->db->from('datoscalendario');	
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor AND conductor.idconductor = '$idconductor'");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo");
		$this->db->where("datoscalendario.fecha BETWEEN '" . $fechaInicial . "' AND '" . $fechaFinal . "'");
		
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para listar todos las rutas filtrando por monitor, repetir y fecha de creacion
	function listarRutasValidacionMensualConductor($idconductor, $fechaInicial, $fechaFinal, $dia){
		$this->db->select('datoscalendario.*, monitor.nombre AS nombreMonitor, , monitor.apellido AS apellidoMonitor, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca, asignacionruta.fechainicial AS fechaInicio, asignacionruta.fechafinal AS fechaFinal');
		$this->db->from('datoscalendario');	
		$this->db->join('monitor', "monitor.idmonitor = datoscalendario.monitor");
		$this->db->join('asignacionruta', "asignacionruta.id = datoscalendario.idruta AND asignacionruta.fechainicial LIKE '%-" . $dia . "'");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor AND conductor.idconductor = '$idconductor'");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = datoscalendario.vehiculo");
		$this->db->where("datoscalendario.fecha BETWEEN '" . $fechaInicial . "' AND '" . $fechaFinal . "'");
		
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	
	//Funcion para obtener una ruta
	function get($id){
		
		$this->db->where("id_asignacionruta", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$particulares = $this->db->get("asignacionruta_particuliaridades");
	
		$this->db->where("id", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		
		$data = $this->db->get('asignacionruta');//El metodo get sirve para realizar un SELECT en la bd.	

		if($data->num_rows() > 0){
			$data->particulares = [];
			foreach ($particulares->result() as $particularidad) {
				array_push($data->particulares, $particularidad);
			}
			return $data;
		}else {
			return false;
		}
	}

	function get_observacione_particulares($id_asignacionruta, $fecha_reemplazo){
		$this->db->select('
			conductor.nombre as conductor_nombre,
			conductor.apellido as conductor_apellido,
			monitor.nombre as monitor_nombre,
			monitor.apellido as monitor_apellido,
			vehiculo.placa,
			asignacionruta_particuliaridades.*
		');
		$this->db->where("asignacionruta_particuliaridades.id_asignacionruta", $id_asignacionruta);
		
		$this->db->where("fecha_reemplazo", $fecha_reemplazo);
		$this->db->order_by("asignacionruta_particuliaridades.fecha_reemplazo");
		$this->db->join('conductor', 'conductor.idconductor = asignacionruta_particuliaridades.id_conductor', 'left');
		$this->db->join('monitor', 'monitor.idmonitor = asignacionruta_particuliaridades.monitor', 'left');
		$this->db->join('vehiculo', 'vehiculo.idvehiculo = asignacionruta_particuliaridades.idruta', 'left');
		$particulares = $this->db->get("asignacionruta_particuliaridades");	

		if($particulares->num_rows() > 0){
			return $particulares->result();
		}else {
			return false;
		}
	}

	function get_recorrido_dia($id_asignacionruta, $fecha_reemplazo, $whitGeoPos = false){
		$this->db->select('coordenadas_recogida');
		$this->db->where("idruta", $id_asignacionruta);
		$this->db->where("fecha", $fecha_reemplazo);
		if( !$whitGeoPos ) $this->db->where("mensaje !=", 'geolocalizacion');
		$coordenadas = $this->db->get("log_ruta");	
		//$q = $this->db->last_query();	
		//var_dump($q);
		return $coordenadas->result();
	}

	//Funcion para obtener una ruta
	function getMensajesChat($usuario1, $usuario2){
		
		$this->db->where("usuario1", $usuario1);//Con esta linea se agrega un WHERE a un SELECT.
		$this->db->where("usuario2", $usuario2);
		$data = $this->db->get('chatmensajes');//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener estudiantes de una ruta
	function getEstudiantes($id){
		$this->db->select('usuarios.*');
		$this->db->from('cart');	
		
		$this->db->where("cart.ruta", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		/*$this->db->order_by("usuarios.PrimerApellido", "asc"); 
		$this->db->order_by("usuarios.SegundoApellido", "asc"); 
		$this->db->order_by("usuarios.PrimerNombre", "asc"); 
		$this->db->order_by("usuarios.SegundoNombre", "asc"); */
		$this->db->join('usuarios', "cart.valores = usuarios.NumeroId");
		$this->db->join('asignacionruta', "cart.ruta = asignacionruta.id");
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener estudiantes de una ruta
	function getLogEstudianteBitacora($id, $fecha, $tipo, $idUsuario){
		$this->db->select('usuarios.*, log_ruta.*');
		$this->db->from('cart');	
		
		$this->db->order_by("usuarios.PrimerApellido", "asc"); 
		$this->db->order_by("usuarios.SegundoApellido", "asc"); 
		$this->db->order_by("usuarios.PrimerNombre", "asc"); 
		$this->db->order_by("usuarios.SegundoNombre", "asc"); 
		$this->db->join('asignacionruta', "cart.ruta = asignacionruta.id AND asignacionruta.id = '$id'");
		$this->db->join('log_ruta', "log_ruta.idruta = asignacionruta.id AND log_ruta.fecha = '" . $fecha . "' AND log_ruta.tipo = '" . $tipo . "'");
		$this->db->join('usuarios', "usuarios.idUsuario = log_ruta.idestudiante AND usuarios.idUsuario = '" . $idUsuario . "'");
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener una ruta detallada
	function getRuta($id){
		$this->db->select('asignacionruta.*, monitor.nombre AS nombreMonitor, monitor.apellido AS apellidoMonitor, monitor.Gcm_Phone, conductor.nombre AS nombreConductor, conductor.apellido AS apellidoConductor, vehiculo.placa, vehiculo.sillas, vehiculo.categoria, vehiculo.marca');
		$this->db->from('asignacionruta');	
		
		$this->db->where("asignacionruta.id", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->join('monitor', "monitor.idmonitor = asignacionruta.monitor");
		$this->db->join('conductor', "conductor.idconductor = asignacionruta.id_conductor");
		$this->db->join('vehiculo', "vehiculo.idvehiculo = asignacionruta.idruta");
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener coordenadas de los estudiantes de una ruta
	function getCoordenadasRuta($id){
		$this->db->select('usuarios.*');
		$this->db->from('usuarios');
		
		$this->db->where("cart.ruta", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->join('cart', "cart.valores = usuarios.NumeroId");
		$this->db->join('asignacionruta', "cart.ruta = asignacionruta.id");
		$data = $this->db->get();//El metodo get sirve para realizar un SELECT en la bd.
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener coordenadas de un bus de una ruta
	function getCoordenadasBus($id, $fecha){
		/*$data = $this->db->query("SELECT log_ruta.* FROM `log_ruta` INNER JOIN monitor ON monitor.idmonitor = log_ruta.idestudiante WHERE log_ruta.`idruta`='$id' AND log_ruta.`fecha`='$fecha' AND log_ruta.`tipo`='BUS' ORDER BY log_ruta.`fecha` DESC, log_ruta.`hora` DESC LIMIT 1");*/
		
		$data = $this->db->query("
			SELECT log_ruta.* 
			FROM `log_ruta` 
			INNER JOIN monitor ON monitor.idmonitor = log_ruta.idestudiante 
			WHERE log_ruta.`idruta`='$id' AND log_ruta.`fecha`='$fecha' 
			AND log_ruta.`tipo`='BUS' 
			AND monitor.Gcm_Phone != '' 
			
			ORDER BY log_ruta.`fecha` DESC, log_ruta.`hora` DESC LIMIT 1
		");
		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener coordenadas del bus de una ruta
	function getTodasCoordenadasBus($id, $fecha){
		$data = $this->db->query("
			SELECT log_ruta.* 
			FROM `log_ruta` 
			WHERE log_ruta.`idruta`='$id' 
			AND log_ruta.`fecha`='$fecha' 
			AND log_ruta.`tipo`='BUS' ORDER BY log_ruta.`hora` ASC
			
		");
		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	function getlogRutaPorTipo($id, $fecha, $tipo, $idUsuario){
		$data = $this->db->query("
			SELECT * 
			FROM `log_ruta` 
			WHERE `tipo`='$tipo' 
			AND `idruta`='$id' 
			AND `fecha`='$fecha' 
			AND `idestudiante`='$idUsuario'
			
		");
		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener coordenadas del bus de una ruta
	function getTodasCoordenadasBusSinFecha($id){
		$data = $this->db->query("
			SELECT log_ruta.* 
			FROM `log_ruta` 
			WHERE log_ruta.`idruta`='$id' 
			AND log_ruta.`fecha`= CURDATE() 
			
			AND log_ruta.`tipo`='BUS' 
			ORDER BY log_ruta.`hora` ASC
		");
		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener los estudiantes de una ruta
	function listarEstudiantesTracking($idruta, $fecha, $fechaIn, $idUsuario, $tipo){
		$data = $this->db->query("
			SELECT log_ruta.* 
			FROM log_ruta 
			WHERE log_ruta.idestudiante = '$idUsuario' 
			AND log_ruta.tipo = '$tipo' 
			
			AND fecha = '$fechaIn'
		");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener los estudiantes de una ruta
	function listarAlertasMonitorRuta($idruta, $tipo, $fecha){
		$data = $this->db->query("
			SELECT log_ruta.* 
			FROM log_ruta 
			INNER JOIN asignacionruta ON asignacionruta.id = log_ruta.idruta 
			AND log_ruta.hora BETWEEN asignacionruta.horainicial 
			AND asignacionruta.horafinal 
			WHERE log_ruta.`idruta`='$idruta' 
			AND  log_ruta.`tipo` = '$tipo' 
			AND fecha = '$fecha'");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener los mensajes que enviaron todos los acudientes a los monitores de las rutas
	function listarMensajesAcudienteaCoordinador(){
		$data = $this->db->query("
			SELECT 
				(SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) 
				FROM `usuarios` WHERE `idUsuario`=u.idAcudiente) AS Nombre, u.*, 
				l.`id`, l.`idestudiante`, l.`coordenadas_recogida`, l.`tipo`, l.`idruta`, l.`fecha`, l.`hora`, l.`mensaje`, a.nombreruta, monitor.* 
			FROM `log_ruta` l 
			INNER JOIN usuarios u ON u.idUsuario = l.`idestudiante` 
			INNER JOIN asignacionruta a ON a.id = l.idruta 
			INNER JOIN monitor ON monitor.idmonitor = a.monitor WHERE l.`tipo`='MENSAJEAMONITOR'");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	// BITACORA
	function get_mensaje_acudiente_monitor($idruta, $fecha){
		$query = sprintf("
				SELECT mensaje, hora, ImagenFotografica, 
				CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) AS nombre_completo 
				FROM log_ruta
				INNER JOIN usuarios ON usuarios.idUsuario = log_ruta.`idestudiante`
				WHERE idruta = '%s' AND fecha =  '%s'
				AND mensaje !=  'geolocalizacion'
				AND tipo =  'MENSAJEAMONITOR'
			", $idruta, $fecha);

		$data = $this->db->query($query);

		if($data->num_rows() > 0) return $data->result();
		else return false;
	}

	// BITACORA
	function get_alerta_monitor($idruta, $fecha){
		$query = sprintf("
				SELECT mensaje, hora, ImagenFotografica, 
				CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) AS nombre_completo 
				FROM log_ruta
				INNER JOIN usuarios ON usuarios.idUsuario = log_ruta.`idestudiante`
				WHERE idruta = '%s' AND fecha =  '%s'
				AND mensaje !=  'geolocalizacion'
				AND tipo =  'ALERTAPPMONITOR'
			", $idruta, $fecha);
		
		$data = $this->db->query($query);

		if($data->num_rows() > 0) return $data->result();
		else return false;
	}

	// BITACORA
	function get_chat_con_acudiente($idruta, $fecha){
		$query = sprintf("
				SELECT mensaje, hora, ImagenFotografica, 
				CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) AS nombre_completo 
				FROM log_ruta
				INNER JOIN usuarios ON usuarios.idUsuario = log_ruta.`idestudiante`
				WHERE idruta = '%s' AND fecha =  '%s'
				AND mensaje !=  'geolocalizacion'
				AND (tipo =  'MENSAJEAACUDIENTESPORESTUDIANTE' OR tipo =  'MENSAJEAACUDIENTESPORRUTA')

			", $idruta, $fecha);

		$data = $this->db->query($query);

		if($data->num_rows() > 0) return $data->result();
		else return false;
	}

	//Funcion para obtener los mensajes que enviaron todos los acudientes a los monitores de las rutas por fecha y id de ruta
	function listarMensajesAcudienteaCoordinadorFecha($idruta, $fecha, $idUsuario){
		$data = $this->db->query("SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=u.idAcudiente) AS Nombre, u.*, l.`id`, l.`idestudiante`, l.`coordenadas_recogida`, l.`tipo`, l.`idruta`, l.`fecha`, l.`hora`, l.`mensaje`, a.nombreruta, monitor.* FROM `log_ruta` l INNER JOIN usuarios u ON u.idUsuario = l.`idestudiante` AND u.idUsuario = '$idUsuario' INNER JOIN asignacionruta a ON a.id = l.idruta INNER JOIN monitor ON monitor.idmonitor = a.monitor WHERE l.`tipo`='MENSAJEAMONITOR' AND l.`fecha` = '$fecha' AND l.`idruta` = '$idruta'");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener los mensajes que enviaron todos los acudientes a los monitores de las rutas por fecha y id de ruta
	function listarMensajesMonitoraEstudiante($idruta, $fecha, $idUsuario){
		$data = $this->db->query("SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=u.idAcudiente) AS Nombre, u.*, l.`idUsuario`, l.`fecha`, l.`hora`, l.`idRuta`, l.`mensaje`, l.`tipo`, a.nombreruta, monitor.* FROM `alertas` l INNER JOIN usuarios u ON u.idUsuario = l.`idUsuario` AND u.idUsuario = '$idUsuario' INNER JOIN asignacionruta a ON a.id = l.idRuta INNER JOIN monitor ON monitor.idmonitor = a.monitor WHERE l.`tipo`='ALERTEAPPNOTIFICACION' AND l.`fecha` = '$fecha' AND l.`idruta` = '$idruta'");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener los mensajes que ha enviado el coordinador de rutas a los acudientes
	function listarMensajesCoordinadorAcudiente(){
		$data = $this->db->query("SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=usua.idAcudiente) AS NombreAcudiente, l.*, '' AS nombreruta, usua.`idUsuario`, usua.`TipoId`, usua.`NumeroId`, usua.`PrimerApellido`, usua.`SegundoApellido`, usua.`PrimerNombre`, usua.`SegundoNombre`, usua.`ImagenFotografica`, usua.`Direccion`, usua.`Telefono1`, usua.`Telefono2`, usua.`Estado` FROM `log_ruta` l INNER JOIN usuarios_sistema u ON u.idUsuario = l.`idestudiante` INNER JOIN usuarios usua ON usua.idUsuario = l.`idruta` WHERE l.`tipo`='MENSAJEAACUDIENTESPORESTUDIANTE' UNION SELECT '' AS NombreAcudiente, lr.*, a.nombreruta, us.`idUsuario`, us.`TipoId`, us.`NumeroId`, us.`PrimerApellido`, us.`SegundoApellido`, us.`PrimerNombre`, us.`SegundoNombre`, us.`ImagenFotografica`, us.`Direccion`, us.`Telefono1`, us.`Telefono2`, us.`Estado` FROM `log_ruta` lr INNER JOIN asignacionruta a ON a.id = lr.`idruta` INNER JOIN usuarios_sistema us ON us.idUsuario = lr.`idestudiante` WHERE lr.`tipo`='MENSAJEAACUDIENTESPORRUTA'");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para obtener los mensajes que ha enviado el coordinador de rutas a los acudientes
	function listarMensajesCoordinadorAcudienteFecha($idruta, $fecha, $idUsuario){
		$data = $this->db->query("SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=usua.idAcudiente) AS NombreAcudiente, l.*, '' AS nombreruta, usua.`idUsuario`, usua.`TipoId`, usua.`NumeroId`, usua.`PrimerApellido`, usua.`SegundoApellido`, usua.`PrimerNombre`, usua.`SegundoNombre`, usua.`ImagenFotografica`, usua.`Direccion`, usua.`Telefono1`, usua.`Telefono2`, usua.`Estado` FROM `log_ruta` l INNER JOIN usuarios usua ON usua.idUsuario = l.`idestudiante` AND usua.idUsuario = '$idUsuario' WHERE l.`tipo`='MENSAJEAACUDIENTESPORESTUDIANTE' AND l.`fecha` = '$fecha' UNION SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=us.idAcudiente) AS NombreAcudiente, lr.*, a.nombreruta, us.`idUsuario`, us.`TipoId`, us.`NumeroId`, us.`PrimerApellido`, us.`SegundoApellido`, us.`PrimerNombre`, us.`SegundoNombre`, us.`ImagenFotografica`, us.`Direccion`, us.`Telefono1`, us.`Telefono2`, us.`Estado` FROM `log_ruta` lr INNER JOIN asignacionruta a ON a.id = lr.`idruta` INNER JOIN usuarios us ON us.idUsuario = lr.`idestudiante` AND us.idUsuario = '$idUsuario' WHERE lr.`tipo`='MENSAJEAACUDIENTESPORRUTA' AND lr.`fecha` = '$fecha'");		
		if($data->num_rows() > 0) return $data;
		else return false;
	}
}	