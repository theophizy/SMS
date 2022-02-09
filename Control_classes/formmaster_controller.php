<?php  

//include_once ('../classes/class.Database.php');
include_once ('../classes/class.form_master.php');
//include_once ('../classes/class.staff.php');
//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
	$formMaster = new ClassFormMaster();
	$database = new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/


		//when submit button is clicked
	 //set values to the variables
		$action = $_GET['action'];
switch($action){

	
	 //set values to the variables
	case "asign_form_master":
		
	if (isset($_POST['send'])){
	 //set values to the variables
	$formMaster->formaster_code = $database->GenCode(5);
	$formMaster->formaster_staffid = $_POST['staff_id'];
	$formMaster->formaster_class_code = $_POST['student_class'];
	$formMaster->formaster_class_arm = $_POST['class_arm'];
	$formMaster->date_from = date('Y-m-d');
		$formMaster->formaster_status = "ACTIVE";
	
	
	$getFormasterClass = $formMaster->avoidForMasterDuplicate();
	$getFormasterstaff = $formMaster->avoidForMasterDuplicateEntry();


	 if( isset($getFormasterClass)&& $getFormasterClass > 0) {
			
	  header("location:../Admin/class_master.php?err=33");
		} 
	 elseif(isset($getFormasterstaff)&& $getFormasterstaff > 0) {
		  header("location:../Admin/class_master.php?err=34");
	 }else{
		
	 $insetid = $formMaster->Save();
  if($insetid == true){
	
	header("location:../Admin/class_master.php?emsg=2");
			
  }else{
		 header("location:../Admin/class_master.php?err=10");
  }
 
	 }}
	break;
	
	 case "Change_formmaster":
	if (isset($_POST['update'])){
	$formMaster->formaster_code = $_POST['formaster_code'];
	$formMaster->formaster_staffid = $_POST['staff_id'];
	$formMaster->date_from = date('Y-m-d');
	$getFormasterCode = $formMaster->avoidForMasterDuplicateEntry();

	 if( isset($getFormasterCode)&& $getFormasterCode > 0) {
			
	  header("location:../Admin/view_master.php?err=34");
		} 
	 else {	
	 $populate_history_table = $formMaster->moveFormTeachertoHistory();
	 if($populate_history_table == true){
	$asignformaster = $formMaster->Save();
	 if($asignformaster == true){
	 
		 	 header("location:../Admin/view_master.php?emsg=2");
			exit;
  }else{
	  header("location:../Admin/view_master.php?err=10");
  }}}}
  exit;  
  break;
  case "Deactivate_staff":
	$staffClass->staff_id = $_GET['staffid'];
	$userAction->username = $_GET['staffid'];
	$deactivate_staff = $staffClass->deactivateStaff();
	 if($deactivate_staff == true){
	  $userAction->deactivateUser();
		 	 header("location:../Admin/manage_staff.php?emsg=8");
			exit;
  }else{
	  header("location:../Admin/manage_staff.php?err=10");
  }
  exit; 
	
}
	
?>