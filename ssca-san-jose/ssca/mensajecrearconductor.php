<?php
 $valor = $_REQUEST["NoIdentificacion"];
 $valor1 = $_REQUEST["PrimerNombre"];
 $valor2 = $_REQUEST["segundonombre"];
 $valor3 = $_REQUEST["PrimerApellido"];
 $valor4 = $_REQUEST["segundoapellido"];
 $valor5 = $_REQUEST["Direccion"];
 $valor6 = $_REQUEST["Telefono1"];
 $valor7 = $_REQUEST["Telefono2"];
 $valor8 = $_REQUEST["TipoIdentificacion"];
 $valor9 = $_REQUEST["LicenciaNo"];
 $valor10 = $_REQUEST["Email"];
 $valor11 = $_REQUEST["c"];

 require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO conductor(idconductor,nombre,nombre2,apellido,apeliido2,direccion,telefono,telefono2,Tipoidentificacion,licencianumero,email) VALUES('".$valor."', '".$valor1."', '".$valor2."', '".$valor3."' , '".$valor4."', '".$valor5."', '".$valor6."', '".$valor7."', '".$valor8."', '".$valor9."', '".$valor10."')");
    // check if row inserted or not

    if ($result) {
        // successfully inserted into database
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Insersion Exitosa de Conductor";
        echo "</div>";
    } else {
        // failed to insert row
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Insersion Fallida de Conductor";
        echo $result;
        echo "</div>";
    }


    define('UPLOAD_DIR', 'images/');
    if($_POST['c'] != ""){
        $img = $_POST['c'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . $valor . '.png';
        $success = file_put_contents($file, $data);
    }


?>