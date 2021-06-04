<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Auth extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('user_model'));
    }

    function index() {
    }

    function login_post() {
        $username = $this->post('username');
        $password = $this->post('password');
        $password_encrypt = md5($password);

        if(empty($username) || empty($password)) {
            $this->response([
                'status' => FALSE,
                'response' => 'Invalid Login'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        $user = $this->user_model->read_single_login($username, $password_encrypt);

        if(!empty($user)) {
            $this->response([
                'status' => TRUE,
                'response' => $user
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Invalid Login'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }

}
?>