<?php
include_once("sessionStart.php"); 

//require_once('../classes/class.article.php');
include_once('../classes/class.Classarm.php');
include_once ('../classes/class.Feeitem.php');
include_once('../classes/class.Session.php');
//include_once('../classes/class.studentclasses.php');
//include_once('../classes/class.school_setup.php');
include_once('../classes/class.term.php');


//include('../classes/class.Database.php');
//include_once ('../Admin/links.php');
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
 <?php include_once('metadatda.php') ?>;
  <title>Pay Fee</title>
  <!-- Tell ethe browser to be responsive to screen width -->
  
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
		
		window.open('payment_page.php?id='+id,'Pay Student Fee','scrollbars=yes,resizable=yess,top=500,width=700,left=500,height=700');
		
	}
    </script> 
   


</head>
<?php include_once('navBar.php'); ?>

<body>

<div class="col-lg-10" align="center"><?php
//include_once('../msg/messages.php');
?></div><div class="clearfix"></div>
        <!-- Left Panel -->

   

         <div class="content mt-12">

           <div class="btn btn-reddit btn-block"> <strong>Fee Payment</strong> </div>
 <strong><hr /></strong>
 <div class="col-lg-12">
 
                    <div class="card">
                     
                      
                      <div class="card-body card-block">
                        <form  action="" method="post" id="form1"   enctype="multipart/form-data" class="form-horizontal" name="postForm" >
                           
         <div class="row form-group">
         <div class="col col-md-2">
                          <select name="class" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($studentclass->viewAllClasses() as $key => $val){
	  ?>
     <option value="<?php echo $val['class_code'] ?>"><?php echo $val['class_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div> 
                          
         <div class="col col-md-2">
                          <select name="classarm" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($classarm->viewAllClassarm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['class_arm_code'] ?>"><?php echo $val['class_arm_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div> 
                          <div class="col col-md-3">
                          <select name="fee_cat" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($feeItem->viewAllFeecat() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['fee_cat_id'] ?>"><?php echo $val['fee_cat_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div> 
          <div class="col col-md-2">
                          <select name="term" onselect="this.className" class="form-control">
     
      <?php
	  
	  foreach($term->viewAllTerm() as $key => $val){ 
	  ?>
     <option value="<?php echo $val['term_code'] ?>"><?php echo $val['term_name'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div>  
                            <div class="col col-md-3">
                          <select name="sessions" onChange="this.form.submit();" onselect="this.className" class="form-control">
                           <option value="">-- Select Session --</option>
      
      <?php
	  
	  foreach($availableSession->viewAllSession() as $key => $val){
	  ?>
     <option value="<?php echo $val['session_code'] ?>"><?php echo $val['session_description'] ?></option>
    
     <?php
	 
	  } ?>
     </select>
                          </div>                
  <!--
    <div class="col col-md-1">
     
                           
                           <i class="fa fa-circle-o-notch fa-spin"></i>
                           <button  type="submit" id="sub"  name="search" class=" btn btn-primary"><i  class="fa fa-search" ></i></button> </div>-->
       </div>                   
</form>
    
  </div>
      
   <?php
  
   if(isset($_POST['sessions'])){
	   $feeItem->fee_cat = $_POST['fee_cat'];
	    $feeItem->fee_item_classid = $_POST['class'];
				    $feeItem->fee_item_classarm = $_POST['classarm'];
					  $feeItem->fee_item_term = $_POST['term'];
			  $feeItem->fee_item_session = $_POST['sessions'];
	if(!empty($feeItem->viewAsignedfeebyTermSessionClassFeecat())){
	
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
                       <th> Fee</th>
                        <th> Amount Paid</th>
                        <th> Balance</th>
                      <th >Action</th>
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                  
				
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($feeItem->viewAsignedfeebyTermSessionClassFeecat() as $key => $values){
							$studentAction->student_regno = $values['fee_regno'];
						$studentAction->viewStudentbyID(); 
				  
				 $feeItem->fee_regno = $studentAction->student_regno;	
						   //get sudent name by his/her admission number
				
					$feeItem->fee_id = 	$values['fee_id'];
				$feeItem->fee_item_id = $values['fee_item'];
				$feeItem->viewfeeitemyID();
				$feeItem->fee_item_description = $values['fee_cat'];
				$feeItem->viewFeeCatID();
			
		
			
				$balance = $feeItem->fee_item_amount - $values['fee_amountpaid'];
			
					
				  ?>
                   
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $values['fee_regno']; ?></td>
                      <td><?php echo $studentAction->last_name ."  ". $studentAction->first_name ?></td>
 
                      <td><?php echo $feeItem->fee_cat_name?></td>
                      
                      <td><?php echo number_format($feeItem->fee_item_amount,2) ?></td>
                      <td><?php echo number_format($values['fee_amountpaid'],2) ?></td>
                      <td><?php echo number_format($balance,2) ?></td>
                   <td > <a href="#" onClick="show(<?php echo $values['fee_id'] ; ?>)" title="pay the student fee" class="btn btn-primary">Pay</a><a href="payment_debtor.php?id=<?php echo $values['fee_id']?>&regno=<?php echo $values['fee_regno'] ?>"  class="btn btn-danger" title="Check if the student is owing">Indebted</a>
                 
                   
                   </td>
                     </tr>
                            
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "No Records Found for the Selected Items";}}  ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  

    <!-- Right Panel -->
     <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
