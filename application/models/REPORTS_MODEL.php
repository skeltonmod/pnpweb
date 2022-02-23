<?php


class REPORTS_MODEL extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
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

	


	public function search_reports($data){
		$this->db->select("reports.month, reports.year, reports.incidents, reports.id, stations_coverage.barangay_name, stations_coverage.canonical_name");
		$this->db->from("reports");
		$this->db->join('stations_coverage', 'stations_coverage.barangay_id=reports.barangay_id', 'left');
		$this->db->where('dateAt BETWEEN "'. $data['from']. '" and "'. $data['to'].'"');
		$query = $this->db->get();
		return $query->result();
	}

	public function search_reports_date($month, $year, $barangay = null){
		$this->db->select("reports.month, reports.year, reports.incidents, reports.id, stations_coverage.barangay_name, stations_coverage.canonical_name");
		$this->db->from("reports");
		$this->db->join('stations_coverage', 'stations_coverage.barangay_id=reports.barangay_id', 'left');
		$this->db->where('month', $month);
		$this->db->where('year', $year);

		if($barangay != null){
			$this->db->where('reports.barangay_id', $barangay);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function search_reports_length($month, $barangay = null){
		$this->db->select("reports.month, reports.year, reports.incidents, reports.id, stations_coverage.barangay_name, stations_coverage.canonical_name");
		$this->db->from("reports");
		$this->db->join('stations_coverage', 'stations_coverage.barangay_id=reports.barangay_id', 'left');
		$this->db->where('month', $month);

		if($barangay != null){
			$this->db->where('reports.barangay_id', $barangay);
		}

		$query = $this->db->get();
		return $query->result();
	}




	public function check_empty($month, $year, $barangay = null){
		$this->db->select("reports.month, reports.year, reports.incidents, reports.id, stations_coverage.barangay_name, stations_coverage.canonical_name");
		$this->db->from("reports");
		$this->db->join('stations_coverage', 'stations_coverage.barangay_id=reports.barangay_id', 'left');
		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$query = $this->db->get();

		if($barangay != null){
			$this->db->where('reports.barangay_id', $barangay);
		}

		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

}
