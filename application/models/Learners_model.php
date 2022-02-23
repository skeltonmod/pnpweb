<?php


class Learners_model extends CI_Model
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
			"username"=>$user,
			"password"=>$password
		);
		$this->db->select("*");
		$this->db->from("learners_login");

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

	public function Get_all_informants(){
		$this->db->select("*");
		$this->db->from("informants");
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

	public function verify_user($id){
		$this->db->where("userid", $id);
		$this->db->update("informants", ['verified'=> 1]);
	}

	public function edit_informant($data, $id){
		$this->db->where("userid", $id);
		$this->db->update("informants", $data);
		return $this->db->affected_rows() > 0;
	}

	public function get_station_data($canonical){
		$this->db->select("station_id, barangay_name, remarks, barangay_id");
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

	public function Countrows_learners_login($email, $password){
		// $this->db->where(array(
		// 				"email_address"=>$email,
		// 				"password"=>$password
		// ));
		// $query = $this->db->get('common_youth_profile');
		// return $query->num_rows();
		$this->db->select("id");
		$this->db->from("common_youth_profile");
		$this->db->where(array(
						"email_address"=>$email,
						"password"=>$password
		));
		$query = $this->db->get();
		return $query->result();
	}

	public function IsEmail_exist($email){
		$this->db->where(array(
						"email_address"=>$email
		));
		$query = $this->db->get('common_youth_profile');
		return $query->num_rows();
	}

	public function Get_youth_id($email)
	{
		$this->db->select("id");
		$this->db->from("common_youth_profile");
		$this->db->where("email_address =", $email);
		$query = $this->db->get();
		return $query->result();
	}

	public function Get_unified_details($id)
	{
		$this->db->select("*");
		$this->db->from("unified_youth_account");
		$this->db->where("youth_id =", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function Insert_osy($data){
		$this->db->insert("common_youth_profile", $data);
	}

	public function Insert_osy_other_details($data){
		$this->db->insert("als_youth_other_details", $data);
	}

	public function Insert_tesda_osy_other_details($data){
		$this->db->insert("tesda_youth_other_details", $data);
	}

	public function Insert_unified_account($data){
		$this->db->insert("unified_youth_account", $data);
	}

	public function Get_cities_municipalities($region)
	{
		$this->db->select("*");
		$this->db->from("city_municipality");
		$this->db->where("region_no", $region);
		$query = $this->db->get();
		return $query->result();
	}
	public function Get_barangays($zip_code)
	{
		$this->db->select("*");
		$this->db->from("barangay");
		$this->db->where("zip_code", $zip_code);
		$this->db->order_by("barangay_name", "asc");
		$query = $this->db->get();
		return $query->result();
	}
}
