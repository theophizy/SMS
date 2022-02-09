<?php
include_once("sessionStart.php"); 

//Instantiate classes
require_once('../classes/class.Subject.php');
//include_once('../classes/class.Scores.php');
require_once('../classes/class.students.php');
$classarm=new ClassArm();
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

  <title>Result Sheet</title>

  <?php  include_once('links.php'); ?>
<head>
   

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
		
		var strURL="findarm_student.php?armid="+armid;
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
	
	function getstudent(classarm) {		
		var strURL="findarm_studentresult.php?classarm="+classarm;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('studentid').innerHTML=req.responseText;						
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

   

         <div class="content mt-3">

          
 <div class="col-lg-4">
 
                    <div class="card">
                      <div class="card-header" align="center">
                        <strong>Select Items to View Result</strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-2">
                                             
		 <select name="student_class" onChange="getarm(this.value)" class="form-control" required >
      <option value="0"> Select Class</option>
      <?php foreach($studentclass->viewAllClasses() as $key =>$val){
		  $studentclass->class_code = $val['class_code'];
		  $studentclass->viewclassByID()
		   ?>
     <option value="<?php echo $studentclass->class_code ?>"><?php  echo $studentclass->class_name?></option>
    
	   <?php } ?>
     </select></div>                
<div class="col col-md-2">     
       <p id="classarmid"> </p></div>
       <div class="col col-md-2">     
       <p id="studentid"> </p></div>
        <div class="col col-md-3">
      <select name="sessions" onselect="this.className" class="form-control">
      <option value="0">session</option>
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
     <font color="#FF0000">*</font></div>
   
                           
     
       <div class="col col-md-2">
      <select name="term" onselect="this.className" class="form-control">
      <option value="0">Term</option>
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
     <font color="#FF0000">*</font></div>
     
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button title="send" type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['search'])){
	   
	   //get post values
	   $students_subjects = $_POST['subject'];
	   $student_term=$_POST['term'];
	   $login = $_POST['admission_no'];
	    $session=$_POST['sessions'];
		 $students_class=$_POST['student_class'];
		  $students_classarm=$_POST['classarm'];
	  $createscore->score_class_arm = $students_classarm;
	  //bind selected subject id to its variable and pass it into view subject a by its id to get the name of the subject 
		
		
		//same operation to get session description
		$createscore->score_session = $session;
		//get student regno from login session
		$createscore->score_student_regno = $login;
		//same operation to get term name
		$createscore->score_term=$student_term;
		
		//same operation to get class name
		$createscore->score_class = $students_class;
		 $publish_code = $_POST['student_class'].$_POST['classarm'].$_POST['term'].$_POST['sessions'];
		 $getpublis = $createscore->AvoidPublisDuplicate($publish_code);

		if(($_POST['term']==0) || ($_POST['sessions']==0) || ($_POST['student_class']==0) || ($_POST['classarm']==0) || ($_POST['admission_no']==0)){
			 header("location:resultsheet.php?err=16");
		}else
		if(empty($createscore->view_scoresbystudent())){
				 header("location:resultsheet.php?err=15");
			
		}
		elseif( isset($getpublis)&& $getpublis <= 0) {
			 header("location:resultsheet.php?err=21");
			
		}else{
	header("location:resultsheet1.php?student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&admission_no=$login");
		}
		}
   ?>
     
    
    
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
 </body>
</html>
