<?php defined('BASEPATH') OR exit('No direct script access allowed');

function user_akses($pid){
    $ci =& get_instance();
    $ci->load->model('user_type_akses_model');
   
   	$user_type_id = $ci->session->userdata('user_type_id');
   	$user_akses = $ci->user_type_akses_model->read_pid($user_type_id, $pid);
  
    return $user_akses;
}

function check_akses($link){
    $ci =& get_instance();
    $ci->load->model('user_type_akses_model');
   	
   	$user_type_id = $ci->session->userdata('user_type_id');
   	$check_akses = $ci->user_type_akses_model->read_single_link($user_type_id, $link);

   	if(!empty($check_akses)) {
   		return TRUE;
   	} else {
   		return FALSE;
   	}
    
}