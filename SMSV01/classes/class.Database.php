<?php
include_once('DbConfig.php');
 class Database extends DbConfig{


	private $_host = 'localhost';
	private $_username = 'root';
	private $_password = '';
	private $_database = 'sms_v001';
	public 	$message;
	protected $connection;
	
	public function __construct()
	{
		if (!isset($this->connection)) {
			$this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
			
			if (!$this->connection) {
				echo 'Cannot connect to database server';
				exit;
			}
		}	
		
		return $this->connection;
	}
	public  function Reader($query)
	{
		$cursor = $this->connection->query($query);
		return $cursor;
	}

	public  function Read($cursor)
	{
		$result = $this->connection->query($cursor);
		return $result->fetch_assoc();
	}

	public  function NonQuery($query, $connection)
	{
		mysqli_query($query, $connection);
		$result = mysqli_affected_rows($connection);
		if ($result == -1)
		{
			return false;
		}
		return $result;

	}
	public function truncate($text){
	return substr($text,0,50);	
	}

	public  function Query($query)
	{
		$result = $this->connection->query($query) ;
		return $result->num_rows;
	}

	public  function InsertOrUpdate($query)
	{
		$result = $this->connection->query($query) ;
		
		if ($result == false) {
			echo 'Error: cannot execute the command';
			return false;
		} else {
			return true;
		}		
	
		//return intval(mysql_insert_id($connection));
	}
	function GenCode($lenght){
	
  $id = "";
  // define possible characters
  $possible = "0123456789";    
  // set up a counter
  $i = 0;    
  // add random characters to $generated number until the required length is reached
  while ($i < $lenght) { 
    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);   
    // we don't want this character if it's already in the generated number
    if (!strstr($id, $char)) { 
      $id .= $char;
	  //echo $char."  ";
      $i++;
    }
  }
  return $id.date('s');
}
	public function Escape($text){
	return $this->connection->real_escape_string($text);	
	}
	public function Resultset($cursor){
	$result = $this->connection->query($cursor);
		
		/*if ($this->Read($cursor) == false) {
			return false;
		} */
		
		$rows = array();
		while ($row = $result->fetch_assoc()) {
		//while ($row = $this->Read($cursor)) {
			$rows[] = $row;
		}
		
		return $rows;
		}
}
?>
