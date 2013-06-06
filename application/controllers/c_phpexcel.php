<?php
/**
 * @author Maestro
 */
class c_phpexcel extends MY_Controller {
	
	
function __construct()
{
    parent::__construct();
  $this -> load -> model('models_sugar/M_Sugar_ExternalFort_B3');
	$this->load->library('PHPexcel'); 
}
		public function data_upload() {
		 
		$objPHPExcel = PHPExcel_IOFactory::load("./excel/sugar_externalfortb3.xls");	
                    $objReader = new PHPExcel_Reader_Excel5();
                        
 			$arr = $objPHPExcel -> getActiveSheet() -> toArray(null, true, true, true);
			$highestColumm = $objPHPExcel -> setActiveSheetIndex(0) -> getHighestColumn();
			$highestRow = $objPHPExcel -> setActiveSheetIndex(0) -> getHighestRow();

			for ($i = 2; $i <= $highestRow; $i++) {
				for ($j = 2; $j <= $highestColumm; $j++) {
				}
                                $inspectionRegistry = $arr[$i]['B'];
                                $factoryName = $arr[$i]['C'];
                                $dates = $arr[$i]['D'];
                                $areasVisited = $arr[$i]['E'];
                                $nonCompliances = $arr[$i]['F'];
                                $suggestionsForImprovement = $arr[$i]['G'];
                                $publicHealthOfficer = $arr[$i]['H'];
                                $receivedBy = $arr[$i]['I'];
                                $inspectorDate = $arr[$i]['J'];
                                $receivedDate = $arr[$i]['L'];
                                $supervisorName = $arr[$i]['N'];
                                $supervisorDate = $arr[$i]['M'];
/*				$this -> load -> database();
				$query = $this -> db -> query("SELECT id FROM drugcode WHERE drug LIKE '%$commodity_name%'");
				$results = $query -> result_array();
				@$commodity_id = $results[0]['id'];
				$total_issued = $arr[$i]['C'];
				$consumption = $arr[$i]['D'];
				$stock_on_hand = $arr[$i]['E'];
				$earliest_expiry_date = $arr[$i]['F'];
				$quantity_of_stock_expiring = $arr[$i]['G'];
				$central_site_stock_on_hand = $arr[$i]['H'];
				$total_stock_in_country = $arr[$i]['I'];
				$mos_on_hand_pipeline = $arr[$i]['J'];
				$mos_on_hand_central_sites = $arr[$i]['K'];
				$mos_on_hand_total = $arr[$i]['L'];
				$quantity_on_order_from_suppliers = $arr[$i]['M'];
				$source = $arr[$i]['N'];
				$expected_delivery_date = $arr[$i]['O'];
				$receipts_or_transfers = $arr[$i]['R'];
				$comments_or_actions = $arr[$i]['S'];
				$upload_date = $_POST['upload_date'];
				$pipeline_id = $_POST['pipeline_name'];
*/
				//pipeline id: 1= KEMSA & 2=KENYA PHARMA

//				$new_pipeline = new Pipeline_Stock();
//				$data = array("id" => 'NULL', "commodity_id" => $commodity_id, "total_issued" => $total_issued, "consumption" => $consumption, "stock_on_hand" => $stock_on_hand, "earliest_expiry_date" => $earliest_expiry_date, "quantity_of_stock_expiring" => $quantity_of_stock_expiring, "central_site_stock_on_hand" => $central_site_stock_on_hand, "total_stock_in_country" => $total_stock_in_country, "mos_on_hand_pipeline" => $mos_on_hand_pipeline, "mos_on_hand_central_sites" => $mos_on_hand_central_sites, "mos_on_hand_total" => $mos_on_hand_total, "quantity_on_order_from_suppliers" => $quantity_on_order_from_suppliers, "source" => $source, "expected_delivery_date" => $expected_delivery_date, "receipts_or_transfers" => $receipts_or_transfers, "comments_or_actions" => $comments_or_actions, "upload_date" => $upload_date, "pipeline_id" => $pipeline_id);
//				$new_pipeline -> fromArray($data);
//				$new_pipeline -> save();
                                $data = array('inspectionRegistry'=>$inspectionRegistry,'factoryName'=>$factoryName,'dates'=>$dates,'areasVisited'=>$areasVisited,'nonCompliances'=>$nonCompliances,'suggestionsForImprovement'=>$suggestionsForImprovement,'publicHealthOfficer'=>$publicHealthOfficer,'receivedBy'=>$receivedBy,'inspectorDate'=>$inspectorDate,'receivedDate'=>$receivedDate,'supervisorName'=>$supervisorName,'supervisorDate'=>$supervisorDate);
//                                echo '<pre>';
//                                json_encode($data);
//                                var_dump($data);
//                                $this->M_Sugar_ExternalFort_B3->excelupload($data);
                                  $this -> load -> database();
                                  $this->db->query("INSERT INTO `fortification`.`sugar_externalfortb3` (`sugar_externalfortB3ID`, `inspectionRegistry`, `factoryName`, `dates`, `areasVisited`, `nonCompliances`, `suggestionsForImprovement`, `publicHealthOfficer`, `receivedBy`, `inspectorDate`, `receivedDate`, `supervisorName`, `supervisorDate`) VALUES (NULL, '$inspectionRegistry', '$factoryName', '$dates','$areasVisited', '$nonCompliances', '$suggestionsForImprovement','$publicHealthOfficer','$receivedBy', '$inspectorDate','$receivedDate','$supervisorName','$supervisorDate');");
//                                $sql = "INSERT INTO table (title) VALUES(".$this->db->escape($title).")";
//                                echo '</pre>';

			//Pipeline_Stock::add($commodity_id,$total_issued,$consumption,$stock_on_hand,$earliest_expiry_date,$quantity_of_stock_expiring,$central_site_stock_on_hand,$total_stock_in_country,$mos_on_hand_pipeline,$mos_on_hand_central_sites,$mos_on_hand_total,$quantity_on_order_from_suppliers,$source,$expected_delivery_date,$receipts_or_transfers,$comments_or_actions,$upload_date,$pipeline_id);
                         }
                         echo "data saved! Thanks";

		//	$this -> session -> set_userdata('upload_counter', '2');
		//	redirect("pipeline_management/index");
		 
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
	 
		public function houseleveluploads() {
		 
		$objPHPExcel = PHPExcel_IOFactory::load("./excel/IODATESURVEY-2010-donblank.xls");	
                    $objReader = new PHPExcel_Reader_Excel5();
                        
 			$arr = $objPHPExcel -> getActiveSheet() -> toArray(null, true, true, true);
			$highestColumm = $objPHPExcel -> setActiveSheetIndex(0) -> getHighestColumn();
			$highestRow = $objPHPExcel -> setActiveSheetIndex(0) -> getHighestRow();

			for ($i = 5; $i <= $highestRow; $i++) {
				for ($j = 2; $j <= $highestColumm; $j++) {
				}
                                $serial = $arr[$i]['B'];
                                $province = $arr[$i]['C'];
                                $district = $arr[$i]['D'];
                                $code = $arr[$i]['E'];
                                $school = $arr[$i]['F'];
                                $sample = $arr[$i]['G'];
                                $weight = $arr[$i]['H'];
                                $brand = $arr[$i]['I'];
                                $iodate = $arr[$i]['J'];
//								$ndata =  array($serial,$province,$district,$code,$school,$sample,$weight,$brand,$iodate);
                                $data = array('serial'=>$serial,'province'=>$province,'district'=>$district,'code'=>$code,'school'=>$school,'sample'=>$sample,'weight'=>$weight,'brand'=>$brand,'iodate'=>$iodate);
                                echo '<pre>';
//                                json_encode($data);
//                                var_dump($data);
//								var_dump($ndata);
								echo "</pre>";
//                                $this->M_Sugar_ExternalFort_B3->excelupload($data);
                                $this -> load -> database();
							    $this->db->query("INSERT INTO `fortification`.`houselevelresults` (`id`, `serial`, `province`, `district`, `code`, `school`, `sample`, `weight`, `brand`, `iodate`) VALUES (NULL, '$serial', '$province','$district', '$code','$school', '$sample', '$weight','$brand','$iodate');");
//                                echo '</pre>';

			//Pipeline_Stock::add($commodity_id,$total_issued,$consumption,$stock_on_hand,$earliest_expiry_date,$quantity_of_stock_expiring,$central_site_stock_on_hand,$total_stock_in_country,$mos_on_hand_pipeline,$mos_on_hand_central_sites,$mos_on_hand_total,$quantity_on_order_from_suppliers,$source,$expected_delivery_date,$receipts_or_transfers,$comments_or_actions,$upload_date,$pipeline_id);
                         }
                         echo "data saved! Thanks";

		//	$this -> session -> set_userdata('upload_counter', '2');
		//	redirect("pipeline_management/index");
		 
	}
	
		function index(){
			$this->load->view('phpexcelview');
		}
	
}

?>