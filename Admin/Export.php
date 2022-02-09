<?php include_once("sessionStart.php"); ?>

<?php


include_once ('../classes/class.Feeitem.php');
include_once('../classes/class.Session.php');
include_once('../classes/class.studentclasses.php');
//include_once('../classes/class.school_setup.php');
include_once('../classes/class.term.php');
include_once('../classes/class.Classarm.php');

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
if(isset($_POST["Export"])){
	
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=debtors.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('SNO','ADMISSION NUMBER', ' NAME', 'FEE ITEM', 'CLASS', 'TERM','SESSION','AMOUNT'));  
      $sn = 1; 
     foreach($feeItem->viewAllDebtors() as $key => $values){
							$studentAction->student_regno = $values['fee_regno'];
						$studentAction->viewStudentbyID(); 
				  
				 $feeItem->fee_regno = $studentAction->student_regno;	
						   //get sudent name by his/her admission number
				
					$feeItem->fee_id = 	$values['fee_id'];
				$feeItem->fee_item_id = $values['fee_item'];
				$feeItem->viewfeeitemyID();
				$feeItem->fee_item_description = $values['fee_cat'];
				$feeItem->viewFeeCatID();
				$studentclass->class_code =  $values['fee_class'];
				$studentclass->viewclassByID();
				$classarm->class_arm_code =  $values['fee_classarm'];
				$classarm->viewClassArmByID();
				$term->term_code = $values['fee_term'];
				$term->viewTermByID();
				$availableSession->session_code = $values['fee_session'];
				$availableSession->viewSessionByID();
				$row = array($sn++,$values['fee_regno'],$studentAction->last_name."  ".$studentAction->first_name,$feeItem->fee_cat_name,$studentclass->class_name.$classarm->class_arm_name,$term->term_name,$availableSession->session_description,$values['amount']);
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  