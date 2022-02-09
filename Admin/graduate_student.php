<?php include_once("sessionStart.php"); ?>

<?php

include_once('../classes/class.Classarm.php');

require_once('../classes/class.students.php');
$classarm = new  ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
//$term=new Term();
//$school_setup = new SchoolSetup();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Graduate Student</title>
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
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
 <div class="btn btn-reddit btn-block"> <strong>Graduating Students</strong> </div>
                        <strong><hr></strong>
                      
                      
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
<div class="col col-md-4">     
    <select name="class_arm" onselect="this.className" onChange="this.form.submit();" class="form-control" required >
     <option value="">-- Select Classarm --</option>
      <?php foreach($classarm->viewAllClassarm() as $key =>$vals){
		  $classarm->class_arm_code = $vals['class_arm_code'];
		  $classarm->viewClassArmByID();
		   ?>
     <option value="<?php echo $classarm->class_arm_code ?>"><?php  echo $classarm->class_arm_name ?></option>
    
	   <?php } ?>
     </select></div>        
       
      
          
       
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
                           </div>
</form>
    
 </div>
    <strong><hr></strong>  
   <?php
  
   if(isset($_POST['class_arm'])){
	   
		 $students_class = $_POST['class'];
		 
		  $students_classarm = $_POST['class_arm'];
		  $studentAction->student_class =  $_POST['class'];
			 $studentAction->student_classarm = $_POST['class_arm'];
	
		
		if(!empty($studentAction->viewActiveStudentbyClassandClassarm())){
		
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
      <form  action="../Control_classes/student_controller.php?action=graduate_student" method="post" enctype="multipart/form-data" class="form-horizontal" name="frmactive" >
                           
         <div class="row form-group">
         <div class="col col-md-4"><label>Select Graduants academic session </label></div>
                            <div class="col col-md-6">
                           <select name="sessions" onselect="this.className" class="form-control" required >
      <option value="0">Select Session</option>
      <?php foreach($availableSession->viewAllSession() as $key =>$val){
		  $availableSession->session_code = $val['session_code'];
		  $availableSession->viewSessionByID()
		   ?>
     <option value="<?php echo $availableSession->session_code ?>"><?php  echo $availableSession->session_description?></option>
    
	   <?php } ?>
     </select></div>   
    </div>  
    <strong><hr></strong>
                      <div class="row form-group">
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title"><strong><hr></strong></h3>
            </div> 
              
              
     <div class="table-responsive" >  
               
            
            <!-- /.box-header -->
            <div class="box-body">
            
            
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th><input type="checkbox" name="allbox" value="all" onClick="un_check(this);" title="Select or Deselct ALL" style="background-color:#ccc;"/></th>
                      <th>Admision No</th>
                      <th> Name</th>
                       <th> Sex</th>
                       <th> Current Class</th>
                        
                    
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                    
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($studentAction->viewActiveStudentbyClassandClassarm() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 
				$studentAction->student_regno =  $values['student_regno'];
						  $studentAction->viewStudentbyID();
						  $classarm->class_arm_code = $studentAction->student_classarm;
						  $classarm->viewClassArmByID();
						 $studentclass->class_code = $studentAction->student_class;
					$studentclass->viewclassByID();
						  
				  ?>
                   
                      <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $studentAction->student_regno; ?>" ></td>
                      <td><?php echo $studentAction->student_regno;?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
 
                      <td><?php echo $studentAction->sex?></td>
                      
                      <td><?php echo $studentclass->class_name.$classarm->class_arm_name?> </td>
                     
                  
                     </tr>
                              
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  

      <div class="col col-md-12">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="graduants" class=" btn btn-primary btn-block" onClick="return confirm('Are you sure you want to promote the selected student(s)?');">Graduate</button> </div>
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
