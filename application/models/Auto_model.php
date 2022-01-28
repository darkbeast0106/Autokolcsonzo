<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert($data)
    {
        $this->db->insert('autok', $data);
        return $this->db->insert_id();
    }

    public function insert_kep($data)
    {   
        $this->db->insert('auto_kepek', $data);
        return $this->db->insert_id();
    }
}
