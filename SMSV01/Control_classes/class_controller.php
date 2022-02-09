<?php  
include_once ('../classes/class.studentclasses.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createClasses=new StudentClasses();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createclass":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
	if (isset($_POST['class_name'])){
		$createClasses->class_name = $_POST['class_name'];
		
	}
	
	$createClasses->class_status = "ACTIVE";
	//ccheck if class already exist
	$getclasscode = $createClasses->AvoidClassDuplicate();

	 if( isset($getclasscode)&& $getclasscode>0) {
			
	  header("location:../Admin/create_class.php?err=3");
		} 
	 else {

   $insetid = $createClasses->Save();
  if($insetid==true){

	
	header("location:../Admin/create_class.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_class.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createclassfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables

	if (isset($_POST['class_name'])){
		$createClasses->class_name = $_POST['class_name'];
		
	}
	
	$createClasses->class_status = "ACTIVE";
	//ccheck if class already exist
	$getclasscode = $createClasses->AvoidClassDuplicate();

	 if( isset($getclasscode)&& $getclasscode>0) {
			
	  header("location:../Admin/view_allclasses.php?err=3");
		} 
	 else {

   $insetid = $createClasses->Save();
  if($insetid==true){

	
	header("location:../Admin/view_allclasses.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_allclasses.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_class":
	$createClasses->class_code = $_GET['id'];
	$delete_class = $createClasses->deleteClass();
	 if($delete_class == true){
	  
		 	 header("location:?pid=2&action=View_articles&emsg=3");
			exit;
  }else{
	 header("location:?pid=2&action=View_articles&err=10");
  }
  exit;
  case "Edit_class":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['class_code'])){
		$createClasses->class_code = $_POST['class_code'];
	 }
	 if (isset($_POST['class_name'])){
	$createClasses->class_name = $_POST['class_name'];
	 }
	
		$createClasses->class_status = "ACTIVE";
		$getclasscode = $createClasses->AvoidClassDuplicate();

	 if( isset($getclasscode)&& $getclasscode>0) {
			
	  header("location:../Admin/view_allclasses.php?err=3");
		} 
	 else {
	
	 $insetid = $createClasses->Save();
  if($insetid == true){
	
	header("location:../Admin/view_allclasses.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_allclasses.php?err=10");
  }
  exit;
	 }
  }
}
?>