<?php


class INCIDENT_MODEL extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
	}

	public function get_incidents()
	{
		$this->db->select("*");
		$this->db->from("incidents");
		$this->db->order_by("incident_no", "desc");
		if ($_SESSION['type'] != "SuperAdmin") {
			$this->db->where("police_station_no", $_SESSION['station_id']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_incident($data)
	{
		$this->db->insert('incidents', $data);
		$last_id = $this->db->insert_id();
		$details = array(
			"incident_no" =>	$last_id,
			"status" => (isset($data['temp_id']) ? strtoupper('New') : strtoupper("Acknowledged")),
			"datetime_acknwldge" => $data['incident_date'],

		);
		$this->db->insert('incident_details', $details);
	}

	public function get_current_incident($id)
	{
		$this->db->select("*");
		$limit = 1;
		$this->db->from("incidents, incident_details");
		$this->db->where("incidents.incident_no = incident_details.incident_no");
		$this->db->where("incident_details.incident_no", $id);
		 //AND incident_details.incident_no", $id);
		$this->db->order_by("unique_id desc");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function checkNew($id)
	{
		$this->db->select('*');
		$this->db->from('incidents');
		$this->db->join("incident_details", "incident_details.incident_no = incidents.incident_no", "left");
		$this->db->where("incidents.incident_no", $id);
		$this->db->order_by('unique_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function edit_incident($data, $id)
	{
		$this->db->where("incident_no", $id);
		$this->db->update("incidents", $data);
	}

	public function edit_incident_detail($data)
	{
		$this->db->insert("incident_details", $data);
	}

	public function delete_incident($id)
	{
		$tables = array("incidents", "incident_details");
		$this->db->where("incident_no", $id);
		$this->db->delete($tables);
	}

	public function get_incident_details($id)
	{
		$this->db->select("*");
		$this->db->from("incident_details");
		$this->db->order_by("unique_id", "desc");
		$this->db->where("incident_no", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_incidents(){
		$this->db->select('*');
		$this->db->from('incidents');
		$this->db->join("incident_details", "incident_details.incident_no = incidents.incident_no", "left");
		$this->db->order_by('unique_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function push_nearest_incident($data){
		$this->db->insert('temp_nearest_station', $data);
	}

	public function get_nearest(){
		$this->db->select('*');
		$this->db->from('temp_incidents');
		$this->db->join("temp_nearest_station", "temp_nearest_station.incident_id = temp_incidents.id", "inner");
		$this->db->order_by('temp_nearest_station.id', 'desc');
		$this->db->where('station_id ='. $_SESSION['station_id']. " AND temp_nearest_station.status = 1");
		$query = $this->db->get();
		return $query->result();
	}

	public function delist($id){
		$this->db->where("id", $id);
		$this->db->update("temp_nearest_station", array(
			"status"=>0
		));
	}
}
