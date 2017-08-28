<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Movimientos extends CI_Controller {

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
		$this->load->model('ordenpedido_model');//Cargar el modelo de orden de pedido donde estan las funciones que hacen las consultas a la bd
		$this->load->model('detalle_orden_pedido_model');//Cargar el modelo de detalle de orden de pedido donde estan las funciones que hacen las consultas a la bd
		$this->load->model('credenciales_model');//Cargar el modelo de credenciales donde estan las funciones que hacen las consultas a la bd
		$this->load->model('movimientos_model');//Cargar el modelo de movimientos donde estan las funciones que hacen las consultas a la bd
		$this->load->model('producto_model');//Cargar el modelo de producto donde estan las funciones que hacen las consultas a la bd
		$this->load->model('categoria_model');//Cargar el modelo de categoria donde estan las funciones que hacen las consultas a la bd
		$this->load->model('usuarios_aplicaciones_model');//Cargar el modelo de usuarios de aplicaciones donde estan las funciones que hacen las consultas a la bd
		$this->load->model('permisos_usuarios_sistema_model');//Cargar el modelo de permisos de usuarios del sistema donde estan las funciones que hacen las consultas a la bd
		$this->load->helper('form');//Cargar el helper de formularios
		$this->load->library('email');//Cargar la libreria de email
	}
	/******************** MOSTRAR PAGINAS **************************/
	public function index()
	{
		
	}

	//Mostrar la vista de consultar movimientos
	function consultaMovimientos(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../movimientos/consultaMovimientos", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Consulta de Movimientos";//Titulo de la pagina, se lo envio al archivo donde esta el header

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('credenciales/consultaMovimientos', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}
	//Mostrar la vista de consultar saldos
	function reporteSaldos(){
    	$this->load->library('logo_footer');
		//Se valida si la pagina a acceder esta dentro de los pemisos del usuario que ha iniciado sesion
		$validacion = $this->permisos_usuarios_sistema_model->verificarPagina("../movimientos/reporteSaldos", $this->session->userdata('UserIDInternoSSCA'));	

		//Se verifica que el usuario tiene permiso a la pagina	
		if($validacion > 0){

			//Se cargan los menus de los modulos, submodulos y servicios que estan en el controller services
			$this->load->library('../controllers/services');
			$data['menuPrincipal'] = $this->services->menuModulos($this->session->userdata('UserIDInternoSSCA'), $this->session->userdata('SegmentoTextoModulo'));	
			$data['menuServicios'] = $this->services->menuServicios($this->session->userdata('UserIDInternoSSCA'), "", $this->session->userdata('SegmentoCodigoModulo'));
			$data['titulo'] = "Consulta de Saldos";//Titulo de la pagina, se lo envio al archivo donde esta el header

			$this->load->view('header', $data);//Se muestra en el navegador primero el header con titulo y demas cosas agregada
			$logo_footer = $this->logo_footer->obtener_logo();
			$datos_footer = [
				'logo' => $logo_footer
			];
			$array_page = [
				'footer' =>  $this->load->view('footerPages', $datos_footer, true)
			];
			$this->load->view('credenciales/reporteSaldos', $array_page);//Se carga la vista que esta dentro de la carpeta
		}else{
			echo "<script>window.location.href = '" . base_url() . "index.php/usuarios_sistema/homeInternoModulos';</script>";//Se redirecciona a la pagina del home cuando el usuario que ha iniciado sesion no tiene permiso sobre la pagina que intenta ingresar
		}
	}
	/******************* ACCIONES ******************************/

	//Funcion para generar reporte de recarga de credenciales
	function GenerarReporteRecaudo(){
		$resultado = $this->movimientos_model->ReporteCaja($_POST["fechaInicial"], $_POST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			//Se verifica si el usuario al que se le hizo la recarga es un Estudiante para buscar los datos de su acudiente
			
				
				//Se itera el json de los datos del usuario
				foreach ($resultado->result() as $value) {
					if($value->TipoUsuario == "Estudiante"){
						//Se obtiene los datos del acudiente del estudiante
						$acudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda

						//Si se encuentran sus datos se agregan los datos del acudiente dentro del objeto json de las recargas
						if($acudiente != null){
							$value->Acudiente = $acudiente->result()[0]->PrimerNombre . " " . $acudiente->result()[0]->SegundoNombre . " " . $acudiente->result()[0]->PrimerApellido . " " . $acudiente->result()[0]->SegundoApellido;
							$value->NumeroIdAcudiente = $acudiente->result()[0]->TipoId . " " . $acudiente->result()[0]->NumeroId;
						}else{
							$value->Acudiente = "";
							$value->NumeroIdAcudiente = "";
						}
					}else{
						$value->Acudiente = "";
						$value->NumeroIdAcudiente = "";
					}
				}
			
			
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para generar reporte de devoluciones de saldo de credenciales
	function GenerarReporteDevoluciones(){
		$resultado = $this->movimientos_model->ReporteDevoluciones($_POST["fechaInicial"], $_POST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			//Se verifica si el usuario al que se le hizo la recarga es un Estudiante para buscar los datos de su acudiente
			
				
				//Se itera el json de los datos del usuario
				foreach ($resultado->result() as $value) {
					if($value->TipoUsuario == "Estudiante"){
						//Se obtiene los datos del acudiente del estudiante
						$acudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda

						//Si se encuentran sus datos se agregan los datos del acudiente dentro del objeto json de las recargas
						if($acudiente != null){
							$value->Acudiente = $acudiente->result()[0]->PrimerNombre . " " . $acudiente->result()[0]->SegundoNombre . " " . $acudiente->result()[0]->PrimerApellido . " " . $acudiente->result()[0]->SegundoApellido;
							$value->NumeroIdAcudiente = $acudiente->result()[0]->TipoId . " " . $acudiente->result()[0]->NumeroId;
						}else{
							$value->Acudiente = "";
							$value->NumeroIdAcudiente = "";
						}
					}else{
						$value->Acudiente = "";
						$value->NumeroIdAcudiente = "";
					}
				}
			
			
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para generar reporte de devoluciones de saldo de credenciales
	function GenerarReporteReversionPedidos(){
		$resultado = $this->movimientos_model->ReporteReversionPedidos($_POST["fechaInicial"], $_POST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			//Se verifica si el usuario al que se le hizo la recarga es un Estudiante para buscar los datos de su acudiente
			
				
				//Se itera el json de los datos del usuario
				foreach ($resultado->result() as $value) {
					if($value->TipoUsuario == "Estudiante"){
						//Se obtiene los datos del acudiente del estudiante
						$acudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda

						//Si se encuentran sus datos se agregan los datos del acudiente dentro del objeto json 
						if($acudiente != null){
							$value->Acudiente = $acudiente->result()[0]->PrimerNombre . " " . $acudiente->result()[0]->SegundoNombre . " " . $acudiente->result()[0]->PrimerApellido . " " . $acudiente->result()[0]->SegundoApellido;
							$value->NumeroIdAcudiente = $acudiente->result()[0]->TipoId . " " . $acudiente->result()[0]->NumeroId;
						}else{
							$value->Acudiente = "";
							$value->NumeroIdAcudiente = "";
						}
					}else{
						$value->Acudiente = "";
						$value->NumeroIdAcudiente = "";
					}
				}
			
			
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}


	//Funcion para generar reporte de devoluciones de saldo de credenciales
	function GenerarReportePermisosSalidas(){
		$resultado = $this->movimientos_model->ReportePermisosSalidas($_POST["fechaInicial"], $_POST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			//Se verifica si el usuario al que se le hizo la recarga es un Estudiante para buscar los datos de su acudiente
			
				
				//Se itera el json de los datos del usuario
				foreach ($resultado->result() as $value) {
					if($value->TipoUsuario == "Estudiante"){
						//Se obtiene los datos del acudiente del estudiante
						$acudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda

						//Si se encuentran sus datos se agregan los datos del acudiente dentro del objeto json 
						if($acudiente != null){
							$value->Acudiente = $acudiente->result()[0]->PrimerNombre . " " . $acudiente->result()[0]->SegundoNombre . " " . $acudiente->result()[0]->PrimerApellido . " " . $acudiente->result()[0]->SegundoApellido;
							$value->NumeroIdAcudiente = $acudiente->result()[0]->TipoId . " " . $acudiente->result()[0]->NumeroId;
						}else{
							$value->Acudiente = "";
							$value->NumeroIdAcudiente = "";
						}
					}else{
						$value->Acudiente = "";
						$value->NumeroIdAcudiente = "";
					}
				}
			
			
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}


	//Funcion para generar el reporte de la consulta de movimientos
	function ReporteMovimientos(){
		$resultado = $this->movimientos_model->ReporteMovimientos($_POST["fechaInicial"], $_POST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){		
			
			echo json_encode($resultado->result());
		}else{
			echo "[]";
		}		
	}

	//Funcion para generar el reporte de la consulta de movimientos
	function ConsultaReporteSaldos(){
		$resultado = $this->movimientos_model->ReporteSaldos();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		echo json_encode($resultado);
	}

	//Funcion para exportar a excel un reporte de recarga de credenciales
	function ExportarReporteRecaudo(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		//Se genera el reporte de recarga de credenciales
		$resultado = $this->movimientos_model->ReporteCaja($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){

			//Se verifica si el usuario al que se le hizo la recarga es un Estudiante para buscar los datos de su acudiente
			
				

				foreach ($resultado->result() as $value) {
					if($value->TipoUsuario == "Estudiante"){
						//Se obtiene los datos del acudiente del estudiante
						$acudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda

						//Si se encuentran sus datos se agregan los datos del acudiente dentro del objeto json de las recargas
						if($acudiente != null){
							$value->Acudiente = $acudiente->result()[0]->PrimerNombre . " " . $acudiente->result()[0]->SegundoNombre . " " . $acudiente->result()[0]->PrimerApellido . " " . $acudiente->result()[0]->SegundoApellido;
							$value->NumeroIdAcudiente = $acudiente->result()[0]->TipoId . " " . $acudiente->result()[0]->NumeroId;
						}else{
							$value->Acudiente = "";
							$value->NumeroIdAcudiente = "";
						}
					}else{
						$value->Acudiente = "";
						$value->NumeroIdAcudiente = "";
					}
				}
			
			
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reporte de Recargas")
               ->setSubject("Reporte de Recargas")
               ->setDescription("Reporte de Recargas")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 2;     

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "ID USUARIO");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "NOMBRES");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "APELLIDOS");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "ACUDIENTE");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "NUMERO DE IDENTIFICACION DEL ACUDIENTE");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "FECHA(aaaa-mm-dd)");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "HORA");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "DESCRIPCION");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "VALOR");
			
			//Se convierte la fecha a letras
			$num = date("j", strtotime($value->FechaMovimiento));
		    $anno = date("Y", strtotime($value->FechaMovimiento));
		    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		    $mes = $mes[(date('m', strtotime($value->FechaMovimiento))*1)-1];
		    $fechaDato =  $num.' de '.$mes.' del '.$anno;

		    //Se itera el json de los datos y se escriben en el excel en cada celda
			foreach ($resultado->result() as $value) {
				$objPHPExcel->setActiveSheetIndex(0)
	          		->setCellValue('A'.$i, $value->idUsuario);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$i, $value->PrimerNombre . " " . $value->SegundoNombre);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$i, $value->PrimerApellido . " " . $value->SegundoApellido);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('D'.$i, $value->Acudiente);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('E'.$i, $value->NumeroIdAcudiente);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('F'.$i, $value->FechaMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('G'.$i, $value->HoraMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('H'.$i, $value->DescripcionMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('I'.$i, $value->ValorMovimiento);   

				$i++;            
			}
			
		}else{
			echo "[]";
		}	
		
		
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Recargas');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Recargas" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

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

	//Funcion para exportar a excel un reporte de recarga de credenciales
	function ExportarReporteDevoluciones(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		//Se genera el reporte de recarga de credenciales
		$resultado = $this->movimientos_model->ReporteDevoluciones($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){

			//Se verifica si el usuario al que se le hizo la recarga es un Estudiante para buscar los datos de su acudiente			
			
			foreach ($resultado->result() as $value) {
				if($value->TipoUsuario == "Estudiante"){
					//Se obtiene los datos del acudiente del estudiante
					$acudiente = $this->usuarios_aplicaciones_model->obtenerAcudiente($value->idAcudiente);//Se llama a la funcion de que esta en modelo y el resultado se guarda

					//Si se encuentran sus datos se agregan los datos del acudiente dentro del objeto json de las recargas
					if($acudiente != null){
						$value->Acudiente = $acudiente->result()[0]->PrimerNombre . " " . $acudiente->result()[0]->SegundoNombre . " " . $acudiente->result()[0]->PrimerApellido . " " . $acudiente->result()[0]->SegundoApellido;
						$value->NumeroIdAcudiente = $acudiente->result()[0]->TipoId . " " . $acudiente->result()[0]->NumeroId;
					}else{
						$value->Acudiente = "";
						$value->NumeroIdAcudiente = "";
					}
				}else{
					$value->Acudiente = "";
					$value->NumeroIdAcudiente = "";
				}
			}
			
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reporte de Devoluciones")
               ->setSubject("Reporte de Devoluciones")
               ->setDescription("Reporte de Devoluciones")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 2;     

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "ID USUARIO");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "NOMBRES");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "APELLIDOS");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "ACUDIENTE");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "NUMERO DE IDENTIFICACION DEL ACUDIENTE");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "FECHA(aaaa-mm-dd)");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "HORA");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "DESCRIPCION");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "VALOR");
			
			//Se convierte la fecha a letras
			$num = date("j", strtotime($value->FechaMovimiento));
		    $anno = date("Y", strtotime($value->FechaMovimiento));
		    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		    $mes = $mes[(date('m', strtotime($value->FechaMovimiento))*1)-1];
		    $fechaDato =  $num.' de '.$mes.' del '.$anno;

		    //Se itera el json de los datos y se escriben en el excel en cada celda
			foreach ($resultado->result() as $value) {
				$objPHPExcel->setActiveSheetIndex(0)
	          		->setCellValue('A'.$i, $value->idUsuario);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$i, $value->PrimerNombre . " " . $value->SegundoNombre);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$i, $value->PrimerApellido . " " . $value->SegundoApellido);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('D'.$i, $value->Acudiente);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('E'.$i, $value->NumeroIdAcudiente);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('F'.$i, $value->FechaMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('G'.$i, $value->HoraMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('H'.$i, $value->DescripcionMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('I'.$i, $value->ValorMovimiento);   

				$i++;            
			}
			
		}else{
			echo "[]";
		}	
		
		
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Devoluciones');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Devoluciones" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

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

	//Funcion para exportar a excel un reporte de la consulta de movimientos
	function ExportarConsultaMovimientos(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		//Se genera el reporte de la consulta de movimientos
		$resultado = $this->movimientos_model->ReporteMovimientos($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reporte de Movimientos")
               ->setSubject("Reporte de Movimientos")
               ->setDescription("Reporte de Movimientos")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");
            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 4;    

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "FECHA(aaaa-mm-dd)");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "HORA");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "DESCRIPCION");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "VALOR");
			
		 	//Se itera el json de los datos y se escriben en el excel en cada celda
			foreach ($resultado->result() as $value) {
				$num = date("j", strtotime($value->FechaMovimiento));
			    $anno = date("Y", strtotime($value->FechaMovimiento));
			    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
			    $mes = $mes[(date('m', strtotime($value->FechaMovimiento))*1)-1];
			    $fechaDato =  $num.' de '.$mes.' del '.$anno;
		    
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido);
    

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('B'.$i, $value->FechaMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('C'.$i, $value->HoraMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('D'.$i, $value->DescripcionMovimiento);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('E'.$i, $value->ValorMovimiento);  

				$i++;            
			}
			
		}	
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Movimientos');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Movimientos" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

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

	//Funcion para exportar a excel un reporte de la consulta de movimientos
	function ExportarConsultaSaldos(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		//Se genera el reporte de la consulta de movimientos
		$resultado = $this->movimientos_model->ReporteSaldos();//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reporte de Saldos")
               ->setSubject("Reporte de Saldos")
               ->setDescription("Reporte de Saldos")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");
            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 2;    

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "DOCUMENTO");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "NOMBRES");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "APELLIDOS");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "SALDO");
			
		 	//Se itera el json de los datos y se escriben en el excel en cada celda
			foreach ($resultado as $value) {				
		    
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $value->NumeroId);    

			    $objPHPExcel->setActiveSheetIndex(0)
		          	->setCellValue('B'.$i, $value->PrimerNombre . " " . $value->SegundoNombre);

			    $objPHPExcel->setActiveSheetIndex(0)
		          	->setCellValue('C'.$i, $value->PrimerApellido . " " . $value->SegundoApellido);

			    $objPHPExcel->setActiveSheetIndex(0)
		          	->setCellValue('D'.$i, $value->SaldoCredencial); 

				$i++;            
			}
			
		}	
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Saldos');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Saldos" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

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


//Funcion para exportar a excel un reporte de reversion pedidos
	function ExportarReversionPedidos(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		//Se genera el reporte de la consulta de movimientos
		$resultado = $this->movimientos_model->ReporteReversionPedidos($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reporte Reversion Pedidos")
               ->setSubject("Reporte Reversion Pedidos")
               ->setDescription("Reporte Reversion Pedidos")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");
            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 4;    

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "FECHA(aaaa-mm-dd)");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "HORA");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "Id PEDIDO");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "Origen Pedido");
			
		 	//Se itera el json de los datos y se escriben en el excel en cada celda
			foreach ($resultado->result() as $value) {
				$num = date("j", strtotime($value->FechaCancelacion));
			    $anno = date("Y", strtotime($value->FechaCancelacion));
			    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
			    $mes = $mes[(date('m', strtotime($value->FechaCancelacion))*1)-1];
			    $fechaDato =  $num.' de '.$mes.' del '.$anno;
		    
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido);
    

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('B'.$i, $value->FechaCancelacion);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('C'.$i, $value->HoraCancelacion);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('D'.$i, $value->idPedido);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('E'.$i, $value->OrigenPedido);      
 

				$i++;            
			}
			
		}	
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Movimientos');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Movimientos" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

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


//Funcion para exportar a excel un reporte de salidas
	function ExportarSalidas(){
		//Se carga la libreria en PHP de Excel
		$this->load->file('PHPExcel/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		//Se genera el reporte de la consulta de movimientos
		$resultado = $this->movimientos_model->ReporteSalidas($_REQUEST["fechaInicial"], $_REQUEST["fechaFinal"], $_REQUEST["usuario"]);//Se llama a la funcion de que esta en modelo y el resultado se guarda
		if($resultado != null){
			// Se agregan la propiedades del archivo de excel a crear
			$objPHPExcel->getProperties()->setCreator("Unisoft System Corporation")
               ->setLastModifiedBy("Fontan")
               ->setTitle("Reporte Salidas")
               ->setSubject("Reporte Salidas")
               ->setDescription("Reporte Salidas")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");
            //Se inicia un contador en 2 para que los datos iterados que se van a ingresar al excel comiencen desde una fila vacia, pues la fila 1 contiene el nombre de cada columna   
			$i = 4;    

			//Se comienzan a crear las primeras celdas que tendran el nombre de cada columna
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "FECHA(aaaa-mm-dd)");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "HORA");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "OBSERVACIONES");
			
		 	//Se itera el json de los datos y se escriben en el excel en cada celda
			foreach ($resultado->result() as $value) {
				$num = date("j", strtotime($value->Fecha));
			    $anno = date("Y", strtotime($value->Fecha));
			    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
			    $mes = $mes[(date('m', strtotime($value->Fecha))*1)-1];
			    $fechaDato =  $num.' de '.$mes.' del '.$anno;
		    
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido);
    

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('B'.$i, $value->Fecha);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('C'.$i, $value->Hora);

			    $objPHPExcel->setActiveSheetIndex(0)
			          ->setCellValue('D'.$i, $value->Observaciones);
 

				$i++;            
			}
			
		}	
		// Se agrega titulo al archivo nuevo
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de Movimientos');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//Se genera un nombre de archivo nuevo de tal manera que no se repita 
		$nombreArchivo = "Reporte_Movimientos" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";

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






}