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

}
