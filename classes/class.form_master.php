<?php
include('class.staff.php');
class ClassFormMaster extends Staff{
	// set parameters
							
	public $formaster_code;
	public $formaster_staffid;
	public $formaster_class_code;
	public $formaster_class_arm;
	public $date_from;
	public $date_to;
	public $formaster_status="ACTIVE";
	public $table_formteacher ="sms_formaster";
	public $table_formteacher_history = "sms_formaster_history";
	public $query;
	
	function class_formMAster($formaster_code, $formaster_staffid='', $formaster_class_code='', $formaster_class_arm='', $date_from='', $date_to='', $formaster_status='ACTIVE'){
		$this->formaster_code = $formaster_code;
		$this->formaster_staffid = $formaster_staffid;
		$this->formaster_class_code = $formaster_class_code;
		$this->formaster_class_arm = $formaster_class_arm;
		$this->date_from = $date_from;
		$this->date_to = $date_to;
		$this->formaster_status = $formaster_status;
		}
		
		
		//Method populating select drop down list for class master 
		
		public function classformmasterSelectField(){
			$this->query="SELECT * FROM ".$this->table_formteacher."";
		
		
	$output='<select class="form-control" onselect="this.className" name="form_master" >
                                  <option value="0">Select Class Master</option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
									   $this->formaster_staffid = $value['formaster_staffid'];
									   $this->viewStaffbyID();
									   $staffname = $this->staff_last_name." ".$this->staff_first_name;
								   
								   $output.='<option value="' .$value['formaster_code'].'">'. $staffname.'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
		
		//Aviod sql duplicate entry error for class master	
function avoidForMasterDuplicate(){
		$this->query = "SELECT formaster_class_code,formaster_class_arm FROM ".$this->table_formteacher." WHERE  `formaster_class_code` = '".$this->formaster_class_code."' AND `formaster_class_arm` = '".$this->formaster_class_arm."'";
		return $this->Query($this->query); 
	}
	
		//Aviod sql duplicate entry error for class master	
function avoidForMasterDuplicateEntry(){
		$this->query = "SELECT formaster_staffid FROM ".$this->table_formteacher." WHERE `formaster_staffid` = '".$this->formaster_staffid."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update 
function Save(){
	//check if the class mater exist and if it does update it else create a new class master
	$this->query = "SELECT `formaster_code` FROM ".$this->table_formteacher." WHERE `formaster_code`='".$this->formaster_code."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		
		$this->query = "UPDATE ".$this->table_formteacher." SET `formaster_staffid`='".$this->Escape($this->formaster_staffid)."',`date_from`='".$this->Escape($this->date_from)."' WHERE `formaster_code`='".$this->formaster_code."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->table_formteacher."(formaster_code,formaster_staffid,formaster_class_code,formaster_class_arm,date_from,formaster_status
) VALUES('".$this->Escape($this->formaster_code)."','".$this->Escape($this->formaster_staffid)."','".$this->Escape($this->formaster_class_code)."','".$this->Escape($this->formaster_class_arm)."','".$this->Escape($this->date_from)."','".$this->Escape($this->formaster_status)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deleteClassMaster(){
		 
				$this->query = "DELETE FROM ".$this->table_formteacher." WHERE `formaster_code`='".$this->Escape($this->formaster_code)."'";
		return $this->Reader($this->query);
		
	}
			//List all available class arms
			 function viewAllClassMaster(){
		
		$this->query = "SELECT * FROM ".$this->table_formteacher."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		function viewClassMasterByID(){
			
		$this->query = "SELECT * FROM ".
		$this->table_formteacher." WHERE 
		`formaster_code`=
		'".$this->Escape($this->formaster_code)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->formaster_code = $value['formaster_code'];
	$this->staff_id = $value['formaster_staffid'];
	$this->viewStaffbyID();
	$this->formaster_staffid = $this->staff_first_name. "  ". $this->staff_last_name;
	
	$classname = $this->viewFormmasterclassByID($value['formaster_class_code']);
	$this->formaster_class_code = $classname;
		$class_armname = $this->viewFormmasterclassarmByID($value['formaster_class_arm']);
		$this->formaster_class_arm = $class_armname;
    $this->date_from = $value['date_from'];
	$this->date_to = $value['date_to']
	;$this->formaster_status = $value['formaster_status'];
	
	
	}
	return $this;
	}
	
	
	function moveFormTeachertoHistory(){
			$date = date('Y-m-d');
		$this->query = "SELECT * FROM ".
		$this->table_formteacher." WHERE 
		`formaster_code`=
		'".$this->Escape($this->formaster_code)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
	
	$this->query = "INSERT INTO ".$this->table_formteacher_history."(formaster_code,formaster_staffid,formaster_class_code,formaster_class_arm,date_from,date_to,formaster_status
) VALUES('{$value['formaster_code']}','{$value['formaster_staffid']}','{$value['formaster_class_code']}','{$value['formaster_class_arm']}','{$value['date_from']}','$date','{$value['formaster_status']}')";	
	
	$insertid = $this->InsertOrUpdate($this->query);
	
	
}
return $insertid;
	}
	
	 function viewActiveStaff(){
		
		$this->query = "SELECT * FROM sms_staff WHERE `staff_status`='ACTIVE'";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		 function viewFormmasterclassByID($formaster_class_code){
		$this->query = "SELECT * FROM sms_class
		 WHERE 
		`class_code`=
		'$formaster_class_code'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		
	$class_name = $value['class_name'];
	
	
	}
	return $class_name;
		 }
	 function viewFormmasterclassarmByID($formaster_class_arm){
		$this->query = "SELECT * FROM sms_classarm
		 WHERE 
		`class_arm_code`=
		'$formaster_class_arm'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		
	$class_arm_name = $value['class_arm_name'];
	
	
	}
	return $class_arm_name;
	}	
	
	
}



?>