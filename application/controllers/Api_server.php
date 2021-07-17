<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Api_server extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('anggota_model'));
    }

    function index_get() {
        //memanggil model
        $response = $this->anggota_model->read();
       
        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'data' => $response,
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    function detail_get() {
        //menangkap nim dari url
        $nim = $this->get('nim');
        
        //memanggil model + nim yang dikirim dari url
        $response = $this->anggota_model->read_single($nim);

        if ($response) {
            $this->response([
                'status' => TRUE,
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    function index_post() {

        //aturan validasi
        $data = $this->post();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|min_length[3]|is_unique[anggota.nim]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //menangkap data input dari app
            $nim = $this->post('nim');
            $nama = $this->post('nama');
            $jurusan = $this->post('jurusan');

            //mengirim data ke model
            $input = array(
                            //format : nim field/kolom table => data input dari view
                            'nim' => $nim,
                            'nama' => $nama,
                            'jurusan' => $jurusan,
                        );

            //memanggil model untuk insert
            $response = $this->anggota_model->insert($input);

            //jika data ditemukan
            if ($response) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Data berhasil dimasukan'
                ], REST_Controller::HTTP_OK);

            //jika data tidak ditemukan
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal dimasukan'
                ], REST_Controller::HTTP_OK);
            }

        //jika validasi gagal
        } else {
            $this->response([
                'status' => FALSE,
                'message' => validation_errors(' ',','),
            ], REST_Controller::HTTP_OK);
        }
    }

    function index_put() {
        //aturan validasi
        $data = $this->put();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('nim', 'nim', 'required|numeric');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('jurusan', 'jurusan', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //check nim terdaftar di database
            $nim = $this->put('nim');
            $check_nim = $this->anggota_model->read_single($nim);

            //if nim tidak terdaftar
            if(empty($check_nim)) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'NIM tidak terdaftar'
                ], REST_Controller::HTTP_OK);

            //nim terdaftar
            } else {

                //menangkap data input dari api
                $nim = $this->put('nim');
                $nama = $this->put('nama');
                $jurusan = $this->put('jurusan');

                //mengirim data ke model
                $input = array(
                                //format : nim field/kolom table => data input dari view
                                'nama' => $nama,
                                'jurusan' => $jurusan,
                            );

                //memanggil model untuk update
                $response = $this->anggota_model->update($input, $nim);
                
                //jika data ditemukan
                if ($response) {
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Data berhasil diubah'
                    ], REST_Controller::HTTP_OK);

                //jika data tidak ditemukan
                } else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Gagal diubah'
                    ], REST_Controller::HTTP_OK);
                }
            }

        //jika validasi gagal
        } else {
            $this->response([
                'status' => FALSE,
                'message' => validation_errors(' ',' '),
            ], REST_Controller::HTTP_OK);
        }
    }

    function index_delete() {
        //menangkap nim dari url
        $nim = $this->delete('nim');

        //memanggil model + nim yang dikirim dari url
        $response = $this->anggota_model->delete($nim);

        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'message' => 'Data berhasil dihapus'
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal dihapus'
            ], REST_Controller::HTTP_OK);
        }
    }
}
?>