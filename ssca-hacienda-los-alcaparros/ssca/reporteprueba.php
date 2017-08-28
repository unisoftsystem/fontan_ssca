<div style="width: 730px; margin: 20px auto; font-family:sans-serif;">
<?php 
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();  
  ?> 
<?php
 require_once 'GoogChart.class.php';


$consulta = mysql_query("SELECT  * FROM `movimientos` INNER JOIN ordenpedido ON movimientos.idCredencial = ordenpedido.idCredencial WHERE SUBSTRING(FechaMovimiento FROM 1 FOR 7) =  SUBSTRING(CURRENT_date - INTERVAL 1 MONTH FROM 1 FOR 7) GROUP BY  `DescripcionPedido` ORDER BY  `DescripcionPedido` DESC LIMIT 0 , 10");



$i=0;
while($row = mysql_fetch_array($consulta))
{
$empresa[$i]=$row["DescripcionPedido"];
echo $empresa[$i];
$ventas2008[$i]=$row["ValorMovimiento"];
echo $ventas2008[$i];
$ventas2009[$i]=$row["ConsecutivoInterno"];
echo $ventas2009[$i];
$i++;
}


$chart = new GoogChart( );
$color = array ( '#95b645', '#7498e9', '#999999',);


$dataMultiple = array(
'Año 2009' => array(
$empresa[0] => $ventas2009[0],
$empresa[1] => $ventas2009[1],
$empresa[2] => $ventas2009[2],
),
'Año 2008' => array(
$empresa[0] => $ventas2008[0],
$empresa[1] => $ventas2008[1],
$empresa[2] => $ventas2008[2],
),
);



echo '<h2>MERCADO DE VIDEOJUEGOS</h2>';
$chart->setChartAttrs( array(
'type' => 'bar-vertical',
'title' => 'Ventas: ',
'data' => $dataMultiple,
'size' => array( 550, 300 ),
'color' => $color,
'labelsXY' => true,
));

?>
</div>