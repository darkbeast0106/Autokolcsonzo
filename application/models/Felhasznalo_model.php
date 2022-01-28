<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Felhasznalo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert($data)
    {
        $this->db->insert('felhasznalok', $data);
        return $this->db->insert_id();
    }

    public function search_by_username($username)
    {
        $this->db->where('felhasznalonev', $username);
        return $this->db->get('felhasznalok')->row_array();
    }
}
