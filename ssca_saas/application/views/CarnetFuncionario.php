<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Carnet</title>
<style>
	{
		margin:0;
		padding:0;
	}
	@font-face {
		font-family: "SegoeUiBold";
		src: url(<?= base_url(1);?>fonts/SEGOEUIB.ttf) format("truetype");
	}
	@font-face {
		font-family: "SegoeUiNormal";
		src: url(<?= base_url(1);?>fonts/SEGOEUI.ttf) format("truetype");
	}
	.tabla1{
		border-radius:16px;
		width:470px; 
		height:305px; 
		padding:0; 
		float:left;
		background-color: #FFF;
		margin-left:-8px;
		margin-top:-8px;
	}
	.tabla2{
		width:470px; 
		height:305px; 
		padding:0; 
		float:left;
		border-radius:16px;
		background-color: #FFF;
		margin-left:-8px;
	}
	#foto{
		border-style:solid; 
		border-width:1px; 
		border-color:#999; 
		margin-top:0px; 
		margin-left:0px; 
		float:left;
	}
	#imageQR{
		border:0;
		margin-top:18px; 
		margin-right:56px;
		float:right;
	}
	.bold{
		font-family:'SegoeUiBold'; 
		font-size:13pt;

	}
	.normal{
		font-family:'SegoeUiNormal'; 
		font-size:13pt;

	}
	.paralelogramo {
		width: 300px; 
		height: 70px;  
		/*background: #039;
		-webkit-transform: skew(20deg);
		-moz-transform: skew(20deg);
		-ms-transform: skew(20deg);
		-o-transform: skew(20deg);
		transform: skew(20deg);*/
		background-image:url(<?= base_url(1);?>images/barra-partea.png);
		background-size: 100% 100%;
		background-repeat: no-repeat;
		float:right;
		font-style:normal;
		color:#FFF;
		margin-top:9px;
		right:0;
	}
	.paralelogramo3 {
		width: 150px; 
		height: 35px;  
		background-image:url(<?= base_url(1);?>images/lobena.png);
		background-size: 100% 100%;
		background-repeat: no-repeat;
		float:right;
		font-style:normal;
		color:#FFF;
		margin-top:25px;
	}
	
	.paralelogramo4 {
		width: 100%; 
		height: 70px;  
		background-image:url(<?= base_url(1);?>images/barra-parteb.png);
		background-size: 100% 100%;
		background-repeat: no-repeat;
		margin-top:210px;
		z-index:1;
	}
	.paralelogramo2 {
		 width: 30%; 
		 height: 70px;  
		 background: #039;
		 -webkit-transform: skew(0deg);
		 -moz-transform: skew(0deg);
		 -ms-transform: skew(0deg);
		 -o-transform: skew(0deg);
		 transform: skew(0deg);
		 float:right;
		 margin-top:-70px;
	}
	.textoRecuadro{
		 margin-top:25px; 
		width:100%;
		margin-right:60px;
		color:#FFF;
		letter-spacing:2px;
		float:right;
		font-family:'SegoeUiNormal'; 
		font-size:10pt;
	}
	.textoRecuadro2{
		margin-top:10px; 
		position:absolute; 
		font-family:'SegoeUiNormal'; 
		font-size:10pt;
		margin-left:30px;
		color:#FFF;
		letter-spacing:3px;
	}
	.lblNombre{
		float:left; 
		margin-top:60px; 
		width:200px; 
		margin-left:15px;
	}
	.lblApellidos{
		float:left;
		margin-left:15px;
		width:200px;
		margin-top:0px;
	}
	.lblDescripcion{
		float:left;
		margin-left:15px;
		width:90%;
		margin-top:0px;
	}
	.lblOtro{
		float:left;
		margin-left:15px; 
		margin-top:0px;
	}
	.logoCarnet{
		float:right; 
		margin-top:-15px; 
		margin-right:0px; 
		right: 10px;
		position:absolute;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
	<div class="tabla1">
	   <div style="width: 145px; height:170px; background-color: #FFF; margin-top:40px; margin-left: 15px; position: relative"><img src="?= base_url(1);?>images/stock_people.png" width="100%" height="100%" id="foto"/></div>
		
		<div style="position: absolute; margin-top:-190px; float: right; width:300px; /*border: solid #000;*/ margin-left:159px">
			<img src="?= base_url(1);?>images/LOGO HORIZONTAL AZUL_ALTA.png" width="140" class="logoCarnet"/>
			<label class="bold lblNombre" id="bNombre"></label><br>
			<label class="bold lblApellidos" id="bApellido"></label><br>
			<label class="normal lblDescripcion" id="numeroId"></label><br>
            <label class="normal lblDescripcion" id="tipoSangre"></label><br>
        	<label class="normal lblDescripcion" id="curso"></label>
		</div>
        
       	<div class="paralelogramo" align="right"><label class="textoRecuadro" style="" id="fechaVencimiento"></label></div>
        <div class="paralelogramo3">&nbsp;</div>
    </div>
	
    <div class="tabla2">
	   <img src="" width="170" height="170" id="imageQR"/>
		<label class="bold lblOtro" style="text-align:center; margin-top:33px; width:216px">Este carné es personal e instransferible</label>
        <label class="normal lblOtro" style="text-align:center; margin-top:32px; width:226px">En caso de pérdida, por favor informar a pbx: 676 1666</label>
        <div class="paralelogramo4">
        	<label class="textoRecuadro2" style="margin-top:5px">WWW.FONTAN.COM.CO</label>
        	<label class="textoRecuadro2" style="margin-top:22px;">Pbx: 676 1666</label>
            <label class="textoRecuadro2" style="margin-top:35px;">Cra. 7. Km 14. Vereda Fusca, Sector Torca,</label>
            <label class="textoRecuadro2" style="margin-top:50px;">Ch&iacute;a, Cundinamarca</label>
        </div>
    </div>
   
    
   <!-- <button id="btnImprimir" name="btnImprimir">IMPRIMIR</button>-->
    <script type="text/javascript">
		window.addEventListener('load',init);
	function init(){
		var resultado = localStorage.getItem("Resultado"); 
		console.log(resultado);
		var usuarioSesion = localStorage.getItem("usuario"); 
		
		var jsonUsuario = JSON.parse(resultado);
		/*var jsonUsuario = [{
			nombre: "Shelvin",
			apellido: "Batista Batista",
			tipo: "Estudiante",
			foto: "images/56814e8a17ec2.png",
			credencial: "19f90f98-9844-11e5-96ac",
			arl: "Sura",
			tipoSangre: "B+"
		}]*/
		console.log(JSON.stringify(jsonUsuario));
		//if(jsonUsuario.length > 0){
			$.each(jsonUsuario, function(i, item) {
								
				var datos = {
					data: jsonUsuario[i].credencial
				}	
				//console.log(jsonUsuario[i].tipoSangre);
				$("#bNombre").html(jsonUsuario[i].nombre)
				$("#bApellido").html(jsonUsuario[i].apellido)
				$("#numeroId").html(jsonUsuario[i].numeroId)
				$("#foto").attr("src", "?= base_url(1);?>" + jsonUsuario[i].foto);
				$("#fechaVencimiento").html("VENCE: " + jsonUsuario[i].fechaVencimiento)
				$("#curso").html("ARL: " + jsonUsuario[i].arl);				
				$("#tipoSangre").html("RH: " + jsonUsuario[i].tipoSangre);
				
				
				$.post("<?= base_url();?>index.php/credenciales/generarQR", datos)
				.done(function( respuesta ) {console.log(respuesta)
					$("#imageQR").attr("src", "<?= base_url(1);?>" + respuesta);
				});			
				
			})
		//}
		
		
		
	}
	$("#btnImprimir").click(function(e) {
        window.print()
		 
    });
	</script>
    
	
</body>
</html>
