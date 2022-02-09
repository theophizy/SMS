<?php  
include_once ('../classes/class.Classarm.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createClassarm=new ClassArm();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createclassarm":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['class_arm_name'])){
		$createClassarm->class_arm_name = $_POST['class_arm_name'];
		
	}
	
	$createClassarm->class_arm_status = "ACTIVE";
	//ccheck if class already exist
	$getclassarm = $createClassarm->AvoidclassarmDuplicate();

	 if( isset($getclassarm)&& $getclassarm>0) {
			
	  header("location:../Admin/create_classarm.php?err=3");
		} 
	 else {

   $insetid = $createClassarm->Save();
  if($insetid==true){

	
	header("location:../Admin/create_classarm.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_classarm.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createclassarmfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['class_arm_name'])){
		$createClassarm->class_arm_name = $_POST['class_arm_name'];
		
	}
	
	$createClassarm->class_arm_status = "ACTIVE";
	//ccheck if class arm already exist
	$getclassarm = $createClassarm->AvoidclassarmDuplicate();

	 if( isset($getclassarm)&& $getclassarm>0) {
			
	  header("location:../Admin/view_classarm.php?err=3");
		} 
	 else {

   $insetid = $createClassarm->Save();
  if($insetid==true){

	
	header("location:../Admin/view_classarm.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_classarm.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_classarm":
	$createClassarm->class_arm_code = $_GET['id'];
	$delete_classarm = $createClassarm->deleteClassarm();
	 if($delete_classarm == true){
	  
		 	 header("location:?pid=2&action=View_articles&emsg=3");
			exit;
  }else{
	 header("location:?pid=2&action=View_articles&err=10");
  }
  exit;
  case "Edit_classarm":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['class_arm_code'])){
		$createClassarm->class_arm_code = $_POST['class_arm_code'];
	 }
	 if (isset($_POST['class_arm_name'])){
	$createClassarm->class_arm_name = $_POST['class_arm_name'];
	 }
	
		$createClassarm->class_arm_status = "ACTIVE";
		$getclassarm = $createClassarm->AvoidclassarmDuplicate();

	 if( isset($getclassarm)&& $getclassarm>0) {
			
	  header("location:../Admin/view_classarm.php?err=3");
		} 
	 else {
	
	 $insetid = $createClassarm->Save();
  if($insetid == true){
	
	header("location:../Admin/view_classarm.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_classarm.php?err=10");
  }
  exit;
	 }
  }
}
?>