<?php
session_start();
ob_start();
	if(!isset($_SESSION['USERNAME'])){
	echo "<script>
location='../'
</script>";
}
//Instantiate classes

/*include_once('../classes/class.FeeItem.php');
include_once('../classes/class.Session.php'); 
include_once('../classes/class.studentclasses.php');
include_once('../classes/class.term.php');
include_once('../classes/class.Scores.php');*/
include_once('../classes/class.Classarm.php');
include_once('../classes/class.Feeitem.php');
require_once('../classes/class.students.php');
$classarm = new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term = new Term();
$createscore = new Scores();
$feeItem = new FeeItem();



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
    function sum(){
		var first = document.getElementById('text1').value; 
		var second = document.getElementById('text2').value; 
		var result = parseInt(first) +  parseInt(second) ; 
		if(!isNaN(result)){
			document.getElementById('text3').value = result;
			}
	}
	
	function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getarm(armid) {		
		
		var strURL="findarm.php?armid="+armid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('classarmid').innerHTML=req.responseText;
												
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getsubject(classid) {		
		var strURL="findsubject.php?classid="+classid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subjectid').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	function getCity(studentrec,subj) {		
		var strURL="findrecords.php?studentrec="+studentrec+"&subj="+subj;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('recdiv').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	function show(student_term,students_class,session,students_classarm,regno){
		window.open('grade_cognitive_skills.php?student_term='+student_term+'&students_class='+students_class+'&session='+session+'&students_classarm='+students_classarm+'&regno='+regno,'Grade Student Cognitive Skills','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
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
                    <div class="btn btn-reddit btn-block"> <strong>Select items to grant students view result privileges</strong> </div>
                      <div class="card-header" align="center">
                        <strong><hr></strong> 
                      </div>
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal" onSubmit="return ValidatePost();">
                           
         <div class="row form-group">
                            <div class="col col-md-3">
                           <?php echo $studentclass->classSelectField(); ?><font color="#FF0000">*</font></div>                
<div class="col col-md-2">     
       <select name="classarm" onselect="this.className" class="form-control">
      
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	
	  } ?>
     </select></div>
        
   
    <div class="col col-md-3">
      <select name="term" onselect="this.className" class="form-control">
      <option value="0">Term</option>
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	
	  } ?>
     </select>
     </div>
     <div class="col col-md-3">
      <select name="fee_cat" onselect="this.className" class="form-control">
      <option value="0">fee category</option>
      <?php
	  
	  foreach($feeItem->viewAllFeecat() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['fee_cat_id'] ?>"><?php echo $val['fee_cat_name'] ?></option>
    
     <?php
	 } ?>
     </select>
     </div>
      
    <div class="col col-md-1">
     
                           
                           <!--<i class="fa fa-circle-o-notch fa-spin"></i>-->
 <button title="send" type="submit" id="sub" name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>
                           </div></div>
</form>
    
 
      
   <?php
  
   if(isset($_POST['search'])){
	   
	   //get post values
	  // $students_subjects = $_POST['subject'];
      $term->getCurrentTermAndSession();
      
	   $student_term = $_POST['term'];
	 
	    $session = $term->current_session;
		
	 
		 $students_class = $_POST['student_class'];
		 
	 	   
		  $students_classarm = $_POST['classarm'];
		 
	 
	  $createscore->avg_class_arm = $students_classarm;
	  //bind selected subject id to its variable and pass it into view subject a by its id to get the name of the subject 
		
		
		//same operation to get session description
		$createscore->avg_session = $session;
		//get student regno from login session
		//$createscore->score_student_regno = $login;
		//same operation to get term name
		$createscore->avg_term = $student_term;
		
		//same operation to get class name
		$createscore->avg_class = $students_class;
		if(($_POST['term']==0) || ($_POST['student_class']==0) || ($_POST['classarm']==0) || ($_POST['fee_cat']==0)){
			 header("location:result_privilege.php?err=16");
		}elseif(!empty($createscore->view_avg_scoresbyTermSessionClass())){
				 
		
	/*header("location:view_class_result1.php?student_term=$student_term&students_class=$students_class&session=$session&students_classarm=$students_classarm");*/
		
		 $classarm->class_arm_code = $students_classarm;
$classarm->viewClassArmByID();	   
	//get class  description using its id
	$studentclass->class_code = $students_class;
	$studentclass->viewclassByID();	
	//get Term  description using its id
	$term->term_code = $student_term;
	$term->viewTermByID();
	//get session  description using its id
	$availableSession->session_code = $session;
	$availableSession->viewSessionByID();
	$feeItem->fee_cat = $_POST['fee_cat'];
	$feeItem->fee_item_classid = $students_class;
	$feeItem->fee_item_classarm =  $students_classarm;
	$feeItem->fee_item_term = $student_term;
	$feeItem->fee_item_session = $session;
   ?>
      <div class="col-lg-12">
      <form  action="../Control_classes/Scores_controller.php?action=result_privilege" method="post" enctype="multipart/form-data" class="form-horizontal" name="frmactive" >
             
     <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class: <?php echo $studentclass->class_name.$classarm->class_arm_name?> &nbsp;&nbsp;&nbsp; TERM:<?php echo $term->term_name?> &nbsp;&nbsp;&nbsp; SESSION:<?php echo $availableSession->session_description?></h3><hr>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th><input type="checkbox" name="allbox" value="all" onClick="un_check(this);" title="Select or Deselct ALL" style="background-color:#ccc;"/></th>

                      <th>Admision No</th>
                      <th> Name</th>
                      <th> Class</th>
                       <th> Payment Status</th>
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				$payment_status;
				$balance;
				 if(!empty($createscore->view_avg_scoresbyTermSessionClass())){
		 foreach($createscore->view_avg_scoresbyTermSessionClass() as $key => $values){
							
						   //get sudent name by his/her admission number
						    $student_admission_no = $values['student_no'];
						$studentAction->student_regno =  $student_admission_no;
						  $studentAction->viewStudentbyID();
						    $createscore->score_student_regno = $student_admission_no;
				/*if(!empty($feeItem->viewPaymentbyTermSessionClassFeecatStudent($student_admission_no))){
								foreach($feeItem->viewPaymentbyTermSessionClassFeecatStudent($student_admission_no) as $key => $val){
								
							  $amount_paid = $val['pay_amount'];
							  $feeItem->fee_item_id = $val['pay_feeitem'];
							  $feeItem->viewfeeitemByID();
							  $balance = $feeItem->fee_item_amount - $amount_paid;
							  echo $balance."==".$amount_paid."======".$feeItem->fee_item_amount;
							  if( $balance > 0){
								$payment_status = "Part Payment ";
							  }else{
								$payment_status = "complete Payment ";  
							  }
						 
							*/
				  ?>
                   
                   <td><input name="checkbox[]" type="checkbox" id="checkbox[]" title="<?php echo $values['avg_code']; ?>"  value="<?php echo $values['avg_code']; ?>"></td>
                      <td><?php echo $studentAction->student_regno?></td>
                      <td><?php echo $studentAction->last_name."  ".$studentAction->first_name ?></td>
                      <td><?php echo $studentclass->class_name.$classarm->class_arm_name ?></td>
                      <?php
                      if(!empty($feeItem->viewPaymentbyTermSessionClassFeecatStudent($student_admission_no))){
	foreach($feeItem->viewPaymentbyTermSessionClassFeecatStudent($student_admission_no) as $key => $val){
								
							 
							  $feeItem->fee_item_id = $val['pay_feeitem'];
							  $feeItem->viewfeeitemByID();
							  $amount = $feeItem->sumAmountPaidByStdentandFeeitem($student_admission_no,$val['pay_feeitem']);
							 
							$balance = $feeItem->fee_item_amount - $amount;
							  if( $balance > 0){
								$payment_status = "Part Payment ";
							  }else{
								$payment_status = "complete Payment ";  
							  }
						 
							?>
                      <td><?php echo $payment_status; ?></td>
                    <?php }}else{ ?>
                     <td><?php echo "No payment made"; ?></td>
                      <?php } ?>
                     </tr>
 
            
     
 <?php  }}else{ echo "Results not yet ready"; } ?>       
			
  	
		
                  </tbody>
                </table>
       </div>

         <button class="btn btn-primary btn-block" name="privilege" type="submit" onClick="return confirm('Grant the selected students privilege to view and print their results?')">Grant Result View Privilege</button>
         </form>

 <?php }else{ echo "No Records Found for the Selected Items";} } ?>
     
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
