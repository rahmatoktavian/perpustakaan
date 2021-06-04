<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table peminjaman di database
	public function read($petugas_id='', $nim='', $search_param=array()) {

		//sql read
        $this->db->select('peminjaman.*');
        $this->db->select('petugas.nama AS nama_petugas');
        $this->db->select('anggota.nama AS nama_anggota');
        $this->db->select('(SELECT COUNT(peminjaman_buku.buku_id) FROM peminjaman_buku WHERE peminjaman_buku.peminjaman_id = peminjaman.id) AS total_buku');
        $this->db->from('peminjaman');
        $this->db->join('petugas', 'peminjaman.petugas_id = petugas.id');
        $this->db->join('anggota', 'peminjaman.nim = anggota.nim');

        if($petugas_id != '')
        	$this->db->where('peminjaman.petugas_id', $petugas_id);

        if($nim != '')
        	$this->db->where('peminjaman.nim', $nim);

        //filter cari
        if(!empty($search_param['anggota_nim']) && $search_param['anggota_nim'] != '-') {
        	$this->db->where('peminjaman.nim', $search_param['anggota_nim']);
        }

        if(!empty($search_param['anggota_nama']) && $search_param['anggota_nama'] != '-') {
            $this->db->like('anggota.nama', $search_param['anggota_nama'], 'both');
        }

        if(!empty($search_param['tanggal_pinjam_start']) && $search_param['tanggal_pinjam_start'] != '-') {
        	$this->db->where('peminjaman.tanggal_pinjam >=', $search_param['tanggal_pinjam_start']);
        }

        if(!empty($search_param['tanggal_pinjam_end']) && $search_param['tanggal_pinjam_end'] != '-') {
        	$this->db->where('peminjaman.tanggal_pinjam <=', $search_param['tanggal_pinjam_end']);
        }
        //end filter

        $this->db->order_by('peminjaman.tanggal_pinjam DESC');
    	$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table peminjaman di database
	public function read_single($id) {

		//sql read
		$this->db->select('peminjaman.*');
        $this->db->select('petugas.nama AS nama_petugas');
        $this->db->select('anggota.nama AS nama_anggota');
		$this->db->from('peminjaman');
		$this->db->join('petugas', 'peminjaman.petugas_id = petugas.id');
        $this->db->join('anggota', 'peminjaman.nim = anggota.nim');

		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('peminjaman.id', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
                return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table peminjaman di database
	public function insert($input) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('peminjaman', $input);
	}

	//function update berfungsi merubah data ke table peminjaman di database
	public function update($input, $id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		//$input = data yang dikirim dari controller
		return $this->db->update('peminjaman', $input);
	}

	//function delete berfungsi menghapus data dari table peminjaman di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id', $id);
		return $this->db->delete('peminjaman');
	}
}
