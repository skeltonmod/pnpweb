<?php

class Prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("prediction_model");
	}

	// Manual
	public function insert_prediction(){
		
		$data = array(
			'barangay_id' => $this->input->post("barangay_id"),
			'month' => $this->input->post("month"),
			'year' => $this->input->post("year"),
			'predicted_number' => $this->input->post("predicted_number")
		);
		$this->prediction_model->Insert_prediction($data);
	}

	public function IsPredictedExist(){
		$barangay_id	= $this->input->post("barangay_id");
		$year 			= $this->input->post("year");
		$month			= $this->input->post("month");
		
		$result = $this->prediction_model->Is_in_predicted_values($barangay_id, $month, $year);
		if($result > 0){
			$response = [
				'incident_data'=> $this->prediction_model->get_cached_prediction($barangay_id, $month, $year),
				'exists'=> true
			];
			echo json_encode($response);
		}else{
			$response = [
				'incident_data'=> null,
				'exists'=> false
			];
			echo json_encode($response);
		}
	}

	public function getTopData(){
		$year 		= $this->input->post("year");
		$month		= $this->input->post("month");
		$limit 		= $this->input->post('limit');

		$result = $this->prediction_model->getTopReports($month, $year, $limit);
		echo json_encode($result);
	}

}

?>
