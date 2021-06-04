<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_buku extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }
        
        //memanggil model
        $this->load->model(array('peminjaman_buku_model', 'peminjaman_model', 'buku_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		$peminjaman_id = $this->uri->segment(3);

		$data_peminjaman = $this->peminjaman_model->read_single($peminjaman_id);

		$data_peminjaman_buku = $this->peminjaman_buku_model->read($peminjaman_id);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_buku_read',
						'judul' => 'Daftar Peminjaman',

						//data peminjaman_buku dikirim ke view
						'data_peminjaman' => $data_peminjaman,
						'data_peminjaman_buku' => $data_peminjaman_buku,
						'peminjaman_id' => $peminjaman_id
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function read_multi() {
		$peminjaman_id = $this->uri->segment(3);

		$data_peminjaman = $this->peminjaman_model->read_single($peminjaman_id);

		$data_buku = $this->buku_model->read();

		$data_peminjaman_buku = $this->peminjaman_buku_model->read($peminjaman_id);

		//get list buku id by peminjaman id
		$list_buku_peminjaman_id = array();
		if(!empty($data_peminjaman_buku)) {
			foreach($data_peminjaman_buku as $peminjaman_buku) {
				$list_buku_peminjaman_id[$peminjaman_buku['buku_id']] = $peminjaman_buku['buku_id'];
				//$list_buku_peminjaman_id[$peminjaman_buku['param_id']] = $peminjaman_buku['nilai'];
			}
		}
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_buku_multi_read',
						'judul' => 'Daftar Peminjaman',

						//data peminjaman_buku dikirim ke view
						'data_peminjaman' => $data_peminjaman,
						'data_buku' => $data_buku,
						'list_buku_peminjaman_id' => $list_buku_peminjaman_id,
						'peminjaman_id' => $peminjaman_id
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function read_submit_multi() {
		$peminjaman_id = $this->uri->segment(3);

		//tangkap data
		$buku_id = $this->input->post('buku_id');

		$this->db->trans_begin();

		//delete all buku by peminjaman id
		$this->peminjaman_buku_model->delete_multi($peminjaman_id);

		//insert multiple
		if(!empty($buku_id)) {
			foreach($buku_id as $id=>$id_buku) {
				$input = array(
								'peminjaman_id' => $peminjaman_id,
								'buku_id' => $id
							);
				$this->peminjaman_buku_model->insert($input);
			}
		}
		
		//batalkan semua query (jika ada error)
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();

		//execute semua query (jika tidak ada error)
		} else {
			$this->db->trans_commit();

			//membuat pesan
			$this->session->set_flashdata('message', 'Data berhasil ditambah');
		}

		//mengembalikan halaman ke function read
		redirect('peminjaman_buku/read_multi/'.$peminjaman_id);
	}

	public function insert() {
		$peminjaman_id = $this->uri->segment(3);

		//drop down buku
		$data_buku = $this->buku_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_buku_insert',
						'judul' => 'Tambah Peminjaman',
						'data_buku' => $data_buku,
						'peminjaman_id' => $peminjaman_id
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {
		$peminjaman_id = $this->uri->segment(3);

		$this->form_validation->set_rules('buku_id', 'Buku', 'required|callback_check_buku');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {
        	//proses multi query
			$this->db->trans_begin();

			//insert peminjaman buku
			$buku_id = $this->input->post('buku_id');
			$input = array(
							'peminjaman_id' => $peminjaman_id,
							'buku_id' => $buku_id
						);

			$this->peminjaman_buku_model->insert($input);

			//ambil stok buku
			$data_buku = $this->buku_model->read_single($buku_id);
			$stok_buku = $data_buku['stok'];
			
			//kurangi stok buku
			$input_buku = array(
							'stok' => ($stok_buku - 1)
						);

			$this->buku_model->update($input_buku, $buku_id);

			//batalkan semua query (jika ada error)
			if ($this->db->trans_status() === FALSE) {
			    $this->db->trans_rollback();

			//execute semua query (jika tidak ada error)
			} else {
				$this->db->trans_commit();

				//membuat pesan
				$this->session->set_flashdata('message', 'Data berhasil ditambah');
			}

			//mengembalikan halaman ke function read
			redirect('peminjaman_buku/read/'.$peminjaman_id);
		}
	}

	public function check_buku() {

		$peminjaman_id = $this->uri->segment(3);
		$buku_id = $this->input->post('buku_id');

		//check username & password sesuai dengan di database
		$data_peminjaman_buku = $this->peminjaman_buku_model->check_buku($peminjaman_id, $buku_id);
		
		//jika sudah pernah dipinjam : dikembalikan ke fungsi login_submit (validasi gagal)
		if(!empty($data_peminjaman_buku)) {
			//membuat pesan error
			$this->form_validation->set_message('check_buku', 'Buku sudah pernah dipinjam');
			
			return FALSE;

		//jika buku belum ada di peminjaman : dikembalikan ke fungsi login_submit (validasi sukses)
		} else {
			return TRUE;
		}
	}

	public function delete() {
		//menangkap id data yg dipilih dari view
		$peminjaman_id = $this->uri->segment(3);
		$id = $this->uri->segment(4);

		//memanggil function delete pada peminjaman_buku model
		$this->peminjaman_buku_model->delete($id);

		//pesan
		$this->session->set_flashdata('message', 'Data berhasil dihapus');

		//mengembalikan halaman ke function read
		redirect('peminjaman_buku/read/'.$peminjaman_id);
	}
}
