<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }

        //check akses auto
        /*if(!check_akses('anggota/read')) {
        	redirect('auth/login');
        }*/
        
        //memanggil model
        $this->load->model('anggota_model');
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		//memanggil function read pada anggota model
		//function read berfungsi mengambil/read data dari table anggota di database
		$data_anggota = $this->anggota_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'anggota_read',
						'judul' => 'Daftar Anggota',

						//data anggota dikirim ke view
						'data_anggota' => $data_anggota
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert() {
		//mengirim data ke view
		$output = array(
						'theme_page' => 'anggota_insert',
						'judul' => 'Tambah Anggota',
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {

		$this->form_validation->set_rules('nim', 'NIM', 'required|numeric|min_length[3]|is_unique[anggota.nim]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {

			//menangkap data input dari view
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$jurusan = $this->input->post('jurusan');

			//mengirim data ke model
			$input = array(
							//format : nim field/kolom table => data input dari view
							'nim' => $nim,
							'nama' => $nama,
							'jurusan' => $jurusan,
						);

			//memanggil function insert pada anggota model
			//function insert berfungsi menyimpan/create data ke table anggota di database
			$this->anggota_model->insert($input);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil ditambah');

			//mengembalikan halaman ke function read
			redirect('anggota/read');
		}
	}

	public function update() {
		//menangkap nim data yg dipilih dari view (parameter get)
		$nim = $this->uri->segment(3);

		//function read berfungsi mengambil 1 data dari table anggota sesuai nim yg dipilih
		$data_anggota_single = $this->anggota_model->read_single($nim);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'anggota_update',
						'judul' => 'Ubah Anggota',

						//mengirim data anggota yang dipilih ke view
						'data_anggota_single' => $data_anggota_single,
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function update_submit() {
		//menangkap nim data yg dipilih dari view
		$nim = $this->uri->segment(3);

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->update();

		//jika validasi sukses
        } else {

			//menangkap data input dari view
			$nama = $this->input->post('nama');
			$jurusan = $this->input->post('jurusan');

			//mengirim data ke model
			$input = array(
							//format : nim field/kolom table => data input dari view
							'nim' => $nim,
							'nama' => $nama,
							'jurusan' => $jurusan,
						);

			//memanggil function update pada anggota model
			//function update berfungsi merubah data ke table anggota di database
			$this->anggota_model->update($input, $nim);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil diubah');

			//mengembalikan halaman ke function read
			redirect('anggota/read');
		}
	}

	public function delete() {
		//menangkap nim data yg dipilih dari view
		$nim = $this->uri->segment(3);

		//memanggil function delete pada anggota model
		$this->anggota_model->delete($nim);

		//pesan
		$this->session->set_flashdata('message', 'Data berhasil diubah');

		//mengembalikan halaman ke function read
		redirect('anggota/read');
	}
}
