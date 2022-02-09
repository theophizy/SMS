<?php
ob_start();
include_once('class.Database.php');
class Session_class extends Database{
	// set parameters
	public $session_code;
	public $session_description;
	public $session_status="ACTIVE";
	public $table="sms_session";
	public $query;
	
	function session_available($session_code='', $session_description='',$session_status='ACTIVE'){
		$this->session_code=$session_code;
		$this->session_description=$session_description;
		$this->session_status=$session_status;
		}
		
		
		//Method populating select drop down list for session 
		
public function sessionSelectField(){
			$this->query="SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="session_admitted">
                                  <option value=""> Session student was admitted</option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="'.  $value['session_code'].'">'.  $value['session_description'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
			
	
		//Aviod sql duplicate entry error 
function AvoidSessionDuplicate(){
		$this->query = "SELECT `session_description` FROM ".$this->table." WHERE `session_description` = '".$this->session_description."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update 
function Save(){
	//check if the session exist and if it does update it else create a new session
	$this->query="SELECT `session_code` FROM ".$this->table." WHERE `session_code`='".$this->session_code."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		
		$this->query="UPDATE ".$this->table." SET `session_description`='".$this->Escape($this->session_description)."' WHERE `session_code`='".$this->session_code."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->table."(`session_description`,`session_status`) VALUES('".$this->Escape($this->session_description)."','".$this->Escape($this->session_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	//Delete a particular session
	function deleteSession(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `session_code`='".$this->Escape($this->session_code)."'";
		return $this->Reader($this->query);
		
	}
			
			// list all available sessions
			 function viewAllSession(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		 function viewSessionByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`session_code`=
		'".$this->Escape($this->session_code)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->session_code=$value['session_code'];
	$this->session_description=$value['session_description'];
	
	
	}
	return $this;
	}	

}



?>