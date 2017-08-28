
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$query  = "SELECT * FROM usuarios where `TipoUsuario`='Estudiante' AND `idAcudiente` !=  ''";
    $result = mysql_query($query);
	$contador = 0;
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$idUsuario = stripslashes($registro["idUsuario"]);	
		$idAcudiente = stripslashes($registro["idAcudiente"]);	

		$queryUpdate = "UPDATE `credenciales` SET `idUsuarioPrincipal`= '$idAcudiente' WHERE `idUsuarioSecundario`='$idUsuario'";
			
		$resultUpdate = mysql_query($queryUpdate);
		$contador++;
	}	
	echo mysql_num_rows($result)	. "<br><br>" . $contador;
	
?>