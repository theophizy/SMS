<?php
include('class.Database.php');
//include('../includes/constants.inc.php');
class Staff extends Database{
public $staff_id;
public $staff_first_name;
public $staff_middle_name;
public $staff_last_name;
public $staff_sex;
public $staff_date_birth;
public $staff_nationality;
public $staff_state_origin;
public $staff_lga;
public $staff_marital;
public $staff_blood_group;
public $staff_address;
public $staff_email;
public $staff_phone;
public $staff_qualification;
public $staff_institution_attended;
public $staff_course_study;
public $staff_year_graduated;
public $staff_year_of_appointment;
public $nextofkin_name;
public $nextofkin_phone;
public $nextofkin_email;
public $nextofkin_address;
public $image;
public $staff_status="ACTIVE";
public $table = "sms_staff";
public $query;



 function staffRecords($staff_id = '', $staff_first_name = '',$staff_middle_name = '', $staff_last_name = '', $staff_sex = '', $staff_date_birth = '',$staff_nationality = '', $staff_state_origin = '', $staff_lga = '', $staff_marital = '', $staff_blood_group = '', $staff_address = '' , $staff_email = '' , $staff_phone = '', $staff_qualification = '', $staff_institution_attended = '', $staff_course_study = '', $staff_year_graduated = '', $staff_year_of_appointment = '', $nextofkin_name = '',$nextofkin_phone = '', $nextofkin_email = '', $nextofkin_address = '',$image = '', $staff_status="ACTIVE"){
	$this->staff_id = $staff_id;
	$this->staff_first_name = $staff_first_name;
	$this->staff_middle_name = $staff_middle_name;
	$this->staff_last_name = $staff_last_name;
	$this->staff_sex = $staff_sex;
	$this->staff_date_birth = $staff_date_birth;
	$this->staff_nationality = $staff_nationality;
	$this->staff_state_origin = $staff_state_origin;
	$this->staff_lga = $staff_lga;
	$this->staff_marital = $staff_marital;
	$this->staff_blood_group = $staff_blood_group;
	$this->staff_address = $staff_address;
	$this->staff_email = $staff_email;
	$this->staff_phone = $staff_phone;
	$this->staff_qualification = $staff_qualification;
	$this->staff_institution_attended = $staff_institution_attended;
	$this->staff_course_study = $staff_course_study;
	$this->staff_year_graduated = $staff_year_graduated;
	$this->staff_year_of_appointment = $staff_year_of_appointment;
	$this->nextofkin_name = $nextofkin_name;
	$this->nextofkin_phone = $nextofkin_phone;
	$this->nextofkin_email = $nextofkin_email;
	$this->nextofkin_address = $nextofkin_address;
	$this->image = $image;
	$this->staff_status = $staff_status;
	
 }
 //mutator

 public function __construct()
	{
		parent::__construct();
	}
	
	
 //method to view Active student by their registration number
	function viewStaffbyID(){
		$this->query = "SELECT * FROM ". $this->table." WHERE 
		`staff_id`='".$this->Escape($this->staff_id)."'";
	//invoke method to return the array of the fetched result from the database class
		
foreach($this->Resultset($this->query) as $key => $value){
		$this->staff_id = $value['staff_id'];
	$this->staff_first_name = $value['staff_first_name'];
	$this->staff_middle_name = $value['staff_middle_name'];
	$this->staff_last_name = $value['staff_last_name'];
	$this->staff_sex = $value['staff_sex'];
	$this->staff_date_birth = $value['staff_date_birth'];
	$this->staff_nationality = $value['staff_nationality'];
	$this->staff_state_origin = $value['staff_state_origin'];
	$this->staff_lga = $value['staff_lga'];
	$this->staff_marital = $value['staff_marital'];
	$this->staff_blood_group = $value['staff_blood_group'];
	$this->staff_address = $value['staff_address'];
	$this->staff_email = $value['staff_email'];
	$this->staff_phone = $value['staff_phone'];
	$this->staff_qualification = $value['staff_qualification'];
	$this->staff_institution_attended = $value['staff_institution_attended'];
	$this->staff_course_study = $value['staff_course_study'];
	$this->staff_year_graduated = $value['staff_year_graduated'];
	$this->staff_year_of_appointment = $value['staff_year_of_appointment'];
	$this->nextofkin_name = $value['nextofkin_name'];
	$this->nextofkin_phone = $value['nextofkin_phone'];
	$this->nextofkin_email = $value['nextofkin_email'];
	$this->nextofkin_address = $value['nextofkin_address'];
	$this->image = $value['image'];
	$this->staff_status = $value['staff_status'];
			
	}
	return $this;
	}
	//method to view student by their class and class arm
	
		
	//return status as string
	function printStatus($student_status){
		return ($student_status == 1) ? 'Active' : 'Deactivated';
	}
	//function for both create and updating of students
	function Save(){
	$this->query = "SELECT `staff_id` 
	FROM
	 ".$this->table."
	  WHERE 
	  `staff_id`=
	  '".$this->staff_id."' LIMIT 1";
	  
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		//if an image is  selected
		if(!empty($this->image)){
		$this->query="UPDATE ".
		$this->table."
		 SET `staff_first_name`='".$this->Escape($this->staff_first_name)."',
		 `staff_middle_name`='".$this->Escape($this->staff_middle_name)."',
		 `staff_last_name`='".$this->Escape($this->staff_last_name)."',
		 `staff_sex`='".$this->Escape($this->staff_sex)."',
		 `staff_date_birth`='".$this->Escape($this->staff_date_birth)."',
		 `staff_nationality`='".$this->Escape($this->staff_nationality)."',
		 `staff_state_origin`='".$this->Escape($this->staff_state_origin)."',
		 `staff_lga`='".$this->Escape($this->staff_lga)."',
		 `staff_marital`='".$this->Escape($this->staff_marital)."',
		 `staff_blood_group`='".$this->Escape($this->staff_blood_group)."', `staff_address`='".$this->Escape($this->staff_address)."', `staff_email`='".$this->Escape($this->staff_email)."', `staff_phone`='".$this->Escape($this->staff_phone)."',
		 `staff_qualification`='".$this->Escape($this->staff_qualification)."',`staff_institution_attended`='".$this->Escape($this->staff_institution_attended)."',
`staff_course_study`='".$this->Escape($this->staff_course_study)."',
`staff_year_graduated`='".$this->Escape($this->staff_year_graduated)."',
`staff_year_of_appointment`='".$this->Escape($this->staff_year_of_appointment)."',
`nextofkin_name`='".$this->Escape($this->nextofkin_name)."',
`nextofkin_phone`='".$this->Escape($this->nextofkin_phone)."',
`nextofkin_email`='".$this->Escape($this->nextofkin_email)."',
`nextofkin_address`='".$this->Escape($this->nextofkin_address)."',	 
`image`='".$this->Escape($this->image)."',
`staff_status`='".$this->Escape($this->staff_status)."'
		  WHERE
		   `staff_id`='".$this->staff_id."'";
		}else{
			//when an image is not selected
		$this->query="UPDATE ".
		$this->table."  SET `staff_first_name`='".$this->Escape($this->staff_first_name)."',
		 `staff_middle_name`='".$this->Escape($this->staff_middle_name)."',
		 `staff_last_name`='".$this->Escape($this->staff_last_name)."',
		 `staff_sex`='".$this->Escape($this->staff_sex)."',
		 `staff_date_birth`='".$this->Escape($this->staff_date_birth)."',
		 `staff_nationality`='".$this->Escape($this->staff_nationality)."',
		 `staff_state_origin`='".$this->Escape($this->staff_state_origin)."',
		 `staff_lga`='".$this->Escape($this->staff_lga)."',
		 `staff_marital`='".$this->Escape($this->staff_marital)."',
		 `staff_blood_group`='".$this->Escape($this->staff_blood_group)."', `staff_address`='".$this->Escape($this->staff_address)."', `staff_email`='".$this->Escape($this->staff_email)."', `staff_phone`='".$this->Escape($this->staff_phone)."',
		 `staff_qualification`='".$this->Escape($this->staff_qualification)."',`staff_institution_attended`='".$this->Escape($this->staff_institution_attended)."',
`staff_course_study`='".$this->Escape($this->staff_course_study)."',
`staff_year_graduated`='".$this->Escape($this->staff_year_graduated)."',
`staff_year_of_appointment`='".$this->Escape($this->staff_year_of_appointment)."',
`nextofkin_name`='".$this->Escape($this->nextofkin_name)."',
`nextofkin_phone`='".$this->Escape($this->nextofkin_phone)."',
`nextofkin_email`='".$this->Escape($this->nextofkin_email)."',
`nextofkin_address`='".$this->Escape($this->nextofkin_address)."',
`staff_status`='".$this->Escape($this->staff_status)."'
		  WHERE
		   `staff_id`='".$this->staff_id."'";
		}
		
	}else{
	$this->query ="INSERT INTO ".$this->table."
(`staff_id`, `staff_first_name`,`staff_middle_name`,`staff_last_name`,`staff_sex`,`staff_date_birth`,`staff_nationality`,`staff_state_origin`,`staff_lga`,`staff_marital`,`staff_blood_group`,`staff_address`,`staff_email`,`staff_phone`,`staff_qualification`,`staff_institution_attended`,`staff_course_study`,`staff_year_graduated`,`staff_year_of_appointment`,`nextofkin_name`,`nextofkin_phone`,`nextofkin_email`,`nextofkin_address`,`image`,`staff_status`) 
VALUES('".$this->Escape($this->staff_id)."',
'".$this->Escape($this->staff_first_name)."',
'".$this->Escape($this->staff_middle_name)."',
'".$this->Escape($this->staff_last_name)."',
'".$this->Escape($this->staff_sex)."',
'".$this->Escape($this->staff_date_birth)."',
'".$this->Escape($this->staff_nationality)."',
'".$this->Escape($this->staff_state_origin)."',
'".$this->Escape($this->staff_lga)."',
'".$this->Escape($this->staff_marital)."',
'".$this->Escape($this->staff_blood_group)."',
'".$this->Escape($this->staff_address)."',
'".$this->Escape($this->staff_email)."',
'".$this->Escape($this->staff_phone)."',
'".$this->Escape($this->staff_qualification)."',
'".$this->Escape($this->staff_institution_attended)."',
'".$this->Escape($this->staff_course_study)."',
'".$this->Escape($this->staff_year_graduated)."',
'".$this->Escape($this->staff_year_of_appointment)."',
'".$this->Escape($this->nextofkin_name)."',
'".$this->Escape($this->nextofkin_phone)."',
'".$this->Escape($this->nextofkin_email)."',
'".$this->Escape($this->nextofkin_address)."',
'".$this->Escape($this->image)."',
'".$this->Escape($this->staff_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);

	return $insertid;
	}
	
	
	function Save_csv(){
	
	$this->query ="INSERT INTO ".$this->table."
(`staff_id`, `staff_first_name`,`staff_middle_name`, `staff_last_name`, `staff_sex`, `staff_date_birth`,`staff_nationality`, `staff_state_origin`, `staff_lga`, `staff_marital`, `staff_blood_group`,`staff_address`,`staff_email`,`staff_phone`, `staff_qualification`, `staff_institution_attended`, `staff_course_study`, `staff_year_graduated`, `staff_year_of_appointment`, `nextofkin_name`,`nextofkin_phone`, `nextofkin_email`, `nextofkin_address`, `staff_status`) 
VALUES('".$this->Escape($this->staff_id)."',
'".$this->Escape($this->staff_first_name)."',
'".$this->Escape($this->staff_middle_name)."',
'".$this->Escape($this->staff_last_name)."',
'".$this->Escape($this->staff_sex)."',
'".$this->Escape($this->staff_date_birth)."',
'".$this->Escape($this->staff_nationality)."',
'".$this->Escape($this->staff_state_origin)."',
'".$this->Escape($this->staff_lga)."',
'".$this->Escape($this->staff_marital)."',
'".$this->Escape($this->staff_blood_group)."',
'".$this->Escape($this->staff_address)."',
'".$this->Escape($this->staff_email)."',
'".$this->Escape($this->staff_phone)."',
'".$this->Escape($this->staff_qualification)."',
'".$this->Escape($this->staff_institution_attended)."',
'".$this->Escape($this->staff_course_study)."',
'".$this->Escape($this->staff_year_graduated)."',
'".$this->Escape($this->staff_year_of_appointment)."',
'".$this->Escape($this->nextofkin_name)."',
'".$this->Escape($this->nextofkin_phone)."',
'".$this->Escape($this->nextofkin_email)."',
'".$this->Escape($this->nextofkin_address)."',
'".$this->Escape($this->staff_status)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);

	return $insertid;
	}
	
	
	//Method to delete a particular student
	function deleteStaff(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `staff_id`='".$this->Escape($this->staff_id)."'";
		return $this->Reader($this->query);
		
	}
	
	//check if primary key exist to avoid mysql duplicate error 
	function AvoidStaffDuplicate(){
		$this->query = "SELECT `staff_id` FROM ".$this->table." WHERE `student_regno` = '".$this->staff_id."'";
		return $this->Query($this->query); 
	}
	
		
		
		 function GeneralViewList(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 //total number of students
		 public function totalNumberofStaff(){
			$this->query = "SELECT COUNT(staff_id) AS total_staff FROM ".$this->table." WHERE `staff_status`='ACTIVE'" ;
			//invokin a method from Database class that returns number of rows
			$getstudentstotal= $this->Query($this->query);
			return $getstudentstotal['total_staff'];
			
 
		 }
		 

	function reactivateStaff(){
	$this->query="UPDATE ".$this->table." SET `staff_status`='ACTIVE' WHERE `staff_id`='".$this->staff_id."'";	
	
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	
}
						
function deactivateStaff(){
	$this->query="UPDATE ".$this->table." SET `staff_status`='INACTIVE' WHERE `staff_id`='".$this->staff_id."'";	
	
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	
}						 
					
						 

 
}
?>