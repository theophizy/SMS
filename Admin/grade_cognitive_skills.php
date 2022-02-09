<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
//Instantiate classes
require_once('../classes/class.school_setup.php');
//include_once('../classes/class.Scores.php');
require_once('../classes/class.students.php');
// instantiate classes
$studentAction = new Students();
//$studentclass = new StudentClasses();
//$availableSession = new Session_class();
//$term=new Term();
//$subject=new Subject();
//$createscore = new Scores();
$database= new Database();
$school_setup = new SchoolSetup();


//get all this values from the choosen data to be scored from scores2.php
$student_term = $_GET['student_term'];
	    $session = $_GET['session'];
		 $students_class = $_GET['students_class'];
		  $students_classarm = $_GET['students_classarm'];
		//   $students_subjects = $_GET['students_subjects'];
		    // $students_subjects = $_GET['students_subjects'];
			 $student_admission_no = $_GET['regno'];
		
		   // when submit button is clicked
	 if (isset($_POST['send'])){
		 //get the inputed values from the text fields
		
		 // $student_regss = $_POST["student_regno"];
//loop through each students scores

			  $cog_id  = $_POST["cog_code"];
	    $value1 = $_POST["cog"];
for($i=0; $i < count($cog_id); $i++){
	 $codid= $cog_id[$i];
	  $selectedvalue= $value1[$codid];
	
	  
$student_cog_code = $student_admission_no.$codid.$students_class.$student_term.$session;
	 
			
		
		
$update =$database->InsertOrUpdate("INSERT INTO `sms_cognitive_student`(`cog_student_id`,`cog_student_reg`,`cognitive_id`,`cog_student_item`,`cog_student_class`,`cog_student_session`,`cog_student_term`,`cog_student_status`
) VALUES('$student_cog_code','$student_admission_no','$codid','$selectedvalue','$students_class','$session','$student_term','ACTIVE')");

	 
	  }
	  
	if($update == true){
	
		header("location:grade_cognitive_skills.php?emsg=1&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects&regno=$student_admission_no");
			
  }else{
	  //if the uodate funstion fails
		 header("location:grade_cognitive_skills.php?err=17&student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm&students_subjects=$students_subjects&regno=$student_admission_no"); 
 
 
}	 
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
    function sum(){
		var first = document.getElementById('text1').value; 
		var second = document.getElementById('text2').value; 
		var result = parseInt(first) +  parseInt(second) ; 
		if(!isNaN(result)){
			document.getElementById('text3').value = result;
			}
	}
	
	 function checkValue(input,test){
	
	if(input.value <0 || input.value >test){
		alert("Specifield value exceeded");
		input.value=0;
		
}}
 function checkexam(input,values){
	if(input.value <0 || input.value >values){
		alert("Specifield value exceeded" );
		input.value=0;
		
}}
    </script> 

</head>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

        <div class="content mt-3">

   
    
  
                <form action="" method="post"> 
               
     
                 
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="col-lg-6">
            
            <div class="btn btn-reddit btn-block"> <strong>Psychomotive Grading Template</strong> </div>
                        <strong><hr></strong>
                 
     
     <div class="table-responsive" >  
                   
                  
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Availabe Cognitive Skilss</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
     <th>Sn</th>
     <th>Cognitive</th>
     
     <th>1</th>
     <th>2</th>
     <th>3</th>
     <th>4</th>
     <th>5</th>
     
     </tr>
       </thead>
      <?php
	
	   $sno=0;
	$date = date('Y/m/d');
		
	  foreach($school_setup->viewAllCognitiveSkills() as $key => $value){
		  
		  $sno++;
		
	  ?>
     
   
     <tbody>
    
     <tr>
      <td><?php echo $sno ?></td>
     <td><?php echo  ucwords(strtolower($value['cog_name']));  ?></td>
   
     
     <input type="hidden" name="cog_code[]"  value="<?=$value['cog_id']?>">
      <td> <input type="radio" name="cog[<?=$value['cog_id']?>]"  value="1" required></td>
     
        <td><input type="radio" name="cog[<?=$value['cog_id']?>]"  value="2"></td>  
           <td><input type="radio" name="cog[<?=$value['cog_id']  ?>]"  value="3"></td>  
              <td><input type="radio" name="cog[<?=$value['cog_id']  ?>]"  value="4"></td>  
                 <td><input type="radio" name="cog[<?=$value['cog_id']  ?>]"  value="5"> 
                 </td>  
        
         
     </tr>
     <?php } ?>
    
     </tbody>
      
     </table>
     
    
                       
                    </div>
                         <input type="submit" id="sub" name="send" value="Submit" class="btn btn-success btn-block">
     </form>

           
                <!-- /# card -->
            </div>


        </div> <!-- .content -->
     
 </div>  
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
