<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Usuarios del Sistema que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Usuarios_aplicaciones_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear un usuario del sistema
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idUsuario' => $datos["idUsuario"],
			'TipoUsuario' => $datos["TipoUsuario"],
			'TipoId' => $datos["TipoId"],
			'NumeroId' => $datos["NumeroId"],
			'PrimerApellido' => $datos["PrimerApellido"],
			'SegundoApellido' => $datos["SegundoApellido"],
			'PrimerNombre' => $datos["PrimerNombre"],
			'SegundoNombre' => $datos["SegundoNombre"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'idAcudiente' => $datos["idAcudiente"],
			'Direccion' => $datos["Direccion"],
			'Telefono1' => $datos["Telefono1"],
			'Telefono2' => $datos["Telefono2"],
			'Estado' => $datos["Estado"],
			'Clave' => $datos["Clave"],
			'Coordenadas' => $datos["Coordenadas"],
			'latitud' => $datos["latitud"],
			'longitud' => $datos["longitud"],
			'curso' => $datos["curso"],
			'TipoSangre' => $datos["TipoSangre"],
			'arl' => $datos["arl"],
			'cargo' => $datos["cargo"],
			'tipoestudiante' => $datos["tipoestudiante"],
			'tipofuncionario' => $datos["tipofuncionario"],
			'fechanacimiento' => $datos["fechanacimiento"]);
		$this->db->insert('usuarios', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para crear un usuario del sistema
	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'idUsuario' => $datos["idUsuario"],
			'TipoUsuario' => $datos["TipoUsuario"],
			'TipoId' => $datos["TipoId"],
			'NumeroId' => $datos["numeroIdNuevo"],
			'PrimerApellido' => $datos["PrimerApellido"],
			'SegundoApellido' => $datos["SegundoApellido"],
			'PrimerNombre' => $datos["PrimerNombre"],
			'SegundoNombre' => $datos["SegundoNombre"],
			'ImagenFotografica' => $datos["ImagenFotografica"],
			'idAcudiente' => $datos["idAcudiente"],
			'Direccion' => $datos["Direccion"],
			'Telefono1' => $datos["Telefono1"],
			'Telefono2' => $datos["Telefono2"],
			'Estado' => $datos["Estado"],
			'Clave' => $datos["Clave"],
			'Coordenadas' => $datos["Coordenadas"],
			'latitud' => $datos["latitud"],
			'longitud' => $datos["longitud"],
			'curso' => $datos["curso"],
			'TipoSangre' => $datos["TipoSangre"],
			'arl' => $datos["arl"],
			'cargo' => $datos["cargo"],
			'tipoestudiante' => $datos["tipoestudiante"],
			'tipofuncionario' => $datos["tipofuncionario"],
			'fechanacimiento' => $datos["fechanacimiento"]);
		$this->db->where('NumeroId', $datos["NumeroId"]);
		$this->db->update('usuarios', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			

		$arrayCart = array(
			'valores' => $datos["numeroIdNuevo"]);
		$this->db->where('valores', $datos["NumeroId"]);
		$this->db->update('cart', $arrayCart);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su userid
	function existeUsuario($userid){
		$this->db->where("idUsuario", $userid);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su userid
	function listarAcudientes(){
		$this->db->where("TipoUsuario","Acudiente");//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->order_by("PrimerNombre", "asc"); 
		$result = $this->db->get('usuarios');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario del sistema en la bd buscandolo por su numero de id
	function existeDocumentoUsuario($documento){
		$this->db->where("NumeroId", $documento);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios');//El metodo get sirve para realizar un SELECT en la bd.
		return $result->num_rows();//Se retorna a cantidad de registros resultantes de la consulta
	}

	//Funcion para Iniciar sesion con un usuario del sistema
	function login($datos){
		$this->db->where("idUsuario", $datos["user"]);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->where("Clave", $datos["pass"]);//Al agregar un where() seguido de otro where() se unen en la consulta con un AND
		$result = $this->db->get('usuarios');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	function getUsuarioDocOther($documento){		
		$data = $this->db->query("SELECT * FROM `usuarios` INNER JOIN credenciales ON credenciales.idUsuarioSecundario = usuarios.idUsuario WHERE usuarios.NumeroId = '$documento'");

		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	function getUsuarioDocAcudiente($documento){
		$data = $this->db->query("SELECT usuarios.* FROM `usuarios` WHERE usuarios.NumeroId = '$documento'");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function obtenerUsuarioDocumento($documento){
		$this->db->where("NumeroId", $documento);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function obtenerDatosAcudiente($idUsuario){
		$data = $this->db->query("SELECT usuarios.*, u.`idUsuario` AS idUsuarioAcudiente, u.`TipoUsuario` AS TipoUsuarioAcudiente, u.`TipoId` AS TipoIdAcudiente, u.`NumeroId` AS NumeroIdAcudiente, u.`PrimerApellido` AS PrimerApellidoAcudiente, u.`SegundoApellido` AS SegundoApellidoAcudiente, u.`PrimerNombre` AS PrimerNombreAcudiente, u.`SegundoNombre` AS SegundoNombreAcudiente, u.`ImagenFotografica` AS ImagenFotograficaAcudiente, u.`Direccion` AS DireccionAcudiente, u.`Telefono1` AS Telefono1Acudiente, u.`Telefono2` AS Telefono2Acudiente, u.`Coordenadas` AS CoordenadasAcudiente, u.`latitud` AS latitudAcudiente, u.`longitud` AS longitudAcudiente, u.`TipoSangre` AS TipoSangreAcudiente, u.`fechanacimiento` AS fechanacimientoAcudiente FROM `usuarios` INNER JOIN usuarios u ON u.`idUsuario` = usuarios.`idAcudiente` WHERE usuarios.`idUsuario` = '$idUsuario'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function obtenerDatosEstudiantes($idUsuario){
		$data = $this->db->query("SELECT c. * , u.`idUsuario` , u.`TipoUsuario` , u.`TipoId` , u.`NumeroId` , u.`PrimerApellido` , u.`SegundoApellido` , u.`PrimerNombre` , u.`SegundoNombre` , u.`ImagenFotografica` , u.`idAcudiente` , u.`Direccion` , u.`Telefono1` , u.`Telefono2` , u.`Estado`  , u.`Clave`, u.`curso`, u.`TipoSangre`, u.`Coordenadas` FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idUsuarioPrincipal` = '$idUsuario'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function obtenerAcudiente($id){
		$this->db->where("idUsuario", $id);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$result = $this->db->get('usuarios');//El metodo get sirve para realizar un SELECT en la bd.
		if($result->num_rows() > 0) return $result;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function ConsultarUsuarioUsuarioDoc($documento){
		$data = $this->db->query("SELECT u.*, c.*, cre.* FROM `usuarios` u INNER JOIN cursos c on c.id = u.curso INNER JOIN `credenciales` cre ON u.idUsuario = cre.idUsuarioSecundario WHERE u.`NumeroId`='$documento'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function ConsultarUsuarioUsuarioFuncionDoc($documento){
		$data = $this->db->query("SELECT u.*, cre.* FROM `usuarios` u INNER JOIN `credenciales` cre ON u.idUsuario = cre.idUsuarioSecundario WHERE u.`NumeroId`='$documento'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}
	//Funcion para verificar la existencia de un usuario en la bd buscandolo por su numero de id
	function obtener_usuario_funcionario($documento){
		$data = $this->db->query("SELECT u.*, cre.* FROM `usuarios` u INNER JOIN `credenciales` cre ON u.idUsuario = cre.idUsuarioSecundario WHERE u.`NumeroId`='$documento' AND u.TipoUsuario = 'Funcionario'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para listar los estudiantes por filtro de curso o apellido
	function ListarEstudiantes($curso){
		$data = $this->db->query("SELECT usuarios.* FROM usuarios INNER JOIN cursos ON cursos.id = usuarios.curso WHERE usuarios.TipoUsuario='Estudiante' AND usuarios.curso = '$curso'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para listar los estudiantes por filtro de curso o apellido
	function ListarEstudiantesApellido($apellido){
		$data = $this->db->query("SELECT usuarios.* FROM usuarios INNER JOIN cursos ON cursos.id = usuarios.curso WHERE usuarios.TipoUsuario='Estudiante' AND usuarios.PrimerApellido = '$apellido'");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para listar los estudiantes
	function ListarTodosEstudiantes(){
		$data = $this->db->query("SELECT * FROM `usuarios` WHERE `TipoUsuario`='Estudiante' ORDER BY PrimerNombre ASC, SegundoNombre ASC, PrimerApellido ASC, SegundoApellido ASC");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para listar los estudiantes
	function ListarTodosFuncionarios(){
		$data = $this->db->query("SELECT * FROM `usuarios` WHERE `TipoUsuario`='Funcionario' ORDER BY PrimerNombre ASC, SegundoNombre ASC, PrimerApellido ASC, SegundoApellido ASC");
		if($data->num_rows() > 0) return $data;
		else return false;		
	}

	//Funcion para borrar funcionarios
	function borrar_funcionario($idUsuario){
		
		$this->db->where('idUsuario', $idUsuario);
		$this->db->delete('usuarios');  
	}
	//Funcion para borrar funcionarios
	function borrar_funcionario_credencial($idUsuario){
		
		$this->db->where('idUsuarioSecundario', $idUsuario);
		$this->db->delete('credenciales');  
	}

	//Funcion para crear log usuarios borrados
	function crear_log_funcionarios($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'id_Funcionario' => $datos["usuario"],
			'documento' => $datos["documento"],
			'tipo_documento' => $datos["tipo_documento"],
			'Nombres' => $datos["nombres"],
			'Apellidos' => $datos["apellidos"],
			'motivo' => $datos["motivo"],
			'user_session' => $datos["session"]);
		$this->db->set('fecha', 'CURDATE()', FALSE);
    	$this->db->set('hora', 'curTime()', FALSE);
		$this->db->insert('log_funcionario_borrado', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}
}