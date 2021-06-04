<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function rekap_peminjaman_perbuku() {

		//sql read
		$this->db->select('buku.judul');
        $this->db->select('COUNT(peminjaman_buku.buku_id) AS total_peminjaman');
        $this->db->from('peminjaman_buku');
        $this->db->join('buku', 'peminjaman_buku.buku_id = buku.id');
        $this->db->group_by('buku.judul');
        $this->db->order_by('COUNT(peminjaman_buku.buku_id) DESC');
		$query = $this->db->get();

        return $query->result_array();
	}

	public function rekap_peminjaman_perhari() {

		//sql read
		$this->db->select('peminjaman.tanggal_pinjam');
        $this->db->select('COUNT(peminjaman_buku.buku_id) AS total_buku');
        $this->db->from('peminjaman_buku');
        $this->db->join('peminjaman', 'peminjaman_buku.peminjaman_id = peminjaman.id');
        $this->db->group_by('peminjaman.tanggal_pinjam');
        $this->db->order_by('peminjaman.tanggal_pinjam', 'DESC');
		$query = $this->db->get();

        return $query->result_array();
	}

	public function rekap_peminjaman_peranggota() {

		//sql read
		$this->db->select('anggota.nama');
        $this->db->select('COUNT(peminjaman_buku.buku_id) AS total_peminjaman');
        $this->db->from('peminjaman_buku');
		$this->db->join('peminjaman', 'peminjaman_buku.peminjaman_id = peminjaman_id');
		$this->db->join('anggota', 'peminjaman.nim = anggota.nim');
        $this->db->group_by('anggota.nama');
		$query = $this->db->get();

        return $query->result_array();
	}

	public function total_peminjaman_buku() {

		//sql read
        $this->db->select('COUNT(peminjaman_buku.buku_id) AS total');
        $this->db->from('peminjaman_buku');
		$query = $this->db->get();

        return $query->row_array();
	}

	public function total_pengembalian_buku() {

		//sql read
        $this->db->select('COUNT(pengembalian_buku.buku_id) AS total');
        $this->db->from('pengembalian_buku');
		$query = $this->db->get();

        return $query->row_array();
	}

}
