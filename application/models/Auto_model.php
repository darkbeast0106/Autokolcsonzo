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

    public function list()
    {
        return $this->db->get('autok')->result_array();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('autok')->row_array();
    }

    public function get_auto_kepek($auto_id)
    {   
        $this->db->where('auto_id', $auto_id);
        return $this->db->get('auto_kepek')->result_array();
    }

	public function get_where_hirdeto_not($hirdeto_id)
	{
        $this->db->where('hirdeto_id != ', $hirdeto_id);
        return $this->db->get('autok')->result_array();
	}

	public function get_where_hirdeto($hirdeto_id)
	{
        $this->db->where('hirdeto_id', $hirdeto_id);
        return $this->db->get('autok')->result_array();
	}

	public function update($id, $data)
	{	
        $this->db->where('id', $id);
		return $this->db->update('autok',$data);
	}
}
