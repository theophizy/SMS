<?php
include_once("sessionStart.php"); 

//Instantiate classes
include_once('../classes/class.school_setup.php');
include_once('../classes/class.Feeitem.php');
//require_once('../classes/class.students.php');



//include_once('../classes/class.Term.php');
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



$school_setup = new SchoolSetup();
$classarm->class_arm_code = $_GET['classarm'];
$classarm->viewClassArmByID();
$studentclass->class_code = $_GET['class'];
$studentclass->viewclassByID();
$studentAction->student_regno = $_GET['regno'];
$studentAction->viewStudentbyID();
$feeitem->fee_cat_id = $_GET['feecat'];
$feeitem->viewFeeCatID();
$term->term_code = $_GET['term'];
$term->viewTermByID();
$availableSession->session_code = $_GET['sessions'];
$availableSession->viewSessionByID();
//selected student admission number
//id=$feeItem->fee_id&class=$feeItem->fee_item_classid&classarm=$feeItem->fee_item_classarm&term=$feeItem->fee_item_term&sessions=$feeItem->fee_item_session&amountpaid=$feeItem->pay_amount&cashier=$feeItem->cashier&date=$feeItem->pay_date&totalamount=$amouttobeupdatewith&balance=$differenceinamount


?>

<?php  include_once('metadatda.php'); ?>

  <title> Payment Reciept</title>

  <?php  include_once('links.php'); ?>
</head>
<?php include_once('navBar.php'); ?>

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
       
       <tr><td colspan="2" align="left">Student Admintion Number</td><td><?php echo $_GET['regno']?></td></tr>   
        <tr><td colspan="2" align="left">Name</td><td><?php echo $studentAction->last_name."  ".$studentAction->first_name?></td></tr>
         <tr><td colspan="2" align="left">Payment Method</td><td><?php echo $_GET['payment_type']?></td></tr>
         <?php if( $_GET['payment_type'] == "Bank"){ ?>
         <tr><td colspan="2" align="left">Bank</td><td><?php $banks->bank_id =  $_GET['bank']; $banks->viewBankByID(); echo $banks->bank_code?></td></tr>
         <tr><td colspan="2" align="left">Teller NO</td><td><?php echo $_GET['teller_id']?></td></tr>
          <?php } ?>
         <tr><td colspan="2" align="left">Amount Paid</td><td><?php echo number_format($_GET['amountpaid'],2)?></td></tr>
         
           <tr><td colspan="2" align="left">Total Amount Paid</td><td><?php echo  number_format($_GET['totalamount'],2)?></td></tr>
            <tr><td colspan="2" align="left">Balance</td><td><?php echo number_format( $_GET['balance'],2)?></td></tr>
          <tr><td colspan="2" align="left">Payment Description</td><td><?php echo $feeitem->fee_cat_name?></td></tr>
           <tr><td colspan="2" align="left">Class</td><td><?php echo $studentclass->class_name.  $classarm->class_arm_name?></td></tr>
           <tr><td colspan="2" align="left">Term</td><td><?php echo $term->term_name?></td></tr>
            <tr><td colspan="2" align="left">Session</td><td><?php echo $availableSession->session_description?></td></tr>
            <tr><td colspan="2" align="left">Date Paid</td><td><?php echo $_GET['date']?></td></tr>
               <tr><td colspan="2" align="left">Account Officer</td><td><?php echo $_GET['cashier']?></td></tr>
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
  <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>

</html>
