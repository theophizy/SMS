<?php  
include_once ('../classes/class.Subject.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createSubject=new Subject();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createsubject":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['subject_code'])){
		$createSubject->subject_code = $_POST['subject_code'];
		$createSubject->subject_id = $_POST['subject_code']. $database->GenCode(3);
		}
		if (isset($_POST['subject_name'])){
		$createSubject->subject_name = $_POST['subject_name'];
		
	}
	
	$createSubject->subject_status = "ACTIVE";
	//ccheck if class already exist
	$getSubjectCode = $createSubject->avoidSubjectDuplicate();

	 if( isset($getSubjectCode)&& $getSubjectCode>0) {
			
	  header("location:../Admin/create_subject.php?err=3");
		} 
	 else {

   $insetid = $createSubject->Save();;
  if($insetid==true){

	
	header("location:../Admin/create_subject.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_subject.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createsubjectfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['subject_code'])){
		$createSubject->subject_code = $_POST['subject_code'];
		$createSubject->subject_id = $_POST['subject_code']. $database->GenCode(3);
		}
		if (isset($_POST['subject_name'])){
		$createSubject->subject_name = $_POST['subject_name'];
		
	}
	
	$createSubject->subject_status = "ACTIVE";
	//ccheck if class already exist
	$getSubjectCode = $createSubject->avoidSubjectDuplicate();

	 if( isset($getSubjectCode)&& $getSubjectCode>0) {
				
	  header("location:../Admin/view_allsubjects_edit.php?err=3");
		} 
	 else {

   $insetid = $createSubject->Save();
  if($insetid==true){

	
	header("location:../Admin/view_allsubjects_edit.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_allsubjects_edit.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
//delete subject
	case "delete_subject":
	$createSubject->subject_id = $_GET['id'];
	$delete_subject = $createSubject->deleteSubject();
	 if($delete_subject == true){
	  
		 	header("location:../Admin/view_allsubjects_edit.php?emsg=3");
			exit;
  }else{
	header("location:../Admin/view_allsubjects_edit.php?err=10");
  }
  exit;
  //if edit subject is clicked
  case "Edit_subject":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['subject_id'])){
		$createSubject->subject_id = $_POST['subject_id'];
	 }
	 if (isset($_POST['subject_code'])){
		$createSubject->subject_code = $_POST['subject_code'];
	 }
	 if (isset($_POST['subject_name'])){
	$createSubject->subject_name = $_POST['subject_name'];
	 }
	
		$getSubjectCode = $createSubject->avoidSubjectDuplicate();

	 if( isset($getSubjectCode)&& $getSubjectCode>0) {
			
	  header("location:../Admin/view_allsubjects_edit.php?err=3");
		} 
	 else {
	 $insetid = $createSubject->Save();
  if($insetid == true){
	
	header("location:../Admin/view_allsubjects_edit.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_allsubjects_edit.php?err=10");
  }
  exit;
	 }
  }
  
  case "createsubjectlimit":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
		
		if (isset($_POST['class_limit'])){
		$createSubject->class_limit = $_POST['class_limit'];
		
	}
	
		if (isset($_POST['classarm_limit'])){
		$createSubject->classarm_limit = $_POST['classarm_limit'];
		
	}
	
		if (isset($_POST['term_limt'])){
		$createSubject->term_limit = $_POST['term_limt'];
		
	}
	if (isset($_POST['session_limit'])){
		$createSubject->session_limit = $_POST['session_limit'];
		
	}
	if (isset($_POST['max_limit'])){
		$createSubject->max_limit = $_POST['max_limit'];
		
	}if (isset($_POST['min_limit'])){
		$createSubject->min_limit = $_POST['min_limit'];
		
	}
	$createSubject->limit_code = $createSubject->session_limit.$createSubject->term_limit.$createSubject->class_limit.$createSubject->classarm_limit;
	//ccheck if class already exist
	$getSubjectCode = $createSubject->avoidSubjectLimitDuplicate();

	 if( isset($getSubjectCode)&& $getSubjectCode > 0) {
				
	  header("location:../Admin/view_allsubjectslimits.php?err=3");
		} 
	 else {

   $insetid = $createSubject->createSubjectLimit();
  if($insetid == true){

	
	header("location:../Admin/set_subject_limit.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/set_subject_limit.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
// from modal
 case "createsubjectlimitmodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
		
		if (isset($_POST['class_limit'])){
		$createSubject->class_limit = $_POST['class_limit'];
		
	}
	
		if (isset($_POST['classarm_limit'])){
		$createSubject->classarm_limit = $_POST['classarm_limit'];
		
	}
	
		if (isset($_POST['term_limt'])){
		$createSubject->term_limit = $_POST['term_limt'];
		
	}
	if (isset($_POST['session_limit'])){
		$createSubject->session_limit = $_POST['session_limit'];
		
	}
	if (isset($_POST['max_limit'])){
		$createSubject->max_limit = $_POST['max_limit'];
		
	}if (isset($_POST['min_limit'])){
		$createSubject->min_limit = $_POST['min_limit'];
		
	}
	$createSubject->limit_code = $createSubject->session_limit.$createSubject->term_limit.$createSubject->class_limit.$createSubject->classarm_limit;
	//ccheck if class already exist
	$getSubjectCode = $createSubject->avoidSubjectLimitDuplicate();

	 if( isset($getSubjectCode)&& $getSubjectCode > 0) {
				
	  header("location:../Admin/view_allsubjectslimits.php?err=3");
		} 
	 else {

   $insetid = $createSubject->createSubjectLimit();
  if($insetid == true){

	
	header("location:../Admin/view_allsubjectslimits.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_allsubjectslimits.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;

case "Edit_subjectlimit":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	if (isset($_POST['max_limit'])){
		$createSubject->max_limit = $_POST['max_limit'];
		
	}if (isset($_POST['min_limit'])){
		$createSubject->min_limit = $_POST['min_limit'];
		
	}
	 if (isset($_POST['limit_code'])){
	$createSubject->limit_code = $_POST['limit_code'];
	 }
	
	 $insetid = $createSubject->createSubjectLimit();
  if($insetid == true){
	
	header("location:../Admin/view_allsubjectslimits.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_allsubjectslimits.php?err=10");
  }
 
	 }
	 break;
	 
  case "Delete_subjectlimit":
	$createSubject->limit_code = $_GET['limit_code'];
	$delete_subject = $createSubject->deleteSubjectLimit();
	 if($delete_subject == true){
	  
		 	header("location:../Admin/view_allsubjectslimits.php?emsg=3");
			exit;
  }else{
	header("location:../Admin/view_allsubjectslimits.php?err=10");
  }
  exit;
}
?>