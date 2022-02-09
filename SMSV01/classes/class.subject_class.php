<?php
include('class.Database.php');
class Subject_class extends Database{
	public $class_sub_code;
	public $class_sub_class_code;
	public $class_sub_subject_code;
	public $class_sub_status="ACTIVE";
	public $table="sms_class_subjects";
	public $query;
	
	function subject_classess($class_sub_code='', $class_sub_class_code='',$class_sub_subject_code='',$class_sub_status='ACTIVE'){
		$this->class_sub_code=$class_sub_code;
		$this->class_sub_class_code=$class_sub_class_code;
		$this->class_sub_subject_code=$class_sub_subject_code;
		
		$this->class_sub_status=$class_sub_status;
		}
		
		
		//Method populating select drop down list eg JSS1
	
		//Aviod sql duplicate entry error for classes	
function AvoidClassSubjectDuplicate($subjectcode,$classcode){
	for($i=0;$i<count($subjectcode);$i++){
		$subjcode=$subjectcode[$i];
		$code=$subjcode.$classcode.$classarm;
		$this->query = "SELECT `class_sub_code` FROM ".$this->table." WHERE `class_sub_code`= '$code'";
		 $getit=$this->Query($this->query);
	}
		return $getit; 
	}
	
	//function for both create and update claasses eg JSS1,SS1 etc
function Save(){
	//check if the class_code exist and if it does update it else create a new clas

		//logic to insert the selected subjects
		
		
	$this->query="INSERT INTO ".$this->table."(`class_sub_code`,`class_sub_class_code`,`class_sub_subject_code`,`class_sub_status`) VALUES('".$this->class_sub_code."','".$this->class_sub_class_code."','".$this->class_sub_subject_code."','".$this->class_sub_status."')";	
	
		
	
		
	return $this->query;
	}
	
	//delete binded subject
	function deleteClassSubject(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `class_sub_code`='".$this->Escape($this->class_sub_code)."'";
		return $this->Reader($this->query);
		
	}
			//view subjects that are binded to a class by class and its arm
function viewBindedSujectToClass($class_sub_class_code){
		
		$this->query = "SELECT * FROM ".$this->table." WHERE `class_sub_class_code`='$class_sub_class_code'";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 

		 
		//select class arm based on the class selected 
function binded_subject_classarm_field(){
		
		$this->query = "SELECT b.*,c.class_arm_name FROM ".$this->table." b JOIN `sms_classarm`c ON b.class_sub_class_arm=c.class_arm_code WHERE b.class_sub_class_code='".$this->class_sub_class_code."' GROUP BY b.class_sub_class_arm";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 // select subject based on the class selected function
function binded_subject_class_field(){
		
		$this->query = "SELECT d.*,e.subject_name FROM ".$this->table." d JOIN `sms_subject`e ON d.class_sub_subject_code=e.subject_id WHERE d.class_sub_class_code='".$this->class_sub_class_code."'";
								 						 
		 return  $this->Resultset($this->query);
						 }
						
						 


}


?>