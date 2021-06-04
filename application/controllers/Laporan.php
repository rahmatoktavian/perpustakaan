<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }

        //check akses auto
        /*if(!check_akses('laporan/rekap_peminjaman')) {
        	redirect('auth/login');
        }*/
        
        //memanggil model
        $this->load->model(array('dashboard_model','peminjaman_model', 'anggota_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->kota_provinsi();
	}

	public function rekap_peminjaman() {
		//memanggil fungsi model laporan
		$data_laporan = $this->dashboard_model->rekap_peminjaman_perhari();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'laporan_rekap_peminjaman',
						'judul' => 'Laporan Rekap Peminjaman',
						'data_laporan' => $data_laporan
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function rekap_peminjaman_export() {
		$tipe_file = $this->uri->segment(3);

		//memanggil fungsi model laporan
		$data_laporan = $this->dashboard_model->rekap_peminjaman_perhari();
		
		//mengirim data ke view
		$output = array(
						'data_laporan' => $data_laporan,
						'tipe_file' => $tipe_file
					);

		//excel
		if($tipe_file == 'xls') {
			$this->load->view('laporan_rekap_peminjaman_export', $output);

		//pdf
		} else {
			//php5
			//$this->load->library('pdf');
	    	//$this->pdf->view('laporan_rekap_peminjaman_export', $output);

			//php7
			$this->load->helper('pdf');
			pdf_view('laporan_rekap_peminjaman_export', $output);
		}
	}

	public function detail_peminjaman() {

		//filter cari
		$anggota_nim = $this->uri->segment(3) ? $this->uri->segment(3) : '-';
        $anggota_nama = $this->uri->segment(4) ? $this->uri->segment(4) : '-';
        $tanggal_pinjam_start = $this->uri->segment(5) ? $this->uri->segment(5) : '-';
        $tanggal_pinjam_end = $this->uri->segment(6) ? $this->uri->segment(6) : '-';

        $search_param = array(
        					'anggota_nim' => $anggota_nim,
        					'anggota_nama' => $anggota_nama,
        					'tanggal_pinjam_start' => $tanggal_pinjam_start,
        					'tanggal_pinjam_end' => $tanggal_pinjam_end,
        				);
        //end filter

        //convert data search param array menjadi url pada view read
		$search_param_url = implode('/', $search_param);

		//memanggil fungsi model laporan
		$petugas_id = $this->session->userdata('petugas_id');
		$nim = '';

		//search_param : param ketiga
		$data_laporan = $this->peminjaman_model->read($petugas_id, $nim, $search_param);
		
		//data anggota
		$data_anggota = $this->anggota_model->read();	

		//mengirim data ke view
		$output = array(
						'theme_page' => 'laporan_detail_peminjaman',
						'judul' => 'Laporan Rekap Peminjaman',
						'data_laporan' => $data_laporan,
						'data_anggota' => $data_anggota,
						'search_param' => $search_param
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	//filter cari
	public function detail_peminjaman_cari() {
		
		//menangkap data filter
		if($this->input->post('anggota_nim')) {
			$search_param['anggota_nim'] =  $this->input->post('anggota_nim');
		} else {
			$search_param['anggota_nim'] =  '-';
		}

		if($this->input->post('anggota_nama')) {
			$search_param['anggota_nama'] =  $this->input->post('anggota_nama');
		} else {
			$search_param['anggota_nama'] =  '-';
		}

		if($this->input->post('tanggal_pinjam_start')) {
			$search_param['tanggal_pinjam_start'] =  $this->input->post('tanggal_pinjam_start');
		} else {
			$search_param['tanggal_pinjam_start'] =  '-';
		}

		if($this->input->post('tanggal_pinjam_end')) {
			$search_param['tanggal_pinjam_end'] =  $this->input->post('tanggal_pinjam_end');
		} else {
			$search_param['tanggal_pinjam_end'] =  '-';
		}

		//convert search param menjadi url
		$search_param_url = implode('/', $search_param);
		
		//kembalikan ke fungsi read dengan bawa url
		redirect('laporan/detail_peminjaman/'.$search_param_url);
	}

	public function detail_peminjaman_export() {
		$tipe_file = $this->uri->segment(3);

		//memanggil fungsi model laporan
		$petugas_id = $this->session->userdata('petugas_id');
		$nim = '';

		$data_laporan = $this->peminjaman_model->read($petugas_id, $nim);
		
		//mengirim data ke view
		$output = array(
						'data_laporan' => $data_laporan,
						'tipe_file' => $tipe_file
					);

		//excel
		if($tipe_file == 'xls') {
			$this->load->view('laporan_detail_peminjaman_export', $output);

		//pdf
		} else {
			//php 5
			//$this->load->library('pdf');
	    	//$this->pdf->view('laporan_detail_peminjaman_export', $output);

	    	//php7
			$this->load->helper('pdf');
			pdf_view('laporan_detail_peminjaman_export', $output);
		}
	}

}
