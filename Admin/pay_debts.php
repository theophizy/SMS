<?php
include_once("sessionStart.php"); 
include_once('../classes/class.Classarm.php');
include_once ('../classes/class.Feeitem.php');
include_once('../classes/class.Session.php');

include_once('../classes/class.term.php');
include_once('../classes/class.bank.php');

$students = new Students();
$feeItem = new FeeItem();
require_once('../classes/class.students.php');
$classarm = new ClassArm();
$banks = new Bank();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
$feeItem->fee_id = $_GET['id'];
$getitems = $feeItem->viewDebtorsbyFeeID();

$balance =  $getitems['amount'];
$feeItem->fee_cat_id = $getitems['fee_cat'];
$studentAction->student_regno = $getitems['fee_regno'];
$studentAction->viewStudentbyID();
$feeItem->viewFeeCatID();
?>

<?php  include_once('metadatda.php') ?>;
  <title>Pay Student Debt</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>
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
<?php include_once('navBar.php'); ?>

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
 <div class="btn btn-reddit btn-block"> <strong>Debt Payment</strong> </div>
 <strong><hr /></strong>
     <div class="col-md-8">
     <form method="POST" action="../Control_classes/feeitem_controller.php?action=Pay_debt">
				<div class="modal-header">
					
				</div>
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
							
<input type="text" name="term" value="<?php echo  $studentAction->last_name ."  ". $studentAction->first_name ?>" class="form-control" readonly   />
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
							
<input type="radio" name="payment_option"  value="Cash"  checked onclick="hideDiv()" />&nbsp;&nbsp;&nbsp;<strong>Cash</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_option"  value="Bank"  onclick="showDiv()"/>&nbsp;&nbsp;&nbsp;<strong>Bank</strong>
						</div>

						
				</div>
				</div>
                <div id="bank"  style="display:none;">
                <div class="col-md-8">
						<div class="form-group">
							<label>Select Bank </label>
							
<?php echo $banks->bankSelectField() ?>
						</div>

						
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
                        <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
 </body>
 
 </html>
 