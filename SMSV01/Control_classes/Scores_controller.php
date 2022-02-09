<?php  
session_start();

include_once ('../classes/class.school_setup.php');
include_once ('../classes/class.Scores.php');
include_once ('../classes/class.Database.php');
//include_once ('../classes/class.students.php');
require_once ('../classes/class.Grades.php');
//require_once('../classes/class.Subject.php');
//include_once ('../Admin/links.php');
//Instantiate class Database
	
	//Instantiate class Scores
	$schoolsetup = new SchoolSetup();
	$create_scores = new Scores();
	//Instantiate class Students
	$database = new Database();
	$getgrade = new Grade();
	

/**
* *********************Adding New Staff /NonStaff *******************
*/
//$score_code; //concat stubentregno+class+class_arm+subject_code+term+session

$action=$_GET['action'];


switch($action){

	case "createscoresfrommodal":
		
	$students_class = $_POST['score_class'];
		
	$students_classarm = $_POST['score_class_arm'];
	
		$student_term = $_POST['score_term'];
	
	
		$session = $_POST['score_session'];
		

	if (isset($_POST['push'])){
		//get user entered values
			$student_regno = $_POST['student_regno'];
		$students_subjects = $_POST['score_subject'];
		$create_scores->score_code = $student_regno.$students_subjects.$students_class.$students_classarm.$session.$student_term; 
	
		//bind values to variables
	
		$create_scores->score_student_regno = $student_regno;
	
	
		$create_scores->score_class = $students_class;
		
	$create_scores->score_class_arm = $students_classarm;
	
		$create_scores->score_term = $student_term;
	
	
		$create_scores->score_session = $session;
		
	
		$create_scores->score_subject_code = $students_subjects;
		
	
	$create_scores->score_by = $_SESSION['USERNAME'];
	
		$create_scores->score_date = date('Y/m/d');
		
	
 $totalmarkscode =  $student_regno.$students_class.$students_classarm.$session.$student_term;
	
	 $getScoresCode = $create_scores->AvoidScoreDuplicate(); 

	 if(isset($getScoresCode) && $getScoresCode > 0) {
		   header("location:../Admin/score_student1.php?err=3&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects");
			
		} 
	 else {

   $insetid = $create_scores->save();
	
	 }
  if($insetid==true){
	 $checkavgtabe = $database->Query("SELECT `avg_code` FROM `sms_average_scores` WHERE `avg_code`='$totalmarkscode'");
			if(isset($checkavgtabe) && $checkavgtabe < 1 ){
$database->InsertOrUpdate("INSERT INTO `sms_average_scores`(`avg_code`,`student_no`,`avg_class`,`avg_class_arm`,`avg_term`,`avg_session`) VALUES('$totalmarkscode','$student_regno','$students_class','$students_classarm','$student_term','$session')");
			}
	 header("location:../Admin/score_student1.php?emsg=1&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects");
	exit;
  }else{
	  
	  header("location:../Admin/score_student1.php?err=3&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects"); 
  }
 exit;
  }
 

  case "Update_scores":
  
   if (isset($_POST['send'])){
		  $scorescodesss  = $_POST["scorecode"];
	 $score_ca1s = $_POST["CA1"];
	  $score_ca2s = $_POST["CA2"];
	   $score_ca3s = $_POST["CA3"];
	    $score_exams = $_POST["exam"];
	 //set values to the variables
	
foreach($scorescodesss as $i => $score_codess){
	 $scorescodes  = $score_codess;
	 $score_ca1 = $score_ca1s[$i];
	  $score_ca2 = $score_ca2s[$i];
	   $score_ca3 = $score_ca3s[$i];
	    $score_exam = $score_exams[$i];
		$score_total= $score_ca1 + $score_ca2 + $score_ca3 + $score_exam;
$update = $database->InsertOrUpdate("UPDATE `sms_scores` SET `score_CA1`='$score_ca1',`score_CA2`='$score_ca2',`score_CA3`='$score_ca3',`score_exam`='$score_exam',`score_total`='$score_total' WHERE `score_code` ='$scorescodes'");
	
	 }
  //$update = $create_scores->totalAssessment($scorescodes);
  if($update==true){
	
		header("location:../Admin/score_student1.php?emsg=1&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects");
			exit;
  }else{
		 header("location:../Admin/score_student1.php?err=10&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects"); 
  }
  exit;
}

 case "publish_result":
    if (isset($_POST['publich'])){
  	
	if (isset($_POST['student_class'])){
		$create_scores->score_class = $_POST['student_class'];
		$create_scores->avg_class = $_POST['student_class'];
		}
		if (isset($_POST['student_classarm'])){
		$create_scores->score_class_arm = $_POST['student_classarm'];
		$create_scores->avg_class_arm = $_POST['student_classarm'];
		}
		if (isset($_POST['term'])){
		$create_scores->score_term = $_POST['term'];
		$create_scores->avg_term = $_POST['term'];
		}
		if (isset($_POST['sessions'])){
		$create_scores->score_session = $_POST['sessions'];
		$create_scores->avg_session = $_POST['sessions'];
		}
		$create_scores->score_by = $_SESSION['USERNAME'];
		$create_scores->score_date = date('d/m/Y');
		$publis_code = $create_scores->score_class.$create_scores->score_class_arm.$create_scores->score_term.$create_scores->score_session;
		$getpublis = $create_scores->AvoidPublisDuplicate($publis_code);

	 if( isset($getpublis)&& $getpublis > 0) {
				  header("location:../Admin/publish_result.php?err=20");
				  exit;
		}else{
  $upd = $create_scores->publisResult($publis_code);
 
	
	 if($upd == true){
	  if(!empty($create_scores->view_avg_scoresbyTermSessionClass())){
	foreach($create_scores->view_avg_scoresbyTermSessionClass() as $key => $vals){
	$student = $vals['student_no'];	
	$totam_marks  = $vals['avg_total_marks'];
	$create_scores->score_student_regno = $vals['student_no'];
	$average = $totam_marks/$create_scores->number_subjects_student_enrolled();	
	$formated_avg = number_format($average,1);
	$avg_code = $vals['avg_code'];
	$database->InsertOrUpdate("UPDATE `sms_average_scores` SET `student_average`='$formated_avg' WHERE `avg_code` ='$avg_code'");
	}
	}

		 	header("location:../Admin/publish_result.php?emsg=15");
	exit;	
  }else{
 header("location:../Admin/publish_result.php?err=10");
	    exit;
  }}
  }	
  
   case "close_scores":
      
$create_scores->score_class = $_GET['score_class'];   
$create_scores->score_class_arm	= $_GET['classarm']; 
  $update = $create_scores->moveScorestoScoresHistoryTable();
	if($update == true){
	
	header("location:../Admin/close_session_scores.php?emsg=19");
			exit;
  }else{
		 header("location:../Admin/close_session_scores.php?err=10");
  }
break;
	 
 
	 
  case "result_privilege":
    if (isset($_POST['privilege'])){
  	if (isset($_POST["checkbox"])){
		//$checkbox = $_POST['checkbox'];
		$id = implode( ",",$_POST["checkbox"] ) ;
	
		}
	
		//$id = "('" . implode( "','", $checkbox ) . "');" ;
		if(empty($id)){
				  header("location:../Admin/result_privilege.php?err=28");
				  exit;
		}else{

  $upd = $database->InsertOrUpdate("UPDATE sms_average_scores SET `result_view`='ACTIVE' WHERE avg_code IN (".$id.")");

 
	
	 if($upd == true){
	  
		 	header("location:../Admin/result_privilege.php?emsg=14");
	exit;	
  }else{
 header("location:../Admin/result_privilege.php?err=10");
	    exit;
  }}
  }
 break;
 
 
 case "set_student_for_scores":
 
    if (isset($_POST['set'])){
		if (isset($_POST["term"])){
		$term = $_POST["term"];
		}
		if (isset($_POST["session"])){
		$session = $_POST["session"];
		}
		 
		if (isset($_POST["student_class"])){
		$student_class = $_POST["student_class"];
		}
		if (isset($_POST["student_classarm"])){
		$student_classarm = $_POST["student_classarm"];
		}
		
		$date = date("Y/m/d");
  if(empty($_POST['term']) ||  empty($_POST['session']) || count($_POST["checkbox"]) < 1){
	 header("location:../Admin/prepare_student_scoring.php?err=32");
}else{
	for($i = 0; $i < count($_POST["checkbox"]); $i++){	
$student_regno = $_POST["checkbox"][$i];
foreach($database->Resultset("SELECT * FROM `sms_class_subjects` WHERE `class_sub_class_code`='$student_class'") as $key => $values){

		$scorecode = $student_regno.$values['class_sub_code'].$student_classarm.$session.$term;
  $avg_code =  $student_regno.$student_class.$student_classarm.$session.$term;
		   $checkavgtabe = $database->Query("SELECT `avg_code` FROM `sms_average_scores` WHERE `avg_code`='$avg_code'");
		   
			if(isset($checkavgtabe) && $checkavgtabe < 1){
$database->InsertOrUpdate("INSERT INTO `sms_average_scores`(`avg_code`,`student_no`,`avg_class`,`avg_class_arm`,`avg_term`,`avg_session`,`student_average`,`result_view`) VALUES('$avg_code','$student_regno','$student_class','$student_classarm','$term','$session','0.0','INACTIVE')");
			 }else{
	 header("location:prepare_student_scoring.php?err=9");
			}
		$upd = $database->InsertOrUpdate("INSERT INTO `sms_scores`(`score_code`,`score_student_regno`,
`score_subject_code`,`score_class`,
`score_class_arm`,`score_term`,`score_session`,
`score_by`,`score_date`) 
VALUES('$scorecode','$student_regno','{$values['class_sub_subject_code']}','$student_class',
'$student_classarm','$term','$session','{$_SESSION['USERNAME']}','$date')");
 
	  }}
	 if($upd == true){
	  
		 	header("location:../Admin/prepare_student_scoring.php?emsg=1");
	exit;	
  }else{
 header("location:../Admin/prepare_student_scoring.php?err=9");
	    exit;
  }}
  }
 break;
 
 //upload students exam scores
 case "uploadscores":
 if(isset($_POST["post"])){
	 	if (isset($_POST['student_class'])){
		$create_scores->score_class = $studentAction->student_class = $database->Escape($_POST['student_class']);
		}
		if (isset($_POST['classarm'])){
		$create_scores->score_class_arm = $studentAction->student_classarm = $database->Escape($_POST['classarm']);
		}
		if (isset($_POST['term'])){
		$create_scores->score_term = $studentAction->student_classarm = $database->Escape($_POST['term']);
		}
		if (isset($_POST['session'])){
		$create_scores->score_session = $studentAction->student_classarm = $database->Escape($_POST['session']);
		}
		if (isset($_POST['subject'])){
		$create_scores->score_subject_code = $studentAction->student_classarm = $database->Escape($_POST['subject']);
		}
		if(empty($create_scores->view_scoresbyScoreCode())){
			header("location:../Admin/upload_students_scores_csv.php?err=14");
		}else{
		$filename=$_FILES["file"]["tmp_name"];		
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
			
		  	$file = fopen($filename, "r");
			 fgetcsv($file, 10000, ",");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				 if(empty( $getData[0]) || empty( $getData[1]) || empty( $getData[2]) || empty( $getData[3]) || empty( $getData[4]) || empty( $getData[5])  || $student_class == "0" ){
				 
header("location:../Admin/upload_students_scores_csv.php?err=18");
/* }elseif(!filter_var($getData[13], FILTER_VALIDATE_EMAIL)){
	
header("location:../Admin/import_students.php?err=7");*/

}
	$regno = $getData[0];
	
		
		

		foreach($create_scores->view_scoresbyScoreCode() as $key => $stud){
			if($regno == $stud['score_student_regno']){
				
		$create_scores->score_CA1 = $getData[2];
		
	
		$create_scores->score_CA2 = $getData[3];
		
		
		$create_scores->score_CA3 = $getData[4];
		$create_scores->score_exam = $getData[5]; 
				$create_scores->score_student_regno = $regno;
				$create_scores->score_code = $stud['score_code'];
				 $create_scores->avg_code =  $create_scores->score_student_regno.$create_scores->score_class.$create_scores->score_class_arm.$create_scores->score_session.$create_scores->score_term;
			}
	$create_scores->score_total = floor($create_scores->score_CA1 + $create_scores->score_CA2 + $create_scores->score_CA3 + $create_scores->score_exam);
	//ccheck if student with such admmission number  exist
	foreach($getgrade->viewAllGrades() as $keys => $gravevalue){
			//get minimum score from the grade table
			$minimun_grade = $gravevalue['grade_min_mark'];
			//get maximum score from the grade table
				$max_grade = $gravevalue['grade_max_mark'];
				//get student's grade based on his total marks obtained
				if($create_scores->score_total >= $minimun_grade && $create_scores->score_total <= $max_grade)
			$create_scores->score_grade = $gravevalue['grade_code'];

   $result = $create_scores->updateScores();
	}
	foreach($create_scores->getStudentTotalMarksObtainedinExams() as $key => $val){
		$create_scores->avg_total_marks = $val['total_marks'];
		$create_scores->updateAvgScoresofStudent();
		
	}}}
				if($result === true)
				{
				
					header("location:../Admin/upload_students_scores_csv.php?emsg=1");	
				
				}elseif($result == false) {
					  header("location:../Admin/upload_students_scores_csv.php?err=19");
			
			 }}
	         fclose($file);	
		
	}
}}
?>