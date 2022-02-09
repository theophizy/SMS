<?php  

//include_once ('../classes/class.Database.php');
include_once ('../classes/class.Users.php');
//include_once ('../classes/class.staff.php');
//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
	$userAction = new Users();
//include_once ('../Admin/links.php');
$staffClass = new Staff();
	
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/


		//when submit button is clicked
	 //set values to the variables
		$action=$_GET['action'];
switch($action){

	
	 //set values to the variables
	case "Edit_staff":	
	if (isset($_POST['update'])){
	 //set values to the variables
	$staffClass->staff_id = $_POST['staff_id'];
	$userAction->username = $_POST['staff_id'];
		
		$staffClass->staff_first_name = $_POST['first_name'];
	

		$staffClass->staff_middle_name = $_POST['middle_name'];
		
	
		$staffClass->staff_last_name = $_POST['last_name'];
		$userAction->login_name = $_POST['last_name'];
		
		
		$staffClass->staff_sex = $_POST['sex'];
		$day = $_POST['day'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		$staffClass->staff_date_birth = $day."/".$month."/".$year;
	
		
		$staffClass->staff_nationality = $_POST['nationality'];
		
	
		$staffClass->staff_state_origin = $_POST['state_origin'];
		
		
		$staffClass->staff_lga = $_POST['lga'];
		
		
		$staffClass->staff_marital = $_POST['marital'];
		
		
		$staffClass->staff_blood_group = $_POST['blood_group'];
		
		
		$staffClass->staff_qualification = $_POST['qualification'];
		
		
		$staffClass->staff_institution_attended = $_POST['staff_institution'];
		
	
		$staffClass->staff_course_study = $_POST['staff_course'];
		$day_graduated = $_POST['day_graduated'];
		$month_graduated = $_POST['month_graduated'];
		$year_graduated = $_POST['year_graduated'];
		$staffClass->staff_year_graduated = $day_graduated."/".$month_graduated."/".$year_graduated;
		
			$apointment_day = $_POST['apointment_day'];
		$apointment_month = $_POST['apointment_month'];
		$apointment_year = $_POST['apointment_year'];
		$staffClass->staff_year_of_appointment = $apointment_day."/".$apointment_month."/".$apointment_year;
		
		$staffClass->staff_address = $_POST['staff_address'];
		
		$staffClass->staff_email = $_POST['staff_email'];
		
		$staffClass->staff_phone = $_POST['staff_phone'];
		
		$staffClass->nextofkin_name = $_POST['nextofkin_name'];
		
		$staffClass->nextofkin_address = $_POST['nextofkin_address'];
		
		$staffClass->nextofkin_email = $_POST['nextofkin_email'];
		$staffClass->nextofkin_phone = $_POST['nextofkin_phone'];
		
	$staffClass->staff_status = "ACTIVE";
$image = basename($_FILES['file']['name']);
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {	
			//$ext=explode(".",$_FILES['file']['name']);
			$extension = strtolower(substr($image,strpos($image,".")+1));
			$updir = "../imageupload/";
			$size = $_FILES["file"]["size"];
			$uppath ="$updir$image";
			$maximun_size =  92458;//134642;
			$picture_size = floor($maximun_size/1024);
			if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' && $extension != 'gif' && $image !== ""){
			 header("location:../Admin/update_staff_record.php?err=1&staff_id=$staffClass->staff_id");
			exit;
			}elseif($size>$maximun_size){
				header("location:../Admin/update_staff_record.php?err=2&staff_id=$staffClass->staff_id");
			exit;
			}else{
			move_uploaded_file($_FILES['file']['tmp_name'],$updir.$image);
			$image_insert=$uppath;
			}
		
		}
	$staffClass->image = $image_insert;
		

	$staffClass->staff_status = "ACTIVE";
	 $insetid = $staffClass->Save();
  if(isset($insetid)){
	$userAction->updateLogin_name();
	header("location:../Admin/update_staff_record.php?emsg=2&staff_id=$staffClass->staff_id");
		exit;	
  }else{
		 header("location:../Admin/update_staff_record.php?err=10&staff_id=$staffClass->staff_id");
  }
  exit;
	 }
	break;
	 case "Reactivate_staff":
	$staffClass->staff_id = $_GET['staffid'];
	$userAction->username = $_GET['staffid'];
	$activate_staff= $staffClass->reactivateStaff();
	 if($activate_staff == true){
	  $userAction->reactivateUser();
		 	 header("location:../Admin/manage_staff.php?emsg=9");
			exit;
  }else{
	  header("location:../Admin/manage_staff.php?err=10");
  }
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