<?php
/*
if(1 === "1 good"){
  echo "yea";
}else{
  echo" bad";
}
php juggling
*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VS45 TECH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="Admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="Admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="Admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script type="Text/javascript">
setTimeout(function(){
    $('#msgdiv').fadeOut('slow');
    
}, 6000);
</script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:"><b>VS45 TECH</b> Ltd</a>
  </div>
  <!-- /.login-logo -->
   
<?php
if(isset( $_GET['err'])){
	if( $_GET['err'] == 3){
	?>
    <div class='btn btn-danger btn-block' id="msgdiv"><i class="fa fa-warning"></i>
<?php echo "Invalid password or username or Inactive User"; ?>
    </div
    ><?php	
	}elseif( $_GET['err'] == 4){
	?>
    <div class='btn btn-danger btn-block' id="msgdiv"><i class="fa fa-warning"></i>
<?php echo "Password does not correspond."; ?>
    </div
    ><?php	
	}elseif( $_GET['err'] == 5){
	?>
    <div class='btn btn-success btn-block' id="msgdiv"><i class="fa fa-check"></i>
<?php echo "Password reset successfully."; ?>
    </div
    ><?php	
	}elseif( $_GET['err'] == 6){
	?>
    <div class='btn  btn-danger btn-block' id="msgdiv"><i class="fa fa-warning"></i>
<?php echo "Invalid Staff ID or Student Admission Number."; ?>
    </div
    ><?php	
	}
	}

?>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="Control_classes/user_controller.php?action=loginUser" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="" data-toggle="modal" data-target="#confirmModal" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-lock"></i> Forgot Password</a>
      <a href=""  class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-warning"></i> Not a user? Contct Admin</a>
    </div>
    <!-- /.social-auth-links -->

   
  

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
  <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <div class="btn btn-reddit btn-block"> <strong>Pls enter your username to reset password</strong> </div>
                     <h3><strong><hr></strong></h3>
              
            </div>
            <div class="modal-footer">
              <form action="Control_classes/user_controller.php?action=resetPassword" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Staff ID or Student Addmission Number" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="new_password" class="form-control" placeholder="New password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="confirm_password" class="form-control" placeholder="New password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="send" class="btn btn-primary btn-block">Save</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

            </div>
          </div>
        </div>
      </div>
<!-- jQuery 3 -->
<script src="Admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="Admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="Admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
