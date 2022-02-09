<?php
include('class.term.php');
class Scores extends Term{
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
	public $table = "sms_scores";
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
		$this->result_view =  $result_view;
	}
	//check for already existing scores to avoid sql duplicate error
	function AvoidScoreDuplicate(){
		$this->query = "SELECT `score_code` FROM ".$this->table." WHERE `score_code` = '".$this->score_code."'";
		return $this->Query($this->query); 
	}


	public function updateAssessments(){
$this->query = "UPDATE " .$this->table."
SET `score_CA1`='".$this->Escape($this->score_CA1)."',`score_CA2`='".$this->Escape($this->score_CA2)."',`score_CA3`='".$this->Escape($this->score_CA3)."',`score_exam`='".$this->Escape($this->score_exam)."',`score_total`='".$this->Escape($this->score_total)."',`score_by`='".$this->Escape($this->score_by)."' WHERE `score_code` ='".$this->Escape($score_code)."'";
$this->Reader($this->query);

	}
	//create a new scores or update an existing scores publis_code	publis_class	publis_classarm	publis_term	publis_session
		//check for already existing scores to avoid sql duplicate error
	function AvoidPublisDuplicate($publis_code){
		$this->query = "SELECT `publis_code` FROM ".$this->public_table." WHERE `publis_code` ='$publis_code'";
		return $this->Query($this->query); 
	}
	
	public function publisResult($publis_code){
		
	$this->query ="INSERT INTO ".$this->public_table."(`publis_code`,`publis_class`,
`publis_classarm`,`publis_term`,`publis_session`,`publis_by`,`publis_date`) VALUES('$publis_code',
'".$this->Escape($this->score_class)."',
'".$this->Escape($this->score_class_arm)."',
'".$this->Escape($this->score_term)."',
'".$this->Escape($this->score_session)."',
'".$this->Escape($this->score_by)."',
'".$this->Escape($this->score_date)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);

	return $insertid;
		
		
		}		
	
	public function save(){
		
	$this->query ="INSERT INTO ".$this->table."(`score_code`,`score_student_regno`,
`score_subject_code`,`score_class`,`score_class_arm`,`score_term`,`score_session`,
`score_by`,`score_date`) VALUES('".$this->Escape($this->score_code)."',
'".$this->Escape($this->score_student_regno)."',
'".$this->Escape($this->score_subject_code)."',
'".$this->Escape($this->score_class)."',
'".$this->Escape($this->score_class_arm)."',
'".$this->Escape($this->score_term)."',
'".$this->Escape($this->score_session)."',
'".$this->Escape($this->score_by)."',
'".$this->Escape($this->score_date)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);

	return $insertid;
		
		
		}
		
public function updateScores(){
		$this->query ="UPDATE ".$this->table." SET `score_CA1`='".$this->Escape($this->score_CA1)."',`score_CA2`='".$this->Escape($this->score_CA2)."',`score_CA3`='".$this->Escape($this->score_CA3)."',`score_exam`='".$this->Escape($this->score_exam)."',`score_total`='".$this->Escape($this->score_total)."',`score_grade`='".$this->Escape($this->score_grade)."',`score_by`='{$_SESSION['USERNAME']}' WHERE `score_code` ='".$this->Escape($this->score_code)."'";	
	
	$insertid=$this->InsertOrUpdate($this->query);

	return $insertid;
		
		
		}	
		
		public function updateAvgScoresofStudent(){
		$this->query ="UPDATE ".$this->table_avg." SET `avg_total_marks`='".$this->Escape($this->avg_total_marks)."' WHERE `avg_code` ='".$this->Escape($this->avg_code)."'";	
	
	$insertid = $this->InsertOrUpdate($this->query);

	return $insertid;
		
		
		}		
				
function view_scoresbyScoreCode(){
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				  `score_subject_code`='".$this->Escape($this->score_subject_code)."' AND`score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."' ORDER BY score_student_regno ASC ";
			  
 return $this->Resultset($this->query);
			   }
			   
function getStudentscoresheet(){
			$this->query = "SELECT DISTINCT(score_student_regno),score_class,score_class_arm,score_term,score_session FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."' AND`score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."' ORDER BY score_student_regno ASC ";
			  
 return $this->Resultset($this->query);
			   }			   
			   
			//view student result for the selected term,session,class,clas arm   
 function view_scoresbystudent(){
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				  `score_student_regno`='".$this->Escape($this->score_student_regno)."' AND`score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."' AND `score_total` > 0";
			  
 return $this->Resultset($this->query);
			   }
	//check if the selected term, session, class and class arm has scores
	function view_scoresbyTermSessionClass(){
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				  `score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."'";
			  
 return $this->Resultset($this->query);
			   }
	
	
	//view class result function
		function view_class_result(){
			$this->query = "SELECT DISTINCT(score_subject_code),`score_by` FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND`score_term`='".$this->Escape($this->score_term)."'
				 AND `score_session` = '".$this->Escape($this->score_session)."'";
			  
 return $this->Resultset($this->query);
			   }
			   
 function view_students_scores_class(){
			$this->query = "SELECT DISTINCT(score_student_regno) FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND`score_term`='".$this->Escape($this->score_term)."'
				 AND `score_session` = '".$this->Escape($this->score_session)."' ORDER BY `score_student_regno` ASC";
			  
 return $this->Resultset($this->query);
			   }
	   
	 function view_students_scores_foreach_subject(){
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND`score_term`='".$this->Escape($this->score_term)."'
				 AND`score_student_regno`='".$this->Escape($this->score_student_regno)."'
				 AND`score_subject_code`='".$this->Escape($this->score_subject_code)."'
				 AND `score_session` = '".$this->Escape($this->score_session)."'";
			  
 return $this->Resultset($this->query);
			   }		   
function position_in_class($student_admission_number){ 
$printedposition=0;
$currenttotalscores=0;
$position=0;
$next=0;
$this->query = "SELECT * FROM ".$this->table_avg." WHERE `avg_class`='".$this->Escape($this->avg_class)."' AND `avg_class_arm`='".$this->Escape($this->avg_class_arm)."' AND `avg_term`='".$this->Escape($this->avg_term)."' AND `avg_session`='".$this->Escape($this->avg_session)."' ORDER BY `avg_total_marks` DESC";
		 foreach($this->Resultset($this->query) as $key => $val){
			 $student_total_scores = $val['avg_total_marks'];
			 $student_regno = $val['student_no'];
			

		//compute student position in a subject	
if($student_total_scores == $currenttotalscores){
	$position = $printedposition;
	$next +=1;
	
}else{
	$position = $next+1;
	$next++;
}
$currenttotalscores = $student_total_scores;
$printedposition = $position;
if($student_admission_number ==  $student_regno){
	$student_position = $printedposition;
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
}elseif($printedposition <= 100){
$reduce = substr($printedposition,1);
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
}elseif($printedposition < 1000){
$reduce=substr($printedposition,2);
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
		$this->query = "SELECT * FROM ".
		$this->table_avg." WHERE 
		`avg_code`=
		'".$this->Escape($this->avg_code)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->avg_total_marks = $value['avg_total_marks'];
	$this->attendance = $value['attendance'];
	$this->days_school_opened = $value['days_school_opened'];
	$this->result_view = $value['result_view'];
	}
	return $this;
	}
	
	function position_in_subject($student_admission_number){ 
$printedposition=0;
$currenttotalscores=0;
$position=0;
$nextposition=0;
$this->query = "SELECT * FROM ".$this->table." WHERE `score_class`='".$this->Escape($this->score_class)."' AND `score_class_arm`='".$this->Escape($this->score_class_arm)."' AND `score_term`='".$this->Escape($this->score_term)."' AND `score_subject_code`='".$this->Escape($this->score_subject_code)."' AND `score_session`='".$this->Escape($this->score_session)."' ORDER BY `score_total` DESC";
		 foreach($this->Resultset($this->query) as $key => $val){
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
			$this->query = "SELECT MAX(score_total) AS maximum_score FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				  `score_subject_code`='".$this->Escape($this->score_subject_code)."' AND`score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."'";
			  
 foreach($this->Resultset($this->query) as $key => $val){			
   $maximum = $val['maximum_score'];
  }
    return $maximum;
}
  
  
  function getLowestScoresinSubject(){
			$this->query = "SELECT MIN(score_total) AS minimum_score FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				  `score_subject_code`='".$this->Escape($this->score_subject_code)."' AND`score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."'";
			  
 foreach($this->Resultset($this->query) as $key => $val){			
   $minimum = $val['minimum_score'];
  }
    return $minimum;
}	 
//get total number of students who sat for exams in a term, session, class and class arm
function number_students_who_sat_exams(){
			$this->query = "SELECT COUNT(student_no) AS total_students FROM 
			 " .$this->table_avg."
			  WHERE
			   `avg_class` = '".$this->Escape($this->avg_class)."'
			    AND 
				`avg_class_arm`='".$this->Escape($this->avg_class_arm)."'
				 AND
				 `avg_term`='".$this->Escape($this->avg_term)."'AND `avg_session` = '".$this->Escape($this->avg_session)."'";
			  
 foreach($this->Resultset($this->query) as $key => $val){			
   $total_students = $val['total_students'];
  }
    return $total_students;
}  

function number_subjects_student_enrolled(){
	//include('class.Subject.php');
	$subjects = new Subject();
	
$this->query = "SELECT COUNT(DISTINCT(score_subject_code)) AS total_subjects,`score_student_regno`,`score_class`,`score_class_arm`,`score_term`,`score_session`  FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				 `score_term`='".$this->Escape($this->score_term)."' AND `score_session` = '".$this->Escape($this->score_session)."' AND
				 `score_student_regno`='".$this->Escape($this->score_student_regno)."' AND `score_total` > 0";
			  
 foreach($this->Resultset($this->query) as $key => $val){	
 		
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
			$this->query = "SELECT COUNT(DISTINCT(score_subject_code)) AS total_subjects FROM 
			 " .$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				 `score_term`='".$this->Escape($this->score_term)."' AND `score_session` = '".$this->Escape($this->score_session)."' AND `score_student_regno`='".$this->Escape($this->score_student_regno)."' AND `score_total` > 0";
			  
 foreach($this->Resultset($this->query) as $key => $val){			
   $total_subjects = $val['total_subjects'];
  }
    return $total_subjects;
}  

function deleteScores(){
		 
	$this->query = "DELETE FROM ".$this->table." WHERE `score_code`='".$this->Escape($this->score_code)."'";
return $this->Reader($this->query);

}
function deleteAllScores(){
		 
	$this->query = "DELETE FROM ".$this->table."";
return $this->Reader($this->query);

}
/*function deleteScoresbyclassandclassarm(){
		 
	$this->query = "DELETE FROM ".$this->table."";
return $this->Reader($this->query);

}*/
/*function deleteAvgScores(){
		 
	$this->query = "DELETE FROM ".$this->table_avg." WHERE `avg_code`='".$this->Escape($this->avg_code)."'";
return $this->Reader($this->query);

}
*/
function deleteAvgScores(){
		 
	$this->query = "DELETE FROM ".$this->table_avg."";
return $this->Reader($this->query);

}


function view_avg_scoresbyTermSessionClass(){
			$this->query = "SELECT * FROM 
			 " .$this->table_avg."
			  WHERE
			   avg_class= '".$this->Escape($this->avg_class)."'
			    AND 
				avg_class_arm='".$this->Escape($this->avg_class_arm)."'
				 AND
				  avg_term='".$this->Escape($this->avg_term)."'AND avg_session = '".$this->Escape($this->avg_session)."' ORDER BY student_no ASC";
			  
 return $this->Resultset($this->query);
			   }
			  //check if the student has already been set for the scoring 
			  
			  function view_avg_scoresbyTermSessionClassandStudentRegno($student_regno,$student_class,$student_classarm,$term,$session){
			$this->query = "SELECT * FROM 
			 " .$this->table_avg."
			  WHERE
			   `avg_class` = '$student_class'
			    AND 
				`avg_class_arm`='$student_classarm'
				 AND
				  `avg_term`='$term' AND `avg_session` = '$session' AND `student_no` = '$student_regno'";
			  
$result = $this->Query($this->query);
	if($result > 0){
		$status = "Already Set";
	}else{
	$status = "Not Set";	
	}
	return $status;

			   }
			   
			   
 function viewAllavg_scores(){
			$this->query = "SELECT * FROM 
			 " .$this->table_avg."";
			  
 return $this->Resultset($this->query);
			   }
			   
function view_scoresbySession(){
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			    `score_session` = '".$this->Escape($this->score_session)."'";
			  
 return $this->Resultset($this->query);
			   }
			   
			   
  function viewAllScores(){
			$this->query = "SELECT * FROM 
			 " .$this->table."";
			  
 return $this->Resultset($this->query);
			   }
			   
function viewAllScoresbyclasscode(){
			$this->query = "SELECT * FROM 
			 " .$this->table." WHERE score_class='".$this->Escape($this->score_class)."' AND score_class_arm='".$this->Escape($this->score_class_arm)."'";
			  
 return $this->Resultset($this->query);
			   }			   
			   
	function moveScorestoScoresHistoryTable(){
	$this->query = "INSERT INTO sms_scores_history(score_code,score_student_regno,score_subject_code,score_class,score_class_arm,score_CA1,score_CA2,score_CA3,score_exam,score_total,score_grade,score_term,score_session,score_by,score_date) SELECT score_code,score_student_regno,score_subject_code,score_class,score_class_arm,score_CA1,score_CA2,score_CA3,score_exam,score_total,score_grade,score_term,score_session,score_by,score_date FROM sms_scores WHERE score_class='".$this->Escape($this->score_class)."' AND score_class_arm='".$this->Escape($this->score_class_arm)."'";	
		
	$insert = $this->InsertOrUpdate($this->query);
	if($insert === true){
	$que = "DELETE FROM ".$this->table." WHERE score_class='".$this->Escape($this->score_class)."' AND score_class_arm='".$this->Escape($this->score_class_arm)."'";
$delete = $this->Reader($que);	
	}
		
	return $delete;	
	}
function viewAllScoresDisticntClass(){
			$this->query = "SELECT DISTINCT score_class,score_class_arm FROM 
			 " .$this->table." ORDER BY score_class ASC";
			  
 return $this->Resultset($this->query);
			   }
		//check if session result has not been clossed	   
	 function view_scoresbySessionIfExist(){
			$this->query = "SELECT * FROM 
			 " .$this->table."
			  WHERE
			    `score_session`<>'".$this->Escape($this->score_session)."'";
			  
 return $this->Read($this->query);
			   }
			   //view students average scoresby term , class, session
			  /*  function view_students_avg_scores_class(){
			$this->query = "SELECT avg_code,student_no FROM 
			 " .$this->table_avg."
			  WHERE
			   `avg_class` = '".$this->Escape($this->avg_class)."'
			    AND 
				`avg_class_arm`='".$this->Escape($this->avg_class_arm)."'
				 AND`avg_term`='".$this->Escape($this->avg_term)."'
				 AND `avg_session` = '".$this->Escape($this->avg_session)."'";
			  
 return $this->Resultset($this->query);
			   }*/
	
	
	function getStudentTotalMarksObtainedinExams(){
			$this->query = "SELECT SUM(score_total) AS total_marks FROM 
			 ".$this->table."
			  WHERE
			   `score_class` = '".$this->Escape($this->score_class)."'
			    AND 
				`score_class_arm`='".$this->Escape($this->score_class_arm)."'
				 AND
				  `score_student_regno`='".$this->Escape($this->score_student_regno)."' AND`score_term`='".$this->Escape($this->score_term)."'AND `score_session` = '".$this->Escape($this->score_session)."'";
			  
 return $this->Resultset($this->query);
			   }
	// get student grade 	   
 function getStudentTotalMarksObtainedinExamswithParameters($regno,$score_class,$score_classarm,$score_term,$score_session){
			$this->query = "SELECT SUM(score_total) AS total_marks FROM  ".$this->table."
			  WHERE
			   score_class='$score_class'
			    AND 
				score_class_arm='$score_classarm'
				 AND
				  score_student_regno='$regno' AND score_term='$score_term' AND score_session= '$score_session'";
			  
 foreach($this->Resultset($this->query) as $key => $val){
	 $total_marks_obtained = $val['total_marks'];	 
 }
 return $total_marks_obtained;
			   }  
// update student total marks in the average score table		   
function updatestudenttotalscoresobtained($avg_code,$totamarksobtained){
			$this->query =	"UPDATE ".$this->table_avg." SET `avg_total_marks`='$totamarksobtained' WHERE `avg_code` ='$avg_code'";
			$update = $this->InsertOrUpdate($this->query); 
		return $update;
			 }
	//update students score for each subject in scores table		 
function updatestudentscoresforeachsubject($score_code,$score_CA1,$score_CA2,$score_CA3,$score_exam,$score_total,$score_grade,$score_by){
$this->query =  "UPDATE  ".$this->table." SET score_CA1='$score_CA1',score_CA2='$score_CA2',score_CA3='$score_CA3',score_exam='$score_exam',score_total='$score_total',score_grade='$score_grade',score_by='$score_by' WHERE `score_code` ='$score_code'";
$insert = $this->InsertOrUpdate($this->query);
return $insert;
}		 
	 }

?>