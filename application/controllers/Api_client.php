<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_client extends CI_Controller {
	public function __construct() {
        parent::__construct();

        //check user already login & authorized user type
		/*
		if(!$this->session->userdata('id') || $this->session->userdata('type') != 'admin') {
        	redirect('auth/login');
        }
        */
    }

	public function woowa() {
		//config
		$key_demo='db63f52c1a00d33cf143524083dd3ffd025d672e255cc688';
		$url='http://45.77.34.32:8000/demo/send_message';
		$data = array(
		  "no_wa"=> '+6285691357671',
		  "key"   =>$key_demo,
		  "message" =>'Message from codeigniter + woowa (plain)'
		);

		$header = array(
		  'Authorization: Basic dXNtYW5ydWJpYW50b3JvcW9kcnFvZHJiZWV3b293YToyNjM3NmVkeXV3OWUwcmkzNDl1ZA=='
		);

		//proses curl
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		//display response
		$response = curl_exec($curl);
		echo $response;

		//display error (jika ada)
		$error = curl_error($curl);
		echo $error;

		//hentikan proses
		curl_close($curl);
	}

	public function woowa_lib() {
		//config
		$key_demo='db63f52c1a00d33cf143524083dd3ffd025d672e255cc688';
		$url='http://45.77.34.32:8000/demo/send_message';
		$data = array(
		  "no_wa"=> '+628xxxxxx',
		  "key"   =>$key_demo,
		  "message" =>'Message from codeigniter + woowa (using library)'
		);
		$header = array(
		  'Authorization: Basic dXNtYW5ydWJpYW50b3JvcW9kcnFvZHJiZWV3b293YToyNjM3NmVkeXV3OWUwcmkzNDl1ZA=='
		);

		//proses curl
		$this->load->library('curl');
		$this->curl->create($url);
		$this->curl->option(CURLOPT_HTTPHEADER, $header);
		$this->curl->post($data);

		//display response
		echo $this->curl->execute();
		echo $this->curl->error_string;
	}

	public function rajaongkir_provinsi() {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 8d923ad9ac9eb0ff0349a6885122d1f3"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $array = json_decode($response, true);
		}
	}

	public function rajaongkir() {
		$data_kota_asal = $this->rajaongkir_api_kota(6);
		$data_kota_tujuan = $this->rajaongkir_api_kota(11);

		//mengirim data ke view
		$output = array(
						'theme_page' => 'api_rajaongkir',
						'judul' => 'API Raja Ongkir',

						//data buku dikirim ke view
						'data_kota_asal' => $data_kota_asal,
						'data_kota_tujuan' => $data_kota_tujuan,
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function rajaongkir_api_kota($provinsi_id) {
		//config
		$url = "https://api.rajaongkir.com/starter/city?province=".$provinsi_id;
		$header = array(
		    "key: 8d923ad9ac9eb0ff0349a6885122d1f3"
		  );

		//proses curl
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		//response sukses (string)
		$response = curl_exec($curl);
		
		//response error (jika ada)
		$error = curl_error($curl);

		//hentikan proses
		curl_close($curl);

		//display response
		if ($error) {
			echo $error;
			die;
		} else {
			//echo $response;

			//display response (array)
			$response_array = json_decode($response, true);
			//print_r($response_array);

			$result = $response_array['rajaongkir']['results'];
			return $result;
		}
	}

	public function rajaongkir_search() {
		$kota_asal_id = $this->input->post('kota_asal_id');
		$kota_tujuan_id = $this->input->post('kota_tujuan_id');
	
		$data_ongkir_jne = $this->rajaongkir_api_ongkir($kota_asal_id, $kota_tujuan_id, 'jne');
		$data_ongkir_pos = $this->rajaongkir_api_ongkir($kota_asal_id, $kota_tujuan_id, 'pos');

		//mengirim data ke view
		$output = array(
						'theme_page' => 'api_rajaongkir_search',
						'judul' => 'API Raja Ongkir',

						//data buku dikirim ke view
						'data_ongkir_jne' => $data_ongkir_jne,
						'data_ongkir_pos' => $data_ongkir_pos,
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function rajaongkir_api_ongkir($kota_asal_id, $kota_tujuan_id, $courier) {
		//config
		$url = "https://api.rajaongkir.com/starter/cost";
		$header = array(
			"content-type: application/x-www-form-urlencoded",
		    "key: 8d923ad9ac9eb0ff0349a6885122d1f3"
		  );
		$post = "origin=".$kota_asal_id."&destination=".$kota_tujuan_id."&weight=1000&courier=".$courier;
		
		//proses curl
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		//response sukses (string)
		$response = curl_exec($curl);
		
		//response error (jika ada)
		$error = curl_error($curl);

		//hentikan proses
		curl_close($curl);

		//display response
		if ($error) {
			echo $error;
			die;
		} else {
			//echo $response;

			//display response (array)
			$response_array = json_decode($response, true);

			$result = $response_array['rajaongkir']['results'][0]['costs'];
			return $result;
		}
	}
}	
