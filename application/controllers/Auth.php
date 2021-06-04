<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model(array('user_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->login();
	}

	public function login() {
		//memanggil fungsi login submit	(agar di view tidak dilihat fungsi login submit)
		$this->login_submit();

		//mengirim data ke view
		$output = array(
						'judul' => 'Login'
					);

		//memanggil file view
		$this->load->view('login', $output);
	}

	private function login_submit() {
		
		//proses jika tombol login di submit
		if($this->input->post('submit') == 'Login') {

			//aturan validasi input login
			$this->form_validation->set_rules('username', 'Username', 'required|alpha|callback_login_check');

			$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[4]
				');

			//jika validasi sukses 
			if ($this->form_validation->run() == TRUE) {

				//redirect after login succeed
				if($this->session->userdata('type') == 'anggota') {
					redirect('peminjaman_saya');
				} else if($this->session->userdata('type') == 'petugas') {
					redirect('dashboard');
				}
				
			} 

		}
	}

	public function login_check() {

		//menangkap data input dari view
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//password encrypt
		$password_encrypt = md5($password);
		
		//check username & password sesuai dengan di database
		$data_user = $this->user_model->read_single_login($username, $password_encrypt);
		
		//jika cocok : dikembalikan ke fungsi login_submit (validasi sukses)
		if(!empty($data_user)) {

			//buat session user 
			$this->session->set_userdata('id', $data_user['id']);
			$this->session->set_userdata('user_type_id', $data_user['user_type_id']);
			$this->session->set_userdata('username', $data_user['username']);
			$this->session->set_userdata('type', $data_user['type']);
			$this->session->set_userdata('petugas_id', $data_user['petugas_id']);
			$this->session->set_userdata('nim', $data_user['nim']);

			if($data_user['petugas_id'] != NULL) {
				$this->session->set_userdata('nama', $data_user['nama_petugas']);
			} else {
				$this->session->set_userdata('nama', $data_user['nama_anggota']);
			}

			return TRUE;

		//jika tidak cocok : dikembalikan ke fungsi login_submit (validasi gagal)
		} else {

			//membuat pesan error
			$this->form_validation->set_message('login_check', 'Username & password tidak tepat');
			
			return FALSE;

		}
	}

	public function logout() {
		
		//check user already login
		if(empty($this->session->userdata('username'))){
        	redirect('auth/login');
        }

		//hapus session user
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('nama');

		//mengembalikan halaman ke function read
		redirect('auth/login');
	}

	public function reset_password() {
		
		//check user already login
		if(!$this->session->userdata('id')) {
        	redirect('auth/login');
        }

		//mengirim data ke view
		$output = array(
						'theme_page' => 'reset_password',
						'judul' => 'Reset Password'
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function reset_password_submit() {
		//proses jika tombol login di submit
		if($this->input->post('submit') == 'Simpan') {

			//aturan validasi input login
			$this->form_validation->set_rules('password_lama', 'Password Lama', 'required|alpha_numeric|min_length[5]|callback_password_lama_check');
			$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|alpha_numeric|min_length[5]
				');
			$this->form_validation->set_rules('password_baru_ulangi', 'Password Baru Ulangi', 'required|alpha_numeric|min_length[5]|matches[password_baru]
				');

			//jika validasi gagal
			if ($this->form_validation->run() == FALSE) {
				$this->reset_password();

			//jika validasi sukses
	        } else {

				$id = $this->session->userdata('id');
				$password_baru = $this->input->post('password_baru');

				//reset password
				$input = array(
						'password' => md5($password_baru)
					);

				$this->user_model->update($input, $id);

				$this->session->set_flashdata('message', 'Berhasil reset password');
				redirect('auth/reset_password');
			} 

		}
	}

	public function password_lama_check() {

		$username = $this->session->userdata('username');
		$password_lama = $this->input->post('password_lama');

		//password encrypt
		$password_encrypt = md5($password_lama);
		
		//check username & password sesuai dengan di database
		$data_user = $this->user_model->read_single_login($username, $password_encrypt);
		
		//jika cocok : dikembalikan ke fungsi login_submit (validasi sukses)
		if(!empty($data_user)) {
			return TRUE;

		//jika tidak cocok : dikembalikan ke fungsi login_submit (validasi gagal)
		} else {

			//membuat pesan error
			$this->form_validation->set_message('password_lama_check', 'Password lama tidak tepat');
			
			return FALSE;

		}
	}
}
