<?php


class INFORMANT_MODEL extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insert_informant($data){
		$this->db->insert('informants', $data);

		return $this->db->affected_rows() > 0;
	}


	public function insert_temp_incident($data){
		$this->db->insert('temp_incidents', $data);
	}

	public function check_existing($email){
		$this->db->select("*");
		$this->db->from("informants");
		$this->db->where("email", $email);
		$query = $this->db->get();
		return $query->result();
	}

	public function check_credentials($user, $password){
		$credentials = array(
			"email"=>$user,
			"password"=>$password
		);
		$this->db->select("*");
		$this->db->from("informants");

		$this->db->where($credentials);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_informant($id){
		$this->db->select("*");
		$this->db->from("informants");
		$this->db->where("userid", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_informant_name($id){
		$this->db->select("firstname, middlename, lastname");
		$this->db->from("informants");
		$this->db->where("userid", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_informant($data, $id){
		$this->db->where("userid", $id);
		$this->db->update("informants", $data);
		return $this->db->affected_rows() > 0;
	}

	public function get_station_data($canonical){
		$this->db->select("station_id, barangay_name, remarks");
		$this->db->from("stations_coverage");
		$this->db->where("canonical_name", $canonical);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_temp_incidents($userid){
		$this->db->select("*");
		$this->db->from("temp_incidents");
		$this->db->where("userid", $userid);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_incident($id){
		$this->db->select("*");
		$this->db->from("temp_incidents");
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_all(){
		$this->db->select("*");
		$this->db->from("temp_incidents");
		$this->db->where("status =", "New");
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_temp_incident($id, $data){
		$this->db->where("id", $id);
		$this->db->update("temp_incidents", $data);
		return $this->db->affected_rows() > 0;
	}

	public function decline_incident($id, $data){
		$this->db->where("id", $id);
		$this->db->update("temp_incidents", $data);
		return $this->db->affected_rows() > 0;
	}
}
