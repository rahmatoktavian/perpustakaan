<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo_dataset_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table algo_dataset di database
	public function read() {

		//sql read
		$this->db->select('*');
		$this->db->from('algo_dataset');
		$this->db->order_by('id');
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table algo_dataset di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('algo_dataset');

		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	public function read_count($filter=array()) {
		$this->db->select('count(algo_dataset.id) AS data_count');
		$this->db->from('algo_dataset');

        foreach($filter as $field=>$value)
			$this->db->where($field, $value);

		$query = $this->db->get();
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table algo_dataset di database
	public function insert($input) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('algo_dataset', $input);
	}

	//function update berfungsi merubah data ke table algo_dataset di database
	public function update($input, $id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		//$input = data yang dikirim dari controller
		return $this->db->update('algo_dataset', $input);

		/*
		UPDATE algo_dataset
		SET nama = 'Jakarta'
		WHERE id = 1
		*/
	}

	//function delete berfungsi menghapus data dari table algo_dataset di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id', $id);
		return $this->db->delete('algo_dataset');

		//DELETE FROM algo_dataset WHERE id = 1
	}
}
