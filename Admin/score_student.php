<?php
include_once("sessionStart.php"); 
//Instantiate classes
include_once('../classes/class.school_setup.php');
require_once('../classes/class.Subject.php');

require_once('../classes/class.students.php');
$school_setup = new SchoolSetup();
$classarm = new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$subject = new Subject();
$database = new Database();
 $scoresAction = new Scores();
	
//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Input Student's Scores </title>

  <?php  include_once('links.php'); ?>
<head>
   

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<script language="javascript" type="text/javascript">
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
</script>
</head>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-3">

          <div class="btn btn-reddit btn-block"> <strong>Register subject for the selected term</strong> </div>
                     
                        <strong><hr></strong> 
 <div class="col-lg-4">
 
                    <div class="card">
                     
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
                            
         <div class=" col-md-4">                   
 
     <?php echo $studentclass->classSelectField(); ?><font color="#FF0000">*</font>
       <p id="classarmid"> </p>
       <p id="subjectid"></p>
      <select name="sessions" onselect="this.className" class="form-control">
      <option value="">session</option>
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
     <font color="#FF0000">*</font>
     
      
      <select name="term" onselect="this.className" class="form-control">
      <option value="">Term</option>
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
     <font color="#FF0000">*</font>
     
      
     </div>
     <div class="row form-group">
                           <div class="col-6 col-md-9" align="center">
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <i class="fa fa-refresh fa-spin"></i><input type="submit" id="sub" name="send" value="search" class="btn btn-success">  <input type="reset" name="reset" value="RESET" class="btn btn-danger"></div>
</form>
      <div class="card-body card-block">
       <form action="../Control_classes/Scores_controller.php?action=Update_scores"  method="post" enctype="multipart/form-data" class="form-horizontal" name="scoresForm">        
   <?php
   if(isset($_POST['send'])){
   if(isset($_POST['term']) && isset($_POST['subject']) && isset($_POST['sessions'])){
	    $studentAction->student_class = $_POST['student_class'];
	   $studentAction->student_classarm = $_POST['classarm'];
	  
	    $student_term = $_POST['term'];
	    $session = $_POST['sessions'];
		 $students_class = $_POST['student_class'];
		  $students_classarm = $_POST['classarm'];
		   $students_subjects = $_POST['subject'];
		   $school_setup->cog_student_session = $session;
		    $scoresAction->score_class = $students_class;
	$scoresAction->score_class_arm = $students_classarm;
		$scoresAction->score_subject_code = $students_subjects;
		$scoresAction->score_term = $student_term;
		$scoresAction->score_session = $session;
		if(!empty($scoresAction->view_scoresbySessionIfExist())){
			 header("location:score_student.php?err=26"); 
		}else
		if(!empty($school_setup->view_cognitivebySessionIfExist())){
header("location:score_student.php?err=27");
}else{
		if(empty($scoresAction->view_scoresbyScoreCode())){
	   if(!empty($studentAction->viewStudentbyClassandClassarm())){
 
   $date = date('Y/m/d');
	  foreach($studentAction->viewStudentbyClassandClassarm() as $key => $value){
		  $regno = $value['student_regno'];
		  
		
		   $scorecode = $regno.$students_subjects.$students_class.$students_classarm.$session.$student_term;
		   $totalmarkscode =  $regno.$students_class.$students_classarm.$session.$student_term;
		   $checkavgtabe =$database->Query("SELECT `avg_code` FROM `sms_average_scores` WHERE `avg_code`='$totalmarkscode'");
			if(isset($checkavgtabe) && $checkavgtabe < 1){
$database->InsertOrUpdate("INSERT INTO `sms_average_scores`(`avg_code`,`student_no`,`avg_class`,`avg_class_arm`,`avg_term`,`avg_session`,`student_average`,`result_view`) VALUES('$totalmarkscode','$regno','$students_class','$students_classarm','$student_term','$session','0.0','INACTIVE')");
			}else{
				 header("location:score_student.php?err=9");
			}
		   	$database->InsertOrUpdate("INSERT INTO `sms_scores`(`score_code`,`score_student_regno`,
`score_subject_code`,`score_class`,
`score_class_arm`,`score_term`,`score_session`,
`score_by`,`score_date`) 
VALUES('$scorecode','$regno','$students_subjects','$students_class',
'$students_classarm','$student_term','$session','{$_SESSION['USERNAME']}','$date')");
  
	  }
	  header("location:score_student.php?emsg=1");
	  }else{
		 header("location:score_student.php?err=9");  
	  }}else{
		   header("location:score_student.php?err=3");
		   }}
		  }}
	  ?>
      
                    </div>
           
                <!-- /# card -->
            </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

 
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
