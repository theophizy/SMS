<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
//require_once('../classes/class.article.php');


//include_once('../classes/class.Session.php');

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
<!doctype html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

 <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
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
                                      
<div class="col col-md-4"><label>Graduating academic session </label></div>
                            <div class="col col-md-6">
                           <select name="sessions" onselect="this.className" class="form-control" required >
    
      <?php foreach($availableSession->viewAllSession() as $key =>$val){
		  $availableSession->session_code = $val['session_code'];
		  $availableSession->viewSessionByID()
		   ?>
     <option value="<?php echo $availableSession->session_code ?>"><?php  echo $availableSession->session_description?></option>
    
	   <?php } ?>
     </select></div>         
       
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['search'])){
	   
		
		  
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

    
     <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
		$("#sub").click(function() {
    $("#sub").val("Submiting...");
});
   </script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
