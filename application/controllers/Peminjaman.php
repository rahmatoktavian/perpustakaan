<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check manual
		/*if(!$this->session->userdata('id') || $this->session->userdata('type') != 'petugas') {
        	redirect('auth/login');
        }*/

        //check akses auto
        if(!check_akses('peminjaman/read')) {
        	redirect('auth/login');
        }
        
        //memanggil model
        $this->load->model(array('peminjaman_model','anggota_model', 'petugas_model', 'pengembalian_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
	}

	public function read() {
		$petugas_id = $this->session->userdata('petugas_id');
		$nim = '';

		$data_peminjaman = $this->peminjaman_model->read($petugas_id, $nim);
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_read',
						'judul' => 'Daftar Peminjaman',

						//data peminjaman dikirim ke view
						'data_peminjaman' => $data_peminjaman
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
		//$this->load->view('peminjaman_read', $output);
	}

	public function insert() {
		//drop down anggota
		$data_anggota = $this->anggota_model->read();
		
		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_insert',
						'judul' => 'Tambah Peminjaman',
						'data_anggota' => $data_anggota
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {

		$this->form_validation->set_rules('nim', 'Anggota', 'required');
		$this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
		$this->form_validation->set_rules('tanggal_batas_kembali', 'Batas Tanggal Kembali', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {

        	//proses multi query
			$this->db->trans_begin();

			//insert peminjaman
			$petugas_id = $this->session->userdata('petugas_id');
			$nim = $this->input->post('nim');
			$tanggal_pinjam = date('Y-m-d');
			$tanggal_batas_kembali = $this->input->post('tanggal_batas_kembali');

			$input = array(
							'nim' => $nim,
							'petugas_id' => $petugas_id,
							'tanggal_pinjam' => $tanggal_pinjam,
							'tanggal_batas_kembali' => $tanggal_batas_kembali
							
						);
			$this->peminjaman_model->insert($input);

			//get last insert peminjaman id
			$peminjaman_id = $this->db->insert_id();

			//insert pengembalian (tanpa tanggal kembali)
			$input_pengembalian = array(
							'peminjaman_id' => $peminjaman_id,
							'petugas_id' => $petugas_id
						);
			$this->pengembalian_model->insert($input_pengembalian);

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

	public function update() {
		//menangkap id data yg dipilih dari view (parameter get)
		$id = $this->uri->segment(3);

		$data_peminjaman_single = $this->peminjaman_model->read_single($id);
		
		//drop down anggota
		$data_anggota = $this->anggota_model->read();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'peminjaman_update',
						'judul' => 'Ubah Peminjaman',

						'data_peminjaman_single' => $data_peminjaman_single,
						'data_anggota' => $data_anggota
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function update_submit() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		$this->form_validation->set_rules('nim', 'Anggota', 'required');
		$this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
		$this->form_validation->set_rules('tanggal_batas_kembali', 'Batas Tanggal Kembali', 'required');

		//jika validasi gagal
		if ($this->form_validation->run() == FALSE) {
			$this->insert();

		//jika validasi sukses
        } else {
			//menangkap data input dari view
			$nim = $this->input->post('nim');
			$tanggal_pinjam = $this->input->post('tanggal_pinjam');
			$tanggal_batas_kembali = $this->input->post('tanggal_batas_kembali');

			//mengirim data ke model
			$input = array(
							'nim' => $nim,
							'tanggal_pinjam' => $tanggal_pinjam,
							'tanggal_batas_kembali' => $tanggal_batas_kembali
							
						);

			//function update berfungsi merubah data ke table peminjaman di database
			$this->peminjaman_model->update($input, $id);

			//pesan
			$this->session->set_flashdata('message', 'Data berhasil diubah');

			//mengembalikan halaman ke function read
			redirect('peminjaman/read');
		}
	}

	public function delete() {
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada peminjaman model
		$this->peminjaman_model->delete($id);

		//pesan
		$this->session->set_flashdata('message', 'Data berhasil dihapus');

		//mengembalikan halaman ke function read
		redirect('peminjaman/read');
	}
}
