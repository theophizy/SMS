<?php  
include_once ('../classes/class.school_setup.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$cognitive = new SchoolSetup();
	$database = new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createcognitive":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['cog_name'])){
		$cognitive->cog_name = $_POST['cog_name'];
		
	}
	
	$cognitive->cog_status = "ACTIVE";
	//ccheck if class already exist
	$getcognitivename = $cognitive->AvoidCognitiveSkillsDuplicate();

	 if( isset($getcognitivename)&& $getcognitivename>0) {
			
	  header("location:../Admin/create_cognitiveskills.php?err=3");
		} 
	 else {

   $insetid = $cognitive->createCognitiveSkills();
  if($insetid==true){

	
	header("location:../Admin/create_cognitiveskills.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_cognitiveskills.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createcocnitiveskillsfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['cog_name'])){
		$cognitive->cog_name = $_POST['cog_name'];
		
	}
	
	$cognitive->cog_status = "ACTIVE";
	//ccheck if class arm already exist
	$getcognitivename = $cognitive->AvoidCognitiveSkillsDuplicate();

	 if( isset($getcognitivename)&& $getcognitivename > 0) {
			
	  header("location:../Admin/view_cognitiveskills.php?err=3");
		} 
	 else {

   $insetid = $cognitive->createCognitiveSkills();
  if($insetid==true){

	
	header("location:../Admin/view_cognitiveskills.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_cognitiveskills.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_cognitive":
	$cognitive->cog_id = $_GET['id'];
	$delete_cognitvieskill = $cognitive->deleteCognitiveSkills();
	 if($delete_cognitvieskill == true){
	   	
	header("location:../Admin/view_cognitiveskills.php?emsg=3");
	
			exit;
  }else{
	 header("location:../Admin/view_cognitiveskills.php?err=10");
  }
  exit;
  case "Edit_cognitiveskills":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['cog_id'])){
		$cognitive->cog_id = $_POST['cog_id'];
	 }
	 if (isset($_POST['cog_name'])){
	$cognitive->cog_name = $_POST['cog_name'];
	 }
	
		$cognitive->cog_status = "ACTIVE";
	$getcognitivename = $cognitive->AvoidCognitiveSkillsDuplicate();

	 if( isset($getcognitivename)&& $getcognitivename > 0) {
			
	  header("location:../Admin/view_cognitiveskills.php?err=3");
		} 
	 else {

   $insetid = $cognitive->createCognitiveSkills();

  if($insetid == true){
	
	header("location:../Admin/view_cognitiveskills.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_cognitiveskills.php?err=10");
  }
 
	 }
  }
   exit;
  case "Update_school":
   if (isset($_POST['post']) ){
	 //set values to the variables
	 if (isset($_POST['school_id'])){
		$cognitive->school_id = $_POST['school_id'];
	}
	
	if (isset($_POST['school_name'])){
		$cognitive->school_name = $_POST['school_name'];
	}
	
	if (isset($_POST['school_address'])){
		$cognitive->school_address = $_POST['school_address'];;
	}
	if (isset($_POST['school_phone'])){
		$cognitive->school_phone = $_POST['school_phone'];;
	}
	if (isset($_POST['school_email'])){
		$cognitive->school_email = $_POST['school_email'];;
	}
  $image = $_FILES['file']['name'];
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {	
			//$ext=explode(".",$_FILES['file']['name']);
			$extension = strtolower(substr($image,strpos($image,".")+1));
			$updir = "../imageupload/";
			$size =$_FILES["file"]["size"];
			$uppath ="$updir$image";
			$maximun_size=134642;//92458;
			$picture_size=floor($maximun_size/1024);
			if($extension!='jpg' && $extension!='png' && $extension!='jpeg' && $extension!='gif' && $image!==""){
			 header("location:../Admin/school_setup.php?err=1");
			exit;
			}elseif($size>$maximun_size){
				header("location:../Admin/school_setup.php?err=2");
			exit;
			}else{
			move_uploaded_file($_FILES['file']['tmp_name'],$updir.$image);
			$image_insert=$uppath;
			}
		}
		
		
	$cognitive->school_logo = $image_insert;
	}
	 $insetid = $cognitive->Save();
	if($insetid == true){
	
	header("location:../Admin/school_setup.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/school_setup.php?err=10");
  }
  exit;
  
  case "createnextterm":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	$cognitive->next_id = $_POST['next_id'];
	$cognitive->next_date = $_POST['day']."/".$_POST['month']."/".$_POST['year'];
		
	//ccheck if class arm already exist
	

   $insetid = $cognitive->createNextTerm();
  if($insetid == true){

	
	header("location:../Admin/next_term_begin.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/next_term_begin.php?err=10");
 
  
 
		  }
		
	    }
	 break;
	 
	 case "createscoreduration":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['duration_session'])){
		$cognitive->duration_session = $_POST['duration_session'];
		
	}
	if (isset($_POST['duration_term'])){
		$cognitive->duration_term = $_POST['duration_term'];
		
	}
	if (isset($_POST['start_date'])){
		$cognitive->start_date = $_POST['start_date'];
		
	}
	if (isset($_POST['end_date'])){
		$cognitive->end_date = $_POST['end_date'];
		
	}
		//ccheck if class already exist
	$getcognitivename = $cognitive->AvoidScoreDurationDuplicate();

	 if( isset($getcognitivename)&& $getcognitivename > 0) {
			
	  header("location:../Admin/exam_scoring_duration.php?err=3");
		} 
	 else {

   $insetid = $cognitive->createScoreDuration();
  if($insetid == true){

	
	header("location:../Admin/exam_scoring_duration.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/exam_scoring_duration.php?err=10");
 exit;
  }
 
		  }
		
	    }
		break;
		
		  case "createdayschoolopened":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	$cognitive->cog_student_term = $_POST['term'];
	$cognitive->cog_student_session = $_POST['sessions'];
	$cognitive->schoolopen_id = $cognitive->cog_student_term.$cognitive->cog_student_session;
	$cognitive->days_school_opened = $_POST['days'];
		
	//ccheck if class arm already exist
	$daysschoolopened = $cognitive->AvoidDaysSchoolopenedduplicate();

	 if( isset($daysschoolopened)&& $daysschoolopened > 0) {
			
	  header("location:../Admin/view_days_school_opened.php?err=3");
		} 
	 else {

   $insetid = $cognitive->createdaysSchoolOpened();
  if($insetid == true){

	
	header("location:../Admin/days_school_opened.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/days_school_opened.php?err=10");
 
  
 
		  }
		
	    }}
	 break;
	 
case "updatedaysschoolopened":
		
	if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['schoolopened_id'])){
		$cognitive->schoolopen_id= $_POST['schoolopened_id'];
		
	}
		
	if (isset($_POST['days'])){
		$cognitive->days_school_opened = $_POST['days'];
		
	}
	
		//ccheck if class already exist
	

   $insetid = $cognitive->createdaysSchoolOpened();
  if($insetid == true){

	
	header("location:../Admin/view_days_school_opened.php?emsg=2");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_days_school_opened.php?err=10");
 exit;
  }
    }
break;

case "updatescoreduration":
		
	if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['duration_id'])){
		$cognitive->duration_id = $_POST['duration_id'];
		
	}
		
	if (isset($_POST['duration_session'])){
		$cognitive->duration_session = $_POST['duration_session'];
		
	}
	if (isset($_POST['duration_term'])){
		$cognitive->duration_term = $_POST['duration_term'];
		
	}
	if (isset($_POST['start_date'])){
		$cognitive->start_date = $_POST['start_date'];
		
	}
	if (isset($_POST['end_date'])){
		$cognitive->end_date = $_POST['end_date'];
		
	}
		//ccheck if class already exist
	

   $insetid = $cognitive->createScoreDuration();
  if($insetid == true){

	
	header("location:../Admin/manage_exam_scoring_duration.php?emsg=2");
	
	
			exit;
  }else{
	 	 header("location:../Admin/manage_exam_scoring_duration.php?err=10");
 exit;
  }
    }
break;
	case "createremark":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
			

	if (isset($_POST['remark_min_mark'])){
		$cognitive->remark_min_mark = $_POST['remark_min_mark'];
		}
		if (isset($_POST['remark_max_mark'])){
		$cognitive->remark_max_mark = $_POST['remark_max_mark'];
		}
		if (isset($_POST['remark'])){
		$cognitive->remark = $_POST['remark'];
		}
		/*if (isset($_POST['remark_term'])){
		$cognitive->remark_term = $_POST['remark_term'];
		}
		
		if (isset($_POST['remark_session'])){
		$cognitive->remark_session= $_POST['remark_session'];
		}*/
		

	
	//check if grade name and remark exist
	

   $insetid = $cognitive->createFormmasterRemark();
  if($insetid == true){

	
	header("location:../Admin/form_master_remark.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/form_master_remark.php?err=10");
 exit;
  }
     }
		break;
		
		case "Edit_remark":
		
	if (isset($_POST['update']) ){
	 //set values to the variables
		
	if (isset($_POST['remark_code'])){
		$cognitive->remark_code = $_POST['remark_code'];
		}	

	if (isset($_POST['remark_min_mark'])){
		$cognitive->remark_min_mark = $_POST['remark_min_mark'];
		}
		if (isset($_POST['remark_max_mark'])){
		$cognitive->remark_max_mark = $_POST['remark_max_mark'];
		}
		if (isset($_POST['remark'])){
		$cognitive->remark = $_POST['remark'];
		}
		/*if (isset($_POST['remark_term'])){
		$cognitive->remark_term = $_POST['remark_term'];
		}
		
		if (isset($_POST['remark_session'])){
		$cognitive->remark_session= $_POST['remark_session'];
		}*/
		

	
	//check if grade name and remark exist
	

   $insetid = $cognitive->createFormmasterRemark();
  if($insetid == true){

	
	header("location:../Admin/manage_remarks.php?emsg=2");
	
	
			exit;
  }else{
	 	 header("location:../Admin/manage_remarks.php?err=10");
 exit;
  }
     }
		break;
		
// Principal remark
case "principalremark":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
			

	if (isset($_POST['remark_min_mark'])){
		$cognitive->remark_min_mark = $_POST['remark_min_mark'];
		}
		if (isset($_POST['remark_max_mark'])){
		$cognitive->remark_max_mark = $_POST['remark_max_mark'];
		}
		if (isset($_POST['remark'])){
		$cognitive->remark = $_POST['remark'];
		}
		/*if (isset($_POST['remark_term'])){
		$cognitive->remark_term = $_POST['remark_term'];
		}
		
		if (isset($_POST['remark_session'])){
		$cognitive->remark_session= $_POST['remark_session'];
		}*/
		

	
	//check if grade name and remark exist
	

   $insetid = $cognitive->createPrincipalRemark();
  if($insetid == true){

	
	header("location:../Admin/principal_remark.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/principal_remark.php?err=10");
 exit;
  }
     }
		break;
		
		case "Edit_principal_remark":
		
	if (isset($_POST['update']) ){
	 //set values to the variables
		
	if (isset($_POST['remark_code'])){
		$cognitive->remark_code = $_POST['remark_code'];
		}	

	if (isset($_POST['remark_min_mark'])){
		$cognitive->remark_min_mark = $_POST['remark_min_mark'];
		}
		if (isset($_POST['remark_max_mark'])){
		$cognitive->remark_max_mark = $_POST['remark_max_mark'];
		}
		if (isset($_POST['remark'])){
		$cognitive->remark = $_POST['remark'];
		}
		/*if (isset($_POST['remark_term'])){
		$cognitive->remark_term = $_POST['remark_term'];
		}
		
		if (isset($_POST['remark_session'])){
		$cognitive->remark_session= $_POST['remark_session'];
		}*/
		

	
	//check if grade name and remark exist
	

   $insetid = $cognitive->createPrincipalRemark();
  if($insetid == true){

	
	header("location:../Admin/manage_principal_remark.php?emsg=2");
	
	
			exit;
  }else{
	 	 header("location:../Admin/manage_principal_remark.php?err=10");
 exit;
  }
     }
		break;		
		
		
case "close_cognitive":
  
  
		    
			 $cognitive->cog_student_class = $_GET['cognitive_class'];
			
	
			
			$update = $cognitive->movePsychomotiveskillstoHistoryTable();
			if($update == true){
			
	
	header("location:../Admin/close_session_result.php?emsg=22");
			exit;
  }else{
		 header("location:../Admin/close_session_result.php?err=10");
  }
break;		
}
?>