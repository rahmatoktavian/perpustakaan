<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id')) {
        	redirect('auth/login');
        }

        //check akses auto
        /*if(!check_akses('buku/read')) {
        	redirect('auth/login');
        }*/
        
        //memanggil model
        $this->load->model(array('buku_model','kategori_buku_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		//memanggil function read pada buku model
		//function read berfungsi mengambil/read data dari table buku di database
		$data_buku = $this->buku_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'buku_read',
						'judul' => 'Daftar Buku',

						//data buku dikirim ke view
						'data_buku' => $data_buku
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert() {

		//data kategori
		$data_kategori = $this->kategori_buku_model->read();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'buku_insert',
						'judul' => 'Tambah Buku',
						'data_kategori' => $data_kategori
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
		$this->form_validation->set_rules('cover', 'Cover', 'callback_upload_cover');
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {

        	//proses upload
        	$upload_data = $this->upload->data();

        	//ambil nama file yg berhasil diupload
        	$cover = $upload_data['file_name'];
        
			//menangkap data input dari view
			$kategori_id = $this->input->post('kategori_id');
			$judul = $this->input->post('judul');
			$stok = $this->input->post('stok');

			//mengirim data ke model
			$input = array(
							//format : judul field/kolom table => data input dari view
							'kategori_id' => $kategori_id,
							'cover' => $cover,
							'judul' => $judul,
							'stok' => $stok,
						);
			
			//memanggil function insert pada buku model
			//function insert berfungsi menyimpan/create data ke table buku di database
			$this->buku_model->insert($input);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil ditambah');

			//mengembalikan halaman ke function read
			redirect('buku/read');
		}
	}

	public function upload_cover() {
		//config & load upload
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|png|jpg|jpeg';
        $config['max_size']             = 10000;
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);


        //validasi upload
        if (!$this->upload->do_upload('cover')) {
        	//respon alasan kenapa gagal upload
        	$error_upload = $this->upload->display_errors();
        	$this->form_validation->set_message('upload_cover_multi', $error_upload);
        	return FALSE;

        } else {
        	return TRUE;
        }
	}

	public function insert_multi() {

		//data kategori
		$data_kategori = $this->kategori_buku_model->read();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'buku_insert_multi',
						'judul' => 'Tambah Buku',
						'data_kategori' => $data_kategori
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit_multi() {
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
		$this->form_validation->set_rules('cover', 'Cover', 'callback_upload_cover_multi');
		$this->form_validation->set_rules('cover2', 'Cover2', 'callback_upload_cover2_multi');
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {

        	//proses upload
        	//$upload_data = $this->upload->data();
        	$delete_file = FALSE;
        	$upload_data = $this->upload_cover_multi($delete_file);

        	//ambil nama file yg berhasil diupload
        	$cover = $upload_data['file_name'];

        	//proses upload2
        	$upload_data2 = $this->upload_cover2_multi($delete_file);

        	//ambil nama file yg berhasil diupload
        	$cover2 = $upload_data2['file_name'];
        
			//menangkap data input dari view
			$kategori_id = $this->input->post('kategori_id');
			$judul = $this->input->post('judul');
			$stok = $this->input->post('stok');

			//mengirim data ke model
			$input = array(
							//format : judul field/kolom table => data input dari view
							'kategori_id' => $kategori_id,
							'cover' => $cover,
							'cover2' => $cover2,
							'judul' => $judul,
							'stok' => $stok,
						);
			
			//memanggil function insert pada buku model
			//function insert berfungsi menyimpan/create data ke table buku di database
			$this->buku_model->insert($input);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil ditambah');

			//mengembalikan halaman ke function read
			redirect('buku/read');
		}
	}

	public function upload_cover_multi($delete_file) {
		//config & load upload
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|png|jpg|jpeg';
        $config['max_size']             = 10000;
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);

        //reset
        $this->upload->initialize($config, TRUE);

        //validasi upload
        if (!$this->upload->do_upload('cover')) {
        	//respon alasan kenapa gagal upload
        	$error_upload = $this->upload->display_errors();
        	$this->form_validation->set_message('upload_cover_multi', $error_upload);
        	return FALSE;

        } else {
        	$upload_data = $this->upload->data();

        	//delete file after validation success
        	$delete_file = isset($delete_file) ? $delete_file : TRUE;
        	if($delete_file) {
        		unlink(FCPATH.'/upload/'.$upload_data['file_name']);
        	}

        	return $upload_data;
        }
	}

	public function upload_cover2_multi($delete_file) {
		//config & load upload
        $config2['upload_path']          = './upload/';
        $config2['allowed_types']        = 'gif|png|jpg|jpeg';
        $config2['max_size']             = 10000;
        //$config2['overwrite']             = TRUE;
        $config2['encrypt_name']          = TRUE;
        $this->load->library('upload', $config2);

        //reset
        $this->upload->initialize($config2, TRUE);

        //validasi upload
        if (!$this->upload->do_upload('cover2')) {
        	//respon alasan kenapa gagal upload
        	$error_upload = $this->upload->display_errors();
        	$this->form_validation->set_message('upload_cover2_multi', $error_upload);
        	return FALSE;

        } else {
        	$upload_data = $this->upload->data();

        	//delete file after validation success
        	$delete_file = isset($delete_file) ? $delete_file : TRUE;
        	if($delete_file) {
        		unlink(FCPATH.'/upload/'.$upload_data['file_name']);
        	}

        	return $upload_data;
        }
	}

	public function update() {
		//menangkap id data yg dipilih dari view (parameter get)
		$id = $this->uri->segment(3);

		//data kategori
		$data_kategori = $this->kategori_buku_model->read();

		//function read berfungsi mengambil 1 data dari table buku sesuai id yg dipilih
		$data_buku_single = $this->buku_model->read_single($id);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'buku_update',
						'judul' => 'Ubah Buku',

						//mengirim data buku yang dipilih ke view
						'data_buku_single' => $data_buku_single,
						'data_kategori' => $data_kategori
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function update_submit() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
		$this->form_validation->set_rules('cover', 'Cover', 'callback_update_cover');
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->update();

		//jika validasi sukses
        } else {

        	//proses upload jika ada image baru replace yg lama
        	if(!empty($_FILES['cover']['name'])) {
	        	$upload_data = $this->upload->data();
	        	$cover = $upload_data['file_name'];

	        	//menangkap data input dari view
				$kategori_id = $this->input->post('kategori_id');
				$judul = $this->input->post('judul');
				$stok = $this->input->post('stok');

				//mengirim data ke model
				$input = array(
								//format : judul field/kolom table => data input dari view
								'kategori_id' => $kategori_id,
								'cover' => $cover,
								'judul' => $judul,
								'stok' => $stok,
							);

			//jika tidak ada image baru
        	} else {
        		//menangkap data input dari view
				$kategori_id = $this->input->post('kategori_id');
				$judul = $this->input->post('judul');
				$stok = $this->input->post('stok');

				//mengirim data ke model
				$input = array(
								//format : judul field/kolom table => data input dari view
								'kategori_id' => $kategori_id,
								'judul' => $judul,
								'stok' => $stok,
							);

        	}

			//memanggil function update pada buku model
			//function update berfungsi merubah data ke table buku di database
			$this->buku_model->update($input, $id);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil diubah');

			//mengembalikan halaman ke function read
			redirect('buku/read');
		}
	}

	public function update_cover() {
		//jika ada image baru replace yg lama, then do validation
		if(!empty($_FILES['cover']['name'])) {

			//config & load upload
	        $config['upload_path']          = './upload/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
	        $config['max_size']             = 10000;
	        $config['encrypt_name']         = TRUE;
	        $config['overwrite']         = TRUE;
	        
	        $this->load->library('upload', $config);

	        //validasi upload
	        if (!$this->upload->do_upload('cover')) {
	        	
	        	//respon alasan kenapa gagal upload
	        	$error_upload = $this->upload->display_errors();
	        	$this->form_validation->set_message('update_cover', $error_upload);
	        	return FALSE;

	        } else {

	        	return TRUE;
	        }
	    }
	}

	public function delete() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada buku model
		$this->buku_model->delete($id);

		//pesan
		$this->session->set_flashdata('message', 'Data berhasil dihapus');

		//mengembalikan halaman ke function read
		redirect('buku/read');
	}
}
