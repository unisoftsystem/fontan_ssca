<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class SuperAdmin extends CI_Controller 
{
	function sessionValidate() {
		if ($this->session->userdata('PERFIL_') !=  'superADMIN') {
			header("HTTP/1.1 403 Forbidden");
			$error = ['error_code' => '403', 'message' => 'Forbidden'];
			$this->json_response($error);
			exit();
		}
	}

	/**
	 * [json_response description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function json_response($data)
	{
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	/**
	 * Load view for super admin folder with it css and js files
	 * @param   $[folder] [folder to searchs files]
	 * @param   $[file_name] [.php, .css, .js to load]
	 * @param   $[data] [array(header=>array(),view=>array(),) with data to pass to head and view]
	 */
	function super_admin_load_view($folder = '', $file_name=null, $data=['header', 'view'])
	{	
		$data_view = (isset($data['view']) && $data['view'] != '') ? $data['view'] : [];
		$data_head = (isset($data['header']) && $data['header'] != '') ? $data['header'] : [];
		
		$this->load->view('SuperAdmin/wrapper/document_open.php', $data_head);
		
		if(file_exists(APPPATH.'views/SuperAdmin/'.$folder.'/'.$file_name.'.css')) {
			echo '<style>'; 
			include_once(APPPATH.'views/SuperAdmin/wrapper/default.css'); 
			include_once(APPPATH.'views/SuperAdmin/'.$folder.'/'.$file_name.'.css'); 
			echo '</style>';
		}

		$this->load->view('SuperAdmin/'.$folder.'/'.$file_name.'.php', $data_view);
		
		if(file_exists(APPPATH.'views/SuperAdmin/'.$folder.'/'.$file_name.'.js')) {
			echo '<script>'; 
			include_once(APPPATH.'views/SuperAdmin/wrapper/default.js'); 
			include_once(APPPATH.'views/SuperAdmin/'.$folder.'/'.$file_name.'.js');
			echo '</script>'; 
		}

		$this->load->view('SuperAdmin/wrapper/document_close.php');
	}

	/**
	 * Start point allways redirect login
	 * @return [Void]
	 */
	function index()
	{
		// $this->crear_carnet();
		$this->ingresar();
	}

	/**
	 * Load view for login
	 * @return [Void] 
	 */
	function ingresar()
	{
		$this->super_admin_load_view('login', 'login');
	}

	/**
	 * Function for authenticate in platfotrm as super admin
	 * @return [Boolean] [authentication successfull]
	 */
	function do_login()
	{
		$login = false;
		$this->load->model('superadmin_model');
		$resp = $this->superadmin_model->do_login();

		if(count($resp) > 0) {
			$login = true;
			$this->session->set_userdata($resp[0]);
			$this->session->set_userdata('PERFIL_', 'superADMIN');
		}

		$this->json_response($login);
	}

	/**
	 * Load view users 
	 * @return [Void]
	 */
	function adminintrar_usuarios()
	{	
		$this->sessionValidate();
		$this->super_admin_load_view('users', 'users');
	}

	/**
	 * Get all users registrates as schools
	 * @return [Array] [collection of users]
	 */
	function get_colegios() {
		$this->sessionValidate();
		$this->load->model('superadmin_model');
		$resp = $this->superadmin_model->get_colegios();
		$this->json_response($resp);
	}

	function get_colegios_from_app() {
		$this->load->model('superadmin_model');
		$resp = $this->superadmin_model->get_colegio_from_app( $_POST['name'] );
		$this->json_response($resp);
	}

	/**
	 * [register_colegio description]
	 * @return [type] [description]
	 */
	function register_colegio() {
		$this->sessionValidate();
		$ID = $this->input->post('ID', true);
		if( ! empty($ID) ) {
			$this->edit_colegio();
		}else{
			$this->create_colegio();
		}
	}

	/**
	 * Create a new user 
	 * @return [Boolean] [is ok/fail operation]
	 */
	function create_colegio()
	{
		$this->sessionValidate();
		$success = false;
		$this->load->model('superadmin_model');
		$resp = $this->superadmin_model->create_colegio();

		if(count($resp) > 0) {
			$success = true;
			$this->session->set_userdata($resp[0]);
			
			$newPath = '/var/www/html/'.$this->input->post('dominio', true).'/'; 
			mkdir($newPath);
			chmod($newPath, 0777 );
			file_put_contents($newPath.'.htaccess', '
				Options FollowSymLinks
				<IfModule mod_rewrite.c>
				    RewriteEngine on
				    RewriteCond %{REQUEST_FILENAME} !-f
				    RewriteCond %{REQUEST_FILENAME} !-d
				    RewriteRule ^(.*)$ index.php?/$1 [L]
				</IfModule> 
				<IfModule !mod_rewrite.c>
				    ErrorDocument 404 /index.php
				</IfModule>
			');
			chmod($newPath.'.htaccess', 0777 );
			file_put_contents($newPath.'index.php', '<?php include "/var/www/html/ssca_saas/index.php"; ?>');
			chmod($newPath.'index.php', 0777 );
			$credenciales = '/var/www/html/'.$this->input->post('dominio', true).'/credenciales/'; 
			mkdir($credenciales);
			chmod($credenciales, 0777 );
			$images = '/var/www/html/'.$this->input->post('dominio', true).'/images/'; 
			mkdir($images);
			chmod($images, 0777 );

			$isOk = $this->superadmin_model->create_data_base();
			if($isOk == true) {
				$success = true;				
			}else {
				$success = false;				
			}
		}

		$this->json_response($success);
	}

	function register_logo() 
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']     = '100';
		$config['file_name']     = 'img_logo_'.time();
		$config['overwrite']     = true;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->json_response($error);
		}else {
			$data = array('upload_data' => $this->upload->data());
			$this->json_response($data);
		}
	}

	/**
	 * Edit a user 
	 * @return [Boolean] [is ok/fail operation]
	 */
	function edit_colegio()
	{
		$this->sessionValidate();
		$success = false;
		$this->load->model('superadmin_model');
		$resp = $this->superadmin_model->edit_colegio();

		if(count($resp) > 0) {
			$success = true;
			$this->session->set_userdata($resp[0]);
		}

		$this->json_response($success);
	}

	/**
	 * [ver_usuario description]
	 * @return [type] [description]
	 */
	function ver_usuario($ID)
	{
		$this->sessionValidate();
		$this->load->model('superadmin_model');
		$user = $this->superadmin_model->get_cole($ID); 
		$user = (count($user) > 0) ? json_encode($user[0]) : $user;
		$data['view'] = ['user' => $user];
		$this->super_admin_load_view('user', 'user', $data);
	}

	/**
	 * [validate_nombre_institucion description]
	 * @return [type] [description]
	 */
	function validate_nombre_institucion()
	{
		$this->sessionValidate();
		$this->load->model('superadmin_model');
		$data = $this->superadmin_model->validate_nombre_institucion();
		$this->json_response($data);
	}

	/**
	 * [crear_carnet description]
	 * @return [type] [description]
	 */
	function crear_carnet()
	{
		$this->sessionValidate();
		$this->super_admin_load_view('user', 'user');
	}

	/**
	 * [guardar_cara_carnet description]
	 * @return [type] [description]
	 */
	function guardar_cara_carnet()
	{
		$this->sessionValidate();
		$this->load->model('superadmin_model');
		$data = $this->superadmin_model->guardar_cara_carnet();
		$this->json_response($data);
	}

	/**
	 * [imprimir_carnet description]
	 * @return [type] [description]
	 */
	function imprimir_carnet()
	{
		// $this->sessionValidate();
		$userID = $_GET['user'];
		if(! (isset($userID) && $userID != '')) exit('Usuario no valido'); 
		$this->load->model('superadmin_model');
		$user = $this->superadmin_model->get_user($userID);
		$data = $this->superadmin_model->get_carnet();
		$data_view['view'] = ['carnet' => $data, 'user' => $user];
		$this->super_admin_load_view('printCarnet', 'printCarnet', $data_view);
	}

	/**
	 * [imprimir_carnet description]
	 * @return [type] [description]
	 */
	function print_carnet()
	{
		// $this->sessionValidate();
		$uri = explode('/', base_url());
		$folderName =  $uri[count($uri) - 2];
		$output_file = '/var/www/html/'.$folderName.'/credenciales/credencial'.time().'.png';
		$base64_string = $this->input->post('image');
		$data = explode( ',', $base64_string );
		file_put_contents($output_file, base64_decode($data[ 1 ]));
	}



}