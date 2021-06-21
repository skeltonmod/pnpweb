<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

	public $INCIDENT_MODEL;
	public $PERSONNEL_MODEL;
	public $BARANGAY_MODEL;
	public $STATION_MODEL;

	public function __construct()
	{
		parent::__construct();
		$this->load->model("INCIDENT_MODEL");
		$this->load->model("PERSONNEL_MODEL");
		$this->load->model("BARANGAY_MODEL");
		$this->load->model("STATION_MODEL");
	}

	public function index($page="Home")
	{
		$this->load->view('utils/Navigation');
		$this->load->view($page);
	}
	function getImage($image,$filename){

		$imagefiletype = pathinfo($image,PATHINFO_EXTENSION);
		$basename = $filename.".".$imagefiletype;
		$location = "/home/deyji/www/pnpweb/incident_images/".$basename;

		// sanitize file
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false){
			$uploadable = true;
		}else{
			echo "File is not an Image: ";
			$uploadable = false;
		}

		if($uploadable === true && $filename != ""){
			if(move_uploaded_file($_FILES['image']['tmp_name'],$location)){
				echo "";
			}else{
				echo "OOPS! \n";
			}
		}else{
			echo "OOPS! \n";
		}
		chmod($location, '0777');
		return $basename;
	}

	// INCIDENT
	public function getIncidents(){
		$data = $this->INCIDENT_MODEL->get_incidents();
		$result = null;
		foreach ($data as $row){
			$result[] = array(
				"id"=>$row->incident_no,
				"date"=>$row->incident_date,
				"lat"=>$row->latitude,
				"long"=>$row->longitude,
				"remarks"=>$row->remarks,
				"suspect"=>$row->suspect,
				"victim"=>$row->victim,
				"image"=>$row->picture,

			);
		}
		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}

	public function insertIncident(){
		$image = $_FILES['image']['name'];

		$parse_image = $this->getImage($image, "INCIDENT_".$this->input->post('incident_date')."_".$this->input->post('victim'));

		$data = array(
			"incident_date"=> $this->input->post('incident_date'),
			"incident_time"=> $this->input->post('incident_time'),
			"latitude"=> $this->input->post('latitude'),
			"longitude"=> $this->input->post('longitude'),
			"location"=> $this->input->post('location'),
			"suspect"=> $this->input->post('suspect'),
			"victim"=> $this->input->post('victim'),
			'police_station_no' 		=> 2,
			'personnel_id' 			=> 2000,
			'informant_id' 			=> 1000,
			"picture"=> $parse_image,
			"remarks"=> $this->input->post('remarks'),

		);
		echo $this->INCIDENT_MODEL->insert_incident($data);

	}

	public function manage_incident(){
		switch ($this->input->post("key")){
			case "edit":
				echo json_encode($this->INCIDENT_MODEL->get_current_incident($this->input->post("id")));
				break;

			case "update":
				$data = array(
					"incident_date"=> $this->input->post('incident_date'),
					"incident_time"=> $this->input->post('incident_time'),
					"latitude"=> $this->input->post('latitude'),
					"longitude"=> $this->input->post('longitude'),
					"location"=> $this->input->post('location'),
					"suspect"=> $this->input->post('suspect'),
					"victim"=> $this->input->post('victim'),
					"remarks"=> $this->input->post('remarks'),

				);
				$this->INCIDENT_MODEL->edit_incident($data, $this->input->post("id"));
				break;

			case "delete":
				$this->INCIDENT_MODEL->delete_incident($this->input->post("id"));
				break;
		}
	}


	// PERSONNEL
	public function insertPersonnel(){
		$data = array(
			"fname"=> $this->input->post('fname'),
			"lname"=> $this->input->post('lname'),
			"mname"=> $this->input->post('mname'),
			"address"=> $this->input->post('address'),
			"dob"=> $this->input->post('dob'),
			"password"=> $this->input->post('password'),
		);

		$this->PERSONNEL_MODEL->insert_personnel($data);
	}

	public function getPersonnel(){
		$data = $this->PERSONNEL_MODEL->get_personnel();
		$result = null;
		foreach ($data as $row){
			$result[] = array(
				"id"=>$row->personnel_id,
				"name"=>$row->fname. " ". $row->mname. " ". $row->lname,
				"address"=>$row->address,
				"dob"=>$row->dob,

			);
		}
		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}

	public function manage_personnel(){
		switch ($this->input->post("key")){
			case "edit":
				echo json_encode($this->PERSONNEL_MODEL->get_current_personnel($this->input->post("id")));
				break;
			case "update":
				$data = array(
					"fname"=> $this->input->post('fname'),
					"lname"=> $this->input->post('lname'),
					"mname"=> $this->input->post('mname'),
					"address"=> $this->input->post('address'),
					"dob"=> $this->input->post('dob'),

				);
				$this->PERSONNEL_MODEL->edit_personnel($data, $this->input->post("id"));
				break;
			case "delete":
				$this->PERSONNEL_MODEL->delete_personnel($this->input->post("id"));
				break;
		}
	}

	// BARANGAY
	public function manage_barangay(){
		switch ($this->input->post("key")){
			case "edit":
				echo json_encode($this->BARANGAY_MODEL->get_current_barangay($this->input->post("id")));
				break;
			case "update":
				$data = array(
					"station_id"=> $this->input->post('station_id'),
					"barangay_name"=> $this->input->post('barangay_name'),
					"canonical_name"=> $this->input->post('canonical_name'),
					"lat"=> $this->input->post('lat'),
					"long"=> $this->input->post('long'),
					"remarks"=> $this->input->post('remarks'),

				);
				$this->BARANGAY_MODEL->edit_barangay($data, $this->input->post("id"));
				break;
			case "delete":
				$this->BARANGAY_MODEL->delete_barangay($this->input->post("id"));
				break;
		}
	}

	public function getBarangay(){
		$data = $this->BARANGAY_MODEL->get_barangay();

		$result = null;
		foreach ($data as $row){
			$result[] = array(
				"id"=>$row->barangay_id,
				"barangay_name"=>$row->barangay_name,
				"location"=>$row->lat."/".$row->long,
				"remarks"=>$row->remarks

			);
		}
		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}

	public function insertBarangay(){
		$data = array(
			"station_id"=> $this->input->post('station_id'),
			"barangay_name"=> $this->input->post('barangay_name'),
			"canonical_name"=> $this->input->post('canonical_name'),
			"lat"=> $this->input->post('lat'),
			"long"=> $this->input->post('long'),
			"remarks"=> $this->input->post('remarks'),
		);
		$this->BARANGAY_MODEL->insert_barangay($data);
	}

	// STATION
	public function insertStation(){
		$data = array(
			"station_name"=> $this->input->post('station_name'),
			"latitude"=> $this->input->post('lat'),
			"longitude"=> $this->input->post('long'),
			"remarks"=> $this->input->post('remarks'),
		);

		$this->STATION_MODEL->insertStation($data);
	}

	public function getStation(){
		$data = $this->STATION_MODEL->get_station();

		$result = null;
		foreach ($data as $row){
			$result[] = array(
				"id"=>$row->station_id,
				"station_name"=>$row->station_name,
				"location"=>$row->latitude."/".$row->longitude,
				"remarks"=>$row->remarks

			);
		}
		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}

	public function manage_station(){
		switch ($this->input->post("key")){
			case "edit":
				echo json_encode($this->STATION_MODEL->get_current_station($this->input->post("id")));
				break;
			case "update":
				$data = array(
					"station_name"=> $this->input->post('station_name'),
					"latitude"=> $this->input->post('lat'),
					"longitude"=> $this->input->post('long'),
					"remarks"=> $this->input->post('remarks'),

				);
				$this->STATION_MODEL->edit_station($data, $this->input->post("id"));
				break;
			case "delete":
				$this->STATION_MODEL->delete_station($this->input->post("id"));
				break;
		}
	}

}
