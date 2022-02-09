<?php  
include_once ('../classes/class.bank.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$createBank = new Bank();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "createbank":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		if (isset($_POST['bank_code'])){
		$createBank->bank_code = $_POST['bank_code'];
		
	}
	
	if (isset($_POST['bank_name'])){
		$createBank->bank_name = $_POST['bank_name'];
	
	}
	
	$createBank->bank_status = "ACTIVE";
	//ccheck if term already exist bank_code	bank_name	bank_status
	$getbankcode = $createBank->AvoidBankDuplicate();

	 if( isset($getbankcode)&& $getbankcode>0) {
			
	  header("location:../Admin/create_bank.php?err=3");
		} 
	 else {

   $insetid = $createBank->Save();
  if($insetid == true){

	
	header("location:../Admin/create_bank.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/create_bank.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createbankfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['bank_code'])){
		$createBank->bank_code = $_POST['bank_code'];
		
	}
	
	if (isset($_POST['bank_name'])){
		$createBank->bank_name = $_POST['bank_name'];
	
	}
	
	$createBank->bank_status = "ACTIVE";
	//ccheck if class already exist
	$getbankcode = $createBank->AvoidBankDuplicate();

	 if( isset($getbankcode)&& $getbankcode>0) {
	
	  header("location:../Admin/view_bank.php?err=3");
		} 
	 else {
		  $insetid = $createBank->Save();
  		  if($insetid == true){

	header("location:../Admin/view_bank.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/view_term.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_bank":
	$createBank->bank_id = $_GET['bank_id'];
	$delete_bank = $createBank->deleteBank();
	 if($delete_bank == true){
	  
		 	 header("location:../Admin/view_bank.php?emsg=3");
			exit;
  }else{
	  header("location:../Admin/view_bank.php?err=10");
  }
 break;
 
 case "deactivatebank_bank":
	$createBank->bank_id = $_GET['bank_id'];
	$deactivate_bank = $createBank->deactivateBank();
	 if($deactivate_bank == true){
	  
		 	 header("location:../Admin/view_bank.php?emsg=8");
			exit;
  }else{
	  header("location:../Admin/view_bank.php?err=10");
  }
  exit;
  break;
  case "activatebank_bank":
	$createBank->bank_id = $_GET['bank_id'];
	$activate_bank = $createBank->activateBank();
	 if($activate_bank == true){
	  
		 	 header("location:../Admin/view_bank.php?emsg=9");
			exit;
  }else{
	  header("location:../Admin/view_bank.php?err=10");
  }
  exit;
  case "Edit_bank":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	 if (isset($_POST['bank_id'])){
		$createBank->bank_id = $_POST['bank_id'];
		
	}
	if (isset($_POST['bank_code'])){
		$createBank->bank_code = $_POST['bank_code'];
		
	}
	
	if (isset($_POST['bank_name'])){
		$createBank->bank_name = $_POST['bank_name'];
	
	}
	 $insetid = $createBank->Save();
  if($insetid == true){
	
	header("location:../Admin/view_bank.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/view_bank.php?err=10");
  }
  exit;
	 
  }
}
?>