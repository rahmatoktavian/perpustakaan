<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'admin') {
        	redirect('auth/login');
        }
        
        //memanggil model
        $this->load->model(array('user_model','anggota_model', 'petugas_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		//memanggil function read pada user model
		//function read berfungsi mengambil/read data dari table user di database
		$data_user = $this->user_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'user_read',
						'judul' => 'Daftar User',

						//data user dikirim ke view
						'data_user' => $data_user
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert() {
		//drop down type
		$data_type = array('admin', 'petugas', 'anggota');

		//drop down petugas
		$data_petugas = $this->petugas_model->read();

		//drop down anggota
		$data_anggota = $this->anggota_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'user_insert',
						'judul' => 'Tambah User',
						'data_type' => $data_type,
						'data_petugas' => $data_petugas,
						'data_anggota' => $data_anggota
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {

		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_ulangi', 'Password Ulangi', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {
			//menangkap data input dari view
			$type = $this->input->post('type');
			$petugas_id = $this->input->post('petugas_id');
			$nim = $this->input->post('nim');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');

			//mengirim data ke model
			$input = array(
							//format : nama field/kolom table => data input dari view
							'type' => $type,
							'petugas_id' => $petugas_id,
							'nim' => $nim,
							'username' => $username,
							'password' => md5($password),
							'nama' => $nama,
						);

			//memanggil function insert pada user model
			//function insert berfungsi menyimpan/create data ke table user di database
			$this->user_model->insert($input);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil ditambah');

			//mengembalikan halaman ke function read
			redirect('user/read');
		}
	}

	public function update() {
		//menangkap id data yg dipilih dari view (parameter get)
		$id = $this->uri->segment(3);

		$data_user_single = $this->user_model->read_single($id);
		
		//drop down type
		$data_type = array('admin', 'petugas', 'anggota');

		//drop down petugas
		$data_petugas = $this->petugas_model->read();

		//drop down anggota
		$data_anggota = $this->anggota_model->read();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'user_update',
						'judul' => 'Ubah User',

						'data_user_single' => $data_user_single,
						'data_type' => $data_type,
						'data_petugas' => $data_petugas,
						'data_anggota' => $data_anggota
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function update_submit() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->update();

		//jika validasi sukses
        } else {
			//menangkap data input dari view
			$type = $this->input->post('type');
			$petugas_id = $this->input->post('petugas_id');
			$nim = $this->input->post('nim');
			$username = $this->input->post('username');
			$nama = $this->input->post('nama');

			//mengirim data ke model
			$input = array(
							//format : nama field/kolom table => data input dari view
							'type' => $type,
							'petugas_id' => $petugas_id,
							'nim' => $nim,
							'username' => $username,
							'nama' => $nama,
						);

			//memanggil function update pada user model
			//function update berfungsi merubah data ke table user di database
			$this->user_model->update($input, $id);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil diubah');

			//mengembalikan halaman ke function read
			redirect('user/read');
		}
	}

	public function delete() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada user model
		$this->user_model->delete($id);

		//pesan
		$this->session->set_flashdata('message', 'Data berhasil dihapus');

		//mengembalikan halaman ke function read
		redirect('user/read');
	}
}
