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

function get_profile_img($nim) {
    $ci =& get_instance();
    $ci->load->model('anggota_model');
    
    //ambil data anggota berdasarkan nim yg login
    $data_user = $ci->anggota_model->read_single($nim);

    //jika ada gambar profile: ambil gambar dari folder profile
    if(!empty($data_user['profile']) && $data_user['profile'] != '') {
        $profile_img = '<img src="'.base_url('profile/'.$data_user['profile']).'" style="width:75px; border-radius:25px" />';

    //jika tidak ada gambar profile
    } else {
        $profile_img = '<i class="fas fa-user fa-lg fa-fw"></i>';
    }

    return $profile_img;
}