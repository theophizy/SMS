<?php include_once("sessionStart.php"); ?>
<?php

require_once('../classes/class.staff.php');
include_once('../classes/class.Feeitem.php');

$feeitem = new FeeItem();
$students = new Students();
$staffAction = new Staff();
if(!empty($students->viewStudentbyIDofStatusAlumni())){
	
	$feeitem->moveDebtorsHistoryofAlumni();
	
	//$students->viewStudentbyIDForGraduation();
}
//$studentclass = new StudentClasses();
//$availableSession = new Session_class();
//$term = new Term();
//$subject = new Subject();
//$createscore = new Scores();
//$database = new Database();
  $staffAction->staff_id = $_SESSION['USERNAME'];
 $staffAction->viewStaffbyID();
	

?>

 <?php  include_once('metadatda.php'); ?>
  <title>Ischool</title>
  <!-- Tell the browser to be responsive to screen width -->
  
 <?php  include_once('links.php'); ?>
 </head>
<?php include_once('navBar.php'); ?>
     
        <!---<section class="col-lg-12 connectedSortable" style="height:800px;">
         <iframe class="embed-responsive" id="iframe_info" name="iframe_info" width="100%" frameborder="0" height="1500" style="position:absolute; top: 0; left: 0; height:100%;  scroll-behavior: unset;"></iframe> 
          <div class="nav-tabs-custom">
            <!-- Tabs within a box
           
            <div class="tab-content no-padding">
             
             
            </div>
             </div>
          </section>  -->
         <?php include_once('footer.php'); ?>
          <?php include_once('footrJScripts.php'); ?>

</body>
</html>
