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
		$this->load->view('head', ['oldal' => 'sajat_ajanlataim']);

		$user_id = $this->session->userdata('user')['id'];

		$ajanlatok = $this->ajanlat_model->get_ajanlat_tevo_ajanlatok($user_id);

		foreach ($ajanlatok as $key => $ajanlat) {
			$auto = $this->auto_model->get_by_id($ajanlat['auto_id']);
			$ajanlatok[$key]['auto_nev'] = $auto['marka'] . ' - ' . $auto['modell'];
		}

		$this->load->view('sajat_ajanlataim', ['ajanlatok' => $ajanlatok]);

		$this->load->view('auto_reszletek');

		$this->load->view('foot');
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

	public function ajanlat_torlese($id)
	{
		$user_id = $this->session->userdata('user')['id'];
		$ajanlat = $this->ajanlat_model->get_by_id($id);
		if (empty($ajanlat)) {
			$this->session->set_flashdata('error', "Nem létező ajánlatot próbált törölni");
			redirect('ajanlat');
		}
		if ($ajanlat['ajanlat_tevo_id'] != $user_id) {
			$this->session->set_flashdata('error', "Csak saját ajánlatot tud törölni");
			redirect('ajanlat');
		}
		$this->ajanlat_model->delete($id);

		$this->session->set_flashdata('success', "Sikeres törlés");
		redirect('ajanlat');
	}

	public function ajanlat_elfogadasa($id)
	{
		$user_id = $this->session->userdata('user')['id'];
		$ajanlat = $this->ajanlat_model->get_by_id($id);
		if (empty($ajanlat)) {
			$this->session->set_flashdata('error', "Nem létező ajánlatot próbált elfogadni");
			redirect('ajanlat');
		}
		$auto = $this->auto_model->get_by_id($ajanlat['auto_id']);
		if ($auto['hirdeto_id'] != $user_id) {
			$this->session->set_flashdata('error', "Csak saját autó ajánlatát tudja elutasitani");
			redirect('auto/sajat_autoim');
		}
		$ajanlatok = $this->ajanlat_model->get_auto_ajanlatok($auto['id']);
		foreach ($ajanlatok as $ajanlat_elutasitashoz) {
			if ($ajanlat_elutasitashoz['id'] != $id) {
				$this->ajanlat_model->update($ajanlat_elutasitashoz['id'], ['elutasitva' => 1]);
			}
		}
		$this->ajanlat_model->update($id, ['elfogadva' => 1]);
		$this->auto_model->update($auto['id'], ['elkelt' => 1]);
		$this->session->set_flashdata('success', "Ajánlat sikeresen elfogadva");
		redirect('auto/auto_ajanlatai/'.$auto['id']);
	}

	public function ajanlat_elutasitasa($id)
	{
		$user_id = $this->session->userdata('user')['id'];
		$ajanlat = $this->ajanlat_model->get_by_id($id);
		if (empty($ajanlat)) {
			$this->session->set_flashdata('error', "Nem létező ajánlatot próbált elutasitani");
			redirect('auto/sajat_autoim');
		}
		$auto = $this->auto_model->get_by_id($ajanlat['auto_id']);
		if ($auto['hirdeto_id'] != $user_id) {
			$this->session->set_flashdata('error', "Csak saját autó ajánlatát tudja elutasitani");
			redirect('auto/sajat_autoim');
		}
		$this->ajanlat_model->update($id, ['elutasitva' => 1]);
		$this->session->set_flashdata('success', "Ajánlat sikeresen elutasítva");
		redirect('auto/auto_ajanlatai/'.$auto['id']);
	}
}
