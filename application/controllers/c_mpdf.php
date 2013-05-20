<?php
/**
 * 
 */
class c_mpdf  extends MY_Controller {
	
  function __construct()
    {
      parent::__construct();
    $this -> load -> model('models_sugar/M_Sugar_ExternalFort_B3');
    $this->load->library('mpdf'); 
    }
	
	function index (){
//		$this->load->view('mpdfview');
$mpdf = new mPDF();
$data['dynamic']=$this->ajax_datatable();
$mpdf->WriteHTML('<p>Just trying out shiet</p> of course it damn works');
$mpdf->WriteHTML('<table border="1">');
foreach ($data['dynamic'] as $value) {
$mpdf->WriteHTML('<tr><td>'.$value['sugar_externalfortB3ID'].'</td><td>'.$value['factoryName'].'</td><td>'.$value['suggestionsForImprovement'].'</td></tr>');
}
$mpdf->WriteHTML('</table>');

$mpdf->Output();
    exit;

	}
	
	
	function ajax_datatable()
    {
    	   $result = $this->M_Sugar_ExternalFort_B3->get_table();
		   return $result;
    }
}

?>