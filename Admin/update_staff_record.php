<?php
include_once("sessionStart.php"); 

//Instantiate classes
require_once('../classes/class.staff.php');

$staffAction = new Staff();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Edit Staff Details</title>

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

<div class="col-lg-10" align="center"> 
<?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12" >

          
 <div class="col-lg-12">
 
                    <div class="card">
                         <div class="btn btn-reddit btn-block"> <strong>Edit Staff Information</strong> </div>
                     
                        <strong><hr></strong> 
                      
                      <div class="card-body card-block">
                     
    
 
      
   <?php
  
  
						   //get sudent name by his/her admission number
						 
						$staffAction->staff_id =  $_GET['staff_id'];
						  $staffAction->viewStaffbyID();
						  
				  ?>
                   
                     
   
    
   <form method="POST" action="../Control_classes/staff_controller2.php?action=Edit_staff" name="form1" enctype="multipart/form-data" class="form-group">
				<div class="modal-header">
				
				</div>
				<div class="modal-body" >
                <div class=" col-lg-12" style="background-color:#FFF;">
				<div class="row form-group">
                <div class="col-md-3">
							<label>Staff ID</label>
							</div>
                        <div class="col-md-9">      
		<input type="text" name="staff_id" value="<?php echo $staffAction->staff_id ?>" class="form-control" readonly/></div></div>
        <div class="row form-group">
         <div class="col-md-3">
							  <label>Surname</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="last_name" value="<?php echo $staffAction->staff_last_name?>" class="form-control" required="required"/>
						</div>
						 </div>
                      
                         <div class="row form-group">
                <div class="col-md-3">
							<label>First Name</label>
							</div>
                        <div class="col-md-9">      
		<input type="text" name="first_name" value="<?php echo $staffAction->staff_first_name ?>" class="form-control" /></div></div>
        <div class="row form-group">
         <div class="col-md-3">
							  <label>Middle Name</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="middle_name" value="<?php echo $staffAction->staff_middle_name?>" class="form-control" required="required"/>
						</div>
						 </div>
                         
                         
                         <div class="row form-group">
                <div class="col-md-3">
							<label>SEX</label>
							</div>
                        <div class="col-md-9">      
		 <select name="sex" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $staffAction->staff_sex ?>"> <?php echo $staffAction->staff_sex ?></option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
     </select></div></div>
   
      <div class="row form-group">
      <div class=" col-md-3"><strong>Date of Birth</strong></div>
    <div class=" col-md-9"><input type="date"  oninput="this.className = ''" name="date_birth" class="form-control" value="<?php echo $staffAction->staff_date_birth ?>"></div>
    
         
  </div>
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Nationality</label>
							</div>
                        <div class="col-md-9">      
		 <input type="text" name="nationality" value="<?php echo $staffAction->staff_nationality ?>" class="form-control" required="required"/></div></div>
         <div class="row form-group">
         <div class="col-md-3">
							  <label>LGA</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="lga" value="<?php echo $staffAction->staff_lga?>" class="form-control" required/>
						</div>
						 </div>
                     
                      
                         <div class="row form-group">
               
                 <div class="col-md-3">
							  <label>State of Origin</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="state_origin" value="<?php echo $staffAction->staff_state_origin?>" class="form-control" required="required"/>
						</div></div>
                        
                         <div class= "row form-group">
                          <div class="col-md-3">
							<label> Blood Group</label>
							</div>
                        <div class="col-md-9">      
		 <select name="blood_group" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $staffAction->staff_blood_group ?>"> <?php echo $staffAction->staff_blood_group ?></option>
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
							  <label> Marital Status </label>
							</div>
      
        <div class="col-md-9"> 
                    <select name="marital" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $staffAction->staff_marital ?>"> <?php echo $staffAction->staff_marital ?></option>
      <option value="Single">Single</option>
     <option value="Married">Married</option>
     <option value="Devorced">Devorced</option>
    
    
	 
     </select>
						</div></div>
                       <div class="row form-group">
                         <div class="col-md-3">
							<label>Staff Phone</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="number" name="staff_phone" value="<?php echo $staffAction->staff_phone ?>" class="form-control" required="required"/>     
		</div></div>
       
                         
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Staff email</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="email" name="staff_email" value="<?php echo $staffAction->staff_email ?>" class="form-control" />     
		</div>
        
						 </div>
                       
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Staff Address</label>
							</div>
                        <div class="col-md-9"> 
                         <textarea name="staff_address" class="form-control"><?php echo $staffAction->staff_address  ?></textarea>    
		</div>
      
                         </div>

                         <div class="row form-group">
                <div class="col-md-3">
							<label>Qualification</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="text" name="qualification" value="<?php echo $staffAction->staff_qualification ?>" class="form-control" required="required"/>     
		</div>
        
						 </div>
                         <div class="row form-group">
                <div class="col-md-3">
							<label>Institution Attended</label>
							</div>
                        <div class="col-md-9"> 
                         <input type="text" name="staff_institution" value="<?php echo $staffAction->staff_institution_attended ?>" class="form-control" required="required"/>     
		</div>
        
						 </div>
     <div class="row form-group">
                <div class="col-md-3">
							<label>Descipline </label>
							</div>
                        <div class="col-md-9"> 
                         <input type="text" name="staff_course" value="<?php echo $staffAction->staff_course_study ?>" class="form-control" required="required"/>     
		</div>
        
						 </div>
                         
	
      <div class="row form-group">
      <div class=" col-md-3"><strong>Year Attended</strong></div>
    <div class=" col-md-9"><input type="date"  oninput="this.className = ''" name="year_graduated" class="form-control" value="<?php echo $staffAction->staff_year_graduated ?>"></div>  
  </div>
  
 
	
      <div class="row form-group">
      <div class=" col-md-3"><strong>Appointment Date</strong></div>
       <div class=" col-md-9"><input type="date"  oninput="this.className = ''" name="apointment_year" class="form-control" value="<?php echo $staffAction->staff_year_of_appointment ?>"></div>  
  </div>
                          <div class="row form-group">
                <div class="col-md-3">
							<label>Name of next of kin </label>
							</div>
                        <div class="col-md-9"> 
                         <input type="text" name="nextofkin_name" value="<?php echo $staffAction->nextofkin_name ?>" class="form-control" required="required"/>     
		</div>
        
						 </div>
                          <div class="row form-group">
                <div class="col-md-3">
							<label>Email of next of kin </label>
							</div>
                        <div class="col-md-9"> 
                         <input type="email" name="nextofkin_email" value="<?php echo $staffAction->nextofkin_email ?>" class="form-control" />     
		</div>
        
						 </div>
                          <div class="row form-group">
                <div class="col-md-3">
							<label>Phone number of next of kin </label>
							</div>
                        <div class="col-md-9"> 
                         <input type="text" name="nextofkin_phone" value="<?php echo $staffAction->nextofkin_phone ?>" class="form-control" required="required"/>     
		</div>
        
						 </div>
                         <div class="row form-group">
                <div class="col-md-3">
							<label> Address of next of kin</label>
							</div>
                        <div class="col-md-9"> 
                         <textarea name="nextofkin_address" class="form-control"><?php echo $staffAction->nextofkin_address ?></textarea>    
		</div>
      
                         </div>
                        <div class=" row form-group">
         <div class="col-md-3">
							  <label>Passport</label>
							</div>
      
        <div class="col-md-9" > 
                            
                    <input type="file" name="file" class="form-control" value="<?php echo $staffAction->image?>" > <img class="user-avatar rounded-circle" src="<?php echo $staffAction->image?>" style="height:40; width:40px;"  alt="User Avatar"> </div>
						
						 </div>
				 <div class="row form-group">
        <div class="col-md-3">
							
							</div>
                        <div class="col-md-9"> 
					<button name="update" type="submit" class="btn btn-primary btn-block"> Update</button>
					
                    </div>
                    </div>
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
