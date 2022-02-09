<?php
include('class.Scores.php');
//include('../includes/constants.inc.php');
class Students extends Scores{
public $student_regno;
public $first_name;
public $middle_name;
public $last_name;
public $sex;
public $date_birth;
public $nationality;
public $state_origin;
public $lga;
public $student_class;
public $student_classarm;
public $student_class_admitted;
public $student_house;
public $blood_group;
public $term_admitted;
public $session_admitted;
public $guardian_name;
public $guardian_address;
public $guardian_phone;
public $guardian_email;
public $image;
public $student_status="ACTIVE";
public $table = "sms_students";
public $alumni_table = "sms_students_alumni";
public $query;



 function students_record($student_regno='',$first_name='',$middle_name='', $last_name='',$sex='', $date_birth='', $nationality='', $state_origin ='', $lga='', $student_class='', $student_classarm='',  $student_class_admitted='', $student_house='', $blood_group='', $term_admitted='',  $session_admitted='', $guardian_name='', $guardian_address='', $guardian_phone='', $guardian_email='',  $image='',$student_status="ACTIVE"){
	$this->student_regno=$student_regno;
	$this->first_name=$first_name;
	$this->middle_name=$middle_name;
	$this->last_name=$last_name;
	$this->sex=$sex;
	$this->date_birth=$date_birth;
	$this->nationality=$nationality;
	$this->state_origin=$state_origin;
	$this->lga=$lga;
	$this->student_class=$student_class;
	$this->student_classarm=$student_classarm;
	$this->student_class_admitted=$student_class_admitted;
	$this->student_house=$student_house;
	$this->blood_group=$blood_group;
	$this->term_admitted=$term_admitted;
	$this->session_admitted=$session_admitted;
	$this->guardian_name=$guardian_name;
	$this->guardian_address=$guardian_address;
	$this->guardian_phone=$guardian_phone;
	$this->guardian_email=$guardian_email;
	$this->image=$image;
	$this->student_status=$student_status;
	
 }
 //mutator

 public function __construct()
	{
		parent::__construct();
	}
	
	
 //method to view Active student by their registration number
	function viewStudentbyID(){
		$this->query = "SELECT * FROM ". $this->table." WHERE 
		`student_regno`='".$this->Escape($this->student_regno)."'";
	//invoke method to return the array of the fetched result from the database class
		
foreach($this->Resultset($this->query) as $key => $value){
		$this->student_regno=$value['student_regno'];
	$this->first_name=$value['first_name'];
	$this->middle_name=$value['middle_name'];
	$this->last_name=$value['last_name'];
	$this->sex=$value['sex'];
	$this->date_birth=$value['date_birth'];
	$this->nationality=$value['nationality'];
	$this->state_origin=$value['state_origin'];
	$this->lga=$value['lga'];
	$this->student_class=$value['student_class'];
	$this->student_classarm=$value['student_classarm'];
	$this->student_class_admitted=$value['student_class_admitted'];
	$this->student_house=$value['student_house'];
	$this->blood_group=$value['blood_group'];
	$this->term_admitted=$value['term_admitted'];
	$this->session_admitted=$value['session_admitted'];
	$this->guardian_name=$value['guardian_name'];
	$this->guardian_address=$value['guardian_address'];
	$this->guardian_phone=$value['guardian_phone'];
	$this->guardian_email=$value['guardian_email'];
	$this->image=$value['image'];
	$this->student_status = $value['student_status'];
			
	}
	return $this;
	}
	//view alumni by registration number
	function viewAlumnibyID(){
		$this->query = "SELECT * FROM ". $this->alumni_table." WHERE 
		`student_regno`='".$this->Escape($this->student_regno)."'";
	//invoke method to return the array of the fetched result from the database class
		
foreach($this->Resultset($this->query) as $key => $value){
		$this->student_regno=$value['student_regno'];
	$this->first_name=$value['first_name'];
	$this->middle_name=$value['middle_name'];
	$this->last_name=$value['last_name'];
	$this->sex=$value['sex'];
	$this->date_birth=$value['date_birth'];
	$this->nationality=$value['nationality'];
	$this->state_origin=$value['state_origin'];
	$this->lga=$value['lga'];
	$this->student_class=$value['student_class'];
	$this->student_classarm=$value['student_classarm'];
	$this->student_class_admitted=$value['student_class_admitted'];
	$this->student_house=$value['student_house'];
	$this->blood_group=$value['blood_group'];
	$this->term_admitted=$value['term_admitted'];
	$this->session_admitted=$value['session_admitted'];
	$this->guardian_name=$value['guardian_name'];
	$this->guardian_address=$value['guardian_address'];
	$this->guardian_phone=$value['guardian_phone'];
	$this->guardian_email=$value['guardian_email'];
	$this->image=$value['image'];
	$this->student_status = $value['student_status'];
			
	}
	return $this;
	}
	
	//view alumni by their graduation academic session
	function viewAlumniBySession(){
		$this->query = "SELECT * FROM ". $this->alumni_table." WHERE 
		`session_admitted`='".$this->Escape($this->session_admitted)."'";
	//invoke method to return the array of the fetched result from the database class
		
return $this->Resultset($this->query);
	
}


	//select students whose have been graduated and ready to be moved to alumni table
	function viewStudentbyIDofStatusAlumni(){
		$this->query = "SELECT * FROM sms_students WHERE 
		`student_status`='Alumni'";
	//invoke method to return the array of the fetched result from the database class
		
return $this->Resultset($this->query);
	
}
	//method move all graduated students to alumni table
	function viewStudentbyIDForGraduation(){
		$this->query = "SELECT * FROM ".$this->table." WHERE 
		`student_status`='Alumni'";
	//invoke method to return the array of the fetched result from the database class
		
foreach($this->Resultset($this->query) as $key => $value){
	$regno = $value['student_regno'];
	/*$this->query ="INSERT INTO ".$this->alumni_table."
(student_regno,first_name,
middle_name,last_name,sex,date_birth,nationality,state_origin,lga, student_class,student_classarm,student_class_admitted,student_house,blood_group,term_admitted,session_admitted,guardian_name,
guardian_address,guardian_phone,guardian_email,image,student_status)
VALUES('{$value['student_regno']}',
'{$value['first_name']}',
'{$value['middle_name']}',
'{$value['last_name']}',
'{$value['sex']}',
'{$value['date_birth']}',
'{$value['nationality']}',
'{$value['state_origin']}',
'{$value['lga']}',
'{$value['student_class']}',
'{$value['student_classarm']}',
'{$value['student_class_admitted']}',
'{$value['student_house']}',
'{$value['blood_group']}',
'{$value['term_admitted']}',
'{$value['session_admitted']}',
'{$value['guardian_name']}',
'{$value['guardian_address']}',
'{$value['guardian_phone']}',
'{$value['guardian_email']}',
'{$value['image']}',
'{$value['student_status']}')";	*/
$this->query ="INSERT INTO ".$this->alumni_table."
(student_regno,first_name,
middle_name,last_name,sex,date_birth,nationality,state_origin,lga, student_class,student_classarm,student_class_admitted,student_house,blood_group,term_admitted,session_admitted,guardian_name,
guardian_address,guardian_phone,guardian_email,image,student_status) SELECT student_regno,first_name,
middle_name,last_name,sex,date_birth,nationality,state_origin,lga, student_class,student_classarm,student_class_admitted,student_house,blood_group,term_admitted,session_admitted,guardian_name,
guardian_address,guardian_phone,guardian_email,image,student_status FROM ".$this->table." WHERE student_status='Alumni'"; 
$insert = $this->InsertOrUpdate($this->query);

$this->que = "UPDATE users SET user_status='INACTIVE' WHERE `username`='$regno'";
 	$this->InsertOrUpdate($this->que);
 $this->q = "DELETE FROM ".$this->table." WHERE student_regno='$regno'"; 
$delete = $this->InsertOrUpdate($this->q);	
	}
	return $delete;
	}
		
	//return status as string
	function printStatus($student_status){
		return ($student_status == 1) ? 'Active' : 'Deactivated';
	}
	//function for both create and updating of students
	function Save(){
	$this->query = "SELECT `student_regno` 
	FROM
	 ".$this->table."
	  WHERE 
	  `student_regno`=
	  '".$this->student_regno."' LIMIT 1";
	  
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		//if an image is  selected
		if(!empty($this->image)){
		$this->query="UPDATE ".
		$this->table."
		 SET `first_name`='".$this->Escape($this->first_name)."',
		 `middle_name`='".$this->Escape($this->middle_name)."',
		 `last_name`='".$this->Escape($this->last_name)."',
		 `sex`='".$this->Escape($this->sex)."',
		 `date_birth`='".$this->Escape($this->date_birth)."',
		 `nationality`='".$this->Escape($this->nationality)."',
		 `state_origin`='".$this->Escape($this->state_origin)."',
		 `lga`='".$this->Escape($this->lga)."',
		 `student_class`='".$this->Escape($this->student_class)."',
		 `student_classarm`='".$this->Escape($this->student_classarm)."',
		 `student_class_admitted`='".$this->Escape($this->student_class_admitted)."',`student_house`='".$this->Escape($this->student_house)."',
`blood_group`='".$this->Escape($this->blood_group)."',
`term_admitted`='".$this->Escape($this->term_admitted)."',
`session_admitted`='".$this->Escape($this->session_admitted)."',
`guardian_name`='".$this->Escape($this->guardian_name)."',
`guardian_address`='".$this->Escape($this->guardian_address)."',
`guardian_phone`='".$this->Escape($this->guardian_phone)."',
`guardian_email`='".$this->Escape($this->guardian_email)."',	 
`image`='".$this->Escape($this->image)."',
`student_status`='".$this->Escape($this->student_status)."'
		  WHERE
		   `student_regno`='".$this->student_regno."'";
		}else{
			//when an image is not selected
		$this->query="UPDATE ".
		$this->table." SET `first_name`='".$this->Escape($this->first_name)."',
		 `middle_name`='".$this->Escape($this->middle_name)."',
		 `last_name`='".$this->Escape($this->last_name)."',
		 `sex`='".$this->Escape($this->sex)."',
		 `date_birth`='".$this->Escape($this->date_birth)."',
		 `nationality`='".$this->Escape($this->nationality)."',
		 `state_origin`='".$this->Escape($this->state_origin)."',
		 `lga`='".$this->Escape($this->lga)."',
		 `student_class`='".$this->Escape($this->student_class)."',
		 `student_classarm`='".$this->Escape($this->student_classarm)."',
		 `student_class_admitted`='".$this->Escape($this->student_class_admitted)."',`student_house`='".$this->Escape($this->student_house)."',
`blood_group`='".$this->Escape($this->blood_group)."',
`term_admitted`='".$this->Escape($this->term_admitted)."',
`session_admitted`='".$this->Escape($this->session_admitted)."',
`guardian_name`='".$this->Escape($this->guardian_name)."',
`guardian_address`='".$this->Escape($this->guardian_address)."',
`guardian_phone`='".$this->Escape($this->guardian_phone)."',
`guardian_email`='".$this->Escape($this->guardian_email)."',
`student_status`='".$this->Escape($this->student_status)."' WHERE `student_regno`='".$this->student_regno."'";
		}
		
	}else{
	$this->query ="INSERT INTO ".$this->table."
(`student_regno`,`first_name`,
`middle_name`,`last_name`,`sex`,`date_birth`,`nationality`,`state_origin`,`lga`, `student_class`,`student_classarm`,`student_class_admitted`,`student_house`,`blood_group`,`term_admitted`,`session_admitted`,`guardian_name`,
`guardian_address`,`guardian_phone`,`guardian_email`,`image`,`student_status`) 
VALUES('".$this->Escape($this->student_regno)."',
'".$this->Escape($this->first_name)."',
'".$this->Escape($this->middle_name)."',
'".$this->Escape($this->last_name)."',
'".$this->Escape($this->sex)."',
'".$this->Escape($this->date_birth)."',
'".$this->Escape($this->nationality)."',
'".$this->Escape($this->state_origin)."',
'".$this->Escape($this->lga)."',
'".$this->Escape($this->student_class)."',
'".$this->Escape($this->student_classarm)."',
'".$this->Escape($this->student_class_admitted)."',
'".$this->Escape($this->student_house)."',
'".$this->Escape($this->blood_group)."',
'".$this->Escape($this->term_admitted)."',
'".$this->Escape($this->session_admitted)."',
'".$this->Escape($this->guardian_name)."',
'".$this->Escape($this->guardian_address)."',
'".$this->Escape($this->guardian_phone)."',
'".$this->Escape($this->guardian_email)."',
'".$this->Escape($this->image)."',
'".$this->Escape($this->student_status)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);

	return $insertid;
	}
	
	
	function Save_csv(){
	
	$this->query ="INSERT INTO ".$this->table."
(`student_regno`,`first_name`,
`middle_name`,`last_name`,`sex`,`date_birth`,`nationality`,`state_origin`,`lga`, `student_class`,`student_classarm`,`student_class_admitted`,`student_house`,`blood_group`,`term_admitted`,`session_admitted`,`guardian_name`,
`guardian_address`,`guardian_phone`,`guardian_email`,`image`,`student_status`) 
VALUES('".$this->Escape($this->student_regno)."',
'".$this->Escape($this->first_name)."',
'".$this->Escape($this->middle_name)."',
'".$this->Escape($this->last_name)."',
'".$this->Escape($this->sex)."',
'".$this->Escape($this->date_birth)."',
'".$this->Escape($this->nationality)."',
'".$this->Escape($this->state_origin)."',
'".$this->Escape($this->lga)."',
'".$this->Escape($this->student_class)."',
'".$this->Escape($this->student_classarm)."',
'".$this->Escape($this->student_class_admitted)."',
'".$this->Escape($this->student_house)."',
'".$this->Escape($this->blood_group)."',
'".$this->Escape($this->term_admitted)."',
'".$this->Escape($this->session_admitted)."',
'".$this->Escape($this->guardian_name)."',
'".$this->Escape($this->guardian_address)."',
'".$this->Escape($this->guardian_phone)."',
'".$this->Escape($this->guardian_email)."',
'".$this->Escape($this->image)."',
'".$this->Escape($this->student_status)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);

	return $insertid;
	}
	
	
	//Method to delete a particular student
	function deleteStudent(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `student_regno`='".$this->Escape($this->student_regno)."'";
		return $this->Reader($this->query);
		
	}
	//Method to deactivate a particular student
	function deactivateStudent(){
		 
				$this->query = "UPDATE ".$this->table." SET `student_status`='INACTIVE' WHERE `student_regno`='".$this->Escape($this->student_regno)."'";
		return $this->Reader($this->query);
		
	}
	//check if primary key exist to avoid mysql duplicate error 
	function AvoidStudentsDuplicate(){
		$this->query = "SELECT `student_regno` FROM ".$this->table." WHERE `student_regno` = '".$this->student_regno."'";
		return $this->Query($this->query); 
	}
	
		
		
		 function GeneralViewList(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 //total number of students
		 public function totalNumberofStudents(){
			$this->query = "SELECT COUNT(student_regno) AS total_students FROM ".$this->table." WHERE `student_status`='ACTIVE'" ;
			//invokin a method from Database class that returns number of rows
			$getstudentstotal= $this->Query($this->query);
			return $getstudentstotal['total_students'];
			
 
		 }
		 
 public function viewStudentbyClassandClassarm(){
			 
$this->query = "SELECT * FROM ".$this->table." WHERE `student_class` ='".$this->Escape($this->student_class)."' AND `student_classarm`='".$this->Escape($this->student_classarm)."'";
return $this->Resultset($this->query); 
		 }
		 
public function viewActiveStudentbyClassandClassarm(){
			 
$this->query = "SELECT * FROM ".$this->table." WHERE `student_class` ='".$this->Escape($this->student_class)."' AND `student_classarm`='".$this->Escape($this->student_classarm)."' AND student_status='ACTIVE' ";
return $this->Resultset($this->query); 
		 }
		 
		public function viewStudentbyClassarm(){
			 
$this->query = "SELECT * FROM ".$this->table." WHERE  `student_classarm`='".$this->Escape($this->student_classarm)."'";
return $this->Resultset($this->query); 
		 }
		 
		function viewStudentbyClass(){
		
		$this->query = "SELECT e.class_arm_name,d.* FROM ".$this->table." d JOIN `sms_classarm` e ON d.student_classarm=e.class_arm_code WHERE d.student_class='".$this->student_class."' GROUP BY d.student_classarm";
								 						 
		 return  $this->Resultset($this->query);
						 }
						
						 

 
}
?>