<?php
include_once("sessionStart.php"); 

include_once('../classes/class.staff.php');

$staffAction = new Staff();
$staffAction->staff_id = $_SESSION['USERNAME'];
$staffAction->viewStaffbyID();
?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Staff Profile</title>

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
   
	
	
    </script> 
   


</head>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

    <div class="btn btn-reddit btn-block"> <strong>STAFF DETAILS</strong> </div>
                     <h3><strong><hr></strong></h3>

         <div class="content mt-12">

          
<form method="POST" action="../Control_classes/student_controller.php?action=Edit_student" name="form1">
				<div class="modal-header">
					
                    <?php
                  if(!empty($staffAction->image)){
					 ?>
					
                    <img src="<?php echo $staffAction->image;?>" width="120" height="120">
                    <?php }else{
						
						 ?>
                    <img src="../img/avatar5.png" width="120" height="120">
                     <?php } ?>
					
				</div>
				<div class="modal-body">
                <div class=" col-lg-12">
				<div class="form-group">
                <div class="col-md-3">
							<label>Staff ID</label>
							</div>
                        <div class="col-md-3" align="left">      
		<input type="text" name="student_regno" value="<?php echo $staffAction->staff_id ?>" class="form-control" readonly/></div>
         <div class="col-md-3">
							  <label>Surname</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="last_name" value="<?php echo $staffAction->staff_last_name?>" class="form-control" readonly />
						</div>
						 </div>
                       <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>First Name</label>
							</div>
                        <div class="col-md-3" align="left">      
		<input type="text" name="first_name" value="<?php echo $staffAction->staff_first_name ?>" class="form-control" readonly /></div>
         <div class="col-md-3">
							  <label>Middle Name</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="middle_name" value="<?php echo $staffAction->staff_middle_name?>" class="form-control" readonly />
						</div>
						 </div>
                         
                         
                          <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>SEX</label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input value=" <?php echo $staffAction->staff_sex ?>" class="form-control" readonly type="text"> 
     </div>
         <div class="col-md-3">
							  <label>Date of Birth</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="date_birth" value="<?php echo $staffAction->staff_date_birth?>" class="form-control" readonly />
						</div>
						 </div>
                    
                           <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Nationality</label>
							</div>
                        <div class="col-md-9" align="left">      
		 <input type="text" name="nationality" value="<?php echo $staffAction->staff_nationality ?>" class="form-control"readonly /></div></div>
          <br>
                         <br>
                         
          <div class="form-group">
         <div class="col-md-3">
							  <label>LGA</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                            
                    <input type="text" name="lga" value="<?php echo $staffAction->staff_lga?>" class="form-control" readonly/>
						</div>
						 </div>
                         
                         
                          <br>
                         <br>
                         
                         <div class="form-group">
               
                 <div class="col-md-3">
							  <label>State of Origin</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                            
                    <input type="text" name="state_origin" value="<?php echo $staffAction->staff_state_origin?>" class="form-control" readonly/>
						</div></div> <br>
                         <br>
                         
                          <div class="form-group">
                         <div class="col-md-3">
							<label>Blood Group</label>
							</div>
                        <div class="col-md-9" align="left">      
		 
     <input type="text" class="form-control" value=" <?php echo $staffAction->staff_blood_group ?>" readonly> </div>
                        
         
						 </div>
                         
                          <br>
                         <br>
                         
                         
                           
                         <div class="form-group">
                         
                         <div class="col-md-3">
							  <label>Marital Status </label>
							</div>
      
        <div class="col-md-9" align="left"> 
                   <input type="text" value="<?php echo $staffAction->staff_marital ?>" class="form-control" readonly> 
						</div></div> <br>
                         <br>
                         
                          <div class="form-group">
                          <div class="col-md-3">
							<label>Staff Address</label>
							</div>
                        <div class="col-md-9" align="left">      
		 <textarea name="guardian_address" readonly class="form-control"><?php echo $staffAction->staff_address  ?></textarea>    </div>
                       
						 </div>
                         
                          <br>
                         <br>
                         
                         
                         <div class="form-group">
                          <div class="col-md-3">
							  <label>Staff Email</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                  <input type="text" class="form-control" value=" <?php echo $staffAction->staff_email ?>" readonly>
						</div></div> <br>
                         <br>
                         
                          <div class="form-group">
                         <div class="col-md-3">
							<label>Staff Phone</label>
							</div>
                        <div class="col-md-9" align="left">      
          <input type="text" class="form-control" value=" <?php  echo $staffAction->staff_phone ?>" readonly></div>
        
						 </div>
                         
                         <br>
                         <br>
                           
                         <div class="form-group">
                                 
         <div class="col-md-3">
							  <label> Qualification</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                   <input type="text" class="form-control" value=" <?php  echo $staffAction->staff_qualification;?>" readonly >
						</div>
                </div>
                 <br>
                         <br>
                         
                  <div class="form-group">
         <div class="col-md-3">
							  <label>Discipline</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                  <input type="text" class="form-control" value=" <?php  echo $staffAction->staff_course_study; ?>" readonly >
						</div>
						 </div>
                         
                         
                           <br>
                         <br>
                         
                         <div class="form-group">
         <div class="col-md-3">
							  <label>Year Obtained</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                  <input type="text" class="form-control" value=" <?php  echo $staffAction->staff_year_graduated; ?>" readonly >
						</div>
						 </div>
                         
                         
                           <br>
                         <br>
                         <div class="form-group">
         <div class="col-md-3">
							  <label>Appointment date</label>
							</div>
      
        <div class="col-md-9" align="left"> 
                  <input type="text" class="form-control" value=" <?php  echo $staffAction->staff_year_of_appointment; ?>" readonly >
						</div>
						 </div>
                         
                         
                           <br>
                         <br>
                          <div class="form-group">
                         <div class="col-md-3">
							<label>Next of Kin Phone</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="text" name="guardian_phone" value="<?php echo $staffAction->nextofkin_phone ?>" class="form-control" readonly />     
		</div></div>
                            <br>
                         <br>
                         
                         <div class="form-group">
                <div class="col-md-3">
							<label>Next of Kin Name</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="text" name="guardian_name" value="<?php echo $staffAction->nextofkin_name ?>" class="form-control" readonly />     
		</div>
        
						 </div>
                         
                            <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Next of Kin email</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="email" name="guardian_email" value="<?php echo $staffAction->nextofkin_email ?>" class="form-control" readonly/>     
		</div>
        
						 </div>
                            <br>
                         <br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Next of Kin Address</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <textarea name="guardian_address" readonly class="form-control"><?php echo $staffAction->nextofkin_address  ?></textarea>    
		</div>
        
						 </div>
                         </div>

                          <br>
                        
   
				</div>
                    </form>
    
  </div>
      
  
     
  
    <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
