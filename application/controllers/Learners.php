<?php


class Learners extends CI_Controller
{
	public $INFORMANT_MODEL;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Learners_model");
	}


	public function get_all_informants(){
		$response = array([
			'data'=>$this->INFORMANT_MODEL->Get_all_informants()
		]);

		echo json_encode($response[0]);
	}


	function verify_user(){
		$this->INFORMANT_MODEL->verify_user($this->input->post('id'));
	}

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
		$location = FCPATH.'incident_images/'.$basename;;

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
		if(count($this->Learners_model->check_credentials($this->input->post('username'), $this->input->post('password'))) > 0){
			$result = $this->Learners_model->check_credentials($this->input->post('username'), $this->input->post('password'))[0];
			$response = array(
				"error"=>false,
				"message"=>"User found!",
				"learners_id" => $result->learners_id,
				"username"=>$result->username,
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
			"image"=>$parse_image

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

	public function CheckAccount_learners_login(){
		$email	= $this->input->post("email");
		$password	= $this->input->post("password");

		// $email = 'quintotan@gmail.com';
		// $password = '12345';

		$result = $this->Learners_model->Countrows_learners_login($email, $password);

		if(empty($result))
		{
			$response['youth_id'] = 0;
			$response['exists'] = false;
		}
		else
		{
			$response['youth_id'] = $result[0]->id;
			$response['exists'] = true;
		}

		echo json_encode($response);
	}

	public function isEmail_exist(){
		$email	= $this->input->post("email");
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo 'Invalid Email';
			//echo '<span style="color: red; text-align: center;"> Invalid Email </span> ';
		}		
		else
		{
			$result = $this->Learners_model->IsEmail_exist($email);
			if($result > 0)
			{
				echo 'Email already exist';
				//echo '<span style="color: red; text-align: center;"> Email already exist </span> ';
			}else{
				echo 'Email available';
				//echo '<span style="color: green; text-align: center;"> Email available </span> ';
			}
		}
	}

	public function Register_osy(){
		// $date = $this->input->post('birthday');
		// echo $date;		
		$email_address = $this->input->post('email_add');
		$pwd = $this->input->post('pwd');
		if($pwd == "Yes"){
			$pwd = 1;
		}else{
			$pwd = 0;
		}
		$data = array(
			"last_name"		=>$this->input->post('lastname'),
			"first_name"	=>$this->input->post('firstname'),
			"middle_name"	=>$this->input->post('middlename'),
			"suffix"		=>$this->input->post('suffix'),
			"birthdate"		=>$this->input->post('birthday'),
			"place_of_birth"=>$this->input->post('place_of_birth'),
			"civil_status"	=>$this->input->post('civil_status'),
			"gender"		=>$this->input->post('gender'),
			"fathers_name"	=>$this->input->post('fathers_name'),
			"mothers_name"	=>$this->input->post('mothers_name'),
			"region"		=>$this->input->post('region'),
			"city"			=>$this->input->post('city'),
			"barangay"		=>$this->input->post('barangay'),
			"street"		=>$this->input->post('street'),
			"province"		=>$this->input->post('province'),
			"district"		=>$this->input->post('district'),
			"nationality"	=>$this->input->post('nationality'),
			"contact_no"	=>$this->input->post('contact_no'),
			"email_address"	=>$email_address,
			"password"		=>$this->input->post('password')
		);
		
		$result = $this->Learners_model->Insert_osy($data);

		//Insert to unified_youth_account
		$data = $this->Learners_model->Get_youth_id($email_address);
		$youth_id = $data[0]->id;
		$unified_data = array (
				"youth_id" => $youth_id,
				"agency_registered" => $this->input->post('agency'),
				"isfirst_login" => true,
				"status" => 'NOT VERIFIED'
		);
		$result = $this->Learners_model->Insert_unified_account($unified_data);

		echo json_encode($result);
	}

	public function sendMail()
	{
		$emailTo 			= $this->input->post('emailTo');
		$confirmationCode 	= $this->input->post('code');
		$firstname 			= $this->input->post('firstname');
		//require_once(__DIR__ . '/vendor/autoload.php');
		require_once("vendor/autoload.php");

		$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key','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');

		$apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(), $config);
		$sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
		$sendSmtpEmail['subject'] = 'Confirmation Code from eMonitor ';
		$sendSmtpEmail['htmlContent'] = '<html><body><p> Congratulations! You now have access to eMonitor app.</p><br> <p> To confirm your email address, please copy the code below to continue the registration.</p> <br> <h2>Confirmation Code : <b>'. $confirmationCode .' </b></h2></body></html>';
		$sendSmtpEmail['sender'] = array('name' => 'eMonitor', 'email' => 'emonitor@gmail.com');
		$sendSmtpEmail['to'] = array(array('email' => $emailTo, 'name' => $firstname));
		$sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
		$sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');

		try 
		{
		    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
		    print_r($result);
		} 
		catch (Exception $e) 
		{
		    echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
		}

		echo "Success";
	}

	public function get_cities_municipalities(){
		$data = $this->Learners_model->Get_cities_municipalities($this->input->post('region'));
		echo json_encode($data);
	}

	public function get_barangays(){
		$data = $this->Learners_model->Get_barangays($this->input->post('zip_code'));
		echo json_encode($data);
	}

	public function get_unified_details(){
		$data = $this->Learners_model->Get_unified_details($this->input->post('youth_id'));
		echo json_encode($data);
	}

	public function save_youth_other_details()
	{
		$data = array (
              "youth_id" 							=> $this->input->post('youth_id'),
              "elementary" 							=> $this->input->post('elementary'),
              "secondary" 							=> $this->input->post('secondary'),
              "no_school_in_barangay" 				=> $this->input->post('no_school_in_barangay'),
              "unable_to_pay" 						=> $this->input->post('unable_to_pay'),
              "school_too_far" 						=> $this->input->post('school_too_far'),
              "other_reasons_for_dropout" 			=> $this->input->post('other_reasons_for_dropout'),
              "distance_from_school_inKMS" 			=> $this->input->post('distance_from_school_inKMS'),
              "distance_from_school_inHRS" 			=> $this->input->post('distance_from_school_inHRS'),
              "mode_of_transportation" 				=> $this->input->post('mode_of_transportation'),
              "day_can_attend" 						=> $this->input->post('day_can_attend'),
              "pass_the_AcademicEquivalency_test" 	=> $this->input->post('pass_the_AcademicEquivalency_test'),
              "attended_ALS_session_before" 		=> $this->input->post('attended_ALS_session_before'),
              "name_of_program" 					=> $this->input->post('name_of_program'),
              "year_attended" 						=> $this->input->post('year_attended'),
              "level_of_literacy" 					=> $this->input->post('level_of_literacy'),
              "isCourse_completed" 					=> $this->input->post('isCourse_completed'),
              "reason_for_notCompleted" 			=> $this->input->post('reason_for_notCompleted')
		);
		$result = $this->Learners_model->Insert_osy_other_details($data);
		$result['success'] = true;
		echo json_encode($result);
	}

	public function save_tesda_youth_other_details()
	{
		$data = array (
              "youth_id" 				=> $this->input->post('youth_id'),
              "educational_attainment"	=> $this->input->post('educational_attainment'),
              "client_classification" 	=> $this->input->post('client_classification'),
              "course_name" 			=> $this->input->post('course_name'),
              "scholarship_name" 		=> $this->input->post('scholarship_name')
		);
		$result = $this->Learners_model->Insert_tesda_osy_other_details($data);
		$result['success'] = true;
		echo json_encode($result);
	}
}
