<?php
include_once("sessionStart.php"); 

//Instantiate classes
require_once('../classes/class.Subject.php');
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

  <title>Edit Student Details </title>

  <?php  include_once('links.php'); ?><head>
   

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
   
	
    </script> 
   
</head>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"> 
<?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
                         <div class="btn btn-reddit btn-block"> <strong>Edit Students Information</strong> </div>
                     
                        <strong><hr></strong> 
                      
                      <div class="card-body card-block">
                     
    
 
      
   <?php
  
  
						   //get sudent name by his/her admission number
						 
						$studentAction->student_regno =  $_GET['regno'];
						  $studentAction->viewStudentbyID();
						  
				  ?>
                   
                     
   
    
<form method="POST" action="../Control_classes/student_controller.php?action=Edit_student" name="form1" enctype="multipart/form-data">
				<div class="modal-header">
					
				</div>
				<div class="modal-body">
                <div class=" col-lg-12" style="background-color:#FFF;">
				<div class="row form-group">
                <div class="col-md-3">
							<label>Admin No</label>
							</div>
                        <div class="col-md-9" >      
		<input type="text" name="student_regno" value="<?php echo $studentAction->student_regno ?>" class="form-control" readonly/></div></div>
        <div class="row form-group">
         <div class="col-md-3">
							  <label>Surname</label>
							</div>
      
        <div class="col-md-9" > 
                            
                    <input type="text" name="last_name" value="<?php echo $studentAction->last_name?>" class="form-control" required="required"/>
						</div>
						 </div>
                       
                         <div class="row form-group">
                <div class="col-md-3">
							<label>First Name</label>
							</div>
                        <div class="col-md-9">      
		<input type="text" name="first_name" value="<?php echo $studentAction->first_name ?>" class="form-control" /></div></div>
        <div class="row form-group">
         <div class="col-md-3">
							  <label>Middle Name</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="middle_name" value="<?php echo $studentAction->middle_name?>" class="form-control" required="required"/>
						</div>
						 </div>
                         
                         
                         
                         <div class="row form-group">
                <div class="col-md-3">
							<label>SEX</label>
							</div>
                        <div class="col-md-9">      
		 <select name="sex" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->sex ?>"> <?php echo $studentAction->sex ?></option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
     </select></div></div>
    
      <div class="row form-group">
      <div class=" col-md-3"><strong>Date of Birth</strong></div>
         <div class="col-md-9"> 
                            
                    <input type="date" name="dob" value="<?php echo $studentAction->date_birth?>" class="form-control" required="required"/>
						</div>
    <!--<div class=" col-md-3"><select name="day" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[0]; ?> "><?php echo $orderdate[0]; ?></option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="month" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[1]; ?>"><?php echo $orderdate[1]; ?></option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="year" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[2]; ?>"><?php echo $orderdate[2]; ?></option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div></p>
    
        -->
  </div>
                        
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Nationality</label>
							</div>
                        <div class="col-md-9">      
		 <input type="text" name="nationality" value="<?php echo $studentAction->nationality ?>" class="form-control" required="required"/></div></div>
        
                         
                      
                         <div class="row form-group">
               
                 <div class="col-md-3">
							  <label>State of Origin</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="state_origin" value="<?php echo $studentAction->state_origin?>" class="form-control" required="required"/>
						</div></div>
                         <div class="row form-group">
         <div class="col-md-3">
							  <label>LGA</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="lga" value="<?php echo $studentAction->lga?>" class="form-control" required="required"/>
						</div>
						 </div>
                        <div class="row form-group">
                         <div class="col-md-3">
							<label>Blood Group</label>
							</div>
                        <div class="col-md-9">      
		 <select name="blood_group" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->blood_group ?>"> <?php echo $studentAction->blood_group ?></option>
      <option value="A+">A+</option>
     <option value="A-">A-</option>
     <option value="B+">B+</option>
      <option value="B-">B-</option>
     <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
     <option value="O+">O+</option>
     <option value="O-">O-</option>
    
	 
     </select></div>
                        
         
						 </div>
                         
                         
                         
                          
                         <div class="row form-group">
                          <div class="col-md-3">
							<label> Current Class</label>
							</div>
                        <div class="col-md-9">      
		 <select name="class" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->student_class ?>"> <?php $studentclass->class_code = $studentAction->student_class; $studentclass->viewclassByID(); echo $studentclass->class_name ?></option>
      <?php foreach($studentclass->viewAllClasses() as $key =>$val){
		  $studentclass->class_code = $val['class_code'];
		  $studentclass->viewclassByID()
		   ?>
     <option value="<?php echo $studentclass->class_code ?>"><?php  echo $studentclass->class_name?></option>
    
	   <?php } ?>
     </select></div>
                        
                       
               
        
						 </div>
                         
                         
                         
                         <div class="row form-group">
                          <div class="col-md-3">
							  <label> Current Class Arm</label>
							</div>
      
        <div class="col-md-9"> 
                   <select name="class_arm" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->student_classarm ?>"> <?php $classarm->class_arm_code = $studentAction->student_classarm; $classarm->viewClassArmByID(); echo $classarm->class_arm_name ?></option>
      <?php foreach($classarm->viewAllClassarm() as $key =>$vals){
		  $classarm->class_arm_code = $vals['class_arm_code'];
		  $classarm->viewClassArmByID();
		   ?>
     <option value="<?php echo $classarm->class_arm_code ?>"><?php  echo $classarm->class_arm_name ?></option>
    
	   <?php } ?>
     </select>
						</div></div>
                        <div class="row form-group">
                         <div class="col-md-3">
							<label>Class Admitted</label>
							</div>
                        <div class="col-md-9">      
		 <select name="class_admitted" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->student_class_admitted ?>"> <?php $studentclass->class_code = $studentAction->student_class_admitted;
	   if(!empty($studentAction->student_class_admitted)){
	  
	   $studentclass->viewclassByID(); echo $studentclass->class_name;
	    }else{
			  echo "Update this filed";
			   }
	    ?></option>
      <?php foreach($studentclass->viewAllClasses() as $key =>$val){
		  $studentclass->class_code = $val['class_code'];
		  $studentclass->viewclassByID()
		   ?>
     <option value="<?php echo $studentclass->class_code ?>"><?php  echo $studentclass->class_name?></option>
    
	   <?php } ?>
     </select></div>
        
						 </div>
                         
                         <div class="row form-group">
                                 
         <div class="col-md-3">
							  <label>Term Admitted</label>
							</div>
      
        <div class="col-md-9"> 
                   <select name="term_admitted" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->term_admitted ?>"> <?php $term->term_code = $studentAction->term_admitted; 
	  if(!empty($studentAction->term_admitted)){
	 $term->viewTermByID();
		   echo $term->term_name;
		   }else{
			  echo "Update this filed";
			   } ?></option>
      <?php foreach($term->viewAllTerm() as $key =>$vals){
		 $term->term_code = $vals['term_code'];
		  $term->viewTermByID();
		   ?>
     <option value="<?php echo $term->term_code ?>"><?php  echo $term->term_name ?></option>
    
	   <?php } ?>
     </select>
						</div></div>
                <div class="row form-group">
         <div class="col-md-3">
							  <label>Session Admitted</label>
							</div>
      
        <div class="col-md-9"> 
                   <select name="session_admitted" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->session_admitted ?>"> <?php $availableSession->session_code = $studentAction->session_admitted; 
	  if(!empty($studentAction->session_admitted)){
	  $availableSession->viewSessionByID(); echo $availableSession->session_description ;
	   }else{
			  echo "Update this filed";
			   }
	  ?></option>
      <?php foreach($availableSession->viewAllSession() as $key =>$vals){
		 $availableSession->session_code = $vals['session_code'];
		  $availableSession->viewSessionByID();
		   ?>
     <option value="<?php echo $availableSession->session_code ?>"><?php  echo $availableSession->session_description ?></option>
    
	   <?php } ?>
     </select>
						</div>
						 </div>
                         
                        
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Guardian Name</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="text" name="guardian_name" value="<?php echo $studentAction->guardian_name ?>" class="form-control" required="required"/>     
		</div>
        
						 </div>
                         
                            
                          <div class="row form-group">
                         <div class="col-md-3">
							<label>Guardian Phone</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="number" name="guardian_phone" value="<?php echo $studentAction->guardian_phone ?>" class="form-control" required="required"/>     
		</div></div>
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Guardian email</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="email" name="guardian_email" value="<?php echo $studentAction->guardian_email ?>" class="form-control" />     
		</div>
        
						 </div>
                         
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Guardian Address</label>
							</div>
                        <div class="col-md-9"> 
                         <textarea name="guardian_address" class="form-control"><?php echo $studentAction->guardian_address  ?></textarea>    
		</div></div>
        <div class="row form-group">
        <div class="col-md-3">
							<label>Photo(Accepted Format jpg,jpeg,png,gif)</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="file" name="file" class="form-control"> <img class="user-avatar rounded-circle" src="<?php echo $studentAction->image?>" style="height:40; width:40px;"  alt="User Avatar">  
		</div>
        
						 </div>
                         </div>

                        
    <div class="row form-group">
        <div class="col-md-3">
							
							</div>
                        <div class="col-md-9"> 
					<button name="update" type="submit" class="btn btn-primary btn-block"> Update</button>
					
                    
                    </div></div>
                    </form>
				</div></div></div>
 
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  

    <!-- Right Panel -->

    
      <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
