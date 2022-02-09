<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}

//Instantiate classes

require_once('../classes/class.Subject.php');
require_once('../classes/class.term.php');
include_once('../classes/class.Session.php');
require_once('../classes/class.studentclasses.php');
//require_once('../classes/class.Classarm.php');
$classarm = new ClassArm();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();

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

  <!-- Custom fonts for this template-->
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

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
   

    

</head>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-3">

           <div class="btn btn-reddit btn-block"><strong>Set maximum and minimum number of subjects each student in each class is offer  </strong></div> <hr>
 <div class="col-lg-4">
 
                    <div class="card">
                      <div class="card-header" align="center">
                       
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="../Control_classes/subject_controller.php?action=createsubjectlimit" method="post" enctype="multipart/form-data" class="form-horizontal" name="postForm" onSubmit="return ValidatePost();">
                           
         
                          
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
