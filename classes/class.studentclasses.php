<?php
include('class.Database.php');
class StudentClasses extends Database{
	public $class_code;
	public $class_name;
	public $class_status="ACTIVE";
	public $table="sms_class";
	public $query;
	
	function studentsClass($class_code='', $class_name='',$class_status='ACTIVE'){
		$this->class_code=$class_code;
		$this->class_name=$class_name;
		$this->class_status=$class_status;
		}
		
		
		//Method populating select drop down list eg JSS1
		
public function classSelectField(){
			$this->query="SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="student_class"  onChange="getarm(this.value)" required>
                                  <option value="0"> student current class</option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="'.$value['class_code'].'">'.  $value['class_name'].'</option>';
								   
								   }
                                
                                $output.='</select>';	
		 
		 return $output;
		 	
			}
			
			
	
		//Aviod sql duplicate entry error for classes	
function AvoidClassDuplicate(){
		$this->query = "SELECT `class_name` FROM ".$this->table." WHERE `class_name` = '".$this->class_name."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update claasses eg JSS1,SS1 etc
function Save(){
	//check if the class_code exist and if it does update it else create a new clas
	$this->query="SELECT `class_code` FROM ".$this->table." WHERE `class_code`='".$this->class_code."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		//if an image is not selected
		
			//when an image is selected
		$this->query="UPDATE ".$this->table." SET `class_name`='".$this->Escape($this->class_name)."' WHERE `class_code`='".$this->class_code."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->table."(`class_name`,`class_status`) VALUES('".$this->Escape($this->class_name)."','".$this->Escape($this->class_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deleteClass(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `class_code`='".$this->Escape($this->class_code)."'";
		return $this->Reader($this->query);
		
	}
			
			 function viewAllClasses(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		
		 
 function viewclassByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`class_code`=
		'".$this->Escape($this->class_code)."'";
	//invoke method to return the array of the fetched result from the database class
		
		foreach($this->Resultset($this->query) as $key => $value){
		$this->class_code=$value['class_code'];
	$this->class_name=$value['class_name'];
	
	
	}
	return $this;
	}	
		 }



?>