<?php  
session_start();
include_once ('../classes/class.Users.php');
include_once ('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$user = new Users();
	$database = new Database();
	//$outputmsg=$addnew_article->outputmsg;
/**
* *********************Adding New Staff /NonStaff *******************
*/

$action=$_GET['action'];


switch($action){

	case "loginUser":
		
	if (isset($_POST['login']) ){
	 //set values to the variables
		
	if (isset($_POST['username'])){
		$user->username = $_POST['username'];
		
	}
	
	/*if (isset($_POST['password'])){
		$user->password = $_POST['password'];
		
		
	}*/
	

if(!empty($user->viewUser())){
	$user->viewUser();
if(!password_verify($_POST['password'],$user->password)){
	//check if user is valid
	//if($user->checkUser() < 1){
	 header("location:../AdminLogin.php?err=3");	
	}else{
	$user->loginUser();
	$_SESSION['logged']=true;
	 $user->viewUser();
	$_SESSION["USERNAME"] = $user->username;
		$_SESSION["ID"] = $user->login_name;
		
	$_SESSION["ROLE"] = $user->role;
	
	if($user->role === "Admin" || $user->role === "Staff" || $user->role === "Cashier" || $user->role === "Academicofficer" || $user->role === "Principal" || $user->role === "Formaster" || $user->role === "Dean" || $user->role === "Adminofficer"){
		
		header("location:../Admin/");
		}elseif($user->role === "Student"){
		
		header("location:../Student/");
		}	
	}
	}
	}
	exit;

 
		
		
	case "resetPassword":
		
	if (isset($_POST['send']) ){
	 //set values to the variables
		
	
	if (isset($_POST['username'])){
		$user->username = $_POST['username'];
		
	}
	
	if(!empty($user->checkUsername())){
	
			if($_POST['new_password'] !== $_POST['confirm_password']){
				 header("location:../AdminLogin.php?err=4");
			}else{
				$user->password =  password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);
			$update = $user->resetUserPassword();	
				
 header("location:../AdminLogin.php?err=5");
				
				}
		
	}else{
		header("location:../AdminLogin.php?err=6");
		}
	
	}
	
	  
break;
	
 		
	case "changePassword":
		
	if (isset($_POST['update']) ){
	 //set values to the variables
		
	
	if (isset($_POST['username'])){
		$user->username = $_POST['username'];
		
	}
	if (isset($_POST['new_password'])){
		$user->password = $_POST['new_password'];
		
	}
	
	if(!empty($user->viewUser())){
	$user->viewUser(); 
	if(!password_verify($_POST['old_password'],$user->password)){
	
	 header("location:../Admin/change_password.php?err=6");	
	}elseif($_POST['new_password'] != $_POST['confirm_password']){
				 header("location:../Admin/change_password.php?err=5");
			}else{
				$user->password =  password_hash($_POST['new_password'], PASSWORD_DEFAULT);
			$update = $user->resetUserPassword();	
				
 header("location:../Admin/change_password.php?emsg=2");
				
				}
		
	}else{
		header("location:../Admin/change_password.php?err=29");
		}
	
	}
 
break;

case "asign_role":
		
	if (isset($_POST['post']) ){
	 //set values to the variables
		
	
	if (isset($_POST['username'])){
		$user->username = $_POST['username'];
		
	}
	if (isset($_POST['user_role'])){
		$user->role = $_POST['user_role'];
		
	}
	
	
			$update = $user->asignRole();	
			if($update == true){	
 header("location:../Admin/manage_staff.php?emsg=2");
				
			
		
	}else{
		header("location:../Admin/manage_staff.php?err=10");
		}
	
	}
 
break;
  
}
?>