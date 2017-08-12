<?PHP
//proceso para visualizar pdf's guardados 
$valor = $_REQUEST["o"];
$ruta = "./pdfgenerados/".$valor.".pdf";
$tam = filesize($ruta);

header("Content-type: application/pdf");
header("Content-Length: $tam"); 
header("Content-Disposition: inline; filename=proyecto.pdf");
$file='./pdfgenerados/'.$valor.'.pdf';

readfile($file);
?>