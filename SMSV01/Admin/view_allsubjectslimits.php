<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}

require_once('../classes/class.Subject.php');
require_once('../classes/class.term.php');
include_once('../classes/class.Session.php');
require_once('../classes/class.studentclasses.php');
require_once('../classes/class.Classarm.php');
$classarm = new ClassArm();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$subject = new Subject();

$database= new Database();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
  <!-- Custom styles for this template-->
  
</head>

<body>
 <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>

 <div class="card">
   <div class="btn btn-reddit btn-block"><strong>Select Items to manage number of subjects to be offered by students </strong></div> <hr>
                      <div class="card-header" align="center">
                        <strong></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-3">
                           <select name="term" onselect="this.className" class="form-control" required >
     
      <?php foreach($term->viewAllTerm() as $key =>$val){
		  
		   ?>
     <option value="<?php echo $val['term_code'] ?>"><?php  echo $val['term_name'] ?></option>
    
	   <?php } ?>
     </select></div>                
<div class="col col-md-3">     
    <select name="session" onselect="this.className" class="form-control" required >
     
      <?php foreach($availableSession->viewAllSession() as $key =>$vals){
		
		   ?>
     <option value="<?php echo $vals['session_code']; ?>"><?php  echo $vals['session_description']; ?></option>
    
	   <?php } ?>
     </select></div>        
       
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button  type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['search'])){
	   
		$subject->term_limit = $_POST['term'];
		 
		  $subject->session_limit = $_POST['session'];
		 
		
		if(!empty($subject->viewAllSubjectLimitbyTermandSession())){
		
		
	//get Term  description using its id
		

	//$position_in_class = $createscore->position_in_class($login);
	
	
	//get total number of students who sat for exams in a term, session, class and class arm
	
   ?>
                <div class="table-responsive" >  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add new subject</button>  
                     </div>  
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
                      <th>Class</th>
                      <th>Term</th>
                      <th>Session</th>
                      <th>Maximum No of Subjects</th>
                       <th>Minimum No of Subjects</th>
                    
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <?php
				  $sn=1;
				  if(!empty($subject->viewAllSubjectLimitbyTermandSession())){
				  foreach($subject->viewAllSubjectLimitbyTermandSession() as $key => $val){
					  $studentclass->class_code = $val['class_limit'];
					  $studentclass->viewclassByID();
					  $classarm->class_arm_code = $val['classarm_limit'];
					  $classarm->viewClassArmByID();
					  $term->term_code = $val['term_limit'];
					  $term->viewTermByID();
					  $availableSession->session_code = $val['session_limit'];
					  $availableSession->viewSessionByID();
				  ?>
                   
                      <th><?php echo $sn++ ?></th>
                      <th><?php echo $studentclass->class_name.$classarm->class_arm_name; ?></th>
                      <th><?php echo $term->term_name ?></th>
                      <th><?php echo $availableSession->session_description ?></th>
                      <th><?php echo $val['max_limit'] ?></th>
                      <th><?php echo $val['min_limit'] ?></th>
                     <td><button title="Edit" class="btn btn-success" data-toggle="modal" type="button" data-target="#update_modal<?php echo $val['limit_code']?>"><span class=" fa fa-pencil"></span></button>
                     <a href="../Control_classes/subject_controller.php?action=Delete_subjectlimit&limit_code=<?php echo $val['limit_code'] ?>" class="btn btn-danger" title="Delete Item" onclick="return confirm('Are you sure?')"><span class="fa fa-trash"></span></a>
                     </td> </tr>
  <div class="modal fade" id="update_modal<?php echo $val['limit_code']?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/subject_controller.php?action=Edit_subjectlimit">
				<div class="modal-header">
					<div class="btn btn-reddit btn-block"> <strong>Edit  Info</strong> </div>
                     
                        <strong><hr></strong>
				</div>
				<div class="modal-body">
					
					
						<div class="row form-group">
                       <div class="col-md-7">
							<label>Maximum Limit of Subjects to be Offered</label>
							<input type="hidden" name="limit_code" value="<?php echo $val['limit_code']?>"/></div><div class="col-md-3">
							<input type="number" name="max_limit" value="<?php echo $val['max_limit']?>" class="form-control" required="required" />
                          
						</div></div>
                        
                       <div class="row form-group">
                       <div class="col-md-7">
							<label>Minimum Limit of Subjects to be Offered</label>
							</div>
                            <div class="col-md-3">
							<input type="number" name="min_limit" value="<?php echo $val['min_limit']?>" class="form-control" required="required" />
                          
						</div>
						
				</div>
				 <div class="row form-group">
                       <div class="col-md-4"></div>
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div></div>
                    </form>
				</div></div></div>
                    <?php  }} ?>
                  </tbody>
                </table>
              </div>
                </div>  
            <?php  }else{ echo "No Record Found";}} ?>
     
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"></h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <div class="btn btn-reddit btn-block"> <strong>Set maximum and minimum number of subjects each student in each class can offer</strong> </div>
                     
                        <strong><hr></strong>
                   
                </div>  
                <div class="modal-body">  
                     <div class="card-body card-block">
                        <form  action="../Control_classes/subject_controller.php?action=createsubjectlimitmodal" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         
                          
        <div class="row form-group">
        <div class="col col-md-2"><label>Session</label></div>
                            <div class="col col-md-3">
      <select name="session_limit" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
    </div>
     <div class="col col-md-2"><label>Term</label></div>
       <div class="col col-md-3">
      <select name="term_limt" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
    </div>
     </div>
     
     <div class="row form-group">
        <div class="col col-md-2"><label>Class</label></div>
                            <div class="col col-md-3">
      <select name="class_limit" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($studentclass->viewAllClasses() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_code'] ?>"><?php echo $val['class_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
    </div>
     <div class="col col-md-2"><label>Class Arm</label></div>
       <div class="col col-md-3">
      <select name="classarm_limit" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
    </div>
     </div>
     
     <div class="row form-group">
                            <div class="col col-md-2"><label>Maximun number of subjects</label></div>
                            <div class="col col-md-3">
                           <input   type="number" class="form-control" name="max_limit" />
                          </div> 
                          <div class="col col-md-2"><label>Minimum number of subjects</label></div>
                            <div class="col col-md-3">
                           <input   type="number" class="form-control" name="min_limit" />
                          </div> </div> 
        <div class="row form-group">
                            <div class="col col-md-2"></div>
    <div class="col col-md-9">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
                           <button title="send" type="submit" id="sub" name="post" class=" btn btn-primary btn-block">Submit</button> </div>
                           </div>
</form>
                      </div>
                     
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
      
      </div>  
 </div>  
 </body>
 
 </html>
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
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
 
