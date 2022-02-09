<?php
include_once("sessionStart.php"); 

include_once('../classes/class.school_setup.php');
require_once('../classes/class.students.php');
$school_setup = new SchoolSetup();
$classarm = new  ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$scores = new Scores();
$getgrade = new Grade();


//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Student Score Sheet</title>

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

   

         <div class="content mt-8">

          
 <div class="col-lg-12">
 
                    <div class="card">
<div class="btn btn-reddit btn-block"> <strong>Print Score Entering Template</strong> </div>
                     <h3><strong><hr></strong></h3>
                      
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
     
      <?php foreach($term->viewAllTerm() as $key =>$val){
		  $term->term_code = $val['term_code'];
		  $term->viewTermByID()
		   ?>
     <option value="<?php echo $term->term_code ?>"><?php  echo $term->term_name ?></option>
    
	   <?php } ?>
     </select></div>   
                
<div class="col col-md-4">     
    <select name="session" onChange="this.form.submit();" onselect="this.className" class="form-control" required >
     <option value="">-- Select Session --</option>
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
	   
		$scores->score_class = $_POST['class'];
		 
		  $scores->score_class_arm = $_POST['class_arm'];
		  $scores->score_term =  $_POST['term'];
		$scores->score_session = $_POST['session'];
	    
		if(!empty($scores->getStudentscoresheet())){
		
		 $classarm->class_arm_code = $_POST['class_arm'];
$classarm->viewClassArmByID();	   
	$studentclass->class_code = $_POST['class'];
	$studentclass->viewclassByID();
	$term->term_code = $_POST['term'];
	$term->viewTermByID();
	$availableSession->session_code = $_POST['session'];
	$availableSession->viewSessionByID();

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	
   ?>
   <div class="col-lg-12">
     
           
                      <div class="row form-group">
                   <div class="box">
            <div class="box-header">
            
            </div> 
              
              
     <div class="table-responsive" id="printDiv" >  
               
            <table border=1 style=" width:100%;">
		<tr>
		<td>
			<table  width="90%">
			<tr>
				<td>
                <?php $school_setup->viewSchoolSetup();
					if(!empty($school_setup->school_logo)){
					 ?>
					<img src="<?php echo $school_setup->school_logo;?>" width="120" height="120">
                    <?php }else{ ?>
                    <img src="../imageupload/admin11.jpg" width="120" height="120">
                     <?php } ?>
				</td>
				<td>
					<b><font size='5'><?php echo strtoupper($school_setup->school_name)?></font></b><br> <i><?php echo ucwords($school_setup->school_address)?></i><br>
                    <i><?php echo $school_setup->school_phone."    ".$school_setup->school_email?></i><br>
					
				</td>
               
			</tr>
           
			</table>
		</td>
		</tr>
	<tr>
	<td>
			<table style="width:90%;" bgcolor="#7woh">
            <tr><td><table style="width:100%;" border="1">
				<tr><td colspan="2"><strong>CLASS:<?php echo $studentclass->class_name.$classarm->class_arm_name ?></strong></td>&nbsp;&nbsp;<td colspan="2"><strong>TERM:<?php echo $term->term_name ?></strong></td><td colspan="3"><strong>ACADEMIC SESSION:<?php echo $availableSession->session_description ?></strong></td></tr>
			</table></td></tr></table>
            <!-- /.box-header -->
            <div class="box-body">
            
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Admision No</th>
                      <th> Name</th>
                       <?php foreach($getgrade->viewAllExamType() as $key =>$vals){  ?>
     <th><?php echo $vals['exam_name']. "(".$vals['exam_marks']."%)" ?></th>
    <?php }?>
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                    
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($scores->getStudentscoresheet() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 $enable;
				$studentAction->student_regno =  $values['score_student_regno'];
						  $studentAction->viewStudentbyID();
						  $classarm->class_arm_code = $studentAction->student_classarm;
						  $classarm->viewClassArmByID();
						 $studentclass->class_code = $studentAction->student_class;
					$studentclass->viewclassByID();
					
						
						  
				  ?>
                   
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $studentAction->student_regno;?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
 
                    
                      <td> </td>
                                             <td> </td>
                      <td> </td>
                      <td> </td>

                     </tr>
                              
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  
</div></div>
      <div class="col col-md-12" align="center">
     
                 <button id="print" class="btn btn-primary btn-block" onClick="printContent('printDiv');" >print</button>           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                         
    <?php }else{ echo "The selected class has no students";}  } ?>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
 </div> </div>

    <!-- Right Panel -->

    
  
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
