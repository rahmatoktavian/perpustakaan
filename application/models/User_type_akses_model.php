<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_type_akses_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table user_type_akses di database
	public function read_pid($user_type_id, $pid) {

		//sql read
		$this->db->select('user_type_akses.id');
		$this->db->select('akses.*');
		$this->db->from('user_type_akses');
		$this->db->join('akses', 'user_type_akses.akses_id = akses.id');
		$this->db->where('user_type_akses.user_type_id', $user_type_id);
		$this->db->where('akses.pid', $pid);
		$this->db->order_by('pid, urutan');
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table user_type_akses di database
	public function read_single_link($user_type_id, $link) {

		//sql read
		$this->db->select('user_type_akses.id');
		$this->db->select('akses.*');
		$this->db->from('user_type_akses');
		$this->db->join('akses', 'user_type_akses.akses_id = akses.id');
		$this->db->where('user_type_akses.user_type_id', $user_type_id);
		$this->db->where('akses.link', $link);
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->row_array();
	}

	//function read berfungsi mengambil/read data dari table user_type_akses di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('user_type_akses');

		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table user_type_akses di database
	public function insert($input) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('user_type_akses', $input);
	}

	//function update berfungsi merubah data ke table user_type_akses di database
	public function update($input, $id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		//$input = data yang dikirim dari controller
		return $this->db->update('user_type_akses', $input);

		/*
		UPDATE user_type_akses
		SET nama = 'Jakarta'
		WHERE id = 1
		*/
	}

	//function delete berfungsi menghapus data dari table user_type_akses di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id', $id);
		return $this->db->delete('user_type_akses');

		//DELETE FROM user_type_akses WHERE id = 1
	}
}
