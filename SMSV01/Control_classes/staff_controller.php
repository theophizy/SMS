<?php  
//include_once ('../classes/class.staff.php');
//include_once ('../classes/class.Database.php');
include_once ('../classes/class.Users.php');
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
		
	
		$staffClass->staff_id = $_GET['staff_id'];
	
		
		$staffClass->staff_first_name = $_GET['first_name'];
	

		$staffClass->staff_middle_name = $_GET['middle_name'];
		
	
		$staffClass->staff_last_name = $_GET['last_name'];
		
		
		$staffClass->staff_sex = $_GET['sex'];
		$day = $_GET['day'];
		$month = $_GET['month'];
		$year = $_GET['year'];
		$staffClass->staff_date_birth = $day."/".$month."/".$year;
	
		
		$staffClass->staff_nationality = $_GET['nationality'];
		
	
		$staffClass->staff_state_origin = $_GET['state_origin'];
		
		
		$staffClass->staff_lga = $_GET['lga'];
		
		
		$staffClass->staff_marital = $_GET['marital'];
		
		
		$staffClass->staff_blood_group = $_GET['blood_group'];
		
		
		$staffClass->staff_qualification = $_GET['qualification'];
		
		
		$staffClass->staff_institution_attended = $_GET['staff_institution'];
		
	
		$staffClass->staff_course_study = $_GET['staff_course'];
		$day_graduated = $_GET['day_graduated'];
		$month_graduated = $_GET['month_graduated'];
		$year_graduated = $_GET['year_graduated'];
		$staffClass->staff_year_graduated = $day_graduated."/".$month_graduated."/".$year_graduated;
		
			$apointment_day = $_GET['apointment_day'];
		$apointment_month = $_GET['apointment_month'];
		$apointment_year = $_GET['apointment_year'];
		$staffClass->staff_year_of_appointment = $apointment_day."/".$apointment_month."/".$apointment_year;
		
		$staffClass->staff_address = $_GET['staff_address'];
		
		$staffClass->staff_email = $_GET['staff_email'];
		
		$staffClass->staff_phone = $_GET['staff_phone'];
		
		$staffClass->nextofkin_name = $_GET['nextofkin_name'];
		
		$staffClass->nextofkin_address = $_GET['nextofkin_address'];
		
		$staffClass->nextofkin_email = $_GET['nextofkin_email'];
		$staffClass->nextofkin_phone = $_GET['nextofkin_phone'];
		


	$staffClass->staff_status = "ACTIVE";
	//ccheck if student with such admmission number  exist
	$getstaff = $staffClass->AvoidStaffDuplicate();

	 if( isset($getstaff)&& $getstaff > 0) {
			
	  header("location:../Admin/Register_staff.php?err=3");
		}
		elseif(empty($_GET['sex']) || empty($_GET['day']) || empty($_GET['month']) || empty($_GET['year']) || empty($_GET['marital'] ) || empty($_GET['apointment_day']) || empty($_GET['apointment_month']) || empty($_GET['apointment_year'])){
		 header("location:../Admin/Register_staff.php?err=11");
		}else{

   $insetid = $staffClass->Save();
  if($insetid==true){

	$userAction->username = $_GET['staff_id'];
					//encrypt password
					$userAction->password = password_hash($_GET['staff_id'], PASSWORD_DEFAULT);
					$userAction->login_name =  $_GET['last_name'];
					$userAction->role = "Staff";
					$userAction->user_status = "ACTIVE";
					$userAction->Save();
	header("location:../Admin/Register_staff.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/Register_staff.php?err=10");
 exit;
  }
 
		  
	
}
	
?>