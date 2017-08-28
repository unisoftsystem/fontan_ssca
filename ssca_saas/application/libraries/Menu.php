<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Menu
{
	
	function __construct()
	{
		
	}

	public function menuModulos($pagina, $arr_menu){
		$menu = '<nav class="navbar navbar-inverse">
	      <div class="container-fluid">
	        
	        <ul class="nav navbar-nav">';
	        	if($pagina == "HOME"){
        			$menu .= '<li class="active"><a href="' . base_url() . 'index.php/usuarios_sistema/homeInternoModulos"><span class="glyphicon glyphicon-home"></span></a></li>';
        			foreach ($arr_menu as $valor) {
        				$menu .= '<li data-id="' . $valor->id . '" class="opcionMenuModulo">
							<a href="#">'
							. $valor->nombre
							. '</a>'
						. '</li>';
        			}
            	}else{
            		$menu .= '<li><a href="' . base_url() . 'index.php/usuarios_sistema/homeInternoModulos"><span class="glyphicon glyphicon-home"></span></a></li>';
		            foreach ($arr_menu as $valor) {
		            	
		            	if($pagina == $valor->nombre){
							$menu .= '<li class="active opcionMenuModulo" data-id="' . $valor->id . '">
									<a href="#" data-id="' . $valor->id . '">'
									. $valor->nombre
									. '</a>'
								. '</li>';
		            	}else{
		            		$menu .= '<li data-id="' . $valor->id . '" class="opcionMenuModulo">
								<a href="#">'
								. $valor->nombre
								. '</a>'
							. '</li>';
		            	}
		            }
		        }
	            $menu .= '<li id="OpcionSalir"><a href="#">CERRAR SESION</a></li>';
	            $menu .='</ul>
				      </div>
				    </nav>';		
		
		return $menu;
	}

	public function menuServicios($pagina, $arr_menu){
		$menu = '<div id="cssmenu">
	        <ul>';
	        foreach ($arr_menu as $valor) {
	        	$services = "";
	        	foreach ($valor->servicios as $key) {
	        		$services .= '<li><a href="' . $key->url . '" title="">' . $key->nombre . '</a></li>';
	        	}
	        	if($valor->id == 1){
	        		$services .= '<li><a href="http://190.60.211.17/ssca" title="" target="_blank">ACCESO PLATAFORMA ACUDIENTES</a></li>';
	        		
	        		$services .= '<li><a href="http://190.60.211.17/ssca/indexfuncionariointerno.html" title="" target="_blank">ACCESO PLATAFORMA FUNCIONARIOS</a></li>';
	        	}
	        	
	        	if($pagina == $valor->name){
					$menu .= '<li class="active">
		                <a href="#"" title="">
		                    <span>' . $valor->name . '</span>
		                </a>
			            <ul style="margin-right:-42%">'
			                . $services . 
			            '</ul>
		           	</li>';
				}else{
					$menu .= '<li class="desactive">
		                <a href="#"" title="' . $valor->name . '">
		                    <span>' . $valor->name . '</span>
		                </a>
			            <ul style="margin-right:-42%">'
			                . $services . 
			            '</ul>
		           	</li>';
				}	
	        }                
	            
	        $menu .= '</ul>
	    </div>';		
		
		return $menu;
	}
}