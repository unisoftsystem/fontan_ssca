<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	Model Producto que realiza ciertas operaciones en la bd. Es importante saber que no es obligacion usar los metodos de codeigniter como where, ge, insert para realizar cieras acciones en los querys. Tambien se pueder realizar la consulta en una cadena y ejecutar con $this->db->query($cadenaSQL). Da el mismo resultado.
*/
	
class Producto_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//Se llama a libraria de base de datos
	}

	//Funcion para listar todos los productos
	function ListarProductosSubCategoria($subcategoria, $dia, $idUsuario, $idCredencial){
		$jsonAcudientes = "[";
		$contador = 1;
		if($subcategoria == "53"){
			$dataCambioMenu = $this->db->query("SELECT dm . * , m . * , p.Descripcion AS Proteina FROM  `detallenenudia` dm INNER JOIN proteinas p ON p.id = dm.`idProteina` INNER JOIN  `menudia` m ON m.id = dm.idMenuDia WHERE dm.`idUsuario` =  '$idUsuario' AND dm.`Dia`=$dia ORDER BY dm.`fecha` DESC , dm.`hora` DESC LIMIT 1");

			if($dataCambioMenu->num_rows() > 0){
				$dataProductoCambioMenu = $this->db->query("SELECT p.* FROM `productos` p WHERE p.`Subcategoria`='$subcategoria' AND p.`Estado`='ACTIVO' AND p.`Stock` > 0 AND (SELECT COUNT(*) FROM restriccion r WHERE r.Log = p.`codigoProducto` AND r.Tipo = 'PORPRODUCTO' AND r.idEstudiante = '$idCredencial') = 0 ORDER BY p.`NombreProducto` ASC");
				if($dataProductoCambioMenu->num_rows() > 0){
					foreach ($dataProductoCambioMenu->result() as $value) {
						$codigoProducto = $registro->codigoProducto;	
						$NombreProducto = $dataCambioMenu->result()[0]->Nombre;	
						$Descripcion = $dataCambioMenu->result()[0]->Proteina . ", " . $dataCambioMenu->result()[0]->Descripcion;						
						$ValorUnitario = $value->ValorUnitario;	
						$Categoria = $value->Categoria;	
						$Subcategoria = $value->Subcategoria;	
						$Stock = $value->Stock;	
						$Estado = $value->Estado;	
						$Imagen = $dataCambioMenu->result()[0]->Foto;
						$resultado = str_replace("/", "\/", $Imagen);
						$resultadoDescripcion = str_replace("\n", ", ", $Descripcion);

						if($contador == 1){
							$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
						}else{
							$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
							
						}
						$contador+=1;
					}
				}
			}else{
				$dataMenu = $this->db->query("SELECT m.*, p.Descripcion AS Proteina FROM `menudia` m INNER JOIN proteinas p on p.id = m.`idProteina` WHERE m.`Dia`=$dia");
				if($dataMenu->num_rows() > 0){
					$dataProductoMenu = $this->db->query("SELECT p.* FROM `productos` p WHERE p.`Subcategoria`='$subcategoria' AND p.`Estado`='ACTIVO' AND p.`Stock` > 0 AND (SELECT COUNT(*) FROM restriccion r WHERE r.Log = p.`codigoProducto` AND r.Tipo = 'PORPRODUCTO' AND r.idEstudiante = '$idCredencial') = 0 ORDER BY p.`NombreProducto` ASC");

					if($dataProductoMenu->num_rows() > 0){
						foreach ($dataProductoMenu->result() as $value) {
							$codigoProducto = $value->codigoProducto;	
							$NombreProducto = $dataMenu->result()[0]->Nombre;	
							$Descripcion = $dataMenu->result()[0]->Proteina . ", " . $dataMenu->result()[0]->Descripcion;							
							$ValorUnitario = $value->ValorUnitario;	
							$Categoria = $value->Categoria;	
							$Subcategoria = $value->Subcategoria;	
							$Stock = $value->Stock;	
							$Estado = $value->Estado;	
							$Imagen = $dataMenu->result()[0]->Foto;
							$resultado = str_replace("/", "\/", $Imagen);
							$resultadoDescripcion = str_replace("\n", ", ", $Descripcion);
							
							if($contador == 1){
								$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
							}else{								
								$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
								
							}
							$contador+=1;
						}
					}
				}
			}
		}else{
			$dataProducto = $this->db->query("SELECT productos.* FROM `productos` WHERE productos.`Subcategoria`='$subcategoria' AND productos.`Estado`='ACTIVO' AND productos.`Stock` > 0 ORDER BY productos.`NombreProducto` ASC");
			if($dataProducto->num_rows() > 0){
				foreach ($dataProducto->result() as $value) {
					$codigoProducto = $value->codigoProducto;	
					$NombreProducto = $value->NombreProducto;	
					$Descripcion = $value->Descripcion;	
					$ValorUnitario = $value->ValorUnitario;	
					$Categoria = $value->Categoria;	
					$Subcategoria = $value->Subcategoria;	
					$Stock = $value->Stock;	
					$Estado = $value->Estado;	
					$Imagen = $value->Imagen;

					$dataRestriccion = $this->db->query("SELECT COUNT(*) AS filas FROM restriccion r WHERE r.Log = '$codigoProducto' AND r.Tipo = 'PORPRODUCTO' AND r.idEstudiante = '$idCredencial'");
					$estadoRestriccion = "";

					if($dataRestriccion->result()[0]->filas > 0){
						$estadoRestriccion = "SI";
					}else{
						$estadoRestriccion = "NO";
					}
					if($contador == 1){
						$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "Restriccion":"' . $estadoRestriccion . '"}';	
					}else{						
						$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "Restriccion":"' . $estadoRestriccion . '"}';	
						
					}
					$contador+=1;
				}
			}
		}
		
		$jsonAcudientes .= "]";			
		return $jsonAcudientes;
	}

	//Funcion para crear un producto
	function crear($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'NombreProducto' => $datos["nombreProducto"],
			'Descripcion' => $datos["descripcion"],
			'ValorUnitario' => $datos["valorUnitario"],
			'Categoria' => $datos["categoria"],
			'Subcategoria' => $datos["subcategoria"],
			'Stock' => $datos["stock"],
			'Estado' => $datos["estado"],
			'Imagen' => $datos["file"],
			'hora_maxima' => $datos["tiempo"],
			'tiempo_cancelacion' => $datos["tiempoc"],
			'edad' => $datos["edadMinima"],
			'edad_max' => $datos["edad"]);

		$this->db->insert('productos', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para crear un producto
	function editar($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'NombreProducto' => $datos["nombreProducto"],
			'Descripcion' => $datos["descripcion"],
			'ValorUnitario' => $datos["valorUnitario"],
			'Categoria' => $datos["categoria"],
			'Subcategoria' => $datos["subcategoria"],
			'Stock' => $datos["stock"],
			'Estado' => $datos["estado"],
			'Imagen' => $datos["file"],
			'hora_maxima' => $datos["tiempo"],
			'tiempo_cancelacion' => $datos["tiempoc"],
			'edad' => $datos["edadMinima"],
			'edad_max' => $datos["edad"]);
		$this->db->where('codigoProducto', $datos["codigo"]);
		$this->db->update('productos', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}

	//Funcion para disminuir el stock de un producto
	function DisminuirStock($codigoProducto, $cantidad, $session, $origen){
		$datos = $this->db->query("SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'");

		if($datos->num_rows() > 0){
			$cantidadActual = $datos->result()[0]->Stock;
			$total = $cantidadActual - $cantidad;
			$this->db->query("UPDATE `productos` SET `Stock`= $total WHERE `codigoProducto`='$codigoProducto'");

			$array = array(
				'codigoProducto' => $datos->result()[0]->codigoProducto,
				'stock_inicial' => $cantidadActual,
				'cantidad_agregar' => $cantidad,
				'stock_final' => $total,
				'session' => $session,
				'origen' => $origen);

			$this->db->set('fecha', 'CURDATE()', FALSE);
			$this->db->set('hora', 'curTime()', FALSE);
			$this->db->insert('Log_inventario', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo		
		}
	}

	//Funcion para disminuir el stock de un producto
	function AumentarStock($codigoProducto, $cantidad, $session, $origen){
		$datos = $this->db->query("SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'");

		if($datos->num_rows() > 0){
			$cantidadActual = $datos->result()[0]->Stock;
			$total = $cantidadActual + $cantidad;
			$this->db->query("UPDATE `productos` SET `Stock`= $total WHERE `codigoProducto`='$codigoProducto'");

			$array = array(
				'codigoProducto' => $datos->result()[0]->codigoProducto,
				'stock_inicial' => $cantidadActual,
				'cantidad_agregar' => $cantidad,
				'stock_final' => $total,
				'session' => $session,
				'origen' => $origen);

			$this->db->set('fecha', 'CURDATE()', FALSE);
			$this->db->set('hora', 'curTime()', FALSE);
			$this->db->insert('Log_inventario', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo		
		}
	}

	//Funcion para disminuir el stock de un producto
	function ObtenerStock($codigoProducto){
		$datos = $this->db->query("SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'");
		
		if($datos->num_rows() > 0) return $datos;
		else return false;
	}

	//Funcion para listar todos los productos
	function ListarProductos(){		
		$data = $this->db->query("SELECT productos.*, categoria.Nombre AS NombreCategoria, `sub-categoria`.Nombre AS NombreSubCategoria FROM productos INNER JOIN categoria ON categoria.codigo = productos.Categoria INNER JOIN `sub-categoria` ON `sub-categoria`.codigo = productos.Subcategoria ORDER BY productos.NombreProducto ASC");
		//Se verifica con el metodo num_rows() la cantidad de registros resultantes de la consulta, si es mayor a 0 se retorna el result sino retorna false
		if($data->num_rows() > 0) return $data;
		else return false;
	}

	//Funcion para crear un producto
	function crearLog($datos){		
		//Se guardan sus datos en un array asociativo, el cual cada id o key tiene que tener el mismo nombre de la columna de la tabla en la bd. Sino se hace asi se genera error
		$array = array(
			'codigoProducto' => $datos["codigoProducto"],
			'stock_inicial' => $datos["stock_inicial"],
			'cantidad_agregar' => $datos["cantidad_agregar"],
			'stock_final' => $datos["stock_final"],
			'session' => $datos["session"],
			'origen' => $datos["origen"]);

		$this->db->set('fecha', 'CURDATE()', FALSE);
		$this->db->set('hora', 'curTime()', FALSE);
		$this->db->insert('Log_inventario', $array);//Se llama a la funcion de insertar datos y se le pasa el array asociativo			
		
	}
}