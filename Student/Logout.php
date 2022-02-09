<?php 
session_start();
ob_start();
include_once ('../classes/class.Users.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$user = new Users();
	//$db = new Database();
	if(!isset($_SESSION['USERNAME'])){
	echo "<script>
location='../'
</script>";
}
$user->username = $_SESSION['USERNAME'];

	$user->LogoutUser();
echo "<script>
location='../'
</script>";

?>