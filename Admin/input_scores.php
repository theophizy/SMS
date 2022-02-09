<?php include_once("sessionStart.php"); ?>

<?php

//require_once('../classes/class.article.php');

//Instantiate classes
include_once('../classes/class.school_setup.php');
require_once('../classes/class.Grades.php');
//include_once('../classes/class.Scores.php');

require_once('../classes/class.students.php');
// instantiate classes
$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$subject = new Subject();
$createscore = new Scores();
$database= new Database();
$getgrade = new Grade();
$school_setup = new SchoolSetup(); 

//get all this values from the choosen data to be scored from scores2.php
$student_term = $_GET['student_term'];
	    $session = $_GET['session'];
		 $students_class = $_GET['students_class'];
		  $students_classarm = $_GET['students_classarm'];
		   $students_subjects = $_GET['students_subjects'];
		
		   // when submit button is clicked
	/* if (isset($_POST['send'])){
		 //get the inputed values from the text fields
		  $scorescodesss  = $_POST["scorecode"];
	 $score_ca1s = $_POST["CA1"];
	  $score_ca2s = $_POST["CA2"];
	   $score_ca3s = $_POST["CA3"];
	    $score_exams = $_POST["exam"];
		  $student_regss = $_POST["student_regno"];
//loop through each students scores
foreach($scorescodesss as $i => $score_codess){
	 $scorescodes  = $score_codess;
	 $score_ca1 = $score_ca1s[$i];
	 $score_ca2 = $score_ca2s[$i];
	 $score_ca3 = $score_ca3s[$i];
	 $score_exam = $score_exams[$i];
	 $student_reg = $student_regss[$i];
	  $avg_code =  $student_reg.$students_class.$students_classarm.$session.$student_term;
	
	 // sum each student's scores to a whole number
	$score_total= floor($score_ca1 + $score_ca2 + $score_ca3 + $score_exam);
	// get student grade acoording to his score in a subject
			$gradecode = $getgrade->getStudentGrade($score_total);
	// update student score in each subject 	
$update = $createscore->updatestudentscoresforeachsubject($scorescodes,$score_ca1,$score_ca2,$score_ca3,$score_exam,$score_total,$gradecode,$_SESSION['USERNAMNE']);
	//get student total marks in the whole exams
	$totalmarksobtaindebystudent = $createscore->getStudentTotalMarksObtainedinExamswithParameters($student_reg,$students_class,$students_classarm,$student_term,$session);
	// update students total marks obtainded in the average scores table
	$createscore->updatestudenttotalscoresobtained($avg_code,$totalmarksobtaindebystudent);
		
	 }
	
  //if the update function is successful
  if($update == true){
	
		header("location:score_student1.php?emsg=1&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects");
			exit;
  }else{
	  //if the uodate funstion fails
		 header("location:score_student1.php?err=10&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects"); 
  }
  exit;
}	 
*/
//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Enter Student's Scores</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>
<head>
   

     <script type="text/javascript">
	 function isNumberKey(evt){
		 var charCode=(evt.which)? evt.which : event.keyCode;
		 if((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)  )
		 return false;
		 else
		 return true;
		
		 }
		 
		  function isNumber(evt){
			  evt = (evt) ? evt : window.event;
		 var charCode=(evt.which)? evt.which : evt.keyCode;
		 if(charCode > 31 && (charCode < 46 || charCode >57))
		 return false;
		 else
		 return true;
		
		 }
    function sum(){
		var first = document.getElementById('text1').value; 
		var second = document.getElementById('text2').value; 
		var result = parseInt(first) +  parseInt(second) ; 
		if(!isNaN(result)){
			document.getElementById('text3').value = result;
			}
	}
	
	 function checkValue(input,test){
	
	if(input.value < 0 || input.value > test){
		alert("Specifield value exceeded");
		input.value = 0;
		
}}
 function checkexam(input,values){
	if(input.value < 0 || input.value > values){
		alert("Specifield value exceeded" );
		input.value = 0;
		
}}
    </script> 

</head>
<?php include_once('navBar.php'); ?>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-12">

      
   <?php
  
	  //bind selected records to various variables
	  $createscore->score_class_arm = $students_classarm;
	   $classarm->class_arm_code = $students_classarm;
	  	$classarm->viewClassArmByID();
		//bind selected subject id to its variable and pass it into view subject a by its id to get the name of the subject 
		$createscore->score_subject_code = $students_subjects;
		$subject->subject_id = $students_subjects;
		$subject->viewSubjectByID();
		//same operation to get session description
		$createscore->score_session = $session;
		$availableSession->session_code = $session;
		$availableSession->viewSessionByID();
		//same operation to get term name
		$createscore->score_term=$student_term;
		$term->term_code=$student_term;
		$term->viewTermByID();
		//same operation to get class name
		$createscore->score_class = $students_class;
		$studentclass->class_code = $students_class;
		$studentAction->student_classarm = $students_classarm;
		$studentclass->viewclassByID();
		
   ?>
   
    
  
             
               
     
                 
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="col-lg-12">
            <div class="btn btn-reddit btn-block" align="center"> <strong>Score Entering Template</strong> </div>
             <h3> <strong><hr></strong>  </h3>
              <div class="btn btn-reddit btn-block" align="center"> <strong>Term:<?php echo $term->term_name  ?>&nbsp;&nbsp;&nbsp;&nbsp;Session:<?php echo $availableSession->session_description ?>&nbsp;&nbsp;&nbsp;&nbsp;Class:<?php echo $studentclass->class_name. $classarm->class_arm_name ?>&nbsp;&nbsp;&nbsp;&nbsp;Subject:<?php echo $subject->subject_name ?></strong></div>
                 <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new  student to this subject</button>  
                     </div> 
    
     <div class="table-responsive" >  
                     
                  
                   <div class="box">
            <div class="box-header">
              <h3 ><strong><hr></strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
     <th>Sn</th>
     <th>Admission No</th>
     <th>Name</th>
     <?php foreach($getgrade->viewAllExamType() as $key =>$vals){  ?>
     <th><?php echo $vals['exam_name']. "(".$vals['exam_marks']."%)" ?></th>
    <?php }?>
      <th>Total</th>
       <th>Action</th>
     </tr>
       </thead>
      <?php
	
	   $sno=0;
	$date = date('Y-m-d');
		$createscore->score_class=$students_class;
	$createscore->score_class_arm = $students_classarm;
		$createscore->score_subject_code = $students_subjects;
		$createscore->score_term = $student_term;
		$createscore->score_session = $session;
		$school_setup->duration_session = $session;
		$school_setup->duration_term = $student_term;
		//invokr view scores by scored code. the score code is a combination of class. class arm, subject code,term,session and studen admission number.
	  foreach($createscore->view_scoresbyScoreCode() as $key => $value){
		  $studentAction->student_regno = $value['score_student_regno'];
		   $studentAction->viewStudentbyID();
		  $sno++;
		$readonlystatus;
		foreach($school_setup->view_score_durationByTermandSession() as $key => $val){
			$startdate = $val['start_date'];
			$enddate = $val['end_date'];
			$readonlystatus = $school_setup->datediff($date,$startdate,$enddate);
			}
	  ?>
     
   
     <tbody>
     <tr>
      <td><?php echo $sno ?></td>
     <td><?php echo  $value['score_student_regno'];  ?></td>
      
      <td><?php echo $studentAction->last_name. "  ". $studentAction->first_name?></td>
     
        <?php $firstexamcode = $getgrade->viewExamTypeByID(1);  ?> 
   
        <td><?php echo $value['score_CA1']  ?></td>  
         <?php $secondexamcode = $getgrade->viewExamTypeByID(2); ?>
         <td ><?php echo $value['score_CA2']  ?></td>
		 
		 <?php $thirdexamcode = $getgrade->viewExamTypeByID(3); ?>
          <td><?php echo $value['score_CA3']  ?></td>
          
          
           <?php $fourthexamcode = $getgrade->viewExamTypeByID(4);  ?>
           <td><?php echo $value['score_exam']  ?></td>
           
           <?php  if(!empty($value['score_total'])){  ?>
           <td><?php echo $value['score_total'] ?></td>
    <?php } ?>
     <td>
     <?php if($readonlystatus === "show"){ ?>
     <button title="Enter Student Scores" class="btn-success" data-toggle="modal" type="button" data-target="#score_modal<?php echo $value['score_code']  ?>">Input</button><?php } ?></td>
     </tr>
   
    
  
     
   
                       
                  
    
    <!-- enter student scores modal --> 
    
    
    <div id="score_modal<?php echo $value['score_code']?>" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    
                      <div class="btn btn-reddit btn-block" align="center"> <strong>Enter Student Scores</strong> </div>
             <h3> <strong><hr></strong>  </h3> 
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form action="../Control_classes/Scores_controller.php?action=enterStudentscores" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" >
                           
                          
 
                          <div class="row form-group">
                            <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Admission Number</label></div>
                            <div class="col-3 col-md-8">
                            
                            <input type="hidden" name="scorecode"   value="<?php echo $value['score_code']  ?>" > 
                            <input type="hidden" name="session"   value="<?php echo $session  ?>" >
                             <input type="hidden" name="student_term"   value="<?php echo $student_term  ?>" >
                             <input type="hidden" name="students_class"   value="<?php echo $students_class  ?>" > 
                             <input type="hidden" name="students_classarm"   value="<?php echo  $students_classarm  ?>" > 
                             <input type="hidden" name="students_subjects"   value="<?php echo $students_subjects  ?>" >
                            
                            <input type="text" name="regno"  class="form-control" value="<?php echo  $value['score_student_regno'];  ?>" readonly></div>
                          </div>
                           <div class="row form-group">
                            <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name </label></div>
                            <div class="col-3 col-md-8">
                          
                            <input type="text"  class="form-control" value="<?php echo $studentAction->last_name. "  ". $studentAction->first_name?>" readonly></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">First CA (CA1)</label></div>
                            <div class="col-3 col-md-8">
                            <?php $firstexamcode = $getgrade->viewExamTypeByID(1);  ?> 
   
       <input type="number" name="CA1" class="form-control" value="<?php echo $value['score_CA1']  ?>" required  onKeyPress="return isNumber(event)"  onChange="checkValue(this,<?php echo $firstexamcode->exam_marks ?>)" >  </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Second CA (CA2)</label></div>
                            <div class="col-3 col-md-8">
                            <?php $secondtexamcode = $getgrade->viewExamTypeByID(2);  ?> 
   
       <input type="number" name="CA2" class="form-control"   value="<?php echo $value['score_CA2']  ?>" required  onKeyPress="return isNumber(event)"  onChange="checkValue(this,<?php echo $secondtexamcode->exam_marks ?>)">  </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Third CA (CA3)</label></div>
                            <div class="col-3 col-md-8">
                            <?php $thirdtexamcode = $getgrade->viewExamTypeByID(3);  ?> 
   
        <input type="number" name="CA3" class="form-control" value="<?php echo $value['score_CA3']  ?>" required  onKeyPress="return isNumber(event)"  onChange="checkValue(this,<?php echo $thirdtexamcode->exam_marks ?>)"> </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Exams </label></div>
                            <div class="col-3 col-md-8">
                            <?php $fourthtexamcode = $getgrade->viewExamTypeByID(4);  ?> 
   
       <input type="number" name="exams" class="form-control"  value="<?php echo $value['score_exam']  ?>" required  onKeyPress="return isNumber(event)"  onChange="checkexam(this,<?php echo $fourthtexamcode->exam_marks ?>)"> </div>
                          </div>
                          <div class="row form-group" align="center">
                          <button name="send" type="submit" class="btn btn-primary"></span> Submit</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button></div>
                          </div>
                        </form>
                      </div>
              
      </div>  
 </div> 
  
    <?php } ?>    
     </tbody>
     </table>
   <!-- end --></div></div>
    
<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button> 
                      <div class="btn btn-reddit btn-block" align="center"> <strong>Add student to the selected subject</strong> </div>
             <h3> <strong><hr></strong>  </h3> 
                     
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form action="../Control_classes/Scores_controller.php?action=createscoresfrommodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost(); ">
                           
                          
 
                          <div class="row form-group">
                            <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Class</label></div>
                            <div class="col-3 col-md-8">
                            <input type="hidden" name="score_class" value="<?php echo $students_class ?>" />
                             <input type="hidden" name="score_class_arm" value="<?php echo $students_classarm ?>" />
                            <input type="text"  class="form-control" value="<?php echo $studentclass->class_name.$classarm->class_arm_name?>" readonly></div>
                          </div>
                         
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Subject</label></div>
                            <div class="col-3 col-md-8">
                             <input type="hidden" name="score_subject" value="<?php echo $students_subjects ?>" />
                            <input type="text" class="form-control" value="<?php echo $subject->subject_name ?>" readonly></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Session</label></div>
                            <div class="col-3 col-md-8">
                             <input type="hidden" name="score_session" value="<?php echo $session ?>" />
                            <input type="text"  class="form-control" value="<?php echo $availableSession->session_description ?>" readonly></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Term</label></div>
                            <div class="col-3 col-md-8">
                             <input type="hidden" name="score_term" value="<?php echo  $student_term ?>" />
                            <input type="text"   class="form-control" value="<?php echo $term->term_name ?>" readonly></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Student </label></div>
                            <div class="col-3 col-md-8"><select name="student_regno" class="form-control"><?php    
							foreach($studentAction->viewStudentbyClassandClassarm() as $keys => $valls){
						
				?>
                <option value="<?php echo $valls['student_regno']?>"><?php echo $valls['student_regno']." ".$valls['last_name']."          ".$valls['first_name']?></option>
                            <?php 	}?>
                            </select></div>
                          </div>
                          <div class="row form-group">
                           <div class="col-6 col-md-9" align="center">
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <i class="fa fa-refresh fa-spin"></i><input type="submit" id="sub" name="push" value="Save" class="btn btn-success"></div>
                          </div>
                        </form>
                      </div>
                     
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
      
      </div>  
 </div>  
    <!-- Right Panel -->

    
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
