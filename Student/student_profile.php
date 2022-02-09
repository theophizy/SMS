<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
//Instantiate classes
require_once('../classes/class.Subject.php');
/*
include_once('../classes/class.Classarm.php');
include_once('../classes/class.Session.php');
include_once('../classes/class.studentclasses.php');
include_once('../classes/class.term.php');
include_once('../classes/class.Scores.php');*/

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
   
	
	function show(student_term,students_class,session,students_classarm,regno){
		window.open('grade_cognitive_skills.php?student_term='+student_term+'&students_class='+students_class+'&session='+session+'&students_classarm='+students_classarm+'&regno='+regno,'Grade Student Cognitive Skills','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
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

<div class="col-lg-10" align="center"> 
<?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

           <div class="btn btn-reddit btn-block"> <strong>Student Profile</strong> </div><strong><hr></strong>
 <div class="col-lg-12">
 
                    <div class="card">
                      <div class="card-header" align="center">
                        
                      </div>
                      
                      <div class="card-body card-block">
                     
    
 
      
   <?php
  
  
						   //get sudent name by his/her admission number
						 
						$studentAction->student_regno = $_SESSION['USERNAME'];
						  $studentAction->viewStudentbyID();
						  
				  ?>
                   
                     
   
    
<form method="POST" action="../Control_classes/student_controller.php?action=Edit_student" name="form1" enctype="multipart/form-data">
				<div class="modal-header">
					<h3 class="modal-title" align="center" > Student Details</h3>
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
                            
                    <input type="text" name="last_name" value="<?php echo $studentAction->last_name?>" class="form-control" readonly/>
						</div>
						 </div>
                       <br><br>
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
                            
                    <input type="text" name="middle_name" value="<?php echo $studentAction->middle_name?>" class="form-control" readonly/>
						</div>
						 </div>
                         
                          <br><br>
                         
                         <div class="form-group">
                <div class="col-md-3">
							<label>SEX</label>
							</div>
                        <div class="col-md-3" align="left">      
		<input type="text" name="sex" onSelect="this.className" class="form-control" readonly  value="<?php echo $studentAction->sex ?>" >
      </div>
         <div class="col-md-3">
							  <label>Date of Birth</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="date_birth" value="<?php echo $studentAction->date_birth?>" class="form-control" readonly/>
						</div>
						 </div>
                    
                         <br><br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Nationality</label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input type="text" name="nationality" value="<?php echo $studentAction->nationality ?>" class="form-control" readonly/></div>
         <div class="col-md-3">
							  <label>LGA</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                            
                    <input type="text" name="lga" value="<?php echo $studentAction->lga?>" class="form-control" readonly />
						</div>
						 </div>
                          <br><br>
                      
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
		 <input type="text" name="blood_group"  class="form-control" readonly value="<?php echo $studentAction->blood_group ?>"> 
     </div>
                        
         
						 </div>
                          <br><br>
                         
                         
                          
                         <div class="form-group">
                         
                         <div class="col-md-3">
							  <label>Student House</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                   <select name="student_house" onselect="this.className" class="form-control" required >
      <option value=" <?php echo $studentAction->student_house ?>"> <?php echo $studentAction->student_house ?></option>
      <?php foreach($classarm->viewAllClassarm() as $key =>$vals){
		  $classarm->class_arm_code = $vals['class_arm_code'];
		  $classarm->viewClassArmByID();
		   ?>
     <option value="<?php echo $classarm->class_arm_code ?>"><?php  echo $classarm->class_arm_name ?></option>
    
	   <?php } ?>
     </select>
						</div>
                          <div class="col-md-3">
							<label> Current Class</label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input name="class" onSelect="this.className" class="form-control" readonly value="<?php $studentclass->class_code = $studentAction->student_class; $studentclass->viewclassByID(); echo $studentclass->class_name ?>">
     
    </div>
						 </div>
                         
                          <br><br>
                         
                         <div class="form-group">
                          <div class="col-md-3">
							  <label> Current Class Arm</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                   <input name="class_arm" onSelect="this.className" class="form-control" readonly value=" <?php $classarm->class_arm_code = $studentAction->student_classarm; $classarm->viewClassArmByID(); echo $classarm->class_arm_name ?>">
     
						</div>
                         <div class="col-md-3">
							<label>Class Admitted</label>
							</div>
                        <div class="col-md-3" align="left">      
		 <input name="class_admitted" onSelect="this.className" class="form-control" readonly option value=" <?php $studentclass->class_code = $studentAction->student_class_admitted;
	   if(!empty($studentAction->student_class_admitted)){
	  
	   $studentclass->viewclassByID(); echo $studentclass->class_name;
	   }?>">
</div>
        
						 </div>
                          <br><br>
                         <div class="form-group">
                                 
         <div class="col-md-3">
							  <label>Term Admitted</label>
							</div>
      
        <div class="col-md-3" align="left"> 
                   <input name="term_admitted" onSelect="this.className" class="form-control" readonly  value=" <?php $term->term_code = $studentAction->term_admitted; 
	  if(!empty($studentAction->term_admitted)){
	 $term->viewTermByID();
		   echo $term->term_name;
	  }?>">
     
						</div>
                
         <div class="col-md-3">
							  <label>Session Admitted</label>
							</div>
                            
      
        <div class="col-md-3" align="left"> 
         <?php 
        $availableSession->session_code = $studentAction->session_admitted; 
	  if(!empty($studentAction->session_admitted)){
	  $availableSession->viewSessionByID();?>
                   <input name="session_admitted" onSelect="this.className" class="form-control" readonly  value="<?php  echo $availableSession->session_description ;  ?>" >
     <?php } ?>
						</div>
						 </div>
                          <br><br>
                         
                          <div class="form-group">
                         <div class="col-md-3">
							<label>Guardian Phone</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="text" name="guardian_phone" value="<?php echo $studentAction->guardian_phone ?>" class="form-control"readonly/>     
		</div></div>
         <br><br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Guardian Name</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="text" name="guardian_name" value="<?php echo $studentAction->guardian_name ?>" class="form-control" readonly/>     
		</div>
        
						 </div>
                         
                           <br><br> 
                         <div class="form-group">
                <div class="col-md-3">
							<label>Guardian email</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <input type="email" name="guardian_email" value="<?php echo $studentAction->guardian_email ?>" class="form-control" readonly />     
		</div>
        
						 </div>
                          <br><br>
                         <div class="form-group">
                <div class="col-md-3">
							<label>Guardian Address</label>
							</div>
                        <div class="col-md-9" align="left"> 
                         <textarea name="guardian_address" readonly class="form-control"><?php echo $studentAction->guardian_address  ?></textarea>    
		</div>
        
						 </div>
                         </div>

                        
   
				</div>
                    </form>
				</div></div></div>
 
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
