<?php  
include_once ('../classes/class.Studenthouses.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createHouse = new StudentHouse();
	$database = new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];

//switch forms action
switch($action){

	case "createhouse":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['house_name'])){
		$createHouse->house_name = $_POST['house_name'];
		$createHouse->house_code = $database->GenCode(3);
	}
	
	$createHouse->house_status = "ACTIVE";
	//ccheck if class already exist
	$getHouse = $createHouse->AvoidHouseDuplicate();

	 if( isset($getHouse) && $getHouse > 0) {
			
	  header("location:../Admin/create_house.php?err=3");
		} 
	 else {
//invoke save function
   $insetid = $createHouse->Save();
  if($insetid == true){

	
	header("location:../Admin/create_house.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_house.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_house":
	$createHouse->house_code = $_GET['id'];
	$delete_house = $createHouse->deleteHouse();
	 if($delete_house == true){
	  
		 	header("location:../Admin/create_house.php?emsg=1");
			exit;
  }else{
	 header("location:../Admin/create_house.php?err=10");
  }
  exit;
  case "Edit_class":
  
  if (isset($_POST['post']) ){
	 //set values to the variables
	 
		$createHouse->house_code = $_GET['id'];
	
		$createHouse->house_name = $_POST['house_name'];
				$createHouse->house_status = "ACTIVE";
	
	 $insetid = $createHouse->Save();
  if($insetid == true){
	
		header("location:../Admin/create_house.php?emsg=1");
			exit;
  }else{
		header("location:../Admin/create_house.php?err=10"); 
  }
  exit;
	 }
}
?>