<?php
include('class.staff.php');
class Users extends Staff{
	// set user attributes
	public $username;
	public $password;
	public $role;
	public $login_name;
	public $login_status;
	public $user_status = "ACTIVE";
	public $table="users";
	public $query;
	
	// user constructor
	function user($username='',$password='', $role='',$login_name='',$login_status='', $user_status = 'ACTIVE'){
		$this->username = $username;
		$this->password = $password;
		$this->role = $role;
		$this->login_name = $login_name;
		$this->login_status = $login_status;
		$this->user_status = $user_status;
		}
		
		
		//check for already existing username to avoid sql duplicate error
	function AvoidGradeDuplicate(){
		
		$this->query = "SELECT * FROM ".$this->table." WHERE `username` = '".$this->username."'";
		return $this->Query($this->query); 
	}
	
	
	//function for both create  user
	
function Save(){
	$this->query="INSERT INTO ".$this->table."(`username`,`password`,`role`,`login_name`,`user_status`) VALUES('".$this->Escape($this->username)."','".$this->Escape($this->password)."','".$this->Escape($this->role)."','".$this->Escape($this->login_name)."','".$this->Escape($this->user_status)."')";	
	
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
//delete user	
function deleteUser(){
		
				$this->query = "DELETE FROM ".$this->table." WHERE `grade_code`='".$this->Escape($this->username)."'";
		return $this->Reader($this->query);
		
	}
	
	// view availablle users
function viewAllUsers(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
	// get user's	attributes 
function viewUserByUsername(){

		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`username`=
		'".$this->Escape($this->username)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->username = $value['username'];
	$this->password = $value['password'];
	$this->role = $value['role'];
	$this->login_name = $value['login_name'];
	$this->login_status = $value['login_status'];
	
	}
	return $this;
	}
		 
function viewUser(){

		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`username`=
		'".$this->Escape($this->username)."' AND `user_status`='ACTIVE'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->username = $value['username'];
	$this->password = $value['password'];
	$this->role = $value['role'];
	$this->login_name = $value['login_name'];
	$this->login_status = $value['login_status'];
	
	}
	return $this;
	}		 

//Login user  
function loginUser(){

		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`username`=
		'".$this->Escape($this->username)."' AND `password`= '".$this->Escape($this->password)."' AND `user_status='ACTIVE'";
	if(!empty($this->Query($this->query))){
		$result = $this->Read($this->query);
		$this->username = $result['username'];
		$this->role = $result['role'];
		$this->login_name = $result['login_name'];
		$this->InsertOrUpdate("UPDATE ".$this->table." SET `login_status`='1' WHERE `username`='".$this->Escape($this->username)."'");
		}
	
	
	return $this;
	}		 
//check if user name exist
function checkUser(){
	
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`username`=
		'".$this->Escape($this->username)."' AND `password`= '".$this->Escape($this->password)."' AND `user_status='ACTIVE'";
	
	return $this->Query($this->query);
	}		 
// update login name if the user  changes his or her surname
public function updateLogin_name(){
	
	$this->query="UPDATE ".
		$this->table."
		 SET `login_name`='".$this->Escape($this->login_name)."' WHERE
		   `username`='".$this->username."'";
		   $this->InsertOrUpdate($this->query);
	}
//Logout a user and destroy his session
function LogoutUser(){
		unset($_SESSION);
session_destroy();
session_write_close();

	$this->query="UPDATE ".
		$this->table."
		 SET `login_status`='0' WHERE
		   `username`='".$this->username."'";
		   $this->InsertOrUpdate($this->query);
		}
	//reset users password	
function resetUserPassword(){
	$this->query="UPDATE ".
		$this->table."
		 SET `password`='".$this->Escape($this->password)."' WHERE
		   `username`='".$this->username."'";
		   $this->InsertOrUpdate($this->query);
		}
		// Asign role to staff
function asignRole(){
	$date = date('Y-m-d');
	$this->query="UPDATE ".
		$this->table."
		 SET `role`='".$this->Escape($this->role)."' WHERE
		   `username`='".$this->username."'";
		  $result = $this->InsertOrUpdate($this->query);
		  if($result == true && $this->role == "Principal"){
			 $this->query="INSERT INTO sms_principal(`principal_staffid`,`date_from`) VALUES('".$this->Escape($this->username)."','$date')";	
	
	$this->InsertOrUpdate($this->query); 
		  }
		  return $result; 
		}
		
		//check if username exist
function checkUsername(){
	
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`username`=
		'".$this->Escape($this->username)."'";
	return $this->Query($this->query);
	}
	// methof to re-activate a user
function reactivateUser(){
	
	$this->query="UPDATE ".$this->table." SET `user_status`='ACTIVE' WHERE `username`='".$this->username."'";	
	
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	
}
// deactivate a user so he/she won't  be allowed to access the system					
function deactivateUser(){

	$this->query="UPDATE ".$this->table." SET `user_status`='INACTIVE' WHERE `username`='".$this->username."'";	
	
		$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	
}						 

		
}



?>