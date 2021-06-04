<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_saya extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'anggota') {
        	redirect('auth/login');
        }

        //check akses auto
        /*if(!check_akses('peminjaman_saya/read')) {
        	redirect('auth/login');
        }*/

        //memanggil model
        $this->load->model(array('peminjaman_model', 'peminjaman_buku_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		$petugas_id = '';
		$nim = $this->session->userdata('nim');

		$data_peminjaman = $this->peminjaman_model->read($petugas_id, $nim);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_saya_read',
						'judul' => 'Daftar peminjaman',

						//data peminjaman dikirim ke view
						'data_peminjaman' => $data_peminjaman
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function read_buku() {
		$peminjaman_id = $this->uri->segment(3);

		$data_peminjaman = $this->peminjaman_model->read_single($peminjaman_id);

		$data_peminjaman_buku = $this->peminjaman_buku_model->read($peminjaman_id);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_saya_read_buku',
						'judul' => 'Daftar Buku',

						//data peminjaman dikirim ke view
						'data_peminjaman' => $data_peminjaman,
						'data_peminjaman_buku' => $data_peminjaman_buku
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

}
