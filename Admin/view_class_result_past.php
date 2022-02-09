<?php
session_start();
ob_start();
	if(!isset($_SESSION['USERNAME'])){
	echo "<script>
location='../'
</script>";
}
//Instantiate classes
require_once('../classes/class.Subject.php');
include_once('../classes/class.Scores_history.php');

/*include_once('../classes/class.Classarm.php');
include_once('../classes/class.Session.php'); 
include_once('../classes/class.studentclasses.php');
include_once('../classes/class.term.php');
include_once('../classes/class.Scores.php');*/

require_once('../classes/class.students.php');
$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$subject=new Subject();
$createscore = new ScoresHistory();
$database= new Database();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<!doctype html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

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

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
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
	
	function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getarm(armid) {		
		
		var strURL="findarm.php?armid="+armid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('classarmid').innerHTML=req.responseText;
												
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getsubject(classid) {		
		var strURL="findsubject.php?classid="+classid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subjectid').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	function getCity(studentrec,subj) {		
		var strURL="findrecords.php?studentrec="+studentrec+"&subj="+subj;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('recdiv').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	function show(student_term,students_class,session,students_classarm,regno){
		window.open('grade_cognitive_skills.php?student_term='+student_term+'&students_class='+students_class+'&session='+session+'&students_classarm='+students_classarm+'&regno='+regno,'Grade Student Cognitive Skills','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
	}
	function showResult(student_term,students_class,session,students_classarm,admission_no){
		window.open('view_student_results.php?student_term='+student_term+'&students_class='+students_class+'&session='+session+'&students_classarm='+students_classarm+'&admission_no='+admission_no,'Grade Student Cognitive Skills','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
	}
    </script> 
    <style type="text/css">
    .Table
    {
        display: table;
		width:auto;
		
		
		
		
		
    }
    .Title
    {
        display: table-caption;
        text-align: center;
        font-weight: bold;
        font-size: larger;
    }
    .Heading
    {
        display: table-row;
        font-weight: bold;
        text-align: center;
    }
    .Row
    {
        display: table-row;
    }
    .Cell
    {
        display: table-cell;
        border: solid;
        border-width: thin;
       
    }
</style>


</head>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
                      <div class="btn btn-reddit btn-block"> <strong>Select Items to View Result</strong> </div>
                     <h3><strong><hr></strong></h3>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-3">
                           <select name="student_class" onselect="this.className" class="form-control">
    
      <?php
	  
	  foreach($studentclass->viewAllClasses() as $key => $val){
	  ?>
     <option value="<?php echo $val['class_code'] ?>"><?php echo $val['class_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select></div>                
<div class="col col-md-3">     
        <select name="classarm" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select> 
     </div>
      <div class="col col-md-3">
      <select name="term" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
   </div>
        <div class="col col-md-3">
      <select name="sessions" onChange="this.form.submit();" onselect="this.className" class="form-control">
      <option value="">-- Select Session --</option>
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
    </div>
   
                           
     
      
     
<!--    <div class="col col-md-1">
     
                           
                           <i class="fa fa-circle-o-notch fa-spin"></i>
                           <button title="send" type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['sessions'])){
	   
	   //get post values
	  // $students_subjects = $_POST['subject'];
	 
	   $student_term=$_POST['term'];
	 
	    $session=$_POST['sessions'];
		
	 
		 $students_class=$_POST['student_class'];
		 
	 
	   
		  $students_classarm=$_POST['classarm'];
		 
	 
	  $createscore->score_class_arm = $students_classarm;
	  //bind selected subject id to its variable and pass it into view subject a by its id to get the name of the subject 
		
		
		//same operation to get session description
		$createscore->score_session = $session;
		//get student regno from login session
		//$createscore->score_student_regno = $login;
		//same operation to get term name
		$createscore->score_term=$student_term;
		
		//same operation to get class name
		$createscore->score_class = $students_class;
		if(($_POST['term']==0) || ($_POST['sessions']==0) || ($_POST['student_class']==0) || ($_POST['classarm']==0)){
			 header("location:view_class_result.php?err=16");
		}elseif(!empty($createscore->view_scoresbyTermSessionClass())){
				 
		
	/*header("location:view_class_result1.php?student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm");*/
		
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
     
     <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class: <?php echo $studentclass->class_name.$classarm->class_arm_name?> &nbsp;&nbsp;&nbsp; TERM:<?php echo $term->term_name?> &nbsp;&nbsp;&nbsp; SESSION:<?php echo $availableSession->session_description?></h3>
            </div>
             <h3><strong><hr></strong></h3>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                     
                      <th>Admision No</th>
                      <th> Name</th>
                      
                     
                      <?php
                       if(!empty($createscore->view_class_result())){
						   foreach($createscore->view_class_result() as $key => $values)  {
							  
						   $subjectcode = $values['class_sub_subject_code'];
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
				
				 if(!empty($createscore->view_students_scores_class())){
		 foreach($createscore->view_students_scores_class() as $key => $values)  {
							
						   //get sudent name by his/her admission number
						    $student_admission_no = $values['score_student_regno'];
						$studentAction->student_regno =  $student_admission_no;
						  $studentAction->viewStudentbyID();
						    $createscore->score_student_regno = $student_admission_no;
						  
				  ?>
                   
                    
                      <td><?php echo $studentAction->student_regno?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
                       
                       <?php foreach($createscore->view_class_result() as $key => $values)  {
							    
						   $subjectcode = $values['class_sub_subject_code'];
						   $createscore->score_subject_code = $subjectcode;
						  foreach($createscore->view_students_scores_foreach_subject() as $key => $valls){;
 ?>
                      <td><?php echo $valls['score_total'] ?></td>
                      <?php }} ?>
                     <td>
                      <!--<button title="View Scores Details" class=""  onClick="showResult(<?php echo $student_term?>,<?php echo $students_class ?>,<?php echo $session?>,<?php echo $students_classarm?>,<?php echo $studentAction->student_regno ?>);"><span class=" btn-default fa fa-eye"></span></button> -->
                      <a href="view_student_results_past.php?student_term=<?php echo $student_term?>&students_class=<?php echo $students_class ?>&session=<?php echo $session?>&students_classarm=<?php echo $students_classarm?>&admission_no=<?php echo $student_admission_no ?>"  title="View Student Result"><span class=" btn btn-success fa fa-eye-slash" ></span></a>
                     </td> </tr>
 
           
   <div class="modal fade" id="update_modal<?php echo $student_admission_no?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">

				<div class="modal-header">
					<h3 class="modal-title">Scores Details</h3>
				</div>
				<div class="modal-body">
                <div class="form-group col-md-12">
				<label><i>NAME:<?php echo $studentAction->last_name." ".$studentAction->first_name ?></i></label>&nbsp;&nbsp;&nbsp;<label><i>ADMISSION NO:<?php echo $studentAction->student_regno ?></i></label>&nbsp;&nbsp;&nbsp; 
    <label><i>SEX:<?php echo $studentAction->sex ?></i></label>&nbsp;&nbsp;&nbsp;
   <label><i>ACADEMIC SESSION:<?php echo $availableSession->session_description ?></i></label>
    <label><i>TERM:<?php echo $term->term_name?></i></label>
    <label><i>CLASS:<?php echo $studentclass->class_name. $classarm->class_arm_name?></i></label>
    
    </div>
   
    
<div  class="table" style="overflow:auto;">
    <div class="Title">
        <p></p>
    </div>
    <div class="Heading">
        
        <div class="Cell">
            <p><i>SUBJECTS</i></p>
        </div>
      
         <?php foreach($database->Resultset("SELECT * FROM sms_exam_type") as $key =>$vals){  ?>
           <div class="Cell">
            <p><i><?php echo $vals['exam_name']. "(".$vals['exam_marks']."%)" ?></i></p>
             </div>
            <?php }?>
       
        <div class="Cell">
      
            <p><i>Total</i></p>
            
        </div>
         
    </div>
  
	
    


				
   
	
			
            <?php  
	$sn=0;
	$createscore->score_class = $students_class; 
	 $createscore->score_class_arm = $students_classarm;
	 $createscore->score_student_regno = $studentAction->student_regno;
		
	
		$createscore->score_term= $student_term;
		$createscore->score_session = $session;
		
	
		foreach($createscore->view_scoresbystudent() as $key => $val){
			
			
		$sn++;
		//get the subject name from its code
		$subjectcode = $val['score_subject_code'];
		
		$subject->subject_id = $subjectcode;
		$subject->viewSubjectByID();
		//get student's grade and remark from sms_grade model
				
				
		//get the highest value in a subject
		
	
		
		 ?>
        
         <div class="Row">
        
        <div class="Cell">
            <p><i><?php echo ucwords($subject->subject_name) ?></p>
        </div>
        <div class="Cell">
            <p><i><?php echo $val['score_CA1']  ?></p>
        </div>
        <div class="Cell">
            <p><i><?php echo $val['score_CA2']  ?></p>
        </div><div class="Cell">
            <p><i><?php echo $val['score_CA3']  ?></p>
        </div><div class="Cell">
            <p><i><?php echo $val['score_exam']  ?></p>
        </div><div class="Cell">
            <p><i><?php echo $val['score_total']  ?></p>
        </div>
    </div>
			
           <?php }?>
    <button onClick="window.print();" >print</button>

				
				<div class="modal-footer">
					
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    
                    </div></div></div> 
                    
				</div></div></div>
     
 <?php }} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "No Records Found for the Selected Items";} } ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  

    <!-- Right Panel -->

    
     <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
		$("#sub").click(function() {
    $("#sub").val("Submiting...");
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
</body>
</html>
