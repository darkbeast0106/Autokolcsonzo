<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auto extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('auto_model');
		if ($this->session->userdata('user') === NULL) {
			redirect('');
		}
	}

	public function index()
	{
	}

	public function auto_felvetele()
	{
		$this->load->view('head', ['oldal' => 'auto_felvetele']);

		$this->load->view('auto_felvetele');

		$this->load->view('foot');
	}

	public function auto_felvetele_post()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('marka', 'Márka', 'trim|required');
		$this->form_validation->set_rules('modell', 'Modell', 'trim|required');
		$this->form_validation->set_rules('uzemanyag', 'Üzemanyag típusa', 'trim|required');
		$this->form_validation->set_rules('gyartasi_ev', 'Gyártási év', 'trim|required|numeric|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('eladasi_ar', 'Eladási ár', 'trim|required|numeric');
		$this->form_validation->set_rules('leiras', 'Leiras', 'trim');
		if (empty($_FILES['kep']['name'])) {
			$this->form_validation->set_rules('kep', 'Kép', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			$this->session->set_flashdata('last_request', $this->input->post());
			redirect('auto_felvetele');
		}

		$kep_nev = $_FILES['kep']['name'];
		$kiterjesztes = pathinfo($kep_nev, PATHINFO_EXTENSION);
		$idopont = date("Y_m_d_H_i_s");
		$marka = $this->input->post('marka');
		$modell = $this->input->post('modell');
		$fajlnev = $marka . '_' . $modell;
		$fajlnev = preg_replace('/[áàãâä]/ui', 'a', $fajlnev);
		$fajlnev = preg_replace('/[éèêë]/ui', 'e', $fajlnev);
		$fajlnev = preg_replace('/[íìîï]/ui', 'i', $fajlnev);
		$fajlnev = preg_replace('/[óòõôöő]/ui', 'o', $fajlnev);
		$fajlnev = preg_replace('/[úùûüű]/ui', 'u', $fajlnev);
		$fajlnev = preg_replace('/[ç]/ui', 'c', $fajlnev);
		$fajlnev = preg_replace('/[^a-z0-9]/i', '_', $fajlnev);
		$fajlnev = preg_replace('/_+/', '_', $fajlnev);
		$fajlnev = strtolower($fajlnev);
		$fajlnev = $fajlnev . '_' . $idopont . '.' . $kiterjesztes;

		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
		$config['max_size']             = 10240;
		$config['file_name']            = $fajlnev;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('kep')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			$this->session->set_flashdata('last_request', $this->input->post());
			redirect('auto_felvetele');
		}
		$data = [
			'marka' => $this->input->post('marka'),
			'modell' => $this->input->post('modell'),
			'uzemanyag' => $this->input->post('uzemanyag'),
			'gyartasi_ev' => $this->input->post('gyartasi_ev'),
			'eladasi_ar' => $this->input->post('eladasi_ar'),
			'leiras' => $this->input->post('leiras'),
			'kep' => $fajlnev,
			'hirdeto_id' => $this->session->userdata('user')['id']
		];
		$id = $this->auto_model->insert($data);

		if (!empty($_FILES['tovabbi_kepek']['name'][0])) {
			$kepszam = 0;
			foreach ($_FILES['tovabbi_kepek']['name'] as $i => $kep_nev) {
				$kepszam++;
				$kiterjesztes = pathinfo($kep_nev, PATHINFO_EXTENSION);
				$idopont = date("Y_m_d_H_i_s");
				$marka = $this->input->post('marka');
				$modell = $this->input->post('modell');
				$fajlnev = $marka . '_' . $modell;
				$fajlnev = preg_replace('/[áàãâä]/ui', 'a', $fajlnev);
				$fajlnev = preg_replace('/[éèêë]/ui', 'e', $fajlnev);
				$fajlnev = preg_replace('/[íìîï]/ui', 'i', $fajlnev);
				$fajlnev = preg_replace('/[óòõôöő]/ui', 'o', $fajlnev);
				$fajlnev = preg_replace('/[úùûüű]/ui', 'u', $fajlnev);
				$fajlnev = preg_replace('/[ç]/ui', 'c', $fajlnev);
				$fajlnev = preg_replace('/[^a-z0-9]/i', '_', $fajlnev);
				$fajlnev = preg_replace('/_+/', '_', $fajlnev);
				$fajlnev = strtolower($fajlnev);
				$fajlnev = $fajlnev . '_' . $idopont . '_' . $kepszam . '.' . $kiterjesztes;

				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
				$config['max_size']             = 10240;
				$config['file_name']            = $fajlnev;

				$_FILES['ideiglenes']['name'] = $_FILES['tovabbi_kepek']['name'][$i];
				$_FILES['ideiglenes']['type'] = $_FILES['tovabbi_kepek']['type'][$i];
				$_FILES['ideiglenes']['tmp_name'] = $_FILES['tovabbi_kepek']['tmp_name'][$i];
				$_FILES['ideiglenes']['error'] = $_FILES['tovabbi_kepek']['error'][$i];
				$_FILES['ideiglenes']['size'] = $_FILES['tovabbi_kepek']['size'][$i];

				$this->upload->initialize($config);
				if (!$this->upload->do_upload('ideiglenes')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					$this->session->set_flashdata('last_request', $this->input->post());
					redirect('auto_felvetele');
				}

				$kepdata = [
					'auto_id' => $id,
					'kep' => $fajlnev,
				];

				$this->auto_model->insert_kep($kepdata);
			}
		}

		$this->session->set_flashdata('success', "Sikeres felvétel");
		redirect('');
	}

	public function autok_bongeszese()
	{
		$this->load->view('head', ['oldal' => 'autok_bongeszese']);

		$user_id = $this->session->userdata('user')['id'];

		$autok = $this->auto_model->get_where_hirdeto_not($user_id);

		$this->load->view('autok_bongeszese', ['autok' => $autok]);

		$this->load->view('auto_reszletek');

		$this->load->view('foot');
	}

	public function sajat_autoim()
	{
		$this->load->view('head', ['oldal' => 'sajat_autoim']);

		$user_id = $this->session->userdata('user')['id'];

		$autok = $this->auto_model->get_where_hirdeto($user_id);

		$this->load->view('sajat_autoim', ['autok' => $autok]);

		$this->load->view('foot');
	}

	public function auto_modositasa($id)
	{
		$user_id = $this->session->userdata('user')['id'];
		$auto = $this->auto_model->get_by_id($id);
		if (empty($auto)) {
			$this->session->set_flashdata('error', "Nem létező autót próbált módosítani");
			redirect('auto/sajat_autoim');
		}
		if ($auto['hirdeto_id'] != $user_id) {
			$this->session->set_flashdata('error', "Csak saját autót tud módosítani");
			redirect('auto/sajat_autoim');
		}

		$this->load->view('head', ['oldal' => 'auto_modositasa']);

		$this->load->view('auto_modositasa', ['auto' => $auto]);

		$this->load->view('foot');
	}

	public function auto_modositasa_post($id)
	{
		$user_id = $this->session->userdata('user')['id'];
		$auto = $this->auto_model->get_by_id($id);
		if (empty($auto)) {
			$this->session->set_flashdata('error', "Nem létező autót próbált módosítani");
			redirect('auto/sajat_autoim');
		}
		if ($auto['hirdeto_id'] != $user_id) {
			$this->session->set_flashdata('error', "Csak saját autót tud módosítani");
			redirect('auto/sajat_autoim');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('marka', 'Márka', 'trim|required');
		$this->form_validation->set_rules('modell', 'Modell', 'trim|required');
		$this->form_validation->set_rules('uzemanyag', 'Üzemanyag típusa', 'trim|required');
		$this->form_validation->set_rules('gyartasi_ev', 'Gyártási év', 'trim|required|numeric|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('eladasi_ar', 'Eladási ár', 'trim|required|numeric');
		$this->form_validation->set_rules('leiras', 'Leiras', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			$this->session->set_flashdata('last_request', $this->input->post());
			redirect('auto_modositasa');
		}
		$data = [
			'marka' => $this->input->post('marka'),
			'modell' => $this->input->post('modell'),
			'uzemanyag' => $this->input->post('uzemanyag'),
			'gyartasi_ev' => $this->input->post('gyartasi_ev'),
			'eladasi_ar' => $this->input->post('eladasi_ar'),
			'leiras' => $this->input->post('leiras')
		];
		
		$this->load->library('upload');

		if (!empty($_FILES['kep']['name'])) {
			$kep_nev = $_FILES['kep']['name'];
			$kiterjesztes = pathinfo($kep_nev, PATHINFO_EXTENSION);
			$idopont = date("Y_m_d_H_i_s");
			$marka = $this->input->post('marka');
			$modell = $this->input->post('modell');
			$fajlnev = $marka . '_' . $modell;
			$fajlnev = preg_replace('/[áàãâä]/ui', 'a', $fajlnev);
			$fajlnev = preg_replace('/[éèêë]/ui', 'e', $fajlnev);
			$fajlnev = preg_replace('/[íìîï]/ui', 'i', $fajlnev);
			$fajlnev = preg_replace('/[óòõôöő]/ui', 'o', $fajlnev);
			$fajlnev = preg_replace('/[úùûüű]/ui', 'u', $fajlnev);
			$fajlnev = preg_replace('/[ç]/ui', 'c', $fajlnev);
			$fajlnev = preg_replace('/[^a-z0-9]/i', '_', $fajlnev);
			$fajlnev = preg_replace('/_+/', '_', $fajlnev);
			$fajlnev = strtolower($fajlnev);
			$fajlnev = $fajlnev . '_' . $idopont . '.' . $kiterjesztes;

			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
			$config['max_size']             = 10240;
			$config['file_name']            = $fajlnev;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('kep')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				$this->session->set_flashdata('last_request', $this->input->post());
				redirect('auto_modositasa');
			}
			$data['kep'] = $fajlnev;
		}
		
		$this->auto_model->update($id, $data);

		if (!empty($_FILES['tovabbi_kepek']['name'][0])) {
			$kepszam = 0;
			foreach ($_FILES['tovabbi_kepek']['name'] as $i => $kep_nev) {
				$kepszam++;
				$kiterjesztes = pathinfo($kep_nev, PATHINFO_EXTENSION);
				$idopont = date("Y_m_d_H_i_s");
				$marka = $this->input->post('marka');
				$modell = $this->input->post('modell');
				$fajlnev = $marka . '_' . $modell;
				$fajlnev = preg_replace('/[áàãâä]/ui', 'a', $fajlnev);
				$fajlnev = preg_replace('/[éèêë]/ui', 'e', $fajlnev);
				$fajlnev = preg_replace('/[íìîï]/ui', 'i', $fajlnev);
				$fajlnev = preg_replace('/[óòõôöő]/ui', 'o', $fajlnev);
				$fajlnev = preg_replace('/[úùûüű]/ui', 'u', $fajlnev);
				$fajlnev = preg_replace('/[ç]/ui', 'c', $fajlnev);
				$fajlnev = preg_replace('/[^a-z0-9]/i', '_', $fajlnev);
				$fajlnev = preg_replace('/_+/', '_', $fajlnev);
				$fajlnev = strtolower($fajlnev);
				$fajlnev = $fajlnev . '_' . $idopont . '_' . $kepszam . '.' . $kiterjesztes;

				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
				$config['max_size']             = 10240;
				$config['file_name']            = $fajlnev;

				$_FILES['ideiglenes']['name'] = $_FILES['tovabbi_kepek']['name'][$i];
				$_FILES['ideiglenes']['type'] = $_FILES['tovabbi_kepek']['type'][$i];
				$_FILES['ideiglenes']['tmp_name'] = $_FILES['tovabbi_kepek']['tmp_name'][$i];
				$_FILES['ideiglenes']['error'] = $_FILES['tovabbi_kepek']['error'][$i];
				$_FILES['ideiglenes']['size'] = $_FILES['tovabbi_kepek']['size'][$i];

				$this->upload->initialize($config);
				if (!$this->upload->do_upload('ideiglenes')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					$this->session->set_flashdata('last_request', $this->input->post());
					redirect('auto_modositasa');
				}

				$kepdata = [
					'auto_id' => $id,
					'kep' => $fajlnev,
				];

				$this->auto_model->insert_kep($kepdata);
			}
		}

		$this->session->set_flashdata('success', "Sikeres módosítás");
		redirect('auto/sajat_autoim');
	}

	public function auto_torlese($id)
	{
		$user_id = $this->session->userdata('user')['id'];
		$auto = $this->auto_model->get_by_id($id);
		if (empty($auto)) {
			$this->session->set_flashdata('error', "Nem létező autót próbált törölni");
			redirect('auto/sajat_autoim');
		}
		if ($auto['hirdeto_id'] != $user_id) {
			$this->session->set_flashdata('error', "Csak saját autót tud törölni");
			redirect('auto/sajat_autoim');
		}
		$this->auto_model->delete_kepek_by_auto_id($id);
		$this->auto_model->delete($id);

		$this->session->set_flashdata('success', "Sikeres törlés");
		redirect('auto/sajat_autoim');
	}
}
