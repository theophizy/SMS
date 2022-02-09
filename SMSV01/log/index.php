<?php 
session_start();
require('../includes/Crud.php');
require('../includes/Validation.php');
$crud=new Crud();
$ipaddress = '';
if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))
   $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
else
$ipaddress = 'UNKNOWN';
//echo "give me ip".$ipaddress;//ends here
 //how to get users country from his IP
 if (isset($_SERVER['HTTP_CLIENT_IP']))
{
    $real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
}

if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
    $real_ip_adress = $_SERVER['REMOTE_ADDR'];
}
$username=$crud->escape_string($_POST['user_email']);
$password=$crud->escape_string($_POST['pwd']);
$loginsession="";
if(isset($_POST['sub'])){
$query="select * from users where username='$username' and password='$password'";
if(!$crud->num_rows($query)){
	$result=$crud->FindsingleRecord($query);
	$status=$result['user_status'];
	if($status==0){
		$msg="
<div class='btn btn-danger btn-block'>
Your registration is still pending approval

</div>
"	;
	}elseif($status==2){
		$msg="
<div class='btn btn-danger btn-block'>
Your account has been deactivated. Contact Admin

</div>
"	;
}elseif($status==1){
	
	$email=$result['username'];	
	$role=$result['role'];
	$registration_number=$result['registration_number'];
	if($role=="Enrollee" || $role=="Agent" || $role=="Provider"){
	$loginsession=$registration_number;
	}else{
	$loginsession=$email;
}
$_SESSION['username']=$loginsession;
	$date1=date("Y/m/d h:i:s");
	$_SESSION['logged']=true;
	
	$_SESSION['role']=$role;
	$crud->execute("update users set login_status='1', last_login='$date1',ipaddress='$ipaddress' where username='$email'");
	if($role=="Enrollee"){
		echo  "<script>alert('Login successfully')
location='../Enrollees/'

</script>
";

}
	if($role=="Agent"){
		echo "<script>alert('Login successfully')
location='../Agents/'

</script>
"	;
	
}

	if($role=="Provider"){
		echo "<script>alert('Login successfully')
location='../Service_providers/'

</script>
"	;
	
}

	if($role=="Admin"){
	echo "<script>alert('Login successfully')
location='../Admin/'

</script>
"	;
	
}}
}else{
$msg="
<div class='btn btn-danger btn-block'>
Invalid username or password 

</div>
"	;	
}}
?>


<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Epic Mutual Life</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Educative Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="style/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="style/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="style/css/font-awesome.css" rel="stylesheet"> 

<!--web-fonts-->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<script type="text/javascript">
 function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }
 

 </script>
	</head>
	<body bgcolor="#999999">
    
   
<!--header end here-->
<!--top nav start here-->

<!--top nav end here-->

<!-- header -->
    <!-- /container -->

<!-- /Header -->


<!-- Main -->
<header>
			<div class="container">

			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>				  
				<div class="w3-logo">
					<h1><a href="../">Epic Mutual Life  &nbsp;&nbsp;&nbsp;</a></h1>
                   
					
				</div>
				</div>

				
			</nav>
			
				 
				</div><!-- /.navbar-collapse -->
				 <div class="clearfix"></div>
		<!-- //navigation -->
			
		</header>
	<!-- //header -->
	


<div class="container">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <!-- Left column -->
          

          
            <!-- head section -->   
        </div>
        <!-- /col-3 -->
        
        <!-- /end of first column -->
        
         <!-- Start of Second column -->
        
       
            <div class="row">
                <!-- center left-->
              
                <div class="col-md-6">
                <br><br><br>
                     <?php echo $msg  ?>
                    <hr>
                    <H2 style="color:#CC6600">SIGN IN </h2> 

  
  
    <form action="" method="post" >
  
                  
                  <div class="form-group">
         <span class="glyphicon glyphicon-envelope"></span>
       
          <input type="text" name="user_email" id="user_email" placeholder="E-mail" class="form-control"  required">
          <div class="help-block with-errors"></div>
         </div>
         <div class="form-group">
      <span class="glyphicon glyphicon-lock"></span>
     
       
          <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password"  required>
          </div>
         
         
        
             <input type="submit" name="sub" id="sub" value="LOGIN" class="btn btn-success">  
             <a href="../"><input type="cancel" name=""  value="CANCEL" class="btn btn-danger"></a>    
             </form>
 
                  
                    <!--/panel-->

                   
                    <!--tabs-->
                   
                    <!--/tabs-->

                    <!-- /end of second column -->
                <!--/col-->
                
                
                 <!-- start of third column -->
                        <!--/panel content-->
                    </div>
                    <!--/panel-->

                    <!--/panel-->

                </div>
                <!--/col-span-6-->

            </div>
            <!--/row-->

            <hr>

               </div>
        </div>
        <!--/col-span-9-->
    </div>
</div>
<!-- /Main -->
 <!-- /end of third column -->
<div style="position:fixed; ">


</div>
<!-- /.modal -->
	<!-- script references -->
	</div>
</body>
</html>
