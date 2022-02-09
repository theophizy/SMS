<?php
session_start();
ob_start();

	if(!isset($_SESSION['USERNAME'])){
	echo "<script>
location='../'
</script>";
}
//Instantiate classes
include_once('../classes/class.school_setup.php');
include_once('../classes/class.Feeitem.php');
require_once('../classes/class.students.php');



include_once('../classes/class.Term.php');
include_once('../classes/class.bank.php');
//include_once('../classes/class.Session.php');



//require_once('../classes/class.Subject.php');
// instantiate classes
$banks = new Bank();
$classarm = new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$feeitem = new FeeItem();

$database= new Database();

$school_setup = new SchoolSetup();
$payid = $_GET['id'];
$results = $feeitem->viewPaymentbyPayID($payid);
$classarm->class_arm_code = $results['pay_classarm'];
$classarm->viewClassArmByID();
$studentclass->class_code = $results['pay_class'];
$studentclass->viewclassByID();
$studentAction->student_regno = $results['pay_student'];
$studentAction->viewStudentbyID();
$feeitem->fee_cat_id = $results['pay_feecat'];
$feeitem->viewFeeCatID();
$term->term_code = $results['pay_term'];
$term->viewTermByID();
$availableSession->session_code = $results['pay_session'];
$availableSession->viewSessionByID();
$feeitem->fee_id = $results['pay_feeid'];
$feeitem->fee_item_id = $results['pay_feeitem'];
$feeitem->viewfeeitemByID();
$balance = $feeitem->fee_item_amount -$feeitem->sumAmountPaidByFeeid();
//selected student admission number
//id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result Template</title>
 <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
</head>

<body>
 <div class="content mt-3">

<center>
	<table border=1 style=" max-width:2480px; width:90%;">
		<tr>
		<td>
			<table  width="100%">
			<tr>
				<td>
                <?php $school_setup->viewSchoolSetup();
					if(!empty($school_setup->school_logo)){
					 ?>
					<img src="<?php echo $school_setup->school_logo;?>" width="120" height="120">
                    <?php }else{ ?>
                    <img src="../imageupload/pc1.jpg" width="120" height="120">
                     <?php } ?>
				</td>
				<td>
					<b><font size='5'><?php echo strtoupper($school_setup->school_name)?></font></b><br> <i><?php echo ucwords($school_setup->school_address)?></i><br>
                    <i><?php echo $school_setup->school_phone."    ".$school_setup->school_email?></i><br>
					
				</td>
                <td>
              
               </td>
			</tr>
           
			</table>
		</td>
		</tr>
	
		<tr>
		<td>
       <table style="width:80%" ; align="center">
      
      
       
       <tr align="center" ><td> <table width="100%" style="margin-top:20px;" align="center"><tr><td><b>STUDENT PAYMENT SLIP</b></td></tr></table></td></tr>
       <br/>
         <br/>
           <tr ><td> <table width="100%" style="margin-top:20px;" height="500px;"> 
       
       <tr><td colspan="2" align="left">Student Admintion Number</td><td><?php echo $results['pay_student'];?></td></tr>   
        <tr><td colspan="2" align="left">Name</td><td><?php echo $studentAction->last_name."  ".$studentAction->first_name?></td></tr>
        
          <tr><td colspan="2" align="left">Payment Method</td><td><?php echo $results['pay_payment_type'];?></td></tr>
           <?php if($results['pay_payment_type'] == "Bank"){ ?>
         <tr><td colspan="2" align="left">Bank</td><td><?php $banks->bank_id =  $results['pay_bank_code']; $banks->viewBankByID(); echo $banks->bank_code?></td></tr>
         <tr><td colspan="2" align="left">Teller NO</td><td><?php echo $results['teller_id']?></td></tr>
          <?php } ?>
         <tr><td colspan="2" align="left">Amount Paid</td><td><?php echo number_format($results['pay_amount'],2);?></td></tr>
         
           <tr><td colspan="2" align="left">Total Amount Paid</td><td><?php echo number_format($feeitem->sumAmountPaidByFeeid(),2)?></td></tr>
            <tr><td colspan="2" align="left">Balance</td><td><?php echo number_format($balance,2);?></td></tr>
          <tr><td colspan="2" align="left">Payment Description</td><td><?php echo $feeitem->fee_cat_name?></td></tr>
           <tr><td colspan="2" align="left">Class</td><td><?php echo $studentclass->class_name.  $classarm->class_arm_name?></td></tr>
           <tr><td colspan="2" align="left">Term</td><td><?php echo $term->term_name?></td></tr>
            <tr><td colspan="2" align="left">Session</td><td><?php echo $availableSession->session_description?></td></tr>
            <tr><td colspan="2" align="left">Date Paid</td><td><?php echo  $results['pay_date']?></td></tr>
               <tr><td colspan="2" align="left">Account Officer</td><td><?php echo  $results['cashier']?></td></tr>
       </table>
       </td></tr>
       </table>
                
               		</td>
                                
                  </td>             	
             </tr>
			</table>   
		</td>
		</tr></table>
    <button onclick="window.print();" >print</button>
</center>
</div>

</body>
 <script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</html>
