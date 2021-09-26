<?php

class Prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("prediction_model");
	}

	public function insert_prediction(){
		
		$data = array(
			'barangay_id' => $this->input->post("barangay_id"),
			'month' => $this->input->post("month"),
			'year' => $this->input->post("year"),
			'predicted_number' => $this->input->post("predicted_number")
		);
		$this->prediction_model->Insert_prediction($data);
	}

}

?>
