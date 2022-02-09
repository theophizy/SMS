<?php include_once("sessionStart.php"); ?>

<?php

include_once('../classes/class.Users.php');
$users = new Users();
$staffAction = new Staff();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>
  <title>Manage Staff Profile</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
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
   
	
	function show(staff_id){
		window.open('update_staff_record.php?staff_id='+staff_id,'Update Staff information','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
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

          

		

	 <div class="btn btn-reddit btn-block"> <strong>Available Staff</strong> </div>
                      
                        <strong><hr> </strong>
     
     <div class="table-responsive" >  
                     
                     
                   <div class="box">
            <div class="box-header">
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Staff ID</th>
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
 foreach($staffAction->GeneralViewList() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 
				$staffAction->staff_id =  $values['staff_id'];
						  $staffAction->viewStaffbyID();
						  
				  ?>
                   
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $staffAction->staff_id;?></td>
                      <td><?php echo $staffAction->staff_first_name."  ".$staffAction->staff_last_name ?></td>
 
                      <td><?php echo $staffAction->staff_sex?></td>
                      
                      <td><?php echo $staffAction->staff_nationality ?></td>
                      
                      <td><?php echo $staffAction->staff_state_origin ?></td>
                      
                      <td><?php echo $staffAction->staff_lga ?></td>
                      <td><?php echo $staffAction->staff_status ?></td>
                   <td> <button title="View Staff Details" class="" data-toggle="modal" type="button" data-target="#update_modal<?php echo $staffAction->staff_id; ?>"><span class=" btn-default fa fa-eye"></span></button>
               <button title="Asign Staff Role" class="" data-toggle="modal" type="button" data-target="#asign_modal<?php echo $staffAction->staff_id; ?>"><span class="  btn-default fa fa-user"></span></button>   
                   <a href="update_staff_record.php?staff_id=<?php echo $staffAction->staff_id ?>" title="Edit Staff Info" class="btn btn-success" >Edit</a>
                    <?php if($staffAction->staff_status  == "ACTIVE"){  ?>
                   <a href="../Control_classes/staff_controller2.php?action=Deactivate_staff&staffid=<?php echo $staffAction->staff_id ?>" title="Deactivate Staff" class="btn btn-danger" onClick="return confirm('Are you sure??');" >Deactivate</a>
                    <?php }else{  ?>
                     <a href="../Control_classes/staff_controller2.php?action=Reactivate_staff&staffid=<?php echo $staffAction->staff_id ?>" title="Reactivate Staff" class="btn btn-success" onClick="return confirm('Are you sure??');" >Reactivate</a>
                      <?php }  ?>
                   </td>
                     </tr>
                          
                      <div class="modal fade" id="update_modal<?php echo $staffAction->staff_id ?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
    
<form method="POST" action="../Control_classes/student_controller.php?action=Edit_student" name="form1">
				<div class="modal-header">
                 <div class="btn btn-reddit btn-block"> <strong>View Staff Details</strong> </div>
                      
                        <strong><hr> </strong>
					
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
							<label>Admin No</label>
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
                        
   
				<div class="modal-footer" align="left">
                 <br>
                         <br>
					
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    
                    </div></div>
                    </form>
				</div></div></div>  
                              
   <div class="modal fade" id="asign_modal<?php echo $staffAction->staff_id ?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
    
<form method="POST" action="../Control_classes/user_controller.php?action=asign_role" name="form1">
				<div class="modal-header">
                  <div class="btn btn-reddit btn-block"> <strong>Sign Role to the Staff</strong> </div>
                      
                        <strong><hr> </strong>
					
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
				<div class="row form-group">
                <div class="col-md-3">
							<label>Staff ID</label>
							</div>
                        <div class="col-md-9">      
		<input type="text" name="" value="<?php echo $staffAction->staff_id ?>" class="form-control" readonly/>
        <input type="hidden" name="username" value="<?php echo $staffAction->staff_id ?>" class="form-control" />
        </div></div>
        <div class="row form-group">
         <div class="col-md-3">
							  <label>Surname</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="last_name" value="<?php echo $staffAction->staff_last_name?>" class="form-control" readonly />
						</div>
						 </div>
                      
                         <div class="row form-group">
                <div class="col-md-3">
							<label>First Name</label>
							</div>
                        <div class="col-md-9">      
		<input type="text" name="first_name" value="<?php echo $staffAction->staff_first_name ?>" class="form-control" readonly /></div></div>
        <div class="row form-group">
         <div class="col-md-3">
							  <label>Middle Name</label>
							</div>
      
        <div class="col-md-9"> 
                            
                    <input type="text" name="middle_name" value="<?php echo $staffAction->staff_middle_name?>" class="form-control" readonly />
						</div>
						 </div>
                         
                         
                           
                         <div class="row form-group">
                         
                         <div class="col-md-3">
							  <label >Staff Role </label>
							</div>
      
        <div class="col-md-9"> 
        <?php  
		$users->username = $staffAction->staff_id;
		$users->viewUserByUsername();
		
		 ?>
                  <select name="user_role" onselect="this.className" class="form-control" required >
      <option value="<?php echo $users->role; ?>"> <?php echo $users->role; ?></option>
    <option value="Principal">Principal</option>
    <option value="Adminofficer">Admin Officer</option>
     <option value="Academicofficer">Academic Officer</option>
     <option value="Dean">Dean of Studies</option>
     <option value="Formaster">Formaster</option>
     <option value="Cashier">Cashier</option>
      <option value="Staff">Staff</option>
     </select>
						</div></div> 
                         
                         
   
				<div class="modal-footer">
                <div class=" row form-group">
                  <div class="col-md-9"> 
                <input type="submit" name="post" value="Submit" class="btn btn-primary">
					</div>
                      <div class="col-md-3"> 
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div>
                    </div></div>
                    </form>
				</div></div></div>
 <?php } ?>       
				
		
                  </tbody>
                </table>
  
 
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
 
    <!-- Right Panel -->

     <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
     
</body>
</html>
