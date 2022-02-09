<?php  
include_once ('../classes/class.Grades.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createGrade=new Grade();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action = $_GET['action'];


switch($action){

	case "creategrade":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
			

	if (isset($_POST['grade_min_mark'])){
		$createGrade->grade_min_mark = $_POST['grade_min_mark'];
		}
		if (isset($_POST['grade_max_mark'])){
		$createGrade->grade_max_mark = $_POST['grade_max_mark'];
		}
		if (isset($_POST['grade_name'])){
		$createGrade->grade_name = $_POST['grade_name'];
		}
		if (isset($_POST['grade_remark'])){
		$createGrade->grade_remark = $_POST['grade_remark'];
		}
		
		$createGrade->grade_status = "ACTIVE";
		

	
	//check if grade name and remark exist
	$getgrade = $createGrade->AvoidGradeDuplicate();

	 if( isset($getgrade) && $getgrade > 0) {
			
	  header("location:../Admin/create_grade.php?err=3");
		} 
	 else {

   $insetid = $createGrade->Save();;
  if($insetid == true){

	
	header("location:../Admin/create_grade.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_grade.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "creategradefrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
	if (isset($_POST['grade_min_mark'])){
		$createGrade->grade_min_mark = $_POST['grade_min_mark'];
		}
		if (isset($_POST['grade_max_mark'])){
		$createGrade->grade_max_mark = $_POST['grade_max_mark'];
		}
		if (isset($_POST['grade_name'])){
		$createGrade->grade_name = $_POST['grade_name'];
		}
		if (isset($_POST['grade_remark'])){
		$createGrade->grade_remark = $_POST['grade_remark'];
		}
		
		$createGrade->grade_status = "ACTIVE";
		

	
	//check if grade name and remark exist
	$getgrade = $createGrade->AvoidGradeDuplicate();

	 if( isset($getgrade) && $getgrade > 0) {
				
	  header("location:../Admin/view_allGrades.php?err=3");
		} 
	 else {

   $insetid = $createGrade->Save();
  if($insetid == true){

	
	header("location:../Admin/view_allGrades.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_allGrades.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
//delete subject
	case "delete_subject":
	$createGrade->grade_code = $_GET['id'];
	$delete_grade = $createGrade->deleteGrade();
	 if($delete_class == true){
	  
		 	header("location:../Admin/view_allGrades.php?emsg=3");
			exit;
  }else{
	header("location:../Admin/view_allGrades.php?err=10");
  }
  exit;
  //if edit subject is clicked
  case "Edit_grade":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['grade_code'])){
		$createGrade->grade_code = $_POST['grade_code'];
	 }
	if (isset($_POST['grade_min_mark'])){
		$createGrade->grade_min_mark = $_POST['grade_min_mark'];
		}
		if (isset($_POST['grade_max_mark'])){
		$createGrade->grade_max_mark = $_POST['grade_max_mark'];
		}
		if (isset($_POST['grade_name'])){
		$createGrade->grade_name = $_POST['grade_name'];
		}
		if (isset($_POST['grade_remark'])){
		$createGrade->grade_remark = $_POST['grade_remark'];
		}
		
	

   $insetid = $createGrade->Save();
  if($insetid == true){

	
	header("location:../Admin/view_allGrades.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_allGrades.php?err=10");
 exit;
  }
 
}
 break;
 
 case "Edit_exam_type":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['exam_code'])){
		$createGrade->exam_code = $_POST['exam_code'];
	 }
	if (isset($_POST['exam_name'])){
		$createGrade->exam_name = $_POST['exam_name'];
		}
		if (isset($_POST['exam_marks'])){
		$createGrade->exam_marks = $_POST['exam_marks'];
		}
		
		
	

   $insetid = $createGrade->SaveExamType();
  if($insetid == true){

	
	header("location:../Admin/view_assessmentweight.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_assessmentweight.php?err=10");
 exit;
  }
 
		  }
}
?>