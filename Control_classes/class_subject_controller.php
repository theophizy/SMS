<?php  
include_once ('../classes/class.subject_class.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$bindClassToSubject = new Subject_class();
	$database = new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "bindclasstosubjects":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
	
if(empty($_POST['student_class']) || count($_POST["cls"]) < 1){
	 header("location:../Admin/bind_subjects_to_class.php?err=13");
}else{
	for($i=0; $i<count($_POST["cls"]); $i++){	
$cls = $_POST["cls"][$i];
$uniquecode = $cls.$_POST['student_class'];
$class_sub_status = "ACTIVE";
	//ccheck if the selected subject has been dinded to the class
$check = $database->Query("SELECT `class_sub_code` FROM ".$bindClassToSubject->table ." WHERE `class_sub_code`='$uniquecode'");
	 if($check>0) {
		  header("location:../Admin/bind_subjects_to_class.php?err=12");
		}else{
$insetid = $database->InsertOrUpdate("INSERT INTO ".$bindClassToSubject->table."(`class_sub_code`,`class_sub_class_code`,`class_sub_subject_code`,`class_sub_status`) VALUES('$uniquecode','{$_POST["student_class"]}','$cls','ACTIVE')");
		}}
  if($insetid == true){

	header("location:../Admin/bind_subjects_to_class.php?emsg=8");
		exit;
  }else{
	 	 header("location:../Admin/bind_subjects_to_class.php?err=12");
 exit;
  }
 
	 
}
	   
	}
		
		
	break;
	case "unbind_subject":
	$bindClassToSubject->class_sub_code = $_GET['bind_code'];
	$delete_class_subject = $bindClassToSubject->deleteClassSubject();
	 if($delete_class_subject == true){
	  
		 	header("location:../Admin/view_binded_subjects_class.php?emsg=3&class={$_GET['bind_code']}");
			exit;
  }else{
	 header("location:../Admin/view_binded_subjects_class.php?err=10&class={$_GET['bind_code']}");
  }
  exit;
  
}
?>