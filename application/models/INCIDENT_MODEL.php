<?php


class INCIDENT_MODEL extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_incidents(){
		$this->db->select("*");
		$this->db->from("incidents");
		$this->db->order_by("incident_no", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_incident($data){
		$this->db->insert('incidents', $data);
		$last_id = $this->db->insert_id();
		$details = array(
			"incident_no"=>	$last_id,
			"status"=>$data['remarks'],
			"datetime_acknwldge"=>$data['incident_date'],

		);

		$this->db->insert('incident_details', $details);

	}

	public function get_current_incident($id){
		$this->db->select("*");
		$this->db->from("incidents");
		$this->db->where("incident_no", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_incident($data, $id){
		$this->db->where("incident_no", $id);
		$this->db->update("incidents", $data);
	}

	public function delete_incident($id){
		$tables = array("incidents", "incident_details");
		$this->db->where("incident_no", $id);
		$this->db->delete($tables);
	}
}
