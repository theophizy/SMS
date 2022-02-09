<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}

//include_once('../classes/class.Session.php');
//include_once('../classes/class.studentclasses.php');
//include_once('../classes/class.school_setup.php');
//include_once('../classes/class.term.php');
//include_once('../classes/class.Scores.php');
include_once('../classes/class.Classarm.php');

require_once('../classes/class.students.php');
$classarm = new  ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$createScores = new Scores();
$database= new Database();
if (isset($_POST['submit'])){
		 //get the inputed values from the text fields
		  $avgcode  = $_POST["avg_code"];
	 $days_attended = $_POST["days_attended"];
	  $days_open = $_POST["days_open"];
	  
//loop through each students scores
foreach($avgcode as $i => $avg_codesss){
	 $avg_code  = $avg_codesss;
	 
	 $days_attended1 = $days_attended[$i];
	 $days_open1 = $days_open[$i];
	 $update = $database->InsertOrUpdate("UPDATE `sms_average_scores` SET `attendance`='$days_attended1',`days_school_opened`='$days_open1' WHERE `avg_code`='$avg_code'");

	 }
 if($update == true){
	
		header("location:attendance.php?emsg=1");
			exit;
  }else{
	  //if the uodate funstion fails
		 header("location:attendance.php?err=10"); 
  }
  exit;
	

}

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
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
<div class="btn btn-reddit btn-block"> <strong>Record Student(s) Attendance</strong> </div>
                      <div class="card-header" align="center">
                        <strong><hr></strong> 
                      </div>
                      
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
     
      <?php foreach($term->viewAllTerm() as $key =>$vals){
		  $term->term_code = $vals['term_code'];
		  $term->viewTermByID();
		   ?>
     <option value="<?php echo $term->term_code ?>"><?php  echo $term->term_name ?></option>
    
	   <?php } ?>
     </select></div>   
           <div class="col col-md-3">     
    <select name="sessions" onselect="this.className" class="form-control" required >
     
      <?php foreach($availableSession->viewAllSession() as $key =>$vals){
		  $availableSession->session_code = $vals['session_code'];
		  $availableSession->viewSessionByID();
		   ?>
     <option value="<?php echo $availableSession->session_code ?>"><?php  echo $availableSession->session_description ?></option>
    
	   <?php } ?>
     </select></div> 
       
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>
                           </div>
</form>
    
 </div>
      
   <?php
  
   if(isset($_POST['search'])){
	   
		 $createScores->avg_class = $_POST['class'];
		 
		  $createScores->avg_class_arm = $_POST['class_arm'];
		 $createScores->avg_session =  $_POST['sessions'];
		$createScores->avg_term = $_POST['term'];
	
		
		if(!empty($createScores->view_avg_scoresbyTermSessionClass())){
		
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
      <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="frmactive" >
                           
        
                      <div class="row form-group">
                   <div class="box">
            <div class="box-header">
              <h3><strong><hr></strong></h3>
            </div> 
              
              
     <div class="table-responsive" >  
               
            
            <!-- /.box-header -->
            <div class="box-body">
            
            
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      
                      <th>Admision No</th>
                      <th> Name</th>
                       <th> Days school opened</th>
                       <th>Days Attended </th>
                        
                    
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				 
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($createScores->view_avg_scoresbyTermSessionClass() as $key => $values){
							
							
						   //get sudent name by his/her admission number
						 
				$studentAction->student_regno =  $values['student_no'];
						  $studentAction->viewStudentbyID();
						 
						  
				  ?>
                   
                    
                      <td><?php echo $studentAction->student_regno;?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
 
                     
                      <input type="hidden" name="avg_code[]" id="avg_code[]" value="<?php echo $values['avg_code']?>">
                      <td><input type="number" name="days_open[]" required id="days_open[]"  onKeyPress=" return isNumber(event)" value="<?php echo $values['days_school_opened']  ?>" > </td>
                     
                   <td><input type="number" name="days_attended[]" required id="days_attended[]"  onKeyPress=" return isNumber(event)" value="<?php echo $values['attendance']  ?>" > </td>
                     </tr>
                              
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  

      <div class="col col-md-12">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="submit" class=" btn btn-primary btn-block" onClick="return confirm('Confirm your entries ');">Submit</button> </div>
                           </div>
</form>
    <?php }else{ echo "The selected class has no students";}  } ?>

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
