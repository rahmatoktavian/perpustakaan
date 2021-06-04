<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Api_server extends REST_Controller {
    public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model(array('kategori_buku_model'));
    }

    function index_get() {
        $result = $this->kategori_buku_model->read();
        
        if ($result) {
            $this->response([
                'status' => TRUE,
                'response' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Data not found',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
            
    }
    
    function index_post() {
        $nama = $this->post('nama');
        
        //validation
        $validation = true;
        $response = array();
        if(empty($nama)) {
            $validation = false;
            $response[] = 'Isi data nama';
        }
    
        if($validation) {
            $input = array('nama'=>$nama);
            $this->kategori_buku_model->insert($input);

            $this->response([
                'status' => TRUE,
                'response' => 'Data Inserted'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => implode(', ', $response)
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
            
    }
    
    function index_put() {
        $id = $this->put('id');
        $nama = $this->put('nama');
        
        //validation
        $validation = true;
        $response = array();
        if(empty($nama)) {
            $validation = false;
            $response[] = 'Isi data nama';
        }
        
        if($validation) {
            $input = array('nama'=>$nama);
            $this->kategori_buku_model->update($input, $id);

            $this->response([
                'status' => TRUE,
                'response' => 'Data Updated'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => implode(', ', $response)
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
            
    }
    
    function index_delete() {
        $id = $this->delete('id');
        
        if($this->kategori_buku_model->delete($id)) {
            $this->response([
                'status' => TRUE,
                'response' => 'Data Deleted'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => implode(', ', $response)
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
            
    }
}
?>