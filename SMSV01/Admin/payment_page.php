<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}
include_once('../classes/class.Classarm.php');
include_once ('../classes/class.Feeitem.php');
include_once('../classes/class.Session.php');

include_once('../classes/class.term.php');
include_once('../classes/class.bank.php');
$banks = new Bank();
$students = new Students();
$feeItem = new FeeItem();
require_once('../classes/class.students.php');
$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$feeItem->fee_id = $_GET['id'];
$getitems = $feeItem->viewSingleAsignedFee();
$feeItem->fee_item_id = $getitems['fee_item'];
$feeItem->viewfeeitemyID();
$balance = $feeItem->fee_item_amount- $getitems['fee_amountpaid'];
$feeItem->fee_item_description = $getitems['fee_cat'];
$studentAction->student_regno = $getitems['fee_regno'];
$studentAction->viewStudentbyID();
$feeItem->viewFeeCatID();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
   <script type="text/javascript">
	 function isNumberKey(evt){
		 var charCode=(evt.which)? evt.which : event.keyCode;
		 if((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)  )
		 return false;
		 else
		 return true;
		
		 }
		 
		  function isNumber(evt){
			  evt = (evt) ? evt : window.event;
		 var charCode=(evt.which)? evt.which : evt.keyCode;
		 if(charCode > 31 && (charCode < 46 || charCode >57))
		 return false;
		 else
		 return true;
		
		 }
   function hideDiv(){
	   document.getElementById('bank').style.display = 'none';
	   }
		
   function showDiv(){
	   document.getElementById('bank').style.display = 'block';
	   }
	  
    </script> 
   
</head>

<body>

<?php
/*
$variable="theo";
$encode= BASE64_ENCODE($variable);
$decode= BASE64_DECODE($encode);
echo $encode."==decoded valew==".$decode;
*/
?>

   <div class="container" style="width:700px;">  
               <div class="col-lg-10" align="center"><?php
include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
 <div class="btn btn-reddit btn-block"> <strong>Fee Payment</strong> </div>
 <strong><hr /></strong>
     <div class="col-md-8">
     <form method="POST" action="../Control_classes/feeitem_controller.php?action=Pay_fee">
				
						<div class="form-group">
							<label>Fee Item Description </label>
							<input type="hidden" name="fee_id" value="<?php echo $feeItem->fee_id ?>"/>
<input type="text" name="description" value="<?php echo $feeItem->fee_cat_name ?>" class="form-control" onkeyup="this.value= this.value.toUpperCase();" readonly />
						</div>

						
				</div>
               

						
				
                 <div class="col-md-8">
						<div class="form-group">
							<label>Student Admission Number </label>
							
<input type="text" name="student_adminssion_no" value="<?php echo $getitems['fee_regno'] ?>" class="form-control"   readonly />
						</div>

						
				</div>
                <div class="col-md-8">
						<div class="form-group">
							<label>Student Name   </label>
							
<input type="text" name="term" value="<?php echo  $studentAction->last_name ."  ". $studentAction->first_name ?>" class="form-control" readonly  required />
						</div>

						
				</div>
                 <div class="col-md-8">
						<div class="form-group">
							<label>Amount to be paid </label>
							<input type="hidden" name="amounttobepaid" value="<?php echo $balance ?>" class="form-control"  readonly/>
<input type="text" name="" value="<?php echo number_format($balance,2) ?>" class="form-control"  readonly/>
						</div></div>
                        
                        <div class="col-md-12">
						<div class="row form-group">
							<label>Payment Option </label>
							
<input type="radio" name="payment_option"  value="Cash" checked  onclick="hideDiv()" />&nbsp;&nbsp;&nbsp;<strong>Cash</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_option"  value="Bank"  onclick="showDiv()"/>&nbsp;&nbsp;&nbsp;<strong>Bank</strong>
						</div>

						
				</div>
				</div>
                <div id="bank"  style="display:none;">
                <div class="col-md-8">
						<div class="form-group">
							<label>Select Bank </label>
							
<?php echo $banks->bankSelectField() ?>						</div>

						
				</div>
               
                
                <div class="col-md-8">
						<div class="form-group">
							<label> Teller Number </label>
							
<input type="text" name="teller_id" value="" class="form-control" onKeyPress="return isNumber(event)"  />
						</div>

						
				</div>
               
                </div>
                <div class="col-md-8">
						<div class="form-group">
							<label>Enter the amount the student is paying </label>
							
<input type="number" name="amount" value="" class="form-control" onKeyPress="return isNumber(event)" required />
						</div>

						
				</div>
               
                
				
				<div class="modal-footer">
					<div class="col-md-8">
						<div class="form-group">
						<button name="pay" type="submit" class="btn btn-primary btn-block"></span> Pay</button>
                       
						</div>

						
				</div>
					
                    </div></div>
                    </form>
				</div>
 </body>
 
 </html>
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
 });
 </script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
 
