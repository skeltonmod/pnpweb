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

	// Test column without polling from database
	public function setHead(){
		$year = null;

		for($i = 0; $i <= 10; ++$i){
			$year[] = 2010 + $i;
		}

		return $year;
	}

	public function index(){
		$spreadsheet = new Spreadsheet();
		$table_columns = $this->setHead();
		$spreadsheet->setActiveSheetIndex(0);
		$filename = "Dummy_Excel";


		// Column
		for($i = 0; $i < count($this->setHead()); ++$i){
			$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $this->setHead()[$i]);

			// Row
			for($x = 0; $x < count($this->setHead()); ++$x){
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($x, $i, $this->setHead()[$x]);
			}
		}

		//write to file
		$writer = new Ods($spreadsheet);

		header('Content-Type: application/vnd.ms-excel'); // generate excel file
		header('Content-Disposition: attachment;filename="'. $filename .'.ods"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}




}
