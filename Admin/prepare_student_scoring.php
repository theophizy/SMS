<?php
include_once("sessionStart.php"); 



//include_once('../classes/class.studentclasses.php');
//include_once('../classes/class.school_setup.php');
//include_once('../classes/class.term.php');
include_once('../classes/class.Classarm.php');
//include_once('../classes/class.Scores.php');
require_once('../classes/class.students.php');
$classarm = new  ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$scores = new Scores();



//$studentAction = new Students();
include_once('metadatda.php');
?>
<!-- Author: Anande Theophilus Terfa             -->
 
  <title>Student Exams Eligibility</title>
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
 <div class="btn btn-reddit btn-block"> <strong>Select students who have resummed and ready to sit for exams and set them for scoring</strong> </div>
                      <div class="card-header" align="center">
                      <h3><strong><hr></strong></h3>
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-3">
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
     
      <?php foreach($term->viewAllTerm() as $key =>$val){
		  $term->term_code = $val['term_code'];
		  $term->viewTermByID()
		   ?>
     <option value="<?php echo $term->term_code ?>"><?php  echo $term->term_name ?></option>
    
	   <?php } ?>
     </select></div>   
                
<div class="col col-md-3">     
    <select name="session" onChange="this.form.submit();" onselect="this.className" class="form-control" required >
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
      
   <?php
  
   if(isset($_POST['session'])){
	   
		 $students_class = $_POST['class'];
		 
		  $students_classarm = $_POST['class_arm'];
		  $studentAction->student_class =  $_POST['class'];
		$studentAction->student_classarm = $_POST['class_arm'];
	     $current_term = $_POST['term'];
	    $current_session = $_POST['session'];
		if(!empty($studentAction->viewStudentbyClassandClassarm())){
		
		 $classarm->class_arm_code = $_POST['class_arm'];
$classarm->viewClassArmByID();	   
	//get class  description using its id
	$studentclass->class_code = $_POST['class'];
	$studentclass->viewclassByID();	
	//get Term  description using its id
		

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	
   ?>
   <div class="col-lg-12">
      <form  action="../Control_classes/Scores_controller.php?action=set_student_for_scores" method="post" enctype="multipart/form-data" class="form-horizontal" name="frmactive" >
                    <input name="term" type="hidden" value="<?php echo $current_term ?>">  
                     <input name="session" type="hidden" value="<?php echo $current_session ?>"> 
                      <input name="student_class" type="hidden" value="<?php echo $_POST['class']; ?>">  
                     <input name="student_classarm" type="hidden" value="<?php echo $_POST['class_arm']; ?>">      
           
                      <div class="row form-group">
                   <div class="box">
            <div class="box-header">
              <h3> <hr> </h3>
            </div> 
              
              
     <div class="table-responsive" >  
               
            
            <!-- /.box-header -->
            <div class="box-body">
            
            
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th><input type="checkbox" name="allbox" value="all" onClick="un_check(this);" title="Select or Deselct ALL" style="background-color:#ccc;"  /></th>
                      <th>Admision No</th>
                      <th> Name</th>
                       
                       <th> Current Class</th>
                        <th> Set Status</th>
                    
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                    
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($studentAction->viewStudentbyClassandClassarm() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 $enable;
				$studentAction->student_regno =  $values['student_regno'];
						  $studentAction->viewStudentbyID();
						  $classarm->class_arm_code = $studentAction->student_classarm;
						  $classarm->viewClassArmByID();
						 $studentclass->class_code = $studentAction->student_class;
					$studentclass->viewclassByID();
					$set_status = $scores->view_avg_scoresbyTermSessionClassandStudentRegno($values['student_regno'],$studentAction->student_class,$studentAction->student_classarm,$current_term,$current_session);
					if($set_status == "Already Set"){
						$enable = "disabled";
					}else{
						$enable = "";
					}
						
						  
				  ?>
                   
                      <td><input name="checkbox[]"  <?php echo $enable ?> type="checkbox" id="checkbox[]"  value="<?php echo $studentAction->student_regno; ?>" ></td>
                      <td><?php echo $studentAction->student_regno;?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
 
                    
                      <td><?php echo $studentclass->class_name.$classarm->class_arm_name?> </td>
                       <td><?php echo $set_status?></td>
                      
                  
                     </tr>
                              
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  

      <div class="col col-md-12">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="set" class=" btn btn-primary btn-block" onClick="return confirm('Are you sure you want to set the selected student(s)?');">SET</button> </div>
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
