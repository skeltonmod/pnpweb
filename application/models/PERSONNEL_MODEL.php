<?php


class PERSONNEL_MODEL extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}



	public function insert_personnel($data){
		$this->db->insert('personnel', $data);

	}

	public function get_current_personnel($id){
		$this->db->select("*");
		$this->db->from("personnel");
		$this->db->where("personnel_id", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_personnel(){
		$this->db->select("*");
		$this->db->from("personnel");
		if($_SESSION['type'] != "SuperAdmin"){
			$this->db->where("station_id", $_SESSION['station_id']);
		}
		$this->db->order_by("personnel_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_personnel($data, $id){
		$this->db->where("personnel_id", $id);
		$this->db->update("personnel", $data);
	}


	public function delete_personnel($id){
		$tables = array("personnel");
		$this->db->where("personnel_id", $id);
		$this->db->delete($tables);
	}

	public function get_credentials($data){
		$this->db->select("*");
		$this->db->from("personnel");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();

	}
}
