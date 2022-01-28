<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kezdolap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('felhasznalo_model');
        $this->load->model('auto_model');
    }

    public function index()
    {
        $this->load->view('head', ['oldal' => 'kezdolap']);

        $autok = $this->auto_model->list();

        $this->load->view('kezdolap', ['autok' => $autok]);

        $this->load->view('foot');
    }

    public function regisztracio()
    {
        if ($this->session->userdata('user') !== NULL) {
            redirect('');
        }
        $this->load->view('head', ['oldal' => 'regisztracio']);

        $this->load->view('regisztracio');

        $this->load->view('foot');
    }

    public function bejelentkezes()
    {
        if ($this->session->userdata('user') !== NULL) {
            redirect('');
        }
        $this->load->view('head', ['oldal' => 'bejelentkezes']);

        $this->load->view('bejelentkezes');

        $this->load->view('foot');
    }

    public function regisztracio_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[felhasznalok.email]');
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'trim|required|is_unique[felhasznalok.felhasznalonev]');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required');
        $this->form_validation->set_rules('jelszo_confirm', 'Jelszó megerősítése', 'trim|required|matches[jelszo]');
        $this->form_validation->set_rules('tel', 'Telefonszám', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('regisztracio');
        }

        $data = [
            'email' => $this->input->post('email'),
            'felhasznalonev' => $this->input->post('felhasznalonev'),
            'jelszo' => password_hash($this->input->post('jelszo'), PASSWORD_DEFAULT),
            'tel' => $this->input->post('tel')
        ];
        $id = $this->felhasznalo_model->insert($data);
        $this->session->set_flashdata('success', "Sikeres regisztráció");
        redirect('bejelentkezes');
    }

    public function bejelentkezes_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'trim|required');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('bejelentkezes');
        }
        $felhasznalonev = $this->input->post('felhasznalonev');

        $felhasznalo = $this->felhasznalo_model->search_by_username($felhasznalonev);

        if (empty($felhasznalo)) {
            $this->session->set_flashdata('error', "Hibás felhasználónév vagy jelszó!");
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('bejelentkezes');
        }

        $jelszo = $this->input->post('jelszo');

        if (!password_verify($jelszo, $felhasznalo['jelszo'])) {
            $this->session->set_flashdata('error', "Hibás felhasználónév vagy jelszó!");
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('bejelentkezes');
        }

        $array = array(
            'user' => $felhasznalo
        );

        $this->session->set_userdata($array);


        $this->session->set_flashdata('success', "Sikeres bejelentkezés");
        redirect('');
    }
}
