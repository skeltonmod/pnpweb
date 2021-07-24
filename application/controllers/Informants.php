<?php


class Informants extends CI_Controller
{
	public $INFORMANT_MODEL;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("INFORMANT_MODEL");
	}


	// Mobile Endpoint

	function generateString($key){
		$n = 8;
		$characters = ($key === "password") ? '0123456789': "123456789";
		$randomString = '';

		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}

		return ($key === "password") ? strval($randomString): intval($randomString);

	}
	function getImage($image,$filename){

		$imagefiletype = pathinfo($image,PATHINFO_EXTENSION);
		$basename = $filename.".".$imagefiletype;
		$location = "../../public/informant_images/".$basename;

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

	public function insertInformant(){
		$image = $_FILES['image']['name'];
		$s_rand = $this->generateString("user");
		$parse_image = $this->getImage($image, "INFORMANT"."_".$s_rand);
		$response = array();
		$data = array(
			"userid"=> $s_rand,
			"firstname"=>$this->input->post('firstname'),
			"suffix"=>$this->input->post('suffix'),
			"lastname"=>$this->input->post('lastName'),
			"middlename"=>$this->input->post('middlename'),
			"email"=> $this->input->post('email'),
			"password"=>$this->input->post('password'),
			"citizenship"=>$this->input->post('citizenship'),
			"civilstatus"=>$this->input->post('civilstatus'),
			"dob"=>$this->input->post('dob'),
			"educ"=>$this->input->post('education'),
			"gender"=>$this->input->post('gender'),
			"mobilenumber"=>$this->input->post('mobilenumber'),
			"nickname"=>$this->input->post('firstname'),
			"pob"=>$this->input->post('birthplace'),
			"currentaddress"=>$this->input->post('currentAddress'),
			"homeaddress"=>$this->input->post('primaryAddress'),
			"occupation"=>$this->input->post('occupation'),
			"workaddress"=>$this->input->post('workAddress'),
			"image"=>$parse_image

		);
		if(count($this->INFORMANT_MODEL->check_existing($this->input->post('email'))) > 0){
			$response = array(
				"error"=>true,
				"message"=>"User with the same Email already Exist!",
			);
		}else{
			if(boolval($this->INFORMANT_MODEL->insert_informant($data))){
				$response = array(
					"error"=>false,
					"message"=>"User Created!",
				);
			}
		}



		$data = array(
			"data"=>$response
		);
		echo json_encode($data);
	}

	public function login(){
		$response = array();
		if(count($this->INFORMANT_MODEL->check_credentials($this->input->post('email'), $this->input->post('password'))) > 0){
			$result = $this->INFORMANT_MODEL->check_credentials($this->input->post('email'), $this->input->post('password'))[0];
			$response = array(
				"error"=>false,
				"message"=>"User found!",
				"userid" => $result->userid,
				"user"=>$result->email,
				"name"=>$result->firstname." ".$result->lastname
			);
		}else{
			$response = array(
				"error"=>true,
				"message"=>"User not found!",
			);
		}


		$data = array(
			"data"=>$response

		);
		echo json_encode($data);
	}

	public function get_informant(){
		echo json_encode($this->INFORMANT_MODEL->get_informant($this->input->post("userid")));
	}

	public function edit_informant(){
		$image = (isset($_FILES['image']['name']) ? $_FILES['image']['name'] : null);

		if($image != null){
			$parse_image = $this->getImage($image, "INFORMANT"."_".$this->input->post('userid'));
		}else{
			$parse_image = "INFORMANT"."_".$this->input->post('userid');
		}

		$data = array(
			"firstname"=>$this->input->post('firstname'),
			"suffix"=>$this->input->post('suffix'),
			"lastname"=>$this->input->post('lastName'),
			"middlename"=>$this->input->post('middlename'),
			"email"=> $this->input->post('email'),
			"password"=>$this->input->post('password'),
			"citizenship"=>$this->input->post('citizenship'),
			"educ"=>$this->input->post('education'),
			"mobilenumber"=>$this->input->post('mobilenumber'),
			"nickname"=>$this->input->post('firstname'),
			"currentaddress"=>$this->input->post('currentAddress'),
			"homeaddress"=>$this->input->post('primaryAddress'),
			"occupation"=>$this->input->post('occupation'),
			"workaddress"=>$this->input->post('workAddress'),
			"image"=>$parse_image
		);

		$this->INFORMANT_MODEL->edit_informant($data, $this->input->post('userid'));

		$response = array(
			"error"=>false,
			"message"=>"User Edited!",
		);

		$data = array(
			"data"=>$response

		);

		echo json_encode($data);

	}

	// Incident For Informants
	public function insert_temp_incident(){
		$response = array();
		$image = $_FILES['image']['name'];

		$parse_image = $this->getImage($image, "INCIDENT"."_".$this->input->post('userid')."_".$this->input->post('type'));

		// Get the station number from canonical name
		$station_id = $this->INFORMANT_MODEL->get_station_data($this->input->post('barangay'))[0]->station_id;
		$data = array(
			"userid"=>$this->input->post('userid'),
			"informant_name"=>$this->input->post('name'),
			"type"=>$this->input->post('type'),
			"latitude"=>$this->input->post('lat'),
			"longitude"=>$this->input->post('lng'),
			"date"=>$this->input->post('date'),
			"time"=>$this->input->post('time'),
			"barangay"=>$this->input->post('barangay'),
			"station"=>$station_id,
			"image"=>$parse_image,

		);

		if($this->INFORMANT_MODEL->insert_temp_incident($data)){
			$response = array(
				"error"=>false,
				"message"=>"Incident Reported!",
			);
		}else{
			$response = array(
				"error"=>false,
				"message"=>"Something went Wrong!",
			);
		}

		$data = array(
			"data"=>$response

		);

		echo json_encode($data);
	}

	public function get_temp_incident(){
		$data = $this->INFORMANT_MODEL->get_temp_incidents($this->input->post('userid'));
		$result = null;

		foreach ($data as $row){
			$result[] = array(
				"userid"=>$row->userid,
				"type"=>$row->type,
				"lat"=>$row->latitude,
				"long"=>$row->longitude,
				"date"=>$row->date,
				"time"=>$row->time,
				"barangay"=>$row->barangay,
				"station"=>$row->station,
				"image"=>$row->image,
				"status"=>$row->status,

			);
		}
		$response = array(
			"data"=>$result
		);
		echo json_encode($response);
	}
}
