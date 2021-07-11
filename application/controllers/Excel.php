<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{

	public $REPORTS_MODEL;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("REPORTS_MODEL");
	}

	public function setHead($from, $to)
	{
		$start = (new DateTime($from))->modify('first day of this month');
		$end = (new DateTime($to))->modify('first day of next month');
		$interval = date_interval_create_from_date_string('1 month');

		$period = new DatePeriod($start, $interval, $end);

		$result = [];

		foreach ($period as $time){
			$result[] = $time->format('F-Y');
		}


		return $result;
	}

	public function index(){
		$spreadsheet = new Spreadsheet();
		$dateFrom = date('Y-m-d', strtotime(str_replace('-', '/', str_replace('_',' ', json_decode($this->input->get('data'))->from))));
		$dateTo = date('Y-m-d', strtotime(str_replace('-', '/', str_replace('_', ' ', json_decode($this->input->get('data'))->to))));

		$data = array(
			"from"=>$dateFrom,
			"to"=>$dateTo
		);
		$spreadsheet->setActiveSheetIndex(0);
		$filename = "Dummy_Excel";

		$column_headers = $this->setHead($data['from'], $data['to']);
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Barangay");

		$cols = array();

		for($i = 0; $i < count($column_headers); $i++){
			// check for empty data
			 if($this->REPORTS_MODEL->check_empty(explode('-', $column_headers[$i])[0], explode('-', $column_headers[$i])[1])){
			 	// rebuild the array
				 $cols[] = $column_headers[$i];
			 }
		}

		for($i = 0; $i < count($cols); $i++){
			// finally build the spreadsheet
			$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2 + $i, 1, $cols[$i]);
			$barangay_row = $this->REPORTS_MODEL->search_reports_date(explode('-', $cols[$i])[0], explode('-', $cols[$i])[1]);
			$rows = array();
			// Build the barangay rows first
			if($i == 0){
				for($x = 0; $x < count($barangay_row); $x++){
					$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 2 + $x, $barangay_row[$x]->canonical_name);
					$rows[] = $barangay_row[$x]->canonical_name;
				}

			}

			// then build the data here
			for($x = 0; $x < count($barangay_row); $x++){
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2 + $i, 2 + $x, $barangay_row[$x]->incidents);
			}

		}
		// write to file
		$writer = new Ods($spreadsheet);

		header('Content-Type: application/vnd.ms-excel'); // generate excel file
		header('Content-Disposition: attachment;filename="'. $filename .'.ods"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		}


}