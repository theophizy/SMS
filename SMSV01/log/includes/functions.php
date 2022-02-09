<?php 
include_once("config/db_conn.php");
require ('DbAction.php');
class Page extends sqlOperation{ 
// class Page's attributes
 
 public function random(){
	 $no=rand(9999,0000);
	 $tim=date('s');
	 $id=$no.$tim;
	 return $id;
	 
 }
 public function chechkMail($email){
	
	  
 return filter_var($email, FILTER_VALIDATE_EMAIL) 
;
 }
 
 
public function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	 public function changePass($username,$currentpass,$newpass,$cnewpass){
	 $q=$this->SqlQ();
	 $r=$this->Rows();
	 $far=$this->Rfectch();
	 $msg;

	 $ql=$q("select * from users where username='$username'")or die(mysql_error());
	 if($r($ql)<0){
		 $msg="
		 You can't access this page. Contact your Admin

		 ";
	 }else{
	$col=$far($ql);
	$npass=$col['password'];
	if($npass !=$currentpass || $newpass!=$cnewpass){
	 $msg="Is either your current password is not current or your newpassword does not match with the confirm password. Check and try again!
	 
	 ";	
	}else{
	$sql1=$q("update users set password='$newpass' where username='$username'")or die(mysql_error());
	if($sql1==1){
		$msg="
		Password change successfully.
	
		";		
 }else{
	 $msg="
	 Oops!!! an error occur, pls try agian 

	 ";	
	}}}
 return $msg;
  }}
   ?>


