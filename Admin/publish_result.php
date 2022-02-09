<?php
include_once("sessionStart.php"); 

//Instantiate classes
require_once('../classes/class.Subject.php');
/*include_once('../classes/class.Classarm.php');
include_once('../classes/class.Session.php'); 
include_once('../classes/class.studentclasses.php');
include_once('../classes/class.term.php');
include_once('../classes/class.Scores.php');*/
include_once('../classes/class.Classarm.php');
require_once('../classes/class.students.php');
$classarm = new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$subject=new Subject();
$createscore = new Scores();
$database= new Database();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Publish Result</title>

  <?php  include_once('links.php'); ?>
<head>
   

     <script type="text/javascript">
	
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
	
	
    </script> 
   
</head>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
                     <div class="btn btn-reddit btn-block"> <strong>Select items to publish result</strong> </div>
                      <div class="card-header" align="center">
                        <strong><hr></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-3">
                          <select name="student_class" onselect="this.className" class="form-control" required >
     
      <?php foreach($studentclass->viewAllClasses() as $key =>$val){
		  $studentclass->class_code = $val['class_code'];
		  $studentclass->viewclassByID()
		   ?>
     <option value="<?php echo $studentclass->class_code ?>"><?php  echo $studentclass->class_name?></option>
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
     </select></div>
        <div class="col col-md-3">
      <select name="sessions" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
     <font color="#FF0000">*</font></div>
   
                           
     
       <div class="col col-md-3">
      <select name="term" onselect="this.className" onChange="this.form.submit();" class="form-control">
      <option value="">--Select Term--</option>
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
     <font color="#FF0000">*</font></div>
     
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>
                           <button title="send" type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['term'])){
	   
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
			 header("location:publish_result.php?err=16");
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
             <div class="btn btn-reddit btn-block"> <strong>Class: <?php echo $studentclass->class_name.$classarm->class_arm_name?> &nbsp;&nbsp;&nbsp; TERM:<?php echo $term->term_name?> &nbsp;&nbsp;&nbsp; SESSION:<?php echo $availableSession->session_description?></strong></div><hr>
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
							  
						   $subjectcode = $values['class_sub_subject_code'];
						   //get subject name by its id
						   $subject->subject_id = $subjectcode;
						   $subject->viewSubjectByID();
						 
						   ?>
                      <th><?php echo $subject->subject_code?></th>
                      <?php }} ?>
                     
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
						$studentAction->student_regno =  $student_admission_no;
						  $studentAction->viewStudentbyID();
						    $createscore->score_student_regno = $student_admission_no;
						  
				  ?>
                   
                      <td><?php echo $sn++ ?></td>
                      <td><?php echo $studentAction->student_regno?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
                       
                       <?php foreach($createscore->view_class_result() as $key => $values)  {
							    
						   $subjectcode = $values['class_sub_subject_code'];
						   $createscore->score_subject_code = $subjectcode;
						  foreach($createscore->view_students_scores_foreach_subject() as $key => $valls){;
 ?>
                      <td><?php echo $valls['score_total'] ?></td>
                      <?php }} ?>
                     </tr>
 
            
     
 <?php }} ?>       
			
  	
		
                  </tbody>
                </table>
       </div></div></div>
<form  action="../Control_classes/Scores_controller.php?action=publish_result" method="post" enctype="multipart/form-data" class="form-horizontal" name="frmactive" >
            <input type="hidden" name="student_class" value="<?php echo $students_class?>"/>
            <input type="hidden" name="student_classarm" value="<?php echo $students_classarm?>"/>
            <input type="hidden" name="term" value="<?php echo $student_term?>"/>
            <input type="hidden" name="sessions" value="<?php echo $session?>"/>
         <button class="btn btn-primary btn-block" name="publich" type="submit" onClick="return confirm('Publish Result?')">Publich Result</button>
         </form>

 <?php }else{ echo "No Records Found for the Selected Items";} } ?>
     
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  </div>

    <!-- Right Panel -->

       <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
