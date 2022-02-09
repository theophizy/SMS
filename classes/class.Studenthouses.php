<?php
include('class.Database.php');
class StudentHouse extends Database{
	public $house_code;
	public $house_name;
	public $table="sms_house";
	public $house_status = "ACTIVE";
	//house constructor
	function studentsHouse($house_code='', $house_name='',$house_status='ACTIVE'){
		$this->classcode = $house_code;
		$this->class_name = $house_name;
		$this->class_status = $house_status;
		}
		
		
		//Method displaying all available houses eg St John's house
		
public function viewAllHouses(){
			$this->query = "SELECT * FROM ".$this->table."";
	
		
	$output = '<select data-placeholder="" class="form-control"  tabindex="1" name="controller">
                                  <option value=""></option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="'.  $value['house_code'].'">'.  $value['house_name'].'</option>';
								   }
                                
                                $output.= '</select>';	
		 
		 return $output;	
			}
			
			
	
		//Aviod sql duplicate entry error for houses	
function AvoidHouseDuplicate(){
		$this->query = "SELECT `house_name`
		 FROM "
		 .$this->table."
		  WHERE 
		  `house_name` =
		  '".$this->house_name."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update claasses eg JSS1,SS1 etc
function Save(){
	//check if the house_code exist and if it does update it else create a new clas
	$this->query = "SELECT `house_code`
		 FROM ".
		 $this->table."
		 WHERE
		  
		 `house_code`='".$this->house_code.
		 "' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		//if an image is not selected
		
			//when an image is selected
		$this->query = "UPDATE "
		.$this->table."
		 SET 
		 `house_name`='".$this->Escape($this->house_name)."',
		 `house_status`='".$this->Escape($this->house_status)."'
		  WHERE `house_code`='".$this->house_code."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->table."
	(`house_code`,`house_name`,`house_status`) 
	VALUES('".$this->Escape($this->house_code)."',
	'".$this->Escape($this->house_name)."',
	'".$this->Escape($this->house_status)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deleteHouse(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `house_code`='".$this->Escape($this->house_code)."'";
		return $this->Reader($this->query);
		
	}
}



?>