<?php

class STATION_MODEL extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_station(){
		$this->db->select("*");
		$this->db->from("stations");
		$this->db->order_by("station_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function insertStation($data){
		$this->db->insert('stations', $data);

	}

	public function edit_station($data, $id){
		$this->db->where("station_id", $id);
		$this->db->update("stations", $data);
	}

	public function get_current_station($id){
		$this->db->select("*");
		$this->db->from("stations");
		$this->db->where("station_id", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function delete_station($id){
		$tables = array("stations");
		$this->db->where("station_id", $id);
		$this->db->delete($tables);
	}

}
