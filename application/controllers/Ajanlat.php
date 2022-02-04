<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajanlat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('auto_model');
		$this->load->model('ajanlat_model');
		if ($this->session->userdata('user') === NULL) {
			redirect('');
		}
	}

	public function index()
	{
		
	}

	public function ajanlat_tetel()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('auto_id', 'Autó azonosító', 'trim|required|numeric');
		$this->form_validation->set_rules('ar', 'Ár', 'trim|required|numeric');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auto/autok_bongeszese');
		} 
		
		$user_id = $this->session->userdata('user')['id'];
		$auto_id = $this->input->post('auto_id');
		$ar = $this->input->post('ar');

		$auto = $this->auto_model->get_by_id($auto_id);
		if (empty($auto)) {
			$this->session->set_flashdata('error', "Nem létező autóra próbál ajánlatot tenni");
			redirect('auto/autok_bongeszese');
		}
		if ($auto['hirdeto_id'] == $user_id) {
			$this->session->set_flashdata('error', "Saját autóra nem tud ajánlatot tenni");
			redirect('auto/autok_bongeszese');
		}

		$data = [
			'ajanlat_tevo_id' => $user_id,
			'auto_id' => $auto_id,
			'ar' => $ar
		];
		$id = $this->ajanlat_model->insert($data);
		$this->session->set_flashdata('success', "Sikeres ajánlattétel");
		redirect('ajanlat');
	}
}
