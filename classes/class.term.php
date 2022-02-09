<?php
include_once('class.Session.php');
class Term extends Session_class{
	// set parameters
	public $term_code;
	public $term_name;
	public $term_status="ACTIVE";
	public $current_id;
	public $current_term;
	public $current_session;
	public $table = "sms_term";
	public $current_term_session_table = "current_term_session";
	public $query;
	
	function term_available($term_code = '', $term_name = '',$term_status = 'ACTIVE' , $current_id = '' , $current_term = '' , $current_session = ''){
		$this->term_code = $term_code;
		$this->term_name = $term_name;
		$this->term_status = $term_status;
		$this->current_id = $current_id;
		$this->current_term = $current_term;
		$this->current_session = $current_session;
		}
		
		
		//Method populating select drop down list for term 
		
public function termSelectField(){
			$this->query = "SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="term_admitted">
                                  <option value="">Term student was admitted </option> ';
                                   
								   foreach($this->Resultset($this->query) as $key => $value){
								   
								   $output.='<option value="'.  $value['term_code'].'">'.  $value['term_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
			public function termSelectedField(){
			$this->query = "SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="term_admitted">
                                  <option value="">Term  </option> ';
                                   
								   foreach($this->Resultset($this->query) as $key => $value){
								   
								   $output.='<option value="'.  $value['term_code'].'">'.  $value['term_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
	
		//Aviod sql duplicate entry error for term	
function AvoidTermDuplicate(){
		$this->query = "SELECT `term_name` FROM ".$this->table." WHERE `term_name` = '".$this->term_name."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update term eg first term
function Save(){
	//check if the term_code exist and if it does update it else create a new term
	$this->query = "SELECT `term_code` FROM ".$this->table." WHERE `term_code`='".$this->term_code."' LIMIT 1";
	$number_rows = $this->Query($this->query);
	if($number_rows > 0){
		
		$this->query = "UPDATE ".$this->table." SET `term_name`='".$this->Escape($this->term_name)."' WHERE `term_code`='".$this->term_code."'";	
		
		
	}else{
	$this->query = "INSERT INTO ".$this->table."(`term_name`,`term_status`) VALUES('".$this->Escape($this->term_name)."','".$this->Escape($this->term_status)."')";	
	}
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
function createCurrentTermAndSession(){
	//check if the term_code exist and if it does update it else create a new term
	
		
		$this->query = "UPDATE ".$this->current_term_session_table." SET `current_term`='".$this->Escape($this->current_term)."',`current_session`='".$this->Escape($this->current_session)."' WHERE `current_id`='".$this->current_id."'";	
		
	
	$insertid = $this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deleteTerm(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `term_code`='".$this->Escape($this->term_code)."'";
		return $this->Reader($this->query);
		
	}
			
			 function viewAllTerm(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
function viewTermByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`term_code`=
		'".$this->Escape($this->term_code)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->term_code = $value['term_code'];
	$this->term_name = $value['term_name'];
	
	
	}
	return $this;
	}	
	 function viewCurrentTermAndSession(){
				
		$this->query = "SELECT * FROM ".$this->current_term_session_table."";
								 						 
	
	return $this->Resultset($this->query);
								   
		 
		 }	
		 	 
 function getCurrentTermAndSession(){
				
		$this->query = "SELECT * FROM ".$this->current_term_session_table." WHERE 
		`current_session`=
		'1'";
								 						 
	foreach($this->Resultset($this->query) as $key => $value){
		$this->current_session = $value['current_session'];
	$this->current_term = $value['current_term'];
	
	
	}
	return $this;				   
		 
		 }	
}



?>