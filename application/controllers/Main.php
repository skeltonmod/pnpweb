<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Main extends CI_Controller
{

	public $INCIDENT_MODEL;
	public $PERSONNEL_MODEL;
	public $BARANGAY_MODEL;
	public $STATION_MODEL;
	public $INFORMANT_MODEL;
	public $REPORTS_MODEL;


	public function __construct()
	{
		parent::__construct();
		$this->load->model("INCIDENT_MODEL");
		$this->load->model("PERSONNEL_MODEL");
		$this->load->model("BARANGAY_MODEL");
		$this->load->model("STATION_MODEL");
		$this->load->model("INFORMANT_MODEL");
		$this->load->model("REPORTS_MODEL");
	}


	public function index($page="Home"){
		$this->load->view('utils/Navigation');
		if(count($_SESSION) > 0){
			$this->load->view($page);
		}else{
			$this->load->view('Login');
		}
	}


	public function getImage($image,$filename){

		$imagefiletype = pathinfo($image,PATHINFO_EXTENSION);
		$basename = $filename.".".$imagefiletype;
		$location = FCPATH.'incident_images/'.$basename;

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
		chmod($location, 0777);
		return $basename;
	}



	// INCIDENT
	public function getIncidents(){
		$result = null;
		$data = $this->INCIDENT_MODEL->get_incidents();
		if($data != null){
			foreach ($data as $row){
				$details = $this->INCIDENT_MODEL->get_incident_details($row->incident_no)[0];

				$result[] = array(
					"id"=>$row->incident_no,
					"date"=>$row->incident_date,
					"location"=>$row->location,
					"status"=>$details->status,
					"remarks"=>$row->remarks,
					"suspect"=>$row->suspect,
					"victim"=>$row->victim,
					"image"=>$row->picture,
				);
			}
		}else{
			$result[] = array(
				"id"=> "Empty Data!",
				"date"=>"Empty Data!",
				"location"=>"Empty Data!",
				"status"=>"Empty Data!",
				"remarks"=>"Empty Data!",
				"suspect"=>"Empty Data!",
				"victim"=>"Empty Data!",
				"image"=>"Empty Data!",
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
			"remarks"=> "",

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
				$temp_data_details = array(
					"status"=>$this->input->post('status'),
				);

				$data_details = array(
					"incident_no"=>$this->input->post("id"),
					"status"=>$this->input->post('status'),
					"datetime_acknwldge"=>$this->input->post('incident_date')
				);

				$this->INCIDENT_MODEL->edit_incident($data, $this->input->post("id"));
				$this->INCIDENT_MODEL->edit_incident_detail($data_details);
				// Edit the temp_incident for mobile users

				if($this->input->post('temp_id') != null){
					$this->INFORMANT_MODEL->edit_temp_incident($this->input->post('temp_id'), $temp_data_details);
				}
				break;

			case "delete":
				$this->INCIDENT_MODEL->delete_incident($this->input->post("id"));
				break;

			case "acknowledge":

				// sanity check
				$temp_id = $this->INCIDENT_MODEL->get_current_incident($this->input->post('id'))[0]->temp_id;
				$temp_data_details = array(
					"incident_no"=> $this->input->post('id'),
					"status"=>"ON-GOING"
				);
				$data_details = array(
					"status"=>"ON-GOING"
				);

				$this->INCIDENT_MODEL->edit_incident_detail($temp_data_details);

				if($temp_id != null){
					$this->INFORMANT_MODEL->edit_temp_incident($temp_id, $data_details);
				}

				break;
		}
	}


	// PERSONNEL

	public function insertPersonnel(){

		$data = array(
			"fname"=> $this->input->post('fname'),
			"lname"=> $this->input->post('lname'),
			"mname"=> $this->input->post('mname'),
			"email"=> $this->input->post('email'),
			"address"=> $this->input->post('address'),
			"dob"=> $this->input->post('dob'),
			"password"=> $this->input->post('password'),
			"station_id"=> $this->input->post('station_id'),
			"type"=> $this->input->post('type'),
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
					"email"=> $this->input->post('email'),
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

	public function login_personnel(){
		$data = array(
			"password"=>$this->input->post("password"),
			"email"=>$this->input->post("email")
		);
		$result = $this->PERSONNEL_MODEL->get_credentials($data);
		if(count($result) > 0){
			$_SESSION['email'] = $result[0]->email;
			$_SESSION['personnel_id'] = $result[0]->personnel_id;
			$_SESSION['station_id'] = $result[0]->station_id;
			$_SESSION['type'] = $result[0]->type;
		}

		echo json_encode(array("data"=>$_SESSION));

	}

	public function logout_personnel(){
		session_destroy();
		echo "Logout success!";
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
				"canonical_name"=>$row->canonical_name,
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

	// Head office incident

	public function get_temp_incident(){
		$data = $this->INFORMANT_MODEL->get_all();

		$result = null;

		foreach ($data as $row){
			$location_name = $this->INFORMANT_MODEL->get_station_data($row->barangay)[0]->barangay_name;
			$contact = $this->INFORMANT_MODEL->get_informant($row->userid)[0]->mobilenumber;
			$result[] = array(
				"id"=>$row->id,
				"name"=>$row->informant_name,
				"type"=>$row->type,
				"location"=>$row->latitude."/".$row->longitude,
				"date"=>$row->date,
				"time"=>$row->time,
				"barangay"=>$location_name,
				"station"=>$row->station,
				"contact"=>$contact,
				"image"=>$row->image,

			);
		}
		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}

	public function move_incident(){
		if($this->input->post('mode') == "accept"){

			// Do the Transfer
			for($i=0; $i < count($this->input->post('items')); ++$i){
				echo $i;
				$result = $this->INFORMANT_MODEL->get_incident($this->input->post('items')[$i])[0];
				$informant = $this->INFORMANT_MODEL->get_informant_name($result->userid)[0];
				$data = array(
					"incident_date"=>$result->date,
					"incident_time"=>$result->time,
					"latitude"=>$result->latitude,
					"longitude"=>$result->longitude,
					"location"=>$result->barangay,
					"suspect"=>"",
					"victim"=>$informant->firstname." ".$informant->lastname,
					"police_station_no"=>$result->station,
					"personnel_id"=>$_SESSION['personnel_id'],
					"informant_id"=>$result->userid,
					"picture"=>$result->image,
					"temp_id"=>$this->input->post('items')[$i],
				);

//				Insert to other table
				$this->INCIDENT_MODEL->insert_incident($data);
				// Change temp incident status
				$data = array(
					"status"=>strtoupper("Acknowledged")
				);

				$this->INFORMANT_MODEL->edit_temp_incident($result->id, $data);

			}

		}else{
			for($i=0; $i < count($this->input->post('items')); ++$i){
				$data = array(
					"status"=> "Reject",
				);

				$this->INFORMANT_MODEL->decline_incident($this->input->post('items')[$i], $data);
			}
		}

	}

	// Insert Report
	public function insert_report(){
		$barangay_id = $this->REPORTS_MODEL->get_barangay_id(explode('_', $this->input->post('barangay'))[1])[0]->barangay_id;
		$date = $this->input->post('month').' 01 '. $this->input->post('year');
		$data = array(
			"barangay_id" => $barangay_id,
			"month"=> $this->input->post('month'),
			"year"=> $this->input->post('year'),
			"incidents"=> $this->input->post('incidents'),
			"dateAt"=>date('Y-m-d', strtotime(str_replace('-', '/', $date)))
		);
		$this->REPORTS_MODEL->insert_report($data);
	}

	public function get_report(){
		$dateFrom = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fromMonth').' 01 '. $this->input->post('fromYear'))));
		$dateTo = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('toMonth').' 01 '. $this->input->post('toYear'))));
		$result = array();
		$data = array(
			"from"=>$dateFrom,
			"to"=>$dateTo
		);
		$data = $this->REPORTS_MODEL->search_reports($data);

		foreach ($data as $row){
			$result[] = array(
				"id"=>$row->id,
				"barangay"=>$row->barangay_name,
				"month"=>$row->month,
				"year"=>$row->year,
				"incidents"=>$row->incidents,
			);
		}

		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}
  
  public function count_incidents(){
    $result = $this->INCIDENT_MODEL->get_incidents();
    $newIncidents = 0;

	foreach($result as $res){
		if($this->INCIDENT_MODEL->checkNew($res->incident_no)[0]->status == strtoupper('acknowledged')){
			$newIncidents += 1;
		}
	}
	echo json_encode(['newIncidents'=> $newIncidents]);
  }  
}
