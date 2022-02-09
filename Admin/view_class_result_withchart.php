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

  <title>View Class Result </title>

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
	function showResult(admission_no,student_term,students_class,session,students_classarm){
		window.open('view_student_results.php?admission_no='+admission_no+'&student_term='+student_term+'&students_class='+students_class+'&session='+session+'&students_classarm='+students_classarm,'Grade Student Cognitive Skills','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
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
     
     <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
               <div class="btn btn-reddit btn-block"> <strong>Class: <?php echo $studentclass->class_name.$classarm->class_arm_name?> &nbsp;&nbsp;&nbsp; TERM:<?php echo $term->term_name?> &nbsp;&nbsp;&nbsp; SESSION:<?php echo $availableSession->session_description?></strong></div>
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
							  
						 // $subjectcode = $values['score_subject_code'];
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
		 foreach($createscore->view_students_scores_class() as $key => $values){
							
						   //get sudent name by his/her admission number
						    $student_admission_no = $values['score_student_regno'];
						$studentAction->student_regno =  $student_admission_no;
						  $studentAction->viewStudentbyID();
						    $createscore->score_student_regno = $student_admission_no;
						  
				  ?>
                   
                      
                      <td><?php echo $studentAction->student_regno?></td>
                      <td><?php echo $studentAction->last_name; ?></td>
                       
                       <?php foreach($createscore->view_class_result() as $key => $values)  {
							    
						   $subjectcode = $values['class_sub_subject_code'];
						   $createscore->score_subject_code = $subjectcode;
						  foreach($createscore->view_students_scores_foreach_subject() as $key => $valls){;
 ?>
                      <td><?php echo $valls['score_total'] ?></td>
                      <?php }} ?>
                     <td><form method="post"> <input type="hidden" name="student_no"  id="student_no"value="<?php echo $student_admission_no?>"> <button title="View Scores Chart" id="btnSubmit" onClick="showExamMarks(this)" class=""  type="button" ><span class=" fa fa-bar-chart-o"></span></button></form>
                    <!-- <button title="Grade Student psychomotive Skills"  onClick="show(<?php echo $student_term?>,<?php echo $students_class ?>,<?php echo $session?>,<?php echo $students_classarm?>,<?php echo $studentAction->student_regno ?>);"><span class=" btn-primary fa fa-pencil"></span></button>
                     <button title="View student result<?php echo $student_admission_no ?>" onClick="showResult(<?php echo $student_admission_no ?>,<?php echo $student_term?>,<?php echo $students_class ?>,<?php echo $session?>,<?php echo $students_classarm?>);"><span class=" btn-success fa fa-eye"></span></button>   -->
                      <!-- <a href="grade_cognitive_skills.php?student_term=<?php echo $student_term?>&students_class=<?php echo $students_class ?>&session=<?php echo $session?>&students_classarm=<?php echo $students_classarm?>&regno=<?php echo $student_admission_no ?>"  title="Grade Student Cognitive Skills"><span class="fa fa-pencil fa-1x" ></span></a>-->
                  
                      <!--<a href="view_student_results.php?student_term=<?php echo $student_term?>&students_class=<?php echo $students_class ?>&session=<?php echo $session?>&students_classarm=<?php echo $students_classarm?>&admission_no=<?php echo $studentAction->student_regno ?>"  title="  View Student Result"><span class="fa fa-eye-slash success" ></span></a>-->
                    
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
  
  
  <script>
function showExamMarks(){
//MSK-000109
	
	var index = <?php echo $students_class  ?>;
	var year = document.getElementById("year").value;
	var exam = document.getElementById("exam").value;
	
	if(exam == 'Select Exam'){
		$('#divExam').addClass('has-error');
		$('#divExam1').addClass('has-feedback');
		$('#divExam1').append('<span id="spanExam" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The exam is required" ></span>');	
					
		$("#exam").change(function() {
							//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			$('#divExam').removeClass('has-error has-feedback');
			$('#spanExam').remove();
						
		});
	}
	
	if(year == 'Select Year'){
		$('#divYear').addClass('has-error');
		$('#divYear1').addClass('has-feedback');
		$('#divYear1').append('<span id="spanYear" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The year is required" ></span>');	
					
		$("#year").change(function() {
							//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			$('#divYear').removeClass('has-error has-feedback');
			$('#spanYear').remove();
						
		});
	}
	
	
	if(exam == 'Select Exam' || year == 'Select Year'){
		$("#btnSubmit").attr("disabled", true);
	}else{
		var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table1').innerHTML = this.responseText;//MSK-000111
				window.scrollTo(0,document.body.scrollHeight);
				var subject = document.getElementById('chartLable').value;
				var marks = document.getElementById('chartData').value;
				
				showBarChart(subject,marks)	;
								
    		}
			
  		};
			
    	xhttp.open("GET", "my_exam_marks1.php?exam="+exam +  "&year="+year +  "&index="+index, true);												
  		xhttp.send();//MSK-000110-End Ajax
		
	}
	
	
};

function showBarChart(subject,marks){
	
	 $("#barChart").show();	
	 $("#lineChart").hide();
	 $("#pieChart").hide();
	 $("#doughnutChart").hide();
 
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("barChart"), {
		type: 'bar',
		data: {
		  labels: subject1,
		  datasets: [
			{
			  label: "Number of Days",
			  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			  data: marks1
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

};

function showLineChart(subject,marks){
	
	 $("#lineChart").show();	
	 $("#barChart").hide();
	 $("#pieChart").hide();
	 $("#doughnutChart").hide();
 
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  labels: subject1,
		  datasets: [
			{
			  label: "Number of Days",
			  borderColor: "#3e95cd",
			  fill: false,
			  data: marks1
			 
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

};

function showPieChart(subject,marks){
	
	$("#pieChart").show();	
 	$("#barChart").hide();
 	$("#lineChart").hide();
 	$("#doughnutChart").hide();
	
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("pieChart"), {
		type: 'pie',
		data: {
		  labels: subject1,
		  datasets: [{
			label: "Population (millions)",
			backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			data: marks1
		  }]
		},
		options: {
		  title: {
			display: true,
			text: ''
		  }
		}
	});


};

function showDoughnutChart(subject,marks){

	$("#doughnutChart").show();	
 	$("#barChart").hide();
 	$("#lineChart").hide();
 	$("#pieChart").hide();
	
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("doughnutChart"), {
		type: 'doughnut',
		data: {
		  labels: subject1,
		  datasets: [
			{
			  label: "Population (millions)",
			  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			  data: marks1
			}
		  ]
		},
		options: {
		  title: {
			display: true,
			text: ''
		  }
		}
	});

};

</script>

 <?php }else{ echo "No Records Found for the Selected Items";} } ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  

    <!-- Right Panel -->

    
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
