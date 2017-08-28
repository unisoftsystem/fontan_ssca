<?php
		
	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataProducto.php');
	
	class Controller_Producto {
		
		public function __construct(){
			
		}
				
		public function CrearProducto(DataProducto $DataProducto){
			$conexionBD = new ConexionBD();
			
			$codigoProducto = $DataProducto->getCodigoProducto();
			$nombreProducto = $DataProducto->getNombreProducto();	
			$descripcion = $DataProducto->getDescripcion();
			$valorUnitario = $DataProducto->getValorUnitario();
			$tiempo = $DataProducto->getTiempo();
			$tiempoc = $DataProducto->getTiempoc();
			$edad = $DataProducto->getEdad();
			$edadMinima = $DataProducto->getEdadMinima();
			$categoria = $DataProducto->getCategoria();
			$subcategoria = $DataProducto->getSubcategoria();
			$stock = $DataProducto->getStock();
			$estado = $DataProducto->getEstado();
			$imagen = $DataProducto->getImagen();	
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `productos`(`codigoProducto`, `NombreProducto`, `Descripcion`, `ValorUnitario`, `Categoria`, `Subcategoria`, `Stock`, `Estado`, `Imagen`, `hora_maxima`, `tiempo_cancelacion`, `edad`, `edad_max`) VALUES (NULL,'$nombreProducto','$descripcion','$valorUnitario','$categoria','$subcategoria','$stock','ACTIVO','$imagen','$tiempo','$tiempoc','$edadMinima','$edad')";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarProducto(DataProducto $DataProducto){
			$conexionBD = new ConexionBD();
			
			$codigoProducto = $DataProducto->getCodigoProducto();
			$nombreProducto = $DataProducto->getNombreProducto();	
			$descripcion = $DataProducto->getDescripcion();
			$valorUnitario = $DataProducto->getValorUnitario();
			$categoria = $DataProducto->getCategoria();
			$subcategoria = $DataProducto->getSubcategoria();
			$tiempo = $DataProducto->getTiempo();
			$tiempoc = $DataProducto->getTiempoc();
			$edad = $DataProducto->getEdad();
			$edadMinima = $DataProducto->getEdadMinima();
			$stock = $DataProducto->getStock();
			$estado = $DataProducto->getEstado();
			$imagen = $DataProducto->getImagen();	
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `productos` SET `NombreProducto`='$nombreProducto',`Descripcion`='$descripcion',`ValorUnitario`='$valorUnitario',`Categoria`='$categoria',`Subcategoria`='$subcategoria',`Stock`='$stock',`Estado`='$estado',`Imagen`='$imagen',`hora_maxima`='$tiempo',`tiempo_cancelacion`='$tiempoc',`edad`='$edadMinima',`edad_max`='$edad' WHERE `codigoProducto`='$codigoProducto'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		/*public function ExisteUsuario($idUsuario){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `usuarios` WHERE `idUsuario`='$idUsuario'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			
			if($registro != null){
				$existe = true;				
			}
			return $existe;
		}*/
		public function ListarProductosPorSubCategoria($subcategoria){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			$query = "SELECT * FROM `productos` WHERE `Subcategoria`='$subcategoria' AND `Estado`='ACTIVO' ORDER BY `NombreProducto` ASC";
					
			$result = mysqli_query($conexion, $query);
			$numeroFilas = mysqli_num_rows($result);
			if($numeroFilas > 0){
				while($registro = mysqli_fetch_array($result)){
					
					if($contador == 1){
						$jsonAcudientes .= json_encode($registro);	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',' . json_encode($registro);
						}
					}
					$contador+=1;
				}	
			}
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		public function ListarProductosSubCategoria($subcategoria, $dia, $idUsuario, $idCredencial){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			if($subcategoria == "53"){
				$queryCambioMenu = "SELECT dm . * , m . * , p.Descripcion AS Proteina FROM  `detallenenudia` dm INNER JOIN proteinas p ON p.id = dm.`idProteina` INNER JOIN  `menudia` m ON m.id = dm.idMenuDia WHERE dm.`idUsuario` =  '$idUsuario' AND dm.`Dia`=$dia ORDER BY dm.`fecha` DESC , dm.`hora` DESC LIMIT 1";
				$resultCambioMenu = mysqli_query($conexion, $queryCambioMenu);
				$numeroFilasCambioMenu = mysqli_num_rows($resultCambioMenu);
				
				if($numeroFilasCambioMenu > 0){
					$registroCambioMenu = mysqli_fetch_array($resultCambioMenu);
					$query = "SELECT p.* FROM `productos` p WHERE p.`Subcategoria`='$subcategoria' AND p.`Estado`='ACTIVO' AND p.`Stock` > 0 AND (SELECT COUNT(*) FROM restriccion r WHERE r.Log = p.`codigoProducto` AND r.Tipo = 'PORPRODUCTO' AND r.idEstudiante = '$idCredencial') = 0 ORDER BY p.`NombreProducto` ASC";
					
					$result = mysqli_query($conexion, $query);
					
					if($result != null){
						$numeroFilas = mysqli_num_rows($result);
						
						while($registro = mysqli_fetch_array($result)){
							$codigoProducto = $registro["codigoProducto"];	
							$NombreProducto = $registroCambioMenu["Nombre"];	
							$Descripcion = $registroCambioMenu["Proteina"] . ", " . $registroCambioMenu["Descripcion"];							
							$ValorUnitario = $registro["ValorUnitario"];	
							$Categoria = $registro["Categoria"];	
							$Subcategoria = $registro["Subcategoria"];	
							$Stock = $registro["Stock"];	
							$Estado = $registro["Estado"];	
							$Imagen = $registroCambioMenu["Foto"];
							$resultado = str_replace("/", "\/", $Imagen);
							$resultadoDescripcion = str_replace("\n", ", ", $Descripcion);
							
							if($contador == 1){
								$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
							}else{
								if($contador <= $numeroFilas && $contador != 1){
									$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
								}
							}
							$contador+=1;
						}	
					}
				}else{
					$queryMenu = "SELECT m.*, p.Descripcion AS Proteina FROM `menudia` m INNER JOIN proteinas p on p.id = m.`idProteina` WHERE m.`Dia`=$dia";
					$resultMenu = mysqli_query($conexion, $queryMenu);
					$numeroFilasMenu = mysqli_num_rows($resultMenu);
					if($numeroFilasMenu > 0){
					
						$registroMenu = mysqli_fetch_array($resultMenu);
						
						$query = "SELECT p.* FROM `productos` p WHERE p.`Subcategoria`='$subcategoria' AND p.`Estado`='ACTIVO' AND p.`Stock` > 0 AND (SELECT COUNT(*) FROM restriccion r WHERE r.Log = p.`codigoProducto` AND r.Tipo = 'PORPRODUCTO' AND r.idEstudiante = '$idCredencial') = 0 ORDER BY p.`NombreProducto` ASC";
						
						$result = mysqli_query($conexion, $query);
						
						if($result != null){
							$numeroFilas = mysqli_num_rows($result);
							
							while($registro = mysqli_fetch_array($result)){
								$codigoProducto = $registro["codigoProducto"];	
								$NombreProducto = $registroMenu["Nombre"];	
								$Descripcion = $registroMenu["Proteina"] . ", " . $registroMenu["Descripcion"];							
								$ValorUnitario = $registro["ValorUnitario"];	
								$Categoria = $registro["Categoria"];	
								$Subcategoria = $registro["Subcategoria"];	
								$Stock = $registro["Stock"];	
								$Estado = $registro["Estado"];	
								$Imagen = $registroMenu["Foto"];
								$resultado = str_replace("/", "\/", $Imagen);
								$resultadoDescripcion = str_replace("\n", ", ", $Descripcion);
								
								if($contador == 1){
									$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
								}else{
									if($contador <= $numeroFilas && $contador != 1){
										$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $resultadoDescripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $resultado . '"}';	
									}
								}
								$contador+=1;
							}	
						}
					}else{
						echo "[]";
					}
				}
			}else{
				$query = "SELECT productos.* FROM `productos` WHERE productos.`Subcategoria`='$subcategoria' AND productos.`Estado`='ACTIVO' AND productos.`Stock` > 0 ORDER BY productos.`NombreProducto` ASC";
				
				$result = mysqli_query($conexion, $query);
				
				if($result != null){
					$numeroFilas = mysqli_num_rows($result);
					
					while($registro = mysqli_fetch_array($result)){
						$codigoProducto = $registro["codigoProducto"];	
						$NombreProducto = $registro["NombreProducto"];	
						$Descripcion = $registro["Descripcion"];	
						$ValorUnitario = $registro["ValorUnitario"];	
						$Categoria = $registro["Categoria"];	
						$Subcategoria = $registro["Subcategoria"];	
						$Stock = $registro["Stock"];	
						$Estado = $registro["Estado"];	
						$Imagen = $registro["Imagen"];
						
						$queryRestriccion = "SELECT COUNT(*) AS filas FROM restriccion r WHERE r.Log = '$codigoProducto' AND r.Tipo = 'PORPRODUCTO' AND r.idEstudiante = '$idCredencial'";
						$resultRestriccion = mysqli_query($conexion, $queryRestriccion);
						$estadoRestriccion = "";
						$registroRestriccion = mysqli_fetch_array($resultRestriccion);

						if($registroRestriccion["filas"] > 0){
							$estadoRestriccion = "SI";
						}else{
							$estadoRestriccion = "NO";
						}
						if($contador == 1){
							$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "Restriccion":"' . $estadoRestriccion . '"}';	
						}else{
							if($contador <= $numeroFilas && $contador != 1){
								$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "Restriccion":"' . $estadoRestriccion . '"}';	
							}
						}
						$contador+=1;
					}	
				}
			}
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ListarProductos(){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT p.*, c.Nombre AS NombreCategoria, sc.Nombre AS NombreSubCategoria FROM productos p, categoria c, `sub-categoria` sc WHERE p.Categoria = c.codigo AND sc.codigo = p.Subcategoria ORDER BY p.NombreProducto ASC";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$codigoProducto = $registro["codigoProducto"];	
					$NombreProducto = $registro["NombreProducto"];	
					$Descripcion = $registro["Descripcion"];	
					$ValorUnitario = $registro["ValorUnitario"];	
					$Categoria = $registro["Categoria"];	
					$Subcategoria = $registro["Subcategoria"];	
					$Stock = $registro["Stock"];	
					$Estado = $registro["Estado"];	
					$Imagen = $registro["Imagen"];
					$NombreCategoria = $registro["NombreCategoria"];
					$NombreSubCategoria = $registro["NombreSubCategoria"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "NombreCategoria":"' . $NombreCategoria . '", "NombreSubCategoria":"' . $NombreSubCategoria . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "NombreCategoria":"' . $NombreCategoria . '", "NombreSubCategoria":"' . $NombreSubCategoria . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarProductos($codigo){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `productos` WHERE `codigoProducto`='$codigo' ORDER BY `NombreProducto` ASC";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$codigoProducto = $registro["codigoProducto"];	
					$NombreProducto = $registro["NombreProducto"];	
					$Descripcion = $registro["Descripcion"];	
					$ValorUnitario = $registro["ValorUnitario"];	
					$Categoria = $registro["Categoria"];	
					$Subcategoria = $registro["Subcategoria"];	
					$Stock = $registro["Stock"];	
					$Estado = $registro["Estado"];	
					$Imagen = $registro["Imagen"];
					$horamaxima = $registro["hora_maxima"];
					$tiempocancelacion = $registro["tiempo_cancelacion"];
					$edad = $registro["edad"];
					$edad_max = $registro["edad_max"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "horamaxima":"' . $horamaxima . '", "tiempocancelacion":"' . $tiempocancelacion . '", "edad":"' . $edad . '", "edad_max":"' . $edad_max . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '", "horamaxima":"' . $horamaxima . '", "tiempocancelacion":"' . $tiempocancelacion . '", "edad":"' . $edad . '", "edad_max":"' . $edad_max . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function DisminuirStock($codigoProducto, $cantidad, $session, $origen){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			$cantidadActual = $registro["Stock"];
			$total = $cantidadActual - $cantidad;
			
			$queryLog  = "INSERT INTO `Log_inventario`(`codigoProducto`, `fecha`, `hora`, `stock_inicial`, `cantidad_agregar`, `stock_final`, `session`, `origen`) VALUES ('$codigoProducto',CURDATE(),curTime(),'$cantidadActual','$cantidad','$total','$session','$origen')";
			$resultLog = mysqli_query($conexion, $queryLog);

			$queryUpdate = "UPDATE `productos` SET `Stock`= $total WHERE `codigoProducto`='$codigoProducto'";
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			return $resultUpdate;
		}
		
		public function AumentarStock($codigoProducto, $cantidad, $session, $origen){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			$cantidadActual = $registro["Stock"];
			$total = $cantidadActual + $cantidad;

			$queryLog  = "INSERT INTO `Log_inventario`(`codigoProducto`, `fecha`, `hora`, `stock_inicial`, `cantidad_agregar`, `stock_final`, `session`, `origen`) VALUES ('$codigoProducto',CURDATE(),curTime(),'$cantidadActual','$cantidad','$total','$session','$origen')";
			$resultLog = mysqli_query($conexion, $queryLog);

			$queryUpdate = "UPDATE `productos` SET `Stock`= $total WHERE `codigoProducto`='$codigoProducto'";
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			return $resultUpdate;
		}
		
		public function CambiarStock($codigoProducto, $cantidad){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$queryUpdate = "UPDATE `productos` SET `Stock`= $cantidad WHERE `codigoProducto`='$codigoProducto'";
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			return $resultUpdate;
		}
		
		
	}
?>