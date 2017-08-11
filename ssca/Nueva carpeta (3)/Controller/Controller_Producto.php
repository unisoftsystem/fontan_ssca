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
			$categoria = $DataProducto->getCategoria();
			$subcategoria = $DataProducto->getSubcategoria();
			$stock = $DataProducto->getStock();
			$estado = $DataProducto->getEstado();
			$imagen = $DataProducto->getImagen();	
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `productos`(`codigoProducto`, `NombreProducto`, `Descripcion`, `ValorUnitario`, `Categoria`, `Subcategoria`, `Stock`, `Estado`, `Imagen`) VALUES (NULL,'$nombreProducto','$descripcion','$valorUnitario','$categoria','$subcategoria','$stock','estado','$imagen')";
			
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
			$stock = $DataProducto->getStock();
			$estado = $DataProducto->getEstado();
			$imagen = $DataProducto->getImagen();	
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `productos` SET `NombreProducto`='$nombreProducto',`Descripcion`='$descripcion',`ValorUnitario`='$valorUnitario',`Categoria`='$categoria',`Subcategoria`='$subcategoria',`Stock`='$stock',`Estado`='$estado',`Imagen`='$imagen' WHERE `codigoProducto`='$codigoProducto'";
			
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
		
		public function ListarProductosSubCategoria($subcategoria){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `productos` WHERE `Subcategoria`='$subcategoria' AND `Estado`='ACTIVO' AND `Stock` > 0";
			
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
					
					if($contador == 1){
						$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '"}';	
						}
					}
					$contador+=1;
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
			
			$query = "SELECT * FROM `productos`";
			
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
					
					if($contador == 1){
						$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '"}';	
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
			
			$query = "SELECT * FROM `productos` WHERE `codigoProducto`='$codigo'";
			
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
					
					if($contador == 1){
						$jsonAcudientes .= '{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"codigoProducto":"' . $codigoProducto . '", "NombreProducto":"' . $NombreProducto . '", "Descripcion":"' . $Descripcion . '", "ValorUnitario":"' . $ValorUnitario . '", "Categoria":"' . $Categoria . '", "Subcategoria":"' . $Subcategoria . '", "Stock":"' . $Stock . '", "Estado":"' . $Estado . '", "Imagen":"' . $Imagen . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function DisminuirStock($codigoProducto, $cantidad){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			$cantidadActual = $registro["Stock"];
			$total = $cantidadActual - $cantidad;
			
			$queryUpdate = "UPDATE `productos` SET `Stock`= $total WHERE `codigoProducto`='$codigoProducto'";
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			return $resultUpdate;
		}
		
		public function AumentarStock($codigoProducto, $cantidad){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `productos` WHERE `codigoProducto`='$codigoProducto'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			$cantidadActual = $registro["Stock"];
			$total = $cantidadActual + $cantidad;
			
			$queryUpdate = "UPDATE `productos` SET `Stock`= $total WHERE `codigoProducto`='$codigoProducto'";
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			return $resultUpdate;
		}
		
		
	}
?>