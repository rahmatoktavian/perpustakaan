<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		/*if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }*/

        //check akses auto
        if(!check_akses('grafik/rekap_peminjaman')) {
        	redirect('auth/login');
        }
        
        //memanggil model
        $this->load->model('dashboard_model');
    }

	public function index() {
		//mengarahkan ke function read
		$this->rekap_peminjaman();
	}

	public function rekap_peminjaman() {
		//memanggil fungsi model laporan
		$data_grafik = $this->dashboard_model->rekap_peminjaman_perhari();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'grafik_rekap_peminjaman',
						'judul' => 'Grafik Rekap Peminjaman',
						'data_grafik' => $data_grafik
					);
					
		//memanggil file view
		$this->load->view('theme/index', $output);
	}

}
