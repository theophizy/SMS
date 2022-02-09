<?php
include_once('class.Feeitem.php');
class Bank extends FeeItem{
	// set parameters
	public $bank_id;
	public $bank_code;
		public $bank_name;
	public $bank_status="ACTIVE";
	public $table="sfms_bank";
	public $query;
	//bank_id	bank_code	bank_name	bank_status

	function availableBanks($bank_id = '', $bank_code='', $bank_name='',$bank_status='ACTIVE'){
		$this->bank_id = $bank_id;
		$this->bank_code = $bank_code;
		$this->bank_name = $bank_name;
		$this->bank_status = $bank_status;
		}
		
		
		//Method populating select drop down list for term 
		
public function bankSelectField(){
			$this->query="SELECT * FROM ".$this->table." WHERE `bank_status`='ACTIVE'";
		
		
	$output='<select class="form-control" onselect="this.className" name="pay_bank_code">
                                  <option value="">Select Bank </option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="'.  $value['bank_id'].'">'.  $value['bank_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
			
	
		//Aviod sql duplicate entry error for term	
function AvoidBankDuplicate(){
		$this->query = "SELECT `bank_name` FROM ".$this->table." WHERE `bank_name` = '".$this->bank_name."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update term eg first term
function Save(){
	//check if the term_code exist and if it does update it else create a new term
	$this->query="SELECT `bank_id` FROM ".$this->table." WHERE `bank_id`='".$this->bank_id."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows > 0){
		
		$this->query="UPDATE ".$this->table." SET `bank_code`='".$this->Escape($this->bank_code)."', `bank_name`='".$this->Escape($this->bank_name)."' WHERE `bank_id`='".$this->bank_id."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->table."(`bank_code`,`bank_name`,`bank_status`) VALUES('".$this->Escape($this->bank_code)."','".$this->Escape($this->bank_name)."','".$this->Escape($this->bank_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deleteBank(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `bank_id`='".$this->Escape($this->bank_id)."'";
		return $this->Reader($this->query);
		
	}
			
			 function viewAllBanks(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
function viewBankByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`bank_id`=
		'".$this->Escape($this->bank_id)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
				$this->bank_id = $value['bank_id'];
				$this->bank_code = $value['bank_code'];
		       $this->bank_name = $value['bank_name'];
				$this->bank_status = $value['bank_status'];
	
	}
	return $this;
	}	
	
	function viewBankByBankcode(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`bank_code`=
		'".$this->Escape($this->bank_code)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
				$this->bank_id = $value['bank_id'];
				$this->bank_code = $value['bank_code'];
		       $this->bank_name = $value['bank_name'];
				$this->bank_status = $value['bank_status'];
	
	
	}
	return $this;
	}		 
function deactivateBank(){
	$this->query="UPDATE ".$this->table." SET `bank_status`='INACTIVE' WHERE `bank_id`='".$this->bank_id."'";	
	
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	
}
function activateBank(){
	$this->query="UPDATE ".$this->table." SET `bank_status`='ACTIVE' WHERE `bank_id`='".$this->bank_id."'";	
	
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	
}
}



?>