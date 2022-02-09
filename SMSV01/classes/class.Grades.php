<?php
include('class.Subject.php');
class Grade extends Subject{
	
	public $grade_code;
	public $grade_min_mark;
	public $grade_max_mark;
	public $grade_name;
	public $grade_remark;
	public $exam_code;
	public $exam_name;
	public $exam_marks;
	public $exam_status;
	public $grade_status="ACTIVE";
	public $table="sms_grade";
	public $examtype_table="sms_exam_type";
	public $query;
	
	function grades($grade_code='',$grade_min_mark='', $grade_max_mark='',$grade_name='',$grade_remark='',$grade_status='ACTIVE', $exam_code = '',$exam_name = '',$exam_marks = ''){
		$this->grade_code = $grade_code;
		$this->grade_min_mark = $grade_min_mark;
		$this->grade_max_mark = $grade_max_mark;
		$this->grade_name = $grade_name;
		$this->grade_remark = $grade_remark;
		$this->grade_status = $grade_status;
		$this->exam_code = $exam_code;
		$this->exam_name = $exam_name;
		$this->exam_marks = $exam_marks;
		$this->exam_status = $grade_status;
		}
		
		
		//check for already existing grade to avoid sql duplicate error
	function AvoidGradeDuplicate(){
		$this->query = "SELECT * FROM ".$this->table." WHERE `grade_name` = '".$this->grade_name."' OR `grade_remark` = '".$this->grade_remark."'";
		return $this->Query($this->query); 
	}
	//function for both create and update
	
function Save(){
	//check if the subject exist and if it does update it else create a new subject
	$this->query = "SELECT `grade_code` FROM ".$this->table." WHERE `grade_code`='".$this->grade_code."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		//update if the enter subject exist
		$this->query="UPDATE ".$this->table." SET `grade_min_mark`='".$this->Escape($this->grade_min_mark)."',`grade_max_mark`='".$this->Escape($this->grade_max_mark)."',`grade_name`='".$this->Escape($this->grade_name)."',`grade_remark`='".$this->Escape($this->grade_remark)."' WHERE `grade_code`='".$this->grade_code."'";	
		
		//if it does not exist, create it
	}else{
	$this->query = "INSERT INTO ".$this->table."(`grade_min_mark`,`grade_max_mark`,`grade_name`,`grade_remark`,`grade_status`) VALUES('".$this->Escape($this->grade_min_mark)."','".$this->Escape($this->grade_max_mark)."','".$this->Escape($this->grade_name)."','".$this->Escape($this->grade_remark)."','".$this->Escape($this->grade_status)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	
	function deleteGrade(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `grade_code`='".$this->Escape($this->grade_code)."'";
		return $this->Reader($this->query);
		
	}
	
	// view availablle subjects
function viewAllGrades(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
function viewGradeByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`grade_code`=
		'".$this->Escape($this->grade_code)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->grade_code = $value['grade_code'];
	$this->grade_min_mark = $value['grade_min_mark'];
	$this->grade_max_mark = $value['grade_max_mark'];
	$this->grade_name = $value['grade_name'];
	$this->grade_remark = $value['grade_remark'];
	$this->grade_status = $value['grade_status'];
	
	
	}
	return $this;
	}		 
function SaveExamType(){
	//check if the subject exist and if it does update it else create a new subject
	
		//update if the enter subject exist
		$this->query = "UPDATE ".$this->examtype_table." SET `exam_name`='".$this->Escape($this->exam_name)."',`exam_marks`='".$this->Escape($this->exam_marks)."' WHERE `exam_code`='".$this->exam_code."'";	
	
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	function viewExamTypeByID($id){
		$this->query = "SELECT * FROM ".
		$this->examtype_table." WHERE 
		`exam_code`=
		'$id'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->exam_code = $value['exam_code'];
	$this->exam_name = $value['exam_name'];
	$this->exam_marks = $value['exam_marks'];
	$this->exam_name = $value['exam_name'];
	$this->exam_status = $value['exam_status'];
	
	}
	return $this;
	}		 
function viewAllExamType(){
		
		$this->query = "SELECT * FROM ".$this->examtype_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 function getStudentGrade($score_total){
			 $this->query = "SELECT grade_code,	grade_min_mark,grade_max_mark FROM ".$this->table."";
		 foreach($this->Resultset($this->query) as $keys => $gravevalue){
			//get minimum score from the grade table
			$minimun_grade = $gravevalue['grade_min_mark'];
			//get maximum score from the grade table
				$max_grade = $gravevalue['grade_max_mark'];
				//get student's grade based on his total marks obtained
				if($score_total >= $minimun_grade && $score_total <= $max_grade)
			$gradecode = $gravevalue['grade_code'];
}
return $gradecode;


		 }
		 
		 }


?>