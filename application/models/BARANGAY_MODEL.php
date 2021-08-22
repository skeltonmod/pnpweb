<?php


class BARANGAY_MODEL extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_barangay_current($canonical){
		$this->db->select("*");
		$this->db->from("stations_coverage");

		// if($_SESSION['type'] != "SuperAdmin"){
		// 	$this->db->where("station_id", $_SESSION['station_id']);
		// }

		$this->db->where("canonical_name", $canonical);

		$this->db->order_by("canonical_name", "asc");
		$query = $this->db->get();
		return $query->result();
	}

	public function get_barangay(){
		$this->db->select("*");
		$this->db->from("stations_coverage");

		if($_SESSION['type'] != "SuperAdmin"){
			$this->db->where("station_id", $_SESSION['station_id']);
		}

		$this->db->order_by("canonical_name", "asc");
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_barangay($data, $id){
		$this->db->where("barangay_id", $id);
		$this->db->update("stations_coverage", $data);
	}

		public function get_current_barangay($id){
		$this->db->select("*");
		$this->db->from("stations_coverage");
		$this->db->where("barangay_id", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_barangay($data){
		$this->db->insert('stations_coverage', $data);

	}

	public function delete_barangay($id){
		$tables = array("stations_coverage");
		$this->db->where("barangay_id", $id);
		$this->db->delete($tables);
	}
}
