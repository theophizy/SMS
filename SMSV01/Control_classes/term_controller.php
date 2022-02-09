<?php  
include_once ('../classes/class.term.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createTerm=new Term();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createterm":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['term_name'])){
		$createTerm->term_name = $_POST['term_name'];
		
	}
	
	$createTerm->term_status = "ACTIVE";
	//ccheck if term already exist
	$gettermname = $createTerm->AvoidTermDuplicate();

	 if( isset($gettermname)&& $gettermname>0) {
			
	  header("location:../Admin/create_term.php?err=3");
		} 
	 else {

   $insetid = $createTerm->Save();
  if($insetid==true){

	
	header("location:../Admin/create_term.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_term.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createtermfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['term_name'])){
		$createTerm->term_name = $_POST['term_name'];
		
	}
	
	$createTerm->term_status = "ACTIVE";
	//ccheck if class already exist
	$gettermname = $createTerm->AvoidTermDuplicate();

	 if( isset($gettermname)&& $gettermname>0) {
			
	  header("location:../Admin/view_term_edit.php?err=3");
		} 
	 else {

   $insetid = $createTerm->Save();
  if($insetid==true){

	
	header("location:../Admin/view_term_edit.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_term_edit.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_term":
	$createTerm->term_code = $_GET['id'];
	$delete_term = $createTerm->deleteTerm();
	 if($delete_term == true){
	  
		 	 header("location:../Admin/view_term_edit.php?emsg=3");
			exit;
  }else{
	  header("location:../Admin/view_term_edit.php?err=10");
  }
  exit;
  case "Edit_term":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['term_code'])){
		$createTerm->term_code = $_POST['term_code'];
	 }
	 if (isset($_POST['term_name'])){
	$createTerm->term_name = $_POST['term_name'];
	 }
	
	$gettermname = $createTerm->AvoidTermDuplicate();

	 if( isset($gettermname)&& $gettermname>0) {
			
	  header("location:../Admin/view_term_edit.php?err=3");
		} 
	 else {
	 $insetid = $createTerm->Save();
  if($insetid == true){
	
	header("location:../Admin/view_term_edit.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_term_edit.php?err=10");
  }
  exit;
	 }
  }
  
  case "createcurrentterm":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	$createTerm->current_id = $_POST['current_id'];
	 if (isset($_POST['term'])){
		$createTerm->current_term = $_POST['term'];
	 }
	  if (isset($_POST['sessions'])){
		$createTerm->current_session = $_POST['sessions'];
	 }
	//ccheck if class arm already exist
	

   $insetid = $createTerm->createCurrentTermAndSession();
  if($insetid == true){

	
	header("location:../Admin/setup_academic_term.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/setup_academic_term.php?err=10");
 exit;
  
 
		  }
		
	    }
}
?>