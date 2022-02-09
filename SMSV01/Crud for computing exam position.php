<?php
include_once 'DbConfig.php';

class Crud extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getData($query)
	{		
		$result = $this->connection->query($query);
		
		if ($result == false) {
			return false;
		} 
		
		$rows = array();
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
	public function getsingleDate($query){
		$result=$this->connection->query($query);
if ($result == false) {
			echo 'Error: cannot execute the command';
			return false;
		} 
		return $result->fetch_array();
	}
		
	public function execute($query) 
	{
		$result = $this->connection->query($query);
		
		if ($result == false) {
			return false;
		} else {
			return true;
		}		
	}
	
	public function delete($id,$primary_key, $table) 
	{ 
		$query = "DELETE FROM $table WHERE $primary_key = $id";
		
		$result = $this->connection->query($query);
	
		if ($result == false) {
			echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
			return false;
		} else {
			return true;
		}
	}
	
	public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}
	public function Random(){
		$number=rand(9999,0000);
	 $time_seconds=date('s');
	 $id=$number.$time_seconds;
	 return $id;
		
	}
	public function truncate($value){
		$substring=substr($value,0,5);
		return $substring;
		
	}
	public function num_rows($query){
		
		$result=$this->connection->query($query);
		
		if($result->num_rows<1){
		return true;
		}else{
		return false;
	}
	}
	public function Findbyprimarykey($id,$table,$primary_key){
		$query="select * from $table where $primary_key='$id'";
		
		return $this->num_rows($query);	
		
		
	
}
function computeposition(){
$printedposition=0;
$currentaverage=0;
$position=0;
$next;	
$msg="";
$msg='<table border="1"> <tr><td>Position</td></tr>';
foreach($this->getData("select * from theo order by ranges desc")as $values){
	$average=$values['ranges'];
if($average==$currentaverage){
	$position=$printedposition;
	$next +=1;
	//echo $next;
}else{
	
	$position=$next+1;
	$next++;
}
$currentaverage=$average;
$printedposition=$position;
if($printedposition<20){
switch ($printedposition){
	case 1:
	$print='<sup>st</sup>';
	break;
	case 2:
	$print='<sup>nd</sup>';
	break;
	case 3:
	$print='<sup>rd</sup>';
	break;
	default:
	$print='<sup>th</sup>';
}
}elseif($printedposition<=100){
$reduce=substr($position,1);
switch ($reduce){
	case 1:
	$print='<sup>st</sup>';
	break;
	case 2:
	$print='<sup>nd</sup>';
	break;
	case 3:
	$print='<sup>rd</sup>';
	break;
	default:
	$print='<sup>th</sup>';
}
}elseif($printedposition<1000){
$reduce=substr($position,2);
switch ($reduce){
	case 1:
	$print='<sup>st</sup>';
	break;
	case 2:
	$print='<sup>nd</sup>';
	break;
	case 3:
	$print='<sup>rd</sup>';
	break;
	default:
	$print='<sup>th</sup>';
}	
}

	
$msg.='<tr style="border:1px;">';

$msg.='<td>'. $printedposition.$print.'</td></tr><br></table>';
}
return $msg;
}
}
?>
