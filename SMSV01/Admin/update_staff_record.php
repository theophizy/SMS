<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
//Instantiate classes
require_once('../classes/class.staff.php');

$staffAction = new Staff();

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
				<div class="modal-body">
                <div class=" col-lg-12">
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
     <?php $dob = $staffAction->staff_date_birth; 
	 $orderdate = explode('/',$dob);
	 ?>
      <div class="row form-group">
      <div class=" col-md-3"><strong>Date of Birth</strong></div>
    <div class=" col-md-3"><select name="day" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[0]; ?> "><?php echo $orderdate[0]; ?></option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="month" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[1]; ?>"><?php echo $orderdate[1]; ?></option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="year" onselect="this.className" class="form-control" required >
      <option value="<?php echo $orderdate[2]; ?>"><?php echo $orderdate[2]; ?></option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div></p>
    
         
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
                        
                         <div class=row "form-group">
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
                           <?php $attended = $staffAction->staff_year_graduated; 
	 $attendeddate = explode('/',$attended);
	 ?>
      <div class="row form-group">
      <div class=" col-md-3"><strong>Year Attended</strong></div>
    <div class=" col-md-3"><select name="day_graduated" onselect="this.className" class="form-control" required >
      <option value="<?php echo $attendeddate[0]; ?> "><?php echo $attendeddate[0]; ?></option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="month_graduated" onselect="this.className" class="form-control" required >
      <option value="<?php echo $attendeddate[1]; ?>"><?php echo $attendeddate[1]; ?></option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="year_graduated" onselect="this.className" class="form-control" required >
      <option value="<?php echo $attendeddate[2]; ?>"><?php echo $attendeddate[2]; ?></option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div></p>
    
         
  </div>
  
    <?php $doapp = $staffAction->staff_year_of_appointment; 
	 $appdate = explode('/',$doapp);
	 ?>
      <div class="row form-group">
      <div class=" col-md-3"><strong>Date of Appintment</strong></div>
    <div class=" col-md-3"><select name="apointment_day" onselect="this.className" class="form-control" required >
      <option value="<?php echo $appdate[0]; ?> "><?php echo $appdate[0]; ?></option>
    <?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
    	<?php } ?>
     </select>
     </div>
     <div class=" col-md-3"><select name="apointment_month" onselect="this.className" class="form-control" required >
      <option value="<?php echo $appdate[1]; ?>"><?php echo $appdate[1]; ?></option>
    <?php for ($month = 1; $month <= 12; $month++){ ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
     </select></div>
    <div class=" col-md-3">
     <select name="apointment_year" onselect="this.className" class="form-control" required >
      <option value="<?php echo $appdate[2]; ?>"><?php echo $appdate[2]; ?></option>
     <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
     </select></div></div></p>
    
         
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
                            
                    <input type="file" name="file" class="form-control" > <img class="user-avatar rounded-circle" src="<?php echo $staffAction->image?>" style="height:40; width:40px;"  alt="User Avatar"> </div>
						
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
