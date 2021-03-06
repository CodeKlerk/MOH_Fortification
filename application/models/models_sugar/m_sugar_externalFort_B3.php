<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *model to E_ExternalFortifiedB2 entity
 */
use application\models\Entities\entities_sugar\E_Sugar_ExternalFort_B3;

class M_Sugar_ExternalFort_B3  extends MY_Model {
	var $id, $attr, $frags, $elements, $theIds, $noOfInserts, $batchSize;

	function __construct() {
		parent::__construct();
	}

	function addRecord($iodizationCentre) {
        $s=microtime(true); /*mark the timestamp at the beginning of the transaction*/
		
		if ($this -> input -> post()) {//check if a post was made		
			$this->elements = array();
			$this->theIds=array();
			foreach ($this -> input -> post() as $key => $val) {//For every posted values
		   // print(($key." ".$val)).'<br \>';			   
			//check if posted value is among the cloned ones   
			/* if(!strpos("_",$key)){//useful to keep all the  non-cloned elements in the loop
			 	$key=$key."_1";
			 }*/
			  		//we separate the attribute name from the number					
					/* $this->frags = explode("_", $key);				   
				    $this->id = $this->frags[1];  // the id				  
				   $this->attr = $this->frags[0];//the attribute name				   
				  $this->theIds[$this->attr]=$this->id;*/
			    //print($this->attr."  ".$this->id."  ".$val).'<br />';				   
			     $this->attr = $key;//the attribute name
				   if (!empty($val)) 
					//We then store the value of this attribute for this element.
					// $this->elements[$this->id][$this->attr]=htmlentities($val);
					$this->elements[$this->attr]=htmlentities($val);
			} //close foreach($_POST)
			//exit;
			//get the highest value of the array that will control the number of inserts to be done
			//$this->noOfInsertsBatch=max($this->theIds);
			$this->noOfInsertsBatch=1;
			//iodization centre name obtained from the session variable => 'affiliation'		
			 for($i=1; $i<=$this->noOfInsertsBatch;++$i){
			  $this -> theForm = new \models\Entities\entities_sugar\E_Sugar_ExternalFort_B3(); //create an object of the model
              $this -> theForm -> setInspectionRegistry($this->elements['inspectionRegistry']);
			  $this -> theForm -> setDates($this->elements['inspectionDate']);
			  $this -> theForm -> setFactoryName($iodizationCentre);
			  $this -> theForm -> setAreasVisited($this->elements['areas_visited']);
			  $this -> theForm -> setNonCompliances($this->elements['nonCompliances']);
			  $this -> theForm -> setSuggestionsForImprovement($this->elements['suggestionsForImprovement']);
			  $this -> theForm -> setPublicHealthOfficer($this->elements['publicHealthOfficer']);
			  $this -> theForm -> setReceivedBy($this->elements['receivedBy']);
			  $this -> theForm -> setInspectorDate($this->elements['inspectorDate']);
			  $this -> theForm -> setReceivedDate($this->elements['receivedDate']);				
			  $this -> theForm ->setSupervisorName($this->elements['supervisorName']);
			  $this -> theForm ->setSupervisorDate($this->elements['supervisorDate']);
			  $this -> em -> persist($this -> theForm);


        	//now do a batched insert, default at 5
			  $this->batchSize=5;
		if($i % $this->batchSize==0){
		try{
					
				$this -> em -> flush();
				$this->em->clear(); //detaches all objects from doctrine
				}catch(Exception $ex){
				    die($ex->getMessage());
					/*display user friendly message*/
					
				}//end of catch
				
			} else if($i<$this->batchSize || $i>$this->batchSize || $i==$this->noOfInsertsBatch && 
			$this->noOfInsertsBatch-$i<$this->batchSize){
				 //total records less than a batch, insert all of them
				try{
					
				$this -> em -> flush();
				$this->em->clear(); //detactes all objects from doctrine
				}catch(Exception $ex){
					die($ex->getMessage());
					/*display user friendly message*/
					
				}//end of catch
				 
				
			}//end of batch condition
				// $this->rowsInserted=$i;
				 } //end of innner loop
		}//close the this->input->post
		$e=microtime(true);
		$this->executionTime=round($e-$s,'4');
        $this->rowsInserted=$this->noOfInsertsBatch;
		return $this -> response = 'ok';
	}
        
		function excelupload($data){
//			            echo '<pre>';
//           var_dump($data);
//            echo '</pre>';
	$suggestionsForImprovement= $data['suggestionsForImprovement'];
	echo $data['suggestionsForImprovement'];
	echo "<br />";
//foreach ($data as  $value) {
//	echo "<pre>";
//	echo $value['factoryName'];
	
//	echo "</pre>";
//			 echo $vale[0];
  			  $this -> theForm = new \models\Entities\entities_sugar\E_Sugar_ExternalFort_B3(); //create an object of the model
/*				  $this -> theForm -> setInspectionRegistry($data['factoryName']);
			  $this -> theForm -> setFactoryName($data['factoryName']);  
		  $this -> theForm -> setDates($vale[2]);
			  $this -> theForm -> setAreasVisited($vale[3]);
			  $this -> theForm -> setNonCompliances($vale[4]);
			 
			  $this -> theForm -> setPublicHealthOfficer($vale[6]);
 			  $this -> theForm -> setReceivedBy($vale[7]);
			  $this -> theForm -> setInspectorDate($vale[8]);
			  $this -> theForm -> setReceivedDate($vale[9]);				
			  $this -> theForm ->setSupervisorName($vale[10]);
		  $this -> theForm ->setSupervisorDate($vale[11]);
	*/		  
	 $this -> theForm -> setSuggestionsForImprovement($suggestionsForImprovement);
			  $this -> em -> persist($this -> theForm);
			  
//			}//end foreach
	
		}
		
        function exceluploads($exceldata){
            echo '<pre>';
            var_dump($exceldata);
            echo '</pre>';
            $this->M_Sugar_ExternalFort_B3->get_table();
//            if ($today="leo")
                {
                    $s=microtime(true); /*mark the timestamp at the beginning of the transaction*/
			 	
                   
			 
			foreach ( $exceldata as  $val) {
					
//				var_dump($val);
//                          
			  //close foreach($_POST)
			//exit;
			//get the highest value of the array that will control the number of inserts to be done
			//$this->noOfInsertsBatch=max($this->theIds);
			$this->noOfInsertsBatch=1;
			//iodization centre name obtained from the session variable => 'affiliation'		
			 for($i=1; $i<=$this->noOfInsertsBatch;++$i){
			  $this -> theForm = new \models\Entities\entities_sugar\E_Sugar_ExternalFort_B3(); //create an object of the model
			  $this -> theForm -> setInspectionRegistry($val['inspectionRegistry']);
			  $this -> theForm -> setDates($val['inspectionDate']);
//			  $this -> theForm -> setFactoryName($val['iodizationCentre']);
			  $this -> theForm -> setAreasVisited($val['areas_visited']);
			  $this -> theForm -> setNonCompliances($val['nonCompliances']);
			  $this -> theForm -> setSuggestionsForImprovement($val['suggestionsForImprovement']);
			  $this -> theForm -> setPublicHealthOfficer($val['publicHealthOfficer']);
			  $this -> theForm -> setReceivedBy($val['receivedBy']);
			  $this -> theForm -> setInspectorDate($val['inspectorDate']);
			  $this -> theForm -> setReceivedDate($val['receivedDate']);				
			  $this -> theForm ->setSupervisorName($val['supervisorName']);
			  $this -> theForm ->setSupervisorDate($val['supervisorDate']);
			  $this -> em -> persist($this -> theForm);
        	//now do a batched insert, default at 5
                	  $this->batchSize=5;
                          if($i % $this->batchSize==0){
                              try{
                                  $this -> em -> flush();
                                  $this->em->clear(); //detaches all objects from doctrine                                                                   
                              }catch(Exception $ex){
				    die($ex->getMessage());
					/*display user friendly message*/
					
				}//end of catch
				
			} else if($i<$this->batchSize || $i>$this->batchSize || $i==$this->noOfInsertsBatch && 
			$this->noOfInsertsBatch-$i<$this->batchSize){
				 //total records less than a batch, insert all of them
				try{
					
				$this -> em -> flush();
				$this->em->clear(); //detactes all objects from doctrine
				}catch(Exception $ex){
					die($ex->getMessage());
					/*display user friendly message*/					
				}//end of catch				
			}//end of batch condition
				// $this->rowsInserted=$i;
				 } //end of innner loop
		 
		$e=microtime(true);
		$this->executionTime=round($e-$s,'4');
        $this->rowsInserted=$this->noOfInsertsBatch;
            return "issorait";
            } 
        }
        
                                }
   function get_table()
    {
           $query = $this->em->createQuery('SELECT m FROM models\Entities\entities_sugar\E_Sugar_ExternalFort_B3 m');
           $dataresult = $query->getArrayResult();
           return $dataresult;
    }
	function update_table($id,$dates,$suggestionsForImprovement){
		 
//		$this -> ish = $this->em->getRepository('models\Entities\entities_sugar\E_Sugar_ExternalFort_B3')->findOneBysugar_externalfortB3ID($id);
//						->findOneBy(array('sugar_externalfortB3ID' => $id));
		$this -> ish = $this->em->getRepository('models\Entities\entities_sugar\E_Sugar_ExternalFort_B3')
						->findOneBy(array('sugar_externalfortB3ID' => $id));


//		$this -> theForm = new \models\Entities\entities_sugar\E_Sugar_ExternalFort_B3(); //create an object of the model
		      
//			  $this -> ish -> setFactoryName($factoryName);
//			  $this -> ish -> setDates($dates);
//			  $this -> ish -> setSuggestionsForImprovement($suggestionsForImprovement);
//			  $this -> em -> persist($this -> ish);
//			  $this -> em -> save();

			/*
			  $qb = $this->em->createQueryBuilder();
			  $q = $qb->update('models\Entities\entities_sugar\E_Sugar_ExternalFort_B3', 'u')
        	  ->set('u.dates', '?1')
        	  ->set('u.suggestionsForImprovement', '?2')
        	  ->where('u.sugar_externalfortB3ID = ?3')
        	  ->setParameter(1, $dates)
        	  ->setParameter(2, $suggestionsForImprovement)
        	  ->setParameter(3, $id)
        	  ->getQuery();
        	  $p = $q->execute();
			  
			  echo $id . " " . $dates . " " . $suggestionsForImprovement; 
			 * */
	}
 
}//end of class ExtternalFortifiedB2


