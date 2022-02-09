<?php
include('class.Grades.php');
class SchoolSetup extends Grade  {
	// set parameters
	public $school_id;
	public $school_name;
	public $school_address;
	public $school_logo;
	public $school_phone;
	public $school_email;
	public $school_status = "ACTIVE";
	public $table="sms_school_setup";
	public $query;
	public $cog_id;
	public $cog_name;
	public $cog_status = "ACTIVE";
	public $cog_table = "sms_cognitive";
	public $cog_student_id;
	public $cog_student_reg;
	public $cognitive_id;
	public $cog_student_class;
	public $cog_student_session;
	public $cog_student_term;
	public $cog_student_status;
	public $cog_student_item;
	public $next_id;
	public $next_date;
	public $duration_id;
	public $duration_term;
	public $duration_session;
	public $start_date;
	public $end_date;
	public $remark_code;	
	public $remark_min_mark;	
	public $remark_max_mark;	
	public $remark;

	public $cog_student_table ="sms_cognitive_student";
	public $cog_history_student_table = "sms_cognitive_student_history";
	public $next_term_table = "sms_next_term";
	public $score_duration_table = "sms_scores_duration";	
	public $formmaster_remark_table = "sms_formaster_remark";
	public $principal_remark_table = "sms_principal_remark";
	public $days_schoolopen_table = "sms_day_schoolopened";
	public $days_school_opened;
	public $schoolopen_id ; 
	
	
function sch_setup($school_id = '', $school_name = '', $school_address = '', 	 $school_logo = '', $school_phone = '', $school_email = '',$school_status = 'ACTIVE', $cog_id = '', $cog_name = '',    	 $cog_status = 'ACTIVE',$cog_student_id = '',$cog_student_reg = '',$cognitive_id = '',$cog_student_item = '',$cog_student_class = '',$cog_student_session = '',$cog_student_term = '',$cog_student_status ='ACTIVE', $next_id = '' , $next_date = '', $duration_id = '', $duration_term = '', $duration_session = '', $start_date = '', $end_date = '', $remark_code = '', $remark_min_mark = '', $remark_max_mark = '', $remark = '', $days_school_opened  = '', $schoolopen_id  = ''){
		$this->school_id=$school_id;
		$this->school_name=$school_name;
		$this->school_address=$school_address;
		$this->school_logo=$school_logo;
		$this->school_phone = $school_phone;
		$this->school_email = $school_email;
		$this->school_status=$school_status;
		$this->cog_id = $cog_id;
		$this->cog_name = $cog_name;
		$this->cog_status = $cog_status;
		$this->cog_student_id = $cog_student_id;
		$this->cog_student_reg = $cog_student_reg;
		$this->cognitive_id = $cognitive_id;
		$this->cog_student_item = $cog_student_item;
		$this->cog_student_class = $cog_student_class;
		$this->cog_student_session = $cog_student_session;
		$this->cog_student_term = $cog_student_term;
		$this->cog_student_status = $cog_student_status;
		$this->next_id = $next_id;
		$this->next_date = $next_date;
		$this->duration_id = $duration_id;
		$this->duration_term = $duration_term;
		$this->duration_session = $duration_session;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->remark_code = $remark_code;
		$this->remark_min_mark = $remark_min_mark;
		$this->remark_max_mark = $remark_max_mark;
		$this->remark = $remark;
		
		$this->days_school_opened = $days_school_opened;
		$this->schoolopen_id = $schoolopen_id;
		}
		
	
	//function for both create and update 
function Save(){
	
	if(empty($this->school_logo)){
		$this->query = "UPDATE ".$this->table." SET `school_name`='".$this->Escape    ($this->school_name)."',`school_address`='".$this->Escape($this->school_address)."',`school_phone`='".$this->Escape($this->school_phone)."',`school_email`='".$this->Escape($this->school_email)."' WHERE `school_id`='".$this->Escape($this->school_id)."'";	
		
		
	}else{
	$this->query = "UPDATE ".$this->table." SET `school_name`='".$this->Escape($this->school_name)."',`school_address`='".$this->Escape($this->school_address)."',`school_logo`='".$this->Escape($this->school_logo)."',`school_phone`='".$this->Escape($this->school_phone)."',`school_email`='".$this->Escape($this->school_email)."' WHERE `school_id`='".$this->Escape($this->school_id)."'";	
		
	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
			//List all available class arms
function viewSchoolSetup(){
				
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 foreach($this->Resultset($this->query ) as $key => $values){
			  $this->school_id = $values['school_id'];
			 $this->school_name = $values['school_name'];
			  $this->school_address = $values['school_address'];
			   $this->school_phone = $values['school_phone'];
			    $this->school_email = $values['school_email'];
				 $this->school_logo = $values['school_logo'];
			 }
				return $this;				   
		 
		 }
		 
		 
 function createCognitiveSkills(){
	//check if the class arm exist and if it does update it else create a new class
	$this->query="SELECT `cog_id` FROM ".$this->cog_table." WHERE `cog_id`='".   $this->cog_id."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		
		$this->query="UPDATE ".$this->cog_table." SET `cog_name`='".$this->Escape($this->cog_name)."' WHERE `cog_id`='".$this->cog_id."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->cog_table."(`cog_name`,`cog_status`) VALUES('".$this->Escape($this->cog_name)."','".$this->Escape($this->cog_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function AvoidDaysSchoolopenedduplicate(){
		$this->query = "SELECT `schoolopen_id` FROM ".$this->days_schoolopen_table." WHERE `schoolopen_id`='".$this->Escape($this->schoolopen_id)."'";
		return $this->Query($this->query); 
	}

	function createdaysSchoolOpened(){
	//check if the class arm exist and if it does update it else create a new class
	$this->query="SELECT `schoolopen_id` FROM ".$this->days_schoolopen_table." WHERE `schoolopen_id`='". $this->schoolopen_id."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		
		$this->query = "UPDATE ".$this->days_schoolopen_table." SET `days_school_opened`='".$this->Escape($this->days_school_opened)."' WHERE `schoolopen_id`='".$this->schoolopen_id."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->days_schoolopen_table."(`schoolopen_id`,`term_id`,`session_id`,`days_school_opened`) VALUES('".$this->Escape($this->schoolopen_id)."','".$this->Escape($this->cog_student_term)."','".$this->Escape($this->cog_student_session)."','".$this->Escape($this->days_school_opened)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
function viewAllDaysSchoolOpened(){
				
		$this->query = "SELECT * FROM ".$this->days_schoolopen_table."";
								 						 
				 return  $this->Resultset($this->query);
		

				
		 }
		 
		  function viewSchoolOpenedbyID(){
				
		$this->query = "SELECT * FROM ".$this->days_schoolopen_table." WHERE `schoolopen_id`='".$this->Escape($this->schoolopen_id)."'";
			 foreach($this->Resultset($this->query ) as $key => $values){
			  $this->schoolopen_id = $values['schoolopen_id'];
			 $this->days_school_opened = $values['days_school_opened'];
			  $this->cog_student_term = $values['term_id'];
			   $this->cog_student_session = $values['session_id'];
			  
			 }
				return $this;						 						 
		 }
	
	function createNextTerm(){
	//check if the subject exist and if it does update it else create a new subject
	/*$this->query = "SELECT `next_id` FROM ".$this->next_term_table." WHERE `next_id`='".$this->next_id."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){*/
		//update if the enter subject exist
		$this->query="UPDATE ".$this->next_term_table." SET `next_date`='".$this->Escape($this->next_date)."' WHERE `next_id`='".$this->next_id."'";	
		
		//if it does not exist, create it
	/*}else{
	$this->query = "INSERT INTO ".$this->next_term_table."(`next_date`) VALUES('".$this->Escape($this->next_date)."')";	
	}*/
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}

	
function AvoidCognitiveSkillsDuplicate(){
		$this->query = "SELECT `cog_name` FROM ".$this->cog_table." WHERE `cog_name`='".$this->Escape($this->cog_name)."'";
		return $this->Query($this->query); 
	}
	
function viewAllCognitiveSkills(){
				
		$this->query = "SELECT * FROM ".$this->cog_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 //view next term begin date
		 function viewNextTermBegin(){
				
		$this->query = "SELECT * FROM ".$this->next_term_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		 function viewAllCognitiveSkillswithOffset($limit,$offset){
				
		$this->query = "SELECT * FROM ".$this->cog_student_table." WHERE `cog_student_reg`='".$this->Escape($this->cog_student_reg)."' AND `cog_student_class`='".$this->Escape($this->cog_student_class)."' AND `cog_student_session`='".$this->Escape($this->cog_student_session)."' AND `cog_student_term`='".$this->Escape($this->cog_student_term)."' LIMIT $limit OFFSET $offset";
								 						 
		 return  $this->Resultset($this->query);
		
		 }
		  function viewAllHistoryCognitiveSkillswithOffset($limit,$offset){
				
		$this->query = "SELECT * FROM ".$this->cog_history_student_table." WHERE `cog_student_reg`='".$this->Escape($this->cog_student_reg)."' AND `cog_student_class`='".$this->Escape($this->cog_student_class)."' AND `cog_student_session`='".$this->Escape($this->cog_student_session)."' AND `cog_student_term`='".$this->Escape($this->cog_student_term)."' LIMIT $limit OFFSET $offset";
								 						 
		 return  $this->Resultset($this->query);
		
					   
		 
		 }

function deleteCognitiveSkills(){
				
		$this->query = "DELETE FROM ".$this->cog_table." WHERE `cog_id`='".$this->Escape($this->cog_id)."'";
								 						 
		return $this->Reader($this->query);
								   
		 
		 }	
		 
		 function viewCog_student_skills(){
		$this->query = "SELECT * FROM ". $this->cog_table." WHERE 
		`cog_id`='".$this->Escape($this->cog_id)."'";
	//invoke method to return the array of the fetched result from the database class
		
foreach($this->Resultset($this->query) as $key => $value){
		$this->cog_id=$value['cog_id'];
	$this->cog_name=$value['cog_name'];
	
	}
	return $this;
	}
	function view_studentCognitiveBySession(){
			$this->query = "SELECT * FROM 
			 " .$this->cog_student_table."
			  WHERE
			    `cog_student_session` = '".$this->Escape($this->cog_student_session)."'";
			  
 return $this->Resultset($this->query);
			   }
	
	function movePsychomotiveskillstoHistoryTable(){
	$this->query = "INSERT INTO sms_cognitive_student_history(cog_student_id,cog_student_reg,cognitive_id,cog_student_item,cog_student_class,cog_student_session,cog_student_term,cog_student_status) SELECT cog_student_id,cog_student_reg,cognitive_id,cog_student_item,cog_student_class,cog_student_session,cog_student_term,cog_student_status FROM sms_cognitive_student WHERE cog_student_class='".$this->Escape($this->cog_student_class)."'";	
		
	$insert = $this->InsertOrUpdate($this->query);
	if($insert === true){
	$que = "DELETE FROM ".$this->cog_student_table." WHERE cog_student_class='".$this->Escape($this->cog_student_class)."'";
$delete = $this->Reader($que);	
	}
		
	return $delete;	
	}
	
	function viewAllStudentCognitive(){
			$this->query = "SELECT * FROM 
			 " .$this->cog_student_table."";
			  
 return $this->Resultset($this->query);
			   }
 function viewAllStudentCognitiveDistinct(){
			$this->query = "SELECT DISTINCT(cog_student_class) FROM 
			 " .$this->cog_student_table." ORDER BY cog_student_class ASC";
			  
 return $this->Resultset($this->query);
			   }
			   
function viewAllStudentCognitivebyclasscode(){
			$this->query = "SELECT * FROM 
			 " .$this->cog_student_table." WHERE cog_student_class='".$this->Escape($this->cog_student_class)."'";
			  
 return $this->Resultset($this->query);
			   }
			   
function deletestudentCognitiveByID(){
		 
	$this->query = "DELETE FROM ".$this->cog_student_table." WHERE cog_student_id='".$this->Escape($this->cog_student_id)."'";
return $this->Reader($this->query);

}
 function view_cognitivebySessionIfExist(){
			$this->query = "SELECT * FROM 
			 " .$this->cog_student_table."
			  WHERE
			    `cog_student_session` !='".$this->Escape($this->cog_student_session)."'";
			  
 return $this->Read($this->query);
			   }
			   
	/*function deletestudentCognitiveByID(){
		 
	$this->query = "DELETE FROM ".$this->cog_student_table." WHERE `cog_student_id`='".$this->Escape($this->cog_student_id)."'";
return $this->Reader($this->query);

}*/
	/* function viewCog_history_student_skills(){
		$this->query = "SELECT * FROM ". $this->cog_history_student_table." WHERE 
		`cog_id`='".$this->Escape($this->cog_id)."'";
	//invoke method to return the array of the fetched result from the database class
		
foreach($this->Resultset($this->query) as $key => $value){
		$this->cog_id=$value['cog_id'];
	$this->cog_name=$value['cog_name'];
	
	}
	return $this;
	}*/
	
	function datediff($todaydate,$startdate,$enddate){
		
		$diff  = round((strtotime($startdate) - strtotime($todaydate))/86400);
	$diff2  = round((strtotime($enddate) - strtotime($todaydate))/86400);
	//echo $diff."==".$diff2 ;
	if($diff <= 0 && $diff2 >= 0 )
	$result = "show";
	else
	$result = "hide";
	return $result;
		}
		
		function createScoreDuration(){
	//check if the term_code exist and if it does update it else create a new term
	$this->query = "SELECT `duration_term`,`duration_session` FROM ".$this->score_duration_table." WHERE `duration_term`='".$this->duration_term."' AND `duration_session`='".$this->duration_session."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		
		$this->query = "UPDATE ".$this->score_duration_table." SET `duration_term`='".$this->Escape($this->duration_term)."',`duration_session`='".$this->Escape($this->duration_session)."',`start_date`='".$this->Escape($this->start_date)."',`end_date`='".$this->Escape($this->end_date)."' WHERE `duration_id`='".$this->duration_id."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->score_duration_table."(`duration_term`,`duration_session`,`start_date`,`end_date`) VALUES('".$this->Escape($this->duration_term)."','".$this->Escape($this->duration_session)."','".$this->Escape($this->start_date)."','".$this->Escape($this->end_date)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function view_score_durationByTermandSession(){
			$this->query = "SELECT * FROM 
			 " .$this->score_duration_table."
			  WHERE
			    `duration_term`='".$this->Escape($this->duration_term)."' AND `duration_session`='".$this->Escape($this->duration_session)."'";
			  
 return $this->Resultset($this->query);
			   }
			   
 function viewAllScoreDuration(){
			$this->query = "SELECT * FROM 
			 " .$this->score_duration_table."";
			  
 return $this->Resultset($this->query);
			   }
			   
 function AvoidScoreDurationDuplicate(){
		$this->query = "SELECT * FROM 
			 " .$this->score_duration_table."
			  WHERE
			    `duration_term`='".$this->Escape($this->duration_term)."' AND `duration_session`='".$this->Escape($this->duration_session)."'";
		return $this->Query($this->query); 
	}
	
	
	function createFormmasterRemark(){
	//check if the term_code exist and if it does update it else create a new term
	$this->query = "SELECT `remark_code` FROM ".$this->formmaster_remark_table." WHERE `remark_code`='".$this->remark_code."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		
		$this->query = "UPDATE ".$this->formmaster_remark_table." SET `remark_min_mark`='".$this->Escape($this->remark_min_mark)."',`remark_max_mark`='".$this->Escape($this->remark_max_mark)."',`remark`='".$this->Escape($this->remark)."' WHERE `remark_code`='".$this->remark_code."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->formmaster_remark_table."(`remark_min_mark`,`remark_max_mark`,`remark`) VALUES('".$this->Escape($this->remark_min_mark)."','".$this->Escape($this->remark_max_mark)."','".$this->Escape($this->remark)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	
	function view_form_MastersRemarkByTermandSession(){
			$this->query = "SELECT * FROM 
			 " .$this->formmaster_remark_table."
			 ";
			  
 return $this->Resultset($this->query);
			   }
			   
	function getStudentRemarkByTermandSession($student_average){
			$this->query = "SELECT * FROM 
			 " .$this->formmaster_remark_table."
			 ";
			  
foreach($this->Resultset($this->query) as $key => $val){
	$student_remark;
	$this->remark_min_mark = $val['remark_min_mark'];
	$this->remark_max_mark = $val['remark_max_mark'];
	if($student_average >= $this->remark_min_mark && $student_average <= $this->remark_max_mark){
		$student_remark = $val['remark'];
		
		}
	
	}
	return $student_remark;
			   }

			   
function viewAllFormmasterRemark(){
			$this->query = "SELECT * FROM 
			 " .$this->formmaster_remark_table."";
			  
 return $this->Resultset($this->query);
			   }
			   
			  
	function createPrincipalRemark(){
	//check if the term_code exist and if it does update it else create a new term
	$this->query = "SELECT `remark_code` FROM ".$this->principal_remark_table." WHERE `remark_code`='".$this->remark_code."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		
		$this->query = "UPDATE ".$this->principal_remark_table." SET `remark_min_mark`='".$this->Escape($this->remark_min_mark)."',`remark_max_mark`='".$this->Escape($this->remark_max_mark)."',`remark`='".$this->Escape($this->remark)."' WHERE `remark_code`='".$this->remark_code."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->principal_remark_table."(`remark_min_mark`,`remark_max_mark`,`remark`) VALUES('".$this->Escape($this->remark_min_mark)."','".$this->Escape($this->remark_max_mark)."','".$this->Escape($this->remark)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function view_principalRemarkByTermandSession(){
			$this->query = "SELECT * FROM 
			 " .$this->principal_remark_table."
			";
			  
 return $this->Resultset($this->query);
			   }
			   
			   
function getStudentPrincipalRemarkByTermandSession($student_average){
	
			$this->query = "SELECT * FROM 
			 " .$this->principal_remark_table."
			 ";
			  
foreach($this->Resultset($this->query) as $key => $val){
	$student_remark;
	$this->remark_min_mark = $val['remark_min_mark'];
	$this->remark_max_mark = $val['remark_max_mark'];
	if($student_average >= $this->remark_min_mark && $student_average <= $this->remark_max_mark){
		$student_remark = $val['remark'];
		
		}
	
	}
	return $student_remark;
			   }
			   
 function viewAllPrincipalRemark(){
			$this->query = "SELECT * FROM 
			 " .$this->principal_remark_table."";
			  
 return $this->Resultset($this->query);
			   }
			   
			   
	function getPrincipal(){
	$this->query = "SELECT users.username,sms_staff.staff_first_name,sms_staff.staff_last_name FROM users JOIN sms_staff ON users.username = sms_staff.staff_id WHERE users.role = 'Principal'";
	 foreach($this->Resultset($this->query) as $key => $val){
	 $principal_name = $val['staff_first_name']."   ".$val['staff_last_name'];	 
 }
 return $principal_name;
}	

}



?>