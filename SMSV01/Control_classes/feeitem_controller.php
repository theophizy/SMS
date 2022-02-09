<?php  
include_once ('../classes/class.Feeitem.php');
//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$students = new Students();
$feeItem = new FeeItem();
	$database=new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/
session_start();
$action=$_GET['action'];


switch($action){

	case "createfeeitem":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		$feeItem->fee_item_id = $database->GenCode(3);
	if (isset($_POST['fee_cat'])){
		$feeItem->fee_item_description = $_POST['fee_cat'];
		
	}
	if (isset($_POST['student_class'])){
		$feeItem->fee_item_classid = $_POST['student_class'];
		$students->student_class =  $_POST['student_class'];
	}

	if (isset($_POST['student_classarm'])){
		$feeItem->fee_item_classarm = $_POST['student_classarm'];
		$students->student_classarm = $_POST['student_classarm'];
	}
		if (isset($_POST['amount'])){
		$feeItem->fee_item_amount = $_POST['amount'];
		
	}if (isset($_POST['session_admitted'])){
		$feeItem->fee_item_session = $_POST['session_admitted'];
		
	}if (isset($_POST['term_admitted'])){
		$feeItem->fee_item_term = $_POST['term_admitted'];
		
	}
	$feeItem->fee_item_status = "ACTIVE";
	//ccheck if class already exist
	$getfeeitem = $feeItem->AvoidfeeitemDuplicate();

	 if( isset($getfeeitem) && $getfeeitem > 0) {
			
	  header("location:../Admin/Create_fee_item.php?err=3");
		} 
	 else {

   $insetid = $feeItem->Save();
  if($insetid == true){
		
		
		foreach( $students->viewStudentbyClassandClassarm() as $stud => $val){
			//get each student's regno in the selected class and class arm
			$feeItem->fee_regno = $val['student_regno'];
			//generate fee id
			$feeItem->fee_id = $feeItem->fee_regno.$feeItem->fee_item_id.$feeItem->fee_item_classid.$feeItem->fee_item_classarm.$feeItem->fee_item_term.$feeItem->fee_item_session;
			//asign fee to all the students in the selected class and class arm
			$query = "INSERT INTO sfms_asign_fee(`fee_id`,`fee_regno`,`fee_item`,`fee_cat`,`fee_class`,`fee_classarm`,`fee_term`,`fee_session`) VALUES('".$feeItem->fee_id."','".$feeItem->fee_regno."','".$feeItem->fee_item_id."','".$feeItem->fee_item_description."','".$feeItem->fee_item_classid."','".$feeItem->fee_item_classarm."','".$feeItem->fee_item_term."','".$feeItem->fee_item_session."')";
			$database->InsertOrUpdate($query);
		}
	header("location:../Admin/Create_fee_item.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/Create_fee_item.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		
		
	case "createfeeitemfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		$feeItem->fee_item_id = $database->GenCode(3);
	if (isset($_POST['fee_cat'])){
		$feeItem->fee_item_description = $_POST['fee_cat'];
		
	}
	if (isset($_POST['student_classarm'])){
		$feeItem->fee_item_classid = $_POST['student_classarm'];
		
	}	$students->student_classarm = $_POST['student_classarm'];
	if (isset($_POST['student_class'])){
		$feeItem->fee_item_classarm = $_POST['student_class'];
			$students->student_class =  $_POST['student_class'];
	}
	if (isset($_POST['amount'])){
		$feeItem->fee_item_amount = $_POST['amount'];
		
	}if (isset($_POST['session_admitted'])){
		$feeItem->fee_item_session = $_POST['session_admitted'];
		
	}if (isset($_POST['term_admitted'])){
		$feeItem->fee_item_term = $_POST['term_admitted'];
		
	}
	$feeItem->fee_item_status = "ACTIVE";
	//ccheck if class already exist
	$getfeeitem = $feeItem->AvoidfeeitemDuplicate();

	 if( isset($getfeeitem) && $getfeeitem > 0) {
			
	  header("location:../Admin/View_fee_item.php?err=3");
		} 
	 else {
   $insetid = $feeItem->Save();
  if($insetid == true){
	  
foreach( $students->viewStudentbyClassandClassarm() as $stud => $val){
			//get each student's regno in the selected class and class arm
			$feeItem->fee_regno = $val['student_regno'];
			//generate fee id
			$feeItem->fee_id = $feeItem->fee_regno.$feeItem->fee_item_id.$feeItem->fee_item_classid.$feeItem->fee_item_classarm.$feeItem->fee_item_term.$feeItem->fee_item_session;
			//asign fee to all the students in the selected class and class arm
			$query = "INSERT INTO sfms_asign_fee(`fee_id`,`fee_regno`,`fee_item`,`fee_cat`,`fee_class`,`fee_classarm`,`fee_term`,`fee_session`) VALUES('".$feeItem->fee_id."','".$feeItem->fee_regno."','".$feeItem->fee_item_id."','".$feeItem->fee_item_description."','".$feeItem->fee_item_classid."','".$feeItem->fee_item_classarm."','".$feeItem->fee_item_term."','".$feeItem->fee_item_session."')";
			$database->InsertOrUpdate($query);
		}
	
	header("location:../Admin/View_fee_item.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/View_fee_item.php?err=10");
 exit;
  }
 
		  }
		
	    }
break;
	case "delete_feeitem":
	$feeItem->fee_item_id = $_GET['id'];
	$delete_feeitem = $feeItem->deletefeeitem();
	 if($delete_feeitem === true){
	  
		 	 header("location:../Admin/View_fee_item.php?emsg=1");
	
	
			exit;
  }else{
	 header("location:../Admin/View_fee_item.php?err=10");
  }
  exit;
  case "Edit_feeitem":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	  if (isset($_POST['fee_id'])){
		$feeItem->fee_item_id = $_POST['fee_id'];
	 }
	if (isset($_POST['description'])){
		$feeItem->fee_item_description = $_POST['description'];
		
	}
	if (isset($_POST['amount'])){
		$feeItem->fee_item_amount = $_POST['amount'];
		
	}
	$feeItem->fee_item_status = "ACTIVE";
	//ccheck if class already exist
		

   $insetid = $feeItem->Save();
  if($insetid === true){
	
	header("location:../Admin/View_fee_item.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/View_fee_item.php?err=10");
  }

	 
  }
    exit;
	
  case "createfeecat":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['fee_name'])){
		$feeItem->fee_cat_name = $_POST['fee_name'];
		
	}
	
	$feeItem->fee_cat_status = "ACTIVE";
	//ccheck if class already exist
	$getfeecat = $feeItem->AvoidfeecatDuplicate();

	 if( isset($getfeecat) && $getfeecat > 0) {
			
	  header("location:../Admin/Create_fee_cat.php?err=3");
		} 
	 else {

   $insetid = $feeItem->creatFeeCat();
  if($insetid === true){

	
	header("location:../Admin/Create_fee_cat.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/Create_fee_cat.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		case "createfeecatfrommodal":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	if (isset($_POST['fee_name'])){
		$feeItem->fee_cat_name = $_POST['fee_name'];
		
	}
	
	$feeItem->fee_cat_status = "ACTIVE";
	//ccheck if class already exist
	$getfeecat = $feeItem->AvoidfeecatDuplicate();

	 if( isset($getfeecat) && $getfeecat > 0) {
			
	  header("location:../Admin/View_fee_cat.php?err=3");
		} 
	 else {

   $insetid = $feeItem->creatFeeCat();
  if($insetid === true){

	
	header("location:../Admin/View_fee_cat.php?emsg=1");
	
	
			exit;
  }else{
	 	 header("location:../Admin/View_fee_cat.php?err=10");
 exit;
  }
 
		  }
		
	    }
		
		 case "Edit_feecat":
  
  if (isset($_POST['update']) ){
	 //set values to the variables
	  if (isset($_POST['fee_catid'])){
		$feeItem->fee_cat_id = $_POST['fee_catid'];
	 }
	if (isset($_POST['fee_name'])){
		$feeItem->fee_cat_name = $_POST['fee_name'];
		
	}
	
	$feeItem->fee_cat_status = "ACTIVE";
	//ccheck if class already exist
		

   $insetid = $feeItem->creatFeeCat();
  if($insetid === true){
	
	header("location:../Admin/View_fee_cat.php?emsg=2");
			exit;
  }else{
		 header("location:../Admin/View_fee_cat.php?err=10");
  }

	 
  }
    exit;
	case "Pay_fee":
	if (isset($_POST['pay']) ){//pay_id	pay_feeid	pay_student	pay_feeitem	pay_feecat	pay_class	pay_classarm	pay_term	pay_session	pay_amount	cashier	pay_date

	 //set values to the variables
	 $feeItem->pay_id = $database->GenCode(5);
	 if (isset($_POST['fee_id'])){
		$feeItem->fee_id = $_POST['fee_id'];
		
	}
		
	if (isset($_POST['student_adminssion_no'])){
		$feeItem->fee_regno = $_POST['student_adminssion_no'];
		
	}
	if (isset($_POST['fee_item_id'])){
		$feeItem->fee_item_id = $_POST['fee_item_id'];
	
	}
	
	if (isset($_POST['payment_option'])){
		$feeItem->pay_payment_type = $_POST['payment_option'];
	//pay_payment_type	
	}else{
	header("location:../Admin/payment_page.php?err=25&id=$feeItem->fee_id");	
	}
	if (isset($_POST['pay_bank_code'])){
		$feeItem->pay_bank_code = $_POST['pay_bank_code'];
		}
		if (isset($_POST['teller_id'])){
		$feeItem->teller_id = $_POST['teller_id'];
		}
		
	if(!empty($feeItem->viewSingleAsignedFee())){
	$getitems = $feeItem->viewSingleAsignedFee();
	
		$feeItem->fee_item_classid = $getitems['fee_class']; 
		$feeItem->fee_item_id = $getitems['fee_item'];
		$feeItem->fee_cat = $getitems['fee_cat'];
		$feeItem->fee_item_classarm = $getitems['fee_classarm'];
		$feeItem->fee_item_term = $getitems['fee_term'];
		$feeItem->fee_item_session = $getitems['fee_session'];
	$amoutpaidbefore =  $getitems['fee_amountpaid'];
	if (isset($_POST['amounttobepaid'])){
		$amounttobepaid = $_POST['amounttobepaid'];
	 	
	}if (isset($_POST['amount'])){
		$feeItem->pay_amount = $_POST['amount'];
		$amouttobeupdatewith = $amoutpaidbefore + $_POST['amount'];
	}
	$feeItem->cashier = $_SESSION['USERNAME'];
	$feeItem->pay_date = date('d/m/Y');
	 $checkdebtor = $feeItem->checkifStudentisOwing();
  $differenceinamount = $amounttobepaid - $feeItem->pay_amount;
  if($differenceinamount < 0){
	
		header("location:../Admin/payment_page.php?err=22&id=$feeItem->fee_id");
			
  }elseif($_POST['amount'] <= 0) {
  header("location:../Admin/payment_page.php?err=23&id=$feeItem->fee_id");
  //check if the student is owing make sure he pays his debts first
 
  }elseif(isset($checkdebtor) && $checkdebtor >0) {
  header("location:../Admin/payment_page.php?err=24&id=$feeItem->fee_id");
	}elseif($differenceinamount == 0) {
			$insert = $feeItem->payFee();
			if($insert == true){
			$feeItem->deleteasignfee();
			header("location:../Admin/receipt.php?emsg=1&id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount&regno=$feeItem->fee_regno&feecat=$feeItem->fee_cat&payment_type=$feeItem->pay_payment_type&bank=$feeItem->pay_bank_code&teller_id=$feeItem->teller_id");
			}
		}elseif($differenceinamount > 0){
			
$insert = $feeItem->payFee();

			if($insert == true){
			 $feeItem->updatepayamount($amouttobeupdatewith);
			header("location:../Admin/receipt.php?emsg=1&id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount&regno=$feeItem->fee_regno&feecat=$feeItem->fee_cat&payment_type=$feeItem->pay_payment_type&bank=$feeItem->pay_bank_code&teller_id=$feeItem->teller_id");
  }
  }
	}}
	exit;
	
	case "Pay_debt":
	if (isset($_POST['pay']) ){//pay_id	pay_feeid	pay_student	pay_feeitem	pay_feecat	pay_class	pay_classarm	pay_term	pay_session	pay_amount	cashier	pay_date

	 //set values to the variables
	 $feeItem->pay_id = $database->GenCode(5);
	 if (isset($_POST['fee_id'])){
		$feeItem->fee_id = $_POST['fee_id'];
		
	}
		
	if (isset($_POST['student_adminssion_no'])){
		$feeItem->fee_regno = $_POST['student_adminssion_no'];
		
	}
	if (isset($_POST['fee_item_id'])){
		$feeItem->fee_item_id = $_POST['fee_item_id'];
		
	}
	if (isset($_POST['payment_option'])){
		$feeItem->pay_payment_type = $_POST['payment_option'];
	//pay_payment_type	
	}else{
	header("location:../Admin/pay_debts.php?err=25&id=$feeItem->fee_id");	
	}
	if (isset($_POST['pay_bank_code'])){
		$feeItem->pay_bank_code = $_POST['pay_bank_code'];
		}
		if (isset($_POST['teller_id'])){
		$feeItem->teller_id = $_POST['teller_id'];
		}
	if(!empty($feeItem->viewDebtorsbyFeeID())){
	$getitems = $feeItem->viewDebtorsbyFeeID();
	
		$feeItem->fee_item_classid = $getitems['fee_class']; 
		$feeItem->fee_item_id = $getitems['fee_item'];
		$feeItem->fee_cat = $getitems['fee_cat'];
		$feeItem->fee_item_classarm = $getitems['fee_classarm'];
		$feeItem->fee_item_term = $getitems['fee_term'];
		$feeItem->fee_item_session = $getitems['fee_session'];
	$amoutowing =  $getitems['amount'];
	if (isset($_POST['amounttobepaid'])){
		$amounttobepaid = $_POST['amounttobepaid'];
	 	
	}if (isset($_POST['amount'])){
		$feeItem->pay_amount = $_POST['amount'];
		$amoutleft = $amoutowing - $_POST['amount'];
		$amouttobeupdatewith = $feeItem->sumAmountPaidByFeeid() + $_POST['amount'];
	}
	$feeItem->cashier = $_SESSION['USERNAME'];
	$feeItem->pay_date = date('d/m/Y');
	
  $differenceinamount = $amounttobepaid - $feeItem->pay_amount;
  if($differenceinamount < 0){
	
		header("location:../Admin/pay_debts.php?err=22&id=$feeItem->fee_id");
			
  }elseif($_POST['amount'] <= 0) {
  header("location:../Admin/pay_debts.php?err=23&id=$feeItem->fee_id");
  //check if the student is owing make sure he pays his debts first
 
 	}elseif($differenceinamount == 0) {
			$insert = $feeItem->payFee();
			if($insert == true){
			$feeItem->deleteDebtorByFeeid();
			header("location:../Admin/receipt.php?emsg=1&id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount&regno=$feeItem->fee_regno&feecat=$feeItem->fee_cat&payment_type=$feeItem->pay_payment_type&bank=$feeItem->pay_bank_code&teller_id=$feeItem->teller_id");
			}
		}elseif($differenceinamount > 0){
			
$insert = $feeItem->payFee();

			if($insert == true){
			 $feeItem->updatedebtoramount($amoutleft);
			header("location:../Admin/receipt.php?emsg=1&id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount&regno=$feeItem->fee_regno&feecat=$feeItem->fee_cat&payment_type=$feeItem->pay_payment_type&bank=$feeItem->pay_bank_code&teller_id=$feeItem->teller_id");
  }
  }
	}}
	exit;
	//pay alumni debts
	
	case "Pay_alumni_debt":
	if (isset($_POST['pay']) ){//pay_id	pay_feeid	pay_student	pay_feeitem	pay_feecat	pay_class	pay_classarm	pay_term	pay_session	pay_amount	cashier	pay_date

	 //set values to the variables
	 $feeItem->pay_id = $database->GenCode(5);
	 if (isset($_POST['fee_id'])){
		$feeItem->fee_id = $_POST['fee_id'];
		
	}
		
	if (isset($_POST['student_adminssion_no'])){
		$feeItem->fee_regno = $_POST['student_adminssion_no'];
		
	}
	if (isset($_POST['fee_item_id'])){
		$feeItem->fee_item_id = $_POST['fee_item_id'];
		
	}
	if (isset($_POST['payment_option'])){
		$feeItem->pay_payment_type = $_POST['payment_option'];
	//pay_payment_type	
	}else{
	header("location:../Admin/pay_alumni_debt.php?err=25&id=$feeItem->fee_id");	
	}
	if (isset($_POST['pay_bank_code'])){
		$feeItem->pay_bank_code = $_POST['pay_bank_code'];
		}
		if (isset($_POST['teller_id'])){
		$feeItem->teller_id = $_POST['teller_id'];
		}
	if(!empty($feeItem->viewAlumniDebtorsbyFeeID())){
	$getitems = $feeItem->viewAlumniDebtorsbyFeeID();
	
		$feeItem->fee_item_classid = $getitems['fee_class']; 
		$feeItem->fee_item_id = $getitems['fee_item'];
		$feeItem->fee_cat = $getitems['fee_cat'];
		$feeItem->fee_item_classarm = $getitems['fee_classarm'];
		$feeItem->fee_item_term = $getitems['fee_term'];
		$feeItem->fee_item_session = $getitems['fee_session'];
	$amoutowing =  $getitems['amount'];
	if (isset($_POST['amounttobepaid'])){
		$amounttobepaid = $_POST['amounttobepaid'];
	 	
	}if (isset($_POST['amount'])){
		$feeItem->pay_amount = $_POST['amount'];
		$amoutleft = $amoutowing - $_POST['amount'];
		$amouttobeupdatewith = $feeItem->sumAmountPaidByFeeidofAlumni() + $_POST['amount'];
	}
	$feeItem->cashier = $_SESSION['USERNAME'];
	$feeItem->pay_date = date('d/m/Y');
	
  $differenceinamount = $amounttobepaid - $feeItem->pay_amount;
  if($differenceinamount < 0){
	
		header("location:../Admin/pay_alumni_debt.php?err=22&id=$feeItem->fee_id");
			
  }elseif($_POST['amount'] <= 0) {
  header("location:../Admin/pay_alumni_debt.php?err=23&id=$feeItem->fee_id");
  //check if the student is owing make sure he pays his debts first
 
 	}elseif($differenceinamount == 0) {
			$insert = $feeItem->payAlumniFee();
			if($insert == true){
			$feeItem->deleteAlumniDebtorByFeeid();
			header("location:../Admin/receipt.php?emsg=1&id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount&regno=$feeItem->fee_regno&feecat=$feeItem->fee_cat&payment_type=$feeItem->pay_payment_type&bank=$feeItem->pay_bank_code&teller_id=$feeItem->teller_id");
			}
		}elseif($differenceinamount > 0){
			
$insert = $feeItem->payAlumniFee();

			if($insert == true){
			 $feeItem->updateAlumniDebtoramount($amoutleft);
			header("location:../Admin/receipt.php?emsg=1&id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount&regno=$feeItem->fee_regno&feecat=$feeItem->fee_cat&payment_type=$feeItem->pay_payment_type&bank=$feeItem->pay_bank_code&teller_id=$feeItem->teller_id");
  }
  }
	}}
	exit;
	//close terms account
	 case "close_account":
  
  if(isset($_POST['search'])){
		    $feeItem->fee_item_classid = $_POST['class'];
				    $feeItem->fee_item_classarm = $_POST['classarm'];
					  $feeItem->fee_item_term = $_POST['term'];
			  $feeItem->fee_item_session = $_POST['sessions'];
	foreach( $feeItem->viewAsignedfeebyTermSessionClass() as $stud => $val){
			//get each student's regno in the selected class and class arm
			$feeItem->fee_id = $val['fee_id'];
$feeItem->fee_item_id = $val['fee_item'];
//find item by its id and get the amount for that item
$feeItem->viewfeeitemByID();
// subtract the amount paid by the student from the item amount to get what the studen is owing   
	$amount_owing = $feeItem->fee_item_amount - $val['fee_amountpaid'];		
			$query = "INSERT INTO sfms_debtors(`fee_id`,`fee_regno`,`fee_item`,`fee_cat`,`fee_class`,`fee_classarm`,`fee_term`,`fee_session`,`amount`) VALUES('{$val['fee_id']}','{$val['fee_regno']}','{$val['fee_item']}','{$val['fee_cat']}','{$val['fee_class']}','{$val['fee_classarm']}','{$val['fee_term']}','{$val['fee_session']}','$amount_owing')";
			$database->InsertOrUpdate($query);
			$feeItem->deleteasignfee();
		}

  
	
	header("location:../Admin/close_account.php?emsg=21");
			exit;
  }else{
		 header("location:../Admin/close_account.php?err=10");
  }

	 
 
    exit;	
 
}
?>