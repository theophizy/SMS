<?php
include_once("sessionStart.php"); 

//require_once('../classes/class.article.php');
include_once('../classes/class.Classarm.php');
include_once ('../classes/class.Feeitem.php');
include_once('../classes/class.Session.php');
//include_once('../classes/class.studentclasses.php');
//include_once('../classes/class.school_setup.php');
include_once('../classes/class.term.php');
//include_once('../classes/class.Classarm.php');

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
<?php  include_once('metadatda.php'); ?>

  <title> List of Fees Defaulters  </title>

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
   
	
	
	function show(id){
		
		window.open('pay_debts.php?id='+id,'Pay Student Fee','scrollbars=yes,resizable=yess,top=500,width=700,left=500,height=700');
		
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
 <div class="btn btn-reddit btn-block"> <strong>List of Students Owing Fees</strong> </div>
 <strong><hr /></strong>

                     
      
   <?php
  
  $feeItem->fee_regno = $_GET['regno'];
	if(!empty($feeItem->viewDebtorsbyRegistrationNumber())){
	
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
                       <th> Amount Owing</th>
                        
                      <th >Action</th>
                    
                    </tr>
                  </thead>
                 <tbody>
                 <tr>
                  <?php
				  $sn=1;
				  
                  
				
                  // if(!empty($studentAction->viewStudentbyClassandClassarm())){
 foreach($feeItem->viewDebtorsbyRegistrationNumber() as $key => $values){
							$studentAction->student_regno = $feeItem->fee_regno;
						$studentAction->viewStudentbyID(); 
				  
				 $feeItem->fee_regno = $studentAction->student_regno;	
						   //get sudent name by his/her admission number
				
					$feeItem->fee_id = 	$values['fee_id'];
				$feeItem->fee_item_id = $values['fee_item'];
				$feeItem->viewfeeitemyID();
				$feeItem->fee_cat_id= $values['fee_cat'];
				$feeItem->viewFeeCatID();
			
		
			
				
			
					
				  ?>
                   
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $feeItem->fee_regno; ?></td>
                      <td><?php echo $studentAction->last_name ."  ". $studentAction->first_name ?></td>
 
                      <td><?php echo $feeItem->fee_cat_name?></td>
                      
                      <td><?php echo number_format($values['amount'],2) ?></td>
                      
                   <td > <a href="#" onClick="show(<?php echo $values['fee_id'] ; ?>)" class="btn btn-primary">Pay</a>
                 
                   
                   </td>
                     </tr>
                            
   
 <?php }//} ?>       
				
		
                  </tbody>
                </table>
  
 <?php }else{ echo "The selected student is not owing. He can pay his/her current fee ";} ?>
     
     </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  

    <!-- Right Panel -->
 <?php include_once('footer.php'); ?>
 <?php include_once('footerTableScript.php'); ?>
</body>
</html>
