<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //check akses auto
        /*if(!check_akses('anggota/read')) {
        	redirect('auth/login');
        }*/
        
        //memanggil model
        $this->load->model(array('algo_dataset_model', 'algo_result_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read_dataset();
	}

	public function read_dataset() {

		//dataset
		$algo_dataset_list = $this->algo_dataset_model->read();
		
		//proses algo
		$this->db->trans_begin();

		//delete algo proses data
		$this->algo_result_model->delete_all();

		//parameter list
		$parameter_list = array();
		$parameter_list[] = array(
							'filter_total' => array(),
							'filter_count' => array('status_lulus' => 'TEPAT'),
							'filter_group' => 'status_lulus=TEPAT;'
						);
		$parameter_list[] = array(
							'filter_total' => array(),
							'filter_count' => array('status_lulus' => 'TERLAMBAT'),
							'filter_group' => 'status_lulus=TERLAMBAT;',
						);

		$parameter_list[] = array(
							'filter_total' => array('status_lulus' => 'TEPAT'),
							'filter_count' => array('status_lulus' => 'TEPAT', 'gender' => 'LAKI-LAKI'),
							'filter_group' => 'status_lulus=TEPAT;',
						);
		$parameter_list[] = array(
							'filter_total' => array('status_lulus' => 'TERLAMBAT'),
							'filter_count' => array('status_lulus' => 'TERLAMBAT', 'gender' => 'LAKI-LAKI'),
							'filter_group' => 'status_lulus=TERLAMBAT;',
						);

		$parameter_list[] = array(
							'filter_total' => array('status_lulus' => 'TEPAT'),
							'filter_count' => array('status_lulus' => 'TEPAT', 'status_mhs' => 'MAHASISWA'),
							'filter_group' => 'status_lulus=TEPAT;',
						);
		$parameter_list[] = array(
							'filter_total' => array('status_lulus' => 'TERLAMBAT'),
							'filter_count' => array('status_lulus' => 'TERLAMBAT', 'status_mhs' => 'MAHASISWA'),
							'filter_group' => 'status_lulus=TERLAMBAT;',
						);

		$parameter_list[] = array(
							'filter_total' => array('status_lulus' => 'TEPAT'),
							'filter_count' => array('status_lulus' => 'TEPAT', 'status_nikah' => 'BELUM'),
							'filter_group' => 'status_lulus=TEPAT;',
						);
		$parameter_list[] = array(
							'filter_total' => array('status_lulus' => 'TERLAMBAT'),
							'filter_count' => array('status_lulus' => 'TERLAMBAT', 'status_nikah' => 'BELUM'),
							'filter_group' => 'status_lulus=TERLAMBAT;',
						);

		//hitung data dengan looping parameter
		foreach($parameter_list as $parameter) {
			//hitung data dari filter total
			$data_total_db = $this->algo_dataset_model->read_count($parameter['filter_total']);
			$data_total = $data_total_db['data_count'];

			//hitung data dari filter count
			$data_count_db = $this->algo_dataset_model->read_count($parameter['filter_count']);
			$data_count = $data_count_db['data_count'];

			//hitung result : data count dibagi data total
			$result_status_lulus = $data_count/$data_total;

			//convert array filter_count ke dalam bentuk text
			$parameter_text = '';
			foreach($parameter['filter_count'] as $param=>$value) {
				$parameter_text .= $param.'='.$value.';';
			}

			//insert result
			$input = array(
							'param' => $parameter_text,
							'param_group' => $parameter['filter_group'],
							'data_count' => $data_count,
							'data_total' => $data_total,
							'result' => $result_status_lulus,
						);
			
			$this->algo_result_model->insert($input);
		}

		//parameter final result
		/*$parameter_group_list = array('status_lulus=TEPAT;', 'status_lulus=TERLAMBAT;');
		$parameter_extra = 'gender=LAKI-LAKI;status_mhs=MAHASISWA;status_nikah=BELUM;';

		//final result
		foreach($parameter_group_list as $param_group) {
			
			//text parameter final
			$param_final_text = $param_group.$parameter_extra.' => ';

			//ambil data algo sesuai param group list
			$filter_group = array('param_group'=>$param_group);
			$algo_result_group = $this->algo_result_model->read($filter_group);

			//hitung result final (mengkalikan semua result per group)
			$result_final_value = 0;
			foreach($algo_result_group as $index=>$result_group) {
				
				//jika data pertama tidak dikalikan
				if($index == 0) {
					$result_final_value = $result_group['result'];
					$param_final_text .= $result_group['result'];

				//data baris kedua dikalikan dgn data pertama & selanjutnya
				} else {
					$result_final_value = $result_final_value * $result_group['result'];
					$param_final_text .= ' * '.$result_group['result'];
				}
			}			

			//insert result final
			$input_final = array(
							'param' => $param_final_text,
							'param_group' => 'final',
							'data_count' => 0,
							'data_total' => 0,
							'result' => $result_final_value,
						);
			$this->algo_result_model->insert($input_final);
		}*/

		//ambil data result berdasarkan group
		$parameter_extra = 'gender=LAKI-LAKI;status_mhs=MAHASISWA;status_nikah=BELUM;';

		$algo_result_group = $this->algo_result_model->read_group();
		if(!empty($algo_result_group)) foreach($algo_result_group as $result_group) {
			$filter = array('param_group'=> $result_group['param_group']);
			$algo_final = $this->algo_result_model->read($filter);
			
			$result_final_value = 0;
			$result_final_text = $result_group['param_group'].$parameter_extra;
			if(!empty($algo_final)) foreach($algo_final as $index=>$final) {
				$result_final_value = $index == 0 ? $final['result'] : $result_final_value * $final['result'];
				//$result_final_text .= $index == 0 ? $final['result'] : ' * '.$final['result'];
			}

			//insert result final
			$input_final = array(
							'param' => $result_final_text,
							'param_group' => 'final',
							'data_count' => 0,
							'data_total' => 0,
							'result' => $result_final_value,
						);
			$this->algo_result_model->insert($input_final);
		}
		
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		//end proses algo

		//hasil semua algo
		$algo_result_list = $this->algo_result_model->read();

		//hasil final algo tertinggi
		$algo_result_top = $this->algo_result_model->read_final_top();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'algo_dataset_read',
						'judul' => 'Algoritma Naive-bayes',

						'algo_dataset_list' => $algo_dataset_list,
						'algo_result_list' => $algo_result_list,
						'algo_result_top' => $algo_result_top
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}
}
