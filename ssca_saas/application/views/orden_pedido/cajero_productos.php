	<?php
	    $UserNameSession = $this->session->userdata('UserNameInternoSSCA');
	    if(empty($UserNameSession)) { // Recuerda usar corchetes.
	        header('Location: ' . base_url(1));
	    }

	?>
	<script type="text/javascript">
	    function nobackbutton(){
	       window.location.hash="no-back-button";
	       window.location.hash="Again-No-back-button" 
	       window.onhashchange=function(){window.location.hash="no-back-button";} 
	    }
    </script>
	<style type="text/css">
		input{
			border-radius: 4px;
		}
		body {
				padding: 60px 0px;
				background-color: rgb(220, 220, 220);
			}
	
		@import url("http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic");
		@import url("//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
		

		.event-list {
			list-style: none;
			font-family: 'Lato', sans-serif;
			margin: 0px;
			padding: 0px;
		}
		.event-list > li {
			background-color: rgb(255, 255, 255);
			box-shadow: 0px 0px 5px rgb(51, 51, 51);
			box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
			padding: 0px;
			margin: 0px 0px 20px;
		}
		.event-list > li > time {
			display: inline-block;
			width: 100%;
			color: rgb(255, 255, 255);
			background-color: rgb(68, 59, 199);
			padding: 5px;
			text-align: center;
			text-transform: uppercase;
		}
		.event-list > li:nth-child(even) > time {
			background-color: rgb(165, 82, 167);
		}
		.event-list > li > time > span {
			display: none;
		}
		.event-list > li > time > .day {
			display: block;
			font-size: 56pt;
			font-weight: 100;
			line-height: 1;
		}
		.event-list > li time > .month {
			display: block;
			font-size: 24pt;
			font-weight: 900;
			line-height: 1;
		}
		.event-list > li > img {
			width: 100%;
		}
		.event-list > li > .info {
			padding-top: 5px;
			text-align: center;
		}
		.event-list > li > .info > .title {
			font-size: 17pt;
			font-weight: 700;
			margin: 0px;
		}
		.event-list > li > .info > .desc {
			font-size: 13pt;
			font-weight: 300;
			margin: 0px;
		}
		.event-list > li > .info > ul,
		.event-list > li > .social > ul {
			display: table;
			list-style: none;
			margin: 10px 0px 0px;
			padding: 0px;
			width: 100%;
			text-align: center;
		}
		.event-list > li > .social > ul {
			margin: 0px;
		}
		.event-list > li > .info > ul > li,
		.event-list > li > .social > ul > li {
			display: table-cell;
			cursor: pointer;
			color: rgb(30, 30, 30);
			font-size: 11pt;
			font-weight: 300;
			padding: 3px 0px;
		}
		.event-list > li > .info > ul > li > a {
			display: block;
			width: 100%;
			color: rgb(30, 30, 30);
			text-decoration: none;
		} 
		.event-list > li > .social > ul > li {    
			padding: 0px;
		}
		.event-list > li > .social > ul > li > a {
			padding: 3px 0px;
		} 
		.event-list > li > .info > ul > li:hover,
		.event-list > li > .social > ul > li:hover {
			color: rgb(30, 30, 30);
			background-color: rgb(200, 200, 200);
		}
		.facebook a,
		.twitter a,
		.google-plus a {
			display: block;
			width: 100%;
			color: rgb(75, 110, 168) !important;
		}
		.twitter a {
			color: rgb(79, 213, 248) !important;
		}
		.google-plus a {
			color: rgb(221, 75, 57) !important;
		}
		.facebook:hover a {
			color: rgb(255, 255, 255) !important;
			background-color: rgb(75, 110, 168) !important;
		}
		.twitter:hover a {
			color: rgb(255, 255, 255) !important;
			background-color: rgb(79, 213, 248) !important;
		}
		.google-plus:hover a {
			color: rgb(255, 255, 255) !important;
			background-color: rgb(221, 75, 57) !important;
		}

		@media (min-width: 768px) {
			.event-list > li {
				position: relative;
				display: block;
				width: 100%;
				height: 120px;
				padding: 0px;
			}
			.event-list > li > time,
			.event-list > li > img  {
				display: inline-block;
			}
			.event-list > li > time,
			.event-list > li > img {
				width: 120px;
				float: left;
			}
			.event-list > li > .info {
				background-color: rgb(245, 245, 245);
				overflow: hidden;
			}
			.event-list > li > time,
			.event-list > li > img {
				width: 120px;
				height: 120px;
				padding: 0px;
				margin: 0px;
			}
			.event-list > li > .info {
				position: relative;
				height: 120px;
				text-align: left;
				padding-right: 40px;
			} 
			.event-list > li > .info > .title, 
			.event-list > li > .info > .desc {
				padding: 0px 10px;
			}
			.event-list > li > .info > ul {
				position: absolute;
				left: 0px;
				bottom: 0px;
			}
			.event-list > li > .social {
				position: absolute;
				top: 0px;
				right: 0px;
				display: block;
				width: 40px;
			}
			.event-list > li > .social > ul {
				border-left: 1px solid rgb(230, 230, 230);
			}
			.event-list > li > .social > ul > li {      
				display: block;
				padding: 0px;
			}
			.event-list > li > .social > ul > li > a {
				display: block;
				width: 40px;
				padding: 10px 0px 9px;
			}
		}
		.list-group.panel > .list-group-item {
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px
		}
		.list-group-submenu {
			margin-left:20px;
		}
		.clearFix
	    {
	        clear:both;
	    }
	    .panel.panel-chat
	    {
	        position: fixed;
	        bottom:0;
	        right:0;
	        max-width: 350px;
	        width: 350px;
	        box-shadow: none;
	        -webkit-box-shadow: none;            
	    }
	    
	    .panel-heading{
	        padding: 10px 10px 10px 10px;
	    }
	    .panel.panel-chat .panel-heading
	    {
	        background: #4b67a8;
	        border: 1px solid #2e4588;
	        color:#FFF;
	    }
	    
	    .panel.panel-chat
	    {
	        display: block;
	        padding: 0;
	        margin: 0;
	        border-left: 1px solid #b2b2b2;
	        border-right: 1px solid #b2b2b2;
	        background: #EDEFF4;
	        overflow: auto;
	    }
	    .panel-body
	    {
	        display: block;
	        padding: 0;
	        margin: 0;
	        max-height: 350px;
	        height: 350px;
	        border-left: 1px solid #b2b2b2;
	        border-right: 1px solid #b2b2b2;
	        overflow: auto;
	    }
	    
	    .panel.panel-chat .panel-body .messageMe
	    {
	        border-bottom:1px dotted #b2b2b2;
	         margin-top: 10px;
	    }
	    .panel.panel-chat .panel-body .messageMe img
	     {
	         float:left;
	         width: 50px;             
	        max-height: 50px;
	     }
	    .panel.panel-chat .panel-body .messageMe span
	    {
	        display: block;
	        float:left;
	        padding: 5px;
	        background: #FFF;
	        min-height: 50px;
	        max-width: 90%;
	        height: 50px;
	        width: 100%;
	        word-break: break-all;
	    }
	    .panel.panel-chat .panel-body .messageHer
	    {
	        border-bottom:1px dotted #b2b2b2;
	         margin-top: 10px;
	    }
	    .panel.panel-chat .panel-body .messageHer img
	    {
	        float:right;
	        max-width: 10%;
	         max-height: 50px;
	    }
	    .panel.panel-chat .panel-body .messageHer span
	    {
	        display: block;
	        float:right;
	        padding: 5px;
	        background: #A9D0F5;
	        min-height: 50px;
	        max-width: 90%;
	        width: auto;
	        height: 50px;
	        width: 100%;
	        word-break: break-all;
	    }
	    .panel.panel-chat .panel-footer
	    {
	        padding: 0;
	        margin: 0;
	        border: 1px solid #b2b2b2;
	        max-height: 75px;
	        height: 37px;
	        resize: none;
	        bottom: 0;
	    }
	    .panel.panel-chat .panel-footer textarea
	    {
	        margin-bottom: -5px;
	        resize: none;
	        width: 100%;
	        height: 100%;
	    }

	    .chat-box
	    {
	        width: 100%;
	    }

	    .header
	    {
	        padding: 10px;
	        color: white;
	        font-size: 14px;
	        font-weight: bold;
	        background-color: #6d84b4;
	    }

	    

	    .panel-body ul
	    {
	        padding: 0px;
	        list-style-type: none;
	    }

	    .panel-body ul li
	    {
	        height: auto;
	        margin-bottom: 10px;
	        clear: both;
	        padding-left: 10px;
	        padding-right: 10px;
	    }

	    .panel-body ul li img
	    {
	        display: inline-block;
	        max-width: 15%;
	        width: 15%;  
	        float: left;       
	    }

	    .panel-body ul li span
	    {
	        display: inline-block;
	        max-width: 80%;
	        background-color: white;
	        padding: 5px;
	        border-radius: 4px;
	        position: relative;
	        border-width: 1px;
	        border-style: solid;
	        border-color: grey;
	        text-align: left;
	    }

	    .panel-body ul li span.left
	    {
	        float: left;
	        background-color: #fff;
	        left:10px;
	        top: 6px;
	        bottom: 5px;
	    }

	    .panel-body ul li span.left:after
	    {
	        content: "";
	        display: inline-block;
	        position: absolute;
	        left: -8px;
	        top: 6px;
	        height: 0px;
	        width: 0px;
	        border-top: 8px solid transparent;
	        border-bottom: 8px solid transparent;
	        border-right: 8px solid #fff;
	    }

	    .panel-body ul li span.left:before
	    {
	        content: "";
	        display: inline-block;
	        position: absolute;
	        left: -9px;
	        top: 6px;
	        height: 0px;
	        width: 0px;
	        border-top: 8px solid transparent;
	        border-bottom: 8px solid transparent;
	        border-right: 8px solid black;
	    }

	    .panel-body ul li span.right:after
	    {
	        content: "";
	        display: inline-block;
	        position: absolute;
	        right: -8px;
	        top: 6px;
	        height: 0px;
	        width: 0px;
	        border-top: 8px solid transparent;
	        border-bottom: 8px solid transparent;
	        border-left: 8px solid #dbedfe;
	    }

	    .panel-body ul li span.right:before
	    {
	        content: "";
	        display: inline-block;
	        position: absolute;
	        right: -9px;
	        top: 6px;
	        height: 0px;
	        width: 0px;
	        border-top: 8px solid transparent;
	        border-bottom: 8px solid transparent;
	        border-left: 8px solid black;
	    }

	    .panel-body ul li span.right
	    {
	        float: right;
	        background-color: #dbedfe;
	        top: 6px;
	    }

	    .clear
	    {
	        clear: both;
	    }
	    .windowHidden{
	        position: absolute; 
	        bottom: 0;
	        right: 720px;
	    }
	    .windowHidden > li > ul > li:hover{
	        background: #4b67a8;
	        border: 1px solid #2e4588;
	        color:#FFF;
	        cursor: pointer;
	    }

	    .windowHidden > li > ul > li{
	        padding: 10px;
	    }

	    .windowHidden > li > ul{
	        width: 100%;
	    }
    </style>
    <?php
        $UserName = $this->session->userdata('idUsuarioApp');
        if(empty($UserName)) { // Recuerda usar corchetes.
            header('Location: ' . base_url(1) . "index.php/ordenpedido/cajero");
        }   
    ?>
	<body id="bodyBase" onload="nobackbutton();">
		<ul class="nav navbar-nav windowHidden" style="display: none;">                
	        <li class="dropup">
	            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background: #4b67a8;
	        border: 1px solid #2e4588; color:#FFF;width: 350px; height: 42px; border-radius: 2px"><i class="fa fa-chevron-up"></i></a>
	            <ul class="dropdown-menu">
	            </ul>
	        </li>
	    </ul>
		<button class="btn btn-primary" style="margin-top: -50px; position: absolute; right: 20px" id="btnCancelar" name="btnCancelar">CANCELAR</button><br>
		<div style="margin-top: -25px">
			<input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
			<input type="hidden" id="txtIdcredencial" name="txtIdcredencial" value="<?= $this->session->userdata('idCredencialSesion');?>" />
			<input type="hidden" id="txtSubCategoriaEscogida" name="txtSubCategoriaEscogida" value="" />
			<input type="hidden" id="txtIdusuario" name="txtIdusuario" value="<?= $this->session->userdata('idUsuarioApp');?>" />
			<input type="hidden" id="txtValorRestriccion" name="txtValorRestriccion" value="<?= $this->session->userdata('ValorRestriccion');?>" />
			<input type="hidden" id="txtSaldoOculto" name="txtSaldoOculto" value="<?= $this->session->userdata('SaldoCredencial');?>" />

			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="10px">&nbsp;</td>
					<td><label for="txtPrimerApellido"><font color="#00C">Primer Apellido</font></label></td>
					<td width="10px">&nbsp;</td>
					<td><input type="text" disabled id="txtPrimerApellido" name="txtPrimerApellido" class="form-control" value="<?= $this->session->userdata('PrimerApellidoUsuarioSesionApp');?>"/></td>

					<td width="10px">&nbsp;</td>

					<td><label for="txtSegundoApellido"><font color="#00C">Segundo Apellido</font></label></td>
					<td width="10px">&nbsp;</td>						
					<td><input type="text" disabled id="txtSegundoApellido" name="txtSegundoApellido" class="form-control" value="<?= $this->session->userdata('SegundoApellidoUsuarioSesionApp');?>"/></td>
					<td rowspan="2" valign="top"><img src="<?= base_url(1) . $this->session->userdata('ImagenFotograficaUsuarioSesionApp');?>" width="70px" style="margin-top: 10px" id="fotoUsuario"/></td>
					<td colspan="3"><h2 align="center" style="color:#00C"><?= $titulo;?></h2></td>
					<td>&nbsp;</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td valign="top"><label for="txtPrimerNombre"><font color="#00C">Primer Nombre</font></label></td>
					<td>&nbsp;</td>
					<td valign="top"><input type="text" disabled id="txtPrimerNombre" name="txtPrimerNombre" class="form-control" value="<?= $this->session->userdata('PrimerNombreUsuarioSesionApp');?>"/>
					</td>
					<td>&nbsp;</td>
					<td valign="top"><label for="txtSegundoNombre"><font color="#00C">Segundo Nombre</font></label></td>
					<td>&nbsp;</td>
					<td valign="top"><input type="text" disabled id="txtSegundoNombre" name="txtSegundoNombre" class="form-control" value="<?= $this->session->userdata('SegundoNombreUsuarioSesionApp');?>"/></td>
					<td valign="top"><label for="txtSaldoCredencial"><font color="#00C">Saldo de Credencial</font></label></td>
					<td valign="top"><input type="text" disabled id="txtSaldoCredencial" class="form-control" name="txtSaldoCredencial" value="<?= $this->session->userdata('SaldoCredencial');?>"/>
					</td>
					<td align="center"><button id="btnPagar" name="btnPagar" class="btn btn-primary" style="visibility: visible">Pagar</button></td>
					<td>&nbsp;</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td>
						<label for="txtFecha" id="lblFecha" style="display: none"><font color="#00C">Fecha: </font></label>
					</td>
					<td>&nbsp;</td>
					<td>
						<input id="txtFecha" name="txtFecha" class="form-control" type="date" style="display: none"/>
					</td>
					<td>&nbsp;</td>
					<td>
						<label for="txtHora" id="lblHora" style="display: none"><font color="#00C">Hora: </font></label>
					</td>
					<td>&nbsp;</td>
					<td>
						<input id="txtHora" name="txtHora" class="form-control" type="time" style="display: none"/>
					</td>
					<td>&nbsp;</td>	
					<td colspan="2">
						<label class="checkbox-inline">
							<input id="toggle-event" type="checkbox" checked  data-toggle="toggle" data-on="Si" data-off="No"><font color="#00C"><b>Entrega Inmediata</b></font>
						</label><br>
						<label><font color="#00C" id="txtTotal"></font></label>	
					</td>
					<td>
						
						<label for="conAlistamiento" style="margin-left: 10px;" id="lblconAlistamiento" class="radio-inline"><input type="radio" name="tipo" id="conAlistamiento" value="CONALISTAMIENTO" /><font color="#00C"><b>Con Alistamiento</b></font></label><br>
						
						<label for="sinlistamiento" style="margin-left: 10px;" id="lblsinlistamiento" class="radio-inline"><input type="radio" name="tipo" id="sinlistamiento" value="SINALISTAMIENTO" checked="checked"/><font color="#00C"><b>Sin Alistamiento</b></font></label>	
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>

		</div>
		<div id='cssmenu' style="width: 25px;margin-top: -20px;">
			
			</div>
			
			<div class="contenidoBorde" style="width: 30%; float: left; overflow: auto; padding:0; margin-top: -20px" id="Categorias">
				
			  
			</div>
			
			<div class="contenidoBorde" style="width: 30%; float: left; overflow: auto; margin-top: -20px" id="Productos" align="center">
				
				
			</div>
			
			<div class="contenidoBorde" style="width: 37%; float: left; overflow: auto; margin-top: -20px">	
				<table width="100%" id="demo">
					<thead>
						<tr align="center">
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Total</th>
							<th>Borrar</th>
						</tr>
					</thead>
					<tbody id="tbody">
						
					</tbody>
			   </table>
			</div>
			
    <div class="container" style="position: absolute;z-index: 1;">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <?= $footer;?>
		   	<script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        	<script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
			<script src="<?= base_url(1);?>js/jquery-loader.js" type="text/javascript"></script>
			<script src="<?= base_url(1);?>dist/tablefilter/tablefilter.js"></script>
			<script>
	        	var saldoActual = 0;
				//Configuracion de la tabla    
				var filtersConfig = {
					base_path: '<?= base_url(1);?>dist/tablefilter/',
					auto_filter: true,//Aceptar o no filtro automatico cuando se empieza a escribir
					auto_filter_delay: 1100, //milliseconds
					filters_row_index: 1,
					remember_page_number: false,
					remember_page_length: false,
					alternate_rows: false,
					grid_layout: true,
					grid_width: '100%',//Ancho de la tabla
					alternate_rows: true,
					btn_reset: false,//Activar el boton de resetear los campos de filtro
					rows_counter: false,
					loader: true,
					status_bar: false,
					col_0: 'none',//Configurar el filtro de la columna con select
					col_1: 'none',//Configurar el filtro de la columna con select
					col_2: 'none',//Configurar el filtro de la columna con select
					col_3: 'none',//Configurar el filtro de la columna con select
					col_4: 'none',//Configurar el filtro de la columna con select
					extensions:[
						{
							name: 'sort',
							types: [
								'string', 'number', 'number',
								'number'
							]
						}
					]
				};
				var tf = new TableFilter('demo', filtersConfig);
				tf.init();
				
	        </script>
			<script type="text/javascript">
				var numeroVeces = 0;
				var saldoActual = 0;
				var jsonCarrito = new Array();
				window.addEventListener('load',init);
				$('#toggle-event').change(function() {
				if($(this).prop('checked') == true){
					$("#txtHora").css({"display":"none"});
					$("#lblHora").css({"display":"none"});
					$("#txtFecha").css({"display":"none"});
					$("#lblFecha").css({"display":"none"});
					$("#conAlistamiento").css({"visibility":"visible"});
					$("#sinlistamiento").css({"visibility":"visible"});
					$("#lblconAlistamiento").css({"visibility":"visible"});
					$("#lblsinlistamiento").css({"visibility":"visible"});
				}else{
					$("#txtHora").css({"display":"block"});
					$("#lblHora").css({"display":"block"});
					$("#txtFecha").css({"display":"block"});
					$("#lblFecha").css({"display":"block"});
					$("#conAlistamiento").css({"visibility":"hidden"});
					$("#sinlistamiento").css({"visibility":"hidden"});
					$("#lblconAlistamiento").css({"visibility":"hidden"});
					$("#lblsinlistamiento").css({"visibility":"hidden"});
				}
				
			})
				function init(){	
					jsonCarrito = JSON.parse('<?=$this->session->userdata('PedidoSSCASESSION');?>');
					verPedido()
					console.log(JSON.stringify(jsonCarrito))
					$.post("../categoria/listarCategorias", {})
					.done(function( data ) {
						//console.log($.trim(data));
						
						if($.trim(data) != "[]"){
							var foto = "";
							var json = JSON.parse(data);
							
							var html = '';
							$("#Categorias").html("");
							$.each(json, function(i, item) {
							var open_panel_count = 0;
								if(json[i].Imagen){
									foto = "<?= base_url(1);?>" + json[i].Imagen;
								}else{
									foto = "<?= base_url(1);?>images/box.png";
								}
								$("#Categorias").append('<div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]" style="margin-left: 0; width: 100%">' +				
								'<ul class="event-list">' +
									'<li id="item' + i + '" style="cursor: pointer" categoria="' + json[i].codigo + '">' +
										'<img src="' + foto + '" >  ' +
																	
										'<div class="info" >' +
											'<h2 class="title">' + json[i].Nombre + '</h2>' +
											'<p class="desc"></p>' +														
										'</div>' +
									'</li>' +								
									'<div class="collapse" id="demo' + i + '" style="height: 40%; margin-top:-17px; margin-bottom: 10px">' +
										
									'</div>' +
									
								'</ul>' +
								
								'</div>');
								
				
								$('#item' + i).click(function() {
									$('.collapse').collapse('hide');
									$('#demo' + i).collapse(open_panel_count ? 'hide' : 'show');
								});

								$('#demo' + i).on('shown.bs.collapse', function () {
									var idCategoria = $("#item" + i).attr("categoria");
									ListarSubCategorias(idCategoria, i)
									open_panel_count++;
								});

								$('#demo' + i).on('hidden.bs.collapse', function () {
									open_panel_count--;				
								}); 
							});
							
						}
					});
				}
				function ListarSubCategorias(categoria, index){
				$.post("../subcategoria/listarSubCategorias", {idCategoria: categoria})
				.done(function( data ) {
					console.log($.trim(data));
					
					if($.trim(data) != "[]"){
						$('#demo' + index).html("");
						var json = JSON.parse(data);
						$.each(json, function(i, item) {					
							$('#demo' + index).append('<a href="#" class="list-group-item" id="Categoria' + index + 'subcategoria' + i + '" data-subcategoria="' + json[i].codigo + '">' + json[i].Nombre + '</a>');
							
							
							
							$('#Categoria' + index + 'subcategoria' + i).click(function(e) {
								var id = $(this).attr("data-subcategoria");
								$("#txtSubCategoriaEscogida").val(id)
								var idUsuarioApp = $("#txtIdusuario").val(); 
								var idCredencialSesion = $("#txtIdcredencial").val(); 
								//EnviarDatos({subcategoria: id, dia: dia, idUsuario: idUsuarioApp}, "ActionListarProductoSubCategoria.php", "LISTARPRODUCTOSSUB");
								ListarProductos(id, idUsuarioApp, idCredencialSesion);
							});
						});
					}else{
						$('#demo' + index).html("");
						$('#demo' + index).append('<a href="#" class="list-group-item">NO hay Subcategorias</a>');
					}
				});
			}
			
			function ListarProductos(idSucategoria, idUsuarioApp, idCredencialSesion){
				var f = new Date();
				var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
				var dia = f.getDay();
				
				$.post("../producto/ListarProductosSubCategoria", {subcategoria: idSucategoria, dia: dia, idUsuario: idUsuarioApp, idCredencial: idCredencialSesion})
				.done(function( data ) {
					console.log(data);
					
					if($.trim(data) != "[]" && $.trim(data) != "[][]"){
						var html = "";
						var json = JSON.parse(data);
						
						$("#Productos").html("");
						$.each(json, function(i, item) {
							var fotoProducto = "";
							
							if(json[i].Imagen.length != 0){
								fotoProducto = "<?= base_url(1);?>" + json[i].Imagen;
							}else{
								fotoProducto = "<?= base_url(1);?>images/box.png";
							}
							var cantiMax = 0;
							var index = Obtener_Index(json[i].codigoProducto);
			
								
							if($.trim(json[i].Restriccion) == "NO"){
								
									html = '<div style="width:40%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF; padding-top:10px; height: auto;" align="center" class="recuadro" data-fila="' + i + '" data-codigoProducto="' + json[i].codigoProducto + '" data-imagenProducto="' + json[i].Imagen + '" data-descProducto="' + json[i].Descripcion + '">' +
									'<img src="' + fotoProducto + '" width="60%"/><br>' +
									'<font size="-1"><b id="fontNombre' + i + '">' + json[i].NombreProducto + '</b></font><br>' +
									'<font color="#FF0000">$</font><font color="#FF0000" id="fontPrecio' + i + '">' + json[i].ValorUnitario + '</font><br>' +
									'<font size="1"><b>CANTIDADES:</b></font><br>' +
									
									'<div style="display: inline-block;margin:0;">' +
										
									   '<table width="100%" height="10px" cellpadding="0" cellspacing="0" align="center">' +
											'<tr>' +
												'<td align="right" width="20%"><input type="button"  id="btnMenos' + i + '" name="btnMenos' + i + '" style="margin-right:10px" value="-" class="botonMenos btn btn-primary" data-fila="' + i + '"/></td>' +
												'<td align="center" width="30%"><input value="1" style="width:100%; text-align:center;border-radius:4px; border-style:ridge" id="txtCantidad' + i + '" name="txtCantidad' + i + '" type="" value="1"/></td>' +
												'<td width="20%"><input type="button" id="btnMas' + i + '" name="btnMas' + i + '" data-max="' + json[i].Stock + '" value="+" style="margin-left:10px" class="botonMas btn btn-primary" data-fila="' + i + '" data-codigoProducto="' + json[i].codigoProducto + '"/></td>' +
											'</tr>' +
											'<tr>' +
												'<td colspan="3" align="center"><button type="button" id="btnAgregar' + i + '" name="btnAgregar' + i + '" data-codigoProducto="' + json[i].codigoProducto + '" class="botonAgregar btn btn-primary" data-fila="' + i + '" style="width:90%; margin-top:5px"><font size="-1">Agregar</font></button><br><font color="#FF0000" id="fontError' + i + '">&nbsp;</font></td>' +
											'</tr>' +
										'</table>' +
									'</div>' +
								'</div>';
							
								
							}else{
								html = '<div style="width:40%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF; padding-top:10px; height: auto;" align="center" class="recuadro" data-fila="' + i + '" data-codigoProducto="' + json[i].codigoProducto + '" data-imagenProducto="' + json[i].Imagen + '" data-descProducto="' + json[i].Descripcion + '">' +
								'<img src="' + fotoProducto + '" width="60%"/><br>' +
								'<font size="-1"><b id="fontNombre' + i + '">' + json[i].NombreProducto + '</b></font><br>' +
								'<font color="#FF0000">$</font><font color="#FF0000" id="fontPrecio' + i + '">' + json[i].ValorUnitario + '</font><br>' +
								'<font size="2" color="#FF0000"><b>PRODUCTO RESTRINGIDO POR EL ACUDIENTE</b></font><br>' +
								
								
							'</div>';
							}
							
							$("#Productos").append(html);
							
							$("#btnMenos" + i).click(function(e) {
								var fila = $(this).attr("data-fila");
								var cantidadActual = $("#txtCantidad" + fila).val();
								
								var numero = parseInt(cantidadActual);
								if(numero > 1){
									numero -= 1;
									$("#txtCantidad" + fila).val(numero)
									$("#fontError" + fila).html("")
									$("#btnAgregar" + fila).css({display: "block"});
								}
								
							});
							$("#btnMas" + i).click(function(e) {
								var fila = $(this).attr("data-fila");
								var cantidadActual = $("#txtCantidad" + fila).val();
								var numero = parseInt(cantidadActual) + 1;
								var precio = parseInt($("#fontPrecio" + fila).html());
								var codigo = $("#btnAgregar" + fila).attr("data-codigoProducto")							
								
								//console.log(numero + " - " + CantidadMaxima)

								$.post("../producto/ObtenerStock", {codigoProducto: codigo})
								.done(function( respuesta ) {
									var jsonStock = JSON.parse(respuesta);
									//console.log(jsonStock[0].Stock)
									$("#btnMas" + fila).attr("data-max", jsonStock[0].Stock);
									if(parseInt(cantidadActual) <= parseInt(jsonStock[0].Stock)){
										
										var CantidadMaxima = parseInt($("#btnMas" + fila).attr("data-max"));
										var total = numero * precio;
										var saldoAux = parseInt($("#txtSaldoCredencial").val()) - (cantidadActual * precio);; 
										var ValorRestriccion = $("#txtValorRestriccion").val(); 
										saldoActual = parseInt($("#txtSaldoCredencial").val())
										
										
										if(ValorRestriccion != ""){
										
											var valor = parseInt(ValorRestriccion);
											var totalActual = Obtener_Total() + (numero * precio);
											if(numero < CantidadMaxima){
												
												var idCredencialSesion = $("#txtIdcredencial").val(); ;
												var date = new Date();
												var dia = date.getDate();
												var mes = (date.getMonth() + 1);
												var year = date.getFullYear();
												
												if(dia < 10) {
													dia = '0' + dia;
												} 
												
												if(mes < 10) {
													mes = '0' + mes;
												} 
												
												var fechaActual = year + "-" + mes + "-" + dia;
												var totalActual = Obtener_Total() + total;
												$.post("../ordenpedido/MostrarTotalPorDia", {idCredencial: idCredencialSesion, fecha: fechaActual})
												.done(function( data ) {
													if($.trim(data) != "[]"){
														var json = JSON.parse(data);
														console.log(json[0].Total);
														if(json[0].Total != null){

															
															if(totalActual <= valor){
																if((numero * precio) <= saldoActual){
																	$("#btnAgregar" + fila).css({display: "block"});
																	$("#txtCantidad" + fila).val(numero)
																	console.log(saldoActual + " - " + (numero * precio));
																	
																	$("#fontError" + fila).html("")
																}else{
																	//$("#btnAgregar" + fila).css({display: "none"});
																	
																	$("#fontError" + fila).html("El saldo actual es de " + saldoAux + ". No es suficiente para agregar mas productos")
																}
															}else{
																$("#btnAgregar" + fila).css({display: "none"});
																$("#fontError" + fila).html("Usted no puede sobrepasar la restriccion de consumir " + ValorRestriccion)
															}
														}else{
															
															
															if(totalActual <= valor){
																if((numero * precio) <= saldoActual){
																	$("#btnAgregar" + fila).css({display: "block"});
																	$("#txtCantidad" + fila).val(numero)
																	//console.log(saldoActual + " - " + (numero * precio));
																	
																	$("#fontError" + fila).html("")
																}else{
																	//$("#btnAgregar" + fila).css({display: "none"});
																	$("#fontError" + fila).html("El saldo actual es de " + saldoAux + ". No es suficiente para agregar mas productos")
																}
															}else{
																//$("#btnAgregar" + fila).css({display: "none"});
																$("#fontError" + fila).html("Usted no puede sobrepasar la restriccion de consumir " + ValorRestriccion)
															}
														}
													}
												});
											}
										}else{
											//console.log(saldoActual);
											if(numero < CantidadMaxima){
												if((numero * precio) <= saldoActual){
													
													$("#btnAgregar" + fila).css({display: "block"});
													$("#txtCantidad" + fila).val(numero)
													//console.log(saldoActual + " - " + (numero * precio));
													
													$("#fontError" + fila).html("")
												}else{
													//$("#btnAgregar" + fila).css({display: "none"});
													$("#fontError" + fila).html("El saldo actual no es suficiente para agregar mas productos")
												}
												
											}
										}
									}else{
										alert("Ya otro cajero ha solicitado cantidades de este producto. Actualmente hay " + jsonStock[0].Stock)
										$("#txtCantidad" + fila).val(jsonStock[0].Stock) 

										var id = $("#txtSubCategoriaEscogida").val()
										var idUsuarioApp = $("#txtIdusuario").val(); 
										var idCredencialSesion = $("#txtIdcredencial").val();
										ListarProductos(id, idUsuarioApp, idCredencialSesion);
									}
									
								});
								
							});
							$("#btnAgregar" + i).click(function(e) {

								var fila = $(this).attr("data-fila");
								
								var cantidadActual = parseInt($("#txtCantidad" + fila).val());
								console.log(cantidadActual)
								var precio = parseInt($("#fontPrecio" + fila).html());
								var codigoProducto = $("#btnAgregar" + fila).attr("data-codigoProducto")		
								var nombre = $("#fontNombre" + fila).html();
								var total = cantidadActual * precio;
								
								$.post("../producto/ObtenerStock", {codigoProducto: codigoProducto})
								.done(function( respuesta ) {
									var jsonStock = JSON.parse(respuesta);
									$("#btnMas" + fila).attr("data-max", jsonStock[0].Stock);
									
									var CantidadMaxima = parseInt($("#btnMas" + fila).attr("data-max"));
									console.log(typeof(cantidadActual) + " - " + cantidadActual)
									if(cantidadActual <= parseInt(jsonStock[0].Stock)){

										if(parseInt($("#txtSaldoCredencial").val()) >= (cantidadActual * precio)){
											var ValorRestriccion = $("#txtValorRestriccion").val(); 
											
											if(ValorRestriccion != ""){
												var date = new Date();
												var dia = date.getDate();
												var mes = (date.getMonth() + 1);
												var year = date.getFullYear();
												
												if(dia < 10) {
													dia = '0' + dia;
												} 
												
												if(mes < 10) {
													mes = '0' + mes;
												} 
												
												var fechaActual = year + "-" + mes + "-" + dia;
												var valor = parseInt(ValorRestriccion);
												var totalActual = Obtener_Total() + total;
												var idCredencialSesion = $("#txtIdcredencial").val();

												$.post("../ordenpedido/MostrarTotalPorDia", {idCredencial: idCredencialSesion, fecha: fechaActual})
												.done(function( data ) {console.log(data)
													if($.trim(data) != "[]"){
														var json = JSON.parse(data);
														if(json[0].Total != null){												

															if(totalActual <= valor){
																saldoActual = parseInt($("#txtSaldoCredencial").val()) - (cantidadActual * precio);

																if (navigator.onLine) {
																	ActualizarPedido(codigoProducto, nombre, cantidadActual, precio, total)
																	//$("#btnMas" + fila).attr("data-max", (CantidadMaxima - cantidadActual))
																	$("#txtCantidad" + fila).val("1")
																	$("#txtTotal").html("Total: " + Obtener_Total())
																	//$("#txtSaldoRestante").val(saldoActual)
																	//$('#popupCarrito').fadeIn('slow');
																	$("#btnPagar").css({"visibility": "visible"});
																	//alert("Agregado con exito el producto");
																	alertify.success("¡Producto agregado con exito!");	
																	var SaldoCredencial = $("#txtSaldoCredencial").val(); 
																	var totalPedido = Obtener_Total();
																	var saldo = parseFloat($("#txtSaldoOculto").val()) - totalPedido;
																	console.log(saldo + ":" + SaldoCredencial + ":" + cantidadActual + "*" + precio + ":" + total + ":" + totalPedido);
																	$("#txtSaldoCredencial").val(saldo);
																	
																	verPedido();
																	$("#fontError" + fila).html("")
																	
																	$("#Productos").html("");
																} else {
																	alertify.alert('Usted no tiene conexion a internet en estos momentos. Por favor verifiquela antes de realizar la transacción.', function(){})
																}
																
																

															}else{
																$("#btnAgregar" + fila).css({display: "none"});
																$("#fontError" + fila).html("Usted no puede sobrepasar la restriccion de consumir " + ValorRestriccion)
															}
														}else{												
															console.log("restri " + totalActual)
															if(totalActual <= valor){
																saldoActual = parseInt($("#txtSaldoCredencial").val()) - (cantidadActual * precio);
																if (navigator.onLine) {
																	ActualizarPedido(codigoProducto, nombre, cantidadActual, precio, total)
																	//$("#btnMas" + fila).attr("data-max", (CantidadMaxima - cantidadActual))
																	$("#txtCantidad" + fila).val("1")
																	$("#txtTotal").html("Total: " + Obtener_Total())
																	//$("#txtSaldoRestante").val(saldoActual)
																	//$('#popupCarrito').fadeIn('slow');
																	$("#btnPagar").css({"visibility": "visible"});
																	//alert("Agregado con exito el producto");
																	alertify.success("¡Producto agregado con exito!");	
																	var SaldoCredencial = $("#txtSaldoCredencial").val(); 
																	var totalPedido = Obtener_Total();
																	var saldo = parseFloat($("#txtSaldoOculto").val()) - totalPedido;
																	console.log(saldo + ":" + SaldoCredencial + ":" + cantidadActual + "*" + precio + ":" + total + ":" + totalPedido);
																	$("#txtSaldoCredencial").val(saldo);
																	

																	

																	verPedido();
																	$("#fontError" + fila).html("")

																	$("#Productos").html("");
																} else {
																	alertify.alert('Usted no tiene conexion a internet en estos momentos. Por favor verifiquela antes de realizar la transacción.', function(){})
																}
															}else{
																$("#btnAgregar" + fila).css({display: "none"});
																$("#fontError" + fila).html("Usted no puede sobrepasar la restriccion de consumir " + ValorRestriccion)
															}
														}
													}
												});

											}else{
												
												if(parseInt($("#txtSaldoCredencial").val()) >= total){
													saldoActual = parseInt($("#txtSaldoCredencial").val()) - (cantidadActual * precio);
													if (navigator.onLine) {
														ActualizarPedido(codigoProducto, nombre, cantidadActual, precio, total)
														
														$("#txtCantidad" + fila).val("1")
														$("#txtTotal").html("Total: " + Obtener_Total())
														//$("#txtSaldoRestante").val(saldoActual)
														//$('#popupCarrito').fadeIn('slow');
														$("#btnPagar").css({"visibility": "visible"});
														//alert("Agregado con exito el producto");
														alertify.success("¡Producto agregado con exito!");	
														var SaldoCredencial = localStorage.getItem("SaldoCredencial");
														//$("#btnMas" + fila).attr("data-max", (CantidadMaxima - cantidadActual))
														$("#txtSaldoCredencial").val(saldoActual);
														verPedido();
														
														$("#Productos").html("");
													} else {
														alertify.alert('Usted no tiene conexion a internet en estos momentos. Por favor verifiquela antes de realizar la transacción.', function(){})
													}
													
												}else{
													alertify.alert("El saldo no es suficiente para agregar este producto!", function(){
														//$("#btnPagar").css({"visibility": "hidden"});
													});	
												}
											}	
											
										}else{
											alertify.alert("El saldo no es suficiente para agregar este producto!", function(){
												//$("#btnPagar").css({"visibility": "hidden"});
											});	
										}
									}else{
										$("#txtCantidad" + fila).val(jsonStock[0].Stock) 
										alert("Ya otro cajero ha solicitado cantidades de este producto. Actualmente hay " + jsonStock[0].Stock)
										var id = $("#txtSubCategoriaEscogida").val()
										var idUsuarioApp = $("#txtIdusuario").val(); 
										var idCredencialSesion = $("#txtIdcredencial").val();
										ListarProductos(id, idUsuarioApp, idCredencialSesion);

									}
								});
								
											
							});
						});
						
						
					}else{
						$("#Productos").html("");
						$("#Productos").append('<h1>No existen productos por el momento en esta subcategoria</h1>');
					}
				});
			}
			$("#btnPagar").click(function(e) {
				if(numeroVeces == 0){

					$("#btnPagar").attr("disabled", "disabled")
					var idCredencialSesion = $("#txtIdcredencial").val(); 
					var usuario = $("#txtIdusuario").val(); 
					var total = Obtener_Total()
					var usuarioSession = $("#txtUserId").val(); 
					var descripcion = Obtener_Descripcion();
					var tipo = $("input[name='tipo']:checked").val();
					var hora = $("#txtHora").val()
					var fecha = $("#txtFecha").val()
					var estadoEntregaInmediata = $("#toggle-event").prop('checked');
					var datos;
					
					/*
						Descripcion: Obtener fecha y hora para registrar movimientos
					*/
					var date = new Date();
					var dia = date.getDate();
					var mes = (date.getMonth() + 1);
					var year = date.getFullYear();
					
					if(dia < 10) {
						dia = '0' + dia;
					} 
					
					if(mes < 10) {
						mes = '0' + mes;
					} 
					
					var fechaActual = year + "-" + mes + "-" + dia;
					var horaActual = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(); 
					
					var detalle = Obtener_Detalle();
					/*$conf = {
		                autoCheck: false,
		                size: 32,  //指定菊花大小
		                bgColor: "#FFF",   //背景颜色
		                bgOpacity: 0.25,    //背景透明度
		                fontColor: "#000",  //文字颜色
		                title: "Cargando", //文字
		                isOnly: false
		            };
		            $.loader.open($conf);*/
					
					if(estadoEntregaInmediata){
						if(tipo == "CONALISTAMIENTO"){
							datos = {
								idCredencial: idCredencialSesion,
								usuario: usuario,
								descripcionPedido: descripcion,
								ubicacionPedido: "ALISTAMIENTO",
								fecha: fechaActual,
								hora: horaActual,
								total: total,
								horaEntrega: "",
								fechaEntrega: "",
								detalle: detalle,
								session: usuarioSession,
								OrigenPedido: "CAJEROWEB"
							}	
						}else{
							datos = {
								idCredencial: idCredencialSesion,
								usuario: usuario,
								descripcionPedido: descripcion,
								ubicacionPedido: "ENTREGADO",
								fecha: fechaActual,
								hora: horaActual,
								total: total,
								horaEntrega: "",
								fechaEntrega: "",
								session: usuarioSession,
								detalle: detalle,
								OrigenPedido: "CAJEROWEB"
							}	
						}
						//alert(total);
						if (navigator.onLine) {
							$.post("../ordenpedido/insertarPedido", datos)
							.done(function( data ) {
								
								//$.loader.close(true);
								alert("¡Pedido Creado con exito!");							
								window.location.href = "../ordenpedido/cajero";	
								
							
							});	
						}else {
							alertify.alert('Usted no tiene conexion a internet en estos momentos. Por favor verifiquela antes de realizar la transacción.', function(){})
						}
					}else{
						if($.trim(hora) != "" && $.trim(fecha) != ""){
							datos = {
								idCredencial: idCredencialSesion,
								usuario: usuario,
								descripcionPedido: descripcion,
								ubicacionPedido: "PLANIFICADO",
								fecha: fechaActual,
								hora: horaActual,
								total: total,
								horaEntrega: hora,
								fechaEntrega: fecha,
								session: usuarioSession,
								detalle: detalle,
								OrigenPedido: "CAJEROWEB"
							}	
							if (navigator.onLine) {
								$.post("../ordenpedido/insertarPedido", datos)
								.done(function( data ) {
									//$.loader.close(true);
									alert("¡Pedido Creado con exito!");						
									window.location.href = "../ordenpedido/cajero";	
								
								});	
							}else {
								alertify.alert('Usted no tiene conexion a internet en estos momentos. Por favor verifiquela antes de realizar la transacción.', function(){})
							}
						}else{
							if($.trim(hora) == ""){
								alert("Debe ingresar una hora valida");
							}
							if($.trim(fecha) == ""){
								alert("Debe ingresar una fecha valida");
							}
						}
					}
					
					numeroVeces++;
				}
			});

			$("#btnCancelar").click(function(e) {
				var confirmar = window.confirm("¿Desea cancelar la creación del pedido actual?");
        		if(confirmar){
					$.post("../ordenpedido/borrarSesion", {session: $("#txtUserId").val()})
					.done(function( respuesta ) {
						window.location.href = "../ordenpedido/cajero";	
					});
				}
			});

			function DisminuirStock(codigo, cantidad, nombre, precio, total){
				$.post("../producto/DisminuirStock", {codigoProducto: codigo, cantidad: cantidad, session: $("#txtUserId").val()})
				.done(function( result ) {			
				
					var index = Obtener_Index(codigo);console.log(index)
					if(index > -1)	{					
						var totalActual = jsonCarrito[index].cantidad + cantidad
						jsonCarrito[index].codigoProducto = codigo;
						jsonCarrito[index].nombre = nombre;
						jsonCarrito[index].cantidad = totalActual;
						jsonCarrito[index].precioUnitario = precio;
						jsonCarrito[index].total += total;
					}else{
						jsonCarrito.push(
							{codigoProducto: codigo, nombre: nombre, cantidad: cantidad, precioUnitario: precio, total: total}
						);
					}
					$.post("../ordenpedido/guardarPedidoSesion", {Pedido: JSON.stringify(jsonCarrito)})
					.done(function( data ) {
						console.log(data)
						var id = $("#txtSubCategoriaEscogida").val()
						var idUsuarioApp = $("#txtIdusuario").val(); 
						var idCredencialSesion = $("#txtIdcredencial").val();
						ListarProductos(id, idUsuarioApp, idCredencialSesion);
						verPedido()
					});

				});
			}

			function AumentarStock(codigo, cantidad){
				$.post("../producto/AumentarStock", {codigoProducto: codigo, cantidad: cantidad, session: $("#txtUserId").val()})
				.done(function( data ) {
					var id = $("#txtSubCategoriaEscogida").val()
					var idUsuarioApp = $("#txtIdusuario").val(); 
					var idCredencialSesion = $("#txtIdcredencial").val();
					ListarProductos(id, idUsuarioApp, idCredencialSesion);
				});
			}

			function Obtener_Total(){
				var total = 0;
				
				$.each(jsonCarrito, function(i, item) {
					if(jsonCarrito[i] != null){
						total += parseInt(jsonCarrito[i].total);
					}
				});	
				return total;
			}
			function Obtener_Index(codigoProducto){
				var index = -1;
				
				$.each(jsonCarrito, function(i, item) {
					if(jsonCarrito[i] != null){
						if(codigoProducto == jsonCarrito[i].codigoProducto){	
							index = i;
						}
					}
					
				});	
				return index;
			}
			function ActualizarPedido(codigoProducto, nombre, cantidadActual, precio, total){
				DisminuirStock(codigoProducto, cantidadActual, nombre, precio, total)
				

			}
			function Obtener_Descripcion(){
				var descripcion = "";
				var contador = 0;
				$.each(jsonCarrito, function(i, item) {
					if(jsonCarrito[i] != null){
						if(contador == 0){						
							descripcion += jsonCarrito[i].cantidad + " " + jsonCarrito[i].nombre;
						}else{
							descripcion += ", " + jsonCarrito[i].cantidad + " " + jsonCarrito[i].nombre;
						}
						contador++;
					}
				});	
				return descripcion;
			}
			function Obtener_Detalle(){
				var descripcion = "";
				
				$.each(jsonCarrito, function(i, item) {
					if(jsonCarrito[i] != null){
						if(i != (jsonCarrito.length - 1)){						
							descripcion += jsonCarrito[i].codigoProducto + ":" + jsonCarrito[i].cantidad + ":" + jsonCarrito[i].total + ",";
						}else{
							descripcion += jsonCarrito[i].codigoProducto + ":" + jsonCarrito[i].cantidad + ":" + jsonCarrito[i].total;
						}
					}
				});	
				return descripcion;
			}
			function verPedido(){
				var html = '';
				console.log(jsonCarrito);
				$("#tbody").html("");
				$.each(jsonCarrito, function(i, item) {
					if(jsonCarrito[i] != null){
						if((i + 1) % 2 == 1){
							$("#tbody").append('<tr class="even" validrow="true">' +
								'<td>' + jsonCarrito[i].nombre + '</td>' +
								'<td>' + jsonCarrito[i].precioUnitario + '</td>' +
								'<td>' + jsonCarrito[i].cantidad + '</td>' +
								'<td>' + jsonCarrito[i].total + '</td>' +
								'<td><img src="<?= base_url(1);?>images/stop.png" width="20" id="borrar' + i + '"/></td>' +
							'</tr>');						
						}else{
							$("#tbody").append('<tr class="odd" validrow="true">' +
								'<td>' + jsonCarrito[i].nombre + '</td>' +
								'<td>' + jsonCarrito[i].precioUnitario + '</td>' +
								'<td>' + jsonCarrito[i].cantidad + '</td>' +
								'<td>' + jsonCarrito[i].total + '</td>' +
								'<td><img src="<?= base_url(1);?>images/stop.png" width="20" id="borrar' + i + '" iter="' + i + '"/></td>' +
							'</tr>');						
						}
						$("#borrar" + i).click(function(e) {
							var confirmarAccion = window.confirm("¿Desea borrar este producto solicitado?");
							var iter = $(this).attr("iter")
							if(confirmarAccion){

								AumentarStock(jsonCarrito[i].codigoProducto, jsonCarrito[i].cantidad)
								delete jsonCarrito[i];
								verPedido();
								
								var SaldoCredencial = $("#txtSaldoCredencial").val();
								var total = Obtener_Total();
								var saldo = parseFloat($("#txtSaldoOculto").val()) - total;
								$("#txtSaldoCredencial").val(saldo);
								$("#txtTotal").html("Total: " + Obtener_Total())
								$("#Productos").html("");
																
								$.post("../ordenpedido/guardarPedidoSesion", {Pedido: JSON.stringify(jsonCarrito)})
								.done(function( data ) {
									console.log(data)
								});
							}
						});
					}					 
				});

				var SaldoCredencial = $("#txtSaldoCredencial").val();
				var total = Obtener_Total();
				var saldo = parseFloat($("#txtSaldoOculto").val()) - total;
				$("#txtSaldoCredencial").val(saldo);
				$("#txtTotal").html("Total: " + Obtener_Total())
				
				$("#txtSaldoCredencial").val(saldo);
				$("#txtTotal").html("Total: " + Obtener_Total())
				
				//var tf = new TableFilter('demo', filtersConfig);
				//tf.init();
				$('#popupCarrito').fadeIn('slow');
			}	
			</script>
	</body>
</html>