<?php  
include_once ('../classes/class.Session.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createSession=new Session_class();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createsession":
		
	if (isset($_POST['session_description']) ){
	 //set values to the variables
		
	if (isset($_POST['session_description'])){
		$createSession->session_description = $_POST['session_description'];
		
	}
	
	$createSession->session_status = "ACTIVE";
	//ccheck if term already exist
	$getsession = $createSession->AvoidSessionDuplicate();

	 if( isset($getsession)&& $getsession>0) {
			
	  header("location:../Admin/create_session.php?err=3");
		} 
	 else {

   $insetid = $createSession->Save();
  if($insetid==true){

	
	header("location:../Admin/create_session.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_sesssion.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createsessionfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['session_description'])){
		$createSession->session_description = $_POST['session_description'];
		
	}
	
	$createSession->session_status = "ACTIVE";
	//ccheck if class already exist
	$getsession = $createSession->AvoidSessionDuplicate();

	 if( isset($getsession)&& $getsession>0) {
			
	  header("location:../Admin/view_session_edit.php?err=3");
		} 
	 else {

   $insetid = $createSession->Save();
  if($insetid==true){

	
	header("location:../Admin/view_session_edit.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_session_edit.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_session":
	$createSession->session_code = $_GET['id'];
	$delete_session = $createSession->deleteSession();
	 if($delete_session == true){
	  
		 	 header("location:../Admin/view_session_edit.php?emsg=3");
			exit;
  }else{
	  header("location:../Admin/view_session_edit.php?err=10");
  }
  exit;
  case "Edit_session":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['session_code'])){
		$createSession->session_code = $_POST['session_code'];
	 }
	 if (isset($_POST['session_description'])){
	$createSession->session_description = $_POST['session_description'];
	 }
	$getsession = $createSession->AvoidSessionDuplicate();

	 if( isset($getsession)&& $getsession>0) {
			
	  header("location:../Admin/view_session_edit.php?err=3");
		} 
	 else {
	
	 $insetid = $createSession->Save();
  if($insetid == true){
	
	header("location:../Admin/view_session_edit.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_session_edit.php?err=10");
  }
  exit;
	 }
  }
}
?>