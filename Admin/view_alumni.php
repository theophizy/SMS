<?php
include_once("sessionStart.php"); 


include_once('../classes/class.school_setup.php');
//include_once('../classes/class.term.php');
//include_once('../classes/class.Scores.php');
include_once('../classes/class.Classarm.php');
include_once('../classes/class.studentclasses.php');
require_once('../classes/class.students.php');
$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$school_setup = new SchoolSetup();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>List of Old Students</title>

  <?php  include_once('links.php'); ?>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

            <div class="btn btn-reddit btn-block"> <strong>List of Old Students (Alumni)</strong> </div>
                     
                        <strong><hr></strong>
 <div class="col-lg-12">
 
                    <div class="card">
                      <div class="card-header" align="center">
                       
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                                      
<div class="col col-md-4"><label>Graduants academic session </label></div>
                            <div class="col col-md-6">
                           <select name="sessions" onChange="this.form.submit();" onselect="this.className" class="form-control" required >
                            <option value="">-- Select Session--</option>
    
      <?php foreach($availableSession->viewAllSession() as $key =>$val){
		  $availableSession->session_code = $val['session_code'];
		  $availableSession->viewSessionByID()
		   ?>
     <option value="<?php echo $availableSession->session_code ?>"><?php  echo $availableSession->session_description?></option>
    
	   <?php } ?>
     </select></div>         
       
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['sessions'])){
	   
		
		  
			 $studentAction->session_admitted = $_POST['sessions'];
	
		
		if(!empty($studentAction->viewAlumniBySession())){
		
		 
	//get Term  description using its id
		

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	
   ?>
     
     <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Admision No</th>
                      <th> Name</th>
                       <th> Sex</th>
                       <th> Nationality</th>
                        <th> State of Origin</th>
                         <th> Lga</th>
                      <th> Status</th>
                      <th>Action</th>
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                    
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($studentAction->viewAlumniBySession() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 
				$studentAction->student_regno =  $values['student_regno'];
						  $studentAction->viewAlumnibyID();
						  
				  ?>
                   
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $studentAction->student_regno;?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
 
                      <td><?php echo $studentAction->sex?></td>
                      
                      <td><?php echo $studentAction->nationality ?></td>
                      
                      <td><?php echo $studentAction->state_origin ?></td>
                      
                      <td><?php echo $studentAction->lga ?></td>
                      <td><?php echo $studentAction->student_status ?></td>
                   <td> <button title="View Student Details" class="" data-toggle="modal" type="button" data-target="#update_modal<?php echo $studentAction->student_regno ?>"><span class=" btn-default fa fa-eye"></span></button> 
                   
                   </td>
                     </tr>
                              
   <div class="modal fade" id="update_modal<?php echo $studentAction->student_regno ?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
    
<form method="POST" action="../Control_classes/student_controller.php?action=Edit_student" name="form1">
				<div class="modal-header">
					  <div class="btn btn-reddit btn-block"> <strong>Student Details</strong> </div>
                     
                        <strong><hr></strong>
                    <?php
                  if(!empty($studentAction->image)){
					 ?>
					
                    <img src="<?php echo $studentAction->image;?>" width="120" height="120">
                    <?php }else{
						$school_setup->viewSchoolSetup();
						 ?>
                    <img src="<?php echo $school_setup->school_logo;?>" width="120" height="120">
                     <?php } ?>
					
				</div>
				<div class="modal-body">
                <div class=" col-lg-12">
				<div class="form-group">
                <div class="col-md-3">
							<label>Admin No</label>
							</div>
                        <div class="col-md-3" align="left">      
		<input type="text" name="student_regno" value="<?php echo $studentAction->student_regno ?>" class="form-control" readonly/></div>
         <div class="col-md-3">
							  <label>Surname</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="last_name" value="<?php echo $studentAction->last_name?>" class="form-control" readonly />
						</div>
						 </div>
                       <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>First Name</label>
							</div>
                        <div class="col-md-3" align="left">      
		<input type="text" name="first_name" value="<?php echo $studentAction->first_name ?>" class="form-control" readonly /></div>
         <div class="col-md-3">
							  <label>Middle Name</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="middle_name" value="<?php echo $studentAction->middle_name?>" class="form-control" readonly />
						</div>
						 </div>
                         
                         
                          <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>SEX</label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input value=" <?php echo $studentAction->sex ?>" class="form-control" readonly type="text"> 
     </div>
         <div class="col-md-3">
							  <label>Date of Birth</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="date_birth" value="<?php echo $studentAction->date_birth?>" class="form-control" readonly />
						</div>
						 </div>
                    
                           <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Nationality</label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input type="text" name="nationality" value="<?php echo $studentAction->nationality ?>" class="form-control"readonly /></div>
         <div class="col-md-3">
							  <label>LGA</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="lga" value="<?php echo $studentAction->lga?>" class="form-control" readonly/>
						</div>
						 </div>
                         
                         
                           <br>
                         <br>
                         <div class="form-group">
               
                 <div class="col-md-3">
							  <label>State of Origin</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="state_origin" value="<?php echo $studentAction->state_origin?>" class="form-control" readonly/>
						</div>
                         <div class="col-md-3">
							<label>Blood Group</label>
							</div>
                        <div class="col-md-3" align="left">      
		 
     <input type="text" class="form-control" value=" <?php echo $studentAction->blood_group ?>" readonly> </div>
                        
         
						 </div>
                         
                         
                         
                           <br>
                         <br>
                         <div class="form-group">
                         
                         <div class="col-md-3">
							  <label>Student House</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                   <input type="text" value="<?php echo $studentAction->student_house ?>" class="form-control" readonly> 
						</div>
                          <div class="col-md-3">
							<label>Current </label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input type="text" class="form-control" value=" <?php $studentclass->class_code = $studentAction->student_class;  $studentclass->viewclassByID(); $classarm->class_arm_code = $studentAction->student_classarm;  $classarm->viewClassArmByID(); echo $studentclass->class_name.$classarm->class_arm_name ;?>" readonly></div>
                        
                       
               
        
						 </div>
                         
                         
                         
                           <br>
                         <br>
                        
                         <div class="form-group">
        
      
         <div class="col-md-3">
							  <label>Graduating Session </label>
							</div>
      
        <div class="col-md-9" align="left"> 
                  <input type="text" class="form-control" value=" <?php $availableSession->session_code = $studentAction->session_admitted; $availableSession->viewSessionByID(); echo $availableSession->session_description; ?>" readonly >
						</div>
						 </div>
                         
                         
                           <br>
                         <br>
                         
                          <div class="form-group">
                         <div class="col-md-3">
							<label>Guardian Phone</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="number" name="guardian_phone" value="<?php echo $studentAction->guardian_phone ?>" class="form-control" readonly />     
		</div></div>
                            <br>
                         <br>
                         
                         <div class="form-group">
                <div class="col-md-3">
							<label>Guardian Name</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="text" name="guardian_name" value="<?php echo $studentAction->guardian_name ?>" class="form-control" readonly />     
		</div>
        
						 </div>
                         
                            <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Guardian email</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="email" name="guardian_email" value="<?php echo $studentAction->guardian_email ?>" class="form-control" readonly/>     
		</div>
        
						 </div>
                            <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Guardian Address</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <textarea name="guardian_address" readonly class="form-control"><?php echo $studentAction->guardian_address  ?></textarea>    
		</div>
        
						 </div>
                         </div>

                          <br>
                        
   
				<div class="modal-footer" align="left">
                 <br>
                         <br>
					
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    
                    </div></div>
                    </form>
				</div></div></div>
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "No Records Found for the Selected Items";} } ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  

    <!-- Right Panel -->

    
      <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
