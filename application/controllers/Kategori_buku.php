<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_buku extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check user already login & authorized user type
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }
        
        //memanggil model
        $this->load->model('kategori_buku_model');
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		//memanggil function read pada kategori_buku model
		//function read berfungsi mengambil/read data dari table kategori_buku di database
		$data_kategori_buku = $this->kategori_buku_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'kategori_buku_read',
						'judul' => 'Daftar Kategori Buku',

						//data kategori_buku dikirim ke view
						'data_kategori_buku' => $data_kategori_buku
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert() {
		//mengirim data ke view
		$output = array(
						'theme_page' => 'kategori_buku_insert',
						'judul' => 'Tambah Kategori Buku',
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {

		$this->form_validation->set_rules('nama', 'Nama', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {
			//menangkap data input dari view
			$nama = $this->input->post('nama');

			//mengirim data ke model
			$input = array(
							//format : nama field/kolom table => data input dari view
							'nama' => $nama
						);

			//memanggil function insert pada kategori_buku model
			//function insert berfungsi menyimpan/create data ke table kategori_buku di database
			$this->kategori_buku_model->insert($input);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil ditambah');

			//mengembalikan halaman ke function read
			redirect('kategori_buku/read');
		}
	}

	public function update() {
		//menangkap id data yg dipilih dari view (parameter get)
		$id = $this->uri->segment(3);

		//function read berfungsi mengambil 1 data dari table kategori_buku sesuai id yg dipilih
		$data_kategori_buku_single = $this->kategori_buku_model->read_single($id);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'kategori_buku_update',
						'judul' => 'Ubah Kategori Buku',

						//mengirim data kategori_buku yang dipilih ke view
						'data_kategori_buku_single' => $data_kategori_buku_single,
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function update_submit() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		$this->form_validation->set_rules('nama', 'Nama', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->update();

		//jika validasi sukses
        } else {
			//menangkap data input dari view
			$nama = $this->input->post('nama');

			//mengirim data ke model
			$input = array(
							//format : nama field/kolom table => data input dari view
							'nama' => $nama
						);

			//memanggil function update pada kategori_buku model
			//function update berfungsi merubah data ke table kategori_buku di database
			$this->kategori_buku_model->update($input, $id);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil diubah');

			//mengembalikan halaman ke function read
			redirect('kategori_buku/read');
		}
	}

	public function delete() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada kategori_buku model
		$this->kategori_buku_model->delete($id);

		//pesan
		$this->session->set_flashdata('message', 'Data berhasil dihapus');

		//mengembalikan halaman ke function read
		redirect('kategori_buku/read');
	}
}
