<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}


include_once('../classes/class.staff.php');

$staffAction = new Staff();
$staffAction->staff_id = $_SESSION['USERNAME'];
$staffAction->viewStaffbyID();
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
   
	
	function display(id){
		
		window.open('payment_debt.php?id='+id,'Pay Student Fee','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
	}
	function show(id){
		
		window.open('payment_page.php?id='+id,'Pay Student Fee','scrollbars=yes,resizable=yess,top=500,width=700,left=500,height=700');
		
	}
    </script> 
   


</head>
<body>

<div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
<form method="POST" action="../Control_classes/student_controller.php?action=Edit_student" name="form1">
				<div class="modal-header">
					<h3 class="modal-title">View Staff Details</h3>
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
