<?php include_once("sessionStart.php"); ?>
<?php

//include_once('../classes/class.Session.php');
//include_once('../classes/class.studentclasses.php');
include_once('../classes/class.school_setup.php');
//include_once('../classes/class.term.php');
//include_once('../classes/class.Scores.php');
include_once('../classes/class.Classarm.php');

require_once('../classes/class.students.php');
$classarm = new  ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$schoolsetup = new SchoolSetup();
$createScores = new Scores();
$database= new Database();
if (isset($_POST['submit'])){
		 //get the inputed values from the text fields
		  $avgcode  = $_POST["avg_code"];
	 $days_attended = $_POST["days_attended"];
	
	  
//loop through each students scores
foreach($avgcode as $i => $avg_codesss){
	 $avg_code  = $avg_codesss;
	 
	 
	 $days_attended1 = $days_attended[$i];
	 $update = $database->InsertOrUpdate("UPDATE `sms_average_scores` SET `attendance`='$days_attended1' WHERE `avg_code`='$avg_code'");

	 }
 if($update == true){
	
		header("location:attendance.php?emsg=1");
			exit;
  }else{
	  //if the uodate funstion fails
		 header("location:attendance.php?err=10"); 
  }
  exit;
	

}

//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Students Attendance</title>
<?php  include_once('links.php'); ?>


   

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
   
	
	function show(regno){
		window.open('update_student_record.php?regno='+regno,'Update student information','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
	}
	function un_check(){
for (var i = 0; i < document.frmactive.elements.length; i++) {
var e = document.frmactive.elements[i];
if ((e.name != 'allbox') && (e.type == 'checkbox')) {
e.checked = document.frmactive.allbox.checked;
}
}
}
function checkinput(input,values){
	if(input.value < 0 || input.value > values){
		alert("Specifield value exceeded" );
		input.value = 0;
		
}}   

 </script> 
   
</head>
<body>
<?php include_once('navBar.php'); ?>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
<div class="btn btn-reddit btn-block"> <strong>Record Student(s) Attendance</strong> </div>
                      <div class="card-header" align="center">
                        <strong><hr></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-2">
                           <select name="class" onselect="this.className" class="form-control" required >
     
      <?php foreach($studentclass->viewAllClasses() as $key =>$val){
		  $studentclass->class_code = $val['class_code'];
		  $studentclass->viewclassByID()
		   ?>
     <option value="<?php echo $studentclass->class_code ?>"><?php  echo $studentclass->class_name?></option>
    
	   <?php } ?>
     </select></div>                
<div class="col col-md-2">     
    <select name="class_arm" onselect="this.className" class="form-control" required >
     
      <?php foreach($classarm->viewAllClassarm() as $key =>$vals){
		  $classarm->class_arm_code = $vals['class_arm_code'];
		  $classarm->viewClassArmByID();
		   ?>
     <option value="<?php echo $classarm->class_arm_code ?>"><?php  echo $classarm->class_arm_name ?></option>
    
	   <?php } ?>
     </select></div>        
       
      <div class="col col-md-3">     
    <select name="term" onselect="this.className" class="form-control" required >
     
      <?php foreach($term->viewAllTerm() as $key =>$vals){
		  $term->term_code = $vals['term_code'];
		  $term->viewTermByID();
		   ?>
     <option value="<?php echo $term->term_code ?>"><?php  echo $term->term_name ?></option>
    
	   <?php } ?>
     </select></div>   
           <div class="col col-md-3">     
    <select name="sessions" onselect="this.className" onChange="this.form.submit();"  class="form-control" required >
     <option value="">--Select Session--</option>
      <?php foreach($availableSession->viewAllSession() as $key =>$vals){
		  $availableSession->session_code = $vals['session_code'];
		  $availableSession->viewSessionByID();
		   ?>
     <option value="<?php echo $availableSession->session_code ?>"><?php  echo $availableSession->session_description ?></option>
    
	   <?php } ?>
     </select></div> 
       
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
                           </div>
</form>
    
 </div>
      
   </div><?php
  
   if(isset($_POST['sessions'])){
	   
		 $createScores->avg_class = $_POST['class'];
		 
		  $createScores->avg_class_arm = $_POST['class_arm'];
		 $createScores->avg_session =  $_POST['sessions'];
		$createScores->avg_term = $_POST['term'];
	
		$schoolsetup->schoolopen_id = $_POST['term']. $_POST['sessions'];
		$schoolsetup->viewSchoolOpenedbyID();

		if(!empty($createScores->view_avg_scoresbyTermSessionClass())){
		
		 $classarm->class_arm_code = $_POST['class_arm'];
$classarm->viewClassArmByID();	   
	//get class  description using its id
	$studentclass->class_code = $_POST['class'];
	$studentclass->viewclassByID();	
	
   ?>
   <div class="col-lg-12">
      <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="frmactive" >
       <h3><strong><hr></strong></h3>
     <div class="row">
        <div class=" col-md-6"><strong>Number of Days Scool Oppended</strong>  </div>  
        <div class=" col-md-4">  
   <input type="number" name="days_open" class="form-control"  readonly value="<?php echo $schoolsetup->days_school_opened; ?>">
   </div> </div>
                        
        
                      <div class="row form-group">
                   <div class="box">
            <div class="box-header">
              <h3><strong><hr></strong></h3>
            </div> 
              
              
     <div class="table-responsive" >  
               
            
            <!-- /.box-header -->
            <div class="box-body">
            
            
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      
                      <th>Admision No</th>
                      <th> Name</th>
                   
                       <th>Days Attended </th>
                        
                    
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				 
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($createScores->view_avg_scoresbyTermSessionClass() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 
				$studentAction->student_regno =  $values['student_no'];
						  $studentAction->viewStudentbyID();
						 
						  
				  ?>
                   
                    
                      <td><?php echo $studentAction->student_regno;?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
 
                     
                      <input type="hidden" name="avg_code[]" id="avg_code[]" value="<?php echo $values['avg_code']?>">
                   
                     
                   <td><input type="number" name="days_attended[]"  onChange="checkinput(this,<?php echo $schoolsetup->days_school_opened ?>)" required id="days_attended[]"  onKeyPress=" return isNumber(event)" value="<?php echo $values['attendance']  ?>" > </td>
                     </tr>
                              
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  

      <div class="col col-md-12">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="submit" class=" btn btn-primary btn-block" onClick="return confirm('Confirm your entries ');">Submit</button> </div>
                           </div>
</form>
    <?php }else{ echo "The selected class has no students";}  } ?>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  </div>

    <!-- Right Panel -->

    
     <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>

</body>
</html>
