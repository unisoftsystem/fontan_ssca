<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Credenciales que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
class Credenciales_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para crear una credencial
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$credencial = "";
		$estado = 0;
		$data = $this->db->query("SELECT UUID() AS idCredencial;");

		if($data->num_rows() > 0){
			
			while ($this->ConsultarUsuarioPorCredencial($data->result()[0]->idCredencial) != "[]") {
				$data = $this->db->query("SELECT UUID() AS idCredencial;");
				
			}

			if ($this->ConsultarUsuarioPorCredencial($data->result()[0]->idCredencial) == "[]") {
				$credencial = $data->result()[0]->idCredencial;
			}

			$array = array(
				'idCredencial' => $credencial,
				'idUsuarioPrincipal' => $datos["idUsuarioPrincipal"],
				'idUsuarioSecundario' => $datos["idUsuarioSecundario"],
				'EstadoCredencial' => "ACTIVO",
				'SaldoCredencial' => $datos["SaldoCredencial"],
				'FechaVencimiento' => $datos["FechaVencimiento"]);
			$this->db->insert('credenciales', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
		}
		

		return $credencial;		
		
	}

	//Funcion para crear una credencial
	function crearReemplazo($idCredencialAnterior){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$credencial = "";
		$data = $this->db->query("SELECT UUID() AS idCredencial;");

		if($data->num_rows() > 0){
			$credencial = $data->result()[0]->idCredencial;

			$array = array(
				'idCredencial' => $credencial,
				'EstadoCredencial' => "ACTIVO");
			$this->db->where('idCredencial', $idCredencialAnterior);

			$this->db->update('credenciales', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo	
		}

		return $credencial;		
		
	}

	//Funcion para verificar la existencia de un usuario por el idusuario
	function ConsultarUsuarioPorId($usuario){
		$contador = 1;
		$json = "";
		$data = $this->db->query("
			SELECT u.*, c.*, cre.*, TIMESTAMPDIFF(YEAR, u.fechanacimiento, CURDATE()) AS edad 
			FROM usuarios u 
			INNER JOIN cursos c on c.id = u.curso  
			INNER JOIN credenciales cre ON u.idUsuario = cre.idUsuarioSecundario 
			WHERE idUsuario='$usuario'
			
		");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0){			
			foreach ($data->result() as $value) {				
				$value->clave = base64_decode($value->Clave);				
			}
			$json = json_encode($data->result());
		}else{
			$datosFuncionario = $this->db->query("
				SELECT u.*, cre.*, '' AS Descripcion, TIMESTAMPDIFF(YEAR, u.fechanacimiento, CURDATE()) AS edad 
				FROM usuarios u 
				INNER JOIN credenciales cre ON u.idUsuario = cre.idUsuarioSecundario 
				WHERE idUsuario='$usuario'
				
			");
			if($datosFuncionario->num_rows() > 0){
				$json = json_encode($datosFuncionario->result());
			}else{
				$json = "[]";
			}
		}
			
		return $json;
	}

	//Funcion para listar todos los servicios asignados por el id del usuario
	function getUsuarioPorCredencial($idCredencial){
		$this->db->select('usuarios.*');
		$this->db->from('credenciales');		
		$this->db->where("credenciales.idCredencial", $idCredencial);//Con esta linea se agrega un WHERE a un SELECT. Esto debe ir primero
		$this->db->join('usuarios', "usuarios.idUsuario = credenciales.idUsuarioSecundario");
		$data = $this->db->get();//esta linea de codigo se realiza un SELECT de todos los datos de la tabla
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para verificar la existencia de un usuario por la credencial
	function ConsultarUsuarioPorCredencial($idUsuario){
		$json = "";
		$contador = 1;
		$data = $this->db->query("
			SELECT c.* , u.*, curso.*, TIMESTAMPDIFF(YEAR, u.fechanacimiento, CURDATE()) AS edad 
			FROM `credenciales` c 
			INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario 
			INNER JOIN cursos curso on curso.id = u.curso 
			WHERE c.`idCredencial` ='$idUsuario'
			
		");
		
		if($data->num_rows() > 0){			
			foreach ($data->result() as $value) {				
				$value->clave = base64_decode($value->Clave);

				$datosRestriccion = $this->db->query("
					SELECT `Log` 
					FROM `restriccion` 
					WHERE `Tipo`='PORVALOR' 
					AND `idEstudiante`='$idUsuario'
										
				");

				if($datosRestriccion->num_rows() > 0){
					$value->ValorRestriccion = $datosRestriccion->result()[0]->Log;
				}else{
					$value->ValorRestriccion = "";
				}	
			}
			$json = json_encode($data->result());
		}else{
			$dataFuncio = $this->db->query("
				SELECT c.* , u.*, '' AS Descripcion 
				FROM `credenciales` c 
				INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario 
				WHERE c.`idCredencial` ='$idUsuario'
				
			");
			if($dataFuncio->num_rows() > 0){
				
				foreach ($dataFuncio->result() as $value) {
					
					$value->clave = base64_decode($value->Clave);
					$value->ValorRestriccion = "";					
				}
				$json = json_encode($dataFuncio->result());
			}else{
				$json = "[]";
			}
				
						
		}					
		return $json;
	}

	//Funcion para obtener el saldo actual de una credencial
	function ObtenerSaldoActual($idCredencial){
		$SaldoCredencial = 0;
		$datos = $this->db->query("
			SELECT `SaldoCredencial` 
			FROM `credenciales` 
			WHERE `idCredencial`='$idCredencial' 
			AND `EstadoCredencial`='ACTIVO'
			
		");

		if($datos->num_rows() > 0){
			$SaldoCredencial = $datos->result()[0]->SaldoCredencial;
		}
		return $SaldoCredencial;
	}

	//Funcion para cambiar el saldo actual de una credencial
	function CambiarSaldo($idCredencial, $valor){
		$datos = $this->db->query("
			UPDATE `credenciales` 
			SET `SaldoCredencial`= '$valor', `EstadoCredencial`='ACTIVO' 
			WHERE `idCredencial`='$idCredencial'
			
		");
	}

	//Funcion para cambiar el saldo actual de una credencial
	function CambiarAcudiente($idAcudiente, $idusuario, $idCredencial){
		$this->db->query("
			UPDATE `credenciales` 
			SET `idUsuarioPrincipal`= '$idAcudiente', `idUsuarioSecundario`='$idusuario' 
			WHERE `idCredencial` = '$idCredencial'
			
		");
		$this->db->query("
			UPDATE `restriccion` 
			SET `idAcudiente`= '$idAcudiente' 
			WHERE `idEstudiante` = '$idCredencial'
			
		");
	}

	//Funcion para cambiar el saldo actual de una credencial
	function CambiaridUsuarioLogIn($idusuarioAntiguo, $idusuarioNuevo, $origen){
		$datos = $this->db->query("
			UPDATE `Log_inventario` 
			SET `session`='$idusuarioNuevo' 
			WHERE `origen`='$origen' 
			AND `session`='$idusuarioAntiguo'
			
		");
	}

	//Funcion para cambiar el saldo actual de una credencial
	function CambiarFechaVencimiento($fechaVencimiento, $idusuario){
		$datos = $this->db->query("
			UPDATE `credenciales` 
			SET `FechaVencimiento`='$fechaVencimiento' 
			WHERE `idUsuarioSecundario`='$idusuario'
			
		");
	}

}