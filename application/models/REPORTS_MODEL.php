<?php


class REPORTS_MODEL extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_report($data){
		$this->db->insert('reports', $data);
	}

	public function get_barangay_id($canonical){
		$this->db->select("barangay_id");
		$this->db->from("stations_coverage");
		$this->db->where("canonical_name", $canonical);
		$query = $this->db->get();
		return $query->result();
	}

}
