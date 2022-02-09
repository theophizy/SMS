<?php  

include_once ('../classes/class.Users.php');
include_once ('../classes/class.students.php');
//include_once ('../classes/class.Feeitem.php');
//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
//$feeitem = new FeeItem();
$studentAction = new Students();
	$database = new Database();
	$userAction = new Users();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action = $_GET['action'];
switch($action){

	case "createstudent":
 if(isset($_POST["post"])){
	 	if (isset($_POST['student_class'])){
		$student_class = $studentAction->student_class = $database->Escape($_POST['student_class']);
		}
		if (isset($_POST['classarm'])){
		$student_class_arm = $studentAction->student_classarm = $database->Escape($_POST['classarm']);
		}
		
		$filename=$_FILES["file"]["tmp_name"];		
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
			
		  	$file = fopen($filename, "r");
			 fgetcsv($file, 10000, ",");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				 if(empty( $getData[0]) || empty( $getData[1]) || empty($_POST['year']) ){
				// || empty( $getData[4]) || empty( $getData[5]) || empty( $getData[6]) || empty( $getData[7]) || empty( $getData[8]) || empty( $getData[10]) || empty( $getData[12]) || $student_class == "0" 
header("location:../Admin/import_students.php?err=18");
/* }elseif(!filter_var($getData[13], FILTER_VALIDATE_EMAIL)){
	
header("location:../Admin/import_students.php?err=7");*/

}else{
	$yearAdmitted = $_POST['year'];
	$regno = $studentAction->generateMatrixNumber($yearAdmitted);
	$studentAction->student_regno = $regno;

		
		$studentAction->first_name = $getData[0];
	

		$studentAction->middle_name = $getData[1];
		
	
		$studentAction->last_name = $getData[2];
		
		
		$studentAction->sex = $getData[3];
		
		$num= $getData[4];
$date =substr($num,0,2);
$month =substr($num,3,2);
$year =substr($num,6,4);

	$studentAction->date_birth =$date."/".$month."/".$year;
		
			
		$studentAction->nationality = $getData[5];
		
	
		$studentAction->state_origin = $getData[6];
		
		
		$studentAction->lga = $getData[7];
		

	
		$studentAction->blood_group = $getData[8];
		
		
		
		$studentAction->guardian_name = $getData[9];
		
		$studentAction->guardian_address = $getData[10];
		
		$studentAction->guardian_phone = $getData[11];
		
		$studentAction->guardian_email =$getData[12];
		


	$studentAction->student_status = "ACTIVE";
	//ccheck if student with such admmission number  exist
	

   $result = $studentAction->Save_csv();
	          
				if($result === true)
				{
					$userAction->username = $getData['0'];
					//encrypt password
					$userAction->password = password_hash($getData['2'], PASSWORD_DEFAULT);
					$userAction->login_name = $getData[2];
					$userAction->role = "Student";
					$userAction->Save();
					header("location:../Admin/import_students.php?emsg=1&student_class=$student_class&student_class_arm=$student_class_arm");	
					
				}
				elseif($result == false) {
					  header("location:../Admin/import_students.php?err=19");
				}
	         }
			 }
	         fclose($file);	
		 }
	}	
		exit;	
	
	case "delete_student":
	$studentAction->student_regno = $_POST['student_regno'];
	$delete_student = $studentAction->deleteStudent();
	 if($delete_student == true){
	  
		 	header("location:../Admin/view_student.php?emsg=2");
		
  }else{
	  header("location:../Admin/view_student.php?err=3");
  }
  exit;
   case "promote_student":
    if (isset($_POST['promote'])){
  	if (isset($_POST["checkbox"])){
		//$checkbox = $_POST['checkbox'];
		$id = implode( ",",$_POST["checkbox"] ) ;
	
		}
	if (isset($_POST['new_class'])){
		$student_class = $_POST['new_class'];
		}
		if (isset($_POST['new_class_arm'])){
		$student_classarm = $_POST['new_class_arm'];
		}
		//$id = "('" . implode( "','", $checkbox ) . "');" ;
		if(empty($id)){
				  header("location:../Admin/promote_student.php?err=28");
				  exit;
		}else{

  $upd = $database->InsertOrUpdate("UPDATE sms_students SET `student_class`='$student_class',`student_classarm`='$student_classarm' WHERE student_regno IN (".$id.")");

 
	
	 if($upd == true){
	  
		 	header("location:../Admin/promote_student.php?emsg=10&cool=$student_class&vaa=$student_classarm&dell=$id");
	exit;	
  }else{
 header("location:../Admin/promote_student.php?err=10&cool=$student_class&vaa=$student_classarm&dell=$id");
	    exit;
  }}
  }
 break;
 
  case "graduate_student":
    if (isset($_POST['graduants'])){
		if($_POST['sessions']== 0){
			 header("location:../Admin/graduate_student.php?err=30");
		}else{
		
		if (isset($_POST['sessions'])){
		$sessions = $_POST['sessions'];
		}
  	if (isset($_POST["checkbox"])){
		//$checkbox = $_POST['checkbox'];
		
		$id = implode( ",",$_POST["checkbox"] ) ;
	
	}
		//$id = "('" . implode( "','", $checkbox ) . "');" ;
		if(empty($id)){
				  header("location:../Admin/graduate_student.php?err=28");
				  exit;
		}else{
			 $upd = $database->InsertOrUpdate("UPDATE sms_students SET `student_status`='Alumni',`session_admitted`='$sessions' WHERE student_regno IN (".$id.")");

			}
	
	 if($upd == true){
		 $feeitem->movePaymentHistoryofAlumni();
	  $studentAction->viewStudentbyIDForGraduation();
		 	header("location:../Admin/graduate_student.php?emsg=11&cool=$student_class&vaa=$student_classarm&dell=$id");
	exit;	
  }else{
 header("location:../Admin/graduate_student.php?err=10&cool=$student_class&vaa=$student_classarm&dell=$id");
	    exit;
  }}}
 break;
	case "transfer_student":
    
  	if (isset($_GET["regno"])){
		//$checkbox = $_POST['checkbox'];
		$studentAction->student_regno = $_GET["regno"] ;
	
		}
	
		$studentAction->viewStudentbyID();

  $upd = $database->InsertOrUpdate("INSERT INTO sms_students_alumni
(`student_regno`,`first_name`,
`middle_name`,`last_name`,`sex`,`date_birth`,`nationality`,`state_origin`,`lga`, `student_class`,`student_classarm`,`student_class_admitted`,`student_house`,`blood_group`,`term_admitted`,`session_admitted`,`guardian_name`,
`guardian_address`,`guardian_phone`,`guardian_email`,`image`,`student_status`) 
VALUES('{$_GET['regno']}',
'$studentAction->first_name','$studentAction->middle_name','$studentAction->last_name','$studentAction->sex','$studentAction->date_birth','$studentAction->nationality','$studentAction->state_origin',
'$studentAction->lga','$studentAction->student_class','$studentAction->student_classarm',
'$studentAction->student_class_admitted','$studentAction->student_house','$studentAction->blood_group',
'$studentAction->term_admitted','$studentAction->session_admitted','$studentAction->guardian_name',
'$studentAction->guardian_address','$studentAction->guardian_phone','$studentAction->guardian_email',
'$studentAction->image',
'Transfer')");

 
	
	 if($upd == true){
	 
	  $database->InsertOrUpdate("UPDATE users SET user_status='INACTIVE' WHERE username='$studentAction->student_regno'");
	  $feeitem->moveDebtorsHistoryofTransferStudent( $_GET["regno"]);
	  $feeitem->movePaymentHistoryofTransferStudent( $_GET["regno"]);
	   $studentAction->deleteStudent();
		 	header("location:../Admin/view_student.php?emsg=13&cool=$student_class&vaa=$student_classarm&dell=$id");
	;	
  }else{
 header("location:../Admin/view_student.php?err=10&cool=$student_class&vaa=$student_classarm&dell=$id");
	  
  }
 
 break;
  case "Edit_student":
  
  if (isset($_POST['update'])){
	 //set values to the variables
	if (isset($_POST['student_regno'])){
		$studentAction->student_regno = $_POST['student_regno'];
		$userAction->username = $_POST['student_regno'];
		}
		if (isset($_POST['first_name'])){
		$studentAction->first_name = $_POST['first_name'];
		}
	if (isset($_POST['middle_name'])){
		$studentAction->middle_name = $_POST['middle_name'];
		}
		if (isset($_POST['last_name'])){
		$studentAction->last_name = $_POST['last_name'];
		$userAction->login_name = $_POST['last_name'];
		}
		if (isset($_POST['sex'])){
		$studentAction->sex = $_POST['sex'];
		}
		
		$studentAction->date_birth = $_POST['dob'];
		if (isset($_POST['nationality'])){
		$studentAction->nationality = $_POST['nationality'];
		}
	if (isset($_POST['state_origin'])){
		$studentAction->state_origin = $_POST['state_origin'];
		}
		if (isset($_POST['lga'])){
		$studentAction->lga = $_POST['lga'];
		}
		if (isset($_POST['class'])){
		$studentAction->student_class = $_POST['class'];
		}
		if (isset($_POST['class_arm'])){
		$studentAction->student_classarm = $_POST['class_arm'];
		}
		if (isset($_POST['class_admitted'])){
		$studentAction->student_class_admitted = $_POST['class_admitted'];
		}
		if (isset($_POST['student_house'])){
		$studentAction->student_house = $_POST['student_house'];
		}
	if (isset($_POST['blood_group'])){
		$studentAction->blood_group = $_POST['blood_group'];
		}
		if (isset($_POST['term_admitted'])){
		$studentAction->term_admitted = $_POST['term_admitted'];
		}
		if (isset($_POST['session_admitted'])){
		$studentAction->session_admitted = $_POST['session_admitted'];
		}
if (isset($_POST['guardian_name'])){
		$studentAction->guardian_name = $_POST['guardian_name'];
		}
		if (isset($_POST['guardian_address'])){
		$studentAction->guardian_address = $_POST['guardian_address'];
		}
		if (isset($_POST['guardian_phone'])){
		$studentAction->guardian_phone = $_POST['guardian_phone'];
		}
		if (isset($_POST['guardian_email'])){
		$studentAction->guardian_email = $_POST['guardian_email'];
		}
//$image = basename($_FILES['file']['name']);
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {	
		
		
        $uploadedFile = $_FILES['file']['tmp_name']; 
        $sourceProperties = getimagesize($uploadedFile);
       // $newFileName = time();
        //$dirPath = "uploads/";
       $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
			$dirPath  = "../imageupload/";
			
			$newFileName  = $_POST['student_regno'].date('Y-m-d');
			
			 $imageType = $sourceProperties[2];


        switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageSrc = imagecreatefrompng($uploadedFile); 
                $tmp =  $studentAction->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                $insert_image = imagepng($tmp,$dirPath. $newFileName."_student.".$ext);
				 $uppath = $dirPath.$newFileName."_student.".$ext;
                break;           

            case IMAGETYPE_JPEG:
                $imageSrc = imagecreatefromjpeg($uploadedFile); 
                $tmp = $studentAction->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                 $insert_image = imagejpeg($tmp,$dirPath. $newFileName."_student.".$ext);
				  $uppath = $dirPath.$newFileName."_student.".$ext;
                break;
            
            case IMAGETYPE_GIF:
                $imageSrc = imagecreatefromgif($uploadedFile); 
                $tmp = $studentAction->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                 $insert_image = imagegif($tmp,$dirPath. $newFileName."_student.".$ext);
				 $uppath = $dirPath.$newFileName."_student.".$ext;
                break;

            default:
               header("location:../Admin/update_student_record.php?err=1&regno=$studentAction->student_regno");
                exit;
                break;
        }

$studentAction->viewStudentbyID();
$filepathimage = $studentAction->image;
$studentAction->removeImageFromServer($filepathimage);     //move_uploaded_file($uploadedFile, $dirPath. $newFileName.".". $ext);
move_uploaded_file($insert_image);

			//move_uploaded_file($uploadedFile,$updir.$image);
			
			//$image_insert = $uppath;
			//}
		
		}
	$studentAction->image = $uppath;
		

	$studentAction->student_status = "ACTIVE";
	 $insetid = $studentAction->Save();
  if(isset($insetid)){
	$userAction->updateLogin_name();
	header("location:../Admin/update_student_record.php?emsg=2&regno=$studentAction->student_regno");
		exit;	
  }else{
		 header("location:../Admin/update_student_record.php?err=10&regno=$studentAction->student_regno");
  }
  exit;
	 }
}

?>