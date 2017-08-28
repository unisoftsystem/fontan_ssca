<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Registro_control extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('categoria_model');//Cargar el modelo de categoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('registro_control_model');//Cargar el modelo de registro de control donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->model('subcategoria_model');//Cargar el modelo de subcategoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('turnos_laborales_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_aplicaciones_model');//Cargar el modelo de usuarios de aplicaciones donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}

	/****************************** MOSTRAR PAGINAS ******************************************/
	public function index()
	{
		
	}
	//Mostrar la vista de reporte de las entradas y salidas de personal	
	function reporteEntradaSalida(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../registro_control/reporteEntradaSalida", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['titulo'] = "Reportes para entrada de personal";//Titulo de la pagina, se lo envio al archivo donde esta el header
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('credenciales/reporteEntradaSalida', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}

	/****************************** ACCIONES ******************************************/

	//Funcion para generar el reporte de las entradas y salidas de personal
	function generarReporteEntradaSalida(){
		//Se verifica si el reporte a generar es con busqueda de numero de documento de identificacion o no		
		if($_POST["numeroID"] == ""){

			switch ($_POST["tipo"]) {
				case 'ESTUDIANTE':
					$resultado = $this->registro_control_model->ReporteSinDoc($_POST["fechaInicial"], $_POST["fechaFinal"], $_POST["tipo"]);//Se llama a la funcion de que esta en modelo
					if($resultado != null){
						foreach ($resultado->result() as $value) {	
							$horaRegistro = strtotime( $value->Hora );	
							$horaInicio = strtotime( "07:00:00" );	
							$horaFinal = strtotime( "15:00:00" );

							switch ($value->Tipo) {
								case 'ENTRADA':
									$horaini="07:00:00"; 
									$horafin="" . $value->Hora; 
									$value->Diferencia = $this->RestarHoras($horaini,$horafin);			
									if($horaRegistro <= $horaInicio){
										$value->Validador = "TEMPRANO";
									}else{
										switch ($value->Observacion) {
											case 'Entrada a tiempo usando un permiso':
												$value->Validador = "TEMPRANO";
												break;
											case 'Entrada tardia despues del permiso':
												$value->Validador = "TARDE";
												$value->Diferencia = "-" . $value->Diferencia;
												break;
											case 'Entrada tardia':
												$value->Validador = "TARDE";
												$value->Diferencia = "-" . $value->Diferencia;
												break;
										}									
										
									}
									break;
								
								case 'SALIDA':
									$horaini="15:00:00"; 
									$horafin="" . $value->Hora;
									$value->Diferencia = $this->RestarHoras($horaini,$horafin);

									break;
							}
						}
						echo json_encode($resultado->result());
					}else{
						echo "[]";
					}
					break;
				
				case 'FUNCIONARIO':
					$data_funcionarios = $this->usuarios_aplicaciones_model->ListarTodosFuncionarios();
					$array_funcionario = array();

					if($data_funcionarios != null){
						foreach ($data_funcionarios->result() as $key) {	
							$resultado = $this->registro_control_model->ReporteConDoc($_POST["fechaInicial"], $_POST["fechaFinal"], $_POST["tipo"], $key->NumeroId);
								

							if($resultado != null){
								foreach ($resultado->result() as $value) {	
									$horaRegistro = strtotime( $value->Hora );	
									$horaInicio = strtotime( "07:00:00" );	
									$horaFinal = strtotime( "15:00:00" );	
									$validador = "";						
									$diferencia = "";											

									switch ($value->Tipo) {
										case 'ENTRADA':
											$horaini="07:00:00"; 
											$horafin="" . $value->Hora; 						
											$diferencia = $this->RestarHoras($horaini,$horafin);	
											
											if($horaRegistro <= $horaInicio){
												//$key->Validador = "TEMPRANO";
												$validador = "TEMPRANO";
											}else{
												switch ($value->Observacion) {
													case 'Entrada a tiempo usando un permiso':
														$validador = "TEMPRANO";
														break;
													case 'Entrada tardia despues del permiso':
														$validador = "TARDE";
														$diferencia = "-" . $diferencia;
														break;
													case 'Entrada tardia':
														$validador = "TARDE";
														$diferencia = "-" . $diferencia;
														break;
												}									
												
											}
											$array_datos = array(
												"PrimerNombre" => $key->PrimerNombre,
												"SegundoNombre" => $key->SegundoNombre,
												"PrimerApellido" => $key->PrimerApellido,
												"SegundoApellido" => $key->SegundoApellido,
												"NumeroId" => $key->NumeroId,
												"Tipo" => $value->Tipo,
												"Fecha" => $value->Fecha,
												"Hora" => $value->Hora,
												"Observacion" => $value->Observacion,
												"Diferencia" => $diferencia,
												"Validador" => $validador
											);
											array_push($array_funcionario, $array_datos);

											break;
										
										case 'SALIDA':
											$horaini="15:00:00"; 
											$horafin="" . $value->Hora;
											$key->Diferencia = $this->RestarHoras($horaini,$horafin);
											$array_datos = array(
												"PrimerNombre" => $key->PrimerNombre,
												"SegundoNombre" => $key->SegundoNombre,
												"PrimerApellido" => $key->PrimerApellido,
												"SegundoApellido" => $key->SegundoApellido,
												"NumeroId" => $key->NumeroId,
												"Tipo" => $value->Tipo,
												"Fecha" => $value->Fecha,
												"Hora" => $value->Hora,
												"Observacion" => $value->Observacion,
												"Diferencia" => $this->RestarHoras($horaini,$horafin),
												"Validador" => $validador
											);

											array_push($array_funcionario, $array_datos);

											break;
									}
								}
							}else{

								$array_datos = array(
									"PrimerNombre" => $key->PrimerNombre,
									"SegundoNombre" => $key->SegundoNombre,
									"PrimerApellido" => $key->PrimerApellido,
									"SegundoApellido" => $key->SegundoApellido,
									"NumeroId" => $key->NumeroId,
									"Tipo" => "",
									"Fecha" => "",
									"Hora" => "",
									"Observacion" => "",
									"Diferencia" => "",
									"Validador" => ""
								);

								array_push($array_funcionario, $array_datos);
							}							
						}
						echo json_encode($array_funcionario);
					}else{
						echo "[]";
					}
					break;
			}
		}else{
			$resultado = $this->registro_control_model->ReporteConDoc($_POST["fechaInicial"], $_POST["fechaFinal"], $_POST["tipo"], $_POST["numeroID"]);//Se llama a la funcion de que esta en modelo
			if($resultado != null){
				foreach ($resultado->result() as $value) {	
					if($value->TipoUsuario == "Estudiante"){
						$horaRegistro = strtotime( $value->Hora );	
						$horaInicio = strtotime( "07:00:00" );	
						$horaFinal = strtotime( "15:00:00" );

						switch ($value->Tipo) {
							case 'ENTRADA':
								$horaini="07:00:00"; 
								$horafin="" . $value->Hora; 
								$value->Diferencia = $this->RestarHoras($horaini,$horafin);	
								if($horaRegistro <= $horaInicio){
									$value->Validador = "TEMPRANO";
								}else{
									switch ($value->Observacion) {
										case 'Entrada a tiempo usando un permiso':
											$value->Validador = "TEMPRANO";
											break;
										case 'Entrada tardia despues del permiso':
											$value->Validador = "TARDE";
											$value->Diferencia = "-" . $value->Diferencia;
											break;
										case 'Entrada tardia':
											$value->Validador = "TARDE";
											$value->Diferencia = "-" . $value->Diferencia;
											break;
									}									
									
								}					
								break;
							
							case 'SALIDA':
								$horaini="15:00:00"; 
								$horafin="" . $value->Hora;
								$value->Diferencia = $this->RestarHoras($horaini,$horafin);

								break;
						}
					}else{
						$dataTurno = $this->turnos_laborales_model->getTurno($value->idUsuario);

						if($dataTurno != null){
							foreach ($dataTurno->result() as $valueTurno) {
								$horaRegistro = strtotime( $value->Hora );	
								$horaInicio = strtotime( $valueTurno->hora_inicio );	
								$horaFinal = strtotime( $valueTurno->hora_final );

								switch ($value->Tipo) {
									case 'ENTRADA':
										$horaini="" . $valueTurno->hora_inicio; 
										$horafin="" . $value->Hora; 
										$value->Diferencia = $this->RestarHoras($horaini,$horafin);	
										if($horaRegistro <= $horaInicio){
											$value->Validador = "TEMPRANO";
										}else{
											switch ($value->Observacion) {
												case 'Entrada a tiempo usando un permiso':
													$value->Validador = "TEMPRANO";
													break;
												case 'Entrada tardia despues del permiso':
													$value->Validador = "TARDE";
													$value->Diferencia = "-" . $value->Diferencia;
													break;
												case 'Entrada tardia':
													$value->Validador = "TARDE";
													$value->Diferencia = "-" . $value->Diferencia;
													break;
											}									
											
										}					
										break;
									
									case 'SALIDA':
										$horaini="" . $valueTurno->hora_final; 
										$horafin="" . $value->Hora;
										$value->Diferencia = $this->RestarHoras($horaini,$horafin);

										break;
								}
							}
						}else{
							$horaini=""; 
							$horafin="" . $value->Hora;
							$value->Diferencia = "";		
						}
					}
				}
				echo json_encode($resultado->result());
			}else{
				echo "[]";
			}
		}	

		
	}	

	//Funcion para exportar a excel un reporte de recarga de credenciales
	function ExportarReporteEntradaSalida(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		$resultado = null;
		$array = 0;

		if($_REQUEST["numeroID"] == ""){

			switch ($_REQUEST["tipo"]) {
				case 'ESTUDIANTE':
					$data_resultado = $this->registro_control_model->ReporteSinDoc($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["tipo"]);//Se llama a la funcion de que esta en modelo
					if($data_resultado != null){
						foreach ($data_resultado->result() as $value) {	
							$horaRegistro = strtotime( $value->Hora );	
							$horaInicio = strtotime( "07:00:00" );	
							$horaFinal = strtotime( "15:00:00" );

							switch ($value->Tipo) {
								case 'ENTRADA':
									$horaini="07:00:00"; 
									$horafin="" . $value->Hora; 
									$value->Diferencia = $this->RestarHoras($horaini,$horafin);			
									if($horaRegistro <= $horaInicio){
										$value->Validador = "TEMPRANO";
									}else{
										switch ($value->Observacion) {
											case 'Entrada a tiempo usando un permiso':
												$value->Validador = "TEMPRANO";
												break;
											case 'Entrada tardia despues del permiso':
												$value->Validador = "TARDE";
												$value->Diferencia = "-" . $value->Diferencia;
												break;
											case 'Entrada tardia':
												$value->Validador = "TARDE";
												$value->Diferencia = "-" . $value->Diferencia;
												break;
										}									
										
									}
									break;
								
								case 'SALIDA':
									$horaini="15:00:00"; 
									$horafin="" . $value->Hora;
									$value->Diferencia = $this->RestarHoras($horaini,$horafin);

									break;
							}
						}
						$resultado = $data_resultado;
					}else{
						
					}
					break;
				
				case 'FUNCIONARIO':
					$data_funcionarios = $this->usuarios_aplicaciones_model->ListarTodosFuncionarios();
					$array = 1;
					$array_funcionario = array();

					if($data_funcionarios != null){
						foreach ($data_funcionarios->result() as $key) {	
							$resultado_registros = $this->registro_control_model->ReporteConDoc($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["tipo"], $key->NumeroId);
								

							if($resultado_registros != null){
								foreach ($resultado_registros->result() as $value) {	
									$horaRegistro = strtotime( $value->Hora );	
									$horaInicio = strtotime( "07:00:00" );	
									$horaFinal = strtotime( "15:00:00" );	
									$validador = "";						
									$diferencia = "";											

									switch ($value->Tipo) {
										case 'ENTRADA':
											$horaini="07:00:00"; 
											$horafin="" . $value->Hora; 						
											$diferencia = $this->RestarHoras($horaini,$horafin);	
											
											if($horaRegistro <= $horaInicio){
												//$key->Validador = "TEMPRANO";
												$validador = "TEMPRANO";
											}else{
												switch ($value->Observacion) {
													case 'Entrada a tiempo usando un permiso':
														$validador = "TEMPRANO";
														break;
													case 'Entrada tardia despues del permiso':
														$validador = "TARDE";
														$diferencia = "-" . $diferencia;
														break;
													case 'Entrada tardia':
														$validador = "TARDE";
														$diferencia = "-" . $diferencia;
														break;
												}									
												
											}
											$array_datos = array(
												"PrimerNombre" => $key->PrimerNombre,
												"SegundoNombre" => $key->SegundoNombre,
												"PrimerApellido" => $key->PrimerApellido,
												"SegundoApellido" => $key->SegundoApellido,
												"NumeroId" => $key->NumeroId,
												"Tipo" => $value->Tipo,
												"Fecha" => $value->Fecha,
												"Hora" => $value->Hora,
												"Observacion" => $value->Observacion,
												"Diferencia" => $diferencia,
												"Validador" => $validador
											);
											array_push($array_funcionario, $array_datos);

											break;
										
										case 'SALIDA':
											$horaini="15:00:00"; 
											$horafin="" . $value->Hora;
											$key->Diferencia = $this->RestarHoras($horaini,$horafin);
											$array_datos = array(
												"PrimerNombre" => $key->PrimerNombre,
												"SegundoNombre" => $key->SegundoNombre,
												"PrimerApellido" => $key->PrimerApellido,
												"SegundoApellido" => $key->SegundoApellido,
												"NumeroId" => $key->NumeroId,
												"Tipo" => $value->Tipo,
												"Fecha" => $value->Fecha,
												"Hora" => $value->Hora,
												"Observacion" => $value->Observacion,
												"Diferencia" => $this->RestarHoras($horaini,$horafin),
												"Validador" => $validador
											);

											array_push($array_funcionario, $array_datos);

											break;
									}
								}
							}else{

								$array_datos = array(
									"PrimerNombre" => $key->PrimerNombre,
									"SegundoNombre" => $key->SegundoNombre,
									"PrimerApellido" => $key->PrimerApellido,
									"SegundoApellido" => $key->SegundoApellido,
									"NumeroId" => $key->NumeroId,
									"Tipo" => "",
									"Fecha" => "",
									"Hora" => "",
									"Observacion" => "",
									"Diferencia" => "",
									"Validador" => ""
								);

								array_push($array_funcionario, $array_datos);
							}							
						}
						$resultado = $array_funcionario;
					}else{
						
					}
					break;
			}
		}else{
			$data_resultado = $this->registro_control_model->ReporteConDoc($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["tipo"], $_REQUEST["numeroID"]);//Se llama a la funcion de que esta en modelo
			if($data_resultado != null){
				foreach ($data_resultado->result() as $value) {	
					if($value->TipoUsuario == "Estudiante"){
						$horaRegistro = strtotime( $value->Hora );	
						$horaInicio = strtotime( "07:00:00" );	
						$horaFinal = strtotime( "15:00:00" );

						switch ($value->Tipo) {
							case 'ENTRADA':
								$horaini="07:00:00"; 
								$horafin="" . $value->Hora; 
								$value->Diferencia = $this->RestarHoras($horaini,$horafin);	
								if($horaRegistro <= $horaInicio){
									$value->Validador = "TEMPRANO";
								}else{
									switch ($value->Observacion) {
										case 'Entrada a tiempo usando un permiso':
											$value->Validador = "TEMPRANO";
											break;
										case 'Entrada tardia despues del permiso':
											$value->Validador = "TARDE";
											$value->Diferencia = "-" . $value->Diferencia;
											break;
										case 'Entrada tardia':
											$value->Validador = "TARDE";
											$value->Diferencia = "-" . $value->Diferencia;
											break;
									}									
									
								}					
								break;
							
							case 'SALIDA':
								$horaini="15:00:00"; 
								$horafin="" . $value->Hora;
								$value->Diferencia = $this->RestarHoras($horaini,$horafin);

								break;
						}
					}else{
						$dataTurno = $this->turnos_laborales_model->getTurno($value->idUsuario);

						if($dataTurno != null){
							foreach ($dataTurno->result() as $valueTurno) {
								$horaRegistro = strtotime( $value->Hora );	
								$horaInicio = strtotime( $valueTurno->hora_inicio );	
								$horaFinal = strtotime( $valueTurno->hora_final );

								switch ($value->Tipo) {
									case 'ENTRADA':
										$horaini="" . $valueTurno->hora_inicio; 
										$horafin="" . $value->Hora; 
										$value->Diferencia = $this->RestarHoras($horaini,$horafin);	
										if($horaRegistro <= $horaInicio){
											$value->Validador = "TEMPRANO";
										}else{
											switch ($value->Observacion) {
												case 'Entrada a tiempo usando un permiso':
													$value->Validador = "TEMPRANO";
													break;
												case 'Entrada tardia despues del permiso':
													$value->Validador = "TARDE";
													$value->Diferencia = "-" . $value->Diferencia;
													break;
												case 'Entrada tardia':
													$value->Validador = "TARDE";
													$value->Diferencia = "-" . $value->Diferencia;
													break;
											}									
											
										}					
										break;
									
									case 'SALIDA':
										$horaini="" . $valueTurno->hora_final; 
										$horafin="" . $value->Hora;
										$value->Diferencia = $this->RestarHoras($horaini,$horafin);

										break;
								}
							}
						}else{
							$horaini=""; 
							$horafin="" . $value->Hora;
							$value->Diferencia = "";		
						}
					}
				}
				$resultado = $data_resultado;
			}else{
				echo "[]";
			}
		}

		if($resultado != null){
			
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reportes para entrada de personal")
               ->setSubject("Reportes para entrada de personal")
               ->setDescription("Reportes para entrada de personal")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 2;     

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "NOMBRES");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "APELLIDOS");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "TIPO");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "DOCUMENTO DE IDENTIFICACION");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "FECHA(aaaa-mm-dd)");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "HORA");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "OBSERVACION");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "DIFERENCIA DE HORARIO");
			
			if($array == 0){
				$resultado = $resultado->result();
			}

			
			foreach ($resultado as $value) {
				switch (gettype($value)) {
					case 'array':
						//Se itera el json de los datos y se escriben en el excel en cada celda
						
						//Se convierte la fecha a letras
						$fechaDato =  "";
						if($value["Fecha"] != null && $value["Fecha"] != "" && $value["Fecha"] != "0000-00:00"){
							$num = date("j", strtotime($value["Fecha"]));
						    $anno = date("Y", strtotime($value["Fecha"]));
						    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
						    $mes = $mes[(date('m', strtotime($value["Fecha"]))*1)-1];
						    $fechaDato =  $num.' de '.$mes.' del '.$anno;
						}
						
					    
						$objPHPExcel->setActiveSheetIndex(0)
			          		->setCellValue('A'.$i, $value["PrimerNombre"] . " " . $value["SegundoNombre"]);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('B'.$i, $value["PrimerApellido"] . " " . $value["SegundoApellido"]);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('C'.$i, $value["Tipo"]);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('D'.$i, $value["NumeroId"]);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('E'.$i, $fechaDato);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('F'.$i, $value["Hora"]);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('G'.$i, $value["Observacion"]);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('H'.$i, $value["Diferencia"]);  

						$i++;            
						
						break;

					case 'object':
						//Se itera el json de los datos y se escriben en el excel en cada celda
						
						//Se convierte la fecha a letras
						$fechaDato =  "";
						if($value->Fecha != null && $value->Fecha != "" && $value->Fecha != "0000-00:00"){
							$num = date("j", strtotime($value->Fecha));
						    $anno = date("Y", strtotime($value->Fecha));
						    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
						    $mes = $mes[(date('m', strtotime($value->Fecha))*1)-1];
						    $fechaDato =  $num.' de '.$mes.' del '.$anno;
						}
						
					    
						$objPHPExcel->setActiveSheetIndex(0)
			          		->setCellValue('A'.$i, $value->PrimerNombre . " " . $value->SegundoNombre);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('B'.$i, $value->PrimerApellido . " " . $value->SegundoApellido);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('C'.$i, $value->Tipo);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('D'.$i, $value->NumeroId);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('E'.$i, $fechaDato);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('F'.$i, $value->Hora);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('G'.$i, $value->Observacion);

					    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('H'.$i, $value->Diferencia);  

						$i++;   
						break;
				}
			}
		    
			
			
		}
		
		
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reportes control');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Control_personal" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

		//Se agregan otros atributos del archivo
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}	

	function RestarHoras($horaini,$horafin)
	{
		/*$horai=substr($horaini,0,2);
		$mini=substr($horaini,3,2);
		$segi=substr($horaini,6,2);
	 
		$horaf=substr($horafin,0,2);
		$minf=substr($horafin,3,2);
		$segf=substr($horafin,6,2);
	 
		$ini=((($horai*60)*60)+($mini*60)+$segi);
		$fin=((($horaf*60)*60)+($minf*60)+$segf);
	 
		$dif=$fin-$ini;
	 
		$difh=floor($dif/3600);
		$difm=floor(($dif-($difh*3600))/60);
		$difs=$dif-($difm*60)-($difh*3600);
		return date("H:i:s",mktime($difh,$difm,$difs));*/
		$fecha1 = new DateTime($horaini);
		$fecha2 = new DateTime($horafin);
		$fecha = $fecha1->diff($fecha2);
		//printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
		// imprime: 2 años, 4 meses, 2 días, 1 horas, 17 minutos
		return date("H:i:s",mktime($fecha->h,$fecha->i,$fecha->s));
	}

	function generarRegistroControl(){
		$resultado = $this->credenciales_model->getUsuarioPorCredencial($_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo
		$fecha = date("Y-m-d");	
		$hora = date("H:i:s");	
		$idUsuario = "";

		if(isset($_POST['_fecha']) && $_POST['_fecha'] != '') {
			$timestamp_fecha = strtotime($_POST['_fecha']);
			$fecha = date("Y-m-d", $timestamp_fecha);	
		}

		if(isset($_POST['_hora']) && $_POST['_hora'] != '') {
			$timestamp_hora = strtotime($_POST['_hora']);
			$hora = date("H:i:s", $timestamp_hora);	
		}


		if($resultado != null){			

			foreach ($resultado->result() as $value) {	
				$idUsuario = $value->idUsuario;

				switch ($value->TipoUsuario) {
					case 'Estudiante':
						$horaActual = strtotime( $hora );
						$horaInicio = strtotime( "07:00:00" );	
						$horaFinal = strtotime( "15:00:00" );

						$existeUltimoEntrada = $this->registro_control_model->ExisteEntradaUltima($_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo

						if($existeUltimoEntrada == true){
							$resultadoRegistro = $this->registro_control_model->existeRegistro($_POST["idCredencial"], "SALIDA");

							if($resultadoRegistro != null){
								$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " ya se ha registrado un ingreso y una salida para el dia de hoy";
							}else{
								if( $horaActual < $horaFinal) {
									$dataPermiso = $this->permisos_model->getPermiso($idUsuario, $fecha, "SALIDA");

									if($dataPermiso != null){
										foreach ($dataPermiso->result() as $valuePermiso) {
											$horaPermiso = $valuePermiso->Hora;

											$horaUsuario = strtotime( $hora );
											$horaPer = strtotime( $horaPermiso );

											if( $horaUsuario >= $horaPer ) {
												$array = array(
													'idUsuario' => $idUsuario,
													'idCredencial' => $_POST["idCredencial"],
													'Tipo' => "SALIDA",
													'Observacion' => "Salida usando un permiso");
												//Se llama a la funcion de guardar datos en bd que esta en el modelo
												$this->registro_control_model->crear($array);
												$value->Mensaje = "Adios " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
											}else{
												$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " no tiene permiso para salir a esta hora. Si tiene permiso falta tiempo para poder salir";
											}
										}
										
									}else{
										$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " no tiene permiso para salir a esta hora. No hay existe un permiso para salir antes de la hora de salida";
									}
								}else{
									$array = array(
										'idUsuario' => $idUsuario,
										'idCredencial' => $_POST["idCredencial"],
										'Tipo' => "SALIDA",
										'Observacion' => "Salida normal");
									//Se llama a la funcion de guardar datos en bd que esta en el modelo
									$this->registro_control_model->crear($array);
									$value->Mensaje = "Adios " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
								}
							}

							
						}else{
							$resultadoRegistro = $this->registro_control_model->existeRegistro($_POST["idCredencial"], "ENTRADA");

							if($resultadoRegistro != null){
								$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " ya se ha registrado un ingreso y una salida para el dia de hoy";
							}else{
								if( $horaActual > $horaInicio) {
									$dataPermiso = $this->permisos_model->getPermiso($idUsuario, $fecha, "ENTRADA");

									if($dataPermiso != null){
										foreach ($dataPermiso->result() as $valuePermiso) {
											$horaPermiso = $valuePermiso->Hora;

											$horaUsuario = strtotime( $hora );
											$horaPer = strtotime( $horaPermiso );

											if( $horaUsuario <= $horaPer ) {
												$array = array(
													'idUsuario' => $idUsuario,
													'idCredencial' => $_POST["idCredencial"],
													'Tipo' => "ENTRADA",
													'Observacion' => "Entrada a tiempo usando un permiso");
												//Se llama a la funcion de guardar datos en bd que esta en el modelo
												$this->registro_control_model->crear($array);
												$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
											}else{
												$array = array(
													'idUsuario' => $idUsuario,
													'idCredencial' => $_POST["idCredencial"],
													'Tipo' => "ENTRADA",
													'Observacion' => "Entrada tardia despues del permiso");
												//Se llama a la funcion de guardar datos en bd que esta en el modelo
												$this->registro_control_model->crear($array);
												$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
											}
										}
										
									}else{
										$array = array(
											'idUsuario' => $idUsuario,
											'idCredencial' => $_POST["idCredencial"],
											'Tipo' => "ENTRADA",
											'Observacion' => "Entrada tardia");
										//Se llama a la funcion de guardar datos en bd que esta en el modelo
										$this->registro_control_model->crear($array);
										$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
									}
								}else{
									$array = array(
										'idUsuario' => $idUsuario,
										'idCredencial' => $_POST["idCredencial"],
										'Tipo' => "ENTRADA",
										'Observacion' => "Entrada normal");
									//Se llama a la funcion de guardar datos en bd que esta en el modelo
									$this->registro_control_model->crear($array);
									$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
								}
							}
							
						}

						
						break;
					
					case 'Funcionario':
						$dataTurno = $this->turnos_laborales_model->getTurno($idUsuario);

						if($dataTurno != null){
							foreach ($dataTurno->result() as $valueTurno) {
								$horaActual = strtotime( $hora );
								$horaInicio = strtotime( $valueTurno->hora_inicio );	
								$horaFinal = strtotime( $valueTurno->hora_final );

								$existeUltimoEntrada = $this->registro_control_model->ExisteEntradaUltima($_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo

								if($existeUltimoEntrada == true){
									$resultadoRegistro = $this->registro_control_model->existeRegistro($_POST["idCredencial"], "SALIDA");

									if($resultadoRegistro != null){
										$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " ya se ha registrado un ingreso y una salida para el dia de hoy";
									}else{
										if( $horaActual < $horaFinal) {
											$dataPermiso = $this->permisos_model->getPermiso($idUsuario, $fecha, "SALIDA");

											if($dataPermiso != null){
												foreach ($dataPermiso->result() as $valuePermiso) {
													$horaPermiso = $valuePermiso->Hora;

													$horaUsuario = strtotime( $hora );
													$horaPer = strtotime( $horaPermiso );

													if( $horaUsuario >= $horaPer ) {
														$array = array(
															'idUsuario' => $idUsuario,
															'idCredencial' => $_POST["idCredencial"],
															'Tipo' => "SALIDA",
															'Observacion' => "Salida usando un permiso");
														//Se llama a la funcion de guardar datos en bd que esta en el modelo
														$this->registro_control_model->crear($array);
														$value->Mensaje = "Adios " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
													}else{
														$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " no tiene permiso para salir a esta hora. Si tiene permiso falta tiempo para poder salir";
													}
												}
												
											}else{
												$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " no tiene permiso para salir a esta hora. No hay existe un permiso para salir antes de la hora de salida";
											}
										}else{
											$array = array(
												'idUsuario' => $idUsuario,
												'idCredencial' => $_POST["idCredencial"],
												'Tipo' => "SALIDA",
												'Observacion' => "Salida normal");
											//Se llama a la funcion de guardar datos en bd que esta en el modelo
											$this->registro_control_model->crear($array);
											$value->Mensaje = "Adios " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
										}
									}
								}else{
									$resultadoRegistro = $this->registro_control_model->existeRegistro($_POST["idCredencial"], "ENTRADA");

									if($resultadoRegistro != null){
										$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " ya se ha registrado un ingreso y una salida para el dia de hoy";
									}else{
										if( $horaActual > $horaInicio) {
											$dataPermiso = $this->permisos_model->getPermiso($idUsuario, $fecha, "ENTRADA");

											if($dataPermiso != null){
												foreach ($dataPermiso->result() as $valuePermiso) {
													$horaPermiso = $valuePermiso->Hora;

													$horaUsuario = strtotime( $hora );
													$horaPer = strtotime( $horaPermiso );

													if( $horaUsuario <= $horaPer ) {
														$array = array(
															'idUsuario' => $idUsuario,
															'idCredencial' => $_POST["idCredencial"],
															'Tipo' => "ENTRADA",
															'Observacion' => "Entrada a tiempo usando un permiso");
														//Se llama a la funcion de guardar datos en bd que esta en el modelo
														$this->registro_control_model->crear($array);
														$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
													}else{
														$array = array(
															'idUsuario' => $idUsuario,
															'idCredencial' => $_POST["idCredencial"],
															'Tipo' => "ENTRADA",
															'Observacion' => "Entrada tardia despues del permiso");
														//Se llama a la funcion de guardar datos en bd que esta en el modelo
														$this->registro_control_model->crear($array);
														$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
													}
												}
												
											}else{
												$array = array(
													'idUsuario' => $idUsuario,
													'idCredencial' => $_POST["idCredencial"],
													'Tipo' => "ENTRADA",
													'Observacion' => "Entrada tardia");
												//Se llama a la funcion de guardar datos en bd que esta en el modelo
												$this->registro_control_model->crear($array);
												$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
											}
										}else{
											$array = array(
												'idUsuario' => $idUsuario,
												'idCredencial' => $_POST["idCredencial"],
												'Tipo' => "ENTRADA",
												'Observacion' => "Entrada normal");
											//Se llama a la funcion de guardar datos en bd que esta en el modelo
											$this->registro_control_model->crear($array);
											$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
										}
									}
								}
							}
							
						}else{
							$existeUltimoEntrada = $this->registro_control_model->ExisteEntradaUltima($_POST["idCredencial"]);//Se llama a la funcion de que esta en modelo

							if($existeUltimoEntrada == true){
								$resultadoRegistro = $this->registro_control_model->existeRegistro($_POST["idCredencial"], "SALIDA");

								if($resultadoRegistro != null){
									$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " ya se ha registrado un ingreso y una salida para el dia de hoy";
								}else{
									$array = array(
										'idUsuario' => $idUsuario,
										'idCredencial' => $_POST["idCredencial"],
										'Tipo' => "SALIDA",
										'Observacion' => "Salida sin tener un turno asignado");
									//Se llama a la funcion de guardar datos en bd que esta en el modelo
									$this->registro_control_model->crear($array);
									$value->Mensaje = "Adios " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
								}
							}else{
								$resultadoRegistro = $this->registro_control_model->existeRegistro($_POST["idCredencial"], "ENTRADA");

								if($resultadoRegistro != null){
									$value->Mensaje = $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido . " ya se ha registrado un ingreso y una salida para el dia de hoy";
								}else{
									$array = array(
										'idUsuario' => $idUsuario,
										'idCredencial' => $_POST["idCredencial"],
										'Tipo' => "ENTRADA",
										'Observacion' => "Entrada sin tener un turno asignado");
									//Se llama a la funcion de guardar datos en bd que esta en el modelo
									$this->registro_control_model->crear($array);
									$value->Mensaje = "Bienvenido(a) " . $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;
								}
							}
						}
						
						break;
					
				}

			}
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}
	}
}