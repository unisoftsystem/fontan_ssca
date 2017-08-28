<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_IDcolegio'))
{
    function get_IDcolegio()
    {
        return '';
        //  	$CI =& get_instance();
        //  	$colegio_name = $_COOKIE['COLEGIO_NAME'];
        //      $CI->load->model('superadmin_model');
        //      $ID = $CI->superadmin_model->get_IDColegio($colegio_name);
        //  	if(count($ID) > 0) {
        //  		return $ID[0]->ID;
        //  	}else {
        //  		$arr = array(
        // 	'Mensaje' => '403 - Forbidden',
        // 	'Recomendacion' => '',
        // );
        // header('HTTP/1.1 403 Unautorized');
        // echo json_encode($arr);
        // exit();
        // }
    }   
}