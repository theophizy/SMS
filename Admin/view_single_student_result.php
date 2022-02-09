<?php
include_once("sessionStart.php"); 

//Instantiate classes
require_once('../classes/class.Grades.php');
//include_once('../classes/class.Scores.php');
include_once('../classes/class.school_setup.php');
require_once('../classes/class.students.php');
//require_once('../classes/class.Subject.php');
// instantiate classes

$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$subject=new Subject();
$createscore = new Scores();
$database= new Database();
$getgrade = new Grade();
$school_setup = new SchoolSetup();

$studentAction->student_regno = $_GET['regno'];
$studentAction->viewStudentbyID();
$student_term = $_GET['student_term'];
 $session = $_GET['session'];
 $students_class = $_GET['students_class'];
 $students_classarm = $_GET['students_classarm'];
 // id for student's total marks obtained in a particular term in sms_average_score model
 $admission_number = $_GET['regno'];
  $avg_code =  $admission_number.$students_class.$students_classarm.$session.$student_term;
  $createscore->avg_code = $avg_code;
 
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
	$createscore->score_student_regno = $_GET['regno'];
	$createscore->score_term = $student_term;
	$createscore->score_student_regno = $_GET['regno'];
$total_subjects_by_student = $createscore->number_subjects_student_enrolled();

	//$position_in_class = $createscore->position_in_class($login);
	$createscore->avg_class = $students_class;
	$createscore->avg_class_arm = $students_classarm;
	$createscore->avg_term = $student_term;
	$createscore->avg_session = $session;
	$student_class_postion = $createscore->position_in_class($_GET['regno']);
	$printsufix = $createscore->print_suffix($student_class_postion);
	//get total number of students who sat for exams in a term, session, class and class arm
	$total_students = $createscore->number_students_who_sat_exams();
	$school_setup->cog_student_reg = $_GET['regno'];
$school_setup->cog_student_class = $students_class;
$school_setup->cog_student_session = $session;
$school_setup->cog_student_term = $student_term;
?>

<?php  include_once('metadatda.php'); ?>

  <title>Student Result</title>

  <?php  include_once('links.php'); ?>
  <!-- Custom styles for this template-->

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
</head>
<?php include_once('navBar.php'); ?>

<body>
 <div class="content mt-3">

<center >
	<table border=1 style=" max-width:2480px; width:100%" >
		
	<tr>
	<td>
			<table style="width:100%;" bgcolor="#7woh">
            <tr><td><table style="width:100%;" border="1">
				<tr><td colspan="2">NAME:<?php echo $studentAction->last_name." ".$studentAction->first_name ?></td>&nbsp;&nbsp;<td colspan="2">ADMISSION NO:<?php echo $studentAction->student_regno ?></td><td colspan="2">SEX:<?php echo $studentAction->sex ?></td></tr>
			<tr><td colspan="2">ACADEMIC SESSION:<?php echo $availableSession->session_description ?></td>	
            <td colspan="4">TERM:<?php echo $term->term_name?></td>
            </tr>
				<tr><td colspan="2">CLASS:<?php echo $studentclass->class_name. $classarm->class_arm_name?></td> </tr>
				
            
               
               
				
				</table></td></td></tr>
			</table>
		</td>
		</tr>
		<tr>
		<td>
        <table border="1" width="100%"><tr><td>
			<table border="1" width="100%">
           
				<tr><th><i>S/N</i></th><th><i>SUBJECTS</i></th> <?php foreach($database->Resultset("SELECT * FROM sms_exam_type") as $key =>$vals){  ?>
     <th><i><?php echo $vals['exam_name']. "(".$vals['exam_marks']."%)" ?></i></th>
    <?php }?><th><i>Total</i></th></tr>
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
		$position = $createscore->position_in_subject($_GET['regno']);
		//get position's suffix like rd for 3rd or nd for 2nd
		$suffix = $createscore->print_suffix($position);
		
		 ?>
				<tr bgcolor="<?php echo $bg_color  ?>"><td><?php echo $sn; ?></td><td><?php echo ucwords($subject->subject_name) ?></td><td><?php echo $values['score_CA1']  ?></td><td><?php echo $values['score_CA2']  ?></td><td><?php echo $values['score_CA3']  ?></td><td><?php echo $values['score_exam']  ?></td><td><?php echo $values['score_total']  ?></td></tr>
               
        
         <?php } ?>       
				
				
			</table>
		</td>
                    	
             </tr>
		  </table>   
		</td>
	</tr></table>
    <button onclick="window.print();" >print</button>
</center>
</div>

</body>
    <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>

</html>
