<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . "libraries/REST_controller.php";

class Auto extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auto_model');
        $this->load->model('felhasznalo_model');
        
    }

    public function index_get($id = 0)
    {
        if ($id != 0) {
            $auto = $this->auto_model->get_by_id($id);
            if (empty($auto)) {
                $this->response(null, REST_Controller::HTTP_NOT_FOUND);
            } else {
                $hirdeto = $this->felhasznalo_model->get_by_id($auto['hirdeto_id']);
                $auto['hirdeto'] = ['tel' => $hirdeto['tel'], 'email' => $hirdeto['email']];
                $auto['tovabbi_kepek'] = $this->auto_model->get_auto_kepek($auto['id']);
                $this->response($auto, REST_Controller::HTTP_OK);
            }
        }   
    }

}
