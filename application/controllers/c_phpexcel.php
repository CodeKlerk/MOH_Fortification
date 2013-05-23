<?php
/**
 * @author Maestro
 */
class c_phpexcel extends MY_Controller {
	
	
function __construct()
{
    parent::__construct();
//  $this -> load -> model('models_sugar/M_Sugar_ExternalFort_B3');
	$this->load->library('PHPexcel'); 
}
	
	function saving()
	{
		$PHPexcelinst = new PHPexcel;
		$PHPexcelinst->getProperties()->setTitle("experimental")
							->setDescription("description");
		$PHPexcelinst->setActiveSheetIndex(0);
		$PHPexcelinst->getActiveSheet()->setCellValue('A1', 'Ni Kama Ndrama, nikama findio');
									 
										
										
										
$filename='just_some_random_name.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($PHPexcelinst, 'Excel5');
		$objWriter->save('php://output');
		
	//	$objWriter->save('http://localhost/moh_fortification/excel/success.xlsx');
	 
	}
	
		function upload(){

//			$location = base_url();
//			$location = $location.'excel/big.xlsx';
//			redirect($location); 
//			$objReader = new PHPExcel_Reader_Excel2007();				
 			//$objPHPExcel = $objReader -> load($location);
			
			$objReader = new PHPExcel_Reader_Excel2007();
			echo $_FILES['file']['temp_name'];
			if  ($_FILES['file']['tmp_name']) {
				$objPHPExcel = $objReader -> load($_FILES['file']['tmp_name']);

			}			

	}


	public function data_upload() {
//		echo "<pre>";
//		var_dump($_POST);
//		echo $_FILES['incoming_file']['name'];
//		echo "</pre>";
 if ($_POST['btn']=='Save') {

			$objReader = new PHPExcel_Reader_Excel2007();

			if ($_FILES['incoming_file']['name']) {
				$objPHPExcel = $objReader -> load($_FILES['incoming_file']['name']);

			} else {
 
			}

	 
		}
 // end here
	}

		function index(){
			$this->load->view('phpexcelview');
		}
	
}

?>