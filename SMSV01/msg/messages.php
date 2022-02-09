<?php
include_once('../classes/messages.php');

?>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<script type="Text/javascript">
setTimeout(function(){
    $('#msgdiv').fadeOut('slow');
    
}, 6000);
</script>
</head>
<body>
<div class="col-sm-8">
                <div class="page-header float-left">
                 <!-- 
                    <div class="page-title">
                   
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                         </div>
                         -->
                   
                   
                    <?php 
					
					if (!isset($_GET['emsg'])) {
		$emsg =0 ;
	}else{
                     $emsg= $_GET['emsg'];
                   
	}
	if (!isset($_GET['err'])) {
			$err=0;
	}else{
		 $err= $_GET['err'];
	}
	if (isset($_GET['err'])) {
			unset($emsg);
			}
			if(isset($emsg) && $emsg!="") {
			?>
            <div class="btn btn-success btn-block" style="float:right;" id="msgdiv"><i class="fa fa-check"></i>
 <?php echo  $sucessmessage[$emsg];?>
</div>
<?php }
if(isset($err) && $err!="") {				

					
 ?>
<div class='btn btn-danger btn-block' id="msgdiv"><i class="fa fa-warning"></i>

<?php echo $errormessage[$err];	}?>
</div>
                </div>
            </div>
</body>

</html>