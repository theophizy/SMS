<?php
include('class.Classarm.php');
class Subject extends Classarm{
	public $subject_id;
	public $subject_code;
	public $subject_name;
	public $subject_status="ACTIVE";
	public $table = "sms_subject";
	public $query;
	public $limit_code;
	public $class_limit;
	public $classarm_limit;	
	public $term_limit;	
	public $session_limit;	
	public $max_limit;	
	public $min_limit;	
	public $limit_status;
	public $table_subject_limt = "sms_subject_limit";
	function subject_offered($subject_id = '',$subject_code = '', $subject_name = '' ,$subject_status = 'ACTIVE' ,$limit_code = '',$class_limit = '',$classarm_limit = '',$term_limit = '',$session_limit = '',$max_limit = '',$min_limit = '',$limit_status = 'ACTIVE'){
		$this->subject_id = $subject_id;
		$this->subject_code = $subject_code;
		$this->subject_name = $subject_name;
		$this->subject_status = $subject_status;
		$this->limit_code = $limit_code;
		$this->class_limit = $class_limit;
		$this->classarm_limit = $classarm_limit;
		$this->term_limit = $term_limit;
		$this->session_limit = $session_limit;
		$this->max_limit = $max_limit;
		$this->min_limit = $min_limit;
	
		}
		
		
		//Method populating select drop down list eg JSS1
		
public function subjectSelectField(){
			$this->query="SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="subject">
                                  <option value="">Select Subject </option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="'.  $value['subject_id'].'">'.  $value['subject_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
			
	
		//Aviod sql duplicate entry error for classes subjects	
function avoidSubjectDuplicate(){
		$this->query = "SELECT `subject_code`,`subject_name` FROM ".$this->table." WHERE `subject_code` = '".$this->subject_code."' OR `subject_name` = '".$this->subject_name."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update 
function Save(){
	//check if the subject exist and if it does update it else create a new subject
	$this->query="SELECT `subject_id` FROM ".$this->table." WHERE `subject_id`='".$this->subject_id."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		//update if the enter subject exist
		$this->query="UPDATE ".$this->table." SET `subject_code`='".$this->Escape($this->subject_code)."',`subject_name`='".$this->Escape($this->subject_name)."' WHERE `subject_id`='".$this->subject_id."'";	
		
		//if it does not exist, create it
	}else{
	$this->query="INSERT INTO ".$this->table."(`subject_id`,`subject_code`,`subject_name`,`subject_status`) VALUES('".$this->Escape($this->subject_id)."','".$this->Escape($this->subject_code)."','".$this->Escape($this->subject_name)."','".$this->Escape($this->subject_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
		
	

	
	function deleteSubject(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `subject_id`='".$this->Escape($this->subject_id)."'";
		return $this->Reader($this->query);
		
	}
	
	
	// view availablle subjects
function viewAllSubject(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
function viewSubjectByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`subject_id`=
		'".$this->Escape($this->subject_id)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->subject_id = $value['subject_id'];
		$this->subject_code = $value['subject_code'];
	$this->subject_name = $value['subject_name'];
	
	
	}
	return $this;
	}	
	
	
	//function for both create and update 
function createSubjectLimit(){
	//check if the subject exist and if it does update it else create a new subject
	$this->query = "SELECT `limit_code` FROM ".$this->table_subject_limt." WHERE `limit_code`='".$this->limit_code."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		//update if the enter subject exist
		$this->query = "UPDATE ".$this->table_subject_limt." SET `max_limit`='".$this->Escape($this->max_limit)."',`min_limit`='".$this->Escape($this->min_limit)."' WHERE `limit_code`='".$this->limit_code."'";	
		
		//if it does not exist, create it
	}else{
	$this->query = "INSERT INTO ".$this->table_subject_limt."(`limit_code`,`class_limit`,`classarm_limit`,`term_limit`,`session_limit`,`max_limit`,`min_limit`) VALUES('".$this->Escape($this->limit_code)."','".$this->Escape($this->class_limit)."','".$this->Escape($this->classarm_limit)."','".$this->Escape($this->term_limit)."','".$this->Escape($this->session_limit)."','".$this->Escape($this->max_limit)."','".$this->Escape($this->min_limit)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	
	function deleteSubjectLimit(){
		 
				$this->query = "DELETE FROM ".$this->table_subject_limt." WHERE `limit_code`='".$this->Escape($this->limit_code)."'";
		return $this->Reader($this->query);
		
	}
	
	// view availablle subjects
function viewAllSubjectLimit(){
		
		$this->query = "SELECT * FROM ".$this->table_subject_limt."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }	
		 
		 function viewAllSubjectLimitbyClassTermandSession(){
		
		$this->query = "SELECT * FROM ".$this->table_subject_limt." WHERE `class_limit`='".$this->Escape($this->class_limit)."' AND `classarm_limit`='".$this->Escape($this->classarm_limit)."' AND `term_limit`='".$this->Escape($this->term_limit)."' AND `session_limit`='".$this->Escape($this->session_limit)."'";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }	 

 function viewAllSubjectLimitbyClassTermandSessiontobeOffered(){
		
		$this->query = "SELECT * FROM ".$this->table_subject_limt." WHERE `class_limit`='".$this->Escape($this->class_limit)."' AND `classarm_limit`='".$this->Escape($this->classarm_limit)."' AND `term_limit`='".$this->Escape($this->term_limit)."' AND `session_limit`='".$this->Escape($this->session_limit)."'";
								 						 
		foreach($this->Resultset($this->query) as $key => $val){
		
		$this->max_limit = $val['max_limit'];
		$this->min_limit = $val['min_limit'];
		}
		 return $this; 
		 }
		 	 
		 
 function viewAllSubjectLimitbyTermandSession(){
		
		$this->query = "SELECT * FROM ".$this->table_subject_limt." WHERE  `term_limit`='".$this->Escape($this->term_limit)."' AND `session_limit`='".$this->Escape($this->session_limit)."'";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }	

function viewAllSubjectLimitbyLimitcode(){
		
		$this->query = "SELECT * FROM ".$this->table_subject_limt." WHERE `limit_code`='".$this->Escape($this->limit_code)."'";
	foreach($this->Resultset($this->query) as $key => $val){
		$this->limit_code = $val['limit_code'];
		$this->class_limit = $val['class_limit'];
		$this->classarm_limit = $val['classarm_limit'];
		$this->term_limit = $val['term_limit'];
		$this->session_limit = $val['session_limit'];
		$this->max_limit = $val['max_limit'];
		$this->min_limit = $val['min_limit'];
		$this->limit_status = $val['limit_status'];
		
	}
								   
		return $this; 
		 }	
		 
		 //Aviod sql duplicate entry error for classes subjects	
function avoidSubjectLimitDuplicate(){
		$this->query = "SELECT `limit_code` FROM ".$this->table_subject_limt." WHERE `limit_code` = '".$this->limit_code."'";
		return $this->Query($this->query); 
	}
}



?>