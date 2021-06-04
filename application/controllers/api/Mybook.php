<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Mybook extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('peminjaman_model', 'peminjaman_buku_model'));
    }

    function list_get() {
        $petugas_id = '';
        $nim = $this->get('nim');

        $result = $this->peminjaman_model->read($petugas_id, $nim);

        if ($result) {
            $this->response([
                'status' => TRUE,
                'response' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    function detail_get() {
        $peminjaman_id = $this->get('id');

        $result = $this->peminjaman_buku_model->read($peminjaman_id);

        if ($result) {
            $this->response([
                'status' => TRUE,
                'response' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }
}
?>