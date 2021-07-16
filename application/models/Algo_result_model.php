<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo_result_model extends CI_Model {

	public function read($filter=array()) {
        $this->db->select('*');
        $this->db->from('algo_result');

        foreach($filter as $field=>$value)
			$this->db->where($field, $value);

        $this->db->order_by('id');
    	$query = $this->db->get();
        return $query->result_array();
	}

	public function read_single($id) {
		$this->db->select('*');
		$this->db->from('algo_result');
        $this->db->where('id', $id);

		$query = $this->db->get();
        return $query->row_array();
	}

	public function read_group() {
        $this->db->select('param_group');
        $this->db->from('algo_result');
        $this->db->group_by('param_group');
    	$query = $this->db->get();
        return $query->result_array();
	}

	public function read_final_top() {
		$this->db->select('*');
		$this->db->from('algo_result');
        $this->db->where('param_group', 'final');
        $this->db->limit(1);

		$query = $this->db->get();
        return $query->row_array();
	}

	public function insert($input) {
		return $this->db->insert('algo_result', $input);
	}

	public function update($input, $id) {
		$this->db->where('id', $id);
		return $this->db->update('algo_result', $input);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('algo_result');
	}

	public function delete_all() {
		return $this->db->query('DELETE FROM algo_result');
	}
}
