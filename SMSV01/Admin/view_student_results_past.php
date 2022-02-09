<?php
session_start();
ob_start();

	if(!isset($_SESSION['USERNAME'])){
	echo "<script>
location='../'
</script>";
}
//Instantiate classes
include_once('../classes/class.school_setup.php');
include_once('../classes/class.Scores_history.php');
//require_once('../classes/class.Grades.php');
//include_once('../classes/class.Scores.php');

require_once('../classes/class.students.php');
require_once('../classes/class.Subject.php');
// instantiate classes

$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$subject=new Subject();
$createscore = new ScoresHistory();
$database= new Database();
$getgrade = new Grade();
$school_setup = new SchoolSetup();
//selected student admission number
$login = $_GET['admission_no'];
$studentAction->student_regno = $login;
$studentAction->viewStudentbyID();
$student_term = $_GET['student_term'];
 $session = $_GET['session'];
 $students_class = $_GET['students_class'];
 $students_classarm = $_GET['students_classarm'];
 $publish_code = $students_class.$students_classarm.$student_term.$session;
 // id for student's total marks obtained in a particular term in sms_average_score model
  $avg_code =  $login.$students_class.$students_classarm.$session.$student_term;
  $createscore->avg_code = $avg_code;
  $createscore->viewStudentTotalMarksObtainedByRegno();
 //get class arm description using its id
 $classarm->class_arm_code = $students_classarm;
$classarm->viewClassArmByID();	   
	//get class  description using its id
	$studentclass->class_code = $students_class;
	$studentclass->viewclassByID();	
	//get Term  description using its id
	$term->term_code = $student_term;
	$term->viewTermByID();
	//get session  description using its id
	$availableSession->session_code = $session;
	$availableSession->viewSessionByID();
	//bind values to parameters of scores model 
	$createscore->score_class = $students_class;
	$createscore->score_class_arm = $students_classarm;
	$createscore->score_session = $session;
	$createscore->score_student_regno = $login;
	$createscore->score_term = $student_term;
	$createscore->score_student_regno = $login;
//$total_subjects_by_student = $createscore->number_subjects_student_enrolled();
$subject->class_limit = $students_class;
	$subject->classarm_limit = $students_classarm;
	$subject->term_limit = $student_term;
	$subject->session_limit = $session;
//	$createscore->score_student_regno = $login;
$total_subjects_by_student = $createscore->number_subjects_student_enrolled();
$numberofsubjectsstudentoffered = $createscore->number_subjects_student_enrolled_per_term();
$getminimumandmaximumsubjectslimit = $subject->viewAllSubjectLimitbyClassTermandSessiontobeOffered();

	//$position_in_class = $createscore->position_in_class($login);
	$createscore->avg_class = $students_class;
	$createscore->avg_class_arm = $students_classarm;
	$createscore->avg_term = $student_term;
	$school_setup->remark_term = $student_term;
	$createscore->avg_session = $session;
	$school_setup->remark_session = $session;
	$student_class_postion = $createscore->position_in_class($login);
	$printsufix = $createscore->print_suffix($student_class_postion);
	//get total number of students who sat for exams in a term, session, class and class arm
	$total_students = $createscore->number_students_who_sat_exams();
	$school_setup->cog_student_reg = $login;
$school_setup->cog_student_class = $students_class;
$school_setup->cog_student_session = $session;
$school_setup->cog_student_term = $student_term;
$student_average =  floor(($createscore->avg_total_marks/$total_subjects_by_student ));
$student_remark = $school_setup->getStudentRemarkByTermandSession($student_average);
$principal_remark = $school_setup->getStudentPrincipalRemarkByTermandSession($student_average);
$attendance;
 if($createscore->attendance == 0 || $createscore->days_school_opened == 0){
	$attendance = "<div class='btn btn-danger'>Pls set students attendance</div>";
	}else{ 
	$getattendancelogic = (($createscore->attendance /$createscore->days_school_opened)*100);
	$attendance =  number_format($getattendancelogic,1)."%";
	} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result Template</title>
 <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
</head>

<body>
 <div class="content mt-3">
<?php
/*$getpublis = $createscore->AvoidPublisDuplicate($publish_code);

	 if( isset($getpublis)&& $getpublis <= 0) {
		 echo "The selected class results has not been published. you must published the results first";
	 }else{*/
?>
<center>
	<table border=1 style=" max-width:2480px; width:100%;">
		<tr>
		<td>
			<table  width="100%">
			<tr>
				<td>
                <?php $school_setup->viewSchoolSetup();
					if(!empty($school_setup->school_logo)){
					 ?>
					<img src="<?php echo $school_setup->school_logo;?>" width="120" height="120">
                    <?php }else{ ?>
                    <img src="../imageupload/admin11.jpg" width="120" height="120">
                     <?php } ?>
				</td>
				<td>
					<b><font size='5'><?php echo strtoupper($school_setup->school_name)?></font></b><br> <i><?php echo ucwords($school_setup->school_address)?></i><br>
                    <i><?php echo $school_setup->school_phone."    ".$school_setup->school_email?></i><br>
					
				</td>
                <td>
               <img src='<?php echo $studentAction->image?>' width="100" height="100">
               </td>
			</tr>
           
			</table>
		</td>
		</tr>
	<tr>
	<td>
			<table style="width:100%;" bgcolor="#7woh">
            <tr><td><table style="width:100%;" border="1">
				<tr><td colspan="2">Name:<?php echo $studentAction->last_name." ".$studentAction->first_name ?></td>&nbsp;&nbsp;<td colspan="2">Admission No:<?php echo $login ?></td><td colspan="2">SEX:<?php echo $studentAction->sex ?></td><td colspan="3">Total Marks Obtained:<?php echo $createscore->avg_total_marks ?></td></tr>
			<tr><td colspan="2">Academic Session:<?php echo $availableSession->session_description ?></td>	
            <td colspan="4">Term:<?php echo  ucwords(strtolower($term->term_name))?></td>
            <td colspan="2">Student Average:<?php echo number_format(($createscore->avg_total_marks/$total_subjects_by_student ),2,'.','');?></td></tr>
				<tr><td colspan="2">Class:<?php echo $studentclass->class_name. $classarm->class_arm_name?></td> <td colspan="2">Number in Class:<?php echo $total_students; ?></td><td colspan="2">Next Term Begin:<?php if(!empty($school_setup->viewNextTermBegin())){foreach($school_setup->viewNextTermBegin() as $key => $val){ echo $val['next_date'];}}  ?></td><td>Attendance:<?php echo $attendance; ?></td></tr>
				
            
               
               
				<tr><td colspan="2">Days School Opened:<?php echo $createscore->days_school_opened ?></td><td colspan="3">Position in Class:<?php echo $student_class_postion?><sup><?php echo $printsufix; ?></sup></td><td colspan="4"></td></tr>
				
				</table></td></td></tr>
			</table>
		</td>
		</tr>
		<tr>
		<td>
        <table border="1" width="100%"><tr><td>
			<table border="1" width="100%">
           
				<tr bgcolor="#CCC"><th><i>S/N</i></th><th><i>Subjects</i></th> <?php foreach($database->Resultset("SELECT * FROM sms_exam_type") as $key =>$vals){  ?>
     <th><i><?php echo $vals['exam_name']. "(".$vals['exam_marks']."%)" ?></i></th>
    <?php }?><th><i>Marks Obtained</i></th><th><i>Highest in Class</i></th><th><i>Lowest in Class</i></th><th><i>Position in Class</i></th><th><i>Grade</i></th><th><i>Remarks</i></th></tr>
    <?php  
	$sn=0;
	
		foreach($createscore->view_scoresbystudent() as $key => $values){

			
			for($i=0; $i<=$sn; $i++){
		$secondrowcolor =  "#ddd";
		$firstrowcolor = "#FFFFFF";
		$bg_color = $i%2 == 0 ? $firstrowcolor: $secondrowcolor;
			}
		$sn++;
		//get the subject name from its code
		$subjectcode = $values['score_subject_code'];
		$subject->subject_id = $subjectcode;
		$subject->viewSubjectByID();
		//get student's grade and remark from sms_grade model
		$getgrade->grade_code = $values['score_grade'];
		$getgrade->viewGradeByID();
		$createscore->score_subject_code = $subjectcode;
		//get the highest value in a subject
		$maximun_score = $createscore->getHighestScoresinSubject();
		//get the lowest value in a subject
		$minimum_score = $createscore->getLowestScoresinSubject();
		//get student's position in a subject
		$position = $createscore->position_in_subject($login);
		//get position's suffix like rd for 3rd or nd for 2nd
		$suffix = $createscore->print_suffix($position);
		
		 ?>
				<tr bgcolor="<?php echo $bg_color  ?>"><td><?php echo $sn; ?></td><td><?php echo  ucwords(strtolower($subject->subject_name)) ?></td><td align="center"><?php echo $values['score_CA1']  ?></td><td align="center"><?php echo $values['score_CA2']  ?></td><td align="center"><?php echo $values['score_CA3']  ?></td><td align="center"><?php echo $values['score_exam']  ?></td><td align="center"><?php echo $values['score_total']  ?></td><td align="center"><?php echo $maximun_score; ?></td><td align="center"><?php echo $minimum_score; ?></td><td align="center"><?php echo $position  ?><sup><?php echo $suffix  ?></sup></td><td align="center"><?php echo $getgrade->grade_name; ?></td><td><?php echo  ucwords(strtolower($getgrade->grade_remark)); ?></td></tr>
               
        
         <?php } ?>       
				
				
			</table>
		</td>
        <td><table border="1"><tr>
        <td colspan="3" bgcolor="#ddd">KEY TO RATING</td>
        </tr>
        <?php foreach($getgrade->viewAllGrades() as $key => $values){ ?>
        <tr>
        <td><?php echo $values['grade_min_mark']."-".$values['grade_max_mark'] ?></td>
        <td><?php echo $values['grade_name']?></td>
        <td><?php $name = strtolower($values['grade_remark']); echo ucfirst($name)?></td>
        </tr>
        <?php } ?>
        <tr><td colspan="3" bgcolor="#ddd">COGNITIVE RATING</td></tr>
         <tr>
         <td>5</td><td>=</td><td>Excellent</td>
         </tr>
          <tr>
         <td>4</td><td>=</td><td>Very Good</td>
         </tr>
          <tr>
         <td>3</td><td>=</td><td>Good</td>
         </tr>
          <tr>
         <td>2</td><td>=</td><td>Fair</td>
         </tr>
          <tr>
         <td>1</td><td>=</td><td>Poor</td>
         </tr>
        </table></td>
		</tr>

		
	</table></td></tr>
    <tr>
		<td>
			<table border="1" width="100%">
           
            <tr>
               <td colspan="2">
          
				
			
				<table border="1" width="100%">
                <tr bgcolor="#ddd"><td>COGNITIVE SKILL</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
                 <?php 
				if(!empty($school_setup->viewAllHistoryCognitiveSkillswithOffset(5,0))){
				foreach($school_setup->viewAllHistoryCognitiveSkillswithOffset(5,0) as $key => $val){ 
				$cognitive_id = $val['cognitive_id'];
				$school_setup->cog_id = $cognitive_id;
				$school_setup->viewCog_student_skills();
			$item_selected = $val['cog_student_item'];
			?>
				<tr><td><?php echo ucwords(strtolower($school_setup->cog_name))?></td>
                <td><?php echo ($item_selected ==1? '&#x2714' : '') ?></td>
                 <td><?php echo ($item_selected ==2? '&#x2714' : '') ?></td>
                  <td><?php echo ($item_selected ==3? '&#x2714' : '') ?></td>
                   <td><?php echo ($item_selected ==4? '&#x2714' : '') ?></td>
                    <td><?php echo ($item_selected ==5? '&#x2714' : '') ?></td>
               </tr>
               <?php	
						}}else{ echo "<div class='btn btn-danger btn-block'>YOUR COGNITIVE SKILLS ARE NOT YET ASSESSED BY YOUR FORMASTER</div>";}
								?>
               </table>
               </td>
                <td colspan="2">
              
				<table border="1" width="100%">
                <tr bgcolor="#ddd"><td>COGNITIVE SKILL</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
                 <?php 
				if(!empty($school_setup->viewAllHistoryCognitiveSkillswithOffset(5,5))){
				foreach($school_setup->viewAllHistoryCognitiveSkillswithOffset(5,5) as $key => $val){ $cognitive_id = $val['cognitive_id'];
				$school_setup->cog_id = $cognitive_id;
				$school_setup->viewCog_student_skills();
			$item_selected = $val['cog_student_item'];
			?>
				<tr><td><?php echo ucwords(strtolower($school_setup->cog_name))?></td>
                <td><?php echo ($item_selected ==1? '&#x2714' : '') ?></td>
                 <td><?php echo ($item_selected ==2? '&#x2714' : '') ?></td>
                  <td><?php echo ($item_selected ==3? '&#x2714' : '') ?></td>
                   <td><?php echo ($item_selected ==4? '&#x2714' : '') ?></td>
                    <td><?php echo ($item_selected ==5? '&#x2714' : '') ?></td>
               </tr>
               <?php	
						}}
								?>
               </table>
               
               		</td>
                   
                    
                                
                  </td> 
                              	
             </tr>
             <tr><td><font size="+1"><i>Maximum Number of Subjects :</i></font><b><?php echo $getminimumandmaximumsubjectslimit->max_limit ?></b></td><td><font size="+1"><i>Minimum Number of Subjects:</i></font><b><?php echo $getminimumandmaximumsubjectslimit->min_limit ?></b></td><td><font size="+1"><i>Number of Subject Offered:</i></font><b><?php echo $numberofsubjectsstudentoffered; ?></b></td></tr> 
               <tr><td><font size="+1"><i>Form Master's Remark:</i></font></td><td colspan="3"><?php echo  ucwords(strtolower($student_remark)) ?></td></tr> 
                 <tr><td><font size="+1"><i>Principal's Remark:</i></font></td><td colspan="3"><?php echo ucwords(strtolower($principal_remark)); ?></td></tr> 
			</table>   
		</td>
		</tr></table>
   <!-- <button onclick="window.print();" >print</button>-->
    <?php// } ?>
</center>
</div>

</body>
 <script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</html>
