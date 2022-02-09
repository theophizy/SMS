<?php include_once("sessionStart.php"); ?>
<?php

//require_once('../classes/class.article.php');
include_once('../classes/class.Classarm.php');
include_once ('../classes/class.Feeitem.php');
include_once('../classes/class.Session.php');
//include_once('../classes/class.studentclasses.php');
//include_once('../classes/class.school_setup.php');
include_once('../classes/class.term.php');
include_once('../classes/class.bank.php');

//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
$banks = new Bank();
$students = new Students();
$feeItem = new FeeItem();
require_once('../classes/class.students.php');
$classarm=new ClassArm();
$studentAction = new Students();
$studentclass = new StudentClasses();
$availableSession = new Session_class();
$term=new Term();
//$school_setup = new SchoolSetup();



//$studentAction = new Students();

?>
<!-- Author: Anande Theophilus Terfa             -->
<?php  include_once('metadatda.php'); ?>

  <title>Alumin Payment History</title>

  <?php  include_once('links.php'); ?>
<head>
   

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
   
	
	function display(id){
		
		window.open('payment_debt.php?id='+id,'Pay Student Fee','scrollbars=yes,resizable=yess,top=500,width=500,left=500,height=500');
		
	}
	function show(id){
		
		window.open('alumni_payment_receipt.php?id='+id,'Alumni Payment History','scrollbars=yes,resizable=yess,top=500,width=700,left=500,height=700');
		
	}
    </script> 
   


</head>
<?php include_once('navBar.php'); ?>

<div class="col-lg-10" align="center"><?php
//include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

          
 <div class="col-lg-12">
 
                    <div class="card">
                     <div class="btn btn-reddit btn-block"> <strong>Old Students Payments History</strong> </div><strong><hr></strong>
                      <div class="card-header" align="center">
      
   <?php
  
  
	  
	if(!empty($feeItem->viewAlumniPaymentHistory())){
	
   ?>
     
     <div class="table-responsive" >  
                     
                     <br />  
                   <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Admision No</th>
                      <th> Name</th>
                       <th> Fee Item</th>
                         <th> Payment Method</th>
                          <th> Bank</th>
                          <th> Teller No</th>
                         <th> Class</th>
                        <th> Amount Paid</th>
                        <th> Cashier</th>
                         <th> Date Paid</th>
                        
                            <th> Term</th>
                         <th> session</th>
                      <th >Action</th>
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                  
				
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($feeItem->viewAlumniPaymentHistory() as $key => $values){
							$studentAction->student_regno = $values['pay_student'];
						$studentAction->viewAlumnibyID(); 
				  
				// $feeItem->fee_regno = $studentAction->student_regno;	
						   //get sudent name by his/her admission number
				
					$pay_id = 	$values['pay_id'];
				$feeItem->fee_item_id = $values['pay_feeitem'];
				$feeItem->viewfeeitemyID();
				$feeItem->fee_cat_id = $values['pay_feecat'];
				$feeItem->viewFeeCatID();
				$studentclass->class_code =  $values['pay_class'];
				$studentclass->viewclassByID();
				$classarm->class_arm_code =  $values['pay_classarm'];
				$classarm->viewClassArmByID();
				$term->term_code = $values['pay_term'];
				$term->viewTermByID();
				$availableSession->session_code = $values['pay_session'];
				$availableSession->viewSessionByID();
			 $banks->bank_id =  $values['pay_bank_code'];
			 
			 if(!empty($banks->bank_id)){
			  $banks->viewBankByID();
			 $bankcode = $banks->bank_code;
			 
			 }else{
				$bankcode =""; 
			 }
			 if( $values['teller_id'] == 0){
				 $teller = "";
			 }else{
			 $teller = 	$values['teller_id']; 
			 }
				  ?>
                   
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $values['pay_student']; ?></td>
                      <td><?php echo $studentAction->last_name ."  ". $studentAction->first_name ?></td>
 
                      <td><?php echo $feeItem->fee_cat_name?></td>
                        <td><?php echo  $values['pay_payment_type']?></td>
                          <td><?php echo $bankcode?></td>
                         <td><?php echo  $teller; ?></td>
                      <td><?php echo $studentclass->class_name.$classarm->class_arm_name ?></td>
                      <td><?php echo number_format($values['pay_amount'],2) ?></td>
                      <td><?php echo $values['cashier']; ?></td>
                      <td><?php echo $values['pay_date']; ?></td>
                      <td><?php echo $term->term_name ?></td>
                      
                      <td><?php echo $availableSession->session_description ?></td>
                      
                    
                   <td > <a href="#" onClick="show(<?php echo $pay_id ; ?>)" title="Pay Receipt" class="btn btn-primary">Receipt</a>
                 
                   
                   </td>
                     </tr>
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "No Records Found for the Selected Items";}  ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  </div>

    <!-- Right Panel -->
<?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
