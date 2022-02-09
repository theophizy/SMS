<?php
include_once("sessionStart.php"); 

//Instantiate classes
require_once('../classes/class.Subject.php');
require_once('../classes/class.students.php');
$classarm = new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$subject = new Subject();
$createscore = new Scores();
$database = new Database();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Current Result </title>

  <?php  include_once('links.php'); ?><head>
   

     <script type="text/javascript">
	
   
	
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
	function getstudentresult(student_term,students_class,session,students_classarm,admission_no) {		
		var strURL="view_student_results.php?student_term="+student_term+"&students_class="+students_class+"&session="+session+"&students_classarm="+students_classarm+"&admission_no="+admission_no ;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('printResult').innerHTML=req.responseText;						
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
   
	
function printContent(el){
	var restorepage = $('body').html();
	var printcontent = $('#'+ el).clone();
	$('body').empty().html(printcontent);
	window.print() ;
	$('body').html(restorepage);
	
	
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
     </select> </div>                
<div class="col col-md-3">     
       <select name="classarm" onChange="this.form.submit();" onselect="this.className" class="form-control">
     <option value="">-- Select Classarm --</option>
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>   
</div>
       <!-- <div class="col col-md-3">
      <select name="sessions" onselect="this.className" class="form-control">
      <option value="0">session</option>
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
     <font color="#FF0000">*</font></div> -->
   
                           
     
      
     
     
    <div class="col col-md-1">
     
                      <!--      
                           <i class="fa fa-circle-o-notch fa-spin"></i>
                           <button title="send" type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button>--> </div></div>
</form>
    
 </div></div></div>
      
   <?php
  
   if(isset($_POST['classarm'])){
	   
	   //get post values
	  // get the current academic session;
	  $term->getCurrentTermAndSession();
	 
	   $student_term = $term->current_term;
	 
	    $session = $term->current_session;
		
	 
		 $students_class = $_POST['student_class'];
		 
	 
	   
		  $students_classarm = $_POST['classarm'];
		 
	 
	  $createscore->score_class_arm = $students_classarm;
	 
		$createscore->score_session = $session;
		
		$createscore->score_term = $student_term;
		
		
		$createscore->score_class = $students_class;
		if(($_POST['student_class']==0) || ($_POST['classarm']==0)){
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
     <div class="row">
     <div class="box-header">
               <div class="btn btn-reddit"> <strong>Class: <?php echo $studentclass->class_name.$classarm->class_arm_name?> &nbsp;&nbsp;&nbsp; TERM:<?php echo $term->term_name?> &nbsp;&nbsp;&nbsp; SESSION:<?php echo $availableSession->session_description?></strong></div>
            </div>
            <h3><strong><hr></strong></h3>
     <div class="col-md-10" align="left">
     <div class="table-responsive" >  
                   
              
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    
                      <th>Admision No</th>
                      <th> Name</th>
                       <th> Action</th>
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				 
				 if(!empty($createscore->view_students_scores_class())){
		 foreach($createscore->view_students_scores_class() as $key => $values){
							
						   //get sudent name by his/her admission number
						    $student_admission_no = $values['score_student_regno'];
						$studentAction->student_regno =  $student_admission_no;
						  $studentAction->viewStudentbyID();
						    $createscore->score_student_regno = $student_admission_no;
						  
				  ?>
                   
                     
                        <td><?php echo $studentAction->student_regno?></td>
                      <td><?php echo $studentAction->last_name ." " . $studentAction->first_name; ?></td>
                      <td>
                        <button title="View student result" onClick="getstudentresult(<?php echo $student_term?>,<?php echo $students_class ?>,<?php echo $session?>,<?php echo $students_classarm?>,<?php echo $studentAction->student_regno ?>)"><span class=" btn-success fa fa-eye"></span></button>  
 <button title="Grade Student psychomotive Skills"  onClick="show(<?php echo $student_term?>,<?php echo $students_class ?>,<?php echo $session?>,<?php echo $students_classarm?>,<?php echo $studentAction->student_regno ?>);"><span class=" btn-primary fa fa-pencil"></span></button>
                    </td>
                    
        
                     
                     </tr>
 
           
   
			
         
  
     
 <?php }} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "No Records Found for the Selected Items";} } ?>
     
     </div>
</div>
       
        
        <div class="col-md-8"  id="printResult">
        
                  
        </div>
         <!-- .content -->
    </div><!-- /#right-panel -->
  </div>

    <!-- Right Panel -->

  
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
