<?php  

//include_once ('../classes/class.Database.php');
include_once ('../classes/class.Users.php');
//include_once ('../classes/class.staff.php');
//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
	$userAction = new Users();
//include_once ('../Admin/links.php');
$staffClass = new Staff();
	
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/


		//when submit button is clicked
	 //set values to the variables
		$action=$_GET['action'];
switch($action){

	
	 //set values to the variables
	case "Edit_staff":	
	if (isset($_POST['update'])){
	 //set values to the variables
	$staffClass->staff_id = $_POST['staff_id'];
	$userAction->username = $_POST['staff_id'];
		
		$staffClass->staff_first_name = $_POST['first_name'];
	

		$staffClass->staff_middle_name = $_POST['middle_name'];
		
	
		$staffClass->staff_last_name = $_POST['last_name'];
		$userAction->login_name = $_POST['last_name'];
		
		
		$staffClass->staff_sex = $_POST['sex'];
		
		$staffClass->staff_date_birth = $_POST['date_birth'];
	
		
		$staffClass->staff_nationality = $_POST['nationality'];
		
	
		$staffClass->staff_state_origin = $_POST['state_origin'];
		
		
		$staffClass->staff_lga = $_POST['lga'];
		
		
		$staffClass->staff_marital = $_POST['marital'];
		
		
		$staffClass->staff_blood_group = $_POST['blood_group'];
		
		
		$staffClass->staff_qualification = $_POST['qualification'];
		
		
		$staffClass->staff_institution_attended = $_POST['staff_institution'];
		
	
		$staffClass->staff_course_study = $_POST['staff_course'];
		
		$staffClass->staff_year_graduated = $_POST['year_graduated'];
		
			
		$staffClass->staff_year_of_appointment = $_POST['apointment_year'];
		
		$staffClass->staff_address = $_POST['staff_address'];
		
		$staffClass->staff_email = $_POST['staff_email'];
		
		$staffClass->staff_phone = $_POST['staff_phone'];
		
		$staffClass->nextofkin_name = $_POST['nextofkin_name'];
		
		$staffClass->nextofkin_address = $_POST['nextofkin_address'];
		
		$staffClass->nextofkin_email = $_POST['nextofkin_email'];
		$staffClass->nextofkin_phone = $_POST['nextofkin_phone'];
		
	
	//$image = basename($_FILES['file']['name']);
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {	
		
        $uploadedFile = $_FILES['file']['tmp_name'];
		// get image properties like hieght, width  
        $sourceProperties = getimagesize($uploadedFile);
       
        // get image extension like jpeg,png
       $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	// directory where the image should be uploaded to 
			$dirPath  = "../imageupload/";
			
			// rename the image
			$newFileName  = $_POST['staff_id'].date('Y-m-d');
			// get image format
			 $imageType = $sourceProperties[2];


        switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageSrc = imagecreatefrompng($uploadedFile); 
				// resize image
                $tmp =  $staffClass->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                $insert_image = imagepng($tmp,$dirPath. $newFileName."_staff.".$ext);
				 $uppath = $dirPath.$newFileName."_staff.".$ext;
                break;           

            case IMAGETYPE_JPEG:
                $imageSrc = imagecreatefromjpeg($uploadedFile); 
                $tmp = $staffClass->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                 $insert_image = imagejpeg($tmp,$dirPath. $newFileName."_staff.".$ext);
				  $uppath = $dirPath.$newFileName."_staff.".$ext;
                break;
            
            case IMAGETYPE_GIF:
                $imageSrc = imagecreatefromgif($uploadedFile); 
                $tmp = $staffClass->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                 $insert_image = imagegif($tmp,$dirPath. $newFileName."_staff.".$ext);
				 $uppath = $dirPath.$newFileName."_staff.".$ext;
                break;

            default:
               header("location:../Admin/update_staff_record.php?err=1&staff_id=$staffClass->staff_id");
               
                break;
        }

$staffClass->viewStaffbyID();
$filepathimage = $staffClass->image;
$staffClass->removeImageFromServer($filepathimage);     //move_uploaded_file($uploadedFile, $dirPath. $newFileName.".". $ext);
move_uploaded_file($insert_image);
        //move_uploaded_file($uploadedFile, $dirPath. $newFileName.".". $ext);
		// update the image to the server
move_uploaded_file($insert_image);
	
		}
		// attach image to the image variable to be sent to the database 
	$staffClass->image = $uppath;
	
	
	$staffClass->staff_status = "ACTIVE";
	 $insetid = $staffClass->Save();
  if(isset($insetid)){
	$userAction->updateLogin_name();
	header("location:../Admin/update_staff_record.php?emsg=2&staff_id=$staffClass->staff_id");
			
  }else{
		 header("location:../Admin/update_staff_record.php?err=10&staff_id=$staffClass->staff_id");
  }
 
	 }
	break;
	 case "Reactivate_staff":
	$staffClass->staff_id = $_GET['staffid'];
	$userAction->username = $_GET['staffid'];
	$activate_staff= $staffClass->reactivateStaff();
	 if($activate_staff == true){
	  $userAction->reactivateUser();
		 	 header("location:../Admin/manage_staff.php?emsg=24");
			exit;
  }else{
	  header("location:../Admin/manage_staff.php?err=10");
  }
  exit;  
  break;
  case "Deactivate_staff":
	$staffClass->staff_id = $_GET['staffid'];
	$userAction->username = $_GET['staffid'];
	$deactivate_staff = $staffClass->deactivateStaff();
	 if($deactivate_staff == true){
	  $userAction->deactivateUser();
		 	 header("location:../Admin/manage_staff.php?emsg=23");
			exit;
  }else{
	  header("location:../Admin/manage_staff.php?err=10");
  }
  exit; 
	
}
	
?>