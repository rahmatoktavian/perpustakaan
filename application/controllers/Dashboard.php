<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }

        //check akses auto
        /*if(!check_akses('dashboard/index')) {
        	redirect('auth/login');
        }*/

        //memanggil model
        $this->load->model(array('dashboard_model'));
    }

	public function index() {
		//summary
		$data_peminjaman_buku = $this->dashboard_model->total_peminjaman_buku();
		$data_pengembalian_buku = $this->dashboard_model->total_pengembalian_buku();

		//grafik
		$data_grafik = $this->dashboard_model->rekap_peminjaman_perbuku();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'dashboard',
						'judul' => 'Dashboard',
						
						'data_peminjaman_buku' => $data_peminjaman_buku,
						'data_pengembalian_buku' => $data_pengembalian_buku,
						'data_grafik' => $data_grafik
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

}
