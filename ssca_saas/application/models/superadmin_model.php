<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Superadmin_model extends CI_Model
{
	// 	ID	int(11)			
	// dominio	int(50)			
	// nombre_contratante	varchar(100)			
	// email_contratante	varchar(200)			
	// nombre_institucion	varchar(200)			
	// estado
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_IDColegio($dominio) 
	{
		$this->db->select('ID');
		$this->db->from('_colegios');
		$this->db->where('dominio', $dominio);
		$query = $this->db->get();
		return $query->result();
	}

	function get_colegios()
	{
		$this->db->select('*');
		$this->db->from('_colegios');
		$query = $this->db->get();
		return $query->result();
	}

	function get_colegio_from_app($name)
	{
		$n = sprintf('%s', $name);
		$this->db->select('nombre_institucion, dominio, ');
		$this->db->from('_colegios');
		$this->db->where('estado', 1);
		$this->db->like('nombre_institucion', $n);
		$query = $this->db->get();
		return $query->result();
	}

	function do_login()
	{
		$this->db->select('*');
		$this->db->from('_super_admins');
		$this->db->where('email', $this->input->post('email', true));
		$this->db->where('contrasena', $this->input->post('contrasena', true));
		$this->db->where('estado', 1);
		$query = $this->db->get();
		return $query->result();
	}

	function create_colegio()
	{
		$data = array(
			'ID'                 => NULL,
			'url_acceso'         => $this->input->post('url_acceso', true) ,
			'dominio'            => $this->input->post('dominio', true) ,
			'nombre_contratante' => $this->input->post('nombre_contratante', true) ,
			'email_contratante'  => $this->input->post('email_contratante', true) ,
			'nombre_institucion' => $this->input->post('nombre_institucion', true) ,
			'img_logo' => $this->input->post('img_logo', true) ,
			'estado'             => $this->input->post('estado', true)
		);
		
		return $this->db->insert('_colegios', $data); 
	}

	function edit_colegio()
	{
		$data = array(
			'nombre_contratante' => $this->input->post('nombre_contratante', true) ,
			'email_contratante'  => $this->input->post('email_contratante', true),
			'estado'             => $this->input->post('estado', true)
		);

		if(!empty($this->input->post('img_logo', true))) {
			$data['img_logo'] = $this->input->post('img_logo', true);
		}

		$this->db->where('ID', $this->input->post('ID', true));
		return $this->db->update('_colegios', $data); 
	}

	/**
	 * [get_cole description]
	 * @param  [type] $ID [description]
	 * @return [type]     [description]
	 */
	function get_cole($ID = 0)
	{
		$this->db->select('*');
		$this->db->from('_colegios');
		$this->db->where('ID', $ID);
		$cole = $this->db->get();
		return $cole->result(); 
	}

	/**
	 * [validate_nombre_institucion description]
	 * @return [type] [description]
	 */
	function validate_nombre_institucion()
	{
		$this->db->select('*');
		$this->db->from('_colegios');
		$this->db->like('nombre_institucion', $this->input->post('nombreInstitucion', true));
		$cole = $this->db->get();
		return $cole->result(); 
	}

	/**
	 * [create_data_base description]
	 * @return [type] [description]
	 */
	function create_data_base()
	{
		$response = false;
		$db_name = $this->input->post('dominio', true);
		$mysqli = new mysqli('localhost', 'root', 'usc');

		if ($mysqli->connect_errno) {
			printf("Falló la conexión: %s\n", $mysqli->connect_error);
			exit();
		}

		$sql_table = 'CREATE DATABASE `'.$db_name.'` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_spanish_ci';
		if ($mysqli->query($sql_table) === TRUE) {
			$mysqli_1 = new mysqli('localhost', 'root', 'usc', $db_name);
			$sql_file = file_get_contents("/var/www/html/ssca_saas/sql/database.sql");
			$re = '/(prueba@ssca.com)/';
			$subst = $this->input->post('email_contratante', true);
			$result = preg_replace($re, $subst, $sql_file);
			if($mysqli_1->multi_query(mb_convert_encoding($result, 'HTML-ENTITIES', "UTF-8")) === TRUE) {
				$response = true;
			}else {
			    printf("Falló la creacion de las tablas: %s\n", $mysqli_1->error);
			    exit();
			}
			$mysqli_1->close();

			// $url = $this->input->post('dominio', true) ,
			// 'nombre_institucion' => $this->input->post('nombre_institucion', true) ,
			$url = $this->input->post('url_acceso', true);
			$user = $this->input->post('email_contratante', true);
			$nombre = $this->input->post('nombre_contratante', true);
			$html = '
				<table width="600px">
					<tr> <td><h3>Hola <br>'.$nombre.'.</h3></td> </tr>
					<tr> <td><p>Estos son tus datos de acceso:</p></td> </tr>
					<tr> 
						<p><b>Usuario: </b>'.$user.'</p>
						<p><b>Contraseña: </b>123</p>
						<p><b>Url: </b>'.$url.'</p>
					</tr>
				</table>
			';

			$this->load->library('email');
			$this->email->from('admin@ssca.com', 'SSCA');
			$this->email->to($this->input->post('email_contratante', true));
			$this->email->subject('Datos de acceso pataforma SSCA.');
			$this->email->message($html);
			$this->email->set_mailtype("html");
			$this->email->send();
		}else {
		    printf("Falló la creacion de la base de datos: %s\n", $mysqli->error);
		    exit();
		}

		$mysqli->close();
		return $response;
	}

	/**
	 * [guardar_cara_carnet description]
	 * @return [type] [description]
	 */
	function guardar_cara_carnet()
	{
		if($this->input->post('cara_carnet', true) == 'parametrizacion_posterior') {
			$this->db->set('html_posterior', $this->input->post('html', false));
		}else {
			$this->db->set('html_frente',$this->input->post('html', false));
		}
		$this->db->where('ID', 1);
		return $this->db->update('_carnet');
	}

	/**
	 * [guardar_cara_carnet description]
	 * @return [type] [description]
	 */
	function get_carnet()
	{
		$this->db->select('*');
		$this->db->from('_carnet');
		$this->db->where('ID', 1);
		$result = $this->db->get();
		return $result->result();
	}

	/**
	 * [get_user description]
	 * @param  string $user [description]
	 * @return [type]       [description]
	 */
	function get_user($user = '')
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('idUsuario', $user);
		$result = $this->db->get();
		return $result->result();
	}

}

