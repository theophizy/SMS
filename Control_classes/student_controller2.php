<?php  

//include_once ('../classes/class.Database.php');
include_once ('../classes/class.Users.php');
include_once ('../classes/class.students.php');
//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
	$userAction = new Users();
//include_once ('../Admin/links.php');
$studentAction = new Students();
	//$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/


		//when submit button is clicked
	 //set values to the variables
		
	$year = $_GET['year_admitted'];
		$regno = $studentAction->generateMatrixNumber($year);
		$studentAction->student_regno = $regno;
		$studentAction->first_name = $_GET['first_name'];
	

		$studentAction->middle_name = $_GET['middle_name'];
		
	
		$studentAction->last_name = $_GET['last_name'];
		
		
		$studentAction->sex = $_GET['sex'];
		$day = $_GET['day'];
		$month = $_GET['month'];
		$year = $_GET['year'];
		$studentAction->date_birth = $day."/".$month."/".$year;
	
		
		$studentAction->nationality = $_GET['nationality'];
		
	
		$studentAction->state_origin = $_GET['state_origin'];
		
		
		$studentAction->lga = $_GET['lga'];
		
		
		$studentAction->student_class = $_GET['student_class'];
		
		
		$studentAction->student_classarm = $_GET['student_classarm'];
		
		
		$studentAction->student_class_admitted = $_GET['student_class_admitted'];
		
		
		$studentAction->student_house = $_GET['student_house'];
		
	
		$studentAction->blood_group = $_GET['blood_group'];
		
		
		$studentAction->term_admitted = $_GET['term_admitted'];
		
		$studentAction->session_admitted = $_GET['session_admitted'];
		
		$studentAction->guardian_name = $_GET['guardian_name'];
		
		$studentAction->guardian_address = $_GET['guardian_address'];
		
		$studentAction->guardian_phone = $_GET['guardian_phone'];
		
		$studentAction->guardian_email = $_GET['guardian_email'];
		


	$studentAction->student_status = "ACTIVE";
	//ccheck if student with such admmission number  exist
	$getstudent = $studentAction->AvoidStudentsDuplicate();

	 if( isset($getstudent)&& $getstudent>0) {
			
	  header("location:../Admin/stepform.php?err=3");
		}
		elseif(empty($_GET['sex']) || empty($_GET['student_class']) || empty($_GET['student_classarm'])){
		 header("location:../Admin/stepform.php?err=11");
		}else{

   $insetid = $studentAction->Save();
  if($insetid==true){

	$userAction->username = $_GET['student_regno'];
					//encrypt password
					$userAction->password = password_hash($_GET['student_regno'], PASSWORD_DEFAULT);
					$userAction->login_name =  $_GET['last_name'];
					$userAction->role = "Student";
					$userAction->Save();
	header("location:../Admin/stepform.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/stepform.php?err=10");
 exit;
  }
 
		  }
		
	    
		
	
?>