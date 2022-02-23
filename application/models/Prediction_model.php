<?php


class Prediction_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function Insert_prediction($data){
		$this->db->insert("predicted_values", $data);
	}

	public function Is_in_predicted_values($brgy_id, $mnth, $yr){
		$this->db->where(array(
						"barangay_id"=>$brgy_id,
						"month"=>$mnth,
						"year"=>$yr
		));
		$query = $this->db->get('predicted_values');
		return $query->num_rows();
	}

	public function get_cached_prediction($brgy_id, $mnth, $yr){
		$this->db->where(array(
						"barangay_id"=>$brgy_id,
						"month"=>$mnth,
						"year"=>$yr
		));
		return $this->db->get('predicted_values')->result();
	}

	public function getTopReports($month, $year, $limit){
		$this->db->select("canonical_name, predicted_number");
		$this->db->from("predicted_values, stations_coverage");
		// SELECT * FROM predicted_values WHERE month = 'December' AND year = 2021 ORDER BY predicted_number DESC LIMIT 5;

		// SELECT canonical_name, predicted_number FROM predicted_values, stations_coverage WHERE predicted_values.barangay_id = stations_coverage.barangay_id AND month = 'December' AND year = 2021 ORDER BY predicted_number DESC LIMIT 5

		// $this->db->where('');

		$this->db->where("predicted_values.barangay_id = stations_coverage.barangay_id AND " .'month = "'. $month. '" AND year =" '. $year .'"'. " ORDER BY predicted_number DESC LIMIT ". $limit);
		$query = $this->db->get();
		return $query->result();
	}
}
