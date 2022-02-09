<?php
include('class.bank.php');
class ScoresHistory extends Bank{
	//class attributes
	public $score_code; //concat studentregno+subject_code+class+class_arm+session+term
	public $score_student_regno;
	public $score_subject_code;
	public $score_class;
	public $score_class_arm;
	public $score_CA1;
	public $score_CA2;
	public $score_CA3;
	public $score_exam;
	public $score_total;
	public $score_grade;
	public $score_term;
	public $score_session;
	public $score_by;
	public $score_date;
	public $table = "sms_scores_history";
	public $query;
	//parameters for sms_average scores
	
	public $avg_code;	
	public $student_no;	
	public $avg_total_marks;
	public $table_avg = "sms_average_scores";
	public $public_table = "sms_publis_result";
	public $avg_class;
	public $avg_class_arm
	;public $avg_term;
	public $avg_session;
	public $student_average;
    public $attendance;
    public $days_school_opened;
    public $result_view;
	 public $total_subjects_student;
	// constructor
	function studentScores($score_code = '', $score_student_regno = '',  $score_subject_code = '', $score_class = '', $score_class_arm = '', $score_CA1 = '', $score_CA2 = '',$score_CA3 = '',  $score_exam = '', $score_total = '', $score_grade = '',$score_term = '', $score_session = '', $score_by = '', $score_date = '',$avg_code='',$avg_class='',$avg_class_arm='',$avg_term='',$avg_session='',$avg_total_marks='' ,$student_average='', $attendance = '', $days_school_opened = '' , $result_view = ''){
		//set values to  parameters 
		$this->score_code = $score_code;
		$this->score_student_regno = $score_student_regno;
		$this->score_subject_code = $score_subject_code;
		$this->score_class = $score_class;
		$this->score_class_arm = $score_class_arm;
		$this->score_CA1 = $score_CA1;
		$this->score_CA2 = $score_CA2;
		$this->score_CA3 = $score_CA3;
		$this->score_exam = $score_exam;
		$this->score_total = $score_total;
		$this->score_grade = $score_grade;
		
		$this->score_term = $score_term;
		$this->score_session  = $score_session;
		$this->score_by = $score_by;
		$this->score_date = $score_date;
		$this->avg_code = $avg_code;
		$this->avg_class = $avg_class;
		$this->avg_class_arm = $avg_class_arm;
		$this->avg_term = $avg_term;
		$this->avg_session = $avg_session;
		$this->avg_total_marks = $avg_total_marks;
		$this->student_average = $student_average;
		$this->attendance = $attendance;
		$this->days_school_opened = $days_school_opened;
		$this->result_view = $result_view;
	}
	//check for already existing scores to avoid sql duplicate error
	function AvoidScoreDuplicate(){
		 $db = new Database();
		$this->query = "SELECT `score_code` FROM ".$this->table." WHERE `score_code` = '".$this->score_code."'";
		return $db->Query($this->query); 
	}


	public function updateAssessments(){
		 $db = new Database();
$this->query = "UPDATE " .$this->table."
SET `score_CA1`='".$db->Escape($this->score_CA1)."',`score_CA2`='".$db->Escape($this->score_CA2)."',`score_CA3`='".$db->Escape($this->score_CA3)."',`score_exam`='".$db->Escape($this->score_exam)."',`score_total`='".$db->Escape($this->score_total)."',`score_by`='".$db->Escape($this->score_by)."' WHERE `score_code` ='".$db->Escape($score_code)."'";
$db->Reader($this->query);

	}
	//create a new scores or update an existing scores publis_code	publis_class	publis_classarm	publis_term	publis_session
		//check for already existing scores to avoid sql duplicate error
	function AvoidPublisDuplicate($publis_code){
		 $db = new Database();
		$this->query = "SELECT `publis_code` FROM ".$this->public_table." WHERE `publis_code` ='$publis_code'";
		return $db->Query($this->query); 
	}
	
	public function publisResult($publis_code){
		 $db = new Database();
	$this->query ="INSERT INTO ".$this->public_table."(`publis_code`,`publis_class`,
`publis_classarm`,`publis_term`,`publis_session`,`publis_by`,`publis_date`) VALUES('$publis_code',
'".$db->Escape($this->score_class)."',
'".$db->Escape($this->score_class_arm)."',
'".$db->Escape($this->score_term)."',
'".$db->Escape($this->score_session)."',
'".$db->Escape($this->score_by)."',
'".$db->Escape($this->score_date)."')";	
	
	$insertid=$db->InsertOrUpdate($this->query);

	return $insertid;
		
		
		}		
	
	
function view_scoresbyScoreCode(){
	 $db = new Database();
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND
				  `score_subject_code`='".$db->Escape($this->score_subject_code)."' AND`score_term`='".$db->Escape($this->score_term)."'AND `score_session` = '".$db->Escape($this->score_session)."'";
			  
 return $db->Resultset($this->query);
			   }
			//view student result for the selected term,session,class,clas arm   
 function view_scoresbystudent(){
	 $db = new Database();
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND
				  `score_student_regno`='".$db->Escape($this->score_student_regno)."' AND`score_term`='".$db->Escape($this->score_term)."'AND `score_session` = '".$db->Escape($this->score_session)."' AND `score_total` > 0";
			  
 return $db->Resultset($this->query);
			   }
	//check if the selected term, session, class and class arm has scores
	function view_scoresbyTermSessionClass(){
		//include('class.Database.php');
		$db = new Database();
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db ->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db ->Escape($this->score_class_arm)."'
				 AND
				  `score_term`='".$db ->Escape($this->score_term)."'AND `score_session` = '".$db ->Escape($this->score_session)."'";
			  
 return $db ->Resultset($this->query);
			   }
	
	
	//view class result function
		function view_class_result(){
			 $db = new Database();
			$this->query = "SELECT DISTINCT(score_subject_code),`score_by` FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND`score_term`='".$db->Escape($this->score_term)."'
				 AND `score_session` = '".$db->Escape($this->score_session)."'";
			  
 return $db->Resultset($this->query);
			   }
			   
 function view_students_scores_class(){
	  $db = new Database();
			$this->query = "SELECT DISTINCT(score_student_regno) FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND`score_term`='".$db->Escape($this->score_term)."'
				 AND `score_session` = '".$db->Escape($this->score_session)."'";
			  
 return $db->Resultset($this->query);
			   }
	   
	 function view_students_scores_foreach_subject(){
		  $db = new Database();
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND`score_term`='".$db->Escape($this->score_term)."'
				 AND`score_student_regno`='".$db->Escape($this->score_student_regno)."'
				 AND`score_subject_code`='".$db->Escape($this->score_subject_code)."'
				 AND `score_session` = '".$db->Escape($this->score_session)."'";
			  
 return $db->Resultset($this->query);
			   }		   
function position_in_class($student_admission_number){
	 $db = new Database(); 
$printedposition=0;
$currenttotalscores=0;
$position=0;
$next=0;
$this->query = "SELECT * FROM ".$this->table_avg." WHERE `avg_class`='".$db->Escape($this->avg_class)."' AND `avg_class_arm`='".$db->Escape($this->avg_class_arm)."' AND `avg_term`='".$db->Escape($this->avg_term)."' AND `avg_session`='".$db->Escape($this->avg_session)."' ORDER BY `avg_total_marks` DESC";
		 foreach($db->Resultset($this->query) as $key => $val){
			 $student_total_scores = $val['avg_total_marks'];
			 $student_regno = $val['student_no'];
			

		//compute student position in a subject	
if($student_total_scores == $currenttotalscores){
	$position=$printedposition;
	$next +=1;
	
}else{
	$position=$next+1;
	$next++;
}
$currenttotalscores=$student_total_scores;
$printedposition=$position;
if($student_admission_number ==  $student_regno){
	$student_position =$printedposition;
	}


			 }
	return $student_position;
			 }
	
	
	
			
			function print_suffix($printedposition){
	if($printedposition<20){
	switch ($printedposition){
	case 1:
	$print='<sup>st</sup>';
	break;
	case 2:
	$print='<sup>nd</sup>';
	break;
	case 3:
	$print='<sup>rd</sup>';
	break;
	default:
	$print='<sup>th</sup>';
}
}elseif($printedposition<=100){
$reduce=substr($position,1);
switch ($reduce){
	case 1:
	$print='<sup>st</sup>';
	break;
	case 2:
	$print='<sup>nd</sup>';
	break;
	case 3:
	$print='<sup>rd</sup>';
	break;
	default:
	$print='<sup>th</sup>';
}
}elseif($printedposition<1000){
$reduce=substr($position,2);
switch ($reduce){
	case 1:
	$print='<sup>st</sup>';
	break;
	case 2:
	$print='<sup>nd</sup>';
	break;
	case 3:
	$print='<sup>rd</sup>';
	break;
	default:
	$print='<sup>th</sup>';
}	
}
	return $print;		
			}
			//view students total marks obtained in a exams by term, session, class and class arm 
			function viewStudentTotalMarksObtainedByRegno(){
				 $db = new Database();
		$this->query = "SELECT * FROM ".
		$this->table_avg." WHERE 
		`avg_code`=
		'".$db->Escape($this->avg_code)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($db->Resultset($this->query) as $key => $value){
		$this->avg_total_marks = $value['avg_total_marks'];
	$this->attendance = $value['attendance'];
	$this->days_school_opened = $value['days_school_opened'];
	$this->result_view = $value['result_view'];
	}
	return $this;
	}
	
	function position_in_subject($student_admission_number){ 
	 $db = new Database();
$printedposition=0;
$currenttotalscores=0;
$position=0;
$nextposition=0;
$this->query = "SELECT * FROM ".$this->table." WHERE `score_class`='".$db->Escape($this->score_class)."' AND `score_class_arm`='".$db->Escape($this->score_class_arm)."' AND `score_term`='".$db->Escape($this->score_term)."' AND `score_subject_code`='".$db->Escape($this->score_subject_code)."' AND `score_session`='".$db->Escape($this->score_session)."' ORDER BY `score_total` DESC";
		 foreach($db->Resultset($this->query) as $key => $val){
			 $student_total_scores = $val['score_total'];
			 $student_regno = $val['score_student_regno'];
			

		//compute student position in a subject	
if($student_total_scores == $currenttotalscores){
	$position = $printedposition;
	$nextposition +=1;
	
}else{
	
	$position = $nextposition+1;
	$nextposition++;
}
$currenttotalscores = $student_total_scores;
$printedposition = $position;
if($student_admission_number ==  $student_regno){
	$student_position = $printedposition;
	}


			 }
	return $student_position;
			 }	
			 
function getHighestScoresinSubject(){
	 $db = new Database();
			$this->query = "SELECT MAX(score_total) AS maximum_score FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND
				  `score_subject_code`='".$db->Escape($this->score_subject_code)."' AND`score_term`='".$db->Escape($this->score_term)."'AND `score_session` = '".$db->Escape($this->score_session)."'";
			  
 foreach($db->Resultset($this->query) as $key => $val){			
   $maximum = $val['maximum_score'];
  }
    return $maximum;
}
  
  
  function getLowestScoresinSubject(){
	   $db = new Database();
			$this->query = "SELECT MIN(score_total) AS minimum_score FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND
				  `score_subject_code`='".$db->Escape($this->score_subject_code)."' AND`score_term`='".$db->Escape($this->score_term)."'AND `score_session` = '".$db->Escape($this->score_session)."'";
			  
 foreach($db->Resultset($this->query) as $key => $val){			
   $minimum = $val['minimum_score'];
  }
    return $minimum;
}	 
//get total number of students who sat for exams in a term, session, class and class arm
function number_students_who_sat_exams(){
	 $db = new Database();
			$this->query = "SELECT COUNT(student_no) AS total_students FROM 
			 " .$this->table_avg."
			  WHERE
			   `avg_class` = '".$db->Escape($this->avg_class)."'
			    AND 
				`avg_class_arm`='".$db->Escape($this->avg_class_arm)."'
				 AND
				 `avg_term`='".$db->Escape($this->avg_term)."'AND `avg_session` = '".$db->Escape($this->avg_session)."'";
			  
 foreach($db->Resultset($this->query) as $key => $val){			
   $total_students = $val['total_students'];
  }
    return $total_students;
}  

function number_subjects_student_enrolled(){
	//include('class.Subject.php');
	$subjects = new Subject();
	 $db = new Database();
			$this->query = "SELECT COUNT(DISTINCT(score_subject_code))  AS total_subjects,`score_student_regno`,`score_class`,`score_class_arm`,`score_term`,`score_session` FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND
				 `score_term`='".$db->Escape($this->score_term)."' AND `score_session` = '".$db->Escape($this->score_session)."' AND
				 `score_student_regno`='".$db->Escape($this->score_student_regno)."' AND `score_total` > 0";
			  
  foreach($db->Resultset($this->query) as $key => $val){	
 		
   $total_subjects = $val['total_subjects'];
   $subjects->class_limit = $val['score_class'];
   $subjects->classarm_limit = $val['score_class_arm'];
   $subjects->term_limit = $val['score_term']; 
   $subjects->session_limit = $val['score_session'];
   $subjects->table_subject_limt;
   foreach($subjects->viewAllSubjectLimitbyClassTermandSession() as $key => $values){
	   $subjects->limit_code = $values['limit_code'];
	   $subjects->viewAllSubjectLimitbyLimitcode();
	   $maximun = $subjects->max_limit;
	   $minimum = $subjects->min_limit;
	   if($total_subjects < $minimum ){
		$total_subjects_student = $minimum;   
	   }else{
		   $total_subjects_student = $total_subjects;
		   }
	   
	   }
  }
    return $total_subjects_student;
}  

function number_subjects_student_enrolled_per_term(){
	 $db = new Database();
			$this->query = "SELECT COUNT(DISTINCT(score_subject_code)) AS total_subjects FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$db->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$db->Escape($this->score_class_arm)."'
				 AND
				 `score_term`='".$db->Escape($this->score_term)."' AND `score_session` = '".$db->Escape($this->score_session)."' AND `score_student_regno`='".$db->Escape($this->score_student_regno)."' AND `score_total` > 0";
			  
 foreach($db->Resultset($this->query) as $key => $val){			
   $total_subjects = $val['total_subjects'];
  }
    return $total_subjects;
}  

function deleteScores(){
		  $db = new Database();
	$this->query = "DELETE FROM ".$this->table." WHERE `score_code`='".$db->Escape($this->score_code)."'";
return $db->Reader($this->query);

}

function view_avg_scoresbyTermSessionClass(){
	 $db = new Database();
			$this->query = "SELECT * FROM 
			 " .$this->table_avg."
			  WHERE
			   `avg_class` = '".$db->Escape($this->avg_class)."'
			    AND 
				`avg_class_arm`='".$db->Escape($this->avg_class_arm)."'
				 AND
				  `avg_term`='".$this->db($this->avg_term)."'AND `avg_session` = '".$db->Escape($this->avg_session)."'";
			  
 return $db->Resultset($this->query);
			   }
	}

?>