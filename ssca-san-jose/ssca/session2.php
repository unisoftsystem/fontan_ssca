<?php
//funcion de consulta usuario
function verificar_login($user,$password,&$result) {
    $sql = "SELECT * FROM `usuarios_sistema` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `Estado`='ACTIVO'";	
    $rec = mysql_query($sql);
    $count = 0;
    while($row = mysql_fetch_object($rec))
    {
        $count++;
        $result = $row;
    }
    if($count == 1)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}
//verificando sesiones al pasar a menu
if(!isset($_SESSION['userid']))
{
	if(empty($_SESSION['login']))
{
}else{	
}
?>