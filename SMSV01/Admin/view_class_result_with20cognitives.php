<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
//Instantiate classes
/*require_once('../classes/class.Grades.php');
//require_once('../classes/class.Session.php');

//require_once('../classes/class.studentclasses.php');
//include_once('../classes/class.Scores.php');
include_once('../classes/class.school_setup.php');
require_once('../classes/class.students.php');
require_once('../classes/class.Subject.php');
// instantiate classes*/

$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$subject=new Subject();
$createscore = new Scores();
$database= new Database();
//$getgrade = new Grade();

/*$student_term = $_GET['student_term'];
 $session = $_GET['session'];
 $students_class = $_GET['students_class'];
 $students_classarm = $_GET['students_classarm'];*/
 // id for student's total marks obtained in a particular term in sms_average_score model
 
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
	//$createscore->score_student_regno = $login;
	$createscore->score_term = $student_term;
	

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  
</head>

<body>
 <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
                <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class: <?php echo $studentclass->class_name.$classarm->class_arm_name?> &nbsp;&nbsp;&nbsp; TERM:<?php echo $term->term_name?> &nbsp;&nbsp;&nbsp; SESSION:<?php echo $availableSession->session_description?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Admision No</th>
                      <th> Name</th>
                      
                     
                      <?php
                       if(!empty($createscore->view_class_result())){
						   foreach($createscore->view_class_result() as $key => $values)  {
							  
						   $subjectcode = $values['score_subject_code'];
						   //get subject name by its id
						   $subject->subject_id = $subjectcode;
						   $subject->viewSubjectByID();
						 
						   ?>
                      <th><?php echo $subject->subject_code?></th>
                      <?php }} ?>
                      <th>Action</th>
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				 if(!empty($createscore->view_students_scores_class())){
		 foreach($createscore->view_students_scores_class() as $key => $values)  {
							
						   //get sudent name by his/her admission number
						    $student_admission_no = $values['score_student_regno'];
						$studentAction->student_regno = $values['score_student_regno'];
						  $studentAction->viewStudentbyID();
						    $createscore->score_student_regno = $student_admission_no;
						  
				  ?>
                   
                      <td><?php echo $sn++ ?></td>
                      <td><?php echo $studentAction->student_regno?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
                       
                       <?php foreach($createscore->view_class_result() as $key => $values)  {
							    
						   $subjectcode = $values['score_subject_code'];
						   $createscore->score_subject_code = $subjectcode;
						  foreach($createscore->view_students_scores_foreach_subject() as $key => $valls){;
 ?>
                      <td><?php echo $valls['score_total'] ?></td>
                      <?php }} ?>
                     <td><a href="view_single_student_result.php?student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&regno=$student_no"><span class=" btn-default fa fa-eye" title="View Student Scores Details"><span>&nbsp;&nbsp;&nbsp;</span></span><span class=" btn-primary fa fa-pencil" title="Grade Student Cognitive Skills"></span></a></td> </tr>
 
                    <?php  }} ?>
                  </tbody>
                </table>
              </div>
                </div>  
          
     
 
 </div>  

 </div>  
      
      </div>  
 </div>  
 </body>
 
 </html>
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
 });
 </script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
 
