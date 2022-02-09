<?php
include('class.studentclasses.php');
class ClassArm extends StudentClasses{
	// set parameters
	public $class_arm_code;
	public $class_arm_name;
	public $class_arm_status="ACTIVE";
	public $table="sms_classarm";
	public $query;
	
	function class_arms($class_arm_code, $class_arm_name='',$class_arm_status='ACTIVE'){
		$this->class_arm_code=$class_arm_code;
		$this->class_arm_name=$class_arm_name;
		$this->class_arm_status=$class_arm_status;
		}
		
		
		//Method populating select drop down list for class arms 
		
		public function classarmSelectFieldSfms(){
			$this->query="SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="student_classarm" id="armid">
                                  <option value="0">Student current class arm</option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="' .$value['class_arm_code'].'">'.  $value['class_arm_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
		
public function classarmSelectField(){
			$this->query="SELECT * FROM ".$this->table."";
		
		
	$output='<select class="form-control" onselect="this.className" name="student_classarm" id="armid">
                                  <option value="0">Student current class arm</option> ';
                                   
								   foreach($this->Resultset($this->query) as $key=> $value){
								   
								   $output.='<option value="' .$value['class_arm_code'].'">'.  $value['class_arm_name'].'</option>';
								   }
                                
                                $output.='</select>';	
		 
		 return $output;	
			}
			
			
	
		//Aviod sql duplicate entry error for class arms	
function AvoidclassarmDuplicate(){
		$this->query = "SELECT `class_arm_name` FROM ".$this->table." WHERE `class_arm_name` = '".$this->class_arm_name."'";
		return $this->Query($this->query); 
	}
	
	//function for both create and update 
function Save(){
	//check if the class arm exist and if it does update it else create a new class
	$this->query="SELECT `class_arm_code` FROM ".$this->table." WHERE `class_arm_code`='".$this->class_arm_code."' LIMIT 1";
	$number_rows=$this->Query($this->query);
	if($number_rows>0){
		
		$this->query="UPDATE ".$this->table." SET `class_arm_name`='".$this->Escape($this->class_arm_name)."' WHERE `class_arm_code`='".$this->class_arm_code."'";	
		
		
	}else{
	$this->query="INSERT INTO ".$this->table."(`class_arm_name`,`class_arm_status`) VALUES('".$this->Escape($this->class_arm_name)."','".$this->Escape($this->class_arm_status)."')";	
	}
	$insertid=$this->InsertOrUpdate($this->query);
	return $insertid;
	}
	
	function deleteClassarm(){
		 
				$this->query = "DELETE FROM ".$this->table." WHERE `class_arm_code`='".$this->Escape($this->class_arm_code)."'";
		return $this->Reader($this->query);
		
	}
			//List all available class arms
			 function viewAllClassarm(){
		
		$this->query = "SELECT * FROM ".$this->table."";
								 						 
		 return  $this->Resultset($this->query);
								   
		 
		 }
		 
		function viewClassArmByID(){
		$this->query = "SELECT * FROM ".
		$this->table." WHERE 
		`class_arm_code`=
		'".$this->Escape($this->class_arm_code)."'";
	//invoke method to return the array of the fetched result from the database class
foreach($this->Resultset($this->query) as $key => $value){
		$this->class_arm_code=$value['class_arm_code'];
	$this->class_arm_name=$value['class_arm_name'];
	
	
	}
	return $this;
	}
}



?>