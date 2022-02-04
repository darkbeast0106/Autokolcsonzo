<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajanlat_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data)
	{
		$this->db->insert('ajanlatok', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('ajanlatok', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('ajanlatok');
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('ajanlatok')->row_array();
	}

	public function get_auto_ajanlatok($auto_id)
	{
		$this->db->where('auto_id', $auto_id);
		return $this->db->get('ajanlatok')->result_array();
	}
	
	public function get_ajanlat_tevo_ajanlatok($ajanlat_tevo_id)
	{
		$this->db->where('ajanlat_tevo_id', $ajanlat_tevo_id);
		return $this->db->get('ajanlatok')->result_array();
	}
}
