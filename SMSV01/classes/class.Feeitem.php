<?php
include('class.students.php');
class FeeItem extends Students{
	// set parameters
	public $fee_item_id;
	public $fee_item_description;
	public $fee_item_amount;
	public $fee_item_session;
	public $fee_item_term;
	public $fee_id;
	public $pay_id;
	public $fee_cat;
	public $fee_regno;
	public $fee_item_classid;
	public $fee_item_classarm;
	public $fee_item_status = "ACTIVE";
	public $table = "sfms_feeitem";
	public $fee_cat_table = "sfms_feecat";
	public $asign_fee_table = "sfms_asign_fee";
	public $debtors_table = "sfms_debtors";
	public $debtor_alumni_table ="sfms_debtors_alumni";
	public $pay_fee_table = "payment_table";
	public $pay_fee_alumni_table = "payment_table_alumni";
	public $fee_cat_id;
	public $fee_cat_name;
	public $pay_amount;
	public $pay_date;
	public $cashier;
	public $pay_bank_code;
	public $pay_payment_type;
	public $teller_id;
	public $fee_cat_status = "ACTIVE";
	public $query;
	
	function feeitems($fee_item_id = '' , $fee_item_description = '' ,$fee_item_amount = '', $fee_item_session = '', $fee_item_term = '', $fee_item_classid = '',$fee_item_classarm = '', $fee_item_status = 'ACTIVE', $fee_cat_id = '', $fee_cat_name = '' , $fee_cat_status = "ACTIVE", $fee_id = '', $fee_regno = '',$fee_cat ='',$pay_amount = '',$pay_date = '', $cashier = '', $pay_bank_code = '', $pay_payment_type = '', $teller_id = '', $pay_id = ''){
		$this->fee_item_id = $fee_item_id;
		$this->fee_item_description = $fee_item_description;
		$this->fee_item_amount = $fee_item_amount;
		$this->fee_item_session = $fee_item_session;
		$this->fee_item_term = $fee_item_term;
		$this->fee_item_classid = $fee_item_classid;
		$this->fee_item_classarm = $fee_item_classarm;
		$this->fee_item_status = $fee_item_status; 
		$this->fee_cat_id = $fee_cat_id;
		$this->fee_cat_name = $fee_cat_name;
		$this->fee_cat_status = $fee_cat_status;
		$this->fee_id = $fee_item_id;
		$this->fee_regno = $fee_regno;
		$this->fee_cat = $fee_item_description;
		$this->pay_amount = $pay_amount;
		$this->pay_date = $pay_date;
		$this->cashier = $cashier;
		$this->pay_bank_code = $pay_bank_code;
		$this->pay_payment_type = $pay_payment_type;
		$this->teller_id = $teller_id;
		$this->pay_id = $pay_id;
		}
		
		
		//Method populating select drop down list for fee items 
		
public function feeitemSelectField(){
			$this->query="SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="fee_item" id="fee_item">
                                  <option value="0">Select Fee Item </option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="' .$value['fee_item_id'].'">'.  $value['fee_item_description'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			//Method populating select drop down list for fee category 
		
public function feecatSelectField(){
	
			$this->query="SELECT * FROM ".$this->fee_cat_table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="fee_cat" id="fee_cat">
                                  <option value="0">Select Fee item </option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="' .$value['fee_cat_id'].'">'.  $value['fee_cat_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
				
			
	
		//Aviod sql duplicate entry error for fee item 	
function AvoidfeeitemDuplicate(){
		$this->query = "SELECT `fee_item_description` FROM ".$this->table." WHERE `fee_item_description` = '".$this->fee_item_description."' AND `fee_item_session`= '".$this->fee_item_session."' AND `fee_item_term`= '".$this->fee_item_term."' AND `fee_item_classid`= '".$this->fee_item_classid."'AND `fee_item_classarm`= '".$this->fee_item_classarm."'";
		return $this->Query($this->query); 
	}
	
	
		//Aviod sql duplicate entry error for fee cat 	
function AvoidfeecatDuplicate(){
		$this->query = "SELECT `fee_cat_id` FROM ".$this->fee_cat_table." WHERE `fee_cat_id` = '".$this->fee_cat_id."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update 
function Save(){
	//check if the class arm exist and if it does update it else create a new class
	$this->query="SELECT `fee_item_id` FROM ".$this->table." WHERE `fee_item_id`='".$this->fee_item_id."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		
		$this->query="UPDATE ".$this->table." SET `fee_item_amount` ='".$this->Escape($this->fee_item_amount)."' WHERE `fee_item_id`='".$this->fee_item_id."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->table."(`fee_item_id`,`fee_item_description`,`fee_item_amount`,`fee_item_session`,`fee_item_term`,`fee_item_classid`,`fee_item_classarm`,`fee_item_status`) VALUES('".$this->Escape($this->fee_item_id)."','".$this->Escape($this->fee_item_description)."','".$this->Escape($this->fee_item_amount)."','".$this->Escape($this->fee_item_session)."','".$this->Escape($this->fee_item_term)."','".$this->Escape($this->fee_item_classid)."','".$this->Escape($this->fee_item_classarm)."','".$this->Escape($this->fee_item_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	
	return $insertid;
	}
	
	function payFee(){

	$this->query="INSERT INTO ".$this->pay_fee_table."(`pay_id`,`pay_feeid`,`pay_student`,`pay_feeitem`,`pay_feecat`,`pay_class`,`pay_classarm`,	`pay_term`,`pay_session`,`pay_amount`,`cashier`,`pay_date`,`pay_payment_type`,`pay_bank_code`,`teller_id`) VALUES('".$this->Escape($this->pay_id)."','".$this->Escape($this->fee_id)."','".$this->Escape($this->fee_regno)."','".$this->Escape($this->fee_item_id)."','".$this->Escape($this->fee_cat)."','".$this->Escape($this->fee_item_classid)."','".$this->Escape($this->fee_item_classarm)."','".$this->Escape($this->fee_item_term)."','".$this->Escape($this->fee_item_session)."','".$this->Escape($this->pay_amount)."','".$this->Escape($this->cashier)."','".$this->Escape($this->pay_date)."','".$this->Escape($this->pay_payment_type)."','".$this->Escape($this->pay_bank_code)."','".$this->Escape($this->teller_id)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);
	
	return $insertid;	
		
	}
	//pay alumni debt
	function payAlumniFee(){

	$this->query="INSERT INTO ".$this->pay_fee_alumni_table."(`pay_id`,`pay_feeid`,`pay_student`,`pay_feeitem`,`pay_feecat`,`pay_class`,`pay_classarm`,	`pay_term`,`pay_session`,`pay_amount`,`cashier`,`pay_date`,`pay_payment_type`,`pay_bank_code`,`teller_id`) VALUES('".$this->Escape($this->pay_id)."','".$this->Escape($this->fee_id)."','".$this->Escape($this->fee_regno)."','".$this->Escape($this->fee_item_id)."','".$this->Escape($this->fee_cat)."','".$this->Escape($this->fee_item_classid)."','".$this->Escape($this->fee_item_classarm)."','".$this->Escape($this->fee_item_term)."','".$this->Escape($this->fee_item_session)."','".$this->Escape($this->pay_amount)."','".$this->Escape($this->cashier)."','".$this->Escape($this->pay_date)."','".$this->Escape($this->pay_payment_type)."','".$this->Escape($this->pay_bank_code)."','".$this->Escape($this->teller_id)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);
	
	return $insertid;	
		
	}


		//function for both create and update 
		
function movePaymentHistoryofAlumni(){
			foreach($this->viewStudentbyIDofStatusAlumni() as $key => $val){
				$regno = $val['student_regno'];
				//$this->query = "SELECT * FROM ".$this->pay_fee_table." WHERE pay_student='$regno'"; 
				/*foreach($this->Resultset($this->query) as $key => $vals){
					
$query ="INSERT INTO ".$this->pay_fee_alumni_table."(pay_id,pay_feeid,pay_student,pay_feeitem,pay_feecat,	pay_class,pay_classarm,pay_term,pay_session,pay_amount,cashier,	pay_date,pay_payment_type,pay_bank_code,teller_id) VALUES('{$vals['pay_id']}','{$vals['pay_feeid']}','{$vals['pay_student']}','{$vals['pay_feeitem']}','{$vals['pay_feecat']}','{$vals['pay_class']}','{$vals['pay_classarm']}','{$vals['pay_term']}','{$vals['pay_session']}','{$vals['pay_amount']}','{$vals['cashier']}','{$vals['pay_date']}','{$vals['pay_payment_type']}','{$vals['pay_bank_code']}','{$vals['teller_id']}')";	*/
$query ="INSERT INTO ".$this->pay_fee_alumni_table."(pay_id,pay_feeid,pay_student,pay_feeitem,pay_feecat,	pay_class,pay_classarm,pay_term,pay_session,pay_amount,cashier,	pay_date,pay_payment_type,pay_bank_code,teller_id) SELECT pay_id,pay_feeid,pay_student,pay_feeitem,pay_feecat,	pay_class,pay_classarm,pay_term,pay_session,pay_amount,cashier,	pay_date,pay_payment_type,pay_bank_code,teller_id FROM ".$this->pay_fee_table." WHERE pay_student='$regno'"; 
	$insert = $this->InsertOrUpdate($query);
	if($insert == true){
					
			$qe = "DELETE FROM ".$this->pay_fee_table." WHERE pay_student='$regno'";
		$delete = $this->Reader($qe);
					}
			}
			return $delete;
			}
			//move the transfer student payment history to alumni payment table
function movePaymentHistoryofTransferStudent($regno){
			
$query ="INSERT INTO ".$this->pay_fee_alumni_table."(pay_id,pay_feeid,pay_student,pay_feeitem,pay_feecat,	pay_class,pay_classarm,pay_term,pay_session,pay_amount,cashier,	pay_date,pay_payment_type,pay_bank_code,teller_id) SELECT pay_id,pay_feeid,pay_student,pay_feeitem,pay_feecat,	pay_class,pay_classarm,pay_term,pay_session,pay_amount,cashier,	pay_date,pay_payment_type,pay_bank_code,teller_id FROM ".$this->pay_fee_table." WHERE pay_student='$regno'"; 
	$insert = $this->InsertOrUpdate($query);
	if($insert == true){
					
			$qe = "DELETE FROM ".$this->pay_fee_table." WHERE pay_student='$regno'";
		$delete = $this->Reader($qe);
					}
			
			return $delete;
			}
			
			
			function moveDebtorsHistoryofAlumni(){
			foreach($this->viewStudentbyIDofStatusAlumni() as $key => $val){
				$regno = $val['student_regno'];
				$this->query = "INSERT INTO ".$this->debtor_alumni_table."(fee_id,fee_regno,fee_item,fee_cat,fee_class,fee_classarm,fee_term,fee_session,amount) SELECT fee_id,fee_regno,fee_item,fee_cat,fee_class,fee_classarm,fee_term,fee_session,amount FROM ".$this->debtors_table." WHERE fee_regno='$regno'";
				/*$this->quer y = "SELECT * FROM ".$this->debtors_table." WHERE fee_regno='$regno'"; 
				foreach($this->Resultset($this->query) as $key => $vals){
					
					$this->query = "INSERT INTO ".$this->debtor_alumni_table."(`fee_id`,`fee_regno`,`fee_item`,`fee_cat`,`fee_class`,`fee_classarm`,`fee_term`,`fee_session`,`amount`) VALUES('{$vals['fee_id']}','{$vals['fee_regno']}','{$vals['fee_item']}','{$vals['fee_cat']}','{$vals['fee_class']}','{$vals['fee_classarm']}','{$vals['fee_term']}','{$vals['fee_session']}','{$vals['amount']}')";	
	
	 $this->InsertOrUpdate($this->query);
				$this->fee_id = $vals['fee_id'];	
				$this->deleteDebtorByFeeid();
					}*/
			$insert = $this->InsertOrUpdate($this->query);
			if($insert === true){
			$qe = "DELETE FROM ".$this->debtors_table." WHERE fee_regno='$regno'";
		$delete = $this->Reader($qe);		
			}
			}
			return $delete;
			}
			//move the transfer student debts  to alumni payment table
			function moveDebtorsHistoryofTransferStudent($regno){
			
				$this->query = "INSERT INTO ".$this->debtor_alumni_table."(fee_id,fee_regno,fee_item,fee_cat,fee_class,fee_classarm,fee_term,fee_session,amount) SELECT fee_id,fee_regno,fee_item,fee_cat,fee_class,fee_classarm,fee_term,fee_session,amount FROM ".$this->debtors_table." WHERE fee_regno='$regno'";	
	
	$insert = $this->InsertOrUpdate($this->query);
			if($insert === true){
			$qe = "DELETE FROM ".$this->debtors_table." WHERE fee_regno='$regno'";
		$delete = $this->Reader($qe);		
			}
			}
			
function creatFeeCat(){
	//check if the class arm exist and if it does update it else create a new class
	$this->query="SELECT `fee_cat_id` FROM ".$this->fee_cat_table." WHERE `fee_cat_id`='".$this->fee_cat_id."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		
		$this->query="UPDATE ".$this->fee_cat_table." SET `fee_cat_name`='".$this->Escape($this->fee_cat_name)."' WHERE `fee_cat_id`='".$this->fee_cat_id."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->fee_cat_table."(`fee_cat_name`,`fee_cat_status`) VALUES('".$this->Escape($this->fee_cat_name)."','".$this->Escape($this->fee_cat_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	//update amount in the asign fee table 
	function updatepayamount($amounttobeupdatewith){
	
	
		
		$this->query="UPDATE ".$this->asign_fee_table." SET `fee_amountpaid`='$amounttobeupdatewith' WHERE `fee_id`='".$this->fee_id."'";	
		
		
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
		//update amount in the asign debtors table 
	function updatedebtoramount($amounttobeupdatewith){
	
	
		$this->query="UPDATE ".$this->debtors_table." SET `amount`='$amounttobeupdatewith' WHERE `fee_id`='".$this->fee_id."'";	
		
		
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	//update amount in the alumni debts table
function updateAlumniDebtoramount($amounttobeupdatewith){
	
	
		$this->query="UPDATE ".$this->debtor_alumni_table." SET `amount`='$amounttobeupdatewith' WHERE `fee_id`='".$this->fee_id."'";	
		
		
		$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deletefeeitem(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `fee_item_id`='".$this->Escape($this->fee_item_id)."'";
		return $this->Reader($this->query);
		
	}
	
	function deleteasignfee(){
		 
				$this->query = "DELETE FROM ".$this->asign_fee_table." WHERE `fee_id`='".$this->Escape($this->fee_id)."'";
		return $this->Reader($this->query);
		
	}
function deletepayfee($student_regno){
		 
				$this->query = "DELETE FROM ".$this->pay_fee_table." WHERE `pay_student`='$student_regno'";
		return $this->Reader($this->query);
		
	}
	//delete debtors by fee id
function deleteDebtorByFeeid(){
		 
				$this->query = "DELETE FROM ".$this->debtors_table." WHERE `fee_id`='".$this->Escape($this->fee_id)."'";
		return $this->Reader($this->query);
		
	}
	
	//delete alumni debtor by fee id
function deleteAlumniDebtorByFeeid(){
		 
				$this->query = "DELETE FROM ".$this->debtor_alumni_table." WHERE `fee_id`='".$this->Escape($this->fee_id)."'";
		return $this->Reader($this->query);
		
	}
			//List all available fee items
function viewAllFeeitems(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 //view alumni payment history
function viewAlumniPaymentHistory(){
		
		$this->query = "SELECT * FROM ".$this->pay_fee_alumni_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 //view all asigned fee by class and classarm
function viewAsignedfeebyTermSessionClassFeecat(){
		
		$this->query = "SELECT * FROM ".$this->asign_fee_table." WHERE `fee_cat` = '".$this->Escape($this->fee_cat)."' AND `fee_class` = '".$this->Escape($this->fee_item_classid)."' AND `fee_classarm` = '".$this->Escape($this->fee_item_classarm)."' AND `fee_term` = '".$this->Escape($this->fee_item_term)."' AND `fee_session` = '".$this->Escape($this->fee_item_session)."'";
								 						 
		 return  $this->Resultset($this->query);
		 }
		 
		 //check payment by term,session,class,fee category
 function viewPaymentbyTermSessionClassFeecat(){
		
		$this->query = "SELECT * FROM ".$this->pay_fee_table." WHERE `pay_feecat` = '".$this->Escape($this->fee_cat)."' AND `pay_class` = '".$this->Escape($this->fee_item_classid)."' AND `pay_classarm` = '".$this->Escape($this->fee_item_classarm)."' AND `pay_term` = '".$this->Escape($this->fee_item_term)."' AND `pay_session` = '".$this->Escape($this->fee_item_session)."'";
								 						 
		 return  $this->Resultset($this->query);
		 }

		 //check payment by term,session,class,fee category and student
 function viewPaymentbyTermSessionClassFeecatStudent($regno){
		
	$this->query = "SELECT DISTINCT(pay_student),pay_feeitem,pay_amount,pay_feecat FROM ".$this->pay_fee_table." WHERE `pay_feecat` = '".$this->Escape($this->fee_cat)."' AND `pay_class` = '".$this->Escape($this->fee_item_classid)."' AND `pay_classarm` = '".$this->Escape($this->fee_item_classarm)."' AND `pay_term` = '".$this->Escape($this->fee_item_term)."' AND `pay_session` = '".$this->Escape($this->fee_item_session)."'AND `pay_student` = '$regno'";
													  
	 return  $this->Resultset($this->query);
	 }
		 
	//view payment by student registration number	 
 function viewPaymentbyStudentRegistrationNumber(){
		
		$this->query = "SELECT * FROM ".$this->pay_fee_table." WHERE `pay_student` = '".$this->Escape($this->fee_regno)."'";
								 						 
		 return  $this->Resultset($this->query);
		 }
		 
		  //view all asigned fee by class and classarm
 function viewDebtorsbyTermSessionClassFeecat(){
		
		$this->query = "SELECT * FROM ".$this->asign_fee_table." WHERE `fee_cat` = '".$this->Escape($this->fee_cat)."' AND `fee_class` = '".$this->Escape($this->fee_item_classid)."' AND `fee_classarm` = '".$this->Escape($this->fee_item_classarm)."' AND `fee_term` = '".$this->Escape($this->fee_item_term)."' AND `fee_session` = '".$this->Escape($this->fee_item_session)."'";
								 						 
		 return  $this->Resultset($this->query);
		 }
		 //view all asigned fee by class and classarm session and term
function viewAsignedfeebyTermSessionClass(){
		
		$this->query = "SELECT * FROM ".$this->asign_fee_table." WHERE  `fee_class` = '".$this->Escape($this->fee_item_classid)."' AND `fee_classarm` = '".$this->Escape($this->fee_item_classarm)."' AND `fee_term` = '".$this->Escape($this->fee_item_term)."' AND `fee_session` = '".$this->Escape($this->fee_item_session)."'";
								 						 
		 return  $this->Resultset($this->query);
		 } 
		 
function viewStudentsthatareowingfeestest(){
		
		$this->query = "SELECT * FROM sfms_asign_fee WHERE `fee_regno` = '".$this->fee_regno."'";
								 						 
		 return  $this->Resultset($this->query);
		 }
		 //List all available fee categories
 function viewAllFeecat(){
		
		$this->query = "SELECT * FROM ".$this->fee_cat_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
function viewFeeCatID(){
		$this->query = "SELECT * FROM ".
		$this->fee_cat_table." WHERE 
		`fee_cat_id`=
		'".$this->Escape($this->fee_cat_id)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->fee_cat_id = $value['fee_cat_id'];
	$this->fee_cat_name = $value['fee_cat_name'];
	$this->fee_cat_status = $value['fee_cat_status'];
	
	
	}
	return $this;
	}
		 
function viewfeeitemyID(){
	//require_once('../classes/class.Session.php');
require_once('../classes/class.term.php');
//require_once('../classes/class.Classarm.php');
//require_once('../classes/class.studentclasses.php');
$term = new Term();
$studentclass = new StudentClasses();
$classarm = new ClassArm();
$sessions = new Session_class();
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`fee_item_id`=
		'".$this->Escape($this->fee_item_id)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->fee_item_id = $value['fee_item_id'];
		//get fee category name by its ID
	$this->fee_cat_id = $value['fee_item_description'];
	$this->viewFeeCatID();
	$this->fee_item_description = $this->fee_cat_name;
	$this->fee_item_amount = $value['fee_item_amount'];
	//get class name by its ID
	$studentclass->class_code = $value['fee_item_classid'];
	$studentclass->viewclassByID();
	$this->fee_item_classid = $studentclass->class_name;
	//get claas arm name by its ID
	$classarm->class_arm_code = $value['fee_item_classarm'];
	$classarm->viewClassArmByID();
	$this->fee_item_classarm = $classarm->class_arm_name;
	//get session description by its ID
	$sessions->session_code = $value['fee_item_session'];
	$settion_descripion = $sessions->viewSessionByID();
	$this->fee_item_session = $settion_descripion->session_description; 
	//get term description by its ID
	$term->term_code = $value['fee_item_term'];
	$term_names = $term->viewTermByID();
	$this->fee_item_term = $term_names->term_name;
	$this->fee_item_status = $value['fee_item_status'];
	
	
	}
	return $this;
	}
	function viewfeeitemByID(){

		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`fee_item_id`=
		'".$this->Escape($this->fee_item_id)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->fee_item_id = $value['fee_item_id'];
	$this->fee_item_description = $value['fee_item_description'];
	$this->fee_item_amount = $value['fee_item_amount'];
	$this->fee_item_session = $value['fee_item_session'];
	$this->fee_item_term = $value['fee_item_term'];
	$this->fee_item_classid = $value['fee_item_classid'];
	$this->fee_item_classarm = $value['fee_item_classarm'];
	}
	return $this;
	}
	
	//view each asigned fee by its ID
	function viewAsignedFeebyID(){
	//require_once('../classes/class.Session.php');
require_once('../classes/class.term.php');
//require_once('../classes/class.Classarm.php');
//require_once('../classes/class.studentclasses.php');
$term = new Term();
$studentclass = new StudentClasses();
$classarm = new ClassArm();
$sessions = new Session_class();
		$this->query = "SELECT * FROM ".
		$this->asign_fee_table." WHERE 
		`fee_id`=
		'".$this->Escape($this->fee_id)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->fee_id = $value['fee_id'];
		$this->fee_regno = $value['fee_regno'];
	
	
	}
	return $this;
	}
	
	function viewSingleAsignedFee(){
	

		$this->query = "SELECT * FROM ".
		$this->asign_fee_table." WHERE 
		`fee_id`=
		'".$this->Escape($this->fee_id)."'";
	//invoke method to return the array of the fetched result from the database class

	return $this->Read($this->query);
	}
	
	 //view all pay fee by class, class arm,session,regno and term
 function viewPayFeebyRegnoTermSessionClassandClassarm($fee_id){
//	pay_id	pay_feeid	pay_student	pay_feeitem	pay_feecat	pay_class	pay_classarm	pay_term	pay_session	pay_amount	cashier	pay_date
		
		$this->query = "SELECT SUM(pay_amount) AS amount_paid FROM ".$this->pay_fee_table." WHERE `pay_feeid` ='$fee_id'";
								 						 
		$resultset =  $this->Read($this->query);
		return $resultset['amount_paid'];
		 }
		 //check if a student is owing 
		 function checkifStudentisOwing(){
		$this->query = "SELECT `fee_regno` FROM ".$this->debtors_table." WHERE `fee_regno` = '".$this->Escape($this->fee_regno)."'";
		return $this->Query($this->query); 
	}
	//move all asigned fee for those students owing to debtors table at the end of the term   
	function deleteAsignFeeattheEndofTerm(){
		 
				$this->query = "DELETE FROM ".$this->asign_fee_table." WHERE `fee_class`='".$this->Escape($this->fee_item_classid)."' AND `fee_classarm`='".$this->Escape($this->fee_item_classarm)."' AND `fee_term`='".$this->Escape($this->fee_item_term)."' AND `fee_session`='".$this->Escape($this->fee_item_session)."'";
		return $this->Reader($this->query);
		
	}
	//view  stdents debtors 
	 function viewStdentDebts(){
		
		$this->query = "SELECT * FROM ".$this->debtors_table." WHERE `fee_regno`='".$this->Escape($this->fee_regno)."'";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		 //view all  debts
	 function viewAllDebtors(){
		
		$this->query = "SELECT * FROM ".$this->debtors_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		  function viewAllAlumniDebtors(){
		
		$this->query = "SELECT * FROM ".$this->debtor_alumni_table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		//view all debtors by student registration number 
	function viewDebtorsbyRegistrationNumber(){
		
		$this->query = "SELECT * FROM ".$this->debtors_table." WHERE `fee_regno`='".$this->Escape($this->fee_regno)."'";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		 	//view all debtors by feeid
	function viewDebtorsbyFeeID(){
		
		$this->query = "SELECT * FROM ".$this->debtors_table." WHERE `fee_id`='".$this->Escape($this->fee_id)."'";
								 						 
		 return  $this->Read($this->query);
								   
		 
		 }
		 //view all alumni debtors by feeid
		 function viewAlumniDebtorsbyFeeID(){
		
		$this->query = "SELECT * FROM ".$this->debtor_alumni_table." WHERE `fee_id`='".$this->Escape($this->fee_id)."'";
								 						 
		 return  $this->Read($this->query);
								   
		 
		 }
		 //view payment by id
		 function viewPaymentbyPayID($payid){
		
		$this->query = "SELECT * FROM ".$this->pay_fee_table." WHERE `pay_id`='$payid'";
								 						 
		 return  $this->Read($this->query);
								   
		 
		 }
		 
		  //view payment by id of an alumni
		  function viewPaymentbyPayIDofAlumni($payid){
		
		$this->query = "SELECT * FROM ".$this->pay_fee_alumni_table." WHERE `pay_id`='$payid'";
								 						 
		 return  $this->Read($this->query);
								   
		 
		 }
		 
		function sumAmountPaidByFeeid(){
		
		$this->query = "SELECT SUM(pay_amount) AS total_amount FROM ".$this->pay_fee_table." WHERE `pay_feeid`='".$this->Escape($this->fee_id)."'";
								 						 
		$result = $this->Read($this->query);
								   
		 return $result['total_amount'];
		 }
		 // check total amount paid by student for in order to grant him result view privileges

		 function sumAmountPaidByStdentandFeeitem($student,$feeitem){
		
			$this->query = "SELECT SUM(pay_amount) AS total_amount FROM ".$this->pay_fee_table." WHERE `pay_feeitem`='$feeitem' AND `pay_student`='$student'";
															  
			$result = $this->Read($this->query);
									   
			 return $result['total_amount'];
			 }
		 //sum amount paid by fee id for an alumni
		 function sumAmountPaidByFeeidofAlumni(){
		
		$this->query = "SELECT SUM(pay_amount) AS total_amount FROM ".$this->pay_fee_alumni_table." WHERE `pay_feeid`='".$this->Escape($this->fee_id)."'";
								 						 
		$result = $this->Read($this->query);
								   
		 return $result['total_amount'];
		 }
		 
		 function viewAsignedfeebyRegno(){
		
		$this->query = "SELECT * FROM ".$this->asign_fee_table." WHERE  `fee_regno` = '".$this->Escape($this->fee_regno)."'";
								 						 
		 return  $this->Resultset($this->query);
		 } 

}



?>